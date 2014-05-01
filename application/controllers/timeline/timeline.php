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
        $this->load->model('event_model');
    }
    
    public function event(){
           $data['views']= array('timeline/event_view');
           page_load($data);
    }
    
    public function add_event(){
        //validate form
        $this->form_validation->set_rules("title","Event title","required");
        $this->form_validation->set_rules("description","Event desciption","required");
        $this->form_validation->set_rules("date_start","Start date","required");
        $this->form_validation->set_rules("date_end","End date","required");
        $this->form_validation->set_message('required','%s is required here');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run('reg') == FALSE){
                $errors = array();
                // Loop through $_POST and get the keys
                foreach ($this->input->post() as $key => $value)
                {
                    // Add the error message for this field
                    $errors[$key] = form_error($key);
                }
                $response['errors'] = array_filter($errors); // Some might be empty
                $response['status'] = 'not_valid';

                
        }else{
            //prepare data
            $data = array(
                        'title' => $_POST['title'],
                        'desc' => $_POST['description'],
                        'start' => $_POST['date_start'],
                        'end' => $_POST['date_end'],
                        'space_id' => $this->session->userdata('space_id'),
                        'creator_id' => $this->session->userdata('user_id'),
            );
            $res = $this->event_model->new_event($data);    
            if($res){
                $response['status'] = 'success';
            }
        }
        // You can use the Output class here too
        header('Content-type: application/json');
        exit(json_encode($response));
    }
    
    public function get_for_edit(){
        echo json_encode((array('title'=> 'hello')));
    }
    
    
    public function c_event(){
        
        //print_r($this->event_model->load_events());
        echo json_encode($this->event_model->load_events());
        
        /*/print_r($_POST);die();
        $year = date('Y');
	$month = date('m');

	echo json_encode(array(
	
		array(
			'id' => 111,
			'title' => "Coordinator Event 1",
			'start' => "$year-$month-10",
			'url' => "http://yahoo.com/",
			'desc' => "Progress Report submission"
		),
		
		array(
			'id' => 222,
			'title' => "Coordinator Event 2",
			'start' => "$year-$month-20",
			'end' => "$year-$month-22",
			'url' => "http://yahoo.com/",
                        'desc' => "Progress Presentations"
		)
	
	));*/
    }
    
    public function s_event(){
        //print_r($_POST);die();
        $year = date('Y');
	$month = date('m');

	echo json_encode(array(
	
		array(
			'id' => 111,
			'title' => "Supervisor Event 1",
			'start' => "$year-$month-25",
			'url' => "http://yahoo.com/",
                        'desc' => "Prepare report first draft"
		),
		
		array(
			'id' => 222,
			'title' => "Supervisor Event 2",
			'start' => "$year-$month-14",
			'end' => "$year-$month-16",
			'url' => "http://yahoo.com/",
                        'desc' => "Progress Report submission"
		)
	
	));
    }
}
