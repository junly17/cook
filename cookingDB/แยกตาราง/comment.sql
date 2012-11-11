-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2012 at 03:25 PM
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
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comID` bigint(20) NOT NULL AUTO_INCREMENT,
  `comContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comTechID` bigint(20) NOT NULL,
  `comDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comChangeDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comUsername` varchar(13) NOT NULL,
  `comMenuID` bigint(20) NOT NULL,
  PRIMARY KEY (`comID`),
  KEY `comTechID_2` (`comTechID`),
  KEY `comUsername` (`comUsername`),
  KEY `comMenuID` (`comMenuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
