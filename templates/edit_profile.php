<?php function drawEditProfile(){

    include_once('../db/connection.php');
    include_once('../utils/session.php');

    $stmt = $db->prepare("SELECT * FROM users WHERE userid={$_SESSION['userid']}");
    $stmt->execute();
    $user=$stmt->fetch();
?>


 <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
        
            <title>Settings</title>
            <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../css/edit-profile-style.css" type="text/css">
            <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        
        </head>
  
    <body>

      

        <section id="profile">


            <div class="profile">
                <div class="header">
                    <h1 class="edit">Edit Profile Info</h1>
                    <!-- profile photo-->
                    <img class="profilepic" src="<?=$user['profilePic']?>" alt="profile picture">
                </div>

                <form class="form__container" action="../actions/edit_profile_action.php" method="post" enctype="multipart/form-data">
                    <!-- csrf token -->
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    

                    <!-- name & contact info-->
                    <label for="name">Name:</label>
                    <input id="name" type="text" name="name"  placeholder="<?=$user['name']?>" autocomplete=on>
                    

                    <label for="User">User:</label>
                    <input id="user" type="text" name="username" placeholder="<?=$user['username']?>" autocomplete=on>
                    
        
                    <label for="Email">Email:</label>
                    <input id="email" type="text" name="email" placeholder="<?=$user['email']?>" autocomplete=on>
                    

                    <label for="Password">Password:</label>
                    <input id="enter" name="enter" type="password" placeholder="New Password" >

                    <input id="confirm" name="confirm" type="password" placeholder="Confirm Password">
                    
                    
                   
                    <label for="phone">Phone:</label>
                    <input id="phone" type="tel" name="phone" pattern="/9[1236][0-9]{7}{7}/|2[1-9]{1,2}[0-9]{7}" placeholder="<?=$user['phoneNumber']?>" autocomplete=on>
                    

                    <label for="bio">Bio:</label>
                    
                    <textarea class="bio" name="bio" rows="2" cols="200"></textarea>
                    
                    <label for="profilepic">Upload profile picture:</label>
                    <input type="file" name="profilepic" >
                    
                    
                    <div class="save-div">
                        <!--save button-->
                        <button type="submit" id="save" class="btn save">Save Changes <i class='fas fa-save'></i></button>
                        
                        
                    </div>
                </form>


            </div>
        </section>
    </body>
    </html>
<?php } ?>