
<?php
include_once('../db/connection.php');

function getAllPosts()
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post ORDER BY post.post_at DESC');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute();
  return $stmt->fetchAll();
}


function getPostsByType($animalType)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post WHERE pet in (SELECT id FROM pet WHERE pet_type = ?) ORDER BY post.post_at DESC');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($animalType));
  return $stmt->fetchAll();
}

function getPostsByName($animalName)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post WHERE pet in (SELECT id FROM pet WHERE name = ?) ORDER BY post.post_at DESC');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($animalName));
  return $stmt->fetchAll();
}

function getPostsByAge($animalAge)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post WHERE pet in (SELECT id FROM pet WHERE age = ?) ORDER BY post.post_at DESC');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($animalAge));
  return $stmt->fetchAll();
}

function getPostsBySize($animalSize)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post WHERE pet in (SELECT id FROM pet WHERE size = ?) ORDER BY post.post_at DESC');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($animalSize));
  return $stmt->fetchAll();
}


function getPostsByColor($animalColor)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post WHERE pet in (SELECT id FROM pet WHERE color = ?) ORDER BY post.post_at DESC');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($animalColor));
  return $stmt->fetchAll();
}

function getPostsByUserName($userName)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post WHERE owner in (SELECT userid FROM users WHERE name = ?) ORDER BY post.post_at DESC');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($userName));
  return $stmt->fetchAll();
}

function getPostsFromUser($id)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post WHERE owner=? ORDER BY post.post_at DESC');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($id));
  return $stmt->fetchAll();
}

function getPost($postID)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM post WHERE id = ?');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($postID));
  return $stmt->fetch();
}


function getAllPets()
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM pet');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute();
  return $stmt->fetchAll();
}



function getPetbyID($petID)
{

  global $db;

  $stmt = $db->prepare('SELECT * FROM pet where id = ? ');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($petID));
  return $stmt->fetch();
}

function getPetofPost($postID)
{
  global $db;

  $auxstmt = $db->prepare('SELECT pet FROM post where id = ?');
  if (!$auxstmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $auxstmt->execute(array($postID));
  $petid = $auxstmt->fetch();


  $stmt = $db->prepare('SELECT * FROM pet where id = ?');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($petid['pet']));
  return $stmt->fetch();
}

function getUsername($userID)
{

  global $db;

  $stmt = $db->prepare('SELECT username FROM users where userid = ? ');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($userID));
  return $stmt->fetch();
}

function getPetPicture($petID)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM photo where pet = ?');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($petID));
  return $stmt->fetch();
}

function getPetPictures($petID)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM photo where pet = ?');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($petID));
  return $stmt->fetchAll();
}

function getUserFavorites($userID)
{
  global $db;
  $stmt = $db->prepare('SELECT * FROM favorite where user = ?');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($userID));
  return $stmt->fetchAll();
}


function insertPictures($imgpaths, $petID)
{
  global $db;

  foreach ($imgpaths as $imgpath) {
    
    $stmt = $db->prepare('INSERT INTO photo VALUES(?, ?)');
    $stmt->execute(array($imgpath, $petID));
  }
}


function insertPicture($imgpath, $petID)
{
  global $db;

  $stmt = $db->prepare('INSERT INTO photo VALUES(?, ?)');
  $stmt->execute(array($imgpath, $petID));
}




function insertPet($userid, $name, $age, $pet_type, $size, $color, $description, $filephoto)
{
  global $db;

  $stmt = $db->prepare('INSERT INTO pet VALUES(?, ?, ?, ?, ?, ?, ?, ?,?)');
  $stmt->execute(array($userid, $name, NULL, $age, $pet_type, $size, $color, $description, $filephoto));

  //to return currID
  $stmt = $db->prepare('SELECT id FROM pet WHERE ownerid = ? AND name = ? ');
  $stmt->execute(array($userid, $name));
  $var = $stmt->fetch();
  $petid = $var['id'];
  return $petid;
}


function insertAdoptionPost($userid, $petid, $message)
{
  global $db;

  $stmt = $db->prepare('INSERT INTO post(owner,pet,is_adopted,adopt,message) VALUES(?, ?, ?, ?, ?)');
  $stmt->execute(array($userid, $petid, 0, 1, $message));
}


function insertOtherPost($userid, $petid, $message, $isadopted)
{
  global $db;

  $stmt = $db->prepare('INSERT INTO post(owner,pet,is_adopted,adopt,message) VALUES(?, ?, ?, ?, ?)');
  $stmt->execute(array($userid, $petid, $isadopted, 0, $message));
}



function getPostbyID($postID)
{

  global $db;

  $stmt = $db->prepare('SELECT * FROM post where id = ? ');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($postID));
  return $stmt->fetch();
}


function setAdoptedPost($postID)
{

  global $db;

  $stmt = $db->prepare('UPDATE post SET is_adopted = 1  where id = ? ');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($postID));
  return $stmt->fetch();
}



function setNewOwner($petid, $userid)
{

  global $db;

  $stmt = $db->prepare('UPDATE pet set ownerid = ?  where id = ? ');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($userid, $petid));
  return $stmt->fetch();
}

function deletePost($postid)
{
  global $db;

  $pstmt = $db->prepare('SELECT * FROM post WHERE id = ?');
  $pstmt->execute(array($postid));
  $post= $pstmt->fetch();

  $stmt = $db->prepare('DELETE FROM post WHERE id = ?');
  $stmt->execute(array($postid));
  deletePet($post['pet']);
}

function deletePet($petid)
{
  global $db;

  $stmt = $db->prepare('DELETE FROM pet WHERE id = ?');
  $stmt->execute(array($petid));


}


function addPostToFavorites($postID)
{
  global $db;

  $stmt = $db->prepare('INSERT INTO favorite(user,post) VALUES(?, ?)');
  $stmt->execute(array($_SESSION['userid'], $postID));
}

function removePostFromFavorites($postID)
{
  global $db;
  $stmt = $db->prepare('DELETE FROM favorite WHERE user = ? AND post = ?');
  $stmt->execute(array($_SESSION['userid'], $postID));
}

function isPostFavorite($postID)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM favorite WHERE user = ? AND post = ?');
  $stmt->execute(array($_SESSION['userid'], $postID));
  $result = $stmt->fetch();
  if (!$result) {
    return false;
  }
  return true;
}

function editPost($postId, $pet_name, $pet_age, $pet_type, $pet_size, $pet_color, $pet_description, $post_message, $pet_pic)
{
  global $db;
  $pet = getPetofPost($postId);
  $st = $db->prepare('SELECT * FROM post WHERE id=?');
  $st->execute(array($postId));
  $post = $st->fetch();

  if ($pet_name == "") {
    $pet_name = $pet['name'];
  }
  if ($pet_age == "") {
    $pet_age = $pet['age'];
  }

  if ($pet_type == "") {
    $pet_type = $pet['pet_type'];
  }

  if ($pet_color == "") {
    $pet_color = $pet['color'];
  }

  if ($pet_pic == "../img/default_user.jpg") {
    $pet_pic = $pet['photo'];
  }

  if ($pet_size == "") {
    $pet_size = $pet['size'];
  }
  if ($pet_description == "") {
    $pet_description = $pet['description'];
  }
  if ($post_message == "") {
    $post_message = $post['bio'];
  }


  $stmt = $db->prepare('UPDATE pet SET name=?, age=?, pet_type=?, size=?, color=?, description=?, photo=? WHERE id=?');
  $stmt->execute(array($pet_name, $pet_age, $pet_type, $pet_size, $pet_color, $pet_description, $pet_pic, $pet['id']));

  $updatePost = $db->prepare('UPDATE post SET message=? WHERE id=?');
  $updatePost->execute(array($post_message, $postId));
  return $pet['id'];
}


?>