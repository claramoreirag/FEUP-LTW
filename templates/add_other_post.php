<?php

include_once('../db/connection.php');
include_once('../utils/session.php');
include_once('../db/posts.php');

?>

<?php function draw_other_post(){
    $pets=getAllPets();
  ?>
 <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
        
            <title>Other Post</title>
            <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../css/add-post-style.css" type="text/css">
            <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        
        </head>
  
    <body>

        <!-- TODO: BACK BUTTON INITIAL PAGE & LOGO, on click of back button pop up saying "unsaved changes bla bla" js-->


        <section id="profile">
        
            


            <div class="profile">
                <h1 class="edit">Make Post</h1>
                <br>
                <div class="container">

                    <form class="form__container" action="../actions/add_other_post.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

                        
                   
                        <!-- name & contact info-->

                        <label for="type"><p>Select the Pet :</p></label>
                        

                        <?php 
                        foreach($pets as $pet){
                        echo'<div class="option">';
                        echo'<label for="Other">'. $pet["name"].'</label>';
                        echo '<input type="radio" name="pet" value='. $pet["id"]. '>';
                        echo '</div>';
                        }
                        ?>
                       <br>
                      
                    
                        <label for="message"><p>Message to add to your post:</p></label>
                        <textarea class="bio" name="message" rows="2" cols="200"></textarea>

                        <div class="submit-div">
                            <!--save button-->
                            <button type="submit" id="save" class="btn submit">Submit <i class='fas fa-save'></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>

  

    </html>
 <?php } ?>