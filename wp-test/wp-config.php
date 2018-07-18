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
define('DB_NAME', 'wp');

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

define('JWT_AUTH_SECRET_KEY', 'pO8XOnvchkpsF9oK2v67mg');
define('JWT_AUTH_CORS_ENABLE', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')rjh@4lgd]z|xcYv$(aP~zfgnG*GS$>b3ih1lzj`VSw7Q4?&0ep0?Ew!Z$Bq90%}');
define('SECURE_AUTH_KEY',  'r9]STvME.v_T442t_{=PQf|YZ.}Grc `=:9)F`uu%0*T n;A@4Z/X ZvoW}hBk6T');
define('LOGGED_IN_KEY',    '[LFGr$Hp$/Ffys{je.#NAU_.*9dsuAp}B?h7m_G[]JC22qk`%u`JM,AyGHcR*-#Z');
define('NONCE_KEY',        'C4YE0_ye8DPt#<L=`n_(yVd0rbF}!lmQv(kXQDTh)NHJ-$kcAfllx$|Eba[?t!&C');
define('AUTH_SALT',        '&q 3O`YhA~T(%S-p93y1WFJp}0yj+yoLP.$t&uQ<njgM)dK9x~]AS($l8xsoj*BC');
define('SECURE_AUTH_SALT', 'oC]fKFG<G5tQj?a+EvaOIUQ!u Dqx>}!iEYrvhyEUV1]<3a+m+0LN7G- .e9asin');
define('LOGGED_IN_SALT',   'v]0(+$ASde/wsM%m(+l`x0/Y+q5_)46k<>IX%v h ,oii,QxPMM/kTQ0BxFmu)ld');
define('NONCE_SALT',       'sHls^n@@!sbhU.8{w1rr^{U!!?@yxbzD:T1Q?/ZOIUNN/dCz1G*`zy1li*U*/M@4');

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
