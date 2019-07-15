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
define( 'DB_NAME', 'mav_pizzascastillo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Rhy73455mk41g07l' );

/** MySQL hostname */
define( 'DB_HOST', '172.17.0.3' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'N/iMWsN<=;I(&{tpMUk2&fa-X|FAI{8c/# j*j qc:SiJ{Vebr90CNOQ]4E@&6OU' );
define( 'SECURE_AUTH_KEY',  'O6rB#8mV/i)7:jOF)8ThFf^|:_a2H9*V!><WXd7Bcb3)r]GOCe5:~1Fl$3<Q++p^' );
define( 'LOGGED_IN_KEY',    'B]r(5mRF=Kw@vqAW9rCF8xqz*h:LoD*h1+dR&,ox2r!<]5iJ.[hOcAl?(fu$f+~h' );
define( 'NONCE_KEY',        '_~$#sy<|/ m<*6/cka_*?L4e!:9iUino^WDALr*(kW#9 1O:X*QCd0Av*Gw(I))9' );
define( 'AUTH_SALT',        'U3Z<ND_a&Te:*J8IHnI#]uu|1.0.9@ f+)Lq);56-e*U/h0UpE_,L?IqemYN,[&_' );
define( 'SECURE_AUTH_SALT', 'oHoVw78H$dq7`|b}kjrQPLjR(pPA<+K0Ai*pd{C>PVSM^BC?4FPy~=zYygG4ZxDf' );
define( 'LOGGED_IN_SALT',   '[t!!wUO@-Yo/+?jnT,r[V7/9qC %A*X+IyKl/W?:,38uMcPSrO[lu M>6K9Sp[S)' );
define( 'NONCE_SALT',       '}e9`<QqEWS*>nUVP}qu^:SgAgkIyqEcBcE:tD@o5g,[M+c}V&+zZz u}/a95#I%N' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
