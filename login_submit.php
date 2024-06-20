<?php
session_start();
include "config.php";

if (isset($_POST["submit"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password, admin FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user"] = $username;
            $_SESSION["user_id"] = $row['id'];
            $_SESSION["admin"] = $row['admin'];
            
            if ($row['admin'] == 1) {
                header("location: admin.php");
            } else {
                header("location: user.php");
            }
        } else {
            $_SESSION["login_error"] = "Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại.";
            header("location: login.php");
        }
    } else {
        $_SESSION["login_error"] = "Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại.";
        header("location: login.php");
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION["login_error"] = "Vui lòng điền đầy đủ thông tin.";
    header("location: login.php");
}
?>
