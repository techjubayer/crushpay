<?php
//User check before money transfer
require("../../../control/datavalidation.php");
require("../../../control/db_config.php");


date_default_timezone_set('Asia/Kolkata');


class UserCheck
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function fetchClient($conn, $clientPhoneEmail)
    {
        if ($this->classKey == "aJOEnt487ds2bfc2f73Kbf1JKbaj") {
            $query = "SELECT `user_name` FROM `crushpay_users` WHERE `user_email`= :email_phone OR `user_phone`= :email_phone";
            $data = $conn->prepare($query);
            $data->execute([
                'email_phone' => $clientPhoneEmail
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

if (isset($_POST['usphem'])) {
    if (isset($_POST['token'])) {
        if (isset($_POST['id'])) {
            if (isset($_POST['csum'])) {
                if (isset($_POST['clientemph'])) {

                    $data_validation_token = "aj2M31ds@JKbf&873";
                    $DataValidation = new DataValidation($data_validation_token);

                    // $userPhoneEmail = $DataValidation->sanitize($_POST['usphem']);
                    $userToken = $DataValidation->sanitize($_POST['token']);
                    $userId = $DataValidation->sanitize($_POST['id']);
                    $userCheckSum = $DataValidation->sanitize($_POST['csum']);
                    $clientPhoneEmail = $DataValidation->sanitize($_POST['clientemph']);

                    $puzzle = $userId . "87ds2bf" . $userToken . "c2f73K" . $clientPhoneEmail . "bf1JK" . $userId;
                    $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                    if ($userCheckSum == $genCheckSum) {

                        $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                        $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");

                        $UserCheck = new UserCheck("aJOEnt487ds2bfc2f73Kbf1JKbaj");
                        $fetchClient = $UserCheck->fetchClient($conn, $clientPhoneEmail);

                        if($fetchClient){

                            $clientName = $fetchClient['user_name'];

                            $response_array['response'] = true;
                            $response_array['message'] = $clientName; 

                        }else{
                            $response_array['response'] = false;
                            $response_array['message'] = "User not found"; 
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
