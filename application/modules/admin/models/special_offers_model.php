<?php

class Special_offers_model extends CI_Model

{
    function __construct()
    {

        // Call the Model constructor

        parent::__construct();
    }

    function get_offer_data($slug)
    {
        $this->db->where('offer_slug', $slug);
        return $this->db->get('pt_special_offers')->result();
    }

    function makeSlug($title, $offerlastid = null)
    {
        $slug = create_url_slug($title);
        $this->db->select("offer_id");
        $this->db->where("offer_slug", $slug);
        if (!empty($offerlastid)) {
            $this->db->where('offer_id !=', $offerlastid);
        }

        $queryc = $this->db->get('pt_special_offers')->num_rows();
        if ($queryc > 0) {
            $slug = $slug . "-" . $offerlastid;
        }

        return $slug;
    }

    // Search hotels from home page
    function search($params, $perpage = null, $page = null)
    {
        $offset = null;
        if ($page != null) {
            $offset = ($page == 1) ? 0 : ($page * $perpage) - $perpage;
        }

        foreach ($params as $key => $value) {
            if ($key == 'offer_title') {
                $this->db->like('pt_special_offers.offer_title', $value);
            } else {
                if ($value) {
                    $this->db->where('pt_special_offers.' . $key, $value);
                }
            }
        }

        if (!empty($perpage)) {
            $this->db->limit($perpage, $offset);
            $query = $this->db->get('pt_special_offers');
            $data = $query->result();
        } else {
            $query = $this->db->get('pt_special_offers');
            $data = $query->num_rows();
        }

        return $data;
    }

    // add offer

    function add_offer()
    {
        $this->db->select("offer_id");
        $this->db->order_by("offer_id", "desc");
        $query = $this->db->get('pt_special_offers');
        $lastid = $query->result();
        $count = $query->num_rows();
        if (empty($lastid)) {
            $offerlastid = 1;
            $order = 1;
        } else {
            $offerlastid = $lastid[0]->offer_id + 1;
            $order = $count + 1;
        }

        $offerslug = $this->makeSlug($this->input->post('offertitle'), $offerlastid);
        $spfrom = $this->input->post('ofrom');
        $spto = $this->input->post('oto');
        if (!empty($spfrom) || !empty($spto)) {
            $isforever = '';
        } else {
            $isforever = 'forever';
        }

        $relatedhotels = @implode(",", $this->input->post('relatedhotels'));
        $data = array(
            'offer_title' => $this->input->post('offertitle'),
            'offer_desc' => $this->input->post('offerdesc'),
            'offer_price' => $this->input->post('offerprice'),
            'offer_from' => convert_to_unix($spfrom),
            'offer_to' => convert_to_unix($spto),
            'offer_forever' => $isforever,
            'offer_slug' => $offerslug,
            'offer_order' => $order,
            'offer_phone' => $this->input->post('offerphone'),
            'offer_email' => $this->input->post('offeremail'),
            'offer_status' => $this->input->post('offerstatus'),
            'offer_city' => $this->input->post('offercity'),
            'offer_type' => $this->input->post('offer_type'),
            'min_nights' => $this->input->post('min_nights'),
            'use_condition' => $this->input->post('use_condition'),
            'so_khach' => (int)$this->input->post('so_khach'),
            'show_price' => $this->input->post('show_price') == 1 ? 1 : 0,

            'cancel_condition' => $this->input->post('cancel_condition'),
            'hotel_related' => $relatedhotels,
            'offers_created_at' => time(),
        );
        $this->db->insert('pt_special_offers', $data);
        $offerid = $this->db->insert_id();
        // hotel_offers
        $relatedhotelsArr = $this->input->post('relatedhotels');

        if (!empty($relatedhotelsArr)) {
            foreach ($relatedhotelsArr as $hotel_id) {
                $this->db->insert('hotel_offers', ['hotel_id' => $hotel_id, 'type' => $this->input->post('offer_type'), 'offer_id' => $offerid]);
            }
        }
        //phu thu combo
        if ($this->input->post('offer_type') == 2) {
            $phuthuArr = $this->input->post('phu_thu');
            $phuthugiaArr = $this->input->post('phu_thu_gia');
            $phuthushowArr = $this->input->post('phu_thu_show');
            //var_dump($phuthuArr, $phuthugiaArr, $phuthushowArr);die;

            if (!empty($phuthuArr)) {
                foreach ($phuthuArr as $key => $loaiphuthu) {
                    if ($loaiphuthu != "") {
                        $phuthugia = isset($phuthugiaArr[$key]) ? $phuthugiaArr[$key] : 0;
                        $phuthushow = isset($phuthushowArr[$key]) ? 1 : 0;

                        $this->db->insert('phuthucombo', ['offer_id' => $offerid, 'name' => $loaiphuthu, 'price' => $phuthugia, 'show_price' => $phuthushow]);
                    }
                }
            }
        }
        $this->update_translation($this->input->post('translated'), $offerid);
    }

    // udpate Special Offer

    function update_offer($id)
    {
        $offerslug = $this->makeSlug($this->input->post('offertitle'), $id);
        $spfrom = $this->input->post('ofrom');
        $spto = $this->input->post('oto');
        if (!empty($spfrom) || !empty($spto)) {
            $isforever = '';
        } else {
            $isforever = 'forever';
        }

        $relatedhotels = @implode(",", $this->input->post('relatedhotels'));
        $data = array(
            'offer_title' => $this->input->post('offertitle'),
            'offer_desc' => $this->input->post('offerdesc'),
            'offer_price' => $this->input->post('offerprice'),
            'offer_from' => convert_to_unix($spfrom),
            'offer_to' => convert_to_unix($spto),
            'offer_forever' => $isforever,
            'offer_slug' => $offerslug,
            'offer_phone' => $this->input->post('offerphone'),
            'offer_email' => $this->input->post('offeremail'),
            'offer_status' => $this->input->post('offerstatus'),
            'offer_city' => $this->input->post('offercity'),
            'offer_type' => $this->input->post('offer_type'),
            'min_nights' => $this->input->post('min_nights'),
            'show_price' => $this->input->post('show_price') == 1 ? 1 : 0,
            'use_condition' => $this->input->post('use_condition'),
            'so_khach' => (int)$this->input->post('so_khach'),
            'cancel_condition' => $this->input->post('cancel_condition'),
            'hotel_related' => $relatedhotels
        );
        $this->db->where('offer_id', $id);
        $this->db->update('pt_special_offers', $data);

        // hotel_offers
        $relatedhotelsArr = $this->input->post('relatedhotels');
        $this->db->where('hotel_offers.offer_id', $id)->delete('hotel_offers');
        if (!empty($relatedhotelsArr)) {
            foreach ($relatedhotelsArr as $hotel_id) {
                $this->db->insert('hotel_offers', ['hotel_id' => $hotel_id, 'offer_id' => $id]);
            }
        }

        //phu thu combo
        if ($this->input->post('offer_type') == 2) {
            $phuthuArr = $this->input->post('phu_thu');
            $phuthugiaArr = $this->input->post('phu_thu_gia');
            $phuthushowArr = $this->input->post('phu_thu_show');

            $phuthuidArr = $this->input->post('phu_thu_id');
            if (!empty($phuthuArr)) {
                foreach ($phuthuArr as $key => $loaiphuthu) {
                    if ($loaiphuthu != "") {
                        $phuthugia = isset($phuthugiaArr[$key]) ? $phuthugiaArr[$key] : 0;
                        $phuthushow = isset($phuthushowArr[$key]) ? $phuthushowArr[$key] : 0;

                        if ($phuthuidArr[$key] > 0) {
                            $this->db->where('phuthucombo.id', $phuthuidArr[$key]);
                            $this->db->update('phuthucombo', ['offer_id' => $id, 'name' => $loaiphuthu, 'price' => $phuthugia, 'show_price' => $phuthushow]);
                        } else {
                            $this->db->insert('phuthucombo', ['offer_id' => $id, 'name' => $loaiphuthu, 'price' => $phuthugia, 'show_price' => $phuthushow]);
                        }

                    } else {
                        if ($phuthuidArr[$key] > 0) {
                            $this->db->where('phuthucombo.id', $phuthuidArr[$key]);
                            $this->db->delete('phuthucombo');
                        }
                    }
                }
            }
        }
        die;
        $this->update_translation($this->input->post('translated'), $id);

        //

    }

    // Remove From special offers

    function remove_from_specialoffer($id)
    {
        $this->db->where('offer_id', $id);
        $this->db->delete('pt_special_offers');
    }

    /*end add_supplement() */

    // get all extras

    function get_all_extras()
    {
        $this->db->order_by('extras_id', 'desc');
        return $this->db->get('pt_extras')->result();
    }

    // Disable Offer

    public function disable_offer($id)
    {
        $data = array(
            'offer_status' => '0'
        );
        $this->db->where('offer_id', $id);
        $this->db->update('pt_special_offers', $data);
    }

    // Enable Offer

    public function enable_offer($id)
    {
        $data = array(
            'offer_status' => '1'
        );
        $this->db->where('offer_id', $id);
        $this->db->update('pt_special_offers', $data);
    }

    function delete_supp($id)
    {
        $this->db->select('extras_image');
        $this->db->where('extras_id', $id);
        $suppimgs = $this->db->get('pt_extras')->result();
        if (!empty($suppimgs)) {
            @unlink(PT_EXTRAS_IMAGES_UPLOAD . $suppimgs[0]->extras_image);
        }

        $this->db->where('extras_id', $id);
        $this->db->delete('pt_extras');
    }

    // / List all offers on front listings page
    function list_specialOffers_front($perpage = null, $page = null, $loc = null, $type = 1, $hotelid = null)
    {
        $data = array();

        $offset = null;
        if (!empty($page)) {
            $offset = ($page == 1) ? 0 : ($page * $perpage) - $perpage;
        }

        if (!empty($loc)) {
            $this->db->where('pt_special_offers.offer_city', $loc);
        }

        $time = time();
        $where = "((pt_special_offers.offer_from < " . $time . " AND pt_special_offers.offer_to > " . $time . ") OR pt_special_offers.offer_forever = 'forever')";
        $this->db->where($where);
        $this->db->where('pt_special_offers.offer_status', 'Yes');
        $this->db->where('pt_special_offers.offer_type = ', $type);
        $this->db->order_by('pt_special_offers.offer_id', 'desc');
        if (!empty($hotelid)) {
            $this->db->join('hotel_offers', 'pt_special_offers.offer_id = hotel_offers.offer_id');
            $this->db->where('hotel_offers.hotel_id = ', $hotelid);
        }
        $query = $this->db->get('pt_special_offers', $perpage, $offset);
        $data['all'] = $query->result();
        $data['rows'] = $query->num_rows();

        return $data;
    }

    // get all special offers admin

    function admin_get_all_special_offers()
    {
        $this->db->order_by('offer_id', 'desc');
        return $this->db->get('pt_special_offers')->result();
    }

    // get all bookings with limit

    function admin_get_all_special_offers_limit($perpage = null, $offset = null, $orderby = null)
    {
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }

        $this->db->order_by('offer_id', 'desc');
        $query = $this->db->get('pt_special_offers', $perpage, $offset);
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    // get all bookings info  by advance search for admin

    function adv_search_all_offers_back_limit($data, $perpage = null, $offset = null, $orderby = null)
    {
        $status = $data["status"];
        $module = $data["module"];
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }

        if (!empty($module)) {
            $this->db->where('offer_module', $module);
        }

        $this->db->where('offer_status', $status);
        $this->db->order_by('offer_id', 'desc');
        $query = $this->db->get('pt_special_offers', $perpage, $offset);
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    // update offer order

    function update_offer_order($id, $order)
    {
        $data = array(
            'offer_order' => $order
        );
        $this->db->where('offer_id', $id);
        $this->db->update('pt_special_offers', $data);
    }

    // Update translation of some fields data

    function update_translation($postdata, $id)
    {
        foreach ($postdata as $lang => $val) {
            if (array_filter($val)) {
                $title = $val['title'];
                $desc = $val['desc'];
                $transAvailable = $this->getBackOffersTranslation($lang, $id);
                if (empty($transAvailable)) {
                    $data = array(
                        'trans_title' => $title,
                        'trans_desc' => $desc,
                        'trans_offer_id' => $id,
                        'trans_lang' => $lang
                    );
                    $this->db->insert('pt_offers_translation', $data);
                } else {
                    $data = array(
                        'trans_title' => $title,
                        'trans_desc' => $desc,
                    );
                    $this->db->where('trans_offer_id', $id);
                    $this->db->where('trans_lang', $lang);
                    $this->db->update('pt_offers_translation', $data);
                }
            }
        }
    }

    function getBackOffersTranslation($lang, $id)
    {
        $this->db->where('trans_lang', $lang);
        $this->db->where('trans_offer_id', $id);
        return $this->db->get('pt_offers_translation')->result();
    }

    // Delete Offer

    function deleteOffer($id)
    {
        $this->db->select('oimg_offer_id,oimg_image');
        $this->db->where('oimg_offer_id', $id);
        $offerimgs = $this->db->get('pt_offer_images')->result();
        foreach ($offerimgs as $img) {
            @unlink(PT_OFFERS_IMAGES_UPLOAD . $img->oimg_image);
            @unlink(PT_OFFERS_THUMBS_UPLOAD . $img->oimg_image);
            $this->db->where('oimg_offer_id', $img->oimg_offer_id);
            $this->db->delete('pt_offer_images');
        }

        $this->deleteOfferTranslations($id);
        $this->db->where('offer_id', $id);
        $this->db->delete('pt_special_offers');
    }

    function deleteOfferTranslations($id)
    {
        $this->db->where('trans_offer_id', $id);
        $this->db->delete('pt_offers_translation');
    }

    function addPhotos($id, $filename)
    {
        $this->db->select('offer_thumb');
        $this->db->where('offer_id', $id);
        $rs = $this->db->get('pt_special_offers')->result();
        if ($rs[0]->offer_thumb == PT_BLANK_IMG) {
            $data = array(
                'offer_thumb' => $filename
            );
            $this->db->where('offer_id', $id);
            $this->db->update('pt_special_offers', $data);
        }

        // add photos to offer images table

        $imgorder = 0;
        $this->db->where('oimg_offer_id', $id);
        $imgorder = $this->db->get('pt_offer_images')->num_rows();
        $imgorder = $imgorder + 1;
        $insdata = array(
            'oimg_offer_id' => $id,
            'oimg_image' => $filename,
            'oimg_order' => $imgorder,
        );
        $this->db->insert('pt_offer_images', $insdata);
    }

    // get offer gallery images

    function offerGallery($id)
    {
        $this->db->select('pt_special_offers.offer_thumb as thumbnail,pt_offer_images.oimg_id as id,pt_offer_images.oimg_offer_id as itemid,pt_offer_images.oimg_image as image,pt_offer_images.oimg_order as imgorder');
        $this->db->where('pt_special_offers.offer_id', $id);
        $this->db->join('pt_offer_images', 'pt_special_offers.offer_id = pt_offer_images.oimg_offer_id', 'left');
        $this->db->order_by('pt_offer_images.oimg_id', 'desc');
        return $this->db->get('pt_special_offers')->result();
    }

    // get number of photos of offer

    function photos_count($id)
    {
        $this->db->where('oimg_offer_id', $id);
        return $this->db->get('pt_offer_images')->num_rows();
    }

    // update offer image order

    function update_offer_image_order($imgid, $order)
    {
        $data = array(
            'oimg_order' => $order
        );
        $this->db->where('oimg_id', $imgid);
        $this->db->update('pt_offer_images', $data);
    }

    // update offer thumbnail

    function updateOfferThumb($offerid, $imgname, $action)
    {
        if ($action == "delete") {
            $this->db->select('offer_thumb');
            $this->db->where('offer_thumb', $imgname);
            $this->db->where('offer_id', $offerid);
            $rs = $this->db->get('pt_special_offers')->num_rows();
            if ($rs > 0) {
                $data = array(
                    'offer_thumb' => PT_BLANK_IMG
                );
                $this->db->where('offer_id', $offerid);
                $this->db->update('pt_special_offers', $data);
            }
        } else {
            $data = array(
                'offer_thumb' => $imgname
            );
            $this->db->where('offer_id', $offerid);
            $this->db->update('pt_special_offers', $data);
        }
    }

    // Delete offer Images

    function delete_image($imgname = null, $imgid = null, $offerid = null)
    {
        $this->db->where('oimg_id', $imgid);
        $this->db->delete('pt_offer_images');
        $this->updateOfferThumb($offerid, $imgname, "delete");
        @unlink(PT_OFFERS_THUMBS_UPLOAD . $imgname);
        @unlink(PT_OFFERS_IMAGES_UPLOAD . $imgname);
    }

    function offerExists($slug)
    {
        $this->db->where('offer_slug', $slug);
        $nums = $this->db->get('pt_special_offers')->num_rows();
        if ($nums > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // search offers by text

    function searchOffers($perpage = null, $page = null, $dfrom = null, $dto = null)
    {
        $data = array();
        $searchtxt = $this->input->get('searching');

        // $hotelslist = $lists['hotels'];
        $offset = null;
        if (!empty($page)) {
            $offset = ($page == 1) ? 0 : ($page * $perpage) - $perpage;
        }

        $this->db->select('pt_special_offers.*,pt_offers_translation.trans_title');
        if (!empty($searchtxt)) {
            $this->db->like('pt_special_offers.offer_title', $searchtxt);
            $this->db->or_like('pt_offers_translation.trans_title', $searchtxt);
        }

        if (!empty($dfrom) && !empty($dto)) {
            $this->db->where('pt_special_offers.offer_from <=', $dfrom);
            $this->db->where('pt_special_offers.offer_to >=', $dto);
            $this->db->or_where('pt_special_offers.offer_forever', 'forever');
        }

        $this->db->join('pt_offers_translation', 'pt_special_offers.offer_id = pt_offers_translation.trans_offer_id', 'left');
        $this->db->group_by('pt_special_offers.offer_id');
        $this->db->having('pt_special_offers.offer_status', 'Yes');
        $query = $this->db->get('pt_special_offers', $perpage, $offset);
        $data['all'] = $query->result();
        $data['rows'] = $query->num_rows();
        return $data;
    }
}

