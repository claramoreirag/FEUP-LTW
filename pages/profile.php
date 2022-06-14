<?php 
  include_once('../utils/session.php');
  include_once('../templates/profile.php');
  include_once('../templates/common.php');
  include_once('../db/connection.php');
  include_once('../db/pets.php');
  include_once('../db/posts.php');
  include_once('../db/users.php');
  include_once('../templates/messages.php');
  
  
  
  draw_loggedin_profile();
  display_messages();
  draw_profile();
  draw_footer();
?>