<?php
include 'soapclient.php';
$response = $client->showOpenGames();
$result = $response->return;
$games = explode("\n", (string) $result);
?>

<h4>Open Games <small>(Awaiting second player)</small></h4>
<table class="table  table-striped">
    <thead>
        <th>Game Id</th>
        <th>Game Creator</th>
        <th>Started Time</th>
        <th>Join</th>
    </thead>
    <?php
    if ($result == "ERROR-NOGAMES" || $result == "ERROR-DB") {
        echo  "<tr><td>$result</td><td></td><td></td><td></td></tr>";
        return;
    }
    foreach ($games as $row) {
        $gameDetailsSplit = explode(",", $row);
        echo "<tr><td>" . $gameDetailsSplit[0] . "</td><td>" . $gameDetailsSplit[1] . "</td><td>" . $gameDetailsSplit[2] . "</td>" . "<td>"
        . "<form id='games-form' action='joingame.php' method='get' role='form'>"
        . " <input name='id' type=hidden value='" . $gameDetailsSplit[0] . "'>"
        . " <input type='submit' value='Join'> </form></td></tr>";
    }
    ?>
</table>