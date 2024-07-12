<?php
/*
Plugin Name: SDW
Description: Wordpress Security Plugin
Version: 1.0.0
Author: Alexander Mack, Jonas Nickel
Author URI: https://www.thm.de
*/

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/modules/badrequest-tracker.php');
require_once(dirname(__FILE__) . '/modules/admin_menu.php');
require_once(dirname(__FILE__) . '/modules/username-enumeration.php');
require_once(dirname(__FILE__) . '/modules/cron.php');
?>