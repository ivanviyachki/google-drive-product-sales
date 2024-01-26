<?php
declare( strict_types = 1 );

namespace WooDrive\Admin;

/**
 * Settings Page class
 */
class Settings {
    
    /**
     * Register a custom menu page.
     * 
     * @return void
     */
    public function register_setting_page(): void {
        
        $menu_slug = 'woodrive-admin';
        
        add_menu_page(
    		__( 'WooDrive', \WooDrive\TEXT_DOMAIN ),
    		__( 'WooDrive', \WooDrive\TEXT_DOMAIN ),
    		'manage_options',
    		$menu_slug,
    		array( $this, 'load_admin_template' ),
    		'dashicons-privacy',
    		55
    	); 
    	
    	add_submenu_page( 
            $menu_slug, 
    	    __( 'WooCommerce Sell Google Drive Files Settings', \WooDrive\TEXT_DOMAIN ),
    	    __( 'Settings', \WooDrive\TEXT_DOMAIN ),
    	    'manage_options', 
    	    'woodrive-settings', 
    	    array( $this, 'load_settings_template' ) 
        );
    }

    /**
     * Register settings.
     * 
     * @return void
     */
    public function register_settings(): void {

        register_setting(
          'woodrive_settings_group',
          'woodrive_settings',
          array( $this, 'validate_settings' )
        );

        add_settings_section(
            'woodrive_settings_section',
            '',
            '',
            'woodrive-settings'
        );

        add_settings_field(
            'woodrive_api_credentials',
            __( 'Google API OAuth client ID Credentials' , \WooDrive\TEXT_DOMAIN ),
            array( $this, 'render_textarea_field' ),
            'woodrive-settings',
            'woodrive_settings_section',
        );


        add_settings_field(
            'woodrive_view_page',
            __( 'Select View Page' , \WooDrive\TEXT_DOMAIN ),
            array( $this, 'render_select_page' ),
            'woodrive-settings',
            'woodrive_settings_section',
        );
    }

    /**
     * Register settings.
     * 
     * @param array $input settings input.
     * 
     * @return array $output validated input.
     */
    public function validate_settings( $input ): array { 
        $output['woodrive_api_credentials'] = $input['woodrive_api_credentials'];
        $output['woodrive_view_page'] = absint( $input['woodrive_view_page'] );
        $this->create_credentials_file( $output['woodrive_api_credentials'] );
        return $output;
    }

    /**
     * Callback function for settings fields type text.
     * 
     * @param array $args settings.
     * 
     * @return void
     */
    public function render_textarea_field( $args ): void {
        $options = get_option( 'woodrive_settings' );

        printf(
            '<textarea cols="60" rows="7" name="%s" value="%s">%s</textarea>',
            esc_attr( 'woodrive_settings[woodrive_api_credentials]' ),
            esc_attr( $options['woodrive_api_credentials'] ),
            esc_attr( $options['woodrive_api_credentials'] )
        );
    }

    /**
     * Callback function for render select view page.
     * 
     * @param array $args settings.
     * 
     * @return void
     */
    public function render_select_page(): void {
        $options = get_option( 'woodrive_settings' );
        
        ?>
        <select name="woodrive_settings[woodrive_view_page]">
            <?php
            if( $pages = get_pages() ){
                foreach( $pages as $page ){
                    echo '<option value="' . $page->ID . '" ' . selected( $page->ID, $options['woodrive_view_page'] ) . '>' . $page->post_title . '</option>';
                }
            }
            ?>
        </select>
        <?php 
    }
    
    /**
     * Include options page template.
     * 
     * @return void
     */
    public function load_admin_template(): void {
       include( \WooDrive\DIR . '/templates/admin-page.php');
    }
    
    /**
     * Include options page template.
     * 
     * @return void
     */
    public function load_settings_template(): void {
        include( \WooDrive\DIR . '/templates/setting-page.php');
    }

    /**
     * Include product syncer page template.
     * 
     * @return void
     */
    public function load_product_syncer_template(): void {
        include( \WooDrive\DIR . '/templates/syncer-product-page.php');
    }

    public function create_credentials_file( $credentials ): void {
        $upload_dir = wp_upload_dir();

        $upload_dir = $upload_dir['basedir'] . '/'. \WooDrive\UPLOADS_DIR;

        if ( is_dir( $upload_dir ) ) {

            $file = fopen( $upload_dir . '/.credentials.json', 'w' );
            fwrite( $file, $credentials) ;
            fclose( $file );
        }
    }
}