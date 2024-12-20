<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends CI_Model {

    public function get_countries($search, $start, $length, $order_column, $order_dir)
    {
        // Base query
        $this->db->select('
            id, 
            id_country, 
            country_name, 
            initial, 
            flag, 
            continent_name, 
            major_cities, 
            capital, 
            location, 
            border_shared, 
            area, 
            climate, 
            topography, 
            population, 
            ethnic_groups, 
            language, 
            religions, 
            government_type, 
            prime_minister, 
            president, 
            vice_president, 
            administrative_division, 
            currency, 
            gdp, 
            gdp_per_capita, 
            major_industry, 
            exports, 
            imports, 
            brief_history, 
            key_historical_events, 
            tourist_stat, 
            education_system, 
            literacy_rate, 
            healthcare_system, 
            life_expectancy, 
            holidays, 
            cuisine, 
            sports, 
            major_attractions, 
            independance_date, 
            denonym, 
            area_rank, 
            population_rank, 
            gdp_rank, 
            literacy_rate_rank, 
            male_literacy, 
            female_literacy, 
            sex_ratio, 
            sex_rank, 
            child_sex_ratio, 
            child_sex_rank, 
            embelam_image_url, 
            song, 
            bird, 
            fish, 
            flower, 
            fruit, 
            mammal, 
            tree, 
            map_link_url, 
            chief_justice, 
            latitude, 
            longitude, 
            created_at, 
            updated_at
        ');
        $this->db->from('country');

        // Apply search filter
        if (!empty($search)) {
            $this->db->group_start()
                    ->like('country_name', $search)
                    ->or_like('currency', $search)
                    ->or_like('capital', $search)
                    ->or_like('continent_name', $search)
                    ->or_like('language', $search)
                    ->or_like('population', $search)
                    ->group_end();
        }

        // Ordering
        if (!empty($order_column)) {
            $this->db->order_by($order_column, $order_dir);
        }

        // Limit and offset for pagination
        $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_countries_count($search = "")
    {
        $this->db->from('country');

        if (!empty($search)) {
            $this->db->group_start()
                     ->like('name', $search)
                     ->or_like('flag', $search)
                     ->or_like('capital', $search)
                     ->or_like('iso', $search)
                     ->or_like('currency', $search)
                     ->or_like('flag', $search)

                     ->group_end();
        }

        return $this->db->count_all_results();
    }

    public function updateCountry($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update('country', $data);
    }

    public function deleteCountry($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('country');
    }
}
