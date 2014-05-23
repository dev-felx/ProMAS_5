<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Assess_panel extends CI_Controller{
    function __construct() {
         
        parent::__construct();
        //checking session and allowed roles
        $roles = array('panel_head', 'supervisor');
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
        $data['forms'] = $this->assessment_model->get_pres($this->session->userdata('user_id'));
        
        if($data['forms'] ==  NULL){
            redirect('assessment/assess', 'location');
        }
        //prepare views
        $data['sub_title'] = 'Presentation Assessment';
        $data['views'] = array('/assessment/pres_view');
        //load view
        page_load($data);
        
    }
    
    public function save_form() {
        $this->form_validation->set_rules("im","Implementation Methodology","required|is_natural|less_than[8]");
        $this->form_validation->set_rules("pq","Presentation Quality","required|is_natural|less_than[9]");
        $this->form_validation->set_rules("ptc","Presentation Time Compliance","required|is_natural|less_than[6]");
        $this->form_validation->set_rules("sc","System correctness","required|is_natural|less_than[16]");
        $this->form_validation->set_rules("sf","System Functionalities","required|is_natural|less_than[11]");
        $this->form_validation->set_message('required','%s marks are required');
        $this->form_validation->set_message('is_natural','%s marks have to a natural number');
        if ($this->form_validation->run('reg') == FALSE){
                echo validation_errors();        
        }else {
            $data = array(
                'im' => $_POST['im'],
                'pq' => $_POST['pq'],
                'ptc' => $_POST['ptc'],
                'sc' => $_POST['sc'],
                'sf' => $_POST['sf'],
                'com' => $_POST['com'],
                'form_id' => $_POST['form_id']
            );
            
            $res = $this->assessment_model->save_form_pres($data);
            if($res){
                $response['forms'] = $this->assessment_model->get_pres($this->session->userdata('user_id'));
                $response['status'] = 'cool';
            }
            header('Content-type: application/json');
            exit(json_encode($response));
        }
    }
}