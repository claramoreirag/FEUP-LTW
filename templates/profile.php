<?php function draw_profile()
{


    $user = getUserbyId($_SESSION['userid']);
?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">

        <title>Profile</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/profile-style.css" type="text/css">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    </head>

    <body>

        <section id="profile">
            <div>
              

                <div class="profile">
                    <div class="profile__upper">
                        <div class="avatar">
                            <!-- profile photo-->
                            <img class="profilepic" src="<?= $user['profilePic'] ?>" alt="profile picture">
                        </div>


                        <!-- name & contact info-->
                        <h1 class="name"><?= $user['name'] ?></h1>


                        <h2 class="username">@<?= $user['username'] ?></h2>
                    </div>

                    <hr class="div-line">

                    <div class="profile__info">
                        <p class="bio"><em>"<?= $user['bio'] ?>"</em></p>
                        <div class="profile__info-personal">
                            <p class="email">Email: <?= $user['email'] ?></p>
                            <p class="phone">Phone: <?= $user['phoneNumber'] ?></p>
                        </div>
                    </div>
                    <br>



                    <div class="settings-div">
                        <!--settings button/link-->
                        <button id="settings" class="btn settings">Settings <i class="fas fa-sliders-h"></i></i></button>

                        <script type="text/javascript">
                            document.getElementById("settings").onclick = function() {
                                location.href = "../pages/editProfile.php";
                            };
                        </script>

                    </div>

                    <div class="delete-div">
                        <!--settings button/link-->
                        <button id="delete" class="btn settings">Delete Profile <i class="far fa-trash-alt"></i></i></button>
                       
                       

                    </div>

                </div>

                <section id="mypets">
                    <h1 class="pets_title">My Pets</h1>

                    <div class="petarea">
                        <!-- my pets-->
                        <?php include_once('../actions/listOwnPets.php'); ?>

                    </div>
                </section>

                <br>

                <section id="myposts">

                    <h1 class="post_title">My Posts</h1>
                    <hr>
                    <!-- my posts-->
                    <?php include_once('../actions/listOwnPosts.php'); ?>

                </section>


                <!--footer-->

            </div>

        </section>

        <div id="deletePost" class="deletePost">

    <!-- Modal content -->
        <div class="modal-content">
        <span id="btn_close" class="close">&times;</span>
        <h2>Are you sure you want to delete your profile?</h2>
       
        <br>
        <button id="btn_delete" class="btn delete">Yes,I'm sure </button>
        </div>

        <script>
        var modal_delete = document.getElementById("deletePost");
        var btn_delete = document.getElementById("btn_delete");
        var btn_open = document.getElementById("delete");
        var span = document.getElementById("btn_close");
    
        btn_delete.onclick = function() {
            location.href = "../actions/deleteProfile.php?userid=<?= $_SESSION['userid'] ?>";
        }

        span.onclick = function() {
          modal_delete.style.display = "none";
        }
        btn_open.onclick = function() {
        modal_delete.style.display = "block";
        }
        window.onclick = function(event) {
          if (event.target == modal_delete) {
            modal_delete.style.display = "none";
          }
        }
      </script>

    </body>

    </html>
<?php } ?>