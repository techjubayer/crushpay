<?php

// SignUp -------- OTP Validation and Final user registation

date_default_timezone_set('Asia/Kolkata');

require("../../../control/datavalidation.php");
require("../../../control/db_config.php");
require("../../../control/contact_details.php");


class UserValidation
{

    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }


    function temp_usersFetch($conn, $email, $phone, $user_token)
    {
        if ($this->classKey == "OEntehGlah6SJlnqge4c") {
            $query = "SELECT * FROM `temp_users` WHERE `token`= :token AND `user_phone`= :user_phone AND `user_email` = :user_email";
            $data = $conn->prepare($query);
            $data->execute(['token' => $user_token,  'user_phone' => $phone, 'user_email' => $email]);
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



    function optVarify($result, $phone_otp)
    {
        if ($this->classKey == "OEntehGlah6SJlnqge4c") {
            if ($result['phone_otp'] == $phone_otp) {
                return false;
            } else {
                return "Phone otp not match";;
            }
        } else {
            return "Something went wrong, please try again";
        }
    }


    function finalUserRegister($conn, $user_id, $user_name, $user_email, $password, $device_id, $token, $user_phone, $refer_code, $refered_by)
    {
        if ($this->classKey == "OEntehGlah6SJlnqge4c") {
            $query = "INSERT INTO `crushpay_users` (
                `user_id`, 
                `user_name`, 
                `user_email`, 
                `password`, 
                `device_id`, 
                `token`, 
                `user_phone`, 
                `refer_code`,
                `refered_by`) VALUES (:user_id_, 
                                        :user_name_, 
                                        :user_email, 
                                        :password_, 
                                        :device_id,
                                        :token,
                                        :user_phone, 
                                        :refer_code,
                                        :refered_by)";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'user_id_' => $user_id,
                'user_name_' => $user_name,
                'user_email' => $user_email,
                'password_' => $password,
                'device_id' => $device_id,
                'token' => $token,
                'user_phone' => $user_phone,
                'refer_code' => $refer_code,
                'refered_by' => $refered_by
            ]);

            if ($response) {
                return false;
            } else {
                return "This email and phone number is already registered with different account";
            }
        } else {
            return "Something went wrong, please try again";
        }
    }


    function referedByUsersFetch($conn, $refered_by)
    {
        if ($this->classKey == "OEntehGlah6SJlnqge4c") {
            $query = "SELECT `user_id`, `user_email`,  `user_phone` FROM `crushpay_users` WHERE `refer_code`= :refered_by";
            $data = $conn->prepare($query);
            $data->execute(['refered_by' => $refered_by]);
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


    function referUserInsert($conn, $refered_deviceid, $user_id, $user_phone, $user_email, $amount, $user_refer_code, $refered_phone, $refered_email, $refered_userid, $refered_name, $refered_refer_code, $status_, $date_)
    {
        if ($this->classKey == "OEntehGlah6SJlnqge4c") {
            $query = "INSERT INTO `refer_user` (
                `refered_deviceid`, 
                `user_id`,
                `user_phone`,
                `user_email`,
                `amount`,
                `user_refer_code`,
                `refered_phone`,
                `refered_email`,
                `refered_userid`,
                `refered_name`,
                `refered_refer_code`,
                `status_`,
                `date_`
                ) VALUES (
                    :refered_deviceid, 
                    :user_id_, 
                    :user_phone, 
                    :user_email, 
                    :amount, 
                    :user_refer_code, 
                    :refered_phone, 
                    :refered_email, 
                    :refered_userid, 
                    :refered_name, 
                    :refered_refer_code, 
                    :status_, 
                    :date_
                    )";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'refered_deviceid' => $refered_deviceid,
                'user_id_' => $user_id,
                'user_phone' => $user_phone,
                'user_email' => $user_email,
                'amount' => $amount,
                'user_refer_code' => $user_refer_code,
                'refered_phone' => $refered_phone,
                'refered_email' => $refered_email,
                'refered_userid' => $refered_userid,
                'refered_name' => $refered_name,
                'refered_refer_code' => $refered_refer_code,
                'status_' => $status_,
                'date_' => $date_
            ]);

            if ($response) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}



$response_array = array();

if (isset($_POST['user_phone'])) {
    if (isset($_POST['user_email'])) {
        if (isset($_POST['user_token'])) {
            if (isset($_POST['phone_otp'])) {
                if (isset($_POST['cs'])) {

                    $data_validation_token = "aj2M31ds@JKbf&873";
                    $DataValidation = new DataValidation($data_validation_token);
                    $user_phone = $DataValidation->sanitize($_POST['user_phone']);
                    $user_email = $DataValidation->sanitize($_POST['user_email']);
                    $user_token = $DataValidation->sanitize($_POST['user_token']);
                    $phone_otp = $DataValidation->sanitize($_POST['phone_otp']);
                    $userCheckSum = $DataValidation->sanitize($_POST['cs']);


                    $puzzle = "2c21237d1" . $user_phone . "86587" . $user_token . "344134" . $phone_otp;
                    $genCheckSum =  $DataValidation->genCheckSum($puzzle);


                    if ($userCheckSum == $genCheckSum) {


                        $date_ = date('Y-m-d H:i:s', time());


                        if ($DataValidation->phoneNumberValidate($user_phone)) {
                            if ($DataValidation->emailValidate($user_email)) {

                                $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                                $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_temp_db");

                                $UserValidation = new UserValidation("OEntehGlah6SJlnqge4c");   //My inner class
                                $temp_usersFetch = $UserValidation->temp_usersFetch($conn, $user_email, $user_phone, $user_token);
                                $conn = null;

                                if ($temp_usersFetch) {
                                    $optVarify = $UserValidation->optVarify($temp_usersFetch, $phone_otp);
                                    if (!$optVarify) {

                                        $user_id = $temp_usersFetch['user_id'];
                                        $user_name = $temp_usersFetch['user_name'];
                                        $user_email = $temp_usersFetch['user_email'];
                                        $password = $temp_usersFetch['password'];
                                        $device_id = $temp_usersFetch['device_id'];
                                        $token = $DataValidation->gentoken($user_id);
                                        $user_phone = $temp_usersFetch['user_phone'];
                                        $refer_code = $DataValidation->genReferId($user_phone);
                                        $refered_by = $temp_usersFetch['refered_by'];

                                        $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");
                                        $finalUserRegister = $UserValidation->finalUserRegister($conn, $user_id, $user_name, $user_email, $password, $device_id, $token, $user_phone, $refer_code, $refered_by);

                                        if (!$finalUserRegister) {

                                            if ($refered_by != null || $refered_by != "") {

                                                $referedByUsersFetch = $UserValidation->referedByUsersFetch($conn, $refered_by);

                                                if ($referedByUsersFetch) {



                                                    $rfBy_user_id = $referedByUsersFetch['user_id'];
                                                    $rfBy_user_phone = $referedByUsersFetch['user_phone'];
                                                    $rfBy_user_email = $referedByUsersFetch['user_email'];
                                                    $rfBy__refer_code = $refered_by;
                                                    $amount = REFER_AMOUNT;


                                                    $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_transaction");

                                                    $referUserInsert = $UserValidation->referUserInsert($conn, $device_id, $rfBy_user_id, $rfBy_user_phone, $rfBy_user_email, $amount, $rfBy__refer_code, $user_phone, $user_email, $user_id, $user_name, $refer_code, "pending", $date_);
                                                }
                                            }

                                            $response_array['response'] = true;
                                            $response_array['token'] = $token;
                                            $response_array['user_id'] = $user_id;
                                            $response_array['user_phone'] = $user_phone;
                                        } else {
                                            $response_array['response'] = false;
                                            $response_array['message'] = $finalUserRegister;
                                        }
                                    } else {
                                        $response_array['response'] = false;
                                        $response_array['message'] = $optVarify;
                                    }
                                } else {
                                    $response_array['response'] = false;
                                    $response_array['message'] = "Something went wrong, please sign up again";
                                }
                            } else {
                                $response_array['response'] = false;
                                $response_array['message'] = "Invalid email address";
                            }
                        } else {
                            $response_array['response'] = false;
                            $response_array['message'] = "Invalid phone number";
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
