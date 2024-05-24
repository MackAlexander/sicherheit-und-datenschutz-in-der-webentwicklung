<?php

function get($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $headers = [];
    [$headers_array, $body] = explode("\r\n\r\n", $response, 2);
    foreach (explode("\r\n", $headers_array) as $header)
    {
        $header = trim($header);
        if (empty($header)) continue;

        $parts = explode(': ', $header, 2);
        if (count($parts) == 2)
        {
            $key = $parts[0];
            $value = $parts[1];
            $headers[$key] = $value;
        }
    }
    if (isset($headers['Content-Type']) && strpos($headers['Content-Type'], 'application/json') !== false)
    {
        $body = json_decode($body, true);
    }
    return [
        'status' => $statuscode,
        'headers' => $headers,
        'body' => $body
    ];
}

function print_json($response)
{
    echo json_encode($response, JSON_PRETTY_PRINT);
}