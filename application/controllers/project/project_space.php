<?php
/* 
 * 
 * 
 */

class Project_space  extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    
        //checking session and allowed roles
        $roles = array('superuser','administrator','coordinator');
        check_session_roles($roles);
        
        $this->load->model('project_space_model');
        $this->load->model('access/manage_users');
    }
    
    public function index(){
        $values= array(
            'space_id >' =>0
        );
        
        $data['space_data'] = $this->project_space_model->get_all_project_space($values);
        $this->load->view('project/project_space');
        
    }

    
    public function add_space() {
            $this->form_validation->set_rules('sdate', 'Start Date', 'required');
            $this->form_validation->set_rules('edate', 'End Date', 'required');
            $this->form_validation->set_message('required'," is required");

            if ($this->form_validation->run() == FALSE){
            
            $values= array(
                'space_id >' =>0
                );
            $data['space_data'] = $this->project_space_model->get_all_project_space($values);
        
            $data['views'] = array('project/project_space');
                page_load($data);
            } //end if $this->form_validation->run() == FALSE
            else {
                
                $acc_year = date('Y',strtotime(mysql_real_escape_string($_POST['sdate']))).'/'.date('Y',strtotime(mysql_real_escape_string($_POST['edate'])));

                $values = array(
                    'academic_year' => $acc_year,
                    'start_date' => date('Y-m-d',strtotime(mysql_real_escape_string($_POST['sdate']))),
                    'end_date' => date('Y-m-d',strtotime(mysql_real_escape_string($_POST['edate']))),
                ); 

                //adding project space and return maximum _id
                $space_data = $this->project_space_model->add_project_space($values);
                if($space_data !== NULL){
                    $newdata= array(
                        'space_id'=>$space_data[0]['space_id'],
                    );
                    //update space_id for coordinator
                    $userdata= $this->manage_users->update_non_student($this->session->userdata['user_id'],$newdata);
                    
                    //if coodinator space id was updated successfully
                    if($userdata !== NULL){
                        
                        $acc_yr = str_replace('/','-' ,$space_data[0]['academic_year']);
                        //directory for storing files for a specific academic year
                        $dir_path = './sProMAS_documents/'.$acc_yr.'/';
                        //if upload path does not exist create directories
                       
                        if (!is_dir($dir_path)) {
                            mkdir($dir_path, 0777, TRUE);
                        }

                        $this->session->set_userdata(array('space_id'=>$userdata[0]['space_id']));
                        $data['message']='<div class="alert alert-success fade in text-center">Project space was successfully created</div>';

                        //prepare data to be sent to view
                        $data['views'] = array('landing/coor_land');
                        page_load($data);

                    }//end if $result>0
                    else{
                        $data['message']="Project space was not defined under coordinator";
                        $data[views] = array('project/project_space');
                        page_load($data);
                    }//end else $userdata is null

                    }//end if space data != NULL
                    else{

                        $data['message']="Project space was not defined under coordinator";
                        $data[views] = array('project/project_space');
                        page_load($data);

                    }//end else space data is NULL

                    }//end else form validation is ok

                }//end function add_space

                public function choose_space(){
                    
                    $this->form_validation->set_rules('choose_space', '', 'required');
                    $this->form_validation->set_message('required'," is required");
            
                    if ($this->form_validation->run() == FALSE){

                        $values= array(
                            'space_id >' =>0
                            );
                        $data['space_data'] = $this->project_space_model->get_all_project_space($values);
                        $data['views'] = array('project/project_space');
                        $data['error']="On error show choose form hide create form";
                        page_load($data);
                        
                    } //end if $this->form_validation->run() == FALSE
            
                    else {
                        
                        $newdata= array(
                        'space_id'=>$_POST['choose_space'],
                            );
                        
                        $userdata= $this->manage_users->update_non_student($this->session->userdata['user_id'],$newdata);
                           //if coodinator space id was updated successfully
                        if($userdata !== NULL){
                            $this->session->set_userdata(array('space_id'=>$userdata[0]['space_id']));
                            $data['message']='<div class="alert alert-success fade in text-center">Project space was successfully created</div>';

                            //prepare data to be sent to view
                            $data['views'] = array('landing/coor_land');
                            page_load($data);

                        }//end if $result>0
                        else{
                            $data['message']="Project space was not defined under coordinator";
                            $data[views] = array('project/project_space');
                            page_load($data);
                        }//end else $userdata is null
                    }
                    
                }//end function choose

                
                }//end class
                
                