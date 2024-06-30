<?php

namespace THM\Security;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('user_register', ['THM\Security\Username', 'user_register'], 10, 2);
add_action('profile_update', ['THM\Security\Username', 'profile_update'], 10, 3);
add_action('user_profile_update_errors', ['THM\Security\Username', 'user_profile_update_errors'], 10, 3);
add_action('template_redirect', ['THM\Security\Username', 'disable_author_page'], 10, 0);
add_action('admin_notices', ['THM\Security\Username', 'admin_notices'], 10, 0);
add_filter('the_author', ['THM\Security\Username', 'the_author'], 10, 1);
add_filter('get_the_author_display_name', ['THM\Security\Username', 'get_the_author_display_name'], 10, 3);
add_filter('get_comment_author', ['THM\Security\Username', 'get_comment_author'], 10, 3);
add_filter('author_link', ['THM\Security\Username', 'author_link'], 10, 3);
add_filter('login_errors', ['THM\Security\Username', 'login_errors'], 10, 1);
add_filter('rest_endpoints', ['THM\Security\Username', 'rest_endpoints'], 10, 1);
add_filter('oembed_response_data', ['THM\Security\Username', 'oembed_response_data'], 10, 4);
add_filter('wp_sitemaps_add_provider', ['THM\Security\Username', 'wp_sitemaps_add_provider'], 10, 2);


/**
 * Username module for the THM Security plugin.
 */
class Username
{
    /**
     * Sets a default nickname and display_name when a new user is created.
     */
    public static function user_register($user_id, $userdata) 
    {
        wp_update_user(array('ID' => $user_id, 'nickname' => 'Anonymous', 'display_name' =>  'Anonymous'));
    }

    /**
     * Prevents users from setting their display_name to their login name.
     */
    public static function profile_update($user_id, $old_user_data, $userdata) 
    {
        $user = get_userdata($user_id);
        if($user->display_name === $user->user_login)
        {
            wp_update_user(array('ID' => $user_id, 'nickname' => 'Anonymous', 'display_name' =>  'Anonymous'));
        }
    }

    /**
     * Displays an error message if the user tries to set their display_name to their login_name.
     */
    public static function user_profile_update_errors($errors, $update, $user) 
    {
        if ($user->display_name === $user->user_login) {
            // Add an error to the WP_Error object
            $errors->add('display_name_error', __('Your display name cannot be the same as your login name. The change has been reverted.'));
        }
        return $errors;
    }

    /**
     * Disables author pages and display a 404 page instead.
     * Affected links:
     * yoursite.com/author/name
     * yoursite.com?author=1
     */
    public static function disable_author_page() 
    {
        if(is_author()) 
        {
            global $wp_query;
            $wp_query->set_404();
            status_header( 404 );
            nocache_headers();
        }
    }

    /**
     * Displays a warn message in the backend, if the current user has the same display name as login name.
     */
    public static function admin_notices()
    {
        $user = wp_get_current_user();

        if($user->display_name === 'Anonymous')
        {
            echo '<div class="notice notice-warning">
                <p>Your display name has been initially set to "Anonymous". Please change your Nickname to a meaningful name which is not your login name and change your display name accordingly.</p>
                <p>Please go to your <a href="/wp-admin/profile.php">profile</a> and change your display name.</p>
            </div>';
        }
    }

    /**
     * Prevents usernames from being displayed in the RSS Feed and displays 'Anonymous' instead.
     * Nicknames will still get displayed.
     * Affected links:
     * yoursite.com/feed
     */
    public static function the_author($display_name) 
    {
        if (username_exists($display_name))
        {
            $display_name = 'Anonymous';
        }
        return $display_name;
    }

    /**
     * Displays 'Anonymous' as the display name, if the current display name of the author is set to the loginname.
     * Affects:
     * - Blog Posts
     */
    public static function get_the_author_display_name($display_name, $user_id, $original_user_id)
    {
        if (username_exists($display_name))
        {
            $display_name = 'Anonymous';
        }
        return $display_name;
    }

    /**
     * Displays 'Anonymous' as the display name, if the current display name of the comment author is set to the loginname.
     * Affects:
     * - Blog Comments
     */
    public static function get_comment_author($comment_author, $comment_id, $comment)
    {
        $user = get_user_by('login', $comment_author);
        
        if ($user)
        {
            $comment_author = $user->display_name;
        }

        if (username_exists($comment_author))
        {
            $comment_author = 'Anonymous';
        }

        return $comment_author;
    }

    /**
     * Disables the author url and links to the current page instead on blog posts
     * Disables redirect from ?author=1 to /author/name
     * Also disables the user URL in the Sitemap: yoursite.com/wp-sitemap-users-1.xml
     */
    public static function author_link($link, $author_id, $author_nicename) {	 	 
        $link = false;
        return $link;
    }

    /**
     * Displays a generic error message on failed logins instead of indicating whether a username is valid or not.
     */
    public static function login_errors($errors) 
    {
        return "Wrong Username or password.";
    }

    /**
     * Disables the users endpoints in the wordpress rest api.
     */
    public static function rest_endpoints($endpoints)
    {
        if (isset($endpoints['/wp/v2/users'])) 
        {
            unset( $endpoints['/wp/v2/users'] );
        }

        if(isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) 
        {
            unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
        }

        return $endpoints;
    }

    /**
     * Removes the author name and the author url from Embeds.
     * Affected links:
     * yoursite.com/wp-json/oembed/1.0/embed?url={page-to-embed}
     */
    public static function oembed_response_data($data, $post, $width, $height)
    {
        unset($data['author_url']);
        unset($data['author_name']);
        return $data;
    }

    /**
     * Disables the http://localhost/wp-sitemap-users-1.xml URL and removes the link from http://localhost/wp-sitemap.xml.
     */
    public static function wp_sitemaps_add_provider($provider, $name) 
    {
        if ( 'users' === $name ) 
        {
            return false;
        }
    
        return $provider;
    }
}