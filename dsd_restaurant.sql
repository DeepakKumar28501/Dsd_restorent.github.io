-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 27, 2019 at 06:49 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsd_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `brand_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `timestamp`, `brand_name`) VALUES
(1, '2019-04-14 15:17:37', 'FOOD'),
(2, '2019-04-14 15:46:08', 'ice cream'),
(3, '2019-04-14 15:46:54', 'drink'),
(4, '2019-04-15 06:28:30', 'dessert'),
(5, '2019-04-15 06:28:58', 'tea & coffee');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `ttl_price` varchar(50) NOT NULL,
  `admin_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `timestamp`, `order_id`, `name`, `mobile`, `ttl_price`, `admin_id`) VALUES
(1, '2019-04-17 03:17:17', '1555471014', 'Mithun', '7823136987', '125', '1'),
(2, '2019-04-22 12:33:06', '1555936361', 'Suman', '8548858936', '510', '1'),
(3, '2019-04-22 12:39:08', '1555936706', 'Harendra', '7451810430', '35', '1'),
(4, '2019-04-22 13:03:51', '1555938134', 'suman', '8452369720', '321', '2'),
(5, '2019-05-12 12:29:53', '1557664161', 'shivam', '85338954650', '581', '2'),
(6, '2019-05-17 08:04:50', '1558080171', 'Anurag', '8533798455', '442', '2'),
(7, '2019-05-31 15:15:33', '1559315704', 'xyz', '8539896', '82', '1');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_name` varchar(50) NOT NULL,
  `brand_id` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `timestamp`, `item_name`, `brand_id`, `price`) VALUES
(1, '2019-05-16 17:12:48', 'tea', '3', '11'),
(2, '2019-04-15 01:28:17', 'coc', '3', '35'),
(3, '2019-04-19 02:15:19', 'coca', '31', '101'),
(4, '2019-05-16 17:14:36', 'vanilla/strawberry', '2', '52'),
(5, '2019-04-15 06:26:06', 'tutti fruti', '2', '60'),
(6, '2019-04-15 06:27:40', 'pineapple', '2', '60'),
(7, '2019-04-15 06:28:02', 'chocolate', '2', '60'),
(8, '2019-04-21 08:38:10', 'gulab jamun', '4', '60'),
(9, '2019-04-15 06:30:10', 'halwa (seasonal)', '4', '60'),
(10, '2019-05-16 17:49:13', 'Coffee Mocachino', '5', '51'),
(11, '2019-04-18 16:38:53', 'Coffee Americano (Black)', '5', '55'),
(12, '2019-05-14 06:23:49', 'butter scotch', '2', '60'),
(13, '2019-05-14 06:24:24', 'kaju kishmish', '2', '60'),
(14, '2019-05-17 08:07:29', 'xyz', '2', '30');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `timestamp`, `username`, `password`) VALUES
(1, '2019-05-17 08:02:12', 'ajeet', '12345'),
(2, '2019-05-17 08:02:21', 'utkarsh', '1234'),
(3, '2019-05-17 08:02:29', 'anurag', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_id` varchar(50) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `timestamp`, `order_id`, `item_id`, `qty`) VALUES
(1, '2019-04-17 03:17:17', '1555471014', '5', '1'),
(2, '2019-04-17 03:17:17', '1555471014', '1', '3'),
(3, '2019-04-17 03:17:17', '1555471014', '2', '1'),
(4, '2019-04-22 12:33:06', '1555936361', '4', '10'),
(5, '2019-04-22 12:39:08', '1555936706', '1', '0'),
(6, '2019-04-22 12:39:08', '1555936706', '2', '1'),
(7, '2019-04-22 13:03:52', '1555938134', '4', '1'),
(8, '2019-04-22 13:03:52', '1555938134', '5', '1'),
(9, '2019-04-22 13:03:52', '1555938134', '7', '1'),
(10, '2019-04-22 13:03:52', '1555938134', '2', '1'),
(11, '2019-04-22 13:03:52', '1555938134', '8', '1'),
(12, '2019-04-22 13:03:52', '1555938134', '11', '1'),
(13, '2019-05-12 12:29:53', '1557664161', '4', '6'),
(14, '2019-05-12 12:29:53', '1557664161', '5', '1'),
(15, '2019-05-12 12:29:53', '1557664161', '2', '1'),
(16, '2019-05-12 12:29:53', '1557664161', '8', '3'),
(17, '2019-05-17 08:04:50', '1558080171', '5', '2'),
(18, '2019-05-17 08:04:50', '1558080171', '1', '2'),
(19, '2019-05-17 08:04:50', '1558080171', '8', '5'),
(20, '2019-05-31 15:15:33', '1559315704', '7', '1'),
(21, '2019-05-31 15:15:34', '1559315704', '1', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
