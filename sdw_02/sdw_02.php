<?php
/*
Plugin Name: SDW-02
Description: Kopie der SDW-01 Plugin - Parallele Ausführung mit eigenem Namespace (SDW02)
Version: 1.0.1
Author: nickel_mack
Author URI: https://github.com/MackAlexander/sicherheit-und-datenschutz-in-der-webentwicklung
*/

namespace THM\SDW02;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/modules/demo.php');

?>