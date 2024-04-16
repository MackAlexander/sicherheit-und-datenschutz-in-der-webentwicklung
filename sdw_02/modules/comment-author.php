<?php

namespace THM\SDW02;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('wp_footer', ['THM\SDW02\Demo', 'wp_footer'], 10, 0);
add_filter('get_the_author_display_name', ['THM\SDW02\Demo', 'author_display_name'], 10, 3); 
add_action('admin_notices', ['THM\SDW02\Demo', 'admin_notices'], 10, 0);

class Demo
{
    /**
     * Add a text to the footer
     */
    public static function wp_footer()
    {
        echo '
            <p>
                <b>Diese Seite wurde in 123 ms gerendert, der maximale Speicherbedarf lag bei 123 MB.</b>
            </p>
        ';
    }


    /**
     * Change the display name of the author
     */
    public static function author_display_name($display_name, $user_id, $original_user_id)
    {
        if ($user_id === '1')
        {
            $display_name = 'nickel_mack';
        }
        return $display_name;
    }


    /**
     * Display a dismissable notice in the admin area (Original)
     */
    /*public static function admin_notices()
    {
        echo '
            <div class="notice notice-success is-dismissible">
                <p>
                    SDW: Demo-Plugin wurde erfolgreich geladen!
                </p>
            </div>
        ';
    }
    */


    public static function admin_notices()
    {
    ?>
    <div class="notice notice-success is-dismissible">
    <p><?php _e( 'Done!', 'https://github.com/MackAlexander/sicherheit-und-datenschutz-in-der-webentwicklung' ); ?></p>
    </div>
    <?php
    }
    add_action( 'admin_notices', 'sample_admin_notice__success' );


}

?>