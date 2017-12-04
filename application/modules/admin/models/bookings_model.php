<?php

class Bookings_model extends CI_Model
{
    private $data = array();

    function __construct()
    {
        // Call the Model constructor
        parent:: __construct();
        $this->load->model('admin/accounts_model');
        $this->load->model('admin/emails_model');
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $this->load->helper('invoice');
    }

    function admin_get_all_bookings($type = null)
    {
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        if (!empty ($type)) {
            $this->db->where('pt_bookings.booking_type', $type);
        }
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        return $this->db->get('pt_bookings')->result();
    }

    // get all bookings
    function get_all_bookings_back_admin()
    {
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
            pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
            booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        $query = $this->db->get('pt_bookings');
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    // get all bookings with limit
    function get_all_bookings_back_limit_admin($perpage = null, $offset = null, $orderby = null)
    {
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
          pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
          booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        $query = $this->db->get('pt_bookings', $perpage, $offset);
        $data['all'] = $query->result();
        // $data['nums'] = $query->num_rows();
        return $data;
    }

    // get all bookings info  by search for admin
    function search_all_bookings_back_limit_admin($term, $perpage = null, $offset = null, $orderby = null)
    {
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
          pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
          booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        $this->db->like('pt_bookings.booking_type', $term);
        $this->db->or_like('pt_bookings.booking_id', $term);
        $this->db->or_like('pt_accounts.ai_first_name', $term);
        $this->db->or_like('pt_accounts.ai_last_name', $term);
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        $query = $this->db->get('pt_bookings', $perpage, $offset);
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    // get all bookings info  by advance search for admin
    function adv_search_all_bookings_back_limit_admin($data, $perpage = null, $offset = null, $orderby = null)
    {
        $invoice = $data["invoiceno"];
        $invoicefromdate = $data["invoicefromdate"];
        $invoicetodate = $data["invoicetodate"];
        $status = $data["status"];
        $customername = $data["customername"];
        $module = $data["module"];
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
          pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
          booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        if (!empty ($invoice)) {
            $this->db->where('pt_bookings.booking_id', $invoice);
        }
        if (!empty ($module)) {
            $this->db->where('pt_bookings.booking_type', $module);
        }
        if (!empty ($status)) {
            $this->db->where('pt_bookings.booking_status', $status);
        }
        if (!empty ($customername)) {
            $this->db->like('pt_accounts.ai_first_name', $customername);
            $this->db->or_like('pt_accounts.ai_last_name', $customername);
        }
        if (!empty ($invoicefromdate)) {
            $this->db->where('pt_bookings.booking_date >=', $invoicefromdate);
            $this->db->where('pt_bookings.booking_date <=', $invoicetodate);
        }
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        $query = $this->db->get('pt_bookings', $perpage, $offset);
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    // Get supplier's bookings
    function supplier_get_all_bookings($myitems)
    {
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
          pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
          booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        if (!empty ($myitems)) {
            $this->db->where_in('pt_bookings.booking_item', $myitems);
        } else {
            $this->db->where('pt_bookings.booking_item', 0);
        }
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        $query = $this->db->get('pt_bookings');
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    // Get supplier's bookings in limit
    function supplier_get_all_bookings_limit($myitems, $perpage = null, $offset = null, $orderby = null)
    {
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
        pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
        booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        if (!empty ($myitems)) {
            $this->db->where_in('pt_bookings.booking_item', $myitems);
        } else {
            $this->db->where('pt_bookings.booking_item', 0);
        }
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        $query = $this->db->get('pt_bookings', $perpage, $offset);
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    // get all bookings info  by search for admin
    function search_all_bookings_back_limit_supplier($term, $myitems, $perpage = null, $offset = null, $orderby = null)
    {
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
        pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
        booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        $this->db->like('pt_bookings.booking_type', $term);
        $this->db->or_like('pt_bookings.booking_id', $term);
        $this->db->or_like('pt_accounts.ai_first_name', $term);
        $this->db->or_like('pt_accounts.ai_last_name', $term);
        if (!empty ($myitems)) {
            $this->db->where_in('pt_bookings.booking_item', $myitems);
        } else {
            $this->db->where('pt_bookings.booking_item', 0);
        }
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        $query = $this->db->get('pt_bookings', $perpage, $offset);
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    // get all bookings info  by advance search for admin
    function adv_search_all_bookings_back_limit_supplier($data, $myitems, $perpage = null, $offset = null, $orderby = null)
    {
        $invoice = $data["invoiceno"];
        $invoicefromdate = $data["invoicefromdate"];
        $invoicetodate = $data["invoicetodate"];
        $status = $data["status"];
        $customername = $data["customername"];
        $module = $data["module"];
        if ($offset != null) {
            $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
        }
        $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
        pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
        booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
        if (!empty ($invoice)) {
            $this->db->where('pt_bookings.booking_id', $invoice);
        }
        if (!empty ($module)) {
            $this->db->where('pt_bookings.booking_type', $module);
        }
        if (!empty ($status)) {
            $this->db->where('pt_bookings.booking_status', $status);
        }
        if (!empty ($customername)) {
            $this->db->like('pt_accounts.ai_first_name', $customername);
            $this->db->or_like('pt_accounts.ai_last_name', $customername);
        }
        if (!empty ($invoicefromdate)) {
            $this->db->where('pt_bookings.booking_date >=', $invoicefromdate);
            $this->db->where('pt_bookings.booking_date <=', $invoicetodate);
        }
        if (!empty ($myitems)) {
            $this->db->where_in('pt_bookings.booking_item', $myitems);
        } else {
            $this->db->where('pt_bookings.booking_item', 0);
        }
        $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
        $this->db->order_by('pt_bookings.booking_id', 'desc');
        $query = $this->db->get('pt_bookings', $perpage, $offset);
        $data['all'] = $query->result();
        $data['nums'] = $query->num_rows();
        return $data;
    }

    function do_login_booking($username, $password)
    {
        $login = $this->accounts_model->login_customer($username, $password);
        if ($login) {
            $userid = $this->session->userdata('pt_logged_customer');
            return $this->do_booking($userid);
        } else {
            $bookingResult = array("error" => "yes", 'msg' => 'Invalid Email or Password');
            return $bookingResult;
        }
    }

    function do_customer_booking()
    {
        $userid = $this->accounts_model->signup_account('customers', '1');
        return $this->do_booking($userid);
    }

    function doGuestBooking($bookquick = null)
    {
        $userid = $this->accounts_model->signup_account('guest', '0');

        if (empty($bookquick)) {
            return $this->do_booking($userid);
        } else {
            return $this->doQuickBooking($userid);
        }

    }

    function do_booking($userid)
    {
        $this->load->library('currconverter');

        $paymethod = $this->input->post('checkout-type');
        $bookingtype = $this->input->post('btype');
        $sent_invoice = $this->input->post('sent_invoice');
        $nguoikhac = $this->input->post('nguoikhac');
        $guest = $this->input->post('guest');
        $sentto = $this->input->post('sentto');
        $company = $this->input->post('company');
        $mst = $this->input->post('mst');
        $companyadd = $this->input->post('companyadd');
        $itemid = $this->input->post('itemid');

        if ($paymethod == "cod") {
            $payinfo = $this->input->post('txtAddress');
        } elseif ($paymethod == "banktransfer") {
            $bank = $this->input->post('bank');
            $payinfo = $this->input->post($bank);
        } else {
            $payinfo = "Địa chỉ: Lầu 1, Số 124 Khánh Hội, P.6, Quận 4, Tp. Hồ Chí Minh - Tel: 028 3826 8797 - Fax: (08) 3826 8798";
        }
        $passportInfo = "";
        $refno = random_string('numeric', 7);
        if ($bookingtype == "hotels") {
            $refno = "HP" . random_string('numeric', 7);
            $this->load->library('hotels/hotels_lib');
        } // add code desktop

        $coupon = $this->input->post('couponid');
        $coupon_code = "";
        if ($coupon > 0) {
            $this->updateCoupon($coupon);
            $coupon_code = $this->input->post('coupon_code');
        }

        $expiry = $this->data['app_settings'][0]->booking_expiry * 86400;

        try {
            if ($bookingtype != 'offers') {
                $subitemid = $this->input->post('subitemid');
                $checkin = $this->input->post('checkin');
                $checkout = $this->input->post('checkout');
                $roomscount = $this->input->post('roomscount');
                $extrabeds = $this->input->post('so_giuong_phu');
                $extrabedscharges = $this->input->post('phi_giuong_phu');
                $honeymoon = $this->input->post('honeymoon');
                $phi_dich_vu = $this->input->post('phi_dich_vu');
                $phi_vat = $this->input->post('phi_vat');

                $checkin = databaseDate($checkin);
                $checkout = databaseDate($checkout);

                $data = array(
                    'booking_ref_no' => $refno,
                    'booking_type' => $bookingtype,
                    'booking_item' => $itemid,
                    'booking_subitem' => $subitemid,
                    'booking_date' => time(),
                    'booking_expiry' => time() + $expiry,
                    'booking_user' => $userid,
                    'booking_status' => 'unpaid',
                    'booking_additional_notes' => $this->input->post('additionalnotes'),
                    'booking_total' => $this->input->post('tong_thanh_toan'),
                    'booking_remaining' => $this->input->post('tong_chua_giam'),
                    'booking_checkin' => $checkin,
                    'booking_checkout' => $checkout,
                    'booking_nights' => $this->input->post('nights'),
                    'booking_adults' => $this->input->post('adults'),
                    'booking_child' => $this->input->post('child'),
                    'booking_payment_type' => $paymethod,
                    'booking_payment_info' => $payinfo,
                    'honeymoon' => $honeymoon,
                    'nguoikhac' => $nguoikhac,
                    'sent_invoice' => $sent_invoice,
                    'company' => $company,
                    'mst' => $mst,
                    'companyadd' => $companyadd,
                    'guest' => $guest,
                    'sentto' => $sentto,
                    'booking_extra_beds' => $extrabeds,
                    'booking_extra_beds_charges' => $extrabedscharges,
                    'booking_deposit' => empty($phi_dich_vu) ? 0 : $phi_dich_vu,
                    'booking_tax' => empty($phi_vat) ? 0 : $phi_vat,
                    'booking_paymethod_tax' => 0,
                    'booking_curr_code' => 'VND',
                    'booking_curr_symbol' => 'vnd',
                    'booking_coupon_rate' => $this->input->post('giam_gia'),
                    'booking_coupon' => $coupon_code,
                    'booking_guest_info' => $passportInfo
                );
                $this->db->insert('pt_bookings', $data);
                $book_id = $this->db->insert_id();
                $this->session->set_userdata("BOOKING_ID", $book_id);
                $this->session->set_userdata("REF_NO", $refno);

                if ($bookingtype == "hotels") {
                    $room_ids = json_decode($subitemid, true);
                    $roomscounts = json_decode($roomscount, true);

                    foreach ($room_ids as $room_id) {
                        $rdata = array(
                            'booked_booking_id' => $book_id,
                            'booked_room_id' => $room_id,
                            'booked_room_count' => $roomscounts[$room_id],
                            'booked_checkin' => $checkin,
                            'booked_checkout' => $checkout,
                            'booked_booking_status' => 'unpaid'
                        );

                        $this->db->insert('pt_booked_rooms', $rdata);
                    }
                } elseif ($bookingtype == "cars") {
                    /*$cdata = array(
                        'booked_booking_id' => $bookid,
                        'booked_car_id' => $itemid,
                        'booked_pickupdate' => $checkin,
                        'booked_pickuptime' => $pickuptime,
                        'booked_pickuplocation' => $pickup,
                        'booked_dropofflocation' => $drop,
                        'booked_dropoffDate' => databaseDate($dropdate),
                        'booked_dropoffTime' => $droptime,
                        'booked_booking_status' => 'unpaid'
                    );
                    $this->db->insert('pt_booked_cars', $cdata);*/
                }
            } else {
                $checkin = $this->input->post('checkin');
                $surcharge = $this->input->post('surcharge');
                $quantity = $this->input->post('quantity');
                $checkin = databaseDate($checkin);

                $data = array(
                    'booking_ref_no' => $refno,
                    'booking_type' => $bookingtype,
                    'booking_item' => $itemid,
                    'booking_subitem' => $surcharge,
                    'booking_quantity' => $quantity,
                    'booking_date' => time(),
                    'booking_expiry' => time() + $expiry,
                    'booking_user' => $userid,
                    'booking_status' => 'unpaid',
                    'booking_additional_notes' => $this->input->post('additionalnotes'),
                    'booking_total' => $this->input->post('tong_thanh_toan'),
                    'booking_remaining' => $this->input->post('tong_chua_giam'),
                    'booking_checkin' => $checkin,
                    'booking_checkout' => $checkin,
                    'booking_nights' => $this->input->post('nights'),
                    'booking_payment_type' => $paymethod,
                    'booking_payment_info' => $payinfo,
                    'nguoikhac' => $nguoikhac,
                    'sent_invoice' => $sent_invoice,
                    'company' => $company,
                    'mst' => $mst,
                    'companyadd' => $companyadd,
                    'guest' => $guest,
                    'sentto' => $sentto,
                    'booking_deposit' => 0,
                    'booking_tax' => 0,
                    'booking_paymethod_tax' => 0,
                    'booking_curr_code' => 'VND',
                    'booking_curr_symbol' => 'vnd',
                    'booking_coupon_rate' => $this->input->post('giam_gia'),
                    'booking_coupon' => $coupon_code,
                    'booking_guest_info' => $passportInfo
                );
                $this->db->insert('pt_bookings', $data);
                $book_id = $this->db->insert_id();
                $this->session->set_userdata("BOOKING_ID", $book_id);
                $this->session->set_userdata("REF_NO", $refno);

                $surcharge_info = json_decode($surcharge, true);

                foreach ($surcharge_info as $id => $value) {
                    $rdata = array(
                        'booked_booking_id' => $book_id,
                        'booked_room_id' => $id,
                        'booked_room_count' => $value,
                        'booked_checkin' => $checkin,
                        'booking_checkout' => $checkin,
                        'booked_booking_status' => 'unpaid'
                    );

                    $this->db->insert('pt_booked_rooms', $rdata);
                }
            }

            $url = base_url() . 'invoice?id=' . $book_id . '&sessid=' . $refno;
            $bookingResult = array("error" => "no", 'msg' => '', 'url' => $url);
            $invoicedetails = invoiceDetails($book_id, $refno);

            $this->emails_model->sendEmail_customer($invoicedetails, $this->data['app_settings'][0]->site_title);
            $this->emails_model->sendEmail_admin($invoicedetails, $this->data['app_settings'][0]->site_title);
            //$this->emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);
            //$this->emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);
        } catch (Exception $e) {
            $bookingResult = array("error" => "yes", 'msg' => $e->getMessage());
        }

        return $bookingResult;
    }


    //Do quick booking by admin
    function doQuickBooking($userid)
    {


        $this->load->library('currconverter');
        $itemid = $this->input->post('itemid');
        $subitemid = $this->input->post('subitemid');
        $roomscount = $this->input->post('roomscount');
        $bookingtype = $this->input->post('btype');
        $quickDeposit = $this->input->post('quickDeposit');
        $extras = $this->input->post('extras');
        $perNight = $this->input->post('perNight');
        $grandtotal = $this->input->post('grandtotal');
        $stay = $this->input->post('stay');
        $paymethod = $this->input->post('checkout-type');
        $honeymoon = $this->input->post('honeymoon');
        $sent_invoice = $this->input->post('sent_invoice');
        $nguoikhac = $this->input->post('nguoikhac');
        $guest = $this->input->post('guest');
        $sentto = $this->input->post('sentto');
        $company = $this->input->post('company');
        $mst = $this->input->post('mst');
        $companyadd = $this->input->post('companyadd');
        if ($paymethod == "cod") {
            $payinfo = $this->input->post('txtAddress');
        } elseif ($paymethod == "banktransfer") {
            $bank = $this->input->post('bank');
            $payinfo = $this->input->post($bank);
        } else {
            $payinfo = "";
        }
        $passportInfo = "";

        $expiry = $this->data['app_settings'][0]->booking_expiry * 86400;
        $paymethodfee = 0;


        $extrabeds = 0;//$this->input->post('bedscount');

        if ($bookingtype == "hotels") {
            $this->load->library('hotels/hotels_lib');
            $extrasInfo = $this->hotels_lib->extrasFee($extras);
            $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
            $subitemData = json_encode(array("id" => $subitemid, "price" => $perNight, "count" => $roomscount));

        } elseif ($bookingtype == "tours") {
            $adults = $this->input->post('adults');
            $child = $this->input->post('children');
            $infant = $this->input->post('infants');


            /* $checkin = $this->input->post('checkin');
             $checkout = $this->input->post('checkin');
                  */


            $this->load->library('tours/tours_lib');
            $extrasInfo = $this->tours_lib->extrasFee($extras);
            $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
            $bookingData = json_decode($this->tours_lib->getUpdatedDataBookResultObject($itemid, $adults, $child, $infant, $extras));
            $subitemData = json_encode($bookingData->subitem);
        } elseif ($bookingtype == "cars") {


            $this->load->library('cars/cars_lib');
            $extrasInfo = $this->cars_lib->extrasFee($extras);
            $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
            $bookingData = json_decode($this->cars_lib->getUpdatedDataBookResultObject($itemid, $extras));
            $subitemData = json_encode($bookingData->subitem);
        }

        $checkin = databaseDate($this->input->post('checkin'));
        $checkout = databaseDate($this->input->post('checkout'));
        $tax = $this->input->post('taxamount');

        $extrasTotalFee = $this->input->post('totalsupamount');

        $currCode = $this->input->post('currencycode');
        $currSymbol = $this->input->post('currencysign');

        $extrabedscharges = 0;//$this->currconverter->convertPriceFloat($bookingData->extraBedCharges);
        $refno = random_string('numeric', 4);

        $data = array('booking_ref_no' => $refno, 'booking_type' => $bookingtype,
            'booking_item' => $itemid,
            'booking_subitem' => $subitemData,
            'booking_extras' => $extrasData, 'booking_date' => time(),
            'booking_expiry' => time() + $expiry, 'booking_user' => $userid,
            'booking_status' => 'unpaid',
            'booking_additional_notes' => "",
            'booking_total' => $grandtotal,
            'booking_remaining' => $grandtotal,
            'booking_checkin' => $checkin,
            'booking_checkout' => $checkout,
            'booking_nights' => $stay,
            'booking_adults' => '1',
            'booking_child' => '0',
            'booking_payment_type' => $this->input->post('paymethod'),
            'booking_deposit' => $quickDeposit,
            'booking_tax' => $tax,
            'booking_paymethod_tax' => $paymethodfee,
            'booking_extras_total_fee' => $extrasTotalFee,
            'booking_curr_code' => $currCode,
            'booking_curr_symbol' => $currSymbol,
            'booking_extra_beds' => $extrabeds,
            'booking_extra_beds_charges' => $extrabedscharges,
            'booking_payment_type' => $paymethod, 'booking_payment_info' => $payinfo, 'honeymoon' => $honeymoon,
            'nguoikhac' => $nguoikhac, 'sent_invoice' => $sent_invoice, 'company' => $company, 'mst' => $mst, 'companyadd' => $companyadd, 'guest' => $guest, 'sentto' => $sentto,
        );

        $this->db->insert('pt_bookings', $data);
        $bookid = $this->db->insert_id();


        if ($bookingtype == "hotels") {
            $rdata = array('booked_booking_id' => $bookid, 'booked_room_id' => $subitemid, 'booked_room_count' => $roomscount, 'booked_checkin' => $checkin, 'booked_checkout' => $checkout, 'booked_booking_status' => 'unpaid');
            $this->db->insert('pt_booked_rooms', $rdata);
        } elseif ($bookingtype == "cars") {
            $cdata = array('booked_booking_id' => $bookid, 'booked_car_id' => $this->input->post('itemid'), 'booked_checkin' => convert_to_unix($checkin), 'booked_checkout' => convert_to_unix($checkout), 'booked_booking_status' => 'unpaid');
            $this->db->insert('pt_booked_cars', $cdata);
        }

        $invoicedetails = invoiceDetails($bookid, $refno);

        $this->emails_model->sendEmail_customer($invoicedetails, $this->data['app_settings'][0]->site_title);
        //$this->emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);
        $this->emails_model->sendEmail_admin($invoicedetails, $this->data['app_settings'][0]->site_title);
        //$this->emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);


    }

    //Update booking details
    function update_booking($id)
    {
        $status = $this->input->post('status');
        $deposit = $this->input->post('totaltopay');
        $total = $this->input->post('grandtotal');
        $bookingtype = $this->input->post('btype');
        $bookid = $this->input->post('bookingid');
        if ($status == "paid") {
            $remaining = $total - $deposit;
            $paid = $deposit;
            $paytime = time();
        } else {
            $remaining = $total;
            $paid = 0;
        }

        $data = array(
            'booking_status' => $status,
            'booking_deposit' => $deposit,
            'booking_payment_type' => $this->input->post('paymethod'),
            'booking_remaining' => $remaining,
            'booking_amount_paid' => $paid,
            'booking_payment_date' => $paytime
        );
        $this->db->where('booking_id', $bookid);
        $this->db->update('pt_bookings', $data);

        if ($bookingtype == "hotels") {

            $rdata = array('booked_booking_status' => $status);
            $this->db->where('booked_booking_id', $bookid);
            $this->db->update('pt_booked_rooms', $rdata);

        } elseif ($bookingtype == "cars") {
            $cdata = array('booked_booking_status' => $status);
            $this->db->where('booked_booking_id', $bookid);
            $this->db->update('pt_booked_cars', $cdata);
        }

        if ($status == "paid") {
            $refno = $this->input->post('refcode');

            $invoicedetails = invoiceDetails($bookid, $refno);

            $this->emails_model->paid_sendEmail_customer($invoicedetails, $this->data['app_settings'][0]->site_title);
            //$this->emails_model->paid_sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);
            $this->emails_model->paid_sendEmail_admin($invoicedetails, $this->data['app_settings'][0]->site_title);
            //$this->emails_model->paid_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);


        }

    }

    function delete_booking($id)
    {
        $this->db->where('booking_id', $id);
        $this->db->delete('pt_bookings');
        $this->db->where('booked_booking_id', $id);
        $this->db->delete('pt_booked_rooms');
        $this->db->where('review_booking_id', $id);
        $this->db->delete('pt_reviews');
        $this->db->where('booked_booking_id', $id);
        $this->db->delete('pt_booked_cars');
    }

    function cancel_booking($id)
    {
        $updata = array('booking_status' => 'cancelled');
        $this->db->where('booking_id', $id);
        $this->db->update('pt_bookings', $updata);
        $this->db->where('booked_booking_id', $id);
        $this->db->delete('pt_booked_rooms');
        $this->db->where('booked_booking_id', $id);
        $this->db->delete('pt_booked_cars');
        $this->db->where('review_booking_id', $id);
        $this->db->delete('pt_reviews');
    }

    // change booking status to paid
    function booking_status_paid($id)
    {
        $this->db->select('booking_total,booking_deposit,booking_type');
        $this->db->where('booking_id', $id);
        $bk = $this->db->get('pt_bookings')->result();
        $btotal = $bk[0]->booking_total;
        $bdep = $bk[0]->booking_deposit;
        $btype = $bk[0]->booking_type;
        $data1 = array('booking_status' => 'paid', 'booking_amount_paid' => $bdep, 'booking_remaining' => $btotal - $bdep, 'booking_payment_date' => time());
        $this->db->where('booking_id', $id);
        $this->db->update('pt_bookings', $data1);
        if ($btype == "hotels") {
            $data2 = array('booked_booking_status' => 'paid');
            $this->db->where('booked_booking_id', $id);
            $this->db->update('pt_booked_rooms', $data2);
        } elseif ($btype == "cruises") {
            $data2 = array('booked_booking_status' => 'paid');
            $this->db->where('booked_booking_id', $id);
            $this->db->update('pt_booked_cruise_rooms', $data2);
        } elseif ($btype == "cars") {
            $data3 = array('booked_booking_status' => 'paid');
            $this->db->where('booked_booking_id', $id);
            $this->db->update('pt_booked_cars', $data3);
        }
    }

    // change booking status to unpaid
    function booking_status_unpaid($id)
    {
        $this->db->select('booking_total,booking_deposit,booking_type');
        $this->db->where('booking_id', $id);
        $bk = $this->db->get('pt_bookings')->result();
        $btotal = $bk[0]->booking_total;
        $bdep = $bk[0]->booking_deposit;
        $btype = $bk[0]->booking_type;
        $data1 = array('booking_status' => 'unpaid', 'booking_amount_paid' => 0, 'booking_remaining' => $btotal,);
        $this->db->where('booking_id', $id);
        $this->db->update('pt_bookings', $data1);
        if ($btype == "hotels") {
            $data2 = array('booked_booking_status' => 'unpaid');
            $this->db->where('booked_booking_id', $id);
            $this->db->update('pt_booked_rooms', $data2);
        } elseif ($btype == "cruises") {
            $data2 = array('booked_booking_status' => 'unpaid');
            $this->db->where('booked_booking_id', $id);
            $this->db->update('pt_booked_cruise_rooms', $data2);
        } elseif ($btype == "cars") {
            $data3 = array('booked_booking_status' => 'unpaid');
            $this->db->where('booked_booking_id', $id);
            $this->db->update('pt_booked_cars', $data3);
        }
    }

    function cancel_booking_approve($id)
    {
        // delete booking and send email
        $useremail = $this->userinfo_by_bookingid($id);
        $this->emails_model->booking_approve_cancellation_email($useremail);
        $this->cancel_booking($id);
        //  $this->delete_booking($id);
    }

    function cancel_booking_reject($id)
    {
        $data = array('booking_cancellation_request' => '2');
        $this->db->where('booking_id', $id);
        $this->db->update('pt_bookings', $data);
        $useremail = $this->userinfo_by_bookingid($id);
        $this->emails_model->booking_reject_cancellation_email($useremail, $id);
    }

    function userinfo_by_bookingid($id)
    {
        $this->db->select('booking_user');
        $this->db->where('booking_id', $id);
        $res = $this->db->get('pt_bookings')->result();
        $user = $res[0]->booking_user;
        $uemail = $this->accounts_model->get_user_email($user);
        return $uemail;
    }

    function get_booking_details_by_id($id)
    {
        $this->db->where('booking_id', $id);
        return $this->db->get('pt_bookings')->result();
    }

    function getBookingRefNo($id)
    {
        $this->db->select('booking_ref_no');
        $this->db->where('booking_id', $id);
        $res = $this->db->get('pt_bookings')->result();
        return $res[0]->booking_ref_no;
    }

    function bookingShortInfo($id)
    {
        $this->db->select('booking_ref_no,booking_deposit,booking_type,booking_total,booking_deposit');
        $this->db->where('booking_id', $id);
        return $this->db->get('pt_bookings')->result();
    }

    function updateCoupon($couponid)
    {

        $this->db->where('id', $couponid);
        $res = $this->db->get('pt_coupons')->result();
        $uses = $res[0]->uses + 1;

        $data = array(
            'uses' => $uses
        );
        $this->db->where('id', $couponid);

        $this->db->update('pt_coupons', $data);

    }

    public function getBookingIdNo($bookingref)
    {
        $this->db->select('booking_id');
        $this->db->where('booking_ref_no', $bookingref);
        $res = $this->db->get('pt_bookings')->result();
        return $res[0]->booking_id;
    }

    public function getBookinginfo($bookingref)
    {

        $this->load->library('form_validation');
        $validation_status = 1; // by default validation is ok
        $fields_failed = array();

        // EMAIL
        if (!$this->form_validation->valid_email($bookingref)) { //if email is not valid
            $validation_status = 0;
            array_push($fields_failed, "email");
        }

        if ($validation_status) {//no error in data, continue
            $this->db->select('booking_user, booking_nights, booking_checkin, ai_first_name, ai_last_name, accounts_email');
            $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
            $this->db->where('accounts_email', $bookingref);
            $this->db->order_by('pt_bookings.booking_id', 'desc');
        } else {
            $this->db->select('booking_user, booking_nights, booking_checkin, ai_first_name, ai_last_name, accounts_email');
            $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
            $this->db->where('booking_ref_no', $bookingref);
            $this->db->order_by('pt_bookings.booking_id', 'desc');
        }

        $res = $this->db->get('pt_bookings')->result();
        if ($res[0]->booking_user > 0) {
            $originalDate = $res[0]->booking_checkin;
            $newDate = date("d/m/Y", strtotime($originalDate));

            $result[] = (object)[
                'booking_user' => $res[0]->booking_user,
                'ai_first_name' => $res[0]->ai_first_name,
                'ai_last_name' => $res[0]->ai_last_name,
                'accounts_email' => $res[0]->accounts_email,
                'booking_nights' => $res[0]->booking_nights,
                'booking_checkin' => $newDate
            ];
        } else {
            $result = "";
        }
        return $result;
    }
}
