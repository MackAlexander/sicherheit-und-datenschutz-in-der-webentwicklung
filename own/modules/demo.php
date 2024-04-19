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
        global $start_time;
        $memory_size = memory_get_usage();

        echo '
            <p>
                Diese Seite wurde in' .(microtime(true) - $start_time ). 'gerendert, der maximale Speicherbedarf lag bei '. $memory_size .' MB.
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