<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Report extends CI_Controller {
    /* put your code here */

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('functional');
        $this->load->model('profile_model');
        $this->load->model('kmp_model');
        $this->load->model('analytics_model');
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

//        $json_result = $this->kmp_model->getAllData("js_report");
        $json_result = $this->analytics_model->getReport();

        $data["title"] = "Report";
        $data["value"] = "report";
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
        $campaign_result = $this->kmp_model->getAllData("js_campaign");

        $data["title"] = "Report";
        $data["value"] = "add_report";
        $data["status"] = "";

        $data["name"] = "";
        $data["user_id"] = "";
        $data["titles"] = "";
        $data["campaign_id"] = "";
        $data["message"] = "";

        $data["user_result"] = $user_result;
        $data["campaign_result"] = $campaign_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_result = $this->kmp_model->getAllData("js_user");
        $campaign_result = $this->kmp_model->getAllData("js_campaign");

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->kmp_model->select_special("js_report", "report_id", $idData);

        $data = array_merge($data, $json_result);

//        print_r($data);
        $data["title"] = "Report";
        $data["value"] = "edit_report";
        $data["status"] = "";

        $data["user_result"] = $user_result;
        $data["campaign_result"] = $campaign_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_report() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_id = $_POST['user_id'];
        $campaign_id = $_POST['campaign_id'];
        $message = $_POST['message'];
        $is_valid = $_POST['is_valid'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["campaign_id"] = $campaign_id;
        $input["message"] = $message;
        $input["is_valid"] = $is_valid;

        if ($this->kmp_model->insert_special("js_report", "campaign_id", "0", $input)) {
            // redirect to table when its success
            redirect(base_url("/report/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            $user_result = $this->kmp_model->getAllData("js_user");
            $campaign_result = $this->kmp_model->getAllData("js_campaign");

            // give status in current page
            $data["title"] = "Report";
            $data["value"] = "add_report";

            $data["user_id"] = $user_id;
            $data["campaign_id"] = $campaign_id;
            $data["message"] = $message;
            $data["is_valid"] = $is_valid;

            $data["user_result"] = $user_result;
            $data["campaign_result"] = $campaign_result;

            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }

    function edit_report() {
        $uri = array();
        $uri = $this->get_url();

        $data_id = $_POST['data_id'];
        $user_id = $_POST['user_id'];
        $campaign_id = $_POST['campaign_id'];
        $message = $_POST['message'];
        $is_valid = $_POST['is_valid'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["campaign_id"] = $campaign_id;
        $input["message"] = $message;
        $input["is_valid"] = $is_valid;

        $where = array();
        $where["report_id"] = $data_id;

        $this->kmp_model->update_special("js_report", $where, $input);
        redirect(base_url("/report/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["report_id"] = $idData;

        $this->kmp_model->delete_special("js_report", $where);
        redirect(base_url("/report/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>