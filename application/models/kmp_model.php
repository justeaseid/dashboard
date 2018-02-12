<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author : Parama Fadli Kurnia
 */

class Kmp_model extends CI_Model {

//    private $db_arango;

    function __construct() {
        parent::__construct();
//        $CI = &get_instance();
//        $this->db_arango = $CI->load->database('arango', TRUE);
        $this->load->library('functional');
    }

    function getGeneralTopic() {
        $q = "";
        $q = "SELECT `topic_id`,  `topic_name`
                FROM `topics`
                WHERE `isViewEnable_flag` = 'true'
                AND `topic_id` <> '1044408263'
                AND `topic_id` <> '22553543'
                ORDER BY `topic_name` ASC";
//        $result = $this->db_arango->query($q);
        $result = $this->db->query($q);
        // output: all user information
        return $result;
    }

    function getSpecificTopic($topic_id) {
        $q = "";
        $topic = "";
        $q = "SELECT `topic_name`
                FROM `topics`
                WHERE `topic_id` = '$topic_id'";
//        $result = $this->db_arango->query($q);
        $result = $this->db->query($q);
        // output: all user information
        foreach ($result->result_array() as $row) {
            $topic = $row["topic_name"];
            break;
        }
        return $topic;
    }

}
