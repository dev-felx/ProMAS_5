<?php 
class Test extends CI_Controller{
    function __construct() { 
        parent::__construct();
    }
    
    public function index(){
        $this->load->view('templates/header');
        $this->load->view('test');
    }

    public function c_event(){
        //print_r($_POST);die();
        $year = date('Y');
	$month = date('m');

	echo json_encode(array(
	
		array(
			'id' => 111,
			'title' => "Event1",
			'start' => "$year-$month-10",
			'url' => "http://yahoo.com/",
                        'desc' => 'bambi helo helo helo helo helo',
                        'className' => 'cl_event'
 		),
		
		array(
			'id' => 222,
			'title' => "Event2",
			'start' => "$year-$month-20",
			'end' => "$year-$month-22",
			'url' => "http://yahoo.com/",
                        'desc' => 'bambi2',
                        'className' => 'cl_event'
		)
	
	));
    }
    
    public function s_event(){
        $year = date('Y');
	$month = date('m');

	echo json_encode(array(
	
		array(
			'id' => 113,
			'title' => "Event3",
			'start' => "$year-$month-10",
			'url' => "http://yahoo.com/",
                        'desc' => 'bambi3',
                        'className' => 'cl_event'
		),
		
		array(
			'id' => 224,
			'title' => "Event4",
			'start' => "$year-$month-20",
			'end' => "$year-$month-22",
			'url' => "http://yahoo.com/",
                        'desc' => 'bambi4',
                        'className' => 'cl_event'
		)
	
	));
    }
 }