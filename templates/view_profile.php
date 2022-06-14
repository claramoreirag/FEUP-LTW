<?php function draw_profile($id)
{

    $user = getUserbyId($id);

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">

        <title>Profile: <?= $user['name'] ?></title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/view_profile.css" type="text/css">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    </head>

    <body>

        <section id="profile">
            <div>
                <!-- TODO: BACK BUTTON  INITIAL PAGE & LOGO -->

                <div class="profile">

                    <div class="avatar">
                        <!-- profile photo-->
                        <img class="profilepic" src="<?= $user['profilePic'] ?>" alt="profile picture">
                    </div>


                    <!-- name & contact info-->
                    <h1 class="name"><?= $user['name'] ?></h1>

                    <br>

                    <h2 class="username">@<?= $user['username'] ?></h2>

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

                    </div>

                </div>

                <section id="mypets">
                    <h1 class="pets_title"><?= $user['name'] ?>'s Pets</h1>

                    <div class="petarea">
                        <br>
                        <!-- my pets-->
                        <?php include_once('../actions/listPetsFromUser.php'); ?>

                    </div>
                </section>

                <br>

                <section id="myposts">

                    <h1 class="post_title"><?= $user['name'] ?>'s Posts</h1>
                    <hr>
                    <!-- my posts-->
                    <?php include_once('../actions/listPostsFromUser.php'); ?>

                </section>

            </div>
        </section>
    </body>

    </html>

<?php } ?>