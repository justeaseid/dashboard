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
    
    function getCampaign() {
        $q = "";
        $q = "SELECT `campaign_id`, ju.name as username, `titles`, `approved_donation`, joc.name as percentage,
                jc.`city`, `verification_status`, `status`
                FROM `js_campaign` jc, `js_user` ju, `js_category` jct, `js_operational_cost` joc
                WHERE jc.`user_id` = ju.`user_id`
                AND jc.`category_id` = jct.`category_id`
                AND jc.`operational_id` = joc.`operational_id`
                order by jc.created_date DESC
                limit 0,100";
        $result = $this->db->query($q);
        return $result;
    }
    
    function getReport() {
        $q = "";
        $q = "SELECT jr.`report_id`, jr.`campaign_id`, ju.name as username, `titles`, jr.`is_valid`
                FROM `js_campaign` jc, `js_user` ju, `js_report` jr
                WHERE jr.`campaign_id` = jc.`campaign_id`
                AND jr.`user_id` = ju.`user_id`
                order by jr.created_date DESC
                limit 0,100";
        $result = $this->db->query($q);
        return $result;
    }
    
    function getDonation() {
        $q = "";
        $q = "SELECT `donation_id`, jc.titles, ju.name as username, jp.name as payment, 
                `amount_for_campaign`, jd.`status`, jd.`campaign_id`, jd.`user_id`, jd.`payment_id`
                FROM `js_donation` jd, `js_campaign` jc, `js_user` ju, `js_payment` jp
                WHERE jd.`campaign_id` = jc.`campaign_id`
                AND jd.`user_id` = ju.`user_id`
                AND jd.`payment_id` = jp.`payment_id`
                order by jd.created_date DESC
                limit 0,100;";
        $result = $this->db->query($q);
        return $result;
    }

}
