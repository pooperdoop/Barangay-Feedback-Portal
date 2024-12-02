<?php

session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);

if(checkUser($con)){
    header("Location: allFeedbackAdmin");
}

$user = $user_data['id'];
if(isset($_POST['view_btn'])){

    $value = $_POST['view_btn'];
    $_SESSION['account_view'] = $value;
    switchTab($value, $con);

}

if(isset($_POST['all'])){
    $sql = "UPDATE all_users SET acc_view = '0' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
if(isset($_POST['verified'])){
    $sql = "UPDATE all_users SET acc_view = '1' WHERE id = '$user'";
    mysqli_query($con, $sql);
}
if(isset($_POST['users'])){
    $sql = "UPDATE all_users SET acc_view = '2' WHERE id = '$user'";
    mysqli_query($con, $sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barangay Feedback Portal</title>
    <link rel="stylesheet" href="css/accountsadmin.css?v=<?php echo time(); ?>"/>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" />
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
                <li><img src="Icons/logout1.png" alt="logout"><a href="logout.php"><i class="but logout">Log Out</a></li>
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

            <div>
                <form action="accountsadmin.php" method="post">
                <div class="buttons" style="margin-left: 20px;">   
                    <button name = 'all'>All Accounts</button>
                    <button name = 'verified'>Verified Officials</button>
                    <button name = 'users'>Users</button>
                </div>
                </form>
                
                <section class="feedback-section" >
                    <form action="accountsadmin.php" method="post">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>User No.</th>
                                <th>Type</th>
                                <th>Position</th>
                                <th>Date</th>
                                <th>Barangay</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php

            
                        $initalcheck = "SELECT * FROM all_users WHERE id = '$user'";
                        $initialresult = mysqli_query($con, $initalcheck);

                        if(mysqli_num_rows($initialresult)>0){

                            $feedbackView = mysqli_fetch_assoc($initialresult);
                            $currentView = $feedbackView['acc_view'];

                            if(  $currentView == 0){
                            $sql = "SELECT * FROM all_users";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                            
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                               echo'<tr>
                               <td>'.$name.'</td>
                               <td>'.$user_num.'</td>
                               <td>'.$row["type"].'</td>
                               <td>'.$row["position"].'</td>
                               <td>'.$row["date_time"].'</td>
                                   <td>'.$row["barangay"].'</td>
                                   <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                               </tr>';
                            }
                        }
                        if(  $currentView == 1){
                            $sql = "SELECT * FROM all_users WHERE verified = 'yes'";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                               echo'<tr>
                               <td>'.$name.'</td>
                               <td>'.$user_num.'</td>
                               <td>'.$row["type"].'</td>
                               <td>'.$row["position"].'</td>
                               <td>'.$row["date_time"].'</td>
                                   <td>'.$row["barangay"].'</td>
                                   <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                               </tr>';
                            }
                        }
                        if(  $currentView == 2){
                            $sql = "SELECT * FROM all_users WHERE type = 'User'";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['first_name']." ".$row['last_name'];
                                $user_num = "#".$row['id'];
                               echo'<tr>
                               <td>'.$name.'</td>
                               <td>'.$user_num.'</td>
                               <td>'.$row["type"].'</td>
                               <td>'.$row["position"].'</td>
                               <td>'.$row["date_time"].'</td>
                                   <td>'.$row["barangay"].'</td>
                                   <td><button value='.$row["id"].' name="view_btn" id="view_btn" class="view-btn">View</button></td>
                               </tr>';
                            }
                        }
                    }
                           ?>
                        </tbody>
                    </table>
                    </form>
                </section>
            </div>

            
    </div>

</body>
</html>