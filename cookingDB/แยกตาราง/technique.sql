-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2012 at 03:28 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oom`
--

-- --------------------------------------------------------

--
-- Table structure for table `technique`
--

CREATE TABLE IF NOT EXISTS `technique` (
  `techID` bigint(20) NOT NULL AUTO_INCREMENT,
  `techName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `techDes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `techVDO` varchar(15) NOT NULL,
  `techStep` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `techPoint` int(11) NOT NULL,
  `techPin` tinyint(4) NOT NULL,
  `techDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `techChangeDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `techUserName` varchar(13) NOT NULL,
  PRIMARY KEY (`techID`),
  KEY `techUserName` (`techUserName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
