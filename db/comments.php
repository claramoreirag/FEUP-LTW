<?php

include_once('../db/connection.php');


function listCommentsFromPost($id){
    global $db;

    $stmt = $db->prepare("SELECT * FROM question WHERE postid=?");
    $stmt->execute(array($id));
    return $stmt->fetchAll();
}

function listAnswersToComment($postid,$questionid){
    global $db;

    $stmt = $db->prepare("SELECT * FROM answer WHERE postid=? and question=? ORDER BY sent_at");
    $stmt->execute(array($postid, $questionid));
    return $stmt->fetchAll();
}


function insertComment($postid, $userid, $message)
{
    global $db;

    $stmt = $db->prepare('INSERT INTO question(postid,sender,message) VALUES(?, ?, ?)');
    $stmt->execute(array($postid, $userid, $message));
}

function getCommentOwner($commentid){
    global $db;

    $stmt = $db->prepare("SELECT username FROM users WHERE userid in (SELECT sender FROM question WHERE id=?)");
    $stmt->execute(array($commentid));
    return $stmt->fetch();
}



function getAnswerOwner($answer){
    global $db;

    $stmt = $db->prepare("SELECT username FROM users WHERE userid in (SELECT owner FROM answer WHERE id=?)");
    $stmt->execute(array($answer));
    return $stmt->fetch();
  
}

function insertAnswer($commentid,$postId,$userid,$new_answer){
    global $db;

    $stmt = $db->prepare('INSERT INTO answer(question,postid,owner,message) VALUES(?, ?, ?,?)');
    $stmt->execute(array($commentid,$postId,$userid,$new_answer));
}
