<?php
require_once APPPATH . '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
function generate_access_token($userId) {
    return generate_jwt($userId, 'access');
}

function generate_refresh_token($userId) {
    return generate_jwt($userId, 'refresh');
}

function validate_access_token($jwt) {
    return validate_jwt($jwt, 'access');
}

function validate_refresh_token($jwt) {
    $decoded = validate_jwt($jwt, 'refresh');

    if ($decoded["responseCode"] === "200") {
        $userId = $decoded["userId"];
        if (is_refresh_token_valid($userId, $jwt)) {
            return [
                'success' => true,
                "responseCode" => "200",
                "userId" => $userId,
                "responseMessage" => "Refresh token validated successfully"
            ];
        } else {
            return [
                'success' => false,
                "responseCode" => "401",
                "responseMessage" => "Refresh token is invalid or expired"
            ];
        }
    } else {
        return $decoded;
    }
}

function generate_jwt($userId, $type = 'access') {
    $config = include(APPPATH . 'config/jwt_config.php');
    $date = new DateTimeImmutable();
    $secretKey = $config[$type === 'access' ? "ACCESS_SECRET_KEY" : "REFRESH_SECRET_KEY"];
    $expirationTime = $config[$type === 'access' ? "ACCESS_SECRET_EXPIRY_TIME" : "REFRESH_SECRET_EXPIRY_TIME"];
    
    // Calculate expiration timestamp and format it as DATETIME
    $expirationTimestamp = $date->getTimestamp() + $expirationTime;
    $expirationDatetime = date('Y-m-d H:i:s', $expirationTimestamp);

    $payload = [
        'iat' => $date->getTimestamp(),
        'iss' => $config["ISS"],
        'nbf' => $date->getTimestamp(),
        'exp' => $expirationTimestamp,
        'userId' => $userId,
        'type' => $type
    ];

    try {
        $jwt = JWT::encode($payload, $secretKey, 'HS256');
        if ($type === 'refresh') {
            store_refresh_token($userId, $jwt, $expirationDatetime);
        }
        return [
            "responseCode" => "200",
            "jwt" => $jwt,
            "responseMessage" => ucfirst($type) . " token generated successfully"
        ];
    } catch (Exception $e) {
        return [
            "responseCode" => "500",
            "responseMessage" => $e->getMessage()
        ];
    }
}


function validate_jwt($jwt, $type) {
    $config = include(APPPATH . 'config/jwt_config.php');
    $secretKey = $config[$type === 'access' ? "ACCESS_SECRET_KEY" : "REFRESH_SECRET_KEY"];

    try {
        $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));
        return [
            'success' => true,
            "responseCode" => "200",

            "userId" => $decoded->userId,
            "responseMessage" => ucfirst($type) . " token validated successfully"
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            "responseCode" => "401",
            "responseMessage" => $e->getMessage()
        ];
    }
}


function store_refresh_token($userId, $refreshToken, $expiresAt) {
    $CI =& get_instance();
    $CI->load->model('User_model');
    
    return $CI->User_model->storeRefreshToken($userId, $refreshToken, $expiresAt);
}
function is_refresh_token_valid($userId, $refreshToken) {
    $CI =& get_instance();
    $CI->load->model('User_model');
    return $CI->User_model->validateRefreshToken($userId, $refreshToken);
}
