<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class File extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    
        $roles = array('superuser','administrator','coordinator','supervisor','student');
        check_session_roles($roles);
        $this->load->model('document_model');
    }

        
    public function index($message=NULL){
        
        if($this->session->userdata['type']!=='student'){
            
            $values = array(
                'creator_id'=>  $this->session->userdata['user_id'],
                'creator_role'=>  $this->session->userdata['type'],
                
            );
            
            $data['table_head']= array('#','Name','Group','Due date','Status');
            $data['filter_fields']= array('#','Name','Group','Due date','Status');
            $data['documents']=  $this->document_model->get_document($values);
            
            $this->load->model('project_model');
            $data['all_groups'] = $this->project_model->get_all_project(array('project_id >'=>0));
            
            $this->load->model('announcement_model');
            $data['groups'] = $this->announcement_model->get_grps($this->session->userdata['user_id']);
            $data['message']=$message;
            
            $data['views']=array('/document/request_view');
            page_load($data);
        
        }elseif ($this->session->userdata['type']=='student'){
            $values= array(
                'group_no'=>  $this->session->userdata['project_id'],
            );
            
            $data['documents']=  $this->document_model->get_document($values);
            //print_r($data['documents']);            die();
            $data['table_head']= array('#','Name','Created by','Due date','Status');
            $data['views']=array('/document/submit_view');
            page_load($data);
            
        }
    }
    
    public function get_documents($group_no){
        $values = array(
                'creator_id'=>  $this->session->userdata['user_id'],
                'creator_role'=>  $this->session->userdata['type'],
                'group_no'=>$group_no,
                'doc_status !='=>2
            );
        
        $documents =  $this->document_model->get_document($values);
        //print_r($documents[1][0]['rev_file_path']);
        $i=0;
        foreach ($documents as $key => $value) {
            
           $documents[$i][0]['rev_file_path'] = base64_encode($documents[$i][0]['rev_file_path']);
        
           $i++;
        }
        header('Content-type: application/json');
        exit(json_encode($documents));

        
    }


    public function request(){
        
        $this->form_validation->set_rules("title","Document title","required");
        $this->form_validation->set_rules("group","Receiver","required");
        $this->form_validation->set_rules("duedate","Receiver","required");
        $this->form_validation->set_message('required','*');
    
        if($this->form_validation->run()==FALSE){
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
           
            $data = array(
                'name' => $_POST['title'],
                'space_id' => $this->session->userdata['space_id'],
                'creator_id' => $this->session->userdata['user_id'],
                'creator_role' => $this->session->userdata['type'],
                'due_date'=>date('Y-m-d',strtotime(mysql_real_escape_string($_POST['duedate']))),
                
            );
            
            if($_POST['group'] == 'All groups'){
                if($this->session->userdata['type']=='supervisor'){
                    $this->load->model('announcement_model');
                    $groups = $this->announcement_model->get_grps($this->session->userdata['user_id']);
                    foreach ($groups as $value){ 
                        $data['group_no']=$value['project_id'];
                        $result = $this->document_model->new_doc($data);
                    }//paramaters for notifications
                    $scope= 3;
                    $sc_p1 = $this->session->userdata['user_id'];
                }elseif($this->session->userdata['type']=='coordinator'){
                    $this->load->model('project_model');
                    $value_proj = array(
                        'student_projects.project_id >'=>0);
                        $projects = $this->project_model->get_all_project($value_proj);
                    
                    foreach ($projects as $value){
                        $data['group_no'] = $value['project_id'];
                        $result = $this->document_model->new_doc($data);
                    }
                    $scope= 2;
                    $sc_p1 = 'stu';
                }
            }else if($_POST['group'] == 'Choose groups'){
                
                foreach ($_POST['groups'] as $value) {
                    $data['group_no'] = $value;
                    $result = $this->document_model->new_doc($data);
                }
            }
            if($result){
                $desc = 'Document: ' .$_POST['title'].' requested by '.$this->session->userdata['type'];
                $email= TRUE;
                $notify = create_notif($desc,$scope,$email,$sc_p1,$sc_p2 = null,$url = null,$glyph = 'bell');
                
                if($notify){
                    $response['status'] = 'success';
                }
                }
        }
        
        // You can use the Output class here too
        header('Content-type: application/json');
        exit(json_encode($response));
        
    }

    public function upload_document(){
        
        $this->load->library('upload');
        
        if($this->session->userdata['type']=='student'){
            
            //controlling version no of a document by counting existing versions
            $exist_revs = $this->document_model->count_prev_revisions($_POST['doc_id'],$_POST['rev_no']);
            if(($_POST['rev_status']==0)){
               $rev_no=$_POST['rev_no']; 
            }else if(($_POST['rev_status']==1)){
               $rev_no=$_POST['rev_no']+1;
            }
            //$config['upload_path']= './files/documents/group_no_'.$this->session->userdata['proeject_id'].'/';
            $config['upload_path']= './files/documents/group_no_1/';
            $config['allowed_types']= 'pdf|doc|docx';
            $config['max_size']='2048';
            $config['file_name']=$_POST['doc_name'].'_v'.$rev_no.'_modified_by_student';
            
            $this->upload->initialize($config);

            if(!$this->upload->do_upload()){
                $response['file_errors'] = $this->upload->display_errors();
                $response['status'] = 'file_error';
                
            } else {
                //obtaining a file extension
                $path_parts = pathinfo($_FILES["userfile"]["name"]);
                $extension = $path_parts['extension'];
                //replaccing white space with _
                $file_name =  str_replace(' ', '_', $config['file_name']);
                
                $data_doc= array(
                    'doc_status' =>1,//status of the document submitted
                    );
                    
                    $data_rev = array(
                        'doc_id'=>$_POST['doc_id'],
                        'rev_date_upload'=>date("Y-m-d",time()),
                        'rev_status'=>0,//status of the revision if approved or not
                        'rev_file_name'=>$file_name,
                        'rev_file_path'=>$config['upload_path'].$file_name.'.'.$extension,
                        'rev_no'=>$rev_no
                    );
                    //controlling number existing version of the document to be only 2
                    if(($_POST['rev_status']==0)){
                        $result = $this->document_model->update_document($_POST['rev_id'],$_POST['doc_id'],$data_doc,$data_rev);
                    }else if($_POST['rev_status']==1){
                        $result = $this->document_model->insert_new_revision($data_rev);
                    }
                    
                    if($result !== NULL){
                        $response['status'] = 'success';
                    }
            
                    }//end else file uploaded successfully
            
                    }else{// else if user not student
                        //controlling version no of a document by counting existing versions
                        $exist_revs = $this->document_model->count_prev_revisions($_POST['doc_id'],$_POST['rev_no']);
                        if(($_POST['rev_status']==0)){
                           $rev_no=$_POST['rev_no']+1; 
                        }else if(($_POST['rev_status']==1)){
                           $rev_no=$_POST['rev_no'];
                        }
                        //$config['upload_path']= './files/documents/group_no_'.$this->session->userdata['proeject_id'].'/';
                        $config['upload_path']= './files/documents/group_no_1/';
                        $config['allowed_types']= 'pdf|doc|docx';
                        $config['max_size']='2048';
                        $config['file_name']=$_POST['doc_name'].'_v'.$rev_no.'_modified_by_'.$this->session->userdata['type'];

                        $this->upload->initialize($config);

                        if(!$this->upload->do_upload()){
                            $response['file_errors'] = $this->upload->display_errors(); // Some might be empty
                            $response['status'] = 'file_error';

                        } else {
                            //obtaining a file extension
                            $path_parts = pathinfo($_FILES["userfile"]["name"]);
                            $extension = $path_parts['extension'];
                            //replaccing white space with _
                            $file_name =  str_replace(' ', '_', $config['file_name']);
                            $data_doc= array(
                                'doc_status' =>1,//status of the document submitted
                            );
                            $data_rev = array(
                                'doc_id'=>$_POST['doc_id'],
                                'rev_date_upload'=>date("Y-m-d",time()),
                                'rev_status'=>1,//status of the document that has been revised and uploaded
                                'rev_file_name'=>$file_name,
                                'rev_file_path'=>$config['upload_path'].$file_name.'.'.$extension,
                                'rev_no'=>$rev_no
                            );
                            
                            //controlling number existing version of the document to be only 2
                            if(($_POST['rev_status']==1)){
                                $result = $this->document_model->update_document($_POST['rev_id'],$_POST['doc_id'],$data_doc,$data_rev);
                            }else if(($_POST['rev_status']==0)){
                                $result = $this->document_model->insert_new_revision($data_rev);
                            }


                            if($result !== NULL){
                                $response['status'] = 'success';
                            }

                            }//end else file uploaded successfully

                            }//end else user not a student


                            header('Content-type: application/json');
                            exit(json_encode($response));

                                }//end function do upload
                        
    public function share_doc(){
        $this->form_validation->set_rules("file_name","Name","required");
        $this->form_validation->set_rules("group","Group","required");
        $this->form_validation->set_message('required','%s');
    
        if($this->form_validation->run()==FALSE){
            
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
        
        
            $this->load->library('upload');
            $config['upload_path']= './files/uploads/documents/';
            $config['allowed_types']= 'pdf|doc|docx';
            $config['max_size']='2048';
            $config['file_name']=$_POST['file_name'];
            
            $this->upload->initialize($config);

            if(!$this->upload->do_upload()){
                $response['file_errors'] = $this->upload->display_errors(); // Some might be empty
                $response['status'] = 'file_error';
                
                
            } else {
                //obtaining a file extension
                $path_parts = pathinfo($_FILES["userfile"]["name"]);
                $extension = $path_parts['extension'];
                //replaccing white space with _
                $file_name =  str_replace(' ', '_', $_POST['file_name']);
                
                
                $data_doc = array(
                    'name'=>$_POST['file_name'],
                    'doc_status'=>2, //document has been shared value
                    'space_id' => $this->session->userdata['space_id'],
                    'creator_id' => $this->session->userdata['user_id'],
                    'creator_role' => $this->session->userdata['type'],
                    );
                
                $data_rev = array(
                        'rev_date_upload'=>date("Y-m-d",time()),
                        'rev_status'=>1,//status of the revision if approved or not
                        'rev_file_name'=>$file_name,
                        'rev_file_path'=>$config['upload_path'].$file_name.'.'.$extension,
                    );
                
                if($_POST['group'] == 'All groups'){
                if($this->session->userdata['type']=='supervisor'){
                    $this->load->model('announcement_model');
                    $groups = $this->announcement_model->get_grps($this->session->userdata['user_id']);
                    foreach ($groups as $value){ 
                        $data_doc['group_no']=$value['project_id'];
                        $result = $this->document_model->share_doc($data_doc,$data_rev);
                    }
                    $scope= 3;
                    $sc_p1 = $this->session->userdata['user_id'];
                }elseif($this->session->userdata['type']=='coordinator'){
                    $this->load->model('project_model');
                    $value_proj = array(
                        'student_projects.project_id >'=>0);
                    $projects = $this->project_model->get_all_project($value_proj);
                    foreach ($projects as $value){
                        $data_doc['group_no'] = $value['project_id'];
                        $result = $this->document_model->share_doc($data_doc,$data_rev);
                    }
                    $scope= 2;
                    $sc_p1 = 'stu';
                }
                }else if($_POST['group'] == 'Choose groups'){
                    foreach($_POST['groups'] as $value) {
                        $data_doc['group_no'] = $value;
                        $result = $this->document_model->share_doc($data_doc,$data_rev);
                    }
                }else if($_POST['group'] == 'All supervisors'){
                    foreach($_POST['groups'] as $value) {
                        $values['file_owner_id'] = $value;
                        $result = $this->file_model->new_file($values);
                    }
                }
                
                if($result !== NULL){
                    $desc = 'Document: ' .$_POST['file_name'].' shared by '.$this->session->userdata['type'];
                    $email= TRUE;
                    $notify = create_notif($desc,$scope,$email,$sc_p1,$sc_p2 = null,$url = null,$glyph = 'bell');
                
                if($notify){
                    $response['status'] = 'success';
                }
                    
                }
                
            }
            }//end outer else form validation
   
            // You can use the Output class here too
            header('Content-type: application/json');
            exit(json_encode($response));
            
            
                }//end function share doc
     
 
            public function preview($file_path){
                
                $file_path = base64_decode($file_path);
                
                $this->load->library('fpdf/fpdf');
                define('FPDF_FONTPATH',$this->config->item('fonts_path'));

                $this->load->library('fpdi/fpdi');

                $pdf = new FPDI();

                // get the page count
                $pageCount = $pdf->setSourceFile($file_path);
                // iterate through all pages
                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    // import a page
                    $templateId = $pdf->importPage($pageNo);
                    // get the size of the imported page
                    $size = $pdf->getTemplateSize($templateId);

                    // create a page (landscape or portrait depending on the imported page size)
                    if ($size['w'] > $size['h']) {
                        $pdf->AddPage('L', array($size['w'], $size['h']));
                    } else {
                        $pdf->AddPage('P', array($size['w'], $size['h']));
                    }

                    // use the imported page
                    $pdf->useTemplate($templateId);

                    $pdf->SetFont('Helvetica');
                    $pdf->SetXY(5, 5);
                    $pdf->Write(8, 'A complete document imported with FPDI');
                }

                // Output the new PDF
                $pdf->Output();
        
        
    }//end function preview

    public function download($file_path){
        
        //$info = new SplFileInfo('foo.txt');
        //var_dump($info->getFilename());
        
        $this->load->helper('file');
        $this->load->helper('download');
        
         
        //reading the file content
        $data = file_get_contents(base64_decode($file_path));
        //download a file from a server
        force_download(basename(base64_decode($file_path)), $data);
        
    }//end function download

    
        }
