<?php

    class Task extends CI_Controller{
        
        function __construct() {
            parent::__construct();
            $this->load->model('TaskModel');
            $this->load->model('EmployeeModel');
            $this->load->model('TaskModel');
            $this->load->model('SubTaskModel');            
            $this->load->model('TaskCommentModel');            
            $this->load->model('TaskFileModel');            
            $this->load->model('TaskHistoryModel');            
            $this->load->model('ProjectModel');            
        }
        
        function board($projectID){
            $data['projectID'] = $projectID;
            $data['taskNew'] = $this->TaskModel->getProjectTaskNew($projectID);
            $data['taskInProgress'] = $this->TaskModel->getProjectTaskInProgress($projectID);
            $data['taskDone'] = $this->TaskModel->getProjectTaskDone($projectID);
            $data['taskCanceled'] = $this->TaskModel->getProjectTaskCanceled($projectID);
            $data['employee'] = $this->EmployeeModel->getAllEmployee();
            $this->load->view('task-board',$data);
        }                
        
        function update($source){                        
            
            $taskID = $this->input->post('taskID');
            $projectID = $this->input->post('projectID');
            
            $dataOld = $this->TaskModel->getTask($taskID);
            
            $taskCode = $this->input->post('taskCode');            
            $taskName = $this->input->post('taskName');
            $dueDate = $this->input->post('dueDate');
            $status = $this->input->post('status');
            $pic = $this->input->post('pic');
            $taskDetail = $this->input->post('taskDetail');
            
            $data = array(
                'task_code' => $taskCode,
                'task_name' => $taskName,
                'due_date' => $dueDate,
                'task_status' => $status,
                'pic' => $pic,                
                'task_detail' => $taskDetail                
            );
            
            $this->db->where('task_id', $taskID);
            $this->db->update('task', $data);
            
            $dataNew = $this->TaskModel->getTask($taskID);
            
            $this->TaskHistoryModel->insertEditTaskHistory($dataOld, $dataNew, $taskID);
            
            switch ($source) {
                case "table":
                    redirect('project/task/'.$projectID);
                    break;
                case "board":                    
                    redirect('task/board/'.$projectID);
                    break;
                case "calendar":                    
                    redirect('calendar');
                    break;
                default:
                    break;
            }
            
        }
        
        function updateTaskStatusOnly($taskID,$sortable){    
            
            $dataOld = $this->TaskModel->getTask($taskID);
            
            switch ($sortable) {
                case "sortableNew" :
                    $status = 0;
                    break;
                case "sortableInProgress" :
                    $status = 1;
                    break;
                case "sortableDone" :
                    $status = 2;
                    break;
                case "sortableCancel" :
                    $status = 3;
                    break;                
                default:
                    break;
            }
            
            $data = array(
                'task_status' => $status,       
                'created_date' => 'created_date'
            );                        
            
            $this->db->where('task_id', $taskID);            
            $this->db->update('task', $data); 
            
            $dataNew = $this->TaskModel->getTask($taskID);
            $this->TaskHistoryModel->insertEditTaskHistory($dataOld, $dataNew, $taskID);
        }
        
        function updateTaskDueDateOnly(){    
            
            $dataOld = $this->TaskModel->getTask($taskID); 
            
            
            $id = $this->input->post('id');
            $due = $this->input->post('due');
            $taskID = explode("-", $id)[0];
            
            $data = array(
                'due_date' => $due,       
                'created_date' => 'created_date'
            );                        
            
            $this->db->where('task_id', $taskID);            
            $this->db->update('task', $data); 
            
            $dataNew = $this->TaskModel->getTask($taskID);
            $this->TaskHistoryModel->insertEditTaskHistory($dataOld, $dataNew, $taskID);
        }
                
        function subTask($taskID,$projectID){
            $data["taskID"] = $taskID;
            $data["projectID"] = $projectID;
            $data['task'] = $this->TaskModel->getTask($taskID);
            $data['subTask'] = $this->SubTaskModel->getAllSubTask($taskID);
            $data['employee'] = $this->EmployeeModel->getAllEmployee();
            $this->load->view('sub-task',$data);
        }
        
        function comment($taskID,$projectID){
            $data["taskID"] = $taskID;
            $data["projectID"] = $projectID;
            $data['task'] = $this->TaskModel->getTask($taskID);
            $data['taskComment'] = $this->TaskCommentModel->getAllTaskComment($taskID);
            $data['employee'] = $this->EmployeeModel->getAllEmployee();
            $this->load->view('task-comment',$data);
        }
        
        function uploadFile() {
            $taskID = $this->input->post('id');
            $data["taskFile"] = $this->TaskFileModel->getAllTaskFile($taskID);
            return $this->load->view('helper/upload-task-file',$data);
        }
        
        function history() {
            $taskID = $this->input->post('id');
            $data["taskHistory"] = $this->TaskHistoryModel->getAllTaskHistory($taskID);
            return $this->load->view('helper/task-history',$data);
        }
        
        function save(){
                        
            $projectID = $this->input->post('projectID');
            
            $taskCode = $this->generateTaskCode($projectID);
            $taskName = $this->input->post('taskName');
            $dueDate = $this->input->post('dueDate');
            $status = $this->input->post('status');
            $pic = $this->input->post('pic');
            $taskDetail = $this->input->post('taskDetail');
            
            $data = array(
                'task_code' => $taskCode,
                'task_name' => $taskName,
                'due_date' => $dueDate,
                'task_status' => $status,
                'pic' => $pic,                
                'task_detail' => $taskDetail,
                'project_id' => $projectID
            );
                        
            $this->db->insert('task',$data);
            
            $lastID = $this->db->insert_id();                                                
            $this->TaskHistoryModel->insertAddTaskHistory($lastID);
            
            redirect('project/task/'.$projectID);
            
        }
        
        function delete(){
            
            $projectID = $this->input->post('projectID');
            
            $taskID = $this->input->post('taskID');
            $this->db->where('task_id', $taskID);
            $this->db->delete('task');
            
             redirect('project/task/'.$projectID);
        }
        
        
        
        function generateTaskCode($projectID){                       
            
            $project = $this->ProjectModel->getProject($projectID);
            $task = $this->TaskModel->getProjectTask($projectID);
            
            foreach ($project->result() as $row) {
                $projectCode = $row->project_code;
            }                        
            
            $num_length = strlen((string)$task->num_rows() + 1);            
            switch ($num_length) {
                case 1:
                    $taskCount = "00" . ($task->num_rows() + 1);                    
                    break;
                case 2:
                    $taskCount = "0" . ($task->num_rows() + 1);
                    echo $taskCount;
                    break;
                case 3:
                    $taskCount = "" . ($task->num_rows() + 1);
                    echo $taskCount;
                    break;
                default:                    
                    break;
            }
            
            return $projectCode . "-" . $taskCount;
            
        }
        
        
        
        function import() {
                        
            $taskID = $this->input->post('taskID');
            $projectID = $this->input->post('projectID');
            
            $config['upload_path'] = './media/import/task/';
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileToUpload')) {
                $error = $this->upload->display_errors(); 
                echo $error;
            } else {
                $upload_data = $this->upload->data();
                $filename = './media/import/task/' . $upload_data['file_name'];
                
                
                $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
                
                try {
                    $inputFileType = IOFactory::identify($filename);
                    $objReader = IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($filename);
                } catch(Exception $e) {
                    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                }
                
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                
                for ($row = 2; $row <= $highestRow; $row++) {              
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);                    
                    
                    $employee = $this->EmployeeModel->getEmployeeByName($rowData[0][3]);
                    
                    foreach ($employee->result() as $rowEmployee) :
                        $pic = $rowEmployee->employee_id;
                    endforeach;                                           
                    
                    $data = array(
                        "task_name" => $rowData[0][1],
                        "task_detail" => $rowData[0][2],                        
                        "due_date" => $rowData[0][4],
                        "pic" => $pic,                        
                        "project_id" => $projectID,
                        "task_code" => $this->generateTaskCode($projectID)
                    );            
                                       
                    $this->db->insert("task", $data);
                    
                    $lastID = $this->db->insert_id();                                                
                    $this->TaskHistoryModel->insertTaskHistory($lastID);
                   
                }
                
                
                redirect('project/task/' . $projectID );
            }
        }
                
        
    }