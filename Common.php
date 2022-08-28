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
    $uri = explode("/", parse_url($uri, PHP_URL_PATH));
    unset($uri[0]);
    unset($uri[1]);
    unset($uri[2]);

    $newUri = "/" . implode('/', $uri);

    return str_replace(".php", "", $newUri);
}

function getTotalPage($tableName, $where)
{
    global $connection;

    $query = "SELECT * FROM $tableName WHERE $where";
    $result = $connection->query($query);
    $totalPage = ceil($result->num_rows / 10);
    return $totalPage == 0 ? 1 : $totalPage;
}

function getTotalItem($tableName, $where)
{
    global $connection;

    $query = "SELECT COUNT(*) FROM $tableName WHERE $where";
    $result = $connection->query($query);
    $row = $result->fetch_row();
    return (int)$row[0]  == 0 ? 1 : (int)$row[0];
}
