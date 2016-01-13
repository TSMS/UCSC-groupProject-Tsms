-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2016 at 06:25 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_supply`
--

INSERT INTO `daily_supply` (`id`, `date`, `supplier_code`, `approved_kgs`, `supplied_kgs`, `units`, `editor`, `approved_by`, `last_editor`, `last_edit_date`) VALUES
(56, '2015-07-01', '0001', 161, 163, 6, 3, 4, 3, 2016),
(57, '2015-07-10', '0001', 175, 180, 7, 3, 4, 3, 2016),
(58, '2015-07-29', '0001', 220, 228, 9, 3, 4, 3, 2016),
(59, '2015-08-19', '0001', 128, 133, 5, 3, 4, 3, 2016),
(60, '2015-08-31', '0001', 169, 173, 7, 3, 4, 3, 2016),
(61, '2015-09-01', '0001', 183, 190, 7, 3, 4, 3, 2016),
(62, '2015-09-15', '0001', 193, 200, 8, 3, 4, 3, 2016),
(63, '2015-09-18', '0001', 69, 75, 3, 3, 4, 3, 2016),
(64, '2015-09-26', '0001', 53, 56, 2, 3, 4, 3, 2016),
(65, '2015-10-04', '0001', 161, 163, 7, 3, 4, 3, 2016),
(66, '2015-10-20', '0001', 220, 223, 9, 3, 4, 3, 2016),
(67, '2015-10-25', '0001', 196, 201, 8, 3, 4, 3, 2016),
(68, '2015-10-31', '0001', 127, 129, 5, 3, 4, 3, 2016),
(69, '2015-11-09', '0001', 178, 181, 9, 3, 4, 3, 2016),
(70, '2015-11-12', '0001', 195, 199, 8, 3, 4, 3, 2016),
(71, '2015-11-16', '0001', 154, 160, 6, 3, 4, 3, 2016),
(72, '2015-11-23', '0001', 197, 203, 8, 3, 4, 3, 2016),
(73, '2015-11-30', '0001', 201, 213, 8, 3, 4, 3, 2016),
(74, '2015-12-06', '0001', 173, 183, 7, 3, 4, 3, 2016),
(75, '2015-12-17', '0001', 222, 227, 9, 3, 4, 3, 2016),
(76, '2015-12-28', '0001', 282, 290, 11, 3, 4, 3, 2016),
(77, '2015-01-07', '0001', 61, 63, 2, 3, 4, 3, 2016),
(78, '2015-07-03', '0002', 161, 163, 6, 3, 4, 3, 2016),
(79, '2015-07-11', '0002', 175, 180, 7, 3, 4, 3, 2016),
(80, '2015-07-19', '0002', 220, 228, 9, 3, 4, 3, 2016),
(81, '2015-08-09', '0002', 128, 133, 5, 3, 4, 3, 2016),
(82, '2015-08-21', '0002', 169, 173, 7, 3, 4, 3, 2016),
(83, '2015-09-01', '0002', 183, 190, 7, 3, 4, 3, 2016),
(84, '2015-09-10', '0002', 193, 200, 8, 3, 4, 3, 2016),
(85, '2015-09-20', '0002', 69, 75, 3, 3, 4, 3, 2016),
(86, '2015-09-30', '0002', 53, 56, 2, 3, 4, 3, 2016),
(87, '2015-10-02', '0002', 161, 163, 7, 3, 4, 3, 2016),
(88, '2015-10-23', '0002', 220, 223, 9, 3, 4, 3, 2016),
(89, '2015-10-25', '0002', 196, 201, 8, 3, 4, 3, 2016),
(90, '2015-10-31', '0002', 127, 129, 5, 3, 4, 3, 2016),
(91, '2015-11-03', '0002', 178, 181, 9, 3, 4, 3, 2016),
(92, '2015-11-18', '0002', 195, 199, 8, 3, 4, 3, 2016),
(93, '2015-11-28', '0002', 154, 160, 6, 3, 4, 3, 2016),
(94, '2015-12-01', '0002', 197, 203, 8, 3, 4, 3, 2016),
(95, '2015-12-04', '0002', 201, 213, 8, 3, 4, 3, 2016),
(96, '2015-12-06', '0002', 173, 183, 7, 3, 4, 3, 2016),
(97, '2015-12-13', '0002', 222, 227, 9, 3, 4, 3, 2016),
(98, '2015-12-26', '0002', 282, 290, 11, 3, 4, 3, 2016),
(99, '2015-01-07', '0002', 61, 63, 2, 3, 4, 3, 2016),
(100, '2015-07-03', '0003', 261, 270, 10, 3, 4, 3, 2016),
(101, '2015-07-12', '0003', 125, 130, 5, 3, 4, 3, 2016),
(102, '2015-07-27', '0003', 130, 137, 5, 3, 4, 3, 2016),
(103, '2015-08-14', '0003', 90, 97, 5, 3, 4, 3, 2016),
(104, '2015-08-25', '0003', 169, 173, 7, 3, 4, 3, 2016),
(105, '2015-09-02', '0003', 111, 121, 4, 3, 4, 3, 2016),
(106, '2015-09-15', '0003', 123, 130, 5, 3, 4, 3, 2016),
(107, '2015-09-18', '0003', 60, 64, 2, 3, 4, 3, 2016),
(108, '2015-09-29', '0003', 196, 200, 8, 3, 4, 3, 2016),
(109, '2015-10-06', '0003', 151, 153, 6, 3, 4, 3, 2016),
(110, '2015-10-23', '0003', 229, 237, 9, 3, 4, 3, 2016),
(111, '2015-10-28', '0003', 290, 301, 12, 4, 3, 3, 2016),
(112, '2015-10-31', '0003', 54, 59, 2, 3, 4, 3, 2016),
(113, '2015-11-05', '0003', 189, 193, 8, 3, 4, 3, 2016),
(114, '2015-11-10', '0003', 133, 139, 5, 3, 4, 3, 2016),
(115, '2015-11-19', '0003', 159, 160, 6, 3, 4, 3, 2016),
(116, '2015-11-22', '0003', 167, 176, 7, 3, 4, 3, 2016),
(117, '2015-11-27', '0003', 209, 213, 8, 3, 4, 3, 2016),
(118, '2015-12-04', '0003', 297, 304, 12, 3, 4, 3, 2016),
(119, '2015-12-15', '0003', 201, 207, 8, 3, 4, 3, 2016),
(120, '2015-12-26', '0003', 262, 270, 11, 3, 4, 3, 2016),
(121, '2015-01-05', '0003', 54, 63, 2, 3, 4, 3, 2016),
(122, '2015-07-03', '0004', 254, 260, 10, 3, 4, 3, 2016),
(123, '2015-07-12', '0004', 225, 240, 10, 3, 4, 3, 2016),
(124, '2015-07-27', '0004', 96, 107, 4, 3, 4, 3, 2016),
(125, '2015-08-14', '0004', 189, 192, 7, 3, 4, 3, 2016),
(126, '2015-08-25', '0004', 136, 143, 5, 3, 4, 3, 2016),
(127, '2015-09-02', '0004', 148, 151, 6, 3, 4, 3, 2016),
(128, '2015-09-15', '0004', 192, 200, 8, 3, 4, 3, 2016),
(129, '2015-09-18', '0004', 269, 275, 11, 3, 4, 3, 2016),
(130, '2015-09-29', '0004', 196, 200, 8, 3, 4, 3, 2016),
(131, '2015-10-06', '0004', 181, 193, 7, 3, 4, 3, 2016),
(132, '2015-10-23', '0004', 276, 287, 11, 3, 4, 3, 2016),
(133, '2015-10-28', '0004', 290, 301, 12, 4, 3, 3, 2016),
(134, '2015-10-31', '0004', 154, 159, 6, 3, 4, 3, 2016),
(135, '2015-11-05', '0004', 289, 293, 12, 3, 4, 3, 2016),
(136, '2015-11-10', '0004', 103, 109, 4, 3, 4, 3, 2016),
(137, '2015-11-19', '0004', 179, 190, 7, 3, 4, 3, 2016),
(138, '2015-11-22', '0004', 197, 206, 8, 3, 4, 3, 2016),
(139, '2015-11-27', '0004', 219, 232, 9, 3, 4, 3, 2016),
(140, '2015-12-04', '0004', 197, 204, 8, 3, 4, 3, 2016),
(141, '2015-12-15', '0004', 101, 107, 4, 3, 4, 3, 2016),
(142, '2015-12-26', '0004', 224, 230, 9, 3, 4, 3, 2016),
(143, '2015-01-05', '0004', 24, 33, 1, 3, 4, 3, 2016),
(144, '2015-07-09', '0005', 161, 170, 6, 3, 4, 3, 2016),
(145, '2015-07-12', '0005', 135, 140, 5, 3, 4, 3, 2016),
(146, '2015-07-27', '0005', 150, 157, 6, 3, 4, 3, 2016),
(147, '2015-08-14', '0005', 290, 297, 12, 3, 4, 3, 2016),
(148, '2015-08-25', '0005', 269, 273, 11, 3, 4, 3, 2016),
(149, '2015-09-02', '0005', 211, 221, 8, 3, 4, 3, 2016),
(150, '2015-09-15', '0005', 93, 100, 4, 3, 4, 3, 2016),
(151, '2015-09-18', '0005', 160, 164, 6, 3, 4, 3, 2016),
(152, '2015-09-29', '0005', 166, 170, 7, 3, 4, 3, 2016),
(153, '2015-10-06', '0005', 121, 133, 5, 3, 4, 3, 2016),
(154, '2015-10-23', '0005', 129, 137, 5, 3, 4, 3, 2016),
(155, '2015-10-28', '0005', 240, 241, 10, 4, 3, 3, 2016),
(156, '2015-10-31', '0005', 154, 159, 6, 3, 4, 3, 2016),
(157, '2015-11-05', '0005', 149, 163, 6, 3, 4, 3, 2016),
(158, '2015-11-10', '0005', 243, 249, 10, 3, 4, 3, 2016),
(159, '2015-11-15', '0005', 259, 260, 10, 3, 4, 3, 2016),
(160, '2015-11-22', '0005', 133, 136, 5, 3, 4, 3, 2016),
(161, '2015-11-27', '0005', 109, 113, 4, 3, 4, 3, 2016),
(162, '2015-12-04', '0005', 107, 114, 4, 3, 4, 3, 2016),
(163, '2015-12-15', '0005', 281, 287, 11, 3, 4, 3, 2016),
(164, '2015-12-26', '0005', 262, 270, 11, 3, 4, 3, 2016),
(165, '2015-01-02', '0005', 44, 53, 2, 3, 4, 3, 2016),
(166, '2015-07-03', '0006', 265, 270, 11, 3, 4, 3, 2016),
(167, '2015-07-12', '0006', 135, 140, 5, 3, 4, 3, 2016),
(168, '2015-07-27', '0006', 160, 167, 5, 3, 4, 3, 2016),
(169, '2015-08-14', '0006', 290, 297, 12, 3, 4, 3, 2016),
(170, '2015-08-25', '0006', 269, 273, 11, 3, 4, 3, 2016),
(171, '2015-09-02', '0006', 100, 101, 4, 3, 4, 3, 2016),
(172, '2015-09-15', '0006', 143, 150, 6, 3, 4, 3, 2016),
(173, '2015-09-18', '0006', 52, 54, 2, 3, 4, 3, 2016),
(174, '2015-09-29', '0006', 186, 200, 7, 3, 4, 3, 2016),
(175, '2015-10-06', '0006', 191, 193, 8, 3, 4, 3, 2016),
(176, '2015-10-23', '0006', 229, 237, 9, 3, 4, 3, 2016),
(177, '2015-10-28', '0006', 390, 401, 16, 4, 3, 3, 2016),
(178, '2015-10-31', '0006', 154, 159, 6, 3, 4, 3, 2016),
(179, '2015-11-05', '0006', 89, 93, 4, 3, 4, 3, 2016),
(180, '2015-11-10', '0006', 93, 109, 4, 3, 4, 3, 2016),
(181, '2015-11-19', '0006', 178, 180, 7, 3, 4, 3, 2016),
(182, '2015-11-22', '0006', 167, 173, 7, 3, 4, 3, 2016),
(183, '2015-11-27', '0006', 229, 233, 9, 3, 4, 3, 2016),
(184, '2015-12-06', '0006', 397, 404, 16, 3, 4, 3, 2016),
(185, '2015-12-15', '0006', 101, 107, 4, 3, 4, 3, 2016),
(186, '2015-12-26', '0006', 135, 140, 5, 3, 4, 3, 2016),
(187, '2015-01-08', '0006', 44, 53, 2, 3, 4, 3, 2016),
(188, '2015-07-03', '0007', 225, 240, 9, 3, 4, 3, 2016),
(189, '2015-07-12', '0007', 105, 110, 4, 3, 4, 3, 2016),
(190, '2015-07-27', '0007', 180, 187, 7, 3, 4, 3, 2016),
(191, '2015-08-14', '0007', 295, 297, 12, 3, 4, 3, 2016),
(192, '2015-08-25', '0007', 209, 213, 8, 3, 4, 3, 2016),
(193, '2015-09-02', '0007', 125, 131, 5, 3, 4, 3, 2016),
(194, '2015-09-15', '0007', 183, 190, 7, 3, 4, 3, 2016),
(195, '2015-09-18', '0007', 152, 154, 6, 3, 4, 3, 2016),
(196, '2015-09-29', '0007', 166, 170, 7, 3, 4, 3, 2016),
(197, '2015-10-06', '0007', 191, 193, 8, 3, 4, 3, 2016),
(198, '2015-10-23', '0007', 169, 177, 7, 3, 4, 3, 2016),
(199, '2015-10-28', '0007', 300, 301, 12, 4, 3, 3, 2016),
(200, '2015-10-31', '0007', 154, 159, 6, 3, 4, 3, 2016),
(201, '2015-11-05', '0007', 289, 293, 12, 3, 4, 3, 2016),
(202, '2015-11-10', '0007', 93, 109, 4, 3, 4, 3, 2016),
(203, '2015-11-19', '0007', 118, 120, 5, 3, 4, 3, 2016),
(204, '2015-11-22', '0007', 367, 373, 15, 3, 4, 3, 2016),
(205, '2015-11-25', '0007', 229, 233, 9, 3, 4, 3, 2016),
(206, '2015-12-06', '0007', 197, 204, 12, 3, 4, 3, 2016),
(207, '2015-12-15', '0007', 141, 147, 6, 3, 4, 3, 2016),
(208, '2015-12-16', '0007', 135, 140, 5, 3, 4, 3, 2016),
(209, '2015-01-07', '0007', 40, 43, 2, 3, 4, 3, 2016),
(210, '2015-07-03', '0008', 205, 210, 8, 3, 4, 3, 2016),
(211, '2015-07-12', '0008', 195, 200, 8, 3, 4, 3, 2016),
(212, '2015-07-17', '0008', 260, 267, 10, 3, 4, 3, 2016),
(213, '2015-08-14', '0008', 270, 277, 11, 3, 4, 3, 2016),
(214, '2015-08-25', '0008', 169, 173, 7, 3, 4, 3, 2016),
(215, '2015-09-04', '0008', 150, 151, 6, 3, 4, 3, 2016),
(216, '2015-09-15', '0008', 234, 250, 9, 3, 4, 3, 2016),
(217, '2015-09-18', '0008', 502, 514, 20, 3, 4, 3, 2016),
(218, '2015-09-29', '0008', 286, 300, 11, 3, 4, 3, 2016),
(219, '2015-10-07', '0008', 191, 193, 8, 3, 4, 3, 2016),
(220, '2015-10-23', '0008', 129, 137, 5, 3, 4, 3, 2016),
(221, '2015-10-28', '0008', 394, 401, 16, 4, 3, 3, 2016),
(222, '2015-10-31', '0008', 254, 259, 10, 3, 4, 3, 2016),
(223, '2015-11-05', '0008', 189, 193, 8, 3, 4, 3, 2016),
(224, '2015-11-10', '0008', 183, 189, 7, 3, 4, 3, 2016),
(225, '2015-11-20', '0008', 188, 190, 7, 3, 4, 3, 2016),
(226, '2015-11-22', '0008', 197, 203, 8, 3, 4, 3, 2016),
(227, '2015-11-27', '0008', 129, 133, 5, 3, 4, 3, 2016),
(228, '2015-12-06', '0008', 397, 404, 16, 3, 4, 3, 2016),
(229, '2015-12-15', '0008', 151, 157, 6, 3, 4, 3, 2016),
(230, '2015-12-26', '0008', 135, 140, 5, 3, 4, 3, 2016),
(231, '2015-01-08', '0008', 78, 83, 3, 3, 4, 3, 2016),
(232, '2015-07-07', '0009', 275, 280, 11, 3, 4, 3, 2016),
(233, '2015-07-14', '0009', 295, 300, 12, 3, 4, 3, 2016),
(234, '2015-07-17', '0009', 260, 267, 10, 3, 4, 3, 2016),
(235, '2015-08-14', '0009', 370, 377, 15, 3, 4, 3, 2016),
(236, '2015-08-25', '0009', 179, 183, 7, 3, 4, 3, 2016),
(237, '2015-09-04', '0009', 110, 121, 4, 3, 4, 3, 2016),
(238, '2015-09-15', '0009', 134, 140, 5, 3, 4, 3, 2016),
(239, '2015-09-18', '0009', 402, 404, 20, 3, 4, 3, 2016),
(240, '2015-09-29', '0009', 146, 150, 6, 3, 4, 3, 2016),
(241, '2015-10-07', '0009', 191, 193, 8, 3, 4, 3, 2016),
(242, '2015-10-23', '0009', 189, 197, 7, 3, 4, 3, 2016),
(243, '2015-10-28', '0009', 394, 401, 16, 4, 3, 3, 2016),
(244, '2015-10-31', '0009', 154, 159, 6, 3, 4, 3, 2016),
(245, '2015-11-05', '0009', 179, 183, 7, 3, 4, 3, 2016),
(246, '2015-11-10', '0009', 223, 229, 9, 3, 4, 3, 2016),
(247, '2015-11-20', '0009', 180, 190, 7, 3, 4, 3, 2016),
(248, '2015-11-22', '0009', 297, 303, 12, 3, 4, 3, 2016),
(249, '2015-11-27', '0009', 129, 133, 5, 3, 4, 3, 2016),
(250, '2015-12-06', '0009', 197, 204, 8, 3, 4, 3, 2016),
(251, '2015-12-15', '0009', 151, 157, 6, 3, 4, 3, 2016),
(252, '2015-12-26', '0009', 125, 130, 5, 3, 4, 3, 2016),
(253, '2015-01-01', '0009', 70, 83, 3, 3, 4, 3, 2016),
(254, '2015-07-02', '0010', 261, 263, 10, 3, 4, 3, 2016),
(255, '2015-07-19', '0010', 131, 133, 5, 3, 4, 3, 2016),
(256, '2015-07-21', '0010', 61, 63, 2, 3, 4, 3, 2016),
(257, '2015-07-30', '0010', 61, 63, 2, 3, 4, 3, 2016),
(258, '2015-08-11', '0010', 61, 63, 2, 3, 4, 3, 2016),
(259, '2015-08-19', '0010', 61, 63, 2, 3, 4, 3, 2016),
(260, '2015-08-28', '0010', 61, 63, 2, 3, 4, 3, 2016),
(261, '2015-08-03', '0010', 61, 63, 2, 3, 4, 3, 2016),
(262, '2015-09-15', '0010', 61, 63, 2, 3, 4, 3, 2016),
(263, '2015-09-22', '0010', 61, 63, 2, 3, 4, 3, 2016),
(264, '2015-09-29', '0010', 61, 63, 2, 3, 4, 3, 2016),
(265, '2015-10-06', '0010', 61, 63, 2, 3, 4, 3, 2016),
(266, '2015-10-12', '0010', 61, 63, 2, 3, 4, 3, 2016),
(267, '2015-10-19', '0010', 61, 63, 2, 3, 4, 3, 2016),
(268, '2015-10-30', '0010', 61, 63, 2, 3, 4, 3, 2016),
(269, '2015-11-04', '0010', 61, 63, 2, 3, 4, 3, 2016),
(270, '2015-11-11', '0010', 61, 63, 2, 3, 4, 3, 2016),
(271, '2015-11-24', '0010', 61, 63, 2, 3, 4, 3, 2016),
(272, '2015-12-09', '0010', 61, 63, 2, 3, 4, 3, 2016),
(273, '2015-12-20', '0010', 61, 63, 2, 3, 4, 3, 2016),
(274, '2015-12-28', '0010', 61, 63, 2, 3, 4, 3, 2016),
(275, '2015-01-02', '0001', 61, 63, 2, 3, 4, 3, 2016),
(276, '2015-01-13', '0002', 31, 33, 1, 3, 4, 3, 2016),
(277, '2015-01-13', '0003', 21, 23, 1, 3, 4, 3, 2016),
(278, '2015-01-09', '0004', 39, 43, 2, 3, 4, 3, 2016),
(279, '2015-01-12', '0005', 60, 63, 2, 3, 4, 3, 2016),
(280, '2015-01-11', '0006', 47, 50, 2, 3, 4, 3, 2016),
(281, '2015-01-06', '0007', 61, 63, 2, 3, 4, 3, 2016),
(282, '2015-01-12', '0008', 64, 68, 3, 3, 4, 3, 2016),
(283, '2015-01-13', '0009', 59, 63, 2, 3, 4, 3, 2016),
(284, '2015-01-08', '0010', 61, 63, 2, 3, 4, 3, 2016);

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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_temp`
--

INSERT INTO `message_temp` (`message_id`, `supplier_code`, `message_code`, `value`, `quantity`, `category`, `date`, `time`, `approve`) VALUES
(36, '0006', 'fer', 0, 20, 'gfd', '2016-01-11', '21:21:25', 1),
(37, '0001', 'adv', 3000, 0, '', '2016-01-11', '21:22:33', 1),
(38, '0009', 'adv', 20, 0, '', '2016-01-11', '21:40:15', 1),
(69, '0005', 'adv', 34, 0, '', '2015-10-11', '07:19:40', 1),
(70, '0001', 'adv', 34, 0, '', '2015-10-16', '07:20:41', 0),
(71, '0006', 'adv', 34, 0, '', '2015-10-16', '07:21:02', 0),
(72, '0002', 'adv', 340, 0, '', '2015-10-22', '10:03:41', 0),
(73, '0009', 'che', 0, 10, 'chemical', '2015-10-22', '11:20:19', 1),
(74, '0001', 'che', 0, 10, 'chemical', '2015-10-22', '11:28:43', 1),
(75, '0002', 'che', 0, 10, 'chemical', '2015-10-22', '11:29:12', 1),
(76, '0001', 'adv', 1000, 0, '', '2015-11-02', '11:22:24', 0),
(77, '0004', 'adv', 1000, 0, '', '2015-11-02', '11:24:02', 1),
(78, '0004', 'adv', 200, 0, '', '2015-11-02', '12:28:09', 0),
(79, '0002', 'adv', 123231, 0, '', '2016-01-12', '21:20:11', 1),
(80, '0002', 'adv', 786543, 0, '', '2016-01-12', '21:23:02', 0);

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

--
-- Dumping data for table `monthly_bill`
--

INSERT INTO `monthly_bill` (`supp_code`, `date`, `total_supp_kgs`, `direct_addition`, `other_addition`, `total_income`, `last_month_debt`, `debt`, `advance`, `manure`, `tea`, `transport`, `stationary`, `stamp`, `total_subtraction`, `balance`, `process_date`, `editor`) VALUES
('0001', '2015-12-01', 677, '0.00', '0.00', '40620.00', '0.00', '0.00', '15000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '15000.00', '25620.00', '2015-12-31', 4),
('0003', '2015-12-01', 760, '0.00', '0.00', '45600.00', '0.00', '0.00', '0.00', '2500.00', '0.00', '0.00', '0.00', '0.00', '2500.00', '43100.00', '2015-12-31', 2),
('0004', '2015-12-01', 522, '0.00', '0.00', '31320.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '31320.00', '0201-12-31', 3),
('0005', '2015-12-01', 650, '0.00', '0.00', '39000.00', '0.00', '0.00', '0.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '30000.00', '9000.00', '2015-12-31', 2),
('0006', '2015-12-01', 633, '0.00', '0.00', '37980.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '37980.00', '2015-12-31', 2),
('0008', '2015-12-01', 683, '0.00', '0.00', '40980.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '40980.00', '0201-12-31', 3),
('0009', '2015-12-01', 473, '0.00', '0.00', '28380.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '28380.00', '2015-12-31', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
(9, '2015-07-07', '58.00', '64.00', '0.00', 2),
(10, '2016-01-13', '55.00', '60.00', '50000.00', 1),
(11, '2015-12-09', '57.00', '62.00', '0.00', 2),
(12, '2015-11-01', '58.00', '65.00', '0.00', 1),
(13, '2015-10-02', '60.00', '65.00', '0.00', 1),
(14, '2015-09-07', '61.00', '67.00', '0.00', 1),
(15, '2015-08-03', '60.00', '65.00', '0.00', 1),
(16, '2015-07-07', '58.00', '64.00', '0.00', 2);

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
('0002', 'Athula', 'Dissanayake', '20,1st lane,Deniyaya', '', '', '6124556452V', '0712548647', 'athula@gmail.com', '2015-01-07 08:07:00', 'Male', 'Green Tea Factory', '', '', '20,1st lane,Deniyaya', '', '', 'NSB', 'Deiniyaya', 1, 1, '2016-01-03 00:00:00', 1, 'a722c63db8ec8625af6cf71cb8c2d939'),
('0003', 'Gamini', 'Gamage', '''Chathurika'',Dewala Road,Deniyaya', '', '', '5247789654V', '0718564713', 'gamini@gmail.com', '2015-05-05 06:26:44', 'Male', 'Gilbert Estate', '', '', '', '', '', 'HNB', 'Deniyaya', 0, 1, '2015-11-03 00:00:00', 2, ''),
('0004', 'Chulani', 'Weerathunga', '30,Pahalagama,Deniyaya', '', '', '6521456987V', '0775869874', 'chulani@gmail.com', '2015-05-05 06:26:44', 'Female', 'Palms Estate', '', '', '', '', '', '', '', 1, 0, '2016-01-04 00:00:00', 3, ''),
('0005', 'Madhushika', 'Rajapakshe', '''Madhu'',Temple Road,Akurassa', '', '', '7456891235V', '0785412365', 'madhu@gmail.com', '2015-03-20 06:41:15', 'Female', 'Hillwood Tea Factory', '', '', '', '', '', '', '', 0, 1, '2015-10-09 00:00:00', 4, ''),
('0006', 'Rajitha', 'Somaweera', '56,Church Road,Deniyaya', '', '', '5689451247V', '0765478987', 'rajitha@gmail.com', '2015-04-12 09:15:32', 'Male', 'Rex Estate', '', '', '', '', '', 'People''s Bank', 'Akurassa', 1, 1, '2016-01-01 00:00:00', 2, ''),
('0007', 'Keerthi', 'Gonagala', '7,Wedagedara,Deniyaya', '', '', '8415254789V', '0714578985', 'keerthi@gmail.com', '2015-05-03 13:24:33', 'Male', 'Excellent Estate', '', '', '', '', '', 'Nation Trust', 'Deniyaya', 1, 0, '2015-06-23 00:00:00', 1, ''),
('0008', 'Lahiru', 'Mendis', '''Upali'',Ihalagama,Akurassa', '', '', '6978451258V', '0724569878', 'lahiru@gmail.com', '2015-05-28 19:19:07', 'Male', 'Wanasundara Tea Factory', '', '', '', '', '', '', '', 0, 1, '2015-07-21 00:00:00', 4, 'pass'),
('0009', 'Upali', 'Silva', '4,Mountain Road,Deniyaya', '', '', '6245789632V', '0712458796', 'upali@gmail.com', '2015-06-22 04:31:08', 'Male', 'Adara Kanda Tea Factory', '', '', '', '', '', 'Commercial', 'Akurassa', 1, 1, '2015-11-21 00:00:00', 3, ''),
('0010', 'Sunimal', 'Malkekulage', '''Sunimal'',Wewa Road,Deniyaya', '', '', '7545126398V', '0714578963', 'sunimal@gmail.com', '2015-07-27 17:32:20', 'Male', 'Suhadakirana Estate', '', '', '', '', '', 'NDB', 'Deniyaya', 1, 1, '2016-01-05 00:00:00', 2, ''),
('0011', 'tharindu', 'piyumanthwa', 'tharind''s address', '', '', '921402210V', '0772343234', 'thrindu@gmail.com', '2016-01-11 04:03:38', 'male', 'hillwood palce', '324j234-23', '4', 'estate-address', 'T. M. Piyumantha', '982-234-23-3432234', 'HNDB', 'Deniyaya', 0, 0, '2016-01-11 04:03:38', 11, '2d3ad9f369406d7a3d60146c3c6410c2');

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
('2016-01-11', '0001', 'adv', 23, 2, 234, 6, 11, 'goot see', 2),
('2016-01-11', '0001', 'adv', 0, 0, 123123, 1, 123123, 'he is good man', 8),
('2016-01-11', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('2016-02-11', '0001', 'che', 123, 123, 15129, 12, 1412.04, 'afasfsf sf', 8),
('2016-01-11', '0002', 'adv', 0, 0, 1231, 1, 1231, 'asfsfa', 8),
('2016-01-11', '0001', 'adv', 0, 0, 12, 1, 12, 'zxc', 8),
('2016-01-12', '0001', 'adv', 0, 0, 1234567, 1, 1234567, '', 8),
('2016-01-12', '0004', 'adv', 0, 0, 3454, 1, 3454, 'helo', 8);

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
('0001', '2016-01-12 15:31:59', 34, 65, 2, 8),
('0005', '2016-01-12 15:32:15', 45, 45, 4, 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `nic`, `joined`, `gender`, `phone`, `groups`, `level`, `user_approved`, `token_code`, `image`) VALUES
(1, 'thusitha', '123', '', '', '', '2016-01-05 00:00:00', '', 0, 2, 'stnd', 'N', '0', ''),
(2, 'malith', '123', 'mdw@gmail.com', '', '', '0000-00-00 00:00:00', '', 0, 2, 'stnd', 'Y', '0', ''),
(3, 'admin', 'password', 'admin@gmail.com', 'Admin', '6458789515', '2015-01-01 04:22:00', 'Male', 712345678, 2, 'user', 'Y', '0', ''),
(4, 'hasitha', 'hasitha', 'hasitha92is@gmail.com', 'Hasitha Dissanayake', '922940690V', '2015-01-21 11:11:28', 'Male', 712689264, 1, 'user', 'Y', '0', ''),
(8, 'System Admin', '1a1dc91c907325c69271ddf0c944bc72', 'tsms@gmail.com', 'Hemantha Dasanayake', '', '2016-01-08 12:10:34', '', 0, 2, 'admin', 'Y', '3a403fcdbe5b5b82657100fd43c6a533', ''),
(11, 'malith', '1a1dc91c907325c69271ddf0c944bc72', 'malith@gmail.com', 'hasitha silva', '', '2016-01-11 03:50:03', '', 0, 2, 'user', 'Y', '41f73bf58b9fd86f086aaedf06276ccc', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=285;
--
-- AUTO_INCREMENT for table `invalid_messages`
--
ALTER TABLE `invalid_messages`
  MODIFY `mid` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `message_temp`
--
ALTER TABLE `message_temp`
  MODIFY `message_id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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
