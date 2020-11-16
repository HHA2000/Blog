<?php 
    require_once "DB.php";

    session_start();

    if($_POST){
        $password = $_POST["password"]; 
        $db = new DB();
        $user = $db->userVerification($_POST["email"], $password); 
        
        if ($user) {
            if ($user->password == $password) {
                $_SESSION["loggedIn"] = true;
                $_SESSION["userID"] = $user->id;
                $_SESSION["userName"] = $user->name;
                header("location:../admin/starter.php");
            } else {
                echo "Wrong Password!!!";
                die();
            }
        } else {
            echo "User Not Found";
            die();
        }
    }
?>