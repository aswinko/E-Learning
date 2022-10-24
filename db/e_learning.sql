-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 24, 2022 at 04:36 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

DROP TABLE IF EXISTS `cart_details`;
CREATE TABLE IF NOT EXISTS `cart_details` (
  `course_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_icon`) VALUES
(1, 'Web Development', 'bi bi-file-earmark-code'),
(2, 'Android Development', 'bi bi-android2'),
(3, 'Bootstrap 5', 'bi bi-bootstrap'),
(4, 'Blockchain', 'bi bi-lightbulb'),
(5, 'Geology', 'bi bi-pin-map'),
(6, 'Algo', 'bi bi-bounding-box'),
(7, 'Forensic Science', 'bi bi-bandaid'),
(8, 'Videography', 'bi bi-camera-reels'),
(14, 'Software Testing', 'bi-microsoft'),
(17, 'new', 'bi-code');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `price` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `course_keywords` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `lecture1` varchar(255) NOT NULL,
  `lecture2` varchar(255) NOT NULL,
  `lecture3` varchar(255) NOT NULL,
  `lecture4` varchar(255) NOT NULL,
  `lecture5` varchar(255) NOT NULL,
  `lecture6` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `instructor_email`, `title`, `author`, `rating`, `price`, `description`, `date`, `course_keywords`, `category_id`, `thumbnail`, `lecture1`, `lecture2`, `lecture3`, `lecture4`, `lecture5`, `lecture6`, `status`) VALUES
(8, 'ammu@gmail.com', 'C++: From Beginner to Expert', 'Feba Mariya Biju', '4.1', '5236', 'Designed for people who don\'t have any knowledge about the programming and want to program in C++', NULL, 'c, c++, cpp, feba', 1, '55554.jpg', '', '', '', '', '', '', 'true'),
(9, 'ammu@gmail.com', 'Creating a Responsive HTML Email', 'Maya Varghese', '2.1', '5199', 'Creating a Responsive HTML Email', '2022-10-22 06:00:59', 'css, html, javascript', 4, '1', '', '', '', '', '', '', 'true'),
(11, 'adhi@gmail.com', 'Learn Python: Python for Beginners', 'Antony sam', '3.9', '5999', 'Learn A-Z everything about Python, from the basics, to advanced topics like Python GUI, Python Data Analysis, and more!', NULL, 'python, gui, data', 5, '13889.jpg', '', '', '', '', '', '', 'true'),
(41, 'ammu@gmail.com', 'sdw', 'ammu', '', '232', 'dfsssd', '2022-10-19 16:23:08', 'sds', 5, '13885.jpg', '20210825_185553-1.mp4', '20210825_185451.mp4', '20210813_165219.mp4', '20210825_185553-1.mp4', '20210825_185451.mp4', '20210813_165219.mp4', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE IF NOT EXISTS `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about_me` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `name`, `email`, `profile_img`, `bio`, `phone`, `address`, `about_me`, `password`, `created_at`) VALUES
(1, 'aswin', 'aswin@gmail.com', 'aswin - 2022.10.24 - 05.30.15am.png', '', '', '', NULL, 'Kuttan1633@', '2022-10-02 06:28:32'),
(2, 'aswin k', 'adhi@gmail.com', NULL, '', '', '', NULL, 'Kuttan1633@', '2022-10-02 07:58:18'),
(3, 'ammu', 'ammu@gmail.com', 'ammu - 2022.10.24 - 06.07.08am.png', 'developer', '', '', 'I am a Web Developer', 'Kuttan1633@', '2022-10-04 07:02:15'),
(4, 'Aswin K O', 'aswinko479@gmail.com', NULL, NULL, '8136945810', NULL, NULL, 'Kuttan1633@', '2022-10-24 05:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

DROP TABLE IF EXISTS `orders_pending`;
CREATE TABLE IF NOT EXISTS `orders_pending` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchased_courses`
--

DROP TABLE IF EXISTS `purchased_courses`;
CREATE TABLE IF NOT EXISTS `purchased_courses` (
  `order_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchased_courses`
--

INSERT INTO `purchased_courses` (`order_id`, `course_id`, `user_id`) VALUES
(4, 8, 1),
(5, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(32) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `password`, `email`, `bio`, `phone`, `address`, `profile_img`) VALUES
(1, 'aswin', 'Aswin K O', '1234', 'aswinko479@gmail.com', 'Web Developer', '8136945810', 'Changanacherry', 'aswin - 2022.10.24 - 04.22.23am.png'),
(2, 'ammu', 'er', '1234', 'john@example.com', 'Full Stack Developer', '(+91) 380-4539', 'Bay Area, San Francisco, CA', 'ammu - 2022.10.23 - 07.12.08am.jpg'),
(3, 'abc', 'Aswin', '12234', 'ammu1234@gmail.com', 'Full Stack', '1928237772', 'Kalampattu h', 'abc - 2022.10.23 - 10.27.33am.jpg'),
(4, 'ammuappu', '', 'aswin@123', 'aswinko@gmail.com', NULL, NULL, NULL, NULL),
(5, 'adhi', '', '1234', 'hannamariyabiju@gmail.com', NULL, NULL, NULL, NULL),
(6, 'as', '', 'aswin1234@', 'asd@ds.com', NULL, NULL, NULL, NULL),
(7, 'aswin123', '', 'aswinko479@', 'aswinko479@gmail.com', NULL, NULL, NULL, NULL),
(8, 'aswin1234', '', '1234aswin@', 'aswinko479@gmail.com', 'bjh', NULL, NULL, NULL),
(9, 'adhi123', '', '12345aswin@', 'adhi123@gmail.com', NULL, NULL, NULL, NULL),
(10, 'baby123', '', 'Kuttan1633@', 'baby@gmail.com', NULL, NULL, NULL, NULL),
(11, 'aswinko', NULL, 'Kuttan1633@', 'aswin@gmail.com', NULL, '8136945810', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

DROP TABLE IF EXISTS `user_orders`;
CREATE TABLE IF NOT EXISTS `user_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice` int(255) NOT NULL,
  `total_courses` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice`, `total_courses`, `order_status`, `order_date`) VALUES
(1, 2, 8198, 145394904, 2, 'pending', '2022-10-10 14:36:53'),
(2, 2, 8198, 1428984993, 2, 'pending', '2022-10-10 14:36:57'),
(3, 2, 8198, 1055950455, 2, 'complete', '2022-10-10 14:37:20'),
(4, 1, 5236, 1540494573, 1, 'complete', '2022-10-22 15:33:06'),
(5, 1, 5999, 862250750, 1, 'pending', '2022-10-22 15:35:16'),
(6, 1, 5999, 1429582406, 1, 'pending', '2022-10-22 15:43:48'),
(7, 1, 5999, 289183650, 1, 'complete', '2022-10-22 15:44:29'),
(8, 1, 5999, 88667921, 1, 'complete', '2022-10-22 15:45:32'),
(9, 1, 5999, 1052513475, 1, 'complete', '2022-10-22 15:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

DROP TABLE IF EXISTS `user_payment`;
CREATE TABLE IF NOT EXISTS `user_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_payment`
--

INSERT INTO `user_payment` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `country`, `state`, `date`) VALUES
(1, 3, 1055950455, 8198, 'cod', 'India', 'Kerala', '2022-10-10 14:37:29'),
(2, 4, 1540494573, 5236, 'cod', 'India', 'Kerala', '2022-10-22 15:33:20'),
(3, 7, 289183650, 5999, 'cod', 'India', 'Kerala', '2022-10-22 15:44:41'),
(4, 7, 289183650, 5999, 'cod', 'India', 'Kerala', '2022-10-22 15:45:14'),
(5, 8, 88667921, 5999, 'cod', 'India', 'Kerala', '2022-10-22 15:48:11'),
(6, 8, 88667921, 5999, 'cod', 'India', 'Kerala', '2022-10-22 15:49:18'),
(7, 9, 1052513475, 5999, 'cod', 'India', 'Kerala', '2022-10-22 15:50:20'),
(8, 9, 1052513475, 5999, 'cod', 'India', 'Kerala', '2022-10-22 15:50:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
