<?php
include "connection.php";

function isAvailableUser($email)
{
    global $connection;

    $query = "SELECT * FROM user WHERE email = '$email'";

    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function getRequestData()
{
    return json_decode(file_get_contents('php://input'), true);
}

function getUriPath($uri)
{
    $uri = explode('/', $uri);
    unset($uri[0]);
    unset($uri[1]);
    unset($uri[4]);

    $newUri = "/" . implode('/', $uri);

    return str_replace("/api", "", $newUri);
}

function getTotalPage($tableName)
{
    global $connection;

    $query = "SELECT * FROM $tableName";
    $result = $connection->query($query);
    $totalPage = ceil($result->num_rows / 10);
    return $totalPage;
}

function getTotalItem($tableName)
{
    global $connection;

    $query = "SELECT COUNT(*) FROM $tableName";
    $result = $connection->query($query);
    $row = $result->fetch_row();
    return $row[0];
}
