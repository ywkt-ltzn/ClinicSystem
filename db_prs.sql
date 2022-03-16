-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 09:23 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_prs`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `bookingtime` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bid`, `pid`, `did`, `bookingtime`, `created`, `modified`) VALUES
(1, 8, 10, '2021-01-16 21:31:51', '2021-01-16 21:31:51', '2021-01-16 21:31:51'),
(2, 7, 10, '2021-01-16 21:32:24', '2021-01-16 21:32:24', '2021-01-16 21:32:24'),
(3, 4, 10, '2021-01-16 21:38:41', '2021-01-16 21:38:41', '2021-01-16 21:38:41'),
(4, 9, 10, '2021-01-16 22:11:29', '2021-01-16 22:11:29', '2021-01-16 22:11:29'),
(5, 13, 1, '2021-01-24 19:53:47', '2021-01-24 19:53:47', '2021-01-24 19:53:47'),
(6, 9, 1, '2021-01-24 19:58:45', '2021-01-24 19:58:45', '2021-01-24 19:58:45'),
(7, 11, 1, '2021-01-24 20:21:21', '2021-01-24 20:21:21', '2021-01-24 20:21:21'),
(8, 10, 1, '2021-01-24 20:22:15', '2021-01-24 20:22:15', '2021-01-24 20:22:15'),
(9, 13, 1, '2021-01-24 20:23:18', '2021-01-24 20:23:18', '2021-01-24 20:23:18'),
(10, 13, 1, '2021-01-24 20:24:26', '2021-01-24 20:24:26', '2021-01-24 20:24:26'),
(11, 10, 1, '2021-01-24 20:25:52', '2021-01-24 20:25:52', '2021-01-24 20:25:52'),
(12, 11, 1, '2021-01-24 20:27:51', '2021-01-24 20:27:51', '2021-01-24 20:27:51'),
(13, 10, 1, '2021-01-25 01:59:55', '2021-01-24 20:29:55', '2021-01-24 20:29:55'),
(14, 13, 13, '2021-01-25 17:05:38', '2021-01-25 11:35:38', '2021-01-25 11:35:38'),
(15, 13, 13, '2021-01-25 17:05:43', '2021-01-25 11:35:44', '2021-01-25 11:35:44'),
(16, 13, 13, '2021-01-25 17:05:44', '2021-01-25 11:35:44', '2021-01-25 11:35:44'),
(17, 13, 13, '2021-01-25 17:05:45', '2021-01-25 11:35:45', '2021-01-25 11:35:45'),
(18, 13, 13, '2021-01-25 17:05:45', '2021-01-25 11:35:46', '2021-01-25 11:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `did` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `degree` varchar(45) NOT NULL,
  `speciality` varchar(250) NOT NULL,
  `remark` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `day0` int(11) DEFAULT NULL,
  `day1` int(11) DEFAULT NULL,
  `day2` int(11) DEFAULT NULL,
  `day3` int(11) DEFAULT NULL,
  `day4` int(11) DEFAULT NULL,
  `day5` int(11) DEFAULT NULL,
  `day6` int(11) DEFAULT NULL,
  `stime` time DEFAULT NULL,
  `etime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`did`, `uid`, `degree`, `speciality`, `remark`, `created`, `modified`, `day0`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`, `stime`, `etime`) VALUES
(1, 9, 'M.B.,B.S(YGN), M.Med.,Sc(Micro)', 'Neurologist(UK)', '', '2018-09-12 15:22:04', '2021-01-26 17:49:39', 0, 0, 0, 1, 1, 1, 1, '02:37:00', '02:37:00'),
(10, 17, 'M.B.,B.S , M.R.C.P(UK),M.Med.Sc', 'Surgery(Neuro)', '', '2018-09-12 22:37:16', '2021-01-24 21:48:38', 1, 1, 0, 0, 0, 0, 1, '09:00:00', '11:30:00'),
(12, 28, 'MBBS', 'Pathyo', '', '2018-09-16 22:27:21', '2018-09-16 22:27:21', 0, 0, 1, 1, 0, 0, 0, '13:00:00', '00:00:00'),
(13, 29, 'MBBS', 'OG', 'test', '2018-09-16 22:32:13', '2018-09-16 22:32:13', 1, 1, 0, 0, 0, 0, 0, '10:30:00', '11:30:00'),
(14, 30, 'MBBS', 'Bone', '', '2018-09-16 22:34:35', '2018-09-16 22:34:35', 0, 1, 0, 1, 0, 0, 0, '11:30:00', '13:00:00'),
(15, 31, 'M.B.B.s', 'Child', '', '2018-09-16 22:45:59', '2018-09-16 22:45:59', 0, 0, 0, 0, 1, 1, 0, '11:10:00', '12:00:00'),
(16, 32, 'M.BBS', 'Child', '', '2018-09-16 22:48:06', '2018-09-16 22:48:06', 0, 0, 0, 0, 1, 0, 0, '11:00:00', '13:00:00'),
(17, 33, 'M.B.B.Sc, M.Med,Sc (Child)', 'general care', '', '2018-09-16 22:49:51', '2021-01-25 11:19:02', 0, 1, 1, 1, 0, 0, 0, '07:00:00', '08:30:00'),
(20, 55, 'M.B.B.Sc', 'General Specialist', '', '2021-01-26 13:39:25', '2021-01-26 13:44:18', 1, 1, 1, 0, 0, 0, 0, '07:00:00', '08:00:00'),
(22, 57, 'M.B.B.Sc', 'Child', '', '2021-01-26 13:47:53', '2021-01-26 13:47:53', 1, 0, 1, 1, 0, 0, 0, '17:30:00', '19:30:00'),
(23, 58, 'M.B.B.Sc', 'OG', '', '2021-01-26 13:55:01', '2021-01-26 13:55:01', 0, 1, 1, 1, 0, 0, 0, '18:00:00', '19:30:00'),
(24, 59, 'M.B.B.Sc', 'Child', '', '2021-01-26 13:58:23', '2021-01-26 13:58:23', 0, 1, 1, 0, 0, 0, 0, '06:00:00', '07:00:00'),
(25, 60, 'M.B.B.Sc', 'Child', '', '2021-01-26 14:04:55', '2021-01-26 14:04:55', 0, 0, 0, 0, 0, 0, 0, '06:00:00', '07:00:00'),
(26, 61, 'M.B.B.Sc', 'Child', '', '2021-01-26 14:06:07', '2021-01-26 14:06:07', 1, 1, 0, 0, 0, 0, 0, '08:00:00', '09:00:00'),
(27, 62, 'M.B.B.Sc', 'Child', '', '2021-01-26 14:13:20', '2021-01-26 14:13:20', 0, 0, 1, 1, 0, 0, 0, '10:30:00', '11:30:00'),
(28, 63, 'M.B.B.Sc', 'Child', '', '2021-01-26 14:16:15', '2021-01-26 14:16:15', 0, 1, 1, 0, 0, 0, 0, '07:00:00', '08:00:00'),
(29, 64, 'M.B.B.Sc', 'Child', '', '2021-01-26 14:26:14', '2021-01-26 14:26:14', 0, 1, 1, 0, 0, 0, 0, '07:00:00', '08:00:00'),
(30, 65, 'M.B.B.Sc', 'Child', '', '2021-01-26 14:28:44', '2021-01-26 14:28:44', 0, 0, 1, 1, 0, 0, 0, '17:30:00', '18:30:00'),
(31, 66, 'sdfsdf', 'sdfsd', 'sdfs', '2021-01-26 14:30:16', '2021-01-26 14:30:16', 0, 0, 1, 1, 0, 0, 0, '17:30:00', '18:30:00'),
(32, 67, 'dfsdf', 'sdfs', 'adfsdf', '2021-01-26 14:32:57', '2021-01-26 14:32:57', 0, 1, 0, 0, 0, 0, 0, '10:30:00', '11:30:00'),
(33, 68, 'M.B.B.Sc', 'Child', '', '2021-01-26 14:33:29', '2021-01-26 14:33:29', 0, 1, 1, 0, 0, 0, 0, '07:00:00', '08:00:00'),
(34, 69, '', 'Child', '', '2021-01-26 14:47:39', '2021-01-26 14:47:39', 0, 0, 1, 0, 0, 0, 0, '10:30:00', '11:30:00'),
(35, 70, 'dfsdfs', 'sdfsdf', 'fdsf', '2021-01-26 17:50:19', '2021-01-26 17:50:19', 0, 0, 1, 0, 0, 0, 0, '10:30:00', '11:30:00'),
(36, 71, 'dfsdfs', 'sdfsdf', 'fdsf', '2021-01-26 17:50:35', '2021-01-26 17:50:35', 0, 1, 1, 0, 0, 0, 0, '10:30:00', '11:30:00'),
(37, 72, 'M.B.,B.S(YGN), M.Med.,Sc(Micro)', 'Neurologist(UK)', '', '2021-01-26 17:50:54', '2021-01-26 17:50:54', 0, 0, 0, 1, 1, 1, 1, '02:37:00', '02:37:00'),
(38, 73, 'fsdf', 'dsfsf', '', '2021-01-26 18:03:01', '2021-01-26 18:03:01', 0, 1, 0, 0, 0, 0, 0, '10:30:00', '11:30:00'),
(39, 74, 'M.B.B.Sc', 'Child', '', '2021-01-26 18:07:57', '2021-01-26 18:07:57', 0, 1, 0, 0, 0, 0, 0, '10:00:00', '11:30:00'),
(40, 75, 'M.B.B.Sc', 'Child Dentle', 'dlf', '2021-01-26 18:15:36', '2021-01-26 18:16:41', 1, 1, 0, 0, 0, 0, 0, '10:30:00', '11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `bloodtype` varchar(45) DEFAULT NULL,
  `weight` varchar(45) DEFAULT NULL COMMENT 'lb',
  `height` int(11) DEFAULT NULL COMMENT 'cm',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `uid`, `code`, `bloodtype`, `weight`, `height`, `created`, `modified`) VALUES
(4, 22, '00000001', 'B', '150', 160, '2018-09-14 06:47:50', '2021-01-25 22:18:35'),
(9, 34, '00000005', 'B-', '100', 140, '2021-01-16 21:47:53', '2021-01-16 21:47:53'),
(10, 35, '00000006', 'B-', '100', 140, '2021-01-16 21:50:02', '2021-01-16 22:12:33'),
(11, 37, '00000007', 'A', '14', 50, '2021-01-16 22:13:35', '2021-01-16 22:41:39'),
(12, 38, '00000008', 'A', '110', 100, '2021-01-16 22:23:23', '2021-01-16 22:23:23'),
(13, 39, '00000009', 'A', '110', 100, '2021-01-16 22:33:36', '2021-01-16 22:33:36'),
(14, 40, '00000010', 'A', '110', 100, '2021-01-16 22:37:13', '2021-01-16 22:37:13'),
(15, 41, '00000011', 'A', '110', 100, '2021-01-16 22:39:30', '2021-01-16 22:39:30'),
(16, 42, '00000012', 'AB', '34', 32, '2021-01-16 22:40:17', '2021-01-16 22:40:17'),
(17, 43, '00000013', 'AB', '23', 12, '2021-01-16 22:42:27', '2021-01-16 22:42:27'),
(18, 44, '00000014', 'AB', '23', 12, '2021-01-16 22:46:36', '2021-01-16 22:46:36'),
(19, 45, '00000015', 'A', '34', 23, '2021-01-16 22:48:33', '2021-01-16 22:48:33'),
(20, 46, '00000016', 'AB', '33', 33, '2021-01-16 22:50:56', '2021-01-16 22:50:56'),
(21, 53, '00000017', 'AB', '110', 140, '2021-01-25 11:33:11', '2021-01-25 11:33:11'),
(22, 54, '00000018', 'A', '140', 130, '2021-01-25 22:22:53', '2021-01-25 22:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `rid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `regdate` datetime NOT NULL,
  `regcode` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role` int(11) NOT NULL,
  `role_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Doctor'),
(3, 'Pharmist'),
(4, 'Cashier'),
(5, 'Staff'),
(6, 'Patient');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `history` longtext NOT NULL,
  `treatment` longtext NOT NULL,
  `issuepharm` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`tid`, `pid`, `uid`, `history`, `treatment`, `issuepharm`, `created`, `modified`) VALUES
(1, 10, 9, 'Headage, Fever \n102 F\n120/90 HMC', 'Paracetamol\nCivit', 0, '2021-01-24 20:31:07', '2021-01-24 20:31:07'),
(2, 10, 9, 'illness, pain , noisey', 'citrine 3/2 day\nbiogesic 2 per day', 1, '2021-01-25 11:22:20', '2021-01-25 11:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `gender` int(11) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `role` int(11) NOT NULL,
  `uimage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `email`, `phone`, `dob`, `address`, `gender`, `password`, `created`, `modified`, `role`, `uimage`) VALUES
(2, 'ARC1', 'arc1@mail.com', '1234567', '1999-01-01', 'Yangon', 0, '296ade920a676bdc3881b2005d3e999b', '2018-09-11 04:16:40', '2021-01-24 23:46:00', 1, ''),
(3, 'ARC2', 'arc2@mail.com', '1234567', '1999-01-01', 'Yangon', 0, 'eefec26f83fbc8318a6af7c3c9b07ec9', '2018-09-11 04:56:01', '2018-09-11 04:56:01', 1, ''),
(9, 'admin1_test', 'admin1@mail.com', '1234567', '1999-01-15', 'Yangon', 0, 'e00cf25ad42683b3df678c61f42c6bda', '2018-09-11 06:58:04', '2021-01-26 17:49:39', 2, ''),
(17, 'Dr. Soe tk test', 'sopykt@gmail.com', '222333444', '1990-06-07', 'Yangon Insein', 0, '7088660367c0304ff51a5c8b97f809ac', '2018-09-12 22:37:16', '2021-01-24 21:48:38', 2, ''),
(22, 'U  Hla Han', '', '222333444', '1984-09-11', 'Yangon', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2018-09-14 06:47:50', '2021-01-25 22:18:35', 6, ''),
(27, 'Sann Sann', 'sann@mail.com', '959222333444', '1980-08-09', 'Yangon', 1, '44e5d2a87a4d43fd72dc9be25ca3a44c', '2018-09-16 21:00:42', '2018-09-16 21:00:42', 5, ''),
(28, 'Dr.Kyaw Hla', 'kyaw@mail.com', '959887766', '1970-04-04', 'Yangon', 0, '3c782fcc2d466fcce64f75e3ac09fb81', '2018-09-16 22:27:21', '2018-09-16 22:27:21', 2, ''),
(29, 'Dr. Win Win Mya', 'win@mail.com', '959884455', '1960-04-04', 'Hlaing', 1, '0b08bd98d279b88859b628cd8c061ae0', '2018-09-16 22:32:13', '2018-09-16 22:32:13', 2, ''),
(30, 'Dr. Hein', 'hein@mail.com', '9598876543', '1980-04-04', 'Kamayut', 0, '817bc3184ef8b40cd73695fa4c05cc84', '2018-09-16 22:34:35', '2018-09-16 22:34:35', 2, ''),
(31, 'Dr.Hnin', 'hnin@mail.com', '959448372', '1980-05-05', 'Yangon', 1, '42debe1e703501935aa2bd50b81acd60', '2018-09-16 22:45:59', '2018-09-16 22:45:59', 2, ''),
(32, 'Dr.Ei', 'ei@mail.com', '959765433', '1980-03-07', 'Yangon', 1, '1ee2225a0118c6a8ff464cf2926cf352', '2018-09-16 22:48:06', '2018-09-16 22:48:06', 2, ''),
(33, 'Dr.Mgmg', 'mgmg@mail.com', '9594238492', '1979-04-06', 'slfsldf', 0, 'ab7057eed74eef5e9f230a27af9788c2', '2018-09-16 22:49:51', '2021-01-25 11:19:02', 2, ''),
(34, 'Ma Yu Wah', '', '09966849884', '1999-06-15', 'North Dagon', 1, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 21:47:53', '2021-01-16 21:47:53', 6, ''),
(35, 'Ma Yu Wah', '', '09966849884', '1999-06-15', 'North Dagon', 1, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 21:50:02', '2021-01-16 22:12:33', 6, ''),
(37, 'Aye Mying', '', '09 966 849884', '2017-01-31', 'Insein', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:13:35', '2021-01-16 22:41:39', 6, ''),
(38, 'kaung kaung', '', '09966849884', '2012-02-14', 'Yangon', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:23:23', '2021-01-16 22:23:23', 6, ''),
(39, 'kaung kaung', '', '09966849884', '2012-02-14', 'Yangon', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:33:36', '2021-01-16 22:33:36', 6, ''),
(40, 'kaung kaung', 'undefined', '09966849884', '0000-00-00', 'Yangon', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:37:13', '2021-01-16 22:37:13', 6, ''),
(41, 'kaung kaung', '', '09966849884', '2012-02-14', 'Yangon', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:39:30', '2021-01-16 22:39:30', 6, ''),
(42, 'cvd', '', '42342342', '2020-12-29', 'fsdfsd', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:40:17', '2021-01-16 22:40:17', 6, ''),
(43, 'dfdf', '', '33123', '2021-01-14', 'dsfs', 1, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:42:27', '2021-01-16 22:42:27', 6, ''),
(44, 'dfdf', '', '33123', '2021-01-14', 'dsfs', 1, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:46:36', '2021-01-16 22:46:36', 6, ''),
(45, 'erewer', '', '323423', '2021-01-06', 'dfsdfs', 1, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:48:33', '2021-01-16 22:48:33', 6, ''),
(46, 'Ma Yu Wah', '', '42342', '2021-01-14', 'rwesdasd', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-16 22:50:56', '2021-01-16 22:50:56', 6, ''),
(47, 'Paing Ta Kon', 'ptk@mail.com', '342342342', '2000-08-30', 'Yangon', 0, 'a5e838089bee858c96d3f56fb39a8b10', '2021-01-21 11:53:53', '2021-01-21 11:53:53', 1, ''),
(48, 'ywkt', 'ywkt@mail.com', '31223423424', '2000-01-03', 'yangon', 1, '8339f6d1f8ce261d431406774995b7a8', '2021-01-23 18:29:47', '2021-01-25 11:09:39', 3, ''),
(49, 'abc', 'abc@mail.com', '42342', '1990-07-23', 'yangon', 1, '900150983cd24fb0d6963f7d28e17f72', '2021-01-24 00:05:39', '2021-01-24 00:05:39', 1, ''),
(53, 'Patient 1', '', '95933442211', '1998-04-20', 'Mandalay', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-25 11:33:11', '2021-01-25 11:33:11', 6, ''),
(54, 'Khin May Aye', '', '09966849884', '1980-05-11', 'Pyay', 1, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-25 22:22:53', '2021-01-25 22:22:53', 6, ''),
(55, 'Dr.Zaw Wai Soe', 'zaw@mail.com', '95345345', '1953-06-08', 'Yangon', 0, '5ee77659d2b94f7c3ae493aa2ccdddee', '2021-01-26 13:39:25', '2021-01-26 13:44:18', 2, ''),
(57, 'Dr. Khin Khin', 'khin@mail.com', '9405340', '1960-05-07', 'Hlaing', 1, '08675b18feea16df428363406810d903', '2021-01-26 13:47:53', '2021-01-26 13:47:53', 2, ''),
(58, 'Dr.Mya Thida', 'mya@mail.com', '34534534', '1960-06-07', 'Yangon', 1, '1762a61f123709ba30f65f09e730accd', '2021-01-26 13:55:01', '2021-01-26 13:55:01', 2, ''),
(59, 'Dr.Thet Lwin', 'thet@mail.com', '34242342', '1980-05-06', 'abc', 0, 'b9433bf54ec4a98e6f3f473c06d31926', '2021-01-26 13:58:23', '2021-01-26 13:58:23', 2, ''),
(60, 'Dr.Thet Lwin', 'thet@mail.com', '34242342', '1980-05-06', 'abc', 0, 'b9433bf54ec4a98e6f3f473c06d31926', '2021-01-26 14:04:55', '2021-01-26 14:04:55', 2, ''),
(61, 'Dr.win oo', 'win@mail.com', '9340234', '0000-00-00', 'kfsdklfs', 0, '0b08bd98d279b88859b628cd8c061ae0', '2021-01-26 14:06:07', '2021-01-26 14:06:07', 2, ''),
(62, 'Dr. Thar Htet', 'thar@mail.com', '432424234', '1980-05-06', 'dfsdfs', 0, '20541d67bb1d6648368e8e91c0d9a2a0', '2021-01-26 14:13:20', '2021-01-26 14:13:20', 2, ''),
(63, 'DR.abc', 'abcd@mail.com', '34132312', '1980-06-07', 'adfsd', 0, 'e2fc714c4727ee9395f324cd2e7f331f', '2021-01-26 14:16:15', '2021-01-26 14:16:15', 2, ''),
(64, 'DR.abc', 'abcd@mail.com', '34132312', '0000-00-00', 'adfsd', 0, 'e2fc714c4727ee9395f324cd2e7f331f', '2021-01-26 14:26:14', '2021-01-26 14:26:14', 2, ''),
(65, 'Dr. Mu Mu', 'mu@mail.com', '42342424', '1980-05-06', 'abcsdfsdf', 0, '89aa4b196b48c8a13a6549bb1eaebd80', '2021-01-26 14:28:44', '2021-01-26 14:28:44', 2, ''),
(66, 'sdfsd', 'sopykt@gmail.com', '34234', '1975-06-07', 'sdfs', 1, '900150983cd24fb0d6963f7d28e17f72', '2021-01-26 14:30:16', '2021-01-26 14:30:16', 2, ''),
(67, 'wrwdsa', 'abc@mail.com', '333312', '1990-05-06', 'sdfsdf', 0, '900150983cd24fb0d6963f7d28e17f72', '2021-01-26 14:32:57', '2021-01-26 14:32:57', 2, ''),
(68, 'DR.abc', 'abcd@mail.com', '34132312', '0000-00-00', 'adfsd', 0, 'e2fc714c4727ee9395f324cd2e7f331f', '2021-01-26 14:33:29', '2021-01-26 14:33:29', 2, ''),
(69, 'fdsfsdf', 'sdfsdf@mail.com', '2342342', '1990-06-07', 'sdfsd', 0, '900150983cd24fb0d6963f7d28e17f72', '2021-01-26 14:47:39', '2021-01-26 14:47:39', 2, ''),
(70, 'dfsd', '', '45343', '1990-04-06', 'sdfsf', 1, '900150983cd24fb0d6963f7d28e17f72', '2021-01-26 17:50:19', '2021-01-26 17:50:19', 2, ''),
(71, 'dfsd', 'sdfs@mail.com', '45343', '1990-04-06', 'sdfsf', 1, '900150983cd24fb0d6963f7d28e17f72', '2021-01-26 17:50:35', '2021-01-26 17:50:35', 2, ''),
(72, 'admin1_test', 'admin1@mail.com', '1234567', '1999-01-16', 'Yangon', 0, '098f6bcd4621d373cade4e832627b4f6', '2021-01-26 17:50:54', '2021-01-26 17:50:54', 2, ''),
(73, 'ttttt', 'ttt@mail.com', '4343424', '1980-05-06', 'fsdf', 1, '9990775155c3518a0d7917f7780b24aa', '2021-01-26 18:03:01', '2021-01-26 18:03:01', 2, ''),
(74, 'dsfsdfsd', 'ddd@mail.com', '34234324', '1980-06-07', 'err', 1, '77963b7a931377ad4ab5ad6a9cd718aa', '2021-01-26 18:07:57', '2021-01-26 18:07:57', 2, ''),
(75, 'Dr. ee sdf', 'eee@mail.com', '42342', '1980-04-08', 'Taungyi', 0, 'd2f2297d6e829cd3493aa7de4416a18f', '2021-01-26 18:15:36', '2021-01-26 18:16:41', 2, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`did`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid_idx` (`uid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `did` (`did`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `userid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `did` FOREIGN KEY (`did`) REFERENCES `doctor` (`did`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pid` FOREIGN KEY (`pid`) REFERENCES `patient` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `role` (`role`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
