<?php
session_start();
include 'soapclient.php';
echo $_SESSION['userId'];
?>