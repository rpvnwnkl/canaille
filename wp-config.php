<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/Applications/MAMP/htdocs/imcooltoo/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'imcooltoo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=K#cHgmG^$#!:vgkw!2?tRK$e<_F2.wq`0C=y<4EH)$A$Br}`s`YK2=eU-![i>~Y');
define('SECURE_AUTH_KEY',  'c<it^.hP+CFKo3#!ZqON;o);=[Z|Flob:|OXNE%gcN}_WA4T3(no-t~Iv:$nxO<z');
define('LOGGED_IN_KEY',    '`{DrIE1.{xhe?;h|]dkD&-u+on`^F!z)^J<1Dek`2IBS+J7O^RY?{Y|)MRzQ@wb#');
define('NONCE_KEY',        '68@Uw-Pyr967)*VGk|_rXdxq}B]RnW%H2t=Yb!<.B|_C^Ean$Ard;w*FWMV{,|8n');
define('AUTH_SALT',        '<*o?k]}a68AGK#iW1x]_~.CQFD3ee!)xk5^|]Z?e0pk;veX!;}<51,`dKS#5@^S2');
define('SECURE_AUTH_SALT', 'Qin@;P~7kPuHK#$#e/B |.!6Ujn(FASEo.KF(~@<x!6$)>M^DJ($oVd]8{J %k6)');
define('LOGGED_IN_SALT',   'c&3`SoqJ{5+e.B&8{An^`D .$g8D2:?d&|neB|JHj(D(Y7BJ_z9Mf4dvEKG t.LK');
define('NONCE_SALT',       '>oZT8BS*M2cd0H^$=k|k+]qk PHfFKQI5&N|g_5*0|idqja.{}ueOzGtD:dU+UZ>');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_GRfQy7_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
