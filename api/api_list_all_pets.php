<?php
include_once('../utils/session.php');
  include_once('../db/posts.php');

  header('Content-Type: pets/json');

  // Verify if user is logged in
  if (!isset($_SESSION['username']))
    die(json_encode(array('error' => 'not_logged_in')));

  // $type = $_POST['type'];
  // $item = getItem($item_id);

  // // Verifies if item exists and user is owner
  // if (!$item || !checkIsListOwner($_SESSION['username'], $item['list_id']))
  //   die(json_encode(array('error' => 'not_item_owner')));

  // // Toggles the done state
  // toggleItem($item_id);

  // Gets the posts from the database
  $posts = getAllPets();

  // Returns the item as JSON
  echo json_encode($posts);
?>