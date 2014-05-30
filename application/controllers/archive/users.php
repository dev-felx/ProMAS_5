<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends CI_Controller{
    function __construct() {
         
        parent::__construct();
    }
    
    public function index(){
        $data['views'] = array('archive/access/user_man_view');
  
        //load user's views
        page_load($data);
    }
    
    
    public function new_user(){
        
    }
    
}