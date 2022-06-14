<?php

include_once('../db/connection.php');
include_once('../utils/session.php');


?>

<?php function draw_adoption_post(){
  ?>
 <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
        
            <title>Adoption Post</title>
            <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../css/add-post-style.css" type="text/css">
            <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        
        </head>
  
    <body>

    


        <section id="profile">
        
            


            <div class="profile">
                <h1 class="edit">Make Adoption Post</h1>
                <br>

                <form class="form__container" action="../actions/add_adoption_post.php" method="post" enctype="multipart/form-data">
                    
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    
                    <!-- name -->

                    <label for="name"><p>Pet name:</p></label>
                    <input id="name" type="text" name="name"  placeholder="name" autocomplete=on required>
                
                    <label for="type"><p>Pet type:</p></label>
                    <div class="option">
                        <label for="Dog">Dog</label>
                        <input id="Dog" type="radio" name="type" value="Dog" checked="checked">
                    </div>

                    <div class="option">
                        <label for="Cat">Cat</label>
                        <input id="Cat" type="radio" name="type" value="Cat">    
                    </div>

                    <div class="option">
                        <label for="Bird">Bird</label>
                        <input id="Bird" type="radio" name="type" value="Bird">    
                    </div>

                    <div class="option">
                        <label for="Rabbit">Rabbit</label>
                        <input id="Rabbit" type="radio" name="type" value="Rabbit">
                    </div>
                    
                    <div class="option">
                        <label for="Reptile">Reptile</label>
                        <input id="Reptile" type="radio" name="type" value="Reptile">    
                    </div>
                    
                    <div class="option">
                        <label for="Other">Other</label>
                        <input id="Other" type="radio" name="type" value="Other">    
                    </div>

                    
                    <label for="size"><p>Size:</p></label>
                    <div class="option">
                        <label for="Other">Small</label>
                        <input type="radio" name="size" value="Small" checked="checked">  
                    </div>

                    <div class="option">
                        <label for="Other">Medium</label>
                        <input type="radio" name="size" value="Medium">  
                    </div>
                    
                    <div class="option">
                        <label for="Other">Large</label>
                        <input type="radio" name="size" value="Large">    
                    </div>
                    

                    <label for="color"><p>Color:</p></label>
                    <input id="name" type="text" name="color"  placeholder="color" required>   


                    <label for="age"><p>Age:</p></label>
                    <input id="phone" type="text" name="age" pattern="[0-9]{1-2}"  autocomplete=on>
                    
                    
                    <label for="description"><p>Description:</p></label>
                    
                    <textarea class="bio" name="description" rows="2" cols="200" required></textarea>
                    
                    <label for="picture"><p>Upload pet pictures:</p></label>
                    <input type="file" name="pictures" required>

                    
                    <label for="message"><p>Message to add to your post:</p></label>
                    <textarea class="bio" name="message" rows="2" cols="200"></textarea>
                    
                    <div class="submit-div">
                        <!--save button-->
                        <button type="submit" id="submit" class="btn submit">Submit <i class='fas fa-save'></i></button>

                    </div>
                </form>

            </div>
        </section>
    </body>



    </html>
 <?php } ?>