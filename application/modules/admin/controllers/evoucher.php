<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Evoucher extends MX_Controller
{
    private $data = array();
    public $role;
    public $editpermission = true;
    public $deletepermission = true;

    function __construct()
    {
        modules::load('admin');
        $chkadmin = modules::run('admin/validadmin');
        if (!$chkadmin) {
            $this->session->set_userdata('prevURL', current_url());
            redirect(base_url() . 'admin');
        }

        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $checkingadmin = $this->session->userdata('pt_logged_admin');
        if (!empty($checkingadmin)) {
            $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        } else {
            $this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');
        }

        if (!empty($checkingadmin)) {
            $this->data['adminsegment'] = "admin";
        } else {
            $this->data['adminsegment'] = "supplier";
        }

        $this->load->model('admin/bookings_model');
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
        $this->role = $this->session->userdata('pt_role');
        $this->load->model('locations_model');
        $this->data['role'] = $this->role;
        $this->data['addpermission'] = true;
        if ($this->role == "admin") {
            $this->editpermission = pt_permissions("editbooking", $this->data['userloggedin']);
            $this->deletepermission = pt_permissions("deletebooking", $this->data['userloggedin']);
            $this->data['addpermission'] = pt_permissions("addbooking", $this->data['userloggedin']);
        }

        $this->lang->load("back", "vi");
    }

    function index()
    {
        if (!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission) {
            backError_404($this->data);
        } else {
            $params = [];
            $params['booking_type'] = $this->input->get('booking_type') ? $this->input->get('booking_type') : 'hotels';
            $params['booking_status'] = $this->input->get('booking_status') ? $this->input->get('booking_status') : null;
            $params['ai_last_name'] = $this->input->get('ai_last_name') ? $this->input->get('ai_last_name') : null;
            $limit = $this->input->get('limit') ? $this->input->get('limit') : 50;
            $page = $this->input->get('page') ? $this->input->get('page') : 1;
            $total_records = $this->bookings_model->search($params);
            $this->data['info'] = array('base' => base_url() . 'admin/bookings', 'totalrows' => $total_records, 'perpage' => $limit);
            $data = $this->bookings_model->search($params, $limit, $page);
            $isadmin = $this->session->userdata('pt_logged_admin');
            $userid = '';
            if (empty($isadmin)) {
                $userid = $this->session->userdata('pt_logged_supplier');
            }

            $this->data['hotels'] = $this->hotels_model->all_hotels_names($userid);
            $this->data['content'] = $data;
            $this->data['params'] = $params;
            $this->data['page_title'] = 'Quản lý Evoucher';
            $this->data['main_content'] = 'modules/evoucher/index';
            $this->data['header_title'] = 'Quản lý Evoucher';
            $this->data['deletepermission'] = $this->deletepermission;
            $this->data['add_link'] = base_url() . 'admin/evoucher/add';
            $this->load->view('admin/template', $this->data);
        }
    }

    function add()
    {
        $isadmin = $this->session->userdata('pt_logged_admin');
        $userid = '';
        if (empty($isadmin)) {
            $userid = $this->session->userdata('pt_logged_supplier');
        }

        if (!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission) {
            backError_404($this->data);
        } else {
            $this->load->helper('invoice');
            $this->load->model('payments_model');
            $this->load->model('hotels/hotels_model');
            $this->data['paygateways'] = $this->payments_model->getAllPaymentsBack();
            $this->data['chklib'] = $this->ptmodules;
            $this->load->library('hotels/hotels_lib');
            $this->data['checkinlabel'] = "Check-In";
            $this->data['checkoutlabel'] = "Check-Out";
            $this->data['main_content'] = 'modules/evoucher/add';
            $this->data['page_title'] = 'Tạo Evoucher';
            $this->data['locations'] = $this->locations_model->getLocationsBackend();
            $this->data['hotels'] = $this->hotels_model->all_hotels_names($userid, 'Yes');
            $this->load->view('template', $this->data);
        }
    }
}
