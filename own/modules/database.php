<?php

namespace THM\Own;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

add_action('plugins_loaded',['THM\Own\Database', 'init'], 5);

/**
 * Database module for the THM Security plugin.
 */
class Database
{
    private static $db_version = '3';
    private static $table_name = 'thm_security_access_log';

    /**
     * Initialize the database module.
     */
    public static function init()
	{
		if (get_site_option(self::$table_name . '_db_version') != self::$db_version)
		{
			self::install_db();
		}
	}

    /**
     * Install the database on the mysql server.
     */
    private static function install_db()
	{
		global $wpdb;
        $db = $wpdb->prefix . self::$table_name;
		
		$charset_collate = $wpdb->get_charset_collate();
		
		$table = "CREATE TABLE $db (
			time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            client VARCHAR(32) NOT NULL,
            url VARCHAR(128) NOT NULL,
            method VARCHAR(8) NOT NULL,
            protocol VARCHAR(8) NOT NULL,
            user_agent VARCHAR(128) NOT NULL,
            query_string VARCHAR(128) NOT NULL,
            user_id INT
		) $charset_collate;";
        dbDelta($table);

		update_site_option(self::$table_name . '_db_version', self::$db_version);
	}

    /**
     * Get a list of all entries from the access log.
     */
    public static function get_access_log()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$table_name;
        $logs = $wpdb->get_results("SELECT * FROM $table_name");
        return $logs;
    }

    /**
     * Add a new entry to the access log.
     */
    public static function append_access_log($client, $url, $method, $protocol, $user_agent, $query_string, $user_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$table_name;
        $wpdb->insert($table_name, ['client' => $client, 'url' => $url, 'method' => $method, 'protocol' => $protocol, 'user_agent' => $user_agent, 'query_string' => $query_string, 'user_id' => $user_id]);
    }
}