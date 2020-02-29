<?php
function api_post($url, $data = [], $header = [])
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

function api_post_file($url, $data = [], $header = [])
{
    //$payload = json_encode($data);
    // Prepare new cURL resource
    $defaulHeader = array(
        'Content-Type: multipart/form-data',
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SAFE_UPLOAD, true);
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array_merge($defaulHeader, $header),
    ));

    $result = curl_exec($curl);

    curl_close($curl);



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
