<?php
// $dbHostName = "localhost";
// $dbUserName = "root";
// $dbPassword = "";
// $dbName = "all_users";
// $con = "";  


// try{    
//     //this is an object with the contents of your database user account
//     $con = mysqli_connect($dbHostName, $dbUserName, $dbPassword, $dbName);}
//     catch(mysqli_sql_exception){
//         }

try{
    $con = mysqli_connect("sql212.infinityfree.com", "if0_37821994", "vRooG9qSRgiE", "if0_37821994_barangay_feedback_portaldb");
}catch(mysqli_sql_exception){

}