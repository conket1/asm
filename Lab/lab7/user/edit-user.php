<?php
session_start();
require("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
     try {
          if (isset($connection)) {
               $id = $_GET['id'];
               $query = "SELECT * FROM user WHERE id = :id";
               $statement = $connection->prepare($query);
               $success = $statement->execute([
                    ':id' => $id
               ]);
               $users = $statement->fetch(PDO::FETCH_ASSOC);

               if (!$users) {
                    throw new Exception("Không tìm thấy người dùng.");
               }
?>
               <!DOCTYPE html>
               <html lang="en">

               <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Edit user</title>
                    <!-- Bootstrap CSS -->
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
               </head>

               <body>
                    <div class="container">
                         <h2>Edit User</h2>
                         <form action="update-user.php" method="POST">
                              <input type="hidden" name="id" value="<?php echo $users['id']; ?>">
                              <div class="form-group">
                                   <label for="name">Username:</label>
                                   <input type="text" class="form-control" id="name" name="username" placeholder="Điền tên mới" >
                              </div>
                              <div class="form-group">
                                   <label for="picture">Email:</label>
                                   <input type="text" class="form-control" id="picture" name="email" placeholder="Điền email mới" >
                              </div>
                              <div class="form-group">
                                   <label for="password">Password:</label>
                                   <input type="password" class="form-control" id="password" name="password" placeholder="Điền mật khẩu mới">
                              </div>
                              <div class="form-group">
                                   <label for="role">Role:</label>
                                   <select class="form-control" id="role" name="role">
                                        <option value="user" <?php if ($users['role'] == 'user') echo 'selected'; ?>>User</option>
                                        <option value="admin" <?php if ($users['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                   </select>
                              </div>
                              <button type="submit" class="btn btn-primary">Update</button>
                         </form>
                    </div>

                    <!-- Bootstrap JS and jQuery (Optional, for certain Bootstrap features) -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
               </body>

               </html>

<?php
          }
     } catch (\Exception $e) {
          echo "Lỗi: " . $e->getMessage();
     }
}
?>
