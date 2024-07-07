<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/database.php');
require_once(dirname(__FILE__) . '/classifier.php');
require_once(dirname(__FILE__) . '/config.php');

add_action('init',['THM\Security\RequestTracker', 'check_ip_adress'], 1, 0);
add_action('shutdown', ['\THM\Security\RequestTracker', 'shutdown']);
add_action('wp_login_failed', ['\THM\Security\RequestTracker', 'wp_login_failed'], 10, 2);

/**
 * Bad request tracker module for the THM Security plugin.
 */
class RequestTracker
{
    public static function check_ip_adress()
    {
        if(Database::is_ip_blocked($_SERVER['REMOTE_ADDR']))
        {
            header("HTTP/1.1 404 Not Found");
            exit;
        }
    }

    public static function wp_login_failed($username, $error)
    {
        $classification = "failed-login";
        $points = Classifier::calculate_points($classification);
        Database::append_access_log($_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_URI'], $_SERVER['HTTP_USER_AGENT'], http_response_code(), $classification, $points);

        if(Database::get_total_points($_SERVER['REMOTE_ADDR']) >= Config::MAX_POINTS)
        {
            Database::ban_ip($_SERVER['REMOTE_ADDR'], Config::BAN_DURATION);
        }
    }

    /**
     * Checks if a request is suspicious.
     */
    public static function shutdown()
    {
        if(Database::is_ip_blocked($_SERVER['REMOTE_ADDR']))
        {
            return;
        }

        $uri = $_SERVER['REQUEST_URI'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $status_code = http_response_code();

        $classification = Classifier::classify_request($uri, $user_agent, $status_code);

        if($classification !== "normal") 
        {
            $points = Classifier::calculate_points($classification);
            Database::append_access_log($_SERVER['REMOTE_ADDR'], $uri, $user_agent, $status_code, $classification, $points);

            if(Database::get_total_points($_SERVER['REMOTE_ADDR']) >= Config::MAX_POINTS)
            {
                Database::ban_ip($_SERVER['REMOTE_ADDR'], Config::BAN_DURATION);
            }

            header("HTTP/1.1 404 Not Found");
            exit;
        }
    }
}