<?php 
    session_start();
    if ($_SESSION) {
      if ($_SESSION["loggedIn"]) {
            if ($_POST) {
                require_once "DB.php";
                $db = new DB();
                $token = $_POST["token"];
                $id = $_POST["id"];
                $title = $_POST["title"];
                $content = $_POST["content"];
                $currentToken = $_SESSION["token"];

                if ($token == $currentToken) {
                    if ($title && $content) {
                        if (!$_FILES["image"]["name"]) {
                            $db->updateBlog($id, $title, $content);
                        } else {
                            $filename = "../image/".$_FILES["image"]["name"];
                            $imageType = pathinfo($filename, PATHINFO_EXTENSION);
                
                            if ($imageType != "png" && $imageType != "jpg" && $imageType != "jpeg") {
                                echo "Image must be png or jpg or jpeg";
                            } else {
                                move_uploaded_file($_FILES["image"]["tmp_name"], $filename);
                                $db->updateBlogWithImage($id, $title, $content, $filename);
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
                    echo "Invalid token";
                    die();
                }
            }
        }
    } else {
        header("location: login.php");
    }
?>