-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 05:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kanaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_sp_detail`
--

CREATE TABLE `t_sp_detail` (
  `id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_amount_in_ctn` int(11) NOT NULL,
  `order_price_before_tax` float NOT NULL,
  `order_price_after_tax` float NOT NULL,
  `order_amount_after_tax` float NOT NULL,
  `order_volume` float NOT NULL,
  `order_weight` float NOT NULL,
  `order_price_dipo_before_tax` float NOT NULL,
  `order_price_dipo_after_tax` float NOT NULL,
  `order_amount_dipo_after_tax` float NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT '0',
  `user_printed` int(11) NOT NULL DEFAULT '0',
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT '0',
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_deleted` int(11) NOT NULL DEFAULT '0',
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_sp_detail`
--
ALTER TABLE `t_sp_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_sp_detail`
--
ALTER TABLE `t_sp_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
