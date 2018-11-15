<?php

    class TaskComment extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->model('TaskCommentModel');
            $this->load->model('TaskModel');
        }
        
        function save(){
            
            $commentDetail = $this->input->post('commentDetail');            
            $taskID = $this->input->post('taskID');            
            $projectID = $this->input->post('projectID');            
            
            $data = array(
                'detail' => $commentDetail,                
                'task_id' => $taskID                
            );                        
            
            $this->TaskCommentModel->insertTaskComment($data);
            redirect('task/comment/' . $taskID . '/' . $projectID);
            
        }
        
        function update(){
            
            $commentDetail = $this->input->post('commentDetail');            
            $taskID = $this->input->post('taskID');            
            $projectID = $this->input->post('projectID');  
            $taskCommentID = $this->input->post('commentID');  
            
            $data = array(
                'detail' => $commentDetail,                 
                'task_id' => $taskID                
            );                        
            
            $this->TaskCommentModel->updateTaskComment($data,$taskCommentID);            
            redirect('task/comment/' . $taskID . '/' . $projectID);
            
        }
        
        function delete(){
                        
            $taskID = $this->input->post('taskID');
            $taskCommentID = $this->input->post('commentID');       
            $projectID = $this->input->post('projectID');                                                            
            
            $this->TaskCommentModel->deleteTaskComment($taskCommentID);
            redirect('task/comment/' . $taskID . '/' . $projectID);
            
        }
        
        function generateTaskCommentCode($taskID){                       
            
            $task = $this->TaskModel->getTask($taskID);
            $taskComment = $this->TaskCommentModel->getAllTaskComment($taskID);
            
            foreach ($task->result() as $row) {
                $taskCode = $row->task_code;
            }                        
            
            return $taskCode . "-" . ($taskComment->num_rows() + 1);
            
        }
        
    }
    
    
    