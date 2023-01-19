-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 24, 2022 at 05:41 PM
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
-- Database: `crushpay_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `crushpay_users`
--

CREATE TABLE `crushpay_users` (
  `sl_no` int(10) NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `refer_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `device_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `balance` float NOT NULL DEFAULT 0,
  `token` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `profit` float NOT NULL DEFAULT 0,
  `today_profit` float NOT NULL DEFAULT 0,
  `joining_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `margins` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '{   "DTH": {     "VDD": 3.4,     "TSD": 3.3,     "SD": 3.4,     "DTD": 3.4,     "ATD": 3.4   },   "PREPAID": {     "AT": 2.7,     "JIO": 4,     "VF": 3.6,     "BSNL": 4.3   } }',
  `usr_status` int(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 0 = block',
  `refered_by` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rch_count` int(11) NOT NULL DEFAULT 0 COMMENT 'Number of recharge doing by the user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `crushpay_users`
--

INSERT INTO `crushpay_users` (`sl_no`, `user_id`, `user_phone`, `user_email`, `refer_code`, `user_name`, `password`, `device_id`, `balance`, `token`, `profit`, `today_profit`, `joining_date`, `margins`, `usr_status`, `refered_by`, `rch_count`) VALUES
(47, '713039ee', '8638199107', 'techjubayer@gmail.com', 'f92d09c6', 'Jubayer Ahmed', '50475b4f14f873090749a09b95beaf2a3ef05c97b503d277fd55e456ba0e1a71', 'ea78a434c7364d4f', 10000, '50922a5856098da9c14e62545127db06', 0.67, 0.67, '2021-11-21 18:53:27', '{   \"DTH\": {     \"VDD\": 3.4,     \"TSD\": 3.3,     \"SD\": 3.4,     \"DTD\": 3.4,     \"ATD\": 3.4   },   \"PREPAID\": {     \"AT\": 2.7,     \"JIO\": 4,     \"VF\": 3.6,     \"BSNL\": 4.3   } }', 1, '', 0),
(48, 'ebee997d', '7396726158', 'somimazad@gmail.com', '976c5b1f', 'Shomim Azad', '6116d7bf6e84fde404af00f071c524840698000a6dca352d39a2512592877e2d', '7bcfa1aed34bf7a4', 480.8, '124b6695ac20324daa30bf9a97448953', 0.8, 0.8, '2021-11-21 21:08:54', '{   \"DTH\": {     \"VDD\": 3.4,     \"TSD\": 3.3,     \"SD\": 3.4,     \"DTD\": 3.4,     \"ATD\": 3.4   },   \"PREPAID\": {     \"AT\": 2.7,     \"JIO\": 4,     \"VF\": 3.6,     \"BSNL\": 4.3   } }', 1, 'f92d09c6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crushpay_users`
--
ALTER TABLE `crushpay_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_phone` (`user_phone`),
  ADD UNIQUE KEY `refer_code` (`refer_code`),
  ADD UNIQUE KEY `user_phone_2` (`user_phone`),
  ADD UNIQUE KEY `user_email_2` (`user_email`),
  ADD UNIQUE KEY `sl_no` (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crushpay_users`
--
ALTER TABLE `crushpay_users`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
