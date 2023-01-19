<?php
// User login file



class UserValidation
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function fetchUserData($conn, $email_phone, $password)
    {
        if ($this->classKey == "3545aehnq6SJOEnt487lge4c") {
            $query = "SELECT `user_id`, `user_phone`, `user_email` FROM `crushpay_users` WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone) AND `password` = :password_";
            $data = $conn->prepare($query);
            $data->execute([
                'email_phone' => $email_phone,
                'password_' => $password
            ]);
            $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function checkUser($conn, $token_cookie, $user_id_cookie, $user_phone_cookie)
    {
        if ($this->classKey == "3545aehnq6SJOEnt487lge4c") {
            $query = "SELECT `user_name`, `balance` FROM `crushpay_users` WHERE (`user_email`= :email_phone OR `user_phone`= :email_phone) AND `token` = :token AND `user_id` = :user_id";
            $data = $conn->prepare($query);
            $data->execute([
                'email_phone' => $user_phone_cookie,
                'token' => $token_cookie,
                'user_id' => $user_id_cookie
            ]);
            $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function updateToken($conn, $token, $email, $phone, $password)
    {
        if ($this->classKey == "3545aehnq6SJOEnt487lge4c") {
            $query = "UPDATE `crushpay_users` SET `token` = :token WHERE `user_email`= :email_ AND `user_phone`= :phone_ AND `password` = :password_";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'token' => $token,
                'email_' => $email,
                'phone_' => $phone,
                'password_' => $password
            ]);

            if ($response) {
                return true;
            } else {
                return false;
            }
        }
    }


    // SIGN UP FUNCTIONS------------------------------------
    
    function checkNewEmail($conn, $email)
    {
        if ($this->classKey == "6SJlOEntehGlahnqge4c") {
            $query = "SELECT `user_email` FROM `crushpay_users` WHERE `user_email`= :email";
            $data = $conn->prepare($query);
            $data->execute(['email' => $email]);
            $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() == 0) {
                return false;   //Phone and Email not registered
            } else {
                return "Email address already registered with different account";
            }
        } else {
            return "Something went wrong, please try again";
        }
    }



    function checkNewPhone($conn, $phone)
    {
        if ($this->classKey == "6SJlOEntehGlahnqge4c") {
            $query = "SELECT `user_phone` FROM `crushpay_users` WHERE `user_phone`= :phone";
            $data = $conn->prepare($query);
            $data->execute(['phone' => $phone]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() == 0) {
                return false;   //Phone and Email not registered
            } else {
                return "Phone number already registered with different account";
            }
        } else {
            return "Something went wrong, please try again";
        }
    }


    function tempUserRegister($conn, $user_token, $user_id, $user_name, $phone, $email, $plane_pass, $pass, $phone_otp)
    {
        if ($this->classKey == "6SJlOEntehGlahnqge4c") {
            $query = "INSERT INTO `temp_users` (
                `token`,
                `user_id`,
                `user_name`,
                `user_phone`,
                `user_email`,
                `plane_pass`,
                `password`,
                `phone_otp`,
                `joining_date`) VALUES (
                    :user_token, 
                    :user_id_, 
                    :user_name_, 
                    :phone, 
                    :email, 
                    :plane_pass, 
                    :pass, 
                    :phone_otp,
                    :joining_date)";

            $result = $conn->prepare($query);
            $response = $result->execute([
                'user_token' => $user_token,
                'user_id_' => $user_id,
                'user_name_' => $user_name,
                'phone' => $phone,
                'email' => $email,
                'plane_pass' => $plane_pass,
                'pass' => $pass,
                'phone_otp' => $phone_otp,
                'joining_date' => date("Y-m-d H:i:s")
            ]);

            if ($response) {
                return true;   //All resutls are insert successfully
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    // OTP VALIDATION--------------------------------------
    function temp_usersFetch($conn, $email, $phone, $user_token)
    {
        if ($this->classKey == "OEntehGlah6SJlnqge4c") {
            $query = "SELECT * FROM `temp_users` WHERE `token`= :token AND `user_phone`= :user_phone AND `user_email` = :user_email";
            $data = $conn->prepare($query);
            $data->execute(['token' => $user_token,  'user_phone' => $phone, 'user_email' => $email]);
            $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function optVarify($result, $phone_otp)
    {
        if ($this->classKey == "OEntehGlah6SJlnqge4c") {
            if ($result['phone_otp'] == $phone_otp) {
                return false;
            } else {
                return "Phone otp not match";;
            }
        } else {
            return "Something went wrong, please try again";
        }
    }

    function finalUserRegister($conn, $user_id, $user_name, $user_email, $password, $device_id, $token, $user_phone, $refer_code, $refered_by)
    {
        if ($this->classKey == "OEntehGlah6SJlnqge4c") {
            $query = "INSERT INTO `crushpay_users` (
                `user_id`, 
                `user_name`, 
                `user_email`, 
                `password`, 
                `device_id`, 
                `token`, 
                `user_phone`, 
                `refer_code`,
                `refered_by`) VALUES (:user_id_, 
                                        :user_name_, 
                                        :user_email, 
                                        :password_, 
                                        :device_id,
                                        :token,
                                        :user_phone, 
                                        :refer_code,
                                        :refered_by)";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'user_id_' => $user_id,
                'user_name_' => $user_name,
                'user_email' => $user_email,
                'password_' => $password,
                'device_id' => $device_id,
                'token' => $token,
                'user_phone' => $user_phone,
                'refer_code' => $refer_code,
                'refered_by' => $refered_by
            ]);

            if ($response) {
                return false;
            } else {
                return "This email and phone number is already registered with different account";
            }
        } else {
            return "Something went wrong, please try again";
        }
    }
}
