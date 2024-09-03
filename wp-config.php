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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'eastoriadbb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         '9G>qL4[MJOWh}2tpa^>hSr<H0+%<$}&h-h3efdiQ#zv{3s_gK{f}@+m?Z6:<}}(V' );
define( 'SECURE_AUTH_KEY',  'kk#`<QLYuQSRL+4niOgw_9-*R<?4%Yyre9P|t22^]2>F}krpswaEOka^%XdOXL +' );
define( 'LOGGED_IN_KEY',    'dkMBhTW=%vPx0AF:sjTkSMC!VpTw;_=+&jMP0v1;M z2P1y!I[yPh -w8^rTh>$;' );
define( 'NONCE_KEY',        ',~o$f<s3uw&~$HZx=s/>6){>dyc-k><hW/]S`k$qCsf/ru{4,fdKo&<(>hV7Z@j,' );
define( 'AUTH_SALT',        'bA[9L?6lG4Ud>fxbHD6%Q[iO[@dc%ZH_Z_h-Hxi+uLthD01[nl= t%KpF3!y}-(R' );
define( 'SECURE_AUTH_SALT', '4pb|AIX/xguaZ!JDtgT11bCfDH?/V-B[|~1=BT(tW]s(s9S}uN@62oG8^8nngodz' );
define( 'LOGGED_IN_SALT',   'ZNGt(0ow<M)Z]#=Ci)IS+$Ib&[Fjc|O7C3uQ#q/!|5?=T4HN>gIQR%p-tFaZ3gbi' );
define( 'NONCE_SALT',       '>a),=X:{S`0A8:O~9`{.7JX%)j|}|4d}3%*tbM2|SBio{yNl8z^c&.?^NT^rF{tF' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mt_';

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
define( 'WP_DEBUG', true );
// define( 'WPCF7_LOAD_JS', false );
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
