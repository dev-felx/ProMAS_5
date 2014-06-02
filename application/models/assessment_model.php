<?php
class Assessment_model extends CI_Model{
    public function new_weekly($data){
        $query = $this->db->insert('asses_week', $data);
        return $query;
    }
    
    public function get_weekly($id){
        $this->db->select('*');
        $this->db->from('asses_week');
        $this->db->where(array('owner' => $id));
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }
    public function get_report($id){
        $this->db->select('*');
        $this->db->from('assess_groups');
        $this->db->where(array('owner' => $id));
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }
    public function get_pres($id){
        $this->db->select('*');
        $this->db->from('assess_pres');
        $this->db->where(array('owner' => $id));
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }
    
    
    public function new_group($data){
        $query = $this->db->insert('assess_groups', $data);
        return $query;
    }
    
    public function get_project_stu($pro_id) {
            $this->db->select('*');
            $this->db->from('students');
            $this->db->where(array('project_id' => $pro_id));
            $query = $this->db->get();
            $result =  $query->result_array();
            return $result;
    }
    
    public function get_week(){
        $this->db->select('week_no');
        $this->db->distinct();
        $this->db->from('asses_week');
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }
    

    public function save_form($data) {
        $this->db->where('form_id', $data['form_id']);
        return $this->db->update('asses_week', $data);
    }
    
    public function save_form_grp($data,$id) {
        $this->db->where('form_id', $id);
        return $this->db->update('assess_groups', $data);
    }
    
    public function save_form_pres($data) {
        $this->db->where('form_id', $data['form_id']);
        return $this->db->update('assess_pres', $data);
    }
     
    public function get_stu_form($reg){
        $this->db->select('*');
        $this->db->from('asses_week');
        $this->db->where(array('student' => $reg));
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }
    
    /*
     * Export functions
     */
    
    public function get_project_stu_ex($pro_id) {
        $this->db->select('registration_no,first_name,last_name');
        $this->db->from('students');
        $this->db->where(array('project_id' => $pro_id));
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }
        
    public function get_grps_list($data) {
        $this->db->select('*');
        $this->db->from('student_projects');
        $this->db->where('project_id',$data[0]);
        for($i = 1; $i < count($data); $i++){
            $this->db->or_where('project_id',$data[1]); 
        }
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }
    public function get_grps_coor($data) {
        $this->db->select('*');
        $this->db->from('student_projects');
        $this->db->where('space_id',$data);
        $query = $this->db->get();
        $result =  $query->result_array();
        return $result;
    }
}