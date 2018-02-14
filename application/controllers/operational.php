<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Operational extends CI_Controller {
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

        $json_result = $this->kmp_model->getAllData("js_operational_cost");

        $data["title"] = "Operational Cost";
        $data["value"] = "operational";
        $data["json_result"] = $json_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function add() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

//        $json_result = $this->profile_model->all_profile();

        $data["title"] = "Operational Cost";
        $data["value"] = "add_operational";
        $data["status"] = "";

        $data["name"] = "";
        $data["percentage"] = "";
        $data["description"] = "";
        $this->load->view("content/component/monitoring_view", $data);
    }

    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->kmp_model->select_special("js_operational_cost", "operational_id", $idData);

        $data = array_merge($data, $json_result);

//        print_r($data);
        $data["title"] = "Operational Cost";
        $data["value"] = "edit_operational";
        $data["status"] = "";
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_operational() {
        $uri = array();
        $uri = $this->get_url();

        $name = $_POST['name'];
        $percentage = $_POST['percentage'];
        $description = $_POST['description'];

        $input = array();
        $input["name"] = $name;
        $input["percentage"] = $percentage;
        $input["description"] = $description;

        if ($this->kmp_model->insert_special("js_operational_cost", "name", $name, $input)) {
            // redirect to table when its success
            redirect(base_url("/operational/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            // give status in current page
            $data["title"] = "Operational Cost";
            $data["value"] = "add_operational";

            $data["name"] = $name;
            $data["percentage"] = $percentage;
            $data["description"] = $description;
            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }

    function edit_operational() {
        $uri = array();
        $uri = $this->get_url();

        $data_id = $_POST['data_id'];
        $name = $_POST['name'];
        $percentage = $_POST['percentage'];
        $description = $_POST['description'];

        $input = array();
        $input["name"] = $name;
        $input["percentage"] = $percentage;
        $input["description"] = $description;

        $where = array();
        $where["operational_id"] = $data_id;

        $this->kmp_model->update_special("js_operational_cost", $where, $input);
        redirect(base_url("/operational/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["operational_id"] = $idData;

        $this->kmp_model->delete_special("js_operational_cost", $where);
        redirect(base_url("/operational/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>