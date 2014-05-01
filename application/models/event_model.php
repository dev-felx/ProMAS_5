<?php
class Event_model extends CI_Model{
    
    public function new_event($data) {
        $query = $this->db->insert('events', $data);
        return $query;
    }
    
    public function load_events(){
        $this->db->select('*');
        $this->db->from('events'); 
        $query = $this->db->get();
        
        if ($query->num_rows() > 0){
            $result =  $query->result_array();
            return $result;
        }else{
            return FALSE;
        }
    }
}