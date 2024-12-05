<?php
require_once APPPATH . '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Load Composer's autoloader for Firebase JWT

// Define a constant for the secret key to avoid hardcoding
define('JWT_SECRET_KEY', 'your_secret_key'); // Use environment variables in production

/**
 * Create a JWT token.
 *
 * @param string $username The username to include in the token.
 * @param int $role_id The role ID to include in the token.
 * @return array The response containing the token and additional info.
 */
function createToken($username, $role_id)
{
    $payload = [
        'iss' => base_url(),      // Issuer of the token
        'iat' => time(),          // Issued at time
        'exp' => time() + 3600,   // Expiry time (1 hour)
        'username' => $username,   // Payload data: User ID or username
        'role' => $role_id        // Payload data: Role ID
    ];

    // Generate the JWT token
    $token = JWT::encode($payload, JWT_SECRET_KEY, 'HS256');

    return [
        'success' => true,
        'message' => 'Login successful.',
        'data' => [
            'username' => $username,
            'role' => $role_id
        ],
        'token' => $token
    ];
}

/**
 * Validate a JWT token.
 *
 * @param string $token The JWT token to validate.
 * @return array The validation result, including success status and decoded data.
 */
function validateToken($token)
{
    if (!$token) {
        return [
            'success' => false,
            'message' => 'Token not provided'
        ];
    }

    try {
        // Decode the JWT token
        $decoded = JWT::decode($token, new Key(JWT_SECRET_KEY, 'HS256'));

        // Return success response with decoded data
        return [
            'success' => true,
            'message' => 'Token is valid.',
            'data' => (array) $decoded
        ];
    } catch (Exception $e) {
        // Catch and handle token validation errors
        return [
            'success' => false,
            'message' => 'Invalid token: ' . $e->getMessage()
        ];
    }
}

?>
