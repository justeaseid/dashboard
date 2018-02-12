<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 
 * This class contain of viewer that used on URL
 * author : Parama Fadli Kurnia
 */

class Apps extends CI_Controller {
    /* put your code here */

    // constructor
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('functional');
//        $this->load->library('formatter');
        $this->load->library('fb_formatter');
        $this->load->library('tw_formatter');
        $this->load->library('ins_formatter');
        $this->load->model('profile_model');
//        $this->load->model('dashboard_model');
        $this->load->model('fb_model');
        $this->load->model('tw_model');
        $this->load->model('ins_model');
    }

    function get_url() {
        $uri = array();
        $uri["enc_email"] = ($this->uri->segment(3) ? $this->uri->segment(3) : "NULL");
        $uri["group"] = ($this->uri->segment(4) ? $this->uri->segment(4) : "0");
        return $uri;
    }

    /* loaded at the first time the web was opened */
    /* load login_view */

    function index() {
        $data = array();
        $data["email"] = "";
        $data["password"] = "";
        $data["status"] = "Sign In";
        $this->load->view("content/main/login_view", $data);
    }

    /* load dashboard view */

    function dashboard() {
        // get url params
        $uri = array();
        $uri = $this->get_url();

        // check and load user profile
        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        // 
        // query result
        $mode = "all";
        $group = "1";
        $range_date = "NULL";

        // DONUT CHART
        $result_query = NULL;
        $result_query = $this->dashboard_model->transaction_type($mode, $range_date);
        // define all output
        $output = array();
        $output = $this->formatter->adv_donut($result_query, $group);
        // define all the output data views
        $data["donut_data"] = $output["donut_data"];
        $data["donut_color"] = $output["donut_color"];

        //AREA CHART
        $result_area = NULL;
        $result_area = $this->dashboard_model->transaction_type_quarter_year($mode, $range_date);
        // define all output
        $output_area = array();
        $output_area = $this->formatter->area_dimension($result_area, $group);
        // define all the output data views
        $data["area_data"] = $output_area["area_data"];
        $data["area_color"] = $output_area["area_color"];
        $data["area_labels"] = $output_area["area_labels"];

        // PIE CHART
        $result_pie = NULL;
        $result_pie = $this->dashboard_model->referral($mode, $range_date);
        // define all output
        $output_pie = NULL;
        $output_pie = $this->formatter->legend_donut($result_pie, $group);
        // define all the output data views
        $data["pie_data"] = $output_pie;


        // NEW PIE
        $new_result = NULL;
        $new_result = $this->dashboard_model->referral($mode, $range_date);
        $res = array();
        $res = $this->formatter->pie_drilldown($new_result, $mode, $range_date);

        $data["pie"] = $res["pie"];
        $data["pie_drilldown"] = $res["pie_drilldown"];


        // BAR CHART
//        $result_bar = NULL;
//        $result_bar = $this->dashboard_model->transaction_group_name($mode, $range_date);
//        // define all output
//        $output_bar = array();
//        $output_area = $this->formatter-> bar_quarter($result_bar, $group);
//        // define all the output data views
//        $data["bar_data"] = $output_area["bar_data"];
//        $data["bar_color"] = $output_area["bar_color"];
//        $data["bar_labels"] = $output_area["bar_labels"];
        $this->load->view("content/main/dashboard_view", $data);
    }

    /* load all monitoring viewer */

    function monitor() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);
        $this->load->view("content/main/monitor_view", $data);
    }

    /* load user viewer */

    function user() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $result = $this->profile_model->all_profile();

        $data = $this->profile_model->profile_exist($uri);
        $data["json_result"] = $result;
        $this->load->view("content/main/user_view", $data);
    }

    /* load profile viewer */

    function profile() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->get_profile($uri);
        $this->load->view("content/main/profile_view", $data);
    }

    /* load register form viewer */

    function register() {
        $data = array();
        $data["email"] = "";
        $data["password"] = "";
        $data["name"] = "";
        $data["role"] = "";
        $data["sex"] = "";
        $data["is_male"] = "checked";
        $data["is_female"] = "";
        $data["status"] = "Sign Up";
        $this->load->view("content/main/register_view", $data);
    }

    /* load reset password form */

    function reset() {
        $data = array();
        $data["email"] = "";
        $data['status'] = "Reset Password";
        $this->load->view("content/main/reset_view", $data);
    }

    function logout() {
        //clearstatcache();
        $email = $this->uri->segment(3);
        $this->functional->delete_file($email);
        redirect(base_url(), 'refresh');
    }

    /* load login viewer */

    function login() {
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);

        $data = array();
        $data["email"] = $email;
        $data["password"] = $password;

        if (empty($email) && empty($password)) {
            $data["status"] = '<font color="red">Empty email and password!</font>';
            $this->load->view('content/main/login_view', $data);
        } else if (empty($email)) {
            $data["status"] = '<font color="red">Empty email!</font>';
            $this->load->view('content/main/login_view', $data);
        } else if (empty($password)) {
            $data["status"] = '<font color="red">Empty password!</font>';
            $this->load->view('content/main/login_view', $data);
        } else {
            $result_db = $this->profile_model->login_profile($email, $password);
            if ($result_db->num_rows() == 1) {
                $uri = array();
                foreach ($result_db->result_array() as $row) {
                    $uri["id_user"] = $row["id_user"];
                    $uri["email"] = $row["email"];
                    $uri["name"] = $row['name'];
                    $uri["access"] = $row['access'];
                }
                $enc_email = $this->functional->encrypt($uri["email"]);
                $id_user = $uri["id_user"];
//                $access = $uri["access"];
                $data = array();
                $data["id_user"] = $id_user;
                $data["email"] = $uri["email"];
                $data["name"] = $uri["name"];
                $data["access"] = $uri["access"];
                $data["url"] = $enc_email;
                // view this class on dashboard
//                $content = implode("||", $data);
                $content = $data["name"];
                $this->functional->save_to($email, $content, "prf");
//                $this->load->view('content/main/dashboard_view', $data);
                //redirect(base_url("/apps/dashboard/$enc_email"), 'refresh');
//                redirect(base_url("/facebook/home/$enc_email/1"), 'refresh');
//                redirect(base_url("/apps/home/$enc_email/$id_user"), 'refresh');
//                redirect(base_url("/facebook/monitoring/$enc_email/$id_user"), 'refresh');
//                redirect(base_url("/apps/home/$enc_email/$id_user"), 'refresh');
                redirect(base_url("/ftopic/home/$enc_email/$id_user"), 'refresh');
            } else {
                $data["status"] = '<font color="red">Email or Password incorrect</font>';
                $this->load->view('content/main/login_view', $data);
            }
        }
    }

    function home() {
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);

        $type = ($this->uri->segment(5) ? $this->uri->segment(5) : "today");

        $page_streaming = $this->fb_model->global_streaming();
        $data["streaming"] = $page_streaming;
//        print_r($page_streaming);

        // facebook
        $active_account = $this->fb_model->home_most_active_user($type);
        $top = $this->fb_model->home_top();

        $data["active_account"] = $active_account;
        $data["top"] = $top;

        // twitter
        $ttop = $this->tw_model->home_top();
        $result_hashtags = $this->tw_model->get_hashtags($type, "0");
        $hashtags = $this->functional->get_hashtags($result_hashtags);

        $result_mhashtags = $this->tw_model->get_mentioned_hashtags($type, "0");
        $mhashtags = $this->functional->get_hashtags($result_mhashtags);

        $result_ghashtags = $result_hashtags . $result_mhashtags;
        $ghashtags = $this->functional->get_hashtags($result_ghashtags);

        $data["ttop"] = $ttop;
        $data["hashtags"] = $ghashtags;

        // instagram
        $itop = $this->ins_model->home_top();
        $iresult_hashtags = $this->ins_model->get_hashtags($type, "0");
        $ihashtags = $this->functional->get_hashtags($iresult_hashtags);

        $data["itop"] = $itop;
        $data["ihashtags"] = $ihashtags;
        
        // return the array value into another page
        $data["type"] = ucfirst($type);
        $this->load->view("content/home/home_view", $data);
    }
    
    // get data from DB and then display them into gridtable
    function get_data(){
        $type = ($this->uri->segment(3) ? $this->uri->segment(3) : "NULL");
        $user_access = ($this->uri->segment(4) ? $this->uri->segment(4) : "NULL");
        
        $json_result = $this->functional->get_json_result($type, $user_access);
        $uri = array();
        $uri = $this->get_url();

        $data = array();
        $data = $this->profile_model->profile_exist($uri);
        $idx = 0;
        foreach ($json_result as $key => $value){
            echo $value.'</br>';
            echo "=========================</br>";
            echo "$idx $value";
            $idx++;
        }
        
        $data["generated"] = false;
        $data["status"] = true;
        $data["is_valid"] = true;
        $data["is_exist"]= true;
        $this->load->view("content/home/data_view", $data);
    }
    
}

?>