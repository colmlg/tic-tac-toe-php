<?php
include 'soapclient.php';

ini_set("default_socket_timeout", 500);

$username = $_POST['username'];
$password = $_POST['password'];
if(!isset($username) || !isset($password)) {
    header('index.php');
    return;
}

$params = array(
    'username' => $username,
    'password' => $password
);

try {
    $response = $client->login($params);
    $userId = $response->return;
    echo $userId;
} catch (Exception $e) {
        echo "<h2>Exception Error!</h2>";
        echo $e->getMessage();
    }
