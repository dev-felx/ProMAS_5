<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Add_group extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        
        //checking session and allowed roles
        $roles = array('superuser','administrator','coordinator');
        check_session_roles($roles);
    
        //
        $this->load->model('access/manage_users');
        $this->load->helper(array('file','directory'));
        
    }


    public function group($user){
        
        $data['user'] = $user;
        $data['views']= array('manage_users/add_group_view');
        
        page_load($data);
        
    }
    
    public function download($user){
        
        $this->load->helper('download');
        
        if($user=='student' ){
        
            $filename = './files/templates/student.csv';
            $name = 'students.csv';
        }
        
        elseif ($user=='supervisor') {
            $filename = './files/templates/supervisor.csv';
            $name = 'supervisors.csv';
    }
        
        //reading the file content
        $data = file_get_contents($filename);
        //download a file from a server
        force_download($name, $data);
        
    }//end function download
    
    public function upload_file($user){
        
        $data['user'] = $user;
        $data['views']= array('manage_users/upload_file_view');
        
        page_load($data);
        
        
    }
    
    public function upload($user){
        
        $this->load->library('upload');
    
        $this->form_validation->set_rules("fName","Name","required");
        $this->form_validation->set_message('required','%s is required');
        
        if($this->form_validation->run() === FALSE){
            
            $data['user'] = $user;
            $data['views']= array('manage_users/upload_file_view');
        
            page_load($data);
        }
        
 
        else {
            
            if($user == 'supervisor' ){
                $config['upload_path']= './files/uploads/supervisor';
            }
            elseif($user == 'student'){
                
                $config['upload_path']= './files/uploads/student';
            }
            
            $config['allowed_types']= 'csv';
            $config['max_size']='2048';
            $config['file_name']= $_POST['fName'];
            
            $this->upload->initialize($config);

            $data['user'] = $user;
            
            if(!$this->upload->do_upload()){
                //if unseccessfully load view and display errors
                $data['message'] = $this->upload->display_errors();
                $data['views']= array('manage_users/upload_file_view');
        
                page_load($data);
                
            }

            else {
                $data['message'] = 'File successful uploaded';
                
                $data['views']= array('manage_users/add_group_view');
                page_load($data);
                

                //$this->pagination($user,$data);
            }
            
        
        
            
            }//end outer else
   
            }//end function do upload
            
            
            public function register_file($user){
                
                $this->load->model('miscellaneous_model');
                
                $this->load->library('csv_reader');
                //fetching content from the csv file
                $content = $this->csv_reader->read_csv_file($_POST['file_path'],$user);
                
                $data['user'] = $user;
                
                if($user == 'student'){
                    
                    foreach($content as $field){
                       
                        $values = array(
                                'group_no' =>$field['Group no']
                            );
                        
                        $table = 'groups';
                        
                            //checking if the group no exist in the db
                        $result = $this->manage_users->check_value_exists($table, $values);
                        
                        //if the group does not exist
                        if(!$result){
                           
                            //add group into the database if it does not exist
                           $result = $this->manage_users->add_group($values);
                        
                        }//end if the value does not exist
                        
                    }//foreach($content as $field)
                  
                    $i=0;
                    $j=0;
                    
                    foreach($content as $field){

                        $values = array(
                                'registration_no' =>$field['Registration no']
                            );
                        
                        $table = 'students';
                        //checking if the student exist in the db
                        $result = $this->manage_users->check_value_exists($table, $values);
                        
                        //if student does not exist
                        if(!$result){
                        
                            $values = array(
                                'first_name' =>$field['Firstname'] ,
                                'last_name' =>$field['Lastname'] ,
                                'registration_no' =>$field['Registration no'] ,
                                'password' =>md5(lcfirst($field['Lastname'])) ,
                                'email' => $field['Email'],
                                'group_id' =>$field['Group no'],
                                'space_id'=>$this->session->userdata['space_id'],
                            );
                            
                            //add a student into the database
                            $userdata = $this->manage_users->add_student($values);
              
                    if($userdata != NULL ){
                    
                        $this->miscellaneous_model->add_student_id($userdata[0]['student_id']);
                        
                       $fname= $userdata[0]['first_name'];
                       $lname= lcfirst($userdata[0]['last_name']);
                       $reg_no= $userdata[0]['registration_no'];
                       $email = $userdata[0]['email'];
                       
                       $from = "admin@promas.com";
                       //$to = $email;
                       $to = 'coord@localhost';
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
                                
                                $data['results'][$i] = array('Firstname'=> $field['Firstname'],'Lastname'=>$field['Lastname'],'Registration no'=> $field['Registration no']);
                                $i++;
                            }
                                
                            }   
                        
                            }////end if the value does not exist
                        
                        
                        else{
                            
                                $data['exists'][$j] = array('Firstname'=> $field['Firstname'],'Lastname'=>$field['Lastname'],'Registration no'=> $field['Registration no']);
                                $j++;
                        }//if student exists    
                    
                    
                    }// end foreach($content as $field)
                    
                    
                    
               }//end if $user == 'student'
               
               elseif ($user == 'supervisor') {
                   
                   $i=0;
                   $j=0;
                    
                   foreach($content as $field){

                       $values = array(
                            'username' => $field['Email'],
                            );
                      
                       $table = 'non_student_users';
                        
                        //checking if the user exist in the db
                       $result = $this->manage_users->check_value_exists($table, $values);
                       //if user does not exist
                       if(!$result){
                           
                           $values = array(
                              'first_name' =>$field['Firstname'] ,
                              'last_name' =>$field['Lastname'] ,
                              'password' =>md5($field['Lastname']) ,
                              'email' => $field['Email']  ,
                              'username'=> $field['Email'],
                              'space_id'=>$this->session->userdata['space_id'],
                                  );
                           
                                //role to be stored into db
                                $role = strtolower($user);

                            $userdata = $this->manage_users->add_non_student($values,$role);

                                if($userdata != NULL ){
                    
                                    $this->miscellaneous_model->add_non_student_id($userdata[0]['user_id']);

                                    $fname= $userdata[0]['first_name'];
                                    $lname= lcfirst($userdata[0]['last_name']);
                                    $email = $userdata[0]['email'];

                                    $from = "admin@promas.com";
                                    //$to = $email;
                                    $to = 'coord@localhost';
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
                              
                                        $data['results'][$i] = array('Firstname'=> $field['Firstname'],'Lastname'=>$field['Lastname'],'Username'=> $field['Email']);
                                        $i++;

                                        }// end if $send_email == TRUE
                            
                                    }// end if $userdata!=NULL if user was added successfully 
                                    
                                    
                                    }////end if the value does not exist
                            
                            else{
                                
                                $data['exists'][$j] = array('Firstname'=> $field['Firstname'],'Lastname'=>$field['Lastname'],'Username'=> $field['Email']);
                                $j++;
                        }//if  user exists    

                        
                    }//end foreach loop
                   
                    
                   }//end else if $user == 'supervisor'
            
                   if(isset($data['exists']) || isset($data['results'])){
                       
                       
                    $data['views']= array('manage_users/register_view');
                    
                    page_load($data);
                
                       
                   }//end isset($data['exists']) || isset($data['results']
                   
                   
            }// end function register
            
    
            public function delete_file($user){
                
                $data['user']=$user;
                
                if(unlink($_POST['file_path'])){
                    
                    $data['message'] = 'File deleted successfully';
                    $data['views']= array('manage_users/add_group_view');
                    
                    page_load($data);
                }
                
                else{
                    
                    $data['message'] = 'File not deleted, Try again';
                    $data['views']= array('manage_users/add_group_view');
                    
                    page_load($data);
                }
                
                
            }//end function delete file

}
?>


