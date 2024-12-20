<?php
class Details extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper("auth");

		$this->load->library(array('session'));
		$this->load->model("details_model");
		check_admin_auth();
	}

	function index()
	{

		$this->load->view("header_view");
		$this->load->view("admin_view");
		$this->load->view("footer_view");
		
	}
	function profile()
	{

		$this->load->view("header_view");
		$this->load->view("profile_view");
		$this->load->view("footer_view");
			
	}
	public function logout()
	{
		
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
			

	}
	


}
?>