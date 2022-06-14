<?php
  include_once('../templates/common.php');
  include_once('../templates/see_proposals.php');
  include_once('../utils/session.php');
  include_once('../db/posts.php');
  include_once('../db/users.php');
  include_once('../db/proposals.php');
  include_once('../templates/messages.php');
  draw_loggedin_profile();
  display_messages();
  draw_see_proposals();
  draw_footer();

?>