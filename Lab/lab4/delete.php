<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username'])) {
    $username = $_GET['username'];
    
    // Kiểm tra xem 'ds_users' đã được khởi tạo chưa
    if (isset($_SESSION['ds_users'])) {
        $ds_users = $_SESSION['ds_users'];
        
        // Lặp qua mảng người dùng và xóa người dùng khi click vào delete
        foreach ($ds_users as $key => $user) {
            if ($user['Username'] === $username) {
                unset($ds_users[$key]);
                $_SESSION['ds_users'] = $ds_users;
                break; 
            }
        }
    }
}

header("Location: index.php");
exit();
?>
