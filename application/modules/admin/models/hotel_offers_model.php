<?php
class hotel_offers_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    

    function addHotelOffers($params){       
        $this->db->insert('hotel_offers',$params);
    }

    

    function deleteHotelOffers($params){
        foreach($params as $key => $value) {            
            if ($value) {
                $query = $this->db->where('hotel_offers.' . $key, $value);
            }            
        }
        $query = $this->db->delete('hotel_offers');
        
    }


 }