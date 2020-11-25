<?php
    session_start();
    require_once "DB.php";  
    if ($_POST) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $token = $_POST["token"];
        $authorID = $_SESSION["userID"];
        $currentToken = $_SESSION["token"];

        if ($token == $currentToken) {
            $db = new DB();

            if ($title && $content) {
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
            } else {
                if (!$title && !$content) {
                    echo "title is null, content is null";
                } else if (!$title) {
                    echo "title is null";
                } else if (!$content) {
                    echo "content is null";
                }
            }
        } else {
            echo "Invalid Token";
            die();
        }
    }
?>