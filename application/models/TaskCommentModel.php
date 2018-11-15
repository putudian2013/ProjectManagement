<?php

    class TaskCommentModel extends CI_Model{
                                
        
        function getAllTaskComment($taskID){
            $result = $this->db->query("SELECT * FROM task_comment WHERE task_id = '".$taskID."'");
            return $result;
        }               
        
        function insertTaskComment($data){                        
            $this->db->insert('task_comment',$data);            
        }
        
        function updateTaskComment($data,$where){
            
            $this->db->where('task_comment_id', $where);
            $this->db->update('task_comment',$data);            
        }
        
        function deleteTaskComment($taskCommentID){
            $this->db->where('task_comment_id', $taskCommentID);
            $this->db->delete('task_comment');            
        }
        
        
    }
