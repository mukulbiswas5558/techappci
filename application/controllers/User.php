<?php
class User extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("User_model");

	}

	function getUser($user_id)
	{
		
		$data = $this->User_model->getUser($user_id);

		// Check if user data is found
		if ($data) {
			$response = [
				'success' => true,
				'data' => $data
			];
		} else {
			$response = [
				'success' => false,
				'data' => null // Set data to null if no user is found
			];
		}

		// Output the response with JSON_PRETTY_PRINT for readability
		echo json_encode($response, JSON_PRETTY_PRINT);


	}
	function getUsers()
	{
		
		$data = $this->User_model->getAllUsers();
		if ($data) {
			$response = [
				'success' => true,
				'data' => $data
			];
		} else {
			$response = [
				'success' => false,
				'data' => $data
			];
		}
		
		// Output the response with JSON_PRETTY_PRINT
		echo json_encode($response, JSON_PRETTY_PRINT);


	}
	function profile()
	{

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['role'] == "admin") {


				$this->load->view("header_view");
				$this->load->view("profile_view");
				$this->load->view("footer_view");
			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}


	}
	public function logout()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['role'] == "admin") {
				// Removing session data
				$sess_array = array(
					'id' => '',
					'name' => '',
					'username' => '',
					'role' => '',
					'status' => ''
				);
				$this->session->unset_userdata('logged_in', $sess_array);
				
				redirect('login');
			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}

	}
	

}
?>