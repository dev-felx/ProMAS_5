<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Assess extends CI_Controller{
    function __construct() {
         
        parent::__construct();
        
        //checking session and allowed roles
        $roles = array('supervisor');
        check_session_roles($roles);
        $this->load->model('assessment_model');
        $this->load->model('announcement_model');
    }
    
    public function index(){
         //prepare data
        $forms = $this->assessment_model->get_weekly($this->session->userdata('user_id'));
        if($forms !=  NULL){
            $data['forms'] =$forms;
            $data['views'] = array('/assessment/forms');
        }else{
            $data['views'] = array('/assessment/welcome');
        }
        
        //load view
        page_load($data);
    }
    
    public function config() {
        //prepare data
        $data['views'] = array('/assessment/setup');
        
        //load view
        page_load($data);
    }
    
    public function setup() {
        //get project supervised
        $projects = $this->announcement_model->get_grps($this->session->userdata('user_id'));
        foreach ($projects as $value) {
            //create groups forms
            $data2 = array(
                'project_id' => $value['project_id'],
                'space_id' => $this->session->userdata('space_id')
            );
            
            $data2['type'] = 'Project proposal';
            $this->assessment_model->new_group($data2);
            
            $data2['type'] = 'Project progress report';
            $this->assessment_model->new_group($data2);
            
            $data2['type'] = 'Final Project report';
            $this->assessment_model->new_group($data2);
            
            
            $students = $this->assessment_model->get_project_stu($value['project_id']);
            //create weekly forms
            foreach ($students as $value2) {
                for($i = 1; $i <= 15; $i++){
                    $data = array(
                        'student' => $value2['registration_no'],
                        'student_name' => ($value2['first_name'].' '.$value2['last_name']),
                        'project_id' => $value['project_id'],
                        'owner' => $this->session->userdata('user_id'),
                        'week_no' => $i,
                        'space_id' => $this->session->userdata('space_id')
                    );
                    $res = $this->assessment_model->new_weekly($data);   
                }
            }
        }
             redirect('assessment/assess/', 'location');
                    
    }
}