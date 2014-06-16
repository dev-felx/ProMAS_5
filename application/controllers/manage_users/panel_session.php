<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Panel_session extends CI_Controller{
    
    function __construct() {
         
        parent::__construct();
        $this->load->model('project_model');
        $this->load->model('panel_session_model');
        $this->load->model('access/manage_users');
    }
    
    public function index(){
        //prepare data
        $data['projects'] = $this->project_model->get_all_project(array('space_id'=>$this->session->userdata('space_id')));
        $data['panel_heads'] = $this->manage_users->get_non_student_no_department(array('non_student_users.space_id'=>$this->session->userdata('space_id'),'roles.role'=> 'panel_head'));
        $data['all_members'] = $this->panel_session_model->get_members(array('panel_head_id >'=>0));
        //prepare views
        $data['views'] = array('manage_users/panel_session_view');
        $data['sub_title'] = 'Manage Panel Session';
        page_load($data);
    }
    
    public function get_session_details(){
       $id = $_POST['id'];
       $response['projects'] = $this->panel_session_model->get_projects(array('owner'=>$id));
       $response['members'] = $this->panel_session_model->get_members(array('panel_head_id'=>$id));
       $response['session_details'] = $this->panel_session_model->get_session_details(array('panel_head_id'=>$id));
        
       $response['status'] = 'true';
       header('Content-type: application/json');
       exit(json_encode($response));
    }
    
    public function add_project(){
       $project_id = $_POST['project_id'];
       $panel_head_id = $_POST['panel_head_id'];
       //print_r($panel_head_id); die();
       $project = $this->project_model->get_project_row($project_id);
       $data = array(
           'owner'=>$panel_head_id,
           'project_id' => $project_id,
           'group_no' => $project['group_no'],
           'project_name'=>$project['title'],
           'space_id'=>  $this->session->userdata['space_id']
       );
       $check_proj = $this->panel_session_model->count_prev_projects($project_id,$panel_head_id);
       if($check_proj !== 2){
           $data['semester']= 1;
           $data['pres_type']= 'Project proposal';

           $res_1 = $this->panel_session_model->add_project($data);
           if($res_1 !=NULL){
               $data['semester']= 2;
               $data['pres_type']= 'Project report';
               $res_2 = $this->panel_session_model->add_project($data);
            }
           if($res_1 != null && $res_2 != null){
                $response['status'] = 'true';
           }   
       }else{
           $response['status'] = 'fail';
       }   
           
        header('Content-type: application/json');
        exit(json_encode($response));
       
   }
   
   public function update_member(){
        $member_id = $_POST['member_id'];
        $panel_head_id = $_POST['panel_head_id'];
        $project = $this->panel_session_model->update_member($member_id,array('panel_head_id'=>$panel_head_id));
        if($project){
                $response['status'] = 'true';
        }else{
           $response['status'] = 'fail';
        }   
           
        header('Content-type: application/json');
        exit(json_encode($response));
   }
   
   public function remove_project(){
       $project_id = $_POST['project_id'];
       
       $data = array(
           'project_id' =>$project_id,
        );
       
       $res= $this->panel_session_model->delete_project($data);
       if($res){
            $response['status'] = 'true';
       }
        header('Content-type: application/json');
        exit(json_encode($response));
   }
   
}
