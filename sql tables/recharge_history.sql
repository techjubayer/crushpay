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
-- Table structure for table `recharge_history`
--

CREATE TABLE `recharge_history` (
  `Sl_No` int(10) NOT NULL,
  `usertx` varchar(30) NOT NULL COMMENT 'Generate by me',
  `user_phone` varchar(15) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `number` varchar(15) DEFAULT NULL COMMENT 'recharge number',
  `Status` varchar(15) DEFAULT 'PENDING',
  `ApiTransID` varchar(20) DEFAULT NULL,
  `TransDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ErrorMsg` varchar(200) DEFAULT NULL,
  `OprtRef` varchar(20) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL COMMENT 'PREPAID/DTH',
  `profit` float NOT NULL DEFAULT 0,
  `oprt_code` varchar(3) DEFAULT NULL,
  `circle_code` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recharge_history`
--

INSERT INTO `recharge_history` (`Sl_No`, `usertx`, `user_phone`, `user_id`, `amount`, `number`, `Status`, `ApiTransID`, `TransDate`, `ErrorMsg`, `OprtRef`, `type`, `profit`, `oprt_code`, `circle_code`) VALUES
(39, '1637529238811811951554', '7396726158', 'ebee997d', 1, '7396726158', 'FAILURE', '0', '2022-10-11 02:43:55', 'IP ADDRESS NOT REGISTER OR MISS MATCH!. YOUR IP : 15.207.73.63', ' ', 'PREPAID', 0, 'JIO', '1'),
(40, '1637529314841860356637', '7396726158', 'ebee997d', 1, '7396726158', 'FAILURE', '0', '2022-10-11 02:45:11', 'IP ADDRESS NOT REGISTER OR MISS MATCH!. YOUR IP : 15.207.73.63', ' ', 'PREPAID', 0, 'AT', '1'),
(41, '16375294833982044405492', '7396726158', 'ebee997d', 1, '7396726158', 'FAILURE', '0', '2022-10-11 02:48:00', 'Invalid Amount', ' ', 'PREPAID', 0, 'AT', '1'),
(42, '16375295761521279844965', '8638199107', '713039ee', 10, '8638199107', 'Failure', '48950A3C69', '2022-10-11 02:49:58', '', '', 'PREPAID', 0, 'AT', '2'),
(43, '16375295789471846945806', '8638199107', '713039ee', 10, '8638199107', 'Failure', '6A14491F48', '2022-10-11 02:50:14', '', '', 'PREPAID', 0, 'AT', '2'),
(44, '16375297603041683354681', '8638199107', '713039ee', 10, '8638199107', 'Failure', '1CF3B8EBCA', '2022-10-11 02:52:47', '', '', 'PREPAID', 0, 'AT', '2'),
(45, '16375297629941601406923', '8638199107', '713039ee', 10, '8638199107', 'Failure', '69247187BD', '2022-10-11 02:52:57', '', '', 'PREPAID', 0, 'AT', '2'),
(46, '16375297983011344179578', '7396726158', 'ebee997d', 1, '9874566321', 'FAILURE', '0', '2022-10-11 02:53:15', 'Invalid Amount', ' ', 'PREPAID', 0, 'AT', '3'),
(47, '1637529837603563200159', '7396726158', 'ebee997d', 10, '7396726158', 'Failure', '05F303A6C7', '2022-10-11 02:54:27', ' ', ' ', 'PREPAID', 0, 'JIO', '1'),
(48, '16375298403721430093289', '7396726158', 'ebee997d', 10, '7396726158', 'Failure', '5800DD3AF2', '2022-10-11 02:54:32', ' ', ' ', 'PREPAID', 0, 'JIO', '1'),
(49, '1637529927189905539808', '7396726158', 'ebee997d', 10, '8638199107', 'Success', 'C7CDDECE5E', '2022-10-11 02:55:37', ' ', 'BR0006W012WD', 'PREPAID', 0.4, 'JIO', '2'),
(50, '16375299298622068906123', '7396726158', 'ebee997d', 10, '8638199107', 'Success', '048D3A615F', '2022-10-11 02:55:39', ' ', 'BR0006W012WL', 'PREPAID', 0.4, 'JIO', '2'),
(52, '16375303710251211490224', '7396726158', 'ebee997d', 10, '8638199107', 'Success', '6E147D3310', '2022-10-11 03:04:39', ' ', 'BR0006W014R0', 'PREPAID', 0.4, 'JIO', '2'),
(51, '16375303736681670496798', '7396726158', 'ebee997d', 10, '8638199107', 'Success', '4AE8DDE6FF', '2022-10-11 03:04:10', ' ', 'BR0006W014NL', 'PREPAID', 0.4, 'JIO', '2'),
(53, '1637531493343131471282', '8638199107', '713039ee', 10, '8638199107', 'Success', 'DFA44A8DFC', '2022-10-11 03:22:23', ' ', 'BR0006W0184U', 'PREPAID', 0.4, 'JIO', '2'),
(54, '16375325566631137542155', '8638199107', '713039ee', 1, '8638199107', 'FAILURE', '0', '2022-10-11 03:39:13', 'Invalid Amount', ' ', 'PREPAID', 0, 'AT', '2'),
(56, '16375637934441752169402', '8638199107', '713039ee', 10, '8638199107', 'Failure', 'C10ED8764D', '2022-10-11 12:20:11', '', '', 'PREPAID', 0, 'AT', '2'),
(55, '1637563796230597117718', '8638199107', '713039ee', 10, '8638199107', 'Pending', '0', '2022-10-11 12:20:02', 'Request Submitted', ' ', 'PREPAID', 0, 'AT', '2'),
(57, '1637578021945180363793', '8638199107', '713039ee', 10, '8638199107', 'Failure', '6D5E42CAFA', '2022-10-11 16:17:24', '', '', 'PREPAID', 0.27, 'AT', '2'),
(58, '16375780247711288990004', '8638199107', '713039ee', 10, '8638199107', 'Failure', 'AE01E37692', '2022-10-11 16:17:24', '', '', 'PREPAID', 0.27, 'AT', '2'),
(59, '16375785570362008292724', '8638199107', '713039ee', 10, '8638199107', 'Failure', '3D84EDDFAD', '2022-10-11 16:25:55', '', '', 'PREPAID', 0, 'AT', '2'),
(60, '1637578559826434167920', '8638199107', '713039ee', 10, '8638199107', 'Failure', '9E590279BF', '2022-10-11 16:26:18', '', '', 'PREPAID', 0, 'AT', '2'),
(61, '16375787968551355746064', '8638199107', '713039ee', 10, '8638199107', 'Failure', 'F6711543D6', '2022-10-11 16:29:54', '', '', 'PREPAID', 0, 'AT', '2'),
(62, '1637578802162794425641', '8638199107', '713039ee', 10, '8638199107', 'Failure', '21CA9BDC8A', '2022-10-11 16:30:13', '', '', 'PREPAID', 0, 'AT', '2'),
(63, '16375799065381757372178', '8638199107', '713039ee', 10, '8638199107', 'Failure', 'A6AE1D3B96', '2022-10-11 16:48:42', '', '', 'PREPAID', 0, 'AT', '2'),
(64, '16375799090801985623180', '8638199107', '713039ee', 10, '8638199107', 'Failure', '2AC4ADAFEE', '2022-10-11 16:48:42', '', '', 'PREPAID', 0, 'AT', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recharge_history`
--
ALTER TABLE `recharge_history`
  ADD PRIMARY KEY (`usertx`),
  ADD UNIQUE KEY `Sl_No` (`Sl_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recharge_history`
--
ALTER TABLE `recharge_history`
  MODIFY `Sl_No` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
