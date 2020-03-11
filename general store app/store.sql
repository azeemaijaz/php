-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2020 at 03:58 AM
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
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` varchar(20) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `username`, `password`, `created`) VALUES
(1, 'azm', 'YWp6', '2020-03-11 03:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `brand_name` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `brand_name`, `quantity`, `price`) VALUES
(1, 'Thumbs Up', 'Cola', '500ml', 35),
(2, 'Uncle Chips', 'Potato Chips', '50 gr', 10),
(3, 'Parle G', 'Parle Products', '1 packet', 10),
(4, 'Hide & Seek', 'Parle Products', '1 packet', 30),
(5, 'Dark Temptation', 'Axe', '150 ml', 200),
(6, 'Pulse Deodorent', 'Axe', '150 ml', 190),
(7, 'Amul Masti Dahi', 'Amul', '1 Kg', 55),
(8, 'Basmati Rice Classic', 'India Gate', '1 Kg', 195),
(9, 'Traditional Basmati Rice', 'Dawat', '1 Kg', 185),
(10, 'Mountain Dew', 'PepsiCo', '2 Ltr', 65),
(11, 'Horlicks Growth - Chocolate Flavor', 'GlaxoSmithKline', '200 gr', 320),
(12, 'Bournvita Refill', 'chocolate malt drink', '500 gr', 198),
(13, 'Maggi 2 Minutes Noodles', 'Nestle', '70 gr', 12);

-- --------------------------------------------------------

--
-- Table structure for table `shopkeeper`
--

DROP TABLE IF EXISTS `shopkeeper`;
CREATE TABLE IF NOT EXISTS `shopkeeper` (
  `vendor_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`vendor_id`),
  UNIQUE KEY `username` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopkeeper`
--

INSERT INTO `shopkeeper` (`vendor_id`, `mobile`, `password`, `created`) VALUES
(1, '9090909090', 'YXptYWp6', '2020-03-10 22:18:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
