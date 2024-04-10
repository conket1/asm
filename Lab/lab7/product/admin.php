<?php
require("../config.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/751e818311.js" crossorigin="anonymous"></script>
</head>
<style>
  .themsp {
    margin-bottom: 20px;
  }
</style>
<body>

  <div class="container">
    <h2>Quản lý sản phẩm</h2>
    <?php
      if(isset($_SESSION['username'])) {
        echo "<p>Xin chào <b>" . $_SESSION['username'] ."</b></p>";
    }
    ?>
    <a class="btn btn-info themsp" href="addproduct.php">New Product</a>
    <a class="btn btn-warning themsp" href="../index.php">Back Home</a>
    <a class="btn btn-success themsp" href="../user/user.php">Quản lý User</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID product</th>
          <th>Name</th>
          <th>Picture</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
     try {
          if (isset($connection)) {
              $query = "SELECT * FROM product";
              $statement = $connection->prepare($query);
              $statement->execute();
              $products = $statement->fetchAll(PDO::FETCH_ASSOC);
              
              foreach ($products as $product) {
                  ?>
                  <tr>
                    <td><?php echo $product['id'] ?></td>
                    <td><?php echo $product['name'] ?></td>
                    <td><?php echo $product['picture'] ?></td>
                    <td><?php echo $product['description'] ?></td>
                    <td>
                        <a href="delete.php?id=<?php echo $product['id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        <a href="edit.php?id=<?php echo $product['id']; ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                       </td>
                    </tr>
                  <?php
              }
          }
      } catch (\Exception $e) {
          echo "Lỗi: ". $e->getMessage();
      }
     ?>
      </tbody>
    </table>
  </div>

</body>

</html>