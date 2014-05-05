<?php
class Event_model extends CI_Model{
    
    public function new_event($data) {
        $query = $this->db->insert('events', $data);
        return $query;
    }
    
    public function get_event($id){
        $this->db->select('*');
        $this->db->from('events'); 
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $result =  $query->row_array();
        return $result;
    }
    
    public function update_event($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('events', $data);
    }
    
    public function del_event($id){       
       return  $this->db->delete('events', array('id' => $id)); 
    }
    
    public function load_events($data){
        $this->db->select('*');
        $this->db->from('events');
        $this->db->where($data);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0){
            $result =  $query->result_array();
            return $result;
        }else{
            return FALSE;
        }
    }
}