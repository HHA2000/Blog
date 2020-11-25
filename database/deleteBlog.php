<?php 
    session_start();
    if ($_SESSION) {
      if ($_SESSION["loggedIn"]) {
            if ($_GET) {
                require_once "DB.php";
                $db = new DB();
                $db->deleteBlog($_GET["id"]);
            }
        }
    } else {
        header("location: ../admin/login.php");
    }
?>