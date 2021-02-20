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
define( 'DB_NAME', 'reseller-plugin' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '^S6)l6>dF} v(oQXO$kNL:Py9j>sax]?>Q|K~>AgoJu 2);{w+GQ&|:=Y/=+ /T1' );
define( 'SECURE_AUTH_KEY',  'iV3KkATOiFAw%C[gSBG*<<;e=w@>OQ+dWUAfXkH9U;[anzey}B+l?a+anaFs[rZ>' );
define( 'LOGGED_IN_KEY',    '-8*}]<oVY2EwE^]piH:-Lj1N.hwK<lOzavF_vzULTIrk5IO(VSl7i7,Rj9OL{ESo' );
define( 'NONCE_KEY',        '#c~wYIrQKP],$kh)p+?a1$+/Z<I$$+Xev)CA+F oTv8!HZ^T0gZ+i$zAI//`mw`v' );
define( 'AUTH_SALT',        '{`!bOS{E0h{+r_dOwQc7 %)`uo/m9hVQ_!)#_<)HKG>fqNJ?7UM5eD#^gN;W%$zP' );
define( 'SECURE_AUTH_SALT', '&nVz0)7kztV=FM3sxXK.?HICbFp+ `a8:-c!FI)mmcnMTf@z?x10AA&4nMQy(y:%' );
define( 'LOGGED_IN_SALT',   'K+}m+Kt#~p{Y$tpA@i#y@|ClEC5J7L`d6cwn$OHl*N+sm=(g/^_(p @GUn52@=bE' );
define( 'NONCE_SALT',       '?f4=S3z>|9v0v4Lvu~x>QQB?_R]2!:}5Wl)wmE,|^@)c=cx$/]Tuh|GfaNMW(th]' );

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
