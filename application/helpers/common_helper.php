<?php

/* 
 * Author: Tesha Evance
 * Description: common tasks for forms
 * Comments: exclusive rights to author, consult on problems
 */


/*
 * Author: Tesha Evance
 * Description: shows errors individually and proper styling
 */
  function show_form_error($name){
     if(form_error($name) != null){ 
         echo form_error($name, '<span class="error_text">', '</span>'); 
         echo '<script>$( "div" ).last().addClass( "has-error" );</script>';
     }
  }
  
  function page_load($data){
      
      //side bar location
        $data['sidebar'] = 'templates/side_bar';
        
        //load page
        $CI =& get_instance();
        $CI->load->view('templates/header',$data);
        $CI->load->view('main_wrapper');
      
  }
  
  function send($from,$to,$subject,$message){
    
    $CI =& get_instance();
    $CI->load->library('email');
    
    $CI->email->from($from,'ProMAS');
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($message);

    if($CI->email->send()) {
        return TRUE;
        } else {
        return FALSE;
        }
    
}


function check_session_roles($roles){
    
    $CI =& get_instance();
    
    if($CI->session->userdata('user_id') && !in_array($CI->session->userdata('type'),$roles)){
        
        $CI->session->sess_destroy();
        setcookie('remember_promas', 'promas', 1,'/');;
        
        unset($_COOKIE['remember_promas']);
        
        //$message='<div class="alert alert-warning text-center" >Invalid Username or Password</div>';
        redirect('access/login/', 'location');
        
    } elseif(!$CI->session->userdata('user_id')){
        
        $CI->session->set_flashdata('url',  current_url());
        //$message='<div class="alert alert-warning text-center" >Invalid Username or Password</div>';
        redirect('access/login/', 'location');
        }
        
}


function no_cache(){
    
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
 
}

function create_notif($desc,$scope,$email = FALSE,$sc_p1 = null,$sc_p2 = null,$url = null,$glyph = 'bell'){
    $CI =& get_instance();
    //prep data
    
    $data = array(
            'description' => $desc,
            'creator_role' => $CI->session->userdata('type'),
            'creator_id' => $CI->session->userdata('user_id'),
            'space_id' => $CI->session->userdata('space_id'),
            'scope' => $scope,
            'sc_parameter' => $sc_p1,
            'sc_parameter2' => $sc_p2,
            'url' => $url,
            'glph' => $glyph
    );
    $CI->load->model('notification_model');
    $CI->load->model('announcement_model');
    $CI->notification_model->create_new($data);
    
    //send email
    if($email == TRUE){
        if($data['scope'] == 1){
            $email_list = $CI->announcement_model->get_email_1_2($CI->session->userdata['space_id'],'all');
        }else if($data['scope'] == 2 && $sc_p1 == 'stu'){
            $email_list = $CI->announcement_model->get_email_1_2($CI->session->userdata['space_id'],'stu');
        }else if($data['scope'] == 2 && $sc_p1 == 'non_stu'){
            $email_list = $CI->announcement_model->get_email_1_2($CI->session->userdata['space_id'],'non_stu');
        }else if($data['scope'] == 3 && $sc_p1 == 'non_stu'){
            $email_list = $CI->announcement_model->get_email_3($CI->session->userdata['space_id'],$CI->session->userdata['user_id']);
        }else if($data['scope'] == 5 && isset ($sc_p2)){
            $email_list = $CI->announcement_model->get_email_5($CI->session->userdata['space_id'],$CI->session->userdata['project_id'],$sc_p2);
        }else if($data['scope'] == 5 && !isset ($sc_p2)){
            $email_list = $CI->announcement_model->get_email_5($CI->session->userdata['space_id'],$CI->session->userdata['project_id'],FALSE);
        }
        $CI->load->library('email');
        $CI->email->from('announcements@promas.co.tz', 'ProMAS');
        $CI->email->subject('ProMAS notification');
        $CI->email->message($desc);
        $CI->email->to($email_list);
        //send email
        $result2 = $CI->email->send();
    }
    return true;
}
