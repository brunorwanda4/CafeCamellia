<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: candidatesTable.php');
    exit;
}

require_once 'config/db.php';

$candidateId = $_GET['id'];

// Delete candidate from CandidatesResult table
$sql = "DELETE FROM CandidatesResult WHERE CandidateNationalId='$candidateId'";

if ($conn->query($sql) === TRUE) {
    header('Location: candidatesTable.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
