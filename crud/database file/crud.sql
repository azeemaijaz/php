-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 20, 2020 at 11:01 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Places'),
(2, 'Flower'),
(3, 'Other'),
(4, 'Animal'),
(5, 'Student'),
(6, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(25) NOT NULL,
  `priority` varchar(20) NOT NULL,
  `notification` tinyint(1) NOT NULL DEFAULT 0,
  `category` int(11) NOT NULL,
  `tags` text NOT NULL,
  `post_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `date`, `time`, `priority`, `notification`, `category`, `tags`, `post_img`) VALUES
(1, 'Flower', '2020-03-20', '18:56', 'High', 1, 2, 'Entertainment,Nature,Education', '1584701873-Hydrangeas.jpg'),
(3, 'Light House', '2020-03-20', '21:08', 'Medium', 1, 1, 'Nature,Education', '1584702024-Lighthouse.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(100) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'Entertainment'),
(2, 'Nature'),
(3, 'Education'),
(4, 'Sports'),
(5, 'Technology');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
