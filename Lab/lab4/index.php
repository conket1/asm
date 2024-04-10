<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
</head>
<body>
    <?php
    $errors = [];
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username'])){
            if(empty($_POST['username'])) {
                $errors['username'] = "username is required";
            }
        }
        if(isset($_POST['password'])){
            if(empty($_POST['password'])) {
                $errors['password'] = "password is required";
            }
        }
        
        if(count($errors) == 0) {
            var_dump($_POST);
            if($_POST['username'] == 'admin' && $_POST['password'] == '123456') {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION["isAuth"] = true;
                header("Location: user.php");
            }
        }
    }
    
    ?>
    <div class="container">
        <h2>Login</h2>
        <form action="index.php" method="post">
            <label for="email">Email</label>
            <input type="username" name="username" class="form-control mb-3" placeholder="Nhập username">
            <?php
            if(isset($errors['username'])) {
                echo "<p class='errors'>$errors[username]</p>";
            }
            ?>
            <label for="password">Password</label>
            <input type="pasword" name="password" class="form-control mb-3" placeholder="Nhập password" >
            <?php
            if(isset($errors['password'])) {
                echo "<p class='errors'>$errors[password]</p>";
            }
            
            
            ?>
            <input class="btn btn-block btn-info " type="submit" name=submit value="Login" />
        </form>

    </div>
</body>
</html>