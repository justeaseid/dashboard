<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author : Parama Fadli Kurnia
 */

/*
 * WEEK: 
 * WHERE date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-3 DAY
 * 
 * TODAY:
 * WHERE date = DATE(NOW())
 * 
 * YESTERDAY - NOW:
 * WHERE DATE(time) = DATE(DATE_SUB(NOW(), INTERVAL 3 DAY));
 * 
 * Month:
 * t.date >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 3 DAY) and
 * r.date <= DATE_SUB(NOW(), INTERVAL 1 MONTH)
 * 
 * YEAR:
 * order_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR);
 */

class Fb_model extends CI_Model {

    private $db_facebook;

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db_facebook = $CI->load->database('facebook', TRUE);
        $this->load->library('functional');
    }

    function insert($table, $data) {
        $this->db_facebook->insert($table, $data);
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

    function crawler() {
        $q = "";
        $q = "SELECT fc.`cw_id`, ft.`tk_name`, fp.`pg_id`, fp.`pg_name`, fc.`last_update`
                FROM `fb_crawl` fc, `fb_page` fp, `fb_token` ft
                WHERE fc.`tk_id` = ft.`tk_id`
                AND fc.`pg_id`= fp.`pg_id`";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_token() {
        $q = "";
        $q = "SELECT * FROM `fb_token` WHERE `tk_name` <> 'kumparan00' AND `tk_name` <> 'kumparan07'";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function crawler_is_exist($data) {
        $pg_id = $data["pg_id"];
        $q = "";
        $q = "SELECT * FROM `fb_crawl`
                WHERE `pg_id` = $pg_id";
        $result = $this->db_facebook->query($q);
        if ($result->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
        // output: all user information
    }

    function delete($table, $data) {
        $this->db_facebook->delete($table, $data);
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
        $q = "SELECT * FROM `fb_page` where `pg_id` IN ( SELECT `pg_id` FROM `fb_permission` WHERE `id_user`= '$id_user' )";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

//    function get_page_monitoring_single() {
//        $q = "";
//        $q = "SELECT * FROM `fb_page` where `pg_id` IN ( SELECT `pg_id` FROM `fb_permission` WHERE `id_user`= '$id_user' )";
//        $result = $this->db_facebook->query($q);
//        // output: all user information
//        return $result;
//    }

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
        $q = "SELECT `d_year` FROM `fb_page_dw`
                GROUP BY `d_year`
                ORDER BY d_year DESC";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_timeline($page_id, $type) {
        $q = "";
        $q = "SELECT p.id, p.name, p.message, p.date, p.image, p.type, p.likes, p.shares
                FROM (
                    SELECT `ps_id` as id, `ps_from` as name, `ps_message` as message,`ps_created_time` as date,`ps_image` as image,`pg_id` as page_id, `ps_type` as type, `ps_likes` as likes, `ps_shares` as shares 
                    FROM `fb_post`
                    WHERE `pg_id` = '$page_id'
                    AND DATE(`ps_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 2 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                      UNION 
                    SELECT `cm_id` as id, `cm_from` as name, `cm_message` as message,`cm_created_time` as date,`cm_image` as image,`pg_id` as page_id,  'comment', `cm_likes` as likes, '0' 
                    FROM `fb_comment`
                    WHERE `pg_id` = '$page_id'
                    AND DATE(`cm_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 2 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                     ) AS p";
        if ($type != "all")
            $q .= " WHERE p.type ='$type'";
        $q .=" ORDER BY p.date DESC
                LIMIT 0,20";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_event($page_id, $type) {
        $q = "";
        $q = "SELECT `ps_id`,`ps_from`,`ps_message`,`ps_created_time`,`ps_shares`, `ps_likes`,`ps_image`,`ps_type`
                FROM `fb_post`
                WHERE `pg_id` = '$page_id'
                AND DATE(`ps_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 30 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                AND 
                (`ps_message` LIKE '%promo%' OR `ps_message` LIKE '%voucher%' OR
                 `ps_message` LIKE '%promosi%' OR `ps_message` LIKE '%kupon%' OR
                 `ps_message` LIKE '%paket%' OR `ps_message` LIKE '%murah%' OR
                 `ps_message` LIKE '%discount%' OR `ps_message` LIKE '%spesial%' OR
                 `ps_message` LIKE '%booking%' OR `ps_message` LIKE '%rekomendasi%' OR
                 `ps_message` LIKE '%menarik%' OR `ps_message` LIKE '%diskon%')
                ";
        if ($type != "all")
            $q .= " AND `ps_type` ='$type'";
        $q .=" ORDER BY `ps_created_time` DESC
                LIMIT 0,50";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_most_active_user($page_id, $type) {
        $q = "";
        $q = "SELECT `cm_id`, `cm_from`,`cm_from_id`,`cm_image`, COUNT(`cm_id`) as jumlah
                FROM `fb_comment`
                WHERE `pg_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("cm_created_time", $type, "AND");
        $q .=" GROUP BY `cm_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_count_likes($page_id, $type) {
        $q = "";
        $q = "SELECT SUM(`cm_comment_count`) as sum_comment, SUM(`cm_likes`) as sum_likes
                FROM `fb_page_dw`
                WHERE `pg_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_shares_likes($page_id, $type) {
        $q = "";
        $q = "SELECT SUM(`ps_shares`) as sum_shares, SUM(`ps_likes`) as sum_likes
                FROM `fb_page_dw`
                WHERE `pg_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_pos_com($page_id, $type) {
        $q = "";
        $q = "SELECT SUM(`ps_count`) as sum_post, SUM(`cm_count`) as sum_comment
                FROM `fb_page_dw`
                WHERE `pg_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_composition($page_id, $type) {
        $q = "";
        $q = "SELECT SUM(`ps_link`) as sum_link, SUM(`ps_status`) as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, 
                SUM(`ps_offer`) as sum_offer
                FROM `fb_page_dw`
                WHERE `pg_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_composition_dashboard($page_id, $year) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`ps_link`) as sum_link, SUM(`ps_status`) as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, SUM(`ps_offer`) as sum_offer 
                FROM `fb_page_dw`
                WHERE `pg_id` = '$page_id'
                AND `d_year` = $year
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_fans($page_id, $year) {
        $q = "";
        $q = "SELECT `d_month`, MAX(`pg_fans_growth`) as sum_likes
                FROM `fb_page_dw`
                WHERE `pg_id` = '$page_id'
                AND `d_year` = $year
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_sentiment($page_id, $year) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`cm_pos`) as sum_cpos, SUM(`cm_neg`) as sum_cneg, SUM(`cm_neu`) as sum_cneu,
                SUM(`ps_pos`) as sum_ppos, SUM(`ps_neg`) as sum_pneg, SUM(`ps_neu`) as sum_pneu
                FROM `fb_page_dw`
                WHERE `pg_id` = '$page_id'
                AND `d_year` = $year
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_timesent($page_id, $mode) {
        //AND DATE(`cm_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
        $q = "";
        $q = "SELECT fc.`cm_id`,fc.`cm_from`,fc.`cm_message`,fc.`cm_created_time`,
                fc.`cm_comment_count`,fc.`cm_likes`, fc.`cm_image`,fca.`cm_sentiment`
                FROM `fb_comment` fc, `fb_comment_analyze` fca
                WHERE fc.`cm_id`= fca.`cm_id`
                AND fc.`pg_id` = '$page_id'
                AND fca.`cm_sentiment` = '$mode'
                AND DATE(`cm_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                ORDER BY `cm_created_time` DESC
                LIMIT 0,50";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        if ($result->num_rows() > 2) {
            return $result;
        } else {
            $q1 = "";
            $q1 = "SELECT fc.`cm_id`,fc.`cm_from`,fc.`cm_message`,fc.`cm_created_time`,
                fc.`cm_comment_count`,fc.`cm_likes`, fc.`cm_image`,fca.`cm_sentiment`
                FROM `fb_comment` fc, `fb_comment_analyze` fca
                WHERE fc.`cm_id`= fca.`cm_id`
                AND fc.`pg_id` = '$page_id'
                AND fca.`cm_sentiment` = '$mode'
                AND DATE(`cm_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 10 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                ORDER BY `cm_created_time` DESC
                LIMIT 0,50";
//        echo $q;
            $result1 = $this->db_facebook->query($q1);
            return $result1;
        }
    }

    function get_cloud($page_id) {
        $q = "";
        $q = "SELECT `cm_text`
            FROM `fb_comment_analyze` fca, `fb_comment` fc
            where fca.`cm_id` = fc.`cm_id`
            AND fca.`pg_id` = '$page_id'
            AND DATE(fc.`cm_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 3 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )";
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

    function get_comments($post_id) {
        $item = explode("_", $post_id);
        $cm_id = $item[1];
        //SELECT * FROM `fb_comment` WHERE `cm_id` LIKE '10153170375806699_%';
        $q = "";
        $q = "SELECT * FROM `fb_comment` WHERE `cm_id` LIKE '$cm_id%';";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_sub_comment($comment_id) {
        $q = "";
        $q = "SELECT * FROM `fb_scomment` WHERE `cm_id` = '$comment_id';";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_most_active_user($type) {
        $q = "";
        $q = "SELECT `cm_id`, `cm_from`,`cm_from_id`,`cm_image`, COUNT(`cm_id`) as jumlah
                FROM `fb_comment`
                WHERE";

        $q .= $this->functional->generate_date_query("cm_created_time", $type);
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
                FROM `fb_page_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_shares_likes($type) {
        $q = "";
        $q = "SELECT SUM(`ps_shares`) as sum_shares, SUM(`ps_likes`) as sum_likes
                FROM `fb_page_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_pos_com($type) {
        $q = "";
        $q = "SELECT SUM(`ps_count`) as sum_post, SUM(`cm_count`) as sum_comment
                FROM `fb_page_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_composition($type) {
        $q = "";
        $q = "SELECT SUM(`ps_link`) as sum_link, SUM(`ps_status`) as sum_status, 
                SUM(`ps_photo`) as sum_photo, SUM(`ps_video`) as sum_video, 
                SUM(`ps_offer`) as sum_offer
                FROM `fb_page_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_streaming() {
        $q = "";
        $q = "SELECT * FROM `fb_post`"
                . " WHERE DATE(`ps_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )"
                . " ORDER BY `ps_created_time` DESC"
                . " LIMIT 0, 30";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function home_top() {
        $q = "";
        $q = "SELECT * FROM `fb_page` ORDER BY `pg_likes` DESC LIMIT 0, 5";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function get_ssummary($page_id, $type) {
        $q = "";
        $q = "SELECT SUM(`ps_pos`) as sum_pos, SUM(`ps_neg`) as sum_neg, SUM(`ps_neu`) as sum_neu
                FROM `fb_page_dw`
                WHERE `pg_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function update_sentiment($cm_id, $data) {
        $this->db_facebook->where('cm_id', $cm_id);
        $this->db_facebook->update('fb_comment_analyze', $data);
        // update data by email
    }

    function get_popular($page_id, $type) {
        $q = "";
        $q = "SELECT `ps_id` as id,`ps_from` as name,`ps_message` as message,
            `ps_created_time` as date,`ps_shares` as shares, `ps_likes` as likes,
            `ps_image` as image,`ps_type` as type
                FROM `fb_post`
                WHERE `pg_id` = '$page_id'
                ";
        if ($type != "all")
            $q .= " AND `ps_type` ='$type'";
        $q .=" ORDER BY `ps_shares` DESC
                LIMIT 0,50";
//        echo $q;
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

    function is_added_to_workspace($data) {
        $id_user = $data["id_user"];
        $pg_id = $data["pg_id"];
        $q = "";
        $q = "SELECT * FROM fb_permission "
                . "WHERE pg_id = '$pg_id' AND id_user= '$id_user'";
        $result = $this->db_facebook->query($q);
//        echo $q;
        if ($result->num_rows() == 0) {
            $this->db_facebook->insert('fb_permission', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // get latest update from social media
    function global_streaming() {
        $q = "";
        $q = "SELECT p.id, p.user_id, p.name, p.date, p.message, p.type, p.image, p.source 
            FROM
            (
            (SELECT `ps_id` as id, `ps_from_id` as user_id, `ps_from`as name, 
            `ps_created_time` as date, `ps_message` as message, `ps_type` as type, `ps_image`as image,
            'facebook' as source
            FROM facebook.`fb_post`
            WHERE DATE(`ps_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
            LIMIT 0,10)
            ) AS p
            ORDER BY p.date DESC";
        $result = $this->db_facebook->query($q);
        // output: all user information
        return $result;
    }

}
