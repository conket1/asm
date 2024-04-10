<?php
session_start();
require("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    try {
        if (isset($connection)) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $picture = $_POST['picture'];
            $description = $_POST['description'];

            $query = "UPDATE product SET name = :name, picture = :picture, description = :description WHERE id = :id";
            $statement = $connection->prepare($query);
            $success = $statement->execute([
                ':name' => $name,
                ':picture' => $picture,
                ':description' => $description,
                ':id' => $id
            ]);

            if ($statement->execute()) {
                header("Location: admin.php");
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
