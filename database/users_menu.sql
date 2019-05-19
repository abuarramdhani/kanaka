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
-- Table structure for table `users_menu`
--

CREATE TABLE `users_menu` (
  `id_user_menu` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `Availabled` tinyint(4) NOT NULL DEFAULT '0',
  `Created` tinyint(1) NOT NULL DEFAULT '0',
  `Viewed` tinyint(4) NOT NULL DEFAULT '0',
  `Updated` tinyint(4) NOT NULL DEFAULT '0',
  `Deleted` tinyint(4) NOT NULL DEFAULT '0',
  `Approved` tinyint(4) NOT NULL,
  `Verified` tinyint(4) NOT NULL DEFAULT '0',
  `FullAccess` tinyint(4) NOT NULL DEFAULT '0',
  `PrintLimited` tinyint(4) NOT NULL DEFAULT '0',
  `PrintUnlimited` tinyint(4) NOT NULL DEFAULT '0',
  `StatusUsermenu` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_menu`
--

INSERT INTO `users_menu` (`id_user_menu`, `user_id`, `menu_id`, `Availabled`, `Created`, `Viewed`, `Updated`, `Deleted`, `Approved`, `Verified`, `FullAccess`, `PrintLimited`, `PrintUnlimited`, `StatusUsermenu`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(2, 1, 13, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(3, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(4, 1, 4, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(5, 1, 5, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(6, 1, 15, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(7, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '1'),
(8, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(9, 2, 7, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(10, 2, 3, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(11, 1, 12, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(12, 8, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, '1'),
(13, 8, 3, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(14, 8, 2, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(15, 1, 14, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(16, 1, 8, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(17, 1, 9, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(18, 1, 10, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(19, 1, 11, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(20, 1, 16, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(21, 1, 17, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(22, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(23, 1, 6, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(24, 1, 18, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_menu`
--
ALTER TABLE `users_menu`
  ADD PRIMARY KEY (`id_user_menu`),
  ADD UNIQUE KEY `key01` (`user_id`,`menu_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_menu`
--
ALTER TABLE `users_menu`
  MODIFY `id_user_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
