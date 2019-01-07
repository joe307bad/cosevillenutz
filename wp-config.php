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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cn');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Reaper307');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'FYE`y<v#;[,qlo,Y!-_x}pk{DxK01o6}Fw{>8~:C1;5CdI4?bxrcfEtek`}!tS(Z');
define('SECURE_AUTH_KEY',  'SH{`i,k8&kIm5E#d{t=**ue|PKHpGGxB:~cHvDKiK[llEZ|EO&oE@:4{TFLi)]/C');
define('LOGGED_IN_KEY',    '2.B9pHvjSibCtg]H gID7*yKg=Rfsv03x[[u@]s=~I{$5DCKJde3CY2iWch+Xe+k');
define('NONCE_KEY',        'l>C|b@j.jjPVeSL~}PQM*^j*,&U#Ic?j47eD=TWIa_V0KXQifr?7GJ=[DLyy/eIj');
define('AUTH_SALT',        '7BT4JqjoJG5PV6M!7*G2cAZ.S3L86tEs),hk;]P,?ntFf}z,0_f)0u&HHwu3o%Wu');
define('SECURE_AUTH_SALT', '/r:)3Q],?CUC75}][Y)KmVgVwbLli-j[>G1W8sQm5W~;dWz/<g}wn.fW;l4Ou%s4');
define('LOGGED_IN_SALT',   'muH+,_w@=Eo$Sy?I(D?+~0*Wyh?AJLi)@Np=3Yje_9l$AsUgU2pczBW[reH*#mVp');
define('NONCE_SALT',       '&y:(Re(0Jc7vq=FS`%;Y$Bcz^~T@ZL?s54CY_HaA0DKXu:.QAJo|3^myl3[RHo6?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
