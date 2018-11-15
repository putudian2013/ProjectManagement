<?php

    class ProjectModel extends CI_Model{
                                
        function getAllProject(){                                    
            $result = $this->db->query("SELECT
                p.*, employee.*,
                (SELECT COUNT(task_id) FROM task t WHERE t.project_id = p.`project_id`) AS 'total_task',
                (SELECT COUNT(task_id) FROM task t WHERE t.project_id = p.`project_id` AND t.task_status IN ('2','3')) AS 'total_finish',
                (SELECT COUNT(task_id) FROM task t WHERE t.project_id = p.`project_id` AND t.task_status IN ('0','1')) AS 'total_in_progress'                
                FROM project p
                inner join employee on p.project_owner = employee.employee_id
                order by p.project_id");
            return $result;            
        }
        
        function getProjectFinish(){                        
            $result = $this->db->query("select * from project where project_status in ('2','3')");            
            return $result;                                    
        }
        
        function getProjectOnGoing(){
            $result = $this->db->query("select * from project where project_status in ('0','1')");
            return $result;                                    
        }
        
        function getProject($projectID){
            $result = $this->db->query("SELECT * FROM project p where p.project_id ='$projectID'");
            return $result;
        } 
        
//        function insertCompany($companyName){
//            
//            $sql = "INSERT INTO hr_company VALUES (NULL, '".$companyName."')";
//            $this->db->query($sql);
//            
//        }
//        
//        function getCompany($companyID){
//            $result = $this->db->query("SELECT * FROM hr_company hc where hc.company_id ='$companyID'");
//            return $result;
//	}
//        
//        function updateCompany($companyID,$companyName){
//            $sql = "UPDATE hr_company SET company_name = '".$companyName."' where company_id = '".$companyID."'";
//            $this->db->query($sql);
//        }
//        
//        function deleteCompany($companyID){
//            $sql = "DELETE FROM hr_company where company_id = '".$companyID."'";
//            $this->db->query($sql);
//        }
        
    }
