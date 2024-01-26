<?php
declare( strict_types = 1 );

namespace WooDrive\Google_API;

use Google\Client;
use Google_Service;

/**
 * Handle Google API Helper methods.
 */
class Google_API_Helper {
    	
	/**
	 * Initialize new Google client
	 *
	 * @return object Google\Client
	 */
	public static function initialize_google_client(): object {
		
		$upload_dir = wp_upload_dir();
		$upload_dir = $upload_dir['basedir'] . '/'. \WooDrive\UPLOADS_DIR;

        $client_redirect_uri = get_site_url() . '/wp-json/woodrive/v1/google-verifcation';

        $client = new Client();
        $client->setAuthConfig( $upload_dir . '/.credentials.json' );
        $client->setRedirectUri( $client_redirect_uri );
        $client->addScope( 'https://www.googleapis.com/auth/drive' );

		if ( get_option( \WooDrive\ACCESS_TOKEN ) ) {

			$client->setAccessToken( get_option( \WooDrive\ACCESS_TOKEN ) );
		  
			if ( $client->isAccessTokenExpired() ) {
				delete_option( \WooDrive\ACCESS_TOKEN );
			}
		} 

        return $client;
	}

    /**
	 * Get Google Client access token
     * 
     * @param string $code code returned from the Google OAuth 2.0 
	 *
	 * @return array
	 */
	public static function get_google_client_token( $code ): array {
		
        $client = self::initialize_google_client();
        $token = $client->fetchAccessTokenWithAuthCode( $code );

        return $token;
	}

	/**
	 * Get Google Client authorization url
     * 
     * @param object $client instance of Google\Client
	 *
	 * @return string
	 */
	public static function get_google_client_authorization_url( $client ): string {
		
		$authorization_url = $client->createAuthUrl();

        return $authorization_url;
	}

	/**
	 * Insert Google Drive file permission
     * 
     * @param object $client instance of Google\Client
	 * @param string $file_id ID of the file to insert permission for.
     * @param string $type type of the permission :value 'user', 'group', 'domain' or 'default'
	 * @param string $role role of the user :value 'owner', 'writer' or 'reader'
     * @param string $email email of the user
	 *
	 * @return void
	 */
	public static function insert_file_permission( $client, $file_id, $type, $role, $email ): void {

		$drive = new \Google_Service_Drive( $client );
		$permission = new \Google_Service_Drive_Permission();
		$permission->setType( $type );
		$permission->setRole( $role );
		$permission->setEmailAddress( $email );
		
		if ( stristr( $email, '@gmail.com' ) !== false ) {
			$drive->permissions->create( $file_id, $permission, array( 'sendNotificationEmail' => true ) );	
		} else {
			$drive->permissions->create( $file_id, $permission );
		}
	}
	
	/**
	 * Get Google Drive file permission id for user 
	 *
	 * @param object $client instance of Google\Client
     * @param string $user_email email of user
     * @param string $file_id id of the file in Google Drive
     * 
	 * @return string
	 */
    public static function get_file_permission_id_for_user( $client, $user_email, $file_id  ): string {

		$drive = new \Google_Service_Drive( $client );
		$permission_id = '';

		$opt_params = array(
			'fields' => '*',
		);

		$permissions_list = $drive->permissions->listPermissions( $file_id, $opt_params );

		foreach ( $permissions_list->permissions as $permission ) {

			if ( $permission->emailAddress === $user_email ) {
				$permission_id = $permission->id;
				return $permission_id;
			}
		}

		return $permission_id;
    }

	/**
	 * Remove Google Drive file permission by permission id
	 *
	 * @param object $client instance of Google\Client
     * @param string $permission_id email of user
     * @param string $file_id id of the file in Google Drive
     * 
	 * @return void
	 */
    public static function remove_file_permission( $client, $permission_id, $file_id  ): void {

		$drive = new \Google_Service_Drive( $client );
		$drive->permissions->delete( $file_id, $permission_id );
    }	
}