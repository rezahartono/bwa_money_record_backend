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
    $result = $connection->query($query);
    $historyData = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $historyData[] = $row;
        }

        echo ResponseFormatter::success($uri, $historyData, 'Berhasil Ambil Data', $currentPage + 1, $result->num_rows, getTotalPage('history'), getTotalItem('history'),);
    } else {
        echo ResponseFormatter::success($uri, $historyData, 'Berhasil Ambil Data', $currentPage + 1, $result->num_rows, getTotalPage('history'), getTotalItem('history'),);
    }

    return $historyData;
}
