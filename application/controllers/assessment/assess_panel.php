<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Assess_panel extends CI_Controller{
    function __construct() {
         
        parent::__construct();
        //checking session and allowed roles
        $roles = array('supervisor');
        check_session_roles($roles);
        $this->load->model('assessment_model');
        $this->load->model('announcement_model');
    }
    
    public function index(){
        //prepare view
        $data['views'] = array('/assessment/assess_view');
        
        //load view
        page_load($data);
    }
    
    public function pres(){
        //get data
        $data['forms'] = $this->assessment_model->get_report($this->session->userdata('user_id'));
        $data['projects'] = $this->announcement_model->get_grps($this->session->userdata('user_id'));
        
        
        //prepare views
        $data['sub_title'] = 'Presentation Assessment';
        $data['views'] = array('/assessment/pres_view');
        //load view
        page_load($data);
        
    }
}