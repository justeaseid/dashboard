<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class User extends CI_Controller {
    /* put your code here */

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('functional');
//        $this->load->library('formatter');
        $this->load->model('profile_model');
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
        $data = array();
        $data["email"] = "";
        $data["password"] = "";
        $data["status"] = "Sign In";
        $this->load->view("content/main/login_view", $data);
    }

    function data() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $json_result = $this->profile_model->all_profile();

        $data["title"] = "User";
        $data["value"] = "user";
        $data["json_result"] = $json_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function add() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $json_result = $this->profile_model->all_profile();

        $data["title"] = "User";
        $data["value"] = "add_user";
        $data["status"] = "";
        $this->load->view("content/component/monitoring_view", $data);
    }

    function insert_user() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $name = $_POST['name'];
        $username = str_replace(" ", "-", strtolower($name));
        $id_card = $_POST['idcard'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $job_title = $_POST['job_title'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $birthday = $_POST['birthday'];
        $short_bio = $_POST['short_bio'];
        $gender = $_POST['gender'];
        $status_account = "inactive";
        $expired_verification = date("Y-m-d H:i:s", strtotime("$dt +7 day"));
        $verification_code = $this->functional->make_token();

        $input = array();
        $input["tk_name"] = $token_name;
        $input["tk_apps"] = $apps_id;
        $input["tk_secret"] = $secret_key;

        $data["token_name"] = $token_name;
        $data["apps_id"] = $apps_id;
        $data["secret_key"] = $secret_key;
        $new_data["password"] = $this->functional->encrypt($password);

//        echo $expired_verificatoin;
        if ($this->profile_model->insert_profile($new_data)) {
            // give return value 'status' Success and redirect page to log in form
            $data["email"] = "";
            $data["password"] = "";
            $data["status"] = '<font color="green">Registration Success!</font>';
            $this->load->view('content/main/login_view', $data);
        } else {
            // give return value 'status' Success and redirect page to log in form
            $data["email"] = "";
            $data["status"] = '<font color="red">Registration Failed!This user already exist</font>';
            $this->load->view('content/main/register_view', $data);
        }
    }

}

?>