<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: login.php");
    exit();
}

if ($_SESSION["admin"] == 1) {
    header("location: admin.php");
    exit();
} else {
    header("location: user.php");
    exit();
}
?>
