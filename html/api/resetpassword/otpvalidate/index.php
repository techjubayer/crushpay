<?php
//OTP verify before reset password
require("../../../control/datavalidation.php");
require("../../../control/db_config.php");
require("../../../control/opt_sender.php");

date_default_timezone_set('Asia/Kolkata');

class OTPValidation
{

    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function isValidOtp($conn, $phone_number, $token, $otp)
    {
        if ($this->classKey == "45aehnq6SJOEnt48735lge4c") {
            $query = "SELECT * FROM `otp_reset` WHERE `user_phone`= :user_phone AND `token`= :token_ AND `otp`= :otp_ AND `status` = 'PROCEED' AND `stage` = 'stage1'";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $phone_number,
                'token_' => $token,
                'otp_' => $otp
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

    function otpVerfied($conn, $phone_number, $token, $otp, $token2)
    {
        if ($this->classKey == "45aehnq6SJOEnt48735lge4c") {
            $query = "UPDATE `otp_reset`  SET `status` = 'SUCCESS', `token2` = :token2, `stage` = 'stage2' WHERE `user_phone`= :user_phone AND `token`= :token_ AND `otp`= :otp_ AND `status` = 'PROCEED'";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'token2' => $token2,
                'user_phone' => $phone_number,
                'token_' => $token,
                'otp_' => $otp
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
if (isset($_POST['otp'])) {
    if (isset($_POST['phone'])) {
        if (isset($_POST['token'])) {
            if (isset($_POST['cs'])) {

                $data_validation_token = "aj2M31ds@JKbf&873";
                $DataValidation = new DataValidation($data_validation_token);   //My outer class
                $otp = $DataValidation->sanitize($_POST['otp']);
                $phone = $DataValidation->sanitize($_POST['phone']);
                $token = $DataValidation->sanitize($_POST['token']);
                $userCheckSum = $DataValidation->sanitize($_POST['cs']);


                $puzzle = $token . "2c21237d1" . $phone . "865JKbfajd87" . $otp . "344134";
                $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                if ($userCheckSum == $genCheckSum) {


                    $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                    $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_temp_db");



                    $OTPValidation = new OTPValidation("45aehnq6SJOEnt48735lge4c");
                    $isValidOtp = $OTPValidation->isValidOtp($conn, $phone, $token, $otp);


                    if ($isValidOtp) {
                        $token2 = $DataValidation->gentoken();
                        $otpVerfied = $OTPValidation->otpVerfied($conn, $phone, $token, $otp, $token2);
                        $conn = null;

                        if ($otpVerfied) {

                            $response_array['response'] = true;
                            $response_array['token'] = $token2;
                            $response_array['phone'] = $phone;
                        } else {
                            $response_array['response'] = false;
                            $response_array['message'] = "Something went wrong, please try again";
                        }
                    } else {
                        $response_array['response'] = false;
                        $response_array['message'] = "Wrong otp, please check your otp!";
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
