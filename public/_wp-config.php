<?php /* BEGIN KINSTA STAGING ENVIRONMENT */ ?>
<?php if ( !defined('KINSTA_DEV_ENV') ) { define('KINSTA_DEV_ENV', true); /* Kinsta staging - don't remove this line */ } ?>
<?php if ( !defined('JETPACK_STAGING_MODE') ) { define('JETPACK_STAGING_MODE', true); /* Kinsta staging - don't remove this line */ } ?>
<?php /* END KINSTA STAGING ENVIRONMENT */ ?>
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'viviwater' );

/** MySQL database username */
define( 'DB_USER', 'viviwater' );

/** MySQL database password */
define( 'DB_PASSWORD', 'T64Juj8mulQoGB9' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '@z_(_4~fJ1,p{-AvB*}`&[+ps,ky!L#itJb#$gl1a;leejds_`KH&q4uS{6~v{]e' );
define( 'SECURE_AUTH_KEY',   '(gg%(DV|zFQM.-foh3lMgMi7$TG1QeK/*|>,,pWRENcU-::.t**~l{D/$thZT$JP' );
define( 'LOGGED_IN_KEY',     'u@8rkz^)#l/rL;|8nG)J-B%Wtgp$!,)CpzW~#ecg7.0m+.JJk`}afgne(2vtoDQj' );
define( 'NONCE_KEY',         ';uY!}@1=7FI`zD[,G8*zU,P$kN*T;-M})1iNVi,cpFo-g CQ_R=* bBx2er<by~n' );
define( 'AUTH_SALT',         '$OPF0tx6*.h/y+pph&t!^7c=2oK-;w^;F13{# WaMO &y(d-MFd4UI=d/q|4Un-=' );
define( 'SECURE_AUTH_SALT',  'gVa.kwqV#?f{n)3wvBKJ<DtY;T>/~CcW^gNm=t4tMN2P3=MY:![O;%uxW?9dr5vb' );
define( 'LOGGED_IN_SALT',    'XfVsJUP%PoCYLz#!Lu@%^8OMIt;!p![3]AO9|)Hle>[jD?:EnB9l(M~w;yFG?kxq' );
define( 'NONCE_SALT',        'jbN`BFX1P>@u@+kNB4[)%6O| _8DCriKSC046$#}Mq$$:+~o@TjZ{[}Sii% IyzZ' );
define( 'WP_CACHE_KEY_SALT', 't6U)B#H@Zih7+?bKg3$g?W2o,cADFU+ouF.}VvhL$gC6DVy(x#<(Rq*f$p.yF]y:' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
