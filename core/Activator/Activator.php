<?php
declare( strict_types = 1 );

namespace WooDrive\Activator;

/**
 * Class handle methods execut on plugin activation.
 */
class Activator {
    	
	/**
	 * Run on plugin activation.
	 *
	 * @return void
	 */
	public function activate(): void {
        $this->create_upload_folder();
	}

    /**
	 * Create upload directory in uploads
	 *
	 * @return void
	 */
	public function create_upload_folder(): void {
        
    	$upload_dir = wp_upload_dir();

        $add_upload_dir = $upload_dir['basedir'] . '/'. \WooDrive\UPLOADS_DIR;
        
        if ( ! is_dir( $add_upload_dir ) ) {

            wp_mkdir_p( $add_upload_dir );
            chmod( $add_upload_dir, 0755 );    
        }
	}
}