<?php

//Reset pasword update in the user table

require("../../control/datavalidation.php");
require("../../control/db_config.php");
require("../../control/opt_sender.php");

date_default_timezone_set('Asia/Kolkata');

class ResetPass
{

    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function isValidToken($conn, $phone_number, $token)
    {
        if ($this->classKey == "62e6f010OEnt48735lge4c") {
            $query = "SELECT * FROM `otp_reset` WHERE `user_phone`= :user_phone AND `token2`= :token_ AND `status` = 'SUCCESS' AND `stage` = 'stage2'";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $phone_number,
                'token_' => $token
            ]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function resetPassword($conn, $pass, $phone)
    {
        if ($this->classKey == "62e6f010OEnt48735lge4c") {
            $query = "UPDATE `crushpay_users` SET `password` = :password_ WHERE `user_phone`= :phone";
            $result = $conn->prepare($query);
            $response = $result->execute(['password_' => $pass, 'phone' => $phone]);

            if ($response) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function fetchUserData($conn, $email_phone, $password)
    {
        if ($this->classKey == "62e6f010OEnt48735lge4c") {
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
        if ($this->classKey == "62e6f010OEnt48735lge4c") {
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
if (isset($_POST['pass'])) {
    if (isset($_POST['pp'])) {
        if (isset($_POST['token'])) {
            if (isset($_POST['cs'])) {
                if (isset($_POST['phone'])) {
                    $data_validation_token = "aj2M31ds@JKbf&873";
                    $DataValidation = new DataValidation($data_validation_token);   //My outer class
                    $pass = $DataValidation->hashPass($_POST['pass']);
                    $plan_pass = $DataValidation->sanitize($_POST['pp']);
                    $token = $DataValidation->sanitize($_POST['token']);
                    $phone_number = $DataValidation->sanitize($_POST['phone']);
                    $checksum = $DataValidation->sanitize($_POST['cs']);


                    $puzzle = "6f010OEnt487" . $plan_pass . "860OEnt87" . $token . "340OEnt34" . $phone_number;
                    $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                    if ($checksum == $genCheckSum) {


                        $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                        $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_temp_db");

                        $ResetPass = new ResetPass("62e6f010OEnt48735lge4c");
                        $isValidToken = $ResetPass->isValidToken($conn, $phone_number, $token);
                        $conn = null;

                        if ($isValidToken) {
                            $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");

                            $resetPassword = $ResetPass->resetPassword($conn, $pass, $phone_number);


                            if ($resetPassword) {
                                $fetchUserData = $ResetPass->fetchUserData($conn, $phone_number, $pass);

                                if ($fetchUserData) {
                                    $email = $fetchUserData['user_email'];
                                    $phone = $fetchUserData['user_phone'];
                                    $user_id = $fetchUserData['user_id'];
                                    $user_token = $DataValidation->gentoken();

                                    $updateToken = $ResetPass->updateToken($conn, $user_token, $email, $phone, $pass);

                                    if ($updateToken) {
                                        $response_array['response'] = true;
                                        $response_array['token'] = $user_token;
                                        $response_array['user_id'] = $user_id;
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
