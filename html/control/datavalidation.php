<?php
class DataValidation
{
    private $db_cnn_token;
    function __construct($tk)
    {
        $this->db_cnn_token = $tk;
    }


    //user email validation
    function emailValidate($email)
    {

        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //user phone number validation
    function phoneNumberValidate($phone)
    {
        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            if (preg_match('/^[0-9]{10}+$/', $phone)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    //user data sanitize
    function sanitize($data)
    {
        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            $data = str_replace('%', '', $data);
            $data = str_replace('#', '', $data);
            $data = str_replace("'", '', $data);
            $data = str_replace('"', '', $data);
            $data = str_replace('`', '', $data);
            $data = str_replace('/', '', $data);
            $data = str_replace(';', '', $data);
            $data = str_replace('(', '', $data);
            $data = str_replace(')', '', $data);
            $data = str_replace('=', '', $data);
            $data = str_replace('&', '', $data);
            $data = str_replace('|', '', $data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        } else {
            return false;
        }
    }

    //Login token generator
    function gentoken($user_id)
    {
        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            $randNum = round(microtime(true) * 1000) .$user_id. rand(1000, 999999999999999);
            $md5 = hash('md5', $randNum);
            return $md5;
        } else {
            return false;
        }
    }

    //Generate refer id 8 char length
    function genReferId($phone)
    {
        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            $crc32b = hash('crc32b', $phone);
            return $crc32b;
        } else {
            return false;
        }
    }

    //user id genrate
    function userIdGen($phone)
    {
        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            $crc32 = hash('crc32', $phone);
            return $crc32;
        } else {
            return false;
        }
    }


    //Generate checksum from puzzle
    function genCheckSum($puzzle)
    {
        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            $sha384 = hash('sha384', $puzzle);
            $sha256 = hash('sha256', $sha384);
            return $sha256;
        } else {
            return false;
        }
    }



    //password hashing alogo
    function hashPass($pass)
    {
        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            $md5 = hash('md5', $pass);
            $sha256 = hash('sha256', $md5);
            $ripemd256 = hash('ripemd256', $sha256);
            $gost = hash('gost', $ripemd256);
            return $gost;
        } else {
            return false;
        }
    }


    //Login password for fontend
    function genFontendPass($plan_pass)
    {
        if ($this->db_cnn_token == "aj2M31ds@JKbf&873") {
            $md5 = hash('md5', $plan_pass);
            return $md5;
        } else {
            return false;
        }
    }
}
