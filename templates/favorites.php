<?php function draw_favorites()
{


    $user = getUserbyId($_SESSION['userid']);
    $favorites = getUserFavorites($user['userid']);


?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">

        <title>My Favorites</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/feed_style.css" type="text/css">


    </head>

    <body>


        <h1>My Favorites</h1>
        <hr>

        <?php foreach ($favorites as $favorite) {
            $post = getPost($favorite['post']);
            $pet = getPetbyID($post['pet']);
            $username = getUsername($post['owner'])['username'];
            $pic = getPetPicture($pet['id']);
        ?>


            <div class="post">

                <div class="info">

                    <div class="top-inf">
                        <?php
                        if ($post['adopt']) {
                            if ($post['is_adopted']) echo '<p class="posttype">#AlreadyAdopted</p>';
                            else  echo '<p id="adoptProposal' . $post["id"] . '"  class="posttype adoptProposal" >#AdoptMe</p>';
                        } else {
                            echo '<p class="posttype">#Other</p>';
                        }
                        ?>

                        <p class="author">@<?= $username ?>, <?= $post['post_at'] ?></p>
                    </div>

                    <h1 class="name"><?= $pet['name'] ?>, <?= $pet['age'] ?></h1>
                    <div class="flex__container">
                        <div class="description__container">
                            <p class="description"><?= $pet['description'] ?></p>
                            <p class="type">Type: <?= $pet['pet_type'] ?></p>
                            <p class="size">Size: <?= $pet['size'] ?></p>
                            <p class="color">Color: <?= $pet['color'] ?></p>
                            <br>
                            <p class="message"> <?= $post['message'] ?></p>
                        </div>
                        <img class="petpic" src="<?= $pet['photo'] ?>" alt="profile picture">
                    </div>


                </div>

                <div class="interactions">
                    <button id="more" class="btn more"><a class="get__more" href="fullPost.php?postid=<?php echo $post['id']; ?>"><i class="fas fa-plus"></i></a></button>
                    <p class="label">See More</p>
                    <button id="comment<?= $post['id'] ?>" class="btn comment"><i class="far fa-comments"></i></button>
                    <p class="label">Comments</p>
                    <button id="dislike" class="btn like"><i class="fas fa-heart"></i></button>
                    <p class="label">Dislike</p>
                </div>
            </div>
            <br>

            <!-- TODO: FIX OTHER BUTTONS -->
            <script type="text/javascript">
                document.getElementById("dislike").onclick = function() {

                    <?php removePostFromFavorites($post['id']); ?>
                };
            </script>



            <div id="makeQuestion<?= $post['id'] ?>" class="makeQuestion">
                <!-- Modal content -->
                <div class="modal-content">
                    <span id="closeQ<?= $post['id'] ?>" class="close">&times;</span>
                    <h2>Do you have a question?</h2>
                    <h4>Write a comment and ask <?= $pet['name'] ?>'s owner what you want to know.</h4>
                    <form action="../actions/makeQuestion.php" method="post" enctype="multipart/form-data">

                        <label for="message">Question:</label>
                        <textarea class="bio" name="message" rows="2" cols="200"></textarea>
                        <input type="hidden" id="postId" name="postId" value="<?= $post['id'] ?>">
                        <div class="save-div">
                            <!--save button-->
                            <button type="submit" id="save" class="btn save">Submit <i class='fas fa-save'></i></button>

                        </div>
                    </form>
                    <br>

                </div>

            </div>
            <script>
                var modal_comm<?= $post['id'] ?> = document.getElementById("makeQuestion<?= $post['id'] ?>");
                var btn_comm<?= $post['id'] ?> = document.getElementById("comment<?= $post['id'] ?>");
                var span_comm<?= $post['id'] ?> = document.getElementById("closeQ<?= $post['id'] ?>");

                // When the user clicks the button, open the modal 
                btn_comm<?= $post['id'] ?>.onclick = function() {
                    modal_comm<?= $post['id'] ?>.style.display = "block";
                }

                // When the user clicks on <span> (x), close the modal
                span_comm<?= $post['id'] ?>.onclick = function() {
                    modal_comm<?= $post['id'] ?>.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == makeQuestion<?= $post['id'] ?>) {
                        modal_comm<?= $post['id'] ?>.style.display = "none";
                    }
                }
            </script>
        <?php } ?>
    </body>

    </html>
<?php } ?>