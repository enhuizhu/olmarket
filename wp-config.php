<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'olmarket_new');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'olmarket.local');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'V]:#;%=|{V?<A%Xn$34RwDn;NHCF(x:M<JvM~q+90]D[osE=o7>FY9S@f-g>Zdr)');
define('SECURE_AUTH_KEY',  'Y^r[VZEpR-:#8|~:,u$* pTKr4K+*@%rAnN^>TSV-c*g sL(:dx@;(r|-ruCPAm6');
define('LOGGED_IN_KEY',    '2O]=;Z-1E2-qyIl>-Y&yxo`vCezX_b^-.Y,q@>nD$jG^wd76zdFxctK#OQGSO8xV');
define('NONCE_KEY',        '>ra$R-o$E)s-J )JP`0yY;YKBOd6fW72.l8W7fI[CKB//Njw*z,Oh*5|i`+1;G<n');
define('AUTH_SALT',        'BhLq^>]]d1}}[yoJwU&yzG1-(W,oCfD>yF-wP|C7j$|9io^hg0c$?M@-%Jc$C!FU');
define('SECURE_AUTH_SALT', '=-7@|Gm x 1bz`Eyv{D.}pqIg`OmdW~+yBrd2]JG;X7oY|T@?|v&UgvN?/d-g3P7');
define('LOGGED_IN_SALT',   '.JbBDyc?:80I2`phw%rTN&CV4)j6KxUWM|4F+O^Tm^Es+:~Q)zX!kY|-;P(V*O?^');
define('NONCE_SALT',       'Q7}Z1D*>r*OdWKK?v[U%HqS~1[e_B!Rio+XH2,l/0-hj622w&@LFqK2EuU%fAbI ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
