<?php
class Country extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper("auth");
		$this->load->library(array('session'));
		$this->load->model('Country_model');
		check_admin_auth();

	}
	public function country()
	{
		
		$this->load->view("header_view");
		$this->load->view("country_view");
		$this->load->view("footer_view");
		
		
	}

	public function fetch_countries()
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
			'id', 'id_country', 'country_name', 'initial', 'flag', 'continent_name', 
			'major_cities', 'capital', 'location', 'border_shared', 'area', 'climate', 
			'topography', 'population', 'ethnic_groups', 'language', 'religions', 
			'government_type', 'prime_minister', 'president', 'vice_president', 
			'administrative_division', 'currency', 'gdp', 'gdp_per_capita', 
			'major_industry', 'exports', 'imports', 'brief_history', 
			'key_historical_events', 'tourist_stat', 'education_system', 'literacy_rate', 
			'healthcare_system', 'life_expectancy', 'holidays', 'cuisine', 'sports', 
			'major_attractions', 'independance_date', 'denonym', 'area_rank', 
			'population_rank', 'gdp_rank', 'literacy_rate_rank', 'male_literacy', 
			'female_literacy', 'sex_ratio', 'sex_rank', 'child_sex_ratio', 
			'child_sex_rank', 'embelam_image_url', 'song', 'bird', 'fish', 'flower', 
			'fruit', 'mammal', 'tree', 'map_link_url', 'chief_justice', 'latitude', 
			'longitude', 'created_at', 'updated_at'
		];
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