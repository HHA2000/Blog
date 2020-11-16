<?php 
    if ($_POST) {
        require_once "DB.php";
        $db = new DB();
        $id = $_POST["id"];
        $title = $_POST["title"];
        $content = $_POST["content"];

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
    }
?>