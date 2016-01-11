-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2016 at 11:16 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

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
-- Table structure for table `daily_supply`
--

CREATE TABLE IF NOT EXISTS `daily_supply` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `supplier_code` varchar(8) NOT NULL,
  `approved_kgs` int(11) NOT NULL,
  `supplied_kgs` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `editor` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `last_edit_date` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_supply`
--

INSERT INTO `daily_supply` (`id`, `date`, `supplier_code`, `approved_kgs`, `supplied_kgs`, `units`, `editor`, `approved_by`, `last_editor`, `last_edit_date`) VALUES
(1, '2016-01-05', '0001', 25, 27, 1, 1, 1, 1, 2016),
(2, '2016-01-06', '0001', 30, 35, 1, 1, 1, 1, 2016),
(3, '2015-12-10', '0001', 30, 32, 2, 1, 1, 1, 2016),
(4, '2015-01-21', '0002', 65, 68, 2, 4, 3, 1, 2016),
(5, '2015-08-12', '0002', 45, 47, 2, 3, 2, 2, 2016),
(6, '2015-04-07', '0003', 78, 84, 3, 4, 3, 3, 2016),
(7, '2015-07-14', '0004', 54, 58, 2, 1, 2, 3, 2016),
(8, '2015-07-22', '0005', 96, 101, 4, 1, 3, 3, 2016),
(9, '2015-08-04', '0006', 26, 29, 1, 2, 3, 3, 2016),
(10, '2015-08-31', '0007', 49, 54, 2, 3, 4, 1, 2016),
(11, '2015-09-15', '0008', 61, 65, 2, 4, 3, 3, 2016),
(12, '2015-10-20', '0010', 89, 93, 4, 3, 3, 3, 2016),
(13, '2015-11-21', '0009', 125, 132, 5, 2, 1, 1, 2016),
(14, '2015-03-05', '0007', 45, 50, 2, 3, 1, 1, 2016),
(15, '2015-07-30', '0001', 27, 29, 1, 3, 1, 3, 2016),
(16, '2015-08-26', '0001', 98, 102, 4, 2, 4, 4, 2016),
(17, '2015-09-08', '0001', 105, 110, 4, 2, 1, 4, 2016),
(18, '2015-10-19', '0001', 82, 85, 3, 2, 1, 3, 2016),
(19, '2015-11-28', '0001', 45, 49, 2, 2, 1, 4, 2016),
(20, '2015-12-01', '0001', 65, 67, 2, 4, 1, 4, 2016),
(21, '2015-12-15', '0001', 28, 30, 1, 2, 1, 4, 2016),
(22, '2015-12-31', '0001', 32, 34, 1, 2, 3, 4, 2016),
(23, '2016-01-07', '0001', 48, 49, 2, 3, 1, 3, 2016),
(24, '2015-08-01', '0002', 56, 60, 2, 3, 4, 3, 2016),
(25, '2015-09-08', '0002', 98, 100, 4, 1, 3, 4, 2016),
(26, '2015-10-19', '0002', 45, 48, 2, 3, 2, 1, 2016),
(27, '2015-11-20', '0002', 65, 67, 3, 2, 1, 1, 2016),
(28, '2015-12-29', '0002', 79, 82, 3, 1, 2, 4, 2016),
(29, '2016-01-07', '0002', 89, 92, 4, 3, 1, 3, 2016),
(30, '2015-08-03', '0003', 76, 78, 3, 1, 4, 2, 2016),
(31, '2015-09-18', '0003', 45, 48, 2, 4, 3, 1, 2016),
(32, '2015-10-22', '0003', 65, 69, 3, 3, 2, 2, 2016),
(33, '2015-11-30', '0003', 98, 103, 4, 2, 3, 1, 2016),
(34, '2015-12-15', '0003', 72, 75, 3, 3, 2, 1, 2016),
(35, '2016-01-04', '0003', 93, 97, 4, 3, 2, 3, 2016),
(36, '2015-08-19', '0004', 61, 63, 2, 3, 4, 3, 2016),
(37, '2015-09-15', '0004', 96, 100, 4, 1, 3, 4, 2016),
(38, '2015-10-11', '0004', 41, 44, 2, 3, 2, 1, 2016),
(39, '2015-11-20', '0004', 79, 82, 3, 2, 1, 1, 2016),
(40, '2015-12-12', '0004', 71, 75, 3, 1, 2, 4, 2016),
(41, '2016-01-02', '0004', 105, 108, 4, 3, 1, 3, 2016),
(42, '2015-08-02', '0005', 94, 96, 4, 3, 4, 3, 2016),
(43, '2015-09-21', '0005', 78, 83, 3, 1, 3, 4, 2016),
(44, '2015-10-19', '0005', 40, 44, 2, 3, 2, 1, 2016),
(45, '2015-11-04', '0005', 56, 58, 2, 2, 1, 1, 2016),
(46, '2015-12-08', '0005', 79, 85, 3, 1, 2, 4, 2016),
(47, '2016-01-02', '0005', 101, 105, 4, 3, 1, 3, 2016),
(48, '2015-08-22', '0006', 104, 110, 4, 3, 4, 3, 2016),
(49, '2015-09-04', '0006', 98, 103, 4, 1, 3, 4, 2016),
(50, '2015-10-24', '0006', 78, 82, 3, 3, 2, 1, 2016),
(51, '2015-11-08', '0006', 69, 71, 3, 2, 1, 1, 2016),
(52, '2015-12-31', '0006', 56, 60, 2, 1, 2, 4, 2016),
(53, '2016-01-03', '0006', 21, 24, 1, 3, 1, 3, 2016),
(54, '2015-07-12', '0007', 96, 98, 4, 3, 4, 3, 2016),
(55, '2015-08-02', '0007', 78, 80, 3, 3, 4, 3, 2016),
(56, '2015-09-21', '0007', 95, 99, 4, 1, 3, 4, 2016),
(57, '2015-10-20', '0007', 62, 67, 2, 3, 2, 1, 2016),
(58, '2015-11-21', '0007', 52, 54, 2, 2, 1, 1, 2016),
(59, '2015-12-09', '0007', 89, 91, 4, 1, 2, 4, 2016),
(60, '2016-01-06', '0007', 28, 30, 1, 3, 1, 3, 2016),
(61, '2015-07-22', '0008', 86, 88, 3, 3, 4, 3, 2016),
(62, '2015-08-09', '0008', 58, 62, 2, 3, 4, 3, 2016),
(63, '2015-09-27', '0008', 97, 99, 4, 1, 3, 4, 2016),
(64, '2015-10-06', '0008', 80, 83, 3, 3, 2, 1, 2016),
(65, '2015-11-07', '0008', 98, 104, 4, 2, 1, 1, 2016),
(66, '2015-12-29', '0008', 86, 91, 3, 1, 2, 4, 2016),
(67, '2016-01-01', '0008', 19, 22, 1, 3, 1, 3, 2016),
(68, '2015-07-27', '0009', 92, 98, 4, 3, 4, 3, 2016),
(69, '2015-08-19', '0009', 88, 92, 3, 3, 4, 3, 2016),
(70, '2015-09-06', '0009', 75, 79, 3, 1, 3, 4, 2016),
(71, '2015-10-31', '0009', 82, 83, 3, 3, 2, 1, 2016),
(72, '2015-11-27', '0009', 71, 74, 3, 2, 1, 1, 2016),
(73, '2015-12-24', '0009', 59, 62, 2, 1, 2, 4, 2016),
(74, '2016-01-03', '0009', 29, 31, 1, 3, 1, 3, 2016),
(75, '2015-07-07', '0010', 82, 85, 3, 3, 4, 3, 2016),
(76, '2015-08-17', '0010', 98, 102, 4, 3, 4, 3, 2016),
(77, '2015-09-22', '0010', 55, 59, 2, 1, 3, 4, 2016),
(78, '2015-10-18', '0010', 67, 70, 3, 3, 2, 1, 2016),
(79, '2015-11-23', '0010', 46, 50, 2, 2, 1, 1, 2016),
(80, '2015-12-07', '0010', 95, 99, 4, 1, 2, 4, 2016),
(81, '2016-01-05', '0010', 26, 28, 1, 3, 1, 3, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `invalid_messages`
--

CREATE TABLE IF NOT EXISTS `invalid_messages` (
  `mid` int(6) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `loan_codes`
--

CREATE TABLE IF NOT EXISTS `loan_codes` (
  `loan_code` varchar(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `unit_price` double NOT NULL,
  `interest_per_month` double NOT NULL,
  `max_installments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_codes`
--

INSERT INTO `loan_codes` (`loan_code`, `name`, `unit_price`, `interest_per_month`, `max_installments`) VALUES
('adv', 'advance', 0, 0, 0),
('che', 'chemical', 500, 0, 0),
('fer', 'fertilizer', 1200, 0, 0),
('lon', 'loan', 0, 1, 100000),
('tea', 'tea packets', 500, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message_info`
--

CREATE TABLE IF NOT EXISTS `message_info` (
  `message_code` varchar(4) NOT NULL,
  `request` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_info`
--

INSERT INTO `message_info` (`message_code`, `request`) VALUES
('adv', 'advance'),
('bil', 'bills'),
('che', 'chemical'),
('fer', 'fertilizer'),
('lon', 'loan'),
('tea', 'tea packets');

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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_temp`
--

INSERT INTO `message_temp` (`message_id`, `supplier_code`, `message_code`, `value`, `quantity`, `category`, `date`, `time`, `approve`) VALUES
(36, '0006', 'fer', 0, 20, 'gfd', '2015-10-10', '21:21:25', 0),
(37, '0001', 'adv', 3000, 0, '', '2015-10-10', '21:22:33', 1),
(38, '0009', 'adv', 20, 0, '', '2015-10-10', '21:40:15', 0),
(69, '0005', 'adv', 34, 0, '', '2015-10-16', '07:19:40', 0),
(70, '0001', 'adv', 34, 0, '', '2015-10-16', '07:20:41', 0),
(71, '0006', 'adv', 34, 0, '', '2015-10-16', '07:21:02', 1),
(72, '0002', 'adv', 340, 0, '', '2015-10-22', '10:03:41', 1),
(73, '0009', 'che', 0, 10, 'chemical', '2015-10-22', '11:20:19', 0),
(74, '0001', 'che', 0, 10, 'chemical', '2015-10-22', '11:28:43', 0),
(75, '0002', 'che', 0, 10, 'chemical', '2015-10-22', '11:29:12', 0),
(76, '0001', 'adv', 1000, 0, '', '2015-11-02', '11:22:24', 1),
(77, '0004', 'adv', 1000, 0, '', '2015-11-02', '11:24:02', 1),
(78, '0004', 'adv', 200, 0, '', '2015-11-02', '12:28:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_bill`
--

CREATE TABLE IF NOT EXISTS `monthly_bill` (
  `supp_code` varchar(8) NOT NULL,
  `date` date NOT NULL,
  `total_supp_kgs` int(10) NOT NULL,
  `direct_addition` decimal(10,2) NOT NULL,
  `other_addition` decimal(10,2) NOT NULL,
  `total_income` decimal(10,2) NOT NULL,
  `last_month_debt` decimal(10,2) NOT NULL,
  `debt` decimal(10,2) NOT NULL,
  `advance` decimal(10,2) NOT NULL,
  `manure` decimal(10,2) NOT NULL,
  `tea` decimal(10,2) NOT NULL,
  `transport` decimal(10,2) NOT NULL,
  `stationary` decimal(10,2) NOT NULL,
  `stamp` decimal(10,2) NOT NULL,
  `total_subtraction` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `process_date` date NOT NULL,
  `editor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `supp_code` varchar(8) NOT NULL,
  `loan_code` varchar(8) NOT NULL,
  `category` varchar(8) NOT NULL,
  `units` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `no_of_installments` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `amount_of_installment` double NOT NULL,
  `coment` varchar(150) NOT NULL,
  `editor` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `last_edit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `approxi_tea_rate` decimal(10,2) NOT NULL,
  `fixed_tea_rate` decimal(10,2) NOT NULL,
  `max_loan_amount` decimal(10,2) NOT NULL,
  `edit_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `date`, `approxi_tea_rate`, `fixed_tea_rate`, `max_loan_amount`, `edit_by`) VALUES
(1, '2016-01-13', '55.00', '60.00', '50000.00', 1),
(2, '2015-12-09', '57.00', '62.00', '0.00', 2),
(3, '2015-11-01', '58.00', '65.00', '0.00', 1),
(6, '2015-10-02', '60.00', '65.00', '0.00', 1),
(7, '2015-09-07', '61.00', '67.00', '0.00', 1),
(8, '2015-08-03', '60.00', '65.00', '0.00', 1),
(9, '2015-07-07', '58.00', '64.00', '0.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_code` varchar(8) NOT NULL,
  `f_name` varchar(32) NOT NULL,
  `l_name` varchar(32) NOT NULL,
  `address_1` varchar(40) NOT NULL,
  `address_2` varchar(50) NOT NULL,
  `address_3` varchar(50) NOT NULL,
  `nic_no` varchar(12) NOT NULL,
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
  `last_edit_date` datetime NOT NULL,
  `editor` int(11) NOT NULL,
  `user_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_code`, `f_name`, `l_name`, `address_1`, `address_2`, `address_3`, `nic_no`, `mobile_no`, `e_mail`, `joined`, `gender`, `estate_name`, `reg_no`, `size_of_estate`, `address_of_estate`, `account_name`, `account_no`, `bank`, `branch`, `e_mail_send`, `sms_send`, `last_edit_date`, `editor`, `user_pass`) VALUES
('0001', 'Kumara', 'Welgama', '''kumara'', gonakola, puwak handiya, deniy', '', '', '812363829V', '0777123782', 'kumara@gmail.com', '2016-01-06 00:00:00', 'male', '', '', 'address_of_estate', '', 'Kumara', '', 'HSBC', 'Deniyaya', 0, 1, '2015-10-30 00:00:00', 1, 'e10adc3949ba59abbe56e057f20f883e'),
('0002', 'Athula', 'Dissanayake', '20,1st lane,Deniyaya', '', '', '6124556452V', '0712548647', 'athula@gmail.com', '2015-01-07 08:07:00', 'Male', 'Green Tea Factory', '', '', '20,1st lane,Deniyaya', '', '', 'NSB', 'Deiniyaya', 1, 1, '2016-01-03 00:00:00', 1, ''),
('0003', 'Gamini', 'Gamage', '''Chathurika'',Dewala Road,Deniyaya', '', '', '5247789654V', '0718564713', 'gamini@gmail.com', '2015-05-05 06:26:44', 'Male', 'Gilbert Estate', '', '', '', '', '', 'HNB', 'Deniyaya', 0, 1, '2015-11-03 00:00:00', 2, ''),
('0004', 'Chulani', 'Weerathunga', '30,Pahalagama,Deniyaya', '', '', '6521456987V', '0775869874', 'chulani@gmail.com', '2015-05-05 06:26:44', 'Female', 'Palms Estate', '', '', '', '', '', '', '', 1, 0, '2016-01-04 00:00:00', 3, ''),
('0005', 'Madhushika', 'Rajapakshe', '''Madhu'',Temple Road,Akurassa', '', '', '7456891235V', '0785412365', 'madhu@gmail.com', '2015-03-20 06:41:15', 'Female', 'Hillwood Tea Factory', '', '', '', '', '', '', '', 0, 1, '2015-10-09 00:00:00', 4, ''),
('0006', 'Rajitha', 'Somaweera', '56,Church Road,Deniyaya', '', '', '5689451247V', '0765478987', 'rajitha@gmail.com', '2015-04-12 09:15:32', 'Male', 'Rex Estate', '', '', '', '', '', 'People''s Bank', 'Akurassa', 1, 1, '2016-01-01 00:00:00', 2, ''),
('0007', 'Keerthi', 'Gonagala', '7,Wedagedara,Deniyaya', '', '', '8415254789V', '0714578985', 'keerthi@gmail.com', '2015-05-03 13:24:33', 'Male', 'Excellent Estate', '', '', '', '', '', 'Nation Trust', 'Deniyaya', 1, 0, '2015-06-23 00:00:00', 1, ''),
('0008', 'Lahiru', 'Mendis', '''Upali'',Ihalagama,Akurassa', '', '', '6978451258V', '0724569878', 'lahiru@gmail.com', '2015-05-28 19:19:07', 'Male', 'Wanasundara Tea Factory', '', '', '', '', '', '', '', 0, 1, '2015-07-21 00:00:00', 4, ''),
('0009', 'Upali', 'Silva', '4,Mountain Road,Deniyaya', '', '', '6245789632V', '0712458796', 'upali@gmail.com', '2015-06-22 04:31:08', 'Male', 'Adara Kanda Tea Factory', '', '', '', '', '', 'Commercial', 'Akurassa', 1, 1, '2015-11-21 00:00:00', 3, ''),
('0010', 'Sunimal', 'Malkekulage', '''Sunimal'',Wewa Road,Deniyaya', '', '', '7545126398V', '0714578963', 'sunimal@gmail.com', '2015-07-27 17:32:20', 'Male', 'Suhadakirana Estate', '', '', '', '', '', 'NDB', 'Deniyaya', 1, 1, '2016-01-05 00:00:00', 2, ''),
('0011', 'assadasd', 'thusitha', 'asdsa', '', '', '232432445v', 'asda', 'asd@asda.sdfd', '2016-01-10 15:11:46', 'male', 'dasd', 'asdas', 'asdas', 'asdsa', 'asdsa', 'asdas', 'asdsa', 'asdsa', 0, 0, '2016-01-10 15:11:46', 8, '');

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
  `description` varchar(40) NOT NULL,
  `editor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `today_service`
--

INSERT INTO `today_service` (`date`, `sup_code`, `loan_code`, `unit_price`, `units`, `total_amount`, `no_of_installment`, `amount_of_installment`, `description`, `editor`) VALUES
('2016-01-04', '0001', 'adv', 23, 2, 234, 6, 11, 'goot see', 2),
('2016-01-10', '0001', 'adv', 0, 0, 123123, 1, 123123, 'he is good man', 8),
('2016-01-10', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('2016-02-10', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('2016-04-10', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('2016-07-10', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('2016-11-10', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('0000-00-00', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('0000-00-00', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('0000-00-00', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('0000-00-00', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('0000-00-00', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('0000-00-00', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('0000-00-00', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('2016-01-10', '0001', 'adv', 0, 0, 13123, 1, 13123, 'hoda eka', 8),
('2016-01-10', '0001', 'adv', 0, 0, 12, 1, 12, 'goodas', 8),
('2016-01-10', '0001', 'adv', 0, 0, 214, 1, 214, 'asdad', 8),
('2016-01-10', '0001', 'adv', 0, 0, 214, 1, 214, 'asdad', 8),
('2016-01-10', '0001', 'adv', 0, 0, 214, 1, 214, 'asdad', 8),
('2016-01-10', '0001', 'adv', 0, 0, 121, 1, 121, 'asf asda', 8),
('2016-01-10', '0001', 'adv', 0, 0, 1231, 1, 1231, '1ascc', 8),
('2016-01-10', '0001', 'adv', 0, 0, 1231, 1, 1231, '1ascc', 8),
('2016-01-10', '0002', 'adv', 0, 0, 42141, 1, 42141, 'asfasfasfas', 8),
('2016-01-10', '0002', 'adv', 0, 0, 42141, 1, 42141, 'asfasfasfas', 8),
('2016-01-10', '0002', 'adv', 0, 0, 42141, 1, 42141, 'asfasfasfas', 8),
('2016-01-10', '0002', 'adv', 0, 0, 42141, 1, 42141, 'asfasfasfas', 8),
('2016-01-10', '0002', 'adv', 0, 0, 1231, 1, 1231, 'asfsfa', 8),
('2016-01-10', '0001', 'adv', 0, 0, 12, 1, 12, 'zxc', 8);

-- --------------------------------------------------------

--
-- Table structure for table `today_supply`
--

CREATE TABLE IF NOT EXISTS `today_supply` (
  `supplier_code` varchar(8) NOT NULL,
  `date` datetime NOT NULL,
  `approved_kgs` int(11) NOT NULL,
  `supplied_kgs` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `editer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `today_supply`
--

INSERT INTO `today_supply` (`supplier_code`, `date`, `approved_kgs`, `supplied_kgs`, `units`, `editer`) VALUES
('0001', '2016-01-05 00:00:00', 65, 69, 3, 1),
('0002', '2016-01-07 00:00:00', 54, 58, 2, 3),
('0003', '2016-01-09 14:34:24', 12312, 312, 123, 8),
('0004', '2016-01-09 14:41:33', 23, 23, 123, 8),
('0005', '2016-01-09 14:45:00', 34324, 243234, 234, 8),
('0006', '2016-01-09 14:54:20', 123, 123, 123, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nic` varchar(10) NOT NULL,
  `joined` datetime NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` int(11) NOT NULL,
  `groups` int(11) NOT NULL,
  `level` varchar(10) NOT NULL,
  `user_approved` enum('Y','N') NOT NULL DEFAULT 'N',
  `token_code` varchar(100) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `nic`, `joined`, `gender`, `phone`, `groups`, `level`, `user_approved`, `token_code`, `image`) VALUES
(1, 'thusitha', '123', '', '', '', '2016-01-05 00:00:00', '', 0, 2, 'stnd', 'N', '0', ''),
(2, 'malith', '123', 'mdw@gmail.com', '', '', '0000-00-00 00:00:00', '', 0, 1, 'stnd', 'Y', '0', ''),
(3, 'admin', 'password', 'admin@gmail.com', 'Admin', '6458789515', '2015-01-01 04:22:00', 'Male', 712345678, 1, 'user', 'Y', '0', ''),
(4, 'hasitha', 'hasitha', 'hasitha92is@gmail.com', 'Hasitha Dissanayake', '922940690V', '2015-01-21 11:11:28', 'Male', 712689264, 1, 'user', 'Y', '0', ''),
(8, 'ccasc', '1a1dc91c907325c69271ddf0c944bc72', 'raja.4cc@gmail.com', 'asdas asc', '', '2016-01-08 12:10:34', '', 0, 2, 'admin', 'Y', '3a403fcdbe5b5b82657100fd43c6a533', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_supply`
--
ALTER TABLE `daily_supply`
  ADD PRIMARY KEY (`id`), ADD KEY `supplier_code` (`supplier_code`), ADD KEY `last_editor` (`last_editor`), ADD KEY `approved_by` (`approved_by`), ADD KEY `editor` (`editor`);

--
-- Indexes for table `invalid_messages`
--
ALTER TABLE `invalid_messages`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `loan_codes`
--
ALTER TABLE `loan_codes`
  ADD PRIMARY KEY (`loan_code`);

--
-- Indexes for table `message_info`
--
ALTER TABLE `message_info`
  ADD PRIMARY KEY (`message_code`);

--
-- Indexes for table `message_temp`
--
ALTER TABLE `message_temp`
  ADD PRIMARY KEY (`message_id`), ADD KEY `message_code` (`message_code`), ADD KEY `supplier_code` (`supplier_code`), ADD KEY `message_code_2` (`message_code`), ADD KEY `message_code_3` (`message_code`);

--
-- Indexes for table `monthly_bill`
--
ALTER TABLE `monthly_bill`
  ADD PRIMARY KEY (`supp_code`), ADD KEY `editor` (`editor`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`), ADD KEY `supp_code` (`supp_code`), ADD KEY `editor` (`editor`), ADD KEY `approved_by` (`approved_by`), ADD KEY `last_editor` (`last_editor`), ADD KEY `loan_code` (`loan_code`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`), ADD KEY `edit_by` (`edit_by`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_code`), ADD KEY `editor` (`editor`);

--
-- Indexes for table `ticket_machine`
--
ALTER TABLE `ticket_machine`
  ADD PRIMARY KEY (`serial_number`);

--
-- Indexes for table `today_service`
--
ALTER TABLE `today_service`
  ADD KEY `sup_code` (`sup_code`), ADD KEY `editor` (`editor`), ADD KEY `loan_code` (`loan_code`);

--
-- Indexes for table `today_supply`
--
ALTER TABLE `today_supply`
  ADD PRIMARY KEY (`supplier_code`), ADD KEY `editer` (`editer`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_supply`
--
ALTER TABLE `daily_supply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `invalid_messages`
--
ALTER TABLE `invalid_messages`
  MODIFY `mid` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `message_temp`
--
ALTER TABLE `message_temp`
  MODIFY `message_id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_supply`
--
ALTER TABLE `daily_supply`
ADD CONSTRAINT `daily_supply_ibfk_1` FOREIGN KEY (`supplier_code`) REFERENCES `suppliers` (`supplier_code`),
ADD CONSTRAINT `daily_supply_ibfk_2` FOREIGN KEY (`last_editor`) REFERENCES `users` (`id`),
ADD CONSTRAINT `daily_supply_ibfk_3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
ADD CONSTRAINT `daily_supply_ibfk_4` FOREIGN KEY (`editor`) REFERENCES `users` (`id`);

--
-- Constraints for table `message_temp`
--
ALTER TABLE `message_temp`
ADD CONSTRAINT `message_temp_ibfk_1` FOREIGN KEY (`message_code`) REFERENCES `message_info` (`message_code`),
ADD CONSTRAINT `message_temp_ibfk_2` FOREIGN KEY (`supplier_code`) REFERENCES `suppliers` (`supplier_code`);

--
-- Constraints for table `monthly_bill`
--
ALTER TABLE `monthly_bill`
ADD CONSTRAINT `monthly_bill_ibfk_1` FOREIGN KEY (`supp_code`) REFERENCES `suppliers` (`supplier_code`),
ADD CONSTRAINT `monthly_bill_ibfk_2` FOREIGN KEY (`editor`) REFERENCES `users` (`id`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`supp_code`) REFERENCES `suppliers` (`supplier_code`),
ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`editor`) REFERENCES `users` (`id`),
ADD CONSTRAINT `service_ibfk_3` FOREIGN KEY (`editor`) REFERENCES `users` (`id`),
ADD CONSTRAINT `service_ibfk_4` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
ADD CONSTRAINT `service_ibfk_5` FOREIGN KEY (`last_editor`) REFERENCES `users` (`id`),
ADD CONSTRAINT `service_ibfk_6` FOREIGN KEY (`loan_code`) REFERENCES `loan_codes` (`loan_code`),
ADD CONSTRAINT `service_ibfk_7` FOREIGN KEY (`loan_code`) REFERENCES `loan_codes` (`loan_code`);

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`edit_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`editor`) REFERENCES `users` (`id`);

--
-- Constraints for table `today_service`
--
ALTER TABLE `today_service`
ADD CONSTRAINT `today_service_ibfk_1` FOREIGN KEY (`sup_code`) REFERENCES `suppliers` (`supplier_code`),
ADD CONSTRAINT `today_service_ibfk_2` FOREIGN KEY (`editor`) REFERENCES `users` (`id`),
ADD CONSTRAINT `today_service_ibfk_3` FOREIGN KEY (`loan_code`) REFERENCES `loan_codes` (`loan_code`);

--
-- Constraints for table `today_supply`
--
ALTER TABLE `today_supply`
ADD CONSTRAINT `today_supply_ibfk_1` FOREIGN KEY (`supplier_code`) REFERENCES `suppliers` (`supplier_code`),
ADD CONSTRAINT `today_supply_ibfk_2` FOREIGN KEY (`editer`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
