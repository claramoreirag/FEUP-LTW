<?php 

$posts = getPostsFromUser($_SESSION['userid']);

foreach($posts as $post) { 

    $pet = getPetbyID($post['pet']);
    $pic = getPetPicture($pet['id']);
?>
<div class="post">

      <div class="info">
      <div class="top-inf">
      <?php
      if($post['adopt']){
        if($post['is_adopted']) echo '<p class="posttype">#AlreadyAdopted</p>';
        else echo '<p class="posttype">#AdoptMe</p>';
      }else{
        echo '<p class="posttype">#Other</p>';
      }
      ?>

      <p class="author"><?=$post['post_at']?></p>
      </div>

        <h1 class="post_name"><?=$pet['name']?>, <?=$pet['age']?></h1>
        <div class="flex__container">
          <div class="description__container">
            <p class="description"><?=$pet['description']?></p>
            <p class="type">Type: <?=$pet['pet_type']?></p>
            <p class="size">Size: <?=$pet['size']?></p>
            <p class="color">Color: <?=$pet['color']?></p>
            <br>
            <p class="message"> <?=$post['message']?></p>
          </div>
          <div class="petpic__container">
            <img class="postpic" src="<?=$pet['photo']?>" alt="profile picture">
          </div>
        </div>
      </div>

      <div id="confirmDelete" class="confirmDelete">
        
        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Do you want to delete this post?</h2>

          <div class="confirm__button">
            <!--save button-->
            <form method="post" action="../actions/delete_post.php?postid=<?php echo $post['id']; ?>">
              <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
              <button type="submit" id="confirm" class="btn confirm">
                <!-- <a class="get__more" href="../actions/delete_post.php?postid=<?php echo $post['id']; ?>"> -->
                  Delete<i class="fas fa-trash-alt"></i>
                <!-- </a> -->
              </button>
            </form>
          </div>
          <br>
      
        </div>
      </div>
      
      <div class="interactions">

        <button id="more" class="btn more"><a class="get__more" href="fullPost.php?postid=<?php echo $post['id']; ?>"><i class="fas fa-plus"></i></a></button>
        <p class="label">See More</p>
        
        <button id="edit_post" class="btn edit_post"><a class="get_edit_post" href="../pages/edit_post.php?postid=<?php echo $post['id']; ?>""><i class="fas fa-edit"></i></a></button>

        <p class="label">Edit</p>
        <button id="delete_post<?=$post['id']?>" class="btn delete_post"><i class="fas fa-trash-alt"></i></button>
        <p class="label">Delete</p>
        
      </div>

      <script>

        var modal_delete = document.getElementById("confirmDelete");
        var btn_delete = document.getElementById("delete_post<?=$post['id']?>");
     
        console.log(btn_delete);
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 

        btn_delete.onclick = function() {
          modal_delete.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal_delete.style.display = "none";
        }
        // // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //   if (event.target == post) {
        //     modal_delete.style.display = "none";
        //   }
        // }
        </script>
    </div>
      <br>

<?php } ?>
