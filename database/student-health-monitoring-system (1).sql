-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2019 at 03:49 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `student-health-monitoring-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `boys_growth_table`
--

CREATE TABLE IF NOT EXISTS `boys_growth_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `age` int(11) NOT NULL,
  `severely_underweight` float NOT NULL,
  `underweight_from` float NOT NULL,
  `underweight_to` float NOT NULL,
  `normal_from` float NOT NULL,
  `normal_to` float NOT NULL,
  `overweight` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `boys_growth_table`
--

INSERT INTO `boys_growth_table` (`id`, `age`, `severely_underweight`, `underweight_from`, `underweight_to`, `normal_from`, `normal_to`, `overweight`) VALUES
(1, 0, 2.1, 2.2, 2.4, 2.5, 4.4, 4.5),
(2, 1, 2.9, 3, 3.3, 3.4, 5.8, 5.9),
(3, 2, 3.8, 3.9, 4.2, 4.3, 7.1, 7.2),
(4, 3, 4.4, 4.5, 4.9, 5, 8, 8.1),
(5, 4, 4.9, 5, 5.5, 5.6, 8.7, 8.8),
(6, 5, 5.3, 5.4, 5.9, 6, 9.3, 9.4),
(7, 6, 5.7, 5.8, 6.3, 6.4, 9.8, 9.9),
(8, 7, 5.9, 6, 6.6, 6.7, 10.3, 10.4),
(9, 8, 6.2, 6.3, 6.8, 6.9, 10.7, 10.8),
(10, 9, 6.4, 6.5, 7, 7.1, 11, 11.1),
(11, 10, 6.6, 6.7, 7.3, 7.4, 11.4, 11.5),
(12, 11, 6.8, 6.9, 7.5, 7.6, 11.7, 11.8),
(13, 12, 6.9, 7, 7.6, 7.7, 12, 12.1);

-- --------------------------------------------------------

--
-- Table structure for table `girls_growth_table`
--

CREATE TABLE IF NOT EXISTS `girls_growth_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `age` int(11) NOT NULL,
  `severely_underweight` float NOT NULL,
  `underweight_from` float NOT NULL,
  `underweight_to` float NOT NULL,
  `normal_from` float NOT NULL,
  `normal_to` float NOT NULL,
  `overweight` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `girls_growth_table`
--

INSERT INTO `girls_growth_table` (`id`, `age`, `severely_underweight`, `underweight_from`, `underweight_to`, `normal_from`, `normal_to`, `overweight`) VALUES
(1, 0, 2, 2.1, 2.3, 2.4, 4.2, 4.3),
(2, 1, 2.7, 2.8, 3.1, 3.2, 5.5, 5.6),
(3, 2, 3.4, 3.5, 3.8, 3.9, 6.6, 6.7),
(4, 3, 4, 4.1, 4.4, 4.5, 7.5, 7.6),
(5, 4, 4.4, 4.5, 4.9, 5, 8.2, 8.3),
(6, 5, 4.8, 4.9, 5.3, 5.4, 8.8, 8.9),
(7, 6, 5.1, 5.2, 5.6, 5.7, 9.3, 9.4),
(8, 7, 5.3, 5.4, 5.9, 6, 9.8, 9.9),
(9, 8, 5.6, 5.7, 6.2, 6.3, 10.2, 10.3),
(10, 9, 5.8, 5.9, 6.4, 6.5, 10.5, 10.6),
(11, 10, 5.9, 6, 6.6, 6.7, 10.9, 11),
(12, 11, 6.1, 6.2, 6.8, 6.9, 11.2, 11.3),
(13, 12, 6.3, 6.4, 6.9, 7, 11.5, 11.6);

-- --------------------------------------------------------

--
-- Table structure for table `marketplace`
--

CREATE TABLE IF NOT EXISTS `marketplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ing_brand` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `in_unit` varchar(255) NOT NULL,
  `ing_section` varchar(255) NOT NULL,
  `ing_category` varchar(255) NOT NULL,
  `date_modified` date NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `marketplace`
--

INSERT INTO `marketplace` (`id`, `name`, `ing_brand`, `price`, `in_unit`, `ing_section`, `ing_category`, `date_modified`, `deleted`) VALUES
(1, 'Karneng baboy', 'No Brand', 180, 'Kilo', 'Meat', 'Pig', '2019-01-04', 0),
(2, 'Shrimp', 'No Brand', 400, 'Kilo', 'Seafoods', 'Seafoods', '2019-01-18', 0),
(4, 'Kalabasa', 'No Brand', 50, 'Kilo', 'Vegetables', 'Vegetables', '2019-01-04', 0),
(5, 'Cow Meat', 'No Brand', 300, 'Kilo', 'Meat', 'Cow', '2019-01-04', 0),
(6, 'Mango', 'No Brand', 26.52, 'pc', 'Fruits', 'Fruits', '2019-01-14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE IF NOT EXISTS `tbl_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`id`, `username`, `password`, `deleted`) VALUES
(1, 'cssdo', 'cssdo', 1),
(7, 'cssdo', 'cssdo', 0),
(8, 'super', 'super', 0),
(9, 'manager', 'manager', 0),
(10, 'kl', 'kl', 0),
(11, 'dswd248', 'dswd1', 0),
(12, 'student', 'student', 1),
(13, 'jean', 'manager', 0),
(14, 'haw23', 'h', 1),
(15, '', '', 1),
(16, 'aw', 'aw', 0),
(17, 'dswd23', 'dswd', 0),
(18, 'juda', 'juda', 0),
(19, 'julius', 'julius', 0),
(20, 'richelle2', 'richelle', 0),
(21, 'jason', 'jason', 0),
(22, 'dswd123', 'dswd', 0),
(23, 'D', 'ong', 0),
(24, 'parent', 'parent', 0),
(25, 'randy1', 'randy', 0),
(26, 'janine', 'janine', 0),
(27, 'anne', 'anne', 0),
(28, 'sdasdsd', 'sd', 1),
(29, '23', '23', 1),
(30, '23', '23', 0),
(31, '23', '23', 0),
(32, '45', '45', 0),
(33, '23', '23', 0),
(34, 'aa', 'aaa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` tinyint(2) NOT NULL,
  `birthday` date NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `privilege` varchar(50) NOT NULL,
  `account_id` int(11) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `firstname`, `middlename`, `lastname`, `age`, `gender`, `birthday`, `citizenship`, `religion`, `address`, `occupation`, `privilege`, `account_id`, `image_path`, `deleted`) VALUES
(1, 'Manager1', 'manager1', 'manager1', 50, 1, '0000-00-00', 'Filipino', 'Catholic', 'Davao City', 'Principal', 'CSSDO', 1, 'manager1.png', 1),
(2, 'Manager2', 'manager2', 'manager2', 50, 0, '0000-00-00', 'Filipino', 'Catholic', 'Davao City', 'Principal', 'CSSDO', 4, 'manager1.png', 0),
(3, 'Manager3', 'manager3', 'manager3', 50, 0, '0000-00-00', 'Filipino', 'Catholic', 'Davao City', 'Principal', 'CSSDO', 3, 'manager3.png', 0),
(4, 'Administrator1', 'Administrator2', 'Administrator2', 50, 0, '0000-00-00', 'Filipino', 'Catholic', 'Davao City', 'Principal', 'DSWD', 2, 'administrator.png', 0),
(5, 'k', 'k', 'k', 15, 0, '2018-02-02', 'asd', 'asd', 'ad', 'ad', 'CSSDO', 5, 'noimage.png', 0),
(6, 'test', 'test', 'test', 50, 0, '1991-05-05', 'filipino', 'test', 'test', 'test', 'CSSDO', 6, 'noimage.png', 0),
(7, 'jonel', 'l', 'lang', 25, 1, '1991-05-05', 'law', 'law', 'l', 'law', 'CSSDO', 7, 'post_office.png', 0),
(9, 'John1', 'L', 'Doe', 50, 0, '1961-01-01', 'USA', 'USA', 'DC', 'USA', 'CSSDO', 9, 'noimage.png', 0),
(10, 'pawe', 'p', 'p', 56, 0, '1691-03-03', 'kl', 'kl', 'kl', 'kl', 'Administrator', 10, 'noimage.png', 0),
(11, 'Will', 'I ', 'Am', 45, 0, '1864-05-05', 'USA23', 'USA', 'USA', 'USA', 'DSWD', 11, 'noimage.png', 0),
(12, 'Steven', 'g', 'Doe', 25, 0, '2018-04-12', 'Filipino', 'Catholic', 'Toril', 'Web Developer', 'Administrator', 8, 'noimage.png', 0),
(13, 'Jean', 'K', 'Dela Cruz', 45, 0, '2018-02-02', 'Filipino', 'Catholic', 'Toril', 'Teacher', 'CSSDO', 13, 'noimage.png', 0),
(14, 'kwwe1', 'k23', 'k', 52, 0, '2018-02-02', 'h', 'h', 'h', 'h', 'DSWD', 14, 'PLAYGROUND-1.jpg', 1),
(15, 'kol', 'ko', 'kol', 15, 0, '2018-02-02', 'aw', 'aw', 'aw', 'aw', 'Administrator', 16, 'noimage.png', 0),
(16, 'we', 'we', 'we', 52, 0, '2018-02-02', 'we', 'we', 'we', 'we', 'Administrator', 17, 'noimage.png', 0),
(17, 'dswd', 'dd', 'dswd', 45, 1, '2018-04-16', 'Philam', 'INC', 'Davao City', 'Head', 'DSWD', 22, 'noimage.png', 0),
(18, 'Di', 'G', 'Ong', 65, 1, '2009-01-05', 'aw', 'aw', 'aw', 'aw', 'DSWD', 23, 'park_png.png', 0),
(19, 'Tapulano', 'K', 'Kaayo', 56, 1, '1979-04-01', 'philam', 'inc', 'Toril', 'none', 'Parent', 24, 'school.jpg', 0),
(20, 'Randy1', 'M', 'Santiago', 54, 1, '2009-10-17', 'Filipino', 'Roman', 'Philipines', 'Worker', 'Parent', 25, 'park_png-1.png', 0),
(21, 'Anne', 'M', 'Curtis', 35, 0, '1980-04-01', 'Filipino', 'Roman', 'none', 'None', 'Parent', 27, 'MICHAEL_CITY.jpg', 0),
(22, 'sd', 'sd', 'sd', 23, 1, '2018-04-09', 'sd', 'sd', 'sd', 'sd', 'Parent', 28, 'traffic_lights-1.png', 1),
(23, '23', '23', '23', 23, 1, '2018-05-13', '23', '23', '23', '23', 'Parent', 29, 'bank-1.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_child_points`
--

CREATE TABLE IF NOT EXISTS `tbl_child_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `credit_points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_child_points`
--

INSERT INTO `tbl_child_points` (`id`, `student_id`, `credit_points`) VALUES
(1, 0, 0),
(2, 8, 20),
(3, 9, 80),
(4, 19, 25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `comment` text NOT NULL,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `post_id`, `user_id`, `date_created`, `comment`, `user_type`) VALUES
(1, 6, 12, '2018-06-27', 'This is a test comment', 'Administrator'),
(2, 4, 12, '2018-06-27', 'another test', 'Administrator'),
(5, 4, 12, '2018-06-27', 'sdasdasd', 'Administrator'),
(6, 4, 12, '2018-06-27', 'asdasdasd', 'Administrator'),
(8, 6, 7, '2018-06-27', 'this is a comment from cssdo', 'CSSDO'),
(10, 4, 12, '2018-06-27', 'example comment23123123', 'Administrator'),
(11, 6, 12, '2018-06-27', 'This is a comment no 2', 'Administrator'),
(13, 6, 12, '2018-06-27', 'weqwqweqweqwe', 'Administrator'),
(14, 6, 1, '2018-06-27', 'student comment', 'Student'),
(16, 11, 12, '2018-06-27', 'aw', 'Administrator'),
(17, 6, 17, '2018-06-28', 'This is a comment from DSWD', 'DSWD'),
(18, 6, 17, '2018-06-28', 'jun2 coimment', 'DSWD'),
(19, 6, 12, '2018-06-29', 'this is a sample comment', 'Administrator'),
(20, 16, 7, '2018-06-29', 'jun bitch kaayo', 'CSSDO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family`
--

CREATE TABLE IF NOT EXISTS `tbl_family` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `tbl_family`
--

INSERT INTO `tbl_family` (`id`, `parent_id`, `student_id`, `deleted`) VALUES
(2, 2, 19, 0),
(4, 2, 19, 0),
(5, 2, 19, 0),
(6, 9, 19, 0),
(7, 19, 2, 0),
(8, 19, 1, 1),
(9, 19, 10, 1),
(10, 19, 0, 0),
(11, 19, 0, 0),
(12, 19, 0, 0),
(13, 19, 0, 0),
(14, 19, 0, 0),
(15, 19, 0, 0),
(16, 19, 0, 0),
(17, 19, 0, 0),
(18, 19, 0, 0),
(19, 19, 0, 0),
(20, 19, 7, 1),
(21, 19, 0, 0),
(23, 19, 0, 0),
(24, 19, 0, 0),
(25, 20, 0, 0),
(26, 20, 9, 0),
(27, 20, 0, 0),
(28, 19, 0, 0),
(29, 19, 0, 0),
(30, 21, 0, 0),
(31, 21, 11, 0),
(32, 21, 0, 0),
(33, 21, 0, 0),
(34, 21, 0, 0),
(35, 21, 0, 0),
(36, 21, 0, 0),
(37, 21, 0, 0),
(38, 21, 0, 0),
(39, 21, 0, 0),
(40, 21, 0, 0),
(41, 21, 0, 0),
(42, 21, 0, 0),
(43, 21, 0, 0),
(44, 21, 0, 0),
(45, 21, 0, 0),
(46, 20, 0, 0),
(47, 20, 0, 0),
(48, 21, 0, 0),
(49, 21, 0, 0),
(50, 21, 0, 0),
(51, 21, 0, 0),
(52, 21, 0, 0),
(53, 21, 0, 0),
(54, 21, 0, 0),
(55, 20, 0, 0),
(56, 19, 0, 0),
(57, 21, 0, 0),
(58, 20, 0, 0),
(59, 19, 0, 0),
(60, 21, 0, 0),
(61, 20, 0, 0),
(62, 20, 0, 0),
(63, 22, 0, 0),
(64, 21, 0, 0),
(65, 21, 0, 0),
(66, 22, 0, 0),
(67, 21, 0, 0),
(68, 21, 0, 0),
(69, 21, 0, 0),
(70, 21, 0, 0),
(71, 21, 0, 0),
(72, 21, 0, 0),
(73, 21, 0, 0),
(74, 20, 0, 0),
(75, 21, 0, 0),
(76, 21, 0, 0),
(77, 21, 0, 0),
(78, 21, 0, 0),
(79, 21, 0, 0),
(80, 21, 0, 0),
(81, 21, 0, 0),
(82, 22, 0, 0),
(83, 22, 0, 0),
(84, 20, 0, 0),
(85, 20, 0, 0),
(86, 21, 0, 0),
(87, 22, 0, 0),
(88, 20, 0, 0),
(89, 21, 0, 0),
(90, 22, 0, 0),
(91, 21, 0, 0),
(92, 21, 0, 0),
(93, 21, 0, 0),
(94, 22, 0, 0),
(95, 20, 0, 0),
(96, 21, 0, 0),
(97, 19, 0, 0),
(98, 19, 0, 0),
(99, 20, 0, 0),
(100, 21, 0, 0),
(101, 21, 9, 0),
(102, 20, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_variety`
--

CREATE TABLE IF NOT EXISTS `tbl_food_variety` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variety` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_food_variety`
--

INSERT INTO `tbl_food_variety` (`id`, `variety`, `credit`) VALUES
(1, 'Vegetables', 100),
(2, 'Fruits', 98),
(3, 'Meats', 85),
(4, 'Grain', 91),
(5, 'Milk', 94);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_health_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_health_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_check_up` date NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `bmi` double NOT NULL,
  `classification` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `tbl_health_profile`
--

INSERT INTO `tbl_health_profile` (`id`, `date_check_up`, `weight`, `height`, `bmi`, `classification`, `student_id`) VALUES
(10, '2018-04-10', 160, 73, 21.1, 'Normal', 6),
(11, '2018-04-10', 160, 731, 304, 'Obese', 2),
(12, '2018-04-10', 160, 73, 21.1, 'Normal', 1),
(13, '2018-04-10', 200, 73, 26.4, 'overweight', 1),
(14, '2018-04-10', 500, 100, 35.1, 'Obese', 1),
(15, '2018-04-10', 100, 73, 13.2, 'Underweight', 1),
(16, '2018-04-10', 180, 76, 21.9, 'Normal', 1),
(17, '2018-04-10', 200, 60, 39.1, 'Obese', 1),
(18, '2018-04-11', 120, 60, 23.4, 'Normal', 7),
(19, '2018-04-11', 250, 80, 27.5, 'overweight', 8),
(20, '2018-04-11', 180, 60, 35.1, 'Obese', 9),
(21, '2018-04-11', 120, 80, 13.2, 'Underweight', 10),
(22, '2018-04-11', 180, 90, 15.6, 'Underweight', 11),
(23, '2018-04-21', 301, 200, 75.3, 'Obese', 2),
(24, '2018-05-27', 500, 150, 222.2, 'Obese', 0),
(25, '2018-05-27', 232, 112, 184.9, 'Obese', 2),
(26, '2018-05-27', 233, 333, 21, 'Normal', 2),
(27, '2018-05-28', 200, 200, 50, 'Obese', 1),
(28, '2018-05-28', 233, 223, 46.9, 'Obese', 7),
(29, '2018-09-01', 15.2, 12, 1055.6, 'Overweight', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ingridients`
--

CREATE TABLE IF NOT EXISTS `tbl_ingridients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ingridient` varchar(150) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `budget` float NOT NULL,
  `price` float NOT NULL,
  `menu_id` int(11) NOT NULL,
  `liquidation` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `tbl_ingridients`
--

INSERT INTO `tbl_ingridients` (`id`, `ingridient`, `quantity`, `budget`, `price`, `menu_id`, `liquidation`) VALUES
(67, 'Kalabasa', '1', 100, 100, 16, 0),
(68, 'Alogbate', '1', 10, 10, 16, 0),
(69, 'Sibuyas Dahon', '10', 100, 5, 16, 0),
(70, 'manok', '1', 300, 200, 17, 0),
(71, 'Bombay', '1', 5, 5, 17, 0),
(72, 'Ahos', '2', 20, 10, 17, 0),
(73, 'sili', '1', 30, 20, 17, 0),
(80, 'sd', '2', 22, 22, 16, 0),
(81, 'w', '2', 2, 2, 16, 0),
(83, 'sdasd', '2', 4, 2, 16, 0),
(85, 'baatong', '2', 112, 56, 16, 0),
(87, 'Kalabasa', '1', 50, 50, 19, 50),
(88, 'Cow Meat', '1', 300, 300, 19, 300),
(89, 'Karneng baboy', '2', 360, 180, 19, 360),
(90, 'Karneng baboy', '3', 540, 180, 19, 400),
(93, 'Karneng baboy', '1', 180, 180, 20, 160),
(94, 'Kalabasa', '2', 100, 50, 20, 80),
(100, 'Mango', '1', 26.52, 26.52, 19, 26.52);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_liquidation`
--

CREATE TABLE IF NOT EXISTS `tbl_liquidation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `total_expenses` int(11) NOT NULL,
  `file_name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `tbl_liquidation`
--

INSERT INTO `tbl_liquidation` (`id`, `menu_id`, `total_expenses`, `file_name`) VALUES
(21, 8, 91, 'icons8-search-50.png'),
(22, 8, 91, 'icons8-shopping-cart-filled-50.png'),
(24, 6, 160, 'login.png'),
(26, 6, 160, 'PLAYGROUND.jpg'),
(48, 4, 0, 'noimage.png'),
(60, 4, 0, 'park png.png'),
(61, 4, 0, 'road.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meals`
--

CREATE TABLE IF NOT EXISTS `tbl_meals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `food_variety_id` int(11) NOT NULL,
  `servings` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_meals`
--

INSERT INTO `tbl_meals` (`id`, `student_id`, `food_variety_id`, `servings`, `credits`) VALUES
(1, 8, 2, 1, 100),
(2, 8, 4, 2, 90),
(5, 9, 2, 1, 50),
(9, 19, 2, 1, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(150) NOT NULL,
  `alloted_budget` float NOT NULL,
  `total_budget` float NOT NULL,
  `parent_id` int(11) NOT NULL,
  `prepared_by_id` int(11) NOT NULL,
  `date_chosen` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `menu`, `alloted_budget`, `total_budget`, `parent_id`, `prepared_by_id`, `date_chosen`) VALUES
(4, 'Adobong manok', 0, 888, 19, 0, '2018-04-18'),
(6, 'Nilagang Baboy', 0, 415, 19, 0, '2018-04-28'),
(8, 'Law oy', 0, 630, 20, 0, '2018-04-04'),
(11, 'menudo', 0, 600, 20, 0, '2018-05-01'),
(12, 'Menudo', 0, 500, 19, 0, '2018-04-20'),
(13, 'Pinakbet', 0, 200, 19, 0, '2018-04-27'),
(15, 'Law oy2', 0, 1280, 20, 0, '2018-07-03'),
(16, 'Law oy', 300, 627, 21, 0, '2018-11-01'),
(17, 'Adobo', 400, 325, 20, 0, '2018-11-02'),
(18, '', 600, 0, 23, 0, '2018-11-03'),
(19, 'Nilagang baka', 1300.25, 1276.52, 23, 12, '2019-01-08'),
(20, 'Adobong manok', 300, 280, 20, 17, '2019-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=204 ;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`id`, `post_id`, `user_id`, `user_type`, `posted_by`, `status`) VALUES
(29, 3, 1, 'Student', 12, 1),
(30, 3, 7, 'Student', 12, 0),
(31, 3, 8, 'Student', 12, 0),
(32, 3, 9, 'Student', 12, 0),
(33, 3, 10, 'Student', 12, 0),
(34, 3, 11, 'Student', 12, 0),
(35, 3, 12, 'Student', 12, 0),
(36, 3, 13, 'Student', 12, 0),
(37, 3, 14, 'Student', 12, 0),
(38, 3, 15, 'Student', 12, 0),
(39, 3, 16, 'Student', 12, 0),
(40, 3, 2, 'CSSDO', 12, 0),
(41, 3, 3, 'CSSDO', 12, 0),
(42, 3, 4, 'DSWD', 12, 0),
(43, 3, 5, 'CSSDO', 12, 0),
(44, 3, 6, 'CSSDO', 12, 0),
(45, 3, 7, 'CSSDO', 12, 0),
(46, 3, 9, 'CSSDO', 12, 0),
(47, 3, 10, 'Administrator', 12, 0),
(48, 3, 11, 'DSWD', 12, 0),
(49, 3, 12, 'Administrator', 12, 0),
(50, 3, 13, 'CSSDO', 12, 0),
(51, 3, 15, 'Administrator', 12, 0),
(52, 3, 16, 'Administrator', 12, 0),
(53, 3, 18, 'DSWD', 12, 0),
(54, 3, 19, 'Parent', 12, 1),
(55, 3, 20, 'Parent', 12, 0),
(56, 3, 21, 'Parent', 12, 0),
(57, 6, 17, 'DSWD', 12, 1),
(58, 3, 17, 'DSWD', 12, 0),
(59, 12, 1, 'Student', 17, 1),
(60, 12, 7, 'Student', 17, 0),
(61, 12, 8, 'Student', 17, 0),
(62, 12, 9, 'Student', 17, 0),
(63, 12, 10, 'Student', 17, 0),
(64, 12, 11, 'Student', 17, 0),
(65, 12, 12, 'Student', 17, 0),
(66, 12, 13, 'Student', 17, 0),
(67, 12, 14, 'Student', 17, 0),
(68, 12, 15, 'Student', 17, 0),
(69, 12, 16, 'Student', 17, 0),
(70, 12, 2, 'CSSDO', 17, 0),
(71, 12, 3, 'CSSDO', 17, 0),
(72, 12, 4, 'DSWD', 17, 0),
(73, 12, 5, 'CSSDO', 17, 0),
(74, 12, 6, 'CSSDO', 17, 0),
(75, 12, 7, 'CSSDO', 17, 0),
(76, 12, 9, 'CSSDO', 17, 0),
(77, 12, 10, 'Administrator', 17, 0),
(78, 12, 11, 'DSWD', 17, 0),
(79, 12, 12, 'Administrator', 17, 1),
(80, 12, 13, 'CSSDO', 17, 0),
(81, 12, 15, 'Administrator', 17, 0),
(82, 12, 16, 'Administrator', 17, 0),
(83, 12, 17, 'DSWD', 17, 0),
(84, 12, 18, 'DSWD', 17, 0),
(85, 12, 19, 'Parent', 17, 0),
(86, 12, 20, 'Parent', 17, 0),
(87, 12, 21, 'Parent', 17, 0),
(88, 13, 1, 'Student', 17, 1),
(89, 13, 7, 'Student', 17, 0),
(90, 13, 8, 'Student', 17, 0),
(91, 13, 9, 'Student', 17, 0),
(92, 13, 10, 'Student', 17, 0),
(93, 13, 11, 'Student', 17, 0),
(94, 13, 12, 'Student', 17, 0),
(95, 13, 13, 'Student', 17, 0),
(96, 13, 14, 'Student', 17, 0),
(97, 13, 15, 'Student', 17, 0),
(98, 13, 16, 'Student', 17, 0),
(99, 13, 2, 'CSSDO', 17, 0),
(100, 13, 3, 'CSSDO', 17, 0),
(101, 13, 4, 'DSWD', 17, 0),
(102, 13, 5, 'CSSDO', 17, 0),
(103, 13, 6, 'CSSDO', 17, 0),
(104, 13, 7, 'CSSDO', 17, 0),
(105, 13, 9, 'CSSDO', 17, 0),
(106, 13, 10, 'Administrator', 17, 0),
(107, 13, 11, 'DSWD', 17, 0),
(108, 13, 12, 'Administrator', 17, 1),
(109, 13, 13, 'CSSDO', 17, 0),
(110, 13, 15, 'Administrator', 17, 0),
(111, 13, 16, 'Administrator', 17, 0),
(112, 13, 17, 'DSWD', 17, 0),
(113, 13, 18, 'DSWD', 17, 0),
(114, 13, 19, 'Parent', 17, 0),
(115, 13, 20, 'Parent', 17, 0),
(116, 13, 21, 'Parent', 17, 0),
(117, 14, 1, 'Student', 17, 1),
(118, 14, 7, 'Student', 17, 0),
(119, 14, 8, 'Student', 17, 0),
(120, 14, 9, 'Student', 17, 0),
(121, 14, 10, 'Student', 17, 0),
(122, 14, 11, 'Student', 17, 0),
(123, 14, 12, 'Student', 17, 0),
(124, 14, 13, 'Student', 17, 0),
(125, 14, 14, 'Student', 17, 0),
(126, 14, 15, 'Student', 17, 0),
(127, 14, 16, 'Student', 17, 0),
(128, 14, 2, 'CSSDO', 17, 0),
(129, 14, 3, 'CSSDO', 17, 0),
(130, 14, 4, 'DSWD', 17, 0),
(131, 14, 5, 'CSSDO', 17, 0),
(132, 14, 6, 'CSSDO', 17, 0),
(133, 14, 7, 'CSSDO', 17, 0),
(134, 14, 9, 'CSSDO', 17, 0),
(135, 14, 10, 'Administrator', 17, 0),
(136, 14, 11, 'DSWD', 17, 0),
(137, 14, 12, 'Administrator', 17, 1),
(138, 14, 13, 'CSSDO', 17, 0),
(139, 14, 15, 'Administrator', 17, 0),
(140, 14, 16, 'Administrator', 17, 0),
(141, 14, 17, 'DSWD', 17, 0),
(142, 14, 18, 'DSWD', 17, 0),
(143, 14, 19, 'Parent', 17, 0),
(144, 14, 20, 'Parent', 17, 0),
(145, 14, 21, 'Parent', 17, 0),
(146, 15, 1, 'Student', 17, 1),
(147, 15, 7, 'Student', 17, 0),
(148, 15, 8, 'Student', 17, 0),
(149, 15, 9, 'Student', 17, 0),
(150, 15, 10, 'Student', 17, 0),
(151, 15, 11, 'Student', 17, 0),
(152, 15, 12, 'Student', 17, 0),
(153, 15, 13, 'Student', 17, 0),
(154, 15, 14, 'Student', 17, 0),
(155, 15, 15, 'Student', 17, 0),
(156, 15, 16, 'Student', 17, 0),
(157, 15, 2, 'CSSDO', 17, 0),
(158, 15, 3, 'CSSDO', 17, 0),
(159, 15, 4, 'DSWD', 17, 0),
(160, 15, 5, 'CSSDO', 17, 0),
(161, 15, 6, 'CSSDO', 17, 0),
(162, 15, 7, 'CSSDO', 17, 0),
(163, 15, 9, 'CSSDO', 17, 0),
(164, 15, 10, 'Administrator', 17, 0),
(165, 15, 11, 'DSWD', 17, 0),
(166, 15, 12, 'Administrator', 17, 1),
(167, 15, 13, 'CSSDO', 17, 0),
(168, 15, 15, 'Administrator', 17, 0),
(169, 15, 16, 'Administrator', 17, 0),
(170, 15, 17, 'DSWD', 17, 0),
(171, 15, 18, 'DSWD', 17, 0),
(172, 15, 19, 'Parent', 17, 0),
(173, 15, 20, 'Parent', 17, 0),
(174, 15, 21, 'Parent', 17, 0),
(175, 16, 1, 'Student', 7, 1),
(176, 16, 7, 'Student', 7, 0),
(177, 16, 8, 'Student', 7, 0),
(178, 16, 9, 'Student', 7, 0),
(179, 16, 10, 'Student', 7, 0),
(180, 16, 11, 'Student', 7, 0),
(181, 16, 12, 'Student', 7, 0),
(182, 16, 13, 'Student', 7, 0),
(183, 16, 14, 'Student', 7, 0),
(184, 16, 15, 'Student', 7, 0),
(185, 16, 16, 'Student', 7, 0),
(186, 16, 2, 'CSSDO', 7, 0),
(187, 16, 3, 'CSSDO', 7, 0),
(188, 16, 4, 'DSWD', 7, 0),
(189, 16, 5, 'CSSDO', 7, 0),
(190, 16, 6, 'CSSDO', 7, 0),
(191, 16, 7, 'CSSDO', 7, 0),
(192, 16, 9, 'CSSDO', 7, 0),
(193, 16, 10, 'Administrator', 7, 0),
(194, 16, 11, 'DSWD', 7, 0),
(195, 16, 12, 'Administrator', 7, 0),
(196, 16, 13, 'CSSDO', 7, 0),
(197, 16, 15, 'Administrator', 7, 0),
(198, 16, 16, 'Administrator', 7, 0),
(199, 16, 17, 'DSWD', 7, 0),
(200, 16, 18, 'DSWD', 7, 0),
(201, 16, 19, 'Parent', 7, 0),
(202, 16, 20, 'Parent', 7, 0),
(203, 16, 21, 'Parent', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` date NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `date_created`, `title`, `description`, `image_path`, `user_id`) VALUES
(3, '2018-06-26', 'Child Health Check up', 'Talk about a missed opportunity! Pediatric well visits are about so much more than getting shots and plotting your child''s climb up the growth chart. "That''s just part of it," explains Charles Shubin, M.D., director of pediatrics at Mercy Family Care in Baltimore. "There are also child safety issues to discuss and whether anything out of the ordinary is going on in the home. Plus there''s a whole other level to the exam, where we''re looking for age-appropriate developmental skills."', 'child_healthcheckup-300x300-3.jpg', 12),
(4, '2018-06-26', 'School Food Feeding Program', 'School feeding programs have been defined by the World Bank as "targeted social safety nets that provide both educational and health benefits to the most vulnerable children, thereby increasing enrollment rates, reducing absenteeism, and improving food security at the household level".', 'food_feeding_program.jpg', 12),
(6, '2018-06-27', 'Search for Volunteer', 'Before long, David carved out his niche volunteer role in the pediatric and neonatal intensive care units, offering comfort, support and hugs to parents and children. And he noticed that some patients, including those with Division of Family and Children Services, didnâ€™t receive many visitors. â€œThere were some babies no one was visiting or hugging, so I did,â€ he said.', 'volunteer-1.jpg', 7),
(16, '2018-06-29', 'this is a sample post', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '342.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reminder`
--

CREATE TABLE IF NOT EXISTS `tbl_reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` date NOT NULL,
  `reminder` text NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_reminder`
--

INSERT INTO `tbl_reminder` (`id`, `date_created`, `reminder`, `image_path`, `user_id`) VALUES
(2, '2018-06-26', 'A reminder notice, in the broadest and simplest sense, serves as a reminder to people of an important matter.It doesnâ€™t make sense to rely too much on a piece of paper, but if itâ€™s written on a reminder notice, youâ€™ll know that what youâ€™re being reminded about must be pretty important. Right?', 'img35.png', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

CREATE TABLE IF NOT EXISTS `tbl_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(150) NOT NULL,
  `address` varchar(500) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_school`
--

INSERT INTO `tbl_school` (`id`, `school_name`, `address`, `image_path`) VALUES
(1, 'Type the name of the school here', 'V mapa st., brgy tagbuan mandawe Davao City', 'school-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE IF NOT EXISTS `tbl_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`id`, `section`) VALUES
(2, 'a2'),
(3, 'awe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE IF NOT EXISTS `tbl_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` tinyint(2) NOT NULL,
  `age` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `image_path` varchar(50) NOT NULL,
  `student_height` float NOT NULL,
  `student_weight` float NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `age`, `birthday`, `citizenship`, `religion`, `address`, `class_section_id`, `account_id`, `image_path`, `student_height`, `student_weight`, `deleted`) VALUES
(1, 'Juana1', 'G', 'Dele Cruz', 0, 30, '2018-04-04', 'Filipino', 'Catholic', 'Toril City', 3, 12, 'bank.png', 100, 100, 1),
(2, 'jessie2323', 'm', 'Wew', 0, 26, '1999-06-01', 'filipino', 'catholic', 'Toril', 3, 15, 'traffic_lights-2.png', 0, 0, 1),
(3, 'Mitch', '', '', 0, 40, '1991-02-05', 'Phil-Am', '', 'Toril', 3, 15, 'noimage.png', 0, 0, 1),
(4, 'kk', '', '', 0, 20, '2018-02-02', 'd', '', 'sds', 3, 15, 'noimage.png', 0, 0, 1),
(5, 'jhon', '', '', 1, 52, '2018-02-02', 'philam', '', 'asds', 3, 15, 'noimage.png', 0, 0, 1),
(6, 'male', 'm', 'male', 0, 52, '2018-02-02', 'philam', 'aw', 'asdsd', 2, 15, 'noimage.png', 0, 0, 1),
(7, 'Juda1', 'L', 'Dele Cruz', 0, 23, '1986-07-24', 'Filipino', 'Born Again', 'Cotabato City', 3, 18, 'FOREST-1.png', 0, 0, 0),
(8, 'Julius', 'K', 'Gomez', 0, 56, '1993-10-20', 'Philam', 'Roman', 'Toril CIty', 3, 19, 'noimage.png', 0, 0, 0),
(9, 'Richelle', 'J', 'Guame', 0, 25, '2018-02-02', 'Filipino', 'Roman', 'Mati City', 2, 20, 'noimage.png', 0, 0, 0),
(10, 'Jason', 'm', 'raz', 1, 25, '1994-06-15', 'Filipino', 'Roman', 'TORIL CITY', 3, 21, 'gas_station.png', 0, 0, 0),
(11, 'Janine1', 'O', 'Opsten', 0, 10, '2018-04-23', 'Filipino', 'Roman', 'Davao City', 2, 26, 'AnonymBruker.png', 0, 0, 0),
(12, '231', '23', '23', 0, 23, '2018-05-10', '23', '23', '23', 2, 30, 'apo-3.jpg', 0, 0, 0),
(13, 'asasd', 'asdasd', 'asdasd', 0, 23, '2018-05-15', '23123', '2323', 'sdasd', 3, 31, 'apo-4.jpg', 0, 0, 0),
(14, '45', '45', '45', 0, 45, '2018-05-09', '45', '45', '45', 3, 32, 'apo-5.jpg', 0, 0, 0),
(15, '23', '23', '23', 1, 23, '2018-05-22', '23', '23', '23', 3, 33, 'apo-6.jpg', 0, 0, 0),
(16, 'aaa', 'aa', 'aa', 1, 23, '2018-05-06', 'aaa', 'aa', 'aaa', 3, 34, 'apo-7.jpg', 222, 222, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submitted_report`
--

CREATE TABLE IF NOT EXISTS `tbl_submitted_report` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `date_created` date NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `submitted_by` int(11) NOT NULL,
  `submitted_to` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
