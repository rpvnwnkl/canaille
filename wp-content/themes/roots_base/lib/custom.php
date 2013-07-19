<?php

function new_wp_trim_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = strip_shortcodes( $text );

		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$text = strip_tags($text, '<a>');
		$excerpt_length = apply_filters('excerpt_length', 40);

		$excerpt_more = apply_filters('excerpt_more', ' ' . '[......]');
		$words = preg_split('/(<a.*?a>,)|(<a.*?a>)|(<a.*?a>.)|\n|\r|\t|\s/', $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE );
		
		
			if ( count($words) > $excerpt_length ) {
				array_pop($words);
				$text = implode(' ', $words);
				$text = $text . $excerpt_more;
				}
			 
		
		else {
			$text = implode(' ', $words);
		}
	}
	return apply_filters('new_wp_trim_excerpt', $text, $raw_excerpt);

}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'new_wp_trim_excerpt');

function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">.....Keep on reading........</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
