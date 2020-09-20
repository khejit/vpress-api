<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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
define( 'DB_NAME', 'blog-api' );

/** MySQL database username */
define( 'DB_USER', 'blog-api' );

/** MySQL database password */
define( 'DB_PASSWORD', 'blog-api' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'R7;jq8CB.,d#5zU0mp6YE:?pS&Nxm[}(K`oY^! T i2QY601F8d)t2z3+n{@3<?V' );
define( 'SECURE_AUTH_KEY',  'tPP)(_P!I>=W=##!A/Fboq(kY ,xq`J^?Gl[)v,x}KJ^pM9NP8=^OQA2FdiX%Hao' );
define( 'LOGGED_IN_KEY',    'c|~5L=u<ik-GM;9Cc[uXEwL/aGR7ijPvh*;s^mP(Sr1%f!@9Q3*Ktxbm9`SOmk5Q' );
define( 'NONCE_KEY',        '>:;|WAER$av^U@n~ 14jV?X~itV7TA!g`l_2NW%+^p`X:D{)z*QyUuT+8ihGAaC$' );
define( 'AUTH_SALT',        ' 80*0<aeR:bn/h<w*+Z2^CyOeHEqZ@G&mj:6mY_Vk&uyD-678fc87pk94|9E(5!G' );
define( 'SECURE_AUTH_SALT', 'z}qJDJ U( %4r.VAMu`GPD?I[y6`d^EO#ZOKtswJG%DQ)nKoT(`G StC>_%L43{L' );
define( 'LOGGED_IN_SALT',   '*K?3ddWb`K[=YlWE3liCtSZ5dt,bxQLk.]IU.teLE^0!]Y:zh<?re9duh5=eA8DA' );
define( 'NONCE_SALT',       'Fc(.iW&q4gH03Ug`nwjHYDm(dVL)aB8kVlr$Ct~;^OG8JqwFS|%R,0`cFt{:BMZK' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
