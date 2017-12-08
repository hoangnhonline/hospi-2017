<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Offers extends MX_Controller
{
    private $data = array();
    private $validlang;

    function __construct()
    {
        parent:: __construct();

        $chk = modules:: run('home/is_module_enabled', 'offers');
        if (!$chk) {
            Module_404();
        }

        modules:: load('home');
        $this->load->library('offers_lib');
        $this->load->library('breadcrumbcomponent');
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $this->data['lang_set'] = $this->session->userdata('set_lang');
        $this->data['usersession'] = $this->session->userdata('pt_logged_customer');
        $this->load->model('admin/special_offers_model');
        $this->data['phone'] = $this->load->get_var('phone');
        $this->data['contactemail'] = $this->load->get_var('contactemail');
        $this->data['appModule'] = "offers";


        $languageid = $this->uri->segment(2);
        $this->validlang = pt_isValid_language($languageid);

        if ($this->validlang) {
            $this->data['lang_set'] = $languageid;
        } else {
            $this->data['lang_set'] = $this->session->userdata('set_lang');
        }

        $defaultlang = pt_get_default_language();
        if (empty ($this->data['lang_set'])) {
            $this->data['lang_set'] = $defaultlang;
        }

        $this->lang->load("front", $this->data['lang_set']);
        $this->offers_lib->set_lang($this->data['lang_set']);
    }

    public function index()
    {
        if ($this->validlang) {
            $offername = $this->uri->segment(3);
        } else {
            $offername = $this->uri->segment(2);
        }

        $check = $this->special_offers_model->offerExists($offername);
        if ($check && !empty($offername)) {
            $sendmsg = $this->input->post('sendmsg');
            $this->offers_lib->set_offerid($offername);
            $this->data['module'] = $this->offers_lib->offer_details();
            $this->data['currencySign'] = $this->data['module']->currSymbol;
            $this->data['lowestPrice'] = $this->data['module']->price;

            $this->data['page_title'] = $this->data['module']->title;
            if (!empty($sendmsg)) {
                $this->load->model('admin/emails_model');
                $this->emails_model->offerContactEmail();
                $this->session->set_flashdata('flashmsgs', "Email Sent");
                redirect(base_url() . "offers/" . $this->data['module']->slug);
            }
            /*$this->data['metakey'] = $this->data['hotel']->keywords;
            $this->data['metadesc'] = $this->data['hotel']->metadesc;*/
            $this->data['success'] = $this->session->flashdata('flashmsgs');
            $this->data['langurl'] = base_url() . "offers/{langid}/" . $this->data['offer']->slug;

            /* Bread crum */
            $this->breadcrumbcomponent->add('Trang chủ', base_url());
            switch ($this->data['module']->type) {
                case 1:
                    $this->breadcrumbcomponent->add('Deals - Ưu đãi', base_url() . 'offers');
                    break;
                case 2:
                    $this->breadcrumbcomponent->add('Combo', base_url() . 'offers/bestchoice');
                    break;
                default:
                    $this->breadcrumbcomponent->add('Honeymoon', base_url() . 'hotels/honeymoon');
                    break;
            }
            $this->breadcrumbcomponent->add($this->data['module']->title, base_url() . "offers/" . $this->data['module']->slug);
            $this->data['breadcrumb'] = $this->breadcrumbcomponent->output();

            $this->theme->view('offer_details', $this->data);
            $this->output->cache(20);
        } else {
            if ($this->validlang) {
                $offer = $this->uri->segment(3);
            } else {
                $offer = $this->uri->segment(2);
            }
            switch ($offer) {
                case "bestchoice":
                    $this->bestchoice();
                    break;
                case "sales":
                    $this->sales();
                    break;
                case "book":
                    $this->book();
                    break;
                default:
                    $this->listing();
                    break;
            }
        }
    }

    function listing()
    {
        $page = $this->input->get('page');
        if (!$page) {
            $page = null;
        }

        $this->data['sorturl'] = base_url() . 'offers?';
        $settings = $this->settings_model->get_front_settings('offers');
        $loc = $this->input->get('location');
        $alloffers = $this->offers_lib->showOffers($page, $loc, 1, 15);
        $this->data['module'] = $alloffers['allOffers']['offers'];
        $this->data['info'] = $alloffers['paginationinfo'];
        $this->data['info']['base'] = base_url() . 'offers';
        $this->data['page_title'] = $settings[0]->header_title;
        $this->data['langurl'] = base_url() . "offers/{langid}";
        $this->theme->view('deals', $this->data);
        //$this->output->cache(20) ;
    }

    function bestchoice()
    {
        $page = $this->input->get('page');
        if (!$page) {
            $page = null;
        }

        $this->data['sorturl'] = base_url() . 'offers/bestchoice?';
        $settings = $this->settings_model->get_front_settings('offers');
        $loc = $this->input->get('location');
        $alloffers = $this->offers_lib->showOffers($page, $loc, 2, 8);
        $this->data['module'] = $alloffers['allOffers']['offers'];
        $this->data['info'] = $alloffers['paginationinfo'];
        $this->data['info']['base'] = base_url() . 'offers/bestchoice';
        $this->data['page_title'] = $settings[0]->header_title;
        $this->data['langurl'] = base_url() . "offers/bestchoice/{langid}";
        $this->theme->view('bestchoice', $this->data);
        //$this->output->cache(20) ;
    }

    function sales()
    {
        $page = $this->input->get('page');
        if (!$page) {
            $page = null;
        }

        $this->data['sorturl'] = base_url() . 'offers/sales?';
        $settings = $this->settings_model->get_front_settings('offers');
        $loc = $this->input->get('location');

        $this->load->library('hotels/hotels_lib');
        $this->data['salesoffHotels'] = $this->hotels_lib->getSalesoffHotels($loc);
        $this->data['page_title'] = $settings[0]->header_title;
        $this->data['langurl'] = base_url() . "offers/sales/{langid}";
        $this->theme->view('sales', $this->data);
        //$this->output->cache(20) ;
    }

    function search()
    {
        $page = $this->input->get('page');
        if (!$page) {
            $page = null;
        }

        $surl = http_build_query($_GET);
        //$this->data['sorturl'] = base_url() . 'offers/search?' . $surl . '&';
        $dfrom = $this->input->get('dfrom');
        $dto = $this->input->get('dto');

        $type = $this->input->get('type');
        $txtsearch = $this->input->get('searching');

        if (array_filter($_GET)) {
            $alloffers = $this->offers_lib->searchOffers($page, $dfrom, $dto);
            $this->data['module'] = $alloffers['allOffers']['offers'];
            $this->data['info'] = $alloffers['paginationinfo'];
        } else {
            $this->listing();
        }

        $this->data['dfrom'] = @$_GET['dfrom'];
        $this->data['dto'] = @$_GET['dto'];

        $this->data['page_title'] = 'Search Results';
        $this->data['metakey'] = $txtsearch;
        $this->data['metadesc'] = $txtsearch;
        $this->data['langurl'] = base_url() . "offers/{langid}";
        $this->theme->view('listing', $this->data);
    }

    function book()
    {
        $this->load->model('admin/countries_model');
        $this->data['allcountries'] = $this->countries_model->get_all_countries();
        $this->load->library("paymentgateways");
        $this->data['hideHeader'] = "1";

        if ($this->validlang) {
            $offername = $this->uri->segment(4);
        } else {
            $offername = $this->uri->segment(3);
        }
        $check = $this->special_offers_model->offerExists($offername);

        $checkin = $this->input->get('checkin');
        $quantity = $this->input->get('quantity');
        $note = $this->input->get('note');
        $surcharge = $this->input->get('surcharge');

        if ($check && !empty($offername)) {
            $this->load->model('admin/payments_model');
            $this->data['error'] = "";

            $this->offers_lib->set_offerid($offername);
            $detailOffer = $this->offers_lib->offer_details();

            //var_dump('<pre>', $detailOffer);die;
            $this->data['module'] = $detailOffer;

            $this->load->model('admin/accounts_model');
            $loggedin = $this->loggedin = $this->session->userdata('pt_logged_customer');
            $this->lang->load("front", $this->data['lang_set']);
            $this->load->helper('invoice');
            $this->load->model('payments_model');
            $paygateways = $this->payments_model->getAllPaymentsBack();
            $this->data['paymentGateways'] = $paygateways['activeGateways'];
            usort($this->data['paymentGateways'], function ($a, $b) {
                return $a['order'] - $b['order'];
            });
            $this->data['profile'] = $this->accounts_model->get_profile_details($loggedin);
            $this->data['page_title'] = $this->data['module']->title;
            $this->data['metakey'] = $this->data['module']->keywords;
            $this->data['metadesc'] = $this->data['module']->metadesc;
            $this->data['checkin'] = $checkin;
            $this->data['quantity'] = $quantity;
            $this->data['note'] = $note;
            $this->data['surcharge'] = $surcharge;
            $this->breadcrumbcomponent->add('Trang chủ', base_url());
            $this->breadcrumbcomponent->add($detailOffer->title, base_url() . "offers/" . $detailOffer->slug);
            $this->breadcrumbcomponent->add('Thông tin thanh toán', '#');
            $this->data['breadcrumb'] = $this->breadcrumbcomponent->output();
            $this->theme->view('booking', $this->data);
        } else {
            redirect("offers");
        }
    }
}
