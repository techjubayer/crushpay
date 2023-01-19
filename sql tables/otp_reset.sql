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
-- Table structure for table `otp_reset`
--

CREATE TABLE `otp_reset` (
  `Sl_No` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `user_phone` varchar(12) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `date` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'PROCEED',
  `token2` varchar(60) DEFAULT NULL,
  `stage` varchar(10) NOT NULL COMMENT 'stage1/stage2/stage3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp_reset`
--

INSERT INTO `otp_reset` (`Sl_No`, `token`, `user_phone`, `otp`, `date`, `status`, `token2`, `stage`) VALUES
(40, '3376376dbc68c5b093b3cbe32c3af3dc', '8638199107', '4317', '2022-03-23', 'PROCEED', NULL, 'stage1'),
(38, '3aed7a3051cd9073e205b0bac1f1b984', '8638199107', '8109', '2022-03-09', 'PROCEED', NULL, 'stage1'),
(37, '605849d083e645f4f7fe6aebed417182', '8638199107', '4342', '2021-11-21', 'SUCCESS', '3620cf5521e8e19d28c15cdab9766b51', 'stage2'),
(39, '772bf82e3bb4b78f75ad98a4d1411642', '8638199107', '9144', '2022-03-09', 'PROCEED', NULL, 'stage1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otp_reset`
--
ALTER TABLE `otp_reset`
  ADD PRIMARY KEY (`token`),
  ADD UNIQUE KEY `Sl_No` (`Sl_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otp_reset`
--
ALTER TABLE `otp_reset`
  MODIFY `Sl_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
