<?php
session_start();
require("config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Index</title>
    <!-- Link CSS của Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <span class="navbar-brand" >SẢN PHẨM</span>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <?php
                $userRole = 'user';
                if (isset($connection)) {
                    $query = "SELECT role FROM user WHERE username = :username";
                    $statement = $connection->prepare($query);
                    $statement->execute([
                         'username' => $_SESSION['username']
                    ]);
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    if ($result) {
                        $userRole = $result['role'];
                    }
                }
                
                if ($userRole === 'admin') {
                    echo "<li><a href='./product/admin.php'>Admin</a></li>";
                }  
                ?>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 style="text-align: center; margin-bottom: 20px;" class="mt-5"><b>SẢN PHẨM</b></h2>
        <div class="row">
            <?php
            if (isset($connection)) {
                try {
                    $query = "SELECT * FROM product";
                    $statement = $connection->prepare($query);
                    $statement->execute();
                    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($products as $product) {
                    ?>
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img src="<?php echo $product['picture'] ?>" alt="Product Image">
                                <div class="caption">
                                    <h3 style="text-align: center; font-weight: bold;"><?php echo $product['name'] ?></h3>
                                    <p style="text-align: center;"><?php echo $product['description'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } catch (\Exception $th) {
                    echo "Lỗi: " . $e->getMessage();
                }
            }
            ?>
        </div>
    </div>
    <!-- Link JS của Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
