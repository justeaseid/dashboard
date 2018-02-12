<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author : Parama Fadli Kurnia
 */

class Ftopic_model extends CI_Model {

    private $db_facebook;

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db_facebook = $CI->load->database('facebook', TRUE);
        $this->load->library('functional');
    }

    function myPage(){
        $page = " `pg_id` IN (SELECT `pg_id` FROM `fb_crawl` WHERE `tk_id` = '5') ";
        return $page;
    }

    function all($table) {
        $q = "";
        $q = "SELECT * FROM $table";
        if ($table == "fb_post") {
            $q .= " WHERE DATE(`ps_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )";
//            $q .= " WHERE DATE(`ps_created_time`) >= curdate() - INTERVAL DAYOFWEEK(curdate())+3 DAY "
//                    . "AND DATE(`ps_created_time`) <= curdate()";
        } else if ($table == "fb_comment") {
            $q .= " WHERE DATE(`cm_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )";
//            $q .= " WHERE DATE(`cm_created_time`) >= curdate() - INTERVAL DAYOFWEEK(curdate())+3 DAY "
//                    . "AND DATE(`cm_created_time`) <= curdate()";
        } else if ($table == "fb_scomment") {
            $q .= " WHERE DATE(`scm_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )";
//            $q .= " WHERE DATE(`scm_created_time`) >= curdate() - INTERVAL DAYOFWEEK(curdate())+3 DAY "
//                    . "AND DATE(`scm_created_time`) <= curdate()";
        }
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_page($page_id) {
        $pg_id = "";
        $pg_name = "";
        $pg_category = "";
        $pg_description = "";
        $pg_link = "";
        $pg_location = "";
        $pg_website = "";
        $pg_image = "";
        $pg_talking_about_count = 0;
        $pg_likes = 0;
        $pg_checkins = 0;
        $q = "";
        $q = "SELECT * from fb_page WHERE pg_id = '$page_id'";
        $result = $this->db_facebook->query($q);
        if ($result->num_rows() != 0) {
            foreach ($result->result_array() as $row) {
                $pg_id = $row["pg_id"];
                $pg_name = $row["pg_name"];
                $pg_category = $row["pg_category"];
                $pg_description = substr($row["pg_description"], 0, 350);
                $pg_link = $row["pg_link"];
                $pg_location = $row["pg_location"];
                $pg_website = $row["pg_website"];
                $pg_image = $row["pg_image"];
                $pg_talking_about_count = number_format($row['pg_talking_about_count'], 0, '.', ',');
                $pg_likes = number_format($row['pg_likes'], 0, '.', ',');
                $pg_checkins = number_format($row['pg_checkins'], 0, '.', ',');
                break;
            }
        }

        if ($pg_description == "NULL")
            $pg_description = "No Description";
        else
            $pg_description = $pg_description . "...";

        if ($pg_location == ",")
            $pg_location = "No Description";
        else
            $pg_location = $pg_location;

        $data = array();
        $data["pg_id"] = $pg_id;
        $data["pg_name"] = $pg_name;
        $data["pg_category"] = $pg_category;
        $data["pg_description"] = $pg_description;
        $data["pg_link"] = $pg_link;
        $data["pg_location"] = $pg_location;
        $data["pg_website"] = $pg_website;
        $data["pg_image"] = $pg_image;
        $data["pg_talking_about_count"] = $pg_talking_about_count;
        $data["pg_likes"] = $pg_likes;
        $data["pg_checkins"] = $pg_checkins;

        return $data;
    }

    function get_page_monitoring($id_user) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `fb_page` where $page";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }
    
    function get_special_page($pg_id) {
        $q = "";
        $pg_name = "All";
        if ($pg_id != "all") {
            $q = "SELECT * FROM `fb_page` where pg_id = '$pg_id'";
            $result = $this->db_facebook->query($q);
            foreach ($result->result_array() as $row) {
                $pg_name = $row['pg_name'];
                break;
            }
        }
        return $pg_name;
    }
    
    function get_page_trends($type, $pg_id) {
        $q = "";
        $qid = "";

        if ($pg_id != "all") {
            $qid = " AND tdw.pg_id = '$pg_id' ";
        }
        
        $date = $this->functional->generate_date_query("created_date", $type, "AND");
        $q = "SELECT ft.topic_name, SUM(`ps_count`) as post, SUM(`cm_count`) as comment, 
                SUM(`ps_likes`) as likes, SUM(`ps_shares`) as shares
                FROM fb_page_topic_dw tdw, fb_topics ft   
                WHERE tdw.topic_id = ft.topic_id
                $qid
                $date
                GROUP BY tdw.topic_id
                ORDER BY likes DESC";
        $result = $this->db_facebook->query($q);
//        echo "$q </br>";
        // output: all user information
        return $result;
    }

    function get_mypage($id_user) {
        $q = "";
        $q = "SELECT p.`pg_id`, p.`pg_name`, p.`pg_description`, p.`pg_link`, p.`pg_talking_about_count`, p.`pg_likes`, p.`pg_checkins`, p.status
            FROM(
            SELECT `pg_id`, `pg_name`, `pg_description`, `pg_link`, `pg_talking_about_count`, `pg_likes`, `pg_checkins`, 'yes' as `status`
            FROM `fb_page` where `pg_id` 
            IN ( 
                SELECT `pg_id` FROM `fb_permission` WHERE `id_user`= '$id_user'
            )
            UNION
            SELECT `pg_id`, `pg_name`, `pg_description`, `pg_link`, `pg_talking_about_count`, `pg_likes`, `pg_checkins` , 'no' as `status`
            FROM `fb_page` where `pg_id` 
            NOT IN 
            ( 
                SELECT `pg_id` FROM `fb_permission` WHERE `id_user`= '$id_user'
            )
                )AS p
                ORDER BY p.`pg_id` ASC";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_streaming($page_id) {
        $q = "";
        $q = "SELECT * FROM `fb_post` WHERE `pg_id` = '$page_id' ORDER BY `ps_created_time` DESC LIMIT 0, 10";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_dw_year() {
        $q = "";
        $q = "SELECT `d_year` FROM `fb_page_topic_dw`
                GROUP BY `d_year`
                ORDER BY d_year DESC";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_timeline($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT `ps_id` as id,`ps_from` as name,`ps_message` as message,
            `ps_created_time` as date,`ps_shares` as shares, `ps_likes` as likes,
            `ps_image` as image,`ps_type` as type
                FROM `fb_post`fp, fb_post_topic fpt
                WHERE fpt.pg_id = fp.pg_id
                AND fpt.sm_id = fp.ps_id
                AND fpt.`pg_id` = '$page_id'
                AND fpt.topic_id = '$topic_id'";
        if ($type != "all")
            $q .= " AND fp.ps_type = '$type'";
        $q .= $this->functional->generate_date_query("fpt.created_time", "yesterday", "AND");
        $q .=" ORDER BY fpt.created_time DESC
                LIMIT 0,50";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_most_active_user($page_id, $type, $topic_id) {
        $q = "";
        $queryDate = $this->functional->generate_date_query("created_time", $type, "AND");
        $q = "SELECT `cm_id`, `cm_from`,`cm_from_id`,`cm_image`, COUNT(`cm_id`) as jumlah 
                FROM 
                (
                SELECT *, SUBSTRING_INDEX(SUBSTRING_INDEX(`sm_id`, '_', 2), '_', -1) AS post_id
                FROM `fb_post_topic`
                WHERE `pg_id` = '$page_id'
                AND `topic_id` = '$topic_id'
                $queryDate
                ) AS p, 
                (
                SELECT `cm_id`, `cm_from`,`cm_from_id`,`cm_image`, SUBSTRING_INDEX(`cm_id`, '_', 1) as post_id 
                FROM `fb_comment`
                WHERE `pg_id` = '$page_id'
                )AS q
                WHERE p.post_id = q.post_id
                GROUP BY `cm_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";

        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_count_likes($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`cm_comment_count`) as sum_comment, SUM(`cm_likes`) as sum_likes
                FROM `fb_page_topic_dw`
                WHERE `pg_id` = '$page_id' 
                AND `topic_id` = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_shares_likes($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`ps_shares`) as sum_shares, SUM(`ps_likes`) as sum_likes
                FROM `fb_page_topic_dw`
                WHERE `pg_id` = '$page_id' 
                AND `topic_id` = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_pos_com($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`ps_count`) as sum_post, SUM(`cm_count`) as sum_comment
                FROM `fb_page_topic_dw`
                WHERE `pg_id` = '$page_id' 
                AND `topic_id` = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_composition($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`ps_link`) as sum_link, SUM(`ps_status`) as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, 
                SUM(`ps_offer`) as sum_offer
                FROM `fb_page_topic_dw`
                WHERE `pg_id` = '$page_id' 
                AND `topic_id` = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_composition_dashboard($page_id, $year, $topic_id) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`ps_link`) as sum_link, SUM(`ps_status`) as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, SUM(`ps_offer`) as sum_offer 
                FROM `fb_page_topic_dw`
                WHERE `pg_id` = '$page_id'
                AND `d_year` = $year
                AND `topic_id` = '$topic_id'
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_fans($page_id, $year, $topic_id) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`ps_count`) as sum_likes 
                FROM `fb_page_topic_dw` 
                WHERE `pg_id` = '$page_id' 
                AND `d_year` = $year
                AND `topic_id` = '$topic_id'
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_item($item_id, $mode) {
        $q = "";
        $table = "";
        $field = "";
        if ($mode == 1) {
            $table = "fb_post";
            $field = "`ps_id`";
        } else if ($mode == 2) {
            $table = "fb_comment";
            $field = "`cm_id`";
        }

        $q = "SELECT * FROM $table WHERE $field = '$item_id';";

//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_most_active_user($type) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT `cm_id`, `cm_from`,`cm_from_id`,`cm_image`, COUNT(`cm_id`) as jumlah
                FROM `fb_comment`
                WHERE $page";

        $q .= $this->functional->generate_date_query("cm_created_time", $type, "AND");
        $q .= " AND ". $this->myPage();
        $q .=" GROUP BY `cm_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_count_likes($type) {
        $q = "";
        $q = "SELECT SUM(`cm_comment_count`) as sum_comment, SUM(`cm_likes`) as sum_likes
                FROM `fb_page_topic_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_shares_likes($type) {
        $q = "";
        $q = "SELECT SUM(`ps_shares`) as sum_shares, SUM(`ps_likes`) as sum_likes
                FROM `fb_page_topic_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $q .= " AND ". $this->myPage();
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_pos_com($type) {
        $q = "";
        $q = "SELECT SUM(`ps_count`) as sum_post, SUM(`cm_count`) as sum_comment
                FROM `fb_page_topic_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $q .= " AND ". $this->myPage();
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_composition($type) {
        $q = "";
        $q = "SELECT SUM(`ps_link`) as sum_link, SUM(`ps_status`) as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, 
                SUM(`ps_offer`) as sum_offer
                FROM `fb_page_topic_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_streaming() {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `fb_post`
                WHERE $page
                ORDER BY `ps_created_time` DESC
                LIMIT 0, 30";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_top() {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `fb_page` "
                . "WHERE $page "
                . "ORDER BY `pg_likes` DESC LIMIT 0, 5";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_popular($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT `ps_id` as id,`ps_from` as name,`ps_message` as message,
            `ps_created_time` as date,`ps_shares` as shares, `ps_likes` as likes,
            `ps_image` as image,`ps_type` as type
                FROM `fb_post` fp, fb_post_topic fpt
                WHERE fpt.pg_id = fp.pg_id
                AND fpt.sm_id = fp.ps_id
                AND fpt.`pg_id` = '$page_id'
                AND fpt.topic_id = '$topic_id'
                ";
        if ($type != "all")
            $q .= " AND `ps_type` ='$type'";
        $q .= $this->functional->generate_date_query("ps_created_time", "month", "AND");
        $q .=" ORDER BY `ps_shares` DESC
                LIMIT 0,50";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

}
