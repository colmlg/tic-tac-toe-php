<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style>
#tic-tac-toe
{
	border-collapse: collapse;
}
#tic-tac-toe td
{
	width: 30vmin;
	height: 30vmin;
	padding: 0;
	border: 1px solid black;
	color: transparent;
}
#tic-tac-toe .piece-x
{
	background-image: url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201%201%22%3E%3Cline%20x1%3D%220.1%22%20y1%3D%220.1%22%20x2%3D%220.9%22%20y2%3D%220.9%22%20stroke-width%3D%220.1%22%20stroke%3D%22red%22%2F%3E%3Cline%20x1%3D%220.1%22%20y1%3D%220.9%22%20x2%3D%220.9%22%20y2%3D%220.1%22%20stroke-width%3D%220.1%22%20stroke%3D%22red%22%2F%3E%3C%2Fsvg%3E');
}
#tic-tac-toe .piece-o
{
	background-image: url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201%201%22%3E%3Ccircle%20cx%3D%220.5%22%20cy%3D%220.5%22%20r%3D%220.4%22%20fill%3D%22none%22%20stroke-width%3D%220.1%22%20stroke%3D%22blue%22%2F%3E%3C%2Fsvg%3E');
}
#tic-tac-toe button
{
	display: block;
	border: none;	
	width: 100%;
	height: 100%;
	cursor: pointer;
        
        
}
#tic-tac-toe button::-moz-focus-inner
{
	border: none;
}
#tic-tac-toe button:focus
{
	background: silver;
}

</style>
</head>

<?php
session_start();
$output = "Game Started";
$isMyTurn = checkTurn();
$gameId = $_SESSION['gameId'];
$userId = $_SESSION['userId'];
if (!empty($_POST['cell'])){
    checkForInput();
}

function checkSelected(){
    $square = $POST_['location'];
    echo 'style="background-image: url(\'data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201%201%22%3E%3Ccircle%20cx%3D%220.5%22%20cy%3D%220.5%22%20r%3D%220.4%22%20fill%3D%22none%22%20stroke-width%3D%220.1%22%20stroke%3D%22blue%22%2F%3E%3C%2Fsvg%3E\')"';
}
function checkForInput(){
    include 'soapclient.php'; 
    $cellCoords = split(",", $_POST['cell']);
    $x = $cellCoords[0];
    $y = $cellCoords[1];
    
    $moveDetails = array(
        'x' => $x,
        'y' => $y,
        'gid' => $_SESSION['gameId'],
        'pid' => $_SESSION['userId']
    );
    squareClicked($moveDetails);
}
function checkTurn(){
    include 'soapclient.php';
    $params = array(
        'gid' => $_SESSION['gameId']
    );
    $gameBoard = $client->getBoard($params);
    $result = $gameBoard->return;
    $moves = explode("\n" ,(string)$result);
    $lastMove = explode(",", end($moves)[0].end($moves)[1]);
    $lastMovePlayerId = $lastMove[0];
    if ($lastMovePlayerId == $_SESSION['userId']){
        $GLOBALS['output'] = "It is not your turn\n";
        return false;
    }
    else{
        return true;
    }
}
function updateGameState($gid, $gstate){
    include 'soapclient.php';
    $params = array(
        'gid' => $gid,
        'gstate' => $gstate
    );
    $update = $client->setGameState($params);
}
function checkForWin(){
    include 'soapclient.php';
    $params = array(
        'gid' => $_SESSION['gameId']
    );
    $response = $client->checkWin($params);
    $result = $response->return;
    $gameResult = "";
    switch ($result){
        case 0: {
            $gameResult = "Ongoing";
            break;
        }
        case 1: {
            $GLOBALS['output'] = "Player 1 has won. Game over - You will be redirected to the main menu";
            updateGameState($_SESSION['gameId'], 1);
            header ("Refresh: 5;URL='menu.php'");
            break;
        }
        case 2: {
            $GLOBALS['output'] = "Player 2 has won. Game over - You will be redirected to the main menu";
            updateGameState($_SESSION['gameId'], 2);
            header ("Refresh: 5;URL='menu.php'");
            break;
        }
        case 3: {
            $GLOBALS['output'] = "Game is a draw. Game over - You will be redirected to the main menu";
            updateGameState($_SESSION['gameId'], 3);
            header ("Refresh: 5;URL='menu.php'");
            break;
        }
        case "ERROR-RETRIEVE": {
            $gameResult = "Error retrieving";
            break;
        }
        case "ERROR-DB": {
            $gameResult = "DB Error";
            break;
        }
    }
}
function updateGameBoard(){
    include 'soapclient.php'; 
    $params = array(
        'gid' => $_SESSION['gameId']
    );
    $gameBoard = $client->getBoard($params);
    $result = $gameBoard->return;
    $moves = explode("\n" ,(string)$result);
    $lastMove = explode(",", end($moves)[0].end($moves)[1]);
    $lastMovePlayerId = $lastMove[0];
    foreach($moves as $move){
        $move = (string)$move;
        $splitMove = split(",", $move);
        $playerId = $splitMove[0];
        $column = $splitMove[1];
        $row = $splitMove[2];
        
        //update UI to show moves taken
    }
    checkForWin();
}
function squareClicked($moveDetails){
    include 'soapclient.php'; 
    if ($GLOBALS['isMyTurn'] == true){
        $response = $client->takeSquare($moveDetails);
        $result = $response->return;
        
        switch ($result){
            case 0: {
                $GLOBALS['output'] = "Problem adding square to table";
                break;
            }
            case 1: {
                $GLOBALS['output'] = "Square Successfully Selected";
                break;
            }
            case "ERROR-TAKEN": {
                $GLOBALS['output'] = "Square Taken";
                break;
            }
            case "ERROR-DB": {
                $GLOBALS['output'] = "Failed to connect to db";
                break;
            }
            case "ERROR": {
                $GLOBALS['output'] = "Unknown error";
                break;
            }
        }
        if ($GLOBALS['isMyTurn'] == true){
            updateGameBoard();
        }
        else {
            echo "It is not your turn";
        }
    }
}
?>

<div class="row affix-row">
    <div class="col-sm-3 col-md-2 affix-sidebar">
		<div class="sidebar-nav">
  <div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <span class="visible-xs navbar-brand">Sidebar menu</span>
    </div>
    <div class="navbar-collapse collapse sidebar-navbar-collapse">
      <ul class="nav navbar-nav" id="sidenav01">
        <li class="active">
          <a href="menu.php" data-toggle="collapse" data-target="#toggleDemo0" data-parent="#sidenav01" class="collapsed">
          <h4>
          Control Panel
          <br>
          </h4>
          </a>
          <div class="collapse" id="toggleDemo0" style="height: 0px;">
            <ul class="nav nav-list">
              <li><a href="#">ProfileSubMenu1</a></li>
              <li><a href="#">ProfileSubMenu2</a></li>
              <li><a href="#">ProfileSubMenu3</a></li>
            </ul>
          </div>
        </li>
        <li><a href="newgame.php"><span class="glyphicon glyphicon-plus"></span> Create New Game</a></li>
        <li><a href="opengames.php"><span class="glyphicon glyphicon-align-center"></span> Join Existing Game <span class="badge pull-right">42</span></a></li>
        <li><a href=""><span class="glyphicon glyphicon-signal"></span> Leaderboard</a></li>
        <li><a href=""><span class="glyphicon glyphicon-info-sign"></span> Your Statistics</a></li>
      </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
	</div>
	<div class="col-sm-9 col-md-10 affix-content">
		<div class="container">
			
				<div class="page-header">
	<h3><span class="glyphicon glyphicon-th"></span> Tic Tac Toe</h3>
</div	
		</div>
	</div>
</div>
<div style="padding-left: 930px; padding-bottom: 10px">
<textarea rows="4" cols="50">
<?php echo $GLOBALS['output'] ?>
</textarea>
</div>
<div style="padding-left: 700px">
    <table id="tic-tac-toe">
            <tbody>
                    <tr>

                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST" value="00" id="location">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="0,0"></button>

                                </td>
                            </form>
                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="0,1"></button>

                                </td>
                            </form>
                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="0,2"></button>

                                </td>
                            </form>
                    </tr>
                    <tr>
                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="1,0"></button>

                                </td>
                            </form>
                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="1,1"></button>

                                </td>
                            </form>
                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="1,2"></button>

                                </td>
                            </form>
                    </tr>
                    <tr>
                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="2,0"></button>

                                </td>
                            </form>
                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="2,1"></button>

                                </td>
                            </form>
                            <form method="POST" action="tictactoe.php">
                                <td>
                                        <input type="hidden" method="POST">
                                        <button type="submit" name="cell" data-row="0" data-column="0" value="2,2"></button>

                                </td>
                            </form>
                    </tr>
            </tbody>
    </table>
</div>