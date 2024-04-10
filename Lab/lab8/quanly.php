<?php
require('connect.php');






?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/751e818311.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
  <h2>Quản lý blog</h2>
  <p>Bảng thống kê bài đăng</p>     
  <div class="seach">
    <input type="text" placeholder="Tìm kiếm">
    <button>tìm kiếm</button>   
  </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Picture</th>
        <th>Message</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
     <?php
     try {
          if (isset($connection)) {
              $query = "SELECT * FROM posts";
              $statement = $connection->prepare($query);
              $statement->execute();
              $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
              
              foreach ($blogs as $blog) {
                  ?>
                  <tr>
                    <td><?php echo $blog['id'] ?></td>
                    <td><?php echo $blog['name'] ?></td>
                    <td><?php echo $blog['picture'] ?></td>
                    <td><?php echo $blog['message'] ?></td>
                    <td>
                        <a href="crud-delete.php?id=<?php echo $blog['id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        <a href="crud-edit.php?id=<?php echo $blog['id']; ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="viewblog.php?id=<?php echo $blog['id']; ?>" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
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