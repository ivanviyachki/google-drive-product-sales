<?php
declare( strict_types = 1 );

namespace WooDrive\WooCommerce;

/**
 * Handle WooCommerce hooks methods.
 */
class WooCommerce {
    
    /**
	 * Add Google Drive file permissions
	 *
     * @param int $order_id id of the order
     * 
	 * @return void
	 */
    public function add_file_permissions( $order_id ): void {

        $order = new \WC_Order( $order_id );

        //Order user email
        $user = $order->get_user();
        $user_email = $user->user_email;

        //Order items
        $items = $order->get_items();

        // Array with Google Drive file ids
        $file_ids = array();
        $file_access_products = get_user_meta( $user->ID, 'woodrive_file_access_products', true );
        
        $book_product_ids = array();

        foreach ( $items as $order_item_id => $item ) {

            $product_id = $item->get_product_id();
            $variation_id = $item->get_variation_id();

            if ( $variation_id > 0 ) {
                $woodrive_google_drive_file_ids = get_post_meta( $variation_id, 'woodrive_google_drive_file_ids', true );
                $current_id = $variation_id;
            } else {
                $woodrive_google_drive_file_ids = get_post_meta( $product_id, 'woodrive_google_drive_file_ids', true );
                $current_id = $product_id;
            }

            if ( ! empty( $woodrive_google_drive_file_ids ) && ! has_term( 'knigi', 'product_cat', $product_id ) ) {

                $woodrive_google_drive_file_ids = str_replace( ' ', '', $woodrive_google_drive_file_ids );
                $google_drive_file_ids = explode ( ',', $woodrive_google_drive_file_ids ); 

                foreach( $google_drive_file_ids as $google_drive_file_id ) {
                    array_push( $file_ids, $google_drive_file_id );
                }
            }
            
            if ( has_term( 'knigi', 'product_cat', $product_id ) ) {
                
                if ( $variation_id > 0 ) {
                    array_push( $book_product_ids, $variation_id );
                } else {
                    array_push( $book_product_ids, $product_id );
                }
            }
        }

        if ( count( $file_ids ) != 0 ) {

            if ( ! empty( $file_access_products ) ) {
                $file_access_products = array_merge( $file_access_products, $file_ids );
            } else {
                $file_access_products = $file_ids;
            }

            update_user_meta( $user->ID, 'woodrive_file_access_products', $file_access_products );
        }
    }

    /**
	 * Add WooCommerce product custom fields
	 *
	 * @return void
	 */
    public function add_product_custom_fields(): void {

        echo '<div class="google_drive_files">';

        //Custom Fields for Google Drive Files
        woocommerce_wp_textarea_input(
            array(
                'id'            => 'woodrive_google_drive_file_ids',
                'placeholder'   => __( 'Google Drive File IDs', \WooDrive\TEXT_DOMAIN ),
                'label'         => __( 'Google Drive File IDs ', \WooDrive\TEXT_DOMAIN ),
                'desc_tip'      => true,
                'value'         => get_post_meta( get_the_ID(), 'WooDrive_google_drive_file_ids', true ),
                'description'   => __( 'Add Google Drive File IDs sprated by comma ( , )', \WooDrive\TEXT_DOMAIN )
            )
        );

        echo '</div>';

        echo '<div class="access_time">';

        echo '</div>';
    }

    /**
	 * Save WooCommerce product custom fields
     *
     * @param int $post_id id of the product
	 *
	 * @return void
	 */
    function save_product_custom_fields( $post_id ): void {

        $woodrive_google_drive_file_ids = $_POST['woodrive_google_drive_file_ids'];
        $woodrive_access_time_dayse = $_POST['woodrive_access_time_dayse'];

        if ( ! empty( $woodrive_google_drive_file_ids ) ) {
            update_post_meta( $post_id, 'woodrive_google_drive_file_ids', esc_html( $woodrive_google_drive_file_ids ) );
        }

        if ( ! empty( $woodrive_access_time_dayse ) && is_numeric( $woodrive_access_time_dayse ) ) {
            update_post_meta( $post_id, 'woodrive_access_time_dayse', esc_html( $woodrive_access_time_dayse ) );
        }
    }

    /**
	 * Add WooCommerce variation product custom fields
	 *
     * @param int $loop number of variation
     * @param array $variation_data data of variation
     * @param object WP_Post $variation  object of the variation
     * 
	 * @return void
	 */
    public function add_variation_custom_fields( $loop, $variation_data, $variation ): void {

        echo '<div class="google_drive_files">';

        //Custom Fields for Google Drive Files
        woocommerce_wp_text_input(
            array(
                'id'            => "woodrive_google_drive_file_ids{$loop}",
                'name'          => "WooDrive_google_drive_file_ids[{$loop}]",
                'placeholder'   => __( 'Google Drive File IDs', \WooDrive\TEXT_DOMAIN ),
                'label'         => __( 'Google Drive File IDs', \WooDrive\TEXT_DOMAIN ),
                'value'         => get_post_meta( $variation->ID, 'woodrive_google_drive_file_ids', true ),
                'desc_tip'      => true,
                'description'   => __( 'Add Google Drive File IDs sprated by comma ( , )', \WooDrive\TEXT_DOMAIN ),
                'wrapper_class' => 'form-row form-row-full',
            )
        );

        echo '</div>';

        echo '<div class="access_time">';

        echo '</div>';
    }

    /**
	 * Save WooCommerce variation product custom fields
     *
     * @param int $variation_id id of the variation
     * @param int $loop number of variation
	 *
	 * @return void
	 */
    public function save_variation_custom_fields( $variation_id, $loop ): void {

        $woodrive_google_drive_file_ids = $_POST['woodrive_google_drive_file_ids'][$loop];
        $woodrive_access_time_dayse = $_POST['woodrive_access_time_dayse'][$loop];

        if ( ! empty( $woodrive_google_drive_file_ids ) ) {
            update_post_meta( $variation_id, 'woodrive_google_drive_file_ids', esc_html( $woodrive_google_drive_file_ids ) );
        }

        if ( ! empty( $woodrive_access_time_dayse ) && is_numeric( $woodrive_access_time_dayse ) ) {
            update_post_meta( $variation_id, 'woodrive_access_time_dayse', esc_html( $woodrive_access_time_dayse ) );
        }
    }

    /**
	 * Remove file access for order
     * 
     * @param int $order_id id of the order
     * @param string $old_status old status of the order
     * @param string $new_status new status of the order
	 *
	 * @return void
	 */
    public function remove_file_access( $order_id, $old_status, $new_status ): void {

        if ( $old_status === 'completed' ) {

            $order = new \WC_Order( $order_id );

            //Order user email
            $user = $order->get_user();
            $user_email = $user->user_email;

            //Order items
            $items = $order->get_items();

            $file_access_products = get_user_meta( $user->ID, 'woodrive_file_access_products', true );
            
            foreach ( $items as $item ) {

                $product_id = $item->get_product_id();
                $variation_id = $item->get_variation_id();
    
                if ( $variation_id > 0 ) {
                    $woodrive_google_drive_file_ids = get_post_meta( $variation_id, 'woodrive_google_drive_file_ids', true );
                } else {
                    $woodrive_google_drive_file_ids = get_post_meta( $product_id, 'woodrive_google_drive_file_ids', true );
                }
    
                if ( ! empty( $woodrive_google_drive_file_ids ) ) {
                        
                    $woodrive_google_drive_file_ids = str_replace(' ', '', $woodrive_google_drive_file_ids);
                    $google_drive_file_ids = explode ( ',', $woodrive_google_drive_file_ids ); 

                    foreach( $google_drive_file_ids as $google_drive_file_id ) {

                        if ( ! empty( $file_access_products ) ) {      

                            if ( ( $key = array_search( $google_drive_file_id, $file_access_products ) ) !== false ) {
                                unset( $file_access_products[$key] );
                            }
                        }
                    }
                }
                
            }
            
            update_user_meta( $user->ID, 'woodrive_file_access_products', $file_access_products );
        }
    }
}