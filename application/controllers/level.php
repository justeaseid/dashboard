<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Level extends CI_Controller {
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

        $json_result = $this->kmp_model->getAllData("js_user_level");

        $data["title"] = "User Level";
        $data["value"] = "level";
        $data["json_result"] = $json_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function add() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

//        $json_result = $this->profile_model->all_profile();

        $data["title"] = "User Level";
        $data["value"] = "add_level";
        $data["status"] = "";

        $data["name"] = "";
        $data["description"] = "";
        $this->load->view("content/component/monitoring_view", $data);
    }
    
    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);
        
        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->   kmp_model->select_special("js_user_level", "level_id", $idData);
        
        $data = array_merge($data, $json_result);

//        print_r($data);
        $data["title"] = "User Level";
        $data["value"] = "edit_level";
        $data["status"] = "";
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_level() {
        $uri = array();
        $uri = $this->get_url();

        $name = $_POST['name'];
        $description = $_POST['description'];

        $input = array();
        $input["name"] = $name;
        $input["description"] = $description;

        if ($this->kmp_model->insert_special("js_user_level", "name", $name, $input)) {
            // redirect to table when its success
            redirect(base_url("/level/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            // give status in current page
            $data["title"] = "User Level";
            $data["value"] = "add_level";

            $data["name"] = $name;
            $data["description"] = $description;
            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }

    function edit_level() {
        $uri = array();
        $uri = $this->get_url();

        $level_id = $_POST['level_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $input = array();
        $input["name"] = $name;
        $input["description"] = $description;

        $where = array();
        $where["level_id"] = $level_id;
        
        $this->kmp_model->update_special("js_user_level", $where, $input);
        redirect(base_url("/level/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }
    
    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["level_id"] = $idData;
        
        $this->kmp_model->delete_special("js_user_level", $where);
        redirect(base_url("/level/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>