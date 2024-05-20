<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';

// Retrieve all candidates' results
$sql = "SELECT * FROM CandidatesResult ORDER BY Marks DESC";
$result = $conn->query($sql);
$candidatesResults = [];
if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidatesResults[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Report</title>
</head>
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
<body>
    <?php include './includes/navbar.php'; ?>
    <main>
        <div class="container">
            <section class="section register min-vh-180 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8  col-md-10" style="width: 95%;">
                            <div class="card mb-3 ">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Candidates Results Report</h5>
                                        <p class="text-center small">Here are the results of all candidates:</p>
                                    </div>
                                    <table class="table mt_table">
                                        <thead>
                                            <tr>
                                                <th scope="col">National ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Date of Birth</th>
                                                <th scope="col">Post</th>
                                                <th scope="col">Exam Date</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($candidatesResults as $result) : ?>
                                                <tr>
                                                    <td><?php echo $result['CandidateNationalId']; ?></td>
                                                    <td><?php echo $result['FirstName'] . ' ' . $result['LastName']; ?></td>
                                                    <td><?php echo $result['Gender']; ?></td>
                                                    <td><?php echo $result['DateOfBirth']; ?></td>
                                                    <td><?php echo $result['PostId']; ?></td>
                                                    <td><?php echo $result['ExamDate']; ?></td>
                                                    <td><?php echo $result['PhoneNumber']; ?></td>
                                                    <td><?php echo $result['Marks']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
