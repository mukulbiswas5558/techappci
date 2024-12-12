<?php
class Admin_Login_model extends CI_Model
{

    public function login($username)
    {
        // Select all columns from the users table
        $this->db->select('id, name, username, role, password');
        $this->db->from('admin');
        $this->db->where('username', $username);
        $this->db->limit(1); // Limit to 1 result since we expect only 1 user with a given username
    
        $query = $this->db->get();
    
        // Check if there is a user found
        if ($query->num_rows() == 1) {
            return $query->row(); // Return the first row as an object
        } else {
            return null; // Return null if no user found
        }
    }
   
    public function get_user_by_username($username)
    {
        $query = $this->db->get_where('users', ['username' => $username]);
        return $query->row_array(); // Returns user data as an associative array
    }

    /******  650b4058-83e7-4956-8698-1fd76a29f83e  *******/
}
?>