<?php
require_once 'config/db.php';

if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Delete all candidates related to this post
    $sql = "DELETE FROM CandidatesResult WHERE PostId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    if ($stmt->execute() !== TRUE) {
        echo "Error deleting related candidates: " . $conn->error;
        exit;
    }

    // Now delete the post
    $sql = "DELETE FROM Post WHERE PostId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    if ($stmt->execute() === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error deleting post: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
