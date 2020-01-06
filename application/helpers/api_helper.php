<?php
function json_post($url, $data = [], $header = [])
{

    $payload = json_encode($data);
    // Prepare new cURL resource
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set HTTP Header for POST request 
    $defaulHeader = array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload),
    );
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array_merge($defaulHeader, $header)
    );

    // Submit the POST request
    $result = curl_exec($ch);

    // Close cURL session handle
    curl_close($ch);
    $response = json_decode($result, true);

    return $response;
}

function format_access_token($token)
{
    return 'Bearer ' . $token;
}
function get_token_header($token)
{
    $header = array(
        'Authorization:' . format_access_token($token),
    );
    return $header;
}
