<?php

    class SubTaskModel extends CI_Model{
                                
        
        function getAllSubTask($taskID){
            $result = $this->db->query("SELECT st.*, e.`employee_name` AS 'emp_pic' FROM sub_task st
                                INNER JOIN employee e ON st.`pic` = e.`employee_id`
                                WHERE task_id = ".$taskID."
                                ORDER BY st.sub_task_code");
            return $result;
        }               
        
        function insertSubTask($data){                        
            $this->db->insert('sub_task',$data);            
        }
        
        function updateSubTask($data,$where){
            
            $this->db->where('sub_task_id', $where);
            $this->db->update('sub_task',$data);            
        }
        
        function deleteSubTask($subTaskID){
            $this->db->where('sub_task_id', $subTaskID);
            $this->db->delete('sub_task');            
        }
        
        
    }
