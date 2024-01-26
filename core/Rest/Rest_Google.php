<?php
declare( strict_types = 1 );

namespace WooDrive\Rest;

use WooDrive\Google_API\Google_API_Helper;
/**
 * Handle all custom endpoints.
 */
class Rest_Google {
    	
	/**
	 * Register rest routes for Google.
	 *
	 * @return void
	 */
	public function get_google_access_token(): void {

		if ( isset( $_GET['code'] ) ) {

			$site_redirect_uri = admin_url( 'admin.php?page=woodrive-admin' );

			$token = Google_API_Helper::get_google_client_token( $_GET['code'] );
		
			// save access token in wp-options
			update_option( \WooDrive\ACCESS_TOKEN, $token );
		
			// redirect back to the Admin page
			header( 'Location: ' . filter_var( $site_redirect_uri, FILTER_SANITIZE_URL ) );
		}
	}
}