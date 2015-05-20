-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2015 at 11:22 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rental_7344333`
--
CREATE DATABASE IF NOT EXISTS `rental_7344333` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rental_7344333`;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE IF NOT EXISTS `listings` (
  `listing_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `province` enum('AB','BC','MB','NB','NL','NS','ON','PE','QC','SK') NOT NULL,
  `furniture` enum('furnished','semi-furnished','non-furnished') NOT NULL,
  `home_type` enum('studio','loft','apartment','house','condo') NOT NULL,
  `bedrooms` enum('1','2','3','4+') NOT NULL,
  `price` int(11) NOT NULL,
  `available` enum('yes','no') NOT NULL,
  `owner_pm` text,
  PRIMARY KEY (`listing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `owner_preferences`
--

CREATE TABLE IF NOT EXISTS `owner_preferences` (
  `opref_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pets_allowed` enum('yes','no') NOT NULL,
  `smoking_allowed` enum('yes','no') NOT NULL,
  `max_vehicles` enum('0','1','2','3+') NOT NULL,
  `max_occupants` enum('1','2','3','4+') NOT NULL,
  `age_min` int(11) NOT NULL,
  `age_max` int(11) NOT NULL,
  `empl_status` enum('student','fulltime','parttime','unemployed','retired','any') NOT NULL,
  `lvl_income` enum('low','mid-low','mid','mid-high','high','any') NOT NULL,
  PRIMARY KEY (`opref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `owner_ranks_tenants`
--

CREATE TABLE IF NOT EXISTS `owner_ranks_tenants` (
  `orank_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ranking_tenants` varchar(255) NOT NULL,
  PRIMARY KEY (`orank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `owner_ranks_tenants`
--

INSERT INTO `owner_ranks_tenants` (`orank_id`, `user_id`, `ranking_tenants`) VALUES
(1, 6, '3,5,2,1,4'),
(2, 7, '5,2,1,4,3'),
(3, 8, '4,3,5,1,2'),
(4, 9, '1,2,3,4,5'),
(5, 10, '2,3,4,1,5');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_details`
--

CREATE TABLE IF NOT EXISTS `tenant_details` (
  `tdetails_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pets` enum('yes','no') NOT NULL,
  `smoking` enum('yes','no') NOT NULL,
  `vehicles` enum('0','1','2','3+') NOT NULL,
  `occupants` enum('1','2','3','4+') NOT NULL,
  `age` int(11) NOT NULL,
  `empl_status` enum('student','fulltime','parttime','unemployed','retired') NOT NULL,
  `lvl_income` enum('low','mid-low','mid','mid-high','high') NOT NULL,
  PRIMARY KEY (`tdetails_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tenant_preferences`
--

CREATE TABLE IF NOT EXISTS `tenant_preferences` (
  `tpref_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `province_pref` enum('all','AB','BC','MB','NB','NL','NS','ON','PE','QC','SK') NOT NULL DEFAULT 'all',
  `furniture_pref` enum('all','furnished','semi-furnished','non-furnished') NOT NULL DEFAULT 'all',
  `home_type_pref` enum('all','studio','loft','apartment','house','condo') NOT NULL DEFAULT 'all',
  `bedrooms_pref` enum('all','1','2','3','4+') NOT NULL DEFAULT 'all',
  `price_min` int(11) NOT NULL,
  `price_max` int(11) NOT NULL,
  `available_only` varchar(3) DEFAULT NULL,
  `tenant_pm` text,
  PRIMARY KEY (`tpref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tenant_ranks_owners`
--

CREATE TABLE IF NOT EXISTS `tenant_ranks_owners` (
  `trank_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ranking_owners` varchar(255) NOT NULL,
  PRIMARY KEY (`trank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tenant_ranks_owners`
--

INSERT INTO `tenant_ranks_owners` (`trank_id`, `user_id`, `ranking_owners`) VALUES
(1, 1, '3,2,5,1,4'),
(2, 2, '1,2,5,3,4'),
(3, 3, '4,3,2,1,5'),
(4, 4, '1,3,4,2,5'),
(5, 5, '1,2,4,5,3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_type` enum('tenant','owner') NOT NULL DEFAULT 'tenant',
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_type`, `phone`, `email`, `password`) VALUES
(1, 'Ali', 'Anderson', 'tenant', '(111)111-1111', 'aa@gmail.com', '9cbf8a4dcb8e30682b927f352d6559a0'),
(2, 'Bob', 'Barkley', 'tenant', '(222)222-2222', 'bb@gmail.com', '7374ce58be384f97fb15117dd99fba3c'),
(3, 'Carl', 'Clooney', 'tenant', '(333)333-3333', 'cc@gmail.com', '85862151eaed9bbc8b94373243e687cf'),
(4, 'Dom', 'Darling', 'tenant', '(444)444-4444', 'dd@gmail.com', '74a0c18637d1c7585a37b331c78d71a8'),
(5, 'Eric', 'Eary', 'tenant', '(555)555-5555', 'ee@gmail.com', '9b476ed9ae35b34d43890d662bd1924a'),
(6, 'Fred', 'Fiddle', 'owner', '(666)666-6666', 'ff@gmail.com', '773079f77569c67fdf2d983702d10a27'),
(7, 'George', 'Gillian', 'owner', '(777)777-7777', 'gg@gmail.com', 'ec2d752ed0d0652254087040bced0247'),
(8, 'Hyde', 'Hellner', 'owner', '(888)888-8888', 'hh@gmail.com', 'c833e923c2e7bffed05b4044fd345c9f'),
(9, 'Ilana', 'Iancu', 'owner', '(999)999-9999', 'ii@gmail.com', '122be6b6a8a090de92049e233df6c361'),
(10, 'Jillian', 'Jonas', 'owner', '(101)010-1010', 'jj@gmail.com', '91c0746cf9897c27e0f8778a6c8de229');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
