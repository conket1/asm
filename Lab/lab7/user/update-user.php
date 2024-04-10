<?php
session_start();
require("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    try {
        if (isset($connection)) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role'];

            $query = "UPDATE user SET username = :username, email = :email, password = :password, role = :role WHERE id = :id";
            $statement = $connection->prepare($query);
            $success = $statement->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $password,
                ':role' => $role,
                ':id' => $id
            ]);

            if ($statement->execute()) {
                header("Location: user.php");
                exit();
            } else {
                echo "Có lỗi xảy ra khi cập nhật.";
            }
        }
    } catch (\Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
