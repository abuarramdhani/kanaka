-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2019 at 09:02 AM
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
-- Dumping data for table `m_principle`
--

INSERT INTO `m_principle` (`id`, `code`, `name`, `address`, `product`, `brand`, `top`, `pic`, `phone_office`, `phone_personal`, `fax`, `email_office`, `email_personal`, `web`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 'P00001', 'PT. MITRAKARYA SUKSES NABATI', 'Jl. Pluit Selatan Raya No. 106-107, Jakarta 14450, Indonesia', 'Minyak Goreng', 'Promoo', '30', 'Darwanto', '02166603959', '081288982238', '0216678695', 'darwanto@mahakaryakapital.co.id', 'darwanto@gmail.com', 'www.mitrakarya.com', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '13:40:47', 1, '2019-05-18', '13:46:58', 0, 0, '1901-01-01', '00:00:00'),
(2, 'P00002', 'PT. DSG SURYAMAS INDONESIA', 'Jl. Pacatama Raya Kav. 18, Desa Leuwilimus, Cikande, 42186, Serang', 'Diapers', 'Fitti', '30', 'Veronika ', '0215256316', '082227049365', '0215256357', 'veronika@dsgap.com', 'veronika@gmail.com', 'www.dsgil.com', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '13:54:42', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
