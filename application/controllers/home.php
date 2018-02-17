<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Home extends CI_Controller {
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

    function analysis() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

//        $json_result = $this->analytics_model->getBlog();
        $campaign_donated = $this->analytics_model->getSum("js_donation", "amount_for_campaign", "");
        $target_campaign = $this->analytics_model->getSum("js_campaign", "approved_donation", "");
        $active_campaign = $this->analytics_model->getCount("js_campaign", "campaign_id", "WHERE `verification_status`='active'");
        $registered_user = $this->analytics_model->getCount("js_user", "user_id", "");
        $reported_campaign = $this->analytics_model->getCount("js_campaign", "campaign_id", "WHERE `is_reported`='yes'");
        $company_donated = $this->analytics_model->getSum("js_donation", "amount_for_company", "");
        $log_activity = $this->analytics_model->getCount("js_log", "log_id", "");
        $comments = $this->analytics_model->getCount("js_donation", "donation_id", "WHERE `comment`<>''");
        $total_lawyer = $this->analytics_model->getCount("js_lawyer", "lawyer_id", "");
        $active_user = $this->analytics_model->getCount("js_user", "user_id", "WHERE `status_account`='active'");
        $total_article = $this->analytics_model->getCount("js_blog", "article_id", "");
        
        $data["title"] = "Home";
        $data["value"] = "home";
        $data["campaign_donated"] = $campaign_donated["jumlah"];
        $data["target_campaign"] = $target_campaign["jumlah"];
        $data["active_campaign"] = $active_campaign["jumlah"];
        $data["registered_user"] = $registered_user["jumlah"];
        $data["reported_campaign"] = $reported_campaign["jumlah"];
        $data["company_donated"] = $company_donated["jumlah"];
        $data["log_activity"] = $log_activity["jumlah"];
        $data["comments"] = $comments["jumlah"];
        $data["total_lawyer"] = $total_lawyer["jumlah"];
        $data["active_user"] = $active_user["jumlah"];
        $data["total_article"] = $total_article["jumlah"];
        
        $this->load->view("content/component/monitoring_view", $data);
    }

}

?>