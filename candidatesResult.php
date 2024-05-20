<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Candidates Result Form</title>
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
                                        <h5 class="card-title text-center pb-0 fs-4">Add Candidate Result</h5>
                                        <p class="text-center small">Enter candidate's information and marks</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>

                                        <div class="col-12">
                                            <label for="nationalId" class="form-label">National ID</label>
                                            <input type="text" name="nationalId" class="form-control" id="nationalId" required>
                                            <div class="invalid-feedback">Please enter candidate's national ID.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" name="firstName" class="form-control" id="firstName" required>
                                            <div class="invalid-feedback">Please enter candidate's first name.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" name="lastName" class="form-control" id="lastName" required>
                                            <div class="invalid-feedback">Please enter candidate's last name.</div>
                                        </div>

                                        <!-- Add other fields as needed -->

                                        <div class="col-12">
                                            <label for="marks" class="form-label">Marks</label>
                                            <input type="number" name="marks" class="form-control" id="marks" required>
                                            <div class="invalid-feedback">Please enter candidate's marks.</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Add Candidate Result</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main --><?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $nationalId = $_POST['nationalId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    // Add other fields as needed

    $marks = $_POST['marks'];

    // Insert data into database
    $sql = "INSERT INTO CandidatesResult (CandidateNationalId, FirstName, LastName, Marks) 
            VALUES ('$nationalId', '$firstName', '$lastName', $marks)";

    if ($conn->query($sql) === TRUE) {
        header('Location: candidatesTable.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

</body>

</html>
