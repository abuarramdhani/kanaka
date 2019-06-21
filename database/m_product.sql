-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2019 at 03:48 PM
-- Server version: 10.2.25-MariaDB
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
-- Table structure for table `m_product`
--

CREATE TABLE `m_product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `category_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `view_total` int(11) NOT NULL,
  `description` text NOT NULL,
  `feature` text NOT NULL,
  `barcode_product` varchar(50) DEFAULT NULL,
  `barcode_carton` varchar(50) DEFAULT NULL,
  `packing_size` float NOT NULL,
  `tipe_kemasan` varchar(50) NOT NULL,
  `cbp_per_kemasan` float NOT NULL,
  `cbp_per_karton` float NOT NULL,
  `harga` float NOT NULL,
  `qty` int(11) NOT NULL,
  `length` float NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `volume` float NOT NULL,
  `weight` float NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_product`
--

INSERT INTO `m_product` (`id`, `name`, `category_id`, `product_code`, `view_total`, `description`, `feature`, `barcode_product`, `barcode_carton`, `packing_size`, `tipe_kemasan`, `cbp_per_kemasan`, `cbp_per_karton`, `harga`, `qty`, `length`, `width`, `height`, `volume`, `weight`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 'Minyak Goreng Promoo Pillow 800ml', 5, 'MGP00003', 0, '', '', '', '', 800, '', 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '05:13:49', 1, '2019-05-27', '14:36:06', 0, 0, '1901-01-01', '00:00:00'),
(2, 'Minyak Goreng Promoo Pillow 200ml', 5, 'MGP00001', 0, '', '', '', '', 200, '', 0, 0, 0, 48, 4, 5, 6, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '05:13:49', 1, '2019-05-27', '14:34:29', 0, 0, '1901-01-01', '00:00:00'),
(3, 'Minyak Goreng Promoo Pillow 400ml', 5, 'MGP00002', 0, '', '', '', '', 400, '', 0, 0, 0, 24, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:26:09', 1, '2019-05-27', '14:35:17', 0, 0, '1901-01-01', '00:00:00'),
(4, 'Minyak Goreng Promoo Pouch 1L', 5, 'MGP00004', 0, '', '', '', '', 1, '', 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:43:25', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(5, 'Minyak Goreng Promoo Pouch 2L', 5, 'MGP00005', 0, '', '', '', '', 2, '', 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:43:55', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(6, 'Minyak Goreng Promoo Jirigen 5L', 5, 'MGP00006', 0, '', '', '', '', 5, '', 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:44:20', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(7, 'Minyak Goreng Promoo Jirigen 19L', 5, 'MGP00007', 0, '', '', '', '', 19, '', 0, 0, 0, 19, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:45:03', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(8, 'Minyak Goreng Promoo BIB 19L', 5, 'MGP00008', 0, '', '', '', '', 19, '', 0, 0, 0, 19, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:45:30', 1, '2019-06-19', '11:19:21', 0, 0, '1901-01-01', '00:00:00'),
(9, 'Garam Dapur DN 20gr', 6, 'GRDN00001', 0, '', '', '', '', 20, '', 0, 0, 0, 40, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:46:02', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(10, 'FDP Bulk Pack Size M', 7, 'FBP00001', 0, '', '', '', '', 1, '', 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:46:28', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(11, 'FDP Bulk Pack Size L', 7, 'FBP00002', 0, '', '', '', '', 1, '', 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:46:51', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(12, 'FDP Bulk Pack Size XL', 7, 'FBP00003', 0, '', '', '', '', 1, '', 0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:47:12', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_product`
--
ALTER TABLE `m_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_product`
--
ALTER TABLE `m_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
