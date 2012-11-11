-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2012 at 08:47 PM
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
  PRIMARY KEY (`quesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`quesID`, `quesTitle`, `quesMessage`, `quesPin`, `quesDate`, `showAcc`, `ques_ansCount`, `quesUsername`) VALUES
(15, 'ssdsfdsfsdf', 'sdafsafsaaaaaa', 0, '2012-10-01 17:48:27', 0, 21, 'chanoknat'),
(16, 'sddddddddddddddddffds', 'sdddddddddddddddddddd', 0, '2012-10-01 17:11:58', 0, 1, 'chanoknat'),
(17, 'pppppppppp', 'ooooooooo', 0, '2012-10-01 18:02:21', 0, 0, 'chanoknat'),
(18, 'dddddddw', 'wwwwwwww', 0, '2012-10-01 18:15:34', 0, 0, 'chanoknat');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
