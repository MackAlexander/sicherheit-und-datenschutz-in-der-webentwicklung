<?php

namespace THM\Own;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('wp_footer', ['THM\Own\Demo', 'wp_footer'], 10, 0);
add_action('admin_notices', ['THM\Own\Demo', 'admin_notices'], 10, 0);

class Demo
{
    /**
     * Add a text to the footer
     */
    public static function wp_footer()
    {
        echo '
            <p>
                Diese Seite wurde in 123 ms gerendert, der maximale Speicherbedarf lag bei 123 MB.
            </p>
        ';
    }

    /**
     * Display a dismissable notice in the admin area
     */
    public static function admin_notices()
    {
        echo '
            <div class="notice notice-success is-dismissible">
                <p>
                    SDW: Eigenes-Plugin wurde erfolgreich geladen!
                </p>
            </div>
        ';
    }
}

?>