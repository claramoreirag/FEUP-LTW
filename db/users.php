<?php
    $db = new PDO('sqlite:../db/tables.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    include_once('posts.php');

    
  function checkUserPassword($username, $password) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();

    if($user !== false && password_verify($password, $user['password'])){
      return $user['userid'];
    }else{
      return false;
    }

    return $user !== false && password_verify($password, $user['password']);
  }

  function insertUser($username, $password,$name) {
    global $db;
    
    $options = ['cost' => 12];

    $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array(NULL, $name,$username, password_hash($password, PASSWORD_DEFAULT, $options),'../img/default_user.jpg','','',''));

    //to return currID
    $stmt = $db->prepare('SELECT userid FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $var = $stmt->fetch();
    $userid =$var['userid'];
    return $userid;
  }

  function getUserbyId($userid){
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE userid=?");
    $stmt->execute(array($userid));
    $user=$stmt->fetch();
    return $user;
  }
  function getCurrentUser(){
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE userid=?");
    $stmt->execute(array($_SESSION['userid']));
    $user=$stmt->fetch();
    return $user;
  }

  function editUser($userid, $name, $username, $password, $profilepic, $email, $phoneNumber, $bio){
    $options = ['cost' => 12];
    $currUser = getCurrentUser();
     
    if($name==""){
      $name=$currUser['name'];
    }
    if($username==""){
      $username=$currUser['username'];
    }

    if($password==""){
      $hashedpassword=$currUser['password'];
    }
    else{
      $hashedpassword=password_hash($password, PASSWORD_DEFAULT, $options);
    }
  
    if($profilepic=="../img/default_user.jpg"){
      $profilepic=$currUser['profilePic'];
    }
    
    if($email==""){
      $email=$currUser['email'];
    }
    if($phoneNumber==""){
      $phoneNumber=$currUser['phoneNumber'];
    }
    if($bio==""){
      $bio=$currUser['bio'];
    }
    
    global $db;
    $stmt = $db->prepare('UPDATE users SET name=?, username=?, password=?, profilePic=?, email=?, phoneNumber=?, bio=? WHERE userid=?');
    $stmt->execute(array($name, $username, $hashedpassword, $profilepic, $email, $phoneNumber, $bio, $userid));
}



function deleteUser($userid){
  global $db;
  $stmt = $db->prepare("DELETE  FROM users WHERE userid=?");
  $stmt->execute(array($userid));
  $user=$stmt->fetch();
 
}



?>
