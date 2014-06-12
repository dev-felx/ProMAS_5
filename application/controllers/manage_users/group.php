<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Group extends CI_Controller{
    function __construct() {
         
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('access/manage_users');
        $this->load->model('assessment_model');
    }
    
    public function index(){
        //prepare data
        $data['projects'] = $this->project_model->get_all_project(array('space_id'=>$this->session->userdata('space_id')));
        
        //prepare views
        $data['views'] = array('manage_users/group_view');
        $data['sub_title'] = 'Manage Project Groups';
        page_load($data);
    }
    
    
   public function get_grp_details(){
       $id = 6;
       $response['students'] = $this->manage_users->get_student(array('project_id'=>$id));
       
       //get project data
       $project = $this->project_model->get_project_row($id);
       $response['super'] = $this->manage_users->get_non_student(array('non_student_users.user_id'=>$project['supervisor_id']));
       
       
       $panel_form = $this->assessment_model->get_panel_head($id);
       $response['panel'] = $this->manage_users->get_non_student(array('non_student_users.user_id'=>$panel_form['owner'],'roles.role'=> 'panel_head'));
       
       $response['status'] = 'true';
       header('Content-type: application/json');
       exit(json_encode($response));
   }
}