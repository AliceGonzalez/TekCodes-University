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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u924819923_qDi7h' );

/** Database username */
define( 'DB_USER', 'u924819923_3qgmS' );

/** Database password */
define( 'DB_PASSWORD', 'qxY8xAThQr' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'b:d~>K>WaTA2*6Jn:vW-+488>0cwkV%?1I]Byi,K.x*HE4rLZzFs?AB;_5p]H1)>' );
define( 'SECURE_AUTH_KEY',   '%tzU 2Xsns3l=C*HQ%+xe oozJjsPL|XnXSk1|?og65$f98{.$>#z_m0:t%*qRII' );
define( 'LOGGED_IN_KEY',     'F_*jU.# 9u{G?j 3-E8?dGy~6]pHBOMw8.0F0^BYJR3_W4y83$pn5[7_01cqKz|9' );
define( 'NONCE_KEY',         'ULOi$*v!SbDRVzFn17DC(:Uu2z3IbolNlm3 cgI(erg:T[o(CjS&+a&Nc]pd8/ 2' );
define( 'AUTH_SALT',         'EMgAvX?vlJJI0XtPCg`aV]cmp2#/8{rr.=(yvIsQ7SD5m?5U--+i:%JT~|>mSSDd' );
define( 'SECURE_AUTH_SALT',  'P4=lL4:5M-yC&3a]>:@bY7uG]sJ521_3`K^@+}6({&bc619xmEv,yjl|N^@W}yxD' );
define( 'LOGGED_IN_SALT',    'avj-U0Le`T]#Ci4U?~*;!e<bJyYvP Gf8CQ**R8t-gjp@-y.&jcrHAq>G-O.Gk$(' );
define( 'NONCE_SALT',        'E,?jRF*ui%nc&DQ6H9R!RXkHy[q&[|8-cEQ}Ay=L_sQm.d?Z(8me[k0`.xt)p5(0' );
define( 'WP_CACHE_KEY_SALT', 'fq=0FO5/6D:p[rha+}.=ai[`RD}}l0F2@0X]A#i-X.i#jPA2@rggxhdFNuU!=BC}' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '672be5e474d15e4855f42fdd17219b6d' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
