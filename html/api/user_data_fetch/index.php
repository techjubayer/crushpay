<?php

require("../../control/datavalidation.php");
require("../../control/db_config.php");


class UserDataFetch
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function fetchUserData($conn, $user_id, $email_phone, $token)
    {
        if ($this->classKey == "KbfaJOEnt48hnq6S1ds@f8Je4c") {
            $query = "SELECT `user_name`, `balance`, `profit`, `today_profit`, `usr_status`, `margins` FROM `crushpay_users` WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone)  AND `user_id` = :user_id_ AND  `token` = :token_";
            $data = $conn->prepare($query);
            $data->execute([
                'email_phone' => $email_phone,
                'user_id_' => $user_id,
                'token_' => $token
            ]);
            $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function fetchUserMargin($conn, $user_id, $email_phone, $token)
    {
        if ($this->classKey == "KbfaJOEnt48hnq6S1ds@f8Je4c") {
            $query = "SELECT `user_name`, `balance`, `profit`, `user_phone`, `usr_status` FROM `crushpay_users` WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone)  AND `user_id` = :user_id_ AND  `token` = :token_";
            $data = $conn->prepare($query);
            $data->execute([
                'email_phone' => $email_phone,
                'user_id_' => $user_id,
                'token_' => $token
            ]);
            $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

$response_array = array();

if (isset($_POST['what'])) {
    if (isset($_POST['phone_email'])) {
        if (isset($_POST['user_token'])) {
            if (isset($_POST['user_id'])) {


                $data_validation_token = "aj2M31ds@JKbf&873";
                $DataValidation = new DataValidation($data_validation_token);

                $email_phone = $DataValidation->sanitize($_POST['phone_email']);
                $token = $DataValidation->sanitize($_POST['user_token']);
                $user_id = $DataValidation->sanitize($_POST['user_id']);
                $what = $DataValidation->sanitize($_POST['what']);

                $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");

                $UserDataFetch = new UserDataFetch("KbfaJOEnt48hnq6S1ds@f8Je4c");
                switch ($what) {
                    case "balance":
                        $fetchUserData = $UserDataFetch->fetchUserData($conn, $user_id, $email_phone, $token);
                        if ($fetchUserData) {
                            $response_array['response'] = true;
                            $response_array['user_name'] = $fetchUserData['user_name'];
                            $response_array['balance'] = $fetchUserData['balance'];
                            $response_array['profit'] = $fetchUserData['profit'];
                            $response_array['today_profit'] = $fetchUserData['today_profit'];
                            $response_array['usr_status'] = $fetchUserData['usr_status'];
                            $response_array['margins'] = json_decode($fetchUserData['margins'], true);
                        } else {
                            $response_array['response'] = false;
                            $response_array['message'] = "Error 406 : Something went wrong, please try again";
                        }
                        break;
                    case "profile_balance":
                        $fetchUserMargin = $UserDataFetch->fetchUserMargin($conn, $user_id, $email_phone, $token);
                        if ($fetchUserMargin) {
                            $response_array['response'] = true;
                            $response_array['user_name'] = $fetchUserMargin['user_name'];
                            $response_array['balance'] = $fetchUserMargin['balance'];
                            $response_array['profit'] = $fetchUserMargin['profit'];
                            $response_array['usr_status'] = $fetchUserMargin['usr_status'];
                            $response_array['user_phone'] = $fetchUserMargin['user_phone'];
                        } else {
                            $response_array['response'] = false;
                            $response_array['message'] = "Error 406 : Something went wrong, please try again";
                        }
                        break;
                    default:
                        $response_array['response'] = false;
                        $response_array['message'] = "Error 405 : Something went wrong, please try again";
                        break;
                }

                $conn = null;
            } else {
                $response_array['response'] = false;
                $response_array['message'] = "Error 404 : Something went wrong, please try again";
            }
        } else {
            $response_array['response'] = false;
            $response_array['message'] = "Error 403 : Something went wrong, please try again";
        }
    } else {
        $response_array['response'] = false;
        $response_array['message'] = "Error 402 : Something went wrong, please try again";
    }
} else {
    $response_array['response'] = false;
    $response_array['message'] = "Error 401 : Something went wrong, please try again";
}




echo json_encode($response_array);
