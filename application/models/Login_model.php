<?php
Class Login_model extends CI_Model
{
  function login($username)
  {
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('username', $username);
      $this->db->limit(1);
  
      $query = $this->db->get();
  
      if ($query->num_rows() >= 1) {
          return $query->result();
      } else {
          return false;
      }
  }


  public function getDetails($loggedIn_id) 
  {
      $this->db->select("*");
      $this->db->from('users');
      $this -> db -> where('id', $loggedIn_id);
      $query = $this -> db -> get();
      $result = $query->result();
      if($query -> num_rows() >= 1)
      {
          return $result;
      }
      else
      {
          return false;
      }

  }

/*************  ✨ Codeium Command 🌟  *************/
  /**
   * Update the last login details for a user.
   *
   * @param array $last_login_data Array of data to update, containing the user ID and last login timestamp.
   * @return bool True if the update was successful, false otherwise.
   */
  public function lastLoginSet($last_login_data)
  {
      // Update the last login timestamp for the specified user ID
      $this->db->where('id', $last_login_data['id']);
      $result = $this->db->update('users', $last_login_data);
      return $result;
  }
/******  650b4058-83e7-4956-8698-1fd76a29f83e  *******/
}
?>