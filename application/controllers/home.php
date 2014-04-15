<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Home extends CI_Controller{
    function __construct() {
         
        parent::__construct();
    }
    
    public function index(){
       $url = $this->session->flashdata('url');
       if(($url != null)){
           redirect($this->session->flashdata('url'), 'location');
       }
        if($this->session->userdata('type')=='superuser'){
            //prepare data to be sent to view
            $data['views'] = array('landing/super_land');
  
            //load user's views
            page_load($data);
        }
        
        else if($this->session->userdata['type']=='administrator'){
            //prepare data to be sent to view
            $data['views'] = array('landing/admin_land');
  
            //load user's views
            page_load($data);
            
        }
        else if($this->session->userdata['type']=='coordinator'){
            //if space id exist 
            if(($this->session->userdata['space_id'] != NULL) ){
                
                //prepare data to be sent to view
                $data['views'] = array('landing/coor_land');
                //load user's views
                page_load($data);
                
            }
            
            else{//if it doesnot exist
                
                redirect('project/project_space', 'location');
            }
            
            
        }
        else if($this->session->userdata['type']=='supervisor'){
            //prepare data to be sent to view
            $data['views'] = array('landing/svisor_land');
  
            //load user's views
            page_load($data);
            
            
        }
        else if($this->session->userdata['type']=='student'){
            //prepare data to be sent to view
            $data['views'] = array('landing/student_land');
  
            //load user's views
            page_load($data);
        }
        else{
           
            redirect('access/login','location');
        }
        
        
            
        }//end function index
    
       	
        public function change_role($role){
            $this->session->set_userdata('type', $role);
            redirect('home','location');
		}
    }

?>
