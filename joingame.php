<?php

session_start();
$userId = $_SESSION['userId'];
$gameToJoinAutokey = $_GET['id'];
include 'soapclient.php';
include 'dbconnect.php';
ini_set("default_socket_timeout", 500);

$gameScreenUrl = "tictactoe.php";

$params = array(
    'uid' => $userId, 
    'gid' => $gameToJoinAutokey
);
try{
    $response = $client->joinGame($params);
    $result = $response->return;
    switch ($result){
        case 0:{
            $message = "Failed to join game";
            break;
        }
        case 'ERROR-DB':{
            $message = "Failed to connect to database";
            break;
        }
        case 1:{
            echo "You have joined an existing game - You will be redirected to the game screen shortly";
            //echo "<input name=id type=hidden method =get value=" . $gameToJoinAutokey . ">";
            header ("Refresh: 3;URL='$gameScreenUrl'"); 
            break;
        }
    }
}
catch (Exception $e) {
        echo "<h2>Exception Error!</h2>";
        echo $e->getMessage();
    }
    ?>
</form>