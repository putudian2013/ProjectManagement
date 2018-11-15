<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->model('DashboardModel');
            $this->load->model('ProjectModel');
            $this->load->model('TaskModel');
        }

        function index() {
            $data["taskDueToday"] = $this->TaskModel->getTaskDueToday();
            $data["taskDueTomorrow"] = $this->TaskModel->getTaskDueTomorrow();
            $data["outstandingTask"] = $this->TaskModel->getOutstandingTask();
            $data["finishProject"] = $this->ProjectModel->getProjectFinish();
            $data["onGoingProject"] = $this->ProjectModel->getProjectOnGoing();
            $data["taskFinish"] = $this->TaskModel->getTaskFinish();
            $data["taskOnGoing"] = $this->TaskModel->getTaskOnGoing();
            $data["project"] = $this->ProjectModel->getAllProject();            
            $this->load->view('dashboard', $data);
        }
        

    }
