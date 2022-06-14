<?php 
  include_once('../utils/session.php');
  include_once('../templates/login.php');
  include_once('../templates/common.php');
  include_once('../templates/messages.php');
  // Verify if user is logged in
  if (isset($_SESSION['username']))
  die(header('Location: mainPage.php'));
  
  
  draw_profile_header();
  display_messages();
  draw_login();
  draw_footer();
?>