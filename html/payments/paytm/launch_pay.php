<?php


$_GET['am'] = 10;
$_GET['phone_email'] = "jubayer553@gamil.com";
$_GET['usr_id']    = "user_id_1";
$_GET['token'] = "user_token_1";
$_GET['pay_from'] = "WEB"; //WAP
$_GET['checksum']  = "";

require("../../control/datavalidation.php");
$callBack_url = "https://crushpay.in/payments/paytm/PaytmKit/paytm_response.php";

if (isset($_GET['am'])) {
    if (isset($_GET['phone_email'])) {
        if (isset($_GET['usr_id'])) {
            if (isset($_GET['token'])) {
                if (isset($_GET['pay_from'])) {
                    if (isset($_GET['checksum'])) {

                        $DataValidation = new DataValidation("aj2M31ds@JKbf&873");

                        $txnAmount  = round(abs($DataValidation->sanitize($_GET['am'])));  //abs() function use to convert ne- to po+ number
                        $phone_email  = $DataValidation->sanitize($_GET['phone_email']);
                        $usr_id  = $DataValidation->sanitize($_GET['usr_id']);
                        $token  = $DataValidation->sanitize($_GET['token']);
                        $pay_from  = $DataValidation->sanitize($_GET['pay_from']);
                        $checksum = $DataValidation->sanitize($_GET['checksum']);



                        $puzzle = "3uJ8Mm" . $usr_id . "u765h" . $phone_email . "Mm2tj!n7KJ" . $token;
                        $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                        // $checksum == $genCheckSum
                        if (true) {
                            //For paytm payment request
                            $paytmParams = array();
                            $paytmParams["TXN_AMOUNT"]     = $txnAmount;
                            $paytmParams["USR_ID"]     = $usr_id;
                            $paytmParams["TOKEN"]     = $token;
                            $paytmParams["PAY_FROM"]     = $pay_from;
                            $paytmParams["PHONE_EMAIL"]     = $phone_email;
                            $paytmParams["CHECKSUM"]     = $genCheckSum;
                        } else {
                            header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error307");
                        }
                    } else {
                         header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error306");
                    }
                } else {
                     header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error305");
                }
            } else {
                 header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error304");
            }
        } else {
             header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error303");
        }
    } else {
         header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error302");
    }
} else {
     header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error301");
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crush Pay - Payment Gateway</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .info {
            background: rgba(69, 31, 107, 0.281);
        }
    </style>
</head>

<body>
    <div class="main_container container shadow p-3 mb-5 bg-white rounded mt-5 w-75 p-4 text-center col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3">
        <img class="rounded-circle" alt="100x100" src="../../images/ic_app_logo.svg" data-holder-rendered="true" height="150px" width="150px">
        <div class="p-3 rounded mt-4 d-flex justify-content-between border border-primary">
            <div class="d-flex flex-row align-items-center">
                <div class="d-flex flex-column ml-4"> <span class="business"><b>Crush Pay</b></span> <span class="plan">Add money to wallet</span> </div>
            </div>
            <div class="d-flex flex-row align-items-center"><span class="amount ml-1 mr-1"> ₹ <b><?php echo $txnAmount; ?></b>.00</span></div>
        </div>
        <div class="info p-3 rounded mt-4 d-flex justify-content-between text-center">
            <h6 class="text-center text-dark"><b>PENDING! </b>Please click 'PROCEED' button to complete your payment.</h6>
        </div>
        <div>
            <form method='post' action='./PaytmKit/req_paytm.php' name='f1'>
                <?php
                foreach ($paytmParams as $name => $value) {
                    echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
                }
                ?>
                <button type="submit" name="PROCEED" class="btn btn-success mt-4 w-100">PROCEED</button>
            </form>
        </div>


    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
</body>

</html>