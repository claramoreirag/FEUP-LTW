<?php
  include_once('../templates/common.php');
  include_once('../templates/fullPost.php');
  include_once('../utils/session.php');
  include_once('../db/comments.php');
  include_once('../db/posts.php');
  include_once('../db/proposals.php');
  include_once('../templates/messages.php');
  
  draw_loggedin_profile();
  display_messages();
  draw_post($_GET['postid']);
  draw_footer();

?>