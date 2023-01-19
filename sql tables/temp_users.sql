-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2022 at 06:41 AM
-- Server version: 10.2.38-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crushpay_temp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE `temp_users` (
  `sl_no` int(10) NOT NULL,
  `user_id` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refered_by` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `device_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `joining_date` datetime NOT NULL DEFAULT current_timestamp(),
  `plane_pass` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone_otp` varchar(6) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `temp_users`
--

INSERT INTO `temp_users` (`sl_no`, `user_id`, `user_phone`, `user_email`, `refered_by`, `user_name`, `password`, `device_id`, `token`, `joining_date`, `plane_pass`, `phone_otp`) VALUES
(63, '713039ee', '8638199107', 'techjubayer@gmail.com', '', 'Jubayer Ahmed', 'c2a9c38072f6250112de46b9c284ab7656f7114475cb85fadb12c04d9c475654', 'ea78a434c7364d4f', 'd7d0d8de29ab493394feb5a09f3b6c4e', '2021-11-22 00:23:10', '1234567890', '9922'),
(64, 'ebee997d', '7396726158', 'somimazad@gmail.com', 'f92d09c6', 'Shomim Azad', '6116d7bf6e84fde404af00f071c524840698000a6dca352d39a2512592877e2d', '7bcfa1aed34bf7a4', 'b4b0f2f0cc588a3cbca5a67b2c011c65', '2021-11-22 02:38:29', 'shomim@azad7396', '1358');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `temp_users`
--
ALTER TABLE `temp_users`
  ADD PRIMARY KEY (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `temp_users`
--
ALTER TABLE `temp_users`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
