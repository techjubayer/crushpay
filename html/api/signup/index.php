<?php

// For SignUp ------ temp user create and OTP sender to validate phone number

require("../../control/datavalidation.php");
require("../../control/db_config.php");
require("../../control/opt_sender.php");

date_default_timezone_set('Asia/Kolkata');

class UserValidation
{

    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }


    function checkEmailPhone($conn, $email, $phone)
    {
        if ($this->classKey == "6SJlOEntehGlahnqge4c") {
            $query = "SELECT `user_email`, `user_phone` FROM `crushpay_users` WHERE `user_email`= :email OR `user_phone`= :phone";
            $data = $conn->prepare($query);
            $data->execute(['email' => $email, 'phone' => $phone]);
            $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() == 0) {
                return false;   //Phone and Email not registered
            } else {
                if ($result['user_phone'] == $phone) {
                    return "Phone number already registered with different account";
                } else if ($result['user_email'] == $email) {
                    return "Email address already registered with different account";
                }
            }
        } else {
            return "Something went wrong, please try again";
        }
    }

    function checkDevice($conn, $device_id)
    {
        if ($this->classKey == "6SJlOEntehGlahnqge4c") {
            $query = "SELECT `device_id` FROM `crushpay_users` WHERE `device_id`= :android_id";
            $data = $conn->prepare($query);
            $data->execute(['android_id' => $device_id]);
            if (($data->rowCount()) == 0) {
                return false;   //Device not registered with any account
            } else {
                return "Device already registered with another account";
            }
        } else {
            return "Something went wrong, please try again";
        }
    }

    function tempUserRegister($conn, $user_token, $user_id, $user_name, $phone, $email, $plane_pass, $pass, $device_id, $refer_code, $phone_otp)
    {
        if ($this->classKey == "6SJlOEntehGlahnqge4c") {
            $query = "INSERT INTO `temp_users` (
                `token`,
                `user_id`,
                `user_name`,
                `user_phone`,
                `user_email`,
                `plane_pass`,
                `password`,
                `device_id`,
                `refered_by`,
                `phone_otp`,
                `joining_date`) VALUES (
                    :user_token, 
                    :user_id_, 
                    :user_name_, 
                    :phone, 
                    :email, 
                    :plane_pass, 
                    :pass, 
                    :device_id, 
                    :refered_by, 
                    :phone_otp,
                    :joining_date)";

            $result = $conn->prepare($query);
            $response = $result->execute([
                'user_token' => $user_token,
                'user_id_' => $user_id,
                'user_name_' => $user_name,
                'phone' => $phone,
                'email' => $email,
                'plane_pass' => $plane_pass,
                'pass' => $pass,
                'device_id' => $device_id,
                'refered_by' => $refer_code,
                'phone_otp' => $phone_otp,
                'joining_date' => date("Y-m-d H:i:s")
            ]);

            if ($response) {
                return true;   //All resutls are insert successfully
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}




$response_array = array();


if (isset($_POST['user_name'])) {
    if (isset($_POST['user_phone'])) {
        if (isset($_POST['user_email'])) {
            if (isset($_POST['user_pass'])) {
                if (isset($_POST['plane_pass'])) {
                    if (isset($_POST['user_device_id'])) {
                        if (isset($_POST['cs'])) {
                            $data_validation_token = "aj2M31ds@JKbf&873";
                            $DataValidation = new DataValidation($data_validation_token);


                            $user_name = $DataValidation->sanitize($_POST['user_name']);
                            $user_phone = $DataValidation->sanitize($_POST['user_phone']);
                            $user_email = $DataValidation->sanitize($_POST['user_email']);
                            $plane_pass = $DataValidation->sanitize($_POST['plane_pass']);
                            $user_pass = $DataValidation->hashPass($_POST['user_pass']);
                            $user_device_id = $DataValidation->sanitize($_POST['user_device_id']);
                            $userCheckSum = $_POST['cs'];
                            $user_refer_code = null;


                            $puzzle = "2c21237d1" . $user_phone . "86587" . $user_device_id . "344134" . $plane_pass;
                            $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                            if ($userCheckSum == $genCheckSum) {

                                if ($DataValidation->phoneNumberValidate($user_phone)) {
                                    if ($DataValidation->emailValidate($user_email)) {

                                        $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                                        $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");

                                        $UserValidation = new UserValidation("6SJlOEntehGlahnqge4c");   //My inner class

                                        $checkEmailPhone = $UserValidation->checkEmailPhone($conn, $user_email, $user_phone);
                                        if (!$checkEmailPhone) {

                                            $user_refer_code = $DataValidation->sanitize(isset($_POST['user_refer_code']) ? $_POST['user_refer_code'] : null);
                                            if ($user_refer_code != null || $user_refer_code != "") {
                                                $checkDevice = $UserValidation->checkDevice($conn, $user_device_id);
                                                if ($checkDevice) {
                                                    $user_refer_code = null;
                                                }
                                            }
                                            $conn = null;

                                            $user_id = $DataValidation->userIdGen($user_phone);
                                            $user_token = $DataValidation->gentoken();
                                            $phone_otp = rand(1000, 9999);
                                            // $email_otp = rand(1000, 9999);



                                            $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_temp_db");
                                            $tempUserRegister = $UserValidation->tempUserRegister($conn, $user_token, $user_id, $user_name, $user_phone, $user_email, $plane_pass, $user_pass, $user_device_id, $user_refer_code, $phone_otp);

                                            if ($tempUserRegister) {

                                                $message = "Thank you for choosing Crush Pay digital payment. Your signup OTP is : " . $phone_otp . "\n This OTP is valid for 5 minutes";

                                                $OtpSender = new OtpSender("83aj2M%31ds@JKbf&");
                                                $send_phone_otp = $OtpSender->sendMobileOTP($user_phone, $message, "eN4Kxzt6wvXhm8IRtuPeAVCk1DJmJHGMolgg31Q9rcf6fSUHBsYUpbJ6P5qf");

                                                // $send_phone_otp = true;


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
                                            $response_array['message'] = $checkEmailPhone;
                                        }
                                    } else {
                                        $response_array['response'] = false;
                                        $response_array['message'] = "Something went wrong, please try again!";
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
} else {
    $response_array['response'] = false;
    $response_array['message'] = "Something went wrong, please try again!";
}


echo json_encode($response_array);
