<?php 
  include_once('../templates/edit_profile.php');
  include_once('../templates/common.php');
  include_once('../templates/messages.php');
  draw_loggedin_profile();
  display_messages();
  drawEditProfile();
  draw_footer();
?>