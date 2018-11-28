<?php
include 'soapclient.php';
session_start();
$board = array(
    array_fill(0, 3, ""),
    array_fill(0, 3, ""),
    array_fill(0, 3, "")
    );

$xPic = 'background-image: url(\'data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201%201%22%3E%3Cline%20x1%3D%220.1%22%20y1%3D%220.1%22%20x2%3D%220.9%22%20y2%3D%220.9%22%20stroke-width%3D%220.1%22%20stroke%3D%22red%22%2F%3E%3Cline%20x1%3D%220.1%22%20y1%3D%220.9%22%20x2%3D%220.9%22%20y2%3D%220.1%22%20stroke-width%3D%220.1%22%20stroke%3D%22red%22%2F%3E%3C%2Fsvg%3E\')';
$oPic = 'background-image: url(\'data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201%201%22%3E%3Ccircle%20cx%3D%220.5%22%20cy%3D%220.5%22%20r%3D%220.4%22%20fill%3D%22none%22%20stroke-width%3D%220.1%22%20stroke%3D%22blue%22%2F%3E%3C%2Fsvg%3E\')';


$params = array(
    'gid' => $_SESSION['gameId']
);
$gameBoard = $client->getBoard($params);
$result = $gameBoard->return;

if ($result == "ERROR-NOMOVES") {
    return;
}

$moves = explode("\n", (string) $result);
$lastMove = explode(",", end($moves)[0] . end($moves)[1]);
$lastMovePlayerId = $lastMove[0];
foreach ($moves as $move) {
    $move = (string) $move;
    $splitMove = split(",", $move);
    $playerId = $splitMove[0];
    $column = $splitMove[1];
    $row = $splitMove[2];
    $marker = $playerId == $_SESSION['userId'] ? $xPic : $oPic;
    $board[$row][$column] = $marker;
}

echo json_encode($board);