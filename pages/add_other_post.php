<?php 
  include_once('../templates/add_other_post.php');
  include_once('../templates/common.php');
  include_once('../templates/messages.php');
  draw_loggedin_profile();
  display_messages();
  draw_other_post();
  draw_footer();
?>