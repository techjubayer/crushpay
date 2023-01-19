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


class AddMoney
{
	private $DBConnection;
	private $conn;
	function __construct($db_cnn_token, $usr, $pass, $db)
	{
		$this->DBConnection = new DBConnection($db_cnn_token);
		$this->conn = $this->DBConnection->dbConn($usr, $pass, $db);
	}

	function upddateTnxHistory($POST_STATUS, $POST_TXNID, $POST_TXNDATE, $POST_ORDERID, $POST_MID, $GET_VERIFY_TOKEN, $GET_CHECKSUM)
	{
		$query = "UPDATE `tnx_add_money` SET `status` = :status_ , `txn_id` = :txn_id, `txn_date` = :txn_date WHERE `order_id`= :order_id AND `mid`= :mid_ AND `verify_token`= :verify_token AND `checksum` = :checksum_";
		$result = $this->conn->prepare($query);
		$response = $result->execute(['status_' => $POST_STATUS, 'txn_id' => $POST_TXNID, 'txn_date' => $POST_TXNDATE, 'order_id' => $POST_ORDERID, 'mid_' => $POST_MID,  'verify_token' => $GET_VERIFY_TOKEN, 'checksum_' => $GET_CHECKSUM]);

		if ($response) {
			return true;
		} else {
			return false;
		}
	}

	function userBalanceFetch($GET_PHONE, $GET_CUSTOMER_ID)
	{
		$query = "SELECT `balance` FROM `crushpay_users` WHERE `user_phone`= :phone AND `user_id`= :user_id_";
		$data = $this->conn->prepare($query);
		$data->execute(['phone' => $GET_PHONE, 'user_id_' => $GET_CUSTOMER_ID]);
		$result = $data->fetch(PDO::FETCH_ASSOC);
		return $result['balance'];
	}

	function userBalanceUpdate($balance, $GET_PHONE, $GET_CUSTOMER_ID)
	{
		$query = "UPDATE `crushpay_users` SET `balance` = :balance WHERE `user_phone`= :phone AND `user_id`= :user_id_";
		$result = $this->conn->prepare($query);
		$response = $result->execute(['balance' => $balance, 'phone' => $GET_PHONE, 'user_id_' => $GET_CUSTOMER_ID]);

		if ($response) {
			return true;
		} else {
			return false;
		}
	}

	function tnxHistoryFetch($POST_ORDERID, $POST_MID, $GET_VERIFY_TOKEN, $GET_CHECKSUM)
	{
		$query = "SELECT * FROM `tnx_add_money` WHERE `order_id`= :order_id AND `mid`= :mid_ AND `verify_token`= :verify_token AND `checksum` = :checksum_";
		$data = $this->conn->prepare($query);
		$data->execute(['order_id' => $POST_ORDERID, 'mid_' => $POST_MID,  'verify_token' => $GET_VERIFY_TOKEN, 'checksum_' => $GET_CHECKSUM]);
		$result = $data->fetch(PDO::FETCH_ASSOC);
		if (($data->rowCount()) == 1) {
			return $result;
		} else {
			return false;
		}
	}
}


// foreach ($_POST as $paramName => $paramValue) {
// 	echo "<br/>" . $paramName . " = " . $paramValue;
// }




$_status = FALSE;
$_message = "";
// $POST_TXNDATE = DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s", time()));
// $POST_TXNDATE = date_format($POST_TXNDATE, 'Y-m-d h:i:s A');
$POST_TXNDATE = date("Y-m-d h:i:s A", time());
if (isset($_GET['status'])) {
	if ($_GET['status']) {
		if (isset($_GET['id'])) {
			if (isset($_GET['checkSum'])) {
				if (isset($_GET['txn_amount'])) {
					if (isset($_GET['order_id'])) {
						if (isset($_GET['token'])) {
							if (isset($_GET['customer_id'])) {
								if (isset($_GET['phone'])) {

									$DataValidation = new DataValidation("aj2M31ds@JKbf&873");
									$GET_MID = $DataValidation->sanitize($_GET['id']);
									$GET_TXN_AMOUNT = $DataValidation->sanitize($_GET['txn_amount']);
									$GET_ORDER_ID = isset($_GET['order_id']) ? $DataValidation->sanitize($_GET['order_id']) : "";
									$GET_VERIFY_TOKEN = $DataValidation->sanitize($_GET['token']);
									$GET_CHECKSUM = $DataValidation->sanitize($_GET['checkSum']);
									$GET_CUSTOMER_ID = $DataValidation->sanitize($_GET['customer_id']);
									$GET_PHONE = $DataValidation->sanitize($_GET['phone']);

									//User balance fetch
									$Add_Money = new AddMoney("2M31ds@f8JKbfajdsb73", 'crush_user', 'ziKuT@iW5.aB72pz', 'crushpay_users');
									$balance = $Add_Money->userBalanceFetch($GET_PHONE, $GET_CUSTOMER_ID);
									$POST_STATUS = "TXN_FAILURE";
									$Add_Money = null;


									if (isset($_POST['ORDERID'])) {
										if (isset($_POST['MID'])) {
											if (isset($_POST['TXNAMOUNT'])) {
												if (isset($_POST['STATUS'])) {
													if (isset($_POST['RESPMSG'])) {
														$POST_ORDERID = $DataValidation->sanitize($_POST['ORDERID']);
														$POST_MID = $DataValidation->sanitize($_POST['MID']);
														$POST_TXNAMOUNT = $DataValidation->sanitize($_POST['TXNAMOUNT']);
														$POST_STATUS = $DataValidation->sanitize($_POST['STATUS']);
														$POST_RESPMSG = $DataValidation->sanitize($_POST['RESPMSG']);

														$isValidChecksum = "FALSE";
														$POST_CHECKSUMHASH = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
														$isValidChecksum = verifychecksum_e($_POST, PAYTM_MERCHANT_KEY, $POST_CHECKSUMHASH);


														if ($isValidChecksum == "TRUE") {
															if ($GET_MID == $POST_MID) {
																if ($GET_ORDER_ID == $POST_ORDERID) {
																	if ($GET_TXN_AMOUNT == $POST_TXNAMOUNT) {

																		$Add_Money = new AddMoney("2M31ds@f8JKbfajdsb73", 'crush_user', 'ziKuT@iW5.aB72pz', 'crushpay_transaction');
																		$result = $Add_Money->tnxHistoryFetch($POST_ORDERID, $POST_MID, $GET_VERIFY_TOKEN, $GET_CHECKSUM);
																		$Add_Money = null;

																		if ($result) {
																			if ($result['txn_amount'] == $POST_TXNAMOUNT && $result['txn_amount'] == $GET_TXN_AMOUNT) {
																				if ($result['status'] == 'PROCEED') {

																					$POST_TXNID = isset($_POST['TXNID']) ? $DataValidation->sanitize($_POST['TXNID']) : "";

																					$POST_TXNDATE = $DataValidation->sanitize($_POST['TXNDATE']);
																					$POST_TXNDATE =  substr($POST_TXNDATE, 0, -2);
																					// $POST_TXNDATE = DateTime::createFromFormat('Y-m-d H:i:s', $POST_TXNDATE);
																					// $POST_TXNDATE = date_format($POST_TXNDATE, 'Y-m-d h:i:s A');

																					if ($POST_STATUS == "TXN_SUCCESS") {
																						$_status = TRUE;


																						//Update txn_status to success 1
																						$Add_Money = new AddMoney("2M31ds@f8JKbfajdsb73", 'crush_user', 'ziKuT@iW5.aB72pz', 'crushpay_transaction');
																						do {
																							$isAddRecord = $Add_Money->upddateTnxHistory($POST_STATUS, $POST_TXNID, $POST_TXNDATE, $POST_ORDERID, $POST_MID, $GET_VERIFY_TOKEN, $GET_CHECKSUM);
																						} while (!$isAddRecord);
																						$Add_Money = null;



																						//User balance update
																						$balance = $balance + $POST_TXNAMOUNT;
																						$Add_Money = new AddMoney("2M31ds@f8JKbfajdsb73", 'crush_user', 'ziKuT@iW5.aB72pz', 'crushpay_users');
																						do {
																							$isBalUpdate = $Add_Money->userBalanceUpdate($balance, $GET_PHONE, $GET_CUSTOMER_ID);
																						} while (!$isBalUpdate);
																						$Add_Money = null;

																						$_message = $POST_RESPMSG;
																					} else {
																						$Add_Money = new AddMoney("2M31ds@f8JKbfajdsb73", 'crush_user', 'ziKuT@iW5.aB72pz', 'crushpay_transaction');
																						do {
																							$isAddRecord = $Add_Money->upddateTnxHistory($POST_STATUS, $POST_TXNID, $POST_TXNDATE, $POST_ORDERID, $POST_MID, $GET_VERIFY_TOKEN, $GET_CHECKSUM);
																						} while (!$isAddRecord);
																						$Add_Money = null;
																						$_message = $POST_RESPMSG;
																					}
																				} else {
																					$_message  = "Error419: Something went wrong!";
																				}
																			} else {
																				$_message  = "Error418: Something went wrong!";
																			}
																		} else {
																			$_message  = "Error417: Something went wrong!";
																		}
																	} else {
																		$_message  = "Error416: Something went wrong!";
																	}
																} else {
																	$_message  = "Error415: Something went wrong!";
																}
															} else {
																$_message  = "Error414: Something went wrong!";
															}
														} else {
															$_message = $POST_RESPMSG;
														}
													} else {
														$_message  = "Error413: Something went wrong!";
													}
												} else {
													$_message  = "Error412: Something went wrong!";
												}
											} else {
												$_message  = "Error411: Something went wrong!";
											}
										} else {
											$_message  = "Error410: Something went wrong!";
										}
									} else {
										$_message  = "Error409: Something went wrong!";
									}
								} else {
									$_message  = "Error408: Something went wrong!";
								}
							} else {
								$_message  = "Error407: Something went wrong!";
							}
						} else {
							$_message  = "Error406: Something went wrong!";
						}
					} else {
						$_message  = "Error405: Something went wrong!";
					}
				} else {
					$_message  = "Error404: Something went wrong!";
				}
			} else {
				$_message  = "Error403: Something went wrong!";
			}
		} else {
			$_message  = "Error402: Something went wrong!";
		}
	} else {
		$_message = $_GET['RESPMSG'];
	}
} else {
	$_message = "Error401: Something went wrong!";
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

		.parent {
			position: relative;
			top: 0;
			left: 0;
		}

		.image1 {
			position: relative;
			top: 0;
			left: 0;
			animation: image_roted 2.5s ease-in-out;
		}

		.image2 {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%);
			animation: image_visible 2.5s linear;
		}


		@keyframes image_roted {
			0% {
				height: 5%;
				width: 5%;
			}

			100% {
				-webkit-transform: rotate(720deg);
				transform: rotate(720deg);
			}
		}

		@keyframes image_visible {
			0% {
				opacity: 0;
				height: 0%;
				width: 0%;
			}

			100% {
				opacity: 1;
			}
		}
	</style>
</head>

<body>
	<div id="mainDiv" class="main_container container shadow p-3 mb-5 bg-white rounded mt-5 w-75 text-center col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4">
		<div class="ic_container text-center">

			<div class="parent">
				<img class="image1" src=<?php echo $_status ? "../../../images/icon/ic_success_bg.svg" : "../../../images/icon/ic_fail_bg.svg"; ?> height="50px" width="50px" />
				<img class="image2" src=<?php echo $_status ? "../../../images/icon/ic_right_sign.svg" : "../../../images/icon/ic_cross_sign.svg"; ?> height="25px" width="25px" />
			</div>


			<h4 class="mt-3"><b>₹ <?php echo $GET_TXN_AMOUNT ?></b>.00</h4>
			<h5><?php echo $_status ? "Add money successful" :  "Fail to add money" ?></h5>

			<p><?php echo $_status ? "You have successfully add money to your 'Crush Pay' wallet" :  "Your transaction is failed. If money has been deducted from your account, your bank will inform us within 24 hrs and we will refund the same!" ?></p>
			<br>
			<p><?php echo $_message; ?></p>

			<hr class="w-25 mt-5">

			<p class="text-muted"><?php echo $POST_TXNDATE; ?></p>
			<p class="text-muted">TXNID: <?php echo ($_status || $POST_TXNID != "") ? $POST_TXNID : "Trnsaction id not found!"; ?></p>
			<p class="text-muted">Order Id: <?php echo ($_status || $GET_ORDER_ID != "") ? $GET_ORDER_ID : "Order id not found!"; ?></p>

			<hr>

			<img class="rounded-circle" alt="100x100" src="../../../images/ic_app_logo.svg" height="70px" width="70px">
			<div class="container shadow bg-white rounded mt-1 p-4 text-center">
				<p>Your <b>Crush Pay</b> current wallet balance:</p>
				<h6><b>₹ <?php echo $balance; ?></b></h6>
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

			$(document).ready(function () {
                function setNav() {
                    if (window.outerWidth < 768) {
                        console.log("Mobile Size");
                        $("#mainDiv").toggleClass("container shadow p-3 w-75");
                    }
                }
                setNav()
                $(window).resize(function () {
                    setNav();
                    console.log(window.outerWidth);
                });
            });
		</script>
</body>

</html>