<?php
require("config.php");
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
     if (empty($_POST['username'])) {
          $errors['username'] = "Username is required";
     }

     if (empty($_POST['email'])) {
          $errors['email'] = "Email is required";
     }

     if (empty($_POST['password'])) {
          $errors['password'] = "Password is required";
     } elseif (strlen($_POST['password']) < 6) {
          $errors['password'] = "Password must be at least 6 characters";
     }

     if ($_POST['password'] != $_POST['confirmpassword']) {
          $errors['confirmpassword'] = "Passwords do not match";
     }

     if (isset($connection)) {
          // Kiểm tra trùng user
          $querycheckuser = "SELECT * FROM user WHERE username = :username or email = :email";
          $statementcheck = $connection->prepare($querycheckuser);
          $statementcheck->execute([
               "username" => $_POST['username'],
               "email" => $_POST['email']
          ]);
          if ($statementcheck->rowCount() > 0) {
               $errors['username'] = "Username or Email already exists";
          } else {
               // Thêm user vào database
               $query = "INSERT INTO user (username, email, password, role) VALUES (:username, :email, :password, :role)";
               $statement = $connection->prepare($query);
               $isCreate = $statement->execute([
                    "username" => $_POST['username'],
                    "email" => $_POST['email'],
                    "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    "role" => "user"
               ]);
               if ($isCreate) {
                    // Thông báo
                    header("Location: login.php");
                    exit(); 
               }
          }
     }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Registration Form</title>
     <!-- Bootstrap CSS -->
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <style>
          body {
               background-color: #f4f4f4;
          }

          .registration-form {
               max-width: 400px;
               margin: 0 auto;
               padding: 30px;
               background-color: #ffffff;
               border-radius: 5px;
               box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               margin-top: 100px;
          }
     </style>
</head>

<body>
     <div class="container">
          <div class="row">
               <div class="col-md-6 offset-md-3">
                    <div class="registration-form">
                         <h2 class="text-center mb-4">Register</h2>
                         <form action="register.php" method="post">
                              <div class="form-group">
                                   <label for="username">Username</label>
                                   <input type="text" class="form-control" id="username" name="username">
                                   <?php if (isset($errors['username'])) : ?>
                                        <span style='color:red; font-size:15px;'><?= $errors['username'] ?></span>
                                   <?php endif; ?>
                              </div>
                              <div class="form-group">
                                   <label for="email">Email</label>
                                   <input type="email" class="form-control" id="email" name="email">
                                   <?php if (isset($errors['email'])) : ?>
                                        <span style='color:red; font-size:15px;'><?= $errors['email'] ?></span>
                                   <?php endif; ?>
                              </div>
                              <div class="form-group">
                                   <label for="password">Password</label>
                                   <input type="password" class="form-control" id="password" name="password">
                                   <?php if (isset($errors['password'])) : ?>
                                        <span style='color:red; font-size:15px;'><?= $errors['password'] ?></span>
                                   <?php endif; ?>
                              </div>
                              <div class="form-group">
                                   <label for="confirm_password">Confirm Password</label>
                                   <input type="password" class="form-control" id="confirm_password" name="confirmpassword">
                                   <?php if (isset($errors['confirmpassword'])) : ?>
                                        <span style='color:red; font-size:15px;'><?= $errors['confirmpassword'] ?></span>
                                   <?php endif; ?>
                              </div>
                              <button type="submit" class="btn btn-primary btn-block">Register</button>
                              <div class="mt-3 text-center">
                                   <a href="login.php">Login Here</a><br>
                                   <a href="forgot-password.php">Forgot Password?</a>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
     <!-- Bootstrap JS (optional) -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>