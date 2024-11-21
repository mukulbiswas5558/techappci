<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller 
{
 
	function __construct()
	{
	   parent::__construct();
	   $this->load->helper('form');
	   $this->load->library('form_validation');
	   $this->load->library('session');
	   $this->load->model('login_model','',TRUE);
	   $this->load->library('table');
	}

	function index()
	{
		// Load form validation library

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
			$result = $this->login_model->login($username);

			if ($result) { // If user exists
				// Compare the provided password with the hashed password
				if (password_verify($password, $result[0]->password)) {
					// Password is correct, prepare session data
					$newarray = array(
						'id' => $result[0]->id,
						'name' => $result[0]->Name,
						'username' => $result[0]->UserName,
						'acct_type' => $result[0]->Account_For,
						'status' => $result[0]->Status
					);

					// Set session data
					$this->session->set_userdata('logged_in', $newarray);

					// Log the login time
					$logintime = date('Y-m-d H:i:s');
					$last_login_data = array(
						'id' => $result[0]->id,
						'last_login' => $logintime
					);
					$this->login_model->lastLoginSet($last_login_data);

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

 

	public function logout() 
	{

		// Removing session data
		$sess_array = array('id' => '',
							'name' => '',   
							'username' => '',
							'acct_type' => '',
							'asso_type' => '',
							'currency' => '',
							'status' => '');
		$this->session->unset_userdata('logged_in', $sess_array);

		$sess_array2 = array('member' => '',
							'priority' => '',
							'status' => '',
							'task' => '');
		$this->session->unset_userdata('filtered_value', $sess_array2);
		$data = array('success_message' => 'Successfully Log Out');
		$this->load->view('login_view', $data);
		
	}
 
}
?>