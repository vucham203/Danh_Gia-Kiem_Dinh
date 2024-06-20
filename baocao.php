<?php
    session_start();
    if( !isset($_SESSION["user"]) ) {
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đồ án</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="baocao.css">
    <script src="baocao.js"></script>
</head>
<body>
    <div id="header">
        <div class="header_1">
            <div class="header_left">
                Quản lý trọ cho thuê
            </div>
            <div class="header_right">
                <p class="admin-label" id="adminLabel">Admin</p>
                <a class="logout-link" id="logoutLink" href="login.php">Log out</a>
                <a class="login-link" id="loginLink" href="index.php">Login</a>
            </div>
            <script>
                var isLoggedIn = <?php echo isset($_SESSION["user"]) ? 'true' : 'false'; ?>;
                var adminLabel = document.getElementById("adminLabel");
                var logoutLink = document.getElementById("logoutLink");
                var loginLink = document.getElementById("loginLink");

                // Tùy chỉnh hiển thị ban đầu dựa trên trạng thái đăng nhập
                if (isLoggedIn) {
                    logoutLink.style.display = "none"; // Ẩn nút "Log out" ban đầu
                    loginLink.style.display = "none"; // Ẩn nút "Login" ban đầu
                } else {
                    logoutLink.style.display = "none"; // Ẩn nút "Log out" ban đầu
                    loginLink.style.display = "inline"; // Hiển thị nút "Login" ban đầu
                }

                // Xử lý sự kiện click trên "Admin"
                adminLabel.addEventListener("click", function () {
                    if (isLoggedIn) {
                        // Nếu đã đăng nhập, hiển thị "Log out"
                        logoutLink.style.display = "inline";
                        loginLink.style.display = "none";
                    } else {
                        // Nếu chưa đăng nhập, chuyển người dùng đến trang đăng nhập (Login)
                        window.location.href = "index.php";
                    }
                });

                // Xử lý sự kiện khi di chuyển chuột ra khỏi "Log out"
                logoutLink.addEventListener("mouseout", function () {
                    logoutLink.style.display = "none"; // Ẩn nút "Log out" khi di chuyển chuột ra khỏi nó
                });
            </script>
        </div>
    </div>
    <div class="main">
        <div class="main_left">
            <a href="index.php">Dashboard</a>
            <a href="room.php">House Type</a>
            <a href="house.php">House</a>
            <a class="content1" href="baocao.php">Reports</a>
        </div>
        <div class="main_right">
            <div class="main_manager" style="height: auto;">
                <div class="main_manager_frame" >
                    <section>
                        <h2>Báo cáo tình trạng phòng trọ</h2>
                        <table id="roomStatusTable">
                            <thead>
                                <tr>
                                    <th>Phòng</th>
                                    <th>Tình trạng</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </section>
                    
                    <section>
                        <h2>Báo cáo thu chi</h2>
                        <table id="financialReportTable">
                            <thead>
                                <tr>
                                    <th>Ngày</th>
                                    <th>Loại</th>
                                    <th>Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </section>
                    
                    <section>
                        <h2>Các thống kê khác</h2>
                        <!-- Thêm các thông tin thống kê khác -->
                    </section>
                    
                    <button onclick="generateReports()">Tạo báo cáo</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>