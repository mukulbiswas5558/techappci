<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller 
{
 
	function __construct()
	{
	   parent::__construct();
	   $this->load->library('form_validation');
	   $this->load->library('session');
	   $this->load->model('Admin_Login_model','',TRUE);
	}

	public function index()
	{
		// Load the form validation library
		$this->load->library('form_validation');

		// Set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		// Run validation
		if ($this->form_validation->run() == FALSE) {
			// Validation failed, send error response
			$errors = array();
			if (form_error('username')) {
				$errors['username'] = form_error('username');
			}
			if (form_error('password')) {
				$errors['password'] = form_error('password');
			}

			// Return JSON response
			echo json_encode(array('success' => false, 'errors' => $errors));
			return;
		} else {
			// Get input data
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Call the model's login function
			$result = $this->Admin_Login_model->login($username);

			if ($result) { // If user exists
				// Compare the provided password with the hashed password
				if (password_verify($password, $result->password)) {
					// Password is correct, prepare session data
					$newarray = array(
						'id' => $result->id,
						'name' => $result->name,
						'username' => $result->username,
						'role' => $result->role
					);

					// Set session data
					$this->session->set_userdata('logged_in', $newarray);

					// Return success JSON with redirect URL
					echo json_encode(array('success' => true, 'redirect_url' => base_url('details')));
				} else {
					// Password incorrect, send error response
					echo json_encode(array('success' => false, 'errors' => array('password' => 'Invalid Username or Password')));
				}
			} else {
				// User not found, send error response
				echo json_encode(array('success' => false, 'errors' => array('username' => 'Invalid Username or Password')));
			}
		}
	}

 
}
?>