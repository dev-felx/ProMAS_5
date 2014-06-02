<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Publish_project extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    
        $roles = array('superuser','administrator','coordinator','supervisor');
        check_session_roles($roles);
        }
    
    
    public function index(){
        
        $data['title'] = 'ProMAS | Publish Project';
        
        if($this->session->userdata['type']=='coordinator'){
            $this->load->model('project_model');
            $data['groups'] = $this->project_model->get_all_project(array('project_id >'=>0,
                'space_id'=>$this->session->userdata['space_id']));
            
        }elseif (($this->session->userdata['type']=='supervisor')) {
            
            $this->load->model('announcement_model');
            $data['groups'] = $this->announcement_model->get_grps($this->session->userdata['user_id']);
            
        }
        
        $data['views']= array('project/publish_view');    
        page_load($data);
    }
    
    public function get_project_details($group_no,$supervisor_id){
        
        $values_doc= array(
                'group_no'=>$group_no,
                'doc_status ='=>1,
                'space_id'=>  $this->session->userdata['space_id']
            );
        $this->load->model('document_model');
        $details['documents']=$this->document_model->get_document($values_doc);
        
        $this->load->model('project_model');
        $project_id = $this->project_model->get_project_id($group_no);
        
        $this->load->model('student_model');
        $values_stud= array(
            'project_id'=>$project_id[0]['project_id'],
            'space_id'=>  $this->session->userdata['space_id']
        );
        $details['students']=$this->student_model->get_student($values_stud);
        
        $this->load->model('non_student_model');
        $values_non_s=array(
            'non_student_users.user_id'=>$supervisor_id,
            'roles.role'=>'supervisor',
            'space_id'=>  $this->session->userdata['space_id']
        );
        $details['supervisor']=$this->non_student_model->get_non_student($values_non_s);
        $values_non_s=array(
            'roles.role'=>'coordinator',
            'space_id'=>  $this->session->userdata['space_id']
        );
        $details['coordinator']=$this->non_student_model->get_non_student($values_non_s);
        
        header('Content-type: application/json');
        exit(json_encode($details));
        
    }
    
    
}
