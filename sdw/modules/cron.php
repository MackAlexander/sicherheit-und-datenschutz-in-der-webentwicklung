<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/database.php');

register_activation_hook('sdw/sdw.php', ['THM\Security\Cron', 'schedule_daily_task']);
register_deactivation_hook('sdw/sdw.php', ['THM\Security\Cron', 'clear_scheduled_task']);

add_action('remove_old_logs', ['THM\Security\Cron', 'remove_old_logs'], 10, 0);

/**
 * Cron module for the THM Security plugin.
 */
class Cron
{
    /**
     * Initializes the cron job when the plugin is activated
     */
    public static function schedule_daily_task()
    {
        if(!wp_next_scheduled('remove_old_logs')) {
            wp_schedule_event(time(), 'daily', 'remove_old_logs');
        }
    }

    /**
     * disables the cron job when the plugin is deactivated
     */
    public static function clear_scheduled_task()
    {
        $timestamp = wp_next_scheduled('remove_old_logs');
        wp_unschedule_event($timestamp, 'remove_old_logs');
    }

    /**
     * Deletes every access log that is older than 30 days.
     */
    public static function remove_old_logs()
    {
        Database::remove_old_logs(30);
    }
}