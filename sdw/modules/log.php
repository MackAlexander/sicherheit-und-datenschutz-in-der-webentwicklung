<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/database.php');
require_once(dirname(__FILE__) . '/classifier.php');
require_once(dirname(__FILE__) . '/blocker.php');

add_action('admin_menu', ['\THM\Security\Log', 'add_menu']);
add_action('shutdown', ['\THM\Security\Log', 'log_access']);

/**
 * Log module for the THM Security plugin.
 */
class Log
{
    private static $ban_duration = 7; //Ban duration in days

    /**
     * Adds a menu item to the tools menu.
     */
    public static function add_menu()
    {
        add_management_page('THM Security', 'THM Security', 'manage_options', 'thm-security', ['\THM\Security\Log', 'render_management_page']);
    }

    /**
     * Renders the management page.
     */
    public static function render_management_page()
    {
        if (!current_user_can('manage_options')) return;

        $tab = sanitize_text_field(@$_GET['tab'] ?: '');

        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()) ?></h1>
            <nav class="nav-tab-wrapper">
                <a href="?page=thm-security" class="nav-tab <?= empty($tab) ? 'nav-tab-active' : '' ?>">Access Log</a>
                <a href="?page=thm-security&tab=page2" class="nav-tab <?= ($tab == 'page2') ? 'nav-tab-active' : '' ?>">Leere Seite</a>
            </nav>
            <?php if(empty($tab))    self::render_access_log(); ?>
            <?php if($tab==='page2') self::render_empty_page(); ?>
        </div>
        <?php
    }

    /**
     * Renders the access log tab on the management page.
     */
    private static function render_access_log()
    {
        $logs = Database::get_access_log();

        ?>
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>IP</th>
                    <th>URL</th>
                    <th>Method</th>
                    <th>User Agent</th>
                    <th>Response Code</th>
                    <th>Classification</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($logs as $log): ?>
                    <tr>
                        <td><?= esc_html($log->time) ?></td>
                        <td><?= esc_html($log->ip_address) ?></td>
                        <td><?= esc_html($log->url) ?></td>
                        <td><?= esc_html($log->method) ?></td>
                        <td><?= esc_html($log->user_agent) ?></td>
                        <td><?= esc_html($log->response_code) ?></td>
                        <td><?= esc_html($log->classification) ?></td>
                        <td><?= esc_html($log->points) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }

    /**
     * Renders the empty page tab on the management page.
     */
    private static function render_empty_page()
    {
        ?>
        <p>
            Dies ist eine leere Seite.<br>
            Sie können beliebig viele weitere Seiten hinzufügen.
        </p>
        <?php
    }

    /**
     * Logs any access to the website into the database.
     */
    public static function log_access()
    {
        if(Database::is_ip_blocked($_SERVER['REMOTE_ADDR']))
        {
            return;
        }

        $classification = Classifier::classify_request();

        if($classification !== "normal") {
            $points = Blocker::calculate_points($classification);
            Database::append_access_log($_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_SERVER['HTTP_USER_AGENT'], http_response_code(), $classification, $points);
        
            if(Database::get_total_points($_SERVER['REMOTE_ADDR'])> 50)
            {
                Database::ban_ip($_SERVER['REMOTE_ADDR'], self::$ban_duration);
            }
        }
    }
}

?>