<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author: Parama Fadli Kurnia
 * Ezytravel
 * 
 */

class Profile_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('functional');
    }

    function insert_profile($data) {
        $email = $data["email"];
        $q = "";
        $q = "SELECT * FROM user "
                . "WHERE email = '$email'";

        $result = $this->db->query($q);
        if ($result->num_rows() == 0) {
            $this->db->insert('user', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function login_profile($email, $password) {
        $q = "";
        $password = $this->functional->encrypt($password);
        $q = "SELECT * FROM user "
                . "WHERE email = '$email' "
                . "AND password = '$password'";
        //echo $q;
        // output: all user information
        $result = $this->db->query($q);
        return $result;
    }

    function update_profile($email, $data) {
        $this->db->where('email', $email);
        $this->db->update('user', $data);
        // update data by email
    }

    function all_profile() {
        $q = "";
        $q = "SELECT * FROM user ";
        $result = $this->db->query($q);
        // output: all user information
        return $result;
    }

    function profile_exist($uri_input) {
        $enc_email = $uri_input["enc_email"];
        $group = $uri_input["group"];
        $email = $this->functional->decrypt($enc_email);
        $prf = DATA . $email . ".prf";
        $login_status = FALSE;
        $user_status = FALSE;
        
        // check email is NULL
        if($enc_email=="NULL")
            redirect(base_url('/apps'), 'refresh');

        // check file profile exist
        if (file_exists($prf))
            $login_status = TRUE;
        else
            $login_status = FALSE;

        // check user is exist on database
        $q = "SELECT * FROM user "
                . "WHERE email = '$email'";
        $result = $this->db->query($q);
        $uri= array();
        if ($result->num_rows() == 1){
            $user_status = TRUE;
            foreach ($result->result_array() as $row) {
                $uri["id_user"] = $row['id_user'];
                $uri["name"] = $row['name'];
                $uri["access"] = $row['access'];
            }
        }else{
            $user_status = FALSE;
        }
        
        // validate the user and file availability
        if (($login_status) && ($user_status)){
            $data = array();
            $data["id_user"] = $uri["id_user"];
            $data["name"] = $uri["name"];
            $data["access"] = $uri["access"];
            $data["email"] = $email;
            $data["group"] = $group;
//            $data["status"] = "";
//            $data["mode"] = "all";
            $data["url"] = $enc_email;
            return $data;
        }else{
            redirect(base_url('/apps'), 'refresh');
        }
    }

    function get_profile($uri_input) {
        $enc_email = $uri_input["enc_email"];
        $email = $this->functional->decrypt($enc_email);
        $q = "";
        $q = "SELECT * FROM user "
                . "WHERE email = '$email'";
        //echo $q;
        // output: all user information
        $result = $this->db->query($q);

        if ($result->num_rows() == 1) {
            $data = array();
            foreach ($result->result_array() as $row) {
                $data["email"] = $row["email"];
                $data["id_user"] = $row["id_user"];
                $data["password"] = $this->functional->decrypt($row["password"]);
                $data["name"] = $row['name'];
                $data["role"] = $row["role"];
                $data["access"] = $row['access'];
                $data["sex"] = $row["sex"];
                $date_created = $row["date_created"];
                $new_date = explode(' ', $date_created);
                $data["date_created"] = $new_date[0];
                $data["check"] = "1";
            }
            $gender = array();
            $gender = $this->functional->validate_gender($data["sex"]);
            $data["profile_image"] = $gender["profile_image"];
            $data["is_male"] = $gender["is_male"];
            $data["is_female"] = $gender["is_female"];
            $data["status"] = "";
            $data["group"] = "1";
            $data["url"] = $enc_email;
            return $data;
        } else {
            redirect(base_url('/apps'), 'refresh');
        }
    }

}
