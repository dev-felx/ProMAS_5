<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of timeline
 *
 * @author User
 */
class Timeline extends CI_Controller {
    
    public function __construct() {
         
        parent::__construct();
    }
    
    public function event(){
           $data['views']= array('timeline/event_view');
           page_load($data);
    }
}
