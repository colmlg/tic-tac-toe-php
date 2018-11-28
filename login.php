<?php
session_start();
include 'soapclient.php';
ini_set("default_socket_timeout", 500);
include 'dbconnect.php';
$username = $_POST['username'];
$password = $_POST['password'];
$referrer = $_SERVER['HTTP_REFERER']; 

if(empty($username) || empty($password)) {
    invalidData("You have submitted empty form data - Returning to login screen", $referrer);
    return;
}

$params = array(
    'username' => $username,
    'password' => $password,
);

try {
    $referrer = $_SERVER['HTTP_REFERER']; 
    $response = $client->login($params);
    $userId = $response->return;
    $_SESSION['username'] = $username;
    if ($userId == -1){
        invalidData("Incorrect login details - Returning to login screen", $referrer);
    }
    else
        confirmLogin($userId);
    } catch (Exception $e) {
        echo "<h2>Exception Error!</h2>";
        echo $e->getMessage();
    }
    
function confirmLogin($userId){
    $_SESSION['userId'] = $userId;
    header('Location: menu.php');
}

function invalidData($message, $referrer){
    echo $message;
    header ("Refresh: 2;URL='$referrer'");
    return;
}