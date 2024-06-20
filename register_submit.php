<?php
include "config.php";

if (isset($_POST["submit"]) && !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["repassword"])) {
    // Validate inputs
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    
    // Check if passwords match
    if ($password != $repassword) {
        header("location:register.php?error=Passwords do not match");
        exit();
    }

    // Check for existing username
    $sql = "SELECT * FROM user WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("location:register.php?error=Username already exists");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $sql = "INSERT INTO user (username, password, level) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $level = 0;
    $stmt->bind_param("ssi", $username, $hashed_password, $level);

    if ($stmt->execute()) {
        header("location:login.php?success=Registration successful");
    } else {
        header("location:register.php?error=Registration failed");
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("location:register.php?error=Please fill in all fields");
}
?>
