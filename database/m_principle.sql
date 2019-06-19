-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2019 at 05:04 PM
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
-- Table structure for table `m_principle`
--

CREATE TABLE `m_principle` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `product` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `top` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `phone_office` varchar(20) NOT NULL,
  `phone_personal` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email_office` varchar(50) NOT NULL,
  `email_personal` varchar(50) NOT NULL,
  `web` varchar(50) NOT NULL,
  `reg_disc` float NOT NULL,
  `add_disc_1` float NOT NULL,
  `add_disc_2` float NOT NULL,
  `btw_disc` float NOT NULL,
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
-- Dumping data for table `m_principle`
--

INSERT INTO `m_principle` (`id`, `code`, `name`, `address`, `product`, `brand`, `top`, `pic`, `phone_office`, `phone_personal`, `fax`, `email_office`, `email_personal`, `web`, `reg_disc`, `add_disc_1`, `add_disc_2`, `btw_disc`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 'P00001', 'PT. MITRAKARYA SUKSES NABATI', 'Jl. Pluit Selatan Raya No. 106-107, Jakarta 14450, Indonesia', 'Minyak Goreng', 'Promoo', '30', 'Darwanto', '02166603959', '081288982238', '0216678695', 'darwanto@mahakaryakapital.co.id', 'darwanto@gmail.com', '', 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '13:40:47', 1, '2019-05-27', '10:59:05', 0, 0, '1901-01-01', '00:00:00'),
(2, 'P00002', 'PT. DSG SURYAMAS INDONESIA', 'Jl. Pacatama Raya Kav. 18, Desa Leuwilimus, Cikande, 42186, Serang', 'Diapers', 'Fitti', '30', 'Veronika ', '0215256316', '082227049365', '0215256357', 'veronika@dsgap.com', '', 'www.dsgil.com', 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '13:54:42', 1, '2019-05-27', '10:58:49', 0, 0, '1901-01-01', '00:00:00'),
(3, 'P00003', 'PT. NADYNE GLOBAL NIAGA', 'Jl. Benda Raya No. 92, Kemang, Jakarta Selatan, DKI Jakarta', 'Diapers', 'Fitti', 'CBD', 'Chika ', '02178835337', '085710019305', '02178835350', 'info@nadyne.com', 'chika@nadyne.com', 'http://nadyne.com/', 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '10:52:57', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(4, 'P00004', 'PT. ASIA PARAMITA INDAH', 'Jl. Perniagaan Barat No. 12,Jakarta Barat 11230, Indonesia', 'Pasta Gigi', 'Darlie', '30', ' Elvin Suryawijaya', '', '08978695780', '', '', 'elvin_suryawijaya@darlie.com', '', 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '10:56:58', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(5, 'P00005', 'PT. SINARMAS DISTIRBUSI NUSANTARA', 'Jl. Rawa Girang No.3, Kawasan Industri Pulogadung, Jakarta Timur, 13930', 'Gula', 'Gulaku', 'CBD', ' Suprihatmo ', '0214602050', '08884103054', '', 'suprihatmo@sinarmas-distribusi.com', 'prie.hatmo@gmail.com', ' www.smart-plus.com', 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '10:58:12', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_principle`
--
ALTER TABLE `m_principle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_principle`
--
ALTER TABLE `m_principle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
