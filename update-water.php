<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["admin"] != 1) {
    header("location: login.php");
    exit();
}

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["water_usage"])) {
    $user_id = $_POST['user_id'];
    $water_usage = $_POST['water_usage'];

    // Check if the water usage is a valid number
    if (!is_numeric($water_usage) || $water_usage <= 0) {
        die("Invalid water usage value.");
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO water_usage (user_id, usewater) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("id", $user_id, $water_usage); // Use correct bind_param type
        if ($stmt->execute()) {
            echo "Water usage updated successfully.";
        } else {
            echo "Error updating water usage: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
