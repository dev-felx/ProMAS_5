<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends CI_Controller{
    function __construct() {
         
        parent::__construct();
        $this->load->model('archive_model');
    }
    
    public function index(){
        //get data
        $data['req_count'] = count($this->archive_model->get_req());
        $data['req'] = $this->archive_model->get_req();
        $data['users'] = $this->archive_model->get_all();
        $data['views'] = array('archive/access/user_list');
  
        //load user's views
        page_load($data);
    }
    
    public function show_req(){
        //get data
        $req = $this->archive_model->get_req();
        foreach ($req as $key => $value) {
            $user = $this->archive_model->get_user_id($value['user_id']);
            $req[$key] = array_merge($req[$key], $user);
        }
        $data['req'] = $req;    
        $data['views'] = array('archive/access/req_list');
        
        //load user's views
        page_load($data);
    }
    public function add_single(){
        //form validation
        $this->form_validation->set_rules("fname","First Name","required");
        $this->form_validation->set_rules("lname","Last Name","required");
        $this->form_validation->set_rules("level","Access level","required");
        $this->form_validation->set_rules("email","Email","required|valid_email");
        if($_POST['type'] == 'student'){
            $this->form_validation->set_rules("reg","Registration Number","required");
        }
        
         if ($this->form_validation->run() == FALSE){
              $response['status'] = 'false';
              $response['data'] = validation_errors();
              header('Content-type: application/json');
              exit(json_encode($response));
        }else {
            $data = array(
                'first_name' => $_POST['fname'],
                'last_name' => $_POST['lname'],
                'username' => $_POST['email'],
                'type' => $_POST['type'],
                'level' => $_POST['level'],
                'password' => md5($_POST['lname'])
            );
            
            if($_POST['type'] == 'student'){
               $data['reg_no'] = $_POST['reg'];
            }
            
            $res = $this->archive_model->new_user($data);
            if($res){
                $message = "Welcome to Promas Archive.<br/> Log in using<br/>Email:".$data['username']."<br/>Password (last name):".$data['last_name'];
                $res2 = send('admin@promas.com', $data['username'], 'Promas Archive Account Activation', $message);
                if($res2){
                    $response['status'] = 'true';
                    header('Content-type: application/json');
                    exit(json_encode($response));
                }else{
                    $response['status'] = 'false';
                    $response['data'] = 'User added but email failed';
                    header('Content-type: application/json');
                    exit(json_encode($response));
                }
            }else{
                $response['status'] = 'false';
                $response['data'] = 'User exists, recover password or use another email';
                header('Content-type: application/json');
                exit(json_encode($response));
            }
        }
    }
    
    public function request() {
        //form validation
        $this->form_validation->set_rules("fname","First Name","required");
        $this->form_validation->set_rules("lname","Last Name","required");
        $this->form_validation->set_rules("level","Access level","required");
        $this->form_validation->set_rules("email","Email","required|valid_email");
        if($_POST['type'] == 'student'){
            $this->form_validation->set_rules("reg","Registration Number","required");
        }
        
        if ($this->form_validation->run() == FALSE){
              $response['status'] = 'false';
              $response['data'] = validation_errors();
              header('Content-type: application/json');
              exit(json_encode($response));
        }else {
            $data = array(
                'first_name' => $_POST['fname'],
                'last_name' => $_POST['lname'],
                'username' => $_POST['email'],
                'type' => $_POST['type'],
                'acc_status' => 0,
                'level' => 1,
                'password' => md5($_POST['lname']),
                'info' => $_POST['info']
            );
            
            if($_POST['type'] == 'student'){
               $data['reg_no'] = $_POST['reg'];
            }
            
            $res = $this->archive_model->new_user($data);
            $user_id = $this->archive_model->get_user($_POST['email']);
            if($res){
                $db_data = array(
                  'user_id' =>  $user_id['user_id'],
                  'project_id' => $_POST['project_id'],
                  'project_name' => $_POST['pname'],
                  'level' => $_POST['level']  
                );
                
                $res2 = $this->archive_model->req($db_data);
                if($res2){
                    $response['status'] = 'true';
                    header('Content-type: application/json');
                    exit(json_encode($response));
                }
            }else{
                $response['status'] = 'false';
                $response['data'] = 'User exists, recover password or use another email';
                header('Content-type: application/json');
                exit(json_encode($response));
            }
        }
        
    }
    
    
    
    
    public function del($id){
        $res = $this->archive_model->del($id);
        if($res){
            redirect('archive/users','location'); 
        }
    }
    
    public function en($id) {
        $res = $this->archive_model->en($id);
        if($res){
           redirect('archive/users','location'); 
        }
    }
    public function dis($id) {
        $res = $this->archive_model->dis($id);
        if($res){
            redirect('archive/users','location'); 
        }
    }
    public function rej($id,$name,$user) {
        $ress = $this->archive_model->get_user_id($user);
        $mail = $ress['username'];
        $res = $this->archive_model->rej($id);
        if($res){
           $message = "Sorry your request for access was rejected.<br/> Project:".$name;
           send('admin@promas.com', $mail, 'Promas Archive Access Request', $message);
           redirect('archive/users/show_req','location'); 
        }
    }
    public function grant($id,$rel,$name) {
        $ress = $this->archive_model->get_user_id($id);
        $mail = $ress['username'];
        $res = $this->archive_model->grant($id,$rel);
        if($res){
            $message = "Request for access was grant. Re access the project to get requested data<br/> Project:".$name;
            send('admin@promas.com', $mail, 'Promas Archive Access Request', $message);
            redirect('archive/users/show_req','location'); 
        }
    }
}