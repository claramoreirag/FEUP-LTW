<?php

    include_once('../utils/session.php');
    include_once('../db/posts.php');
    include_once('../db/connection.php');
    echo '<br>';
    
    if($_SESSION['csrf'] !== $_POST['csrf']){
	    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
	    die(header('Location: ../index.php'));
  	}

    $userid=$_SESSION['userid'];

    $petId = $_POST['pet'];
    if ( !preg_match ("/^[a-zA-Z0-9]*$/", $petId)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet ID can only contain letters and numbers!');
        die(header('Location: ../pages/feed.php'));
    }

    $message = $_POST['message'];
    if ( !preg_match ("/^[a-zA-Z0-9\s\.\,\!]*$/", $message)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Message can only contain letters, numbers, spaces and punctuation!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet=getPetbyID($petId);
    insertOtherPost($userid, $petId, $message, 0); //TODO alter this 0

    

    header('Location: ../pages/feed.php');
    
?>