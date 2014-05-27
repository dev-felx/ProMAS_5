<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Assess extends CI_Controller{
    function __construct() {
         
        parent::__construct();
        
        //checking session and allowed roles
        $roles = array('supervisor','panel_head');
        check_session_roles($roles);
        $this->load->model('assessment_model');
        $this->load->model('announcement_model');
    }
    
    public function index(){
         //prepare data
        $forms = $this->assessment_model->get_weekly($this->session->userdata('user_id'));
        if($forms !=  NULL){
            redirect('assessment/assess/weekly', 'location');
        }else{
            $data['views'] = array('/assessment/welcome');
        }
        
        //load view
        page_load($data);
    }
    
    
    public function setup() {
        //get project supervised
        $projects = $this->announcement_model->get_grps($this->session->userdata('user_id'));
        
        //week interval
         if($_POST['interval'] >= '2'){  $st = 0; }else{ $st = 1;}
         $stepper = (int)$_POST['interval'];
        foreach ($projects as $value) {
            //create groups forms
            $data2 = array(
                'project_id' => $value['project_id'],
                'project_name' => $value['title'],
                'space_id' => $this->session->userdata('space_id'),
                'owner' => $this->session->userdata('user_id')
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
                for($i = $st; $i <= 30;$i = $i + $stepper){
                    if($i == 0){
                        continue;
                    }
                    $data = array(
                        'student' => $value2['registration_no'],
                        'student_name' => ($value2['first_name'].' '.$value2['last_name']),
                        'project_id' => $value['project_id'],
                        'project_name' => $value['title'],
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
    
    
    public function weekly(){
        //get data
        $data['forms'] = $this->assessment_model->get_weekly($this->session->userdata('user_id'));
        $data['projects'] = $this->announcement_model->get_grps($this->session->userdata('user_id'));
        
        if($data['forms'] ==  NULL){
            redirect('assessment/assess', 'location');
        }
        //prepare views
        $data['sub_title'] = 'Weekly Assessment';
        $data['views'] = array('/assessment/assess_view','/assessment/weekly_view');
        //load view
        page_load($data);
        
    }
    public function report(){
        //get data
        $data['forms'] = $this->assessment_model->get_report($this->session->userdata('user_id'));
        $data['projects'] = $this->announcement_model->get_grps($this->session->userdata('user_id'));
        
        if($data['forms'] ==  NULL){
            redirect('assessment/assess', 'location');
        }
        //prepare views
        $data['sub_title'] = 'Report Assessment';
        $data['views'] = array('/assessment/assess_view','/assessment/group_view');
        //load view
        page_load($data);
        
    }
        
    public function get_pro_stu(){
        $id = $_POST['id'];
        $response['students'] = $this->assessment_model->get_project_stu($id);
        $response['week'] = $this->assessment_model->get_week();
        header('Content-type: application/json');
        exit(json_encode($response));
    }
    
    public function average(){
        $data['forms'] = $this->assessment_model->get_weekly($this->session->userdata('user_id'));
        $data['projects'] = $this->announcement_model->get_grps($this->session->userdata('user_id'));
        
        if($data['forms'] ==  NULL){
            redirect('assessment/assess', 'location');
        }
        //compute the average
        $ave_forms = array();
        foreach ($data['projects'] as $value) {
            $students = $this->assessment_model->get_project_stu($value['project_id']);

            foreach ($students as $sub_value) {
                $student_forms = $this->assessment_model->get_stu_form($sub_value['registration_no']);
                //average fields
                $form = array(
                    'student' => null,
                    'student_name' => null,
                    'project_id' => null,
                    'project_name' => null,
                    'initiative' => 0,
                    'understand' => 0,
                    'contribution' => 0,
                    'qna' => 0,
                );
                
                //sum all
                foreach ($student_forms as $sub_sub_value) {
                    $form['student'] = $sub_sub_value['student'];
                    $form['student_name'] = $sub_sub_value['student_name']; 
                    $form['project_id'] = $sub_sub_value['project_id']; 
                    $form['project_name'] = $sub_sub_value['project_name']; 
                    $form['initiative'] =  $form['initiative'] + $sub_sub_value['initiative'];
                    $form['understand'] =  $form['understand'] + $sub_sub_value['understand'];
                    $form['contribution'] = $form['contribution'] + $sub_sub_value['contribution'];
                    $form['qna'] = $form['qna'] + $sub_sub_value['qna'];
                }
                
                //average
                $num  = count($student_forms);
                $form['initiative'] =  $form['initiative'] / $num;
                $form['understand'] =  $form['understand'] / $num;
                $form['contribution'] = $form['contribution'] / $num;
                $form['qna'] = $form['qna'] / $num;
                    
                array_push($ave_forms, $form);
            }
            
            
        }
        $data['forms'] = $ave_forms;
        //prepare views
        $data['sub_title'] = 'Average for weekly Assessment';
        $data['views'] = array('/assessment/ave_view');
        //load view
        page_load($data);
        
    }
    
    public function save_form() {
        $this->form_validation->set_rules("init","Initiative","required|is_natural|less_than[6]");
        $this->form_validation->set_rules("gen","General Project Understanding","required|is_natural|less_than[6]");
        $this->form_validation->set_rules("spec","Specific Contribution","required|is_natural|less_than[11]");
        $this->form_validation->set_rules("qn"," Questions and Answers","required|is_natural|less_than[6]");
        $this->form_validation->set_message('required','%s marks are required');
        $this->form_validation->set_message('is_natural','%s marks have to a natural number');
        if ($this->form_validation->run('reg') == FALSE){
                echo validation_errors();        
        }else {
            $data = array(
                'initiative' => $_POST['init'],
                'understand' => $_POST['gen'],
                'contribution' => $_POST['spec'],
                'qna' => $_POST['qn'],
                'comments' => $_POST['com'],
                'form_id' => $_POST['form_id']
            );
            $res = $this->assessment_model->save_form($data);
            if($res){
                $response['forms'] = $this->assessment_model->get_weekly($this->session->userdata('user_id'));
                $response['status'] = 'cool';
            }
            header('Content-type: application/json');
            exit(json_encode($response));
        }
    }
    
    public function save_form_grp(){ 
        $this->form_validation->set_rules("abs","Abstract","required|is_natural|less_than[4]");
        $this->form_validation->set_rules("ack","Acknowledgment","required|is_natural|less_than[3]");
        $this->form_validation->set_rules("con","Table Of Contents","required|is_natural|less_than[4]");
        $this->form_validation->set_rules("intro","General Introduction","required|is_natural|less_than[5]");
        $this->form_validation->set_rules("main","Main Body","required|is_natural|less_than[16]");
        $this->form_validation->set_rules("ref","References","required|is_natural|less_than[4]");
        $this->form_validation->set_message('required','%s marks are required');
        $this->form_validation->set_message('is_natural','%s marks have to a natural number');
        if ($this->form_validation->run('reg') == FALSE){
                echo validation_errors();        
        }else {
            $data = array(
                'abs' => $_POST['abs'],
                'ack' => $_POST['ack'],
                'comments' => $_POST['com'],
                't_content' => $_POST['con'],
                'intro' => $_POST['intro'],
                'main' => $_POST['main'],
                'ref' => $_POST['ref']
            );
            $form_id = $_POST['form_id'];
            $res = $this->assessment_model->save_form_grp($data,$form_id);
            if($res){  
                $response['forms'] = $this->assessment_model->get_report($this->session->userdata('user_id'));
                $response['status'] = 'cool';
            }
            header('Content-type: application/json');
            exit(json_encode($response));
        }
    }
    
    
    public function export(){
        $data['sub_title'] = 'Export Assessment Documents';
        $data['views'] = array('/assessment/export_view');
        //load view
        page_load($data);
    }
    
    
    
      public function report_export(){
        $this->load->dbutil();
        $this->db->select('*');
        $this->db->from('assess_groups');
        $this->db->where(array('owner' => $this->session->userdata('user_id')));
        $query = $this->db->get();

        $delimiter = ",";
        $newline = "\r\n";
        $csv_data =  $this->dbutil->csv_from_result($query, $delimiter, $newline);
        
        $name = 'mytext.csv';
        $this->load->helper('download');
        force_download($name, $csv_data);
    
        
    }
}