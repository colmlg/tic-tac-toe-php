<?php

include 'soapclient.php';
include 'dbconnect.php';
ini_set("default_socket_timeout", 500);

$name = $_POST['name'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$referrer = $_SERVER['HTTP_REFERER']; 

if(empty($name) || empty($surname) || empty($username) || empty($password)) {
    echo "You have submitted empty form data - Returning to register page";
    header ("Refresh: 5;URL='$referrer'"); 
    return;
}
else{
    $params = array(
        'name' => $name,
        'surname' => $surname,
        'username' => $username,
        'password' => $password
    );
    
        $response = $client->register($params);
        $result = $response->return;
        
        switch($result){
            case ($result > 0):{
                header('Location: loginpage.php');
                break;
            }
            
            case($result == 'ERROR-REPEAT'):{
                echo "User already exists";
                break;
               
            }
            
            case ($result == 'ERROR-INSERT'):{
                echo "Failed to inssert data";
                break;  
                }
            
            case ($result == 'ERROR-RETRIEVE'):{
                echo "Failed to retrieve data";
                break;
            }
            
            case ($result == 'ERROR-DB'):{
                echo "Failed to connect to database";
                break;                
            }
        }
        
    }
?>

