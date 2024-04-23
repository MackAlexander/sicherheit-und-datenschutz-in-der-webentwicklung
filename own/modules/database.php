<?php

namespace THM\Own;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

add_action('thm_own_plugin_loaded',['THM\Own\Database', 'init'], 5);

/**
 * Database module for the THM Own plugin.
 */
class Database
{
    private static $db_version = '1';
    private static $table_name = 'thm_own_access_log';

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
        //$db = $wpdb->prefix . self::$table_name;
        $db = 'own_' . self::$table_name;//Änderung vorgenommen
		
		$charset_collate = $wpdb->get_charset_collate();
		
		/*$table = "CREATE TABLE $db (
			time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            client VARCHAR(32) NOT NULL,
            url VARCHAR(128) NOT NULL
		) $charset_collate;";
        dbDelta($table);
        */

        $table = "CREATE TABLE $db (
            id INT(11) NOT NULL AUTO_INCREMENT,
            time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            client VARCHAR(32) NOT NULL,
            url VARCHAR(128) NOT NULL,
            timestamps DATETIME NOT NULL,
            PRIMARY KEY  (id)
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
    public static function append_access_log($client, $url)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$table_name;
        $wpdb->insert($table_name, ['client' => $client, 'url' => $url]);
    }
}