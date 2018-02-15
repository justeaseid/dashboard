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

    function getAllData($table) {
        $q = "";
        $q = "SELECT * FROM $table order by created_date DESC limit 0,100;";
        $result = $this->db->query($q);
        return $result;
    }

    function insert($table, $data) {
        $this->db->insert($table, $data);
    }

    function select_special($table, $field, $idData) {
        $q = "";
        $q = "SELECT * FROM $table "
                . "WHERE $field = '$idData'";
        $query = $this->db->query($q);
        $res = $query->result();
        $row = (array) $res[0];
        return $row;
    }

    public function delete_special($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function update_special($table, $where, $data) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function insert_special($table, $field, $fieldData, $data) {
        $q = "";
        $q = "SELECT * FROM $table "
                . "WHERE $field = '$fieldData'";

        $result = $this->db->query($q);
        if ($result->num_rows() == 0) {
            $this->db->insert($table, $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
