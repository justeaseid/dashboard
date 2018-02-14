<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Payment extends CI_Controller {
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

        $json_result = $this->kmp_model->getAllData("js_payment");

        $data["title"] = "Payment";
        $data["value"] = "payment";
        $data["json_result"] = $json_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function add() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

//        $json_result = $this->profile_model->all_profile();

        $data["title"] = "Payment";
        $data["value"] = "add_payment";
        $data["status"] = "";

        $data["name"] = "";
        $data["slug"] = "";
        $data["account_number"] = "";
        $data["account_name"] = "";
        $data["branch"] = "";
        $data["description"] = "";
        $this->load->view("content/component/monitoring_view", $data);
    }

    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->kmp_model->select_special("js_payment", "payment_id", $idData);

        $data = array_merge($data, $json_result);

//        print_r($data);
        $data["title"] = "Payment";
        $data["value"] = "edit_payment";
        $data["status"] = "";
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_payment() {
        $uri = array();
        $uri = $this->get_url();
        
        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $account_number = $_POST['account_number'];
        $account_name = $_POST['account_name'];
        $branch = $_POST['branch'];
        $description = $_POST['description'];

        $input = array();
        $input["name"] = $name;
        $input["slug"] = $slug;
        $input["account_number"] = $account_number;
        $input["account_name"] = $account_name;
        $input["branch"] = $branch;
        $input["description"] = $description;

        if ($this->kmp_model->insert_special("js_payment", "name", $name, $input)) {
            // redirect to table when its success
            redirect(base_url("/payment/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            // give status in current page
            $data["title"] = "Payment";
            $data["value"] = "add_payment";

            $data["name"] = $name;
            $data["slug"] = $slug;
            $data["account_number"] = $account_number;
            $data["account_name"] = $account_name;
            $data["branch"] = $branch;
            $data["description"] = $description;
            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }

    function edit_payment() {
        $uri = array();
        $uri = $this->get_url();

        $data_id = $_POST['data_id'];
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $account_number = $_POST['account_number'];
        $account_name = $_POST['account_name'];
        $branch = $_POST['branch'];
        $description = $_POST['description'];

        $input = array();
        $input["name"] = $name;
        $input["slug"] = $slug;
        $input["account_number"] = $account_number;
        $input["account_name"] = $account_name;
        $input["branch"] = $branch;
        $input["description"] = $description;

        $where = array();
        $where["payment_id"] = $data_id;

        $this->kmp_model->update_special("js_payment", $where, $input);
        redirect(base_url("/payment/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["payment_id"] = $idData;

        $this->kmp_model->delete_special("js_payment", $where);
        redirect(base_url("/payment/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>