-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 24, 2013 at 11:06 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `numbers`
--
CREATE DATABASE IF NOT EXISTS `numbers` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `numbers`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `passwd`, `enabled`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ip2addr`
--

CREATE TABLE IF NOT EXISTS `ip2addr` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `ip` varchar(32) NOT NULL,
  `addr` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ip2addr`
--

INSERT INTO `ip2addr` (`id`, `ip`, `addr`) VALUES
(1, '220.181.111.86', 'Beijing'),
(2, '220.181.111.86', 'Beijing'),
(3, '220.181.111.86', 'Beijing'),
(4, '220.181.111.86', 'Beijing'),
(5, '220.181.111.86', 'Beijing'),
(6, '220.181.111.86', 'Beijing'),
(7, '220.181.111.86', 'Beijing'),
(8, '220.181.111.86', 'Beijing'),
(9, '220.181.111.86', 'Beijing'),
(10, '220.181.111.86', 'Beijing');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE IF NOT EXISTS `userdata` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `package` varchar(32) NOT NULL,
  `version` varchar(32) NOT NULL,
  `buildkey` varchar(32) NOT NULL,
  `androidversion` varchar(32) NOT NULL,
  `imeiplusmac` varchar(64) NOT NULL COMMENT '用来区分相同的记录',
  `region` varchar(32) NOT NULL COMMENT '根据ip解析的地址',
  `accesstime` datetime NOT NULL COMMENT '获取用户数据的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `package`, `version`, `buildkey`, `androidversion`, `imeiplusmac`, `region`, `accesstime`) VALUES
(1, 'xsadf', '4', 'oppo', '3', '3', 'nanjing', '2013-12-03 00:00:00'),
(2, 'sfsdf', '3', 'huawei', '4', '1', 'beijing', '2013-12-17 00:00:00'),
(3, 'sdf', '343', 'huawei', '4', '2', 'nanjing', '2013-11-17 00:00:00'),
(4, 'sfsdf', '3', 'huawei', '4', '1', 'beijing', '2013-12-17 00:00:00'),
(5, 'xsadf', '4', 'oppo', '3', '3', 'nanjing', '2013-12-03 00:00:00'),
(6, 'xsadf', '4', 'iphone', '3', '2', 'nanjing', '2013-12-03 00:00:00'),
(7, 'xsadf', '4', 'iphone', '3', '2', 'nanjing', '2013-12-03 00:00:00'),
(8, 'sdf', '343', 'huawei', '4', '1', 'nanjing', '2013-12-17 00:00:00'),
(9, 'sfsdf', '3', 'huawei', '4', '1', 'beijing', '2013-12-17 00:00:00'),
(10, 'sdf', '343', 'huawei', '4', '1', 'nanjing', '2013-12-17 00:00:00'),
(11, 'xsadf', '4', 'iphone', '3', '2', 'nanjing', '2013-12-03 00:00:00'),
(12, 'sfsdf', '3', 'sumsing', '2.2', '5', 'beijing', '2013-12-17 00:00:00'),
(13, 'xsadf', '4', 'podao', '4.1', '4', 'nanjing', '2013-12-03 00:00:00'),
(14, 'xsadf', '4', 'zhongxing', '3.3', '6', 'nanjing', '2013-12-03 00:00:00'),
(15, 'xsadf', '4', 'zhongxing', '3.3', '7', 'nanjing', '2013-12-03 00:00:00'),
(16, 'packagename', '33', 'buildkey', '4.0', '23234234242342asdfaafsadf', 'Beijin', '2013-12-24 14:25:48'),
(17, 'packagename', '33', 'buildkey', '4.0', '23234234242342asdfaafsadf', 'Beijin', '2013-12-24 14:26:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
