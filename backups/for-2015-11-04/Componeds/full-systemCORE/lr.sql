-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2015 at 10:02 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `daily_supply`
--

INSERT INTO `daily_supply` (`id`, `date`, `supplier_code`, `approved_kgs`, `supplied_kgs`, `units`, `editor`, `approved_by`, `last_editor`, `last_edit_date`) VALUES
(1, '2015-10-17', '0001', 76, 80, 3, 'admin', 'admin', '', 0),
(2, '2015-02-21', '0001', 110, 0, 5, '', '', '', 0),
(3, '2015-02-01', '0001', 26, 28, 1, '', '', '', 0);

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
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_code` varchar(8) NOT NULL,
  `f_name` varchar(32) NOT NULL,
  `l_name` varchar(32) NOT NULL,
  `address_1` varchar(40) NOT NULL,
  `address_2` varchar(40) NOT NULL,
  `nic_no` varchar(10) NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `e_mail` varchar(40) NOT NULL,
  `birth_day` date NOT NULL,
  `Gender` varchar(4) NOT NULL,
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
  PRIMARY KEY (`supplier_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_code`, `f_name`, `l_name`, `address_1`, `address_2`, `nic_no`, `mobile_no`, `phone_no`, `e_mail`, `birth_day`, `Gender`, `estate_name`, `reg_no`, `size_of_estate`, `address_of_estate`, `account_name`, `account_no`, `bank`, `branch`, `e_mail_send`, `sms_send`, `last_edit_date`, `editor`) VALUES
('0001', 'Malith', 'dilshan', 'rubberwatta', 'boraluwage aina', '932310562V', '0712 097337', '0457 900373', 'mdw@gmail.com', '1978-07-07', '', 'rubberwatta', 'teare00785245', '4 acr', 'rubberwatta,buthkanda', 'W.A.M Dilshan', '72160858', 'BOC', 'deniyaya', 1, 0, '30/07/2015', 'malith'),
('32-df', 'kripala', 'sumane', 'sdgsd', 'gsdg', '23235235', '23523523', '2235325', 'fdsf@gmail.com', '1982-12-12', '', 'sdg', '52345v', '235', 'sdg', 'wweg', '', 'sdgsg', '2352352', 1, 1, '', ''),
('56rtrt', 'Hemantha', 'fgdf', 'sggs', 'sdgdsg', '3646436', '235235', '34524352', 'sdgs@gmail.com', '1995-02-02', '', 'wer', '252f', '25', 'wtwet', 'fsd', '', 'sgsd', 'dsfsdg', 1, 1, '', ''),
('ds-12', 'errrr', 'qwwww', 'weerrr', 'weerrr', '2342341232', '234234', '23423423', 'sfgdsd@sdf.com', '0000-00-00', '-- -', 'wr', '234', '', '', '234', '531', '1245', '', 0, 0, '2015-10-21', 'no-editor-yet'),
('ts-34', 'Hemantha', 'Wige', 'kegala 23 sa', 'kegala 23 sa2', '9112354345', '0711762541', '0771762541', 'hemantha@gmail.com', '1991-09-02', '', 'hema', 'he-735', '543', 'hema kegalla', 'bantu', '273653223432', 'HSCB', 'dehiwala', 1, 1, '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `today_service`
--

CREATE TABLE IF NOT EXISTS `today_service` (
  `date` date NOT NULL,
  `sup_code` varchar(8) NOT NULL,
  `loan_code` varchar(4) NOT NULL,
  `unit_price` double NOT NULL,
  `units` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `no_of_installment` int(11) NOT NULL,
  `amount_of_installment` double NOT NULL,
  `description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `image` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `name`, `nic`, `joined`, `gender`, `phone`, `groups`, `user_approved`, `progressbar`, `image`) VALUES
(5, 'thusitha', '5f41b4464d99c25484dfe2de81e242b6993bd92ff8a308ed843284b586e2a8a9', 'ÝGÂdô”\ZihFrÿn|.å—Û\\àº®\\ïG°‘æ', 'thusitha.4t@gmail.com', 'I.P.V.T.P.M. Jayalath', '921401232v', '2015-10-04 12:26:19', 'Male', 0, 1, '1', 55, 'images/profile.jpg'),
(6, 'pawan', 'aad1b620a763df571367087b019548a2bc6e60bdfc0331b2495cf3afa3f1229f', 'µóIðŽ	—ÐÈ¡Š£QÿG¥¾{ÕqjËª|K–nõ', 'pawan@gmail.com', 'pawan kumara', '46364573', '2015-10-08 10:11:07', 'Male', 0, 1, '2', 60, ''),
(10, 'admin', '3c87fce7b9db136b22941051ddbe879b47184396564112576b15de70e02ffff1', 'F7ŸËÐpNZ™„j½ô’{Ä$†ð˜°³„áž%½n', 'admin@gmail.com', 'Hematha Disanayaka Bandara', '9211112321', '2015-10-06 18:06:22', 'Male', 991281272, 2, '2', 88, 'images/hemantha.png'),
(12, 'Malith', '6ec8436e0bdad119bfc7a1da4b263f84cd82cd70897e01c55b3bd992608cc43e', 'PÂ|3Ü8·3y¹Égt²\Z,ëëÙöçÿãïhhž…S&Ô', 'Malith@gmail.com', 'Malith Dilshan', '932352355v', '2015-10-26 10:00:25', 'Male', 781242142, 1, '1', 0, '');

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
