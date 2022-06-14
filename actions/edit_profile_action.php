<?php

    include_once('../utils/session.php');
    include_once('../db/users.php');
    include_once('../db/connection.php');

    if($_SESSION['csrf'] !== $_POST['csrf']){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
        die(header('Location: ../index.php'));
    }

    $id=$_SESSION['userid'];
    $fileName="../img/default_user.jpg";
    if(is_array($_FILES['profilepic'])){
        
            $allowedExts = array("jpeg", "jpg", "png");
            $temp = explode(".", $_FILES['profilepic']["name"]);
            $extension = end($temp);
            if ((($_FILES['profilepic']["type"] == "image/jpeg")
            || ($_FILES['profilepic']["type"] == "image/jpg")
            || ($_FILES['profilepic']["type"] == "image/pjpeg")
            || ($_FILES['profilepic']["type"] == "image/x-png")
            || ($_FILES['profilepic']["type"] == "image/png"))
            && ($_FILES['profilepic']["size"] < 50000000)
            && in_array($extension, $allowedExts)) {
                if ($_FILES['profilepic']["error"] > 0) {
                    echo "Return Code: " . $_FILES['profilepic']["error"] . "<br>";
                }
                else {
                    $name = $_FILES['profilepic']["name"];
                    $ext = explode(".", $name)[1];
                    $fileName = "../img/users/" . $id . "." . $ext;
                    if(move_uploaded_file($_FILES['profilepic']['tmp_name'],  $fileName)){
                        
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
    

    $name = $_POST['name'];
    if(!preg_match ("/^[a-zA-Z\s]*$/", $name)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Name can only contain letters and spaces!');
        die(header('Location: ../pages/profile.php'));
    }

    $username = $_POST['username'];
    if(!preg_match ("/^[a-zA-Z0-9]*$/", $username)){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Username can only contain letters and numbers!');
        die(header('Location: ../pages/profile.php'));
    }

    $enter = $_POST['enter'];
    if(!preg_match ("/^[a-zA-Z0-9]*$/", $enter)){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Password can only contain letters and numbers!');
        die(header('Location: ../pages/profile.php'));
    }

    $email = $_POST['email'];
    if(!preg_match ("/^(([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}){0,1}$/", $email)){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Email can only be in this format: [email]@[host].com!');
        die(header('Location: ../pages/profile.php'));
    }
    
    $phone = $_POST['phone'];
    if(!preg_match ("/^([0-9]{9}){0,1}$/", $phone)){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Phone can only have exactly 9 numbers!');
        die(header('Location: ../pages/profile.php'));
    }


    editUser($id, $_POST['name'], $_POST['username'], $_POST['enter'] , $fileName,$_POST['email'], $_POST['phone'], $_POST['bio']);
    header('Location: ../pages/profile.php');
    //header( 'Location: ../pages/profile.php' ) ;
?>