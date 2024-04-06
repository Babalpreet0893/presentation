<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $gender = $_POST['gender'];
    $message = $_POST['message'];
}
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Presentation";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape user inputs for security
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$number = mysqli_real_escape_string($conn, $_POST['number']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Hash the password
$password = password_hash($raw_password, PASSWORD_DEFAULT);

// Prepare and bind statement
$stmt = $conn->prepare("INSERT INTO users (name, email, password, number, gender, message) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $password, $number, $gender, $message);

// Execute the statement
if ($stmt->execute()) {
    // Redirect back to index.html after successful submission
    header("Location: index.html");
    exit(); // Ensure that script execution stops after redirection
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
