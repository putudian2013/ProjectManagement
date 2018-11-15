<?php

    class TaskFileModel extends CI_Model{
                                
        
        function getAllTaskFile($taskID){
            $result = $this->db->query("select * from task_file where task_id = '".$taskID."'");
            return $result;
        }               
               
        function deleteTaskFile($taskFileID){
            $this->db->where('task_file_id', $taskFileID);
            $this->db->delete('task_file');            
        }
        
        function uploadTaskFile($data){                        
            $this->db->insert('task_file',$data);            
        }
        
        
    }
