<?php

//Recharge for PREPAID and DTH -------

require("../../control/datavalidation.php");
require("../../control/db_config.php");
require("../../control/contact_details.php");


date_default_timezone_set('Asia/Kolkata');



class LetsRecharge
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function fetchUserData($conn, $user_id, $email_phone, $token)
    {
        if ($this->classKey == "M31ds2bfc7d1JKbaj2f73") {
            $query = "SELECT `balance`, `profit`, `today_profit`, `usr_status`, `margins` FROM `crushpay_users` WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone)  AND `user_id` = :user_id_ AND  `token` = :token_";
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

    function doRecharge($number, $operator_code, $circle, $amount, $userTxnId)
    {
        if ($this->classKey == "M31ds2bfc7d1JKbaj2f73") {

            $url = "https://cyrusrecharge.in/api/recharge.aspx?memberid=AP217843&pin=0922434197&number=" . $number . "&operator=" . $operator_code . "&circle=" . $circle . "&amount=" . $amount . "&usertx=" . $userTxnId . "&format=json";

            // $url = "https://teercounterofficial.com/crushpay/CrushPay_API/recharge_status.php";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($response, true);
            return $response;
        } else {
            return null;
        }
    }

    function updateUserBalance($conn, $balance, $profit, $todayProfit, $email_phone, $user_id, $token)
    {
        if ($this->classKey == "M31ds2bfc7d1JKbaj2f73") {
            $query = "UPDATE `crushpay_users` SET `balance` = :balance, `profit` = :profit, `today_profit` = :today_profit WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone)  AND `user_id` = :user_id_ AND  `token` = :token_";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'balance' => $balance,
                'profit' => $profit,
                'today_profit' => $todayProfit,
                'email_phone' => $email_phone,
                'user_id_' => $user_id,
                'token_' => $token
            ]);

            if ($response) {
                return true;
            } else {
                return false;
            }
        }
    }

    function storeTransaction($conn, $usertx, $user_phone, $user_id, $amount, $number, $Status, $ApiTransID, $TransDate, $ErrorMsg, $OprtRef, $type, $profit, $oprt_code, $circle_code)
    {
        if ($this->classKey == "M31ds2bfc7d1JKbaj2f73") {

            $query = "INSERT INTO `recharge_history` (
                `usertx`,
                `user_phone`,
                `user_id`,
                `amount`,
                `number`,
                `Status`,
                `ApiTransID`,
                `TransDate`,
                `ErrorMsg`,
                `OprtRef`,
                `type`,
                `profit`,
                `oprt_code`,
                `circle_code`
                ) VALUES (
                    :usertx, 
                    :user_phone,
                    :user_id_,
                    :amount,
                    :number_,
                    :Status_,
                    :ApiTransID,
                    :TransDate,
                    :ErrorMsg,
                    :OprtRef,
                    :type_,
                    :profit,
                    :oprt_code,
                    :circle_code
                    )";

            $result = $conn->prepare($query);
            $response = $result->execute([
                'usertx' => $usertx,
                'user_phone' => $user_phone,
                'user_id_' => $user_id,
                'amount' => $amount,
                'number_' => $number,
                'Status_' => $Status,
                'ApiTransID' => $ApiTransID,
                'TransDate' => $TransDate,
                'ErrorMsg' => $ErrorMsg,
                'OprtRef' => $OprtRef,
                'type_' => $type,
                'profit' => $profit,
                'oprt_code' => $oprt_code,
                'circle_code' => $circle_code
            ]);

            return $response;
        } else {
            return false;
        }
    }
}



$response_array = array();
if (isset($_POST['checksum'])) {
    if (isset($_POST['usrid'])) {
        if (isset($_POST['token'])) {
            if (isset($_POST['num'])) {
                if (isset($_POST['opt'])) {
                    if (isset($_POST['am']) && $_POST['am'] > 0) {
                        if (isset($_POST['type'])) {
                            if (isset($_POST['email_phone'])) {
                                $data_validation_token = "aj2M31ds@JKbf&873";
                                $DataValidation = new DataValidation($data_validation_token);

                                $checksum = $DataValidation->sanitize($_POST['checksum']);
                                $token = $DataValidation->sanitize($_POST['token']);
                                $usrid = $DataValidation->sanitize($_POST['usrid']);
                                $type = $DataValidation->sanitize($_POST['type']);
                                $amount = round(abs($DataValidation->sanitize($_POST['am'])));  //Round and Absolute value amount
                                $operator = $DataValidation->sanitize($_POST['opt']);
                                $number = $DataValidation->sanitize($_POST['num']);
                                $email_phone = $DataValidation->sanitize($_POST['email_phone']);


                                $puzzle = "2bfc7d1" . $number . "88f5" . $amount . "6d859" . $token;
                                $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                                if ($checksum == $genCheckSum) {

                                    $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                                    $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");


                                    $LetsRecharge = new LetsRecharge("M31ds2bfc7d1JKbaj2f73");
                                    $fetchUserData = $LetsRecharge->fetchUserData($conn, $usrid, $email_phone, $token);

                                    if ($fetchUserData) {

                                        $userBalance = $fetchUserData['balance'];
                                        $userProfit = $fetchUserData['profit'];
                                        $todayProfit = $fetchUserData['today_profit'];
                                        $usr_status = $fetchUserData['usr_status'];
                                        $margins = json_decode($fetchUserData['margins'], true);
                                        $userMargin =  $margins[$type][$operator];

                                        if ($usr_status) {
                                            if ($userBalance >= $amount) {

                                                $userTxnId = round(microtime(true) * 1000) . rand();

                                                $circle = "";
                                                $doRecharge = array();
                                                if ($type == "PREPAID" || $type == "DTH") {
                                                    if (isset($_POST['cr'])) {
                                                        $circle = $DataValidation->sanitize($_POST['cr']);
                                                    }
                                                    $doRecharge = $LetsRecharge->doRecharge($number, $operator, $circle, $amount, $userTxnId);


                                                    if ($doRecharge != null) {
                                                        $Status = $doRecharge["Status"];
                                                        $ApiTransID = $doRecharge["ApiTransID"];
                                                        $ErrorMsg = $doRecharge["ErrorMessage"];
                                                        $OprtRef = $doRecharge["OperatorRef"];
    
                                                        $TransDate = $doRecharge["TransactionDate"];
                                                        $TransDate1 = DateTime::createFromFormat('j/n/Y h:i:s A', $TransDate);
                                                        $TransDate = date_format($TransDate1, 'Y-m-d H:i:s');
    
                                                        $profit = 0;
                                                        if ($Status == "FAILURE" || $Status == "Failure" || $Status == "failure") {
                                                         
                                                        }else{
                                                            $profit = $amount * ($userMargin / 100);
                                                            $userBalance = ($userBalance - $amount) + $profit;
    
                                                            $userProfit = $userProfit + $profit;
                                                            $todayProfit = $todayProfit + $profit;
    
                                                            $updateUserBalance = $LetsRecharge->updateUserBalance($conn, $userBalance, $userProfit, $todayProfit, $email_phone, $usrid, $token);
                                                        }
    
                                                        $conn = null;
    
                                                        $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_transaction");
    
                                                        $storeTransaction = $LetsRecharge->storeTransaction($conn, $userTxnId, $email_phone, $usrid, $amount, $number, $Status, $ApiTransID, $TransDate, $ErrorMsg, $OprtRef, $type, $profit, $operator, $circle);
                                                        $conn = null;
    
    
    
                                                        $response_array['response'] = true;
                                                        $response_array['message'] = $ErrorMsg;
                                                        $response_array['date_time'] = date_format($TransDate1, 'Y-m-d h:i:s A');
                                                        $response_array['Status'] = $Status;
                                                        $response_array['TxnId'] = $userTxnId;
                                                    } else {
                                                        $response_array['response'] = false;
                                                        $response_array['message'] = "Something went wrong, please try again";
                                                    }

                                                } else {
                                                    $response_array['response'] = false;
                                                    $response_array['message'] = "Something went wrong, please try again!";
                                                }
                                            } else {
                                                $response_array['response'] = false;
                                                $response_array['message'] = "Insufficient balance!";
                                            }
                                        } else {
                                            $response_array['response'] = false;
                                            $response_array['message'] = "Your account is temporarily blocked, please contact at " . SUPPORT_EMAIL;
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
