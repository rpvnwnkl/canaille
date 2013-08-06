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
define('AUTH_KEY',         'Zpn]A}D-jMr*N+W^;H%XqLd8qT^NR1ga}!g%IxQO=j+p(_S?Ad2C-R~-S|Z`qK>I');
define('SECURE_AUTH_KEY',  '[n|!h9waIDPo;xQ}X$yoYSe[:r*6TRc8ExN%}7.H}<JLcJaVOOtOq8D4:fb+1]Ln');
define('LOGGED_IN_KEY',    '9O@c}yRh-:`e4NdbVX({2kU:n_<,7YLg.74(mqP<aLDep{a@5CY#o.o_Ml6q=n*W');
define('NONCE_KEY',        'MGxkz&9Mw`YO*A{=naUx0D%<5l==9L(UHS:&qsvXdVT}nMXdiEe-v$nRORHM~>G|');
define('AUTH_SALT',        '4Tl[moct-8i8N@?9r3(-N4D2 +pw5Y>!) 7?)7r#zm<{(}+Z;/z=m^@q[=TTeoiE');
define('SECURE_AUTH_SALT', 'ys/.;l^*h,)UnIl_G]nsEp9FMK8j5[X$o*c(62Q22rC7!i Ak-FW(Ij6n1A.sj6(');
define('LOGGED_IN_SALT',   'qXbH/r!|q3z/S8b#N|_;xo QK#-X@9_K@]?jF{^WtA,b#N H$Brm-y]wMPkH[d4@');
define('NONCE_SALT',       'wIi-Q`?_mQW%]GW-eS{eQ$N*- ?G-~|on{6TXz:`Es1x04Q@-{oR</mN~^2m M3i');


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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
