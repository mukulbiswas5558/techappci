<?php
class Login_model extends CI_Model
{

    function loginuser($username)
    {
        // Select all columns from the users table
        $this->db->select('name, username, role');
        $this->db->from('users');
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
    public function createUser($data)
    {
        // Attempt to insert the data into the table
        if ($this->db->insert('users', $data)) {
            // Return the insert ID on success
            return $this->db->insert_id();
        }

        // Return false if the insert failed
        return false;
    }
    public function get_user_by_username($username)
    {
        $query = $this->db->get_where('users', ['username' => $username]);
        return $query->row_array(); // Returns user data as an associative array
    }

    /******  650b4058-83e7-4956-8698-1fd76a29f83e  *******/
}
?>