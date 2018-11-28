<?php
include 'soapclient.php';
$response = $client->leagueTable()->return;

$games = explode("\n", $response);
$players = array();
foreach($games as $game) {
    $components = explode(",", $game);
    $player1 = $components[1];
    $player2 = $components[2];
    if(!in_array($player1, $players)) {
        $players[] = $player1;
    }
    
    if(!in_array($player2, $players)) {
        $players[] = $player2;
    }
}

$wins = array_fill(0, count($players), 0);
$losses = array_fill(0, count($players), 0);
$draws = array_fill(0, count($players), 0);

foreach($games as $game) {
    $components = explode(",", $game);
    $params = array(
        'gid' => $components[0]
    );
    $result = $client->getGameState($params)->return;
            switch ($result) {
                case 1:
                    $index = array_search($components[1], $players);
                    $wins[$index] += 1;
                    $index = array_search($components[2], $players);
                    $losses[$index] += 1;
                    break;
                case 2:
                    $index = array_search($components[2], $players);
                    $wins[$index] += 1;
                    $index = array_search($components[1], $players);
                    $losses[$index] += 1;
                    break;
                case "3":
                    $index = array_search($components[1], $players);
                    $draws[$index] += 1;
                    $index = array_search($components[2], $players);
                    $draws[$index] += 1;
                default:
            }
}

?>
<html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>
        <div class="row affix-row">
            <?php include 'navbar.php' ?>
            <div class="container">
                <div class="page-header">
                    <h3><span class="glyphicon glyphicon-th"></span> Tic Tac Toe</h3>
                </div>
                <h4>Leaderboard</h4>
                <table class="table  table-striped">
                    <thead>
                    <th>Player</th>
                    <th>Wins</th>
                    <th>Losses</th>
                    <th>Draws</th>
                    </thead>
                <?php 
                    for($i = 0; $i < count($players); $i++) {
                        echo "<tr>";
                        echo "<td>" . $players[$i] . "</td><td>" . $wins[$i] . "</td><td>" . $losses[$i] . "</td><td>" . $draws[$i] . "</td>";
                        echo "</tr>";
                    }
                ?>
                </table>
            </div>
        </div>
    </body>
</html>