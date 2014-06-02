<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Access extends CI_Controller{
    function __construct() {
         
        parent::__construct();
    }
    
    public function switcher(){
            //Check type of user and grant access
            if($this->session->userdata('type') == 'coordinator'){
                $this->session->set_userdata('archive_level', 1);
            }else if($this->session->userdata('type') == 'supervisor'){
                $this->session->set_userdata('archive_level', 2);
            }if($this->session->userdata('type') == 'student'){
                $this->session->set_userdata('archive_level', 3);
            }
            
            //Redirect to archive home
            redirect('archive/archive','location');  
    }
    
    
}