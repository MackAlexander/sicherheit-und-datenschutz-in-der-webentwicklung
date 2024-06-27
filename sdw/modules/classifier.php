<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Classifier module for the THM Security plugin.
 */
class Classifier
{
    public static function classify_request()
    {
        $request_class = 'normal';

        if (preg_match('/\/wp-config.php/i', $_SERVER['REQUEST_URI']))
        {
            $request_class = 'config-grabber';
        }

        return $request_class;
    }
}