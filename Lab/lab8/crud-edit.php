<?php
session_start();
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    try {
        if (isset($connection)) {
            $id = $_GET['id'];
            // Lấy thông tin của bài đăng từ cơ sở dữ liệu
            $query = "SELECT * FROM posts WHERE id = :id";
            $statement = $connection->prepare($query);
            $success = $statement->execute([
                ':id' => $id
            ]);
            $blog = $statement->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra xem có bài đăng tương ứng với ID không
            if (!$blog) {
                throw new Exception("Không tìm thấy bài đăng tương ứng với ID.");
            }

?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Blog</title>
                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            </head>

            <body>
                <div class="container">
                    <h2>Edit Blog</h2>
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Điền tên mới">
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture:</label>
                            <input type="text" class="form-control" id="picture" name="picture" placeholder="Điền hình ảnh mới">
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" placeholder="Điền nội dung mới"></textarea>
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