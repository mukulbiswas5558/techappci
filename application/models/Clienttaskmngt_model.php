<?php
class Clienttaskmngt_model extends CI_Model {
    
    public function __construct()
        {
                $this->load->database();
        }

    public function getTaskList($loggedin_Id)
    {
        //$sql = "SELECT u.Name, p.ProjectName, p.create_date, pt.status, p.client_id, p.id as project_id from useracc u, project p, project_task pt where p.client_id='".$loggedin_Id."' AND p.client_id=u.id and pt.project_id = p.id order by p.client_id";
        //$sql = "SELECT u.Name, p.ProjectName, p.create_date, pt.status, p.client_id, p.id as project_id from useracc u, project p LEFT JOIN project_task pt ON pt.project_id = p.id where p.client_id='".$loggedin_Id."' AND p.client_id=u.id and pt.project_id = p.id order by p.client_id";
        $sql = "SELECT u.Name, p.ProjectName, p.create_date, pt.status, p.client_id, p.id as project_id from useracc u, project p LEFT JOIN project_task pt ON pt.category='task' AND pt.project_id = p.id where p.client_id='".$loggedin_Id."' AND p.client_id=u.id order by p.client_id";
        $query = $this -> db -> query($sql);
        $result = $query->result();
        $clients = null;
        if($query -> num_rows() >= 1)
        {
            foreach ($result as $each_task) {
                $clients[$each_task->project_id]['projname'] = $each_task->ProjectName;
                $clients[$each_task->project_id]['createdt'] = $each_task->create_date;

                $status = $each_task->status;

                if (!isset($clients[$each_task->project_id]['ctask'])) $clients[$each_task->project_id]['ctask'] = 0;
                if (!isset($clients[$each_task->project_id]['inctask'])) $clients[$each_task->project_id]['inctask'] = 0;
                if (!isset($clients[$each_task->project_id]['histask'])) $clients[$each_task->project_id]['histask'] = 0;
                if (!isset($clients[$each_task->project_id]['clftask'])) $clients[$each_task->project_id]['clftask'] = 0;
                if (!isset($clients[$each_task->project_id]['rdy4testtask'])) $clients[$each_task->project_id]['rdy4testtask'] = 0;


                if ($status == 'Completed' || $status == 'Approved' || $status == 'Client Approved' || $status == 'Pending with Client') 
                    $clients[$each_task->project_id]['ctask']++;
                if ($status == 'Assigned' || $status == 'Pending' || $status == 'In Progress' || $status == 'Clarification' || $status == 'Ready for test') 
                    $clients[$each_task->project_id]['inctask']++;
                if ($status == 'Rejected' || $status == 'Ready to be invoiced' || $status == 'Recurring Invoicing' || $status == 'Invoiced') 
                    $clients[$each_task->project_id]['histask']++;
                if ($status == 'Clarification') 
                    $clients[$each_task->project_id]['clftask']++;
                if ($status == 'Ready for test') 
                    $clients[$each_task->project_id]['rdy4testtask']++;

            }
            return $clients;
        }
        else
        {
            return false;
        }
    }

    public function getProject($project_id)
    {
        $sql = "SELECT pt.*, ua.Name as Name FROM project pt, useracc ua WHERE pt.id = '".$project_id."' AND pt.client_id=ua.id";
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

    

    public function getCompletedProjectTask($project_id)
    {
        $sql = "SELECT pt.*, u.Name FROM project_task pt LEFT JOIN useracc u ON u.id = pt.associate_id WHERE pt.project_id = '".$project_id."' and pt.status = 'Completed' order by pt.id desc";
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

    public function getIncompletedProjectTask($project_id)
    {
        $sql = "SELECT pt.*, u.Name FROM project_task pt LEFT JOIN useracc u ON u.id = pt.associate_id WHERE pt.project_id = '".$project_id."' and pt.status in ('Pending','Assigned','In Progress','Clarification','Approved') order by pt.id desc";
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

    public function getHistoryProjectTask($project_id)
    {
        $sql = "SELECT pt.*, u.Name FROM project_task pt LEFT JOIN useracc u ON u.id = pt.associate_id WHERE pt.project_id = '".$project_id."' and pt.status in ('Completed','Approved','Rejected','Ready to be invoiced','Recurring Invoicing','Invoiced') order by pt.id desc";
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

    public function getFilteredProjectTask($project_id, $member_string, $status_string, $priority_string, $task_string)
    {
        $sql = "";
        if ($task_string!="") {
            $sql = "SELECT pt.*, u.Name FROM project_task pt LEFT JOIN useracc u ON u.id = pt.associate_id WHERE pt.category='task' AND pt.id = ".$task_string;
        }
        else {
            $sql = "SELECT pt.*, u.Name FROM project_task pt LEFT JOIN useracc u ON u.id = pt.associate_id WHERE pt.category='task' AND pt.project_id = '".$project_id."'";
            if ($status_string!="''")
             $sql .= " and pt.status in (".$status_string.")";

            if ($member_string!="''")
             $sql .= " and pt.associate_id in (".$member_string.")";

            if ($priority_string!="''")
             $sql .= " and pt.priority in (".$priority_string.")";

            $sql .= "  order by pt.id desc";
        }

        //echo $sql;
        $query = $this -> db -> query($sql);
        $result = $query->result();
        $finalresult = array();
        //print_r($result);
        if($query -> num_rows() >= 1)
        {
            foreach ($result as $each_task) {
                $sql1 = "SELECT COUNT(id) as attachment FROM project_task_attachments WHERE task_id = '".$each_task->id."'";
                //echo $sql;
                $query1 = $this -> db -> query($sql1);
                $each_result1 = $query1->result();

                $sql2 = "SELECT COUNT(id) as comment FROM project_task_comments WHERE task_id = '".$each_task->id."'";
                //echo $sql;
                $query2 = $this -> db -> query($sql2);
                $each_result2 = $query2->result();

                $arraymerge = array($each_task, $each_result1[0], $each_result2[0]);
                array_push($finalresult, $arraymerge);
            }
            return $finalresult;
        }
        else
        {
            return false;
        }
    }

    public function getLinkedProjectTask($task_id)
    {
        $sql = "SELECT pt.*, u.Name FROM project_task pt LEFT JOIN useracc u ON u.id = pt.associate_id WHERE pt.category='task' AND pt.id = '".$task_id."'";
        $query = $this -> db -> query($sql);
        $result = $query->result();
        $finalresult = array();
        //print_r($result);
        if($query -> num_rows() >= 1)
        {
            foreach ($result as $each_task) {
                $sql1 = "SELECT COUNT(id) as attachment FROM project_task_attachments WHERE task_id = '".$each_task->id."'";
                //echo $sql;
                $query1 = $this -> db -> query($sql1);
                $each_result1 = $query1->result();

                $sql2 = "SELECT COUNT(id) as comment FROM project_task_comments WHERE task_id = '".$each_task->id."'";
                //echo $sql;
                $query2 = $this -> db -> query($sql2);
                $each_result2 = $query2->result();

                $arraymerge = array($each_task, $each_result1[0], $each_result2[0]);
                array_push($finalresult, $arraymerge);
            }
            return $finalresult;
        }
        else
        {
            return false;
        }
    }

    public function getTaskDetails($task_id)
    {
        $sql = "SELECT pt.*, ua.Name as emp_name FROM project_task pt/*, useracc ua*/ LEFT JOIN useracc ua ON ua.id = pt.associate_id  WHERE pt.id='".$task_id."'";
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

    public function getEmailTaskDetails($task_id)
    {
        $sql = "SELECT pt.*, ua.Name as emp_name, pj.ProjectName as ProjectName, pj.ProjectCode as ProjectCode FROM project_task pt LEFT JOIN useracc ua ON ua.id=pt.associate_id LEFT JOIN project pj ON pj.id=pt.project_id WHERE pt.id='".$task_id."'";
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

    public function getComments($task_id)
    {
        $sql = "SELECT ptc.comments as comments, ptc.filepath as filepath, ptc.original_filename as original_filename, ptc.commenting_date as commenting_date, ptc.user_id as user_id, ua.Name as name FROM project_task_comments ptc, useracc ua  WHERE ptc.task_id='".$task_id."' AND ptc.user_id=ua.id order by ptc.id desc";
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

    public function getTimesheet($task_id)
    {
        $sql = "SELECT * FROM timesheet WHERE Task_id='".$task_id."' AND Working_hours IS NOT NULL AND extra_hours IS NOT NULL";
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

    public function getActivities($task_id)
    {
        $sql = "SELECT tr.updated_on as updated_on, tr.updated_for as updated_for, tr.updated_from as updated_from, tr.updated_to as updated_to, ua.Name as name FROM task_record tr, useracc ua WHERE tr.task_id='".$task_id."' AND tr.updated_by=ua.id ORDER BY tr.id DESC";
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

    public function getAttachments($task_id)
    {
        $sql = "SELECT * FROM project_task_attachments WHERE task_id='".$task_id."' ORDER BY id DESC";
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

    public function getStatusList()
    {
        $sql = "SELECT * FROM contentmgnt WHERE category = 'TASK_STATUS' ORDER BY `order`";
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

    public function getTeam($project_id)
    {
        $sql = "SELECT ua.Name as emp_name, ua.id as emp_id FROM project_team pt, useracc ua  WHERE pt.project_id='".$project_id."' AND pt.members_id=ua.id UNION ALL SELECT ua.Name as emp_name, ua.id as emp_id FROM project pj, useracc ua  WHERE pj.id='".$project_id."' AND pj.client_id=ua.id";
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

    public function getTaskHours($task_id)
    {
        $sql = "SELECT SUM(Working_hours) as Working_hours, SUM(extra_hours) as extra_hours FROM timesheet WHERE Task_id='".$task_id."' AND Working_hours IS NOT NULL AND extra_hours IS NOT NULL";
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

    public function getAssoRate($associate_id)
    {
        $sql = "SELECT hourly_rate, currency FROM useracc WHERE id='".$associate_id."'";
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

    public function getClient($project_id)
    {
        //$sql = "SELECT ua.hourly_rate as hourly_rate, ua.currency as currency FROM project pt, useracc ua WHERE pt.id='".$project_id."' AND pt.client_id=ua.id";
        $sql = "SELECT ua.* FROM project pt, useracc ua WHERE pt.id='".$project_id."' AND pt.client_id=ua.id";
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

    public function update($insertdata) 
    {
        $this->db->where('id', $insertdata['id']);
        $result = $this->db->update('project_task', $insertdata);
        return $result;
    }

    public function commenting($insertdata) 
    {
        $result = $this->db->insert('project_task_comments', $insertdata);
        $date = date('d/m/Y h:i:s a', time());
        $loggedIn_id = $this->session->userdata['logged_in']['id'];
        $taskrecordtdata = array(
              'task_id' => $insertdata['task_id'],
              'updated_by' => $loggedIn_id,
              'updated_on' => $date,
              'updated_for' => "Commented"
        );
        $this->db->insert('task_record', $taskrecordtdata);
        return $result;
    }

    public function comment_attach_file_upload($data)
    {
        $this->db->where('id', $data['id']);
        $result = $this->db->update('project_task_comments', $data);
        return $result;
    }

    public function file_upload($data)
    {
        $result = $this->db->insert('project_task_attachments', $data);
        $date = date('d/m/Y h:i:s a', time());
        $loggedIn_id = $this->session->userdata['logged_in']['id'];
        $taskrecordtdata = array(
              'task_id' => $data['task_id'],
              'updated_by' => $loggedIn_id,
              'updated_on' => $date,
              'updated_for' => "Attached"
        );
        $this->db->insert('task_record', $taskrecordtdata);
        return $this->db->insert_id();
    }

    public function deleteAttachFile($filepath, $type) 
    {
        $result = "";
        $this->db->where('filepath', $filepath);
        if($type=="task")
            $result = $this->db->delete('project_task_attachments');
        elseif($type=="comment") {
            $data = array(
                      'filepath' => '',
                      'original_filename' => ''
                ); 
            $result = $this->db->update('project_task_comments', $data);
        }
        return $result;
    }

    public function extrahours($formdata)
    {
        if(is_array($formdata['date_of_job[]'])) {
            foreach ($formdata['date_of_job[]'] as $key => $value) {
                $insertdata = array();
                if($formdata['extra_hours[]'][$key] != "") {
                    $insertdata = array(
                          'Date_of_job' => $value,
                          'extra_hours' => $formdata['extra_hours[]'][$key],
                          'Task_id' => $formdata['extrahours_task_id']
                    ); 
                }
                else {
                    $insertdata = array(
                          'Date_of_job' => $value,
                          'extra_hours' => NULL,
                          'Task_id' => $formdata['extrahours_task_id']
                    ); 
                }
                //print_r($insertdata);
                $this->db->where('Task_id', $insertdata['Task_id']);
                $this->db->where('Date_of_job', $insertdata['Date_of_job']);
                $result = $this->db->update('timesheet', $insertdata);
                return $result;
            }
        }
        else {
            $insertdata = array();
            if($formdata['extra_hours[]'] != "") {
                $insertdata = array(
                      'Date_of_job' => $formdata['date_of_job[]'],
                      'extra_hours' => $formdata['extra_hours[]'],
                      'Task_id' => $formdata['extrahours_task_id']
                );
            }
            else {
                $insertdata = array(
                      'Date_of_job' => $formdata['date_of_job[]'],
                      'extra_hours' => NULL,
                      'Task_id' => $formdata['extrahours_task_id']
                ); 
            }
            $this->db->where('Task_id', $insertdata['Task_id']);
            $this->db->where('Date_of_job', $insertdata['Date_of_job']);
            $result = $this->db->update('timesheet', $insertdata);
            return $result;
        }
    }

    public function getPrevAssignee($prev_assignee)
    {
        $sql = "SELECT * FROM useracc WHERE id='".$prev_assignee."'";
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

    public function getPresentAssignee($present_assignee)
    {
        $sql = "SELECT * FROM useracc WHERE id='".$present_assignee."'";
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

    public function getRecordInfo($task_id)
    {
        $sql = "SELECT * FROM `task_record` WHERE `task_id` = '".$task_id."' AND `updated_for`='Assignee' ORDER BY `updated_on` DESC";
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

    public function taskrecord($taskrecordtdata)
    {
        $result = $this->db->insert('task_record', $taskrecordtdata);
        return $result;
    }

    public function delete($id) 
    {
        $this->db->where('id', $id);
        $result = $this->db->delete('useracc');
        return $result;
    }

    /*public function record_count() 
    {
        return $this->db->count_all('product');
    }

    public function get_contents($limit, $start) {
        //$this->db->select('id','proname','price');
        //$this->db->from('product');
        $offset = ($start-1)*$limit;
        $this->db->limit($limit);
        //$this->db->where('id', $start);
        //$query = $this->db->get('product');
        $query = $this->db->get('product', $limit, $offset);
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }*/
}
