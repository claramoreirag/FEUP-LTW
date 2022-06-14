<?php
  include_once('../utils/session.php');
  include_once('../db/users.php');

  if($_SESSION['csrf'] !== $_POST['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
    die(header('Location: ../index.php'));
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $userid = checkUserPassword($username, $password);
  
  if ($userid) {
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $userid;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
    header('Location: ../pages/profile.php');                  //feed
  } else {
    // // var_dump($_SESSION('auth_tries'));
    // $_SESSION['auth_tries']++;
    // usleep(pow(250000, $_SESSION['auth_tries'])); //For every wrong authentication, the function sleeps
    //                                                   //0.25^(tries) seconds
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
    header('Location: ../pages/login.php');                 //back to login
  }

?>
