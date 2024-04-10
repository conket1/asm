<?php
require("../config.php");
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_POST['name']) && empty($_POST['name'])) {
          $errors['name'] = "Name is required";
     }

     if (isset($_POST['picture']) && empty($_POST['picture'])) {
          $errors['picture'] = "Picture is required";
     }

     if (isset($_POST['description']) && empty($_POST['description'])) {
          $errors['description'] = "Description is required";
     }


     if (isset($connection)) {
          try {
               $query = "INSERT INTO product (name,picture,description) VALUES (:name, :picture, :description)";
               $statement = $connection->prepare($query);
               $createProduct = $statement->execute([
                    "name" => $_POST['name'],
                    "picture" => $_POST['picture'],
                    "description" => $_POST['description']
               ]);
               if ($createProduct) {
                    header("Location: admin.php");
                    exit();
               }
          } catch (\Exception $th) {
               echo "Lỗi: " . $th->getMessage();
          }
     }


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Add New Product</title>
     <!-- Link CSS của Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
     <div class="container">
          <h2 class="mt-5">Add New Product</h2>
          <form action="addproduct.php" method="POST">
               <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <?php
                    if (isset($errors['name'])) {
                         echo "<span style='color:red;'> Error: " .$errors['name'] . "</span>";
                    }
                    ?>
               </div>
               <div class="mb-3">
                    <label for="link" class="form-label">Link Picture:</label>
                    <input type="text" class="form-control" id="picture" name="picture" >
                    <?php
                    if (isset($errors['picture'])) {
                         echo "<span style='color:red;'> Error: " .$errors['picture'] . "</span>";
                    }
                    ?>
               </div>
               <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" ></textarea>
                    <?php
                    if (isset($errors['description'])) {
                         echo "<span style='color:red;'> Error: " .$errors['description'] . "</span>";
                    }
                    ?>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
          </form>
     </div>
     <!-- Link JS của Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-vy3yf3II5zF2w9k5OftP3ZAHPAc/JggG0+wwzhi5LeZCJ+e/Jm4FV85f90XZh4V9" crossorigin="anonymous"></script>
</body>

</html>