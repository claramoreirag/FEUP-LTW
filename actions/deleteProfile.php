<?php
    include_once('../utils/session.php');
    include_once('../db/posts.php');
    include_once('../db/users.php');
    include_once('../db/proposals.php');
    deletePost($_GET['userid']);
    $user=getUserbyId($_GET['userid']);
    $posts=getPostsFromUser($_GET['userid']);
    foreach($posts as $post){
        deletePost($post['id']);
    }
    deleteUserProposals($_GET['userid']);
    deleteUser($_GET['userid']);
    session_destroy();
    session_start();
    header('Location: ../pages/login.php');
?>