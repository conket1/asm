<?php
session_start();
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
     try {
          if (isset($connection)) {
               $idxoa = $_GET['id'];
               $query = "DELETE FROM posts WHERE id = :id";
               $statement = $connection->prepare($query);
               $success = $statement->execute([
                    ':id' => $idxoa
               ]);
               if ($statement->execute()) {
                    header("Location: quanly.php");
                    exit();
               } else {
                    echo "Xóa không thành công";  
               }
          }
     } catch (\Exception $e) {
          echo "Lỗi:" . $e->getMessage();
     }
}
?>