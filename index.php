<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';

// Retrieve all candidates' results
$sql = "
    SELECT CandidatesResult.*, Post.PostName 
    FROM CandidatesResult 
    LEFT JOIN Post ON CandidatesResult.PostId = Post.PostId
";
$result = $conn->query($sql);
$candidates = [];
$post ='';
if ($result !== false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Candidates Results</title>

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
        .table{
            width: 96%;
        }
        .action{
            display: flex;
            gap: 24px;
        }
    </style>
</head>

<body>
<?php include './includes/navbar.php'; ?>
    <main>
        <div class="">

        <section class="min-vh-100 d-flex flex-column align-items-center  mt-4" style="width: 100%;">
                <div class="">
                    <div class=" justify-content-between my_button">
                            <a href="candidatesResult.php" class="btn btn-primary mb-4">Add Candidates Results</a>
                            <div class=""></div>
                    </div>
                        </div>
                        <div class=" d-flex flex-column align-items-center justify-content-center" style="width: 100%;">
                            <div class="card mb-3">
                                <div class="card-body" style="width: 100%;">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Candidates Table</h5>
                                        <p class="text-center small">Here are all the candidates' results:</p>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>National ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Gender</th>
                                                <th>Date of Birth</th>
                                                <th>Post</th>
                                                <th>Exam Date</th>
                                                <th>Phone Number</th>
                                                <th>Marks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($candidates as $candidate) : ?>
                                                <tr>
                                                    <td><?php echo $candidate['CandidateNationalId']; ?></td>
                                                    <td><?php echo $candidate['FirstName']; ?></td>
                                                    <td><?php echo $candidate['LastName']; ?></td>
                                                    <td><?php echo $candidate['Gender']; ?></td>
                                                    <td><?php echo $candidate['DateOfBirth']; ?></td>
                                                    <td><?php echo htmlspecialchars($candidate['PostName']); ?></td>
                                                    <td><?php echo $candidate['ExamDate']; ?></td>
                                                    <td><?php echo $candidate['PhoneNumber']; ?></td>
                                                    <td><?php echo $candidate['Marks']; ?></td>
                                                    <td class="action">
                                                        <a href="update_candidate.php?id=<?php echo $candidate['CandidateNationalId']; ?>" class="btn btn-primary">Update</a>
                                                        <a href="delete_candidate.php?id=<?php echo $candidate['CandidateNationalId']; ?>" class="btn btn-danger">Delete</a>
                                                    </td>
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
    </main><!-- End #main -->

</body>

</html>
