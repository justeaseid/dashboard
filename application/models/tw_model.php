<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tw_model
 *
 * @author Parama_Fadli_Kurnia
 */
class Tw_model extends CI_Model {

    //put your code here
    private $db_twitter;

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db_twitter = $CI->load->database('twitter', TRUE);
        $this->load->library('functional');
    }

    function insert($table, $data) {
        $this->db_twitter->insert($table, $data);
    }

    function delete($table, $data) {
        $this->db_twitter->delete($table, $data);
    }

    function all($table) {
        $q = "";
        //AND DATE(`tw_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
        if ($table == "tw_tweet") {
            $q .= "SELECT tw.tw_id, tw.tw_from, tw.tw_text, tw.tw_retweet, tw.tw_favorite, ta.acc_screen_name as name
                    FROM tw_tweet tw, tw_account ta
                    WHERE tw.acc_id = ta.acc_id 
                    AND DATE(`tw_created_time`) = CURDATE()";
        } else if ($table == "tw_retweet") {
            $q .= "SELECT rt.rt_id, rt.rt_from, rt.rt_text, rt.rt_retweet, rt.rt_favorite, ta.acc_screen_name as name
                    FROM tw_retweet rt, tw_account ta
                    WHERE rt.acc_id = ta.acc_id
                    AND DATE(`rt_created_time`) = CURDATE()";
        } else if ($table == "tw_mention") {
            $q .= "SELECT mn.mn_id, mn.mn_from, mn.mn_text, mn.mn_retweet, mn.mn_favorite, ta.acc_screen_name as name
                    FROM tw_mention mn, tw_account ta
                    WHERE mn.acc_id = ta.acc_id
                    AND DATE(`mn_created_time`) = CURDATE()";
        } else if ($table == "tw_account") {
            $q = "SELECT * FROM tw_account "
                    . "WHERE is_special= '1'";
        } else {
            $q = "SELECT * FROM $table";
        }

        $result = $this->db_twitter->query($q);
//        echo $q;
        return $result;
    }

    function all1($table) {
        $q = "";
        $q = "SELECT * FROM $table";
        if ($table == "tw_tweet") {
//            $q .= " WHERE `tw_created_time` <= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
            $q .= " WHERE DATE(`tw_created_time`) >= curdate() - INTERVAL DAYOFWEEK(curdate())+2 DAY "
                    . "AND DATE(`tw_created_time`) <= curdate()";
        } else if ($table == "tw_retweet") {
//            $q .= " WHERE `mn_created_time` <= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
            $q .= " WHERE DATE(`rt_created_time`) >= curdate() - INTERVAL DAYOFWEEK(curdate())+2 DAY "
                    . "AND DATE(`rt_created_time`) <= curdate()";
        } else if ($table == "tw_mention") {
//            $q .= " WHERE `mn_created_time` <= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
            $q .= " WHERE DATE(`mn_created_time`) >= curdate() - INTERVAL DAYOFWEEK(curdate())+2 DAY "
                    . "AND DATE(`mn_created_time`) <= curdate()";
        }

        $result = $this->db_twitter->query($q);
        echo $q;
        return $result;
    }

    function crawler() {
        $q = "";
        $q = "SELECT tc.`cw_id`, tt.`tk_name`, tp.`acc_id`, tp.`acc_screen_name`, tc.`last_update`
                FROM `tw_crawl` tc, `tw_account` tp, `tw_token` tt
                WHERE tc.`tk_id` = tt.`tk_id`
                AND tc.`acc_id`= tp.`acc_id`";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_token() {
        $q = "";
        $q = "SELECT * FROM `tw_token` WHERE `tk_name` <> 'kumparan00' AND `tk_name` <> 'kumparan07'"
                . " AND `tk_name` <> 'kumparan08'";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function crawler_is_exist($data) {
        $pg_id = $data["acc_id"];
        $q = "";
        $q = "SELECT * FROM `tw_crawl`
                WHERE `acc_id` = $pg_id";
        $result = $this->db_twitter->query($q);
        if ($result->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
        // output: all user information
    }

    function is_added_to_workspace($data) {
        $id_user = $data["id_user"];
        $pg_id = $data["acc_id"];
        $q = "";
        $q = "SELECT * FROM tw_permission "
                . "WHERE acc_id = '$pg_id' AND id_user= '$id_user'";
        $result = $this->db_twitter->query($q);
//        echo $q;
        if ($result->num_rows() == 0) {
            $this->db_twitter->insert('tw_permission', $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_page_monitoring($id_user) {
        $q = "";
//        $q = "SELECT * FROM `fb_page` where `pg_id` IN ( SELECT `pg_id` FROM `fb_page_dw` GROUP BY `pg_id` )";
//        $q = "SELECT * FROM `tw_account` WHERE `is_special` = '1'";
        $q = "SELECT * FROM `tw_account` where `acc_id` IN ( SELECT `acc_id` FROM `tw_permission` WHERE `id_user`= '$id_user' )";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_mypage($id_user) {
        $q = "";
        $q = "SELECT p.`acc_id`, p.`acc_screen_name`, p.`acc_description`, p.`acc_url`, p.`acc_followers`, p.`acc_friends`, p.`acc_statuses`, p.status
            FROM(
            SELECT `acc_id`, `acc_screen_name`, `acc_description`, `acc_url`, `acc_followers`, `acc_friends`, `acc_statuses`, 'yes' as `status`
            FROM `tw_account` 
            WHERE `acc_id` 
            IN ( 
                SELECT `acc_id` FROM `tw_permission` WHERE `id_user`= '$id_user'
            )
            UNION
            SELECT `acc_id`, `acc_screen_name`, `acc_description`, `acc_url`, `acc_followers`, `acc_friends`, `acc_statuses`, 'no' as `status`
            FROM `tw_account` 
            WHERE `acc_id` 
            NOT IN ( 
                SELECT `acc_id` FROM `tw_permission` WHERE `id_user`= '$id_user'
            ) 
            AND `is_special` = '1'
                )AS p
                ORDER BY p.`acc_id` ASC";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_tweet() {
        $q = "";
        $q = "SELECT * FROM tw_tweet";
        $result = $this->db_twitter->query(q);
        return $result;
    }

    function get_page($acc_id) {
        $pg_id = "";
        $pg_name = "";
        $pg_screen = "";
        $pg_description = "";
        $pg_link = "";
        $pg_location = "";
        $pg_website = "";
        $pg_image = "";
        $pg_tweets = 0;
        $pg_followers = 0;
        $pg_friends = 0;
        $q = "";
        $q = "SELECT * from tw_account WHERE acc_id = '$acc_id'";
        $result = $this->db_twitter->query($q);
        if ($result->num_rows() != 0) {
            foreach ($result->result_array() as $row) {
                $pg_id = $row["acc_id"];
                $pg_name = $row["acc_name"];
                $pg_screen = "@" . $row["acc_screen_name"];
                $pg_description = substr($row["acc_description"], 0, 350);
                $pg_link = TWITTER . $row["acc_screen_name"];
                $pg_location = $row["acc_location"];
                $pg_website = $row["acc_url"];
                $pg_image = str_replace("_normal", "", $row["acc_image"]);
                $pg_tweets = number_format($row['acc_statuses'], 0, '.', ',');
                $pg_followers = number_format($row['acc_followers'], 0, '.', ',');
                $pg_friends = number_format($row['acc_friends'], 0, '.', ',');
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
        $data["acc_id"] = $pg_id;
        $data["acc_name"] = $pg_name;
        $data["acc_screen"] = $pg_screen;
        $data["acc_description"] = $pg_description;
        $data["acc_link"] = $pg_link;
        $data["acc_location"] = $pg_location;
        $data["acc_website"] = $pg_website;
        $data["acc_image"] = $pg_image;
        $data["acc_tweets"] = $pg_tweets;
        $data["acc_followers"] = $pg_followers;
        $data["acc_friends"] = $pg_friends;

        return $data;
    }

    function get_popular($acc_id) {
        $q = "";
        $q = "SELECT `tw_id` as id,`tw_from` as name,`tw_text` as message,
            `tw_created_time` as date,`tw_retweet` as shares, `tw_favorite` as likes,
            `tw_image` as image
                FROM `tw_tweet`
                WHERE `acc_id` = '$acc_id'
                ORDER BY `tw_retweet` DESC
                LIMIT 0,50";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_event($acc_id) {
        $q = "";
        $q = "SELECT `tw_id`,`tw_from`,`tw_text`,`tw_created_time`,`tw_retweet`, `tw_favorite`,`tw_image`
                FROM `tw_tweet`
                WHERE `acc_id` = '$acc_id'
                AND DATE(`tw_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 30 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                AND 
                (`tw_text` LIKE '%promo%' OR `tw_text` LIKE '%voucher%' OR
                 `tw_text` LIKE '%promosi%' OR `tw_text` LIKE '%kupon%' OR
                 `tw_text` LIKE '%paket%' OR `tw_text` LIKE '%murah%' OR
                 `tw_text` LIKE '%discount%' OR `tw_text` LIKE '%spesial%' OR
                 `tw_text` LIKE '%booking%' OR `tw_text` LIKE '%rekomendasi%' OR
                 `tw_text` LIKE '%menarik%' OR `tw_text` LIKE '%diskon%')
                ";
        $q .=" ORDER BY `tw_created_time` DESC
                LIMIT 0,50";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_timeline($page_id, $type) {
        $q = "";
        $q = "SELECT p.id, p.name, p.message, p.date, p.image, p.type, p.likes, p.shares
                FROM (
                    SELECT `tw_id` as id, `tw_from` as name, `tw_text` as message,`tw_created_time` as date,`tw_image` as image,`acc_id` as page_id, 'tweet' as type, `tw_favorite` as likes, `tw_retweet` as shares 
                    FROM `tw_tweet`
                    WHERE `acc_id` = '$page_id'
                    AND DATE(`tw_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 2 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                      UNION 
                    SELECT `rt_id` as id, `rt_from` as name, `rt_text` as message,`rt_created_time` as date,`rt_image` as image,`acc_id` as page_id,  'retweet' as type, `rt_favorite` as likes, `rt_retweet` as shares
                    FROM `tw_retweet`
                    WHERE `acc_id` = '$page_id'
                    AND DATE(`rt_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 2 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                      UNION 
                    SELECT `mn_id` as id, `mn_from` as name, `mn_text` as message,`mn_created_time` as date,`mn_image` as image,`acc_id` as page_id,  'mention' as type, `mn_favorite` as likes, `mn_retweet` as shares
                    FROM `tw_mention`
                    WHERE `acc_id` = '$page_id'
                    AND DATE(`mn_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 2 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                     ) 
                AS p";
        if ($type != "all")
            $q .= " WHERE p.type ='$type'";
        $q .=" ORDER BY p.date DESC
                LIMIT 0,30";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_dw_year() {
        $q = "";
        $q = "SELECT `d_year` FROM `tw_account_dw`
                GROUP BY `d_year`
                ORDER BY d_year DESC";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_timesent($page_id, $mode) {
        //AND DATE(`mn_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
        $q = "";
        $q = "SELECT fc.`mn_id`,fc.`mn_from`,fc.`mn_text`,fc.`mn_created_time`,
                fc.`mn_retweet`,fc.`mn_favorite`, fc.`mn_image`,fca.`mn_sentiment`
                FROM `tw_mention` fc, `tw_mention_analyze` fca
                WHERE fc.`mn_id`= fca.`mn_id`
                AND fc.`acc_id` = '$page_id'
                AND fca.`mn_sentiment` = '$mode'
                AND DATE(`mn_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                ORDER BY `mn_created_time` DESC
                LIMIT 0,50;";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information

        if ($result->num_rows() > 2) {
            return $result;
        } else {
            $q1 = "";
            $q1 = "SELECT fc.`mn_id`,fc.`mn_from`,fc.`mn_text`,fc.`mn_created_time`,
                fc.`mn_retweet`,fc.`mn_favorite`, fc.`mn_image`,fca.`mn_sentiment`
                FROM `tw_mention` fc, `tw_mention_analyze` fca
                WHERE fc.`mn_id`= fca.`mn_id`
                AND fc.`acc_id` = '$page_id'
                AND fca.`mn_sentiment` = '$mode'
                AND DATE(`mn_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 10 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )
                ORDER BY `mn_created_time` DESC
                LIMIT 0,50;";
//        echo $q;
            $result1 = $this->db_twitter->query($q1);
            return $result1;
        }
    }

    function get_sentiment($page_id, $year) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`mn_pos`) as sum_cpos, SUM(`mn_neg`) as sum_cneg, SUM(`mn_neu`) as sum_cneu,
                SUM(`tw_pos`) as sum_ppos, SUM(`tw_neg`) as sum_pneg, SUM(`tw_neu`) as sum_pneu
                FROM `tw_account_dw`
                WHERE `acc_id` = '$page_id'
                AND `d_year` = $year
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function update_sentiment($mn_id, $data) {
        $this->db_twitter->where('mn_id', $mn_id);
        $this->db_twitter->update('tw_mention_analyze', $data);
        // update data by email
    }

    function get_streaming($page_id) {
        $q = "";
        $q = "SELECT * FROM `tw_tweet` WHERE `acc_id` = '$page_id' ORDER BY `tw_created_time` DESC LIMIT 0, 10";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_composition_dashboard($page_id, $year) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`tw_count`) as sum_tweet, SUM(`rt_count`) as sum_retweet, SUM(`mn_count`) as sum_mention
                FROM `tw_account_dw`
                WHERE `acc_id` = '$page_id'
                AND `d_year` = $year
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_fans($page_id, $year) {
        $q = "";
        $q = "SELECT `d_month`, MAX(`acc_followers`) as sum_likes
                FROM `tw_account_dw`
                WHERE `acc_id` = '$page_id'
                AND `d_year` = $year
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_most_mention_user($page_id, $type) {
        $q = "";
        $q = "SELECT `mn_id`, `mn_from`,`mn_from_id`,`mn_image`, COUNT(`mn_id`) as jumlah
                FROM `tw_mention`
                WHERE `acc_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("mn_created_time", $type, "AND");
        $q .=" GROUP BY `mn_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_most_retweet_user($page_id, $type) {
        $q = "";
        $q = "SELECT `rt_id`, `rt_from`,`rt_from_id`,`rt_image`, COUNT(`rt_id`) as jumlah
                FROM `tw_retweet`
                WHERE `acc_id` = '$page_id' AND `rt_from_id` <> '$page_id'";

        $q .= $this->functional->generate_date_query("rt_created_time", $type, "AND");
        $q .=" GROUP BY `rt_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_composition($page_id, $type) {
        $q = "";
        $q = "SELECT SUM(`tw_count`) as sum_tweet, SUM(`rt_count`) as sum_retweet, SUM(`mn_count`) as sum_mention
                FROM `tw_account_dw`
                WHERE `acc_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_shares_likes($page_id, $type) {
        $q = "";
        $q = "SELECT SUM(`tw_retweet`) as sum_shares, SUM(`tw_favorite`) as sum_likes
                FROM `tw_account_dw`
                WHERE `acc_id` = '$page_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_streaming() {
        $q = "";
        $q = "SELECT * FROM `tw_tweet`"
                . " WHERE DATE(`tw_created_time`) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 1 Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )"
                . " ORDER BY `tw_created_time` DESC"
                . " LIMIT 0, 30";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_mention_user($type) {
        $q = "";
        $q = "SELECT `mn_id`, `mn_from`,`mn_from_id`,`mn_image`, COUNT(`mn_id`) as jumlah
                FROM `tw_mention`
                WHERE";

        $q .= $this->functional->generate_date_query("mn_created_time", $type);
        $q .=" GROUP BY `mn_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_retweet_user($type) {
        $q = "";
        $q = "SELECT `rt_id`, `rt_from`,`rt_from_id`,`rt_image`, COUNT(`rt_id`) as jumlah
                FROM `tw_retweet`
                WHERE";

        $q .= $this->functional->generate_date_query("rt_created_time", $type);
        $q .=" GROUP BY `rt_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_top() {
        $q = "";
        $q = "SELECT * FROM `tw_account` "
                . "WHERE `is_special`= '1' "
                . "AND `acc_screen_name` <> 'selenamaria_' "
                . "AND `acc_screen_name` <> 'eghalatoya'"
                . "ORDER BY `acc_followers` DESC LIMIT 0, 5";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_composition($type) {
        $q = "";
        $q = "SELECT SUM(`tw_count`) as sum_tweet, SUM(`rt_count`) as sum_retweet, 
                SUM(`mn_count`) as sum_mention
                FROM `tw_account_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_shares_likes($type) {
        $q = "";
        $q = "SELECT SUM(`tw_retweet`) as sum_shares, SUM(`tw_favorite`) as sum_likes
                FROM `tw_account_dw`
                WHERE";

        $q .= $this->functional->generate_date_query("created_date", $type);
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_hashtags($type, $mode, $acc_id = "NULL") {
        $q = "";
        $q = "SELECT `tw_hashtag` FROM `tw_tweet`
                WHERE";

        $q .= $this->functional->generate_date_query("tw_created_time", $type);
        $q .=" AND `tw_hashtag` <> 'NULL'";
        if ($mode == "1")
            $q .=" AND `acc_id` = '$acc_id'";
        $result = $this->db_twitter->query($q);
        // output: all user information
        $string = "";
        if ($result->num_rows() != 0) {
            $idx = 0;
            foreach ($result->result_array() as $row) {
                $string .= $row['tw_hashtag'] . " ";
            }
        }
        return $string;
    }

    function get_mentioned_hashtags($type, $mode, $acc_id = "NULL") {
        $q = "";
        $q = "SELECT `mn_hashtag` FROM `tw_mention`
                WHERE";

        $q .= $this->functional->generate_date_query("mn_created_time", $type);
        $q .=" AND `mn_hashtag` <> 'NULL'";
        if ($mode == "1")
            $q .=" AND `acc_id` = '$acc_id'";
        $result = $this->db_twitter->query($q);
        // output: all user information
        $string = "";
        if ($result->num_rows() != 0) {
            $idx = 0;
            foreach ($result->result_array() as $row) {
                $string .= $row['mn_hashtag'] . " ";
            }
        }
        return $string;
    }

    function get_ssummary($page_id, $type) {
        $q = "";
        $q = "SELECT SUM(`mn_pos`) as sum_pos, SUM(`mn_neg`) as sum_neg, SUM(`mn_neu`) as sum_neu
                FROM `tw_account_dw`
                WHERE `acc_id` = '$page_id'";
        $type = strtolower($type);
        $q .= $this->functional->generate_date_query("created_date", $type, $prefix = "AND");
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
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
        $result = $this->db->query($q);
        // output: all user information
        return $result;
    }

}

?>