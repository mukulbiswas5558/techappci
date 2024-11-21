<?php
Class Login_model extends CI_Model
{
  function login($username)
  {
      $this->db->select('*');
      $this->db->from('useracc');
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
      $this->db->from('useracc');
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

  public function lastLoginSet($last_login_data)
  {
      $this->db->where('id', $last_login_data['id']);
      $result = $this->db->update('useracc', $last_login_data);
      return $result;
  }
}
?>