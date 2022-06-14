        var modal_comm = document.getElementById("makeQuestion");
        var btn_comm = document.getElementById("comment<?= $post['id'] ?>");
        console.log(btn_comm);
        var span = document.getElementsByClassName("close")[2];

        // When the user clicks the button, open the modal 
        btn_comm.onclick = function() {
          modal_comm.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal_comm.style.display = "none";
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == makeQuestion) {
            modal_comm.style.display = "none";
          }
        }