<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor
 * Author: Parama Fadli Kurnia
 * 
 * information:
 * mformatter is formatter data for FB monitoring
 * get data from fb message and then view that into graph
 * 
 * params UI get the data and tranform it into graph
 */

require_once dirname(__FILE__) . '/functional.php';

class Tw_formatter {

    function __construct() {
        $this->functional = new Functional();
    }

    function get_commented($data) {
        $output = "";
        $result = "";
//        $idx = 0;

        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $cm_from = $row["mn_from"];
                $jumlah = $row["jumlah"];
                $name = substr($cm_from, 0, 15);
                $output .= '{name:"' . $name . '",y:' . $jumlah . ', color: "#606060"},';
//                $idx++;
            }
        } else {
            $output .= '{name:"NO RESULT",weight: 0, color: "#606060"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function get_retweeted($data) {
        $output = "";
        $result = "";
//        $idx = 0;

        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $cm_from = $row["rt_from"];
                $jumlah = $row["jumlah"];
                $name = substr($cm_from, 0, 15);
                $output .= '{name:"' . $name . '",y:' . $jumlah . ', color: "#606060"},';
//                $idx++;
            }
        } else {
            $output .= '{name:"NO RESULT",weight: 0, color: "#606060"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function get_count_likes($data) {
        $output = "";
        $result = "";
//        $idx = 0;
        //{name:'comment',y:28,color:'#f79646'},{name:'likes',y:14,color:'#376092'}
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $sum_comment = $row["sum_comment"];
                $sum_likes = $row["sum_likes"];
                if ((($sum_comment == NULL) || ($sum_comment == "NULL")) && (($sum_likes == NULL) || ($sum_likes == "NULL"))) {
                    $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                } else {
                    if (($sum_comment == NULL) || ($sum_comment == "NULL"))
                        $sum_comment = 0;
                    if (($sum_likes == NULL) || ($sum_likes == "NULL"))
                        $sum_likes = 0;

                    if (($sum_comment == 0) && ($sum_likes == 0)) {
                        $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                    } else {
                        $output .= '{name:"retweet",y:' . $sum_comment . ', color: "#f79646"},';
                        $output .= '{name:"likes",y:' . $sum_likes . ', color: "#376092"},';
                    }
                }
//                $idx++;
            }
        } else {
            $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function get_shares_likes($data) {
        $output = "";
        $result = "";
//        $idx = 0;
        //{name:'likes',y:28,color:'#953735'},{name:'shares',y:14,color:'#3e4348'}
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $sum_shares = $row["sum_shares"];
                $sum_likes = $row["sum_likes"];
                if ((($sum_shares == NULL) || ($sum_shares == "NULL")) && (($sum_likes == NULL) || ($sum_likes == "NULL"))) {
                    $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                } else {
                    if (($sum_shares == NULL) || ($sum_shares == "NULL"))
                        $sum_shares = 0;
                    if (($sum_likes == NULL) || ($sum_likes == "NULL"))
                        $sum_likes = 0;

                    if (($sum_shares == 0) && ($sum_likes == 0)) {
                        $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                    } else {
                        $output .= '{name:"retweet",y:' . $sum_shares . ', color: "#3e4348"},';
                        $output .= '{name:"favorite",y:' . $sum_likes . ', color: "#953735"},';
                    }
                }
//                $idx++;
            }
        } else {
            $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function get_pos_com($data) {
        $output = "";
        $result = "";
//        $idx = 0;
        //{name:'post',y:128, color:'#f79646'},{name:'comment',y:54,color:'#606060'}
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $sum_post = $row["sum_post"];
                $sum_comment = $row["sum_comment"];
                if ((($sum_post == NULL) || ($sum_post == "NULL")) && (($sum_comment == NULL) || ($sum_comment == "NULL"))) {
                    $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                } else {
                    if (($sum_post == NULL) || ($sum_post == "NULL"))
                        $sum_post = 0;
                    if (($sum_comment == NULL) || ($sum_comment == "NULL"))
                        $sum_comment = 0;

                    if (($sum_comment == 0) && ($sum_post == 0)) {
                        $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                    } else {
                        $output .= '{name:"post",y:' . $sum_post . ', color: "#f79646"},';
                        $output .= '{name:"comment",y:' . $sum_comment . ', color: "#606060"},';
                    }
                }
//                $idx++;
            }
        } else {
            $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function get_composition($data) {
        $output = "";
        $result = "";
//        $idx = 0;
        /*
          {name:'tweet',y:28,color:'#953735'},{name:'retweet',y:14,color:'#376092'},"
          . "{name:'mention',y:10,color:'#f79646'},{name:'status',y:30,color:'#00a65a'},"
          . "{name:'offer',y:12,color:'#606060'}
         *          */
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $sum_tweet = $row["sum_tweet"];
                $sum_retweet = $row["sum_retweet"];
                $sum_mention = $row["sum_mention"];
                if ((($sum_tweet == NULL) || ($sum_tweet == "NULL")) &&
                        (($sum_retweet == NULL) || ($sum_retweet == "NULL")) &&
                        (($sum_mention == NULL) || ($sum_mention == "NULL"))
                ) {
                    $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                } else {
                    if (($sum_tweet == NULL) || ($sum_tweet == "NULL"))
                        $sum_tweet = 0;
                    if (($sum_retweet == NULL) || ($sum_retweet == "NULL"))
                        $sum_retweet = 0;
                    if (($sum_mention == NULL) || ($sum_mention == "NULL"))
                        $sum_mention = 0;

                    if (($sum_tweet == 0) && ($sum_retweet == 0) && ($sum_mention == 0)) {
                        $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                    } else {
                        $output .= '{name:"tweet",y:' . $sum_tweet . ', color: "#953735"},';
                        $output .= '{name:"retweet",y:' . $sum_retweet . ', color: "#376092"},';
                        $output .= '{name:"mention",y:' . $sum_mention . ', color: "#f79646"},';
                    }
                }
//                $idx++;
            }
        } else {
            $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function get_composition_dashboard($data) {
        $str_tweet = "";
        $str_mention = "";
        $str_retweet = "";

        $data_month = array();
        $tweet = array();
        $retweet = array();
        $mention = array();
        $idx = 0;

        /*
          {name:'tweet',y:28,color:'#953735'},{name:'retweet',y:14,color:'#376092'},"
          . "{name:'mention',y:10,color:'#f79646'},{name:'status',y:30,color:'#00a65a'},"
          . "{name:'offer',y:12,color:'#606060'}
         *          */
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $d_month = $row["d_month"];
                $sum_tweet = $row["sum_tweet"];
                $sum_retweet = $row["sum_retweet"];
                $sum_mention = $row["sum_mention"];
                if ((($sum_tweet == NULL) || ($sum_tweet == "NULL")) &&
                        (($sum_retweet == NULL) || ($sum_retweet == "NULL")) &&
                        (($sum_mention == NULL) || ($sum_mention == "NULL"))
                ) {
//                    echo "NO</br>";
                    $str_tweet = "0,0,0,0,0,0,0,0,0,0,0,0";
                    $str_mention = "0,0,0,0,0,0,0,0,0,0,0,0";
                    $str_retweet = "0,0,0,0,0,0,0,0,0,0,0,0";
                } else {
//                    echo "YES</br>";
                    if (($sum_tweet == NULL) || ($sum_tweet == "NULL"))
                        $sum_tweet = 0;
                    if (($sum_retweet == NULL) || ($sum_retweet == "NULL"))
                        $sum_retweet = 0;
                    if (($sum_mention == NULL) || ($sum_mention == "NULL"))
                        $sum_mention = 0;

//                    echo substr($d_month, 4, strlen($d_month) - 1);
                    $data_month[$idx] = substr($d_month, 4, strlen($d_month) - 1);
                    $tweet[$idx] = $sum_tweet;
                    $mention[$idx] = $sum_mention;
                    $retweet[$idx] = $sum_retweet;
                }
                $idx++;
            }

            $list_tweet = array();
            $list_retweet = array();
            $list_mention = array();

//            $data_month = array();
            $list_month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
            $count_data = count($list_month);
            for ($i = 0; $i < $count_data; $i++) {
                if (in_array($list_month[$i], $data_month)) {
                    $index = array_search($list_month[$i], $data_month);
                    $list_tweet[$i] = $tweet[$index];
                    $list_retweet[$i] = $retweet[$index];
                    $list_mention[$i] = $mention[$index];
                } else {
                    $list_tweet[$i] = 0;
                    $list_retweet[$i] = 0;
                    $list_mention[$i] = 0;
                }
            }
            $str_tweet = implode(", ", $list_tweet);
            $str_mention = implode(", ", $list_mention);
            $str_retweet = implode(", ", $list_retweet);
        } else {
            $str_tweet = "0,0,0,0,0,0,0,0,0,0,0,0";
            $str_mention = "0,0,0,0,0,0,0,0,0,0,0,0";
            $str_retweet = "0,0,0,0,0,0,0,0,0,0,0,0";
        }
        $data = array();
        $data["tweet"] = $str_tweet;
        $data["mention"] = $str_mention;
        $data["retweet"] = $str_retweet;
        return $data;
    }

    function get_fans($data, $last_likes, $type, $mode = "0") {
        $output = "";
        $result = "";
        $str_likes = "";

        $data_month = array();
        $likes = array();
        $idx = 0;
        $year_now = date("Y");

        /*
          {name:'video',y:28,color:'#953735'},{name:'photo',y:14,color:'#376092'},"
          . "{name:'link',y:10,color:'#f79646'},{name:'status',y:30,color:'#00a65a'},"
          . "{name:'offer',y:12,color:'#606060'}
         *          */
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $d_month = $row["d_month"];
                $sum_likes = $row["sum_likes"];
                if (($sum_likes == NULL) || ($sum_likes == "NULL"))
                    $sum_likes = 0;
                $data_month[$idx] = substr($d_month, 4, strlen($d_month) - 1);

                if ($mode == "0") {
                    if ($idx == $count_data - 1) {
                        if ($year_now == $type)
                            $likes[$idx] = $last_likes;
                        else
                            $likes[$idx] = $sum_likes;
                    }else {
                        $likes[$idx] = $sum_likes;
                    }
                } else {
                    $likes[$idx] = $sum_likes;
                }

                $idx++;
            }

            $list_likes = array();

//            print_r($likes);
//            print_r($data_month);
//            $data_month = array();
            $list_month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
            $count_data = count($list_month);
            for ($i = 0; $i < $count_data; $i++) {
//                echo $list_month[$i];
                $name_month = $this->functional->converter($list_month[$i]);
                if (in_array($list_month[$i], $data_month)) {
                    $index = array_search($list_month[$i], $data_month);
//                    echo $index.'</br>';
                    $like = $likes[$index];
                    $str_likes .= "{name: '" . $name_month . "',y: " . $like . ",color: '#606060'},";
                } else {
                    $str_likes .= "{name: '" . $name_month . "',y: 0,color: '#606060'},";
                }
            }
        } else {
            $str_likes = "{name: 'Jan',y: 0,color: '#606060'},{name: 'Feb',y: 0,color: '#606060'},{name: 'Mar',y: 0,color: '#606060'},"
                    . "{name: 'Apr',y: 0,color: '#606060'},{name: 'May',y: 0,color: '#606060'},{name: 'Jun',y: 0,color: '#606060'},"
                    . "{name: 'Jul',y: 0,color: '#606060'},{name: 'Aug',y: 0,color: '#606060'},{name: 'Sep',y: 0,color: '#606060'},"
                    . "{name: 'Oct',y: 0,color: '#606060'},{name: 'Nov',y: 0,color: '#606060'},{name: 'Dec',y: 0,color: '#606060'},";
        }
        $result = substr($str_likes, 0, strlen($str_likes) - 1);
        ;
        return $result;
    }

    function get_sentiment($data) {
        $str_pos = "";
        $str_neg = "";
        $str_neu = "";

        $data_month = array();
        $pos = array();
        $neg = array();
        $neu = array();
        $idx = 0;

        $sum_pos = 0;
        $sum_neg = 0;
        $sum_neu = 0;
        $sum_ppos = 0;
        $sum_pneg = 0;
        $sum_pneu = 0;

        /*
          {name:'video',y:28,color:'#953735'},{name:'photo',y:14,color:'#376092'},"
          . "{name:'link',y:10,color:'#f79646'},{name:'status',y:30,color:'#00a65a'},"
          . "{name:'offer',y:12,color:'#606060'}
         *          */
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $d_month = $row["d_month"];
                $sum_pos = $row["sum_cpos"];
                $sum_neg = $row["sum_cneg"];
                $sum_neu = $row["sum_cneu"];

                $sum_ppos = $row["sum_ppos"];
                $sum_pneg = $row["sum_pneg"];
                $sum_pneu = $row["sum_pneu"];
                if ((($sum_pos == NULL) || ($sum_pos == "NULL")) &&
                        (($sum_neg == NULL) || ($sum_neg == "NULL")) &&
                        (($sum_neu == NULL) || ($sum_neu == "NULL")) &&
                        (($sum_ppos == NULL) || ($sum_ppos == "NULL")) &&
                        (($sum_pneg == NULL) || ($sum_pneg == "NULL")) &&
                        (($sum_pneu == NULL) || ($sum_pneu == "NULL"))
                ) {
//                    echo "NO</br>";
                    $str_pos = "0,0,0,0,0,0,0,0,0,0,0,0";
                    $str_neg = "0,0,0,0,0,0,0,0,0,0,0,0";
                    $str_neu = "0,0,0,0,0,0,0,0,0,0,0,0";
                } else {
//                    echo "YES</br>";
                    if (($sum_pos == NULL) || ($sum_pos == "NULL"))
                        $sum_pos = 0;
                    if (($sum_neg == NULL) || ($sum_neg == "NULL"))
                        $sum_neg = 0;
                    if (($sum_neu == NULL) || ($sum_neu == "NULL"))
                        $sum_neu = 0;

                    if (($sum_ppos == NULL) || ($sum_ppos == "NULL"))
                        $sum_ppos = 0;
                    if (($sum_pneg == NULL) || ($sum_pneg == "NULL"))
                        $sum_pneg = 0;
                    if (($sum_pneu == NULL) || ($sum_pneu == "NULL"))
                        $sum_pneu = 0;


//                    echo substr($d_month, 4, strlen($d_month) - 1);
                    $data_month[$idx] = substr($d_month, 4, strlen($d_month) - 1);
                    $pos[$idx] = $sum_pos + $sum_ppos;
                    $neg[$idx] = $sum_neg + $sum_pneg;
                    $neu[$idx] = $sum_neu + $sum_pneu;
                }
                $idx++;
            }

            $list_pos = array();
            $list_neg = array();
            $list_neu = array();

//            $data_month = array();
            $list_month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
            $count_data = count($list_month);
            for ($i = 0; $i < $count_data; $i++) {
                if (in_array($list_month[$i], $data_month)) {
                    $index = array_search($list_month[$i], $data_month);
                    $list_pos[$i] = $pos[$index];
                    $list_neg[$i] = $neg[$index];
                    $list_neu[$i] = $neu[$index];
                } else {
                    $list_pos[$i] = 0;
                    $list_neg[$i] = 0;
                    $list_neu[$i] = 0;
                }
            }
            $str_pos = implode(", ", $list_pos);
            $str_neg = implode(", ", $list_neg);
            $str_neu = implode(", ", $list_neu);
        } else {
            $str_pos = "0,0,0,0,0,0,0,0,0,0,0,0";
            $str_neg = "0,0,0,0,0,0,0,0,0,0,0,0";
            $str_neu = "0,0,0,0,0,0,0,0,0,0,0,0";
        }
        $data = array();
        $data["pos"] = $str_pos;
        $data["neg"] = $str_neg;
        $data["neu"] = $str_neu;
        return $data;
    }

    // create cloud data viewer
    function get_cloud($data) {
        $output = "";
        $result = "";
//        $idx = 0;
        // $output .= '{text:"#' . $flight_from . '-' . $flight_to . '",weight:' . $jumlah . '},';
        // {text:"NO RESULT",weight: 10},

        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $cm_from = $row["cm_from"];
                $jumlah = $row["jumlah"];
                $jumlah = $this->functional->get_weight($jumlah);
                $name = substr($cm_from, 0, 15);
                $output .= '{name:"' . $name . '",weight:' . $jumlah . ', color: "#606060"},';
//                $idx++;
            }
        } else {
            $output .= '{name:"NO RESULT",weight: 0, color: "#606060"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function get_ssummary($data) {
        $output = "";
        $result = "";
//        $idx = 0;
        //{name:'comment',y:28,color:'#f79646'},{name:'likes',y:14,color:'#376092'}
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $sum_pos = $row["sum_pos"];
                $sum_neg = $row["sum_neg"];
                $sum_neu = $row["sum_neu"];
                if ((($sum_pos == NULL) || ($sum_pos == "NULL")) &&
                        (($sum_neg == NULL) || ($sum_neg == "NULL")) &&
                        (($sum_neu == NULL) || ($sum_neu == "NULL"))) {
                    $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                } else {
                    if (($sum_pos == NULL) || ($sum_pos == "NULL"))
                        $sum_pos = 0;
                    if (($sum_neg == NULL) || ($sum_neg == "NULL"))
                        $sum_neg = 0;
                    if (($sum_neu == NULL) || ($sum_neu == "NULL"))
                        $sum_neu = 0;

                    if (($sum_pos == 0) && ($sum_neg == 0) && ($sum_neu == 0)) {
                        $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
                    } else {
                        $output .= '{name:"positive",y:' . $sum_pos . ', color: "#376092"},';
                        $output .= '{name:"negative",y:' . $sum_neg . ', color: "#953735"},';
                        $output .= '{name:"neutral",y:' . $sum_neu . ', color: "#3e4348"},';
                    }
                }
//                $idx++;
            }
        } else {
            $output .= '{name:"NO RESULT",y: 0, color: "#606060"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

}

?>