<?php

namespace THM\Own;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter('get_comment_author', ['THM\Own\Comment', 'comment_author_display_name'], 10, 1);
add_filter('get_comment_author_url', ['THM\Own\Comment', 'comment_author_url'], 10, 1);

class Comment
{
    /**
     * Change the display name of the comment author
     */
    public static function comment_author_display_name($comment_id)
    {
        $comment = get_comment($comment_id);
        $display_name = $comment->comment_author;
        $display_name = 'Fake Comment Autor';
        return $display_name;
    }

    /**
     * Change the url of the comment author
     */
    public static function comment_author_url($comment_id)
    {
        $comment = get_comment($comment_id);
        $author_url = $comment->comment_author_url;
        $author_url = 'localhost/author/fakeauthor';
        return $author_url;
    }
}

?>