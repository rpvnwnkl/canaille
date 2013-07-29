<?php
/*
Plugin Name: Bitly Official WordPress Plug-in
Description: A plugin that replaces shared links with Bitly short urls and gives you the option of placing a widget on your site that shows your popular or most recent bitmarks, or the top results from a search of all currently popular bitly links.  Please visit the plug-in settings page to authorize your Bitly account.  For the widget, please find 'Bitly Bitmarks' under the Available Widgets area.
Version: 1.0
Author: Bitly
*/

require_once( 'lib/BitlyService.php' );

$default_domains = array( 'bit.ly', 'bitly.com', 'j.mp' );

$bitly_settings = get_option('bitly_settings');
if ( (!$bitly_settings || !$bitly_settings['oauthToken'] || $bitly_settings['oauthToken'] == "") && !isset($_POST['submit']) )
{
	function bitly_warning()
	{
		echo "
		<div id='bitly-warning' class='updated fade'><p><strong>".__('Bitly is almost ready.')."</strong> ".sprintf(__('You must <a href="%1$s">enter your Bitly WP OAuth Token</a> for it to work.'), 	"admin.php?page=bitly")."</p></div>
		";
	}
	
	add_action('admin_notices', 'bitly_warning');
}


class Bitly extends BitlyService
{

	function __construct()
	{
		global $wpdb;

		// Filter for our short link
		add_filter ( 'post_link', array( &$this, 'hook_post_link' ), 10, 3 );

		// Admin settings
		add_action( 'wp_loaded', array( &$this, 'wp_loaded' ) );

		// Get bitly link button
		add_filter('get_sample_permalink_html', array( &$this, 'hook_get_sample_permalink_html' ), '',4);
		
		// set some tags
		add_action( 'wp_head', array( &$this, 'og_tags' ));
	}
	
	function og_tags()
	{
		$tags = array();
		
		$p = get_post();
		
		if ( $p->ID > 0 )
		{
			$tags['bitly:url'] = $this->get_bitly_link_for_post_id( $p->ID );
			$tags['og:url'] = $this->get_bitly_link_for_post_id( $p->ID );
		}

		if ( empty( $tags ) )
			return;
		
		$og_output = '';
		foreach ( (array) $tags as $tag_property => $tag_content )
		{
			// to accomodate multiple images
			$tag_content = (array) $tag_content;
			$tag_content = array_unique( $tag_content );
	
			foreach ( $tag_content as $tag_content_single )
			{
				if ( empty( $tag_content_single ) )
					continue; // Don't ever output empty tags
					
				$og_tag = sprintf( '<meta property="%s" content="%s" />', esc_attr( $tag_property ), esc_attr( $tag_content_single ) );
				$og_output .= $og_tag . "\n";
			}
		}
	
		echo $og_output;
	}
	
	// get our shortcode
	function hook_post_link($permalink, $post, $leavename)
	{
		// check if the call was from a plugin
		$plugin_call = false;
		$bt = debug_backtrace();
		foreach ( $bt as $b )
		{
			if (strpos($b['file'],'wp-content/plugins') !== false)
			{
				$plugin_call = true;
			}
			
			// don't want to hook for our own plugin!
			if (strpos($b['file'],'bitly') !== false)
			{
				$plugin_call = false;
				break;
			}
			
			// custom for jetpack
			if (strpos($b['file'],'sharing-service') !== false && strpos($b['file'],'jetpack') !== false && $b['function'] == 'get_display' )
			{
				$plugin_call = false;
				break;
			}
		}
		
		// return the bitly link
		if ( $plugin_call )
		{
			$link = $this->get_bitly_link($permalink, $post->ID);
			if ( strlen($link) > 0 )
			{
				return $link;
			}
		}
		
		// not a plugin, return a normal link
		return $permalink;
	}
	
	// Add our get bitly link button to the admin post view
    function hook_get_sample_permalink_html($return, $id, $new_title, $new_slug)
    {
	    // <strong>Permalink:</strong>\n<span id="sample-permalink" tabindex="-1">http://dev.groovyape.com/?p=9</span>\n<span id="change-permalinks"><a href="options-permalink.php" class="button button-small" target="_blank">Change Permalinks</a></span>\n<span id='view-post-btn'><a href='http://dev.groovyape.com/?p=9' class='button button-small'>View Post</a></span>
	    $p = get_post();
	    
	    if ( $p && isset($p->ID) )
	    {
		    $bitly_link = $this->get_bitly_link_for_post_id($p->ID);
	
		    if ( strlen($bitly_link) > 0 )
		    {
		    	return $return . "<span id='view-post-btn'><input id=\"bitly-link\" type=\"hidden\" value=\"$bitly_link\" /><a href='#' class='button button-small' onclick=\"prompt(&#39;URL:&#39;, jQuery('#bitly-link').val()); return false;\">View Bitly Link</a>\n";
		    }
	    }
	    
	    return $return;

    }
	
	function get_most_recent_cache($total)
	{
		$result = get_transient( 'bitly_recent' );
		
		// nothing in the cache, hit the bitly api
		if ( false === $result )
		{
			$result = $this->get_most_recent($total);
			
			// cache data for 60 seconds
			set_transient( 'bitly_recent', $result, 60 );
		}

		return $result;
	}
	
	// Get our most popular links (checks the cache first)
	function get_most_popular_cache($total)
	{
		$result = get_transient( 'bitly_popular' );
		
		// nothing in the cache, hit the bitly api
		if ( false === $result )
		{
			$result = $this->get_most_popular($total);
			
			// cache data for 60 seconds
			set_transient( 'bitly_popular', $result, 60 );
		}
	
		return $result;
	}
	
	function get_search_cache($total, $query)
	{
		$result = get_transient( 'bitly_search_' . $query );
		
		// nothing in the cache, hit the bitly api
		if ( false === $result )
		{
			$result = $this->search($total, $query);
			
			// cache data for 60 seconds
			set_transient( 'bitly_search_' . $query, $result, 60 );
		}
	
		return $result;
	}
	
	function get_bitly_link_for_post_id($post_id)
	{
		if ( $post_id )
		{
			$meta = get_post_meta($post_id);
			
			if ( isset($meta['bitly_url']) )
			{
				return $meta['bitly_url'][0];
			}
		}
		
		// if we get here we need to create one
		$permalink = get_permalink($post_id);
		return $this->get_bitly_link($permalink, $post_id);			
	}
	
	function get_bitly_link($permalink, $post_id)
	{
		if ( $post_id )
		{
			// snag our permalink for a comparison
			if ( strlen($parmlink) == 0 )
			{
				$permalink = get_permalink($post_id);
			}
		
			$meta = get_post_meta($post_id);
			
			if ( isset($meta['bitly_url']) && isset($meta['bitly_long_url']) && $permalink == $meta['bitly_long_url'][0] )
			{
				return $meta['bitly_url'][0];
			}
		}

		if ( !$domain = bitly_settings( 'domain' ) )
			$domain = 'bit.ly';
			
		// in theory this should never fail
		if ( ($data = $this->shorten($permalink, $domain)) )
		{
			// verify it doesn't exist already
			$meta = get_post_meta($post_id);
			
			// update
			if ( isset($meta['bitly_url']) )
			{
				update_post_meta($post_id, 'bitly_url', $data['url']);
				update_post_meta($post_id, 'bitly_hash', $data['hash']);
				update_post_meta($post_id, 'bitly_long_url', $permalink);
			}
			// add
			else
			{
				add_post_meta($post_id, 'bitly_url', $data['url'], true);
				add_post_meta($post_id, 'bitly_hash', $data['hash'], true);
				add_post_meta($post_id, 'bitly_long_url', $permalink, true);
			}
			
			return $data['url'];
		}
		else
		{
			// TODO: throw error
			error_log("Unable to get a bit.ly link for permalink '$permalink' and post id '$post_id'!");
			
			return NULL;
		}
		
		return NULL;
	}
	
	// Wordpress has loaded
	function wp_loaded()
	{
	
		if ( is_admin() )
		{
			add_action( 'admin_menu', 'bitly_admin_setup' );

			add_filter( 'plugin_action_links', 'bitly_service_action_link', 10, 2 );
		}
		else
		{
			// include jquery
			wp_enqueue_script('jquery'); 
			
			// include our js script
			wp_enqueue_script('bitly-js', plugins_url('/js/bitly-client.js',__FILE__) );
		}
	}
}

// start
$bitly = new Bitly();
if ( $oathToken = bitly_settings( 'oauthToken' ) )
	$bitly->oauth( $oathToken );
	
// require after $bitly has been defined so we can access statistics
require_once( 'bitly-widget.php' );
	
/**
 * Loads the settings once and allows the input of the specific field the user would
 * like to show.
 *
 * @since 1.0.0
 */
function bitly_settings( $option = '' )
{
	if ( empty( $option ) )
		return false;

	$settings = get_option( 'bitly_settings' );

	if ( !is_array( $settings ) || empty( $settings[$option] ) )
		return false;

	return $settings[$option];
}

// Adds our setup page
function bitly_admin_setup() {
	add_options_page( __( 'Bitly Settings', 'bitly' ), 'Bitly', 'manage_options', 'bitly', 'bitly_service_settings_page' );

	add_action( 'admin_init', 'bitly_service_register_settings' );
}

// register our settings page w/wordpress
function bitly_service_register_settings()
{
	register_setting( 'bitly_settings', 'bitly_settings', 'bitly_validate_settings' );
}

// validate our settings (nothing needed here)
function bitly_validate_settings( $input )
{
	global $default_domains, $bitly;
	
	/*
	if ( isset($input['custom_domain']) && strlen($input['custom_domain']) > 0 && $input['custom_domain'] != 'Custom' )
	{
		// verify this is a proper domain
		if ( $bitly->pro($input['custom_domain']) )
		{
			// our default domain is now this one!
			$input['domain'] = $input['custom_domain'];
		}
		// default to normal
		else
		{
			$input['domain'] = 'bit.ly';
		}
	}
	
	// we never save the custom_domain key since we just save it to domain
	unset($input['custom_domain']);*/
	
	return $input;
}


// Adds the Bitly Service settings page.
function bitly_service_settings_page() { 
	global $default_domains, $bitly; 
	
	// include jquery
	wp_enqueue_script('jquery'); 
	
	// include our js script
	wp_enqueue_script('bitly-js', plugins_url('/js/bitly.js',__FILE__) );
	
	// check if there is an existing token and if it is valid!
	if ( $bitly->hasToken() )
	{
		$info = $bitly->userInfo();
		
		if ($info == false)
			{
				$validKey = false;
				$noConnection = true;
			}
		else	
			{
				if ( isset($info['data']['login']) )
				{
					$validKey = true;
					$noConnection = false;

				}
				else
				{
					$validKey = false;
					$noConnection = false;
				}
			}
	}
		

?>

	<div class="wrap">

		<?php // screen_icon( 'bitly' ); ?>

		<h2><?php _e( 'Bitly Settings', 'bitly' ); ?></h2>

		<form id="bitly_service_options_form" action="<?php echo admin_url( 'options.php' ); ?>" method="post">

			<?php settings_fields( 'bitly_settings' ); ?>
			
			<h3>This plugin will replace your permalinks with Bitly links for all sharing plugins.</h3>
			<p>
				To enable this plugin, you must first link it with your Bitly account by generating a Bitly WordPress OAuth token. 
			</p>
			<p>
				Visit the <a href="https://bitly.com/a/wordpress_oauth_app" target="_blank">Bitly WP OAuth</a> 
				page on Bitly.com and enter your Bitly password to generate an access token, then paste it here.
			</p>

			<table class="form-table">
				<tr>
					<th><label for="bitly_settings-oauthToken"><?php _e( 'OAuth Token', 'bitly' ); ?></label></th>
					<td>
						<?php if (isset($validKey) && !$validKey && !$noConnection) { echo "<span style='color:red;'><strong>Invalid OAuth Token:</strong> Please verify that you have entered your Bitly OAuth token correctly.</span><br>"; } ?>
						<?php if (isset($validKey) && $noConnection) { echo "<span style='color:red;'><strong>Your Wordpress installation cannot connect to the Bitly API.  Please make sure you host allows 3rd party connections.</span><br>"; } ?>
						<input id="bitly_settings-oauthToken" name="bitly_settings[oauthToken]" type="text" 
							value="<?php echo bitly_settings( 'oauthToken' ); ?>" />
						<br />

						<span class="description"><?php printf( __( 'Enter your %s.', 'bitly' ), '<a href="https://bitly.com/a/wordpress_oauth_app" title="bitly OAuth Token" target="_blank">OAuth Token</a>' ); ?></span>
						<?php if(!bitly_settings( 'oauthToken' ) || bitly_settings( 'oauthToken' ) == '' || (isset($validKey) && !$validKey)){ ?>
							<p class="submit" style="clear: both;">
								<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Save' ); ?>" />
							</p>
						<?php } ?>
					</td>
				</tr>
				<?php if(bitly_settings( 'oauthToken' ) && bitly_settings( 'oauthToken' ) != '' && isset($validKey) && $validKey){ ?>
					<tr>
						<th><label for="bitly_settings-domain"><?php _e( 'Domain', 'bitly' ); ?></label></th>
						<td>
							<?php _e( 'Select a domain you would  like to use.', 'bitly' ); ?>
							<br />
							<select name="bitly_settings[domain]" id="bitly_settings-domain">
							
								<?php

									// anything non-custom?
									/*$domain = bitly_settings( 'domain' );
									if ( !in_array($domain, $default_domains) )
									{
										$default_domains[] = $domain;
									}
									
									// add this for our custom field
									if ( !in_array('Custom', $default_domains) )
										$default_domains[] = 'Custom';
										
										*/
										
									$custom_domain = $bitly->get_custom_domain();
									
									if ( strlen($custom_domain) > 0 && !in_array($custom_domain, $default_domains) )
									{
										$default_domains[] = $custom_domain;
									}

								?>

								<?php foreach ( $default_domains as $domain ) { ?>
									<option value="<?php echo $domain; ?>" <?php selected( $domain, bitly_settings( 'domain' ) ); ?>><?php echo $domain; ?></option>
								<?php } ?>
							</select>
							<!--<br />
							<span style="display: none;" id="bitly_settings-custom-domain"><input id="bitly_settings-custom_domain" name="bitly_settings[custom_domain]" type="text" value="<?php echo bitly_settings( 'custom_domain' ); ?>" /></span>-->
							<br />
							<span class="description"><?php printf( __( 'You can also use your own short domain with %s.', 'bitly' ), '<a href="https://bitly.com/a/settings/advanced" title="Custom Domain" target="_blank">Custom Domain Settings</a>' ); ?></span>
						</td>
					</tr>
					<tr><td>
						<p class="submit" style="clear: both;">
							<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
						</p><!-- .submit -->
					</td></tr>
				<?php } //end custom domain section ?> 
			</table>

			

		</form>

	</div> <!-- .wrap --> <?php
}

// Adds a Settings link to the admin page.
function bitly_service_action_link( $links, $file )
{
	if ( 'bitly/bitly.php' !== $file )
		return $links;

	$settings = '<a href="' . admin_url( 'options-general.php?page=bitly' ) . '">' . __( 'Settings', 'bitly' ) . '</a>';
	array_unshift( $links, $settings );
	return $links;
}

