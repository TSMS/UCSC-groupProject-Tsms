-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2015 at 10:04 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `invalid_messages`
--

CREATE TABLE IF NOT EXISTS `invalid_messages` (
`mid` int(6) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `invalid_messages`
--

INSERT INTO `invalid_messages` (`mid`, `phone_number`, `message`) VALUES
(1, '2147483647', 'hgsr hjk'),
(2, '94713535362', 'hgsr hjk'),
(3, '94713535362', 'hgsr hjk'),
(4, '94713535362', 'hgsr hjk'),
(5, '94713535362', 'hgsr hjk'),
(6, '94713535362', 'hgsr hjk'),
(7, '94713535362', 'hgsr hjk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invalid_messages`
--
ALTER TABLE `invalid_messages`
 ADD PRIMARY KEY (`mid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invalid_messages`
--
ALTER TABLE `invalid_messages`
MODIFY `mid` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
