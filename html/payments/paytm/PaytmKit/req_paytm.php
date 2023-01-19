<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

require("../../../control/datavalidation.php");
require("../../../control/db_config.php");


date_default_timezone_set('Asia/Kolkata');

$STATUS = FALSE;
$callBack_url = "https://crushpay.in/payments/paytm/PaytmKit/paytm_response.php";




if (isset($_POST["PROCEED"])) {
    if (isset($_POST["USR_ID"])) {
        if (isset($_POST["TOKEN"])) {
            if (isset($_POST["PAY_FROM"])) {
                if (isset($_POST["PHONE_EMAIL"])) {
                    if (isset($_POST['CHECKSUM'])) {


                        $DataValidation = new DataValidation("aj2M31ds@JKbf&873");

                        $TXN_AMOUNT = $DataValidation->sanitize($_POST["TXN_AMOUNT"]);
                        $USR_ID = $DataValidation->sanitize($_POST["USR_ID"]);
                        $TOKEN = $DataValidation->sanitize($_POST["TOKEN"]);
                        $PAY_FROM = $DataValidation->sanitize($_POST["PAY_FROM"]);
                        $PHONE_EMAIL = $DataValidation->sanitize($_POST["PHONE_EMAIL"]);
                        $checkSum = $DataValidation->sanitize($_POST["CHECKSUM"]);

                        $puzzle = "3uJ8Mm" . $USR_ID . "u765h" . $PHONE_EMAIL . "Mm2tj!n7KJ" . $TOKEN;
                        $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                        if ($checkSum == $genCheckSum) {
                            if ($DataValidation->emailValidate($PHONE_EMAIL) || $DataValidation->phoneNumberValidate($PHONE_EMAIL)) {

                                $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");
                                $conn = $DBConnection->dbConn('crush_user', 'ziKuT@iW5.aB72pz', 'crushpay_users');


                                $query = "SELECT `user_id`, `user_email`, `user_phone` FROM `crushpay_users` WHERE (`user_email`= :email OR `user_phone`= :phone) AND `token`= :user_token";
                                $data = $conn->prepare($query);
                                $data->execute(['email' => $PHONE_EMAIL, 'phone' => $PHONE_EMAIL, 'user_token' => $TOKEN]);
                                $result = $data->fetch(PDO::FETCH_ASSOC);
                                $conn = null;


                                if (($data->rowCount()) != 0) {
                                    if ($result['user_id'] == $USR_ID) {


                                        $paramList = array();
                                        $paramList["MID"] = PAYTM_MERCHANT_MID;
                                        $paramList["ORDER_ID"] = rand(100000, 999999) . time() . rand(100000000, 9999999999999);
                                        $paramList["CUST_ID"] = $result['user_id'];
                                        $paramList["INDUSTRY_TYPE_ID"] = PAYTM_INDUSTRY_TYPE_ID;    //Retail
                                        $paramList["CHANNEL_ID"] = $PAY_FROM;    //WEB or APP
                                        $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
                                        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE; //WEBSTAGING or MY_Website
                                        $paramList["EMAIL"] = $result['user_email'];
                                        $paramList["MOBILE_NO"] = $result['user_phone'];

                                        $checkSum1 = hash('gost', rand(1000000000, 9999999999999) . time() . rand(1000000000, 9999999999999));     //Not use actually but use in generate checksum and validate it

                                        $VERIFY_TOKEN = hash('md5', rand(1000000000, 9999999999999) . time() . rand(1000000000, 9999999999999));
                                        $paramList["CALLBACK_URL"] = $callBack_url . "?token=" . $VERIFY_TOKEN . "&order_id=" . $paramList["ORDER_ID"] . "&txn_amount=" . $paramList["TXN_AMOUNT"] . "&customer_id=" . $paramList["CUST_ID"] . "&phone=" . $paramList["MOBILE_NO"] . "&checkSum=" . $checkSum1 . "&id=" . $paramList["MID"] . "&status=TRUE";


                                        $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
                                        $paramList["CHECKSUMHASH"] = $checkSum;



                                        $conn = $DBConnection->dbConn('crush_user', 'ziKuT@iW5.aB72pz', 'crushpay_transaction');
                                        $query2 = "INSERT INTO `tnx_add_money` (`order_id`, `checksum`, `mid`, `txn_amount`, `customer_id`, `eamil`, `phone`, `channel`, `status`, `verify_token`, `proceed_time`) VALUES
                                        (:order_id, 
                                        :checksum_,
                                        :mid,
                                        :txn_amount,
                                        :customer_id,
                                        :eamil,
                                        :phone,
                                        :channel,
                                        :status_,
                                        :verify_token,
                                        CURRENT_TIMESTAMP
                                        )";

                                        $result1 = $conn->prepare($query2);
                                        $response = $result1->execute([
                                            'order_id' => $paramList["ORDER_ID"],
                                            'checksum_' => $checkSum1,
                                            'mid' => $paramList["MID"],
                                            'txn_amount' => floatval($paramList["TXN_AMOUNT"]),
                                            'customer_id' => $paramList["CUST_ID"],
                                            'eamil' => $paramList["EMAIL"],
                                            'phone' => $paramList["MOBILE_NO"],
                                            'channel' => $paramList["CHANNEL_ID"],
                                            'status_' => 'PROCEED',
                                            'verify_token' => $VERIFY_TOKEN
                                        ]);
                                        $conn = null;

                                        if ($response) {
                                            $STATUS = TRUE;
                                        } else {
                                            header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error309");
                                        }
                                    } else {
                                        header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error308");
                                    }
                                } else {
                                    header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error307");
                                }
                            } else {
                                header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error306");
                            }
                        } else {
                            header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error309");
                        }
                    } else {
                        header("location: " . $callBack_url . "?status=" . $STATUS . "&RESPMSG=Error309");
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

<html>

<head>
    <title>Crush Pay - Check Out Page</title>
</head>

<body>
    <center>
        <h1>Please do not refresh this page...</h1>
    </center>
    <form method="post" action="<?php if ($STATUS) {
                                    echo PAYTM_TXN_URL;
                                } ?>" name="f1">
        <table border="1">
            <tbody>
                <?php
                if ($STATUS) {
                    foreach ($paramList as $name => $value) {
                        echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
                    }
                }
                ?>
            </tbody>
        </table>
        <script type="text/javascript">
            <?php
            if ($STATUS) {
            ?>
                document.f1.submit();
            <?php
            }
            ?>
            document.addEventListener('contextmenu', event => event.preventDefault());
        </script>
    </form>
</body>

</html>