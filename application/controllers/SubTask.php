<?php

    class SubTask extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->model('SubTaskModel');
            $this->load->model('TaskModel');
        }
        
        function save(){
            
            $subTaskName = $this->input->post('subTaskName');
            $dueDate = $this->input->post('dueDate');
            $pic = $this->input->post('pic');
            $subTaskDetail = $this->input->post('subTaskDetail');
            $taskID = $this->input->post('taskID');
            $subTaskCode = $this->generateSubTaskCode($taskID);
            $projectID = $this->input->post('projectID');
            $status = $this->input->post('status');
            
            $data = array(
                'sub_task_code' => $subTaskCode,
                'sub_task_name' => $subTaskName,
                'due_date' => $dueDate,
                'sub_task_status' => $status,
                'pic' => $pic,
                'created_date' => 'created_date',
                'task_id' => $taskID,
                'sub_task_detail' => $subTaskDetail                
            );                        
            
            $this->SubTaskModel->insertSubTask($data);
            redirect('task/subTask/' . $taskID . '/' . $projectID);
            
        }
        
        function update(){
            
            $subTaskName = $this->input->post('subTaskName');
            $dueDate = $this->input->post('dueDate');
            $pic = $this->input->post('pic');
            $subTaskDetail = $this->input->post('subTaskDetail');
            $taskID = $this->input->post('taskID');
            $subTaskID = $this->input->post('subTaskID');
            $subTaskCode = $this->input->post('subTaskCode');
            $projectID = $this->input->post('projectID');
            $status = $this->input->post('status');
            
            $data = array(
                'sub_task_code' => $subTaskCode,
                'sub_task_name' => $subTaskName,
                'due_date' => $dueDate,
                'sub_task_status' => $status,
                'pic' => $pic,
                'created_date' => 'created_date',
                'task_id' => $taskID,
                'sub_task_detail' => $subTaskDetail                
            );                        
            
            $this->SubTaskModel->updateSubTask($data,$subTaskID);
            redirect('task/subTask/' . $taskID . '/' . $projectID);
            
        }
        
        function delete(){
                        
            $taskID = $this->input->post('taskID');
            $subTaskID = $this->input->post('subTaskID');            
            $projectID = $this->input->post('projectID');                                                            
            
            $this->SubTaskModel->deleteSubTask($subTaskID);
            redirect('task/subTask/' . $taskID . '/' . $projectID);
            
        }
        
        function generateSubTaskCode($taskID){                       
            
            $task = $this->TaskModel->getTask($taskID);
            $subTask = $this->SubTaskModel->getAllSubTask($taskID);
            
            foreach ($task->result() as $row) {
                $taskCode = $row->task_code;
            }                        
            
            return $taskCode . "-" . ($subTask->num_rows() + 1);
            
        }
        
    }
    
    
    