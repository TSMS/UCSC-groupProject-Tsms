-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2015 at 07:31 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lr`
--
CREATE DATABASE IF NOT EXISTS `lr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lr`;

-- --------------------------------------------------------

--
-- Table structure for table `daily_supply`
--

CREATE TABLE IF NOT EXISTS `daily_supply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `supplier_code` varchar(8) NOT NULL,
  `approved_kgs` int(11) NOT NULL,
  `supplied_kgs` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `editor` varchar(50) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `last_editor` varchar(50) NOT NULL,
  `last_edit_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `daily_supply`
--

INSERT INTO `daily_supply` (`id`, `date`, `supplier_code`, `approved_kgs`, `supplied_kgs`, `units`, `editor`, `approved_by`, `last_editor`, `last_edit_date`) VALUES
(1, '2015-10-17', '0001', 76, 80, 3, 'admin', 'admin', '', 0),
(2, '2015-02-21', '0002', 110, 0, 5, '', '', '', 0),
(3, '2015-02-01', '0004', 26, 28, 1, '', '', '', 0),
(4, '2015-09-09', '0001', 1000, 0, 0, '', '', '', 0),
(5, '2015-08-11', '0001', 870, 0, 0, '', '', '', 0),
(6, '2015-07-14', '0001', 570, 0, 0, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', ''),
(2, 'Administrator', '{"admin": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `invalid_messages`
--

CREATE TABLE IF NOT EXISTS `invalid_messages` (
  `mid` int(6) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invalid_messages`
--

INSERT INTO `invalid_messages` (`mid`, `phone_number`, `message`) VALUES
(1, '2147483647', 'hgsr hjk'),
(2, '94713535362', 'hgsr hjk'),
(3, '94713535362', 'hgsr hjk'),
(4, '94713535362', 'hgsr hjk'),
(5, '94713535362', 'hgsr hjk'),
(6, '94713535362', 'hgsr hjk');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(33) NOT NULL,
  `text` text NOT NULL,
  `read` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `supplier_code`, `text`, `read`) VALUES
(1, '0010', '4 43 64', '0'),
(2, '0009', '3 23 54', '1'),
(3, '0002', '3 78 78', '0'),
(4, '0004', '6 23 34', '0'),
(5, '0001', '5 78 80', '0'),
(6, '0006', '5 70 90', '0'),
(7, '0007', '3 60 71', '1');

-- --------------------------------------------------------

--
-- Table structure for table `message_info`
--

CREATE TABLE IF NOT EXISTS `message_info` (
  `message_code` varchar(4) NOT NULL,
  `request` varchar(25) NOT NULL,
  `max_value` varchar(10) NOT NULL,
  `unit_price` varchar(10) NOT NULL,
  `catagory` varchar(25) NOT NULL,
  PRIMARY KEY (`message_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_info`
--

INSERT INTO `message_info` (`message_code`, `request`, `max_value`, `unit_price`, `catagory`) VALUES
('adv', 'advance', '', '', ''),
('bil', 'bills', '', '', ''),
('che', 'chemical', '', '', ''),
('fer', 'fertilizer', '', '', 'C828'),
('lon', 'loan', '', '', ''),
('tea', 'tea packets', '', '', '');

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
  `approve` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `message_temp`
--

INSERT INTO `message_temp` (`message_id`, `supplier_code`, `message_code`, `value`, `quantity`, `category`, `date`, `time`, `approve`, `id`) VALUES
(36, '0001', 'fer', 0, 20, 'gfd', '2015-10-10', '21:21:25', 0, 1),
(37, '0002', 'adv', 3000, 0, '', '2015-10-10', '21:22:33', 1, 2),
(38, '0003', 'adv', 20, 0, '', '2015-10-10', '21:40:15', 0, 3),
(69, '0004', 'adv', 34, 0, '', '2015-10-16', '07:19:40', 0, 4),
(70, '0005', 'adv', 34, 0, '', '2015-10-16', '07:20:41', 0, 5),
(71, '0006', 'adv', 34, 0, '', '2015-10-16', '07:21:02', 0, 6),
(72, '0007', 'adv', 340, 0, '', '2015-10-22', '10:03:41', 0, 7),
(73, '0008', 'che', 0, 10, 'chemical', '2015-10-22', '11:20:19', 0, 8),
(74, '0009', 'che', 0, 10, 'chemical', '2015-10-22', '11:28:43', 0, 9),
(75, '0001', 'che', 0, 10, 'chemical', '2015-10-22', '11:29:12', 0, 10),
(76, '0001', 'adv', 1000, 0, '', '2015-11-02', '11:22:24', 0, 11),
(77, '0001', 'adv', 1000, 0, '', '2015-11-02', '11:24:02', 0, 12),
(78, '0001', 'adv', 200, 0, '', '2015-11-02', '12:28:09', 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `approx_rate` int(11) NOT NULL,
  `editor` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `date`, `approx_rate`, `editor`) VALUES
(1, '2015-10-01', 80, 'hemantha'),
(2, '2015-11-01', 65, 'hemantha');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(8) NOT NULL,
  `f_name` varchar(32) NOT NULL,
  `l_name` varchar(32) NOT NULL,
  `address_1` varchar(40) NOT NULL,
  `nic_no` varchar(10) NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `e_mail` varchar(40) NOT NULL,
  `joined` datetime NOT NULL,
  `gender` varchar(6) NOT NULL,
  `estate_name` varchar(50) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  `size_of_estate` varchar(40) NOT NULL,
  `address_of_estate` varchar(60) NOT NULL,
  `account_name` varchar(60) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `bank` varchar(40) NOT NULL,
  `branch` varchar(40) NOT NULL,
  `e_mail_send` tinyint(1) NOT NULL,
  `sms_send` tinyint(1) NOT NULL,
  `last_edit_date` varchar(10) NOT NULL,
  `editor` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_code`, `f_name`, `l_name`, `address_1`, `nic_no`, `mobile_no`, `e_mail`, `joined`, `gender`, `estate_name`, `reg_no`, `size_of_estate`, `address_of_estate`, `account_name`, `account_no`, `bank`, `branch`, `e_mail_send`, `sms_send`, `last_edit_date`, `editor`) VALUES
(32, '0001', 'Kumara', 'Welgama', '''kumara'', gonakola, puwak handiya, deniy', '812363829V', '0777123782', 'kumara@gmail.com', '0000-00-00 00:00:00', 'male', 'NULL', 'NULL', 'address_of_estate', '', 'Kumara', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(33, '0002', 'Malade', 'Kumarihami', 'Mlage, namara, gonakula, deniyaya.', '8812321421', '0229343224', 'malage@gmail.com', '0000-00-00 00:00:00', 'female', 'NULL', 'NULL', 'NULL', 'NULL', 'Malade', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(35, '0003', 'Amaradasa', 'Kodithuwakku', '89, Wele, sanunuwara, deniyaya', '8912141433', '0712324242', 'kumari@gmail.com', '0000-00-00 00:00:00', 'male', 'NULL', 'NULL', 'NULL', 'NULL', 'Amaradasa', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(36, '0004', 'sarampa', 'kudagamage', '73, hamaha, deniyaya, kudagama', '901231233v', '0781232134', 'hya@ymail.com', '2015-11-11 00:00:00', 'male', 'NULL', 'NULL', 'NULL', 'NULL', 'sarampa', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(37, '0005', 'marawathi', 'nanayakkara', '89, wasamapara, deniyaya, vistharma.', '671212323V', '0123232312', 'nomail@ganak.com', '2015-11-05 00:00:00', 'female', 'NULL', 'NULL', 'NULL', 'NULL', 'marawathi', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(38, '0006', 'Malith', 'Dilshan', 'Malith, kumarasinga mawatha, deniyaya.', '931324123V', '0781232346', 'malith@gmail.com', '2015-11-03 06:16:19', 'male', 'NULL', 'NULL', 'NULL', 'NULL', 'Malith', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(39, '0007', 'Madhushika', 'Rajapaksha', 'Madhu-92 , Nugavela, katugasthota, Kandy', '9723412351', '0712193750', 'mashuwanth@yahoo.com', '2015-11-11 03:20:14', 'female', 'NULL', 'NULL', 'NULL', 'NULL', 'Madhushika', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(40, '0008', 'Sahanpala', 'Jayawardana', 'No 78, Sahanamawataha, kadana, kokahena.', '78123442v', '0777234234', 'saana@mail.com', '2015-11-19 00:14:22', 'male', 'NULL', 'NULL', 'NULL', 'NULL', 'Sahanpala', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(41, '0012', 'Dmaya', 'jayalath', 'No 60, rivasaide, gonakula, deniyaya', '941221422V', '0712132142', 'damaya@hotmail.com', '0000-00-00 00:00:00', 'female', 'NULL', 'NULL', 'NULL', 'NULL', 'Dmaya', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(42, '0009', 'Parami', 'Jyasinghe', 'Colombo road, mifihana, hithachiya.', '932163424v', '0772734323', 'Prami.cmo@has.com', '0000-00-00 00:00:00', 'female', 'NULL', 'NULL', 'NULL', 'NULL', 'Parami', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(43, '0010', 'Parami', 'Jyasinghe', 'Colombo road, mifihana, hithachiya.', '932163424v', '0772734323', 'Prami.cmo@has.com', '2015-11-11 07:23:37', 'female', 'NULL', 'NULL', 'NULL', 'NULL', 'Parami', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30', 'Hematha Disanayaka'),
(44, '0999', 'hashini ', 'disanakaye', 'No 90, jajsgs, gahalana kaocba.', '932136212v', '0777125321', 'hashi@h.com', '0000-00-00 00:00:00', 'female', 'NULL', 'NULL', 'NULL', 'NULL', 'hashini ', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-11-03', 'Hematha Disanayaka'),
(46, '0030', 'Nataliya', 'Jayawaradana', 'Colombo road, hungama, Galle.', '934324339v', '0711262536', 'Nati@hotmail.com', '0000-00-00 00:00:00', '', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'HSBC', 'Deniyaya', 0, 1, '2015-11-03', 'Hematha Disanayaka');

-- --------------------------------------------------------

--
-- Table structure for table `today_service`
--

CREATE TABLE IF NOT EXISTS `today_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `sup_code` varchar(8) NOT NULL,
  `loan_code` varchar(10) NOT NULL,
  `unit_price` double NOT NULL,
  `units` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `no_of_installment` int(11) NOT NULL,
  `amount_of_installment` double NOT NULL,
  `description` varchar(40) NOT NULL,
  `editor` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `today_service`
--

INSERT INTO `today_service` (`id`, `date`, `sup_code`, `loan_code`, `unit_price`, `units`, `total_amount`, `no_of_installment`, `amount_of_installment`, `description`, `editor`) VALUES
(1, '2015-11-03', '0005', '', 0, 0, 34, 0, 0, '                                        ', 'Hematha Disanayaka');

-- --------------------------------------------------------

--
-- Table structure for table `today_supply`
--

CREATE TABLE IF NOT EXISTS `today_supply` (
  `date` date NOT NULL,
  `supplier_code` varchar(8) NOT NULL,
  `approved_kgs` int(11) NOT NULL,
  `supplied_kgs` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `editor` varchar(50) NOT NULL,
  PRIMARY KEY (`supplier_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `today_supply`
--

INSERT INTO `today_supply` (`date`, `supplier_code`, `approved_kgs`, `supplied_kgs`, `units`, `editor`) VALUES
('2015-11-02', '0001', 48, 65, 4, 'Hematha Disanayaka'),
('2015-11-02', '0002', 12, 23, 4, 'Hematha Disanayaka'),
('2015-11-02', '0004', 67, 80, 6, 'Hematha Disanayaka'),
('2015-11-02', '0005', 23, 32, 4, 'Hematha Disanayaka'),
('2015-11-02', '0006', 70, 90, 5, 'Hematha Disanayaka'),
('2015-11-02', '0009', 23, 54, 3, 'Hematha Disanayaka');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `email` varchar(25) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nic` varchar(10) NOT NULL,
  `joined` datetime NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` int(11) NOT NULL,
  `groups` int(11) NOT NULL,
  `user_approved` text NOT NULL,
  `progressbar` int(3) NOT NULL,
  `image` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `name`, `nic`, `joined`, `gender`, `phone`, `groups`, `user_approved`, `progressbar`, `image`) VALUES
(5, 'thusitha', '5f41b4464d99c25484dfe2de81e242b6993bd92ff8a308ed843284b586e2a8a9', 'ÝGÂdô”\ZihFrÿn|.å—Û\\àº®\\ïG°‘æ', 'thusitha.4t@gmail.com', 'I.P.V.T.P.M. Jayalath', '921401232v', '2015-10-04 12:26:19', 'Male', 0, 1, '2', 55, 'dist/img/profile.jpg'),
(6, 'pawan', 'aad1b620a763df571367087b019548a2bc6e60bdfc0331b2495cf3afa3f1229f', 'µóIðŽ	—ÐÈ¡Š£QÿG¥¾{ÕqjËª|K–nõ', 'pawan@gmail.com', 'pawan kumara', '46364573', '2015-10-08 10:11:07', 'Male', 0, 1, '1', 60, ''),
(10, 'admin', '3c87fce7b9db136b22941051ddbe879b47184396564112576b15de70e02ffff1', 'F7ŸËÐpNZ™„j½ô’{Ä$†ð˜°³„áž%½n', 'admin@gmail.com', 'Hematha Disanayaka', '9211112321', '2015-10-06 18:06:22', 'Male', 991281272, 2, '2', 88, 'dist/img/hemantha.png'),
(12, 'Malith', '6ec8436e0bdad119bfc7a1da4b263f84cd82cd70897e01c55b3bd992608cc43e', 'PÂ|3Ü8·3y¹Égt²\Z,ëëÙöçÿãïhhž…S&Ô', 'Malith@gmail.com', 'Malith Dilshan', '932352355v', '2015-10-26 10:00:25', 'Male', 781242142, 1, '1', 0, 'dist/img/malith.jpg'),
(13, 'madhushika', '0cca76b36b62c26142980af561dd318aff135953c7d2cd75d874d579d4b7ade0', '¼–†:ñá¡f''I²ˆ9 8dõ+Q¶wEõ íq™á', 'madhu@gmail.com', 'madhushika rajapaksha', '', '2015-11-01 14:28:05', 'Female', 712145037, 1, '1', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_approved`
--

CREATE TABLE IF NOT EXISTS `user_approved` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `approvedd` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_approved`
--

INSERT INTO `user_approved` (`id`, `name`, `approvedd`) VALUES
(1, 'approved user', ''),
(2, 'non-approved user', '{"approved": 1}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
