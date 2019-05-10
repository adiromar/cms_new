-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2018 at 12:29 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_tables`
--

CREATE TABLE `cms_tables` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `fields` text NOT NULL,
  `types` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_tables`
--

INSERT INTO `cms_tables` (`id`, `title`, `fields`, `types`) VALUES
(7, 'Test', 'a,b,c', 'VARCHAR,radio1,checkbox1'),
(9, 'Profile', 'Firstname,Lastname,Gender,Interests,City', 'VARCHAR,VARCHAR,radio1,checkbox1,dropdown1'),
(10, 'Interests', 'interests', 'VARCHAR'),
(11, 'wr3qr3', 'erf3r3w,w3rw3,w3r3w3r,wr3wr,wr3ww3,w3r3wr3wr3wr3wr', 'INT,VARCHAR,TEXT,radio1,checkbox1,dropdown1');

-- --------------------------------------------------------

--
-- Table structure for table `cms_values`
--

CREATE TABLE `cms_values` (
  `id` int(11) NOT NULL,
  `tableid` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `vals` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_values`
--

INSERT INTO `cms_values` (`id`, `tableid`, `name`, `vals`) VALUES
(12, 7, 'radio1', 'add|abb'),
(13, 7, 'checkbox1', 'aaa|sad'),
(16, 9, 'radio1', 'M|F'),
(17, 9, 'checkbox1', 'Sports|Study'),
(18, 9, 'dropdown1', 'Ktm|Bkt'),
(19, 11, 'radio1', 'wr|wrw'),
(20, 11, 'checkbox1', 'w3r3wrwr3w3r|3wrw3r3wr'),
(21, 11, 'dropdown1', 'wrwv r3wr |3wr w3rw3 ');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(9) NOT NULL,
  `interests` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `interests`) VALUES
(1, 'uybyu');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(9) NOT NULL,
  `Firstname` varchar(200) NOT NULL,
  `Lastname` varchar(200) NOT NULL,
  `Gender` varchar(200) NOT NULL,
  `Interests` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `Firstname`, `Lastname`, `Gender`, `Interests`, `City`) VALUES
(1, 'Nikhil', 'Dhakal', 'on', 'on', 'Bkt'),
(2, 'adawd', 'asdawdwa', 'on', 'on', 'Bkt'),
(3, 'adwadwad', 'awdwadwad', 'M', 'Study', 'Ktm'),
(4, '', '', '', 'Study', ''),
(5, '', '', 'M', 'Study', ''),
(6, 'Aditya', 'Bhattarai', 'M', 'Sports|_|Study', 'Ktm'),
(7, 'test', 'tests', 'F', 'Study', 'Ktm');

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `id` int(20) NOT NULL,
  `primary_table` varchar(100) NOT NULL,
  `primary_key` varchar(100) NOT NULL,
  `sec_table` varchar(100) NOT NULL,
  `sec_key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(9) NOT NULL,
  `a` varchar(200) NOT NULL,
  `b` varchar(200) NOT NULL,
  `c` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `a`, `b`, `c`) VALUES
(1, 'adwdwad', 'on', 'on'),
(2, 'adwadawdwad', 'on', 'on'),
(3, 'dwadawdwad', 'on', 'on'),
(4, 'adwadwadwadwadwad', 'on', 'on'),
(5, 'qwdwqdwq', 'on', 'on'),
(6, 'WDWDWD', 'on', 'on'),
(7, 'adwadaw', 'on', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `wr3qr3`
--

CREATE TABLE `wr3qr3` (
  `id` int(9) NOT NULL,
  `erf3r3w` int(20) NOT NULL,
  `w3rw3` varchar(200) NOT NULL,
  `w3r3w3r` text NOT NULL,
  `wr3wr` varchar(200) NOT NULL,
  `wr3ww3` varchar(200) NOT NULL,
  `w3r3wr3wr3wr3wr` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wr3qr3`
--

INSERT INTO `wr3qr3` (`id`, `erf3r3w`, `w3rw3`, `w3r3w3r`, `wr3wr`, `wr3ww3`, `w3r3wr3wr3wr3wr`) VALUES
(1, 0, 'efef', 'esfefe', 'wr', 'w3r3wrwr3w3r', '3wr w3rw3 ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_tables`
--
ALTER TABLE `cms_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_values`
--
ALTER TABLE `cms_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tableid` (`tableid`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wr3qr3`
--
ALTER TABLE `wr3qr3`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_tables`
--
ALTER TABLE `cms_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cms_values`
--
ALTER TABLE `cms_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `wr3qr3`
--
ALTER TABLE `wr3qr3`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cms_values`
--
ALTER TABLE `cms_values`
  ADD CONSTRAINT `cms_values_ibfk_1` FOREIGN KEY (`tableid`) REFERENCES `cms_tables` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
