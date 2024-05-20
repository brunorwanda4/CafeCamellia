<?php

$DB_Server = "localhost";
$DB_Username = "root";
$DB_Password = "";
$DB="CafeCamellia";
$conn = mysqli_connect($DB_Server, $DB_Username, $DB_Password,$DB);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

// // Create database 😔

// $sql = "CREATE DATABASE IF NOT EXISTS CafeCamellia";
// if (mysqli_query($conn, $sql)) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: " . mysqli_error($conn);
// }

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Create database
// $sql = "CREATE DATABASE Users";
// if ($conn->query($sql) === TRUE) {
//     echo "Database created successfully\n";
// } else {
//     echo "Error creating database: " . $conn->error . "\n";
// }

// // Select the database
// $conn->select_db("Users");

// // SQL to create table
// $sql = "CREATE TABLE users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(255) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )";

// $sql = "CREATE TABLE Post (
//     PostId INT AUTO_INCREMENT PRIMARY KEY,
//     PostName VARCHAR(50) NOT NULL
// )";
// $sql = "CREATE TABLE CandidatesResult (
//     CandidateNationalId VARCHAR(20) PRIMARY KEY,
//     FirstName VARCHAR(50) NOT NULL,
//     LastName VARCHAR(50) NOT NULL,
//     Gender VARCHAR(10) NOT NULL,
//     DateOfBirth DATE NOT NULL,
//     PostId INT,
//     ExamDate DATE NOT NULL,
//     PhoneNumber VARCHAR(15),
//     Marks INT NOT NULL,
//     FOREIGN KEY (PostId) REFERENCES Post(PostId)
// )";




// if (mysqli_query($conn, $sql)) {
//     echo "table created successfully";
// } else {
//     echo "Error creating database: " . mysqli_error($conn);
// }

// if ($conn->query($sql) === TRUE) {
//     echo "Table users created successfully\n";
// } else {
//     echo "Error creating table: " . $conn->error . "\n";
// }

// $conn->close();
?>


