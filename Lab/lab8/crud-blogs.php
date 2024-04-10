<?php
require("connect.php");
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && empty($_POST['name'])) {
        $errors['name'] = "Name is required";
    }
    if (isset($_POST['picture']) && empty($_POST['picture'])) {
        $errors['picture'] = "Picture is required";
    }
    if (isset($_POST['message']) && empty($_POST['message'])) {
        $errors['message'] = "Message is required";
    }
    # dùng bằng session
    // if (count($errors) == 0) {
    //     if (isset($_SESSION['blog'])) {
    //         $blog = $_SESSION['blog'];
    //         array_push($blog, array(
    //             "id" => rand(10, 100),
    //             "name" => $_POST['name'],
    //             "picture" => $_POST['picture'],
    //             "message" => $_POST['message']
    //         ));
    //         $_SESSION['blog'] = $blog;
    //     }
    // } else {
    //     // thêm vào session
    //     $blog = [];
    //     array_push($blog, array(
    //         "id" => rand(10, 100),
    //         "name" => $_POST['name'],
    //         "picture" => $_POST['picture'],
    //         "message" => $_POST['message']
    //     ));
    //     $_SESSION['blog'] = $blog;
    // }

    //      # dùng bằng database
         try {
              if (isset($connection) && count($errors) == 0) {
                   $query = "INSERT INTO posts (id,name,picture,message) values (:id,:name,:picture,:message)";
                   $statement = $connection->prepare($query);
                   $statement->execute([
                        "id" => rand(10,100),
                        "name" => $_POST['name'],
                        "picture" => $_POST['picture'],
                        "message" => $_POST['message']
                   ]);
              }
         } catch (\Exception $th) {
              echo $errors = $th->getMessage();
         }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Clean Blog - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="post.php">Sample Post</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="crud-blogs.php">Manage Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Contact Me</h1>
                        <span class="subheading">Have questions? I have answers.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="my-5">
                        <form id="contactForm" action="crud-blogs.php" method="post">
                            <div class="form-floating">
                                <input name="name" class="form-control" id="name" type="text" placeholder="Enter your name..." />
                                <label for="name">Name</label>
                                <?php
                                if (isset($errors['name'])) {
                                    echo "<span style='color:red; font-size:15px;'>" . $errors['name'] . "</span>";
                                }
                                ?>
                            </div>
                            <div class="form-floating">
                                <input name="picture" class="form-control" id="name" type="text" placeholder="Enter your name..." />
                                <label for="name">Picture</label>
                                <?php
                                if (isset($errors['picture'])) {
                                    echo "<span style='color:red; font-size:15px;'>" . $errors['picture'] . "</span>";
                                }
                                ?>
                            </div>
                            <div class="form-floating">
                                <textarea name="message" class="form-control" id="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <?php
                                if (isset($errors['message'])) {
                                    echo "<span style='color:red; font-size:15px;'>" . $errors['message'] . "</span>";
                                }
                                ?>
                            </div>
                            <br />
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage">
                                <div class="text-center text-danger mb-3">Error sending message!</div>
                            </div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Add</button>
                            <a href="quanly.php" class="btn btn-primary text-uppercase">Edit</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer-->
    <footer class="border-top">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>