<?php

    class Calendar extends CI_Controller{
        
        function __construct() {
            parent::__construct();
            $this->load->model('TaskModel');
            $this->load->model('EmployeeModel');
        }
        
        function index(){
            
            $data['task'] = $this->TaskModel->getAllTask();
            $this->load->view('calendar',$data);
        }
        
        function taskEdit(){
            
            $id = $this->input->post('id');
            $taskID = explode("-", $id)[0];
            $projectID = explode("-", $id)[1];
            
            $data['taskID'] = $taskID;
            $data['projectID'] = $projectID;
            $data['task'] = $this->TaskModel->getTask($taskID);
            $data['employee'] = $this->EmployeeModel->getAllEmployee();
            return $this->load->view('helper/task-calendar',$data);            
            
        }                
        
    }
