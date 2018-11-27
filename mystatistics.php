<?php

session_start();
$userId = $_SESSION['userId'];
include 'soapclient.php';
include 'dbconnect.php';
ini_set("default_socket_timeout", 500);

$response = $client->leagueTable();
$result = $response->return;
$gameDetails = explode("\n", (string)$result);
echo $result;

   /* echo "<table border=1>"; 
    echo "<th>Game Id</th><th>Game Creator</th><th>Started Time</th><th>Join</th>";
    foreach ($gameDetails as $row){
        $gameDetailsSplit = split(",", $row);
        echo "<tr><td>" . $gameDetailsSplit[0] . "</td><td>" . $gameDetailsSplit[1] . "</td><td>" . $gameDetailsSplit[2] . "</td>" . "<td>"
                 . "<form id='games-form' action='joingame.php' method='get' role='form'>"
                 . " <input name=id type=hidden value='". $gameDetailsSplit[0] . "'>"
                 . " <input type='submit' value='Join'> </form></td></tr>";
    }
    echo "</table>";
*/
?>
