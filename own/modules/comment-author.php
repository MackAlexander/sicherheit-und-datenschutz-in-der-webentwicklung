<?php

namespace THM\Own;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter('get_comment_author', ['THM\Own\Comment', 'comment_author_display_name'], 10, 3);
add_filter('get_comment_author_url', ['THM\Own\Comment', 'comment_author_url'], 10, 3);

class Comment
{
    /**
     * Change the display name of the comment author
     */
    public static function comment_author_display_name($comment_author, $comment_id, $comment)
    {
        $comment_author = 'Fake Comment Autor';
        return $comment_author;
    }

    /**
     * Change the url of the comment author
     */
    public static function comment_author_url($comment_author_url, $comment_id, $comment)
    {
        $comment_author_url = 'localhost/author/fakecommentauthor';
        return $comment_author_url;
    }
}

?>