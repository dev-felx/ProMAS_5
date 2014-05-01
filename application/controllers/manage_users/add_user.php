<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/*
 * 
 * 
 */


class Add_user extends CI_Controller {
     

    public function __construct() {
        parent::__construct();
        
        //checking session 
        $roles = array('superuser','administrator','coordinator');
        check_session_roles($roles);

        $this->load->model('access/manage_users');
        $this->load->model('project_model');
    
        
    }
    
    
    
    public function individual($user,$message=NULL){
        
        
        $values = array(
                'student_projects.project_id >' =>0, 
            );
        $data['user_data'] = $this->project_model->get_all_project($values);
        $data['message']=$message;
        $data['user'] = $user;
        $data['views'] = array('manage_users/add_user_view');
        
        page_load($data);
        
    }
    
    
    public function add($user){
        
            $this->form_validation->set_rules('fname', 'First Name', 'required|trim');
            $this->form_validation->set_rules('lname', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
            
            if($user == 'student'){
                $this->form_validation->set_rules('reg_no', 'Registration No', 'required|trim');
                $this->form_validation->set_rules('group_project', 'project', 'required|trim');
            }
            
            $this->form_validation->set_message('required',' is required');
            
            $data['user'] = $user;
   
        if ($this->form_validation->run() == FALSE){
            
            $message = '<div class="alert alert-warning text-center">Fields can not be empty</div>';
            $this->individual($user,$message);
            
            
        }//end if $this->form_validation->run() == FALSE
        else{//else validation successfull
            
            $this->load->model('miscellaneous_model');
                        
            if($user == 'student'){
                
                $data_exist = array(
                    'registration_no' => $_POST['reg_no'],
                       );
                      
                $table = 'students';
                        
                //checking if the user exist in the db
                $result_exist = $this->manage_users->check_value_exists($table, $data_exist);
                
                //if user  does not exist is added
                if(!$result_exist){
                    
                
                    $values = array(
                        'first_name' => $_POST['fname'],
                        'last_name' => $_POST['lname'],
                        'email' => $_POST['email'],
                        'registration_no' => $_POST['reg_no'],
                        'password' => md5(lcfirst($_POST['lname'])),
                        'project_id' =>$_POST['group_project'],
                        'group_id'=>$_POST['group_project'],
                        'space_id'=>$this->session->userdata['space_id'],
                        );
            
               
                    $userdata = $this->manage_users->add_student($values);
              
                    if($userdata != NULL ){
                    
                        $this->miscellaneous_model->add_student_id($userdata[0]['student_id']);
                        
                       $fname= $userdata[0]['first_name'];
                       $lname= lcfirst($userdata[0]['last_name']);
                       $reg_no= $userdata[0]['registration_no'];
                       $email = $userdata[0]['email'];
                       
                       $from = "admin@promas.com";
                       //$to = $email;
                       $to = $email;
                       $subject = "ProMAS | Account registration";
                       $message = " 
                            <html>
                            <head>
                            <title>ProMAS | Account Registration</title>
                            </head>
                            <body>
                                    <h4>Hello $fname,</h4>
                                     <p>Use credentials below to login into the system and complete registration</p>   
                                     <p>Username : $reg_no </p>   
                                     <p>Password : $lname  </p>
                                     <p>Click the link below</p>    
                                     <a href='http://localhost/ProMAS_4/index.php/access/login'>Login into promas</a>
                                    <p>Sincerely,</p>
                                    <p>ProMAS admin.</p>
                            </body>
                            </html>";

                        //sending email
                       $send_email =  send($from,$to,$subject,$message);

                        if($send_email == TRUE){

                                        $message = '<div class="alert alert-success  text-center">Student added and email was sent</div>';
                                        $this->individual($user,$message);
                                        
                                    }// end if $send_email == TRUE

                                    
                        }// end if $userdata !=NULL
                        else{// if user user was not added in the database

                            $message = '<div class="alert alert-warning text-center">Student not added, try again</div>';
                            $this->individual($user,$message);

                        }//end else


                        }//end if !$result_exist 


                        else{//else if added user exist in the db
                            $message = '<div class="alert alert-warning text-center">Student not added, Student with the same registration # exists</div>';
                            $this->individual($user,$message);
                            
                        }//end else
                        
                        } //end if $user == 'student'
                        
                        else {//if user is not a student
                
                            $data_exist = array(
                                'username' => $_POST['email'],
                                 );

                            $table = 'non_student_users';

                            //checking if the user exist in the db
                            $result_exist = $this->manage_users->check_value_exists($table, $data_exist);
                            //if user  does not exist is added
                            if(!$result_exist){
                                
                                $values = array(
                                    'first_name' => $_POST['fname'],
                                    'last_name' => $_POST['lname'],
                                    'email' => $_POST['email'],
                                    'username' => $_POST['email'],
                                    'password' => md5(lcfirst($_POST['lname'])),
                                    'space_id'=>$this->session->userdata['space_id'],
                                    );
                                
                                //role to be stored into db
                                $role = strtolower($user);

                                $userdata = $this->manage_users->add_non_student($values,$role);

                                if($userdata != NULL ){
                    
                                   $result_miscell = $this->miscellaneous_model->add_non_student_id($userdata[0]['user_id']);

                                   if( ($user=='supervisor')  && isset($_POST['group_project']) && $_POST['group_project'] != NULL ){
                                       
                                       $this->load->model('project_model');
                                       $result_project = $this->project_model->update_project($_POST['group_project'],array('supervisor_id'=>$userdata[0]['user_id']));
                                   }
                                   
                                   $fname= $userdata[0]['first_name'];
                                   $lname= lcfirst($userdata[0]['last_name']);
                                   $email = $userdata[0]['email'];

                                   $from = "admin@promas.com";
                                  
                                   $to = $email;
                                   $subject = "ProMAS | Account registration";
                                   $message = " 
                                        <html>
                                        <head>
                                        <title>ProMAS | Account Registration</title>
                                        </head>
                                        <body>
                                                <h4>Hello $fname,</h4>
                                                 <p>Use credentials below to login into the system and complete registration</p>   
                                                 <p>Username : $email </p>   
                                                 <p>Password : $lname  </p>
                                                 <p>Click the link below</p>    
                                                 <a href='http://localhost/ProMAS_4/index.php/access/login'>Login into promas</a>
                                                <p>Sincerely,</p>
                                                <p>ProMAS admin.</p>
                                        </body>
                                        </html>";

                                    //sending email
                                   $send_email =  send($from,$to,$subject,$message);

                                    if($send_email == TRUE){

                                        $message = '<div class="alert alert-success  text-center">User added and email was sent</div>';
                                        $this->individual($user,$message);
                                        
                                    }// end if $send_email == TRUE

                                    }// end if $userdata !=NULL
                        

                                    else{// if user user was not added in the database

                                        $message = '<div class="alert alert-warning text-center">User not added, try again</div>';
                                        $this->individual($user,$message);

                                    }//end else

                                
                                    }//end if !$result_exist 
            
            
                                    else{//else if added user exist in the db

                                        $message = '<div class="alert alert-warning text-center">User with the same email already exists</div>';
                                        $this->individual($user,$message);

                                    
                                    }//end else
            
                                    
                                    }// end else if user added is not student
  
                                   
                                    }//end if form validation is true     
    
                                    
                                    }//eend function add
    

                                    }//end class add_user