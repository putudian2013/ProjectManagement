<?php

    class Report extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->model('TaskModel');
        }


        function dueTask($period){
            
            switch ($period) {
                case "today":          
                    $data["filename"] = 'List of Task Due Today';                    
                    $data["task"] = $this->TaskModel->getTaskDueToday();
                    break;
                case "tomorrow":
                    $data["filename"] = 'List of Task Due Tomorrow';
                    $data["task"] = $this->TaskModel->getTaskDueTomorrow();
                    break;
                case "outstanding":
                    $data["filename"] = 'List of Outstanding Task';
                    $data["task"] = $this->TaskModel->getOutstandingTask();
                    break;
                default:                    
                    break;
            }
            $this->load->view('report/due-task',$data);
            
        }
        
    }
