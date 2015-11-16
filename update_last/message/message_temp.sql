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
-- Table structure for table `message_temp`
--

CREATE TABLE IF NOT EXISTS `message_temp` (
`message_id` int(7) NOT NULL,
  `supplier_code` varchar(4) NOT NULL,
  `message_code` varchar(8) NOT NULL,
  `value` int(5) NOT NULL,
  `quantity` int(4) NOT NULL,
  `category` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `approve` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `message_temp`
--

INSERT INTO `message_temp` (`message_id`, `supplier_code`, `message_code`, `value`, `quantity`, `category`, `date`, `time`, `approve`) VALUES
(36, '0001', 'fer', 0, 20, 'gfd', '2015-10-10', '21:21:25', 0),
(37, '0001', 'adv', 3000, 0, '', '2015-10-10', '21:22:33', 0),
(38, '0001', 'adv', 20, 0, '', '2015-10-10', '21:40:15', 0),
(69, '0001', 'adv', 34, 0, '', '2015-10-16', '07:19:40', 0),
(70, '0001', 'adv', 34, 0, '', '2015-10-16', '07:20:41', 0),
(71, '0001', 'adv', 34, 0, '', '2015-10-16', '07:21:02', 0),
(72, '0001', 'adv', 340, 0, '', '2015-10-22', '10:03:41', 0),
(73, '0001', 'che', 0, 10, 'chemical', '2015-10-22', '11:20:19', 0),
(74, '0001', 'che', 0, 10, 'chemical', '2015-10-22', '11:28:43', 0),
(75, '0001', 'che', 0, 10, 'chemical', '2015-10-22', '11:29:12', 0),
(76, '0001', 'adv', 1000, 0, '', '2015-11-02', '11:22:24', 0),
(77, '0001', 'adv', 1000, 0, '', '2015-11-02', '11:24:02', 0),
(78, '0001', 'adv', 200, 0, '', '2015-11-02', '12:28:09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message_temp`
--
ALTER TABLE `message_temp`
 ADD PRIMARY KEY (`message_id`), ADD KEY `message_code` (`message_code`), ADD KEY `supplier_code` (`supplier_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message_temp`
--
ALTER TABLE `message_temp`
MODIFY `message_id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `message_temp`
--
ALTER TABLE `message_temp`
ADD CONSTRAINT `message_temp_ibfk_1` FOREIGN KEY (`message_code`) REFERENCES `message_info` (`message_code`),
ADD CONSTRAINT `message_temp_ibfk_2` FOREIGN KEY (`supplier_code`) REFERENCES `suppliers` (`supplier_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
