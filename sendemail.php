<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['action']) && $input['action'] == 'send_email') {
        include 'config.php'; // Include your database connection here

        $adminEmail = '';
        $usersEmails = [];

        // Fetch admin email and user emails from the database
        $result = $conn->query("SELECT username, admin, level FROM user");
        if ($result === false) {
            echo json_encode(['status' => 'error', 'message' => 'Database query failed: ' . $conn->error]);
            exit;
        }

        while ($row = $result->fetch_assoc()) {
            if ($row['admin'] == 1 && $row['level'] == 1) {
                $adminEmail = $row['username'];
            } elseif ($row['admin'] == 0 && $row['level'] == 0) {
                $usersEmails[] = $row['username'];
            }
        }

        if (empty($adminEmail)) {
            echo json_encode(['status' => 'error', 'message' => 'No admin found']);
            exit;
        }

        if (empty($usersEmails)) {
            echo json_encode(['status' => 'error', 'message' => 'No users found']);
            exit;
        }

        try {
            // Configure SMTP for sending email
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $adminEmail;
            $mail->Password = 'ojss bihy qyrb wlrf'; // Replace with your actual app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom($adminEmail, 'Admin');

            foreach ($usersEmails as $userEmail) {
                $mail->addAddress($userEmail);
            }

            // Create the email content
            $content = '
                <div style="border: 2px solid #000; padding: 10px;">
                    <p>Thông báo về tiền nước</p>
                    <p>Số nước đã sử dụng: 100 m<sup>3</sup></p>
                    <p>Số nước tháng trước: 80 m<sup>3</sup></p>
                    <p>Số nước sử dụng đến tháng này: 20 m<sup>3</sup></p>
                    <p>Số nước cần thanh toán: 5000VND x 20 m<sup>3</sup> = 100,000VND</p>
                    <p>Thanh toán trước ngày 5/6/2024</p>
                    <p>Thanh toán vào tài khoản 999999 tại MB Bank</p>
                    <p>NGUYEN VAN A</p>
                </div>
            ';

            // Set email format to HTML
            $mail->isHTML(true);
            $mail->Subject = 'Thông báo về tiền nước';
            $mail->Body    = $content;

            // Send the email
            $mail->send();
            echo json_encode(['status' => 'success', 'message' => 'Emails have been sent successfully']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
