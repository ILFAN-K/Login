<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// <!-- Step 1 : Database connection -->
$host = "localhost";
$dbname = "login";
$username = "username";
$password = "password";

// <!-- Step 2 : Creating a connection -->
$conn = new mysqli($host, $username, $password, $dbname);

// <!-- Step 3 : Checking the connection -->
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// <!-- Step 4 : Retrieving Form Data -->
$user = $_POST['uname'];
$pass = $_POST['pass'];  // This is the plain text password from the form

// <!-- Step 5 : Writing the SQL Query -->
$sql = "SELECT pasw FROM users WHERE uname = ?";

// <!-- Step 6 : Preparing the SQL Statement -->
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);

// <!-- Step 7 : Executing the Query -->
$stmt->execute();
$result = $stmt->get_result();

// <!-- Step 8 : Checking if a User Exists -->
if ($result->num_rows > 0) {
    // Fetch the hashed password from the database
    $row = $result->fetch_assoc();
    $hashed_password = $row['pasw'];

    // Verify the password using password_verify()
    if (password_verify($pass, $hashed_password)) {
        echo "Login successful!";
    } else {
        echo "Invalid password.";
    }
} else {
    echo "Invalid username or password!";
}

// <!-- Step 9 : Closing the Connection -->
$stmt->close();
$conn->close();
?>
