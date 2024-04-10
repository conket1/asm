<?php
require("config.php");
session_start();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_POST['username']) && empty($_POST['username'])) {
          $errors['username'] = "Username is required";
     }
     if (isset($_POST['password']) && empty($_POST['password'])) {
          $errors['password'] = "Password is required";
     }
}

if (isset($connection) && count($errors) == 0) {
     try {
          if (isset($_POST['username'])) { // Kiểm tra xem $_POST['username'] có tồn tại không
               $query = "SELECT * FROM user where username = :username";
               $statement = $connection->prepare($query);
               $statement->execute([
                    "username" => $_POST['username']
               ]);
               $statement->setFetchMode(PDO::FETCH_ASSOC);
               if ($statement->rowCount() > 0) {
                    $result = $statement->fetchAll();
                    $storeHashPassword = $result[0]['password'];
                    if (password_verify($_POST['password'], $storeHashPassword)) {
                         $_SESSION['username'] = $_POST['username'];
                         header("Location: index.php");
                         exit();
                    } else {
                         $errors['password'] = "Username or password incorrect";
                    }
               }
          }
     } catch (\Exception $e) {
          echo $errors = $e->getMessage();
     }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form</title>
     <!-- Bootstrap CSS -->
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <style>
          body {
               background-color: #f4f4f4;
          }

          .login-form {
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
                    <div class="login-form">
                         <h2 class="text-center mb-4">Login</h2>
                         <form action="login.php" method="post">
                              <div class="form-group">
                                   <label for="username">Username</label>
                                   <input type="text" class="form-control" id="username" name="username">
                                   <?php
                                   if (isset($errors['username'])) {
                                        echo "<span style='color:red; font-size:15px;'>" . $errors['username'] . "</span>";
                                   }
                                   ?>
                              </div>
                              <div class="form-group">
                                   <label for="password">Password</label>
                                   <input type="password" class="form-control" id="password" name="password">
                                   <?php
                                   if (isset($errors['password'])) {
                                        echo "<span style='color:red; font-size:15px;'>" . $errors['password'] . "</span>";
                                   }
                                   ?>
                              </div>
                              <button type="submit" class="btn btn-primary btn-block">Login</button>
                              <div class="mt-3 text-center">
                                   <p>Don't have an account? <a href="register.php">Register</a></p>
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