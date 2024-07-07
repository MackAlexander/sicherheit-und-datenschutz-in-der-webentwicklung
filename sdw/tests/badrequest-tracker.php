<?php

require_once __DIR__ . '/curl.php';

echo "Starting Bad Request Tracker tests...\n\n";

test_xmlrpc();
test_sql();
test_installer_log();
test_wp_scan();
test_wpconfig();
test_vulnerable_plugin();
test_404();
test_login_response();

function test_xmlrpc()
{
    echo "Accessing xmlrpc.\n";
    $url = "http://localhost/xmlrpc.php";
    $response = get($url);
}

function test_sql()
{
    echo "Accessing .sql.\n";
    $url = "http://localhost/database.sql";
    $response = get($url);
}

function test_installer_log()
{
    echo "Accessing installer-log.\n";
    $url = "http://localhost/installer-log.txt";
    $response = get($url);
}

function test_wp_scan()
{
    echo "Accessing site with wpscan user agent.\n";
    $url = "http://localhost/";
    $response = get($url, "/wpscan.com");
}

function test_wpconfig()
{
    echo "Accessing wp-config.\n";
    $url = "http://localhost/wp-config.php";
    $response = get($url);
}

function test_vulnerable_plugin()
{
    echo "Accessing vulnerable plugin.\n";
    $url = "http://localhost/wp-content/plugins/zingiri-web-shop/timthumb.php";
    $response = get($url);
}

function test_404()
{
    echo "Accessing 404 page.\n";
    $url = "http://localhost/asdf";
    $response = get($url);
}

function test_login_response()
{
    echo "Sending wrong credentials.\n";

    $loginUrl = "http://localhost/wp-login.php";
    $cookieFile = get_cookies($loginUrl);

    $url = "http://localhost/wp-login.php";
    $data = [
        'log' => 'admin',
        'pwd' => '123',
        'wp-submit' => 'Log In',
        'redirect_to' => 'http://localhost/wp-admin/',
        'testcookie' => '1'
    ];

    post($loginUrl, $data, $cookieFile);
    echo('\n');
}