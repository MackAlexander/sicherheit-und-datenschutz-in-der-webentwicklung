<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/database.php');

add_action('init',['THM\Security\Blocker', 'check_ip_adress'], 1, 0);


/**
 * IP Block module for the THM Security plugin.
 */
class Blocker
{
    public static function check_ip_adress()
    {
        if(Database::is_ip_blocked($_SERVER['REMOTE_ADDR']))
        {
            header("HTTP/1.1 404 Not Found");
            exit;
        }
    }

    public static function calculate_points($classification)
    {
        switch($classification)
        {
            case "config-grabber":
                return 5;
            case "wp-scan":
                return 10;
        }
    }
}