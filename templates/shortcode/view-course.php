<?php 

use Google\Client;
use Google\Service\Drive;

function downloadFile() {
  $client = new Client();
  $client->setAccessToken( get_option( \WooDrive\ACCESS_TOKEN ) );
  $client->addScope(Drive::DRIVE);
  $driveService = new Drive($client);
  $realFileId = readline("Enter File Id: ");
  $fileId = $_GET["file_id"];
  $upload_dir = wp_upload_dir();
  $upload_dir_url = $upload_dir['baseurl'] . '/'. \WooDrive\VIDEOS_DIR;
  $upload_dir_path = $upload_dir['basedir'] . '/'. \WooDrive\VIDEOS_DIR;
  $file_path =  $upload_dir_path . "/" . $fileId . ".mp4";
  $file_url = $upload_dir_url . "/" . $fileId . ".mp4";
  if ( ! file_exists( $file_path ) ) {

    $file = $driveService->files->get($fileId);
    $fileName = $file->getName();

    // Download a file.
    $content = $driveService->files->get($fileId, array("alt" => "media"));
    $handle = fopen("$file_path", "w+"); // Modified

    while (!$content->getBody()->eof()) { // Modified
        fwrite($handle, $content->getBody()->read(1024)); // Modified
    }

    fclose($handle);

  }
}


if ( ! empty( $file_id ) ) {

  $args = array (
    'post_type'             => array( 'product', 'product_variation' ),
    'post_status'           => array('publish','private'),
    'fields'              	=> 'ids',
    'meta_query'          	=> array(
      array(
        'key'       => 'WooDrive_google_drive_file_ids',
        'value'     => $file_id,
        'compare'   => 'LIKE'
      ),
    ),
  );

  // The Query
  $product = new \WP_Query( $args );

  if ( ! empty( $product->posts ) ) {

    $files_data = get_post_meta( $product->posts[0], '_downloadable_files', true );

    foreach( $files_data as $file_data ) { 
    
      if ( strpos( $file_data['file'], 'folders' ) &&  strpos( $file_data['file'], $file_id ) ) {

        $upload_dir = wp_upload_dir();
        $upload_dir_url = $upload_dir['baseurl'] . '/'. \WooDrive\UPLOADS_DIR;
        $upload_dir_path = $upload_dir['basedir'] . '/'. \WooDrive\UPLOADS_DIR;
        $file_path =  $upload_dir_path . "/" . $file_id . ".html";
        $file_url = $upload_dir_url . "/" . $file_id . ".html";

        if ( ! file_exists( $file_path ) ) {
          exec( "wget -O " . $file_path . " https://drive.google.com/embeddedfolderview?id=" . $file_id . "#list" ); 
          sleep(0.1);
          exec( "sed -i 's#_blank#_self#g' " . $file_path ); 
          sleep(1);
          exec( "sed -i 's#view?usp=drive_web#preview#g' " . $file_path ); 
          sleep(0.1);
          exec( "sed -i 's#.mp4# #g' " . $file_path ); 
          sleep(0.1);
          exec( "cat /home/natxazsr/public_html/wp-content/plugins/woodrive-courses/templates/shortcode/appendix.php >>" . $file_path ); 
        }
        $time = time();

        //include('gotissue.php');

        echo '<iframe src="' . $file_url . '?time=' . $time . '&folderid=' . $file_id . '" style="width:100%; height:700px; border:0;"></iframe>';

        break;
      }  

      if ( ( strpos( $file_data['file'], 'file' ) || strpos( $file_data['file'], 'document' ) ) &&  strpos( $file_data['file'], $file_id ) ) {

        //include('gotissue.php');

        //echo '<iframe src="https://drive.google.com/file/d/' . $file_id . '/preview" width="100%" height="600"></iframe>';

        downloadFile();
        
        echo '

        <video id="v1" oncontextmenu="return false;" width="100%" height="600" controls controlsList="nodownload">
        	<source src="/wp-content/uploads/woodrive-videos/' . $file_id . '.mp4" type="video/mp4"></source>
        </video> 
        
        ';
        
        break;
      }

    }
  }

  wp_reset_query();
  wp_reset_postdata();
}
?>