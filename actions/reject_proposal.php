<?php

    include_once('../utils/session.php');
    include_once('../db/posts.php');
    include_once('../db/connection.php');
    include_once('../db/proposals.php');

    $post=getPostbyID($_GET['post']);
    
    eraseProposal($_GET['post'],$_GET['user']);

    header('Location: ../pages/see_proposals.php');
?>