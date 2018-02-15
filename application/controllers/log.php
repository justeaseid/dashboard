<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Log extends CI_Controller {
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

        $json_result = $this->analytics_model->getLog();
//        print_r($json_result);
//        echo mysql_num_rows($json_result);
//        echo gettype($json_result);

        $data["title"] = "Log Activity";
        $data["value"] = "log";
        $data["json_result"] = $json_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function add() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

//        $json_result = $this->profile_model->all_profile();
        $data_result = $this->kmp_model->getAllData("js_user");

        $data["title"] = "Log Activity";
        $data["value"] = "add_log";
        $data["status"] = "";

        $data["name"] = "";
        $data["user_id"] = "";
        $data["type"] = "";
        $data["action"] = "";
        $data["activity"] = "";
        $data["data_result"] = $data_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->kmp_model->select_special("js_log", "log_id", $idData);
        $data_result = $this->kmp_model->getAllData("js_user");

        $data = array_merge($data, $json_result);

//        print_r($data);
        $data["title"] = "Log Activity";
        $data["value"] = "edit_log";
        $data["status"] = "";
        $data["data_result"] = $data_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_log() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $user_id = $_POST['user_id'];
        $type = $_POST['type'];
        $action = $_POST['action'];
        $activity = $_POST['activity'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["type"] = $type;
        $input["action"] = $action;
        $input["activity"] = $activity;

        if ($this->kmp_model->insert_special("js_log", "log_id", "0", $input)) {
            // redirect to table when its success
            redirect(base_url("/log/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            // give status in current page
            $data["title"] = "Log Activity";
            $data["value"] = "add_log";

            $data["user_id"] = "";
            $data["type"] = $type;
            $data["action"] = $action;
            $data["activity"] = $activity;
            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }

    function edit_log() {
        $uri = array();
        $uri = $this->get_url();

        $data_id = $_POST['data_id'];
        $user_id = $_POST['user_id'];
        $type = $_POST['type'];
        $action = $_POST['action'];
        $activity = $_POST['activity'];

        $input = array();
        $input["user_id"] = $user_id;
        $input["type"] = $type;
        $input["action"] = $action;
        $input["activity"] = $activity;

        $where = array();
        $where["log_id"] = $data_id;

        $this->kmp_model->update_special("js_log", $where, $input);
        redirect(base_url("/log/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["log_id"] = $idData;

        $this->kmp_model->delete_special("js_log", $where);
        redirect(base_url("/log/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>