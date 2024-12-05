<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model'); // Ensure your Login_model is properly configured
        $this->load->library('session');
        $this->load->helper('token'); // Load token helper
    }

    /**
     * User login method.
     */
    public function login()
    {
        // Restrict access to POST requests only
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output->set_status_header(405)
                         ->set_content_type('application/json')
                         ->set_output(json_encode([
                             'success' => false,
                             'message' => 'GET method is not allowed. Please use POST.'
                         ]));
            return;
        }

        // Decode the JSON payload
        $raw_data = file_get_contents('php://input');
        $json_data = json_decode($raw_data, true);

        $username = trim($json_data['username'] ?? '');
        $name = trim($json_data['name'] ?? '');

        // Validate input
        if (empty($username)) {
            $this->output->set_status_header(400)
                         ->set_content_type('application/json')
                         ->set_output(json_encode([
                             'success' => false,
                             'message' => 'Username is required.'
                         ]));
            return;
        }

        // Check if the user exists
        $result = $this->Login_model->loginuser($username);

        if ($result) {
            // Generate token for existing user
            $response = createToken($username, $result->role);
            $this->output->set_status_header(200)
                         ->set_content_type('application/json')
                         ->set_output(json_encode($response));
        } else {
            // Register the user if not found
            $inserted_id = $this->Login_model->createUser(['username' => $username, 'name' => $name]);

            if ($inserted_id) {
                // Generate token for new user
                $response = createToken($username, 'user'); // Default role
                $this->output->set_status_header(200)
                             ->set_content_type('application/json')
                             ->set_output(json_encode($response));
            } else {
                // User creation failed
                $this->output->set_status_header(500)
                             ->set_content_type('application/json')
                             ->set_output(json_encode([
                                 'success' => false,
                                 'message' => 'Oops! Error creating user.'
                             ]));
            }
        }
    }

    /**
     * Validate the JWT token.
     */
    public function validate_token()
    {
        // Get the token from the Authorization header
        $authorization_header = $this->input->get_request_header('Authorization');

        // Check if the Authorization header is set and not empty
        if (!isset($authorization_header) || empty($authorization_header)) {
            $this->output->set_status_header(401)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'success' => false,
                            'message' => 'Authorization header not provided.'
                        ]));
            return;
        }

        // Remove 'Bearer ' from the token
        $token = str_replace('Bearer ', '', $authorization_header);
       

        // Check if the token is empty after stripping 'Bearer '
        if (empty($token)) {
            $this->output->set_status_header(401)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'success' => false,
                            'message' => 'Token not provided.'
                        ]));
            return;
        }

        // Validate the token using the helper function
        $result = validateToken($token);
        
        if ($result['success']) {
            // Assuming the 'username' is part of the decoded token
            $decoded_data = $result['data'];
            $username = $decoded_data['username'] ?? null;

            if ($username) {
                // Load the user model
               

                // Fetch user details by username
                $user = $this->Login_model->get_user_by_username($username);

                if ($user) {
                    $this->output->set_status_header(200)
                                ->set_content_type('application/json')
                                ->set_output(json_encode([
                                    'success' => true,
                                    'message' => 'Token is valid.',
                                    'user'    => $user
                                ]));
                } else {
                    $this->output->set_status_header(404)
                                ->set_content_type('application/json')
                                ->set_output(json_encode([
                                    'success' => false,
                                    'message' => 'User not found.'
                                ]));
                }
            } else {
                $this->output->set_status_header(400)
                            ->set_content_type('application/json')
                            ->set_output(json_encode([
                                'success' => false,
                                'message' => 'Username not found in token.'
                            ]));
            }
        } else {
            $this->output->set_status_header(401)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'success' => false,
                            'message' => $result['message']
                        ]));
        }
    }
}

?>
