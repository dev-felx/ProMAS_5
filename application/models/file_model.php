<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class File_model extends CI_Model{
    
    public function new_file($data){
        $query = $this->db->insert('files', $data);
        return $query;
    }
    
    public function get_file($data){
        
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
    
    public function update_file($doc_id,$data){
        
        $this->db->where('file_id', $doc_id);
        $result = $this->db->update('files', $data); 
            
        if($result){
                
            $query = $this->db->get_where('files', array('file_id' => $doc_id));
        }
        return $query->result_array();
        
    }//end function
    
    
    
}