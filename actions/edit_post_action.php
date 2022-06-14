<?php
    include_once('../utils/session.php');
    include_once('../db/users.php');
    include_once('../db/connection.php');

    $name = preg_replace ("/[^a-zA-Z\s]/", '', $_POST['pet_name']);
    $age = preg_replace ("/[^a-zA-Z0-9\s]/", '', $_POST['pet_age']);

    $color = preg_replace ("/[^a-zA-Z\s]/", '', $_POST['pet_color']);
    
    if($_SESSION['csrf'] !== $_POST['csrf']){
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Invalid request! Wrong token');
        die(header('Location: ../index.php'));
    }
    

    $userid = $_SESSION['userid'];
    $fileName = "../img/default_user.jpg";
    $pet = getPetofPost($_POST['postId']);
    if($_POST['pet_type']=="")$type=$pet['pet_type'];
    else $type=$_POST['pet_type'];

    if($_POST['name']=="")$pname=$pet['name'];
    else $pname=$_POST['name'];
    if(is_array($_FILES['pet_pic'])){
        
        $allowedExts = array("jpeg", "jpg", "png");
        $temp = explode(".", $_FILES['pet_pic']["name"]);
        $extension = end($temp);
        if ((($_FILES['pet_pic']["type"] == "image/jpeg")
        || ($_FILES['pet_pic']["type"] == "image/jpg")
        || ($_FILES['pet_pic']["type"] == "image/pjpeg")
        || ($_FILES['pet_pic']["type"] == "image/x-png")
        || ($_FILES['pet_pic']["type"] == "image/png"))
        && ($_FILES['pet_pic']["size"] < 50000000)
        && in_array($extension, $allowedExts)) {
            if ($_FILES['pet_pic']["error"] > 0) {
                echo "Return Code: " . $_FILES['pet_pic']["error"] . "<br>";
            }
            else {
                $name = $_FILES['pet_pic']["name"];
                $ext = explode(".", $name)[1];
                $fileName = "../img/". $type."/" . $petid."_".$pname . "." . $ext;
                if(move_uploaded_file($_FILES['pet_pic']['tmp_name'],  $fileName)){
                    
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

    $postId = $_POST['postId'];
    if ( !preg_match ("/^[a-zA-Z0-9]*$/", $postId)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Post ID can only contain letters and numbers!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_name = $_POST['pet_name'];
    if(!preg_match ("/^[a-zA-Z\s]*$/", $pet_name)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet name can only contain letters and spaces!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_age = $_POST['pet_age'];
    if(!preg_match ("/^[0-9]{0,3}$/", $pet_age)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet age can only contain numbers!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_type = $_POST['pet_type'];
    if(!preg_match ("/^[a-zA-Z\s]*$/", $pet_type)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet type can only contain letters and spaces!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_size = $_POST['pet_size'];
    if(!preg_match ("/^[a-zA-Z\s]*$/", $pet_size)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet size can only contain letters and spaces!');
        die(header('Location: ../pages/feed.php'));
    }

    $pet_colour = $_POST['pet_colour'];
    if(!preg_match ("/^[a-zA-Z\s]*$/", $pet_colour)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Pet colour can only contain letters and spaces!');
        die(header('Location: ../pages/feed.php'));
    }

    $description = preg_replace ("/[^a-zA-Z!.\',?\-\s]/", '', $_POST['pet_description']);
    var_dump($description);die();
    $message = preg_replace ("/[^a-zA-Z!.\',?\-\s]/", '', $_POST['post_message']);
    
    $petid=editPost($postId, $pet_name, $pet_age, $pet_type, $pet_size, $pet_colour, $pet_description, 
        $post_message, $fileName);

    //insertPicture($fileName,$petid);
    header('Location: ../pages/profile.php');
    
?>