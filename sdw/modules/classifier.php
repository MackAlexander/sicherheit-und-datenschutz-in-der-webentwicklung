<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . '/suspicious_links.php');

/**
 * Classifier module for the THM Security plugin.
 */
class Classifier
{
    public static function classify_request($uri, $user_agent, $status_code)
    {
        $request_class = 'normal';

        if (preg_match('/\/xmlrpc.php/i', $uri))
        {
            return $request_class = 'xmlrpc';
        }
        if (preg_match('/.sql/i', $uri))
        {
            return $request_class = 'database-access';
        }
        if (preg_match('/\/installer-log.txt/i', $uri))
        {
            return $request_class = 'installer-log';
        }
        if (preg_match('/\/wpscan.com/i', $user_agent))
        {
            return $request_class = 'wp-scan';
        }
        if (preg_match('/\/wp-config.php/i', $uri))
        {
            return $request_class = 'config-grabber';
        }
        if (preg_match('/\/wp-content\/plugins\//i', $uri))
        {
            foreach(Suspicious::PLUGINS as $plugin)
            {
                if($plugin === $uri)
                {
                    return $request_class = 'suspicious_plugin';
                }
            }
            
        }
        if ($status_code === 404)
        {
            return $request_class = '404-not-found';
        }

        return $request_class;
    }

    public static function calculate_points($classification)
    {
        switch($classification)
        {
            case "config-grabber":
                return Config::CONFIG_GRAPPER_POINTS;
            case "wp-scan":
                return Config::WP_SCAN_POINTS;
            case "installer-log":
                return Config::INSTALLER_LOG_POINTS;
            case "database-access":
                return Config::DATABASE_ACCESS_POINTS;
            case "xmlrpc":
                return Config::XMLRPC_POINTS;
            case "failed-login":
                return Config::FAILED_LOGIN_POINTS;
            case "suspicious_plugin":
                return Config::SUSPICIOUS_PLUGIN_POINTS;
            case "404-not-found":
                return Config::NOT_FOUND_POINTS;
        }
    }
}