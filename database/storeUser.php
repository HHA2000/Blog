<?php 
    if ($_POST) {
        require_once "DB.php";
        $db = new DB();
        $db->storeUser($_POST["name"], $_POST["email"], $_POST["password"]);
    }
?>