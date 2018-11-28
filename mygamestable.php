<?php
include 'soapclient.php';
session_start();
$userId = $_SESSION['userId'];
$params = array(
    'uid' => $userId,
);
$response = $client->showAllMyGames($params);
$result = $response->return;
$games = explode("\n", (string) $result);
?>

<h4>My Games <small>(Games in progress)</small></h4>
<table class="table  table-striped">
    <thead>
        <th>Game Id</th>
        <th>Player 1</th>
        <th>Player 2</th>
        <th>Started Time</th>
        <th>Join</th>
    </thead>
    <?php
    if ($result == "ERROR-NOGAMES" || $result == "ERROR-DB") {
        echo  "<tr><td>$result</td><td></td><td></td><td></td><td></td></tr>";
        return;
    }
    foreach ($games as $row) {
        $gameDetailsSplit = explode(",", $row);
        echo "<tr><td>" . $gameDetailsSplit[0] . "</td><td>" . $gameDetailsSplit[1] . "</td><td>" . $gameDetailsSplit[2] . "</td><td>" . $gameDetailsSplit[3] . "</td><td>"
        . "<form id='games-form' action='open.php' method='get' role='form'>"
        . " <input name='id' type=hidden value='" . $gameDetailsSplit[0] . "'>"
        . " <input type='submit' value='Open'> </form></td></tr>";
    }
    ?>
</table>