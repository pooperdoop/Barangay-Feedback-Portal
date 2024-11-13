<?php
$dbHostName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "admin_usersdb";
$con = "";  


try{    
    //this is an object with the contents of your database user account
    $con = mysqli_connect($dbHostName, $dbUserName, $dbPassword, $dbName);}
    catch(mysqli_sql_exception){
    }