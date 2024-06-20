<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h3>Đăng Ký</h3>
        
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="register_submit.php" method="post">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" required>
            <button type="submit" name="submit">Đăng Ký</button>
            <button type="reset">Làm Mới</button>
            <a href="login.php">Đăng Nhập</a>
        </form>
    </div>
</body>
</html>
