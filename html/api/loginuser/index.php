<?php
// User login file
require("../../control/datavalidation.php");
require("../../control/db_config.php");

date_default_timezone_set('Asia/Kolkata');

class UserValidation
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function fetchUserData($conn, $email_phone, $password)
    {
        if ($this->classKey == "3545aehnq6SJOEnt487lge4c") {
            $query = "SELECT `user_id`, `user_phone`, `user_email` FROM `crushpay_users` WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone) AND `password` = :password_";
            $data = $conn->prepare($query);
            $data->execute([
                'email_phone' => $email_phone,
                'password_' => $password
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

    function updateToken($conn, $token, $email, $phone, $password)
    {
        if ($this->classKey == "3545aehnq6SJOEnt487lge4c") {
            $query = "UPDATE `crushpay_users` SET `token` = :token WHERE `user_email`= :email_ AND `user_phone`= :phone_ AND `password` = :password_";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'token' => $token,
                'email_' => $email,
                'phone_' => $phone,
                'password_' => $password
            ]);

            if ($response) {
                return true;
            } else {
                return false;
            }
        }
    }
}



$response_array = array();


if (isset($_POST['em_ph'])) {
    if (isset($_POST['pass'])) {
        if (isset($_POST['cs'])) {

            $data_validation_token = "aj2M31ds@JKbf&873";
            $DataValidation = new DataValidation($data_validation_token);
            $email_phone = $DataValidation->sanitize($_POST['em_ph']);
            $password = $DataValidation->hashPass($_POST['pass']);
            $userCheckSum = $DataValidation->sanitize($_POST['cs']);

            $puzzle = "2c21237d1" . $email_phone . "86JKb58fajds7";
            $genCheckSum =  $DataValidation->genCheckSum($puzzle);

            if ($userCheckSum == $genCheckSum) {



                $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");

                $UserValidation = new UserValidation("3545aehnq6SJOEnt487lge4c");
                $fetchUserData = $UserValidation->fetchUserData($conn, $email_phone, $password);
                if ($fetchUserData) {
                    $email = $fetchUserData['user_email'];
                    $phone = $fetchUserData['user_phone'];
                    $user_id = $fetchUserData['user_id'];
                    $user_token = $DataValidation->gentoken();

                    $updateToken = $UserValidation->updateToken($conn, $user_token, $email, $phone, $password);

                    if ($updateToken) {
                        $response_array['response'] = true;
                        $response_array['token'] = $user_token;
                        $response_array['user_id'] = $user_id;
                        $response_array['user_phone'] = $phone;
                    } else {
                        $response_array['response'] = false;
                        $response_array['message'] = "Something went wrong, please try again";
                    }
                } else {
                    $response_array['response'] = false;
                    $response_array['message'] = "Invalid user or password";
                }
                $conn = null;
            } else {
                $response_array['response'] = false;
                $response_array['message'] = "Something went wrong, please try again";
            }
        } else {
            $response_array['response'] = false;
            $response_array['message'] = "Something went wrong, please try again";
        }
    } else {
        $response_array['response'] = false;
        $response_array['message'] = "Something went wrong, please try again";
    }
} else {
    $response_array['response'] = false;
    $response_array['message'] = "Something went wrong, please try again";
}



echo json_encode($response_array);
