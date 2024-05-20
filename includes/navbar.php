<header class="header">
    <h1>
        <i class="bi bi-cup-fill"></i>
        Camellia
    </h1>
    <nav>
        <a href="index.php" class="btn btn-warning">Home</a>
        <a href="posts.php" class="btn btn-primary">Add</a>
        <a href="candidatesTable.php" class="btn btn-primary">candidates</a>
        <a href="posts.php" class="btn btn-primary">Posts</a>
        <?php if (isset($_SESSION['username'])) : ?>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        <?php endif; ?>
    </nav>
</header>
