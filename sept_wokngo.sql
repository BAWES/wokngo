-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2014 at 01:15 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sept_wokngo`
--
CREATE DATABASE IF NOT EXISTS `sept_wokngo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sept_wokngo`;

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE IF NOT EXISTS `approval` (
  `approval_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `approval_type` enum('image','desc') NOT NULL,
  `approval_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`approval_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(120) NOT NULL,
  `customer_email` varchar(120) NOT NULL,
  `customer_password` varchar(120) NOT NULL,
  `customer_civil_id` varchar(42) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_phone`, `customer_email`, `customer_password`, `customer_civil_id`) VALUES
(1, 'Khalid Al-Mutawa', '99811042', 'khalid@khalidm.net', 'bb752c04cc05bc3ac00dcb09f2eba17a', '2147483647'),
(2, 'Altaf Al-Mutawa', '99774011', 'm6awa3@gmail.com', 'bb752c04cc05bc3ac00dcb09f2eba17a', '289100500863'),
(3, 'Dalia Al-Mutawa', '96758392', 'kalmutawa@ghaliah.com', 'bb752c04cc05bc3ac00dcb09f2eba17a', '289100500880'),
(4, 'Jasim Al-Mutawa', '99837283', 'tech@ghaliah.com', 'bb752c04cc05bc3ac00dcb09f2eba17a', '289100500868');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_name` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_ingredients` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `item_image` varchar(80) DEFAULT NULL,
  `item_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`item_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `customer_id`, `item_name`, `item_ingredients`, `item_image`, `item_description`) VALUES
(1, 1, 'Ninja Box', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(2, 1, 'Second Ninja Box', 'egg noodles', NULL, 'I LOVE THIS BOX! I ALWAYS ORDER IT! You must try it!'),
(3, 2, 'Chicken Box', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(4, 2, 'Second Chicken Box', 'egg noodles', NULL, NULL),
(5, 2, 'Fat Box', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(6, 2, 'Second Fat Box', 'egg noodles', NULL, NULL),
(7, 2, 'The Hungry Box', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(8, 2, 'The Feeder', 'egg noodles', NULL, NULL),
(9, 1, 'Dancing Monkey', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(10, 1, 'Ascia Favorite', 'egg noodles', NULL, NULL),
(11, 3, 'Plain Chicken', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(12, 3, 'Extra Beef', 'egg noodles', NULL, 'I LOVE THIS BOX! I ALWAYS ORDER IT! You must try it!'),
(13, 3, 'Hunger Strikes', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(14, 3, 'Starving Again', 'egg noodles', NULL, NULL),
(15, 3, 'Ghaliah Technology', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(16, 4, 'I like to wok', 'egg noodles', NULL, NULL),
(17, 4, 'feedme', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(18, 4, 'Why not', 'egg noodles', NULL, NULL),
(19, 4, 'Move it', 'egg noodles, shrimp, chili sauce, carrots', NULL, NULL),
(20, 4, 'Terminator', 'egg noodles', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sale_quantity` int(11) NOT NULL,
  `sale_datetime` datetime NOT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `item_id`, `sale_quantity`, `sale_datetime`) VALUES
(1, 1, 3, '2014-02-24 15:24:27'),
(2, 2, 2, '2014-02-24 15:25:08'),
(3, 1, 1, '2014-02-22 15:24:27'),
(4, 1, 5, '2014-02-23 15:24:27'),
(5, 1, 1, '2014-02-24 15:27:45'),
(6, 3, 10, '2014-02-12 15:24:27'),
(7, 4, 2, '2014-02-13 15:25:08'),
(8, 5, 1, '2014-02-14 15:24:27'),
(9, 6, 3, '2014-02-15 15:24:27'),
(10, 6, 5, '2014-02-16 15:27:45');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval`
--
ALTER TABLE `approval`
  ADD CONSTRAINT `approval_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
