<?php

$gameToJoinAutokey = $_GET['id'];
$_SESSION['gameId'] = $gameToJoinAutokey;
$gameScreenUrl = "tictactoe.php";
header ("Refresh: 0;URL='$gameScreenUrl'"); 
