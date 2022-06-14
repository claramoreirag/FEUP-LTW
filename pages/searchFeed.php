<?php
  include_once('../templates/common.php');
  include_once('../templates/searchFeed.php');
  include_once('../utils/session.php');
  include_once('../templates/messages.php');
  
  draw_loggedin_profile();
  display_messages();
  draw_search_feed($_GET['search']);
  draw_footer();

?>