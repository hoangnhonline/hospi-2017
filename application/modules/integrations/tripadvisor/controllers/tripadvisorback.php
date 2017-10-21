<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tripadvisorback extends MX_Controller {


    private $data = array();


	function __construct(){
	    $seturl =  $this->uri->segment(3);
      if($seturl != "settings"){
        $chk = modules::run('home/is_main_module_enabled','tripadvisor');
   if(!$chk){
       Error_404($this->data);

   }
      }
     $checkingadmin = $this->session->userdata('pt_logged_admin');
    if(!empty($checkingadmin)){

      $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');

    }else{

      $this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');

    }

    if(empty($this->data['userloggedin'])){
     redirect("admin");
    }

    if(!empty($checkingadmin)){
     $this->data['adminsegment'] = "admin";

    }else{
      $this->data['adminsegment'] = "supplier";
    }

    if($this->data['adminsegment'] == "admin"){

   $chkadmin = modules::run('admin/validadmin');
   if(!$chkadmin){
      redirect('admin');
   }

    }else{

   $chksupplier = modules::run('supplier/validsupplier');
   if(!$chksupplier){
      redirect('supplier');
   }


    }

   if(!pt_permissions('tripadvisor',$this->data['userloggedin'])){

     redirect('admin');
   }
    $this->load->helper('settings');
    $this->load->model('tripadvisor/tripadvisor_model');
    
    $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
    $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');


    }

    function index(){

    }


    function settings(){

    $updatesett = $this->input->post('updatesettings');

    if(!empty($updatesett)){

    $this->tripadvisor_model->update_front_settings();
    redirect('admin/tripadvisor/settings');

    }

    $this->data['settings'] = $this->settings_model->get_front_settings("tripadvisor");
    $this->data['main_content'] = 'tripadvisor/settings';
	$this->data['page_title'] = 'Trip Advisor Settings';

	$this->load->view('admin/template',$this->data);

    }



    }