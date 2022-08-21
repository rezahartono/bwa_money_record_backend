<?php

include "../../Common.php";
include "../../connection.php";
include "../../ResponseFormatter.php";

$uri = getUriPath($_SERVER['REQUEST_URI']);

getAll(10, $uri);

function getAll($rowPerPage, $uri)
{
    global $connection;
    $query = "SELECT * FROM history LIMIT $rowPerPage";
    $result = $connection->query($query);
    $historyData = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $historyData[] = $row;
        }

        echo ResponseFormatter::success($uri, $historyData, 'Berhasil Ambil Data', 1, $result->num_rows, getTotalPage('history'), getTotalItem('history'),);
    } else {
        echo ResponseFormatter::error($uri, null, 'Gagal Ambil Data!');
    }

    return $historyData;
}
