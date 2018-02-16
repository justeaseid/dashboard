<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Donation extends CI_Controller {
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

//        $json_result = $this->kmp_model->getAllData("js_donation");
        $json_result = $this->analytics_model->getDonation();

        $data["title"] = "Donation";
        $data["value"] = "donation";
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
        $payment_result = $this->kmp_model->getAllData("js_payment");

        $vercode = $this->functional->make_token();

        $data["title"] = "Donation";
        $data["value"] = "add_donation";
        $data["status"] = "";

        $data["user_id"] = "";
        $data["titles"] = "";
        $data["campaign_id"] = "";
        $data["payment_id"] = "";
        $data["amount_for_campaign"] = "";
        $data["amount_for_company"] = "";
        $data["comment"] = "";
        $data["is_anymous"] = "";
        $data["expired_date"] = "";
        $data["status"] = "";
        $data["verification_code"] = $vercode["tk_secret"];

        $data["user_result"] = $user_result;
        $data["campaign_result"] = $campaign_result;
        $data["payment_result"] = $payment_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_result = $this->kmp_model->getAllData("js_user");
        $campaign_result = $this->kmp_model->getAllData("js_campaign");
        $payment_result = $this->kmp_model->getAllData("js_payment");

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->kmp_model->select_special("js_donation", "donation_id", $idData);

        $data = array_merge($data, $json_result);

//        print_r($data);
        $data["title"] = "Donation";
        $data["value"] = "edit_donation";
        $data["status"] = "";

        $data["user_result"] = $user_result;
        $data["campaign_result"] = $campaign_result;
        $data["payment_result"] = $payment_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_donation() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_id = $_POST['user_id'];
        $campaign_id = $_POST['campaign_id'];
        $payment_id = $_POST['payment_id'];
        $amount_for_campaign = $_POST['amount_for_campaign'];
        $amount_for_company = $_POST['amount_for_company'];
        $comment = $_POST['comment'];
        $is_anymous = $_POST['is_anymous'];
        $expired_date = $_POST['expired_date'];
        $status = $_POST['status'];
        $verification_code = $_POST['verification_code'];

        $input = array();
        $input["user_id"] = $user_id;
//        $input["titles"] = $titles;
        $input["campaign_id"] = $campaign_id;
        $input["payment_id"] = $payment_id;
        $input["amount_for_campaign"] = $amount_for_campaign;
        $input["amount_for_company"] = $amount_for_company;
        $input["comment"] = $comment;
        $input["is_anymous"] = $is_anymous;
        $input["expired_date"] = $expired_date;
        $input["status"] = $status;
        $input["verification_code"] = $verification_code;

        if ($this->kmp_model->insert_special("js_donation", "campaign_id", "0", $input)) {
            // redirect to table when its success
            redirect(base_url("/donation/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            $user_result = $this->kmp_model->getAllData("js_user");
            $campaign_result = $this->kmp_model->getAllData("js_campaign");
            $payment_result = $this->kmp_model->getAllData("js_payment");

            // give status in current page
            $data["title"] = "Donation";
            $data["value"] = "add_donation";

            $data["user_id"] = $user_id;
            $data["titles"] = $titles;
            $data["campaign_id"] = $campaign_id;
            $data["payment_id"] = $payment_id;
            $data["amount_for_campaign"] = $amount_for_campaign;
            $data["amount_for_company"] = $amount_for_company;
            $data["comment"] = $comment;
            $data["is_anymous"] = $is_anymous;
            $data["expired_date"] = $expired_date;
            $data["status"] = $status;
            $data["verification_code"] = $verification_code;

            $data["user_result"] = $user_result;
            $data["campaign_result"] = $campaign_result;
            $data["payment_result"] = $payment_result;

            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }

    function edit_donation() {
        $uri = array();
        $uri = $this->get_url();

        $data_id = $_POST['data_id'];
        $user_id = $_POST['user_id'];
        $campaign_id = $_POST['campaign_id'];
        $payment_id = $_POST['payment_id'];
        $amount_for_campaign = $_POST['amount_for_campaign'];
        $amount_for_company = $_POST['amount_for_company'];
        $comment = $_POST['comment'];
        $is_anymous = $_POST['is_anymous'];
        $expired_date = $_POST['expired_date'];
        $status = $_POST['status'];
        $verification_code = $_POST['verification_code'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["campaign_id"] = $campaign_id;
        $input["payment_id"] = $payment_id;
        $input["amount_for_campaign"] = $amount_for_campaign;
        $input["amount_for_company"] = $amount_for_company;
        $input["comment"] = $comment;
        $input["is_anymous"] = $is_anymous;
        $input["expired_date"] = $expired_date;
        $input["status"] = $status;
        $input["verification_code"] = $verification_code;

        $where = array();
        $where["donation_id"] = $data_id;

        $this->kmp_model->update_special("js_donation", $where, $input);
        redirect(base_url("/donation/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["donation_id"] = $idData;

        $this->kmp_model->delete_special("js_donation", $where);
        redirect(base_url("/donation/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>