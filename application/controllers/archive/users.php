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
        $data['views'] = array('archive/access/user_list');
  
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
            
            $res = $this->archieve_model->new_user($data);
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
                $response['data'] = 'Operation failed';
                header('Content-type: application/json');
                exit(json_encode($response));
            }
        }
    }
    
}