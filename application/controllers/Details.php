<?php
class Details extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library(array('session'));
		$this->load->model('Country_model');

		$this->load->model("details_model");
	}

	function index()
	{

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['role'] == "admin") {

				$this->load->view("header_view");
				$this->load->view("admin_view");
				$this->load->view("footer_view");
				//$this->load->view("admintasklist_temp_view", $data);
			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}


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
	public function country()
	{
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['role'] == "admin") {

				$this->load->view("header_view");
				$this->load->view("country_view");
				$this->load->view("footer_view");
				//$this->load->view("admintasklist_temp_view", $data);
			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}
	}

	public function fetch_countries()
	{

		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata['logged_in']['role'] == "admin") {
				$request = $this->input->post();

				// Get DataTable parameters
				$search = $request['search']['value'] ?? '';
				$start = $request['start'] ?? 0;
				$length = $request['length'] ?? 10;
				$order_column_index = $request['order'][0]['column'] ?? 0;
				$order_dir = $request['order'][0]['dir'] ?? 'asc';

				// Define columns
				$columns = ['id', 'iso', 'name', 'nicename', 'iso3', 'numcode', 'phonecode', 'capital'];
				$order_column = $columns[$order_column_index] ?? 'id';

				// Fetch data and total counts
				$data = $this->Country_model->get_countries($search, $start, $length, $order_column, $order_dir);
				$total_records = $this->Country_model->get_countries_count();
				$filtered_records = $this->Country_model->get_countries_count($search);

				// Prepare JSON response
				$response = [
					'draw' => $request['draw'] ?? 1,
					'recordsTotal' => $total_records,
					'recordsFiltered' => $filtered_records,
					'data' => $data
				];

				echo json_encode($response);

			} else {
				header("location: login");


			}

		} else {
			header("location: login");
		}
	}


	public function update()
    {
        $data = $this->input->post();
        $result = $this->Country_model->updateCountry($data);
        echo json_encode(['success' => $result]);
    }

    public function delete_country($id)
    {
        $result = $this->Country_model->deleteCountry($id);
        echo json_encode(['success' => $result]);
    }


}
?>