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
}