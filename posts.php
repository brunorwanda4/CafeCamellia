<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Add Post</title>
</head>

<body>

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

    <?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $postName = $_POST['postName'];

    // Insert data into database
    $sql = "INSERT INTO Post (PostName) VALUES ('$postName')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


</body>

</html>
