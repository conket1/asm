<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" class="">
    <title>Đăng Ký</title>
</head>
<body>
    <?php
    session_start();
    $errors = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username'])) {
            if (empty($_POST['username'])) {
                $errors['username'] = "Username không được để trống !";
            }
        }
        if (isset($_POST['email'])) {
            if (empty($_POST['email'])) {
                $errors['email'] = "Bạn chưa nhập email";
            }
        }
        if (isset($_POST['password'])) {
            if (empty($_POST['password'])) {
                $errors['password'] = "Email không được để trống !";
            }
        }
        if (isset($_POST['confirmpassword'])) {
            if ($_POST['password'] != $_POST['confirmpassword']) {
                $errors['confirmpassword'] = "Mật khẩu nhập lại không đúng !";
            }
        }
        if (isset($_POST['role'])) {
            if (empty($_POST['role'])) {
                $errors['role'] = "Bạn chưa chọn quyền truy cập !";
            }
        }
    }
    
    
    //validate email
    if (isset($_POST['email'])) {
        if (empty($_POST['email'])) {
            $errors['email'] = "Bạn chưa nhập email";
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không đúng định dạng!";
            }
        }
    }
    //validate password > 6 kí tự
    if (isset($_POST['password'])) {
        if(empty($_POST['password'])){
            $errors['password'] = "Password không được bỏ trống";
        } else {
            if(strlen($_POST['password']) < 6) {
                $errors['password'] = "Mật này phải bằng hoặc lớn hơn 6 kí tự";
            }
        }
        // var_dump($_POST);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Thêm dữ liệu người dùng mới vào mảng $_SESSION['ds_users']
        if (empty($errors)) {
            $new_user = array(
                'Username' => $_POST['username'],
                'Email' => $_POST['email'],
                'Password' => $_POST['password'],
                'Role' => $_POST['role']
            );
    
            // Kiểm tra 'ds_users' đã được khởi tạo chưa
            if (!isset($_SESSION['ds_users'])) {
                $_SESSION['ds_users'] = array();
            }
    
            // Thêm người dùng mới vào mảng 'ds_users'
            $_SESSION['ds_users'][] = $new_user;
            header("Location: user.php");
            exit();
        }
    }
    var_dump($errors);



    ?>
    <div class="container">
        <h2>Đăng ký</h2>
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="username" name="username" class="form-control mb-3" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '';?>" placeholder="Nhập username">
            <?php
            if(isset($errors['username'])) {
                echo "<p class='errors'>$errors[username]</p>";
            }
            ?>
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control mb-3" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '';?>" placeholder="Nhập email">
            <?php
            if (isset($errors['email'])){
                echo "<p class='errors'>$errors[email]</p>";
            }
            ?>
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control mb-3" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '';?>" placeholder="Nhập password">
            <?php
            if(isset($errors['password'])) {
                echo "<p class='errors'>$errors[password]</p>";
            }
            ?>
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" name="confirmpassword" class="form-control mb-3" value="<?php echo isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '';?>" placeholder="Nhập lại password">
            <?php
            if(isset($errors['confirmpassword'])) {
                echo "<p class='errors'>$errors[confirmpassword]</p>";
            }
            ?>
            <select class="form-select mb-3" name="role">
                <option value="">Chọn quyền</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <?php
            if (isset($errors['role'])) {
                echo "<p class='error'>$errors[role]</p>";
            }
            ?>
            <input class="btn btn-block btn-info " type="submit" name=submit value="Submit" />
        </form>
    </div>
</body>
</html>