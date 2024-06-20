<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["admin"] == 1) {
    header("location: login.php");
    exit();
}

include "config.php";

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pay'])) {
    // Validate and sanitize the total_amount if needed
    $total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : null;

    if ($total_amount === null || !is_numeric($total_amount) || $total_amount <= 0) {
        echo "Invalid total amount.";
        exit();
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Insert the payment record
        $stmt = $conn->prepare("INSERT INTO payments (user_id, amount) VALUES (?, ?)");
        $stmt->bind_param("id", $user_id, $total_amount);
        if (!$stmt->execute()) {
            throw new Exception("Error processing payment: " . $stmt->error);
        }
        $stmt->close();

        // Delete the water usage records
        $stmt = $conn->prepare("DELETE FROM water_usage WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        if (!$stmt->execute()) {
            throw new Exception("Error deleting water usage: " . $stmt->error);
        }
        $stmt->close();

        // Commit the transaction
        $conn->commit();

        // Set success message
        $payment_success = true;

    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo $e->getMessage();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thanh Toán</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // JavaScript to display payment success message
        window.addEventListener('DOMContentLoaded', (event) => {
            <?php if (isset($payment_success) && $payment_success): ?>
                document.getElementById('payment-success').style.display = 'block';
            <?php endif; ?>
        });
    </script>
</head>
<body>
    <header>
        <h1>Trang Thanh Toán</h1>
        <nav>
            <ul>
                <li><a href="logout.php">Đăng Xuất</a></li>
            </ul>
        </nav>
    </header>

    <section id="payment">
        <h2>Thanh Toán</h2>
        <?php if (isset($payment_success) && $payment_success): ?>
            <div id="payment-success">
                <p class="success">Thanh toán thành công!</p>
            </div>
        <?php else: ?>
            <div id="payment-error">
                <p class="error">Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại sau.</p>
            </div>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2024 Công Ty Cung Cấp Nước</p>
    </footer>
</body>
</html>
