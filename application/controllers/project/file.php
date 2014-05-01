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
        $this->load->model('file_model');
    }

        
    public function index($message=NULL){
        
        if($this->session->userdata['type']!=='student'){
            
            $values = array(
                'file_creator_id'=>  $this->session->userdata['user_id'],
            );
            
            $data['table_head']= array('#','Name','Group','Due date','Status');
            $data['documents']=  $this->file_model->get_file($values);
            
            
            $this->load->model('announcement_model');
            $data['receiver'] = array('All groups','Choose groups');
            $data['groups'] = $this->announcement_model->get_grps($this->session->userdata['user_id']);
            $data['message']=$message;
            
            $data['views']=array('/document/request_view');
            page_load($data);
        
        }elseif ($this->session->userdata['type']=='student'){
            $values= array(
                'file_owner_id'=>  $this->session->userdata['project_id'],
                
            );
            
            $data['documents']=  $this->file_model->get_file($values);
            $data['table_head']= array('#','Name','Due date','Status');
            $data['views']=array('/document/submit_view');
            page_load($data);
            
        }
    }
    
    public function request(){
        
        $this->form_validation->set_rules("title","Document title","required");
        $this->form_validation->set_rules("receiver","Receiver","required");
        $this->form_validation->set_rules("duedate","Receiver","required");
        $this->form_validation->set_message('required','*');
    
        if($this->form_validation->run()==FALSE){
            
            $message='<div class="text-danger text-center"><b>Fields can not be empty</b></div>';
            $this->index($message);
            
        }else{
            
            $data = array(
                'file_name' => $_POST['title'],
                'space_id' => $this->session->userdata['space_id'],
                'file_creator_id' => $this->session->userdata['user_id'],
                'file_due_date'=>date('Y-m-d',strtotime(mysql_real_escape_string($_POST['duedate']))),
            );
            
            if($_POST['receiver'] == 'All groups'){
            
                
            }else if($_POST['receiver'] == 'Choose groups'){
                
                foreach ($_POST['groups'] as $value) {
                    $data['file_owner_id'] = $value;
                    $result = $this->file_model->new_file($data);

                }
                
                if($result){
                    $message='<div class="alert alert-warning text-center">Request sent successfully</div>';
                    $this->index($message);
                    
                }
            }    
        }
    }
    
    public function upload_view($doc_id,$file_name){
        $data['doc_id']= $doc_id;
        $data['file_name']= $file_name;
        
        $data['views']=array('document/upload_file');
        page_load($data);
    }

    public function upload(){
        
        $this->load->library('upload');
        
            $config['upload_path']= './files/uploads/documents/';
            $config['allowed_types']= 'pdf|doc|docx';
            $config['max_size']='2048';
            $config['file_name']=$_POST['file_name'];;
            
            $this->upload->initialize($config);

            if(!$this->upload->do_upload()){
                //if unseccessfully load view and display errors
                
                $data['doc_id'] = $_POST['doc_id'];
                $data['file_name'] = $_POST['file_name'];
                $data['message'] = $this->upload->display_errors();
                $data['views']= array('document/upload_file');
                page_load($data);
                
                
            } else {
                //obtaining a file extension
                $path_parts = pathinfo($_FILES["userfile"]["name"]);
                $extension = $path_parts['extension'];
                //replaccing white space with _
                $file_name =  str_replace(' ', '_', $_POST['file_name']);
                
                
                $values = array(
                    'file_path'=>$config['upload_path'].$file_name.'.'.$extension,
                    'file_status'=>1 //document has been submited value
                        );
                
                $result = $this->file_model->update_file($_POST['doc_id'],$values);
                
                if($result !== NULL){
                
                    
                    $data['doc_id'] = $_POST['doc_id'];
                    $data['file_name'] = $_POST['file_name'];
                    
                    $data['message'] = 'File successful uploaded';
                    $data['views']= array('document/upload_file');
                    page_load($data);

                }
               
            
        
        
            
            }//end outer else
   
            }//end function do upload
    
 
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
