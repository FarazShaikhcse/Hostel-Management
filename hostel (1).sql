-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2023 at 03:49 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'nidahsshaikh@gmail.com', 'nidah123', '2016-04-04 20:31:45', '2016-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

DROP TABLE IF EXISTS `adminlog`;
CREATE TABLE IF NOT EXISTS `adminlog` (
  `id` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomno` int(11) DEFAULT NULL,
  `seater` int(11) DEFAULT NULL,
  `feespm` int(11) DEFAULT NULL,
  `foodstatus` int(11) DEFAULT NULL,
  `stayfrom` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `regno` varchar(10) DEFAULT NULL,
  `egycontactno` bigint(11) DEFAULT NULL,
  `guardianName` varchar(30) DEFAULT NULL,
  `guardianRelation` varchar(50) DEFAULT NULL,
  `guardianContactno` bigint(11) DEFAULT NULL,
  `pmntAddress` varchar(500) DEFAULT NULL,
  `pmntCity` varchar(50) DEFAULT NULL,
  `pmnatetState` varchar(50) DEFAULT NULL,
  `pmntPincode` int(11) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`),
  KEY `roomno_fk` (`roomno`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `roomno`, `seater`, `feespm`, `foodstatus`, `stayfrom`, `duration`, `regno`, `egycontactno`, `guardianName`, `guardianRelation`, `guardianContactno`, `pmntAddress`, `pmntCity`, `pmnatetState`, `pmntPincode`, `postingDate`, `updationDate`) VALUES
(3, 100, 5, 2000, 0, '2023-01-18', 9, '4MT20IS023', 9887656565, 'abcd', 'dfg', 9989658745, 'xyz', 'Bangalore', 'Karnataka', 506801, '2023-01-06 18:30:24', NULL),
(4, 201, 2, 8000, 1, '2023-02-01', 4, '4MT20IS014', 9876543200, 'ananya', 'sister', 9632587410, '\'Tripti house\' near suratkal,Mangalore,Karnataka', 'Mangalore', 'Karnataka', 574225, '2023-01-07 04:43:14', NULL),
(5, 201, 2, 8000, 0, '2023-02-14', 6, '4MT20IS003', 8794561238, 'lahari', 'sister', 7894561237, 'nagashree house near mangalore body garrage  udupi,karnataka ', 'udupi', 'Karnataka', 789456, '2023-01-07 04:47:33', NULL),
(6, 112, 3, 6000, 1, '2023-01-08', 12, '4MT20IS019', 9546123788, 'Nidah', 'Sister', 9874612355, '\'Prajna House\' ,Mundli ,Karkala', 'Karkala', 'Karnataka', 574225, '2023-01-07 04:51:54', NULL),
(14, 100, 5, 2000, 1, '2023-01-21', 6, '4MT20IS011', 9872695625, 'Medhini', 'Grandmother', 7789563214, 'uppinkote,Brahmavar', 'Brahmavar', 'Karnataka', 576213, '2023-01-10 06:12:07', NULL),
(15, 304, 4, 8000, 1, '2023-01-14', 6, '4MT20IS056', 7689532145, 'Vidya', 'sister', 8879561334, 'Ajjibettu,Bantwal', 'Bantwal', 'Karnataka', 574324, '2023-01-10 06:16:18', NULL),
(16, 110, 2, 8000, 1, '2023-01-26', 6, '4MT20IS043', 8523697415, 'Vijetha', 'Aunt', 8896547124, 'NR Pura,Chikmagalur', 'NR Pura', 'Karnataka', 577152, '2023-01-10 06:19:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seater` int(11) DEFAULT NULL,
  `room_no` int(11) DEFAULT NULL,
  `fees` int(11) DEFAULT NULL,
  `posting_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `room_no` (`room_no`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `seater`, `room_no`, `fees`, `posting_date`) VALUES
(4, 3, 112, 6000, '2020-04-12 01:31:07'),
(8, 5, 100, 2000, '2023-01-08 12:11:17'),
(10, 4, 110, 4000, '2023-01-09 14:43:53'),
(11, 2, 201, 8000, '2023-01-09 14:45:06'),
(14, 4, 304, 6000, '2023-01-09 14:50:23'),
(16, 1, 305, 10000, '2023-01-12 16:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `room_occupancy`
--

DROP TABLE IF EXISTS `room_occupancy`;
CREATE TABLE IF NOT EXISTS `room_occupancy` (
  `roomno` int(20) NOT NULL,
  `occupiedseats` int(5) NOT NULL,
  PRIMARY KEY (`roomno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_occupancy`
--

INSERT INTO `room_occupancy` (`roomno`, `occupiedseats`) VALUES
(100, 2),
(110, 1),
(112, 1),
(201, 2),
(304, 1),
(305, 0);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `State` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `State`) VALUES
(1, 'Andaman and Nicobar Island (UT)'),
(2, 'Andhra Pradesh'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(5, 'Bihar'),
(6, 'Chandigarh (UT)'),
(7, 'Chhattisgarh'),
(8, 'Dadra and Nagar Haveli (UT)'),
(9, 'Daman and Diu (UT)'),
(10, 'Delhi (NCT)'),
(11, 'Goa'),
(12, 'Gujarat'),
(13, 'Haryana'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(16, 'Jharkhand'),
(17, 'Karnataka'),
(18, 'Kerala'),
(19, 'Lakshadweep (UT)'),
(20, 'Madhya Pradesh'),
(21, 'Maharashtra'),
(22, 'Manipur'),
(23, 'Meghalaya'),
(24, 'Mizoram'),
(25, 'Nagaland'),
(26, 'Odisha'),
(27, 'Puducherry (UT)'),
(28, 'Punjab'),
(29, 'Rajastha'),
(30, 'Sikkim'),
(31, 'Tamil Nadu'),
(32, 'Telangana'),
(33, 'Tripura'),
(34, 'Uttarakhand'),
(35, 'Uttar Pradesh'),
(36, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

DROP TABLE IF EXISTS `userlog`;
CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(30) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userIp`, `loginTime`) VALUES
(24, '4MT20IS014', 0x3a3a31, '2023-01-17 16:44:03'),
(25, '4MT20IS003', 0x3a3a31, '2023-01-17 16:48:20'),
(26, '4MT20IS023', 0x3a3a31, '2023-01-17 16:49:02'),
(27, '4MT20IS023', 0x3a3a31, '2023-01-19 14:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

DROP TABLE IF EXISTS `userregistration`;
CREATE TABLE IF NOT EXISTS `userregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regNo` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `contactNo` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(45) DEFAULT NULL,
  `passUdateDate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regNo` (`regNo`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `regNo`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(4, '4MT20IS023', 'Nidah', 'Shabbir', 'Shaikh', 'female', 9876543210, 'nidah@gmail.com', 'nidah123', '2023-01-06 18:30:24', NULL, NULL),
(5, '4MT20IS014', 'LAHARI', '', 'ACHARYA', 'female', 9945612589, 'laharilahari@gmail.com', '12345', '2023-01-07 04:43:14', '08-01-2023 06:18:56', NULL),
(6, '4MT20IS003', 'ANANYA', '', 'GANIGA', 'female', 9874561238, 'ananyaganiga2111@gmail.com', '12345', '2023-01-07 04:47:33', NULL, NULL),
(7, '4MT20IS019', 'MANOJNA ', 'P', 'JAIN', 'female', 9517386420, 'jainmanojna@gmail.com', '12345', '2023-01-07 04:51:54', NULL, NULL),
(10, '4MT20IS015', 'LAKSHITHA', '', 'SALIAN', 'female', 9876543210, 'lakshitha@gmail.com', '123', '2023-01-07 08:53:27', NULL, NULL),
(11, '4MT20CS143', 'Sauda', '', 'Shaikh', 'female', 9875945656, 'sauda@gmail.com', 'sauda', '2023-01-08 12:59:15', NULL, NULL),
(14, '4MT20IS011', 'SHRAMITHA', '', 'SHETTY', 'female', 9512364785, 'shramitha17@gmail.com', '12345', '2023-01-10 06:12:07', NULL, NULL),
(15, '4MT20IS056', 'VINAYA', '', 'SHREE', 'female', 7789562314, 'vinaya11@gmail.com', '12345', '2023-01-10 06:16:18', NULL, NULL),
(16, '4MT20IS043', 'SNEHA', '', 'CM', 'female', 8896547123, 'sneha25@gmail.com', '12345', '2023-01-10 06:19:11', NULL, NULL),
(17, '456abc', 'ab', 'ee', 'eeer', 'female', 648751655, 'gfs@gmail.com', '12345', '2023-01-10 07:06:59', NULL, NULL),
(18, '4MT20IS099', 'A', 'B', 'C', 'male', 9874563111, 'test@gmail.com', '12345', '2023-01-17 07:07:44', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `regno_fk` FOREIGN KEY (`regno`) REFERENCES `userregistration` (`regNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roomno_fk` FOREIGN KEY (`roomno`) REFERENCES `rooms` (`room_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_occupancy`
--
ALTER TABLE `room_occupancy`
  ADD CONSTRAINT `roomnofk` FOREIGN KEY (`roomno`) REFERENCES `rooms` (`room_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
