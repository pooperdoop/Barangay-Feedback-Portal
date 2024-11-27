<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Feedback Portal - Settings</title>
    <link rel="stylesheet" href="profileedit.css">
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
</head>
<body>
        
    <div class="wrapper">
        <div class="sidebar">
            <h2><img src="Icons/brgy icon.png" alt="brgy">Barangay Feedback Portal</h2>
            <ul>
                <li><img src="Icons/home1.png" alt="home"><a href="homeuser.php"><i class="but home"></i>Home</a></li>
                <li><img src="Icons/transfer1.png" alt="feedback"><a href="allFeedbackuser.php"><i class="but feedbacks"></i>Feedbacks</a></li>
                <li><img src="Icons/account1.png" alt="accounts"><a href="#"><i class="but accounts"></i>Accounts</a></li>
                <li><img src="Icons/settings1.png" alt="settings"><a href="profileedituser.php"><i class="but settings"></i>Settings</a></li>
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
                    <p>Welcome, Username</p>
                </div>
            </div>
            
            <div class="rectangle-5">
                <div class="flex-row-c" style="margin-top: 7px;">
                    <div class="top">
                        <span class="title">Edit your personal information here</span>
                        <button class="return" >
                            <div class="arrow-back"></div>
                            Return
                        </button>
                    </div>
                </div>
                <div class="divider"></div>
            
                <div class="flex-container" style="display: flex;">
                    <div class="leftdiv" style="width: 200px; height: 568px;">
                        <div style="position: relative;">
                            <img class="profile-image" src="Icons/profile.png" alt="profile">
                            <button class="pencil-button">
                                <div class="pencil-icon"></div>
                            </button>
                        </div>
                        <button class="cancel-button" type="cancel">Cancel</button>
                        <button class="save-button" type="save">Save</button>
                    </div>
            
                    <div class="rightdiv" style="flex-grow: 1; height: 568px;">
                        <div class="form-container">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" id="first-name" placeholder="Enter your first name" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                                <div class="form-group">
                                    <label for="middle-name">Middle Name</label>
                                    <input type="text" id="middle-name" placeholder="Enter your middle name" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" id="last-name" placeholder="Enter your last name" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                            </div>
            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" id="dob" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <select id="barangay" style="width: 225px; height: 40px; margin-right: 20px; background-image: url('Icons/droplist.png'); background-repeat: no-repeat; background-position: right 10px center; padding-right: 30px;">
                                        <option value="" disabled selected>Select your barangay</option>
                                        <option value="barangay1">Barangay 1</option>
                                        <option value="barangay2">Barangay 2</option>
                                        <option value="barangay3">Barangay 3</option>
                                        <option value="barangay4">Barangay 4</option>
                                        <option value="barangay5">Barangay 5</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">Full Address</label>
                                    <input type="text" id="address" placeholder="Enter your full address" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                            </div>
            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="sex">Sex</label>
                                    <select id="sex" style="width: 225px; height: 40px; margin-right: 20px; background-image: url('Icons/droplist.png'); background-repeat: no-repeat; background-position: right 10px center; padding-right: 30px;">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" placeholder="Enter your email" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="phone" placeholder="Enter your phone number" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                            </div>
            
                            <div class="form-row" style="width: 225px; height: 40px;">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" placeholder="Choose a username" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" placeholder="Enter your password" style="width: 225px; height: 40px; margin-right: 20px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</body>
</html>