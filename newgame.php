<?php
session_start();
$gameOwner = $_SESSION['userId'];
include 'soapclient.php';
$gameScreenUrl = "tictactoe.php";

$params = array(
    'uid' => $gameOwner,
);

try {
    $response = $client->newGame($params);
    $gameId = $response->return;
    $_SESSION['gameId'] = $gameId;
    echo "You have created a new game - You will be redirected to the game screen shortly";
    
    header ("Refresh: 3;URL='$gameScreenUrl'"); 
    } catch (Exception $e) {
        echo "<h2>Exception Error!</h2>";
        echo $e->getMessage();
    }
    
