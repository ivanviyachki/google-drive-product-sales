<?php

use WooDrive\Google_API\Google_API_Helper;

$client = Google_API_Helper::initialize_google_client();

if ( get_option( \WooDrive\ACCESS_TOKEN ) ) {

  $client->setAccessToken( get_option( \WooDrive\ACCESS_TOKEN ) );
  
  //hm
  //if ( $client->isAccessTokenExpired() ) {

    $refresh_token = $client->getRefreshToken();
    $_SESSION['access_token'] = $client->getAccessToken();
    $google_token= json_decode($_SESSION['access_token']);
    $client->refreshToken($google_token->refresh_token);
    $_SESSION['access_token']= $client->getAccessToken();
    update_option( \WooDrive\ACCESS_TOKEN, $_SESSION['access_token'] );
    
  //}
} else {
  $authorization_url = Google_API_Helper::get_google_client_authorization_url( $client );
}
?>

<div>
  <div class="wrap">
      <h1>
        <?php _e( 'WooCommerce Sell Google Drive Files', \WooDrive\TEXT_DOMAIN );?>
      </h1>
  </div>

  <div class="box">
  <?php if ( isset( $authorization_url ) ) : ?>
    <div class="request">
      <a class='login' href='<?php echo $authorization_url ?>'><?php _e( 'Connect Google Account' , \WooDrive\TEXT_DOMAIN );?></a>
    </div>
  <?php else : ?>
    <div class="request">
      <a class='remove' href='<?php echo 'asd' ?>'><?php _e( 'Disconnect Google Account' , \WooDrive\TEXT_DOMAIN );?></a>
    </div>
  <?php endif ?>
  </div>
</div>