<?php
session_start();
if (!isset($_SESSION["user"]) || !isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
    header("location: login.php");
    exit();
}

include "config.php";

$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Người Dùng</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Danh Sách Người Dùng</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Trang Chủ</a></li>
                <li><a href="logout.php">Đăng Xuất</a></li>
            </ul>
        </nav>
    </header>

    <section id="user-list">
        <h2>Danh Sách Người Dùng</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Đăng Nhập</th>
                    <th>Cấp Độ</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["level"] . "</td>";
                        echo "<td>" . ($row["admin"] == 1 ? "Yes" : "No") . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Không có người dùng nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2024 Công Ty Cung Cấp Nước</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
