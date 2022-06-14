<?php

    include_once('../utils/session.php');
    include_once('../db/comments.php');
    include_once('../db/connection.php');
   
    $userid=$_SESSION['userid'];
    insertComment($_POST['postId'],$userid,$_POST['message']);

    header('Location: ../pages/feed.php');
?>