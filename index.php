<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';

// Retrieve all posts
$sql = "SELECT * FROM Post";
$result = $conn->query($sql);
$posts = [];
if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384- +...">
    <!-- Custom styles for this template -->
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
                        <div class="col-lg-8 col-md-10">
                        <div class="justify-content-center">
                    <div>
                                <a href="posts.php" class="btn btn-primary mb-4">Add post</a>
                            </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Welcome, <?php echo $_SESSION['username']; ?></h5>
                                        <p class="text-center small">Here are all the posts:</p>
                                    </div>
                                    <ul class="list-group">
                                        <?php foreach ($posts as $post) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?php echo $post['PostName']; ?>
                                                <div>
                                                    <a href="edit_post.php?id=<?php echo $post['PostId']; ?>" class="btn btn-primary me-2">Edit</a>
                                                    <a href="delete_post.php?id=<?php echo $post['PostId']; ?>" class="btn btn-danger">Delete</a>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
