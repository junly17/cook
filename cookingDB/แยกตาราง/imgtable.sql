-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2012 at 05:10 AM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
