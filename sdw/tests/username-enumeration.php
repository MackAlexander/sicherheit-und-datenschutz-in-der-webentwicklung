<?php

require_once __DIR__ . '/curl.php';

$usernames = ["asdf", "admin", "test", "user", "root"];
$blogpost = "http://localhost/2024/06/14/hello-world/";

$tests_passed = 0;

echo "Starting Username Enumeration tests...\n\n";

test_author_pages($usernames);
test_author_page($usernames);
test_feed($usernames);
test_sitemap($usernames);
test_oembed($usernames, $blogpost);
test_blogpost($usernames, $blogpost);
test_rest_api($usernames);
test_login_response($usernames);

echo "${tests_passed} out of 8 tests passed.\n";

function test_author_pages($usernames)
{
    global $tests_passed;
    $users_found = false;
    echo "[Test 1] Enumerating author pages...\n";
    
    for($i = 1; $i <= 10; $i++)
    {
        $url = "http://localhost?author=${i}";
        $response = get($url);

        if($response['status'] === 301) 
        {
            foreach($usernames as $username)
            {
                if (strpos($response['headers']['Location'], $username))
                {
                    echo "[Test 1] Username of User ${i}: ${username}.\n";
                    $users_found = true;
                }
                    
            }
        }
        else if($response['status'] === 200) 
        {
            foreach($usernames as $username)
            {
                if(strpos($response['body'], "Author: <span>${username}</span>"))
                {
                    echo "[Test 1] Username of User ${i}: ${username}.\n";
                    $users_found = true;
                }
            }
        }
    }
    if(!$users_found) $tests_passed++;
    echo "\n";
}

function test_author_page($usernames)
{
    global $tests_passed;
    $users_found = false;
    echo "[Test 2] Checking author pages directly...\n";
    
    foreach($usernames as $username)
    {
        $url = "http://localhost/author/${username}/";
        $response = get($url);

        if($response['status'] === 200)
        {
            echo "[Test 2] Found author page of ${username}.\n"; 
            $users_found = true;
        }
    }
    if(!$users_found) $tests_passed++;
    echo "\n";
}

function test_feed($usernames)
{
    global $tests_passed;
    $users_found = false;
    echo "[Test 3] Checking feed...\n";

    $url = "http://localhost/feed/";
    $response = get($url);
    
    foreach($usernames as $username)
    {
        if(strpos($response['body'], "<dc:creator><![CDATA[${username}]]></dc:creator>"))
        {
            echo "[Test 3] Found username ${username}.\n"; 
            $users_found = true;
        }        
    }
    if(!$users_found) $tests_passed++;
    echo "\n";
}

function test_sitemap($usernames)
{
    global $tests_passed;
    $users_found = false;
    echo "[Test 4] Checking users site map...\n";

    $url = "http://localhost/wp-sitemap-users-1.xml";
    $response = get($url);

    foreach($usernames as $username)
    {
        if(strpos($response['body'], "<loc>http://localhost/author/${username}/</loc>"))
        {
            echo "[Test 4] Found username ${username}.\n"; 
            $users_found = true;
        }        
    } 
    if(!$users_found) $tests_passed++;
    echo "\n";
}

function test_oembed($usernames, $blogpost)
{
    global $tests_passed;
    $users_found = false;
    echo "[Test 5] Checking oembed...\n";

    $url = "http://localhost/wp-json/oembed/1.0/embed?url=${blogpost}";
    $response = get($url);

    foreach($usernames as $username)
    {
        if(isset($response['body']['author_name']) && isset($response['body']['author_url']))
        {
            if($response['body']['author_name'] === $username)
            {
                echo "[Test 5] Found username ${username}.\n"; 
                $users_found = true;
            }
            if(strpos($response['body']['author_url'], $username))
            {
                echo "[Test 5] Found author url of user ${username}.\n"; 
                $users_found = true;
            }
        }
    }
    if(!$users_found) $tests_passed++;
    echo "\n";
}

function test_blogpost($usernames, $blogpost)
{
    global $tests_passed;
    $users_found = false;
    echo "[Test 6] Checking blog post ${blogpost}...\n";

    $url = "${blogpost}";
    $response = get($url);

    foreach($usernames as $username)
    {
        if(strpos($response['body'], 'class="wp-block-post-author-name__link">' . $username . '</a></div>'))
        {
            echo "[Test 6] Found blog author ${username}.\n"; 
            $users_found = true;
        }
        if(strpos($response['body'], '<div class="wp-block-comment-author-name">' . $username . '</div>'))
        {
            echo "[Test 6] Found comment of ${username}.\n"; 
            $users_found = true;
        }
    }
    if(!$users_found) $tests_passed++;
    echo "\n";
}

function test_rest_api($usernames)
{
    global $tests_passed;
    $users_found = false;
    echo "[Test 7] Checking REST API...\n";

    $url = "http://localhost/wp-json/wp/v2/users/?per_page=100&page=1";
    $response = get($url);

    foreach($response['body'] as $user) 
    {
        foreach($usernames as $username)
        {
            if(isset($user['name']) && $user['name'] === $username)
            {
                echo "[Test 7] Found ${username} in name.\n"; 
                $users_found = true;
            }
            if(isset($user['slug']) && $user['slug'] === $username)
            {
                echo "[Test 7] Found ${username} in slug.\n"; 
                $users_found = true;
            }
            if(isset($user['link']) && strpos($user['link'], $username))
            {
                echo "[Test 7] Found ${username} in link.\n"; 
                $users_found = true;
            } 
        }
    }
    if(!$users_found) $tests_passed++;
    echo "\n";
}

function test_login_response($usernames)
{
    global $tests_passed;
    $users_found = false;
    echo "[Test 8] Checking login error response.\n";

    $loginUrl = "http://localhost/wp-login.php";
    $cookieFile = get_cookies($loginUrl);

    foreach($usernames as $username)
    {
        $url = "http://127.0.0.1/wp-login.php";
        $data = [
            'log' => $username,
            'pwd' => '123',
            'wp-submit' => 'Log In',
            'redirect_to' => 'http://localhost/wp-admin/',
            'testcookie' => '1'
        ];
    
        $response = post($loginUrl, $data, $cookieFile);
        $filtered_response = return_json($response);
    
        if(strpos($filtered_response, "The password you entered for the username <strong>" . $username ."<\/strong> is incorrect."))
        {
            echo "[Test 8] Username " . $username . " confirmed.\n";
            $users_found = true;
        }
    }
    if(!$users_found) $tests_passed++;
    echo "\n";
}