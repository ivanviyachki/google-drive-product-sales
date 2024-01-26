<?php 
//authtype must be replaced 
require_once( '/home/natxazsr/public_html/wp-load.php' );

use WooDrive\Google_API\Google_API_Helper;

$client = Google_API_Helper::initialize_google_client();

if ( get_option( 'woodrive_access_token' ) ) {
    
    $client->setAccessToken( get_option( 'woodrive_access_token' ) );
    $refresh_token = $client->getRefreshToken();
    $_SESSION['access_token'] = $client->getAccessToken();
    $google_token = $_SESSION['access_token'];
    $client->refreshToken($google_token->refresh_token);
    $_SESSION['access_token']= $client->getAccessToken();
    update_option( 'woodrive_access_token', $_SESSION['access_token'] );
    
}
?>