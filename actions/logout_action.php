<?php
  include_once('../utils/session.php');

  if($_SESSION['csrf'] !== $_POST['csrf']){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
        die(header('Location: ../index.php'));
  }  

  session_destroy();
  session_start();
  session_regenerate_id(true);

  header('Location: ../pages/login.php');
?>