<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:login.php");
    exit(); // Kết thúc kịch bản nếu không có phiên đăng nhập
}

// Lấy tên người dùng từ dữ liệu phiên
$username = $_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Cập Nhật Số Nước</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Trang Cập Nhật Số Nước</h1>
        <nav>
            <ul>
                <li><a href="register.php">Đăng Ký</a></li>
                <li><a href="login.php">Đăng Nhập</a></li>
                <li><a href="water.php">Cập Nhật Số Nước</a></li>
                <li><a href="payment.php">Thanh Toán</a></li>
                <?php if (isset($_SESSION["user"])): ?>
                    <li>Xin chào, <?php echo $_SESSION["user"]; ?></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section id="update-water">
    <h2>Cập Nhật Số Nước</h2>
        <form id="update-form">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <label for="water-usage">Số Nước Tiêu Thụ (m³):</label>
            <input type="number" id="water-usage" name="water_usage" required>
            <button type="submit">Cập Nhật</button>
        </form>
    </section>

    <!-- Thẻ div để hiển thị thông báo -->
    <div id="update-message"></div>

    <footer>
        <p>&copy; 2024 Công Ty Cung Cấp Nước</p>
    </footer>

    <!-- Thêm thư viện jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Script để gửi yêu cầu AJAX -->
    <script>
        $(document).ready(function(){
            $('#update-form').submit(function(e){
                e.preventDefault(); // Ngăn chặn việc gửi biểu mẫu một cách thông thường
                var formData = $(this).serialize(); // Lấy dữ liệu biểu mẫu

                $.ajax({
                    type: 'POST',
                    url: 'update-water.php',
                    data: formData,
                    success: function(response){
                        $('#update-message').html(response); // Hiển thị thông báo thành công
                    },
                    error: function(xhr, status, error){
                        $('#update-message').html('Lỗi: ' + xhr.responseText); // Hiển thị thông báo lỗi nếu có
                    }
                });
            });
        });
    </script>
</body>
</html>
