<?php



$PAYTM_ENVIRONMENT = "PROD";	// For Production LIVE
// $PAYTM_ENVIRONMENT = "TEST";	// For Staging TEST

if (!defined("PAYTM_ENVIRONMENT")) {
	define('PAYTM_ENVIRONMENT', $PAYTM_ENVIRONMENT);
}

$PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
$PAYTM_TXN_URL = 'https://securegw-stage.paytm.in/theia/processTransaction';

// $PAYTM_MERCHANT_MID = "zUHxAP47626515860472";	
// $PAYTM_MERCHANT_KEY = "g@Y__ApRtIFgTOLr";	

$PAYTM_MERCHANT_MID = "MPnVyI32489761845772";	
$PAYTM_MERCHANT_KEY = "7ocdGFBil81fZ1wy";	

$PAYTM_CHANNEL_ID 	= "WEB";	
$PAYTM_INDUSTRY_TYPE_ID = "Retail";	
// $PAYTM_MERCHANT_WEBSITE = "crushpay.in";	
$PAYTM_MERCHANT_WEBSITE = "WEBSTAGING";	

// $PAYTM_CALLBACK_URL 	= "http://localhost/Local%20Host%20Websites/Crush%20Pay/AWS%20Site/payments/paytm/PaytmKit/paytm_response.php";



define('PAYTM_MERCHANT_KEY', $PAYTM_MERCHANT_KEY);
define('PAYTM_MERCHANT_MID', $PAYTM_MERCHANT_MID);

define("PAYTM_MERCHANT_WEBSITE", $PAYTM_MERCHANT_WEBSITE);
define("PAYTM_CHANNEL_ID", $PAYTM_CHANNEL_ID);
define("PAYTM_INDUSTRY_TYPE_ID", $PAYTM_INDUSTRY_TYPE_ID);
// define("PAYTM_CALLBACK_URL", $PAYTM_CALLBACK_URL);


define('PAYTM_REFUND_URL', '');
define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
