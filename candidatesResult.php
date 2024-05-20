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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $nationalId = $_POST['nationalId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $postId = $_POST['postId'];
    $examDate = $_POST['examDate'];
    $phoneNumber = $_POST['phoneNumber'];
    $marks = $_POST['marks'];

    // Insert data into database
    $sql = "INSERT INTO CandidatesResult (CandidateNationalId, FirstName, LastName, Gender, DateOfBirth, PostId, ExamDate, PhoneNumber, Marks) 
            VALUES ('$nationalId', '$firstName', '$lastName', '$gender', '$dob', $postId, '$examDate', '$phoneNumber', $marks)";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Add Candidate</title>
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

                                        <div class="col-6">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select" name="gender" id="gender" required>
                                                <option value="" selected disabled>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <div class="invalid-feedback">Please select candidate's gender.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" name="dob" class="form-control" id="dob" required>
                                            <div class="invalid-feedback">Please enter candidate's date of birth.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="postId" class="form-label">Post</label>
                                            <select class="form-select" name="postId" id="postId" required>
                                                <option value="" selected disabled>Select Post</option>
                                                <?php foreach ($posts as $post) : ?>
                                                    <option value="<?php echo $post['PostId']; ?>"><?php echo $post['PostName']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">Please select candidate's post.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="examDate" class="form-label">Exam Date</label>
                                            <input type="date" name="examDate" class="form-control" id="examDate" required>
                                            <div class="invalid-feedback">Please enter exam date.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="phoneNumber" class="form-label">Phone Number</label>
                                            <input type="text" name="phoneNumber" class="form-control" id="phoneNumber">
                                            <div class="invalid-feedback">Please enter candidate's phone number.</div>
                                        </div>

                                        <div class="col-6">
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
    </main>
</body>

</html>
