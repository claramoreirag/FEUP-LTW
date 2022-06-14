<?php function draw_feed()
{
  include_once('../db/posts.php');
  include_once('../utils/session.php');
  $posts = getAllPosts();
?>

  <!DOCTYPE html>
  <html lang="en-US">

  <head>
    <title>
      Feed
    </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/feed_style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  </head>

  <body>

    <div class="start__container">
      <h1 class="feed">Recent Posts</h1>
      <div class="search">
        <form action="../pages/searchFeed.php" method="get">
          <input id="search__text" type="text" placeholder="  Search for Animal or User" name="search">
          <button class="search__button">
            <i class="fa fa-search" style="font-size: 18px;">
            </i>
          </button>
        </form>
      </div>
      <button id="add post" class="btn addpost">Add post <i class="fas fa-plus"></i></button>
    </div>


    <hr class="start">


    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Choose type of post:</h2>
        <br>
        <button id="adopt" class="btn adopt">Adoption </button>
        <button id="other" class="btn other">Other </button>
      </div>

    </div>

    <script src="../js/popups_feed.js"></script>




    <?php foreach ($posts as $post) {
      if (checkAlreadyProposed($post['id'], $_SESSION['userid']) == false) {
        $proposalStatus = false;
      } else $proposalStatus = true;
      $isPostOwner = ($_SESSION['userid'] == $post['owner']);

      $pet = getPetbyID($post['pet']);
      $username = getUsername($post['owner'])['username'];

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

            <p class="author"><?php if ($_SESSION['userid'] == $post['owner']) {
                                echo '@' . $username;
                              } else {
                                echo '<a href="view_profile.php?id=' . $post["owner"] . '">@' . $username . '</a>';
                              } ?>, <?= $post['post_at'] ?></p>
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

          <!-- TODO: dar fix a tudo e também ao click que só muda se carregarmos mesmo no icon -->
          <?php if (!$favorite) { ?>
            <button id="like<?= $post['id'] ?>" class="btn like"><i onclick="changeIconLike(this)" class="far fa-heart"></i></button>
            <p id="like_text<?= $post['id'] ?>" class="label">Like</p>
          <?php } else { ?>
            <button id="like<?= $post['id'] ?>" class="btn like"><i onclick="changeIconDislike(this)" class="fas fa-heart"></i></button>
            <p id="like_text<?= $post['id'] ?>" class="label">Dislike</p>
          <?php } ?>

        </div>
      </div>

      <br>


      <script type="text/javascript">
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
      </div>

      <div id="makeProposal<?= $post['id'] ?>" class="makeProposal">

        <!-- Modal content -->
        <div class="modal-content">
          <span id="close<?= $post['id'] ?>" class="close">&times;</span>
          <h2>Do you want to adopt this pet?</h2>
          <h4>Write a message explaining why you'll be the perfect owner for <?= $pet['name'] ?>.</h4>
          <form action="../actions/make_proposal.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label for="message">Message to add to your proposal:</label>
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
        var modal_prop<?= $post['id'] ?> = document.getElementById("makeProposal<?= $post['id'] ?>");
        var btn_prop<?= $post['id'] ?> = document.getElementById("adoptProposal<?= $post['id'] ?>");

        var span_prop<?= $post['id'] ?> = document.getElementById("close<?= $post['id'] ?>");
        // When the user clicks the button, open the modal 

        btn_prop<?= $post['id'] ?>.onclick = function() {
          var owner<?= $post['id'] ?> = "<?php echo $isPostOwner ?>";
          var status<?= $post['id'] ?> = "<?php echo $proposalStatus ?>";
          if (owner<?= $post['id'] ?> == "") {
            if (status<?= $post['id'] ?> == "") {
              modal_prop<?= $post['id'] ?>.style.display = "block";
            } else {
              alert('You already made a proposal, wait for it to be accepted!');
            }
          } else {
            alert('You can\'t propose to adopt your own pet.');
          }
        }

        // When the user clicks on <span> (x), close the modal
        span_prop<?= $post['id'] ?>.onclick = function() {
          modal_prop<?= $post['id'] ?>.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == makeProposal<?= $post['id'] ?>) {
            modal_prop<?= $post['id'] ?>.style.display = "none";
          }
        }
      </script>

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