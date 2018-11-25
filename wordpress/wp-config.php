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
define('DB_NAME', 'ieeeday18');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '12M[7a@SS)PeZ-8Aaoc9eK?lFGq16giAD>9>E6?iw]JG7?r[pX<:UQdQ#HDefHf4');
define('SECURE_AUTH_KEY',  'T!P+$U_-6:E{)3.%eqTZljXV>hkLvAG}.]Jkw,<p+YB(|`aIkm/[;D;%9wd_`w8X');
define('LOGGED_IN_KEY',    'o2 Z_1pnLjTqiWcAti.he[eC|J)PvsJ(nT6=T2#<S-jDAA#DUvycl3?My <CT%%v');
define('NONCE_KEY',        'BS7_@N:Wyp<dZ4~`#kzIvF.#&CqNmSWtU&jUgV<:>h  ab(]B#=beUfyxl(|nkl3');
define('AUTH_SALT',        'z`CBvOZ-ByzH42T_C+l~CCis/nnFT}9W(3_6k}+J-gYP{Ap<}fE/rI$tsuS:TX}n');
define('SECURE_AUTH_SALT', 'uG/|Z;TTS+5|x.|0&jO,Y~$h9hM?.Bh0TchK~tjL{y|+m~AO#)l6rGK#aofHwxb>');
define('LOGGED_IN_SALT',   'ln9x[g49KIL`<a)BhZ2X[Gzj[/iJ:*%nzpDOS_ireB/&8&&:MBXkSt>[xVAsS%+H');
define('NONCE_SALT',       ',:<iJsnqvRU(Jc3x}6;s_OEojuxcYp_npDWJ,>leijyS;ZJXt%xM}oeSPlm6PPY]');

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
