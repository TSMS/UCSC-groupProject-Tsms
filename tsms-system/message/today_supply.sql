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
-- Table structure for table `today_supply`
--

CREATE TABLE IF NOT EXISTS `today_supply` (
  `supplier_code` varchar(8) NOT NULL,
  `date` date NOT NULL,
  `approved_kgs` int(11) NOT NULL,
  `supplied_kgs` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `editer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `today_supply`
--

INSERT INTO `today_supply` (`supplier_code`, `date`, `approved_kgs`, `supplied_kgs`, `units`, `editer`) VALUES
('0001', '2015-11-02', 20, 0, 0, '01258792ASDG236'),
('0002', '2015-11-02', 12, 23, 4, 'Hematha Disanayaka'),
('0004', '2015-11-02', 67, 80, 6, 'Hematha Disanayaka'),
('0005', '2015-11-02', 23, 32, 4, 'Hematha Disanayaka'),
('0006', '2015-11-02', 70, 90, 5, 'Hematha Disanayaka'),
('0009', '2015-11-02', 23, 54, 3, 'Hematha Disanayaka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `today_supply`
--
ALTER TABLE `today_supply`
 ADD PRIMARY KEY (`supplier_code`), ADD KEY `editer` (`editer`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
