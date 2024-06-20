<?php
// Start session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"]) || $_SESSION["admin"] != 1) {
    header("location: login.php");
    exit();
}

include "config.php";

// Query to get users and their total water usage that hasn't been paid for
$sql = "
SELECT u.id, u.username, COALESCE(SUM(w.usewater), 0) AS total_usewater
FROM user u
LEFT JOIN water_usage w ON u.id = w.user_id
WHERE u.admin != 1
GROUP BY u.id, u.username";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header> 
        <h1>Quản Lý Người Dùng</h1>
        <nav>
            <ul>
                <li><a href="logout.php">Đăng Xuất</a></li>
            </ul>
            <button id="sendMail">thông báo </button>
            <button id="print">in dữ liệu</button>
        </nav>
        <script>
        document.getElementById('sendMail').addEventListener('click', function() {
            fetch('sendemail.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ action: 'send_email' })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    alert('Emails have been sent successfully');
                } else {
                    alert('Failed to send emails: ' + data.message);
                }
            })
            .catch(error => {
                alert('Error: ' + error.message);
                console.error('There was an error!', error);
            });
        });
        document.getElementById('print').addEventListener('click', function() {
    fetch('export.php', {
        method: 'GET', // Use GET method since we're just downloading a file
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.blob(); // Convert response to a Blob
    })
    .then(blob => {
        // Create a link element to download the Blob as a file
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = 'danh_sach_nguoi_dung.xlsx'; // File name
        document.body.appendChild(a);
        a.click(); // Trigger the click event to download the file
        window.URL.revokeObjectURL(url);
        alert('Dữ liệu đã được in ra file Excel.');
    })
    .catch(error => {
        alert('Lỗi: ' + error.message);
        console.error('Có lỗi xảy ra!', error);
    });
});
    </script>

    </header>

    <section id="user-management">
        <h2>Danh Sách Người Dùng</h2>
        <table>
            <tr>
                <th>Tên Đăng Nhập</th>
                <th>Số Nước Chưa Thanh Toán (m³)</th>
                <th>Cập Nhật Số Nước</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['total_usewater']; ?></td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <input type="number" name="water_usage" placeholder="Số nước tiêu thụ (m³)" required>
                            <button type="submit">Cập Nhật</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
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
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["water_usage"])) {
    include "config.php";

    $user_id = $_POST['user_id'];
    $water_usage = $_POST['water_usage'];

    // Check if the water usage is a valid number
    if (!is_numeric($water_usage) || $water_usage <= 0) {
        die("Invalid water usage value.");
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO water_usage (user_id, usewater) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ii", $user_id, $water_usage); // Use correct bind_param type
        if ($stmt->execute()) {
            echo "<script>alert('Water usage updated successfully.');</script>";
            echo "<script>window.location.href = 'admin.php';</script>";
        } else {
            echo "<script>alert('Error updating water usage: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
