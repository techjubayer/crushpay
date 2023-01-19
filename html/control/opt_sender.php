<?php

class OtpSender
{

    private $cnn_token;
    function __construct($tk)
    {
        $this->cnn_token = $tk;
    }
    
    
    function sendMobileOTP($mobile, $message, $sender_token){
        if ($this->cnn_token == "83aj2M%31ds@JKbf&") {
            $fields = array(
                "sender_id" => "TXTIND",
                "message" => $message,
                "route" => "v3",
                "numbers" => $mobile,
            );

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($fields),
          CURLOPT_HTTPHEADER => array(
            "authorization: ".$sender_token,
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              return false;
            } else {
              return true;
            }
        }
    }
}
?>