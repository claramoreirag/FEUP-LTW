<?php function draw_post($postid)
{


  $post = getPost($postid);
  $pet = getPetofPost($post['id']);
  $username = getUsername($post['owner'])['username'];
  $comments = listCommentsFromPost($postid);

  if (isPostFavorite($post['id']) == false) {
    $favorite = false;
  } else $favorite = true;

?>

  <!DOCTYPE html>
  <html lang="en-US">

  <head>
    <title>
      Post
    </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/fullPost.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  </head>

  <body>

    <div class="container">
      <div class="carousel">
        <button class="carousel__button carousel__button--left">
          <img src="..\img\ui\back.svg" alt="">
        </button>

        <button class="carousel__button carousel__button--right">
          <img src="../img/ui/next.svg" alt="">
        </button>

        <div class="carousel__track-container">
          <ul class="carousel__track">
            <?php
            $pictures = getPetPictures($pet['id']);

            $first = true;
            foreach ($pictures as $pic) {
              if ($first) {
                echo '<li class="carousel__slide current-slide">
                  <img class="carousel__image" src=' . $pic['source'] .  ' alt="Pet photo">
                </li>';
                $first = false;
              } else {
                echo '<li class="carousel__slide">
                  <img class="carousel__image" src=' . $pic['source'] .  ' alt="Pet photo">
                </li>';
              }
            }
            ?>

          </ul>
        </div>

        <div class="carousel__nav">
          <button class="carousel__indicator current-slide"></button>

          <?php
          for ($i = 0; $i < sizeof($pictures, 0) - 1; $i++) {
            echo '<button class="carousel__indicator"></button>';
          }
          ?>

        </div>
      </div>

      <div class="fullpost">

        <div class="info">
          <div class="top-inf">
            <?php
            if ($post['adopt']) {
              echo '<a class="posttype" href="../pages/proposal.php">#AdoptMe</a>';
            } else {
              echo '<p class="posttype">#Other</p>';
            }
            ?>

            <p class="author">@<?= $username ?>, <?= $post['post_at'] ?></p>
          </div>

          <h1 class="name"><?= $pet['name'] ?>, <?= $pet['age'] ?></h1>

          <p class="description"><?= $pet['description'] ?></p>
          <p class="type">Type: <?= $pet['pet_type'] ?></p>
          <p class="size">Size: <?= $pet['size'] ?></p>
          <p class="color">Color: <?= $pet['color'] ?></p>
          <br>
          <p class="message"> <?= $post['message'] ?></p>

          <br>

          <h2>Comments</h2>

          <?php foreach ($comments as $comment) {
            $comment_owner = getCommentOwner($comment['id']);
            $answers = listAnswersToComment($post['id'], $comment['id']);
          ?>
            <div class="comment">
              <p class="comment_info"> <?= $comment['sent_at'] ?>, @<?= $comment_owner['username'] ?> says:</p>
              <p class="content"><?= $comment['message'] ?></p>
              <div class="answers">
                <ul>
                  <?php foreach ($answers as $answer) {
                    $answer_owner = getAnswerOwner($answer['id']);
                  ?>
                    <li>
                      <p class="answer_info"><?= $answer['sent_at'] ?>, @<?= $answer_owner['username'] ?> says:</p>
                      <p class="answer_content"><?= $answer['message'] ?></p>
                    </li>
                  <?php } ?>
                </ul>
                <form class="form__container" action="../actions/send_answer_action.php" method="post" enctype="multipart/form-data">
                  <label for="new_answer">Write your answer:</label>
                  <input type="hidden" id="postId" name="postId" value="<?= $post['id'] ?>">
                  <input type="hidden" id="commentid" name="commentid" value="<?= $comment['id'] ?>">
                  <input type="hidden" id="userid" name="userid" value="<?= $_SESSION['userid'] ?>">

                  <textarea class="new_answer" name="new_answer" rows="2" cols="200"></textarea>
                  <div class="save-div">
                    <button type="submit" id="send" class="btn send">Send<i class='fas fa-send'></i></button>
                  </div>
                </form>
              </div>
            </div>
          <?php } ?>

          <form class="form__container" action="../actions/send_comment_action.php" method="post" enctype="multipart/form-data">
            <label for="new_answer">Write a new comment:</label>
            <input type="hidden" id="postId" name="postId" value="<?= $post['id'] ?>">
            <input type="hidden" id="commentid" name="commentid" value="<?= $comment['id'] ?>">
            <input type="hidden" id="userid" name="userid" value="<?= $_SESSION['userid'] ?>">

            <textarea class="new_answer" name="new_answer" rows="2" cols="200"></textarea>
            <div class="save-div">
              <button type="submit" id="send" class="btn send">Send<i class='fas fa-send'></i></button>
            </div>
          </form>

        </div>

        <div class="fullinteractions">
          <?php if (!$favorite) { ?>
            <button id="like<?= $post['id'] ?>" class="btn like"><i onclick="changeIconLike(this)" class="far fa-heart"></i></button>
            <p id="like_text<?= $post['id'] ?>" class="label">Like</p>
          <?php } else { ?>
            <button id="like<?= $post['id'] ?>" class="btn like"><i onclick="changeIconDislike(this)" class="fas fa-heart"></i></button>
            <p id="like_text<?= $post['id'] ?>" class="label">Dislike</p>
          <?php } ?>
        </div>
      </div>
    </div>

    </div>
    </div>

    <script src="../js/carousel.js"></script>

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


    <!-- </body>
</html> -->



  <?php } ?>