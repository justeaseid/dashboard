<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Article extends CI_Controller {
    /* put your code here */

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('functional');
        $this->load->model('profile_model');
        $this->load->model('kmp_model');
    }

    function get_url() {
        $uri = array();
        $uri["enc_email"] = ($this->uri->segment(3) ? $this->uri->segment(3) : "NULL");
        $uri["group"] = ($this->uri->segment(4) ? $this->uri->segment(4) : "0");
        return $uri;
    }

    /* loaded at the first time the web was opened */
    /* load login_view */

    function index() {
        
    }

    function data() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $json_result = $this->analytics_model->getBlog();

        $data["title"] = "Article";
        $data["value"] = "article";
        $data["json_result"] = $json_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function add() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

//        $json_result = $this->profile_model->all_profile();
        $user_result = $this->kmp_model->getAllData("js_user");
        $category_result = $this->kmp_model->getAllData("js_category");

        $data["title"] = "Article";
        $data["value"] = "add_article";
        $data["status"] = "";

        $data["user_id"] = "";
        $data["category_id"] = "";
        $data["titles"] = "";
        $data["summary"] = "";
        $data["content"] = "";
        $data["is_published"] = "";
        $data["is_scheduled"] = "";
        $data["is_promoted"] = "";

        $data["user_result"] = $user_result;
        $data["category_result"] = $category_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_result = $this->kmp_model->getAllData("js_user");
        $category_result = $this->kmp_model->getAllData("js_category");

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->kmp_model->select_special("js_blog", "article_id", $idData);

        $data = array_merge($data, $json_result);

//        print_r($data);
        $data["title"] = "Article";
        $data["value"] = "edit_article";
        $data["status"] = "";

        $data["user_result"] = $user_result;
        $data["category_result"] = $category_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_article() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_id = $_POST['user_id'];
        $category_id = $_POST['category_id'];
        $titles = $_POST['titles'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $is_published = $_POST['is_published'];
        $is_scheduled = $_POST['is_scheduled'];
        $is_promoted = $_POST['is_promoted'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["category_id"] = $category_id;
        $input["titles"] = $titles;
        $input["summary"] = $summary;
        $input["content"] = $content;
        $input["is_published"] = $is_published;
        $input["is_scheduled"] = $is_scheduled;
        $input["is_promoted"] = $is_promoted;

        if ($this->kmp_model->insert_special("js_blog", "titles", $titles, $input)) {
            // redirect to table when its success
            redirect(base_url("/article/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            $user_result = $this->kmp_model->getAllData("js_user");
            $category_result = $this->kmp_model->getAllData("js_category");

            // give status in current page
            $data["title"] = "Article";
            $data["value"] = "add_article";

            $data["user_id"] = $user_id;
            $data["category_id"] = $category_id;
            $data["titles"] = $titles;
            $data["summary"] = $summary;
            $data["content"] = $content;
            $data["is_published"] = $is_published;
            $data["is_scheduled"] = $is_scheduled;
            $data["is_promoted"] = $is_promoted;

            $data["user_result"] = $user_result;
            $data["category_result"] = $category_result;
            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }

    function edit_article() {
        $uri = array();
        $uri = $this->get_url();

        $data_id = $_POST['data_id'];
        $user_id = $_POST['user_id'];
        $category_id = $_POST['category_id'];
        $titles = $_POST['titles'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $is_published = $_POST['is_published'];
        $is_scheduled = $_POST['is_scheduled'];
        $is_promoted = $_POST['is_promoted'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["category_id"] = $category_id;
        $input["titles"] = $titles;
        $input["summary"] = $summary;
        $input["content"] = $content;
        $input["is_published"] = $is_published;
        $input["is_scheduled"] = $is_scheduled;
        $input["is_promoted"] = $is_promoted;

        $where = array();
        $where["article_id"] = $data_id;

        $this->kmp_model->update_special("js_blog", $where, $input);
        redirect(base_url("/article/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["article_id"] = $idData;

        $this->kmp_model->delete_special("js_blog", $where);
        redirect(base_url("/article/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>