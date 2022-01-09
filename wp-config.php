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
define( 'DB_NAME', 'wp_recruitment_task' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'qm%Y!9Q+}p<dk%xef:OO_f3Aoc}nQ#5grwLiQv6/Eg0_jR?aVmqBE`4!>h_5AJdH' );
define( 'SECURE_AUTH_KEY',  '2!krOV Wiz&5ujiKC%CiAY/]:c#B47t[b.2A,B7HvI_GVb76-#SU.I%R5=*H~-S5' );
define( 'LOGGED_IN_KEY',    'VA$`.>S&XDp(c|lCiqAIb7C,&CwfWx|Dp^Kk~9j^,[. PdKTl^/*hE0Kn3xh$Mo!' );
define( 'NONCE_KEY',        '-Y^:tah!jCNmK+>OE[41}uidK31cw?5RhMuEpvFU}=BPyGgjB_6PwQC}IZY@{Q5z' );
define( 'AUTH_SALT',        'I<]3`:Mf1@E>6edUh/YoN1b0Lk&|E^Vm51HOC_(z}x^@/uzv~Xtjm@_!7wf?uU!Z' );
define( 'SECURE_AUTH_SALT', 'WdfbaF5& #hK:}O 8BNum@J5s>=C?[|?VE*98,Cr{tH6Qx0dj)g@U.Wl[~Fkpv2)' );
define( 'LOGGED_IN_SALT',   '%Zt7wmnUa;HvZ]4z>(Zxv~=C5N@^~FwbKan}a]|XFl@Ojct[tlZ0D&}yjAVhs0$T' );
define( 'NONCE_SALT',       'Tk+3@Yd||uW`$Qj;73_mqu=_< K&p~rX20!Ou`o{:F1-;S9koCxK4ObAslm@89[Z' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wprt_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
