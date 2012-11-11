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
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menuID` bigint(20) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menuDes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menuVDO` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menuStep` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menuNumOfMat` int(11) NOT NULL,
  `menuPoint` int(11) NOT NULL,
  `menuDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menuChangeDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `menuUsername` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`menuID`),
  KEY `menuUsername` (`menuUsername`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=227 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
