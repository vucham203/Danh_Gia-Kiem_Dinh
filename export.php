<?php
// export.php

include "config.php";
require 'vendor/autoload.php'; // Make sure this path is correct based on your project structure

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Your SQL query remains the same as before
$sql = "
SELECT u.username, COALESCE(SUM(w.usewater), 0) AS total_usewater
FROM user u
LEFT JOIN water_usage w ON u.id = w.user_id
WHERE u.admin != 1
GROUP BY u.id, u.username";

$result = $conn->query($sql);

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers
$sheet->setCellValue('A1', 'Tên Đăng Nhập');
$sheet->setCellValue('B1', 'Số Nước Chưa Thanh Toán (m³)');

$row = 2;
while ($row_data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $row_data['username']);
    $sheet->setCellValue('B' . $row, $row_data['total_usewater']);
    $row++;
}

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="danh_sach_nguoi_dung.xlsx"');
header('Cache-Control: max-age=0');

// Write the spreadsheet to file
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

$conn->close();
?>
