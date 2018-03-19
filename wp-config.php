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
define('AUTH_KEY',         'fXSJ%.?:I@lP6la/hF=|eVc]Q,mU.].uOx--?+B|O|f[$LRj)(oj8{6u>1T1f7Nf');
define('SECURE_AUTH_KEY',  '=@=9)zdb2;=g(.cn!LSPHq@vAJ[w]/_Z3iC|<`Pe]XwF|;VTVjVjEv8/L|$*5 ~N');
define('LOGGED_IN_KEY',    'AV)`9ozPZa,p?-SkmPU=al.:v/fUAUawUA)xNE@T+Vp@n[A*JHr@_#=cB%mFEPtK');
define('NONCE_KEY',        ',MGf7]z{1Z2x*K2;wx^yNny2~XN{ZK^?=E#{+ ` 8plJmj_Ho9r$5cKY[Si^8fY8');
define('AUTH_SALT',        '>[9%3E5 ^G?c}7U-Lc^nW--V3J|q>}mBVW}z<SMAkvHFSd[]CZ6(X-PVzaS;KPs`');
define('SECURE_AUTH_SALT', 'ONa=4cxyC}LU(i(@1-,D;r:7BwZ%l#Hr+$&Ix_:0^$N;C9rWFct b(x_;9V>zVK1');
define('LOGGED_IN_SALT',   '2aHR3aAQxn&g QCJo(ATCN>a#[OBC|bpO1xMs!MBv-Xug^u7`ziRm]Q>cw+Rv{rZ');
define('NONCE_SALT',       '&r5Cl7Wcfg=`o6 U<zK~9+jbYgO1lftaFPL0:LvY6j8!CXx`y~aBN<%7iE3Pg|f2');

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
/* That's all, stop editing! Happy blogging. */

define('FS_METHOD', 'direct');

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
