<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Panel_session_model extends CI_Model{
    
    public function get_projects($data){
        $this->db->select('project_id,project_name,group_no,project_id,owner,space_id');
        $this->db->distinct();
        $this->db->from('assess_pres');
        $this->db->where($data);
        $query= $this->db->get();
        return $query->result_array();
    }
    public function get_members($data){
        $this->db->select('*');
        $this->db->from('panel_member');
        $this->db->where($data);
        $query= $this->db->get();
        return $query->result_array();
    }
    public function get_session_details($data){
        $this->db->select('*');
        $this->db->from('panel_session');
        $this->db->where($data);
        $query= $this->db->get();
        return $query->result_array();
    }
    public function add_project($data){
        $result = $this->db->insert('assess_pres', $data);
        return $result;
    }
    public function delete_project($data){
            return  $this->db->delete('assess_pres', $data); 
        }
    
    public function count_prev_projects($proj_id,$ph_id){
        $this->db->like('project_id',$proj_id);
        $this->db->like('owner',$ph_id);
        $this->db->from('assess_pres');
        return $this->db->count_all_results();
    }
    
    
    
    
}
