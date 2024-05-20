<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';

// Retrieve candidates' results
$sql = "SELECT * FROM CandidatesResult";
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
    <title>Candidates Results</title>
</head>

<body>
<?php include './includes/navbar.php'; ?>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div>
                                <a href="candidatesResult.php" class="btn btn-primary mb-4">Add Candidates Results</a>
                            </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-center pb-0 fs-4">Candidates Results</h5>

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Candidate ID</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Date of Birth</th>
                                                <th scope="col">Post ID</th>
                                                <th scope="col">Exam Date</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($candidatesResults as $candidateResult) : ?>
                                                <tr>
                                                    <td><?php echo $candidateResult['CandidateNationalId']; ?></td>
                                                    <td><?php echo $candidateResult['FirstName']; ?></td>
                                                    <td><?php echo $candidateResult['LastName']; ?></td>
                                                    <td><?php echo $candidateResult['Gender']; ?></td>
                                                    <td><?php echo $candidateResult['DateOfBirth']; ?></td>
                                                    <td><?php echo $candidateResult['PostId']; ?></td>
                                                    <td><?php echo $candidateResult['ExamDate']; ?></td>
                                                    <td><?php echo $candidateResult['PhoneNumber']; ?></td>
                                                    <td><?php echo $candidateResult['Marks']; ?></td>
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
