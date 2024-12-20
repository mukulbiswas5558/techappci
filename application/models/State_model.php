<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_Model {

    public function get_states($search, $start, $length, $order_column, $order_dir)
    {
        // Base query
        $this->db->select('
            id, 
            country_id, 
            name, 
            slug, 
            code, 
            created_at, 
            updated_at, 
            continent_name, 
            country_name, 
            capital, 
            brief_history, 
            formation_date, 
            language, 
            chief_minister, 
            governor, 
            chief_justice, 
            denonyme, 
            area, 
            area_rank, 
            population, 
            population_rank, 
            gdp, 
            gdp_rank, 
            per_capita_income, 
            per_capita_income_rank, 
            literacy, 
            literacy_rank, 
            male_literacy, 
            female_literacy, 
            sex_ratio, 
            sex_ratio_rank, 
            child_sex_ratio, 
            child_sex_ratio_rank, 
            embelam_image, 
            song, 
            bird, 
            fish, 
            flower, 
            fruit, 
            mammal, 
            tree, 
            assembly, 
            high_court, 
            rajya_sava_seat, 
            lok_sava_seat, 
            map_link_url
        ');
        $this->db->from('state');

        // Apply search filter
        if (!empty($search)) {
            $this->db->group_start()
                    ->like('name', $search)
                    ->or_like('capital', $search)
                    ->or_like('continent_name', $search)
                    ->or_like('country_name', $search)
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

    public function get_states_count($search = "")
    {
        $this->db->from('state');

        if (!empty($search)) {
                $this->db->group_start()
                ->like('name', $search)
                ->or_like('capital', $search)
                ->or_like('continent_name', $search)
                ->or_like('country_name', $search)
                ->or_like('language', $search)
                ->or_like('population', $search)
                ->group_end();
        }

        return $this->db->count_all_results();
    }

    public function updateState($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->update('state', $data);
    }

    public function deleteState($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('state');
    }
}
