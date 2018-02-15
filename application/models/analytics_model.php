<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author : Parama Fadli Kurnia
 */

class Analytics_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('functional');
    }

    function getLog() {
        $q = "";
        $q = "SELECT log_id, ju.name, type, action, activity, ju.created_date "
                . "FROM js_log jl, js_user ju "
                . "WHERE jl.user_id = ju.user_id "
                . "order by created_date DESC "
                . "limit 0,100;";
        $result = $this->db->query($q);
        return $result;
    }

}
