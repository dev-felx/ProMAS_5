<?php 
class Test extends CI_Controller{
    function __construct() {
         
        parent::__construct();
    }
    
    public function index(){
        $this->load->model('announcement_model');
        echo '<pre>';
        print_r($this->announcement_model->get_email_1_2(1,'non_stu'));
        echo '</pre>';
}
 }