<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style>

        h1 {
  text-align: center;
}
td {
  width: 100px;
  height: 100px;
}
table {
  margin: 5px auto;
}
.vert {
  border-left: 2px solid black;
  border-right: 2px solid black;
}
.hori {
  border-top: 2px solid black;
  border-bottom: 2px solid black;
}
</style>
</head>

<?php
session_start();

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
<h1>Tic Tac Toe</h1>
<table>
  <tr>
    <td></td>
    <td class="vert"></td>
    <td></td>
  </tr>
  <tr>
    <td class="hori"></td>
    <td class="vert hori"></td>
    <td class="hori"></td>
  </tr>
  <tr>
    <td></td>
    <td class="vert"></td>
    <td></td>
  </tr>
</table>

