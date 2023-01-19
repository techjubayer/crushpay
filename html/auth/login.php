<?php


require("../var/db_config.php");
require("../var/var.php");

require("./auth.php");
require("../control/datavalidation.php");
require("../control/db_config.php");
require("./balance_analys.php");
date_default_timezone_set('Asia/Kolkata');




$callBackUrl = "../home/";
$message = "Something went wrong, please reload the page and try again!";
if (isset($_POST['em_ph'])) {
    if (isset($_POST['pass'])) {
        if (isset($_POST['cs'])) {

            $data_validation_token = "aj2M31ds@JKbf&873";
            $DataValidation = new DataValidation($data_validation_token);
            $email_phone = $DataValidation->sanitize($_POST['em_ph']);
            $password = $DataValidation->hashPass($_POST['pass']);
            $userCheckSum = $DataValidation->sanitize($_POST['cs']);

            $puzzle = "2c21237d1" . $email_phone . "86JKb58fajds7";
            $genCheckSum =  $DataValidation->genCheckSum($puzzle);

            if ($userCheckSum == $genCheckSum) {



                $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
                $conn = $DBConnection->dbConn(LOGED_OUT_USER, LOGED_OUT_USER_PASS, "crushpay_users");

                $UserValidation = new UserValidation("3545aehnq6SJOEnt487lge4c");
                $fetchUserData = $UserValidation->fetchUserData($conn, $email_phone, $password);
                if ($fetchUserData) {
                    $email = $fetchUserData['user_email'];
                    $phone = $fetchUserData['user_phone'];
                    $user_id = $fetchUserData['user_id'];
                    $user_token = $DataValidation->gentoken($user_id);

                    $conn = $DBConnection->dbConn(LOGED_IN_USER, LOGED_IN_USER_PASS, "crushpay_users");
                    $updateToken = $UserValidation->updateToken($conn, $user_token, $email, $phone, $password);

                    if ($updateToken) {

                        session_start();
                        $_SESSION['token'] = $user_token;
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_phone'] = $phone;

                       
                        setcookie('token', $user_token, time() + SESSION_EXPIRE, "/", DOMAIN, true, true);
                        setcookie('user_id', $user_id, time() + SESSION_EXPIRE, "/", DOMAIN, true, true);
                        setcookie('user_phone', $phone, time() + SESSION_EXPIRE, "/", DOMAIN, true, true);




                        $conn = $DBConnection->dbConn(LOGED_IN_USER, LOGED_IN_USER_PASS, "crushpay_transaction");
                        $HistoryFetch = new HistoryFetch("bfaJOEnt487d1JKbaj2s2bfcKf73");

                        $fetchRcHistory = $HistoryFetch->fetchRcHistory($conn, $user_id, $phone);
                        $fetchAddMoneyHistory = $HistoryFetch->fetchAddMoneyHistory($conn, $user_id, $phone);
                        $fetchTransactionHistory = $HistoryFetch->fetchTransactionHistory($conn, $user_id, $phone);
                        $fetchReferHistory = $HistoryFetch->fetchReferHistory($conn, $user_id, $phone);



                        $balance = $fetchRcHistory + $fetchAddMoneyHistory + $fetchTransactionHistory + $fetchReferHistory;


                        $conn = $DBConnection->dbConn(LOGED_IN_USER, LOGED_IN_USER_PASS, "crushpay_users");
                        $updateUserBalance = $HistoryFetch->updateUserBalance($conn, $balance, $phone, $user_id, $user_token);


                        if ($updateUserBalance) {
                            $callBackUrl = "../";
                            header("location: " . $callBackUrl);
                        } else {
                            header("location: " . $callBackUrl . "?error=" . $message);
                        }


                    } else {
                        header("location: " . $callBackUrl . "?error=" . $message);
                    }
                } else {
                    $message = "Invalid user or password";
                    header("location: " . $callBackUrl . "?error=" . $message);
                }
                $conn = null;
            } else {
                header("location: " . $callBackUrl . "?error=" . $message);
            }
        } else {
            header("location: " . $callBackUrl . "?error=" . $message);
        }
    } else {
        header("location: " . $callBackUrl . "?error=" . $message);
    }
} else {
    header("location: " . $callBackUrl . "?error=" . $message);
}

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crush Pay | User Login</title>



    <!-- MyStyle--------------------------START -->
    <link rel="stylesheet" href="../css/vendor/main.css">
    <!-- MyStyle--------------------------END -->
</head>

<body>

    <div id="preloader">

    </div>




    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- MY Scripts-------------------------START -->
    <script src="../scripts/main.js"></script>
    <!-- MY Scripts-------------------------END -->
</body>

</html>