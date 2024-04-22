<?php
/*
Plugin Name: Own Plugin
Description: Sicherheit und Datenschutz in der Webentwicklung - Kapitel 1
Version: 1.0.0
Author: Jonas Nickel, Alexander Mack
Author URI: https://www.thm.de
*/

namespace THM\Own;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/modules/demo.php');
require_once(dirname(__FILE__) . '/modules/comment-author.php');
require_once(dirname(__FILE__) . '/modules/log.php');

?>