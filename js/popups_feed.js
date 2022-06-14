var modal_add = document.getElementById("myModal");
      
      var btn_add = document.getElementById("add post");
      var btn_adopt = document.getElementById("adopt");
      var btn_other = document.getElementById("other");
      var span = document.getElementsByClassName("close")[0];
      // When the user clicks the button, open the modal 
      btn_add.onclick = function() {
        modal_add.style.display = "block";
      }
      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal_add.style.display = "none";
      }
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal_add.style.display = "none";
        }
      }
      btn_adopt.onclick = function () {
        location.href = "../pages/add_adoption_post.php";
      }
      btn_other.onclick = function () {
        location.href = "../pages/add_other_post.php";
      }



      