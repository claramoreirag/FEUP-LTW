<?php

include_once('../db/proposals.php');
$posts = getPostsFromUser($id);

foreach ($posts as $post) {

    if (checkAlreadyProposed($post['id'], $_SESSION['userid']) == false) {
        $proposalStatus = false;
    } else $proposalStatus = true;

    $pet = getPetbyID($post['pet']);
    $pic = getPetPicture($pet['id']);
    if (isPostFavorite($post['id']) == false) {
        $favorite = false;
    } else $favorite = true;
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

                <p class="author"><?= $post['post_at'] ?></p>
            </div>

            <h1 class="post_name"><?= $pet['name'] ?>, <?= $pet['age'] ?></h1>
            <div class="flex__container">
                <div class="description__container">
                    <p class="description"><?= $pet['description'] ?></p>
                    <p class="type">Type: <?= $pet['pet_type'] ?></p>
                    <p class="size">Size: <?= $pet['size'] ?></p>
                    <p class="color">Color: <?= $pet['color'] ?></p>
                    <br>
                    <p class="message"> <?= $post['message'] ?></p>
                </div>
                <div class="petpic__container">
                    <img class="petpic" src="<?= $pet['photo'] ?>" alt="profile picture">
                </div>
            </div>
        </div>


        <div class="interactions">

            <button id="more" class="btn more"><a class="get__more" href="fullPost.php?postid=<?php echo $post['id']; ?>"><i class="fas fa-plus"></i></a></button>
            <p class="label">See More</p>
            <button id="comment" class="btn comment"><i class="far fa-comments"></i></button>
            <p class="label">Comments</p>

            <!-- TODO: dar fix a tudo e também ao click que só muda se carregarmos mesmo no icon -->
            <?php if (!$favorite) { ?>
                <button id="like<?= $post['id'] ?>" class="btn like"><i onclick="changeIconLike(this)" class="far fa-heart"></i></button>
                <p id="like_text<?= $post['id'] ?>" class="label">Like</p>
            <?php } else { ?>
                <button id="like<?= $post['id'] ?>" class="btn like"><i onclick="changeIconDislike(this)" class="fas fa-heart"></i></button>
                <p id="like_text<?= $post['id'] ?>" class="label">Dislike</p>
            <?php } ?>
        </div>

        <script type="text/javascript">
            document.getElementById("comment").onclick = function() {
                // TODO: HOW TO DO COMMENTS: pop up (all comments in fullpost)
            };

            var like = document.getElementById("like<?= $post['id'] ?>");
            var fav = "<?php echo $favorite ?>";
            like.onclick = function() {
                let request = new XMLHttpRequest();
                if (fav == "") {
                    document.getElementById('like_text<?= $post['id'] ?>').innerHTML = 'Like';
                    request.open("get", "../actions/addPostToFavoritesAction.php?post=<?= $post['id'] ?>", true);
                    request.send();
                    fav = "a";
                    return;
                } else {
                    document.getElementById('like_text<?= $post['id'] ?>').innerHTML = 'Dislike';
                    request.open("get", "../actions/removePostFromFavoritesAction.php?post=<?= $post['id'] ?>", true);
                    request.send();
                    fav = "";
                    return;
                }
            };

            function changeIconLike(x) {
                x.classList.toggle('fas');
            }

            function changeIconDislike(x) {
                x.classList.toggle('far');
            }
        </script>

        <div id="makeProposal" class="makeProposal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Do you want to adopt this pet?</h2>
                <h4>Write a message explaining why to help the current owners accept your proposal.</h4>
                <form action="../actions/make_proposal.php" method="post" enctype="multipart/form-data">

                    <label for="message">Message to add to your post:</label>
                    <textarea class="bio" name="message" rows="2" cols="200"></textarea>
                    <input type="hidden" id="postId" name="postId" value="<?= $post['id'] ?>">
                    <div class="save-div">
                        <!--save button-->
                        <button type="submit" id="save" class="btn save">Submit <i class='fas fa-save'></i></button>

                    </div>
                </form>
                <br>

            </div>
            
    <script  type="text/javascript">
        var modal_prop = document.getElementById("makeProposal");
        var btn_prop = document.getElementById("adoptProposal<?= $post['id'] ?>");
            console.log("i'm here");
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 

        btn_prop.onclick = function() {
            var status = "<?php echo $proposalStatus ?>";
            if (status == "") {
                modal_prop.style.display = "block";
            } else {
                alert('You already made a proposal, wait for it to be accepted!');
            }



            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal_prop.style.display = "none";
            }
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal_prop.style.display = "none";
                }
            }
        }
    </script>
        </div>

    </div>

    <br>


<?php } ?>