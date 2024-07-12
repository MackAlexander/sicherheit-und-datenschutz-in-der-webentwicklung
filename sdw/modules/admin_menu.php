<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/config.php');

add_action('admin_menu', ['\THM\Security\AdminMenu', 'add_menu']);

/**
 * Admin Menu module for the THM Security plugin to display logs and bans in the admin_menu.
 */
class AdminMenu
{
    /**
     * Adds a menu item to the tools menu.
     */
    public static function add_menu()
    {
        add_management_page('THM Security', 'THM Security', 'manage_options', 'thm-security', ['\THM\Security\AdminMenu', 'render_management_page']);
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
                <a href="?page=thm-security&tab=bans" class="nav-tab <?= ($tab == 'bans') ? 'nav-tab-active' : '' ?>">Bans</a>
            </nav>
            <?php if(empty($tab))    self::render_access_log(); ?>
            <?php if($tab==='bans') self::render_bans(); ?>
        </div>
        <?php
    }

    /**
     * Renders the access log tab on the management page.
     */
    private static function render_access_log()
    {
        $logs_per_page = Config::LOGS_PER_PAGE; // Number of logs per page
        $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
        $offset = ($current_page - 1) * $logs_per_page;

        $total_logs = Database::get_access_log_count();
        $logs = Database::get_access_log($logs_per_page, $offset);
        $total_pages = ceil($total_logs / $logs_per_page);

        ?>
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>IP</th>
                    <th>URL</th>
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
                        <td><?= esc_html($log->user_agent) ?></td>
                        <td><?= esc_html($log->response_code) ?></td>
                        <td><?= esc_html($log->classification) ?></td>
                        <td><?= esc_html($log->points) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php

        // Pagination links
        if ($total_pages > 1) {
            $page_links = paginate_links(array(
                'base' => add_query_arg('paged', '%#%'),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => $total_pages,
                'current' => $current_page
            ));

            echo '<div class="tablenav"><div class="tablenav-pages">' . $page_links . '</div></div>';
        }
    }

    /**
     * Renders the empty page tab on the management page.
     */
    private static function render_bans()
    {
        $bans = Database::get_bans();

        ?>
        <table class="wp-list-table widefat fixed striped table-view-list">
            <thead>
                <tr>
                    <th>IP</th>
                    <th>Begin</th>
                    <th>End</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($bans as $ban): ?>
                    <tr>
                        <td><?= esc_html($ban->ip_address) ?></td>
                        <td><?= esc_html($ban->begin_time) ?></td>
                        <td><?= esc_html($ban->end_time) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }
}

?>