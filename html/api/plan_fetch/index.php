<?php

//Recharge plan fetch api----------------------------
require("../../control/datavalidation.php");
require("../../control/var.php");



class PlanFetch
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function planFetch($APIID, $PASSWORD, $Operator_Code, $Circle_Code, $MobileNumber)
    {

        if ($this->classKey == "aJOEnt487d1JKbaj2s2bfbfcKf73") {
            //suport@cyrustechnoedge.com
            $url = "https://cyrusrecharge.in/API/CyrusPlanFatchAPI.aspx?APIID=" . $APIID . "&PASSWORD=" . $PASSWORD . "&Operator_Code=" . $Operator_Code . "&Circle_Code=" . $Circle_Code . "&MobileNumber=" . $MobileNumber . "&PageID=0&FORMAT=JSON";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            curl_close($curl);

            return $response;
        } else {
            return false;
        }
    }
}


// $_POST['token'] = "";
// $_POST['user_id'] = "";
// $_POST['phone'] = "";
// $_POST['cs'] = "";
// $_POST['optcode'] = "AT";
// $_POST['crclecode'] = "2";
// $_POST['number'] = "8638199107";


$response_array = array();
if (isset($_POST['token'])) {
    if (isset($_POST['user_id'])) {
        if (isset($_POST['phone'])) {
            if (isset($_POST['cs'])) {
                if (isset($_POST['optcode'])) {
                    if (isset($_POST['crclecode'])) {
                        if (isset($_POST['number'])) {

                            $data_validation_token = "aj2M31ds@JKbf&873";
                            $DataValidation = new DataValidation($data_validation_token);

                            $POST_userToken = $_POST['token'];
                            $POST_userId = $_POST['user_id'];
                            $operatorCode = $_POST['optcode'];
                            $circleCode = $_POST['crclecode'];
                            $number = $_POST['number'];
                            $checkSum = $_POST['cs'];

                            $puzzle = "2c7d1" . $POST_userId . "86d8095234134" . $POST_userToken;
                            $genCheckSum =  $DataValidation->genCheckSum($puzzle);

                            //$checkSum == $genCheckSum
                            if ($checkSum == $genCheckSum) {

                                $PlanFetch = new PlanFetch("aJOEnt487d1JKbaj2s2bfbfcKf73");

                                $planFetch = $PlanFetch->planFetch(CYRAPIID, CYRPLANPASS, $operatorCode, $circleCode, $number);

                                if ($planFetch) {
                                    $response_array['response'] = true;
                                    $response_array['data'] = json_decode($planFetch);
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
