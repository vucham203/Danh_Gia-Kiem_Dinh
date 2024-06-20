-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 20, 2024 lúc 09:16 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `danhgia`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `date`) VALUES
(15, 12, 225000.00, '2024-06-13 22:59:17'),
(16, 13, 125000.00, '2024-06-14 01:44:24'),
(17, 13, 10000.00, '2024-06-14 02:44:09'),
(18, 13, 50000.00, '2024-06-16 03:22:12'),
(19, 13, 25000.00, '2024-06-17 15:01:16'),
(20, 13, 25000.00, '2024-06-19 09:00:46'),
(21, 12, 80000.00, '2024-06-20 18:35:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `admin`) VALUES
(12, 'hoavong768@gmail.com', '$2y$10$qi5ZQ9c.XfmkVkhcPenUJeHWxV0WkX/rid4XIjDFDPqKkiunZayBC', 0, 0),
(13, 'pimpompimpom4@gmail.com', '$2y$10$D3pSMCF4b5NXwaH1ltEd3.AKUilQHUBEHLKh7huh2NlsOu.iiTG4O', 0, 0),
(16, 'nguyenvu00304@gmail.com', '$2y$10$nuPqETAf12u8OY1gw8BwReRsxKH8.f.V/QMjD/w2JL18cZ3eWbrI.', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `water_usage`
--

CREATE TABLE `water_usage` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `usewater` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `water_usage`
--

INSERT INTO `water_usage` (`id`, `user_id`, `usewater`, `date`) VALUES
(12, 16, 3.00, '2024-06-13 21:07:13'),
(13, 16, 7.00, '2024-06-13 21:20:41'),
(14, 16, 1.00, '2024-06-13 21:29:35'),
(15, 16, 5.00, '2024-06-13 21:30:12');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `water_usage`
--
ALTER TABLE `water_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `water_usage`
--
ALTER TABLE `water_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
