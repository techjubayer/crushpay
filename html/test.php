<?php
function fetchTransactionHistory($conn, $user_phone, $user_id)
{
    $query = "SELECT `amount`, `fromuserid`, `fromphnem`, `touserid`, `tophnem` FROM `money_trans_history` WHERE (`fromphnem`= :user_phone AND `fromuserid`= :user_id_ ) OR (`tophnem` = :user_phone AND `touserid` = :user_id_) AND `status` = 'Success'";
    $data = $conn->prepare($query);
    $data->execute([
        'user_phone' => $user_phone,
        'user_id_' => $user_id
    ]);

    if ($data->rowCount() != 0) {

        // foreach ($data as $row) {
        //     echo $row['amount'];
        // }

        $credit = 0;
        $debit = 0;
        foreach ($data as $row) {
            if ($user_phone == $row['fromphnem'] && $user_id == $row['fromuserid']) {
                // $debit = $debit + $row['amount'];
                echo "Debit: ". $row['amount'];
            } else {
                echo "Credit: ". $row['amount'];
                // $credit = $credit + $row['amount'];
            }
        }

        // return $credit - $debit;
    } else {
        echo false;
    }
}


$server = "localhost";
$user = "crush_user";
$password = "ziKuT@iW5.aB72pz";
$db = "crushpay_transaction";

$conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

fetchTransactionHistory($conn, "8638199107", "713039ee");
