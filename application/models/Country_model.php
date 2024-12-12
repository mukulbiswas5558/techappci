<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends CI_Model {

    public function get_countries($search, $start, $length, $order_column, $order_dir)
    {
        // Base query
        $this->db->select('id, iso, name, nicename, iso3, numcode, phonecode,capital');
        $this->db->from('country');

        // Apply search filter
        if (!empty($search)) {
            $this->db->group_start()
                     ->like('name', $search)
                     ->or_like('nicename', $search)
                     ->or_like('capital', $search)
                     ->or_like('iso', $search)
                     ->or_like('iso3', $search)
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
                     ->or_like('nicename', $search)
                     ->or_like('capital', $search)
                     ->or_like('iso', $search)
                     ->or_like('iso3', $search)
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
