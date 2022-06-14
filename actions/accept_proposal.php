<?php

    include_once('../utils/session.php');
    include_once('../db/posts.php');
    include_once('../db/connection.php');

	$postFromGET = $_GET['post'];

	$user = $_GET['user'];

   $post=getPostbyID($postFromGET);
   setAdoptedPost($postFromGET);
   setNewOwner($post['pet'], $user);
   eraseProposal($postFromGET, $user);


    header('Location: ../pages/see_proposals.php');
?>