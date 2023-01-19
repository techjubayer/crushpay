<?php
class DBConnection
{
    private $db_cnn_token;
    function __construct($tk)
    {
        $this->db_cnn_token = $tk;
    }

    function dbConn($user, $password, $db)
    {
        if ($this->db_cnn_token == "2M31ds@f8JKbfajdsb73") {
            try {
                $server = "localhost";
                $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
                if($conn){
                    return $conn;
                }else{
                    return false;
                }                
            } catch (PDOException $e) {
                return $e;
            }
        } else {
            return false;
        }
    }
}
