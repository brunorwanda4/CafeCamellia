<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['postId'];
    $postName = $_POST['postName'];

    $sql = "UPDATE Post SET PostName='$postName' WHERE PostId=$postId";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error updating post: " . $conn->error;
    }

    $conn->close();
} else {
    $postId = $_GET['id'];
    $sql = "SELECT * FROM Post WHERE PostId=$postId";
    $result = $conn->query($sql);
    if ($result !== false && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "Post not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Edit Post</title>

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
                                        <h5 class="card-title text-center pb-0 fs-4">Edit Post</h5>
                                    </div>
                                    <form class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                                        <input type="hidden" name="postId" value="<?php echo $postId; ?>">
                                        <div class="col-12">
                                            <label for="postName" class="form-label">Post Name</label>
                                            <input type="text" name="postName" class="form-control" id="postName" value="<?php echo $post['PostName']; ?>" required>
                                            <div class="invalid-feedback">Please enter post name.</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Save Changes</button>
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
