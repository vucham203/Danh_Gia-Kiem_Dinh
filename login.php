<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h3>Đăng Nhập</h3>
        
        <?php
        session_start();
        if (isset($_SESSION['login_error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_SESSION['login_error']); ?></p>
            <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>
        
        <form action="login_submit.php" method="post">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit" name="submit">Đăng Nhập</button>
            <button type="reset" name="reset">Làm Mới</button>
            <a href="register.php">Đăng Ký</a>
        </form>
    </div>
</body>
</html>
