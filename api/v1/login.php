<?php

include "../../Common.php";
include "../../connection.php";
include "../../ResponseFormatter.php";
include "../../models/User.php";

$requestData = getRequestData();
$uri = getUriPath($_SERVER['REQUEST_URI']);

if (isset($requestData['email'])) {
    $email = $requestData['email'];
    $password = sha1($requestData['password']);

    apiLogin($email, $password, $uri);
}

function apiLogin($email, $password, $uri)
{
    global $connection;
    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = $connection->query($query);
    $userData = User::setUser($result->fetch_assoc());

    if ($result->num_rows > 0) {
        echo ResponseFormatter::success($uri, $userData, 'Login Success');
    } else {
        echo ResponseFormatter::error($uri, null, 'Login Failed');
    }
}
