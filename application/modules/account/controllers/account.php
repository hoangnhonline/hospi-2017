<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Account extends MX_Controller {
		private $data = array();
		private $loggedin;
		private $fbloggedin;
		private $validlang;

		function __construct() {
				parent :: __construct();
				modules :: load('home');
				$this->load->library('facebook');
				$this->data['app_settings'] = $this->settings_model->get_settings_data();
				$langcode = $this->uri->segment(2);
                $this->validlang = pt_isValid_language($langcode);
                if($this->validlang){
                	$this->data['lang_set'] = $langcode;
                }else{
                	$this->data['lang_set'] = $this->session->userdata('set_lang');
                }
 
				
				$this->load->model('admin/accounts_model');
				$this->load->model('admin/countries_model');
				$this->load->model('admin/newsletter_model');
				$this->loggedin = $this->session->userdata('pt_logged_customer');
				$this->fbloggedin = $this->session->userdata('fb_token');
//  $this->data['geo'] = $this->load->get_var('geolib');
				
				$this->data['phone'] = $this->load->get_var('phone');
				$this->data['contactemail'] = $this->load->get_var('contactemail');
				$defaultlang = pt_get_default_language();
				if (empty ($this->data['lang_set'])) {
						$this->data['lang_set'] = $defaultlang;
				}
								
		}

		public function index() {
				$code = $this->input->get('code');
				if (empty ($this->loggedin) && empty ($this->fbloggedin)) {
						redirect(base_url() . 'login');
				}
				elseif (!empty ($code)) {
						$fbuser = $this->facebook->get_user();
						$fblogin = $this->accounts_model->login_facebook($fbuser);
						if ($fblogin) {
								redirect(base_url() . 'account');
						}
						else {
								redirect(base_url() . 'login');
						}
				}
				else {
						$this->invoices();
				}
		}

		function invoices($offset = null) {
			$this->lang->load("front", $this->data['lang_set']);
			
				$this->load->library('bootpagination');
				$this->data['fbuser'] = $this->facebook->get_user();
//$perpage = 10;
				$this->data['allcountries'] = $this->countries_model->get_all_countries();
				$this->data['profile'] = $this->accounts_model->get_profile_details($this->loggedin);
				$rh = $this->accounts_model->get_my_bookings($this->loggedin);
				$this->data['wishlist'] = $this->accounts_model->my_wishlist($this->loggedin);
				if (pt_main_module_available('ean')) {
						$this->load->model('ean/ean_model');
						$this->data['eanbookings'] = $this->ean_model->get_my_bookings($this->loggedin);
				}
				else {
						$this->data['eanbookings'] = "";
				}
				$this->data['bookings'] = $this->accounts_model->get_my_bookings($this->loggedin);
//$this->data['plinks'] = $this->bootpagination->dopagination('account/invoices', $rh['rows'], $perpage);
				$this->data['is_subscribed'] = $this->newsletter_model->is_subscribed($this->data['profile'][0]->accounts_email);
				$this->data['cancel_duration'] = $this->data['app_settings'][0]->booking_cancellation * 86400;
				$this->data['langurl'] = base_url()."account/{langid}";
				$this->data['page_title'] = "My Account";
				$this->theme->view('account/account', $this->data);
		}

		function newsletter_action() {
				$action = $this->input->post('action');
				$email = $this->input->post('email');
				if (empty ($action)) {
						redirect(base_url());
				}
				else {
						if ($action == "add") {
								$this->newsletter_model->add_subscriber($email);
						}
						elseif ($action == "remove") {
								$this->newsletter_model->remove_subscriber($email);
						}
				}
		}

		function update_profile() {
				$password = $this->input->post('password');
				$cpassword = $this->input->post('confirmpassword');
				$oldemail = $this->input->post('oldemail');
				$newemail = $this->input->post('email');
// $this->form_validation->set_rules('firstname','Tên', 'trim|required');
//  $this->form_validation->set_rules('lastname','Họ', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
				if (!empty ($password)) {
						$this->form_validation->set_message('matches', 'Passwords not matching.');
						$this->form_validation->set_rules('password', 'Password', 'matches[confirmpassword]');
				}
				if ($this->form_validation->run() == FALSE) {
						echo '
<div class="alert alert-danger">' . validation_errors() . '</div>
<br>';
				}
				else {
						if ($oldemail != $newemail) {
								$this->db->where('accounts_email', $newemail);
								$this->db->where('accounts_type', 'customer');
								$nums = $this->db->get('pt_accounts')->num_rows();
								if ($nums > 0) {
										echo '
<div class="alert alert-danger">Email Already Exists.</div>
';
								}
								else {
										$this->accounts_model->change_email($this->loggedin);
										echo '
<div class="alert alert-success">Profile Updated Successfully.</div>
';
								}
						}
						else {
								$this->accounts_model->update_profile_customer($this->loggedin);
								echo '
<div class="alert alert-success">Profile Updated Successfully.</div>
';
						}
				}
		}

//Wishlist actions
		function wishlist($action) {
			if(empty($this->loggedin)){
			$userid = $this->input->post('loggedin');	
		}else{
			$userid = $this->loggedin;
		}
			
			if(!empty($userid)){

				if ($action == 'add') {
						$data = array(
							'wish_user' => $userid, 
							'wish_itemid' => $this->input->post('itemid'), 
							'wish_module' => $this->input->post('module'), 
							'wish_date' => time());
						$this->db->insert('pt_wishlist', $data);
				}
				elseif ($action == 'remove') {
						$this->db->where('wish_user', $userid);
						$this->db->where('wish_itemid', $this->input->post('itemid'));
						$this->db->where('wish_module', $this->input->post('module'));
						$this->db->delete('pt_wishlist');
				}
				elseif ($action == 'single') {
						$this->db->where('wish_id', $this->input->post('id'));
						$this->db->delete('pt_wishlist');
				}
			}
			
			if(!empty($userid)){
				$result = array("isloggedIn" => TRUE);
			}else{
				$result = array("isloggedIn" => FALSE);
			}

			echo json_encode($result);

		}

// sign up functionality
		function signup() {
			$this->lang->load("front", $this->data['lang_set']);
				$this->form_validation->set_message('matches', 'Password not matching with confirm password.');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[confirmpassword]');
				$this->form_validation->set_rules('firstname', 'First name', 'trim|required');
				$this->form_validation->set_rules('lastname', 'Họ', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
						echo "<div class='alert alert-danger'>" . validation_errors() . "</div>";
				}
				else {
						$this->db->select('accounts_email');
						$this->db->where('accounts_email', $this->input->post('email'));
						$this->db->where('accounts_type', 'customers');
						$nums = $this->db->get('pt_accounts')->num_rows();
						if ($nums > 0) {
								echo "<div class='alert alert-danger'> Email Already Exists. </div>";
						}
						else {
							$allowed = $this->data['app_settings'][0]->user_reg_approval;
							if($allowed == "No"){
								$accStatus = "no";
								$response = "<div class='alert alert-success'> ".trans('0244')." </div>";
							}else{
								$accStatus = "yes";
								$response = "true";
							} 

								$this->accounts_model->signup_account('customers', $accStatus);
								$this->load->model('admin/emails_model');
								$fullname = $this->input->post('firstname') . " " . $this->input->post('lastname');
								$edata = array("email" => $this->input->post('email'), "fullname" => $fullname, "mobile" => $this->input->post('mobile'), "password" => $this->input->post('password'));
								if($accStatus == "no"){
								$this->emails_model->new_customer_email($edata);
								$this->emails_model->customer_signup($edata);	
							}else{
								
								$this->emails_model->signupEmail($edata);

							}
								

								

// $this->session->set_userdata('pt_logged_customer',$id);
								echo $response;
						}
				}
		}

		function addreview() {
				$this->load->model('admin/reviews_model');
				$addrev = $this->input->post('addreview');
				if (empty ($addrev)) {
						redirect('account');
				}
				$this->form_validation->set_rules('reviews_comments', 'Comment', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
						echo '
<div class="alert alert-danger"><i class="fa fa-times-circle"></i> ' . validation_errors() . '</div>
<br>';
				}
				else {
						$this->reviews_model->add_review_cust($this->data['app_settings'][0]->reviews);
						echo "done";
				}
		}

//cancel booking
		function cancelbooking() {
				$data = array('booking_cancellation_request' => 1);
				$this->db->where('booking_id', $this->input->post('id'));
				$this->db->update('pt_bookings', $data);
// send email for request cancellation
				$useremail = $this->accounts_model->get_user_email($this->loggedin);
				$this->load->model('admin/emails_model');
				$this->emails_model->booking_request_cancellation_email($useremail, $this->input->post('id'));
		}

		function resetpass() {
				$email = $this->input->post('email');
				$this->db->where('accounts_email', $email);
				$this->db->where('accounts_type', 'customers');
				$check = $this->db->get('pt_accounts')->num_rows();
				if ($check > 0) {
						$newpass = random_string('alnum', 8);
						$updata = array('accounts_password' => sha1($newpass));
						$this->db->where('accounts_email', $email);
						$this->db->where('accounts_type', 'customers');
						$this->db->update('pt_accounts', $updata);
						$this->load->model('admin/emails_model');
						echo "1";
						$this->emails_model->reset_password($email, $newpass);
				}
				else {
						echo "0";
				}
		}

		function resetpassadmin() {
				$email = $this->input->post('email');
				$this->db->where('accounts_email', $email);
				$this->db->where('accounts_type', 'webadmin');
				$check = $this->db->get('pt_accounts')->num_rows();
				if ($check > 0) {
						$newpass = random_string('alnum', 8);
						$updata = array('accounts_password' => sha1($newpass));
						$this->db->where('accounts_email', $email);
						$this->db->where('accounts_type', 'webadmin');
						$this->db->update('pt_accounts', $updata);
						$this->load->model('admin/emails_model');
						echo "1";
						$this->emails_model->reset_password($email, $newpass);
				}
				else {
						echo "0";
				}
		}

		function resetpasssupplier() {
				$email = $this->input->post('email');
				$this->db->where('accounts_email', $email);
				$this->db->where('accounts_type', 'supplier');
				$check = $this->db->get('pt_accounts')->num_rows();
				if ($check > 0) {
						$newpass = random_string('alnum', 8);
						$updata = array('accounts_password' => sha1($newpass));
						$this->db->where('accounts_email', $email);
						$this->db->where('accounts_type', 'supplier');
						$this->db->update('pt_accounts', $updata);
						$this->load->model('admin/emails_model');
						echo "1";
						$this->emails_model->reset_password($email, $newpass);
				}
				else {
						echo "0";
				}
		}

		function logout() {
				
				$this->session->unset_userdata('pt_logged_customer');
				$this->load->library('facebook');
				$this->facebook->logoutfb();
				redirect(base_url() . 'login','refresh');
		}

}