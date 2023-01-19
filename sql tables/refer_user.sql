-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2022 at 09:43 AM
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
-- Database: `crushpay_transaction`
--

-- --------------------------------------------------------

--
-- Table structure for table `refer_user`
--

CREATE TABLE `refer_user` (
  `sl_no` int(6) NOT NULL,
  `refered_deviceid` varchar(30) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `amount` int(3) NOT NULL DEFAULT 0,
  `user_refer_code` varchar(10) NOT NULL COMMENT 'Refered By This',
  `refered_phone` varchar(15) NOT NULL,
  `refered_email` varchar(50) NOT NULL,
  `refered_userid` varchar(20) NOT NULL,
  `refered_name` varchar(30) NOT NULL,
  `refered_refer_code` varchar(10) NOT NULL,
  `status_` varchar(10) NOT NULL DEFAULT 'pending',
  `date_` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refer_user`
--

INSERT INTO `refer_user` (`sl_no`, `refered_deviceid`, `user_id`, `user_phone`, `user_email`, `amount`, `user_refer_code`, `refered_phone`, `refered_email`, `refered_userid`, `refered_name`, `refered_refer_code`, `status_`, `date_`) VALUES
(2, '7bcfa1aed34bf7a4', '713039ee', '8638199107', 'techjubayer@gmail.com', 30, 'f92d09c6', '7396726158', 'somimazad@gmail.com', 'ebee997d', 'Shomim Azad', '976c5b1f', 'pending', '2021-11-22 02:38:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `refer_user`
--
ALTER TABLE `refer_user`
  ADD PRIMARY KEY (`refered_deviceid`),
  ADD KEY `sl_no` (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `refer_user`
--
ALTER TABLE `refer_user`
  MODIFY `sl_no` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
