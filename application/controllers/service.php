<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Service extends CI_Controller {
    /* put your code here */

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session', 'funtional');
        $this->load->model('profile_model');
    }

    function get_url() {
        $uri = array();
        $uri["enc_email"] = ($this->uri->segment(3) ? $this->uri->segment(3) : "NULL");
        $uri["group"] = ($this->uri->segment(4) ? $this->uri->segment(4) : "0");
        return $uri;
    }

    /* service submit after user profile edited */

    function submit_edit_profile() {
        // init value
        $name = $_POST['name'];
        //$email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $sex = $_POST['sex'];

        //echo $name, $email, $password, $role, $sex;
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data["name"] = $name;
        $data['password'] = $this->functional->encrypt($password);
        $data["role"] = $role;
        $data["sex"] = $sex;
        $this->profile_model->update_profile($this->functional->decrypt($uri["enc_email"]), $data);
        redirect(base_url("/apps/profile/".$uri['enc_email']), 'refresh');
    }

    // reset all password with condition
    //reset_password/<sessionId>/<email>/<password>
    function submit_reset_password() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];

        $data = array();
        $data["email"] = $email;
        $data["password"] = $password;
        $data["re_password"] = $re_password;
        if (empty($email) && empty($password) && empty($re_password)) {
            $data["status"] = '<font color="red">Empty all fields!</font>';
            $this->load->view('content/main/reset_view', $data);
        } else if (empty($email)) {
            $data["status"] = '<font color="red">Empty email!</font>';
            $this->load->view('content/main/reset_view', $data);
        } else if (empty($password)) {
            $data["status"] = '<font color="red">Empty password!</font>';
            $this->load->view('content/main/reset_view', $data);
        } else if (empty($re_password)) {
            $data["status"] = '<font color="red">Empty Re-type Password!</font>';
            $this->load->view('content/main/reset_view', $data);
        } else {
            if ($password != $re_password) {
                $data["status"] = '<font color="red">Password and Re-type Password not match!</font>';
                $this->load->view('content/main/reset_view', $data);
            } else {
                $new_data = array();
                $new_data['password'] = $this->functional->encrypt($password);
                $this->profile_model->update_profile($email, $new_data);
                $data["password"] = "";
                $data["status"] = '<font color="green">Reset password success!</font>';
                $this->load->view('content/main/login_view', $data);
            }
        }
    }

    /* service submit after do registration */

    // /register/<sessionId>/<name>/<email>/<password>/<sex>/<role>
    function submit_register() {
        $email = $_POST['email'];
        $s_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];
        $name = $_POST['name'];
        //$name = str_replace(" ", "_", $name);
        $role = $_POST['role'];
        //$role = str_replace(" ", "_", $role);
        $sex = $_POST['sex'];

        $data = array();
        $data['email'] = $email;
        $data['password'] = $password;
        $data['re_password'] = $re_password;
        $data['name'] = $name;
        $data['role'] = $role;
        $data['sex'] = $sex;
        $session = "12345";

        if ($data['sex'] == "male") {
            $data['is_male'] = "checked";
            $data['is_female'] = "";
        } else {
            $data['is_male'] = "";
            $data['is_female'] = "checked";
        }

        // validate all field when empty and fill the form
        if (empty($email) && empty($password) && empty($re_password) && empty($name) && empty($role) && empty($sex)) {
            $data["status"] = '<font color="red">Empty all fields!</font>';
            $this->load->view('content/main/register_view', $data);
        } else if (empty($email)) {
            $data["status"] = '<font color="red">Empty email!</font>';
            $this->load->view('content/main/register_view', $data);
        } else if (empty($password)) {
            $data["status"] = '<font color="red">Empty password!</font>';
            $this->load->view('content/main/register_view', $data);
        } else if (empty($re_password)) {
            $data["status"] = '<font color="red">Empty Re-type Password!</font>';
            $this->load->view('content/main/register_view', $data);
        } else if (empty($name)) {
            $data["status"] = '<font color="red">Empty name!</font>';
            $this->load->view('content/main/register_view', $data);
        } else if (empty($role)) {
            $data["status"] = '<font color="red">Empty role!</font>';
            $this->load->view('content/main/register_view', $data);
        } else {
            if ($password != $re_password) {
                $data["status"] = '<font color="red">Password and Re-type Password not match!</font>';
                $this->load->view('content/main/register_view', $data);
            } else if (!filter_var($s_email, FILTER_VALIDATE_EMAIL)) {
                $data["status"] = '<font color="red">The email you have entered is invalid, please try again.</font>';
                $this->load->view('content/main/register_view', $data);
            } else {
                $new_data = array();
                $new_data['password'] = $password;
                $new_data['name'] = $name;
                $new_data['email'] = $email;
                $new_data['sex'] = $sex;
                $new_data['role'] = $role;
                $new_data["password"] = $this->functional->encrypt($password);
                $new_data["date_created"] = date("Y-m-d H:i:s");
                $new_data["access"] = "guest";
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
    }

}

?>