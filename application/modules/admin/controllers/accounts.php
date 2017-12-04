<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Accounts extends MX_Controller
{
    public $data = array();
    public $role;
    public $xcrud;

//private $userid = 1; //$this->session->userdata('userid');
    function __construct()
    {
        parent:: __construct();
        //modules :: load('admin');
        $this->load->module("admin");
        /*   $chkadmin = modules::run('admin/validadmin');

        if(!$chkadmin){

        redirect(base_url().'admin');

        }*/
        $this->load->model('admin/uploads_model');
        $this->load->model('admin/modules_model');
        $this->data['c_model'] = $this->countries_model;
        $this->data['countries'] = $this->data['c_model']->get_all_countries();
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['userid'] = $this->session->userdata('pt_logged_id');
        $this->data['modules'] = $this->modules_model->get_all_modules();
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
        $this->role = $this->session->userdata('pt_role');
        $this->data['role'] = $this->role;

        $this->data['mainmodules'] = $this->ptmodules->modules_permissions($this->data['modules']);


    }

    public function index()
    {
    }

    public function userprofile()
    {
        $data['profile'] = $this->accounts_model->get_profile_details($this->data['userid']);
        $data['allcountries'] = $this->countries_model->get_all_countries();
        $this->load->view('accounts/profile-content', $data);
    }

    public function profile()
    {
        $update = $this->input->post('submit');
        if (!empty ($update)) {
            $userid = $this->input->post('userid');
            $subscribe = $this->input->post('newssub');
            $oldemail = $this->input->post('oldemail');
            $newemail = $this->input->post('email');
            $password = $this->input->post('password');
            if ($oldemail == $newemail) {
            } else {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pt_accounts.accounts_email]');
            }
            if (!empty ($password)) {
                $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
            }
            $this->form_validation->set_rules('city', 'City', 'trim');
            $this->form_validation->set_rules('fname', 'Tên', 'trim|required');
            $this->form_validation->set_rules('lname', 'Họ', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                echo '<div class="alert alert-danger">' . validation_errors() . '</div>';
            } else {
                $this->accounts_model->update_profile($this->input->post('type'), $userid);
                if (!empty ($subscribe)) {
                    $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                } else {
                    $this->newsletter_model->remove_subscriber($this->input->post('email'));
                }
                if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                    $result = $this->uploads_model->__profileimg($userid);
                    if ($result == '1') {
                        echo '<div class="alert alert-danger">Invalid file type kindly select only jpg/jpeg, png, gif file types</div>';
                    } elseif ($result == '2') {
                        echo '<div class="alert alert-danger">Only upto 2MB size photos allowed</div>';
                    } elseif ($result == '3') {
                        echo 'done';
                    }
                } else {
                    echo 'done';
                    redirect(base_url() . 'admin');
                }
            }
        }
    }

// customers function

    public function customers($args = null, $id = null)
    {
        if ($this->admin->role == "webadmin" || $this->admin->role == "admin") {
            $this->data['addpermission'] = true;
        } else {

            redirect(base_url() . 'admin');
        }
        $this->data['type'] = "customers";
        $userdata = $this->accounts_model->get_profile_details($id);
        if (!empty($userdata)) {
            $this->data['profile'] = $userdata;
            $this->data['isSubscribed'] = $this->newsletter_model->is_subscribed($this->data['profile'][0]->accounts_email);
            $this->data['permitted'] = explode(",", $this->data['profile'][0]->accounts_permissions);

        } else {
            $this->data['profile'] = "";
            $this->data['permitted'] = array();
        }

        if ($args == 'add') {
            $this->data['viewtype'] = "addaccount";

            $subscribe = $this->input->post('newssub');
            $addaccount = $this->input->post('addaccount');
            if (!empty ($addaccount)) {

                if ($this->form_validation->run('addaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Customer Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/customers/');
                        }
                    } else {
                        $this->accounts_model->add_account($filename_db);
                        $this->session->set_flashdata('flashmsgs', "Customer Account Added Successfully");
                        redirect(base_url() . 'admin/accounts/customers/');
                    }
                }
            }

            $this->data['page_title'] = 'Add Customer';
            $this->data['headertitle'] = 'Add Customer';
            $this->data['main_content'] = 'accounts/accounts-management';
        } elseif ($args == 'edit') {
            $this->data['viewtype'] = "updateaccount";

            $subscribe = $this->input->post('newssub');
            $updateaccount = $this->input->post('updateaccount');
            if (!empty ($updateaccount)) {

                if ($this->form_validation->run('updateaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    } else {
                        $this->newsletter_model->remove_subscriber($this->input->post('email'));

                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Customer Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/customers/');
                        }
                    } else {
                        $this->accounts_model->update_profile('customers', $id, $filename_db);
                        $this->session->set_flashdata('flashmsgs', "Customer Account Updated Successfully");
                        redirect(base_url() . 'admin/accounts/customers/');
                    }
                }
            }

            $this->data['page_title'] = 'Update Customer';
            $this->data['headertitle'] = 'Update Customer';
            $this->data['main_content'] = 'accounts/accounts-management';
        } else {
            $xcrud = xcrud_get_instance();
            $xcrud->table('pt_accounts');
            $xcrud->where('accounts_type =', 'customers');
            $xcrud->order_by('accounts_id', 'desc');
            $xcrud->button(base_url() . 'admin/accounts/customers/edit/{accounts_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
            $delurl = base_url() . 'admin/ajaxcalls/delAcc';
            $xcrud->button("javascript: delfunc('{accounts_id}','$delurl')", 'DELETE', 'fa fa-times', 'btn-danger', array('target' => '_self', 'id' => '{accounts_id}'));
            $xcrud->unset_add();
            $xcrud->unset_edit();
            $xcrud->unset_remove();
            $xcrud->unset_view();
            $xcrud->columns('ai_first_name,ai_last_name,accounts_email,accounts_status,accounts_last_login');
            $xcrud->search_columns('ai_first_name,ai_last_name,accounts_email,accounts_status');
            $xcrud->column_callback('accounts_status', 'create_status_icon');
            $xcrud->column_callback('accounts_last_login', 'long_date_fmt');
            $xcrud->label('ai_first_name', 'Tên')->label('ai_last_name', 'Họ')->label('accounts_email', 'Email')->label('accounts_status', 'Active')->label('accounts_last_login', 'Đăng nhập lần cuối');

            $xcrud->multiDelUrl = base_url() . 'admin/ajaxcalls/multiDelAcc';

            $this->data['content'] = $xcrud->render();
            $this->data['page_title'] = 'Customers Management';
            $this->data['main_content'] = 'temp_view';
            $this->data['header_title'] = 'Customers Management';
            $this->data['add_link'] = base_url() . 'admin/accounts/customers/add';

        }

        $this->load->view('template', $this->data);
    }

// Guest function

    public function guest($args = null, $id = null)
    {
        if ($this->admin->role == "webadmin" || $this->admin->role == "admin") {
            $this->data['addpermission'] = true;
        } else {

            redirect(base_url() . 'admin');
        }
        $this->data['type'] = "guest";
        $userdata = $this->accounts_model->get_profile_details($id);
        if (!empty($userdata)) {
            $this->data['profile'] = $userdata;
            $this->data['isSubscribed'] = $this->newsletter_model->is_subscribed($this->data['profile'][0]->accounts_email);
            $this->data['permitted'] = explode(",", $this->data['profile'][0]->accounts_permissions);

        } else {
            $this->data['profile'] = "";
            $this->data['permitted'] = array();
        }

        if ($args == 'add') {
            $this->data['viewtype'] = "addaccount";

            $subscribe = $this->input->post('newssub');
            $addaccount = $this->input->post('addaccount');
            if (!empty ($addaccount)) {

                if ($this->form_validation->run('addaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Guest Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/guest/');
                        }
                    } else {
                        $this->accounts_model->add_account($filename_db);
                        $this->session->set_flashdata('flashmsgs', "Guest Account Added Successfully");
                        redirect(base_url() . 'admin/accounts/guest/');
                    }
                }
            }

            $this->data['page_title'] = 'Add Gest';
            $this->data['headertitle'] = 'Add Guest';
            $this->data['main_content'] = 'accounts/accounts-management';
        } elseif ($args == 'edit') {
            $this->data['viewtype'] = "updateaccount";

            $subscribe = $this->input->post('newssub');
            $updateaccount = $this->input->post('updateaccount');
            if (!empty ($updateaccount)) {

                if ($this->form_validation->run('updateaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    } else {
                        $this->newsletter_model->remove_subscriber($this->input->post('email'));

                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Guest Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/guest/');
                        }
                    } else {
                        $this->accounts_model->update_profile('guest', $id, $filename_db);
                        $this->session->set_flashdata('flashmsgs', "Guest Account Updated Successfully");
                        redirect(base_url() . 'admin/accounts/guest/');
                    }
                }
            }

            $this->data['page_title'] = 'Update Guest';
            $this->data['headertitle'] = 'Update Guest';
            $this->data['main_content'] = 'accounts/accounts-management';
        } else {
            $xcrud = xcrud_get_instance();
            $xcrud->table('pt_accounts');
            $xcrud->where('accounts_type =', 'guest');
            $xcrud->order_by('accounts_id', 'desc');
            $xcrud->button(base_url() . 'admin/accounts/guest/edit/{accounts_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
            $delurl = base_url() . 'admin/ajaxcalls/delAcc';
            $xcrud->button("javascript: delfunc('{accounts_id}','$delurl')", 'DELETE', 'fa fa-times', 'btn-danger', array('target' => '_self', 'id' => '{accounts_id}'));
            $xcrud->limit(50);
            $xcrud->unset_add();
            $xcrud->unset_edit();
            $xcrud->unset_remove();
            $xcrud->unset_view();
            $xcrud->columns('ai_first_name,ai_last_name,accounts_email,accounts_status,accounts_last_login');
            $xcrud->search_columns('ai_first_name,ai_last_name,accounts_email,accounts_status');
            $xcrud->column_callback('accounts_status', 'create_status_icon');
            $xcrud->column_callback('accounts_last_login', 'long_date_fmt');
            $xcrud->label('ai_first_name', 'Tên')->label('ai_last_name', 'Họ')->label('accounts_email', 'Email')->label('accounts_status', 'Active')->label('accounts_last_login', 'Đăng nhập lần cuối');

            $xcrud->multiDelUrl = base_url() . 'admin/ajaxcalls/multiDelAcc';
            $this->data['content'] = $xcrud->render();
            $this->data['page_title'] = 'Guest Management';
            $this->data['main_content'] = 'temp_view';
            $this->data['header_title'] = 'Guest Management';
            $this->data['add_link'] = base_url() . 'admin/accounts/guest/add';

        }

        $this->load->view('template', $this->data);
    }

// Suppliers function

    public function suppliers($args = null, $id = null)
    {
        if ($this->admin->role == "webadmin" || $this->admin->role == "admin") {
            $this->data['addpermission'] = true;
        } else {

            redirect(base_url() . 'admin');
        }
        $this->data['type'] = "supplier";
        $this->data['mainmodules'] = $this->ptmodules->supplierModulesPermission();
        $userdata = $this->accounts_model->get_profile_details($id);
        if (!empty($userdata)) {
            $this->data['profile'] = $userdata;
            $this->data['isSubscribed'] = $this->newsletter_model->is_subscribed($this->data['profile'][0]->accounts_email);
            $this->data['permitted'] = explode(",", $this->data['profile'][0]->accounts_permissions);

        } else {
            $this->data['profile'] = "";
            $this->data['permitted'] = array();
        }
        $appliedFor = json_decode($this->data['profile'][0]->appliedfor);
        $this->data['appliedFor'] = ucfirst($appliedFor->appliedfor);
        $this->data['propertyName'] = $appliedFor->name;


        if ($args == 'add') {
            $this->data['viewtype'] = "addaccount";

            $subscribe = $this->input->post('newssub');
            $addaccount = $this->input->post('addaccount');
            if (!empty ($addaccount)) {

                if ($this->form_validation->run('addaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Supplier Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/suppliers/');
                        }
                    } else {
                        $this->accounts_model->add_account($filename_db);
                        $this->session->set_flashdata('flashmsgs', "Supplier Account Added Successfully");
                        redirect(base_url() . 'admin/accounts/suppliers/');
                    }
                }
            }
            $this->data['chkinghotels'] = $this->ptmodules->is_mod_available_enabled("hotels");
            $this->data['chkingtours'] = $this->ptmodules->is_mod_available_enabled("tours");
            $this->data['chkingcars'] = $this->ptmodules->is_mod_available_enabled("cars");

            if ($this->data['chkinghotels']) {
                $this->load->model('hotels/hotels_model');
                $this->data['userhotels'] = array();
                $this->data['hotels'] = $this->hotels_model->all_hotels_names();
            }

            if ($this->data['chkingtours']) {
                $this->load->model('tours/tours_model');
                $this->data['usertours'] = array();
                $this->data['tours'] = $this->tours_model->all_tours_names();
            }

            if ($this->data['chkingcars']) {
                $this->load->model('cars/cars_model');
                $this->data['usercars'] = array();
                $this->data['cars'] = $this->cars_model->all_cars_names();
            }

            $this->data['page_title'] = 'Add Supplier';
            $this->data['headertitle'] = 'Add Supplier';
            $this->data['main_content'] = 'accounts/accounts-management';
        } elseif ($args == 'edit') {
            $this->data['viewtype'] = "updateaccount";

            $subscribe = $this->input->post('newssub');
            $updateaccount = $this->input->post('updateaccount');
            if (!empty ($updateaccount)) {


                if ($this->form_validation->run('updateaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    } else {
                        $this->newsletter_model->remove_subscriber($this->input->post('email'));

                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Supplier Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/suppliers/');
                        }
                    } else {
                        $this->accounts_model->update_profile('supplier', $id, $filename_db);
                        $this->session->set_flashdata('flashmsgs', "Supplier Account Updated Successfully");
                        redirect(base_url() . 'admin/accounts/suppliers/');
                    }
                }
            }
            $this->data['chkinghotels'] = $this->ptmodules->is_mod_available_enabled("hotels");
            $this->data['chkingtours'] = $this->ptmodules->is_mod_available_enabled("tours");
            $this->data['chkingcars'] = $this->ptmodules->is_mod_available_enabled("cars");
            if ($this->data['chkinghotels']) {
                $this->load->model('hotels/hotels_model');
                $this->data['userhotels'] = $this->hotels_model->userOwnedHotels($id);
                $this->data['hotels'] = $this->hotels_model->all_hotels_names();

            }

            if ($this->data['chkingtours']) {
                $this->load->model('tours/tours_model');
                $this->data['usertours'] = $this->tours_model->userOwnedTours($id);
                $this->data['tours'] = $this->tours_model->all_tours_names();

            }

            if ($this->data['chkingcars']) {
                $this->load->model('cars/cars_model');
                $this->data['usercars'] = $this->cars_model->userOwnedCars($id);
                $this->data['cars'] = $this->cars_model->all_cars_names();
            }

            $this->data['page_title'] = 'Update Supplier';
            $this->data['headertitle'] = 'Update Supplier';
            $this->data['main_content'] = 'accounts/accounts-management';
        } else {
            $xcrud = xcrud_get_instance();
            $xcrud->table('pt_accounts');
            $xcrud->where('accounts_type =', 'supplier');
            $xcrud->order_by('accounts_id', 'desc');
            $xcrud->button(base_url() . 'admin/accounts/suppliers/edit/{accounts_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
            $delurl = base_url() . 'admin/ajaxcalls/delAcc';
            $xcrud->button("javascript: delfunc('{accounts_id}','$delurl')", 'DELETE', 'fa fa-times', 'btn-danger', array('target' => '_self', 'id' => '{accounts_id}'));
            $xcrud->unset_add();
            $xcrud->unset_edit();
            $xcrud->unset_remove();
            $xcrud->unset_view();
            $xcrud->columns('ai_first_name,ai_last_name,accounts_email,accounts_status,accounts_last_login');
            $xcrud->search_columns('ai_first_name,ai_last_name,accounts_email,accounts_status');
            $xcrud->column_callback('accounts_status', 'create_status_icon');
            $xcrud->column_callback('accounts_last_login', 'long_date_fmt');
            $xcrud->label('ai_first_name', 'Tên')->label('ai_last_name', 'Họ')->label('accounts_email', 'Email')->label('accounts_status', 'Active')->label('accounts_last_login', 'Đăng nhập lần cuối');

            $xcrud->multiDelUrl = base_url() . 'admin/ajaxcalls/multiDelAcc';

            $this->data['content'] = $xcrud->render();
            $this->data['page_title'] = 'Suppliers Management';
            $this->data['main_content'] = 'temp_view';
            $this->data['header_title'] = 'Suppliers Management';
            $this->data['add_link'] = base_url() . 'admin/accounts/suppliers/add';

        }

        $this->load->view('template', $this->data);
    }

// Manager function

    public function managers($args = null)
    {
        $chkadmin = modules:: run('admin/validadmin');
        if (!$chkadmin) {
            redirect(base_url() . 'admin');
        }
        $this->data['type'] = "managers";
        if ($args == 'add') {
            $subscribe = $this->input->post('newssub');
            $addaccount = $this->input->post('addaccount');
            if (!empty ($addaccount)) {

                if ($this->form_validation->run('addaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Manager Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/managers/');
                        }
                    } else {
                        $this->accounts_model->add_account($filename_db);
                        $this->session->set_flashdata('flashmsgs', "Manager Account Added Successfully");
                        redirect(base_url() . 'admin/accounts/managers/');
                    }
                }
            }
            $this->data['main_content'] = 'accounts/accounts-management';
            $this->data['page_title'] = 'Add Manager';
        } else {
            $this->data['alldata'] = $this->accounts_model->get_accounts_data($this->data['type']);
            $this->data['main_content'] = 'accounts/accounts-management';
            $this->data['page_title'] = 'Manage Managers';
        }
        $this->data['all_countries'] = $this->countries_model->get_all_countries();
        $this->load->view('template', $this->data);
    }

// Staff function

    public function staff($args = null)
    {
        $chkadmin = modules:: run('admin/validadmin');
        if (!$chkadmin) {
            redirect(base_url() . 'admin');
        }
        $this->data['type'] = "staff";
        if ($args == 'add') {
            $subscribe = $this->input->post('newssub');
            $addaccount = $this->input->post('addaccount');
            if (!empty ($addaccount)) {

                if ($this->form_validation->run('addaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Staff Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/staff/');
                        }
                    } else {
                        $this->accounts_model->add_account($filename_db);
                        $this->session->set_flashdata('flashmsgs', "Staff Account Added Successfully");
                        redirect(base_url() . 'admin/accounts/staff/');
                    }
                }
            }
            $this->data['main_content'] = 'accounts/accounts-management';
            $this->data['page_title'] = 'Add Staff';
        } else {
            $this->data['alldata'] = $this->accounts_model->get_accounts_data($this->data['type']);
            $this->data['main_content'] = 'accounts/accounts-management';
            $this->data['page_title'] = 'Manage Staff';
        }
        $this->data['all_countries'] = $this->countries_model->get_all_countries();
        $this->load->view('template', $this->data);
    }

    public function admins($args = null, $id = null)
    {


        if ($this->admin->role != "webadmin") {
            redirect(base_url() . 'admin');
        }
        $this->data['type'] = "admin";
        $userdata = $this->accounts_model->get_profile_details($id);
        if (!empty($userdata)) {
            $this->data['profile'] = $userdata;
            $this->data['isSubscribed'] = $this->newsletter_model->is_subscribed($this->data['profile'][0]->accounts_email);
            $this->data['permitted'] = explode(",", $this->data['profile'][0]->accounts_permissions);

        } else {
            $this->data['profile'] = "";
            $this->data['permitted'] = array();
        }

        if ($args == 'add') {
            $this->data['viewtype'] = "addaccount";

            $subscribe = $this->input->post('newssub');
            $addaccount = $this->input->post('addaccount');
            if (!empty ($addaccount)) {

                if ($this->form_validation->run('addaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Admin Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/admins/');
                        }
                    } else {
                        $this->accounts_model->add_account($filename_db);
                        $this->session->set_flashdata('flashmsgs', "Admin Account Added Successfully");
                        redirect(base_url() . 'admin/accounts/admins/');
                    }
                }
            }

            $this->data['page_title'] = 'Add Admin';
            $this->data['headertitle'] = 'Add Admin';
            $this->data['main_content'] = 'accounts/accounts-management';
        } elseif ($args == 'edit') {
            $this->data['viewtype'] = "updateaccount";

            $subscribe = $this->input->post('newssub');
            $updateaccount = $this->input->post('updateaccount');
            if (!empty ($updateaccount)) {

                if ($this->form_validation->run('updateaccount') == FALSE) {
                } else {
                    if (!empty ($subscribe)) {
                        $this->newsletter_model->add_subscriber($this->input->post('email'), $this->input->post('type'));
                    } else {
                        $this->newsletter_model->remove_subscriber($this->input->post('email'));

                    }
                    if (isset ($_FILES['photo']) && !empty ($_FILES['photo']['name'])) {
                        $result = $this->uploads_model->__profileimg();
                        if ($result == '1') {
                            $this->data['errormsg'] = "Invalid file type kindly select only jpg/jpeg, png, gif file types";
                        } elseif ($result == '2') {
                            $this->data['errormsg'] = "Only upto 2MB size photos allowed";
                        } elseif ($result == '3') {
                            $this->session->set_flashdata('flashmsgs', "Admin Account Added Successfully");
                            redirect(base_url() . 'admin/accounts/admins/');
                        }
                    } else {
                        $this->accounts_model->update_profile('admin', $id, $filename_db);
                        $this->session->set_flashdata('flashmsgs', "Admin Account Updated Successfully");
                        redirect(base_url() . 'admin/accounts/admins/');
                    }
                }
            }

            $this->data['page_title'] = 'Update Admin';
            $this->data['headertitle'] = 'Update Admin';
            $this->data['main_content'] = 'accounts/accounts-management';
        } else {
            $xcrud = xcrud_get_instance();
            $xcrud->table('pt_accounts');
            $xcrud->where('accounts_type =', 'admin');
            $xcrud->order_by('accounts_id', 'desc');
            $delurl = base_url() . 'admin/ajaxcalls/delAcc';
            $xcrud->button(base_url() . 'admin/accounts/admins/edit/{accounts_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));

            $xcrud->button("javascript: delfunc('{accounts_id}','$delurl')", 'DELETE', 'fa fa-times', 'btn-danger', array('target' => '_self', 'id' => '{accounts_id}'));
            $xcrud->unset_add();
            $xcrud->unset_edit();
            $xcrud->unset_remove();
            $xcrud->unset_view();
            $xcrud->columns('ai_first_name,ai_last_name,accounts_email,accounts_status,accounts_last_login');
            $xcrud->search_columns('ai_first_name,ai_last_name,accounts_email,accounts_status');
            $xcrud->column_callback('accounts_status', 'create_status_icon');
            $xcrud->column_callback('accounts_last_login', 'long_date_fmt');
            $xcrud->label('ai_first_name', 'Tên')->label('ai_last_name', 'Họ')->label('accounts_email', 'Email')->label('accounts_status', 'Active')->label('accounts_last_login', 'Đăng nhập lần cuối');
            $this->data['addpermission'] = true;

            $xcrud->multiDelUrl = base_url() . 'admin/ajaxcalls/multiDelAcc';

            $this->data['content'] = $xcrud->render();
            $this->data['page_title'] = 'Quản lý quản trị viên';
            $this->data['main_content'] = 'temp_view';
            $this->data['header_title'] = 'Quản lý quản trị viên';
            $this->data['add_link'] = base_url() . 'admin/accounts/admins/add';

        }

        $this->load->view('template', $this->data);

    }

    function delete($type, $id)
    {
        $this->accounts_model->delete_account($id);
        redirect(base_url() . 'admin/accounts/' . $type);

    }

}