<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>User</title>
</head>
<body>
    <?php
    
    session_start();
    $errors = [];
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username'])) {
            if (empty($_POST['username'])) {
                // them item vao mang
                $errors['username'] = "username is required";
            }
        }
        if (isset($_POST['password'])) {
            if (empty($_POST['password'])) {
                $errors['password'] = "username is required";
            }
        }
    }
    
    $ds_users = array( 
        array(
            'Username' => 'kh001',
            'Email' => 'user1@gmail.com',
            'Password' => '123456',
            "Role" => 'user',
        ),
        array(
            'Username' => 'kh002',
            'Email' => 'user2@gmail.com',
            'Password' => '123456',
            "Role" => 'user',
        ),
    );
    if (!isset($_SESSION['ds_users'])) {
        $_SESSION['ds_users'] = array(
            array(
                'Username' => 'kh001',
                'Email' => 'user1@gmail.com',
                'Password' => '123456',
                "Role" => 'user',
            ),
            array(
                'Username' => 'kh002',
                'Email' => 'user2@gmail.com',
                'Password' => '123456',
                "Role" => 'user',   
            )
        );
    }
    ?>
    <div class="container mt-3">
    <h2>List Users <span>

        <?php
        if (isset($_SESSION['username'])) {
            echo "Hello " . $_SESSION['username'];
        }

        ?>
        </span></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Delete<th>
                    <th>Edit<th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (isset($_SESSION['ds_users'])) {
                    $ds_users = $_SESSION['ds_users'];
                    foreach ($ds_users as $user) {
                        echo "<tr>";
                        echo "<td>$user[Username]</td>";
                        echo "<td>$user[Password]</td>";
                        echo "<td>$user[Role]</td>";
                        echo "<td>$user[Email]</td";
                        echo "<td>
                         <a href='delete.php?username=$user[Username]' class='delete-link'>Delete</a>
                         <a href='edit.php?username=$user[Username]' class='edit-link'>Edit</a>
                        </td";
                        echo "<tr/>";
                    }
                }

                ?>
                <tr>
                    <td>admin</td>
                    <td>123456</td>
                    <td>Admin</td>
                    <td>admin@gmail.com</td>
                </tr>
            </tbody>
        </table>
    </div>

    
</body>
</html>