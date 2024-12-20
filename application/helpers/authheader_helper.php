<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_authorization_token')) {
    /**
     * Extract and validate the Authorization token from the request header.
     *
     * @return array
     */
    function get_authorization_token() {
        $CI =& get_instance(); // Get the CodeIgniter instance
        $authorization_header = $CI->input->get_request_header('Authorization');

        // Check if the Authorization header is provided
        if (!isset($authorization_header) || empty($authorization_header)) {
            return [
                'success' => false,
                'status' => 401,
                'message' => 'Authorization header not provided.'
            ];
        }

        // Extract the token from the header
        $token = str_replace('Bearer ', '', $authorization_header);

        // Check if the token is empty
        if (empty($token)) {
            return [
                'success' => false,
                'status' => 401,
                'message' => 'Token not provided.'
            ];
        }

        // If everything is valid, return the token
        return [
            'success' => true,
            'status' => 200,
            'token' => $token
        ];
    }
}