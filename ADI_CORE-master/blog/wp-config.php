<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'desampai_wp123' );

/** MySQL database username */
define( 'DB_USER', 'desampai_wp123' );

/** MySQL database password */
define( 'DB_PASSWORD', 'S3p14@[8j7' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'qgukihg43dimtfxzrpylq5gljyzsgabailowthd9icrr6t0knuruvshgwsyd5tc3' );
define( 'SECURE_AUTH_KEY',  'vbxlyhap9xjuuz1h5vjddqpb0jjkk5esvvy3qq4sl44lgmsgjp2sefv2pmdsooyx' );
define( 'LOGGED_IN_KEY',    'bngswl1qxlgqljgmwkd3z337krcgtg6aohgca5wgpftowoxkpv5kjpcf51qswu0x' );
define( 'NONCE_KEY',        'mfajmyn3rpp0dii0gdneeudfxu424o77y3biawdjp70j23b4epvjgk61bp4ok0hb' );
define( 'AUTH_SALT',        '4bklfdairqaht5yzlhct57riuvbfrbptyfl6bkmyzbxp0o6da5mfeothp7kdejqh' );
define( 'SECURE_AUTH_SALT', 'hvwnjxbzwojyirhyav5u95iccaishqtilx9fafm7iwdrgd4nql7rvok2qtexf8xa' );
define( 'LOGGED_IN_SALT',   'ugq3g9j0u9za518mikpena0sm8bpylcdfti7thin8jgqxuxafvo2yc8x7mfj6lfb' );
define( 'NONCE_SALT',       'ufabmztgisru31vbvmn0hlsmlkokwkcgyp8kx1h1sromsir6wtl5y432pexbjxzf' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpnb_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
