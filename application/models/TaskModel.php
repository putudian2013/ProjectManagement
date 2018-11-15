<?php

    class TaskModel extends CI_Model{
                                
        
        function getTaskDueToday(){
            $result = $this->db->query("select * from task t 
                                    inner join project p on t.project_id = p.project_id
                                    where t.task_status in ('0','1') and t.due_date = date_format(now(), '%Y-%m-%d')");
            return $result;
        }
        
        function getTaskDueTomorrow(){
            $result = $this->db->query("select * from task t 
                                    inner join project p on t.project_id = p.project_id
                                    where t.task_status in ('0','1') and t.due_date = date_format(now() + INTERVAL 1 DAY, '%Y-%m-%d')");
            return $result;
        }
        
        function getOutstandingTask(){
            $result = $this->db->query("select * from task t 
                                    inner join project p on t.project_id = p.project_id
                                    where t.task_status in ('0','1') and t.due_date < date_format(now(), '%Y-%m-%d')");
            return $result;
        }
        
        function getTaskFinish(){
            $result = $this->db->query("select * from task where task_status in ('2','3')");
            return $result;                                    
        }
        
        function getTaskOnGoing(){
            $result = $this->db->query("select * from task where task_status in ('0','1')");
            return $result;                                    
        }
        
        function getProjectTask($projectID){
            $result = $this->db->query("select t.*, e.`employee_name` as 'emp_pic',
                                    (SELECT COUNT(sub_task_id) FROM sub_task WHERE task_id = t.task_id) AS 'sub_task'
                                    from task t
                                    inner join employee e on t.`pic` = e.`employee_id`                                                    
                                    where project_id = ".$projectID."
                                    order by t.task_status asc, t.task_code asc");
            
            return $result;
        }
        
        function getProjectTaskNew($projectID){
            $result = $this->db->query("select * from task where project_id = '".$projectID."' and task_status = 0");            
            return $result;
        }
        
        function getProjectTaskInProgress($projectID){
            $result = $this->db->query("select * from task where project_id = '".$projectID."' and task_status = 1");            
            return $result;
        }
        
        function getProjectTaskDone($projectID){
            $result = $this->db->query("select * from task where project_id = '".$projectID."' and task_status = 2");            
            return $result;
        }
        
        function getProjectTaskCanceled($projectID){
            $result = $this->db->query("select * from task where project_id = '".$projectID."' and task_status = 3");            
            return $result;
        }
        
        function getTask($taskID){
            $result = $this->db->query("SELECT * FROM task t where t.task_id ='$taskID'");
            return $result;
        }        
        
        function getAllTask(){
            $result = $this->db->query("select task.*, project.project_color from task 
                inner join project on task.project_id = project.project_id");
            return $result;
        }
        
        
        
    }
