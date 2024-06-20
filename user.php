<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["admin"] == 1) {
    header("location: login.php");
    exit();
}

include "config.php";

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM water_usage WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

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
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['usewater']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <section id="payment">
        <h2>Thanh Toán</h2>
        <form action="user_page.php" method="post">
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
