<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Request_title extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    
        $roles = array('superuser','administrator','coordinator','supervisor', 'student');
        check_session_roles($roles);
    }
    
    public function index(){
        $data['views']= array('project/request_title');    
        page_load($data);
    }
    
    public function request(){
        $this->form_validation->set_rules("title","Project Title", "required");
        $this->form_validation->set_rules("desription","Project Description","required");
        
        if ($this->form_validation->run() == FALSE){
            $response['status'] = 'false';
            $response['data'] = validation_errors();
            header('Content-type: application/json');
            exit(json_encode($response));
        }else {
            $data = array(
                'title' => $_POST['title'],
                'description' => $_POST['description'],
            );
        }
        
    }
        
}