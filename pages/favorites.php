<?php 
  include_once('../utils/session.php');
  include_once('../templates/favorites.php');
  include_once('../templates/common.php');
  include_once('../db/proposals.php');
  include_once('../db/connection.php');
  include_once('../db/posts.php');
  include_once('../db/users.php');
  include_once('../templates/messages.php');
  draw_header_favorites();
  display_messages();
  draw_favorites();
  draw_footer();
?>