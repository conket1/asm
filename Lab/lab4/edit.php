<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Thông tin Người dùng</title>
</head>
<body>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username'])) {
    $username = $_GET['username'];
    
    // Kiểm tra xem 'ds_users' đã được khởi tạo chưa
    if (isset($_SESSION['ds_users'])) {
        $ds_users = $_SESSION['ds_users'];
        // Cập nhật tên người dùng và mật khẩu
        foreach ($ds_users as $key => $user) {
            if ($user['Username'] === $username) {
                if(isset($_GET['new_username'])) {
                    $new_username = $_GET['new_username'];
                    $ds_users[$key]['Username'] = $new_username;
                }
                if (isset($_GET ['new_password'])) {
                    $new_password = $_GET['new_password'];
                    $ds_users[$key]['Password'] = $new_password;
                    break;
                }
            }
        }
        $_SESSION['ds_users'] = $ds_users;
    }
}

// Xử lý khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_username'], $_POST['new_password'])) {
    // Lọc dữ liệu nhập vào
    $new_username = htmlspecialchars($_POST['new_username']);
    $new_password = htmlspecialchars($_POST['new_password']);

    // Cập nhật dữ liệu trong session
    if (isset($_SESSION['ds_users'])) {
        $ds_users = $_SESSION['ds_users'];
        foreach ($ds_users as $key => $user) {
            if ($user['Username'] === $username) {
                $ds_users[$key]['Username'] = $new_username;
                $ds_users[$key]['Password'] = $new_password;
                break;
            }
        }
        $_SESSION['ds_users'] = $ds_users;
    }
    // Chuyển hướng hoặc hiển thị thông báo thành công
    header("Location: index.php");
    exit;
}
?>
    <h2>Chỉnh sửa tên đăng nhập và mật khẩu mới</h2>
    <form action="" method="get">
        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" class="form-control mb-3" placeholder="Nhập tên đăng nhập" required>
        <label for="new_username">Tên đăng nhập mới</label>
        <input type="text" id="new_username" name="new_username" class="form-control mb-3" placeholder="Nhập tên đăng nhập mới">
        <label for="new_password">Mật khẩu mới</label>
        <input type="password" id="new_password" name="new_password" class="form-control mb-3" placeholder="Nhập mật khẩu mới">
        <input class="btn btn-block btn-info" type="submit" value="Submit" />
    </form>
</body>
</html>
