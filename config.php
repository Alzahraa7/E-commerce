<?php

//variables of DB
$userName = "root";
$hostName = "localhost";
$password = "";
$databaseName = "e-commercedb";

//connection
$conn = mysqli_connect($hostName,$userName,$password,$databaseName);

//check connection
/*if($conn){
    echo "Connected Successffully";
}
else{
    echo "Not connected -_-";
}*/
?>