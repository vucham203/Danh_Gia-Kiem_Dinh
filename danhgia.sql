-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 01:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vidu`
--

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `id` int(5) NOT NULL,
  `r_number` int(2) NOT NULL,
  `d_contract` varchar(20) NOT NULL,
  `deposits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `r_number`, `d_contract`, `deposits`) VALUES
(6, 22, '12/03/2023', 758798),
(7, 55, '12/03/2024', 23443182),
(8, 443, '12/03/2024', 2344434),
(10, 88, '12/03/2024', 23443434);

-- --------------------------------------------------------

--
-- Table structure for table `house_type`
--

CREATE TABLE `house_type` (
  `id` int(4) NOT NULL,
  `r_number` int(20) NOT NULL,
  `r_condition` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `convenient` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `house_type`
--

INSERT INTO `house_type` (`id`, `r_number`, `r_condition`, `price`, `convenient`) VALUES
(1, 44, 'trống', 242434432, 'có giường đôi'),
(4, 88, 'đã thuê', 234434243, 'có giường đôi');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` int(50) NOT NULL,
  `r_number` int(20) NOT NULL,
  `r_amount` int(50) NOT NULL,
  `co_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `name`, `phone`, `r_number`, `r_amount`, `co_date`) VALUES
(1, 'Hoa Tran', 123456789, 36, 234423, '12/12/2033'),
(4, 'Trần Gia Hoà', 363633706, 15, 5435454, '12/01/2024'),
(5, 'Trần Gia Hoà', 363633706, 22, 2132344, '2/12/2023');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0),
(5, 'hoadeptrai', 'e10adc3949ba59abbe56e057f20f883e', 0),
(6, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0),
(7, 'hoadeptrai', '250cf8b51c773f3f8dc8b4be867a9a02', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_type`
--
ALTER TABLE `house_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `house_type`
--
ALTER TABLE `house_type`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
