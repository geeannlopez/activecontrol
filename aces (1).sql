-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2017 at 02:10 AM
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
  `invoice_no` varchar(15) DEFAULT NULL,
  `invoice_date` varchar(15) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `amount_pc` float NOT NULL,
  `date_received` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_received`
--

INSERT INTO `item_received` (`id`, `prod_id`, `invoice_no`, `invoice_date`, `qty`, `amount_pc`, `date_received`, `remarks`) VALUES
(59, 27, '00001', '2017-10-11', 20, 15, '2017-10-11 00:00:00', NULL),
(60, 24, '00001', '2017-10-24', 20, 20, '2017-10-24 00:00:00', NULL),
(61, 25, '0001', '2017-10-17', 50, 15, '2017-10-17 00:00:00', NULL),
(62, 24, '00002', '2017-10-27', 100, 20, '2017-10-27 00:00:00', NULL),
(63, 28, '00004', '2017-10-28', 50, 25, '2017-10-28 00:00:00', NULL),
(64, 25, '0002', '2017-10-18', 50, 20, '2017-10-18 00:00:00', NULL),
(65, 27, '0003', '2017-11-06', 10, 15, '2017-11-06 00:00:00', NULL),
(101, 24, '15', NULL, 1, 0, '2017-11-07 17:20:01', 'cancelled order (order id: 15)'),
(102, 25, '15', NULL, 2, 0, '2017-11-07 17:20:01', 'cancelled order (order id: 15)'),
(103, 24, '12', NULL, 3, 0, '2017-11-10 10:08:28', 'cancelled order (order id: 12)'),
(104, 25, '12', NULL, 1, 0, '2017-11-10 10:08:28', 'cancelled order (order id: 12)');

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
(10, 27, 30, 18),
(11, 24, 124, 35),
(12, 25, 103, 13),
(13, 28, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `order_id` int(10) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `order_amount` double(10,2) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'processing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`order_id`, `order_date`, `date_updated`, `order_amount`, `user_id`, `status`) VALUES
(11, '2017-10-28 03:03:25', '2017-10-29 22:23:50', 303.25, 6, 'delivery'),
(12, '2017-10-28 03:24:55', '2017-11-10 10:08:28', 77.25, 6, 'cancelled'),
(13, '2017-10-28 03:26:45', '2017-11-07 17:17:55', 77.25, 6, 'delivery'),
(14, '2017-10-28 03:30:55', '2017-11-07 17:17:59', 35.75, 6, 'delivery'),
(15, '2017-10-28 11:02:32', '2017-11-07 17:20:01', 50.75, 6, 'cancelled'),
(16, '2017-10-28 11:11:50', '2017-10-29 22:25:13', 20.75, 6, 'delivery'),
(17, '2017-10-28 16:03:48', '2017-10-29 22:25:16', 15.00, 0, 'received'),
(18, '2017-11-03 18:13:49', '0000-00-00 00:00:00', 90.75, 3, 'processing'),
(19, '2017-11-03 18:19:49', '0000-00-00 00:00:00', 105.00, 3, 'processing'),
(20, '2017-11-03 18:21:00', '0000-00-00 00:00:00', 140.00, 3, 'processing'),
(21, '2017-11-06 20:17:07', '0000-00-00 00:00:00', 70.75, 3, 'processing'),
(22, '2017-11-06 20:31:06', '0000-00-00 00:00:00', 35.00, 3, 'processing'),
(23, '2017-11-06 20:36:23', '0000-00-00 00:00:00', 35.00, 3, 'processing'),
(24, '2017-11-06 22:35:55', '0000-00-00 00:00:00', 90.75, 3, 'processing'),
(25, '2017-11-07 09:21:59', '0000-00-00 00:00:00', 138.75, 3, 'processing'),
(26, '2017-11-07 09:32:03', '0000-00-00 00:00:00', 124.50, 3, 'processing'),
(27, '2017-11-07 13:32:52', '0000-00-00 00:00:00', 35.00, 3, 'processing'),
(28, '2017-11-10 09:17:09', '0000-00-00 00:00:00', 70.75, 3, 'processing'),
(29, '2017-11-10 09:32:27', '0000-00-00 00:00:00', 35.00, 3, 'processing');

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
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`order_id`, `prod_id`, `prod_price`, `prod_qty`, `order_line_id`, `prod_name`, `order_date`, `remarks`) VALUES
(11, 24, 20.75, 11, 5, 'Filter Regulator', '2017-10-28 03:03:25', NULL),
(11, 25, 15.00, 5, 6, 'Mist Filter Regulator', '2017-10-28 03:03:25', NULL),
(12, 24, 20.75, 3, 7, 'Filter Regulator', '2017-10-28 03:24:56', NULL),
(12, 25, 15.00, 1, 8, 'Mist Filter Regulator', '2017-10-28 03:24:56', NULL),
(13, 24, 20.75, 3, 9, 'Filter Regulator', '2017-10-28 03:26:45', NULL),
(13, 25, 15.00, 1, 10, 'Mist Filter Regulator', '2017-10-28 03:26:46', NULL),
(14, 24, 20.75, 1, 11, 'Filter Regulator', '2017-10-28 03:30:55', NULL),
(14, 25, 15.00, 1, 12, 'Mist Filter Regulator', '2017-10-28 03:30:55', NULL),
(15, 24, 20.75, 1, 13, 'Filter Regulator', '2017-10-28 11:02:33', NULL),
(15, 25, 15.00, 2, 14, 'Mist Filter Regulator', '2017-10-28 11:02:33', NULL),
(16, 24, 20.75, 1, 15, 'Filter Regulator', '2017-10-28 11:11:50', NULL),
(17, 25, 15.00, 1, 16, 'Mist Filter Regulator', '2017-10-28 16:03:48', NULL),
(18, 27, 35.00, 2, 17, 'FR.L COMBINATION NC-200', '2017-11-03 18:13:49', NULL),
(18, 24, 20.75, 1, 18, 'Filter Regulator', '2017-11-03 18:13:49', NULL),
(19, 27, 35.00, 3, 19, 'FR.L COMBINATION NC-200', '2017-11-03 18:19:49', NULL),
(20, 27, 35.00, 4, 20, 'FR.L COMBINATION NC-200', '2017-11-03 18:21:00', NULL),
(21, 27, 35.00, 1, 21, 'FR.L COMBINATION NC-200', '2017-11-06 20:17:07', NULL),
(21, 24, 20.75, 1, 22, 'Filter Regulator', '2017-11-06 20:17:07', NULL),
(21, 25, 15.00, 1, 23, 'Mist Filter Regulator', '2017-11-06 20:17:07', NULL),
(22, 27, 35.00, 1, 24, 'FR.L COMBINATION NC-200', '2017-11-06 20:31:07', NULL),
(23, 27, 35.00, 1, 25, 'FR.L COMBINATION NC-200', '2017-11-06 20:36:24', NULL),
(24, 27, 35.00, 2, 26, 'FR.L COMBINATION NC-200', '2017-11-06 22:35:55', NULL),
(24, 24, 20.75, 1, 27, 'Filter Regulator', '2017-11-06 22:35:56', NULL),
(25, 27, 35.00, 1, 28, 'FR.L COMBINATION NC-200', '2017-11-07 09:21:59', NULL),
(25, 24, 20.75, 5, 29, 'Filter Regulator', '2017-11-07 09:21:59', NULL),
(26, 24, 20.75, 6, 30, 'Filter Regulator', '2017-11-07 09:32:03', NULL),
(27, 27, 35.00, 1, 31, 'FR.L COMBINATION NC-200', '2017-11-07 13:32:52', NULL),
(28, 24, 20.75, 1, 32, 'Filter Regulator', '2017-11-10 09:17:09', NULL),
(28, 27, 35.00, 1, 33, 'FR.L COMBINATION NC-200', '2017-11-10 09:17:09', NULL),
(28, 25, 15.00, 1, 34, 'Mist Filter Regulator', '2017-11-10 09:17:09', NULL),
(29, 27, 35.00, 1, 35, 'FR.L COMBINATION NC-200', '2017-11-10 09:32:27', NULL);

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
(23, 'F.R.L Combination NC-100', 'Brand: Chelic\r\nModel: NC-100', '2017-10-28 02:29:56', 15, '2017-11-10 10:38:01', 'F.R.L_Combination_NC-100', 8, 1, 10),
(24, 'Filter Regulator', 'Brand: Checlic\r\nModel: NFC-300', '2017-10-28 02:31:40', 20.75, '2017-11-10 10:38:01', 'Filter_Regulator.jpg', 8, 1, 25),
(25, 'Mist Filter Regulator', 'Brand: Chelic\r\nModel: MFR-200', '2017-10-28 02:32:36', 15, '2017-11-10 10:38:01', 'default.jpg', 8, 1, 20),
(26, 'MICRO MIST FILTER REGULATOR', 'Brand: Chelic\r\nModel: MFRD-300', '2017-10-28 02:33:35', 50, '2017-11-10 10:38:01', 'default.jpg', 8, 1, 20),
(27, 'FR.L COMBINATION NC-200', 'Brand: Chelic\r\nModel: NFC-100', '2017-10-28 02:35:39', 35, '2017-11-10 10:38:01', 'FR.L_COMBINATION_(NFC-100)', 8, 1, 50),
(28, 'Valve Sample 1', 'Brand: Chelic\r\nModel: N300', '2017-10-28 18:45:04', 15, '2017-11-10 10:29:55', 'default.jpg', 9, 1, 10),
(29, 'Valve sample 2', 'Brand: A\r\nModel: Aa', '2017-10-28 18:46:17', 13, '2017-11-10 10:37:33', 'Valve_sample_2.jpg', 9, 1, 114);

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
(10, '', 'Air Cylinders', 1),
(11, '', 'Gripper', 1),
(12, '', 'Vacuum Equipment', 1),
(13, 'ABCf', 'CAT', 0),
(14, '', 'asd', 1),
(15, '', 'sadasdsada', 1);

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
(1, 'Admin', 'admin@gmail.com', '1996-11-22', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '09179695868', '2017-10-24 11:30:38', 'superadmin', 1),
(2, 'Geeasdsfdsas', 'geeann1227@gmail.com', '1996-11-22', 'd41d8cd98f00b204e9800998ecf8427e', 'geeasinif', '09179586824', '2017-09-26 14:38:22', 'admin', 0),
(3, 'Customer', 'customer@test.com', '1996-11-22', 'e10adc3949ba59abbe56e057f20f883e', 'Teresa', '09179695868', '2017-10-02 16:36:15', 'customer', 1),
(4, 'qshsfbjw', 'test@a.s', '1996-11-22', 'e10adc3949ba59abbe56e057f20f883e', 'teresa', '09179695868', '2017-10-05 14:15:18', 'customer', 1),
(5, 'abc', 'abc@a.b', '1996-11-22', '0d225f8ee0155adab741d4210109d690', 'abc', '09179695868', '2017-10-24 11:29:10', 'customer', 1),
(6, 'testing customer', 'testing@gmail.com', '1996-11-22', 'e10adc3949ba59abbe56e057f20f883e', 'Boulevard St. Dalig Teresa Rizal', '09179695868', '2017-10-28 02:11:11', 'customer', 1),
(7, 'adrian laganas', 'laganasadrian00@gmail.com', '1996-11-07', '6ebe76c9fb411be97b3b0d48b791a7c9', 'cavite', '09235656854', '2017-10-28 17:20:16', 'customer', 1),
(8, 'sadasdsada', 'asdasdsa@gmail.com', '2014-01-01', '25f9e794323b453885f5181f1b624d0b', 'dasdasdasda', '12321321321', '2017-10-28 17:30:08', 'customer', 1),
(9, 'asdsadsadsadsad', 'dudong@gmail.com', '1995-01-12', '432f45b44c432414d2f97df0e5743818', 'bulacan', '09421233421', '2017-10-28 17:31:00', 'customer', 1),
(10, 'Staff', 'staff@test.com', '1996-11-22', 'e10adc3949ba59abbe56e057f20f883e', 'Sample St. Teresa, Rizal', '09179695868', '2017-10-29 23:12:20', 'admin', 1),
(11, 'Sample', 'Sample@customer.com', '1996-11-22', '0d225f8ee0155adab741d4210109d690', '111 ABC. St. Sampleee', '09179695868', '2017-11-10 08:43:31', 'customer', 1),
(12, 'ABC', 'Sample@customer1.com', '1996-11-22', '0d225f8ee0155adab741d4210109d690', 'ABC TESTING ADDRESS', '09179695868', '2017-11-10 08:45:35', 'customer', 1),
(13, 'Sample Admin', 'geeannmlopez@gmail.com', '1996-11-22', '0d225f8ee0155adab741d4210109d690', 'aban', '09179695868', '2017-11-10 10:05:44', 'admin', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `item_total`
--
ALTER TABLE `item_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_header`
--
ALTER TABLE `order_header`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `order_line_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
