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
-- Table structure for table `ticket_machine`
--

CREATE TABLE IF NOT EXISTS `ticket_machine` (
  `serial_number` varchar(50) NOT NULL,
  `reg_date` date NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `phone_number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_machine`
--

INSERT INTO `ticket_machine` (`serial_number`, `reg_date`, `user_name`, `phone_number`) VALUES
('01258792ASDG236', '2015-11-02', 'Malith', '94713535362');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket_machine`
--
ALTER TABLE `ticket_machine`
 ADD PRIMARY KEY (`serial_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
