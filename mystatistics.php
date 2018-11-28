<?php
session_start();
include 'soapclient.php';
$username = $_SESSION['username'];
$params = array(
    'uid' => $_SESSION['userId']
);
$response = $client->showAllMyGames($params)->return;

$wins = 0;
$losses = 0;
$draws = 0;
$games = explode("\n", $response);

foreach ($games as $game) {
    $components = explode(',', $game);
    $params = array(
        'gid' => $components[0]
    );
    $result = $client->getGameState($params)->return;
    switch ($result) {
        case 1:
            $components[1] == $username ? $wins += 1 :$losses += 1;
            break;
        case 2:
            $components[2] == $username ? $wins += 1 :$losses += 1;
            break;
        case 3:
            $draws += 1;
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
                <h4>My Statistics</h4>
                <table class="table  table-striped">
                    <thead>
                    <th>Player</th>
                    <th>Wins</th>
                    <th>Losses</th>
                    <th>Draws</th>
                    </thead>
                    <?php
                        echo "<tr>";
                        echo "<td>" . $username . "</td><td>" . $wins . "</td><td>" . $losses . "</td><td>" . $draws . "</td>";
                        echo "</tr>";
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
