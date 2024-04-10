<?php
session_start();
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    try {
        if (isset($connection)) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $picture = $_POST['picture'];
            $message = $_POST['message'];

            // Cập nhật thông tin blog
            $query = "UPDATE posts SET name = :name, picture = :picture, message = :message WHERE id = :id";
            $statement = $connection->prepare($query);
            $success = $statement->execute([
                ':name' => $name,
                ':picture' => $picture,
                ':message' => $message,
                ':id' => $id
            ]);

            if ($statement->execute()) {
                header("Location: quanly.php");
                exit();
            } else {
                echo "Có lỗi xảy ra khi cập nhật bài đăng.";
            }
        }
    } catch (\Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>