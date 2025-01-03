<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lustra";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert user info into the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO users (name, email, password, gender, country, phone) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $password, $gender, $country, $phone);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.html'>Login Here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
