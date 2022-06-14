<?php
include_once('../utils/session.php');
include_once('../db/posts.php');
include_once('../db/comments.php');
include_once('../db/connection.php');
insertComment($_POST['postId'],$_POST['userid'],$_POST['new_answer']);
header('Location:../pages/fullPost.php?postid='.$_POST['postId']);

?>