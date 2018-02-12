<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Apps extends CI_Controller {
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

    /* load user viewer */

    function user() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $result = $this->profile_model->all_profile();

        $data = $this->profile_model->profile_exist($uri);
        $data["json_result"] = $result;
        $this->load->view("content/main/user_view", $data);
    }

    /* load profile viewer */

    function profile() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->get_profile($uri);
        $this->load->view("content/main/profile_view", $data);
    }

    /* load register form viewer */

    function register() {
        $data = array();
        $data["email"] = "";
        $data["password"] = "";
        $data["name"] = "";
        $data["role"] = "";
        $data["sex"] = "";
        $data["is_male"] = "checked";
        $data["is_female"] = "";
        $data["status"] = "Sign Up";
        $this->load->view("content/main/register_view", $data);
    }

    /* load reset password form */

    function reset() {
        $data = array();
        $data["email"] = "";
        $data['status'] = "Reset Password";
        $this->load->view("content/main/reset_view", $data);
    }

    function logout() {
        //clearstatcache();
        $email = $this->uri->segment(3);
        $this->functional->delete_file($email);
        redirect(base_url(), 'refresh');
    }

    /* load login viewer */

    function login() {
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);

        $data = array();
        $data["email"] = $email;
        $data["password"] = $password;

        if (empty($email) && empty($password)) {
            $data["status"] = '<font color="red">Empty email and password!</font>';
            $this->load->view('content/main/login_view', $data);
        } else if (empty($email)) {
            $data["status"] = '<font color="red">Empty email!</font>';
            $this->load->view('content/main/login_view', $data);
        } else if (empty($password)) {
            $data["status"] = '<font color="red">Empty password!</font>';
            $this->load->view('content/main/login_view', $data);
        } else {
            $result_db = $this->profile_model->login_profile($email, $password);
            if ($result_db->num_rows() == 1) {
                $uri = array();
                foreach ($result_db->result_array() as $row) {
                    $uri["id_user"] = $row["user_id"];
                    $uri["email"] = $row["email"];
                    $uri["name"] = $row['name'];
                    $uri["access"] = $row['level_id'];
                }
                $enc_email = $this->functional->encrypt($uri["email"]);
                $id_user = $uri["id_user"];
//                $access = $uri["access"];
                $data = array();
                $data["id_user"] = $id_user;
                $data["email"] = $uri["email"];
                $data["name"] = $uri["name"];
                $data["access"] = $uri["access"];
                $data["url"] = $enc_email;
                // view this class on dashboard
//                $content = implode("||", $data);
                $content = $data["name"];
                $this->functional->save_to($email, $content, "prf");
                redirect(base_url("/user/data/$enc_email/$id_user"), 'refresh');
            } else {
                $data["status"] = '<font color="red">Email or Password incorrect</font>';
                $this->load->view('content/main/login_view', $data);
            }
        }
    }

}

?>