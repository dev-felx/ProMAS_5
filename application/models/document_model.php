<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Document_model extends CI_Model{
    
    public function new_doc($data){
        
        $query_doc = $this->db->insert('documents', $data);
        if(isset($query_doc) && $query_doc == 1){
            $id = $this->db->insert_id();
            $query_rev = $this->db->insert('revisions',array('doc_id'=>$id));
            return $query_rev;
        }
        
    }
    
    public function get_document($data){
        
        $this->db->select('*');
        $this->db->from('documents');
        $this->db->where($data);
        $this->db->join('revisions', "revisions.doc_id =documents.doc_id",'inner');
        $query= $this->db->get();
            
            if($query->num_rows()>0){
                return $query->result_array();
                
            }else{
                $this->db->select('*');
                $this->db->from('documents');
                $this->db->where($data);
                $query= $this->db->get();
                return $query->result_array();
            } 
    }
    
    
    public function update_document($rev_id,$doc_id,$data_doc,$data_rev){
        
        $this->db->where('doc_id', $doc_id);
        $result_doc = $this->db->update('documents', $data_doc);
        
        if($result_doc){
            $this->db->where('rev_id', $rev_id);
            $result_rev = $this->db->update('revisions', $data_rev);
        }
        if($result_rev && $result_doc){//to be modified more
            $this->db->select('*');
            $this->db->from('documents');
            $this->db->where(array('documents.doc_id'=>$doc_id));
            //$this->db->join('revisions', "revisions.doc_id =documents.doc_id",'inner');
            $query= $this->db->get();
            return $query->result_array();
        }
        
        
    }//end function
    
    public function insert_new_revision($data_rev){
        
        $query_rev = $this->db->insert('revisions',$data_rev);
        if(isset($query_rev) && $query_rev == 1){
            //$id = $this->db->insert_id();
            //$query_rev = $this->db->insert('revisions',array('doc_id'=>$id));
            return $query_rev;
        }
        
    }
    
    public function count_prev_revisions($doc_id,$rev_no){
        $this->db->like('doc_id',$doc_id);
        $this->db->like('rev_no',$rev_no);
        $this->db->from('revisions');
        return $this->db->count_all_results();
    }
    
}