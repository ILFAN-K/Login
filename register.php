<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database credentials
$servername = "localhost";
$username = "root";    // Change to your DB username
$password = "Ilfan@2006";        // Change to your DB password
$dbname = "login"; // Change to your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user = $_POST['un'];
    $email = $_POST['mail'];
    $passw = $_POST['pass2'];

    // Hash the password for security
    $hashed_password = password_hash($passw, PASSWORD_DEFAULT);

    // Prepare SQL query to insert the data into the database
    $sql = "INSERT INTO users (uname, email, pasw) VALUES (?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user, $email, $hashed_password);

    // Execute query
    if ($stmt->execute()) {
        header("Location: ../login/login.html");
        exit();  // Make sure to stop script execution after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
