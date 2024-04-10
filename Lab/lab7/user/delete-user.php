<?php
session_start();
require("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
     try {
          if (isset($connection)) {
               $idxoa = $_GET['id'];
               $query = "DELETE FROM user WHERE id = :id";
               $statement = $connection->prepare($query);
               $success = $statement->execute([
                    ':id' => $idxoa
               ]);
               if ($statement->execute()) {
                    header("Location: user.php");
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