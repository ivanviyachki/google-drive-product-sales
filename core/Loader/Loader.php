<?php
declare( strict_types = 1 );

namespace WooDrive\Loader;

use WooDrive;

/**
 * Loader class
 */
class Loader {
    
    /**
	 * Array with dependencies.
	 *
	 * @var array
	 */
	private $dependencies = array(
		'admin'         			=> 'WooDrive\Admin\Admin',
		'settings_page' 			=> 'WooDrive\Admin\Settings',
		'woocommerce'				=> 'WooDrive\WooCommerce\WooCommerce',
		'shortcode'					=> 'WooDrive\Shortcode\Shortcode',
		'rest'          			=> 'WooDrive\Rest\Rest',
	);

    /**
	 * The constructor.
	 */
    public function __construct() {
        
        $this->load_dependencies();    
        $this->add_admin_hooks();
		$this->add_woocommerce_hooks();
		$this->add_shortcode_hooks();
		$this->add_rest_hooks();
    }
    
    /**
	 * Load the main plugin dependencies.
	 *
	 * @return void
	 */
	private function load_dependencies(): void {
	    
		foreach ( $this->dependencies as $slug => $class ) {
		    $this->$slug = new $class;
		}
	}

    /**
	 * Add admin hooks.
	 *
	 * @return void
	 */
    public function add_admin_hooks(): void {
        add_action( 'admin_init', array( $this->settings_page, 'register_settings' ) );
        add_action( 'admin_menu', array( $this->settings_page, 'register_setting_page' ) );
    }
    
	/**
	 * Add WooCommerce hooks.
	 *
	 * @return void
	 */
    public function add_woocommerce_hooks(): void {
        add_action( 'woocommerce_order_status_completed', array( $this->woocommerce, 'add_file_permissions' ) );
		add_action( 'woocommerce_order_status_changed', array( $this->woocommerce, 'remove_file_access' ), 10, 3 );
		add_action( 'woocommerce_product_options_general_product_data', array( $this->woocommerce, 'add_product_custom_fields' ) );
		add_action( 'woocommerce_process_product_meta', array( $this->woocommerce, 'save_product_custom_fields' ) );
		add_action( 'woocommerce_product_after_variable_attributes', array( $this->woocommerce, 'add_variation_custom_fields' ), 10, 3 );
		add_action( 'woocommerce_save_product_variation', array( $this->woocommerce, 'save_variation_custom_fields' ), 10, 2 );
    }

	/**
	 * Add shortcode hooks.
	 *
	 * @return void
	 */
    public function add_shortcode_hooks(): void {
		add_shortcode( 'courses', array( $this->shortcode, 'user_courses' ) );
		add_shortcode( 'view-course', array( $this->shortcode, 'view_course' ) );
    }

	/**
	 * Add rest hooks.
	 *
	 * @return void
	 */
    public function add_rest_hooks(): void {
        add_action( 'rest_api_init', array( $this->rest, 'register_rest_routes' ) );
    }
}