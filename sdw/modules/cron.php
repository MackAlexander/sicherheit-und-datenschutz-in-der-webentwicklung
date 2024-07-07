<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/database.php');
require_once(dirname(__FILE__) . '/config.php');

register_activation_hook('sdw/sdw.php', ['THM\Security\Cron', 'schedule_daily_task']);
register_deactivation_hook('sdw/sdw.php', ['THM\Security\Cron', 'clear_scheduled_task']);

add_action('remove_old_entries', ['THM\Security\Cron', 'remove_old_entries'], 10, 0);

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
        if(!wp_next_scheduled('remove_old_entries')) {
            wp_schedule_event(time(), 'daily', 'remove_old_entries');
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
    public static function remove_old_entries()
    {
        Database::remove_old_logs(Config::CLEAN_DURATION);
        Database::remove_old_bans();
    }
}