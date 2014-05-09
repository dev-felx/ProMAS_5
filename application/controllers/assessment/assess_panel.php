<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Assess_panel extends CI_Controller{
    function __construct() {
         
        parent::__construct();
    }
    
    public function index(){
        //prepare view
        $data['views'] = array('/assessment/assess_view');
        
        //load view
        page_load($data);
    }
}