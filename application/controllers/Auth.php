<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Login_model','Country_model','State_model']); // Ensure your Login_model is properly configured
        $this->load->library('session');
        $this->load->helper('token'); // Load token helper
        $this->load->helper('authheader');
    }

    /**
     * User login method.
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->output->set_status_header(405)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'success' => false,
                            'message' => 'GET method is not allowed. Please use POST.'
                        ]));
            return;
        }

        $raw_data = file_get_contents('php://input');
        $json_data = json_decode($raw_data, true);

        $username = trim($json_data['username'] ?? '');
        $name = trim($json_data['name'] ?? '');

        if (empty($username)) {
            $this->output->set_status_header(400)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'success' => false,
                            'message' => 'Username is required.'
                        ]));
            return;
        }

        $result = $this->Login_model->loginuser($username);
       
        if ($result) {
            $accessToken = generate_access_token($username);
            $refreshToken = generate_refresh_token($username);

            $this->output->set_status_header(200)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'success' => true,
                            'message' => 'Login successful.',
                            'access_token' => $accessToken['jwt'],
                            'refresh_token' => $refreshToken['jwt']
                        ]));
        } else {
            $inserted_id = $this->Login_model->createUser(['username' => $username, 'name' => $name]);

            if ($inserted_id) {
                $accessToken = generate_access_token($username);
                $refreshToken = generate_refresh_token($username);

                $this->output->set_status_header(200)
                            ->set_content_type('application/json')
                            ->set_output(json_encode([
                                'success' => true,
                                'message' => 'User registered successfully.',
                                'access_token' => $accessToken['jwt'],
                                'refresh_token' => $refreshToken['jwt']
                            ]));
            } else {
                $this->output->set_status_header(500)
                            ->set_content_type('application/json')
                            ->set_output(json_encode([
                                'success' => false,
                                'message' => 'Error creating user.'
                            ]));
            }
        }
    }

    public function validate_token()
    {
        $tokenResponse = get_authorization_token();

        if (!$tokenResponse['success']) {
            // Return the error response if token extraction failed
            return $this->output
                ->set_status_header($tokenResponse['status'])
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => $tokenResponse['message']
                ]));
        }

        $token = $tokenResponse['token'];
            // If token is empty, return 401 Unauthorized

        $result = validate_access_token($token);
      

        if ($result['responseCode'] === '200') {
            $user = $this->Login_model->get_user_by_username($result['userId']);

            if ($user) {
                $this->output->set_status_header(200)
                            ->set_content_type('application/json')
        // Validate the token
                            ->set_output(json_encode([
                                'success' => true,
                                'message' => 'Token is valid.',
            // If token is valid, get the user
                                'user'    => $user
                            ]));
            } else {
                // If user is found, return 200 OK
                $this->output->set_status_header(404)
                            ->set_content_type('application/json')
                            ->set_output(json_encode([
                                'success' => false,
                                'message' => 'User not found.'
                            ]));
            }
        } else {
                // If user is not found, return 404 Not Found
            $this->output->set_status_header(401)
                        ->set_content_type('application/json')
                        ->set_output(json_encode([
                            'success' => false,
                            'message' => $result['responseMessage']
                        ]));
        }
    }
    
    public function get_access_token_by_refresh_token() {
        // Get the refresh token from the POST request
        $tokenResponse = get_authorization_token();

        if (!$tokenResponse['success']) {
            // Return the error response if token extraction failed
            return $this->output
                ->set_status_header($tokenResponse['status'])
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => $tokenResponse['message']
                ]));
        }

        $token = $tokenResponse['token'];

        // Validate the refresh token using helper
        $validationResponse = validate_refresh_token($token);

        // If validation fails, return the error response
        if ($validationResponse['responseCode'] !== "200") {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($validationResponse));
        }
        
        // Extract userId from the validated token
        $userId = $validationResponse['userId'];

        // Generate a new access token
        $newAccessToken = generate_access_token($userId);

        // If the token generation fails, return an error
        if ($newAccessToken['responseCode'] !== "200") {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($newAccessToken));
        }

        // Return the new access token in the response
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'responseCode' => '200',
                'responseMessage' => 'Access token generated successfully',
                'accessToken' => $newAccessToken['jwt']
            ]));
    }



    public function fetch_countries() {
        $tokenResponse = get_authorization_token();

        if (!$tokenResponse['success']) {
            return $this->output
                ->set_status_header($tokenResponse['status'])
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => $tokenResponse['message']
                ]));
        }

        $token = $tokenResponse['token'];
        $result = validate_access_token($token);

        if ($result['responseCode'] === '200') {
            $countries = $this->Country_model->get_countries('', 0, 10, '', 'ASC');

            return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'data' => $countries
                ]));
        } else {
            return $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => $result['responseMessage']
                ]));
        }
    }

    public function fetch_states() {
        $tokenResponse = get_authorization_token();

        if (!$tokenResponse['success']) {
            return $this->output
                ->set_status_header($tokenResponse['status'])
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => $tokenResponse['message']
                ]));
        }

        $token = $tokenResponse['token'];
        $result = validate_access_token($token);

        if ($result['responseCode'] === '200') {
            $states = $this->State_model->get_states('', 0, 10, '', 'ASC');

            return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'data' => $states
                ]));
        } else {
            return $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => false,
                    'message' => $result['responseMessage']
                ]));
        }
    }
}

?>
