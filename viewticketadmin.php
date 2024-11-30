<?php

session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);

if(isset($_POST['view_btn'])){

    $feedback = $_POST['view_btn'];

    $sql = "SELECT * FROM all_feedback WHERE ticketID = '$feedback' limit 1";
    $result = mysqli_query($con, $sql);

    
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        $ticketID = $data['ticketID'];
        $title = $data['title'];
        $message = $data['message'];
        $status = $data['status'];
        $date = $data['date'];
        $type = $data['type'];
        $_SESSION['ticketID'] = $ticketID;
        $_SESSION['ticketType'] = $type;
        $Isfeedback = 'yes';
        $user = $data['user_current'];
    $sqlUser = "SELECT * FROM all_users WHERE id = '$user' limit 1";
    $resultUser = mysqli_query($con, $sqlUser);
   
    if(mysqli_num_rows($resultUser) > 0){
        
        $data = mysqli_fetch_assoc($resultUser);

        $fullname = $data['first_name']." ".$data['middle_name']." ".$data['last_name'];
        $bday = $data['birthday'];
        $address = $data['full_address'];
        $email = $data['email'];
        $contact = $data['phonenumber'];


      }
    }   
}

if(isset($_POST['view_btn_rep'])){
    //   echo "<script>alert('what')</script>";
       $reply = $_POST['view_btn_rep'];
   
       $sql = "SELECT * FROM all_reply WHERE replyID = '$reply' limit 1";
       $result = mysqli_query($con, $sql);
   
       
       if(mysqli_num_rows($result) > 0){
           $data = mysqli_fetch_assoc($result);
           $ticketID = $data['replyID'];
           $title = $data['title'];
           $message = $data['message'];
           $Isfeedback = 'no';

         }
   }

if(isset($_POST['save_btn'])){
    $changeStatus = $_POST['status_chg'];
    $ticket_val = $_POST['ticket_value'];
    $sql = "UPDATE all_feedback SET status = '$changeStatus' WHERE ticketID =  '$ticket_val'";
    mysqli_query($con, $sql);
    header("Location: allFeedbackAdmin.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Portal - Settings</title>
    <link rel="stylesheet" href="css/viewticketadmin.css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
</head>
<body>
        
    <div class="wrapper">
        <div class="sidebar">
            <h2><img src="Icons/brgy icon.png" alt="brgy">Barangay Feedback Portal</h2>
            <ul>
            <li><img src="Icons/home1.png" alt="home"><a href="homeadmin.php"><i class="but home"></i>Home</a></li>
                <li><img src="Icons/transfer1.png" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
                <li><img src="Icons/account1.png" alt="accounts"><a href="accountsadmin.php"><i class="but accounts"></i>Accounts</a></li>
                <li><img src="Icons/settings1.png" alt="settings"><a href="profileeditadmin.php "><i class="but settings"></i>Settings</a></li>
                <li><img src="Icons/logout1.png" alt="logout"><a href="#"><i class="but logout">Log Out</a></li>
            </ul>
        </div>

        <div class="main_content">

            <div class="header">
                <div>
                    <h2>Feedbacks</h2>
                </div>
                <div>
                    <input class="search" type="text" placeholder="Search for something">
                </div>
                <div>
                    <p>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>
            
            <div class="rectangle-5">
                <div class="flex-row-c" style="margin-top: 7px;">
                    <div class="top">
                        <span class="title"><?php echo "#".$ticketID." - ".$title;   ?></span>
                        <button onclick="ReturnPage()"  class="return">
                            <div class="arrow-back"></div>
                            Return
                        </button>
                    </div>
                </div>
                <div class="divider"></div>
                <div class='centerdiv'>
            <?php 

                if(checkIfReply($con, $Isfeedback)){
                    echo "
                        <p><strong>Ticket No:</strong". $ticketID  ."</p>
                        <p><strong>Date:</strong>".  $date  ."</p>
                        <br>
                        <p><strong>Name:</strong>" . $fullname ." </p>
                        <p><strong>Birthday:</strong>".  $bday . "</p>
                        <p><strong>Address:</strong>" . $address ." </p>
                        <p><strong>Feedback Type:</strong>".  $type . "</p>
                        <p><strong>Email:</strong> ". $email . "</p>
                        <p><strong>Contact No:</strong>" . $contact  ."</p>
                        <br>
                        <br>
                        <p><strong>Title:</strong>" .  $title. " </p>
                        <br>";} ?>
                        <p><strong>Description:</strong></p>
                        <p><?php echo $message?></p>
                        <br>
                        <?php
                         if(checkIfReply($con,$Isfeedback)){
                    echo "
                        <p><strong>Attachment Links:</strong></p>
                        <img src".$.">";}


                    ?>
                    <?php 
                            if(checkUser($con)){
                            } 
                            else{
                                echo '
                    <div class="rectangle-f">
                        <div class="set-status">
                            <span class="status">Set Status</span>
                            <div class="dropdown-container">';}
                             ?>   
                 <form action="viewticketadmin.php" method="post">
                 <?php 
                            if(checkUser($con)){
                            } 
                            else{
                                echo '<select id="status" name="status_chg" class="status-dropdown">
                                    <option value="' .$status.'" >'.$status.'</option>
                                    <option value="Open">Open</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                        </div> ';}
                                    
                        ?>

                        <input type='text' name="ticket_value" style="display: none;" value= '<?php echo $ticketID ?>'>
                        <?php 
                            if(checkUser($con)){
                            }
                            else{
                                echo ' <button name="save_btn" class="save-feedback-button">Save Changes</button>';
                            }
                            ?>
                    </form>
                        <?php 
                            if(checkUser($con)){
                            }
                            else{
                                echo '<button onclick="ReplyPage()" class="reply-feedback-button">Reply</button>';
                            }
                            ?>
                    </div>

                </div>

            </div>
        </div>


    </div>
</body>
</html>

<script>
function ReturnPage(){

window.location.href = 'allFeedbackAdmin.php';

}

function ReplyPage(){
    
    location.replace('replyticket.php') ;
}

</script>