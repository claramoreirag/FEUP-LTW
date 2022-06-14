<?php function draw_search_feed($animalSearchTerm){
    include_once('../db/posts.php');
    
    // TODO: Check if list_feed is redundant or not
    if($animalSearchTerm == ""){
        $posts = getAllPosts();
    }
    else{
        $posts = getPostsByType($animalSearchTerm);

        if(count($posts) == 0){
            $posts = getPostsByType($animalSearchTerm);

            if(count($posts) == 0){
                $posts = getPostsByAge($animalSearchTerm);

                if(count($posts) == 0){
                    $posts = getPostsBySize($animalSearchTerm);

                    if(count($posts) == 0){
                        $posts = getPostsByColor($animalSearchTerm);

                        if(count($posts) == 0){
                            $posts = getPostsByName($animalSearchTerm);

                            if(count($posts) == 0){
                                $posts = getPostsByUserName($animalSearchTerm);
                            }
                        }
                    }
                }
            }
        }
    }
    

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
      
    <!-- TODO: see mockup, SEARCH BAR!-->

    <div class="start__container">
      <h1 class="feed">Recent Posts</h1>
      <div class="search"> 
      <form action="../pages/searchFeed.php" method="get"> 
                <input id="search__text" type="text"
                    placeholder="  Search for Animal or User"
                    name="search"> 
                <button class="search__button"> 
                    <i class="fa fa-search"
                        style="font-size: 18px;"> 
                    </i> 
                </button> 
            </form>
        </div> 
      <button id="add post" class="btn addpost">Add post <i class="fas fa-plus"></i></button>
    </div>
    <script src="../js/searchBar.js"></script>

    <hr class="start">

    <div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Choose type of post:</p>
      <br>
      <button id="adopt" class="btn adopt">Adoption </button>
      <button id="other" class="btn other">Other </button>
      </div>

    </div>

      <script>
     
      var modal = document.getElementById("myModal");
      
      var btn = document.getElementById("add post");
      var btn_adopt = document.getElementById("adopt");
      var btn_other = document.getElementById("other");
      var span = document.getElementsByClassName("close")[0];
      // When the user clicks the button, open the modal 
      btn.onclick = function() {
        modal.style.display = "block";
      }
      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
      btn_adopt.onclick = function () {
        location.href = "../pages/add_adoption_post.php";
      }
      btn_other.onclick = function () {
        location.href = "../pages/add_other_post.php";
      }
    </script>

  

  <?php foreach($posts as $post) { 
      $pet = getPetbyID($post['pet']);
      $username = getUsername($post['owner'])['username'];
      $pic = getPetPicture($pet['id']);
  ?>


    
    <div class="post">

      <div class="info">
      <!-- TODO: OUT OF POST BOX -->
      <div class="top-inf">
      <?php
       if($post['adopt']){
        if($post['is_adopted']) echo '<p class="posttype">#AlreadyAdopted</p>';
        else echo '<p id="adoptProposal' . $post["id"].'"  class="posttype adoptProposal" >#AdoptMe</p>';
      }else{
        echo '<p class="posttype">#Other</p>';
      }
      ?>

      <p class="author">@<?=$username?>, <?=$post['post_at']?></p>
      </div>

        <h1 class="name"><?=$pet['name']?>, <?=$pet['age']?></h1>
        <div class="flex__container">
          <div class="description__container">
            <p class="description"><?=$pet['description']?></p>
            <p class="type">Type: <?=$pet['pet_type']?></p>
            <p class="size">Size: <?=$pet['size']?></p>
            <p class="color">Color: <?=$pet['color']?></p>
            <br>
            <p class="message"> <?=$post['message']?></p>
          </div>
          <img class="petpic" src="<?=$pet['photo']?>" alt="profile picture">
        </div>
      </div>
      
      <div class="interactions">
        <button id="more" class="btn more"><a class="get__more" href="fullPost.php?postid=<?php echo $post['id']; ?>"><i class="fas fa-plus"></i></a></button>
        <p class="label">See More</p>
        <button id="comment" class="btn comment"><i class="far fa-comments"></i></button>
        <p class="label">Comments</p>
        <button id="like" class="btn like"><i class="far fa-heart"></i></button>
        <p class="label">Like</p>
      </div>
    </div>
      <br>

    <script type="text/javascript">
        document.getElementById("comment").onclick = function () {
          // TODO: HOW TO DO COMMENTS: pop up (all comments in fullpost)
        };
        document.getElementById("like").onclick = function () {
          // TODO: ADD TO FAVORITES OF USER
        };
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
          <input type="hidden" id="postId" name="postId" value="<?=$post['id']?>">
          <div class="save-div">
            <!--save button-->
            <button type="submit" id="save" class="btn save">Submit <i class='fas fa-save'></i></button>

            </div>
        </form>
        <br>
      
      </div>
      
    </div>

    
    
    <script>

    var modal_prop = document.getElementById("makeProposal");
      var btn_prop = document.getElementById("adoptProposal<?=$post['id']?>");
     
      //var btn_adopt = document.getElementById("adopt");
     //var btn_other = document.getElementById("other");
     var span = document.getElementsByClassName("close")[1];
     // When the user clicks the button, open the modal 
    
     btn_prop.onclick = function() {
       var owner ="<?php echo $isPostOwner ?>";
        var status="<?php echo $proposalStatus ?>";
      if(owner==""){
       if(status==""){
       modal_prop.style.display = "block";
       }
       else{
         alert('You already made a proposal, wait for it to be accepted!');
       }
     }else{
        alert('You can\'t propose to adopt your own pet.');
     }
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
    </script>
  <?php } ?>
    
    </body>
  </html>

<?php } ?>
