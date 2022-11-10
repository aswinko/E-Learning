-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2022 at 02:24 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `instructor_email`, `title`, `author`, `rating`, `price`, `description`, `date`, `course_keywords`, `category_id`, `thumbnail`, `lecture1`, `lecture2`, `lecture3`, `lecture4`, `lecture5`, `lecture6`, `status`) VALUES
(8, 'ammu@gmail.com', 'C++: From Beginner to Expert', 'Feba Mariya Biju', '4.1', '100001', 'C++: From Beginner to Expert', '2022-11-06 08:53:33', 'c, c++, cpp, feba', 14, '564154.jpg', '20210825_185553-1.mp4', '20210825_185553-1.mp4', '20210813_165219.mp4', '20210813_165219.mp4', '20210825_185553-1.mp4', '20210825_185451.mp4', 'true'),
(11, 'adhi@gmail.com', 'Learn Python: Python for Beginners', 'Antony sam', '3.9', '5999', 'Learn Python: Python for Beginners', '2022-11-06 08:53:51', 'python, gui, data', 5, '564027.jpg', 'VID_20210923_183422.mp4', '20210825_185553-1.mp4', 'Cobra - Adheeraa Lyric - Chiyaan Vikram - @A. R. Rahman - Ajay Gnanamuthu - 7 Screen Studio_audio.mp4', '20210813_165219.mp4', '20210825_185553-1.mp4', '[Slowed Reverb] Hookah bar - Himesh Reshammiya -Vhan Muzic_audio.mp4', 'true'),
(41, 'ammu@gmail.com', 'Learn HTML in 100 days', 'ammu', '', '4999', 'Learn HTML in 100 days', '2022-11-06 08:54:03', 'html, web', 1, '1135494.jpg', '', '', '[Slowed Reverb] Hookah bar - Himesh Reshammiya -Vhan Muzic_audio.mp4', '', 'Cobra - Adheeraa Lyric - Chiyaan Vikram - @A. R. Rahman - Ajay Gnanamuthu - 7 Screen Studio_audio.mp4', 'VID_20210923_183422.mp4', 'pending'),
(42, 'ammu@gmail.com', 'Learn PHP', 'ammu', '', '3999', 'Learn PHP', '2022-11-06 08:54:16', 'php, server, web', 1, '1155345.jpg', 'VID_20210923_183422.mp4', '20210825_185553-1.mp4', '20210825_185451.mp4', '20210813_165219.mp4', 'Cobra - Adheeraa Lyric - Chiyaan Vikram - @A. R. Rahman - Ajay Gnanamuthu - 7 Screen Studio_audio.mp4', '[Slowed Reverb] Hookah bar - Himesh Reshammiya -Vhan Muzic_audio.mp4', 'pending');

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
(3, 'ammu', 'ammu@gmail.com', 'ammu - 2022.11.06 - 08.55.50am.jpg', 'developer', '8136945810', 'changanacherry', 'I am a Web Developer', 'Kuttan1633@', '2022-10-04 07:02:15'),
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
  `order_id` int(11) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchased_courses`
--

INSERT INTO `purchased_courses` (`order_id`, `course_id`, `user_id`, `purchase_status`) VALUES
(1, 41, 1, 'success'),
(1, 42, 1, 'success'),
(2, 8, 1, 'success');

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
(1, 'aswin', 'Aswin K O', '1234', 'aswinko479@gmail.com', 'Web Developer', '8136945810', 'Changanacherry', 'aswin - 2022.11.06 - 08.55.02am.jpg'),
(2, 'ammu', 'Ammu', '1234', 'john@example.com', 'Full Stack Developer', '(+91) 380-4539', 'Bay Area, San Francisco, CA', 'ammu - 2022.11.05 - 09.40.02am.jpg'),
(3, 'abc', 'Aswin', '12234', 'ammu1234@gmail.com', 'Full Stack', '1928237772', 'Kalampattu h', 'abc - 2022.10.23 - 10.27.33am.jpg'),
(4, 'ammuappu', '', 'aswin@123', 'aswinko@gmail.com', NULL, NULL, NULL, NULL),
(5, 'adhi', '', '1234', 'hannamariyabiju@gmail.com', NULL, NULL, NULL, NULL),
(6, 'as', '', 'aswin1234@', 'asd@ds.com', NULL, NULL, NULL, NULL),
(7, 'aswin123', '', 'aswinko479@', 'aswinko479@gmail.com', NULL, NULL, NULL, NULL),
(8, 'aswin1234', '', '1234aswin@', 'aswinko479@gmail.com', 'bjh', NULL, NULL, NULL),
(9, 'adhi123', '', '12345aswin@', 'adhi123@gmail.com', NULL, NULL, NULL, NULL),
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
  `no_of_courses_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice`, `total_courses`, `order_status`, `no_of_courses_id`, `order_date`) VALUES
(1, 1, 8998, 199740619, 2, 'complete', NULL, '2022-11-09 16:09:48'),
(2, 1, 100001, 147080159, 1, 'complete', NULL, '2022-11-09 16:26:54');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_payment`
--

INSERT INTO `user_payment` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `country`, `state`, `date`) VALUES
(1, 1, 199740619, 8998, 'cod', 'India', 'Kerala', '2022-11-09 16:10:10'),
(2, 2, 147080159, 100001, 'cod', 'India', 'Kerala', '2022-11-09 16:27:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
