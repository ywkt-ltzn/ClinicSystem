-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2021 at 12:26 PM
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
(1, 9, 'M.B.,B.S(YGN), M.Med.,Sc(Micro)', 'Neurologist(UK)', '', '2018-09-12 15:22:04', '2021-01-24 21:07:55', 0, 0, 0, 1, 1, 1, 1, '02:37:55', '02:37:55'),
(10, 17, 'M.B.,B.S , M.R.C.P(UK),M.Med.Sc', 'Surgery(Neuro)', '', '2018-09-12 22:37:16', '2021-01-24 21:48:38', 1, 1, 0, 0, 0, 0, 1, '09:00:00', '11:30:00'),
(12, 28, 'MBBS', 'Pathyo', '', '2018-09-16 22:27:21', '2018-09-16 22:27:21', 0, 0, 1, 1, 0, 0, 0, '13:00:00', '00:00:00'),
(13, 29, 'MBBS', 'OG', 'test', '2018-09-16 22:32:13', '2018-09-16 22:32:13', 1, 1, 0, 0, 0, 0, 0, '10:30:00', '11:30:00'),
(14, 30, 'MBBS', 'Bone', '', '2018-09-16 22:34:35', '2018-09-16 22:34:35', 0, 1, 0, 1, 0, 0, 0, '11:30:00', '13:00:00'),
(15, 31, 'M.B.B.s', 'Child', '', '2018-09-16 22:45:59', '2018-09-16 22:45:59', 0, 0, 0, 0, 1, 1, 0, '11:10:00', '12:00:00'),
(16, 32, 'M.BBS', 'Child', '', '2018-09-16 22:48:06', '2018-09-16 22:48:06', 0, 0, 0, 0, 1, 0, 0, '11:00:00', '13:00:00'),
(17, 33, 'M.B.B.Sc, M.Med,Sc (Child)', 'general care', '', '2018-09-16 22:49:51', '2021-01-25 11:19:02', 0, 1, 1, 1, 0, 0, 0, '07:00:00', '08:30:00');

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
(4, 22, '00000001', 'B', '150', 160, '2018-09-14 06:47:50', '2018-09-14 06:47:50'),
(7, 25, '00000003', 'O', '230', 150, '2018-09-14 07:51:00', '2018-09-14 13:33:53'),
(8, 26, '00000004', 'O', '230', 150, '2018-09-14 13:34:43', '2018-09-14 13:34:43'),
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
(21, 53, '00000017', 'AB', '110', 140, '2021-01-25 11:33:11', '2021-01-25 11:33:11');

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
(9, 'admin1_test', 'admin1@mail.com', '1234567', '1999-01-13', 'Yangon', 0, 'e00cf25ad42683b3df678c61f42c6bda', '2018-09-11 06:58:04', '2021-01-24 21:07:55', 2, ''),
(17, 'Dr. Soe tk test', 'sopykt@gmail.com', '222333444', '1990-06-07', 'Yangon Insein', 0, '7088660367c0304ff51a5c8b97f809ac', '2018-09-12 22:37:16', '2021-01-24 21:48:38', 2, ''),
(22, 'U Hla', '', '222333444', '1984-09-11', 'Yangon', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2018-09-14 06:47:50', '2018-09-14 06:47:50', 6, ''),
(25, 'Dr. Soe tk', 'sopykt@gmail.com', '222333444', '0000-00-00', 'Yangon', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2018-09-14 06:54:28', '2021-01-24 17:13:32', 2, ''),
(26, 'Prof. Htoo Han', 'htoohan@gmail.com', '222333444', '1984-09-12', 'Yangon', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2018-09-14 13:34:43', '2021-01-24 17:28:57', 2, ''),
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
(53, 'Patient 1', '', '95933442211', '1998-04-20', 'Mandalay', 0, 'd41d8cd98f00b204e9800998ecf8427e', '2021-01-25 11:33:11', '2021-01-25 11:33:11', 6, '');

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
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
