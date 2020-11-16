<?php
    class DB
    {
        private $pdo;
        public function __construct() {
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=blog", "root", "admin123");
                $this->pdo = $pdo;
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                var_dump($e);
                die();
            }
        }

        public function index() {
            $statement = $this->pdo->prepare("SELECT p.title, p.content, p.image, p.created_at, u.name 
            FROM posts as p 
            INNER JOIN users as u
            ON p.author_id = u.id");
            if ($statement->execute()) {
                return $statement->fetchall(PDO::FETCH_CLASS);
            }
        }

        public function userVerification($email, $password) {
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(":email" , $email);

            if ($statement->execute()) {
                return $statement->fetch(PDO::FETCH_OBJ);
            }
        } 

        public function storeBlogWithImage($title, $content, $image, $authorId) {
            $statement = $this->pdo->prepare("INSERT INTO `posts` 
            (`title`, `content`, `image`, `author_id`) VALUE
            (:title, :content, :image, :authorId)");

            $statement->bindParam(":title", $title);
            $statement->bindParam(":content", $content);
            $statement->bindParam(":image", $image);
            $statement->bindParam(":authorId", $authorId);

            if ($statement->execute()) {
                header("location:../admin/starter.php");
            }
        }

        public function storeBlog($title, $content, $authorId) {
            $statement = $this->pdo->prepare("INSERT INTO `posts` 
            (`title`, `content`, `author_id`) VALUE
            (:title, :content, :authorId)");

            $statement->bindParam(":title", $title);
            $statement->bindParam(":content", $content);
            $statement->bindParam(":authorId", $authorId);

            if ($statement->execute()) {
                header("location:../admin/starter.php");
            }
        }

        public function indexBlog($authorId) {
            $statement = $this->pdo->prepare("SELECT * FROM posts WHERE `author_id` = :authorID");

            $statement->bindParam(":authorID", $authorId);

            if ($statement->execute()) {
                return $statement->fetchall(PDO::FETCH_CLASS);
            }
        }

        public function editBlog($id) {
            $statement = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
            $statement->bindParam(":id", $id);

            if($statement->execute()) {
                return $statement->fetch(PDO::FETCH_OBJ);
            }
        }

        public function updateBlog($id, $title, $content) {
            $statement = $this->pdo->prepare("UPDATE posts SET 
            title = :title, content = :content WHERE id = :id");

            $statement->bindParam(":id", $id);
            $statement->bindParam(":title", $title);
            $statement->bindParam(":content", $content);

            if ($statement->execute()) {
                header("location:../admin/starter.php");
            }
        }

        public function updateBlogWithImage($id, $title, $content, $image) {
            $statement = $this->pdo->prepare("UPDATE posts SET 
            title = :title, content = :content, image = :image WHERE id = :id");

            $statement->bindParam(":id", $id);
            $statement->bindParam(":title", $title);
            $statement->bindParam(":content", $content);
            $statement->bindParam(":image", $image);

            if ($statement->execute()) {
                header("location:../admin/starter.php");
            }
        }

        public function deleteBlog($id) {
            $statement = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
            $statement->bindParam(":id", $id);

            if($statement->execute()) {
                header("location:../admin/starter.php");
            }
        }

        public function storeUser($name, $email, $password) {
            $statement = $this->pdo->prepare("INSERT INTO `users`(`name`, `email`, `password`) VALUE (:name, :email, :password)");

            $statement->bindParam(":name", $name);
            $statement->bindParam(":email", $email);
            $statement->bindParam(":password", $password);

            if ($statement->execute()) {
                header("location:../admin/login.html");
            }
        }
    }
?>