-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2019 at 07:24 AM
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
-- Table structure for table `t_pricelist`
--

CREATE TABLE `t_pricelist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `normal_price` float NOT NULL,
  `company_before_tax_pcs` float NOT NULL,
  `company_before_tax_ctn` float NOT NULL,
  `company_after_tax_pcs` float NOT NULL,
  `company_after_tax_ctn` float NOT NULL,
  `stock_availibility` tinyint(4) NOT NULL,
  `dipo_before_tax_pcs` float NOT NULL,
  `dipo_before_tax_ctn` float NOT NULL,
  `dipo_after_tax_pcs` float NOT NULL,
  `dipo_after_tax_ctn` float NOT NULL,
  `dipo_after_tax_round_up` float NOT NULL,
  `mitra_before_tax_pcs` float NOT NULL,
  `mitra_before_tax_ctn` float NOT NULL,
  `mitra_after_tax_pcs` float NOT NULL,
  `mitra_after_tax_ctn` float NOT NULL,
  `mitra_after_tax_round_up` float NOT NULL,
  `customer_before_tax_pcs` float NOT NULL,
  `customer_before_tax_ctn` float NOT NULL,
  `customer_after_tax_pcs` float NOT NULL,
  `customer_after_tax_ctn` float NOT NULL,
  `customer_after_tax_round_up` float NOT NULL,
  `het_round_up_pcs` float NOT NULL,
  `het_round_up_ctn` float NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pricelist`
--

INSERT INTO `t_pricelist` (`id`, `product_id`, `normal_price`, `company_before_tax_pcs`, `company_before_tax_ctn`, `company_after_tax_pcs`, `company_after_tax_ctn`, `stock_availibility`, `dipo_before_tax_pcs`, `dipo_before_tax_ctn`, `dipo_after_tax_pcs`, `dipo_after_tax_ctn`, `dipo_after_tax_round_up`, `mitra_before_tax_pcs`, `mitra_before_tax_ctn`, `mitra_after_tax_pcs`, `mitra_after_tax_ctn`, `mitra_after_tax_round_up`, `customer_before_tax_pcs`, `customer_before_tax_ctn`, `customer_after_tax_pcs`, `customer_after_tax_ctn`, `customer_after_tax_round_up`, `het_round_up_pcs`, `het_round_up_ctn`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 1, 106000, 1742, 83636, 1917, 92000, 0, 1777, 85309, 1955, 93840, 93900, 1813, 87015, 1994, 95717, 95800, 1885, 90496, 2074, 99545, 99600, 2100, 100800, 0, 0, '1901-01-01', '00:00:00', 0, '1901-01-01', '00:00:00', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_pricelist`
--
ALTER TABLE `t_pricelist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_pricelist`
--
ALTER TABLE `t_pricelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
