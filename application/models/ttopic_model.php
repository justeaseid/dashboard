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
class Ttopic_model extends CI_Model {

    //put your code here
    private $db_twitter;

    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $this->db_twitter = $CI->load->database('twitter', TRUE);
        $this->load->library('functional');
    }
    
    function myPage(){
        $page = " `acc_id` IN (SELECT `acc_id` FROM `tw_crawl` WHERE `tk_id` = '8') ";
        return $page;
    }

    function get_page_monitoring($id_user) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `tw_account` where $page";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }
    
    function get_special_page($pg_id) {
        $q = "";
        $pg_name = "All";
        if ($pg_id != "all") {
            $q = "SELECT * FROM `tw_account` where acc_id = '$pg_id'";
            $result = $this->db_twitter->query($q);
            foreach ($result->result_array() as $row) {
                $pg_name = $row['acc_name'];
                break;
            }
        }
        return $pg_name;
    }
    
    function get_page_trends($type, $pg_id) {
        $q = "";
        $qid = "";

        if ($pg_id != "all") {
            $qid = " AND tdw.acc_id = '$pg_id' ";
        }
        
        $date = $this->functional->generate_date_query("created_date", $type, "AND");
        $q = "SELECT ft.topic_name, SUM(`tw_count`) as tweet, SUM(`rt_count`) as retweet, SUM(`tw_favorite`) as likes
                FROM tw_account_topic_dw tdw, tw_topics ft   
                WHERE tdw.topic_id = ft.topic_id
                $qid
                $date
                GROUP BY tdw.topic_id
                ORDER BY likes DESC;";
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

    function get_timeline($acc_id, $type, $topic_id) {
        $q = "";
        $date = "";
        if($type!="all"){
            $date = $this->functional->generate_date_query("created_time", $type, "AND");
        }
        
        $q = "SELECT `tw_id` as id,`tw_from` as name,`tw_text` as message,
            `tw_created_time` as date,`tw_retweet` as shares, `tw_favorite` as likes,
            `tw_image` as image, 'tweet' as type
                FROM `tw_tweet`tw, tw_post_topic tpt
                WHERE tpt.pg_id = tw.acc_id
                AND tpt.sm_id = tw.tw_id
                AND tpt.`pg_id` = '$acc_id'
                AND tpt.topic_id = '$topic_id'
                $date
                ORDER BY tpt.created_time DESC
                LIMIT 0,50";

//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_dw_year() {
        $q = "";
        $q = "SELECT `d_year` FROM `tw_account_topic_dw`
                GROUP BY `d_year`
                ORDER BY d_year DESC";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_streaming($page_id) {
        $q = "";
        $q = "SELECT * FROM `tw_tweet` WHERE `acc_id` = '$page_id' ORDER BY `tw_created_time` DESC LIMIT 0, 10";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_composition_dashboard($page_id, $year, $topic_id) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`tw_count`) as sum_tweet, SUM(`rt_count`) as sum_retweet, SUM(`mn_count`) as sum_mention
                FROM `tw_account_topic_dw`
                WHERE `acc_id` = '$page_id'
                AND `d_year` = $year
                AND `topic_id` = '$topic_id'
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_fans($page_id, $year, $topic_id) {
        $q = "";
        $q = "SELECT `d_month`, SUM(`tw_count`) as sum_likes
                FROM `tw_account_topic_dw`
                WHERE `acc_id` = '$page_id'
                AND `d_year` = $year
                AND `topic_id` = '$topic_id'
                GROUP BY `d_month`
                ORDER BY `d_month` ASC";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_most_retweet_user($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT `rt_id`, `rt_from`,`rt_from_id`,`rt_image`, COUNT(`rt_id`) as jumlah
                FROM `tw_retweet` tw, tw_post_topic tpt
                WHERE tpt.pg_id = tw.acc_id
                AND tpt.sm_id = tw.rt_retweet_to_tweet_id
                AND tpt.topic_id = '$topic_id'
                AND tpt.`pg_id` = '$page_id' AND tw.`rt_from_id` <> '$page_id'";

        $q .= $this->functional->generate_date_query("created_time", $type, "AND");
        $q .=" GROUP BY `rt_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_composition($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`tw_count`) as sum_tweet, SUM(`rt_count`) as sum_retweet, SUM(`mn_count`) as sum_mention
                FROM `tw_account_topic_dw`
                WHERE `acc_id` = '$page_id'
                AND topic_id = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }
    
    function get_count_likes($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`rt_retweet`) as sum_comment, SUM(`rt_favorite`) as sum_likes
                FROM `tw_account_topic_dw`
                WHERE `acc_id` = '$page_id'
                AND topic_id = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_shares_likes($page_id, $type, $topic_id) {
        $q = "";
        $q = "SELECT SUM(`tw_retweet`) as sum_shares, SUM(`tw_favorite`) as sum_likes
                FROM `tw_account_topic_dw`
                WHERE `acc_id` = '$page_id'
                AND topic_id = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_streaming() {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `tw_tweet`"
                . " WHERE $page"
                . " ORDER BY `tw_created_time` DESC"
                . " LIMIT 0, 30";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_mention_user($type) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT `mn_id`, `mn_from`,`mn_from_id`,`mn_image`, COUNT(`mn_id`) as jumlah
                FROM `tw_mention`
                WHERE $page";

        $q .= $this->functional->generate_date_query("mn_created_time", $type, "AND");
        $q .=" GROUP BY `mn_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_retweet_user($type) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT `rt_id`, `rt_from`,`rt_from_id`,`rt_image`, COUNT(`rt_id`) as jumlah
                FROM `tw_retweet`
                WHERE $page";

        $q .= $this->functional->generate_date_query("rt_created_time", $type, "AND");
        $q .=" GROUP BY `rt_from_id`
                ORDER BY jumlah DESC
                LIMIT 0,12";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_top() {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT * FROM `tw_account` "
                . "WHERE $page"
                . "ORDER BY `acc_followers` DESC LIMIT 0, 5";
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function home_composition($type) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT SUM(`tw_count`) as sum_tweet, SUM(`rt_count`) as sum_retweet, 
                SUM(`mn_count`) as sum_mention
                FROM `tw_account_topic_dw`
                WHERE $page";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }
    
    function home_shares_likes($type) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT SUM(`tw_retweet`) as sum_shares, SUM(`tw_favorite`) as sum_likes
                FROM `tw_account_topic_dw`
                WHERE $page";

        $q .= $this->functional->generate_date_query("created_date", $type, "AND");
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }

    function get_hashtags($type, $mode, $acc_id = "NULL") {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT `tw_hashtag` FROM `tw_tweet`
                WHERE $page";

        $q .= $this->functional->generate_date_query("tw_created_time", $type, "AND");
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

    function get_hashtags_monitor($type, $mode, $acc_id = "NULL", $topic_id) {
        $q = "";
        $q = "SELECT `tw_hashtag` 
                FROM `tw_tweet` tw, tw_post_topic tpt
                WHERE tpt.pg_id = tw.acc_id
                AND tpt.sm_id = tw.tw_id
                AND tpt.topic_id = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_time", $type, "AND");
        $q .=" AND tw.`tw_hashtag` <> 'NULL'";
        if ($mode == "1")
            $q .=" AND tpt.`pg_id` = '$acc_id'";
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
        $page = $this->myPage();
        $q = "SELECT `mn_hashtag` FROM `tw_mention`
                WHERE $page";

        $q .= $this->functional->generate_date_query("mn_created_time", $type, "AND");
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

    function get_mentioned_hashtags_monitor($type, $mode, $acc_id = "NULL", $topic_id) {
        $q = "";
        $page = $this->myPage();
        $q = "SELECT `rt_hashtag` FROM `tw_retweet` tw, tw_post_topic tpt
                WHERE tpt.pg_id = tw.acc_id
                AND tpt.sm_id = tw.rt_retweet_to_tweet_id
                AND tpt.topic_id = '$topic_id'";

        $q .= $this->functional->generate_date_query("created_time", $type, "AND");
        $q .=" AND tw.`rt_hashtag` <> 'NULL'";
        if ($mode == "1")
            $q .=" AND tpt.`pg_id` = '$acc_id'";
        $result = $this->db_twitter->query($q);
        // output: all user information
        $string = "";
        if ($result->num_rows() != 0) {
            $idx = 0;
            foreach ($result->result_array() as $row) {
                $string .= $row['rt_hashtag'] . " ";
            }
        }
        return $string;
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
    
    function get_popular($acc_id, $type, $topic_id) {
        $q = "";
        $date = "";
        if($type!="all"){
            $date = $this->functional->generate_date_query("created_time", $type, "AND");
        }
        
        $q = "SELECT `tw_id` as id,`tw_from` as name,`tw_text` as message,
            `tw_created_time` as date,`tw_retweet` as shares, `tw_favorite` as likes,
            `tw_image` as image, 'tweet' as type
                FROM `tw_tweet` tw, tw_post_topic tpt
                WHERE tpt.pg_id = tw.acc_id
                AND tpt.sm_id = tw.tw_id
                AND tpt.`pg_id` = '$acc_id'
                AND tpt.topic_id = '$topic_id'
                $date
                ORDER BY `tw_retweet` DESC
                LIMIT 0,50";
//        echo $q;
        $result = $this->db_twitter->query($q);
        // output: all user information
        return $result;
    }
    
}

?>