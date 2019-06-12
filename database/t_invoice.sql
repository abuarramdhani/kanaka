-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Jun 2019 pada 22.47
-- Versi server: 10.2.24-MariaDB
-- Versi PHP: 7.2.7

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
-- Struktur dari tabel `t_invoice`
--

CREATE TABLE `t_invoice` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(25) NOT NULL,
  `sj_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `note` varchar(150) NOT NULL,
  `total_order_amount_in_ctn` float NOT NULL,
  `total_order_price_before_tax` float NOT NULL,
  `total_order_price_after_tax` float NOT NULL,
  `total_order_amount_after_tax` float NOT NULL,
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
-- Dumping data untuk tabel `t_invoice`
--

INSERT INTO `t_invoice` (`id`, `invoice_no`, `sj_id`, `due_date`, `note`, `total_order_amount_in_ctn`, `total_order_price_before_tax`, `total_order_price_after_tax`, `total_order_amount_after_tax`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, '017/KANAKA/INVC/V/2019', 1, '2019-06-08', 'Orderan Pertama', 0, 0, 0, 36000000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-25', '07:00:00', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_invoice`
--
ALTER TABLE `t_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_invoice`
--
ALTER TABLE `t_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
