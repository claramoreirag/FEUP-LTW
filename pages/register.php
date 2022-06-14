

<?php 
  include_once('../utils/session.php');
  include_once('../templates/register.php');
  include_once('../templates/common.php');
  include_once('../templates/messages.php');
  // Verify if user is logged in
  if (isset($_SESSION['username']))
  die(header('Location: temPage.php'));
  
  
  draw_header();
  display_messages();
  draw_register();
  draw_footer();
?>