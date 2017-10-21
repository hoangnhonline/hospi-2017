<?php
header('Access-Control-Allow-Origin: *');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'modules/api/libraries/REST_Controller.php';

class Login extends REST_Controller {

    function __construct() {
        // Construct our parent class
        parent :: __construct();
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['list_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
 
    }

     function check_post() {
                $email = $this->post('email');
                $password = $this->post('password');

                $data = $this->verify($email, $password);

                $message = array('response' => $data);
                $this->response($message, 200); // 200 being the HTTP response code
        }

    function verify($email, $password){
        $this->db->select('accounts_email as email,accounts_id as id,ai_first_name as firstName, ai_last_name as lastName');
        $this->db->where('accounts_email', $email);
        $this->db->where('accounts_password', sha1($password));
        $this->db->where('accounts_type', 'customers');
        $this->db->where('accounts_status', 'yes');
        $q = $this->db->get('pt_accounts');
        $user = $q->result();
        $num = $q->num_rows();
        $response = array("status" => false, "user" => "");
        if ($num > 0) {
            
           $response = array("status" => true, "user" => $user[0]);
        }
        else {
            $response = array("status" => false, "user" => "");
        }

        return $response;

    }


    function signup_post(){
        
        $this->load->model('admin/accounts_model');
        $result = $this->accounts_model->apisignup_account($this->post(),'customers');

        if($result > 0){
            $this->load->model('admin/emails_model');
            $fullname = $this->input->post('first_name') . " " . $this->input->post('last_name');
            $edata = array("email" => $this->input->post('email'), "fullname" => $fullname, "mobile" => $this->input->post('phone'), "password" => $this->input->post('password'));

            $this->emails_model->new_customer_email($edata);
            $this->emails_model->customer_signup($edata);
            $signedup = TRUE;
        }else{
            $signedup = FALSE;
        }

        $message = array('response' => $signedup);
        $this->response($message, 200); // 200 being the HTTP response code

    }
}