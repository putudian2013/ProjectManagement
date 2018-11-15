<?php

    class TaskHistoryModel extends CI_Model{
                                
        
        function getAllTaskHistory($taskID){
            $result = $this->db->query("select * from task_history where task_id = '".$taskID."'");
            return $result;
        }               
        
        function insertAddTaskHistory($taskID){ 
            
            $data = array(
                'action' => 'Add',
                'detail' => 'Added New Task',
                'task_id' => $taskID
            );
            
            $this->db->insert('task_history',$data);            
        }
        
        function insertEditTaskHistory($dataOld, $dataNew, $taskID){
            
            foreach ($dataOld->result() as $rowOld) {
                
                switch ($rowOld->task_status) {
                    case 0:
                        $statusOld = 'New';
                        break;
                    case 1:
                        $statusOld = 'In Progress';
                        break;
                    case 2:
                        $statusOld = 'Done';
                        break;
                    case 3:
                        $statusOld = 'Canceled'; 
                        break;
                    default:
                        break;
                }                                
                
                $employeeOld = $this->EmployeeModel->getEmployee($rowOld->pic);                
                
                foreach ($employeeOld->result() as $rowEmployeeOld) {
                    $employeeNameOld = $rowEmployeeOld->employee_name;                    
                }                
                
                $detailOld = "Task Updated from : <br /> <br />
                    Task Name : " . $rowOld->task_name . " <br />
                    Due Date : " . $rowOld->due_date . " <br />
                    Status : " . $statusOld . " <br />
                    PIC : " . $employeeNameOld . " <br />
                    Task Detail : " . $rowOld->task_detail . " <br /><br />";
                                                               
            }
            
            foreach ($dataNew->result() as $rowNew) {                                
                
                switch ($rowNew->task_status) {
                    case 0:
                        $statusNew = 'New';
                        break;
                    case 1:
                        $statusNew = 'In Progress';
                        break;
                    case 2:
                        $statusNew = 'Done';
                        break;
                    case 3:
                        $statusNew = 'Canceled'; 
                        break;
                    default:
                        break;
                }
                
                $employeeNew = $this->EmployeeModel->getEmployee($rowNew->pic);
                                
                foreach ($employeeNew->result() as $rowEmployeeNew) {
                    $employeeNameNew = $rowEmployeeName->employee_name;                    
                }
                                
                
                $detailNew = " to : <br /> <br />
                    Task Name : " . $rowNew->task_name . " <br />
                    Due Date : " . $rowNew->due_date . " <br />
                    Status : " . $statusNew . " <br />
                    PIC : " . $employeeNameNew . " <br />
                    Task Detail : " . $rowNew->task_detail . " <br /><br />";                               
            }
            
            $data = array(
                'action' => 'Edit',
                'detail' => $detailOld . $detailNew,
                'task_id' => $taskID
            );

            $this->db->insert('task_history',$data); 
            
        }
//        
//        function updateTaskComment($data,$where){
//            
//            $this->db->where('task_comment_id', $where);
//            $this->db->update('task_comment',$data);            
//        }
//        
//        function deleteTaskComment($taskCommentID){
//            $this->db->where('task_comment_id', $taskCommentID);
//            $this->db->delete('task_comment');            
//        }
        
        
    }
