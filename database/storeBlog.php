<?php
    session_start();
    require_once "DB.php";
    
    if ($_POST) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $authorID = $_SESSION["userID"];

        $db = new DB();

        if (!$_FILES["image"]["name"]) {
            $db->storeBlogWithImage($title, $content, $filename, $authorID);
        } else {
            $filename = "../image/".$_FILES["image"]["name"];
            $imageType = pathinfo($filename, PATHINFO_EXTENSION);

            if ($imageType != "png" && $imageType != "jpg" && $imageType != "jpeg") {
                echo "Image must be png or jpg or jpeg";
            } else {
                move_uploaded_file($_FILES["image"]["tmp_name"], $filename);
                $db->storeBlogWithImage($title, $content, $filename, $authorID);
            } 
        }

        
    }
?>