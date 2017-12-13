<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('pt_post_thumbnail')) {
    function pt_post_thumbnail($id)
    {
        $CI = get_instance();

        $CI->load->model('blog_model');

        $res = $CI->blog_model->post_thumbnail($id);

        if (!empty($res)) {
            if (file_exists(PT_BLOG_THUMBS_UPLOAD . $res)) {
                return PT_BLOG_THUMBS . $res;
            } else {
                return PT_BLOG_IMAGES . $res;
            }
        } else {
            return PT_BLANK;
        }


    }
}

if (!function_exists('pt_post_full')) {
    function pt_post_full($id)
    {
        $CI = get_instance();

        $CI->load->model('blog_model');

        $res = $CI->blog_model->post_thumbnail($id);

        if (!empty($res)) {
            return PT_BLOG_IMAGES . $res;
        } else {
            return PT_BLANK;
        }


    }
}

if (!function_exists('pt_posts_count')) {
    function pt_posts_count($id)
    {
        $CI = get_instance();

        $CI->load->model('blog_model');

        return $CI->blog_model->category_posts_count($id);


    }
}

if (!function_exists('pt_blog_category_name')) {
    function pt_blog_category_name($id_slug)
    {
        $CI = get_instance();

        $CI->load->model('blog_model');

        return $CI->blog_model->category_name($id_slug);


    }
}
if (!function_exists('pt_blog_category_slug')) {
    function pt_blog_category_slug($id_slug)
    {
        $CI = get_instance();

        $CI->load->model('blog_model');

        return $CI->blog_model->category_slug($id_slug);


    }
}
if (!function_exists('pt_blog_category_parent')) {
    function pt_blog_category_parent($id_slug)
    {
        $CI = get_instance();

        $CI->load->model('blog_model');

        return $CI->blog_model->category_parent($id_slug);


    }
}
