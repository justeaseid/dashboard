<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */

/**
 * Description of formatter
 *
 * @author Parama_Fadli_Kurnia
 */
require_once dirname(__FILE__) . '/functional.php';

class Formatter {

    function __construct() {
        $this->functional = new Functional();
        $this->CI = & get_instance();
        $this->CI->load->model('dashboard_model');
    }

    //put your code here
    function donut($data) {
        $result = "";

        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $row) {

                $strKey = "{name:'" . $row['referral_name'] . "',";
                $strValue = 'y:' . $row['jumlah'] . '},';
                $item = $strKey . $strValue;
                $result .= $item;
            }
        } else {
            $result = '{name: "NO RESULT", y: 10},';
        }
        return substr($result, 0, strlen($result) - 1);
    }

    function cluster($data) {
        $list = array();
        $idx = 0;
        $result = "";
        $outter_item = "";
        $fix_result = "";
        $count_cluster = 0;
        $result .= '{
                    "name": "",
                    "children": [';
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            $item = "";
            foreach ($data->result_array() as $row) {
                $referral_code = $row['referral_code'];
                $referral_name = $row['referral_name'];
                $name = $row['name'];
                $jumlah = $row['jumlah'];
                if (!in_array($referral_name, $list)) {
                    $list[$idx] = $referral_name;
                    if ($idx > 0) {
                        $result .= '{
                                "name": "' . $list[$idx - 1] . '",
                                "children": [';
                        $item = substr($item, 0, strlen($item) - 1);
                        $inner_item = $item . ']},';
                        $result .= $inner_item;
                    }

                    $item = "";
                    $idx++;
                    $count_cluster = $idx;
                }
                $item .= '{
                            "name": "' . $name . '",
                            "size": ' . $jumlah . '
                        },';
            }
        } else {
            $result .= '{
                        "name": "Default Cluster",
                        "children": [
                            {
                                "name": "NO RESULT",
                                "size": 10
                            }
                        ]
                    },';
        }
        if ($count_cluster == 1) {
            $item = substr($item, 0, strlen($item) - 1);
            $inner_item = $item . ']},';
            $result .= $inner_item;
            $outter_item = substr($result, 0, strlen($result) - 1);
            $fix_result = $outter_item;
        } else if ($count_cluster >= 1) {
            $outter_item = substr($result, 0, strlen($result) - 1);
            $fix_result = $outter_item . ']}';
        }
        return $fix_result;
    }

    function ontology1($data) {
        $list = array();
        $result = "";
        $idx = 0;
        $jdx = 0;

        $result .= "source,target,value,groupsource,grouptarget\n";
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                // outpout flght_from , flught_to, jumlah
                $flight_from = $row["flight_from"];
                $flight_to = $row["flight_to"];
                $jumlah = $row["jumlah"];
                if (!in_array($flight_from, $list)) {
                    $list[$idx] = $flight_from;
                    $idx++;
                    $result .= "[C] $flight_from , $flight_to , 1 , $idx , $idx\n";
                } else {
                    if ($jdx <= 2) {
                        $result .= "[C] $flight_from , $flight_to , 1 , $idx , $idx\n";
                    } else if ($jdx > 3) {
                        $jdx = 0;
                    }
                    $jdx++;
                }
//                print all result in array
//                $result .= "$flight_from , $flight_to , 1 , $idx , $idx\n";
            }
        } else {
            $result .= "No Result , None , 1 , 1 , 1";
        }
        return $result;
    }

    function ontology($data) {
        $list = array();
        $result = "";
        $idx = 0;

        $list_departure = array();
        $list_arrival = array();
        $str_departure = array();
        $str_arrival = array();
        $ldx = 0;
        $lax = 0;
        $item = "";
        $jdx = 0;

        // init all value
        $result .= "source,target,value,groupsource,grouptarget\n";
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $flight_from = $row["flight_from"];
                $flight_to = $row["flight_to"];
                $jumlah = $row["jumlah"];

                $item_from = strtolower($flight_from);
                $item_to = strtolower($flight_to);
                $item = "$item_from $item_to";
                $item_reverse = "$item_to $item_from";

                // check when data in array
                if (!in_array($item_reverse, $list)) {
                    $list[$idx] = $item;
                    $list_arrival[$lax] = $item;
                    //$str_arrival[$lax] = '"' . $flight_from . '", "' . $flight_to . '", ' . $jumlah;
                    $result .= "[A] $flight_from , $flight_to , 1 , $idx , $idx\n";
//                    echo "[A] $flight_from , $flight_to , $jumlah </br>";
                    $lax++;
                    $idx++;
                } else {
                    $list_departure[$ldx] = $item_reverse;
                    $str_departure[$ldx] = $jumlah;
                    if ($jdx <= 2) {
                        $result .= "[D] $flight_from , $flight_to , 1 , $idx , $idx\n";
                    } else if ($jdx > 3) {
                        $jdx = 0;
                    }
                    $jdx++;

//                    echo "[D] $flight_from , $flight_to , $jumlah </br>";
                    $ldx++;
                }
//                echo "$flight_from , $flight_to , $jumlah </br>";
            }
        } else {
            $result .= "No Result , None , 1 , 1 , 1";
        }
        return $result;
    }

    function chord($data) {
        $list = array();
        $result = "";
        $idx = 0;

        $list_departure = array();
        $list_arrival = array();
        $str_departure = array();
        $str_arrival = array();
        $ldx = 0;
        $lax = 0;
        $item = "";

        // init all value
        $result .= "year,importer1,importer2,flow1,flow2\n";
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $flight_from = $row["flight_from"];
                $flight_to = $row["flight_to"];
                $jumlah = $row["jumlah"];

                $item_from = strtolower($flight_from);
                $item_to = strtolower($flight_to);
                $item = "$item_from $item_to";
                $item_reverse = "$item_to $item_from";

                // check when data in array
                if (!in_array($item_reverse, $list)) {
                    $list[$idx] = $item;
                    $list_arrival[$lax] = $item;
                    $str_arrival[$lax] = '"' . $flight_from . '", "' . $flight_to . '", ' . $jumlah;
//                    echo "[A] $flight_from , $flight_to , $jumlah </br>";
                    $lax++;
                    $idx++;
                } else {
                    $list_departure[$ldx] = $item_reverse;
                    $str_departure[$ldx] = $jumlah;
//                    echo "[D] $flight_from , $flight_to , $jumlah </br>";
                    $ldx++;
                }
//                echo "$flight_from , $flight_to , $jumlah </br>";
            }

            // validate between departure and arrival
            foreach ($list_arrival as $value) {
                if (in_array($value, $list_departure)) {
                    $key_departure = array_search($value, $list_departure);
                    $key_arrival = array_search($value, $list_arrival);
                    $result .= "0, $str_arrival[$key_arrival], $str_departure[$key_departure]\n";
                }
            }
        } else {
            $result .= '0,"NO RESULT","NONE",1,0';
        }
        return $result;
    }

    function heatmap($data) {
        $list = array();
        $result = array();
        $output = "";
        $idx = 0;
        $min_year = 0;
        $max_year = 0;

        $output .= "Date,Open\n";
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $idx++;
                $create_date = $row["create_date"];
                $jumlah = $row["jumlah"];

                $date = array();
                $date = explode("-", $create_date);
                $year = $date[0];
                $output .= "$create_date, $jumlah\n";
                if ($idx == 1) {
                    $min_year = $year;
                }
                if ($idx == $count_data) {
                    $max_year = $year + 1;
                }
            }
        } else {
            $output .= '2014-01-01';
            $min_year = '2014';
            $max_year = '2015';
        }
        $result['output'] = $output;
        $result['min_year'] = $min_year;
        $result['max_year'] = $max_year;
        return $result;
    }

    function heatmap_hour($data) {
        $list = array();
        $result = array();
        $output = "";
        $idx = 0;
        $min_year = 0;
        $max_year = 0;

        $output .= "Date,Time,Temperature\n";
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $idx++;
                $create_date = $row["create_date"];
                $hour = $row["hour"];
                $jumlah = $row["jumlah"];

                $date = array();
                $date = explode("-", $create_date);
                $year = $date[0];
                $output .= "$create_date, $hour, $jumlah\n";
                if ($idx == 1) {
                    $min_year = $year;
                }
                if ($idx == $count_data) {
                    $max_year = $year + 1;
                }
            }
        } else {
            $output .= '2014-01-01';
            $min_year = '2014';
            $max_year = '2015';
        }
        $result['output'] = $output;
        $result['min_year'] = $min_year;
        $result['max_year'] = $max_year;
        return $result;
    }

    function cloud($data, $mode) {
        $output = "";
        $result = "";

        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                //$idx++;

                $jumlah = $row["jumlah"];
                $jumlah = $this->functional->get_weight($jumlah);
                if ($mode == "1") {
                    $flight_from = $row["flight_from"];
                    $flight_to = $row["flight_to"];
                    $output .= '{text:"#' . $flight_from . '-' . $flight_to . '",weight:' . $jumlah . '},';
                } else if (($mode == "2") || ($mode == "3")) {
                    $item = $row["item"];
                    $output .= '{text:"#' . $item . '",weight:' . $jumlah . '},';
                }
            }
        } else {
            $output .= '{text:"NO RESULT",weight: 10},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function cloud_flight($data) {
        // init all value into variable
        $list = array();
        $result = "";
        $idx = 0;
        $jdx = 0;

        // init all value into array
        $output = array();
        $result = "";
        $result_reverse = "";
        // get data count from another data source
        $count_data = $data->num_rows();
        // validate when datas exist or != 0
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $flight_from = $row["flight_from"];
                $flight_to = $row["flight_to"];
                $jumlah = $this->functional->get_weight($row["jumlah"]);

                $item_from = strtolower($flight_from);
                $item_to = strtolower($flight_to);
                $item = "$item_from $item_to";
                $item_reverse = "$item_to $item_from";

                // check when data in array
                if (!in_array($item_reverse, $list)) {
                    $list[$idx] = $item;
                    // arrival
                    //if($idx<=$count_data)
                    $result .= '{text:"#' . $flight_from . '-' . $flight_to . '",weight:' . $jumlah . '},';
                    $idx++;
                } else {
                    // departure
                    //if($jdx<=$count_data)
                    $result_reverse .= '{text:"#' . $flight_from . '-' . $flight_to . '",weight:' . $jumlah . '},';
                    $jdx++;
                }
            }
        } else {
            $result .= '{text:"NO RESULT",weight: 10},';
            $result_reverse .= '{text:"NO RESULT",weight: 10},';
        }
        // assign arrival and departure tag into array
        $output["result"] = substr($result, 0, strlen($result) - 1);
        $output["result_reverse"] = substr($result_reverse, 0, strlen($result_reverse) - 1);
        // return the arrival and departure tag
        return $output;
    }

    function funnel($data, $mode) {
        /* input: ['Website visits', 15654],['Downloads', 4064], */
        $output = "";
        $result = "";

        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                // 1 = status; 2 = reason
                $item = "";
                $jumlah = $row["jumlah"];
                if ($mode == "1") {
                    $item = $row["status"];
                } else if ($mode == "2") {
                    $item = $row["reason"];
                }
                $output .= '["' . $item . '", ' . $jumlah . '],';
            }
        } else {
            $output .= '["NO RESULT", 10],';
        }
        $result = substr($output, 0, strlen($output) - 1);
        return $result;
    }

    function adv_donut($data, $mode) {
        /* chart input:
          {label: "Download Sales", value: 12},
          {label: "In-Store Sales", value: 30},
          {label: "Mail-Order Sales", value: 20}
         *          
         * color input:
          "#3c8dbc", "#f56954", "#00a65a"
         *          */
        $output = "";
        $result = "";
        $output_color = "";
        $result_color = "";

        $count_data = $data->num_rows();
        if ($count_data > 0) {
            //contruct the data chart
            foreach ($data->result_array() as $row) {
                // 1 = status; 2 = reason
                $item = $row["type"];
                $jumlah = $row["jumlah"];
                $output .= '{label: "' . $item . '", value: ' . $jumlah . '},';
            }

            // construct color mode
            for ($i = 1; $i <= $count_data; $i++) {
                $color = $this->functional->random_color();
                $output_color .= '"' . $color . '",';
            }
        } else {
            $output .= '{label: "NO RESULT", value: 20},';
            $output_color .= '"#3c8dbc",';
        }
        $result = substr($output, 0, strlen($output) - 1);
        $result_color = substr($output_color, 0, strlen($output_color) - 1);

        // define all return value
        $res = array();
        $res["donut_data"] = $result;
        $res["donut_color"] = $result_color;
        return $res;
    }

    function area_dimension($data, $mode) {
        /*  data: 
         * {y: '2011 Q2', item1: 2778, item2: 0},
         * labels:
         * 'Item 1', 'Item 2', 'Item 3'
         * color:
         * '#a0d0e0', '#3c8dbc', '#00ff00'
         *  */
        $list_quater = array();
        $list_type = array();
        $list_item = array();

        // init all variable
        $idx = 0;
        $itdx = 0;
        $tdx = 0;
        $output = "";
        $result = "";
        $output_labels = "";
        $result_labels = "";
        $output_color = "";
        $result_color = "";

        // define all formatter process
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            $output_wrapper = "";
            $output_container = "";
            foreach ($data->result_array() as $row) {
                $year = $row["year"];
                $quarter = $row["quarter"];
                $type = $row["type"];
                $jumlah = $row["jumlah"];
                $item = "$year Q$quarter";

                $output_container .= "$type: $jumlah,";
                if (!in_array($item, $list_item)) {
                    $list_item[$itdx] = $item;
                    if ($itdx != 0) {
                        $fix_container = substr($output_container, 0, strlen($output_container) - 1);
                        $output_wrapper = "{y: '$list_item[$itdx]', $fix_container},";
                        $output .= $output_wrapper;
                        $output_container = "";
                    } else {
                        $fix_container = substr($output_container, 0, strlen($output_container) - 1);
                        $output_wrapper = "{y: '$list_item[$itdx]', $fix_container},";
                        $output .= $output_wrapper;
                        $output_container = "";
                    }
                    $itdx++;
                }
                $list_type[$tdx] = $type;
                $idx++;
                $tdx++;
            }

            $jdx = 0;
            $list_type1 = array_values(array_unique($list_type));
            $count_type = count($list_type1);

            for ($i = 0; $i < $count_type; $i++) {
                $color = $this->functional->random_color();
                $output_color .= '"' . $color . '",';
                $output_labels .= '"' . $list_type1[$jdx] . '",';
                $jdx++;
            }
        } else {
            $output .= "{y: '2011 Q1', item1: 0},";
            $output_color .= "'#a0d0e0',";
            $output_labels .= "'NO RESULT',";
        }
        $result = substr($output, 0, strlen($output) - 1);
        $result_color = substr($output_color, 0, strlen($output_color) - 1);
        $result_labels = substr($output_labels, 0, strlen($output_labels) - 1);

        $res = array();
        $res["area_data"] = $result;
        $res["area_color"] = $result_color;
        $res["area_labels"] = $result_labels;
        return $res;
    }

    function bar_quarter($data, $mode) {
        /*  data: 
         * {y: '2011 Q2', item1: 2778, item2: 0},
         * labels:
         * 'Item 1', 'Item 2', 'Item 3'
         * color:
         * '#a0d0e0', '#3c8dbc', '#00ff00'
         *  */
        $list_quater = array();
        $list_type = array();
        $list_item = array();

        // init all variable
        $idx = 0;
        $itdx = 0;
        $tdx = 0;
        $output = "";
        $result = "";
        $output_labels = "";
        $result_labels = "";
        $output_color = "";
        $result_color = "";

        // define all formatter process
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            $output_wrapper = "";
            $output_container = "";
            foreach ($data->result_array() as $row) {
                $year = $row["year"];
                $quarter = $row["quarter"];
                $type = $row["group_name"];
                $jumlah = $row["jumlah"];
                //$item = "$year Q$quarter";
                $item = "$year";

                $output_container .= "$type: $jumlah,";
                if (!in_array($item, $list_item)) {
                    $list_item[$itdx] = $item;
                    if ($itdx != 0) {
                        $fix_container = substr($output_container, 0, strlen($output_container) - 1);
                        $output_wrapper = "{y: '$list_item[$itdx]', $fix_container},";
                        $output .= $output_wrapper;
                        $output_container = "";
                    } else {
                        $fix_container = substr($output_container, 0, strlen($output_container) - 1);
                        $output_wrapper = "{y: '$list_item[$itdx]', $fix_container},";
                        $output .= $output_wrapper;
                        $output_container = "";
                    }
                    $itdx++;
                }
                $list_type[$tdx] = $type;
                $idx++;
                $tdx++;
            }

            $jdx = 0;
            $list_type1 = array_values(array_unique($list_type));
            $count_type = count($list_type1);

            for ($i = 0; $i < $count_type; $i++) {
                $color = $this->functional->random_color();
                $output_color .= '"' . $color . '",';
                $output_labels .= '"' . $list_type1[$jdx] . '",';
                $jdx++;
            }
        } else {
            $output .= "{y: '2011 Q1', item1: 0},";
            $output_color .= "'#a0d0e0',";
            $output_labels .= "'NO RESULT',";
        }
        $result = substr($output, 0, strlen($output) - 1);
        $result_color = substr($output_color, 0, strlen($output_color) - 1);
        $result_labels = substr($output_labels, 0, strlen($output_labels) - 1);

//        echo $result . "</br>";
//        echo $result_color . "</br>";
//        echo $result_labels . "</br>";
        $res = array();
        $res["bar_data"] = $result;
        $res["bar_color"] = $result_color;
        $res["bar_labels"] = $result_labels;
        return $res;
    }

    function legend_donut($data) {
        /* {value: 700,color: "#f56954",highlight: "#f56954",label: "Chrome"}, */
        $result = "";
        $output = "";
        $count_data = $data->num_rows();
        if ($count_data > 0) {
            foreach ($data->result_array() as $row) {
                $referral = $row["referral"];
                $jumlah = $row["jumlah"];
                $color = $this->functional->random_color();
                $output .= '{value: ' . $jumlah . ', color: "' . $color . '", highlight: "' . $color . '", label: "' . $referral . '"},';
            }
        } else {
            $output = '{value: 10,color: "#f56954",highlight: "#f56954",label: "NO RESULT"},';
        }
        $result = substr($output, 0, strlen($output) - 1);
//        echo $result;
        return $result;
    }

    function pie_drilldown($data, $mode, $range_date) {
        /* pie level 0: {name: "Microsoft Internet Explorer",y: 56.33,drilldown: "Microsoft Internet Explorer"}, */
        /* pie level 1: 
         * {
          name: "Microsoft Internet Explorer",
          id: "Microsoft Internet Explorer",
          data: [["v11.0", 24.13],
          ["v8.0", 17.2],
          ["v9.0", 8.11],
          ["v10.0", 5.33],
          ["v6.0", 1.06],
          ["v7.0", 0.5]
          ]
          },
         */

        $list = array();

        $result = "";
        $output = "";
        $result_drilldown = "";
        $output_drilldown = "";

        $count_data = $data->num_rows();
        if ($count_data > 0) {
            $idx = 0;
            foreach ($data->result_array() as $row) {
                $referral = $row["referral"];
                $jumlah = $row["jumlah"];
                $list[$idx] = $referral;
                $output .= '{name: "' . $referral . '", y: ' . $jumlah . ', drilldown: "' . $referral . '"},';
                $idx++;
            }
            $count_list = count($list);
            $s_output_drilldown = null;
            for ($jdx = 0; $jdx < $count_list; $jdx++) {
                $referral_item = $list[$jdx];
                $group_referral = $this->CI->dashboard_model->referral_group_manual($referral_item, $mode, $range_date);
                $s_output_drilldown .= "{name: '$referral_item', id: '$referral_item', data:[";
                $kdx = 0;
                $temp_drilldown = "";
                foreach ($group_referral->result_array() as $row) {
                    $s_name = $row["name"];
                    $s_referral = $row["referral"];
                    $s_jumlah = $row["jumlah"];
                    $temp_drilldown .= "['$s_name',$s_jumlah],";
                    $kdx++;
                    if ($kdx == 8)
                        break;
                }
                $s_output_drilldown .= substr($temp_drilldown, 0, strlen($temp_drilldown) - 1);
                $s_output_drilldown .= "]},";
            }
//            echo '</br>';
//            echo $s_output_drilldown;
        } else {
            $output = '{name: "NO RESULT",y: 0,drilldown: "NO RESULT"},';
            $output_drilldown = '{name: "NO RESULT", id: "NO RESULT", data: [["NO RESULT",0]]},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        $result_drilldown = substr($s_output_drilldown, 0, strlen($s_output_drilldown) - 1);
        // in debug mode
//        echo $result;
//        echo "</br>======================================</br>";
//        echo $result_drilldown;

        $res = array();
        $res["pie"] = $result;
        $res["pie_drilldown"] = $result_drilldown;
        return $res;
    }

    function bar_drilldown($data, $mode, $range_date) {
        /* pie level 0: {name: "Microsoft Internet Explorer",y: 56.33,drilldown: "Microsoft Internet Explorer"}, */
        /* pie level 1: 
         * {
          name: "Microsoft Internet Explorer",
          id: "Microsoft Internet Explorer",
          data: [["v11.0", 24.13],
          ["v8.0", 17.2],
          ["v9.0", 8.11],
          ["v10.0", 5.33],
          ["v6.0", 1.06],
          ["v7.0", 0.5]
          ]
          },
         */

        $list = array();

        $result = "";
        $output = "";
        $result_drilldown = "";
        $output_drilldown = "";

        $count_data = $data->num_rows();
        if ($count_data > 0) {
            $idx = 0;
            foreach ($data->result_array() as $row) {
                $referral = $row["paid_method"];
                $jumlah = $row["jumlah"];
                $list[$idx] = $referral;
                $output .= '{name: "' . $referral . '", y: ' . $jumlah . ', drilldown: "' . $referral . '"},';
                $idx++;
            }
            $count_list = count($list);
            $s_output_drilldown = null;
            for ($jdx = 0; $jdx < $count_list; $jdx++) {
                $referral_item = $list[$jdx];
                $group_referral = $this->CI->dashboard_model->transaction_paid_method_group_manual($referral_item, $mode, $range_date);
                $s_output_drilldown .= "{name: '$referral_item', id: '$referral_item', data:[";
                $kdx = 0;
                $temp_drilldown = "";
                foreach ($group_referral->result_array() as $row) {
                    $s_name = $row["name"];
                    $s_referral = $row["paid_method"];
                    $s_jumlah = $row["jumlah"];
                    $temp_drilldown .= "['$s_name',$s_jumlah],";
                    $kdx++;
                    if ($kdx == 8)
                        break;
                }
                $s_output_drilldown .= substr($temp_drilldown, 0, strlen($temp_drilldown) - 1);
                $s_output_drilldown .= "]},";
            }
//            echo '</br>';
//            echo $s_output_drilldown;
        } else {
            $output = '{name: "NO RESULT",y: 0,drilldown: "NO RESULT"},';
            $output_drilldown = '{name: "NO RESULT", id: "NO RESULT", data: [["NO RESULT",0]]},';
        }
        $result = substr($output, 0, strlen($output) - 1);
        $result_drilldown = substr($s_output_drilldown, 0, strlen($s_output_drilldown) - 1);
        // in debug mode
//        echo $result;
//        echo "</br>======================================</br>";
//        echo $result_drilldown;

        $res = array();
        $res["bar"] = $result;
        $res["bar_drilldown"] = $result_drilldown;
        return $res;
    }

    

}
