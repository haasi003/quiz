<?php
include 'db_connect.php'; // Include the database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (empty($username) || empty($password) || empty($email)) {
        // Handle empty fields error
        echo "Please fill in all the required fields.";
    } else {
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $password, $email); // Use the password directly

        if ($stmt->execute()) {
            // Registration successful
            header('Location: index.html'); // Redirect to the login page
            exit;
        } else {
            // Handle database insertion error
            echo "Registration failed: " . $stmt->error; // Display the error message
        }
    }
}

?>
