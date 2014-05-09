<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Assess extends CI_Controller{
    function __construct() {
         
        parent::__construct();
        
        //checking session and allowed roles
        $roles = array('supervisor');
        check_session_roles($roles);
    }
    
    public function index(){
         //prepare data
        $data['views'] = array('/assessment/welcome');
        
        //load view
        page_load($data);
    }
    
    public function setup() {
        //prepare data
        $data['views'] = array('/assessment/setup');
        
        //load view
        page_load($data);
    }
}