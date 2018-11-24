<?php

    class Project extends CI_Controller {
        
        function __construct() {
            parent::__construct();  
            $this->load->model('TaskModel');
            $this->load->model('ProjectModel');
            $this->load->model('EmployeeModel');
        }


        function index(){
            $data['project'] = $this->ProjectModel->getAllProject();            
            $data['employee'] = $this->EmployeeModel->getAllEmployee();
            $this->load->view('project', $data);
        }
        
        function task($projectID){
            $data['projectID'] = $projectID;
            $data['task'] = $this->TaskModel->getProjectTask($projectID);
            $data['employee'] = $this->EmployeeModel->getAllEmployee();
            $project = $this->ProjectModel->getProject($projectID);
            foreach ($project->result() as $row) :
                $data["projectName"] = $row->project_name;
            endforeach;                           
            $this->load->view('task', $data);
        }
        
        function save(){
            
            $projectCode = $this->input->post('projectCode');
            $projectName = $this->input->post('projectName');
            $startDate = $this->input->post('startDate');
            $endDate = $this->input->post('endDate');
            $status = $this->input->post('status');
            $projectOwner = $this->input->post('projectOwner');
            $projectColor = $this->input->post('projectColor');
            
            $data = array(                
                'project_name' => $projectName,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'project_owner' => $projectOwner,
                'project_code' => $projectCode,
                'project_status' => $status,
                'project_color' =>$projectColor
            );
            
            $this->db->insert('project',$data);
            redirect('project');
        }
        
        function update(){
            
            $projectID = $this->input->post('projectID');
            $projectCode = $this->input->post('projectCode');
            $projectName = $this->input->post('projectName');
            $startDate = $this->input->post('startDate');
            $endDate = $this->input->post('endDate');
            $status = $this->input->post('status');
            $projectOwner = $this->input->post('projectOwner');
            $projectColor = $this->input->post('projectColor');
            
            $data = array(                
                'project_name' => $projectName,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'project_owner' => $projectOwner,
                'project_code' => $projectCode,
                'project_status' => $status,
                'project_color' =>$projectColor
            );
            
            $this->db->where('project_id',$projectID);
            $this->db->update('project',$data,$where);
            redirect('project');
        }
        
        function delete(){
            
            $projectID = $this->input->post('projectID');                                    
            
            $this->db->where('project_id',$projectID);
            $this->db->delete('project');
            redirect('project');
        }
        
    }
