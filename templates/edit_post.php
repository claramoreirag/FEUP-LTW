<?php function drawEditPost($postID){

include_once('../db/connection.php');
include_once('../utils/session.php');
include_once('../db/posts.php');


$stmt = $db->prepare('SELECT * FROM post WHERE id=?');
$stmt->execute(array($postID));
$post=$stmt->fetch();
$pet = getPetofPost($postID)
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

    <!-- TODO: BACK BUTTON INITIAL PAGE & LOGO, on click of back button pop up saying "unsaved changes bla bla" js-->


    <section id="profile">


        <div class="profile">
            <div class="header">
                <h1 class="edit">Edit Post Info</h1>
                <!-- profile photo-->
                <img class="profilepic" src="<?=$pet['photo']?>" alt="profile picture">
            </div>

            <form class="form__container" action="../actions/edit_post_action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">    
                <input type="hidden" id="postId" name="postId" value="<?=$post['id']?>">
                <!-- name & contact info-->
                <label for="name">Pet Name:</label>
                <input id="name" type="text" name="pet_name"  placeholder="<?=$pet['name']?>" autocomplete=on>
                

                <label for="User">Age:</label>
                <input id="user" type="text" name="pet_age" placeholder="<?=$pet['age']?>" autocomplete=on>
                

                <label for="pet_type">Pet type:</label>
                        <input type="radio" name="pet_type" value="Dog" checked="checked">Dog<br>
                        <input type="radio" name="pet_type" value="Cat">Cat<br>
                        <input type="radio" name="pet_type" value="Bird">Bird<br>
                        <input type="radio" name="pet_type" value="Rabbit">Rabbit<br>
                        <input type="radio" name="pet_type" value="Reptile">Reptile<br>
                        <input type="radio" name="pet_type" value="Other">Other<br>

                <label for="Password">Pet Size:</label>
                        <input type="radio" name="pet_size" value="Small" checked="checked">Small<br>
                        <input type="radio" name="pet_size" value="Medium">Medium<br>
                        <input type="radio" name="pet_size" value="Large">Large<br>
                <label for="Password">Pet Color:</label>
                <input id="enter" name="pet_color" type="text" placeholder="<?=$pet['color']?>" autocomplete=on>
                
            
                <!-- TODO: trash button to delete bio -->
                <label for="bio">Pet Description:</label>
                
                <textarea class="bio" name="pet_description" rows="2" cols="200"></textarea>

                <!-- TODO: trash button to delete bio -->
                <label for="bio">Post Message:</label>
                
                <textarea class="post_message" name="post_message" rows="2" cols="200"></textarea>
                
                <label for="pet_pic">Upload pet picture:</label>
                <input type="file" name="pet_pic" >
                

            <div class="save-div">
                <!--save button-->
                
                <button type="submit" id="save" class="btn save">Save Changes<i class='fas fa-save'></i></button>

                <script type="text/javascript">
                    document.getElementById("save").onclick = function () {
                        location.href = "../pages/profile.php";
                    };
                </script>
            </div>
        </form>

            <!-- TODO: DELETE PROFILE -->
        </div>
    </section>
</body>
</html>
<?php } ?>