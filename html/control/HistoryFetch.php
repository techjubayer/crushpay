<?php


class HistoryFetch
{
    private $classKey;
    function __construct($classKey)
    {
        $this->classKey = $classKey;
    }

    function fetchRcHistory($conn, $user_id, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `number`, `oprt_code`, `usertx`, `amount`, `profit`, `TransDate`, `Status` FROM `recharge_history` WHERE `user_phone`= :user_phone  AND `user_id` = :user_id_ ORDER BY `Sl_No` DESC LIMIT 60";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);

            if ($data->rowCount() != 0) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function fetchAddMoneyHistory($conn, $user_id, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `order_id`, `txn_amount`, `status`, `txn_date` FROM `tnx_add_money` WHERE `phone`= :user_phone  AND `customer_id` = :user_id_ AND `status` != 'PROCEED' ORDER BY `Sl. No.` DESC LIMIT 100";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function fetchTransactionHistory($conn, $user_phone, $user_id)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `txn_id`, `amount`, `fromuserid`, `fromphnem`, `fromusrname`, `touserid`, `tophnem`, `tousername`, `txndate` FROM `money_trans_history` WHERE (`fromphnem`= :user_phone  AND `fromuserid`= :user_id_ ) OR (`tophnem` = :user_phone AND `touserid` = :user_id_) ORDER BY `Sl_No` DESC LIMIT 100";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function fetchReferHistory($conn, $user_id_, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `refered_name`, `refered_email`, `amount`, `date_`, `status_` FROM `refer_user` WHERE (`user_id`= :user_id_  AND `user_phone`= :user_phone ) ORDER BY `Sl_No` DESC LIMIT 100";
            $data = $conn->prepare($query);
            $data->execute([
                'user_id_' => $user_id_,
                'user_phone' => $user_phone
            ]);
            // $result = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() != 0) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
