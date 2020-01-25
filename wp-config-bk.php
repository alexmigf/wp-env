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

/** Require Autoloader */
require_once __DIR__.'/vendor/autoload.php';

/** Symfony Dotenv dependencie */
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__,1).'/.env');

/**
 * Configure MySQL Settings
 */
/** Configure Database */
if($_ENV['WP_ENV']) {
    /** The name of the database for WordPress */
    define( 'DB_NAME', $_ENV[strtoupper($_ENV['WP_ENV']).'_DB_NAME'] );

    /** MySQL database username */
    define( 'DB_USER', $_ENV[strtoupper($_ENV['WP_ENV']).'_DB_USER'] );

    /** MySQL database password */
    define( 'DB_PASSWORD', $_ENV[strtoupper($_ENV['WP_ENV']).'_DB_PASSWORD'] );

    /** MySQL hostname */
    define( 'DB_HOST', $_ENV[strtoupper($_ENV['WP_ENV']).'_DB_HOST'] );

    /** Database Charset to use in creating database tables. */
    define( 'DB_CHARSET', $_ENV[strtoupper($_ENV['WP_ENV']).'_DB_CHARSET'] );

    /** The Database Collate type. Don't change this if in doubt. */
    define( 'DB_COLLATE', '' );

    /** The database table prefix */
    $table_prefix = $_ENV[strtoupper($_ENV['WP_ENV']).'_DB_PREFIX'];
}

/**
 * Don't allow any other write method than direct
 */
define( 'FS_METHOD', 'direct' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         $_ENV['AUTH_KEY'] );
define( 'SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY'] );
define( 'LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY'] );
define( 'NONCE_KEY',        $_ENV['NONCE_KEY'] );
define( 'AUTH_SALT',        $_ENV['AUTH_SALT'] );
define( 'SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] );
define( 'LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT'] );
define( 'NONCE_SALT',       $_ENV['NONCE_SALT'] );

/**#@-*/

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

/**
 * Custom Settings
 */
define('AUTOMATIC_UPDATER_DISABLED', true); /* automatic updates are handled by wordpress-palvelu */
define('DISALLOW_FILE_EDIT', true); /* this disables the theme/plugin file editor */

/**
 * Only keep the last 5 revisions of a post. Having hundreds of revisions of
 * each post might cause sites to slow down, sometimes significantly due to a
 * massive, and usually unecessary bloating the wp_posts and wp_postmeta tables.
 */
define( 'WP_POST_REVISIONS', 5 );

/**
 * Changing the Site URL
 */
if( $_ENV['WP_ENV'] && $_ENV[strtoupper($_ENV['WP_ENV']).'_WP_SITEURL'] ) {
    define( 'WP_HOME', $_ENV[strtoupper($_ENV['WP_ENV']).'_WP_HOME'] );
    define( 'WP_SITEURL', $_ENV[strtoupper($_ENV['WP_ENV']).'_WP_SITEURL'] );
}

/**
 * For developers: show verbose debugging output if not in production.
 */
if ( 'prod' === $_ENV['WP_ENV'] ) {
  define('WP_DEBUG', false);
  define('WP_DEBUG_DISPLAY', false);
  define('SCRIPT_DEBUG', false);
} else {
  define('WP_DEBUG', true);
  define('WP_DEBUG_DISPLAY', true);
  define('SCRIPT_DEBUG', true);

  // Disable wp-content/object-cache.php from being active during development
  define('WP_REDIS_DISABLED', true);
}

/**
 * Log error data but don't show it in the frontend.
 */
ini_set('log_errors', 'On');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
