<?php

//History fetch like recharge, addmoney, transaction, refer

require("../../control/datavalidation.php");
require("../../control/db_config.php");
require("../../control/contact_details.php");

// date_default_timezone_set('Asia/Kolkata');


class HistoryFetch
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function fetchRcHistory($conn, $user_id, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `number`, `oprt_code`, `usertx`, `amount`, `profit`, `TransDate`, `Status` FROM `recharge_history` WHERE `user_phone`= :user_phone  AND `user_id` = :user_id_ ORDER BY `Sl_No` DESC LIMIT 60";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);

            if ($data->rowCount() != 0) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function fetchAddMoneyHistory($conn, $user_id, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `order_id`, `txn_amount`, `status`, `txn_date` FROM `tnx_add_money` WHERE `phone`= :user_phone  AND `customer_id` = :user_id_ AND `status` != 'PROCEED' ORDER BY `Sl. No.` DESC LIMIT 100";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function fetchTransactionHistory($conn, $user_phone, $user_id)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `txn_id`, `amount`, `fromuserid`, `fromphnem`, `fromusrname`, `touserid`, `tophnem`, `tousername`, `txndate` FROM `money_trans_history` WHERE (`fromphnem`= :user_phone  AND `fromuserid`= :user_id_ ) OR (`tophnem` = :user_phone AND `touserid` = :user_id_) ORDER BY `Sl_No` DESC LIMIT 100";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function fetchReferHistory($conn, $user_id_, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `refered_name`, `refered_email`, `amount`, `date_`, `status_` FROM `refer_user` WHERE (`user_id`= :user_id_  AND `user_phone`= :user_phone ) ORDER BY `Sl_No` DESC LIMIT 100";
            $data = $conn->prepare($query);
            $data->execute([
                'user_id_' => $user_id_,
                'user_phone' => $user_phone
            ]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}


function arangeTransactionHistory($POST_userPhone, $POST_userId, $fetchHistory)
{
    $historyArray = array();
    $tempArray = array();
    foreach ($fetchHistory as $row) {
        $tempArray['trns_id'] = $row['txn_id'];
        $tempArray['trns_date'] = $row['txndate'];
        $tempArray['amount'] = $row['amount'];
        if ($POST_userPhone == $row['fromphnem'] && $POST_userId == $row['fromuserid']) {
            $tempArray['trns_type'] = "send";
            $tempArray['clientName'] = $row['tousername'];
        } else {
            $tempArray['trns_type'] = "receive";
            $tempArray['clientName'] = $row['fromusrname'];
        }

        array_push($historyArray, $tempArray);
    }

    return $historyArray;
}


$response_array = array();
if (isset($_POST['id'])) {
    if (isset($_POST['token'])) {
        if (isset($_POST['phone'])) {
            if (isset($_POST['cs'])) {
                if (isset($_POST['rqf'])) {

                    $data_validation_token = "aj2M31ds@JKbf&873";
                    $DataValidation = new DataValidation($data_validation_token);

                    $POST_userId = $DataValidation->sanitize($_POST['id']);
                    $POST_userPhone = $DataValidation->sanitize($_POST['phone']);
                    $POST_userToken = $DataValidation->sanitize($_POST['token']);
                    $POST_checkSum = $DataValidation->sanitize($_POST['cs']);
                    $POST_requestFor = $DataValidation->sanitize($_POST['rqf']);

                    $puzzle = "2c7d1" . $POST_userId . "86d809587" . $POST_userPhone . "3421234134" . $POST_userToken;
                    $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                    if ($POST_checkSum ==  $genCheckSum) {

                        $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");
                        $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_transaction");

                        $HistoryFetch = new HistoryFetch("bfaJOEnt487d1JKbaj2s2bfcKf73");
                        if ($POST_requestFor == "recharge") {
                            $fetchHistory = $HistoryFetch->fetchRcHistory($conn, $POST_userId, $POST_userPhone);
                            if ($fetchHistory) {
                                $historyArray = array();
                                foreach ($fetchHistory as $row) {
                                    array_push($historyArray, $row);
                                }
                                $response_array['response'] = true;
                                $response_array['records'] = $historyArray;
                            } else {
                                $response_array['response'] = false;
                                $response_array['message'] = "No data found";
                            }
                        } else if ($POST_requestFor == "add_money") {
                            $fetchHistory = $HistoryFetch->fetchAddMoneyHistory($conn, $POST_userId, $POST_userPhone);
                            if ($fetchHistory) {
                                $historyArray = array();
                                foreach ($fetchHistory as $row) {
                                    array_push($historyArray, $row);
                                }
                                $response_array['response'] = true;
                                $response_array['records'] = $historyArray;
                            } else {
                                $response_array['response'] = false;
                                $response_array['message'] = "No data found";
                            }
                        } else if ($POST_requestFor == "trans") {
                            $fetchHistory = $HistoryFetch->fetchTransactionHistory($conn, $POST_userPhone, $POST_userId);
                            if ($fetchHistory) {
                                $response_array['response'] = true;
                                $response_array['records'] = arangeTransactionHistory($POST_userPhone, $POST_userId, $fetchHistory);
                            } else {
                                $response_array['response'] = false;
                                $response_array['message'] = "No data found";
                            }
                        } else if ($POST_requestFor == "refer") {
                            $fetchHistory = $HistoryFetch->fetchReferHistory($conn, $POST_userId, $POST_userPhone);
                            if ($fetchHistory) {
                                $historyArray = array();
                                foreach ($fetchHistory as $row) {
                                    array_push($historyArray, $row);
                                }
                                $response_array['response'] = true;
                                $response_array['records'] = $historyArray;
                            } else {
                                $response_array['response'] = false;
                                $response_array['message'] = "No data found";
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
