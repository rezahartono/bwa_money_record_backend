<?php

$host = "localhost";
$port = "3306";
$user = "root";
$password = "";
$db_name = "money_record";

$connection = new mysqli($host, $user, $password, $db_name, $port);

// if ($connection) {
//     echo "Berhasil Konek";
// } else {
//     echo "Gagal Konek";
//     echo $connection->connect_error;
// }
