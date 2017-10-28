-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 10:01 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aces`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_received`
--

CREATE TABLE `item_received` (
  `id` int(11) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `invoice_no` varchar(15) NOT NULL,
  `invoice_date` varchar(15) NOT NULL,
  `qty` int(10) NOT NULL,
  `amount_pc` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_received`
--

INSERT INTO `item_received` (`id`, `prod_id`, `invoice_no`, `invoice_date`, `qty`, `amount_pc`) VALUES
(59, 27, '00001', '2017-10-11', 20, 15),
(60, 24, '00001', '2017-10-24', 20, 20),
(61, 25, '0001', '2017-10-17', 50, 15);

-- --------------------------------------------------------

--
-- Table structure for table `item_total`
--

CREATE TABLE `item_total` (
  `id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `qty_received` int(10) NOT NULL,
  `qty_delivered` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_total`
--

INSERT INTO `item_total` (`id`, `product_id`, `qty_received`, `qty_delivered`) VALUES
(10, 27, 20, 0),
(11, 24, 20, 18),
(12, 25, 50, 8);

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `order_id` int(10) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_amount` double(10,2) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`order_id`, `order_date`, `order_amount`, `user_id`, `status`) VALUES
(11, '2017-10-28 03:03:25', 303.25, 6, 'processing'),
(12, '2017-10-28 03:24:55', 77.25, 6, 'processing'),
(13, '2017-10-28 03:26:45', 77.25, 6, 'processing'),
(14, '2017-10-28 03:30:55', 35.75, 6, 'processing');

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_price` double(10,2) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `order_line_id` int(10) NOT NULL,
  `prod_name` varchar(30) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`order_id`, `prod_id`, `prod_price`, `prod_qty`, `order_line_id`, `prod_name`, `order_date`) VALUES
(11, 24, 20.75, 11, 5, 'Filter Regulator', '2017-10-28 03:03:25'),
(11, 25, 15.00, 5, 6, 'Mist Filter Regulator', '2017-10-28 03:03:25'),
(12, 24, 20.75, 3, 7, 'Filter Regulator', '2017-10-28 03:24:56'),
(12, 25, 15.00, 1, 8, 'Mist Filter Regulator', '2017-10-28 03:24:56'),
(13, 24, 20.75, 3, 9, 'Filter Regulator', '2017-10-28 03:26:45'),
(13, 25, 15.00, 1, 10, 'Mist Filter Regulator', '2017-10-28 03:26:46'),
(14, 24, 20.75, 1, 11, 'Filter Regulator', '2017-10-28 03:30:55'),
(14, 25, 15.00, 1, 12, 'Mist Filter Regulator', '2017-10-28 03:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(10) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_desc` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prod_price` float NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prod_image` varchar(50) NOT NULL,
  `prod_category` int(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `critical_level` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_desc`, `created_date`, `prod_price`, `last_updated`, `prod_image`, `prod_category`, `status`, `critical_level`) VALUES
(23, 'F.R.L Combination NC-100', 'Brand: Chelic\r\nModel: NC-100', '2017-10-28 02:29:56', 15, '2017-10-28 03:10:40', 'F.R.L_Combination_NC-100', 8, 1, 10),
(24, 'Filter Regulator', 'Brand: Checlic\r\nModel: NFC-300', '2017-10-28 02:31:40', 20.75, '2017-10-28 02:31:40', 'Filter_Regulator.jpg', 8, 1, 25),
(25, 'Mist Filter Regulator', 'Brand: Chelic\r\nModel: MFR-200', '2017-10-28 02:32:36', 15, '2017-10-28 02:32:36', 'default.jpg', 8, 1, 20),
(26, 'MICRO MIST FILTER REGULATOR', 'Brand: Chelic\r\nModel: MFRD-300', '2017-10-28 02:33:35', 50, '2017-10-28 02:33:35', 'default.jpg', 8, 1, 20),
(27, 'FR.L COMBINATION (NFC-100)', 'Brand: Chelic\r\nModel: NFC-100', '2017-10-28 02:35:39', 35, '2017-10-28 02:36:34', 'FR.L_COMBINATION_(NFC-100)', 8, 1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(10) NOT NULL,
  `category_brand` varchar(50) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_brand`, `category_name`, `status`) VALUES
(8, '', 'Air Unit', 1),
(9, '', 'Solvenoid Valve', 1),
(10, '', 'Air Cylinder', 1),
(11, '', 'Gripper', 1),
(12, '', 'Vacuum Equipment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_bday` date NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_contactno` varchar(15) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` varchar(10) NOT NULL DEFAULT 'customer',
  `user_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_bday`, `user_pass`, `user_address`, `user_contactno`, `date_created`, `user_type`, `user_status`) VALUES
(1, 'Admin', 'admin@gmail.com', '1996-11-22', '0d225f8ee0155adab741d4210109d690', 'admin', '09179695868', '2017-10-24 11:30:38', 'superadmin', 1),
(2, 'Geeasdsfdsas', 'geeann1227@gmail.com', '1996-11-22', 'd41d8cd98f00b204e9800998ecf8427e', 'geeasinif', '09179586824', '2017-09-26 14:38:22', 'admin', 0),
(3, 'Customer', 'customer.test@a.c', '1996-11-22', '0d225f8ee0155adab741d4210109d690', 'Teresa', '09179695868', '2017-10-02 16:36:15', 'customer', 0),
(4, 'qshsfbjw', 'test@a.s', '1996-11-22', 'e10adc3949ba59abbe56e057f20f883e', 'teresa', '09179695868', '2017-10-05 14:15:18', 'customer', 1),
(5, 'abc', 'abc@a.b', '1996-11-22', '0d225f8ee0155adab741d4210109d690', 'abc', '09179695868', '2017-10-24 11:29:10', 'customer', 1),
(6, 'testing customer', 'testing@gmail.com', '1996-11-22', 'e10adc3949ba59abbe56e057f20f883e', 'Boulevard St. Dalig Teresa Rizal', '09179695868', '2017-10-28 02:11:11', 'customer', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_received`
--
ALTER TABLE `item_received`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_total`
--
ALTER TABLE `item_total`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`order_line_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_received`
--
ALTER TABLE `item_received`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `item_total`
--
ALTER TABLE `item_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_header`
--
ALTER TABLE `order_header`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `order_line_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
