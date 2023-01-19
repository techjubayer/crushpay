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
            $query = "SELECT `amount`, `profit` FROM `recharge_history` WHERE `user_phone`= :user_phone  AND `user_id` = :user_id_ AND `Status` = 'Success'";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);

            if ($data->rowCount() != 0) {
                $credit = 0;
                $debit = 0;
                foreach ($data as $row) {
                    $debit  = $debit + $row['amount'];
                    $credit  = $credit + $row['profit'];
                }

                return $credit - $debit;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function fetchAddMoneyHistory($conn, $user_id, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `txn_amount` FROM `tnx_add_money` WHERE `phone`= :user_phone  AND `customer_id` = :user_id_ AND `status` = 'TXN_SUCCESS'";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);

            if ($data->rowCount() != 0) {
                $credit = 0;
                foreach ($data as $row) {
                    $credit  = $credit + $row['txn_amount'];
                }

                return $credit;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function fetchTransactionHistory($conn, $user_id, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `amount`, `fromuserid`, `fromphnem`, `touserid`, `tophnem` FROM `money_trans_history` WHERE (`fromphnem`= :user_phone AND `fromuserid`= :user_id_ ) OR (`tophnem` = :user_phone AND `touserid` = :user_id_) AND `status` = 'Success'";
            $data = $conn->prepare($query);
            $data->execute([
                'user_phone' => $user_phone,
                'user_id_' => $user_id
            ]);

            if ($data->rowCount() != 0) {
                $credit = 0;
                $debit = 0;
                foreach ($data as $row) {
                    if ($user_phone == $row['fromphnem'] && $user_id == $row['fromuserid']) {
                        $debit = $debit + $row['amount'];
                    } else {
                        $credit = $credit + $row['amount'];
                    }
                }

                return $credit - $debit;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function fetchReferHistory($conn, $user_id_, $user_phone)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "SELECT `amount`  FROM `refer_user` WHERE (`user_id`= :user_id_  AND `user_phone`= :user_phone AND `status_` = 'success')";
            $data = $conn->prepare($query);
            $data->execute([
                'user_id_' => $user_id_,
                'user_phone' => $user_phone
            ]);

            if ($data->rowCount() != 0) {
                $credit = 0;
                foreach ($data as $row) {
                    $credit  = $credit + $row['amount'];
                }

                return $credit;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function updateUserBalance($conn, $balance, $_phone, $user_id, $token)
    {
        if ($this->classKey == "bfaJOEnt487d1JKbaj2s2bfcKf73") {
            $query = "UPDATE `crushpay_users` SET `balance` = :balance WHERE `user_phone`= :_phone  AND `user_id` = :user_id_ AND  `token` = :token_";
            $result = $conn->prepare($query);
            $response = $result->execute([
                'balance' => $balance,
                '_phone' => $_phone,
                'user_id_' => $user_id,
                'token_' => $token
            ]);

            if ($response) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}
