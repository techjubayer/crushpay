<?php

date_default_timezone_set('Asia/Kolkata');

require("../var/db_config.php");

require("../control/datavalidation.php");
require("../control/db_config.php");
require("../control/opt_sender.php");

require("./auth.php");


$response_array = array();


if (isset($_POST['user_name'])) {
    if (isset($_POST['user_phone'])) {
        if (isset($_POST['user_email'])) {
            if (isset($_POST['user_pass'])) {
                if (isset($_POST['plane_pass'])) {
                    if (isset($_POST['cs'])) {
                        $data_validation_token = "aj2M31ds@JKbf&873";
                        $DataValidation = new DataValidation($data_validation_token);


                        $user_name = $DataValidation->sanitize($_POST['user_name']);
                        $user_phone = $DataValidation->sanitize($_POST['user_phone']);
                        $user_email = $DataValidation->sanitize($_POST['user_email']);
                        $plane_pass = $DataValidation->sanitize($_POST['plane_pass']);
                        $user_pass = $DataValidation->hashPass($_POST['user_pass']);
                        $userCheckSum = $DataValidation->sanitize($_POST['cs']);

                        $puzzle = "6JKb58fa2c21237d1" . $user_phone . "58fajds8fajds7";
                        $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                        if ($userCheckSum == $genCheckSum) {

                            if ($DataValidation->phoneNumberValidate($user_phone)) {

                                $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                                $conn = $DBConnection->dbConn(LOGED_OUT_USER, LOGED_OUT_USER_PASS, "crushpay_users");

                                $UserValidation = new UserValidation("6SJlOEntehGlahnqge4c");   //My inner class

                                if ($user_email != "") {
                                    if ($DataValidation->emailValidate($user_email)) {
                                        $checkNewEmail = $UserValidation->checkNewEmail($conn, $user_email);
                                        if ($checkNewEmail) {
                                            $response_array['response'] = false;
                                            $response_array['message'] = $checkNewEmail;
                                            echo json_encode($response_array);
                                            exit();
                                        }
                                    } else {
                                        $response_array['response'] = false;
                                        $response_array['message'] = "Invalid email, please enter valid email!";
                                    }
                                }

                                $checkNewPhone = $UserValidation->checkNewPhone($conn, $user_phone);
                                if (!$checkNewPhone) {

                                    $user_id = $DataValidation->userIdGen($user_phone);
                                    $user_token = $DataValidation->gentoken($user_id);
                                    $phone_otp = rand(100000, 999999);
                                    // $email_otp = rand(1000, 9999);

                                    $conn = $DBConnection->dbConn(NEW_USER, NEW_USER_PASS, "crushpay_temp_db");
                                    $tempUserRegister = $UserValidation->tempUserRegister($conn, $user_token, $user_id, $user_name, $user_phone, $user_email, $plane_pass, $user_pass, $phone_otp);

                                    if ($tempUserRegister) {

                                        $message = "Thank you for choosing Crush Pay recharge app. Your signup OTP is : " . $phone_otp . "\n This OTP is valid for 5 minutes";

                                        $OtpSender = new OtpSender("83aj2M%31ds@JKbf&");
                                        // $send_phone_otp = $OtpSender->sendMobileOTP($user_phone, $message, "eN4Kxzt6wvXhm8IRtuPeAVCk1DJmJHGMolgg31Q9rcf6fSUHBsYUpbJ6P5qf");

                                        $send_phone_otp = true;


                                        if ($send_phone_otp) {
                                            $response_array['response'] = true;
                                            $response_array['token'] = $user_token;
                                        } else {
                                            $response_array['response'] = false;
                                            $response_array['message'] = "Something went wrong, please try again!";
                                        }
                                    } else {
                                        $response_array['response'] = false;
                                        $response_array['message'] = "Something went wrong, please try again!";
                                    }
                                } else {
                                    $response_array['response'] = false;
                                    $response_array['message'] = $checkNewPhone;
                                }
                            } else {
                                $response_array['response'] = false;
                                $response_array['message'] = "Something went wrong, please try again!";
                            }
                            $conn = null;
                        } else {
                            $response_array['response'] = false;
                            $response_array['message'] = "Something went wrong, please try again!";
                        }
                    } else {
                        $response_array['response'] = false;
                        $response_array['message'] = "Something went wrong, please try again!";
                    }
                } else {
                    $response_array['response'] = false;
                    $response_array['message'] = "Something went wrong, please try again!";
                }
            } else {
                $response_array['response'] = false;
                $response_array['message'] = "Something went wrong, please try again!";
            }
        } else {
            $response_array['response'] = false;
            $response_array['message'] = "Something went wrong, please try again!";
        }
    } else {
        $response_array['response'] = false;
        $response_array['message'] = "Something went wrong, please try again!";
    }
} else {
    $response_array['response'] = false;
    $response_array['message'] = "Something went wrong, please try again!";
}


echo json_encode($response_array);
