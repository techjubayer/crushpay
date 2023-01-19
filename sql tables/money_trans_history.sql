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
-- Table structure for table `money_trans_history`
--

CREATE TABLE `money_trans_history` (
  `Sl_No` int(11) NOT NULL,
  `txn_id` varchar(40) NOT NULL,
  `fromuserid` varchar(20) NOT NULL,
  `fromphnem` varchar(30) NOT NULL,
  `fromusrname` varchar(20) DEFAULT NULL,
  `touserid` varchar(20) NOT NULL,
  `tophnem` varchar(30) NOT NULL,
  `tousername` varchar(20) NOT NULL,
  `txndate` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` float NOT NULL DEFAULT 0,
  `status` varchar(10) NOT NULL COMMENT 'success/fail/pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money_trans_history`
--

INSERT INTO `money_trans_history` (`Sl_No`, `txn_id`, `fromuserid`, `fromphnem`, `fromusrname`, `touserid`, `tophnem`, `tousername`, `txndate`, `amount`, `status`) VALUES
(27, '16375290871449218365777', '713039ee', '8638199107', 'Jubayer Ahmed', 'ebee997d', '7396726158', 'Shomim Azad', '2021-11-22 02:41:27', 500, 'Success');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `money_trans_history`
--
ALTER TABLE `money_trans_history`
  ADD PRIMARY KEY (`txn_id`),
  ADD UNIQUE KEY `Sl_No` (`Sl_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `money_trans_history`
--
ALTER TABLE `money_trans_history`
  MODIFY `Sl_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
