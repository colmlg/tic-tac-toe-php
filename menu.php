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
                <?php include 'mygamestable.php'; ?>   
                <?php include 'opengamestable.php'; ?> 
            </div>
        </div>
    </body>
</html>