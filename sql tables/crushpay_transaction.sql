-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2022 at 07:36 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `tnx_add_money`
--

CREATE TABLE `tnx_add_money` (
  `Sl. No.` int(100) NOT NULL,
  `order_id` varchar(40) NOT NULL,
  `checksum` varchar(300) NOT NULL,
  `mid` varchar(40) DEFAULT NULL,
  `txn_amount` float DEFAULT NULL,
  `customer_id` varchar(150) DEFAULT NULL,
  `eamil` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `channel` varchar(5) DEFAULT NULL COMMENT 'WEB or WAP',
  `status` varchar(20) DEFAULT NULL,
  `verify_token` varchar(300) DEFAULT NULL,
  `txn_id` varchar(70) DEFAULT NULL,
  `proceed_time` timestamp NULL DEFAULT NULL,
  `txn_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tnx_add_money`
--

INSERT INTO `tnx_add_money` (`Sl. No.`, `order_id`, `checksum`, `mid`, `txn_amount`, `customer_id`, `eamil`, `phone`, `channel`, `status`, `verify_token`, `txn_id`, `proceed_time`, `txn_date`) VALUES
(188, '11098516477053261598594505431', '0b88f92c958d29fda578912b42bd8af020272343be3c5d800216800ff980fd72', 'MPnVyI32489761845772', 20, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', '173c4c9be590d377c736105451ffc67f', NULL, '2022-03-19 15:55:26', NULL),
(176, '15674916375737731674932691273', 'e3063b88bd83cdae5baf556932154b61971cbb160bfbfec34c1eddfc838a163b', 'zUHxAP47626515860472', 100, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', '714c254d41ec1dd55126c5d15be52bd9', NULL, '2021-11-22 09:36:13', NULL),
(179, '15948016376038408153881774003', '37ec275354cf9f43613601e6df58dfde7add0db19a345109373aece1f3727626', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', 'ccaedaec80acc08cd2dac3ab27c6a389', NULL, '2021-11-22 17:57:20', NULL),
(185, '20839116381209456937081699736', '41bcbf8a6e92ab32b45c5442169d032c9a4665ed169d87ce4b16e357347a60a6', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'TXN_SUCCESS', 'd89ac406378f91bfd8aef0fb7bd162cf', '20211128111212800110168283403213693', '2021-11-28 17:35:45', '2021-11-28 23:05:49'),
(181, '46360316376041767715533732035', '50de31c68bfed9bb17e577d71ef43b0b7fb44e44f2f7341684476f32f2f928df', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'TXN_SUCCESS', 'c62cbb18c6fdf113685a31e7472094cc', '20211122111212800110168789703212084', '2021-11-22 18:02:56', '2021-11-22 23:32:56'),
(187, '46437316454292367285198196461', '96c4d6af720ad7de4d5c53f25d94c5b03ae20abf8eda98ce03c2d126382db22a', 'MPnVyI32489761845772', 25, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', 'e33366dfa179d20ffccb7ea13b4d3010', NULL, '2022-02-21 07:40:36', NULL),
(178, '5410311637603812644522046027', 'b0fa5efff9c55c0adff78cf8fe995ce3a3489d3aaed64df2942cfe69cd2cc7b6', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', '29240eba1a6c7b0c10cbbf53f6ca9fd4', NULL, '2021-11-22 17:56:52', NULL),
(180, '56029316376038493198863958675', '7d6f6539cde3891587cd68a5926cd85cf1a1cd355ddea9f60227b85e6b85c838', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', '96272bfc3fd5446e31fdf0b2547a8c16', NULL, '2021-11-22 17:57:29', NULL),
(184, '69992316376060626695067585901', '355176146b0b23936c67850ee3e7b5b92712bf5222ad5b42a45fba3ce4260f76', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'TXN_SUCCESS', 'bb827fbc31a627ca4bb5748b2bbe364c', '20211123111212800110168324603213405', '2021-11-22 18:34:22', '2021-11-23 00:04:22'),
(182, '77984516376042355500997891101', '347beabf3463c547596c493341dfaaed01f83e200f2f3aad3761f751f9eb1082', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'TXN_FAILURE', '8096aab6a35ef679ece8c7a713ce983e', '20211122111212800110168308403338332', '2021-11-22 18:03:55', '2021-11-22 23:33:57'),
(186, '80928316392427159231739007544', '1138279b3d98ab45d99291c864501370dac2744dad9cb09ba0dcf930f7403ec4', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', 'c6603459925b18a1db26329cf58d9db1', NULL, '2021-12-11 17:11:55', NULL),
(183, '87528416376059628396025100952', 'ee56525d8789113bdea1e0a0263829f341126554270ea23f35e51a16c960ce23', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'TXN_FAILURE', 'bb6849c124b50a3e28f25efccf46727a', '20211123111212800110168219303171404', '2021-11-22 18:32:42', '2021-11-23 00:02:43'),
(177, '90371416376037398124271311868', '364420e67cdb7391587a36280da24323fb074a7688ce7146bf5f85825233aa67', 'zUHxAP47626515860472', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', '20eb513b5ffccbbcfd08a2a0478b2c39', NULL, '2021-11-22 17:55:39', NULL),
(189, '9374621647876455727693243129', '24a75a78bb8ab57ec4cb50e05f5d1d180e2364403eb172ec53da80569b14dee7', 'MPnVyI32489761845772', 10, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', '326dbbb97d54698ff8fcc25b3dcd1790', NULL, '2022-03-21 15:27:35', NULL),
(175, '94553816375638852798827468377', '48b99282f4340448c849ec80732fc098dd6b217f7484eb9874f5a1d69c325079', 'zUHxAP47626515860472', 500, '713039ee', 'techjubayer@gmail.com', '8638199107', 'WEB', 'PROCEED', '1ecb477cc882797ecb92cb7e5b36c9bf', NULL, '2021-11-22 06:51:25', NULL),
(174, '99169316375291311520580822961', '41e166dfda1376e90119d52dc2caa384e1a06260b91c248708709e34a6c3437e', 'zUHxAP47626515860472', 200, 'ebee997d', 'somimazad@gmail.com', '7396726158', 'WEB', 'PROCEED', '0c0d558e19ddd99c1210a37fb5b73e2d', NULL, '2021-11-21 21:12:11', NULL);

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
-- Indexes for table `recharge_history`
--
ALTER TABLE `recharge_history`
  ADD PRIMARY KEY (`usertx`),
  ADD UNIQUE KEY `Sl_No` (`Sl_No`);

--
-- Indexes for table `refer_user`
--
ALTER TABLE `refer_user`
  ADD PRIMARY KEY (`refered_deviceid`),
  ADD KEY `sl_no` (`sl_no`);

--
-- Indexes for table `tnx_add_money`
--
ALTER TABLE `tnx_add_money`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `checksum` (`checksum`),
  ADD UNIQUE KEY `verify_token` (`verify_token`),
  ADD KEY `Sl. No.` (`Sl. No.`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `money_trans_history`
--
ALTER TABLE `money_trans_history`
  MODIFY `Sl_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `recharge_history`
--
ALTER TABLE `recharge_history`
  MODIFY `Sl_No` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `refer_user`
--
ALTER TABLE `refer_user`
  MODIFY `sl_no` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tnx_add_money`
--
ALTER TABLE `tnx_add_money`
  MODIFY `Sl. No.` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
