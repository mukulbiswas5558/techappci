<?php
class Details_model extends CI_Model {
    
    public function __construct()
        {
                $this->load->database();
        }

   

    public function getTaskDetails($task_id)
    {
        $sql = "SELECT * FROM project_task  WHERE id='".$task_id."'";
        $query = $this -> db -> query($sql);
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

  

  
    public function projectassigned($insertdata) 
    {
        $this->db->where('id', $insertdata['id']);
        $result = $this->db->update('project_task', $insertdata);
        return $result;
    }

   
    public function commenting($insertdata) 
    {
        $result = $this->db->insert('project_task_comments', $insertdata);
        return $this->db->insert_id();
    }

    public function comment_attach_file_upload($data)
    {
        $this->db->where('id', $data['id']);
        $result = $this->db->update('project_task_comments', $data);
        return $result;
    }

   


    public function deletetaskrow($task_id, $Date_of_job)
    {
        $this->db->where('Task_id', $task_id);
        $this->db->where('Date_of_job', $Date_of_job);
        $result = $this->db->delete('timesheet');
        return $result;
    }
   
}
