<?php


define('DOMAIN', "localhost");
define('DOMAIN_ORIGIN', "http://localhost/My%20Sites/crushpay.in/html");


//Here I set cookie for 1hour, if set 1 day then multiply 24
define('SESSION_EXPIRE', (60 * 60));


define('MAX_OTP_POST_TRY', 4);
define('MAX_OTP_RECEIVE', 3);
