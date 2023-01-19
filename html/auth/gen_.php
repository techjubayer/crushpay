
<?php
require("../control/datavalidation.php");
// date_default_timezone_set('Asia/Kolkata');




$response_array = array();


if (isset($_POST['from'])) {
    if (isset($_POST['em_ph'])) {
        if (isset($_POST['pass'])) {

            $data_validation_token = "aj2M31ds@JKbf&873";
            $DataValidation = new DataValidation($data_validation_token);


            $request_from = $DataValidation->sanitize($_POST['from']);
            $email_phone = $DataValidation->sanitize($_POST['em_ph']);
            $genFontendPass = $DataValidation->genFontendPass($_POST['pass']);

            $puzzle = "";
            if ($request_from == "login") {
                $puzzle = "2c21237d1" . $email_phone . "86JKb58fajds7";
            } else if ($request_from == "sign_up") {
                $puzzle = "6JKb58fa2c21237d1" . $email_phone . "58fajds8fajds7";
            } else if ($request_from == "otp") {
                $puzzle = "58fa2c2c21237d1" . $email_phone . "fajdsKb58fajds7";
            }



            $genCheckSum =  $DataValidation->genCheckSum($puzzle);

            $response_array['response'] = true;
            $response_array['cs'] = $genCheckSum;
            $response_array['pass'] = $genFontendPass;
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

?>