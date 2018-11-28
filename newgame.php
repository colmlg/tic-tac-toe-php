<?php

session_start();
$gameOwner = $_SESSION['userId'];
include 'soapclient.php';
$gameScreenUrl = "menu.php";

$params = array(
    'uid' => $gameOwner,
);

try {
    $response = $client->newGame($params);
    $gameId = $response->return;
    $_SESSION['gameId'] = $gameId;
    header("Refresh: 0;URL='$gameScreenUrl'");
} catch (Exception $e) {
    echo "<h2>Exception Error!</h2>";
    echo $e->getMessage();
}
    
