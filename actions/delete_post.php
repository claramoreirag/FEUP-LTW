<?php
    include_once('../utils/session.php');
    include_once('../db/posts.php');

	if($_SESSION['csrf'] !== $_POST['csrf']){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
        die(header('Location: ../index.php'));
    }

    $postId = $_GET['postid'];

    if ( !preg_match ("/^[a-zA-Z0-9]+$/", $postId)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Post ID can only contain letters and numbers!');
        die(header('Location: ../pages/feed.php'));
    }

    deletePost($postId);

    header('Location: ../pages/profile.php');
?>