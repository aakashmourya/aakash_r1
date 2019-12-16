-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 16, 2019 at 12:38 PM
-- Server version: 5.7.24
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knowyourgene`
--

-- --------------------------------------------------------

--
-- Table structure for table `test_master`
--

DROP TABLE IF EXISTS `test_master`;
CREATE TABLE IF NOT EXISTS `test_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_master`
--

INSERT INTO `test_master` (`id`, `test`) VALUES
(1, 'Wellness'),
(2, 'Skin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `parent_id` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'A',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `user_id`, `parent_id`, `email`, `password`, `status`, `datetime`) VALUES
(20, '191018020', 'root', 'aakashmourya03@gmail.com', '123', 'A', '2019-10-18 10:35:52'),
(25, '191216021', '191018020', 'wephyre.aakashmourya@gmail.com', '123', 'A', '2019-12-16 16:48:00'),
(26, '191216026', '191018020', 'wephyre.aakashmourya@gmail.comf', '123', 'A', '2019-12-16 16:48:19'),
(27, '191216027', '191018020', 'wephyre.aakashmou90rya@gmail.com', '123', 'A', '2019-12-16 16:48:38'),
(28, '191216028', '191018020', 'wephyre.aakashm88ou90rya@gmail.com', '123', 'A', '2019-12-16 16:48:45'),
(29, '191216029', '191018020', 'wephyre.aakashmourysa@gmail.com', 'gennext123', 'A', '2019-12-16 17:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_contracts`
--

DROP TABLE IF EXISTS `user_contracts`;
CREATE TABLE IF NOT EXISTS `user_contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `mrp` float NOT NULL,
  `discount_amt` float NOT NULL,
  `discount_percentage` float NOT NULL,
  `from_date` varchar(50) NOT NULL,
  `to_date` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_contracts`
--

INSERT INTO `user_contracts` (`id`, `user_id`, `type_id`, `test_id`, `mrp`, `discount_amt`, `discount_percentage`, `from_date`, `to_date`, `datetime`) VALUES
(1, '191018020', 1, 1, 15000, 7500, 50, '2019-12-01 10:35:52', '2020-12-01 10:35:52', '2019-12-13 10:57:23'),
(2, '191018020', 1, 2, 15000, 6000, 40, '2019-12-01 10:35:52', '2020-12-01 10:35:52', '2019-12-13 11:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `company_name` varchar(300) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `gst` varchar(100) NOT NULL,
  `reg_type` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `name`, `company_name`, `mobile`, `address`, `gst`, `reg_type`, `datetime`) VALUES
(1, '191018020', 'AAKASH MOURYA', 'Gennext IT', '7840079095', '', '0909090909090909', 'company', '2019-12-12 16:30:27'),
(3, '191216021', 'aakash mourya', '54', '847 608 9809', 'delhi', 'yt', 'company', '2019-12-16 16:48:00'),
(4, '191216026', 'aakash mourya', 'rt', '847 608 9809', 'delhi', 'yt', 'company', '2019-12-16 16:48:19'),
(5, '191216027', 'aakash mourya', 'rt89', '847 608 9809', 'delhi', 'yt', 'company', '2019-12-16 16:48:38'),
(6, '191216028', 'aakash mourya', 'rt8989', '847 608 9809', 'delhi', 'yt', 'company', '2019-12-16 16:48:45'),
(7, '191216029', 'aakash mourya', '', '847 608 9809', 'delhi', '', 'individual', '2019-12-16 17:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`) VALUES
(1, 'Distributor'),
(2, 'Sub Distributor'),
(3, 'Agent'),
(4, 'Sub Agent');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
