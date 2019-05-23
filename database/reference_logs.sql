-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 11:44 PM
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
-- Table structure for table `reference_logs`
--

CREATE TABLE `reference_logs` (
  `rowID` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `reference_logs`
--

INSERT INTO `reference_logs` (`rowID`, `code`, `menu`) VALUES
(1, 1, 'Menu'),
(2, 2, 'User'),
(3, 3, 'User Menus'),
(4, 4, 'Product'),
(5, 5, 'Category'),
(6, 6, 'DIPO'),
(7, 7, 'Partner'),
(8, 8, 'Zona'),
(9, 9, '-'),
(10, 10, 'Principle'),
(11, 11, 'Price List');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reference_logs`
--
ALTER TABLE `reference_logs`
  ADD PRIMARY KEY (`rowID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reference_logs`
--
ALTER TABLE `reference_logs`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
