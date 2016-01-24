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
define('DB_NAME', 'all-construct.be');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ';Rx%cV/r,3nw{N$UQ|~l|BO|q.N@TOC[~D]9gzTBBSd_ %l],TmNv0nlrQ4jiN<d');
define('SECURE_AUTH_KEY',  'z!0AFk_J@%Y^,me0wct@q]=&2g0j7=b#[bGf-$c>O$A+S1+y-x(Bp}LO31wD-;{d');
define('LOGGED_IN_KEY',    '3/B>90TTK(B4}ML8-7y{zruz3-G[_j`s|blq0!3%9G<-:+wb>VK_2=J+f7o>m$hi');
define('NONCE_KEY',        '1gQp-:5>fpc7EhLU$Mre3Za!fSp9x{~oI]o=[`IW^1L#!bBwo~N-mypBv<2%.@GC');
define('AUTH_SALT',        'ysK1: HF80fC5Nf._+iBWTMeqoXSX]oGyq4;A_y-W_E-.i_f}Fp=Y^[m*/ZG_V6#');
define('SECURE_AUTH_SALT', '/KiJ-UD`/_=+yJU-:(,b)FCl_F|.=:LcG?R2phBuj|=,x<HU !(,76J1HwW_vw=&');
define('LOGGED_IN_SALT',   'uTCW_h~ce[kRmME+exPV)~z0{1aQkuGuA,1/Hbm9P_.RK;f[VBel-|}})En~u;cw');
define('NONCE_SALT',       's#9@$ O)(`Tk]#G}W3(eWoC tx-jK&SX-w~=I*Ye;}jc-#aP@cO~&e,J31-!]@eb');

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
