<?php

// OTP sender before reset password

require("../../../control/datavalidation.php");
require("../../../control/db_config.php");
require("../../../control/opt_sender.php");

date_default_timezone_set('Asia/Kolkata');

class UserValidation
{

    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function isValidUser($conn, $email_phone)
    {
        if ($this->classKey == "45aehnq6SJOEnt48735lge4c") {
            $query = "SELECT `user_phone` FROM `crushpay_users` WHERE `user_email`= :email_phone OR `user_phone`= :email_phone";
            $data = $conn->prepare($query);
            $data->execute([
                'email_phone' => $email_phone
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

    function isAbleToSend($conn, $phone_number, $date)
    {
        if ($this->classKey == "45aehnq6SJOEnt48735lge4c") {
            $query = "SELECT * FROM `otp_reset` WHERE `user_phone`= :phone_email_ AND `date`= :date_";
            $data = $conn->prepare($query);
            $data->execute([
                'phone_email_' => $phone_number,
                'date_' => $date
            ]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() < 3) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function setOtpToReset($conn, $token, $user_phone, $otp, $date)
    {
        if ($this->classKey == "45aehnq6SJOEnt48735lge4c") {
            $query = "INSERT INTO `otp_reset` (
                `token`,
                `user_phone`,
                `otp`,
                `date`,
                `stage`) VALUES (
                    :token_, 
                    :user_phone,
                    :otp_,
                    :date_,
                    'stage1')";

            $result = $conn->prepare($query);
            $response = $result->execute([
                'token_' => $token,
                'user_phone' => $user_phone,
                'otp_' => $otp,
                'date_' => $date
            ]);

            if ($response) {
                return false;   //All resutls are insert successfully
            } else {
                return "Something went wrong, please try again";
            }
        } else {
            return "Something went wrong, please try again";
        }
    }
}





$response_array = array();
if (isset($_POST['email_phone'])) {
    if (isset($_POST['cs'])) {

        $data_validation_token = "aj2M31ds@JKbf&873";
        $DataValidation = new DataValidation($data_validation_token);   //My outer class
        $email_phone = $DataValidation->sanitize($_POST['email_phone']);
        $checksum = $DataValidation->sanitize($_POST['cs']);

      
        $puzzle = "2c21237d1" . $email_phone . "89ca754fab2bba";
        $genCheckSum =  $DataValidation->genCheckSum($puzzle);


        if ($checksum == $genCheckSum) {


            $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
            $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");

            $UserValidation = new UserValidation("45aehnq6SJOEnt48735lge4c");   //My inner class
            $isValidUser = $UserValidation->isValidUser($conn, $email_phone);
            $conn = null;
            
            if( $isValidUser){

                $phone_number = $isValidUser['user_phone'];
                
                $date = date('Y-m-d', time());

                $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_temp_db");
                $isAbleToSend = $UserValidation->isAbleToSend($conn, $phone_number, $date);

                if($isAbleToSend){
                    $otp = rand(1000, 9999);
                    $token =  $DataValidation->gentoken();
                    $setOtpToReset = $UserValidation->setOtpToReset($conn, $token, $phone_number, $otp, $date);

                    if(!$setOtpToReset){

                        $OtpSender = new OtpSender("83aj2M%31ds@JKbf&");

                        $message = "Your Crush Pay account reset password OTP is : " . $otp . "\n This OTP is valid for 5 minutes. Kindly do not share to anyone.";

                        $send_phone_otp = $OtpSender -> sendMobileOTP($phone_number, $message, "eN4Kxzt6wvXhm8IRtuPeAVCk1DJmJHGMolgg31Q9rcf6fSUHBsYUpbJ6P5qf");

                        // $send_phone_otp = true;

                        if($send_phone_otp){

                            $response_array['response'] = true;
                            $response_array['token'] = $token; 
                            $response_array['phone'] = $phone_number; 

                        }else{
                            $response_array['response'] = false;
                            $response_array['message'] = "Something went wrong, please try again";
                        }

                    }else{
                        $response_array['response'] = false;
                        $response_array['message'] = $setOtpToReset;
                    }
                }else{
                    $response_array['response'] = false;
                    $response_array['message'] = "You've exceeded the maximum number of reset password attempt, please try after 24 hour!";  
                }
            }else{
                $response_array['response'] = false;
                $response_array['message'] = "This user is not found, please check details"; 
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
