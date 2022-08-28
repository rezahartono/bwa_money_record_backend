<?php

include "../../Common.php";
include "../../connection.php";
include "../../ResponseFormatter.php";

$uri = getUriPath($_SERVER['REQUEST_URI']);
$userId = $_GET['user_id'];
$currentPage = 0;

if (isset($_GET['page'])) {
    $currentPage = ceil($_GET['page'] - 1);
}

getAll(10, $uri, $userId, $currentPage);

function getAll($rowPerPage, $uri, $userId, $currentPage)
{
    global $connection;
    $query = "SELECT * FROM history WHERE user_id = $userId LIMIT $rowPerPage OFFSET " . ceil($rowPerPage * $currentPage) . "";
    $data = $connection->query($query);
    $historyData = array();
    $result = null;


    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            $historyData[] = $row;
        }

        $result = ResponseFormatter::success($uri, $historyData, 'Berhasil Ambil Data', $currentPage + 1, $data->num_rows, getTotalPage('history', "user_id = $userId"), getTotalItem('history', "user_id = $userId"),);
    } else {
        $result = ResponseFormatter::success($uri, $historyData, 'Berhasil Ambil Data', $currentPage + 1, $data->num_rows, getTotalPage('history', "user_id = $userId"), getTotalItem('history', "user_id = $userId"),);
    }

    echo $result;
}
