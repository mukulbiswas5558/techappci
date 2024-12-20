<?php
class State extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper("auth");

		$this->load->library(array('session'));
		$this->load->model('State_model');

		$this->load->model("details_model");
		check_admin_auth();

	}



	public function state()
	{
		

		$this->load->view("header_view");
		$this->load->view("state_view");
		$this->load->view("footer_view");
				
			
	}

	public function fetch_states()
	{
		
		$request = $this->input->post();

		// Get DataTable parameters
		$search = $request['search']['value'] ?? '';
		$start = $request['start'] ?? 0;
		$length = $request['length'] ?? 10;
		$order_column_index = $request['order'][0]['column'] ?? 0;
		$order_dir = $request['order'][0]['dir'] ?? 'asc';

		// Define columns
		$columns = [
			'id',
			'country_id',
			'name',
			'slug',
			'code',
			'created_at',
			'updated_at',
			'continent_name',
			'country_name',
			'capital',
			'brief_history',
			'formation_date',
			'language',
			'chief_minister',
			'governor',
			'chief_justice',
			'denonyme',
			'area',
			'area_rank',
			'population',
			'population_rank',
			'gdp',
			'gdp_rank',
			'per_capita_income',
			'per_capita_income_rank',
			'literacy',
			'literacy_rank',
			'male_literacy',
			'female_literacy',
			'sex_ratio',
			'sex_ratio_rank',
			'child_sex_ratio',
			'child_sex_ratio_rank',
			'embelam_image',
			'song',
			'bird',
			'fish',
			'flower',
			'fruit',
			'mammal',
			'tree',
			'assembly',
			'high_court',
			'rajya_sava_seat',
			'lok_sava_seat',
			'map_link_url'
		];

		// Get the column to order by (default to 'id' if invalid index)
		$order_column = $columns[$order_column_index] ?? 'id';

		// Fetch data and total counts
		$data = $this->State_model->get_states($search, $start, $length, $order_column, $order_dir);
		$total_records = $this->State_model->get_states_count();
		$filtered_records = $this->State_model->get_states_count($search);

		// Prepare JSON response
		$response = [
			'draw' => $request['draw'] ?? 1,
			'recordsTotal' => $total_records,
			'recordsFiltered' => $filtered_records,
			'data' => $data
		];

		echo json_encode($response);

			
	}


	public function update_state()
	{
		
		$data = $this->input->post();
		$result = $this->State_model->updateState($data);
		echo json_encode(['success' => $result]);
			
	}

	public function delete_state($id)
	{

		
		$result = $this->State_model->deleteState($id);
		echo json_encode(['success' => $result]);

			
	}


}
?>