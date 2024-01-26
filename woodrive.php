<?php 
/**
 * @wordpress-plugin
 * Plugin Name:       WooDrive
 * Description:       Enhance your WooCommerce store's capabilities with GoogleDrive Sales for WooCommerce and provide a hassle-free shopping experience for your customers while boosting your digital product sales. Start selling effortlessly today!
 * Version: 		  1.0.0
 * Author:            iviyachki
 * Text Domain:       woodrive
 */

// Our namespace.
namespace WooDrive;

use WooDrive\Loader\Loader;
use WooDrive\Activator\Activator;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define root directory.
if ( ! defined( __NAMESPACE__ . '\DIR' ) ) {
	define( __NAMESPACE__ . '\DIR', __DIR__ );
}

// Define root directory.
if ( ! defined( __NAMESPACE__ . '\DIR_URL' ) ) {
	define( __NAMESPACE__ . '\DIR_URL', plugin_dir_url( __FILE__ ) );
}

// Define version constant.
if ( ! defined( __NAMESPACE__ . '\VERSION' ) ) {
	define( __NAMESPACE__ . '\VERSION', '1.0.0' );
}

// Define plugin uploads dir
if ( ! defined( __NAMESPACE__ . '\UPLOADS_DIR' ) ) {
	define( __NAMESPACE__ . '\UPLOADS_DIR', 'woodrive-uploads' );
}

// Define text domain
if ( ! defined( __NAMESPACE__ . '\TEXT_DOMAIN' ) ) {
	define( __NAMESPACE__ . '\TEXT_DOMAIN', 'woodrive' );
}

// Define wp-options for access token
if ( ! defined( __NAMESPACE__ . '\ACCESS_TOKEN' ) ) {
	define( __NAMESPACE__ . '\ACCESS_TOKEN', 'woodrive_access_token' );
}

require_once( \WooDrive\DIR . '/vendor/autoload.php' );

register_activation_hook( __FILE__, array( new Activator(), 'activate' ) );

// Initialize the loader.
global $woodrive_loader;

if ( ! isset( $woodrive_loader ) ) {
    // Create new instance of class Loader
	$woodrive_loader = new Loader();
}