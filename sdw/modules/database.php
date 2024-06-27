<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

add_action('plugins_loaded',['THM\Security\Database', 'activate'], 5);
register_activation_hook('sdw/sdw.php', ['THM\Security\Database', 'activate']);
register_deactivation_hook('sdw/sdw.php', ['THM\Security\Database', 'deactivate']);

/**
 * Database module for the THM Security plugin.
 */
class Database
{
    private static $access_log_table_name = 'sdw_security_access_log';
    private static $bans_table_name = 'sdw_security_bans';
    private static $access_log_version = '1';
    private static $bans_version = '1';

    /**
     * Get a list of all entries from the access log.
     */
    public static function get_access_log()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$access_log_table_name;
        $logs = $wpdb->get_results("SELECT * FROM $table_name");
        return $logs;
    }

    /**
     * Add a new entry to the access log.
     */
    public static function append_access_log($ip_address, $url, $method, $user_agent, $response_code, $classification, $points)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$access_log_table_name;
        $query = $wpdb->prepare(
            "
            INSERT INTO $table_name 
            (ip_address, url, method, user_agent, response_code, classification, points) 
            VALUES 
            (%s, %s, %s, %s, %d, %s, %d)
            ",
            $ip_address, $url, $method, $user_agent, $response_code, $classification, $points
        );

        $wpdb->query($query);
    }

    public static function get_total_points($ip_address)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$access_log_table_name;
        $query = $wpdb->prepare(
            "
            SELECT SUM(points)
            FROM $table_name
            WHERE ip_address = %s
            ",
            $ip_address
        );

        $total_points = $wpdb->get_var($query);
        return $total_points;
    }

    public static function remove_old_logs($days)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$access_log_table_name;

        $query = $wpdb->prepare(
            "DELETE FROM $table_name WHERE time < NOW() - INTERVAL %d DAY",
            $days
        );

        $wpdb->query($query);
    }

    public static function is_ip_blocked($ip_address)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$bans_table_name;
        $query = $wpdb->prepare(
            "
            SELECT COUNT(*) 
            FROM $table_name 
            WHERE ip_address = %s 
            AND begin_time <= NOW() 
            AND (end_time IS NULL OR end_time >= NOW())
            ",
            $ip_address
        );

        $blocked_count = $wpdb->get_var($query);
        return $blocked_count > 0;
    }

    public static function ban_ip($ip_address, $duration)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$bans_table_name;
        $query = $wpdb->prepare(
            "
            INSERT INTO $table_name 
            (ip_address, begin_time, end_time) 
            VALUES 
            (%s, NOW(), DATE_ADD(NOW(), INTERVAL %d DAY))
            ",
            $ip_address, $duration
        );

        $wpdb->query($query);
    }

    /**
     * Initialize the database module.
     */
    public static function activate()
	{
		if (get_site_option(self::$access_log_table_name . '_db_version') != self::$access_log_version)
		{
			self::install_log_table();
		}

        if (get_site_option(self::$bans_table_name . '_db_version') != self::$bans_version)
		{
			self::install_bans_table();
		}
	}

    /**
     * Install the access log table on the mysql server.
     */
    private static function install_log_table()
	{
		global $wpdb;
        $db = $wpdb->prefix . self::$access_log_table_name;
		
		$charset_collate = $wpdb->get_charset_collate();
		
		$table = "CREATE TABLE $db (
			time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            ip_address VARCHAR(32) NOT NULL,
            url VARCHAR(128) NOT NULL,
            method VARCHAR(8) NOT NULL,
            user_agent VARCHAR(128) NOT NULL,
            response_code INT NOT NULL,
            classification VARCHAR(128),
            points DECIMAL
		) $charset_collate;";
        dbDelta($table);

		update_site_option(self::$access_log_table_name . '_db_version', self::$access_log_version);
	}

    /**
     * Install the bans table on the mysql server.
     */
    private static function install_bans_table()
	{
		global $wpdb;
        $db = $wpdb->prefix . self::$bans_table_name;
		
		$charset_collate = $wpdb->get_charset_collate();
		
		$table = "CREATE TABLE $db (
            ip_address VARCHAR(32) NOT NULL,
            begin_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            end_time TIMESTAMP
		) $charset_collate;";
        dbDelta($table);

		update_site_option(self::$bans_table_name . '_db_version', self::$bans_version);
	}

    /**
     * Uninstalls the access log and bans table on the mysql server if the plugin gets deactivated.
     */
    public static function deactivate()
    {
        global $wpdb;

        $access_log_table = $wpdb->prefix . self::$access_log_table_name;
        $points_table = $wpdb->prefix . self::$bans_table_name;

        $sql = "DROP TABLE IF EXISTS $access_log_table, $points_table;";
        $wpdb->query($sql);

        update_site_option(self::$access_log_table_name . '_db_version', '0');
        update_site_option(self::$bans_table_name . '_db_version', '0');
    }
}