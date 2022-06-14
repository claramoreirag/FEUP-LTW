<?php
include_once('../utils/session.php');
include_once('../db/posts.php');
include_once('../db/connection.php');


if($_GET['post'] != NULL){
    addPostToFavorites($_GET['post']);
}

?>


