<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Blog extends MX_Controller {
    private $data = array();
    private $validlang;
    protected $ci = NULL; //codeigniter instance

    function __construct() {
        parent :: __construct();
        modules :: load('home');
        $this->load->library("blog_lib");
        $this->load->model("blog/blog_model");
        $this->load->library('hotels/hotels_lib');
        $this->load->helper("blog_front");
        $this->ci = & get_instance();
        $this->load->library('breadcrumbcomponent');
        $this->data['phone'] = $this->load->get_var('phone');
        $this->data['contactemail'] = $this->load->get_var('contactemail');
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $this->data['lang_set'] = $this->session->userdata('set_lang');
        $this->data['usersession'] = $this->session->userdata('pt_logged_customer');
        $this->data['bloglib'] = $this->blog_lib;
        $chk = modules :: run('home/is_main_module_enabled', 'blog');
        if (!$chk) {
            Error_404();
        }

        

        $settings = $this->settings_model->get_front_settings('blog');
       
        $languageid = $this->uri->segment(2);
                $this->validlang = pt_isValid_language($languageid);

                if($this->validlang){
                  $this->data['lang_set'] =  $languageid;
                }else{
                  $this->data['lang_set'] = $this->session->userdata('set_lang');
                }

        $defaultlang = pt_get_default_language();
        if (empty ($this->data['lang_set'])){
            $this->data['lang_set'] = $defaultlang;
        }



        $this->lang->load("front", $this->data['lang_set']);
        $this->blog_lib->set_lang($this->data['lang_set']);
        $this->data['popular_posts'] = $this->blog_model->get_popular_posts($settings[0]->front_popular);
        $this->data['feature_posts'] = $this->blog_model->get_featured_posts($settings[0]->front_related);
        $this->data['categories'] = $this->blog_lib->getCategories();
    }

    public function index() {
        $settings = $this->settings_model->get_front_settings('blog');
        $this->data['ptype'] = "index";
        $this->data['categoryname'] = "";
        
        if($this->validlang){

                    $slug = $this->uri->segment(3);

                }else{

                    $slug = $this->uri->segment(2);
                }
        if (!empty ($slug)) {
            $this->blog_lib->set_blogid($slug);
            $this->data['details'] = $this->blog_lib->post_details();
            $this->data['title'] = $this->blog_lib->title;
            $this->data['desc'] = $this->blog_lib->desc;
            $this->data['thumbnail'] = $this->blog_lib->thumbnail;
            $this->data['date'] = $this->blog_lib->date;
            $this->data['view'] = $this->data['details'][0]->post_visits;
            $hits = $this->blog_lib->hits + 1;
            $this->blog_model->update_visits($this->data['details'][0]->post_id, $hits);
            $relatedstatus = $settings[0]->testing_mode;
            if ($relatedstatus == "1") {
                $this->data['related_posts'] = $this->blog_model->get_related_posts($this->data['details'][0]->post_related, $settings[0]->front_related);
            }
            else {
                $this->data['related_posts'] = "";
            }
            $res = $this->settings_model->get_contact_page_details();
            $this->data['fbcomments'] = $settings[0]->front_fb_comments;
            $this->data['sharing'] = $settings[0]->front_sharing;
            $this->data['phone'] = $res[0]->contact_phone;
            $this->data['tel'] = $res[0]->tel;
            $this->data['fax'] = $res[0]->fax;
            $this->data['page_title'] = $this->blog_lib->title;
            $this->data['metakey'] = $this->data['details'][0]->post_meta_keywords;
            $this->data['metadesc'] = $this->data['details'][0]->post_meta_desc;
            $this->data['langurl'] = base_url()."blog/{langid}/".$this->blog_lib->slug;
            $this->data['url'] = base_url()."blog/".$this->blog_lib->slug;
            $camnang = $this->blog_lib->category_posts($offset,'cam-nang-du-lich');
            $this->data['camnang'] = $camnang['all_posts'];
            
            $catid = $this->blog_lib->catid;
            
            $catslug = pt_blog_category_slug($catid);
            $catname = pt_blog_category_name($catslug);
            $catparent = pt_blog_category_parent($catid);
            
            
            if($catparent>0) {
                $parentslug = pt_blog_category_slug($catparent);
                $parentname = pt_blog_category_name($parentslug);
                $this->breadcrumbcomponent->add($parentname, base_url()."blog/category?cat=".$parentslug);
            }
            $this->breadcrumbcomponent->add($catname, base_url()."blog/category?cat=".$catslug);
            $this->breadcrumbcomponent->add($this->blog_lib->title, base_url()."blog/".$this->blog_lib->slug);  
            $this->data['breadcrumb'] = $this->breadcrumbcomponent->output();
            
            $this->theme->view('blog/blog', $this->data);
            $this->output->cache(20) ;
        }
        else {
            $this->listing();
        }
    }

    function listing($offset = null) {
        $settings = $this->settings_model->get_front_settings('blog');
        $this->data['ptype'] = "index";
        $this->data['categoryname'] = "";
        $allposts = $this->blog_lib->show_posts($offset);
        $this->data['allposts'] = $allposts['all_posts'];
        $this->data['info'] = $allposts['paginationinfo'];
        $this->data['page_title'] = $settings[0]->header_title;
        $diemden = $this->blog_lib->category_posts($offset,'diem-den');
        $this->data['diemden'] = $diemden['all_posts'];
        $amthuc = $this->blog_lib->category_posts($offset,'am-thuc');
        $this->data['amthuc'] = $amthuc['all_posts'];
        $kinhnghiem = $this->blog_lib->category_posts($offset,'kinh-nghiem');
        $this->data['kinhnghiem'] = $kinhnghiem['all_posts'];
        $khuyenmai = $this->blog_lib->category_posts($offset,'khuyen-mai');
        $this->data['khuyenmai'] = $khuyenmai['all_posts'];
        $anhvideo = $this->blog_lib->category_posts($offset,'anh-video');
        $this->data['anhvideo'] = $anhvideo['all_posts'];
        $camnang = $this->blog_lib->category_posts($offset,'cam-nang-du-lich');
        $this->data['camnang'] = $camnang['all_posts'];
        $khachsan = $this->blog_lib->category_posts($offset,'khach-san-va-resort');
        $this->data['khachsan'] = $khachsan['all_posts'];
        $checkin = date($this->data['app_settings'][0]->date_f,strtotime('+'.CHECKIN_SPAN.' day', time()));
        $checkout = date($this->data['app_settings'][0]->date_f, strtotime('+'.CHECKOUT_SPAN.' day', time()));
        $this->data['hotelslocationsList'] = $this->hotels_lib->getLocationsList($checkin,$checkout);
        $this->data['langurl'] = base_url()."blog/{langid}/";
        $this->theme->view('blog/index', $this->data);
        $this->output->cache(20) ;
    }

    function search($offset = null) {
        $this->data['ptype'] = "search";
        $this->data['categoryname'] = "";
        $settings = $this->settings_model->get_front_settings('blog');
        $allposts = $this->blog_lib->search_posts($offset);
        $this->data['allposts'] = $allposts['all_posts'];
        $this->data['info'] = $allposts['paginationinfo'];
        $this->data['plinks'] = $allposts['plinks'];
        $this->data['plinks2'] = $allposts['plinks2'];
        $this->data['page_title'] = $settings[0]->header_title;
        $camnang = $this->blog_lib->category_posts($offset,'cam-nang-du-lich');
        $this->data['camnang'] = $camnang['all_posts'];
        $this->data['langurl'] = base_url()."blog/{langid}/";
        $this->theme->view('blog/index', $this->data);
    }

    function category($offset = null) {
        $settings = $this->settings_model->get_front_settings('blog');
        //$id = $this->input->get('cat');
        $id = $this->ci->uri->segment(3);
        $this->data['current'] = $id;
        $this->data['ptype'] = "category";
        $this->data['categoryname'] = pt_blog_category_name($id);
        $allposts = $this->blog_lib->category_posts($offset);
        $this->data['allposts'] = $allposts['all_posts'];
        $this->data['info'] = $allposts['paginationinfo'];
        $this->data['plinks'] = $allposts['plinks'];
        $this->data['plinks2'] = $allposts['plinks2'];
        $this->data['page_title'] = $settings[0]->header_title;
        $camnang = $this->blog_lib->category_posts($offset,'cam-nang-du-lich');
        $this->data['camnang'] = $camnang['all_posts'];
        $this->data['cinfo'] = $camnang['paginationinfo'];
        $this->data['cplinks'] = $camnang['plinks'];
        $this->data['cplinks2'] = $camnang['plinks2'];
        $checkin = date($this->data['app_settings'][0]->date_f,strtotime('+'.CHECKIN_SPAN.' day', time()));
        $checkout = date($this->data['app_settings'][0]->date_f, strtotime('+'.CHECKOUT_SPAN.' day', time()));
        $this->data['hotelslocationsList'] = $this->hotels_lib->getLocationsList($checkin,$checkout);
        $this->theme->view('blog/category', $this->data);
        $this->output->cache(20) ;
    }

}