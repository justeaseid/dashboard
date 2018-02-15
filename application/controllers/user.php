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
    /* load userin_view */

    function index() {
        
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

//        $json_result = $this->profile_model->all_profile();
        $data_result = $this->kmp_model->getAllData("js_user_level");
        $vercode = $this->functional->make_token();

        $data["title"] = "User";
        $data["value"] = "add_user";
        $data["status"] = "";

        $data["name"] = "";
        $data["id_card"] = "";
        $data["level_id"] = "";
        $data["email"] = "";
        $data["password"] = "";
        $data["job_title"] = "";
        $data["birthday"] = "";
        $data["phone_number"] = "";
        $data["country"] = "";
        $data["city"] = "";
        $data["street"] = "";
        $data["short_bio"] = "";
        $data["male"] = "";
        $data["female"] = "";
        $data["status_account"] = "";
        $data["verification_code"] = $vercode["tk_secret"];
        $data["data_result"] = $data_result;
        $this->load->view("content/component/monitoring_view", $data);
    }

    function edit() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $json_result = $this->kmp_model->select_special("js_user", "user_id", $idData);
        $data_result = $this->kmp_model->getAllData("js_user_level");

        $data = array_merge($data, $json_result);

        $gender = $data["gender"];
        if ($gender == "male") {
            $data["male"] = "checked";
            $data["female"] = "";
        } else {
            $data["male"] = "";
            $data["female"] = "checked";
        }

//        print_r($data);
        $data["title"] = "User";
        $data["value"] = "edit_user";
        $data["status"] = "";
        $data["data_result"] = $data_result;
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
        $phone = $_POST['phone_number'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $birthday = $_POST['birthday'];
        $short_bio = $_POST['short_bio'];
        $gender = $_POST['gender'];

        $status_account = $_POST['status_account'];
        $dt = date("Y-m-d H:i:s");
        $expired_verification = date("Y-m-d H:i:s", strtotime("$dt +7 day"));
        $verification_code = $_POST['verification_code'];

        $input = array();
        $input["name"] = $name;
        $input["username"] = $username;
        $input["id_card"] = $id_card;
        $input["email"] = $email;
        $input["password"] = $password;
        $input["job_title"] = $job_title;
        $input["phone_number"] = $phone;
        $input["country"] = $country;
        $input["city"] = $city;
        $input["street"] = $street;
        $input["birthday"] = $birthday;
        $input["short_bio"] = $short_bio;
        $input["gender"] = $gender;
        $input["status_account"] = $status_account;
        $input["expired_verification"] = $expired_verification;
        $input["verification_code"] = $verification_code;

        if ($this->kmp_model->insert_special("js_user", "email", $email, $input)) {
            // redirect to table when its success
            redirect(base_url("/user/data/" . $uri['enc_email']) . "/" . $uri['group'], 'refresh');
        } else {
            // give status in current page
            $data_result = $this->kmp_model->getAllData("js_user_level");

            $data["title"] = "User";
            $data["value"] = "add_user";

            $data["name"] = $name;
            $data["username"] = $username;
            $data["id_card"] = $id_card;
            $data["email"] = $email;
            $data["password"] = $password;
            $data["job_title"] = $job_title;
            $data["phone"] = $phone;
            $data["country"] = $country;
            $data["city"] = $city;
            $data["street"] = $street;
            $data["birthday"] = $birthday;
            $data["short_bio"] = $short_bio;
            $data["gender"] = $gender;
            if ($gender == "male") {
                $data["male"] = "checked";
                $data["female"] = "";
            } else {
                $data["male"] = "";
                $data["female"] = "checked";
            }
            $data["status_account"] = $status_account;
            $data["expired_verification"] = $expired_verification;
            $data["verification_code"] = $verification_code;
            $data["data_result"] = $data_result;
            $data["status"] = '<font color="red">This data already exist</font>';
            $this->load->view('content/component/monitoring_view', $data);
        }
    }
    
    function edit_user() {
        $uri = array();
        $uri = $this->get_url();

        $data_id = $_POST['data_id'];
        $name = $_POST['name'];
        $id_card = $_POST['idcard'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $job_title = $_POST['job_title'];
        $phone = $_POST['phone_number'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $birthday = $_POST['birthday'];
        $short_bio = $_POST['short_bio'];
        $gender = $_POST['gender'];
        $status_account = $_POST['status_account'];
        $verification_code = $_POST['verification_code'];

        $input = array();
        $input["name"] = $name;
        $input["id_card"] = $id_card;
        $input["email"] = $email;
        $input["password"] = $password;
        $input["job_title"] = $job_title;
        $input["phone_number"] = $phone;
        $input["country"] = $country;
        $input["city"] = $city;
        $input["street"] = $street;
        $input["birthday"] = $birthday;
        $input["short_bio"] = $short_bio;
        $input["gender"] = $gender;
        $input["status_account"] = $status_account;
        $input["verification_code"] = $verification_code;

        $where = array();
        $where["user_id"] = $data_id;

        $this->kmp_model->update_special("js_user", $where, $input);
        redirect(base_url("/user/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

    function delete() {
        $uri = array();
        $uri = $this->get_url();

        $idData = ($this->uri->segment(5) ? $this->uri->segment(5) : "0");

        $where = array();
        $where["user_id"] = $idData;

        $this->kmp_model->delete_special("js_user", $where);
        redirect(base_url("/user/data/" . $uri['enc_email'] . "/" . $uri['group']), 'refresh');
    }

}

?>