<?php

//Money transfer from one wallet to another

require("../../control/datavalidation.php");
require("../../control/db_config.php");
require("../../control/contact_details.php");

date_default_timezone_set('Asia/Kolkata');


class MoneyTrans
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function storeTransaction($conn, $txn_id, $fromuserid, $from_phone_email, $fromusrname, $touserid, $to_phone_email, $tousername, $txndate, $amount, $status)
    {
        if ($this->classKey == "s2bfcKbfaJOEnt487d1JKbaj2f73") {
            $query = "INSERT INTO `money_trans_history` (
                `txn_id`, 
                `fromuserid`, 
                `fromphnem`, 
                `fromusrname`, 
                `touserid`, 
                `tophnem`, 
                `tousername`, 
                `txndate`, 
                `amount`, 
                `status`
                ) VALUES (
                    :txn_id, 
                    :fromuserid,
                    :from_phone_email,
                    :fromusrname,
                    :touserid,
                    :to_phone_email,
                    :tousername,
                    :txndate,
                    :amount,
                    :status_            
                    )";

            $result = $conn->prepare($query);
            $response = $result->execute([
                'txn_id' => $txn_id,
                'fromuserid' => $fromuserid,
                'from_phone_email' => $from_phone_email,
                'fromusrname' => $fromusrname,
                'touserid' => $touserid,
                'to_phone_email' => $to_phone_email,
                'tousername' => $tousername,
                'txndate' => $txndate,
                'amount' => $amount,
                'status_' => $status
            ]);

            return $response;
        } else {
            return false;
        }
    }

    function fetchUserBalance($conn, $user_id, $email_phone, $token)
    {
        if ($this->classKey == "s2bfcKbfaJOEnt487d1JKbaj2f73") {
            $query = "SELECT `balance`, `user_name`, `user_phone` FROM `crushpay_users` WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone)  AND `user_id` = :user_id_ AND  `token` = :token_";
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

    function fetchClient($conn, $clientPhoneEmail, $user_name)
    {
        if ($this->classKey == "s2bfcKbfaJOEnt487d1JKbaj2f73") {
            $query = "SELECT `user_id`, `balance`, `token` FROM `crushpay_users` WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone) AND `user_name` = :user_name_";
            $data = $conn->prepare($query);
            $data->execute([
                'email_phone' => $clientPhoneEmail,
                'user_name_' => $user_name
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


    function updateUserBalance($conn, $balance, $email_phone, $user_id, $token)
    {
        if ($this->classKey == "s2bfcKbfaJOEnt487d1JKbaj2f73") {
            $query = "UPDATE `crushpay_users` SET `balance` = :balance WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone)  AND `user_id` = :user_id_ AND  `token` = :token_";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'balance' => $balance,
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
}


$userMinimumBalance = 100;
$status = "Fail";
$response_array = array();

if (isset($_POST['phone1'])) {
    if (isset($_POST['phone2'])) {
        if (isset($_POST['name'])) {
            if (isset($_POST['token'])) {
                if (isset($_POST['id'])) {
                    if (isset($_POST['checksum'])) {
                        if (isset($_POST['amount'])) {


                            $data_validation_token = "aj2M31ds@JKbf&873";
                            $DataValidation = new DataValidation($data_validation_token);

                            $checksum = $DataValidation->sanitize($_POST['checksum']);
                            $token = $DataValidation->sanitize($_POST['token']);
                            $usrid = $DataValidation->sanitize($_POST['id']);
                            $from_phone_email = $DataValidation->sanitize($_POST['phone1']);
                            $amount = round(abs($DataValidation->sanitize($_POST['amount'])));

                            $clientname = $DataValidation->sanitize($_POST['name']);
                            $clientPhoneEmail = $DataValidation->sanitize($_POST['phone2']);


                            $puzzle = "2c7d1" . $token . "8587" . $clientPhoneEmail . "6d809" . $amount . $usrid;
                            $genCheckSum =  $DataValidation->genCheckSum($puzzle);


                            if ($checksum == $genCheckSum) {

                                $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                                $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");

                                $MoneyTrans = new MoneyTrans("s2bfcKbfaJOEnt487d1JKbaj2f73");
                                $fetchUserBalance = $MoneyTrans->fetchUserBalance($conn, $usrid, $from_phone_email, $token);

                                if ($fetchUserBalance) {
                                    $userBalance = $fetchUserBalance['balance'];
                                    $userName = $fetchUserBalance['user_name'];
                                    $userPhone = $fetchUserBalance['user_phone'];

                                    if ($userPhone != $clientPhoneEmail) {
                                        if ($amount <= $userBalance && $amount > 0) {
                                            if ($userBalance >= $userMinimumBalance) {

                                                $fetchClient = $MoneyTrans->fetchClient($conn, $clientPhoneEmail, $clientname);
                                                $conn = null;

                                                $clientID = $fetchClient['user_id'];
                                                $clientTOKEN = $fetchClient['token'];
                                                $clientBAL = $fetchClient['balance'];

                                                $userBalance = $userBalance - $amount;
                                                $clientBAL = $clientBAL + $amount;

                                                $txn_id = round(microtime(true) * 1000) . rand(1000, 9999999999);
                                                $txndate = date('Y-m-d H:i:s', time());
                                                $status = "Success";




                                                $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_transaction");
                                                $storeTransaction = $MoneyTrans->storeTransaction($conn, $txn_id, $usrid, $userPhone, $userName, $clientID, $clientPhoneEmail, $clientname, $txndate, $amount, $status);

                                                if ($storeTransaction) {

                                                    $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");
                                                    $updateUserBalance = $MoneyTrans->updateUserBalance($conn, $userBalance, $userPhone, $usrid, $token);
                                                    $updateUserBalance = $MoneyTrans->updateUserBalance($conn, $clientBAL, $clientPhoneEmail, $clientID, $clientTOKEN);

                                                    if ($updateUserBalance) {
                                                        $response_array['response'] = true;
                                                        $response_array['message'] = "Your transaction is successfully completed";
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
                                                $response_array['message'] = "You must have minimum " . $userMinimumBalance . " rupees on your wallet!";
                                            }
                                        } else {
                                            $response_array['response'] = false;
                                            $response_array['message'] = "Insufficient balance!";
                                        }
                                    } else {
                                        $response_array['response'] = false;
                                        $response_array['message'] = "You can't send money yourself";
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
