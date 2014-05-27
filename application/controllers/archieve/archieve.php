<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Archieve extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('archieve_model');
    }

    public function index(){
        $data['view'] = 'suggest';
        $this->load->view('archieve/homepage', $data);
    }
    
    public function suggestions(){
        $searchterm = $this->input->post('search_key');
        $data['ajax_req'] = TRUE;
        $search_term = mysql_real_escape_string(strip_tags($searchterm));
        $data['res'] = $this->archieve_model->st($search_term);
        $this->load->view('archieve/suggest', $data);
    }

    public function search(){
        $searchterm = $this->input->post('search_key');
        $search_term = mysql_real_escape_string(strip_tags($searchterm));
        $data['res'] = $this->archieve_model->search($search_term);
        $this->load->view('archieve/search_result', $data);
    }
    
    public function profile($id){
        $data['res'] = $this->archieve_model->profile($id);
        $this->load->view('archieve/profile_view', $data);
    }
}
