<?php
include("all_usersdb.php");

function check_login($con){

    if(isset($_SESSION['id'])){

        $id = $_SESSION['id'];

        $query =  "SELECT * FROM all_users WHERE id ='$id' LIMIT 1";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);

            return $user_data;
        }
    }
    else{
        
        header('Location: index.php');
        die;
    }

}

function after_signup(){
    header('Location: index.php');
}


function switchTab($value, $con){
    
    $query =  "SELECT * FROM all_users WHERE id ='$value' LIMIT 1";
    $result = mysqli_query($con, $query);
    $user_data = mysqli_fetch_assoc($result);
    $type = $user_data['type'];
    $verified = $user_data['verified'];



    if($verified == "no"){
        header("Location: viewofficialacc.php");
    }
    elseif($verified == "yes"){
        header("Location: viewverifiedofficialacc.php");
}
else{
    echo '<script>alert("INVALID ACCOUNT!")</script>';
}
    
}

function checkUser($con){

        $id = $_SESSION['id'];

        $query =  "SELECT * FROM all_users WHERE id ='$id' LIMIT 1";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            if($user_data['type'] == "User" ){
                    return true;
            }
            else{
                return false;
            }
        }
}

function checkIfReply($con, $feedback){

        if($feedback == "yes"){
                return true;
        }
        else{
            return false;
        }
    }
?>