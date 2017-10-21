<?php

class Locations_model extends CI_Model {
	private $userloggedin;
	private $isSuperAdmin;

		function __construct() {
// Call the Model constructor
				parent :: __construct();
				$this->userloggedin = $this->session->userdata('pt_logged_id');
   				$this->isSuperAdmin = $this->session->userdata('pt_logged_super_admin');
		}

		//get locations list admin panel
		function getLocationsBackend($id = null){

			$this->db->where('status','yes');
			$this->db->order_by('id','desc');
			return $this->db->get('pt_locations')->result();

		}
                // Get all hotels id and names only
		function getRelatedhotels($city = null) {
				$this->db->select('hotel_city,hotel_id,hotel_title,hotel_slug');
				//$this->db->where('hotel_city',$city);
				$this->db->order_by('hotel_id', 'desc');
				return $this->db->get('pt_hotels')->result();
		}
		//get details of location
		function getLocationDetails($id, $lang = null){
			$this->db->where('id',$id);
			
			if(!empty($this->userloggedin)){
		
			if(!$this->isSuperAdmin){
				$this->db->where('user',$this->userloggedin);
				$this->db->or_where('user',NULL);
			}else{
				$user = NULL;
			}
		}

			$result = $this->db->get('pt_locations')->result();

			$response = new stdClass;
			$response->country = $result[0]->country;
			if(!empty($result[0]->location)){
				$response->isValid = TRUE;
			}else{
				$response->isValid = FALSE;
			}
			
			if(empty($lang) || $lang == DEFLANG){

			$response->city = $result[0]->location;	
			
			}else{

			$this->db->where('loc_id',$id);
			$this->db->where('trans_lang',$lang);
			$Transresult = $this->db->get('pt_locations_translation')->result();
			if(empty($Transresult[0]->loc_name)){

			$response->city = $result[0]->location;		

			}else{

			$response->city = $Transresult[0]->loc_name;	
			
			}
					

			}
			
			$response->latitude = $result[0]->latitude;
			$response->longitude = $result[0]->longitude;
            $response->near = $result[0]->near;
			$response->status = $result[0]->status;
            $response->feature = $result[0]->feature;
            $response->best = $result[0]->best;
            $response->description = $result[0]->description;
            $response->image = $result[0]->image;
            $response->hotelimage = $result[0]->hotelimage;
			$response->id = $id;
			return $response;

		}

		// add location
		function addLocation($picture = null, $hotelimage = null) {
			if(!$this->isSuperAdmin){
				$user = $this->userloggedin;
			}else{
				$user = NULL;
			}

				$data = array(
					'location' => $this->input->post('city'), 
					'country' => $this->input->post('country'), 
					'latitude' => $this->input->post('latitude'), 
					'longitude' => $this->input->post('longitude'),
                    'near' => $this->input->post('near'),
					'user' => $user,
					'status' => $this->input->post('status'),
                    'feature' => $this->input->post('feature'),
                    'best' => $this->input->post('best'),
                    'description' => $this->input->post('description'),
                    'image' => $picture,
                    'hotelimage' => $hotelimage
					);
				$this->db->insert('pt_locations', $data);
                $locid = $this->db->insert_id();
                $this->updateLocationsTranslation($this->input->post('translated'),$locid);
		}

		// update location
		function updateLocation($locid, $picture = null, $hotelimage = null) {

				$data = array(
					'location' => $this->input->post('city'), 
					'country' => $this->input->post('country'), 
					'latitude' => $this->input->post('latitude'), 
					'longitude' => $this->input->post('longitude'),
                    'near' => $this->input->post('near'),
					'status' => $this->input->post('status'),
                    'feature' => $this->input->post('feature'),
                    'best' => $this->input->post('best'),
                    'description' => $this->input->post('description'),
                    'image' => $picture,
                    'hotelimage' => $hotelimage
					);

				$this->db->where('id', $locid);
				$this->db->update('pt_locations', $data);

                $this->updateLocationsTranslation($this->input->post('translated'),$locid);
		}

	

		//delete location
		function delete_loc($id){
			$this->db->where('loc_id', $id);
			$this->db->delete('pt_locations_translation');

			$this->db->where('id', $id);
			$this->db->delete('pt_locations');

		}

		//update location translation

	   function updateLocationsTranslation($postdata,$id) {

       foreach($postdata as $lang => $val){
		     if(array_filter($val)){
		        $name = $val['name'];

                $transAvailable = $this->getLocationsTranslation($lang,$id);

                if(empty($transAvailable)){
                 $data = array(
                'loc_name' => $name,
                'loc_id' => $id,
                'trans_lang' => $lang
                );
				$this->db->insert('pt_locations_translation', $data);

                }else{

                 $data = array(
                'loc_name' => $name
                );
				$this->db->where('loc_id', $id);
				$this->db->where('trans_lang', $lang);
			    $this->db->update('pt_locations_translation', $data);

              }


              }

                }
		}


		function getLocationsTranslation($lang,$id){

            $this->db->where('trans_lang',$lang);
            $this->db->where('loc_id',$id);
            return $this->db->get('pt_locations_translation')->result();

        }

        function isUserLocation($id, $locid){
        	$this->db->where('user',$id);
        	$this->db->where('id',$locid);
        	$nums = $this->db->get('pt_locations')->num_rows();

        	if($nums > 0){
        		return TRUE;
        	}else{
        		return FALSE;
        	}
        }

        function alreadyExists(){

        	$this->db->where('latitude',$this->input->post('latitude'));
        	$this->db->where('longitude',$this->input->post('longitude'));
        	$nums = $this->db->get('pt_locations')->num_rows();

        	if($nums > 0){
        		$this->session->set_flashdata('msg', 'Location Already Exists');
        		return TRUE;
        	}else{
        		return FALSE;
        	}
        }

}