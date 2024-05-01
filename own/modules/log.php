<?php

namespace THM\Own;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/database.php');

add_action('admin_menu', ['\THM\Own\Log', 'add_menu']);
add_action('shutdown', ['\THM\Own\Log', 'log_access']);

/**
 * Log module for the THM Security plugin.
 */
class Log
{
    /**
     * Adds a menu item to the tools menu.
     */
    public static function add_menu()
    {
        add_management_page('THM Security', 'THM Security', 'manage_options', 'thm-security', ['\THM\Own\Log', 'render_management_page']);
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
                    <th>Protocol</th>
                    <th>User Agent</th>
                    <th>Query String</th>
                    <th>Response Code</th>
                    <th>User ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($logs as $log): ?>
                    <tr>
                        <td><?= esc_html($log->time) ?></td>
                        <td><?= esc_html($log->client) ?></td>
                        <td><?= esc_html($log->url) ?></td>
                        <td><?= esc_html($log->method) ?></td>
                        <td><?= esc_html($log->protocol) ?></td>
                        <td><?= esc_html($log->user_agent) ?></td>
                        <td><?= esc_html($log->query_string) ?></td>
                        <td><?= esc_html($log->response_code) ?></td>
                        <td><?= esc_html($log->user_id) ?></td>
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
        if (str_contains($_SERVER['REQUEST_URI'], 'favicon.ico')) {
            return;
        }

        if (str_contains($_SERVER['REQUEST_URI'], '/wp-admin/tools.php?page=thm-security')) {
            return;
        }

        if (str_contains($_SERVER['REQUEST_URI'], '/wp-admin/admin-ajax.php')) {
            return;
        }

        /*foreach($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = $key . ': ' . $value;

            error_log($header, 0);
        }*/        

        $user_id = get_current_user_id();

        Database::append_access_log($_SERVER['REMOTE_ADDR'], $_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_SERVER['SERVER_PROTOCOL'], $_SERVER['HTTP_USER_AGENT'], $_SERVER['QUERY_STRING'], http_response_code(),$user_id ? : null);
    }
}

?>