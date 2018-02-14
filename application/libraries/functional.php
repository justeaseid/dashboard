<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This class contain of all support fuction for development
 * @author : Parama_Fadli_Kurnia
 * Developer can make some additional code in this classs
 */
class Functional {
    /* validate gender by user input */

    function validate_gender($sex) {
        $is_male = "";
        $is_female = "";
        $profile_image = "";
        $gender = array();
        if ($sex == "male") {
            $profile_image = MAN;
            $is_male = "checked";
            $is_female = "";
        } else {
            $profile_image = WOMAN;
            $is_male = "";
            $is_female = "checked";
        }
        $gender["profile_image"] = $profile_image;
        $gender['is_male'] = $is_male;
        $gender['is_female'] = $is_female;
        return $gender;
    }

    /* encrypt data with base 64 */

    function encrypt($q) {
        //$cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
        //$qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        $qEncoded = base64_encode($q);
        return( $qEncoded );
    }

    /* decrypt data with base 64 */

    function decrypt($q) {
        //$cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
        //$qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        $qDecoded = base64_decode($q);
        return( $qDecoded );
    }

    /* get original value and then encrypt it before pass it */

    function encyrpt_profile($uri) {
        // get original value
        $email = $uri["email"];
        $password = $uri["password"];
        $name = $uri["name"];
        $role = $uri["role"];
        $access = $uri["access"];
        $date_created = $uri["date_created"];
        $sex = $uri["sex"];
        $check = $uri["check"];

        // sent value to new variable
        $enc_email = $this->encrypt($email);
        $enc_password = $this->encrypt($password);
        $enc_name = $this->encrypt($name);
        $enc_role = $this->encrypt($role);
        $enc_access = $this->encrypt($access);
        $enc_date_created = $this->encrypt($date_created);
        $enc_sex = $this->encrypt($sex);
        $enc_check = $this->encrypt($check);

        // get detail gender data
        $gender = array();
        $gender = $this->validate_gender($sex);

        // pass decrypted value
        $data = array();
        $data["email"] = $email;
        $data["password"] = $password;
        $data["name"] = $name;
        $data["role"] = $role;
        $data["access"] = $access;
        $data["date_created"] = $date_created;
        $data["sex"] = $sex;
        $data["profile_image"] = $gender["profile_image"];
        $data["is_male"] = $gender["is_male"];
        $data["is_female"] = $gender["is_female"];
        $data["url"] = $enc_email . '/' . $enc_password . '/' . $enc_name . '/' . $enc_role
                . '/' . $enc_access . '/' . $enc_date_created . '/' . $enc_sex . '/' . $enc_check;
        // return all value of data
        return $data;
    }

    /* get encrypted value and then decrypt it before pass it */

    function decrypt_profile($uri) {
        // get value from another function
        $enc_email = $uri["enc_email"];
        $enc_password = $uri["enc_password"];
        $enc_name = $uri["enc_name"];
        $enc_role = $uri["enc_role"];
        $enc_access = $uri["enc_access"];
        $enc_date_created = $uri["enc_date_created"];
        $enc_sex = $uri["enc_sex"];
        $enc_check = $uri["enc_check"];

        // sent value to new variable
        $email = $this->decrypt($enc_email);
        $password = $this->decrypt($enc_password);
        $name = $this->decrypt($enc_name);
        $role = $this->decrypt($enc_role);
        $access = $this->decrypt($enc_access);
        $date_created = $this->decrypt($enc_date_created);
        $sex = $this->decrypt($enc_sex);
        $check = $this->decrypt($enc_check);

        // init array value
        $data = array();
        $gender = array();
        $gender = $this->validate_gender($sex);

        // pass decrypted value
        $data["email"] = $email;
        $data["password"] = $password;
        $data["name"] = $name;
        $data["role"] = $role;
        $data["access"] = $access;
        $data["date_created"] = $date_created;
        $data["sex"] = $sex;
        $data["profile_image"] = $gender["profile_image"];
        $data["is_male"] = $gender["is_male"];
        $data["is_female"] = $gender["is_female"];
        $data["url"] = $enc_email . '/' . $enc_password . '/' . $enc_name . '/' . $enc_role
                . '/' . $enc_access . '/' . $enc_date_created . '/' . $enc_sex . '/' . $enc_check;
        return $data;
    }

    /* get url object */

    function mcurl($url, $data) {
        $result = "";
        $ch = curl_init($url . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /* get value from another form */

    function get_profile($uri) {
        // init data with array value
        $data = array();
        //$result = $this->functional->decrypt_profile($uri);
        $result = $this->decrypt_profile($uri);
        $data["email"] = $result["email"];
        $data["password"] = $result["password"];
        $data["name"] = $result["name"];
        $data["role"] = $result["role"];
        $data["access"] = $result["access"];
        $data["date_created"] = $result["date_created"];
        $data["sex"] = $result["sex"];
        $data["profile_image"] = $result["profile_image"];
        $data["is_male"] = $result["is_male"];
        $data["is_female"] = $result["is_female"];
        $data["url"] = $result["url"];
        return $data;
    }

    function save_to($session, $content, $file_type) {
        $myfile = fopen(DATA . $session . "." . $file_type, "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }

    function delete_file($session) {
        $json = DATA . $session . ".json";
        $csv = DATA . $session . ".csv";
        $prf = DATA . $session . ".prf";

        if (file_exists($prf))
            unlink($prf);
        if (file_exists($json))
            unlink($json);
        if (file_exists($csv))
            unlink($csv);
    }

    function read_file($session) {
        $user = "";
        $prf = DATA . $session . ".prf";
        $myfile = fopen($prf, "r") or die("Unable to open file!");
        $user = fgets($myfile);
        fclose($myfile);
        return $user;
    }

    function get_weight($data) {
        $val = 0;
        switch (true) {
            case ($data <= 20):
                $val = 18;
                break;
            case ($data > 20 && $data <= 40):
                $val = 20;
                break;
            case ($data > 40 && $data <= 60):
                $val = 22;
                break;
            case ($data > 60 && $data <= 80):
                $val = 24;
                break;
            case ($data > 80 && $data <= 100):
                $val = 26;
                break;
            case ($data > 100):
                $val = 28;
                break;
            default:
                $val = 15;
                break;
        }
        return $val;
    }

    // color picker part from our data
    function random_color() {
        $str = '#';
        for ($i = 0; $i < 6; $i++) {
            $randNum = rand(0, 15);
            switch ($randNum) {
                case 10: $randNum = 'A';
                    break;
                case 11: $randNum = 'B';
                    break;
                case 12: $randNum = 'C';
                    break;
                case 13: $randNum = 'D';
                    break;
                case 14: $randNum = 'E';
                    break;
                case 15: $randNum = 'F';
                    break;
            }
            $str .= $randNum;
        }
        return $str;
    }

    function date_between($date_init, $date_end) {
        $aryRange = array();
        $iDateFrom = mktime(1, 0, 0, substr($date_init, 5, 2), substr($date_init, 8, 2), substr($date_init, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($date_end, 5, 2), substr($date_end, 8, 2), substr($date_end, 0, 4));
        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom < $iDateTo) {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }

    function build_date() {
        $video = array();
        $photo = array();
        $link = array();
        $status = array();
        $offer = array();

        $list_video = array();
        $list_photo = array();
        $list_link = array();
        $list_status = array();
        $list_offer = array();

        $data_month = array();
        $list_month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $count_data = count($list_month);
        for ($i = 0; $i < $count_data; $i++) {
            if (in_array($list_month[$i], $data_month)) {
                $index = array_search($list_month[$i], $data_month);
                $list_video[$i] = $video[$index];
                $list_photo[$i] = $photo[$index];
                $list_link[$i] = $link[$index];
                $list_status[$i] = $status[$index];
                $list_offer[$i] = $offer[$index];
            } else {
                $list_video[$i] = 0;
                $list_photo[$i] = 0;
                $list_link[$i] = 0;
                $list_status[$i] = 0;
                $list_offer[$i] = 0;
            }
        }
        $str_video = implode(", ", $list_video);
        $str_link = implode(", ", $list_link);
        $str_photo = implode(", ", $list_photo);
        $str_status = implode(", ", $list_status);
        $str_offer = implode(", ", $list_offer);
    }

    function converter($date) {
        $result = "";
        if ($date == "01")
            $result = "Jan";
        else if ($date == "02")
            $result = "Feb";
        else if ($date == "03")
            $result = "Mar";
        else if ($date == "04")
            $result = "Apr";
        else if ($date == "05")
            $result = "Mei";
        else if ($date == "06")
            $result = "Jun";
        else if ($date == "07")
            $result = "Jul";
        else if ($date == "08")
            $result = "Aug";
        else if ($date == "09")
            $result = "Sep";
        else if ($date == "10")
            $result = "Oct";
        else if ($date == "11")
            $result = "Nov";
        else if ($date == "12")
            $result = "Dec";
        return $result;
    }

    function get_hashtags($string) {
//        $string = "#sukaOnline #OK #sukaOnline #parama #fadli #kurnia #iingria #parama #parama";
        $unique_word = array_unique(str_word_count(trim($string), 1));
        $unique_word_array = array_values($unique_word);
        $count = count($unique_word);
        $data = array();
        $output = array();

        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                $word = $unique_word_array[$i];
                $word_counter = substr_count($string, $word);
                $len_word = strlen($word);

                if ($len_word > 2) {
                    $input = array();
                    $input["ID"] = $i;
                    $input["key"] = $word;
                    $input["value"] = $word_counter;
                    $output[$i] = $input;
                }
            }
            # get a list of sort columns and their data to pass to array_multisort
            $sort = array();
            foreach ($output as $k => $v) {
                $sort['key'][$k] = $v['key'];
                $sort['value'][$k] = $v['value'];
            }
            # sort by event_type desc and then title asc
            array_multisort($sort['value'], SORT_DESC, $output);
        }

        return $output;
    }
    
    function make_token() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 24; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $str_pass = implode($pass);

        $numlink = '0123456789';
        $pass_numlink = array(); //remember to declare $pass as an array
        $numlinkLength = strlen($numlink) - 1; //put the length -1 in cache
        for ($i = 0; $i < 16; $i++) {
            $n = rand(0, $numlinkLength);
            $pass_numlink[] = $numlink[$n];
        }
        $str_numlink = implode($pass_numlink);
        $token = $str_pass . "|" . $str_numlink;
        $data = array();
        $data["tk_apps"] = $str_numlink;
        $data["tk_secret"] = $str_pass;
        $data["tk_token"] = $token;
        return $data; //turn the array into a string
    }

    function test() {
        $mylist = array(
            array('ID' => 0, 'key' => 'Boring Meeting', 'value' => 3),
            array('ID' => 1, 'key' => 'Find My Stapler', 'value' => 2),
            array('ID' => 2, 'key' => 'Mario Party', 'value' => 3),
            array('ID' => 3, 'key' => 'Duct Tape Party', 'value' => 1)
        );

        # get a list of sort columns and their data to pass to array_multisort
        $sort = array();
        foreach ($mylist as $k => $v) {
            $sort['key'][$k] = $v['key'];
            $sort['value'][$k] = $v['value'];
        }
        # sort by event_type desc and then title asc
        array_multisort($sort['value'], SORT_DESC, $mylist);
        print_r($mylist);
    }

    // check if key exist in array
    function validate($key, $array) {
        return (array_key_exists($key, $array) ? $array[$key] : "NULL");
    }

    function generate_date_query($field, $type, $prefix = "") {
        $total_day = "";
        $type = strtolower($type);
        if ($type == "today")
            $total_day = "1";
        else if ($type == "yesterday")
            $total_day = "2";
        else if ($type == "special")
            $total_day = "60";
        else if ($type == "week")
            $total_day = "7";
        else if ($type == "month")
            $total_day = "20";
        else if ($type == "year")
            $total_day = "360";
        $q = " $prefix DATE($field) BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL $total_day Day ) AND DATE_SUB( CURDATE( ) ,INTERVAL 0 Day )";
        
//        if ($type == "today")
//            $q .= " DATE(`mn_created_time`) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY))";
//        else if ($type == "week")
//            $q .= " DATE(`mn_created_time`) >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY 
//                AND DATE(`mn_created_time`) <= curdate()";
//        else if ($type == "month")
//            $q .= " DATE(`mn_created_time`) >= curdate() - INTERVAL DAYOFWEEK(curdate())+30 DAY 
//                AND DATE(`mn_created_time`) <= curdate()";
//        else if ($type == "year")
//            $q .= " DATE(`mn_created_time`) >= DATE_SUB(NOW(),INTERVAL 1 YEAR)";
        
        return $q;
    }

}
