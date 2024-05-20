<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $postName = $_POST['postName'];

    // Insert data into database
    $sql = "INSERT INTO Post (PostName) VALUES ('$postName')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit; // Ensure the script stops executing after redirect
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Add Post</title>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #f8f9fa !important;
        }

        .card {
            border: 1px solid #ffc107;
        }

        .card-title {
            color: #ffc107;
        }

        .btn-primary {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
    </style>
</head>

<body>
<?php include './includes/navbar.php'; ?>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Add Post</h5>
                                        <p class="text-center small">Enter post name</p>
                                    </div>

                                    <?php
                                    if (isset($error)) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                    }
                                    ?>

                                    <form class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>

                                        <div class="col-12">
                                            <label for="postName" class="form-label">Post Name</label>
                                            <input type="text" name="postName" class="form-control" id="postName" required>
                                            <div class="invalid-feedback">Please enter post name.</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Add Post</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
</body>

</html>
