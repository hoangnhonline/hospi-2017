<?php

class Hotels_model extends CI_Model
{
    public $langdef;
    public $isSuperAdmin = null;
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->langdef      = DEFLANG;
        $this->isSuperAdmin = $this->session->userdata('pt_logged_super_admin');
    }
    
    // Get all enabled hotels short info
    function shortInfo($id = null)
    {
        $result = array();
        $this->db->select('hotel_id,hotel_title,hotel_slug');
        if (!empty($id)) {
            $this->db->where('hotel_owned_by', $id);
        }
        $this->db->where('hotel_status', 'Yes');
        $this->db->order_by('hotel_id', 'desc');
        $hotels = $this->db->get('pt_hotels')->result();
        foreach ($hotels as $hotel) {
            $result[] = (object) array(
                'id' => $hotel->hotel_id,
                'title' => $hotel->hotel_title,
                'slug' => $hotel->hotel_slug
            );
        }
        
        return $result;
    }
    
    
    // Get all hotels id and names only
    function all_hotels_names($id = null)
    {
        $this->db->select('hotel_id,hotel_title,hotel_slug');
        if (!empty($id)) {
            $this->db->where('hotel_owned_by', $id);
        }
        $this->db->order_by('hotel_id', 'desc');
        return $this->db->get('pt_hotels')->result();
    }
    
    // Get all hotels for extras
    function all_hotels($id = null)
    {
        $this->db->select('hotel_id as id,hotel_title as title');
        if (!empty($id)) {
            $this->db->where('hotel_owned_by', $id);
        }
        $this->db->order_by('hotel_id', 'desc');
        return $this->db->get('pt_hotels')->result();
    }
    
    // get all data of single hotel by slug
    function get_hotel_data($hotelslug)
    {
        $this->db->select('pt_hotels.*');
        $this->db->where('pt_hotels.hotel_slug', $hotelslug);
        /* $this->db->where('pt_hotel_images.himg_type','default');
        
        $this->db->join('pt_hotel_images','pt_hotels.hotel_id = pt_hotel_images.himg_hotel_id','left');*/
        return $this->db->get('pt_hotels')->result();
    }
    
    // get data of single hotel by id for maps
    function hotel_data_for_map($id)
    {
        $this->db->select('pt_hotels.hotel_id,pt_hotels.hotel_title,pt_hotels.hotel_slug');
        $this->db->where('pt_hotels.hotel_id', $id);
        /*  $this->db->where('pt_hotel_images.himg_type','default');
        
        $this->db->where('pt_hotel_images.himg_approved','1');
        
        $this->db->join('pt_hotel_images','pt_hotels.hotel_id = pt_hotel_images.himg_hotel_id','left');*/
        return $this->db->get('pt_hotels')->result();
    }
    
    // add hotel data
    function add_hotel($user = null)
    {
        if (empty($user)) {
            $user = 1;
        }
        $hotelcount    = $this->db->get('pt_hotels')->num_rows();
        $hotelorder    = $hotelcount + 1;
        $amenities     = @implode(",", $this->input->post('hotelamenities'));
        $paymentopt    = @implode(",", $this->input->post('hotelpayments'));
        $relatedhotels = @implode(",", $this->input->post('relatedhotels'));
        $near          = @implode(",", $this->input->post('near'));
        $featured      = $this->input->post('isfeatured');
        
        if (empty($featured)) {
            
            $featured = "no";
        }
        
        $ffrom = $this->input->post('ffrom');
        $fto   = $this->input->post('fto');
        if (empty($ffrom) || empty($fto) && $featured == "yes") {
            
            $isforever = 'forever';
            
        } else {
            
            $isforever = '';
        }
        
        if ($featured == "no") {
            $isforever = '';
        }
        
        /*Sale off*/
        $sale = $this->input->post('issale');
        
        if (empty($sale)) {
            
            $sale = "no";
        }
        
        $percent = $this->input->post('percent');
        
        $salefrom = $this->input->post('sfrom');
        $saleto   = $this->input->post('sto');
        
        if (empty($salefrom) || empty($saleto) && $sale == "yes") {
            $issaleforever = 'forever';
        } else {
            $issaleforever = '';
        }
        
        if ($sale == "no") {
            $issaleforever = '';
        }
        
        
        $depval  = floatval($this->input->post('depositvalue'));
        $deptype = $this->input->post('deposittype');
        
        $taxval  = floatval($this->input->post('taxvalue'));
        $taxtype = $this->input->post('taxtype');
        
        if ($deptype == "fixed") {
            $commfixed = $depval;
            $commper   = 0;
        } else {
            $commfixed = 0;
            $commper   = $depval;
        }
        
        if ($taxtype == "fixed") {
            $taxfixed = $taxval;
            $taxper   = 0;
        } else {
            $taxfixed = 0;
            $taxper   = $taxval;
        }
        
        $serviceval  = floatval($this->input->post('servicevalue'));
        $servicetype = $this->input->post('servicetype');
        if ($servicetype == "fixed") {
            $servicefixed = $serviceval;
            $serviceper   = 0;
        } else {
            $servicefixed = 0;
            $serviceper   = $serviceval;
        }
        
        
        $hslug = create_url_slug($this->input->post('hotelname'));
        $stars = $this->input->post('hotelstars');
        if (empty($stars)) {
            $stars = 1;
        }
        
        $data = array(
            'hotel_title' => $this->input->post('hotelname'),
            'hotel_slug' => $hslug,
            'hotel_desc' => $this->input->post('hoteldesc'),
            'hotel_website' => $this->input->post('hotelwebsite'),
            //    'hotel_admin_review' => $this->input->post('adminreview'),
            'hotel_stars' => intval($stars),
            //    'hotel_ratings' => $this->input->post('hotelratings'),
            'hotel_is_featured' => $featured,
            'hotel_is_sale' => $sale,
            'hotel_is_sale_percent' => $percent,
            'hotel_sale_from' => convert_to_unix($salefrom),
            'hotel_sale_to' => convert_to_unix($saleto),
            'hotel_featured_from' => convert_to_unix($ffrom),
            'hotel_featured_to' => convert_to_unix($fto),
            'hotel_owned_by' => $user,
            'hotel_type' => $this->input->post('hoteltype'),
            'hotel_city' => $this->input->post('hotelcity'),
            //   'hotel_basic_price' => $this->input->post('hotelprice'),
            //   'hotel_basic_discount' => $this->input->post('hoteldiscount'),
            'hotel_latitude' => $this->input->post('latitude'),
            'hotel_longitude' => $this->input->post('longitude'),
            'hotel_meta_title' => $this->input->post('hotelmetatitle'),
            'hotel_meta_keywords' => $this->input->post('hotelkeywords'),
            'hotel_meta_desc' => $this->input->post('hotelmetadesc'),
            'hotel_pickup' => $this->input->post('pickup'),
            'hotel_amenities' => $amenities,
            'hotel_payment_opt' => $paymentopt,
            'hotel_adults' => $this->input->post('adults'),
            'hotel_children' => $this->input->post('children'),
            'hotel_check_in' => $this->input->post('checkintime'),
            'hotel_check_out' => $this->input->post('checkouttime'),
            'hotel_policy' => $this->input->post('hotelpolicy'),
            'hotel_status' => $this->input->post('hotelstatus'),
            'price_status' => $this->input->post('pricestatus'),
            'hotel_related' => $relatedhotels,
            'near' => $near,
            'hotel_order' => $hotelorder,
            'hotel_comm_fixed' => $commfixed,
            'hotel_comm_percentage' => $commper,
            'hotel_tax_fixed' => $taxfixed,
            'hotel_tax_percentage' => $taxper,
            'hotel_service_fixed' => $servicefixed,
            'hotel_service_percentage' => $serviceper,
            'hotel_email' => $this->input->post('hotelemail'),
            'hotel_phone' => $this->input->post('hotelphone'),
            //'hotel_website' => $this->input->post('hotelwebsite'),
            'hotel_map_address' => $this->input->post('hoteladdress'),
            'hotel_map_city' => $this->input->post('hotelmapaddress'),
            'tripadvisor_id' => $this->input->post('tripadvisor'),
            'hotel_featured_forever' => $isforever,
            'hotel_sale_forever' => $issaleforever
        );
        //print_r($data);
        $this->db->insert('pt_hotels', $data);
        $hotelid   = $this->db->insert_id();
        $isSpecial = $this->input->post('isSpecial');
        /*    if ($isSpecial == "1") {
        $this->special_offers_model->add_to_specialoffer('hotels', $hotelid);
        }*/
        return $hotelid;
    }
    
    // update hotel data
    function update_hotel($id)
    {
        
        $amenities     = @implode(",", $this->input->post('hotelamenities'));
        $paymentopt    = @implode(",", $this->input->post('hotelpayments'));
        $relatedhotels = @implode(",", $this->input->post('relatedhotels'));
        $near          = @implode(",", $this->input->post('near'));
        $featured      = $this->input->post('isfeatured');
        
        if (empty($featured)) {
            
            $featured = "no";
        }
        
        $ffrom = $this->input->post('ffrom');
        $fto   = $this->input->post('fto');
        
        if (empty($ffrom) || empty($fto) && $featured == "yes") {
            $isforever = 'forever';
        } else {
            $isforever = '';
        }
        
        if ($featured == "no") {
            $isforever = '';
        }
        
        /*Sale off*/
        $sale = $this->input->post('issale');
        
        if (empty($sale)) {
            
            $sale = "no";
        }
        
        $percent = $this->input->post('percent');
        
        $salefrom = $this->input->post('sfrom');
        $saleto   = $this->input->post('sto');
        
        if (empty($salefrom) || empty($saleto) && $sale == "yes") {
            $issaleforever = 'forever';
        } else {
            $issaleforever = '';
        }
        
        if ($sale == "no") {
            $issaleforever = '';
        }
        
        $depval  = floatval($this->input->post('depositvalue'));
        $deptype = $this->input->post('deposittype');
        
        $taxval  = floatval($this->input->post('taxvalue'));
        $taxtype = $this->input->post('taxtype');
        
        if ($deptype == "fixed") {
            $commfixed = $depval;
            $commper   = 0;
        } else {
            $commfixed = 0;
            $commper   = $depval;
        }
        
        if ($taxtype == "fixed") {
            $taxfixed = $taxval;
            $taxper   = 0;
        } else {
            $taxfixed = 0;
            $taxper   = $taxval;
        }
        
        $serviceval  = floatval($this->input->post('servicevalue'));
        $servicetype = $this->input->post('servicetype');
        if ($servicetype == "fixed") {
            $servicefixed = $serviceval;
            $serviceper   = 0;
        } else {
            $servicefixed = 0;
            $serviceper   = $serviceval;
        }
        
        $hslug = create_url_slug($this->input->post('hotelname'));
        
        $stars = $this->input->post('hotelstars');
        if (empty($stars)) {
            $stars = 1;
        }
        
        $data = array(
            'hotel_title' => $this->input->post('hotelname'),
            'hotel_slug' => $hslug,
            'hotel_desc' => $this->input->post('hoteldesc'),
            'hotel_website' => $this->input->post('hotelwebsite'),
            //    'hotel_admin_review' => $this->input->post('adminreview'),
            'hotel_stars' => intval($stars),
            'hotel_is_sale' => $sale,
            'hotel_is_sale_percent' => $percent,
            'hotel_sale_from' => convert_to_unix($salefrom),
            'hotel_sale_to' => convert_to_unix($saleto),
            'hotel_is_featured' => $featured,
            'hotel_featured_from' => convert_to_unix($ffrom),
            'hotel_featured_to' => convert_to_unix($fto),
            'hotel_type' => $this->input->post('hoteltype'),
            'hotel_city' => $this->input->post('hotelcity'),
            'hotel_latitude' => $this->input->post('latitude'),
            'hotel_longitude' => $this->input->post('longitude'),
            'hotel_meta_title' => $this->input->post('hotelmetatitle'),
            'hotel_meta_keywords' => $this->input->post('hotelkeywords'),
            'hotel_meta_desc' => $this->input->post('hotelmetadesc'),
            'hotel_pickup' => $this->input->post('pickup'),
            'hotel_amenities' => $amenities,
            'hotel_payment_opt' => $paymentopt,
            //     'hotel_adults' => $this->input->post('adults'),
            //     'hotel_children' => $this->input->post('children'),
            'hotel_check_in' => $this->input->post('checkintime'),
            'hotel_check_out' => $this->input->post('checkouttime'),
            'hotel_policy' => $this->input->post('hotelpolicy'),
            'hotel_status' => $this->input->post('hotelstatus'),
            'price_status' => $this->input->post('pricestatus'),
            'hotel_related' => $relatedhotels,
            'near' => $near,
            'hotel_comm_fixed' => $commfixed,
            'hotel_comm_percentage' => $commper,
            'hotel_tax_fixed' => $taxfixed,
            'hotel_tax_percentage' => $taxper,
            'hotel_service_fixed' => $servicefixed,
            'hotel_service_percentage' => $serviceper,
            'hotel_email' => $this->input->post('hotelemail'),
            'hotel_phone' => $this->input->post('hotelphone'),
            //'hotel_website' => $this->input->post('hotelwebsite'),
            //  'hotel_map_address' => $this->input->post('hoteladdress'),
            'hotel_map_city' => $this->input->post('hotelmapaddress'),
            'tripadvisor_id' => $this->input->post('tripadvisor'),
            'hotel_featured_forever' => $isforever,
            'hotel_sale_forever' => $issaleforever
        );
        //print_r($data);
        $this->db->where('hotel_id', $id);
        $this->db->update('pt_hotels', $data);
        
    }
    
    // add hotel images by type
    function add_hotel_image($type, $filename, $hotelid)
    {
        $imgorder = 0;
        
        $this->db->where('himg_type', 'slider');
        $this->db->where('himg_hotel_id', $hotelid);
        $imgorder = $this->db->get('pt_hotel_images')->num_rows();
        $imgorder = $imgorder + 1;
        $approval = pt_admin_gallery_approve();
        $this->db->where('himg_type', 'default');
        $this->db->where('himg_hotel_id', $hotelid);
        $hasdefault = $this->db->get('pt_hotel_images')->num_rows();
        if ($hasdefault < 1) {
            $type = 'default';
        }
        $data = array(
            'himg_hotel_id' => $hotelid,
            'himg_type' => $type,
            'himg_image' => $filename,
            'himg_order' => $imgorder,
            'himg_approved' => $approval
        );
        $this->db->insert('pt_hotel_images', $data);
    }
    
    // update hotel image by type
    function update_hotel_image($type, $filename, $hotelid)
    {
        $data = array(
            'himg_image' => $filename
        );
        $this->db->where("himg_type", $type);
        $this->db->where("himg_hotel_id", $hotelid);
        $this->db->update('pt_hotel_images', $data);
    }
    
    // update hotel order
    function update_hotel_order($id, $order)
    {
        $data = array(
            'hotel_order' => $order
        );
        $this->db->where('hotel_id', $id);
        $this->db->update('pt_hotels', $data);
    }
    // Disable Hotel
    
    public function disable_hotel($id)
    {
        $data = array(
            'hotel_status' => '0'
        );
        $this->db->where('hotel_id', $id);
        $this->db->update('pt_hotels', $data);
    }
    // Enable Hotel
    
    public function enable_hotel($id)
    {
        $data = array(
            'hotel_status' => '1'
        );
        $this->db->where('hotel_id', $id);
        $this->db->update('pt_hotels', $data);
    }
    
    // update featured status
    function update_featured()
    {
        //    $forever = $this->input->post('foreverfeatured');
        $isfeatured = $this->input->post('isfeatured');
        $id         = $this->input->post('id');
        
        if ($isfeatured == "no") {
            $isforever = '';
        } else {
            
            $isforever = "forever";
            
        }
        
        /*    if ($isfeatured == '1') {
        if ($forever == "forever") {
        $ffrom = date('Y-m-d');
        $fto = date('Y-m-d', strtotime('+1 years'));
        $isforever = 'forever';
        }
        else {
        $ffrom = $this->input->post('ffrom');
        $fto = $this->input->post('fto');
        $isforever = '';
        }
        }
        else {
        $ffrom = '';
        $fto = '';
        $isforever = 'forever';
        }*/
        
        //$data = array('hotel_is_featured' => $isfeatured, 'hotel_featured_from' => convert_to_unix($ffrom), 'hotel_featured_to' => convert_to_unix($fto), 'hotel_featured_forever' => $isforever);
        $data = array(
            'hotel_is_featured' => $isfeatured,
            'hotel_featured_forever' => $isforever
        );
        $this->db->where('hotel_id', $id);
        $this->db->update('pt_hotels', $data);
        
    }
    
    
    
    
    
    // Get Hotel Images
    function hotel_images($id)
    {
        /*$this->db->where('himg_hotel_id', $id);
        $this->db->where('himg_type', 'default');
        $this->db->order_by('himg_id', 'desc');
        $q = $this->db->get('pt_hotel_images');
        $data['def_image'] = $q->result();*/
        $this->db->where('himg_type', 'slider');
        $this->db->order_by('himg_id', 'desc');
        $this->db->having('himg_hotel_id', $id);
        $q                     = $this->db->get('pt_hotel_images');
        $data['all_slider']    = $q->result();
        $data['slider_counts'] = $q->num_rows();
        /*$this->db->where('himg_hotel_id', $id);
        $this->db->where('himg_type', 'interior');
        $this->db->order_by('himg_id', 'desc');
        $q2 = $this->db->get('pt_hotel_images');
        $data['all_interior'] = $q2->result();
        $data['interior_counts'] = $q2->num_rows();
        $this->db->where('himg_hotel_id', $id);
        $this->db->where('himg_type', 'exterior');
        $this->db->order_by('himg_id', 'desc');
        $q3 = $this->db->get('pt_hotel_images');
        $data['all_exterior'] = $q3->result();
        $data['exterior_counts'] = $q3->num_rows();*/
        return $data;
    }
    
    // Delete Hotel Images
    function delete_image($imgname, $imgid, $hotelid)
    {
        $this->db->where('himg_id', $imgid);
        $this->db->delete('pt_hotel_images');
        $this->updateHotelThumb($hotelid, $imgname, "delete");
        @unlink(PT_HOTELS_SLIDER_THUMBS_UPLOAD . $imgname);
        @unlink(PT_HOTELS_SLIDER_UPLOAD . $imgname);
        
    }
    //update hotel thumbnail
    function updateHotelThumb($hotelid, $imgname, $action)
    {
        if ($action == "delete") {
            $this->db->select('thumbnail_image');
            $this->db->where('thumbnail_image', $imgname);
            $this->db->where('hotel_id', $hotelid);
            $rs = $this->db->get('pt_hotels')->num_rows();
            if ($rs > 0) {
                $data = array(
                    'thumbnail_image' => PT_BLANK_IMG
                );
                $this->db->where('hotel_id', $hotelid);
                $this->db->update('pt_hotels', $data);
            }
        } else {
            $data = array(
                'thumbnail_image' => $imgname
            );
            $this->db->where('hotel_id', $hotelid);
            $this->db->update('pt_hotels', $data);
        }
        
    }
    
    //update hotel thumbnail
    function update_thumb($oldthumb, $newthumb, $hotelid)
    {
        $data = array(
            'himg_type' => 'slider'
        );
        $this->db->where('himg_id', $oldthumb);
        $this->db->where('himg_hotel_id', $hotelid);
        $this->db->update('pt_hotel_images', $data);
        $data2 = array(
            'himg_type' => 'default'
        );
        $this->db->where('himg_id', $newthumb);
        $this->db->where('himg_hotel_id', $hotelid);
        $this->db->update('pt_hotel_images', $data2);
    }
    
    // update image order
    function update_image_order($imgid, $order)
    {
        $data = array(
            'himg_order' => $order
        );
        $this->db->where('himg_id', $imgid);
        $this->db->update('pt_hotel_images', $data);
    }
    
    
    // get number of rooms of hotel
    function rooms_count($hotelid)
    {
        $this->db->where('room_hotel', $hotelid);
        $this->db->select_sum('room_quantity');
        $res = $this->db->get('pt_rooms')->result();
        return $res[0]->room_quantity;
    }
    
    // get number of reviews of hotel
    function reviews_count($hotelid)
    {
        $this->db->where('review_itemid', $hotelid);
        $this->db->where('review_module', 'hotels');
        return $this->db->get('pt_reviews')->num_rows();
    }
    
    // get number of photos of hotel
    function photos_count($hotelid)
    {
        $this->db->where('himg_hotel_id', $hotelid);
        return $this->db->get('pt_hotel_images')->num_rows();
    }
    
    
    // get default image of hotel
    function default_hotel_img($id)
    {
        $this->db->select('thumbnail_image');
        $this->db->where('hotel_id', $id);
        $res = $this->db->get('pt_hotels')->result();
        return $res[0]->thumbnail_image;
    }
    
    // Approve or reject Hotel Images
    function approve_reject_images()
    {
        $data = array(
            'himg_approved' => $this->input->post('apprej')
        );
        $this->db->where('himg_id', $this->input->post('imgid'));
        
        return $this->db->update('pt_hotel_images', $data);
    }
    
    
    // Delete Hotel
    function delete_hotel($hotelid)
    {
        $hotelimages = $this->hotel_images($hotelid);
        foreach ($hotelimages['all_slider'] as $sliderimg) {
            $this->delete_image($sliderimg->himg_image, $sliderimg->himg_id, $hotelid);
        }
        
        $this->db->select('room_id,room_hotel');
        $this->db->where('room_hotel', $hotelid);
        $rooms = $this->db->get('pt_rooms')->result();
        foreach ($rooms as $r) {
            $this->db->select('rimg_room_id,rimg_image');
            $this->db->where('rimg_room_id', $r->room_id);
            $roomimgs = $this->db->get('pt_room_images')->result();
            foreach ($roomimgs as $rmimg) {
                @unlink(PT_ROOMS_THUMBS_UPLOAD . $rmimg->rimg_image);
                @unlink(PT_ROOMS_IMAGES_UPLOAD . $rmimg->rimg_image);
                
                $this->db->where('rimg_room_id', $rmimg->rimg_room_id);
                $this->db->delete('pt_room_images');
            }
            
            $this->db->where('room_id', $r->room_id);
            $this->db->delete('pt_rooms_availabilities');
            
            $this->db->where('room_id', $r->room_id);
            $this->db->delete('pt_rooms_prices');
            
            
            
            $this->db->where('item_id', $r->room_id);
            $this->db->delete('pt_rooms_translation');
            
        }
        
        $this->db->where('room_hotel', $hotelid);
        $this->db->delete('pt_rooms');
        
        $this->db->where('review_itemid', $hotelid);
        $this->db->where('review_module', 'hotels');
        $this->db->delete('pt_reviews');
        
        $this->db->where('item_id', $hotelid);
        $this->db->delete('pt_hotels_translation');
        
        $this->db->where('hotel_id', $hotelid);
        $this->db->delete('pt_hotels');
    }
    
    
    // Disable hotel settings
    function disable_settings($id)
    {
        $data = array(
            'sett_status' => 'No'
        );
        $this->db->where('sett_id', $id);
        $this->db->update('pt_hotels_types_settings', $data);
    }
    
    // Enable hotel settings
    function enable_settings($id)
    {
        $data = array(
            'sett_status' => 'Yes'
        );
        $this->db->where('sett_id', $id);
        $this->db->update('pt_hotels_types_settings', $data);
    }
    
    
    
    // Check by slug
    function hotel_exists($slug)
    {
        $this->db->select('hotel_id');
        $this->db->where('hotel_slug', $slug);
        $this->db->where('hotel_status', 'Yes');
        $nums = $this->db->get('pt_hotels')->num_rows();
        if ($nums > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // List all hotels on front listings page
    function list_hotels_front($perpage = null, $offset = null, $orderby = null)
    {
        $data = array();
        // $hotelslist = $lists['hotels'];
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_hotels.hotel_id,pt_hotels.hotel_stars,pt_hotels.hotel_title,pt_hotels.hotel_order,pt_hotels.hotel_order,pt_rooms.room_basic_price as price');
        if ($orderby == "za") {
            $this->db->order_by('pt_hotels.hotel_title', 'desc');
        } elseif ($orderby == "az") {
            $this->db->order_by('pt_hotels.hotel_title', 'asc');
        } elseif ($orderby == "oldf") {
            $this->db->order_by('pt_hotels.hotel_id', 'asc');
        } elseif ($orderby == "newf") {
            $this->db->order_by('pt_hotels.hotel_id', 'desc');
        } elseif ($orderby == "ol") {
            $this->db->order_by('pt_hotels.hotel_order', 'asc');
        } elseif ($orderby == "p_lh") {
            $this->db->order_by('pt_rooms.room_basic_price', 'asc');
        } elseif ($orderby == "p_hl") {
            $this->db->order_by('pt_rooms.room_basic_price', 'desc');
        } elseif ($orderby == "s_lh") {
            $this->db->order_by('pt_hotels.hotel_stars', 'asc');
        } elseif ($orderby == "s_hl") {
            $this->db->order_by('pt_hotels.hotel_stars', 'desc');
        }
        // $this->db->where_in('pt_hotels.hotel_id', $hotelslist);
        //$this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
        //$this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
        $this->db->where('pt_hotels.hotel_status', 'Yes');
        // if($perpage!='' && $offset!=''){
        //    $this->db->limit($perpage, $offset);
        // }
        $query        = $this->db->get('pt_hotels', $perpage, $offset);
        $data['all']  = $query->result();
        $data['rows'] = $query->num_rows();
        return $data;
    }
    
    // List all hotels on front listings page
    function list_honeymoons_front($perpage = null, $offset = null, $orderby = null)
    {
        $data = array();
        // $hotelslist = $lists['hotels'];
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_hotels.hotel_id,pt_hotels.hotel_stars,pt_hotels.hotel_title,pt_hotels.hotel_order,pt_hotels.hotel_order,pt_rooms.room_basic_price as price,pt_rooms.room_id');
        if ($orderby == "za") {
            $this->db->order_by('pt_hotels.hotel_title', 'desc');
        } elseif ($orderby == "az") {
            $this->db->order_by('pt_hotels.hotel_title', 'asc');
        } elseif ($orderby == "oldf") {
            $this->db->order_by('pt_hotels.hotel_id', 'asc');
        } elseif ($orderby == "newf") {
            $this->db->order_by('pt_hotels.hotel_id', 'desc');
        } elseif ($orderby == "ol") {
            $this->db->order_by('pt_hotels.hotel_order', 'asc');
        } elseif ($orderby == "p_lh") {
            $this->db->order_by('pt_rooms.room_basic_price', 'asc');
        } elseif ($orderby == "p_hl") {
            $this->db->order_by('pt_rooms.room_basic_price', 'desc');
        } elseif ($orderby == "s_lh") {
            $this->db->order_by('pt_hotels.hotel_stars', 'asc');
        } elseif ($orderby == "s_hl") {
            $this->db->order_by('pt_hotels.hotel_stars', 'desc');
        }
        // $this->db->where_in('pt_hotels.hotel_id', $hotelslist);
        //$this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
        //$this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
        $this->db->where('pt_hotels.hotel_status', 'Yes');
        //$this->db->where('pt_rooms.honey_moon', 'Yes');
        $where = "((pt_rooms.honey_moon='Yes' AND pt_rooms.honey_moon_from < " . time() . " AND pt_rooms.honey_moon_to > " . time() . ") OR pt_rooms.room_honey_forever = 'forever')";
        $this->db->where($where);
        $query        = $this->db->get('pt_hotels', $perpage, $offset);
        $data['all']  = $query->result();
        $data['rows'] = $query->num_rows();
        
        return $data;
    }
    
    
    
    // List all hotels on front listings page based on location
    function listHotelsByLocation($locs, $perpage = null, $offset = null, $orderby = null)
    {
        $data = array();
        // $hotelslist = $lists['hotels'];
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_hotels.hotel_id,pt_hotels.hotel_stars,pt_hotels.hotel_title,pt_hotels.hotel_order,pt_hotels.hotel_order,pt_rooms.room_basic_price as price');
        if ($orderby == "za") {
            $this->db->order_by('pt_hotels.hotel_title', 'desc');
        } elseif ($orderby == "az") {
            $this->db->order_by('pt_hotels.hotel_title', 'asc');
        } elseif ($orderby == "oldf") {
            $this->db->order_by('pt_hotels.hotel_id', 'asc');
        } elseif ($orderby == "newf") {
            $this->db->order_by('pt_hotels.hotel_id', 'desc');
        } elseif ($orderby == "ol") {
            $this->db->order_by('pt_hotels.hotel_order', 'asc');
        } elseif ($orderby == "p_lh") {
            $this->db->order_by('pt_rooms.room_basic_price', 'asc');
        } elseif ($orderby == "p_hl") {
            $this->db->order_by('pt_rooms.room_basic_price', 'desc');
        } elseif ($orderby == "s_lh") {
            $this->db->order_by('pt_hotels.hotel_stars', 'asc');
        } elseif ($orderby == "s_hl") {
            $this->db->order_by('pt_hotels.hotel_stars', 'desc');
        }
        // $this->db->where_in('pt_hotels.hotel_id', $hotelslist);
        //$this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
        if (is_array($locs)) {
            $this->db->where_in('pt_hotels.hotel_city', $locs);
        } else {
            $this->db->where('pt_hotels.hotel_city', $locs);
        }
        
        $this->db->where('pt_hotels.hotel_status', 'Yes');
        $query        = $this->db->get('pt_hotels', $perpage, $offset);
        $data['all']  = $query->result();
        $data['rows'] = $query->num_rows();
        return $data;
    }
    // Search hotels from home page
    function search_hotels_front($perpage = null, $offset = null, $orderby = null, $cities = null, $lists = null)
    {
        $data         = array();
       $stars     = $this->input->get('stars');
        $sprice    = $this->input->get('price');
        $types     = $this->input->get('type');
        $near      = $this->input->get('near');
        $issale    = $this->input->get('issale');
        $pickup    = $this->input->get('pickup');
        $honeymoon = $this->input->get('honeymoon');
        //$hotelslist = $lists['hotels'];
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_hotels.*,pt_rooms.room_basic_price as price,pt_hotels_translation.trans_title');
        $this->db->select_avg('pt_reviews.review_overall', 'overall');
        //$this->db->where('pt_hotels.hotel_city', $searchtxt);
        
        /*$this->db->where('MATCH (pt_hotels.hotel_title) AGAINST ("'. $searchtxt .'")', NULL, false);
        $this->db->or_where('MATCH (pt_hotels_translation.trans_title) AGAINST ("'. $searchtxt .'")', NULL, false);
        $this->db->or_where('MATCH (pt_hotels.hotel_city) AGAINST ("'. $searchtxt .'")', NULL, false);
        */
        
        /*$this->db->like('pt_hotels.hotel_title', $searchtxt);
        $this->db->or_like('pt_hotels_translation.trans_title', $searchtxt);
        $this->db->or_like('pt_hotels.hotel_city', $searchtxt);*/
        
        if (!empty($stars)) {
            
            $this->db->where_in('pt_hotels.hotel_stars', $stars);
        }
        if ($orderby == "za") {
            $this->db->order_by('pt_hotels.hotel_title', 'desc');
        } elseif ($orderby == "az") {
            $this->db->order_by('pt_hotels.hotel_title', 'asc');
        } elseif ($orderby == "oldf") {
            $this->db->order_by('pt_hotels.hotel_id', 'asc');
        } elseif ($orderby == "newf") {
            $this->db->order_by('pt_hotels.hotel_id', 'desc');
        } elseif ($orderby == "ol") {
            $this->db->order_by('pt_hotels.hotel_order', 'asc');
        } elseif ($orderby == "p_lh") {
            $this->db->order_by('price', 'asc');
        } elseif ($orderby == "p_hl") {
            $this->db->order_by('price', 'desc');
        } elseif ($orderby == "s_lh") {
            $this->db->order_by('pt_hotels.hotel_stars', 'asc');
        } elseif ($orderby == "s_hl") {
            $this->db->order_by('pt_hotels.hotel_stars', 'desc');
        } elseif ($orderby == "featured") {
            //$where1 = "((pt_hotels.hotel_featured_from < ".time()." AND pt_hotels.hotel_featured_to > ".time().") OR pt_hotels.hotel_featured_forever = 'forever')";
            $this->db->order_by('pt_hotels.hotel_is_featured', 'asc');
            //$this->db->where($where1);
        }
        if (!empty($types)) {
            $this->db->where_in('pt_hotels.hotel_type', $types);
        }
        if (!empty($sprice)) {
            $tmp = explode(";", $sprice);
            
            $this->db->where('pt_rooms.room_basic_price >=', $tmp[0]);
            $this->db->where('pt_rooms.room_basic_price <=', $tmp[1]);
        }
        if (!empty($honeymoon)) {
            
            $this->db->where('pt_rooms.honey_moon', 'Yes');
            
        }
        if (!empty($issale)) {
            $this->db->where('pt_hotels.hotel_is_sale', 'yes');
            $where = "((pt_hotels.hotel_sale_from < " . time() . " AND pt_hotels.hotel_sale_to > " . time() . ") OR pt_hotels.hotel_sale_forever = 'forever')";
            $this->db->where($where);
            
            
        }
        if (!empty($pickup)) {
            $this->db->where('pt_hotels.hotel_pickup', 'Yes');
            
        }
        if (!empty($near)) {
            $near = str_replace("+", ' ', $near);
            $this->db->like('pt_hotels.near', $near);
            
        }
        
        
        $this->db->join('pt_hotels_translation', 'pt_hotels.hotel_id = pt_hotels_translation.item_id', 'left');
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
        $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
        $this->db->having('pt_hotels.hotel_status', 'Yes');
        
        if (!empty($perpage)) {
            
            $query = $this->db->get('pt_hotels', $perpage, $offset);
            
        } else {
            
            $query = $this->db->get('pt_hotels');
            
        }
        /*echo $this->db->_error_message();
        exit;*/
        
        $data['all']  = $query->result();
        $data['rows'] = $query->num_rows();
        
        return $data;
    }
    //search hotels by text
    function search_hotels_by_text($cityid, $perpage = null, $offset = null, $orderby = null, $cities = null, $lists = null, $checkin = null, $checkout = null)
    {
        $data = array();
        
        $searchtxt = $cityid; // $this->input->get('searching');
        if (empty($checkin)) {
            $checkin = $this->input->get('checkin');
        }
        
        if (empty($checkout)) {
            $checkout = $this->input->get('checkout');
        }
        
        $adult     = $this->input->get('adults');
        $child     = $this->input->get('child');
        $stars     = $this->input->get('stars');
        $sprice    = $this->input->get('price');

        $types     = $this->input->get('type');
        $near      = $this->input->get('near');
        $issale    = $this->input->get('issale');
        $pickup    = $this->input->get('pickup');
        $honeymoon = $this->input->get('honeymoon');
        //$hotelslist = $lists['hotels'];
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_hotels.*,pt_rooms.room_basic_price as price,pt_hotels_translation.trans_title');
        $this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->where('pt_hotels.hotel_city', $searchtxt);
        
        /*$this->db->where('MATCH (pt_hotels.hotel_title) AGAINST ("'. $searchtxt .'")', NULL, false);
        $this->db->or_where('MATCH (pt_hotels_translation.trans_title) AGAINST ("'. $searchtxt .'")', NULL, false);
        $this->db->or_where('MATCH (pt_hotels.hotel_city) AGAINST ("'. $searchtxt .'")', NULL, false);
        */
        
        /*$this->db->like('pt_hotels.hotel_title', $searchtxt);
        $this->db->or_like('pt_hotels_translation.trans_title', $searchtxt);
        $this->db->or_like('pt_hotels.hotel_city', $searchtxt);*/
        
        if (!empty($stars)) {
            
            $this->db->where_in('pt_hotels.hotel_stars', $stars);
        }
        if ($orderby == "za") {
            $this->db->order_by('pt_hotels.hotel_title', 'desc');
        } elseif ($orderby == "az") {
            $this->db->order_by('pt_hotels.hotel_title', 'asc');
        } elseif ($orderby == "oldf") {
            $this->db->order_by('pt_hotels.hotel_id', 'asc');
        } elseif ($orderby == "newf") {
            $this->db->order_by('pt_hotels.hotel_id', 'desc');
        } elseif ($orderby == "ol") {
            $this->db->order_by('pt_hotels.hotel_order', 'asc');
        } elseif ($orderby == "p_lh") {
            $this->db->order_by('price', 'asc');
        } elseif ($orderby == "p_hl") {
            $this->db->order_by('price', 'desc');
        } elseif ($orderby == "s_lh") {
            $this->db->order_by('pt_hotels.hotel_stars', 'asc');
        } elseif ($orderby == "s_hl") {
            $this->db->order_by('pt_hotels.hotel_stars', 'desc');
        } elseif ($orderby == "featured") {
            //$where1 = "((pt_hotels.hotel_featured_from < ".time()." AND pt_hotels.hotel_featured_to > ".time().") OR pt_hotels.hotel_featured_forever = 'forever')";
            $this->db->order_by('pt_hotels.hotel_is_featured', 'asc');
            //$this->db->where($where1);
        }
        if (!empty($types)) {
            $this->db->where_in('pt_hotels.hotel_type', $types);
        }
        if (!empty($sprice)) {
            $tmp = explode(";", $sprice);            
            $this->db->where('pt_rooms.room_basic_price >=', $tmp[0]);
            $this->db->where('pt_rooms.room_basic_price <=', $tmp[1]);
        }
        if (!empty($honeymoon)) {
            
            $this->db->where('pt_rooms.honey_moon', 'Yes');
            
        }
        if (!empty($issale)) {
            $this->db->where('pt_hotels.hotel_is_sale', 'yes');
            $where = "((pt_hotels.hotel_sale_from < " . time() . " AND pt_hotels.hotel_sale_to > " . time() . ") OR pt_hotels.hotel_sale_forever = 'forever')";
            $this->db->where($where);
            
            
        }
        if (!empty($pickup)) {
            $this->db->where('pt_hotels.hotel_pickup', 'Yes');
            
        }
        if (!empty($near)) {
            $near = str_replace("+", ' ', $near);
            $this->db->like('pt_hotels.near', $near);
            
        }
        
        
        $this->db->join('pt_hotels_translation', 'pt_hotels.hotel_id = pt_hotels_translation.item_id', 'left');
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
        $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
        $this->db->having('pt_hotels.hotel_status', 'Yes');
        
        if (!empty($perpage)) {
            
            $query = $this->db->get('pt_hotels', $perpage, $offset);
            
        } else {
            
            $query = $this->db->get('pt_hotels');
            
        }
        
        $data['all'] = $query->result();     
        $data['rows'] = $query->num_rows();
        return $data;
    }
    
    
    
    
    
    // for auto suggestions search
    function textsearch()
    {
        $q     = $this->input->get('q');
        $r     = $this->input->get('type');
        $term  = mysql_real_escape_string($q);
        $query = $this->db->query("SELECT hotel_title as name FROM pt_hotels WHERE hotel_title LIKE '%$term%' ")->result();
        foreach ($query as $qry) {
            echo $qry->name . "\n";
        }
    }
    
    // get all hotels for related selection for backend
    function select_related_hotels($id = null)
    {
        $this->db->select('hotel_title,hotel_id');
        if (empty($this->isSuperAdmin)) {
            if (!empty($id)) {
                $this->db->where('hotel_owned_by', $id);
            }
        }
        
        
        return $this->db->get('pt_hotels')->result();
    }
    
    // get related hotels for front-end
    function get_related_hotels($hotels)
    {
        $id = explode(",", $hotels);
        $this->db->select('pt_hotels.hotel_title,pt_hotels.hotel_slug,pt_hotels.hotel_id,pt_hotels.hotel_basic_price,pt_hotels.hotel_basic_discount,pt_hotels.hotel_stars');
        $this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->where_in('pt_hotels.hotel_id', $id);
        // $this->db->where('pt_hotel_images.himg_type','default');
        $this->db->group_by('pt_hotels.hotel_id');
        // $this->db->join('pt_hotel_images','pt_hotels.hotel_id = pt_hotel_images.himg_hotel_id','left');
        $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
        return $this->db->get('pt_hotels')->result();
    }
    
    // get featured hotels
    function featured_hotels_front()
    {
        $settings = $this->settings_model->get_front_settings('hotels');
        $limit    = $settings[0]->front_homepage;
        $orderby  = $settings[0]->front_homepage_order;
        $this->db->select('pt_hotels.hotel_status,pt_hotels.hotel_slug,pt_hotels.hotel_id,pt_hotels.hotel_desc,pt_hotels.hotel_stars,

   pt_hotels.hotel_title,pt_hotels.hotel_city,pt_hotels.hotel_basic_price,pt_hotels.hotel_basic_discount,pt_hotels.hotel_latitude,pt_hotels.hotel_longitude');
        $this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->where('pt_hotels.hotel_is_featured', 'yes');
        $this->db->where('pt_hotels.hotel_featured_from <', time());
        $this->db->where('pt_hotels.hotel_featured_to >', time());
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
        $this->db->having('hotel_status', '1');
        $this->db->limit($limit);
        if ($orderby == "za") {
            $this->db->order_by('pt_hotels.hotel_title', 'desc');
        } elseif ($orderby == "az") {
            $this->db->order_by('pt_hotels.hotel_title', 'asc');
        } elseif ($orderby == "oldf") {
            $this->db->order_by('pt_hotels.hotel_id', 'asc');
        } elseif ($orderby == "newf") {
            $this->db->order_by('pt_hotels.hotel_id', 'desc');
        } elseif ($orderby == "ol") {
            $this->db->order_by('pt_hotels.hotel_order', 'asc');
        }
        return $this->db->get('pt_hotels')->result();
    }
    
    // get popular hotels
    function popular_hotels_front($location = null)
    {
        $settings = $this->settings_model->get_front_settings('hotels');
        $limit    = $settings[0]->front_popular;
        $orderby  = $settings[0]->front_popular_order;
        
        $this->db->select('pt_hotels.hotel_id,pt_hotels.hotel_status,pt_reviews.review_overall,pt_reviews.review_itemid');
        
        $this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->order_by('overall', 'desc');
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid');
        $this->db->where('hotel_status', 'yes');
        $this->db->limit($limit);
        return $this->db->get('pt_hotels')->result();
    }
    
    // get latest hotels
    function latest_hotels_front()
    {
        $settings = $this->settings_model->get_front_settings('hotels');
        $limit    = $settings[0]->front_latest;
        $this->db->select('pt_hotels.hotel_status,pt_hotels.hotel_slug,pt_hotels.hotel_id,pt_hotels.hotel_desc,pt_hotels.hotel_stars,

   pt_hotels.hotel_title,pt_hotels.hotel_city,pt_hotels.hotel_basic_price,pt_hotels.hotel_basic_discount,pt_hotels.hotel_latitude,pt_hotels.hotel_longitude');
        $this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->order_by('pt_hotels.hotel_id', 'desc');
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
        $this->db->where('hotel_status', '1');
        $this->db->limit($limit);
        return $this->db->get('pt_hotels')->result();
    }
    
    function offers_data($id)
    {
        $this->db->where('offer_module', 'hotels');
        $this->db->where('offer_item', $id);
        return $this->db->get('pt_special_offers')->result();
    }
    
    // update translated data os some fields in english
    function update_english($id)
    {
        $hslug = create_url_slug($this->input->post('title'));
        $this->db->where('hotel_slug', $hslug);
        $this->db->where('hotel_id !=', $id);
        $nums = $this->db->get('pt_hotels')->num_rows();
        if ($nums > 0) {
            $hslug = $hslug . "-" . $id;
        } else {
            $hslug = $hslug;
        }
        $data = array(
            'hotel_title' => $this->input->post('title'),
            'hotel_slug' => $hslug,
            'hotel_desc' => $this->input->post('desc'),
            'hotel_additional_facilities' => $this->input->post('additional'),
            'hotel_policy' => $this->input->post('policy')
        );
        $this->db->where('hotel_id', $id);
        $this->db->update('pt_hotels', $data);
        return $hslug;
    }
    
    
    
    
    
    function convert_price($amount)
    {
        $this->load->library('geolib');
        return $this->geolib->convert_price($amount);
    }
    
    // get special offer hotels
    function specialoffer_hotels()
    {
        $this->db->select('pt_hotels.hotel_status,pt_hotels.hotel_slug,pt_hotels.hotel_id,pt_hotels.hotel_desc,pt_hotels.hotel_stars,

   pt_hotels.hotel_title,pt_hotels.hotel_city,pt_hotels.hotel_basic_price,pt_hotels.hotel_basic_discount,pt_hotels.hotel_latitude,pt_hotels.hotel_longitude,pt_special_offers.offer_item');
        $this->db->select_avg('pt_reviews.review_overall', 'overall');
        $this->db->where('pt_special_offers.offer_from <=', time());
        $this->db->where('pt_special_offers.offer_to >=', time());
        $this->db->where('pt_special_offers.offer_status', '1');
        $this->db->order_by('pt_special_offers.offer_id', 'desc');
        $this->db->group_by('pt_hotels.hotel_id');
        $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
        $this->db->join('pt_special_offers', 'pt_hotels.hotel_id = pt_special_offers.offer_item', 'left');
        $this->db->having('pt_hotels.hotel_status', '1');
        return $this->db->get('pt_hotels')->result();
    }
    
    
    
    
    // Adds translation of some fields data
    function add_translation($postdata, $id)
    {
        foreach ($postdata as $lang => $val) {
            if (array_filter($val)) {
                $title     = $val['title'];
                $desc      = $val['desc'];
                $metatitle = $val['metatitle'];
                $metadesc  = $val['metadesc'];
                $keywords  = $val['keywords'];
                $policy    = $val['policy'];
                $data      = array(
                    'trans_title' => $title,
                    'trans_desc' => $desc,
                    'trans_policy' => $policy,
                    'metatitle' => $metatitle,
                    'metadesc' => $metadesc,
                    'metakeywords' => $keywords,
                    'item_id' => $id,
                    'trans_lang' => $lang
                );
                $this->db->insert('pt_hotels_translation', $data);
            }
            
        }
        
        
    }
    
    // Update translation of some fields data
    function update_translation($postdata, $id)
    {
        
        foreach ($postdata as $lang => $val) {
            if (array_filter($val)) {
                $title          = $val['title'];
                $desc           = $val['desc'];
                $metatitle      = $val['metatitle'];
                $metadesc       = $val['metadesc'];
                $kewords        = $val['keywords'];
                $policy         = $val['policy'];
                $transAvailable = $this->getBackTranslation($lang, $id);
                
                if (empty($transAvailable)) {
                    $data = array(
                        'trans_title' => $title,
                        'trans_desc' => $desc,
                        'trans_policy' => $policy,
                        'metatitle' => $metatitle,
                        'metadesc' => $metadesc,
                        'metakeywords' => $kewords,
                        'item_id' => $id,
                        'trans_lang' => $lang
                    );
                    $this->db->insert('pt_hotels_translation', $data);
                    
                } else {
                    $data = array(
                        'trans_title' => $title,
                        'trans_desc' => $desc,
                        'trans_policy' => $policy,
                        'metatitle' => $metatitle,
                        'metadesc' => $metadesc,
                        'metakeywords' => $kewords
                    );
                    $this->db->where('item_id', $id);
                    $this->db->where('trans_lang', $lang);
                    $this->db->update('pt_hotels_translation', $data);
                }
                
                
            }
            
        }
    }
    
    function getBackTranslation($lang, $id)
    {
        
        $this->db->where('trans_lang', $lang);
        $this->db->where('item_id', $id);
        return $this->db->get('pt_hotels_translation')->result();
        
    }
    
    function hotelGallery($slug)
    {
        $this->db->select('pt_hotels.thumbnail_image as thumbnail,pt_hotel_images.himg_id as id,pt_hotel_images.himg_hotel_id as itemid,pt_hotel_images.himg_type as type,pt_hotel_images.himg_image as image,pt_hotel_images.himg_order as imgorder,pt_hotel_images.himg_image as image,pt_hotel_images.himg_approved as approved');
        $this->db->where('pt_hotels.hotel_slug', $slug);
        $this->db->join('pt_hotel_images', 'pt_hotels.hotel_id = pt_hotel_images.himg_hotel_id', 'left');
        $this->db->order_by('pt_hotel_images.himg_id', 'desc');
        return $this->db->get('pt_hotels')->result();
    }
    
    function addPhotos($id, $filename)
    {
        $this->db->select('thumbnail_image');
        $this->db->where('hotel_id', $id);
        $rs = $this->db->get('pt_hotels')->result();
        if ($rs[0]->thumbnail_image == PT_BLANK_IMG) {
            $data = array(
                'thumbnail_image' => $filename
            );
            $this->db->where('hotel_id', $id);
            $this->db->update('pt_hotels', $data);
        }
        
        //add photos to hotel images table
        $imgorder = 0;
        $this->db->where('himg_type', 'slider');
        $this->db->where('himg_hotel_id', $id);
        $imgorder = $this->db->get('pt_hotel_images')->num_rows();
        $imgorder = $imgorder + 1;
        
        $approval = pt_admin_gallery_approve();
        $insdata  = array(
            'himg_hotel_id' => $id,
            'himg_type' => 'slider',
            'himg_image' => $filename,
            'himg_order' => $imgorder,
            'himg_approved' => $approval
        );
        $this->db->insert('pt_hotel_images', $insdata);
        
        
    }
    
    function assignHotels($hotels, $userid)
    {
        if (!empty($hotels)) {
            $userhotels = $this->userOwnedHotels($userid);
            foreach ($userhotels as $ht) {
                if (!in_array($ht, $hotels)) {
                    $ddata = array(
                        'hotel_owned_by' => '1'
                    );
                    $this->db->where('hotel_id', $ht);
                    $this->db->update('pt_hotels', $ddata);
                }
            }
            
            foreach ($hotels as $h) {
                $data = array(
                    'hotel_owned_by' => $userid
                );
                $this->db->where('hotel_id', $h);
                $this->db->update('pt_hotels', $data);
                
            }
            
        }
    }
    
    function userOwnedHotels($id)
    {
        $result = array();
        if (!empty($id)) {
            $this->db->where('hotel_owned_by', $id);
        }
        
        $rs = $this->db->get('pt_hotels')->result();
        if (!empty($rs)) {
            foreach ($rs as $r) {
                $result[] = $r->hotel_id;
            }
        }
        return $result;
    }
    
    /*************Hotel Settings Functions**************/
    
    // Add hotel settings data
    function addSettingsData()
    {
        $filename = "";
        $type     = $this->input->post('typeopt');
        if ($type == "hamenities") {
            if (isset($_FILES['amticon']) && !empty($_FILES['amticon']['name'])) {
                $filename = $this->uploadSettingIcon();
            } else {
                $filename = $this->input->post('oldicon');
            }
            
        }
        
        $selected = $this->input->post('setselect');
        if (empty($selected)) {
            $selected = 'No';
        }
        
        $data = array(
            'sett_name' => $this->input->post('name'),
            'sett_status' => $this->input->post('statusopt'),
            'sett_selected' => $selected,
            'sett_type' => $type,
            'sett_img' => $filename
        );
        $this->db->insert('pt_hotels_types_settings', $data);
        return $this->db->insert_id();
        $this->session->set_flashdata('flashmsgs', "Updated Successfully");
        
    }
    
    // update hotel settings data
    function updateSettingsData()
    {
        $id   = $this->input->post('settid');
        $type = $this->input->post('typeopt');
        
        if (isset($_FILES['amticon']) && !empty($_FILES['amticon']['name'])) {
            $filename = $this->uploadSettingIcon($this->input->post('oldicon'));
        } else {
            $filename = $this->input->post('oldicon');
        }
        
        $selected = $this->input->post('setselect');
        if (empty($selected)) {
            $selected = 'No';
        }
        
        
        $data = array(
            'sett_name' => $this->input->post('name'),
            'sett_status' => $this->input->post('statusopt'),
            'sett_selected' => $selected,
            'sett_img' => $filename
            
        );
        
        
        $this->db->where('sett_id', $id);
        $this->db->update('pt_hotels_types_settings', $data);
        $this->session->set_flashdata('flashmsgs', "Updated Successfully");
    }
    
    // Get hotel settings data
    function get_hotel_settings_data($type = null)
    {
        if (!empty($type)) {
            $this->db->where('sett_type', $type);
        }
        
        $this->db->order_by('sett_id', 'desc');
        return $this->db->get('pt_hotels_types_settings')->result();
    }
    
    function get_hotel_settings_value($type, $id)
    {
        $this->db->where('sett_type', $type);
        $this->db->where('sett_id', $id);
        $this->db->where('sett_status', 'Yes');
        $rslt = $this->db->get('pt_hotels_types_settings')->result();
        if (empty($rslt)) {
            return '';
        } else {
            return $rslt[0]->sett_name . "!";
        }
    }
    
    // Get hotel settings data for adding hotel or room
    function get_hsettings_data($type)
    {
        $this->db->where('sett_type', $type);
        $this->db->where('sett_status', 'Yes');
        return $this->db->get('pt_hotels_types_settings')->result();
    }
    
    // Get hotel settings data for adding hotel or room
    function get_hsettings_data_front($type, $items)
    {
        $this->db->where('sett_type', $type);
        $this->db->where_in('sett_id', $items);
        $this->db->where('sett_status', 'Yes');
        return $this->db->get('pt_hotels_types_settings')->result();
    }
    function updateHotelSettings()
    {
        $ufor       = $this->input->post('updatefor');
        $herohotels = $this->input->post('herohotels');
        if (!empty($herohotels)) {
            $herohotelstxt = implode(",", $herohotels);
        } else {
            $herohotelstxt = "";
        }
        $miniherohotels = $this->input->post('miniherohotels');
        if (!empty($miniherohotels)) {
            $miniherohotelstxt = implode(",", $miniherohotels);
        } else {
            $miniherohotelstxt = "";
        }
        $topcities = $this->input->post('topcities');
        if (!empty($topcities)) {
            $topcitiestxt = implode(",", $topcities);
        } else {
            $topcitiestxt = "";
        }
        $data = array(
            'front_icon' => $this->input->post('page_icon'),
            'front_homepage' => $this->input->post('home'),
            'front_homepage_order' => $this->input->post('homeorder'),
            'front_popular' => $this->input->post('popular'),
            'front_popular_order' => $this->input->post('popularorder'),
            'front_latest' => $this->input->post('latest'),
            'front_homepage_hero' => $herohotelstxt,
            'front_listings' => $this->input->post('listings'),
            'front_listings_order' => $this->input->post('listingsorder'),
            'front_homepage_small_hero' => $miniherohotelstxt,
            'front_top_cities' => $topcitiestxt,
            'front_search' => $this->input->post('searchresult'),
            'front_search_order' => $this->input->post('searchorder'),
            'front_search_min_price' => $this->input->post('minprice'),
            'front_search_max_price' => $this->input->post('maxprice'),
            'front_checkin_time' => $this->input->post('checkin'),
            'front_checkout_time' => $this->input->post('checkout'),
            'front_txtsearch' => '1',
            'front_tax_percentage' => $this->input->post('taxpercentage'),
            'front_tax_fixed' => $this->input->post('taxfixed'),
            'front_search_state' => $this->input->post('state'),
            'front_sharing' => $this->input->post('sharing'),
            'linktarget' => $this->input->post('target'),
            'header_title' => $this->input->post('headertitle'),
            'meta_keywords' => $this->input->post('keywords'),
            'meta_description' => $this->input->post('description')
        );
        $this->db->where('front_for', $ufor);
        $this->db->update('pt_front_settings', $data);
        $this->session->set_flashdata('flashmsgs', "Updated Successfully");
    }
    
    function updateSettingsTypeTranslation($postdata, $id)
    {
        
        foreach ($postdata as $lang => $val) {
            if (array_filter($val)) {
                $name = $val['name'];
                
                $transAvailable = $this->getBackSettingsTranslation($lang, $id);
                
                if (empty($transAvailable)) {
                    $data = array(
                        'trans_name' => $name,
                        'sett_id' => $id,
                        'trans_lang' => $lang
                    );
                    $this->db->insert('pt_hotels_types_settings_translation', $data);
                    
                } else {
                    
                    $data = array(
                        'trans_name' => $name
                    );
                    $this->db->where('sett_id', $id);
                    $this->db->where('trans_lang', $lang);
                    $this->db->update('pt_hotels_types_settings_translation', $data);
                    
                }
                
                
            }
            
        }
    }
    
    
    function getBackSettingsTranslation($lang, $id)
    {
        
        $this->db->where('trans_lang', $lang);
        $this->db->where('sett_id', $id);
        return $this->db->get('pt_hotels_types_settings_translation')->result();
        
    }
    
    // Delete hotel settings
    function deleteTypeSettings($id)
    {
        $this->db->where('sett_id', $id);
        $this->db->delete('pt_hotels_types_settings');
        
        $this->db->where('sett_id', $id);
        $this->db->delete('pt_hotels_types_settings_translation');
    }
    
    // Delete multiple hotel settings
    function deleteMultiplesettings($id, $type)
    {
        $this->db->where('sett_id', $id);
        $this->db->where('sett_type', $type);
        $this->db->delete('pt_hotels_types_settings');
        
        $rowsDeleted = $this->db->affected_rows();
        
        if ($rowsDeleted > 0) {
            $this->db->where('sett_id', $id);
            $this->db->delete('pt_hotels_types_settings_translation');
        }
        
        
    }
    
    function getTypesTranslation($lang, $id)
    {
        
        $this->db->where('trans_lang', $lang);
        $this->db->where('sett_id', $id);
        return $this->db->get('pt_hotels_types_settings_translation')->result();
        
    }
    
    function uploadSettingIcon($oldfile = null)
    {
        
        if (!empty($_FILES)) {
            if (!empty($oldfile)) {
                @unlink(PT_HOTELS_ICONS_UPLOAD . $oldfile);
            }
            $tempFile = $_FILES['amticon']['tmp_name'];
            $fileName = $_FILES['amticon']['name'];
            $fileName = str_replace(" ", "-", $_FILES['amticon']['name']);
            $fig      = rand(1, 999999);
            $saveFile = $fig . '_' . $fileName;
            
            $targetPath = PT_HOTELS_ICONS_UPLOAD;
            
            $targetFile = $targetPath . $saveFile;
            move_uploaded_file($tempFile, $targetFile);
            return $saveFile;
        }
    }
    
    /*function get_Honeymoon()
    {
    $this->db->select('hotel_id');
    $this->db->from('pt_hotels');
    $this->db->join('pt_rooms','pt_rooms.room_hotel=pt_hotels.hotel_id');
    $this->db->where('pt_rooms.honey_moon','Yes');
    return $this->db->get()->result();
    }*/
    
    /*************End Hotel Settings Functions**************/
    
    // get all hotels for nearby backend
    function select_nearby($id = null)
    {
        $this->db->select('id,near');
        if (!empty($id)) {
            $this->db->where('id', $id);
        }
        $this->db->where('near is NOT NULL', NULL, FALSE);
        
        return $this->db->get('pt_locations')->result();
    }
    
    
    
    
}