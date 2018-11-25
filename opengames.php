<?php

session_start();
$userId = $_SESSION['userId'];
include 'soapclient.php';
ini_set("default_socket_timeout", 500);

$user = 'root';
$pass = '';
$db = 'tttexample';
$dbconnect = new mysqli('localhost', $user, $pass, $db) or die ("unable to connect");


    if ($result = $dbconnect->query("SELECT * from games")) {

    echo "<table border=1>"; 
    echo "<th>Game Started Time</th><th>Game Creator</th><th>Join</th>";
    
    while($row = mysqli_fetch_array($result)){  
        if(is_null($row['p2'])){
            echo "<tr><td>" . $row['started'] . "<td>" . $row['autokey']. "</td>" . "</td> <td>"
                 . "<form id='games-form' action='joingame.php' method='get' role='form'>"
                 . " <input name=id type=hidden value='".$row['autokey']."'>"
                 . " <input type='submit' value='Join'> </form></td></tr>";

        }
    }

    echo "</table>";
    $result->close();
}



?>
