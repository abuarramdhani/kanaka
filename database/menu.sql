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
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_code` int(11) NOT NULL,
  `menu_name` char(50) NOT NULL,
  `menu_link` char(50) NOT NULL,
  `menu_icon` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `parent_menu_id` int(11) NOT NULL,
  `lang` char(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_code`, `menu_name`, `menu_link`, `menu_icon`, `parent_menu_id`, `lang`, `status`, `date_created`, `date_modified`) VALUES
(1, 2, 'Master', 'master', 'icon-grid', 0, 'master', '1', '2019-04-25 01:16:17', '2019-04-27 23:54:40'),
(2, 8, 'Category', 'category', 'icon-briefcase', 1, 'category', '1', NULL, '2019-05-12 21:50:22'),
(3, 1, 'Reports', 'reports', 'icon-notebook', 0, 'reports', '1', NULL, '2017-10-11 15:45:49'),
(4, 14, 'Menus', 'menu', NULL, 1, 'menus', '1', NULL, NULL),
(5, 13, 'Users', 'users/account', NULL, 1, 'users', '1', NULL, NULL),
(6, 4, 'Zona', 'zona', 'icon-clock', 1, 'zona', '1', '2017-10-11 17:02:05', '2019-05-15 22:06:39'),
(7, 7, 'Area', 'area', NULL, 1, 'area', '0', '2018-12-13 10:27:48', '2019-04-27 07:52:18'),
(8, 9, 'Product', 'product', NULL, 1, 'product', '1', '2019-04-28 20:19:00', '2019-04-28 20:19:00'),
(9, 10, 'DIPO', 'dipo', NULL, 1, 'dipo', '1', '2019-04-28 20:19:30', '2019-04-28 20:19:30'),
(10, 11, 'Partner', 'partner', NULL, 1, 'partner', '1', '2019-04-28 20:19:55', '2019-04-28 20:19:55'),
(11, 12, 'Vendor', 'vendor', NULL, 1, 'vendor', '1', '2019-04-28 20:20:13', '2019-05-18 14:09:02'),
(12, 5, 'Customer', 'customer', NULL, 3, 'customer', '1', '2019-04-28 20:21:08', '2019-04-28 20:21:08'),
(13, 6, 'Company', 'company', NULL, 3, 'company', '1', '2019-04-28 20:21:29', '2019-04-28 20:21:29'),
(14, 7, 'DIPO Report', 'dipo_report', NULL, 3, 'dipo_report', '1', '2019-04-28 20:22:00', '2019-04-28 20:23:40'),
(15, 8, 'Partner Report', 'partner_report', NULL, 3, 'partner_report', '1', '2019-04-28 20:22:20', '2019-04-28 20:23:51'),
(16, 4, 'Admin', 'admin', 'icon-users', 0, 'admin', '1', '2019-04-28 20:22:36', '2019-04-28 20:22:36'),
(17, 3, 'Blog', 'blog', 'icon-feed', 0, 'blog', '1', '2019-04-28 20:22:47', '2019-04-28 20:22:47'),
(18, 5, 'Pricelist', 'pricelist', NULL, 3, 'pricelist', '1', '2019-05-19 09:36:15', '2019-05-19 09:42:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
