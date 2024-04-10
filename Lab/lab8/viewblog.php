<?php
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
     if(isset($_GET['id'])) {
          $blogId = $_GET['id'];
           if (isset($connection)) {
                try {
                     $query = "SELECT * FROM posts WHERE id = :id";
                     $statement = $connection->prepare($query);
                     $statement->execute([':id' => $blogId]);
                     $blog = $statement->fetch(PDO::FETCH_ASSOC);
             
                     if($blog) {
                         echo "<h1>{$blog['name']}</h1>";
                         echo "<img src='{$blog['picture']}' alt='Picture'>";
                         echo "<p>{$blog['message']}</p>";
                     } else {
                         echo "Không tìm thấy blog!";
                     }
                 } catch (\Exception $e) {
                     echo "Lỗi: " .$e->getMessage();
                 }
           }
      } else {
          echo "ID blog không được cung cấp!";
      }
}
?>