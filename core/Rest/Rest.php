<?php
declare( strict_types = 1 );

namespace WooDrive\Rest;

/**
 * Handle all custom endpoints.
 */
class Rest {
    
    const REST_NAMESPACE = 'woodrive/v1';

	/**
	 * The constructor.
	 */
	public function __construct() {
		$this->rest_google = new Rest_Google();
	}
	
	/**
	 * Register rest routes.
	 *
	 * @return void
	 */
	public function register_rest_routes(): void {
		$this->register_google_routes();
	}
	
	/**
	 * Register Google rest routes.
	 *
	 * @return void
	 */
	public function register_google_routes(): void {
	    
	    register_rest_route( self::REST_NAMESPACE, '/google-verifcation/', array(
            'methods'	=> 'GET',
            'callback'	=> array( $this->rest_google, 'get_google_access_token' ),
        ) );
	}
}