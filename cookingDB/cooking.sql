-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2012 at 04:59 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `ansID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ansMessage` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ansDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ansUsername` varchar(13) NOT NULL,
  `ans_quesID` bigint(20) NOT NULL,
  PRIMARY KEY (`ansID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `consist`
--

CREATE TABLE IF NOT EXISTS `consist` (
  `consistMenuID` bigint(20) NOT NULL,
  `consistMatID` bigint(20) NOT NULL,
  `consistMatQuan` int(11) NOT NULL,
  PRIMARY KEY (`consistMenuID`,`consistMatID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imgtable`
--

CREATE TABLE IF NOT EXISTS `imgtable` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `img_techID` bigint(20) NOT NULL,
  `img_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img_type` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `img_size` int(8) NOT NULL,
  `img_data` longblob NOT NULL,
  `img_indexAtPage` int(11) NOT NULL,
  `img_menuID` bigint(20) NOT NULL,
  `img_username` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `img_menuID` (`img_menuID`),
  KEY `img_techID` (`img_techID`),
  KEY `img_username` (`img_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `matID` bigint(20) NOT NULL AUTO_INCREMENT,
  `matName` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `matUnit` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`matID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=785 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=231 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `quesID` bigint(20) NOT NULL AUTO_INCREMENT,
  `quesTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quesMessage` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quesPin` tinyint(4) NOT NULL,
  `quesDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `showAcc` tinyint(1) NOT NULL,
  `ques_ansCount` int(11) NOT NULL,
  `quesUsername` varchar(13) NOT NULL,
  `quesActiveDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`quesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(13) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL,
  `fName` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lName` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) NOT NULL,
  `userPoint` int(11) NOT NULL,
  `userType` varchar(10) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
