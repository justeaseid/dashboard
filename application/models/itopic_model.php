<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author : Parama Fadli Kurnia
 */

class Itopic_model extends CI_Model {

    private $db_instagram;

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db_instagram = $CI->load->database('instagram', TRUE);
        $this->load->library('functional');
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
        $q = "SELECT * from ins_page WHERE pg_id = '$page_id'";
        $result = $this->db_instagram->query($q);
        if ($result->num_rows() != 0) {
            foreach ($result->result_array() as $row) {
                $pg_id = $row["pg_id"];
                $pg_name = $row["pg_username"];
                $pg_category = $row["pg_name"];
                $pg_description = substr($row["pg_description"], 0, 350);
                $pg_link = INSTAGRAM . $row["pg_username"];
                $pg_location = "No Description";
                $pg_website = $row["pg_link"];
                $pg_image = $row["pg_image"];
                $pg_talking_about_count = number_format($row['pg_friends'], 0, '.', ',');
                $pg_likes = number_format($row['pg_followers'], 0, '.', ',');
                $pg_checkins = number_format($row['pg_post'], 0, '.', ',');
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

    function myPage() {
        $page = " `pg_id` IN (SELECT `pg_id` FROM `ins_crawl` WHERE `tk_id` = '6') ";
        return $page;
    }

    function get_page_monitoring($id_user) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `ins_page` where $page";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_special_page($pg_id) {
        $q = "";
        $pg_name = "All";
        if ($pg_id != "all") {
            $q = "SELECT * FROM `ins_page` where pg_id = '$pg_id'";
            $result = $this->db_instagram->query($q);
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
                SUM(`ps_likes`) as likes
                FROM ins_page_topic_dw tdw, ins_topics ft   
                WHERE tdw.topic_id = ft.topic_id
                $qid
                $date
                GROUP BY tdw.topic_id
                ORDER BY likes DESC";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_streaming($page_id) {
        $q = "";
        $q = "SELECT * FROM `ins_post` WHERE `pg_id` = '$page_id' ORDER BY `ps_created_time` DESC LIMIT 0, 10";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_dw_year() {
        $q = "";
        $q = "SELECT `d_year` FROM `ins_page_topic_dw`
                GROUP BY `d_year`
                ORDER BY d_year DESC";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_timeline($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT `ps_id` as id,`ps_from` as name,`ps_message` as message,
            `ps_created_time` as date,`ps_comments` as shares, `ps_likes` as likes,
            `ps_image` as image,`ps_type` as type
                FROM `ins_post` ip, ins_post_topic itp
                WHERE itp.pg_id = ip.pg_id
                AND itp.sm_id = ip.ps_id
                AND itp.`pg_id` = '$page_id'
                AND itp.topic_id = '$topic_id'";
        if ($type != "all")
            $q .= " AND ip.ps_type ='$type'";
        $q .=" ORDER BY itp.created_time DESC
                LIMIT 0,50";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_most_active_user($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT ps_id, `cm_id`, `cm_from`,`cm_from_id`,`cm_image`, COUNT(`cm_id`) as jumlah
                FROM `ins_comment` ip, ins_post_topic itp
                WHERE itp.pg_id = ip.pg_id
                AND itp.sm_id = ip.ps_id
                AND itp.`pg_id` ='$page_id'
                AND itp.topic_id = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_time", $type, "AND");
        $q .=" GROUP BY `cm_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_count_likes($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`cm_comment_count`) as sum_comment, SUM(`cm_likes`) as sum_likes
                FROM `ins_page_topic_dw`
                WHERE `pg_id` = '$page_id' 
                AND `topic_id` = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_shares_likes($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`ps_comments`) as sum_comments, SUM(`ps_likes`) as sum_likes
                FROM `ins_page_topic_dw`
                WHERE `pg_id` = '$page_id' 
                AND `topic_id` = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_pos_com($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`ps_count`) as sum_post, SUM(`cm_count`) as sum_comment
                FROM `ins_page_topic_dw`
                WHERE `pg_id` = '$page_id' 
                AND `topic_id` = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_composition($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT '0' as sum_link, '0' as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, 
                '0' as sum_offer
                FROM `ins_page_topic_dw`
                WHERE `pg_id` = '$page_id' 
                AND `topic_id` = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_composition_dashboard($page_id, $year, $topic_id) {
        $q = "";
        $q = "SELECT `d_month`, '0' as sum_link, '0' as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, '0' as sum_offer 
                FROM `ins_page_topic_dw`
                WHERE `pg_id` = '$page_id'
                AND `d_year` = $year
                AND `topic_id` = '$topic_id'
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_fans($page_id, $year, $topic_id) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`ps_count`) as sum_likes
                FROM `ins_page_topic_dw`
                WHERE `pg_id` = '$page_id'
                AND `d_year` = $year
                AND `topic_id` = '$topic_id'
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_comments($post_id) {
//        $item = explode("_", $post_id);
//        $cm_id = $item[1];
        //SELECT * FROM `ins_comment` WHERE `cm_id` LIKE '10153170375806699_%';
        $q = "";
        $q = "SELECT * FROM `ins_comment` WHERE `ps_id` LIKE '$post_id';";
//        echo $q;
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_sub_comment($comment_id) {
        $q = "";
        $q = "SELECT * FROM `ins_scomment` WHERE `cm_id` = '$comment_id';";
//        echo $q;
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function home_most_active_user($type) {
        $q = "";
        $page = $this->myPage();
        $page = $this->myPage();
        $q = "SELECT ps_id, `cm_id`, `cm_from`,`cm_from_id`,`cm_image`, COUNT(`cm_id`) as jumlah
                FROM `ins_comment`
                WHERE $page";

        $q .= $this->functional->generate_date_query("cm_created_time", $type, "AND");
        $q .=" GROUP BY `cm_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function home_count_likes($type) {
        $q = "";
        $q = "SELECT SUM(`cm_comment_count`) as sum_comment, SUM(`cm_likes`) as sum_likes
                FROM `ins_page_topic_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function home_shares_likes($type) {
        $q = "";
        $q = "SELECT SUM(`ps_comments`) as sum_comments, SUM(`ps_likes`) as sum_likes
                FROM `ins_page_topic_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function home_pos_com($type) {
        $q = "";
        $q = "SELECT SUM(`ps_count`) as sum_post, SUM(`cm_count`) as sum_comment
                FROM `ins_page_topic_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function home_composition($type) {
        $q = "";
        $q = "SELECT '0' as sum_link, '0' as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, 
                '0' as sum_offer
                FROM `ins_page_topic_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function home_streaming() {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `ins_post`"
                . " WHERE $page"
                . " ORDER BY `ps_created_time` DESC"
                . " LIMIT 0, 30";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function home_top() {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `ins_page` "
                . "WHERE $page "
                . "ORDER BY `pg_followers` DESC LIMIT 0, 5";
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_popular($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT `ps_id` as id,`ps_from` as name,`ps_message` as message,
            `ps_created_time` as date,`ps_comments` as shares, `ps_likes` as likes,
            `ps_image` as image,`ps_type` as type
                FROM `ins_post` ip, ins_post_topic itp
                WHERE itp.pg_id = ip.pg_id
                AND itp.sm_id = ip.ps_id
                AND itp.`pg_id` = '$page_id'
                AND itp.topic_id = '$topic_id'
                ";
        if ($type != "all")
            $q .= " AND ip.`ps_type` ='$type'";
//        $q .= $this->functional->generate_date_query("ps_created_time", "month", "AND");
        $q .=" ORDER BY ip.`ps_likes` DESC
                LIMIT 0,50";
//        echo $q;
        $result = $this->db_instagram->query($q);
        // output: all user information
        return $result;
    }

    function get_hashtags($type, $mode, $acc_id = "NULL") {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT `ps_hashtag` FROM `ins_post`
                WHERE $page";

        $q .= $this->functional->generate_date_query("ps_created_time", $type, "AND");
        $q .=" AND (`ps_hashtag` <> 'NULL' OR `ps_hashtag` <> '')";
        if ($mode == "1")
            $q .=" AND `pg_id` = '$acc_id'";
        $result = $this->db_instagram->query($q);
        // output: all user information
        $string = "";
        if ($result->num_rows() != 0) {
            $idx = 0;
            foreach ($result->result_array() as $row) {
                $string .= $row['ps_hashtag'] . " ";
            }
        }
        return $string;
    }

    function get_hashtags_statistic($type, $mode, $acc_id = "NULL", $topic_id) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT `ps_hashtag` FROM `ins_post` ip, ins_post_topic itp
                WHERE itp.pg_id = ip.pg_id
                AND itp.sm_id = ip.ps_id";

        $q .= $this->functional->generate_date_query("ps_created_time", $type, "AND");
        $q .=" AND (`ps_hashtag` <> 'NULL' AND `ps_hashtag` <> '')";
        if ($mode == "1")
            $q .=" AND itp.`pg_id` = '$acc_id' "
                    . " AND itp.topic_id = '$topic_id';";
        $result = $this->db_instagram->query($q);
        // output: all user information
        $string = "";
        if ($result->num_rows() != 0) {
            $idx = 0;
            foreach ($result->result_array() as $row) {
                $string .= $row['ps_hashtag'] . " ";
            }
        }
        return $string;
    }

}
