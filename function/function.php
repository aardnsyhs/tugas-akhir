<?php
function decrypt($string)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = '23432MLKJSDF0L2934897@00001';
    $secret_iv  = 'X0000W9876H5982@7676765';

    $key    = hash('sha256', $secret_key);
    $iv     = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

    return $output;
}

function encrypt($string)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = '23432MLKJSDF0L2934897@00001';
    $secret_iv = 'X0000W9876H5982@7676765';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
}