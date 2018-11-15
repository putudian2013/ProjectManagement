<?php

    class EmployeeModel extends CI_Model{
                                
        
        function getAllEmployee(){            
                        
            $result = $this->db->query('SELECT * FROM employee e');
            return $result;
            
        }
        
        function getEmployeeByName($employeeName){            
                        
            $result = $this->db->query('SELECT * FROM employee e where employee_name = "'.$employeeName.'"');
            return $result;
            
        }
        
        function getEmployee($employeeID){            
                        
            $result = $this->db->query('SELECT * FROM employee e where employee_id = "'.$employeeID.'"');
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
