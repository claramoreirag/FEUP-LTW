<?php

    include_once('../utils/session.php');
    include_once('../db/posts.php');
    include_once('../db/connection.php');
    include_once('../db/proposals.php');

   
    if($_SESSION['csrf'] !== $_POST['csrf']){
	    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
	    die(header('Location: ../index.php'));
    }

    $userid=$_SESSION['userid'];
    insertProposal($_POST['postId'],$userid,$_POST['message']);

    header('Location: ../pages/feed.php');
    
?>