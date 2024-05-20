<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'config/db.php';

// Fetch candidate data
if (isset($_GET['id'])) {
    $nationalId = $_GET['id'];
    $sql = "SELECT * FROM CandidatesResult WHERE CandidateNationalId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nationalId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $candidate = $result->fetch_assoc();
    } else {
        echo "No candidate found with ID: $nationalId";
        exit;
    }

    // Fetch all posts
    $sql = "SELECT * FROM Post";
    $result = $conn->query($sql);
    $posts = [];
    if ($result !== false && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nationalId = $_POST['nationalId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $postId = $_POST['postId'];
    $examDate = $_POST['examDate'];
    $phoneNumber = $_POST['phoneNumber'];
    $marks = $_POST['marks'];

    $sql = "UPDATE CandidatesResult 
            SET FirstName=?, LastName=?, Gender=?, DateOfBirth=?, 
                PostId=?, ExamDate=?, PhoneNumber=?, Marks=?
            WHERE CandidateNationalId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissis", $firstName, $lastName, $gender, $dob, $postId, $examDate, $phoneNumber, $marks, $nationalId);

    if ($stmt->execute() === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php'; ?>
    <title>Edit Candidate</title>

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
                        <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Edit Candidate Result</h5>
                                        <p class="text-center small">Update candidate's information and marks</p>
                                    </div>
                                    <form class="row g-3 needs-validation" action="update_candidate.php" method="post" novalidate>

                                        <input type="hidden" name="nationalId" value="<?php echo htmlspecialchars($candidate['CandidateNationalId']); ?>">

                                        <div class="col-12">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo htmlspecialchars($candidate['FirstName']); ?>" required>
                                            <div class="invalid-feedback">Please enter candidate's first name.</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo htmlspecialchars($candidate['LastName']); ?>" required>
                                            <div class="invalid-feedback">Please enter candidate's last name.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select" name="gender" id="gender" required>
                                                <option value="Male" <?php echo ($candidate['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                <option value="Female" <?php echo ($candidate['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                            <div class="invalid-feedback">Please select candidate's gender.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" name="dob" class="form-control" id="dob" value="<?php echo htmlspecialchars($candidate['DateOfBirth']); ?>" required>
                                            <div class="invalid-feedback">Please enter candidate's date of birth.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="postId" class="form-label">Post</label>
                                            <select class="form-select" name="postId" id="postId" required>
                                                <?php foreach ($posts as $post) : ?>
                                                    <option value="<?php echo htmlspecialchars($post['PostId']); ?>" <?php echo ($post['PostId'] == $candidate['PostId']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($post['PostName']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">Please select candidate's post.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="examDate" class="form-label">Exam Date</label>
                                            <input type="date" name="examDate" class="form-control" id="examDate" value="<?php echo htmlspecialchars($candidate['ExamDate']); ?>" required>
                                            <div class="invalid-feedback">Please enter exam date.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="phoneNumber" class="form-label">Phone Number</label>
                                            <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" value="<?php echo htmlspecialchars($candidate['PhoneNumber']); ?>">
                                            <div class="invalid-feedback">Please enter candidate's phone number.</div>
                                        </div>

                                        <div class="col-6">
                                            <label for="marks" class="form-label">Marks</label>
                                            <input type="number" name="marks" class="form-control" id="marks" value="<?php echo htmlspecialchars($candidate['Marks']); ?>" required>
                                            <div class="invalid-feedback">Please enter candidate's marks.</div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Update Candidate Result</button>
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
