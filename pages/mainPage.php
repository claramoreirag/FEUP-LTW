<?php 
  include_once('../templates/mainPage.php');
  include_once('../templates/common.php');
  include_once('../utils/session.php');
  
  if(isset($_SESSION['username'])){
    draw_loggedin_profile();
  }
  else{
    draw_header();

  }
  draw_mainPage();
  draw_footer();
?>