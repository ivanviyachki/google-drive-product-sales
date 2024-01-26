<?php
declare( strict_types = 1 );

namespace WooDrive\Shortcode;

use WooDrive;

/**
 * Handle WooCommerce hooks methods.
 */
class Shortcode {

    /**
	 * Shortcode [courses] method.
	 *
	 */
    public function user_courses(): void {
        
        if ( is_user_logged_in() ) {
            $rest_url = get_site_url() . '/wp-json/woodrive/v1/user-courses?user_id=' . get_current_user_id();

            wp_enqueue_script( 'data-table', \WooDrive\DIR_URL . '/assets/js/lib/dataTables.min.js', array('jquery') );
            wp_enqueue_script( 'user-courses', \WooDrive\DIR_URL . '/assets/js/user-courses.js', array('jquery'), '8.16.3', true );
            
            wp_localize_script( 'user-courses', 'restData', array( 'rest_url' => $rest_url ) );
               
            include( \WooDrive\DIR . '/templates/shortcode/user-courses.php' );
        }
    }

    /**
	 * Shortcode [view-course] method.
	 *
	 */
    public function view_course(): void {

        if ( isset( $_GET['file_id'] ) && is_user_logged_in() ) {

            $user_id = get_current_user_id();
            $file_id = $_GET['file_id'];

            $file_access_subscription = get_user_meta( $user_id, 'WooDrive_file_access_subscription', true );
            $file_access_products = get_user_meta( $user_id, 'WooDrive_file_access_products', true );

            $has_access = false;

            if ( ! empty( $file_access_subscription ) ) {
                if ( in_array( $file_id, $file_access_subscription ) ) {
                    $has_access = true;
                }
            }

            if ( ! empty( $file_access_products ) ) {
                if ( in_array( $file_id, $file_access_products ) ) {
                    $has_access = true;
                }
            }

            if ( $has_access ) {
                include( \WooDrive\DIR . '/templates/shortcode/view-course.php' );
            } else {
                wp_safe_redirect( get_home_url() );
                exit();
            }

        } else {
            wp_safe_redirect( get_home_url() );
            exit();
        }
    }
    

}