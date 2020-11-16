<?php 
    if ($_GET) {
        require_once "DB.php";
        $db = new DB();
        $db->deleteBlog($_GET["id"]);
    }
?>