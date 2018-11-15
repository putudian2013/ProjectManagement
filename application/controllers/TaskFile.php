<?php

    class TaskFile extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->model('TaskFileModel');
        }
        
        function upload() {
            
            $taskFileName = $this->input->post('fileName');
            $taskID = $this->input->post('taskID');
            $projectID = $this->input->post('projectID');
            
            $config['upload_path'] = './media/task/';
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileToUpload')) {
                $error = $this->upload->display_errors();                
            } else {
                $upload_data = $this->upload->data();
                
                $data = array(
                    'task_file_name' => $taskFileName,
                    'filename' => $upload_data['file_name'],
                    'task_id' => $taskID
                );
                
                $this->TaskFileModel->uploadTaskFile($data);
                redirect('project/task/' . $projectID );
            }
        }
        
        function delete($taskFileID, $projectID){
                       
            $this->TaskFileModel->deleteTaskFile($taskFileID);
            redirect('project/task/' . $projectID );
            
        }
        
    }
