<?php 
  include_once('../templates/edit_post.php');
  include_once('../templates/common.php');
  include_once('../templates/messages.php');
  draw_loggedin_profile();
  display_messages();
  drawEditPost($_GET['postid']);
  draw_footer();
?>