-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2021 at 07:55 PM
-- Server version: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `write_neat`
--
CREATE DATABASE IF NOT EXISTS `write_neat` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `write_neat`;

-- --------------------------------------------------------

--
-- Table structure for table `wn_product_price`
--

CREATE TABLE `wn_product_price` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(256) NOT NULL,
  `product_mrp` int(11) NOT NULL,
  `product_sp` int(11) NOT NULL,
  `product_cod_charges` int(11) NOT NULL,
  `product_igst_percentage` tinyint(4) NOT NULL DEFAULT 18,
  `product_sgst_percentage` tinyint(4) NOT NULL DEFAULT 9,
  `product_cgst_percentage` tinyint(9) NOT NULL DEFAULT 9
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wn_user_order`
--

CREATE TABLE `wn_user_order` (
  `order_id` bigint(20) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `pincode` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `order_type` enum('COD','ONLINE') NOT NULL,
  `order_status` enum('PENDING','PROCESSING','FAILED','SUCCESS') NOT NULL DEFAULT 'PENDING',
  `delivery_status` enum('PENDING','PACKING','DISPATCHED','DELIVERED') NOT NULL DEFAULT 'PENDING',
  `order_amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wn_product_price`
--
ALTER TABLE `wn_product_price`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `wn_user_order`
--
ALTER TABLE `wn_user_order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wn_product_price`
--
ALTER TABLE `wn_product_price`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wn_user_order`
--
ALTER TABLE `wn_user_order`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
