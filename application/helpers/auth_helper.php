<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('check_admin_auth')) {
    function check_admin_auth()
    {
        $CI = &get_instance();
        $user_data = $CI->session->userdata('logged_in');

        if (!isset($user_data) || $user_data['role'] !== 'admin') {
            redirect(base_url("login"));
            exit;
        }
    }
}