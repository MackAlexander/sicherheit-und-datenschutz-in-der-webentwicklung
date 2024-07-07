<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Configuration module for the THM Security plugin.
 */
class Config
{
    public const DEFAULT_NAME = 'Anonymous'; 

    public const BAN_DURATION = 7;
    public const CLEAN_DURATION = 30;
    public const MAX_POINTS = 50;

    public const DATABASE_ACCESS_POINTS = 15;
    public const XMLRPC_POINTS = 15;
    public const WP_SCAN_POINTS = 10;
    public const INSTALLER_LOG_POINTS = 10;
    public const CONFIG_GRAPPER_POINTS = 5;    
    public const SUSPICIOUS_PLUGIN_POINTS = 5;
    public const NOT_FOUND_POINTS = 1;   
    public const FAILED_LOGIN_POINTS = 1;
}