<?php

session_start();
include("all_usersdb.php"); 
include("functions.php");
$user_data = check_login($con);
if(checkUser($con)){
    header("Location: allFeedbackAdmin");
}



if(isset($_POST["edit_btn"])){

    $notice = $_POST["edit_btn"];
    $sql = "SELECT * FROM all_notice WHERE noticeID = '$notice'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0){

        $notice_data = mysqli_fetch_assoc($result);

        $ID = $notice_data['noticeID'];
        $title = $notice_data['title'];
        $link = $notice_data['link'];
        $barangay = $notice_data['barangay'];

    }

}

if(isset($_POST['del_btn'])){

    $notice = $_POST['del_btn'];
 
    $sql = "DELETE FROM all_notice WHERE noticeID = '$notice'";
    mysqli_query($con, $sql);

       header("Location: homeadmin.php");
         die;
}

if(isset($_POST['post_btn'])){

    $notice = $_POST['post_btn'];
    $newtitle = $_POST['notice_title'];
    $newlink = $_POST['notice_link'];
    $sql = "UPDATE all_notice SET title = '$newtitle' WHERE noticeID = '$notice'";
    mysqli_query($con, $sql);

    $sql = "UPDATE all_notice SET link = '$newlink ' WHERE noticeID = '$notice'";
    mysqli_query($con, $sql);

       header("Location: homeadmin.php");
         die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Portal - Settings</title>
    <link rel="stylesheet" href="css/editnotice.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
</head>
<body>
        
    <div class="wrapper">
        <div class="sidebar">
            <h2><img src="Icons/brgy icon.png" alt="brgy">Barangay Feedback Portal</h2>
            <ul>
            <li><img src="Icons/home1.png" alt="home"><a href="homeadmin.php"><i class="but home"></i>Home</a></li>
                <li><img src="Icons/transfer1.png" alt="feedback"><a href="allFeedbackAdmin.php"><i class="but feedbacks"></i>Feedbacks</a></li>
<?php
if(!checkUser($con)){echo'
                <li><img src="Icons/account1.png" alt="accounts"><a href="accountsadmin.php"><i class="but accounts"></i>Accounts</a></li>';
            }
?>
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
                    <p>Welcome, <?php echo $user_data['username'] ?></p>
                </div>
            </div>
            
            <div class="rectangle-5">
                <div class="flex-row-c" style="margin-top: 7px;">
                    <div class="top">
                        <span class="title">Post your notice</span>
                        <button onclick="ReturnPage()" class="return">
                            <div class="arrow-back"></div>
                            Return
                        </button>
                    </div>
                </div>
                <hr>
                <span class="subtitle">Notice</span>
                <form action="editnotice.php" method = "post">
                <div class="flex-row-c" style="margin-top: 5px;">
                    <div class="title-container" style="margin-right: 53px;">
                        <span class="title">Title</span>
                        <input type="text" value="<?php echo $title?>" name="notice_title" id="notice_title" class="group-input" placeholder="Enter notice title" required />
                    </div>
                    
                    <div class="barangay-container" style="margin-right: 53px;">
                        <span class="barangay">Barangay</span>
                        <select name="barangay" class="group-input" style="width: 256px;" required>
                            <option value=<?php echo $barangay?> ><?php echo $barangay?></option>
                            <option value="Barangay 1">Barangay 1</option>
                            <option value="Barangay 2">Barangay 2</option>
                            <option value="Barangay 3">Barangay 3</option>
                        </select>
                    </div>
                </div>

                <div class="description-container">
                    <span class="description">Link</span>
                    <input type="url" name="notice_link" id="notice_link" class="group-input" value=<?php echo $link?> placeholder="Enter a link here" style="margin-bottom:19px" required />
                </div>
                
                <div class="button-container">
                <button type="submit" value=<?php echo $ID?> name="post_btn" id="post_btn" class="post-button">Post</button>
                    <button type="submit" value=<?php echo $ID?> name="del_btn" id="del_btn" class="delete-button">Delete</button>
                </div>

            </div>
            </form>
        </div>


    </div>
</body>
</html>
<script>

function ReturnPage(){
    
    window.location.href = 'homeadmin.php';
}

</script>