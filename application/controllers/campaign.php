<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Campaign extends CI_Controller {
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

//        $json_result = $this->kmp_model->getAllData("js_campaign");
        $json_result = $this->analytics_model->getCampaign();

        $data["title"] = "Campaign";
        $data["value"] = "campaign";
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
        $case_result = $this->kmp_model->getAllData("js_case_category");
        $lawyer_result = $this->kmp_model->getAllData("js_lawyer");
        $operational_result = $this->kmp_model->getAllData("js_operational_cost");

        $vercode = $this->functional->make_token();

        $data["title"] = "Campaign";
        $data["value"] = "add_campaign";
        $data["status"] = "";

        $data["name"] = "";
        $data["user_id"] = "";
        $data["titles"] = "";
        $data["category_id"] = "";
        $data["description"] = "";
        $data["country"] = "";
        $data["city"] = "";
        $data["street"] = "";
        $data["lawyer_id"] = "";
        $data["min_donation"] = "";
        $data["max_donation"] = "";
        $data["approved_donation"] = "";
        $data["expired_donation"] = "";
        $data["operational_id"] = "";
        $data["launch_date"] = "";
        $data["verification_status"] = "";
        $data["status"] = "";
        $data["is_reported"] = "";
        $data["is_promoted"] = "";
        $data["verification_code"] = $vercode["tk_secret"];

        $data["user_result"] = $user_result;
        $data["case_result"] = $case_result;
        $data["lawyer_result"] = $lawyer_result;
        $data["operational_result"] = $operational_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_result = $this->kmp_model->getAllData("js_user");
        $case_result = $this->kmp_model->getAllData("js_case_category");
        $lawyer_result = $this->kmp_model->getAllData("js_lawyer");
        $operational_result = $this->kmp_model->getAllData("js_operational_cost");

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->kmp_model->select_special("js_campaign", "campaign_id", $idData);

        $data = array_merge($data, $json_result);

//        print_r($data);
        $data["title"] = "Campaign";
        $data["value"] = "edit_campaign";
        $data["status"] = "";

        $data["user_result"] = $user_result;
        $data["case_result"] = $case_result;
        $data["lawyer_result"] = $lawyer_result;
        $data["operational_result"] = $operational_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_campaign() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_id = $_POST['user_id'];
        $titles = $_POST['titles'];
        $newTitles = preg_replace("/[^A-Za-z0-9 ]/", '', $titles);
        $slug = str_replace(" ", "-", strtolower($titles));
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $lawyer_id = $_POST['lawyer_id'];
        $min_donation = $_POST['min_donation'];
        $max_donation = $_POST['max_donation'];
        $approved_donation = $_POST['approved_donation'];
        $expired_donation = $_POST['expired_donation'];
        $operational_id = $_POST['operational_id'];
        $launch_date = $_POST['launch_date'];
        $verification_status = $_POST['verification_status'];
        $status = $_POST['status'];
        $is_reported = $_POST['is_reported'];
        $is_promoted = $_POST['is_promoted'];
        $verification_code = $_POST['verification_code'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["titles"] = $titles;
        $input["slug"] = $slug;
        $input["category_id"] = $category_id;
        $input["description"] = $description;
        $input["country"] = $country;
        $input["city"] = $city;
        $input["street"] = $street;
        $input["lawyer_id"] = $lawyer_id;
        $input["min_donation"] = $min_donation;
        $input["max_donation"] = $max_donation;
        $input["approved_donation"] = $approved_donation;
        $input["expired_donation"] = $expired_donation;
        $input["operational_id"] = $operational_id;
        $input["launch_date"] = $launch_date;
        $input["verification_status"] = $verification_status;
        $input["status"] = $status;
        $input["is_reported"] = $is_reported;
        $input["is_promoted"] = $is_promoted;
        $input["verification_code"] = $verification_code;

        if ($this->kmp_model->insert_special("js_campaign", "titles", $titles, $input)) {
            // redirect to table when its success
            redirect(base_url("/campaign/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            $user_result = $this->kmp_model->getAllData("js_user");
            $case_result = $this->kmp_model->getAllData("js_case_category");
            $lawyer_result = $this->kmp_model->getAllData("js_lawyer");
            $operational_result = $this->kmp_model->getAllData("js_operational_cost");

            // give status in current page
            $data["title"] = "Campaign";
            $data["value"] = "add_campaign";

            $data["user_id"] = $user_id;
            $data["titles"] = $titles;
            $data["category_id"] = $category_id;
            $data["description"] = $description;
            $data["country"] = $country;
            $data["city"] = $city;
            $data["street"] = $street;
            $data["lawyer_id"] = $lawyer_id;
            $data["min_donation"] = $min_donation;
            $data["max_donation"] = $max_donation;
            $data["approved_donation"] = $approved_donation;
            $data["expired_donation"] = $expired_donation;
            $data["operational_id"] = $operational_id;
            $data["launch_date"] = $launch_date;
            $data["verification_status"] = $verification_status;
            $data["status"] = $status;
            $data["is_reported"] = $is_reported;
            $data["is_promoted"] = $is_promoted;
            $data["verification_code"] = $verification_code;

            $data["user_result"] = $user_result;
            $data["case_result"] = $case_result;
            $data["lawyer_result"] = $lawyer_result;
            $data["operational_result"] = $operational_result;

            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }

    function edit_campaign() {
        $uri = array();
        $uri = $this->get_url();

        $data_id = $_POST['data_id'];
        $user_id = $_POST['user_id'];
        $titles = $_POST['titles'];
        $newTitles = preg_replace("/[^A-Za-z0-9 ]/", '', $titles);
        $slug = str_replace(" ", "-", strtolower($titles));
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $lawyer_id = $_POST['lawyer_id'];
        $min_donation = $_POST['min_donation'];
        $max_donation = $_POST['max_donation'];
        $approved_donation = $_POST['approved_donation'];
        $expired_donation = $_POST['expired_donation'];
        $operational_id = $_POST['operational_id'];
        $launch_date = $_POST['launch_date'];
        $verification_status = $_POST['verification_status'];
        $status = $_POST['status'];
        $is_reported = $_POST['is_reported'];
        $is_promoted = $_POST['is_promoted'];
        $verification_code = $_POST['verification_code'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["titles"] = $titles;
        $input["slug"] = $slug;
        $input["category_id"] = $category_id;
        $input["description"] = $description;
        $input["country"] = $country;
        $input["city"] = $city;
        $input["street"] = $street;
        $input["lawyer_id"] = $lawyer_id;
        $input["min_donation"] = $min_donation;
        $input["max_donation"] = $max_donation;
        $input["approved_donation"] = $approved_donation;
        $input["expired_donation"] = $expired_donation;
        $input["operational_id"] = $operational_id;
        $input["launch_date"] = $launch_date;
        $input["verification_status"] = $verification_status;
        $input["status"] = $status;
        $input["is_reported"] = $is_reported;
        $input["is_promoted"] = $is_promoted;
        $input["verification_code"] = $verification_code;

        $where = array();
        $where["campaign_id"] = $data_id;

        $this->kmp_model->update_special("js_campaign", $where, $input);
        redirect(base_url("/campaign/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["campaign_id"] = $idData;

        $this->kmp_model->delete_special("js_campaign", $where);
        redirect(base_url("/campaign/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>