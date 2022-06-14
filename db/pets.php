<?php
include_once('../db/connection.php');

function getPetsFromUser($userid){
    global $db;

    $stmt = $db->prepare("SELECT * FROM pet WHERE ownerid=?");
    $stmt->execute(array($userid));
    return $stmt->fetchAll();
}
?>