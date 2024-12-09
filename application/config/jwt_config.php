<?php
defined('BASEPATH') OR exit('No direct script access allowed');

return [
    "ACCESS_SECRET_KEY" => "your_access_secret_key",
    "REFRESH_SECRET_KEY" => "your_refresh_secret_key",
    "ACCESS_SECRET_EXPIRY_TIME" => 3600,  // 1 hour
    "REFRESH_SECRET_EXPIRY_TIME" => 604800,  // 1 week
    "ISS" => base_url()
];
