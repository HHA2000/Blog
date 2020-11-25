<?php 
    session_start();
    if ($_POST) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $token = $_POST["token"];
        $currentToken = $_SESSION["token"];

        if ($token == $currentToken) {
            if ($name && $email && $password) {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    
                require_once "DB.php";
                $db = new DB();
                $db->storeUser($name, $email, $hashPassword);
            } else {
                if (!$name && !$email && !$password) {
                    echo "name is null <br> email is null <br> password is null";
                } elseif (!$name) {
                    echo "name is null";
                } elseif (!$email) {
                    echo "email is null";
                } elseif (!$password) {
                    echo "password is null";
                }
            }
        } else {
            echo "Invalid Token";
            die();
        }
    }
?>