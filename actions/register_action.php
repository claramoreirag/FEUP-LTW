<?php
  include_once('../utils/session.php');
  include_once('../db/users.php');
  
  if($_SESSION['csrf'] !== $_POST['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
    die(header('Location: ../index.php'));
  }
  
  $username = $_POST['username'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  // Don't allow certain characters
  if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers!');
    die(header('Location: ../pages/register.php'));
  }
  if ( $password !=$_POST['confirm']) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Password confirmation didn\'t match!');
    die(header('Location: ../pages/register.php'));
  }

  if(!preg_match ("/^[a-zA-Záéã\s]+$/", $name)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Name can only contain letters and spaces!');
        die(header('Location: ../pages/login.php'));
  }

  if(!preg_match ("/^[a-zA-Z0-9]+$/", $password)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Password can only contain letters and numbers!');
        die(header('Location: ../pages/login.php'));
  }


  try {
    $userid = insertUser($username, $password,$name);
    $_SESSION['userid'] = $userid;
    $_SESSION['username'] = $username;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/profile.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    header('Location: ../pages/register.php');
  }
?>