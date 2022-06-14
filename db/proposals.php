
<?php
include_once('../db/connection.php');


function checkAlreadyProposed($postid, $userid)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM proposal WHERE postid=? AND user=?');
  $stmt->execute(array($postid, $userid));
  return $stmt->fetch();
}

function insertProposal($postid, $userid, $message)
{
  global $db;

  $stmt = $db->prepare('INSERT INTO proposal(postid,user,message,accepted) VALUES(?, ?, ?, ?)');
  $stmt->execute(array($postid, $userid, $message, 0));
}


function getAllProposals($userid)
{
  global $db;

  $stmt = $db->prepare('SELECT * FROM proposal WHERE postid in (SELECT id from post where owner =?)');
  if (!$stmt) {
    echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
  }
  $stmt->execute(array($userid));
  return $stmt->fetchAll();
}


function deleteUserProposals($userid){
  
    global $db;
  
    $stmt = $db->prepare('DELETE FROM proposal where  user=?');
    if (!$stmt) {
      echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
    }
    $stmt->execute(array( $userid));
    
  }
  
  function eraseProposal($postID, $userid)
  {
  
    global $db;
  
    $stmt = $db->prepare('DELETE FROM proposal where postid = ? AND user=?');
    if (!$stmt) {
      echo "Prepare failed: (" . $db->errno . ") " . $db->error . "<br>";
    }
    $stmt->execute(array($postID, $userid));
    return $stmt->fetch();
  }
  


?>