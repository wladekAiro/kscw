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
define('DB_NAME', 'kisumu_county');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'toor');

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
define('AUTH_KEY',         ';jZn^Dnb|^`3zp|PNOEpZFv9!jSt)grT_[t d03Yn.vZp-9:=Z`nk,?I68eU_$=`');
define('SECURE_AUTH_KEY',  'S0pyzNc>kO@I`?~ltJs}oK0y-A6@1aV${5V?mdNlf~ST^{i$rN:w4W@Oqd5r Bf_');
define('LOGGED_IN_KEY',    'S}bO9j-)PZwH:G!E[z ;0;T#v.$&=V:9*[Aq(8M][kS`ITx^B{@/8S? TIS$nB?F');
define('NONCE_KEY',        'Fk_/]N6T.oo3;BT}IC5`DwWQ|WP/~xR5)uZfh V07]*u>+z VI=4 W7E?mqi]1$Y');
define('AUTH_SALT',        '#*ftX%w*tBr{9Y#z51H76<f7e0*|;`y-:EnR_3=2D#08sGKuH)c= Ks!*Jl?#uv;');
define('SECURE_AUTH_SALT', 'XL|NCT&pP{(Tch/:}Lm,T8Le$/>{{;|/0HW(~$fSmVp|Pt~i%1, M?@K/45qpuK@');
define('LOGGED_IN_SALT',   '@4P3l/(vu(aq4?),G.Gvl|1.yn!w<5zWJ_fu8]v;Q:u^V:Nwpb7m<4AOSXV08UIw');
define('NONCE_SALT',       'e?_ukMFT0E5Vlq8{qF RpvLS&,Ie9%SQ.zUE$f&Vyi*rA}k%pmej9z,|KRp[sj<K');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'kc_';

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

/**
 *
 *
 *Make plugins and themes installble directly on local host
 *
 */
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
