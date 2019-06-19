-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2019 at 05:03 PM
-- Server version: 10.2.24-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u5670349_kanaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_sp`
--

CREATE TABLE `t_sp` (
  `id` int(11) NOT NULL,
  `principle_id` int(11) NOT NULL,
  `sp_no` varchar(25) NOT NULL,
  `dipo_partner_id` int(11) NOT NULL,
  `sp_date` date NOT NULL,
  `total_order_amount_in_ctn` int(11) NOT NULL,
  `total_order_price_before_tax` float NOT NULL,
  `total_order_price_after_tax` float NOT NULL,
  `total_order_amount_after_tax` float NOT NULL,
  `reg_disc_total` float NOT NULL,
  `add_disc_1_total` float NOT NULL,
  `add_disc_2_total` float NOT NULL,
  `btw_disc_total` float NOT NULL,
  `total_niv` float NOT NULL,
  `printed` tinyint(4) NOT NULL DEFAULT 0,
  `user_printed` int(11) NOT NULL DEFAULT 0,
  `date_printed` date NOT NULL DEFAULT '1901-01-01',
  `time_printed` time NOT NULL DEFAULT '00:00:00',
  `user_created` int(11) NOT NULL DEFAULT 0,
  `date_created` date NOT NULL DEFAULT '1901-01-01',
  `time_created` time NOT NULL DEFAULT '00:00:00',
  `user_modified` int(11) NOT NULL DEFAULT 0,
  `date_modified` date NOT NULL DEFAULT '1901-01-01',
  `time_modified` time NOT NULL DEFAULT '00:00:00',
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `user_deleted` int(11) NOT NULL DEFAULT 0,
  `date_deleted` date NOT NULL DEFAULT '1901-01-01',
  `time_deleted` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `t_sp`
--

INSERT INTO `t_sp` (`id`, `principle_id`, `sp_no`, `dipo_partner_id`, `sp_date`, `total_order_amount_in_ctn`, `total_order_price_before_tax`, `total_order_price_after_tax`, `total_order_amount_after_tax`, `reg_disc_total`, `add_disc_1_total`, `add_disc_2_total`, `btw_disc_total`, `total_niv`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 1, '017/KANAKA/SP/V/2019', 1, '2019-05-25', 0, 0, 0, 0, 0, 0, 0, 0, 34500000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-25', '07:00:00', 0, '1901-01-01', '00:00:00', 1, 1, '2019-06-11', '16:36:45'),
(12, 3, '017/KANAKA/SP/V/2019', 1, '2019-06-25', 150, 265000, 291500, 19175000, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-06-11', '16:37:26', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(13, 2, '018/KANAKA/SP/V/2019', 6, '2019-06-19', 20, 80455, 88500, 1770000, 0, 0, 0, 0, 1770000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-06-19', '17:01:58', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_sp`
--
ALTER TABLE `t_sp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_sp`
--
ALTER TABLE `t_sp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
