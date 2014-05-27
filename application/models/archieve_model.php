<?php

/**
 * Description of archieve_model
 *
 * @author Minja Junior
 */
class Archieve_model extends CI_Model {
    
    public function st($term){
        $this->db->select('*');
        $this->db->from('project_profile'); 
        $this->db->like('name', $term);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response; 
        }else{
            return FALSE;
        }   
    }
    
    public function search($term){
        $this->db->select('*');
        $this->db->from('project_profile'); 
        $this->db->like('name', $term);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response; 
        }else{
            return FALSE;
        }
    }
    
    public function profile($id){
        $this->db->select('*');
        $this->db->from('project_profile'); 
        $this->db->where('project_profile_id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $response[] = $row;
            }
            return $response; 
        }else{
            return FALSE;
        }
    }
}
