<?php

    include_once('../utils/session.php');
    include_once('../db/posts.php');
    include_once('../db/connection.php');
    echo '<br>';

    if($_SESSION['csrf'] !== $_POST['csrf']){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
        die(header('Location: ../index.php'));
    }
    
    $userid = $_SESSION['userid'];
    $fileName = "../img/default_user.jpg";
    
    if(is_array($_FILES['pictures'])){
        
        $allowedExts = array("jpeg", "jpg", "png");
        $temp = explode(".", $_FILES['pictures']["name"]);
        $extension = end($temp);
        if ((($_FILES['pictures']["type"] == "image/jpeg")
        || ($_FILES['pictures']["type"] == "image/jpg")
        || ($_FILES['pictures']["type"] == "image/pjpeg")
        || ($_FILES['pictures']["type"] == "image/x-png")
        || ($_FILES['pictures']["type"] == "image/png"))
        && ($_FILES['pictures']["size"] < 50000000)
        && in_array($extension, $allowedExts)) {
            if ($_FILES['pictures']["error"] > 0) {
                echo "Return Code: " . $_FILES['pictures']["error"] . "<br>";
            }
            else {
                $name = $_FILES['pictures']["name"];
                $ext = explode(".", $name)[1];
                $fileName = "../img/". $_POST['type']."/" . $petID."_".$_POST['name'] . "." . $ext;
                if(move_uploaded_file($_FILES['pictures']['tmp_name'],  $fileName)){
                    
                }
                else{
                    echo 'Error uploading file.';
                }
            }   
        } 
        else {
            echo "<div class='alert alert-success'>Image type or size is not valid.</div>";
        }
        
    }


    $pet_name = $_POST['name'];
    if(!preg_match ("/^[a-zA-Z\s]+$/", $pet_name)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet name can only contain letters and spaces!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_age = $_POST['age'];
    if(!preg_match ("/^[0-9]{1,3}$/", $pet_age)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet age can only contain numbers!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_type = $_POST['type'];
    if(!preg_match ("/^[a-zA-Z\s]+$/", $pet_type)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet type can only contain letters and spaces!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_size = $_POST['size'];
    if(!preg_match ("/^[a-zA-Z\s]+$/", $pet_size)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet size can only contain letters and spaces!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_colour = $_POST['color'];
    if(!preg_match ("/^[a-zA-Z\s]+$/", $pet_colour)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet colour can only contain letters and spaces!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_description = $_POST['description'];
    if(!preg_match ("/^[a-zA-Z\s\,\.\!\?]+$/", $pet_description)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet description can only contain letters, spaces and punctuation!');
        die(header('Location: ../pages/feed.php'));
    }

    $post_message = $_POST['message'];
    if(!preg_match ("/^[a-zA-Z\s\,\.\!\?]+$/", $post_message)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Post message can only contain letters, spaces and punctuation!');
        die(header('Location: ../pages/feed.php'));
    }
    
    $petID= insertPet($userid, $pet_name, $pet_age, $pet_type, $pet_size, $pet_colour, $pet_description, $fileName);
    insertPicture($fileName, $petID);
    insertAdoptionPost($userid, $petID, $post_message);
    

    header('Location: ../pages/feed.php');
    
?>