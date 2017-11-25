<?php
class Phuthucombo_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    

    function add($params){       
        $this->db->insert('hotel_offers',$params);
    }
    function update($id, $params){ 
        $this->db->where('phuthucombo.id', $id);      
        $this->db->update('phuthucombo', $params);
    }
    function search($params, $limit = null, $start = null)
    {       
        $data = array();
        foreach($params as $key => $value) {
            
            if ($value) {
                $query = $this->db->where('phuthucombo.' . $key, $value);
            }
            
        }

             
        $this->db->limit($limit, $start);
        $query = $this->db->get('phuthucombo');
        $data = $query->result();
    

        return $data;
    }
    

    function delete($params){
        foreach($params as $key => $value) {            
            if ($value) {
                $query = $this->db->where('phuthucombo.' . $key, $value);
            }            
        }
        $query = $this->db->delete('phuthucombo');
        
    }


 }