<?php 
    require_once "DB.php";

    session_start();

    if($_POST){
        $token = $_POST["token"];
        $currentToken = $_SESSION["token"];

        if ($token == $currentToken) {
            $db = new DB();
            $user = $db->userVerification($_POST["email"]); 

            if ($user) {
                if (password_verify($_POST["password"], $user->password)) {
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
        } else {
            echo "Invalid Token";
        }
    }
?>