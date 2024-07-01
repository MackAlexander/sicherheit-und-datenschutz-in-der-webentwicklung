<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/database.php');
require_once(dirname(__FILE__) . '/log.php');
require_once(dirname(__FILE__) . '/classifier.php');
require_once(dirname(__FILE__) . '/blocker.php');

add_action('shutdown', ['\THM\Security\RequestTracker', 'shutdown']);

/**
 * Bad request tracker module for the THM Security plugin.
 */
class RequestTracker
{
    private static $ban_duration = 7; //Ban duration in days

    /**
     * Checks if a request is suspicious.
     */
    public static function shutdown()
    {
        if(Database::is_ip_blocked($_SERVER['REMOTE_ADDR']))
        {
            return;
        }

        $classification = Classifier::classify_request();

        if($classification !== "normal") 
        {
            $points = Blocker::calculate_points($classification);
            Log::insert_log($_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_SERVER['HTTP_USER_AGENT'], http_response_code(), $classification, $points);

            if(Database::get_total_points($_SERVER['REMOTE_ADDR']) >= 50)
            {
                Database::ban_ip($_SERVER['REMOTE_ADDR'], self::$ban_duration);
            }
        }
    }
}