<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["admin"] == 1) {
    header("location: login.php");
    exit();
}

include "config.php";

$user_id = $_SESSION['user_id'];

// Calculate total water usage
$sql = "SELECT SUM(usewater) AS total_usewater FROM water_usage WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$total_usage = $row['total_usewater'];

// Define the rate per cubic meter
$rate_per_cubic_meter = 5000; // example rate
$total_amount = $total_usage * $rate_per_cubic_meter;

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Người Dùng</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Trang Người Dùng</h1>
        <nav>
            <ul>
                <li><a href="logout.php">Đăng Xuất</a></li>
            </ul>
        </nav>
    </header>

    <section id="water-usage">
        <h2>Số Nước Đã Tiêu Thụ</h2>
        <table>
            <tr>
                <th>Số Nước (m³)</th>
                <th>Ngày</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM water_usage WHERE user_id=$user_id");
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['usewater']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <section id="payment">
        <h2>Thanh Toán</h2>
        <p>Tổng số nước tiêu thụ: <?php echo $total_usage; ?> m³</p>
        <p>Số tiền cần thanh toán: <?php echo number_format($total_amount); ?> VND</p>
        <form action="payment.php" method="post">
            <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
            <input type="hidden" name="total_usage" value="<?php echo $total_usage; ?>">
            <button type="submit" name="pay">Thanh Toán</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Công Ty Cung Cấp Nước</p>
    </footer>
</body>
</html>
<?php
$conn->close();
?>
