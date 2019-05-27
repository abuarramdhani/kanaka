-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2019 at 04:26 PM
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
-- Table structure for table `app_sessions`
--

CREATE TABLE `app_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_sessions`
--

INSERT INTO `app_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('04b98c74554d656cd145dec93b21c2a9004de197', '119.82.239.38', 1558680193, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383638303139333b7265717565737465645f706167657c733a35313a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f7265706f7274732f70726963656c6973742f657863656c223b70726576696f75735f706167657c733a35313a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f7265706f7274732f70726963656c6973742f657863656c223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538353837343039223b6c6173745f636865636b7c693a313535383636303831313b),
('b40c65c720e1c31bf5fbbe8d4b8d110830f62bfa', '118.99.118.152', 1558678184, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383637383138343b7265717565737465645f706167657c733a35353a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f706172746e65722f706172746e6572732f66657463685f64617461223b70726576696f75735f706167657c733a35353a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f706172746e65722f706172746e6572732f66657463685f64617461223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538363630383131223b6c6173745f636865636b7c693a313535383636333636383b),
('c349aa04ce8bba4cd84700073d37cb50befcfbcb', '118.99.118.152', 1558678195, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383637383138343b7265717565737465645f706167657c733a35353a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f70726f647563742f70726f64756374732f66657463685f64617461223b70726576696f75735f706167657c733a35353a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f70726f647563742f70726f64756374732f66657463685f64617461223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538363630383131223b6c6173745f636865636b7c693a313535383636333636383b),
('be1cfee45511d7a93c30d606837f9cc8f080771d', '119.82.239.38', 1558680503, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383638303230333b7265717565737465645f706167657c733a32383a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f223b70726576696f75735f706167657c733a32383a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538363633363638223b6c6173745f636865636b7c693a313535383638303530333b),
('aa1c795a9353aef7d3bd41cf59a2b284cdf74155', '116.206.8.9', 1558760329, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383736303331313b7265717565737465645f706167657c733a35393a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f70726963656c6973742f70726963656c697374732f66657463685f64617461223b70726576696f75735f706167657c733a35393a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f70726963656c6973742f70726963656c697374732f66657463685f64617461223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538363830353033223b6c6173745f636865636b7c693a313535383736303331373b),
('918e30d6409e38c62f988d7d34ba24f7d4f8bb1d', '118.99.118.152', 1558923839, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383932333833393b7265717565737465645f706167657c733a32383a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f223b),
('72577ea04843dfbfbe96f37b0b7ddee9bcd04be1', '118.99.118.152', 1558948708, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383934383730383b7265717565737465645f706167657c733a34333a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f6469706f2f6469706f732f76696577223b70726576696f75735f706167657c733a34333a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f6469706f2f6469706f732f76696577223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538373630333137223b6c6173745f636865636b7c693a313535383932333834353b),
('980bbb13a93afc680e41c8c23085767bd9baaccc', '118.99.118.152', 1558941670, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383934313637303b7265717565737465645f706167657c733a34393a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f7a6f6e612f7a6f6e61732f66657463685f64617461223b70726576696f75735f706167657c733a34393a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f7a6f6e612f7a6f6e61732f66657463685f64617461223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538393233383435223b6c6173745f636865636b7c693a313535383932373236393b),
('59c6c9919c12a9b17ac3413cd36ff0989660ff9b', '119.82.239.38', 1558928491, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383932373534363b7265717565737465645f706167657c733a37333a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f7375726174706573616e616e2f7375726174706573616e616e732f66657463685f646174615f706573616e616e223b70726576696f75735f706167657c733a37333a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f7375726174706573616e616e2f7375726174706573616e616e732f66657463685f646174615f706573616e616e223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538393237323639223b6c6173745f636865636b7c693a313535383932373535393b),
('063742d81e56e49e779113dcc03569140b4bab80', '118.99.118.152', 1558948703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383934313637303b7265717565737465645f706167657c733a35383a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f63617465676f72792f63617465676f726965732f66657463685f64617461223b70726576696f75735f706167657c733a35383a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f63617465676f72792f63617465676f726965732f66657463685f64617461223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538393233383435223b6c6173745f636865636b7c693a313535383932373236393b),
('3568d68d865ba3696fe5a288753d782eaa95eb23', '119.82.239.38', 1558947720, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383934373639393b7265717565737465645f706167657c733a35393a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f7072696e6369706c652f7072696e6369706c65732f66657463685f64617461223b70726576696f75735f706167657c733a35393a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f7072696e6369706c652f7072696e6369706c65732f66657463685f64617461223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538393237353539223b6c6173745f636865636b7c693a313535383934373730333b),
('c0080a996fcd7aabc71fc6f9bbebb9e5fc4f3f4d', '114.5.215.43', 1558948331, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383934383333313b7265717565737465645f706167657c733a32383a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f223b),
('7d48e7173a7b2f77ad0910affe87956ecf65ed8f', '118.99.118.152', 1558948715, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535383934383730383b7265717565737465645f706167657c733a35353a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f70726f647563742f70726f64756374732f66657463685f64617461223b70726576696f75735f706167657c733a35353a22687474703a2f2f6261636b656e642e6b616e616b61736e2e636f6d2f70726f647563742f70726f64756374732f66657463685f64617461223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31363a2261646d696e406b616e616b612e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353538373630333137223b6c6173745f636865636b7c693a313535383932333834353b);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_config` varchar(255) NOT NULL DEFAULT '',
  `company_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_old`
--

CREATE TABLE `company_old` (
  `company_config` varchar(255) NOT NULL DEFAULT '',
  `company_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_old`
--

INSERT INTO `company_old` (`company_config`, `company_value`) VALUES
('address1', 'RUKAN ARTHA GADING NIAGA BLOK B NO. 21-22, JL. BOULEVARD ARTHA GADING KELURAHAN ARTHA GADING BARAT'),
('address2', 'KELAPA GADING'),
('address3', 'JAKARTA UTARA'),
('bank_account_name', 'SUMOSOR JAYA INDRA'),
('bank_account_no', '2288-20-1368'),
('bank_address_line_1', 'Komp. Puri Niaga III Jl. Puri Kencana Blok M-8 No 1 JKL'),
('bank_address_line_2', 'Jakarta Barat, DKI Jakarta, Indonesia 11610'),
('bank_name', 'BANK MAYBANK KCP PURI KENCANA'),
('company_logo', 'logo.png'),
('comp_cd', 'SMJ'),
('comp_id', '1'),
('comp_name', 'SUMOSOR JAYA INDRA'),
('decimal_separator', ','),
('default_currency', 'IDR'),
('default_currency_symbol', 'Rp'),
('email1', 'WEBMASTER@BIG-GROUP.CO.ID'),
('email2', 'WEBMASTER@BIG-GROUP.CO.ID'),
('fax1', '02145857623'),
('fax2', '0'),
('manager_keuangan', 'HENDRO WIJAYA'),
('nppkp_no', '01.882.136.3-045.000'),
('npwp_address1', 'SARANG BANGO NO. 170 RT.008 RW.002 MARUNDA'),
('npwp_address2', 'CILINCING'),
('npwp_address3', 'JAKARTA UTARA'),
('npwp_no', '01.882.136.3-045.000'),
('npwp_post_cd', '11750'),
('post_cd', '14240'),
('reg_date', '2015-04-04'),
('rowID', '1'),
('telp1', '02145857621'),
('telp2', '02145857622'),
('ticket_files', '/file_attachment/IT/ticket/'),
('website', 'WWW.BIG-GROUP.CO.ID');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `config_key` varchar(255) CHARACTER SET latin1 NOT NULL,
  `value` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`config_key`, `value`) VALUES
('password_default', '12345678'),
('timezone', 'Asia/Bangkok');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Company'),
(2, 'dipo', 'DIPO'),
(3, 'mitra', 'Mitra');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id_logs` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `data_new` text DEFAULT NULL,
  `data_old` text DEFAULT NULL,
  `data_change` text DEFAULT NULL,
  `message` text NOT NULL,
  `created_on` datetime NOT NULL,
  `activity` enum('C','U','D') NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id_logs`, `id_user`, `data_new`, `data_old`, `data_change`, `message`, `created_on`, `activity`, `type`) VALUES
(1, 1, '{\"Kode Menu\":1}', '{\"Kode Menu\":3}', '{\"Kode Menu\":1}', 'menu Reports berhasil diubah oleh Administrator', '2017-10-11 15:45:03', 'U', 1),
(2, 1, '{\"Kode Menu\":3}', '{\"Kode Menu\":1}', '{\"Kode Menu\":3}', 'menu Reports berhasil diubah oleh Administrator', '2017-10-11 15:45:49', 'U', 1),
(3, 1, '{\"Kode Menu\":\"6\",\"Nama Menu\":\"TesT\",\"Link Menu\":\"teSt_li\",\"Lang\":\"Test_Lang\",\"Parent Menu\":\"-\",\"Status\":\"1\"}', NULL, NULL, 'Add menu TesT succesfully by Administrator', '2017-10-11 16:19:51', 'C', 1),
(4, 1, '{\"Kode Menu\":\"6\",\"Nama Menu\":\"TesT1\",\"Link Menu\":\"teSt_lin\",\"Lang\":\"Test_Langu\",\"Parent Menu\":\"Reports\",\"Status\":\"0\"}', '{\"Kode Menu\":6,\"Nama Menu\":\"TesT\",\"Link Menu\":\"teSt_li\",\"Lang\":\"Test_Lang\",\"Parent Menu\":\"-\",\"Status\":\"1\"}', '{\"Nama Menu\":\"TesT1\",\"Link Menu\":\"teSt_lin\",\"Lang\":\"Test_Langu\",\"Parent Menu\":\"Reports\",\"Status\":\"0\"}', 'Update menu TesT1 succesfully by Administrator', '2017-10-11 16:20:41', 'U', 1),
(5, 1, NULL, '{\"Kode Menu\":6,\"Nama Menu\":\"TesT1\",\"Link Menu\":\"teSt_lin\",\"Lang\":\"Test_Langu\",\"Parent Menu\":\"Reports\",\"Status\":\"0\"}', NULL, 'Delete menu TesT1 succesfully by Administrator', '2017-10-11 16:21:11', 'D', 1),
(6, 1, '{\"Kode Menu\":\"6\",\"Nama Menu\":\"Test\",\"Link Menu\":\"test\",\"Lang\":\"tses\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', NULL, NULL, 'Add menu Test succesfully by Administrator', '2017-10-11 17:02:05', 'C', 1),
(7, 1, '{\"Kode Menu\":\"6\",\"Nama Menu\":\"Test\",\"Link Menu\":\"test\",\"Lang\":\"tses\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', '{\"Kode Menu\":6,\"Nama Menu\":\"Test\",\"Link Menu\":\"test\",\"Lang\":\"tses\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', '[]', 'Update menu Test succesfully by Administrator', '2017-10-11 17:13:23', 'U', 1),
(8, 1, '{\"Kode Menu\":\"8\",\"Nama Menu\":\"Test\",\"Link Menu\":\"Test1\",\"Lang\":\"Test\",\"Parent Menu\":\"Reports\",\"Status\":\"1\"}', '{\"Kode Menu\":8,\"Nama Menu\":\"Test\",\"Link Menu\":\"Test\",\"Lang\":\"Test\",\"Parent Menu\":\"Reports\",\"Status\":\"1\"}', '{\"Link Menu\":\"Test1\"}', 'Update menu Test succesfully by Administrator', '2017-10-11 17:21:19', 'U', 1),
(9, 1, '{\"Kode Menu\":\"10\",\"Nama Menu\":\"Resr\",\"Link Menu\":\"Test\",\"Lang\":\"setrse\",\"Parent Menu\":\"Transaction\",\"Status\":\"1\"}', NULL, NULL, 'Add menu Resr succesfully by Administrator', '2017-10-11 17:25:39', 'C', 1),
(10, 1, '{\"Kode Menu\":\"6\",\"Nama Menu\":\"History\",\"Link Menu\":\"history\",\"Lang\":\"history\",\"Parent Menu\":\"-\",\"Status\":\"1\"}', '{\"Kode Menu\":6,\"Nama Menu\":\"Test\",\"Link Menu\":\"test\",\"Lang\":\"tses\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', '{\"Nama Menu\":\"History\",\"Link Menu\":\"history\",\"Lang\":\"history\",\"Parent Menu\":\"-\"}', 'Update menu History succesfully by Administrator', '2017-10-11 17:35:30', 'U', 1),
(11, 1, '{\"Kode Menu\":\"11\",\"Nama Menu\":\"Las\",\"Link Menu\":\"te\",\"Lang\":\"Te\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', NULL, NULL, 'Add menu Las succesfully by Administrator', '2017-10-11 18:33:15', 'C', 1),
(12, 1, '{\"Kode Menu\":\"11\",\"Nama Menu\":\"Las\",\"Link Menu\":\"tea\",\"Lang\":\"Te\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', '{\"Kode Menu\":11,\"Nama Menu\":\"Las\",\"Link Menu\":\"te\",\"Lang\":\"Te\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', '{\"Link Menu\":\"tea\"}', 'Update menu Las succesfully by Administrator', '2017-10-11 18:33:45', 'U', 1),
(13, 1, '{\"Kode Menu\":10}', '{\"Kode Menu\":11}', '{\"Kode Menu\":10}', 'Update menu Las succesfully by Administrator', '2017-10-11 18:34:30', 'U', 1),
(14, 1, NULL, '{\"Kode Menu\":10,\"Nama Menu\":\"Las\",\"Link Menu\":\"tea\",\"Lang\":\"Te\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', NULL, 'Delete menu Las succesfully by Administrator', '2017-10-11 18:34:52', 'D', 1),
(15, 1, '{\"Kode Menu\":\"10\",\"Nama Menu\":\"Resr\",\"Link Menu\":\"Test\",\"Lang\":\"setrse\",\"Parent Menu\":\"Transaction\",\"Status\":\"1\"}', '{\"Kode Menu\":10,\"Nama Menu\":\"Resr\",\"Link Menu\":\"Test\",\"Lang\":\"setrse\",\"Parent Menu\":\"Transaction\",\"Status\":\"1\"}', '[]', 'Update menu Resr succesfully by Administrator', '2017-10-11 18:35:25', 'U', 1),
(16, 1, NULL, '{\"Kode Menu\":10,\"Nama Menu\":\"Resr\",\"Link Menu\":\"Test\",\"Lang\":\"setrse\",\"Parent Menu\":\"Transaction\",\"Status\":\"1\"}', NULL, 'Delete menu Resr succesfully by Administrator', '2017-10-12 09:12:00', 'D', 1),
(17, 1, '{\"Kode Menu\":\"9\",\"Nama Menu\":\"Test2\",\"Link Menu\":\"Test2\",\"Lang\":\"Test2\",\"Parent Menu\":\"Reports\",\"Status\":\"0\"}', '{\"Kode Menu\":9,\"Nama Menu\":\"Test\",\"Link Menu\":\"Test\",\"Lang\":\"Test\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', '{\"Nama Menu\":\"Test2\",\"Link Menu\":\"Test2\",\"Lang\":\"Test2\",\"Parent Menu\":\"Reports\",\"Status\":\"0\"}', 'Update menu Test2 succesfully by Administrator', '2017-10-12 09:12:30', 'U', 1),
(18, 1, '{\"Kode Menu\":\"10\",\"Nama Menu\":\"Na\",\"Link Menu\":\"nad\",\"Lang\":\"naaa\",\"Parent Menu\":\"Master\",\"Status\":\"0\"}', NULL, NULL, 'Add menu Na succesfully by Administrator', '2017-10-12 09:13:09', 'C', 1),
(19, 1, '{\"Kode Menu\":\"9\",\"Nama Menu\":\"Test2\",\"Link Menu\":\"Test2\",\"Lang\":\"Test2\",\"Parent Menu\":\"Reports\",\"Status\":\"1\"}', '{\"Kode Menu\":9,\"Nama Menu\":\"Test2\",\"Link Menu\":\"Test2\",\"Lang\":\"Test2\",\"Parent Menu\":\"Reports\",\"Status\":\"0\"}', '{\"Status\":\"1\"}', 'Update menu Test2 succesfully by Administrator', '2017-10-12 09:13:35', 'U', 1),
(20, 1, '{\"Kode Menu\":\"11\",\"Nama Menu\":\"as\",\"Link Menu\":\"das\",\"Lang\":\"asd\",\"Parent Menu\":\"History\",\"Status\":\"Not Active\"}', NULL, NULL, 'Add menu as succesfully by Administrator', '2017-10-12 09:15:20', 'C', 1),
(21, 1, '{\"Kode Menu\":\"11\",\"Nama Menu\":\"as\",\"Link Menu\":\"das\",\"Lang\":\"asd\",\"Parent Menu\":\"Master\",\"Status\":\"1\"}', '{\"Kode Menu\":11,\"Nama Menu\":\"as\",\"Link Menu\":\"das\",\"Lang\":\"asd\",\"Parent Menu\":\"History\",\"Status\":\"Not Active\"}', '{\"Parent Menu\":\"Master\",\"Status\":\"1\"}', 'Update menu as succesfully by Administrator', '2017-10-12 09:15:39', 'U', 1),
(22, 1, '{\"Kode Menu\":12}', '{\"Kode Menu\":11}', '{\"Kode Menu\":12}', 'Update menu as succesfully by Administrator', '2017-10-12 09:15:53', 'U', 1),
(23, 1, NULL, '{\"Kode Menu\":12,\"Nama Menu\":\"as\",\"Link Menu\":\"das\",\"Lang\":\"asd\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', NULL, 'Delete menu as succesfully by Administrator', '2017-10-12 09:16:00', 'D', 1),
(24, 1, '{\"Kode Menu\":\"10\",\"Nama Menu\":\"Na\",\"Link Menu\":\"nad\",\"Lang\":\"naaa\",\"Parent Menu\":\"History\",\"Status\":\"Active\"}', '{\"Kode Menu\":10,\"Nama Menu\":\"Na\",\"Link Menu\":\"nad\",\"Lang\":\"naaa\",\"Parent Menu\":\"Master\",\"Status\":\"Not Active\"}', '{\"Parent Menu\":\"History\",\"Status\":\"Active\"}', 'Update menu Na succesfully by Administrator', '2017-10-12 09:17:10', 'U', 1),
(25, 1, NULL, '{\"Kode Menu\":10,\"Nama Menu\":\"Na\",\"Link Menu\":\"nad\",\"Lang\":\"naaa\",\"Parent Menu\":\"History\",\"Status\":\"Active\"}', NULL, 'Delete menu Na succesfully by Administrator', '2017-10-12 09:17:33', 'D', 1),
(26, 1, '{\"Kode Menu\":\"6\",\"Nama Menu\":\"History\",\"Link Menu\":\"history\",\"Lang\":\"history\",\"Parent Menu\":\"-\",\"Status\":\"Not Active\"}', '{\"Kode Menu\":6,\"Nama Menu\":\"History\",\"Link Menu\":\"history\",\"Lang\":\"history\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Status\":\"Not Active\"}', 'Update menu History succesfully by Administrator', '2017-10-12 09:17:42', 'U', 1),
(27, 1, NULL, '{\"Kode Menu\":9,\"Nama Menu\":\"Test2\",\"Link Menu\":\"Test2\",\"Lang\":\"Test2\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', NULL, 'Delete menu Test2 succesfully by Administrator', '2017-10-12 09:18:04', 'D', 1),
(28, 1, NULL, '{\"Kode Menu\":7,\"Nama Menu\":\"Test\",\"Link Menu\":\"Test\",\"Lang\":\"TEst\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', NULL, 'Delete menu Test succesfully by Administrator', '2017-10-12 09:18:33', 'D', 1),
(29, 1, NULL, '{\"Kode Menu\":8,\"Nama Menu\":\"Test\",\"Link Menu\":\"Test1\",\"Lang\":\"Test\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', NULL, 'Delete menu Test succesfully by Administrator', '2017-10-12 09:18:38', 'D', 1),
(30, 1, '{\"Full Name\":\"Sandhy\",\"Email\":\"Sandhy@gmail.com\",\"Role\":\"General User\",\"Company\":\"Test\",\"Phone\":\"\"}', NULL, NULL, 'Administrator berhasil menambahkan pengguna  Sandhy@gmail.com', '2017-10-12 10:28:11', 'C', 2),
(31, 1, '{\"Full Name\":\"a\",\"Email\":\"abbay89@gmail.com\",\"Role\":\"General User\",\"Company\":\"asda\",\"Phone\":\"\"}', NULL, NULL, 'Administrator berhasil menambahkan pengguna  abbay89@gmail.com', '2017-10-12 10:45:38', 'C', 2),
(32, 1, '{\"Full Name\":\"Fajar\",\"Email\":\"Fajar@gmail.com\",\"Role\":\"Administrator\",\"Company\":\"Nadyne\",\"Phone\":\"\"}', NULL, NULL, 'Administrator berhasil menambahkan pengguna  Fajar@gmail.com', '2017-10-12 10:48:08', 'C', 2),
(33, 1, '{\"Full Name\":\"Sandhy\",\"Email\":\"Sandhy@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"08123456789\",\"City\":\"Depok\",\"VAT\":null,\"Address\":\"Jalan margonda\",\"Role \":\"General User\"}', '{\"Full Name\":\"Sandhy\",\"Email\":\"Sandhy@gmail.com\",\"Company\":\"Test\",\"Phone\":\"0812345\",\"City\":null,\"VAT\":null,\"Address\":null,\"Role \":\"General User\"}', '{\"Company\":\"Nadyne\",\"Phone\":\"08123456789\",\"City\":\"Depok\",\"Address\":\"Jalan margonda\"}', 'pengguna Sandhy@gmail.com berhasil diubah oleh Administrator', '2017-10-12 11:01:45', 'U', 2),
(34, 1, '{\"Full Name\":\"Sandhy\",\"Email\":\"Sandhy@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"08123456789\",\"City\":\"Depok\",\"Address\":\"Jalan Margonda\",\"Role \":\"Administrator\"}', '{\"Full Name\":\"Sandhy\",\"Email\":\"Sandhy@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"08123456789\",\"City\":\"Depok\",\"Address\":\"Jalan margonda\",\"Role \":\"General User\"}', '{\"Address\":\"Jalan Margonda\",\"Role \":\"Administrator\"}', 'pengguna Sandhy@gmail.com berhasil diubah oleh Administrator', '2017-10-12 11:03:38', 'U', 2),
(35, 1, '{\"Full Name\":\"Akbar\",\"Email\":\"abbay89@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"08123456789\",\"City\":\"Jakarta\",\"Address\":\"Jalan Benda\",\"Role \":\"Administrator\"}', '{\"Full Name\":\"a\",\"Email\":\"abbay89@gmail.com\",\"Company\":\"asda\",\"Phone\":\"a\",\"City\":null,\"Address\":null,\"Role \":\"General User\"}', '{\"Full Name\":\"Akbar\",\"Company\":\"Nadyne\",\"Phone\":\"08123456789\",\"City\":\"Jakarta\",\"Address\":\"Jalan Benda\",\"Role \":\"Administrator\"}', 'pengguna abbay89@gmail.com berhasil diubah oleh Administrator', '2017-10-12 11:05:37', 'U', 2),
(36, 1, '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"\",\"Address\":\"\",\"Role \":\"Administrator\"}', '{\"Full Name\":\"Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":null,\"Address\":null,\"Role \":\"Administrator\"}', '{\"Full Name\":\"Muhammad Fajar\"}', 'pengguna Fajar@gmail.com berhasil diubah oleh Administrator', '2017-10-12 11:36:19', 'U', 2),
(37, 1, '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"Bogo\",\"Address\":\"Cileungsi\",\"Role \":\"Administrator\"}', '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"\",\"Address\":\"\",\"Role \":\"Administrator\"}', '{\"City\":\"Bogo\",\"Address\":\"Cileungsi\"}', 'pengguna Fajar@gmail.com berhasil diubah oleh Administrator', '2017-10-12 11:36:46', 'U', 2),
(38, 1, '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"Bogor\",\"Address\":\"Cileungsi\",\"Role \":\"Administrator\"}', '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"Bogo\",\"Address\":\"Cileungsi\",\"Role \":\"Administrator\"}', '{\"City\":\"Bogor\"}', 'pengguna Fajar@gmail.com berhasil diubah oleh Administrator', '2017-10-12 11:37:08', 'U', 2),
(39, 1, '{\"Active\":\"Not Active\"}', '{\"Active\":\"Active\"}', '{\"Active\":\"Not Active\"}', 'pengguna Administrator berhasil diubah oleh Administrator', '2017-10-12 11:38:03', 'U', 2),
(40, 1, '{\"Active\":\"Not Active\"}', '{\"Active\":\"Active\"}', '{\"Active\":\"Not Active\"}', 'pengguna Administrator berhasil diubah oleh Administrator', '2017-10-12 11:45:24', 'U', 2),
(41, 1, '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"Bogor\",\"Address\":\"Cileungsi\",\"Role \":\"Administrator\"}', '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"Bogor\",\"Address\":\"Cileungsi\",\"Role \":\"Administrator\"}', '[]', 'pengguna Fajar@gmail.com berhasil diubah oleh Administrator', '2017-10-12 11:45:39', 'U', 2),
(42, 1, '{\"Full Name\":\"Rizki\",\"Email\":\"rizki@gmail.com\",\"Role\":\"General User\",\"Company\":\"Nadyne\",\"Phone\":\"08123456\"}', NULL, NULL, 'Add user Rizki succesfully by Administrator', '2017-10-12 13:14:43', 'C', 2),
(43, 1, '{\"Full Name\":\"Rizki\",\"Email\":\"rizki@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"08123456\",\"City\":\"Jakarta\",\"Address\":\"Halim\",\"Role \":\"General User\"}', '{\"Full Name\":\"Rizki\",\"Email\":\"rizki@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"08123456\",\"City\":null,\"Address\":null,\"Role \":\"General User\"}', '{\"City\":\"Jakarta\",\"Address\":\"Halim\"}', 'Update user Rizki succesfully by Administrator', '2017-10-12 13:15:46', 'U', 2),
(44, 1, '{\"Full Name\":\"Rizki\",\"Email\":\"rizki@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"081234567\",\"City\":\"Jakarta\",\"Address\":\"Halim\",\"Role \":\"Administrator\"}', '{\"Full Name\":\"Rizki\",\"Email\":\"rizki@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"08123456\",\"City\":\"Jakarta\",\"Address\":\"Halim\",\"Role \":\"General User\"}', '{\"Phone\":\"081234567\",\"Role \":\"Administrator\"}', 'Update user Rizki succesfully by Administrator', '2017-10-12 13:16:16', 'U', 2),
(45, 1, '{\"Full Name\":\"Rizki\",\"Email\":\"rizki@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"081234567\",\"City\":\"Jakarta\",\"Address\":\"Halim\",\"Role \":\"General User\"}', '{\"Full Name\":\"Rizki\",\"Email\":\"rizki@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"081234567\",\"City\":\"Jakarta\",\"Address\":\"Halim\",\"Role \":\"Administrator\"}', '{\"Role \":\"General User\"}', 'Update user Rizki succesfully by Administrator', '2017-10-12 13:17:32', 'U', 2),
(46, 1, '{\"Active\":\"Not Active\"}', '{\"Active\":\"Active\"}', '{\"Active\":\"Not Active\"}', 'Delete user Administrator succesfully by Administrator', '2017-10-12 13:18:35', 'U', 2),
(47, 1, '{\"Full Name\":\"Test\",\"Email\":\"ytayst@gmail.com\",\"Role\":\"Administrator\",\"Company\":\"Nadyne\",\"Phone\":\"089\"}', NULL, NULL, 'Add user Test succesfully by Administrator', '2017-10-12 13:21:32', 'C', 2),
(48, 1, '{\"Active\":\"Not Active\"}', '{\"Active\":\"Active\"}', '{\"Active\":\"Not Active\"}', 'Delete user Test succesfully by Administrator', '2017-10-12 13:21:38', 'U', 2),
(49, 1, '{\"Active\":\"Not Active\"}', '{\"Active\":\"Active\"}', '{\"Active\":\"Not Active\"}', 'Delete user Rizki succesfully by Administrator', '2017-10-12 13:23:16', 'D', 2),
(50, 1, NULL, '{\"Status\":\"Active\"}', NULL, 'Delete user Rizki succesfully by Administrator', '2017-10-12 13:27:59', 'D', 2),
(51, 1, '{\"User\":\"Muhammad Fajar\",\"Menu\":\"Master\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"NO\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:07:11', 'C', 3),
(52, 1, '{\"Menu\":\"Master\",\"Availabled\":\"No\",\"Created\":\"No\",\"Viewed\":\"No\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"No\",\"Verified\":\"No\",\"Fullaccess\":\"No\",\"Print Limited\":\"Yes\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Master\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Availabled\":\"No\",\"Created\":\"No\",\"Viewed\":\"No\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"No\",\"Verified\":\"No\",\"Fullaccess\":\"No\",\"Print Limited\":\"Yes\",\"Print Unlimited\":\"No\"}', 'Update user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:14:47', 'U', 3),
(53, 1, '{\"Menu\":\"Master\",\"Availabled\":\"No\",\"Created\":\"No\",\"Viewed\":\"No\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"No\",\"Verified\":\"No\",\"Fullaccess\":\"No\",\"Print Limited\":\"Yes\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Master\",\"Availabled\":\"No\",\"Created\":\"No\",\"Viewed\":\"No\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"No\",\"Verified\":\"No\",\"Fullaccess\":\"No\",\"Print Limited\":\"Yes\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '[]', 'Update user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:22:49', 'U', 3),
(54, 1, '{\"User\":\"Muhammad Fajar\",\"Menu\":\"Transaction\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:23:05', 'C', 3),
(55, 1, '{\"User\":\"Muhammad Fajar\",\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:29:42', 'C', 3),
(56, 1, '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Print Unlimited\":\"No\"}', 'Update user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:30:25', 'U', 3),
(57, 1, '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"No\"}', '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Status Usermenu\":\"No\"}', 'Update user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:30:36', 'U', 3),
(58, 1, '{\"User\":\"Muhammad Fajar\",\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Not Active\"}', NULL, NULL, 'Add user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:32:21', 'C', 3),
(59, 1, '{\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"Yes\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Not Active\"}', '{\"Print Limited\":\"Yes\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', 'Update user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:33:44', 'U', 3),
(60, 1, '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"Yes\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Users\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\"}', 'Update user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:35:18', 'U', 3),
(61, 1, '{\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Not Active\"}', '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Not Active\"}', '{\"Menu\":\"Reports\"}', 'Update user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:36:23', 'U', 3),
(62, 1, '{\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Not Active\"}', '{\"Status Usermenu\":\"Active\"}', 'Update user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:36:47', 'U', 3),
(63, 1, '{\"Status Usermenu\":\"Not Active\"}', '{\"Status Usermenu\":\"Active\"}', '{\"Status Usermenu\":\"Not Active\"}', 'Delete user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 14:37:13', 'U', 3),
(64, 5, '{\"Full Name\":\"Octavian Panggestu\",\"Email\":\"octavian@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Bogor\",\"Address\":\"Cilebut\",\"Role \":\"General User\"}', '{\"Full Name\":\"Member\",\"Email\":\"\",\"Company\":null,\"Phone\":\"\",\"City\":null,\"Address\":null,\"Role \":\"General User\"}', '{\"Full Name\":\"Octavian Panggestu\",\"Email\":\"octavian@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Bogor\",\"Address\":\"Cilebut\"}', 'Update user Member succesfully by Muhammad Fajar', '2017-10-12 14:39:58', 'U', 2),
(65, 1, '{\"Menu Code\":\"7\",\"Menu Name\":\"Tets\",\"Menu Link\":\"stse\",\"Lang\":\"sets\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Tets succesfully by Administrator', '2017-10-12 14:44:50', 'C', 1),
(66, 1, '{\"Menu Code\":\"7\",\"Menu Name\":\"Test\",\"Menu Link\":\"stse\",\"Lang\":\"sets\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":7,\"Menu Name\":\"Tets\",\"Menu Link\":\"stse\",\"Lang\":\"sets\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Test\"}', 'Update menu Test succesfully by Administrator', '2017-10-12 14:44:58', 'U', 1),
(67, 1, NULL, '{\"Menu Code\":7,\"Menu Name\":\"Test\",\"Menu Link\":\"stse\",\"Lang\":\"sets\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', NULL, 'Delete menu Test succesfully by Administrator', '2017-10-12 14:45:03', 'D', 1),
(68, 1, '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"Bogor\",\"Address\":\"Cileungsi\",\"Role \":\"General User\"}', '{\"Full Name\":\"Muhammad Fajar\",\"Email\":\"Fajar@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"0812345\",\"City\":\"Bogor\",\"Address\":\"Cileungsi\",\"Role \":\"Administrator\"}', '{\"Role \":\"General User\"}', 'Update user Muhammad Fajar succesfully by Administrator', '2017-10-12 15:30:35', 'U', 2),
(69, 1, NULL, '{\"Status Usermenu\":\"Active\"}', NULL, 'Delete user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 15:59:46', 'D', 3),
(70, 1, NULL, '{\"Menu\":\"Transaction\",\"Status Usermenu\":\"Active\"}', NULL, 'Delete user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 16:01:00', 'D', 3),
(71, 1, NULL, '{\"Menu\":\"Reports\",\"Status Usermenu\":\"Not Active\"}', NULL, 'Delete user menu Muhammad Fajar succesfully by Administrator', '2017-10-12 16:01:49', 'D', 3),
(72, 1, '{\"First Name\":\"Admin\",\"Last Name\":\"istrator\",\"Email\":\"octavian91011@gmail.com1\",\"Address\":\"Cilebut1\",\"City\":\"Bogor1\",\"Phone\":\"+62878987654321\"}', '{\"First Name\":\"Octavian\",\"Last Name\":\"Panggestu\",\"Email\":\"octavian91011@gmail.com\",\"Address\":\"Cilebut\",\"City\":\"Bogor\",\"Phone\":\"+62878123456789\"}', '{\"First Name\":\"Admin\",\"Last Name\":\"istrator\",\"Email\":\"octavian91011@gmail.com1\",\"Address\":\"Cilebut1\",\"City\":\"Bogor1\",\"Phone\":\"+62878987654321\"}', 'Update user profile Administrator succesfully by Administrator', '2017-10-12 16:06:14', 'U', 2),
(73, 1, '{\"First Name\":\"Admin\",\"Last Name\":\"istrator\",\"Email\":\"octavian91011@gmail.com\",\"Address\":\"Cilebut\",\"City\":\"Bogor\",\"Phone\":\"+62878987654321\"}', '{\"First Name\":\"Admin\",\"Last Name\":\"istrator\",\"Email\":\"octavian91011@gmail.com1\",\"Address\":\"Cilebut1\",\"City\":\"Bogor1\",\"Phone\":\"+62878987654321\"}', '{\"Email\":\"octavian91011@gmail.com\",\"Address\":\"Cilebut\",\"City\":\"Bogor\"}', 'Update user profile Administrator succesfully by Administrator', '2017-10-12 16:07:17', 'U', 2),
(74, 1, '{\"Username\":\"admin\",\"First Name\":\"Octavian\",\"Last Name\":\"Panggestu\",\"Full Name\":\"Octavian Panggestu\",\"Email\":\"octavian91011@gmail.com\",\"Address\":\"Cilebut\",\"City\":\"Bogor\",\"Phone\":\"+62878987654321\"}', '{\"Username\":\"administrator\",\"First Name\":\"Admin\",\"Last Name\":\"istrator\",\"Full Name\":\"Admin istrator\",\"Email\":\"octavian91011@gmail.com\",\"Address\":\"Cilebut\",\"City\":\"Bogor\",\"Phone\":\"+62878987654321\"}', '{\"Username\":\"admin\",\"First Name\":\"Octavian\",\"Last Name\":\"Panggestu\",\"Full Name\":\"Octavian Panggestu\"}', 'Update user profile Administrator succesfully by Administrator', '2017-10-12 17:17:18', 'U', 2),
(75, 1, '{\"Username\":\"admin\",\"First Name\":\"Octavian\",\"Last Name\":\"Panggestu\",\"Full Name\":\"Octavian Panggestu\",\"Email\":\"octavian91011@gmail.com\",\"Address\":\"Cilebut\",\"City\":\"Bogor\",\"Phone\":\"+62878987654321\"}', '{\"Username\":\"admin\",\"First Name\":\"Octavian\",\"Last Name\":\"Panggestu\",\"Full Name\":\"Octavian Panggestu\",\"Email\":\"octavian91011@gmail.com\",\"Address\":\"Cilebut\",\"City\":\"Bogor\",\"Phone\":\"+62878987654321\"}', '[]', 'Update user profile Octavian Panggestu succesfully by Octavian Panggestu', '2017-10-12 17:20:45', 'U', 2),
(76, 1, '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"No\",\"Viewed\":\"Yes\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Not Active\"}', '{\"Menu\":\"Menus\",\"Created\":\"No\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Status Usermenu\":\"Active\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:25:54', 'U', 3),
(77, 1, '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"No\",\"Viewed\":\"Yes\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Created\":\"Yes\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:27:42', 'U', 3),
(78, 1, '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Updated\":\"Yes\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:27:55', 'U', 3),
(79, 1, '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Deleted\":\"Yes\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:28:07', 'U', 3),
(80, 1, '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"No\",\"Status Usermenu\":\"Active\"}', '{\"Print Unlimited\":\"Yes\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:28:15', 'U', 3),
(81, 1, '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"No\",\"Viewed\":\"Yes\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Created\":\"No\",\"Updated\":\"No\",\"Deleted\":\"No\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:28:51', 'U', 3),
(82, 1, '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"No\",\"Viewed\":\"Yes\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Created\":\"Yes\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:29:14', 'U', 3),
(83, 1, '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"No\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Updated\":\"Yes\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:31:10', 'U', 3),
(84, 1, '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"No\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Deleted\":\"Yes\"}', 'Update user menu Muhammad Fajar succesfully by Octavian Panggestu', '2017-10-12 18:31:34', 'U', 3),
(85, 1, '{\"Full Name\":\"Edo\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Octavian Panggestu\",\"Email\":\"octavian@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Bogor\",\"Address\":\"Cilebut\",\"Role \":\"General User\"}', '{\"Full Name\":\"Edo\",\"Email\":\"edo@gmail.com\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\"}', 'Update user Octavian Panggestu succesfully by Octavian Panggestu', '2017-10-24 13:52:34', 'U', 2),
(86, 1, '{\"Full Name\":\"Edo\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Edo\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '[]', 'Update user Edo succesfully by Octavian Panggestu', '2017-10-24 14:00:46', 'U', 2),
(87, 1, '{\"Menu Code\":\"6\",\"Menu Name\":\"Brand\",\"Menu Link\":\"brand\",\"Lang\":\"brand\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":6,\"Menu Name\":\"History\",\"Menu Link\":\"history\",\"Lang\":\"history\",\"Parent Menu\":\"-\",\"Status\":\"Not Active\"}', '{\"Menu Name\":\"Brand\",\"Menu Link\":\"brand\",\"Lang\":\"brand\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', 'Update menu Brand succesfully by Octavian Panggestu', '2017-10-31 09:50:36', 'U', 1),
(88, 1, '{\"Menu\":\"Brand\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Brand\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Not Active\"}', '{\"Status Usermenu\":\"Active\"}', 'Update user menu Octavian Panggestu succesfully by Octavian Panggestu', '2017-10-31 09:51:12', 'U', 3),
(96, 1, '{\"Menu Code\":\"7\",\"Menu Name\":\"Area\",\"Menu Link\":\"area\",\"Lang\":\"area\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Area succesfully by Octavian Panggestu', '2018-12-13 10:27:48', 'C', 1),
(97, 1, '{\"User\":\"Octavian Panggestu\",\"Menu\":\"Area\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"Yes\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu Octavian Panggestu succesfully by Octavian Panggestu', '2018-12-13 10:28:08', 'C', 3),
(110, 1, '{\"Menu Code\":1}', '{\"Menu Code\":1}', '[]', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-24 00:03:36', 'U', 1),
(111, 1, '{\"Menu Code\":1}', '{\"Menu Code\":1}', '[]', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-25 01:13:44', 'U', 1),
(112, 1, '{\"Menu Code\":2}', '{\"Menu Code\":1}', '{\"Menu Code\":2}', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-25 01:14:40', 'U', 1),
(113, 1, '{\"Menu Code\":1}', '{\"Menu Code\":2}', '{\"Menu Code\":1}', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-25 01:15:03', 'U', 1),
(114, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Master\",\"Menu Link\":\"masters\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Master succesfully by Octavian Panggestu', '2019-04-25 01:16:17', 'C', 1),
(115, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Mastera\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Mastera succesfully by Octavian Panggestu', '2019-04-25 01:16:51', 'C', 1),
(116, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Mastera\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Code\":1,\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Mastera\"}', 'Update menu Mastera succesfully by Octavian Panggestu', '2019-04-25 01:19:58', 'U', 1),
(117, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Code\":1,\"Menu Name\":\"Mastera\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Master\"}', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-25 01:20:12', 'U', 1),
(118, 1, NULL, '{\"Menu Code\":1,\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', NULL, 'Delete menu Master succesfully by Octavian Panggestu', '2019-04-25 01:20:46', 'D', 1),
(119, 1, NULL, '{\"Menu Code\":1,\"Menu Name\":\"Mastera\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', NULL, 'Delete menu Mastera succesfully by Octavian Panggestu', '2019-04-25 01:21:21', 'D', 1),
(120, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Mastera\",\"Menu Link\":\"masters\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Code\":1,\"Menu Name\":\"Master\",\"Menu Link\":\"masters\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Mastera\"}', 'Update menu Mastera succesfully by Octavian Panggestu', '2019-04-25 01:21:37', 'U', 1),
(121, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Master\",\"Menu Link\":\"masters\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Code\":1,\"Menu Name\":\"Mastera\",\"Menu Link\":\"masters\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Master\"}', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-25 01:22:41', 'U', 1),
(122, 1, '{\"Full Name\":\"Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Edo\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Edo Gustian\"}', 'Update user Edo succesfully by Octavian Panggestu', '2019-04-27 07:31:13', 'U', 2),
(123, 1, '{\"User\":\"Edo Gustian\",\"Menu\":\"Master\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu Edo Gustian succesfully by Octavian Panggestu', '2019-04-27 07:31:37', 'C', 3),
(124, 1, '{\"Menu\":\"Master\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"No\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Master\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Fullaccess\":\"No\"}', 'Update user menu Edo Gustian succesfully by Octavian Panggestu', '2019-04-27 07:31:55', 'U', 3),
(125, 1, NULL, '{\"Menu\":\"Master\",\"Status Usermenu\":\"Not Active\"}', NULL, 'Delete user menu Edo Gustian succesfully by Octavian Panggestu', '2019-04-27 07:32:08', 'D', 3),
(126, 1, '{\"Full Name\":\"Muhhamad Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Muhhamad Edo Gustian\"}', 'Update user Edo Gustian succesfully by Octavian Panggestu', '2019-04-27 07:41:19', 'U', 2),
(127, 1, '{\"Full Name\":\"Muhammad Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Muhhamad Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Muhammad Edo Gustian\"}', 'Update user Muhhamad Edo Gustian succesfully by Octavian Panggestu', '2019-04-27 07:41:32', 'U', 2),
(128, 1, '{\"Full Name\":\"Muhammad Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Muhammad Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '[]', 'Update user Muhammad Edo Gustian succesfully by Octavian Panggestu', '2019-04-27 07:41:39', 'U', 2),
(129, 1, NULL, '{\"Status\":\"Active\"}', NULL, 'Delete user Muhammad Fajar succesfully by Octavian Panggestu', '2019-04-27 07:45:07', 'D', 2),
(130, 1, NULL, '{\"Status\":\"Active\"}', NULL, 'Delete user Muhammad Fajar succesfully by Octavian Panggestu', '2019-04-27 07:46:18', 'D', 2),
(131, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Master1\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Code\":1,\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Master1\"}', 'Update menu Master1 succesfully by Octavian Panggestu', '2019-04-27 07:47:05', 'U', 1),
(132, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Code\":1,\"Menu Name\":\"Master1\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Master\"}', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-27 07:47:12', 'U', 1),
(133, 1, NULL, '{\"Menu Code\":1,\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', NULL, 'Delete menu Master succesfully by Octavian Panggestu', '2019-04-27 07:47:43', 'D', 1),
(134, 1, NULL, '{\"Menu Code\":7,\"Menu Name\":\"Area\",\"Menu Link\":\"area\",\"Lang\":\"area\",\"Parent Menu\":\"Master\",\"Status\":\"Not Active\"}', NULL, 'Delete menu Area succesfully by Octavian Panggestu', '2019-04-27 07:52:07', 'D', 1),
(135, 1, '{\"Menu Code\":\"7\",\"Menu Name\":\"Area\",\"Menu Link\":\"area\",\"Lang\":\"area\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":7,\"Menu Name\":\"Area\",\"Menu Link\":\"area\",\"Lang\":\"area\",\"Parent Menu\":\"Master\",\"Status\":\"Not Active\"}', '{\"Status\":\"Active\"}', 'Update menu Area succesfully by Octavian Panggestu', '2019-04-27 07:52:18', 'U', 1),
(141, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Code\":1,\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '[]', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-27 23:49:54', 'U', 1),
(142, 1, '{\"Full Name\":\"Muhammad Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Muhammad Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '[]', 'Update user Muhammad Edo Gustian succesfully by Octavian Panggestu', '2019-04-27 23:52:02', 'U', 2),
(143, 1, '{\"Full Name\":\"Muhammad Edo\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Muhammad Edo Gustian\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"General User\"}', '{\"Full Name\":\"Muhammad Edo\"}', 'Update user Muhammad Edo Gustian succesfully by Octavian Panggestu', '2019-04-27 23:54:09', 'U', 2),
(144, 1, '{\"Menu Code\":\"1\",\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '{\"Menu Code\":1,\"Menu Name\":\"Master\",\"Menu Link\":\"master\",\"Lang\":\"master\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', '[]', 'Update menu Master succesfully by Octavian Panggestu', '2019-04-27 23:54:40', 'U', 1),
(147, 1, '{\"Menu\":\"Master\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"No\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Master\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"No\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Not Active\"}', '{\"Status Usermenu\":\"Active\"}', 'Update user menu Muhammad Edo succesfully by Octavian Panggestu', '2019-04-27 23:56:32', 'U', 3),
(148, 1, '{\"Full Name\":\"DIPO Jatinegara\",\"Email\":\"dipo-jatinegara@gmail.com\",\"Company\":\"Kanaka\",\"Phone\":\"085123567123\",\"City\":\"Jakarta Timur\",\"Address\":\"Jalan Jatinegara 12\",\"Role \":\"DIPO\"}', '{\"Full Name\":\"Muhammad Edo\",\"Email\":\"edo@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"085123567\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Benda No 92\",\"Role \":\"DIPO\"}', '{\"Full Name\":\"DIPO Jatinegara\",\"Email\":\"dipo-jatinegara@gmail.com\",\"Company\":\"Kanaka\",\"Phone\":\"085123567123\",\"City\":\"Jakarta Timur\",\"Address\":\"Jalan Jatinegara 12\"}', 'Update user Muhammad Edo succesfully by Octavian Panggestu', '2019-04-28 00:24:12', 'U', 2),
(149, 1, '{\"Full Name\":\"PT Kanaka\",\"Email\":\"admin@kanaka.com\",\"Company\":\"PT KANAKA\",\"Phone\":\"+62878987654321\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Sudirman No 1\",\"Role \":\"Company\"}', '{\"Full Name\":\"Octavian Panggestu\",\"Email\":\"octavian91011@gmail.com\",\"Company\":\"Nadyne\",\"Phone\":\"+62878987654321\",\"City\":\"Bogor\",\"Address\":\"Cilebut\",\"Role \":\"Company\"}', '{\"Full Name\":\"PT Kanaka\",\"Email\":\"admin@kanaka.com\",\"Company\":\"PT KANAKA\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Sudirman No 1\"}', 'Update user Octavian Panggestu succesfully by Octavian Panggestu', '2019-04-28 00:24:52', 'U', 2);
INSERT INTO `logs` (`id_logs`, `id_user`, `data_new`, `data_old`, `data_change`, `message`, `created_on`, `activity`, `type`) VALUES
(150, 1, '{\"Full Name\":\"Mitra Beras Jatinegara\",\"Email\":\"mitra_beras_jatinegara@kanaka.com\",\"Role\":\"Mitra\",\"Company\":\"PT Kanaka\",\"Phone\":\"0212378176\"}', NULL, NULL, 'Add user Mitra Beras Jatinegara succesfully by PT Kanaka', '2019-04-28 00:25:44', 'C', 2),
(151, 1, '{\"Full Name\":\"PT Kanaka\",\"Email\":\"admin@kanaka.com\",\"Company\":\"PT Kanaka\",\"Phone\":\"+62878987654321\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Sudirman No 1\",\"Role \":\"Company\"}', '{\"Full Name\":\"PT Kanaka\",\"Email\":\"admin@kanaka.com\",\"Company\":\"PT KANAKA\",\"Phone\":\"+62878987654321\",\"City\":\"Jakarta Selatan\",\"Address\":\"Jalan Sudirman No 1\",\"Role \":\"Company\"}', '{\"Company\":\"PT Kanaka\"}', 'Update user PT Kanaka succesfully by PT Kanaka', '2019-04-28 00:25:57', 'U', 2),
(152, 1, '{\"Full Name\":\"DIPO Jatinegara\",\"Email\":\"dipo-jatinegara@gmail.com\",\"Company\":\"PT Kanaka\",\"Phone\":\"085123567123\",\"City\":\"Jakarta Timur\",\"Address\":\"Jalan Jatinegara 12\",\"Role \":\"DIPO\"}', '{\"Full Name\":\"DIPO Jatinegara\",\"Email\":\"dipo-jatinegara@gmail.com\",\"Company\":\"Kanaka\",\"Phone\":\"085123567123\",\"City\":\"Jakarta Timur\",\"Address\":\"Jalan Jatinegara 12\",\"Role \":\"DIPO\"}', '{\"Company\":\"PT Kanaka\"}', 'Update user DIPO Jatinegara succesfully by PT Kanaka', '2019-04-28 00:26:05', 'U', 2),
(153, 1, '{\"User\":\"Mitra Beras Jatinegara\",\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu Mitra Beras Jatinegara succesfully by PT Kanaka', '2019-04-28 00:39:35', 'C', 3),
(154, 1, '{\"User\":\"Mitra Beras Jatinegara\",\"Menu\":\"Transaction\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu Mitra Beras Jatinegara succesfully by PT Kanaka', '2019-04-28 00:39:43', 'C', 3),
(155, 1, '{\"Menu\":\"Reports\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Users\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Reports\"}', 'Update user menu DIPO Jatinegara succesfully by PT Kanaka', '2019-04-28 00:40:47', 'U', 3),
(156, 1, '{\"Menu\":\"Area\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Menus\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Area\"}', 'Update user menu DIPO Jatinegara succesfully by PT Kanaka', '2019-04-28 00:41:10', 'U', 3),
(157, 1, '{\"Menu Code\":\"8\",\"Menu Name\":\"Product\",\"Menu Link\":\"product\",\"Lang\":\"product\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Product succesfully by PT Kanaka', '2019-04-28 20:19:00', 'C', 1),
(158, 1, NULL, '{\"Menu Code\":6,\"Menu Name\":\"Brand\",\"Menu Link\":\"brand\",\"Lang\":\"brand\",\"Parent Menu\":\"Master\",\"Status\":\"Not Active\"}', NULL, 'Delete menu Brand succesfully by PT Kanaka', '2019-04-28 20:19:05', 'D', 1),
(159, 1, NULL, '{\"Menu Code\":7,\"Menu Name\":\"Area\",\"Menu Link\":\"area\",\"Lang\":\"area\",\"Parent Menu\":\"Master\",\"Status\":\"Not Active\"}', NULL, 'Delete menu Area succesfully by PT Kanaka', '2019-04-28 20:19:11', 'D', 1),
(160, 1, '{\"Menu Code\":\"9\",\"Menu Name\":\"DIPO\",\"Menu Link\":\"dipo\",\"Lang\":\"dipo\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu DIPO succesfully by PT Kanaka', '2019-04-28 20:19:30', 'C', 1),
(161, 1, '{\"Menu Code\":\"10\",\"Menu Name\":\"Partner\",\"Menu Link\":\"partner\",\"Lang\":\"partner\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Partner succesfully by PT Kanaka', '2019-04-28 20:19:55', 'C', 1),
(162, 1, '{\"Menu Code\":\"11\",\"Menu Name\":\"Transfer\",\"Menu Link\":\"transfer\",\"Lang\":\"transfer\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Transfer succesfully by PT Kanaka', '2019-04-28 20:20:13', 'C', 1),
(163, 1, NULL, '{\"Menu Code\":2,\"Menu Name\":\"Transaction\",\"Menu Link\":\"transaction\",\"Lang\":\"transaction\",\"Parent Menu\":\"-\",\"Status\":\"Not Active\"}', NULL, 'Delete menu Transaction succesfully by PT Kanaka', '2019-04-28 20:20:27', 'D', 1),
(164, 1, '{\"Menu Code\":\"12\",\"Menu Name\":\"Customer\",\"Menu Link\":\"customer\",\"Lang\":\"customer\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Customer succesfully by PT Kanaka', '2019-04-28 20:21:08', 'C', 1),
(165, 1, '{\"Menu Code\":\"13\",\"Menu Name\":\"Company\",\"Menu Link\":\"company\",\"Lang\":\"company\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Company succesfully by PT Kanaka', '2019-04-28 20:21:29', 'C', 1),
(166, 1, '{\"Menu Code\":\"14\",\"Menu Name\":\"DIPO\",\"Menu Link\":\"dipo_report\",\"Lang\":\"dipo_report\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu DIPO succesfully by PT Kanaka', '2019-04-28 20:22:00', 'C', 1),
(167, 1, '{\"Menu Code\":\"15\",\"Menu Name\":\"Partner\",\"Menu Link\":\"partner_report\",\"Lang\":\"partner_report\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Partner succesfully by PT Kanaka', '2019-04-28 20:22:20', 'C', 1),
(168, 1, '{\"Menu Code\":\"16\",\"Menu Name\":\"Admin\",\"Menu Link\":\"admin\",\"Lang\":\"admin\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Admin succesfully by PT Kanaka', '2019-04-28 20:22:36', 'C', 1),
(169, 1, '{\"Menu Code\":\"17\",\"Menu Name\":\"Blog\",\"Menu Link\":\"blog\",\"Lang\":\"blog\",\"Parent Menu\":\"-\",\"Status\":\"Active\"}', NULL, NULL, 'Add menu Blog succesfully by PT Kanaka', '2019-04-28 20:22:47', 'C', 1),
(170, 1, '{\"Menu Code\":\"14\",\"Menu Name\":\"DIPO Report\",\"Menu Link\":\"dipo_report\",\"Lang\":\"dipo_report\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', '{\"Menu Code\":14,\"Menu Name\":\"DIPO\",\"Menu Link\":\"dipo_report\",\"Lang\":\"dipo_report\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', '{\"Menu Name\":\"DIPO Report\"}', 'Update menu DIPO Report succesfully by PT Kanaka', '2019-04-28 20:23:40', 'U', 1),
(171, 1, '{\"Menu Code\":\"15\",\"Menu Name\":\"Partner Report\",\"Menu Link\":\"partner_report\",\"Lang\":\"partner_report\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', '{\"Menu Code\":15,\"Menu Name\":\"Partner\",\"Menu Link\":\"partner_report\",\"Lang\":\"partner_report\",\"Parent Menu\":\"Reports\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Partner Report\"}', 'Update menu Partner Report succesfully by PT Kanaka', '2019-04-28 20:23:51', 'U', 1),
(172, 1, '{\"Menu\":\"Customer\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Area\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"Yes\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Customer\",\"Print Limited\":\"No\"}', 'Update user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:24:19', 'U', 3),
(173, 1, '{\"Menu\":\"Company\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Transaction\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Company\"}', 'Update user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:24:31', 'U', 3),
(174, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"DIPO Report\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:24:53', 'C', 3),
(175, 1, '{\"Menu\":\"Partner Report\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Brand\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', '{\"Menu\":\"Partner Report\"}', 'Update user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:25:19', 'U', 3),
(176, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"Product\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:26:07', 'C', 3),
(177, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"DIPO\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:26:30', 'C', 3),
(178, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"Partner\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:26:47', 'C', 3),
(179, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"Transfer\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:26:57', 'C', 3),
(180, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"Admin\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:27:12', 'C', 3),
(181, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"Blog\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-04-28 20:27:21', 'C', 3),
(182, 1, '{\"Name\":\"\",\"Address\":\"Jalan Pajajaran No 10\",\"Phone\":\"02518790654\",\"Email\":\"dipobogor@kanaka.com\",\"City\":\"Bogor\",\"Subdistrict\":\"Bogor Tengah\",\"Latitude\":\"8098898999\",\"Longitude\":\"-889898989\"}', NULL, NULL, 'Add dipo  succesfully by PT Kanaka', '2019-05-01 22:10:29', 'C', 6),
(183, 1, '{\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No9\",\"Phone\":\"02318654257\",\"Email\":\"dipobandung@kanaka.com\",\"City\":\"Bandung\",\"Subdistrict\":\"Tamansari\",\"Latitude\":\"87817283791\",\"Longitude\":\"-8738827318\"}', NULL, NULL, 'Add dipo Bandung Store succesfully by PT Kanaka', '2019-05-01 22:14:50', 'C', 6),
(184, 1, '{\"Name\":\"Jakarta Store\",\"Address\":\"Jalan Kemang 20\",\"Phone\":\"0218765234\",\"Email\":\"dipojakarta@kanaka.com\",\"City\":\"Jakarta Selatan\",\"Subdistrict\":\"Pasar Minggu\",\"Latitude\":\"87971923719\",\"Longitude\":\"-8978196237\"}', NULL, NULL, 'Add dipo Jakarta Store succesfully by PT Kanaka', '2019-05-01 22:25:23', 'C', 6),
(185, 1, '{\"Name\":\"Bandung Store 1\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\"}', '{\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No9\",\"Phone\":\"02318654257\",\"Email\":\"dipobandung@kanaka.com\",\"City\":\"Bandung\",\"Subdistrict\":\"Tamansari\",\"Latitude\":\"87817283791\",\"Longitude\":\"-8738827318\"}', '{\"Name\":\"Bandung Store 1\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\"}', 'Update dipo Bandung Store 1 succesfully by PT Kanaka', '2019-05-01 23:04:32', 'U', 6),
(186, 1, NULL, '{\"Name\":\"Bandung Store 1\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\"}', NULL, 'Delete dipo Bandung Store 1 succesfully by PT Kanaka', '2019-05-01 23:05:28', 'D', 6),
(187, 1, '{\"Name\":\"Semarang Store\",\"Address\":\"Jalan Diponegoro No 7\",\"Phone\":\"02358618236\",\"Email\":\"semarang_store@kanaka.com\",\"City\":\"Semarang\",\"Subdistrict\":\"Semarang Utara\",\"Latitude\":\"89815236576152\",\"Longitude\":\"-89123617623781\"}', NULL, NULL, 'Add dipo Semarang Store succesfully by PT Kanaka', '2019-05-09 05:25:51', 'C', 6),
(188, 1, '{\"Name\":\"Semarang Store\",\"Address\":\"Jalan Diponegoro No 7\",\"Phone\":\"02358618236\",\"Email\":\"diposemarang@kanaka.com\",\"City\":\"Semarang\",\"Subdistrict\":\"Semarang Utara\",\"Latitude\":\"89815236576152\",\"Longitude\":\"-89123617623781\"}', '{\"Name\":\"Semarang Store\",\"Address\":\"Jalan Diponegoro No 7\",\"Phone\":\"02358618236\",\"Email\":\"semarang_store@kanaka.com\",\"City\":\"Semarang\",\"Subdistrict\":\"Semarang Utara\",\"Latitude\":\"89815236576152\",\"Longitude\":\"-89123617623781\"}', '{\"Email\":\"diposemarang@kanaka.com\"}', 'Update dipo Semarang Store succesfully by PT Kanaka', '2019-05-09 05:26:07', 'U', 6),
(189, 1, NULL, '{\"Name\":\"Semarang Store\",\"Address\":\"Jalan Diponegoro No 7\",\"Phone\":\"02358618236\",\"Email\":\"diposemarang@kanaka.com\",\"City\":\"Semarang\",\"Subdistrict\":\"Semarang Utara\",\"Latitude\":\"89815236576152\",\"Longitude\":\"-89123617623781\"}', NULL, 'Delete dipo Semarang Store succesfully by PT Kanaka', '2019-05-09 05:31:15', 'D', 6),
(190, 1, '{\"Menu Code\":\"2\",\"Menu Name\":\"Product Category\",\"Menu Link\":\"product_category\",\"Lang\":\"product_category\",\"Parent Menu\":\"Admin\",\"Status\":\"Active\"}', '{\"Menu Code\":2,\"Menu Name\":\"Transaction\",\"Menu Link\":\"transaction\",\"Lang\":\"transaction\",\"Parent Menu\":\"-\",\"Status\":\"Not Active\"}', '{\"Menu Name\":\"Product Category\",\"Menu Link\":\"product_category\",\"Lang\":\"product_category\",\"Parent Menu\":\"Admin\",\"Status\":\"Active\"}', 'Update menu Product Category succesfully by PT Kanaka', '2019-05-10 05:44:43', 'U', 1),
(191, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"Product Category\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-05-10 05:45:35', 'C', 3),
(192, 1, '{\"Menu Code\":\"2\",\"Menu Name\":\"Product Category\",\"Menu Link\":\"product_category\",\"Lang\":\"product_category\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":2,\"Menu Name\":\"Product Category\",\"Menu Link\":\"product_category\",\"Lang\":\"product_category\",\"Parent Menu\":\"Admin\",\"Status\":\"Active\"}', '{\"Parent Menu\":\"Master\"}', 'Update menu Product Category succesfully by PT Kanaka', '2019-05-10 05:46:01', 'U', 1),
(193, 1, '{\"Menu Code\":\"8\",\"Menu Name\":\"Category\",\"Menu Link\":\"category\",\"Lang\":\"category\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":8,\"Menu Name\":\"Product Category\",\"Menu Link\":\"product_category\",\"Lang\":\"product_category\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Category\",\"Menu Link\":\"category\",\"Lang\":\"category\"}', 'Update menu Category succesfully by PT Kanaka', '2019-05-12 21:50:22', 'U', 1),
(194, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan Pokok\",\"Image\":\"\"}', NULL, NULL, 'Add category Beras succesfully by PT Kanaka', '2019-05-12 23:31:11', 'C', 5),
(195, 1, '{\"Name\":\"Gula\",\"Description\":\"Makanan\",\"Image\":\"logo-template.png\"}', NULL, NULL, 'Add category Gula succesfully by PT Kanaka', '2019-05-12 23:32:51', 'C', 5),
(196, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Logo-Property.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan Pokok\",\"Image\":\"\"}', '{\"Description\":\"Makanan\",\"Image\":\"Logo-Property.png\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-12 23:34:29', 'U', 5),
(197, 1, NULL, '{\"Name\":\"Gula\",\"Description\":\"Makanan\",\"Image\":\"logo-template.png\"}', NULL, 'Delete category Gula succesfully by PT Kanaka', '2019-05-12 23:37:08', 'D', 5),
(198, 1, '{\"Name\":\"Gula\",\"Description\":\"Makanan\",\"Image\":\"\"}', NULL, NULL, 'Add category Gula succesfully by PT Kanaka', '2019-05-12 23:38:43', 'C', 5),
(199, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan Pokok\",\"Image\":\"Logo-Property.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Logo-Property.png\"}', '{\"Description\":\"Makanan Pokok\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-13 23:45:56', 'U', 5),
(200, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan Pokok\",\"Image\":\"Logo-Property.png\"}', '{\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-13 23:47:00', 'U', 5),
(201, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', '[]', 'Update category Beras succesfully by PT Kanaka', '2019-05-14 05:28:42', 'U', 5),
(202, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"t-transparent-logo-7.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', '{\"Image\":\"t-transparent-logo-7.png\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-14 05:29:59', 'U', 5),
(203, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"t-transparent-logo-7.png\"}', '{\"Image\":\"Real_Estate.png\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-14 05:32:17', 'U', 5),
(204, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"logo_property.jpg\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', '{\"Image\":\"logo_property.jpg\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-14 05:37:00', 'U', 5),
(205, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"logo_property.jpg\"}', '{\"Image\":\"Real_Estate.png\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-14 05:39:15', 'U', 5),
(206, 1, NULL, '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', NULL, 'Delete category Beras succesfully by PT Kanaka', '2019-05-14 05:39:55', 'D', 5),
(207, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan Pokok\",\"Image\":\"Logo-Property.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan\",\"Image\":\"Real_Estate.png\"}', '{\"Description\":\"Makanan Pokok\",\"Image\":\"Logo-Property.png\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-14 22:30:06', 'U', 5),
(208, 1, '{\"Name\":\"Beras\",\"Description\":\"Makanan Pokok\",\"Image\":\"Real_Estate.png\"}', '{\"Name\":\"Beras\",\"Description\":\"Makanan Pokok\",\"Image\":\"Logo-Property.png\"}', '{\"Image\":\"Real_Estate.png\"}', 'Update category Beras succesfully by PT Kanaka', '2019-05-14 22:31:08', 'U', 5),
(209, 1, '{\"Menu Code\":\"12\",\"Menu Name\":\"Vendor\",\"Menu Link\":\"vendor\",\"Lang\":\"vendor\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":12,\"Menu Name\":\"Transfer\",\"Menu Link\":\"transfer\",\"Lang\":\"transfer\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Vendor\",\"Menu Link\":\"vendor\",\"Lang\":\"vendor\"}', 'Update menu Vendor succesfully by PT Kanaka', '2019-05-14 23:22:48', 'U', 1),
(210, 1, '{\"Code\":\"SRB\",\"Name\":\"Surabaya Store\",\"Address\":\"Jalan Bung Tomo\",\"Phone\":\"0236787129\",\"Email\":\"diposurabaya@kanaka.com\",\"City\":\"Surabaya\",\"Subdistrict\":\"Surabaya Barat\",\"Latitude\":\"871761564615\",\"Longitude\":\"-819685717651\"}', NULL, NULL, 'Add dipo Surabaya Store succesfully by PT Kanaka', '2019-05-14 23:44:41', 'C', 6),
(211, 1, '{\"Code\":\"JKT\",\"Name\":\"Jakarta Store\",\"Address\":\"Jalan Kemang 20\",\"Phone\":\"0218765234\",\"Email\":\"dipojakarta@kanaka.com\",\"City\":\"Jakarta Selatan\",\"Subdistrict\":\"Pasar Minggu\",\"Latitude\":\"87971923719\",\"Longitude\":\"-8978196237\"}', '{\"Code\":\"\",\"Name\":\"Jakarta Store\",\"Address\":\"Jalan Kemang 20\",\"Phone\":\"0218765234\",\"Email\":\"dipojakarta@kanaka.com\",\"City\":\"Jakarta Selatan\",\"Subdistrict\":\"Pasar Minggu\",\"Latitude\":\"87971923719\",\"Longitude\":\"-8978196237\"}', '{\"Code\":\"JKT\"}', 'Update dipo Jakarta Store succesfully by PT Kanaka', '2019-05-14 23:44:59', 'U', 6),
(212, 1, '{\"Code\":\"BGR\",\"Name\":\"Bogor Store\",\"Address\":\"Jalan Pajajaran No 10\",\"Phone\":\"02518790654\",\"Email\":\"dipobogor@kanaka.com\",\"City\":\"Bogor\",\"Subdistrict\":\"Bogor Tengah\",\"Latitude\":\"8098898999\",\"Longitude\":\"-889898989\"}', '{\"Code\":\"\",\"Name\":\"Bogor Store\",\"Address\":\"Jalan Pajajaran No 10\",\"Phone\":\"02518790654\",\"Email\":\"dipobogor@kanaka.com\",\"City\":\"Bogor\",\"Subdistrict\":\"Bogor Tengah\",\"Latitude\":\"8098898999\",\"Longitude\":\"-889898989\"}', '{\"Code\":\"BGR\"}', 'Update dipo Bogor Store succesfully by PT Kanaka', '2019-05-14 23:45:07', 'U', 6),
(213, 1, NULL, '{\"Code\":\"SRB\",\"Name\":\"Surabaya Store\",\"Address\":\"Jalan Bung Tomo\",\"Phone\":\"0236787129\",\"Email\":\"diposurabaya@kanaka.com\",\"City\":\"Surabaya\",\"Subdistrict\":\"Surabaya Barat\",\"Latitude\":\"871761564615\",\"Longitude\":\"-819685717651\"}', NULL, 'Delete dipo Surabaya Store succesfully by PT Kanaka', '2019-05-14 23:46:13', 'D', 6),
(214, 1, '{\"Menu Code\":\"6\",\"Menu Name\":\"Zona\",\"Menu Link\":\"zona\",\"Lang\":\"zona\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":6,\"Menu Name\":\"Brand\",\"Menu Link\":\"brand\",\"Lang\":\"brand\",\"Parent Menu\":\"Master\",\"Status\":\"Not Active\"}', '{\"Menu Name\":\"Zona\",\"Menu Link\":\"zona\",\"Lang\":\"zona\",\"Status\":\"Active\"}', 'Update menu Zona succesfully by PT Kanaka', '2019-05-15 22:06:39', 'U', 1),
(215, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"Zona\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-05-15 22:08:02', 'C', 3),
(216, 1, '{\"Name\":\"Zona\",\"Description\":\"Jakarta, Bogor,Bandung\"}', NULL, NULL, 'Add zona Zona succesfully by PT Kanaka', '2019-05-15 22:38:00', 'C', 8),
(217, 1, '{\"Name\":\"Gas\",\"Description\":\"Gas 3 Kg\",\"Image\":\"Logo-Property.png\"}', '{\"Name\":\"Zona\",\"Description\":\"Jakarta, Bogor,Bandung\",\"Image\":\"\"}', '{\"Name\":\"Gas\",\"Description\":\"Gas 3 Kg\",\"Image\":\"Logo-Property.png\"}', 'Update category Gas succesfully by PT Kanaka', '2019-05-15 22:42:00', 'U', 5),
(218, 1, '{\"Name\":\"Zona 1\",\"Description\":\"Jakarta, Bogor, Bandung\"}', NULL, NULL, 'Add zona Zona 1 succesfully by PT Kanaka', '2019-05-15 22:45:30', 'C', 8),
(219, 1, '{\"Name\":\"Zona 2\",\"Description\":\"Padang\"}', NULL, NULL, 'Add zona Zona 2 succesfully by PT Kanaka', '2019-05-15 22:45:49', 'C', 8),
(220, 1, '{\"Name\":\"Zona 2\",\"Description\":\"Padang, Lampung\"}', '{\"Name\":\"Zona 2\",\"Description\":\"Padang\"}', '{\"Description\":\"Padang, Lampung\"}', 'Update zona Zona 2 succesfully by PT Kanaka', '2019-05-15 22:45:58', 'U', 8),
(221, 1, NULL, '{\"Name\":\"Zona 2\",\"Description\":\"Padang, Lampung\"}', NULL, 'Delete zona Zona 2 succesfully by PT Kanaka', '2019-05-15 22:48:11', 'D', 8),
(222, 1, '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0236787129\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Latitude\":\"871761564615\",\"Longitude\":\"-819685717651\"}', '{\"Code\":\"SRB\",\"Name\":\"Surabaya Store\",\"Address\":\"Jalan Bung Tomo\",\"Phone\":\"0236787129\",\"Email\":\"diposurabaya@kanaka.com\",\"City\":\"Surabaya\",\"Subdistrict\":\"Surabaya Barat\",\"Latitude\":\"871761564615\",\"Longitude\":\"-819685717651\"}', '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\"}', 'Update dipo Padang Store succesfully by PT Kanaka', '2019-05-15 23:58:02', 'U', 6),
(223, 1, '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0256787129\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"87176156461589\",\"Longitude\":\"-81968571765176\"}', '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0236787129\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"871761564615\",\"Longitude\":\"-819685717651\"}', '{\"Phone\":\"0256787129\",\"Latitude\":\"87176156461589\",\"Longitude\":\"-81968571765176\"}', 'Update dipo Padang Store succesfully by PT Kanaka', '2019-05-16 00:02:03', 'U', 6),
(224, 1, '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0256787129\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87176156461589\",\"Longitude\":\"-81968571765176\"}', '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0256787129\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"87176156461589\",\"Longitude\":\"-81968571765176\"}', '{\"Zona Name\":\"Zona 1\"}', 'Update dipo Padang Store succesfully by PT Kanaka', '2019-05-16 00:02:48', 'U', 6),
(225, 1, '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0256787129\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"87176156461589\",\"Longitude\":\"-81968571765176\"}', '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0256787129\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87176156461589\",\"Longitude\":\"-81968571765176\"}', '{\"Zona Name\":\"Zona 2\"}', 'Update dipo Padang Store succesfully by PT Kanaka', '2019-05-16 00:03:11', 'U', 6),
(226, 1, '{\"Code\":\"LMP\",\"Name\":\"Lampung Store\",\"Address\":\"Jalan Sudirman\",\"Phone\":\"02657687623\",\"Email\":\"dipolampung@kanaka.com\",\"City\":\"Lampung\",\"Subdistrict\":\"Bandar Lampung\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"8917236516\",\"Longitude\":\"-8186237152\"}', NULL, NULL, 'Add dipo Lampung Store succesfully by PT Kanaka', '2019-05-16 00:04:22', 'C', 6),
(227, 1, NULL, '{\"Code\":\"LMP\",\"Name\":\"Lampung Store\",\"Address\":\"Jalan Sudirman\",\"Phone\":\"02657687623\",\"Email\":\"dipolampung@kanaka.com\",\"City\":\"Lampung\",\"Subdistrict\":\"Bandar Lampung\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"8917236516\",\"Longitude\":\"-8186237152\"}', NULL, 'Delete dipo Lampung Store succesfully by PT Kanaka', '2019-05-16 00:04:57', 'D', 6),
(228, 1, '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0256787120\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"87176156461589\",\"Longitude\":\"-81968571765176\"}', '{\"Code\":\"PDG\",\"Name\":\"Padang Store\",\"Address\":\"Jalan Ahmad Yani\",\"Phone\":\"0256787129\",\"Email\":\"dipopadang@kanaka.com\",\"City\":\"Padang\",\"Subdistrict\":\"Sumatera Barat\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"87176156461589\",\"Longitude\":\"-81968571765176\"}', '{\"Phone\":\"0256787120\"}', 'Update DIPO Padang Store succesfully by PT Kanaka', '2019-05-16 00:06:11', 'U', 6),
(229, 1, '{\"Code\":\"PLB\",\"Name\":\"Palembang Store\",\"Address\":\"Jalan Ampera No 10\",\"Phone\":\"02458123671\",\"Email\":\"dipopalembang@kanaka.com\",\"City\":\"Palembang\",\"Subdistrict\":\"Sumatera Selatan\",\"Zona Name\":\"Zona 2\",\"Latitude\":\"887182367125\",\"Longitude\":\"-871623152271\"}', NULL, NULL, 'Add DIPO Palembang Store succesfully by PT Kanaka', '2019-05-16 00:13:44', 'C', 6),
(230, 1, '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"Ahmad\"}', '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"\"}', '{\"PIC\":\"Ahmad\"}', 'Update DIPO Bandung Store succesfully by PT Kanaka', '2019-05-18 23:22:47', 'U', 6),
(231, 1, '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"ahmad\"}', '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"\"}', '{\"PIC\":\"ahmad\"}', 'Update DIPO Bandung Store succesfully by PT Kanaka', '2019-05-18 23:34:08', 'U', 6),
(232, 1, '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"Reza\"}', '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"\"}', '{\"PIC\":\"Reza\"}', 'Update DIPO Bandung Store succesfully by PT Kanaka', '2019-05-18 23:35:20', 'U', 6),
(233, 1, '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"Reza\",\"TOP\":\"14\"}', '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"Reza\",\"TOP\":\"\"}', '{\"TOP\":\"14\"}', 'Update DIPO Bandung Store succesfully by PT Kanaka', '2019-05-19 08:38:56', 'U', 6),
(234, 1, '{\"Code\":\"M00001\",\"Name\":\"MITRA Cimanggis\",\"DIPO Name\":\"Jakarta Store\",\"Address\":\"Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat\",\"Phone\":\"085811275490\",\"Email\":\"mitracimanggis@kanaka.com\",\"City\":\"Depok\",\"Subdistrict\":\"Cimanggis\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"897918623123\",\"Longitude\":\"-899891723812\",\"PIC\":\" Udin \",\"TOP\":\"7\"}', NULL, NULL, 'Add Partner MITRA Cimanggis succesfully by PT Kanaka', '2019-05-19 09:55:44', 'C', 7),
(235, 1, '{\"Code\":\"M00001\",\"Name\":\"MITRA Cimanggis\",\"DIPO Name\":\"Jakarta Store\",\"Address\":\"Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat\",\"Phone\":\"085811275490\",\"Email\":\"mitracimanggis@kanaka.com\",\"City\":\"Depok\",\"Subdistrict\":\"Cimanggis\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"897918623123\",\"Longitude\":\"-899891723812\",\"PIC\":\"Udin\",\"TOP\":\"7\"}', '{\"Code\":\"M00001\",\"Name\":\"MITRA Cimanggis\",\"DIPO Name\":\"Jakarta Store\",\"Address\":\"Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat\",\"Phone\":\"085811275490\",\"Email\":\"mitracimanggis@kanaka.com\",\"City\":\"Depok\",\"Subdistrict\":\"Cimanggis\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"897918623123\",\"Longitude\":\"-899891723812\",\"PIC\":\"Udin\",\"TOP\":\"7\"}', '[]', 'Update Partner MITRA Cimanggis succesfully by PT Kanaka', '2019-05-19 09:56:52', 'U', 7),
(236, 1, '{\"Code\":\"M00001\",\"Name\":\"MITRA Cimanggis\",\"DIPO Name\":\"Jakarta Store\",\"Address\":\"Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat\",\"Phone\":\"085811275490\",\"Email\":\"mitracimanggis@kanaka.com\",\"City\":\"Depok\",\"Subdistrict\":\"Cimanggis\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"897918623123\",\"Longitude\":\"-899891723812\",\"PIC\":\"Asep\",\"TOP\":\"7\"}', '{\"Code\":\"M00001\",\"Name\":\"MITRA Cimanggis\",\"DIPO Name\":\"Jakarta Store\",\"Address\":\"Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat\",\"Phone\":\"085811275490\",\"Email\":\"mitracimanggis@kanaka.com\",\"City\":\"Depok\",\"Subdistrict\":\"Cimanggis\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"897918623123\",\"Longitude\":\"-899891723812\",\"PIC\":\"Udin\",\"TOP\":\"7\"}', '{\"PIC\":\"Asep\"}', 'Update Partner MITRA Cimanggis succesfully by PT Kanaka', '2019-05-19 09:59:33', 'U', 7),
(237, 1, NULL, '{\"Code\":\"M00001\",\"Name\":\"MITRA Cimanggis\",\"DIPO Name\":\"Jakarta Store\",\"Address\":\"Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat\",\"Phone\":\"085811275490\",\"Email\":\"mitracimanggis@kanaka.com\",\"City\":\"Depok\",\"Subdistrict\":\"Cimanggis\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"897918623123\",\"Longitude\":\"-899891723812\",\"PIC\":\"Asep\",\"TOP\":\"7\"}', NULL, 'Delete Partner MITRA Cimanggis succesfully by PT Kanaka', '2019-05-19 10:00:00', 'D', 7),
(238, 1, '{\"Product\":\"Minyak Goreng Promoo Pillow 200ml\",\"Normal Price\":\"106000\",\"Company Before Tax in Pcs\":\"1743\",\"Company Before Tax in Ctn\":\"83636\",\"Company After Tax in Pcs\":\"92000\",\"Stock Availibility\":\"Available\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"1777\",\"Dipo Before Tax in Ctn\":\"85309\",\"Dipo After Tax in Pcs\":\"93840\",\"Dipo After Tax Round Up in Ctn\":\"93900\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"1813\",\"Mitra Before Tax in Ctn\":\"87015\",\"Mitra After Tax in Pcs\":\"95717\",\"Mitra After Tax Round Up in Ctn\":\"95800\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"1885\",\"Customer Before Tax in Ctn\":\"90496\",\"Customer After Tax in Pcs\":\"99546\",\"Customer After Tax Round Up in Ctn\":\"99600\",\"HET Round Up in Pcs\":\"2100\",\"HET Round Up in Ctn\":\"100800\"}', '{\"Product\":\"Minyak Goreng Promoo Pillow 200ml\",\"Normal Price\":106000,\"Company Before Tax in Pcs\":1742,\"Company Before Tax in Ctn\":83636,\"Company After Tax in Pcs\":92000,\"Stock Availibility\":\"Available\",\"Dipo Discount\":2,\"Dipo Before Tax in Pcs\":1777,\"Dipo Before Tax in Ctn\":85309,\"Dipo After Tax in Pcs\":93840,\"Dipo After Tax Round Up in Ctn\":93900,\"Mitra Discount\":2,\"Mitra Before Tax in Pcs\":1813,\"Mitra Before Tax in Ctn\":87015,\"Mitra After Tax in Pcs\":95717,\"Mitra After Tax Round Up in Ctn\":95800,\"Customer Discount\":4,\"Customer Before Tax in Pcs\":1885,\"Customer Before Tax in Ctn\":90496,\"Customer After Tax in Pcs\":99546,\"Customer After Tax Round Up in Ctn\":99600,\"HET Round Up in Pcs\":2100,\"HET Round Up in Ctn\":100800}', '{\"Company Before Tax in Pcs\":\"1743\"}', 'Update price list Minyak Goreng Promoo Pillow 200ml succesfully by PT Kanaka', '2019-05-24 11:44:31', 'U', 11),
(239, 1, '{\"Product\":\"Minyak Goreng Promoo Pillow 200ml\",\"Normal Price\":\"106000\",\"Company Before Tax in Pcs\":\"1742\",\"Company Before Tax in Ctn\":\"83636\",\"Company After Tax in Pcs\":\"92000\",\"Stock Availibility\":\"Available\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"1777\",\"Dipo Before Tax in Ctn\":\"85309\",\"Dipo After Tax in Pcs\":\"93840\",\"Dipo After Tax Round Up in Ctn\":\"93900\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"1813\",\"Mitra Before Tax in Ctn\":\"87015\",\"Mitra After Tax in Pcs\":\"95717\",\"Mitra After Tax Round Up in Ctn\":\"95800\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"1885\",\"Customer Before Tax in Ctn\":\"90496\",\"Customer After Tax in Pcs\":\"99546\",\"Customer After Tax Round Up in Ctn\":\"99600\",\"HET Round Up in Pcs\":\"2100\",\"HET Round Up in Ctn\":\"100800\"}', '{\"Product\":\"Minyak Goreng Promoo Pillow 200ml\",\"Normal Price\":106000,\"Company Before Tax in Pcs\":1743,\"Company Before Tax in Ctn\":83636,\"Company After Tax in Pcs\":92000,\"Stock Availibility\":\"Available\",\"Dipo Discount\":2,\"Dipo Before Tax in Pcs\":1777,\"Dipo Before Tax in Ctn\":85309,\"Dipo After Tax in Pcs\":93840,\"Dipo After Tax Round Up in Ctn\":93900,\"Mitra Discount\":2,\"Mitra Before Tax in Pcs\":1813,\"Mitra Before Tax in Ctn\":87015,\"Mitra After Tax in Pcs\":95717,\"Mitra After Tax Round Up in Ctn\":95800,\"Customer Discount\":4,\"Customer Before Tax in Pcs\":1885,\"Customer Before Tax in Ctn\":90496,\"Customer After Tax in Pcs\":99546,\"Customer After Tax Round Up in Ctn\":99600,\"HET Round Up in Pcs\":2100,\"HET Round Up in Ctn\":100800}', '{\"Company Before Tax in Pcs\":\"1742\"}', 'Update price list Minyak Goreng Promoo Pillow 200ml succesfully by PT Kanaka', '2019-05-24 11:45:25', 'U', 11),
(240, 1, '{\"Menu Code\":\"11\",\"Menu Name\":\"Mitra\",\"Menu Link\":\"mitra\",\"Lang\":\"Mitra\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":11,\"Menu Name\":\"Partner\",\"Menu Link\":\"partner\",\"Lang\":\"partner\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Mitra\",\"Menu Link\":\"mitra\",\"Lang\":\"Mitra\"}', 'Update menu Mitra succesfully by PT Kanaka', '2019-05-24 11:47:03', 'U', 1),
(241, 1, '{\"Menu Code\":\"11\",\"Menu Name\":\"Mitra\",\"Menu Link\":\"mitra\",\"Lang\":\"Mitra\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":11,\"Menu Name\":\"Mitra\",\"Menu Link\":\"mitra\",\"Lang\":\"Mitra\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '[]', 'Update menu Mitra succesfully by PT Kanaka', '2019-05-24 11:47:41', 'U', 1),
(242, 1, '{\"Menu Code\":\"11\",\"Menu Name\":\"Partner\",\"Menu Link\":\"partner\",\"Lang\":\"partner\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Code\":11,\"Menu Name\":\"Mitra\",\"Menu Link\":\"mitra\",\"Lang\":\"Mitra\",\"Parent Menu\":\"Master\",\"Status\":\"Active\"}', '{\"Menu Name\":\"Partner\",\"Menu Link\":\"partner\",\"Lang\":\"partner\"}', 'Update menu Partner succesfully by PT Kanaka', '2019-05-24 11:48:24', 'U', 1),
(243, 1, '{\"User\":\"PT Kanaka\",\"Menu\":\"Surat Pesanan\",\"Availabled\":\"Yes\",\"Created\":\"Yes\",\"Viewed\":\"Yes\",\"Updated\":\"Yes\",\"Deleted\":\"Yes\",\"Approved\":\"Yes\",\"Verified\":\"Yes\",\"Fullaccess\":\"Yes\",\"Print Limited\":\"No\",\"Print Unlimited\":\"Yes\",\"Status Usermenu\":\"Active\"}', NULL, NULL, 'Add user menu PT Kanaka succesfully by PT Kanaka', '2019-05-27 09:25:24', 'C', 3),
(244, 1, '{\"Code\":\"P00003\",\"Name\":\"PT. NADYNE GLOBAL NIAGA\",\"Address\":\"Jl. Benda Raya No. 92, Kemang, Jakarta Selatan, DKI Jakarta\",\"Product\":\"Diapers\",\"Brand\":\"Fitti\",\"TOP\":\"CBD\",\"PIC\":\"Chika \",\"Phone Office\":\"02178835337\",\"Phone Personal\":\"085710019305\",\"Fax\":\"02178835350\",\"Email Office\":\"info@nadyne.com\",\"Email Persoal\":\"chika@nadyne.com\",\"Web\":\"http:\\/\\/nadyne.com\\/\"}', NULL, NULL, 'Add Principle PT. NADYNE GLOBAL NIAGA succesfully by PT Kanaka', '2019-05-27 10:52:57', 'C', 10),
(245, 1, '{\"Code\":\"P00004\",\"Name\":\"PT. ASIA PARAMITA INDAH\",\"Address\":\"Jl. Perniagaan Barat No. 12,Jakarta Barat 11230, Indonesia\",\"Product\":\"Pasta Gigi\",\"Brand\":\"Darlie\",\"TOP\":\"30\",\"PIC\":\" Elvin Suryawijaya\",\"Phone Office\":\"\",\"Phone Personal\":\"08978695780\",\"Fax\":\"\",\"Email Office\":\"\",\"Email Persoal\":\"elvin_suryawijaya@darlie.com\",\"Web\":\"\"}', NULL, NULL, 'Add Principle PT. ASIA PARAMITA INDAH succesfully by PT Kanaka', '2019-05-27 10:56:58', 'C', 10),
(246, 1, '{\"Code\":\"P00005\",\"Name\":\"PT. SINARMAS DISTIRBUSI NUSANTARA\",\"Address\":\"Jl. Rawa Girang No.3, Kawasan Industri Pulogadung, Jakarta Timur, 13930\",\"Product\":\"Gula\",\"Brand\":\"Gulaku\",\"TOP\":\"CBD\",\"PIC\":\" Suprihatmo \",\"Phone Office\":\"0214602050\",\"Phone Personal\":\"08884103054\",\"Fax\":\"\",\"Email Office\":\"suprihatmo@sinarmas-distribusi.com\",\"Email Persoal\":\"prie.hatmo@gmail.com\",\"Web\":\" www.smart-plus.com\"}', NULL, NULL, 'Add Principle PT. SINARMAS DISTIRBUSI NUSANTARA succesfully by PT Kanaka', '2019-05-27 10:58:12', 'C', 10),
(247, 1, '{\"Code\":\"P00002\",\"Name\":\"PT. DSG SURYAMAS INDONESIA\",\"Address\":\"Jl. Pacatama Raya Kav. 18, Desa Leuwilimus, Cikande, 42186, Serang\",\"Product\":\"Diapers\",\"Brand\":\"Fitti\",\"TOP\":\"30\",\"PIC\":\"Veronika \",\"Phone Office\":\"0215256316\",\"Phone Personal\":\"082227049365\",\"Fax\":\"0215256357\",\"Email Office\":\"veronika@dsgap.com\",\"Email Persoal\":\"\",\"Web\":\"www.dsgil.com\"}', '{\"Code\":\"P00002\",\"Name\":\"PT. DSG SURYAMAS INDONESIA\",\"Address\":\"Jl. Pacatama Raya Kav. 18, Desa Leuwilimus, Cikande, 42186, Serang\",\"Product\":\"Diapers\",\"Brand\":\"Fitti\",\"TOP\":\"30\",\"PIC\":\"Veronika \",\"Phone Office\":\"0215256316\",\"Phone Personal\":\"082227049365\",\"Fax\":\"0215256357\",\"Email Office\":\"veronika@dsgap.com\",\"Email Persoal\":\"veronika@gmail.com\",\"Web\":\"www.dsgil.com\"}', '{\"Email Persoal\":\"\"}', 'Update Principle PT. DSG SURYAMAS INDONESIA succesfully by PT Kanaka', '2019-05-27 10:58:49', 'U', 10),
(248, 1, '{\"Code\":\"P00001\",\"Name\":\"PT. MITRAKARYA SUKSES NABATI\",\"Address\":\"Jl. Pluit Selatan Raya No. 106-107, Jakarta 14450, Indonesia\",\"Product\":\"Minyak Goreng\",\"Brand\":\"Promoo\",\"TOP\":\"30\",\"PIC\":\"Darwanto\",\"Phone Office\":\"02166603959\",\"Phone Personal\":\"081288982238\",\"Fax\":\"0216678695\",\"Email Office\":\"darwanto@mahakaryakapital.co.id\",\"Email Persoal\":\"darwanto@gmail.com\",\"Web\":\"\"}', '{\"Code\":\"P00001\",\"Name\":\"PT. MITRAKARYA SUKSES NABATI\",\"Address\":\"Jl. Pluit Selatan Raya No. 106-107, Jakarta 14450, Indonesia\",\"Product\":\"Minyak Goreng\",\"Brand\":\"Promoo\",\"TOP\":\"30\",\"PIC\":\"Darwanto\",\"Phone Office\":\"02166603959\",\"Phone Personal\":\"081288982238\",\"Fax\":\"0216678695\",\"Email Office\":\"darwanto@mahakaryakapital.co.id\",\"Email Persoal\":\"darwanto@gmail.com\",\"Web\":\"www.mitrakarya.com\"}', '{\"Web\":\"\"}', 'Update Principle PT. MITRAKARYA SUKSES NABATI succesfully by PT Kanaka', '2019-05-27 10:59:05', 'U', 10),
(249, 1, '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"Reza\",\"TOP\":\"14\"}', '{\"Code\":\"BDG\",\"Name\":\"Bandung Store\",\"Address\":\"Jalan Asia Afrika No 19\",\"Phone\":\"02318654259\",\"Email\":\"dipobandungstore@kanaka.com\",\"City\":\"Bandung Barat\",\"Subdistrict\":\"Ciwidey\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"87817283799\",\"Longitude\":\"-8738827319\",\"PIC\":\"Reza\",\"TOP\":\"14\"}', '[]', 'Update DIPO Bandung Store succesfully by PT Kanaka', '2019-05-27 11:59:04', 'U', 6),
(250, 1, '{\"Code\":\"D00001\",\"Name\":\"DIPO Tambun\",\"Address\":\"Graha Melasti Baru Blok CA2\\/5A RT01 RW17, Ds. Sumber Jaya, Tambun Selatan, Bekasi 17510\",\"Phone\":\"081385056419\",\"Email\":\"\",\"City\":\"Bekasi\",\"Subdistrict\":\"Tambun Selatan\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"\",\"Longitude\":\"\",\"PIC\":\" Sukar \",\"TOP\":\" 14\"}', NULL, NULL, 'Add DIPO DIPO Tambun succesfully by PT Kanaka', '2019-05-27 14:00:35', 'C', 6),
(251, 1, '{\"Code\":\"D00002\",\"Name\":\"DIPO Depok\",\"Address\":\"Gudang Raja Gas No. 43, Jl. Raya Kali Mulya, Kec. Cilodong, Kota Depok\",\"Phone\":\"081282751539\",\"Email\":\"\",\"City\":\"Depok\",\"Subdistrict\":\"Cilodong\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"\",\"Longitude\":\"\",\"PIC\":\" Purwanto\",\"TOP\":\"14\"}', NULL, NULL, 'Add DIPO DIPO Depok succesfully by PT Kanaka', '2019-05-27 14:02:51', 'C', 6),
(252, 1, '{\"Code\":\"D00003\",\"Name\":\"DIPO Bandung\",\"Address\":\"Jl. Gumuruh No. 76, Bandung, Jawa Barat\",\"Phone\":\"08112003812\",\"Email\":\"\",\"City\":\"Bandung\",\"Subdistrict\":\"Batununggal\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"\",\"Longitude\":\"\",\"PIC\":\" Aditya Nugraha\",\"TOP\":\"14\"}', NULL, NULL, 'Add DIPO DIPO Bandung succesfully by PT Kanaka', '2019-05-27 14:04:55', 'C', 6),
(253, 1, '{\"Code\":\"D00004\",\"Name\":\"Ragunan\",\"Address\":\"Jalan Ragunan\",\"Phone\":\"081288982238\",\"Email\":\"\",\"City\":\"Jakarta Selatan\",\"Subdistrict\":\"Pasar Minggu\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"\",\"Longitude\":\"\",\"PIC\":\" Darwanto\",\"TOP\":\"14\"}', NULL, NULL, 'Add DIPO Ragunan succesfully by PT Kanaka', '2019-05-27 14:07:38', 'C', 6),
(254, 1, '{\"Code\":\"M00001\",\"Name\":\"MITRA Cimanggis\",\"DIPO Name\":\"DIPO Depok\",\"Address\":\"Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat\",\"Phone\":\"085811275490\",\"Email\":\"\",\"City\":\"Depok\",\"Subdistrict\":\"Cimanggis\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"897918623123\",\"Longitude\":\"-899891723812\",\"PIC\":\"Udin\",\"TOP\":\"7\"}', '{\"Code\":\"M00001\",\"Name\":\"MITRA Cimanggis\",\"DIPO Name\":\"Jakarta Store\",\"Address\":\"Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat\",\"Phone\":\"085811275490\",\"Email\":\"mitracimanggis@kanaka.com\",\"City\":\"Depok\",\"Subdistrict\":\"Cimanggis\",\"Zona Name\":\"Zona 1\",\"Latitude\":\"897918623123\",\"Longitude\":\"-899891723812\",\"PIC\":\"Asep\",\"TOP\":\"7\"}', '{\"DIPO Name\":\"DIPO Depok\",\"Email\":\"\",\"PIC\":\"Udin\"}', 'Update Partner MITRA Cimanggis succesfully by PT Kanaka', '2019-05-27 14:19:05', 'U', 7),
(255, 1, '{\"Name\":\"Minyak Goreng Promoo Pillow 400ml\",\"Category\":\"Beras\",\"Product Code\":\"MGP00002\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"400ml x 24\",\"Qty\":\"24\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product Minyak Goreng Promoo Pillow 400ml succesfully by PT Kanaka', '2019-05-27 14:26:09', 'C', 4),
(256, 1, '{\"Name\":\"Minyak Goreng\",\"Description\":\"\",\"Image\":\"\"}', NULL, NULL, 'Add category Minyak Goreng succesfully by PT Kanaka', '2019-05-27 14:28:24', 'C', 5);
INSERT INTO `logs` (`id_logs`, `id_user`, `data_new`, `data_old`, `data_change`, `message`, `created_on`, `activity`, `type`) VALUES
(257, 1, '{\"Name\":\"Garam\",\"Description\":\"\",\"Image\":\"\"}', NULL, NULL, 'Add category Garam succesfully by PT Kanaka', '2019-05-27 14:31:44', 'C', 5),
(258, 1, '{\"Name\":\"Popok\",\"Description\":\"\",\"Image\":\"\"}', NULL, NULL, 'Add category Popok succesfully by PT Kanaka', '2019-05-27 14:33:22', 'C', 5),
(259, 1, '{\"Name\":\"Minyak Goreng Promoo Pillow 200ml\",\"Category\":\"5\",\"Product Code\":\"MGP00001\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"200ml x 48\",\"Qty\":\"48\",\"Length\":\"4\",\"Height\":\"6\",\"Width\":\"5\",\"Volume\":\"0.00\",\"Weight\":\"0\"}', '{\"Name\":\"Minyak Goreng Promoo Pillow 200ml\",\"Category\":1,\"Product Code\":\"MP00001\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"200ml x 48\",\"Qty\":48,\"Length\":4,\"Height\":6,\"Width\":5,\"Volume\":1.1999999999999999555910790149937383830547332763671875,\"Weight\":0}', '{\"Category\":\"5\",\"Product Code\":\"MGP00001\",\"Volume\":\"0.00\"}', 'Update product Minyak Goreng Promoo Pillow 200ml succesfully by PT Kanaka', '2019-05-27 14:34:29', 'U', 4),
(260, 1, '{\"Name\":\"Minyak Goreng Promoo Pillow 400ml\",\"Category\":\"5\",\"Product Code\":\"MGP00002\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"400ml x 24\",\"Qty\":\"24\",\"Length\":\"0\",\"Height\":\"0\",\"Width\":\"0\",\"Volume\":\"0\",\"Weight\":\"0\"}', '{\"Name\":\"Minyak Goreng Promoo Pillow 400ml\",\"Category\":1,\"Product Code\":\"MGP00002\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"400ml x 24\",\"Qty\":24,\"Length\":0,\"Height\":0,\"Width\":0,\"Volume\":0,\"Weight\":0}', '{\"Category\":\"5\"}', 'Update product Minyak Goreng Promoo Pillow 400ml succesfully by PT Kanaka', '2019-05-27 14:35:17', 'U', 4),
(261, 1, '{\"Name\":\"Minyak Goreng Promoo Pillow 800ml\",\"Category\":\"5\",\"Product Code\":\"MGP00003\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"800ml x 12\",\"Qty\":\"12\",\"Length\":\"0\",\"Height\":\"0\",\"Width\":\"0\",\"Volume\":\"0.00\",\"Weight\":\"\"}', '{\"Name\":\"BiorF Ultra 825ml\\r\\n\",\"Category\":1,\"Product Code\":\"SB00001\\r\\n\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"1 x 12\\r\\n\",\"Qty\":12,\"Length\":29,\"Height\":28,\"Width\":23,\"Volume\":0.0200000000000000004163336342344337026588618755340576171875,\"Weight\":10.46000000000000085265128291212022304534912109375}', '{\"Name\":\"Minyak Goreng Promoo Pillow 800ml\",\"Category\":\"5\",\"Product Code\":\"MGP00003\",\"Packing Size\":\"800ml x 12\",\"Length\":\"0\",\"Height\":\"0\",\"Width\":\"0\",\"Volume\":\"0.00\",\"Weight\":\"\"}', 'Update product Minyak Goreng Promoo Pillow 800ml succesfully by PT Kanaka', '2019-05-27 14:36:06', 'U', 4),
(262, 1, '{\"Name\":\"Minyak Goreng Promoo Pouch 1L\",\"Category\":\"Minyak Goreng\",\"Product Code\":\"MGP00004\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"1L x 12\",\"Qty\":\"12\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product Minyak Goreng Promoo Pouch 1L succesfully by PT Kanaka', '2019-05-27 14:43:25', 'C', 4),
(263, 1, '{\"Name\":\"Minyak Goreng Promoo Pouch 2L\",\"Category\":\"Minyak Goreng\",\"Product Code\":\"MGP00005\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"2L x 6\",\"Qty\":\"6\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product Minyak Goreng Promoo Pouch 2L succesfully by PT Kanaka', '2019-05-27 14:43:55', 'C', 4),
(264, 1, '{\"Name\":\"Minyak Goreng Promoo Jirigen 5L\",\"Category\":\"Minyak Goreng\",\"Product Code\":\"MGP00006\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"5L x 4\",\"Qty\":\"4\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product Minyak Goreng Promoo Jirigen 5L succesfully by PT Kanaka', '2019-05-27 14:44:20', 'C', 4),
(265, 1, '{\"Name\":\"Minyak Goreng Promoo Jirigen 19L\",\"Category\":\"Minyak Goreng\",\"Product Code\":\"MGP00007\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"19L x 1\",\"Qty\":\"19\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product Minyak Goreng Promoo Jirigen 19L succesfully by PT Kanaka', '2019-05-27 14:45:03', 'C', 4),
(266, 1, '{\"Name\":\"Minyak Goreng Promoo BIB 19L\",\"Category\":\"Minyak Goreng\",\"Product Code\":\"MGP00008\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"19L x 1\",\"Qty\":\"19\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product Minyak Goreng Promoo BIB 19L succesfully by PT Kanaka', '2019-05-27 14:45:30', 'C', 4),
(267, 1, '{\"Name\":\"Garam Dapur DN 20gr\",\"Category\":\"Garam\",\"Product Code\":\"GRDN00001\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"20gr X 20\",\"Qty\":\"40\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product Garam Dapur DN 20gr succesfully by PT Kanaka', '2019-05-27 14:46:02', 'C', 4),
(268, 1, '{\"Name\":\"FDP Bulk Pack Size M\",\"Category\":\"Popok\",\"Product Code\":\"FBP00001\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"1 x 120\",\"Qty\":\"120\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product FDP Bulk Pack Size M succesfully by PT Kanaka', '2019-05-27 14:46:28', 'C', 4),
(269, 1, '{\"Name\":\"FDP Bulk Pack Size L\",\"Category\":\"Popok\",\"Product Code\":\"FBP00002\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"1 x 120\",\"Qty\":\"120\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product FDP Bulk Pack Size L succesfully by PT Kanaka', '2019-05-27 14:46:51', 'C', 4),
(270, 1, '{\"Name\":\"FDP Bulk Pack Size XL\",\"Category\":\"Popok\",\"Product Code\":\"FBP00003\",\"Description\":\"\",\"Feature\":\"\",\"Barcode Product\":\"\",\"Barcode Carton\":\"\",\"Packing Size\":\"1 x 120\",\"Qty\":\"120\",\"Length\":\"\",\"Height\":\"\",\"Width\":\"\",\"Volume\":\"\",\"Weight\":\"\"}', NULL, NULL, 'Add product FDP Bulk Pack Size XL succesfully by PT Kanaka', '2019-05-27 14:47:12', 'C', 4),
(271, 1, NULL, '{\"Product\":\"Minyak Goreng Promoo Pillow 800ml\",\"Normal Price\":138000,\"Company Before Tax in Pcs\":10455,\"Company Before Tax in Ctn\":125455,\"Company After Tax in Pcs\":138000,\"Stock Availibility\":\"Available\",\"Dipo Discount\":2,\"Dipo Before Tax in Pcs\":10909,\"Dipo Before Tax in Ctn\":130909,\"Dipo After Tax in Pcs\":144000,\"Dipo After Tax Round Up in Ctn\":144000,\"Mitra Discount\":2,\"Mitra Before Tax in Pcs\":11364,\"Mitra Before Tax in Ctn\":136364,\"Mitra After Tax in Pcs\":150000,\"Mitra After Tax Round Up in Ctn\":150000,\"Customer Discount\":4,\"Customer Before Tax in Pcs\":11818,\"Customer Before Tax in Ctn\":141818,\"Customer After Tax in Pcs\":156000,\"Customer After Tax Round Up in Ctn\":156000,\"HET Round Up in Pcs\":13000,\"HET Round Up in Ctn\":156000}', NULL, 'Delete price list  succesfully by PT Kanaka', '2019-05-27 14:53:27', 'D', 11),
(272, 1, '{\"Product\":\"Minyak Goreng Promoo Pillow 200ml\",\"Normal Price\":\"106000\",\"Company Before Tax in Pcs\":\"1742\",\"Company Before Tax in Ctn\":\"83636\",\"Company After Tax in Pcs\":\"92000\",\"Stock Availibility\":\"Out of Stock\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"1777\",\"Dipo Before Tax in Ctn\":\"85309\",\"Dipo After Tax in Pcs\":\"93840\",\"Dipo After Tax Round Up in Ctn\":\"93900\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"1813\",\"Mitra Before Tax in Ctn\":\"87015\",\"Mitra After Tax in Pcs\":\"95717\",\"Mitra After Tax Round Up in Ctn\":\"95800\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"1885\",\"Customer Before Tax in Ctn\":\"90496\",\"Customer After Tax in Pcs\":\"99546\",\"Customer After Tax Round Up in Ctn\":\"99600\",\"HET Round Up in Pcs\":\"2100\",\"HET Round Up in Ctn\":\"100800\"}', NULL, NULL, 'Add price list Minyak Goreng Promoo Pillow 200ml succesfully by PT Kanaka', '2019-05-27 14:55:11', 'C', 11),
(273, 1, '{\"Product\":\"Minyak Goreng Promoo Pillow 400ml\",\"Normal Price\":\"104500\",\"Company Before Tax in Pcs\":\"3409\",\"Company Before Tax in Ctn\":\"81818\",\"Company After Tax in Pcs\":\"90000\",\"Stock Availibility\":\"Out of Stock\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"3477\",\"Dipo Before Tax in Ctn\":\"83455\",\"Dipo After Tax in Pcs\":\"91800\",\"Dipo After Tax Round Up in Ctn\":\"91800\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"3547\",\"Mitra Before Tax in Ctn\":\"85124\",\"Mitra After Tax in Pcs\":\"93636\",\"Mitra After Tax Round Up in Ctn\":\"93700\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"3689\",\"Customer Before Tax in Ctn\":\"88529\",\"Customer After Tax in Pcs\":\"97381\",\"Customer After Tax Round Up in Ctn\":\"97400\",\"HET Round Up in Pcs\":\"4100\",\"HET Round Up in Ctn\":\"98400\"}', NULL, NULL, 'Add price list Minyak Goreng Promoo Pillow 400ml succesfully by PT Kanaka', '2019-05-27 14:57:00', 'C', 11),
(274, 1, '{\"Product\":\"Minyak Goreng Promoo Pillow 800ml\",\"Normal Price\":\"102500\",\"Company Before Tax in Pcs\":\"6705\",\"Company Before Tax in Ctn\":\"80455\",\"Company After Tax in Pcs\":\"88500\",\"Stock Availibility\":\"Available\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"6839\",\"Dipo Before Tax in Ctn\":\"82064\",\"Dipo After Tax in Pcs\":\"90270\",\"Dipo After Tax Round Up in Ctn\":\"90300\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"6975\",\"Mitra Before Tax in Ctn\":\"83705\",\"Mitra After Tax in Pcs\":\"92075\",\"Mitra After Tax Round Up in Ctn\":\"92100\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"7254\",\"Customer Before Tax in Ctn\":\"87053\",\"Customer After Tax in Pcs\":\"95758\",\"Customer After Tax Round Up in Ctn\":\"95800\",\"HET Round Up in Pcs\":\"8000\",\"HET Round Up in Ctn\":\"96000\"}', '{\"Product\":\"Minyak Goreng Promoo Pillow 800ml\",\"Normal Price\":139000,\"Company Before Tax in Pcs\":10455,\"Company Before Tax in Ctn\":125455,\"Company After Tax in Pcs\":139000,\"Stock Availibility\":\"Available\",\"Dipo Discount\":2,\"Dipo Before Tax in Pcs\":10909,\"Dipo Before Tax in Ctn\":130909,\"Dipo After Tax in Pcs\":144000,\"Dipo After Tax Round Up in Ctn\":145000,\"Mitra Discount\":2,\"Mitra Before Tax in Pcs\":11364,\"Mitra Before Tax in Ctn\":136364,\"Mitra After Tax in Pcs\":150000,\"Mitra After Tax Round Up in Ctn\":150000,\"Customer Discount\":4,\"Customer Before Tax in Pcs\":11818,\"Customer Before Tax in Ctn\":141818,\"Customer After Tax in Pcs\":156000,\"Customer After Tax Round Up in Ctn\":156000,\"HET Round Up in Pcs\":13000,\"HET Round Up in Ctn\":156000}', '{\"Normal Price\":\"102500\",\"Company Before Tax in Pcs\":\"6705\",\"Company Before Tax in Ctn\":\"80455\",\"Company After Tax in Pcs\":\"88500\",\"Dipo Before Tax in Pcs\":\"6839\",\"Dipo Before Tax in Ctn\":\"82064\",\"Dipo After Tax in Pcs\":\"90270\",\"Dipo After Tax Round Up in Ctn\":\"90300\",\"Mitra Before Tax in Pcs\":\"6975\",\"Mitra Before Tax in Ctn\":\"83705\",\"Mitra After Tax in Pcs\":\"92075\",\"Mitra After Tax Round Up in Ctn\":\"92100\",\"Customer Before Tax in Pcs\":\"7254\",\"Customer Before Tax in Ctn\":\"87053\",\"Customer After Tax in Pcs\":\"95758\",\"Customer After Tax Round Up in Ctn\":\"95800\",\"HET Round Up in Pcs\":\"8000\",\"HET Round Up in Ctn\":\"96000\"}', 'Update price list Minyak Goreng Promoo Pillow 800ml succesfully by PT Kanaka', '2019-05-27 14:58:34', 'U', 11),
(275, 1, '{\"Product\":\"Minyak Goreng Promoo Pouch 1L\",\"Normal Price\":\"128000\",\"Company Before Tax in Pcs\":\"8409\",\"Company Before Tax in Ctn\":\"100909\",\"Company After Tax in Pcs\":\"111000\",\"Stock Availibility\":\"Available\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"8577\",\"Dipo Before Tax in Ctn\":\"102927\",\"Dipo After Tax in Pcs\":\"113220\",\"Dipo After Tax Round Up in Ctn\":\"113300\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"8749\",\"Mitra Before Tax in Ctn\":\"104986\",\"Mitra After Tax in Pcs\":\"115484\",\"Mitra After Tax Round Up in Ctn\":\"115500\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"9099\",\"Customer Before Tax in Ctn\":\"109185\",\"Customer After Tax in Pcs\":\"120103\",\"Customer After Tax Round Up in Ctn\":\"120200\",\"HET Round Up in Pcs\":\"10100\",\"HET Round Up in Ctn\":\"121200\"}', NULL, NULL, 'Add price list Minyak Goreng Promoo Pouch 1L succesfully by PT Kanaka', '2019-05-27 15:01:28', 'C', 11),
(276, 1, '{\"Product\":\"Minyak Goreng Promoo Pouch 2L\",\"Normal Price\":\"127000\",\"Company Before Tax in Pcs\":\"16667\",\"Company Before Tax in Ctn\":\"100000\",\"Company After Tax in Pcs\":\"110000\",\"Stock Availibility\":\"Available\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"17000\",\"Dipo Before Tax in Ctn\":\"102000\",\"Dipo After Tax in Pcs\":\"112200\",\"Dipo After Tax Round Up in Ctn\":\"112200\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"17340\",\"Mitra Before Tax in Ctn\":\"104040\",\"Mitra After Tax in Pcs\":\"114444\",\"Mitra After Tax Round Up in Ctn\":\"114500\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"18034\",\"Customer Before Tax in Ctn\":\"108202\",\"Customer After Tax in Pcs\":\"119022\",\"Customer After Tax Round Up in Ctn\":\"119100\",\"HET Round Up in Pcs\":\"19900\",\"HET Round Up in Ctn\":\"119400\"}', NULL, NULL, 'Add price list Minyak Goreng Promoo Pouch 2L succesfully by PT Kanaka', '2019-05-27 15:03:25', 'C', 11),
(277, 1, '{\"Product\":\"Minyak Goreng Promoo Jirigen 5L\",\"Normal Price\":\"221000\",\"Company Before Tax in Pcs\":\"45341\",\"Company Before Tax in Ctn\":\"181364\",\"Company After Tax in Pcs\":\"199500\",\"Stock Availibility\":\"Out of Stock\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"46248\",\"Dipo Before Tax in Ctn\":\"184991\",\"Dipo After Tax in Pcs\":\"203490\",\"Dipo After Tax Round Up in Ctn\":\"203500\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"47173\",\"Mitra Before Tax in Ctn\":\"188691\",\"Mitra After Tax in Pcs\":\"207560\",\"Mitra After Tax Round Up in Ctn\":\"207600\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"49060\",\"Customer Before Tax in Ctn\":\"196239\",\"Customer After Tax in Pcs\":\"215862\",\"Customer After Tax Round Up in Ctn\":\"215900\",\"HET Round Up in Pcs\":\"54000\",\"HET Round Up in Ctn\":\"216000\"}', NULL, NULL, 'Add price list Minyak Goreng Promoo Jirigen 5L succesfully by PT Kanaka', '2019-05-27 15:05:00', 'C', 11),
(278, 1, '{\"Product\":\"Minyak Goreng Promoo Jirigen 19L\",\"Normal Price\":\"203000\",\"Company Before Tax in Pcs\":\"8732\",\"Company Before Tax in Ctn\":\"165909\",\"Company After Tax in Pcs\":\"182500\",\"Stock Availibility\":\"Out of Stock\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"8907\",\"Dipo Before Tax in Ctn\":\"169227\",\"Dipo After Tax in Pcs\":\"186150\",\"Dipo After Tax Round Up in Ctn\":\"186200\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"9085\",\"Mitra Before Tax in Ctn\":\"172612\",\"Mitra After Tax in Pcs\":\"189873\",\"Mitra After Tax Round Up in Ctn\":\"189900\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"9448\",\"Customer Before Tax in Ctn\":\"179516\",\"Customer After Tax in Pcs\":\"197468\",\"Customer After Tax Round Up in Ctn\":\"197500\",\"HET Round Up in Pcs\":\"10400\",\"HET Round Up in Ctn\":\"197600\"}', NULL, NULL, 'Add price list Minyak Goreng Promoo Jirigen 19L succesfully by PT Kanaka', '2019-05-27 15:06:41', 'C', 11),
(279, 1, '{\"Product\":\"Minyak Goreng Promoo BIB 19L\",\"Normal Price\":\"190000\",\"Company Before Tax in Pcs\":\"8062\",\"Company Before Tax in Ctn\":\"153182\",\"Company After Tax in Pcs\":\"168500\",\"Stock Availibility\":\"Out of Stock\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"8223\",\"Dipo Before Tax in Ctn\":\"156245\",\"Dipo After Tax in Pcs\":\"171870\",\"Dipo After Tax Round Up in Ctn\":\"171900\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"8388\",\"Mitra Before Tax in Ctn\":\"159370\",\"Mitra After Tax in Pcs\":\"175307\",\"Mitra After Tax Round Up in Ctn\":\"175400\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"8723\",\"Customer Before Tax in Ctn\":\"165745\",\"Customer After Tax in Pcs\":\"182319\",\"Customer After Tax Round Up in Ctn\":\"182400\",\"HET Round Up in Pcs\":\"9600\",\"HET Round Up in Ctn\":\"182400\"}', NULL, NULL, 'Add price list Minyak Goreng Promoo BIB 19L succesfully by PT Kanaka', '2019-05-27 15:08:14', 'C', 11),
(280, 1, '{\"Product\":\"Garam Dapur DN 20gr\",\"Normal Price\":\"70000\",\"Company Before Tax in Pcs\":\"1477\",\"Company Before Tax in Ctn\":\"59091\",\"Company After Tax in Pcs\":\"65000\",\"Stock Availibility\":\"Out of Stock\",\"Dipo Discount\":\"2\",\"Dipo Before Tax in Pcs\":\"1507\",\"Dipo Before Tax in Ctn\":\"60273\",\"Dipo After Tax in Pcs\":\"66300\",\"Dipo After Tax Round Up in Ctn\":\"66300\",\"Mitra Discount\":\"2\",\"Mitra Before Tax in Pcs\":\"1537\",\"Mitra Before Tax in Ctn\":\"61478\",\"Mitra After Tax in Pcs\":\"67626\",\"Mitra After Tax Round Up in Ctn\":\"67700\",\"Customer Discount\":\"4\",\"Customer Before Tax in Pcs\":\"1598\",\"Customer Before Tax in Ctn\":\"63937\",\"Customer After Tax in Pcs\":\"70331\",\"Customer After Tax Round Up in Ctn\":\"70400\",\"HET Round Up in Pcs\":\"1800\",\"HET Round Up in Ctn\":\"72000\"}', NULL, NULL, 'Add price list Garam Dapur DN 20gr succesfully by PT Kanaka', '2019-05-27 15:09:34', 'C', 11);

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
(2, 16, 'Category', 'category', 'icon-briefcase', 1, 'category', '1', NULL, '2019-05-12 21:50:22'),
(3, 1, 'Reports', 'reports', 'icon-notebook', 0, 'reports', '1', NULL, '2017-10-11 15:45:49'),
(4, 14, 'Menus', 'menu', NULL, 1, 'menus', '1', NULL, NULL),
(5, 13, 'Users', 'users/account', NULL, 1, 'users', '1', NULL, NULL),
(6, 15, 'Zona', 'zona', 'icon-clock', 1, 'zona', '1', '2017-10-11 17:02:05', '2019-05-15 22:06:39'),
(7, 7, 'Invoice', 'invoice', NULL, 3, 'invoice', '1', '2018-12-13 10:27:48', '2019-05-27 15:04:46'),
(8, 9, 'Product', 'product', NULL, 1, 'product', '1', '2019-04-28 20:19:00', '2019-04-28 20:19:00'),
(9, 10, 'DIPO', 'dipo', NULL, 1, 'dipo', '1', '2019-04-28 20:19:30', '2019-04-28 20:19:30'),
(10, 11, 'Partner', 'partner', NULL, 1, 'partner', '1', '2019-04-28 20:19:55', '2019-04-28 20:19:55'),
(11, 12, 'Vendor', 'vendor', NULL, 1, 'vendor', '1', '2019-04-28 20:20:13', '2019-05-18 14:09:02'),
(12, 11, 'Customer', 'customerreport', NULL, 3, 'customer', '0', '2019-04-28 20:21:08', '2019-05-27 16:25:25'),
(13, 8, 'Company', 'companyreport', NULL, 3, 'company', '1', '2019-04-28 20:21:29', '2019-04-28 20:21:29'),
(14, 9, 'DIPO Report', 'diporeport', NULL, 3, 'dipo_report', '0', '2019-04-28 20:22:00', '2019-05-27 16:24:56'),
(15, 10, 'Partner Report', 'partnerreport', NULL, 3, 'partner_report', '0', '2019-04-28 20:22:20', '2019-05-27 16:25:12'),
(16, 4, 'Admin', 'admin', 'icon-users', 0, 'admin', '1', '2019-04-28 20:22:36', '2019-04-28 20:22:36'),
(17, 3, 'Blog', 'blog', 'icon-feed', 0, 'blog', '1', '2019-04-28 20:22:47', '2019-04-28 20:22:47'),
(18, 4, 'Pricelist', 'pricelist', NULL, 3, 'pricelist', '1', '2019-05-19 09:36:15', '2019-05-19 09:42:18'),
(19, 5, 'Surat Pesanan', 'suratpesanan', NULL, 3, 'surat_pesanan', '1', '2019-05-25 12:31:22', '2019-05-25 12:33:28'),
(20, 6, 'Surat Jalan', 'suratjalan', NULL, 3, 'surat_jalan', '1', '2019-05-27 14:42:46', '2019-05-27 14:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `m_category`
--

CREATE TABLE `m_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(150) NOT NULL,
  `image` varchar(50) NOT NULL,
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
-- Dumping data for table `m_category`
--

INSERT INTO `m_category` (`id`, `name`, `description`, `image`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 'Beras', 'Makanan Pokok', 'Real_Estate.png', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-12', '23:31:11', 1, '2019-05-14', '22:31:08', 0, 0, '1901-01-01', '00:00:00'),
(2, 'Gula', 'Makanan', 'logo-template.png', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-12', '23:32:51', 0, '1901-01-01', '00:00:00', 1, 1, '2019-05-12', '23:37:08'),
(3, 'Gula', 'Makanan', 'logo-template.png', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-12', '23:38:43', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(4, 'Gas', 'Gas 3 Kg', 'Logo-Property.png', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-15', '22:37:59', 1, '2019-05-15', '22:42:00', 0, 0, '1901-01-01', '00:00:00'),
(5, 'Minyak Goreng', '', '', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:28:24', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(6, 'Garam', '', '', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:31:44', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(7, 'Popok', '', '', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:33:22', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_dipo_partner`
--

CREATE TABLE `m_dipo_partner` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `dipo_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `subdistrict` varchar(50) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `top` varchar(50) NOT NULL,
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
-- Dumping data for table `m_dipo_partner`
--

INSERT INTO `m_dipo_partner` (`id`, `type`, `dipo_id`, `code`, `name`, `address`, `phone`, `email`, `city`, `subdistrict`, `zona_id`, `latitude`, `longitude`, `pic`, `top`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 'dipo', 0, 'BGR', 'Bogor Store', 'Jalan Pajajaran No 10', '02518790654', 'dipobogor@kanaka.com', 'Bogor', 'Bogor Tengah', 1, '8098898999', '-889898989', 'Ahmad', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-04-29', '22:10:29', 1, '2019-05-14', '23:45:07', 0, 0, '1901-01-01', '00:00:00'),
(2, 'dipo', 0, 'BDG', 'Bandung Store', 'Jalan Asia Afrika No 19', '02318654259', 'dipobandungstore@kanaka.com', 'Bandung Barat', 'Ciwidey', 1, '87817283799', '-8738827319', 'Reza', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-04-30', '22:14:50', 1, '2019-05-27', '11:59:04', 0, 0, '1901-01-01', '00:00:00'),
(3, 'dipo', 0, 'JKT', 'Jakarta Store', 'Jalan Kemang 20', '0218765234', 'dipojakarta@kanaka.com', 'Jakarta Selatan', 'Pasar Minggu', 1, '87971923719', '-8978196237', 'Andi', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-01', '22:25:23', 1, '2019-05-14', '23:44:59', 0, 0, '1901-01-01', '00:00:00'),
(4, 'dipo', 0, 'SMR', 'Semarang Store', 'Jalan Diponegoro No 7', '02358618236', 'diposemarang@kanaka.com', 'Semarang', 'Semarang Utara', 1, '89815236576152', '-89123617623781', 'Seila', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-09', '05:25:51', 1, '2019-05-09', '05:26:07', 0, 0, '1901-01-01', '00:00:00'),
(5, 'dipo', 0, 'PDG', 'Padang Store', 'Jalan Ahmad Yani', '0256787120', 'dipopadang@kanaka.com', 'Padang', 'Sumatera Barat', 2, '87176156461589', '-81968571765176', 'Riki', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-14', '23:44:41', 1, '2019-05-16', '00:06:11', 0, 0, '1901-01-01', '00:00:00'),
(6, 'dipo', 0, 'LMP', 'Lampung Store', 'Jalan Sudirman', '02657687623', 'dipolampung@kanaka.com', 'Lampung', 'Bandar Lampung', 2, '8917236516', '-8186237152', 'Asep', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-16', '00:04:22', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(7, 'dipo', 0, 'PLB', 'Palembang Store', 'Jalan Ampera No 10', '02458123671', 'dipopalembang@kanaka.com', 'Palembang', 'Sumatera Selatan', 2, '887182367125', '-871623152271', 'Ujang', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-16', '00:13:44', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(8, 'partner', 10, 'M00001', 'MITRA Cimanggis', 'Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat', '085811275490', '', 'Depok', 'Cimanggis', 1, '897918623123', '-899891723812', 'Udin', '7', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-19', '09:55:44', 1, '2019-05-27', '14:19:05', 0, 0, '1901-01-01', '00:00:00'),
(9, 'dipo', 0, 'D00001', 'DIPO Tambun', 'Graha Melasti Baru Blok CA2/5A RT01 RW17, Ds. Sumber Jaya, Tambun Selatan, Bekasi 17510', '081385056419', '', 'Bekasi', 'Tambun Selatan', 1, '', '', ' Sukar ', ' 14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:00:35', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(10, 'dipo', 0, 'D00002', 'DIPO Depok', 'Gudang Raja Gas No. 43, Jl. Raya Kali Mulya, Kec. Cilodong, Kota Depok', '081282751539', '', 'Depok', 'Cilodong', 1, '', '', ' Purwanto', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:02:51', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(11, 'dipo', 0, 'D00003', 'DIPO Bandung', 'Jl. Gumuruh No. 76, Bandung, Jawa Barat', '08112003812', '', 'Bandung', 'Batununggal', 1, '', '', ' Aditya Nugraha', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:04:55', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(12, 'dipo', 0, 'D00004', 'Ragunan', 'Jalan Ragunan', '081288982238', '', 'Jakarta Selatan', 'Pasar Minggu', 1, '', '', ' Darwanto', '14', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:07:38', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

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

INSERT INTO `m_principle` (`id`, `code`, `name`, `address`, `product`, `brand`, `top`, `pic`, `phone_office`, `phone_personal`, `fax`, `email_office`, `email_personal`, `web`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 'P00001', 'PT. MITRAKARYA SUKSES NABATI', 'Jl. Pluit Selatan Raya No. 106-107, Jakarta 14450, Indonesia', 'Minyak Goreng', 'Promoo', '30', 'Darwanto', '02166603959', '081288982238', '0216678695', 'darwanto@mahakaryakapital.co.id', 'darwanto@gmail.com', '', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '13:40:47', 1, '2019-05-27', '10:59:05', 0, 0, '1901-01-01', '00:00:00'),
(2, 'P00002', 'PT. DSG SURYAMAS INDONESIA', 'Jl. Pacatama Raya Kav. 18, Desa Leuwilimus, Cikande, 42186, Serang', 'Diapers', 'Fitti', '30', 'Veronika ', '0215256316', '082227049365', '0215256357', 'veronika@dsgap.com', '', 'www.dsgil.com', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '13:54:42', 1, '2019-05-27', '10:58:49', 0, 0, '1901-01-01', '00:00:00'),
(3, 'P00003', 'PT. NADYNE GLOBAL NIAGA', 'Jl. Benda Raya No. 92, Kemang, Jakarta Selatan, DKI Jakarta', 'Diapers', 'Fitti', 'CBD', 'Chika ', '02178835337', '085710019305', '02178835350', 'info@nadyne.com', 'chika@nadyne.com', 'http://nadyne.com/', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '10:52:57', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(4, 'P00004', 'PT. ASIA PARAMITA INDAH', 'Jl. Perniagaan Barat No. 12,Jakarta Barat 11230, Indonesia', 'Pasta Gigi', 'Darlie', '30', ' Elvin Suryawijaya', '', '08978695780', '', '', 'elvin_suryawijaya@darlie.com', '', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '10:56:58', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(5, 'P00005', 'PT. SINARMAS DISTIRBUSI NUSANTARA', 'Jl. Rawa Girang No.3, Kawasan Industri Pulogadung, Jakarta Timur, 13930', 'Gula', 'Gulaku', 'CBD', ' Suprihatmo ', '0214602050', '08884103054', '', 'suprihatmo@sinarmas-distribusi.com', 'prie.hatmo@gmail.com', ' www.smart-plus.com', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '10:58:12', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

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
  `packing_size` varchar(50) NOT NULL,
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

INSERT INTO `m_product` (`id`, `name`, `category_id`, `product_code`, `view_total`, `description`, `feature`, `barcode_product`, `barcode_carton`, `packing_size`, `qty`, `length`, `width`, `height`, `volume`, `weight`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 'Minyak Goreng Promoo Pillow 800ml', 5, 'MGP00003', 0, '', '', '', '', '800ml x 12', 12, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '05:13:49', 1, '2019-05-27', '14:36:06', 0, 0, '1901-01-01', '00:00:00'),
(2, 'Minyak Goreng Promoo Pillow 200ml', 5, 'MGP00001', 0, '', '', '', '', '200ml x 48', 48, 4, 5, 6, 0, 0, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-18', '05:13:49', 1, '2019-05-27', '14:34:29', 0, 0, '1901-01-01', '00:00:00'),
(3, 'Minyak Goreng Promoo Pillow 400ml', 5, 'MGP00002', 0, '', '', '', '', '400ml x 24', 24, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:26:09', 1, '2019-05-27', '14:35:17', 0, 0, '1901-01-01', '00:00:00'),
(4, 'Minyak Goreng Promoo Pouch 1L', 5, 'MGP00004', 0, '', '', '', '', '1L x 12', 12, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:43:25', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(5, 'Minyak Goreng Promoo Pouch 2L', 5, 'MGP00005', 0, '', '', '', '', '2L x 6', 6, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:43:55', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(6, 'Minyak Goreng Promoo Jirigen 5L', 5, 'MGP00006', 0, '', '', '', '', '5L x 4', 4, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:44:20', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(7, 'Minyak Goreng Promoo Jirigen 19L', 5, 'MGP00007', 0, '', '', '', '', '19L x 1', 19, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:45:03', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(8, 'Minyak Goreng Promoo BIB 19L', 5, 'MGP00008', 0, '', '', '', '', '19L x 1', 19, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:45:30', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(9, 'Garam Dapur DN 20gr', 6, 'GRDN00001', 0, '', '', '', '', '20gr X 20', 40, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:46:02', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(10, 'FDP Bulk Pack Size M', 7, 'FBP00001', 0, '', '', '', '', '1 x 120', 120, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:46:28', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(11, 'FDP Bulk Pack Size L', 7, 'FBP00002', 0, '', '', '', '', '1 x 120', 120, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:46:51', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(12, 'FDP Bulk Pack Size XL', 7, 'FBP00003', 0, '', '', '', '', '1 x 120', 120, 0, 0, 0, 0, 0, 0, 0, '1901-01-01', '00:00:00', 0, '2019-05-27', '14:47:12', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_product_image`
--

CREATE TABLE `m_product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `image` varchar(30) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `m_zona`
--

CREATE TABLE `m_zona` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
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
-- Dumping data for table `m_zona`
--

INSERT INTO `m_zona` (`id`, `name`, `description`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 'Zona 1', 'Jakarta, Bogor, Bandung', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-15', '22:45:30', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(2, 'Zona 2', 'Padang, Lampung', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-15', '22:45:49', 1, '2019-05-15', '22:45:58', 0, 0, '1901-01-01', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `rowID` int(11) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `type1` varchar(25) DEFAULT NULL,
  `type2` varchar(25) DEFAULT NULL,
  `description` text DEFAULT NULL,
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
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`rowID`, `start_date`, `end_date`, `dep_id`, `type1`, `type2`, `description`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, '2017-09-01 17:03:42', '2017-09-04 17:04:17', 1, 'Order', 'Notification', '-', 1, '2016-11-25', '10:34:18', 1, '2016-11-25', '10:41:21', 1, 1, '2017-09-06', '17:32:37'),
(2, '2017-09-01 17:03:42', '2017-09-05 17:04:24', 2, 'General', 'Event', '-', 1, '2016-11-25', '10:41:06', 0, '1901-01-01', '00:00:00', 0, 0, '0000-00-00', '00:00:00'),
(3, '2017-09-01 17:03:42', '2017-09-05 17:04:33', 3, 'Order', 'Notification', '-', 1, '2016-11-25', '16:21:44', 1, '2016-11-25', '16:22:05', 0, 0, '1901-01-01', '00:00:00'),
(4, '2017-09-01 17:03:42', '2017-09-05 17:04:36', 4, 'Order', 'Event', '-', 1, '2017-09-04', '14:51:36', 1, '2017-09-04', '14:51:43', 1, 1, '2017-09-04', '14:51:50'),
(5, '2017-09-01 05:20:31', '2017-12-31 11:55:39', 7, 'General', 'Event', 'Asd', 1, '2017-09-06', '17:24:30', 1, '2017-09-06', '17:30:14', 0, 0, '1901-01-01', '00:00:00');

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
(9, 9, 'Sell In Company'),
(10, 10, 'Principle'),
(11, 11, 'Price List'),
(12, 12, 'Sell Out Company'),
(13, 13, 'Surat Pesanan'),
(14, 14, 'Surat Jalan'),
(15, 15, 'Invoice');

-- --------------------------------------------------------

--
-- Table structure for table `t_invoice`
--

CREATE TABLE `t_invoice` (
  `id` int(11) NOT NULL,
  `dipo_partner_id` int(11) NOT NULL,
  `invoice_no` varchar(25) NOT NULL,
  `sj_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `note` varchar(150) NOT NULL,
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
-- Dumping data for table `t_invoice`
--

INSERT INTO `t_invoice` (`id`, `dipo_partner_id`, `invoice_no`, `sj_id`, `due_date`, `note`, `total_niv`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 1, '017/KANAKA/INVC/V/2019', 1, '2019-06-08', 'Orderan Pertama', 36000000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-25', '07:00:00', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

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
  `dipo_discount` float NOT NULL,
  `dipo_before_tax_pcs` float NOT NULL,
  `dipo_before_tax_ctn` float NOT NULL,
  `dipo_after_tax_pcs` float NOT NULL,
  `dipo_after_tax_ctn` float NOT NULL,
  `dipo_after_tax_round_up` float NOT NULL,
  `mitra_discount` float NOT NULL,
  `mitra_before_tax_pcs` float NOT NULL,
  `mitra_before_tax_ctn` float NOT NULL,
  `mitra_after_tax_pcs` float NOT NULL,
  `mitra_after_tax_ctn` float NOT NULL,
  `mitra_after_tax_round_up` float NOT NULL,
  `customer_discount` float NOT NULL,
  `customer_before_tax_pcs` float NOT NULL,
  `customer_before_tax_ctn` float NOT NULL,
  `customer_after_tax_pcs` float NOT NULL,
  `customer_after_tax_ctn` float NOT NULL,
  `customer_after_tax_round_up` float NOT NULL,
  `het_round_up_pcs` float NOT NULL,
  `het_round_up_ctn` float NOT NULL,
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
-- Dumping data for table `t_pricelist`
--

INSERT INTO `t_pricelist` (`id`, `product_id`, `normal_price`, `company_before_tax_pcs`, `company_before_tax_ctn`, `company_after_tax_pcs`, `company_after_tax_ctn`, `stock_availibility`, `dipo_discount`, `dipo_before_tax_pcs`, `dipo_before_tax_ctn`, `dipo_after_tax_pcs`, `dipo_after_tax_ctn`, `dipo_after_tax_round_up`, `mitra_discount`, `mitra_before_tax_pcs`, `mitra_before_tax_ctn`, `mitra_after_tax_pcs`, `mitra_after_tax_ctn`, `mitra_after_tax_round_up`, `customer_discount`, `customer_before_tax_pcs`, `customer_before_tax_ctn`, `customer_after_tax_pcs`, `customer_after_tax_ctn`, `customer_after_tax_round_up`, `het_round_up_pcs`, `het_round_up_ctn`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 1, 138000, 10455, 125455, 11500, 138000, 1, 2, 10909, 130909, 12000, 144000, 144000, 2, 11364, 136364, 12500, 150000, 150000, 4, 11818, 141818, 13000, 156000, 156000, 13000, 156000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-23', '05:08:24', 0, '1901-01-01', '00:00:00', 1, 1, '2019-05-27', '14:53:27'),
(2, 1, 102500, 6705, 80455, 7375, 88500, 1, 2, 6839, 82064, 7523, 90270, 90300, 2, 6975, 83705, 7673, 92075, 92100, 4, 7254, 87053, 7980, 95758, 95800, 8000, 96000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-23', '05:08:24', 1, '2019-05-27', '14:58:34', 0, 0, '1901-01-01', '00:00:00'),
(3, 2, 106000, 1742, 83636, 1917, 92000, 0, 2, 1777, 85309, 1955, 93840, 93900, 2, 1813, 87015, 1994, 95717, 95800, 4, 1885, 90496, 2074, 99546, 99600, 2100, 100800, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:55:11', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(4, 3, 104500, 3409, 81818, 3750, 90000, 0, 2, 3477, 83455, 3825, 91800, 91800, 2, 3547, 85124, 3902, 93636, 93700, 4, 3689, 88529, 4058, 97381, 97400, 4100, 98400, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '14:57:00', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(5, 4, 128000, 8409, 100909, 9250, 111000, 1, 2, 8577, 102927, 9435, 113220, 113300, 2, 8749, 104986, 9624, 115484, 115500, 4, 9099, 109185, 10009, 120103, 120200, 10100, 121200, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '15:01:28', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(6, 5, 127000, 16667, 100000, 18333, 110000, 1, 2, 17000, 102000, 18700, 112200, 112200, 2, 17340, 104040, 19074, 114444, 114500, 4, 18034, 108202, 19837, 119022, 119100, 19900, 119400, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '15:03:25', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(7, 6, 221000, 45341, 181364, 49875, 199500, 0, 2, 46248, 184991, 50873, 203490, 203500, 2, 47173, 188691, 51890, 207560, 207600, 4, 49060, 196239, 53966, 215862, 215900, 54000, 216000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '15:05:00', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(8, 7, 203000, 8732, 165909, 9605, 182500, 0, 2, 8907, 169227, 9797, 186150, 186200, 2, 9085, 172612, 9993, 189873, 189900, 4, 9448, 179516, 10393, 197468, 197500, 10400, 197600, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '15:06:41', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(9, 8, 190000, 8062, 153182, 8868, 168500, 0, 2, 8223, 156245, 9046, 171870, 171900, 2, 8388, 159370, 9227, 175307, 175400, 4, 8723, 165745, 9596, 182319, 182400, 9600, 182400, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '15:08:14', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(10, 9, 70000, 1477, 59091, 1625, 65000, 0, 2, 1507, 60273, 1658, 66300, 66300, 2, 1537, 61478, 1691, 67626, 67700, 4, 1598, 63937, 1758, 70331, 70400, 1800, 72000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '15:09:34', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_sell_in_company`
--

CREATE TABLE `t_sell_in_company` (
  `id` int(11) NOT NULL,
  `po_date` date NOT NULL,
  `receive_date` date NOT NULL,
  `check_status` tinyint(1) NOT NULL,
  `monthly_period` tinyint(2) NOT NULL,
  `tax_status` tinyint(1) NOT NULL,
  `tax_no` varchar(50) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `principle_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `price_hna_per_ctn_before_tax` float NOT NULL,
  `price_hna_per_ctn_after_tax` float NOT NULL,
  `total_order_in_ctn` int(11) NOT NULL,
  `discount` int(3) NOT NULL,
  `discount_value` float NOT NULL,
  `ppn` float NOT NULL,
  `net_price_in_ctn_before_tax` float NOT NULL,
  `net_price_in_ctn_after_tax` float NOT NULL,
  `total_value_order_in_ctn_before_tax` float NOT NULL,
  `total_value_order_in_ctn_after_tax` float NOT NULL,
  `top` varchar(50) NOT NULL,
  `due_date_invoice` date NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `payment_value` float NOT NULL,
  `difference` float NOT NULL,
  `selling_price` float NOT NULL,
  `margin_percented` float NOT NULL,
  `margin_value` float NOT NULL,
  `remark` varchar(150) NOT NULL,
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
-- Dumping data for table `t_sell_in_company`
--

INSERT INTO `t_sell_in_company` (`id`, `po_date`, `receive_date`, `check_status`, `monthly_period`, `tax_status`, `tax_no`, `invoice_id`, `sp_id`, `principle_id`, `product_id`, `customer_id`, `price_hna_per_ctn_before_tax`, `price_hna_per_ctn_after_tax`, `total_order_in_ctn`, `discount`, `discount_value`, `ppn`, `net_price_in_ctn_before_tax`, `net_price_in_ctn_after_tax`, `total_value_order_in_ctn_before_tax`, `total_value_order_in_ctn_after_tax`, `top`, `due_date_invoice`, `payment_status`, `payment_value`, `difference`, `selling_price`, `margin_percented`, `margin_value`, `remark`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, '2019-05-26', '2019-05-26', 1, 5, 1, 'T12345', 1, 1, 1, 1, 3, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-05-25', 1, 34500000, 0, 144000, -238, 34356000, 'Test', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:13:23', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(2, '2019-05-26', '2019-05-26', 1, 5, 1, 'T12345', 1, 1, 1, 1, 1, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-05-25', 1, 34500000, 0, 144000, -238, 34356000, 'Test ', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:26:15', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(3, '2019-05-26', '2019-06-01', 0, 6, 0, 'T12346', 1, 1, 1, 1, 6, 125454, 138000, 200, 138000, 0, 12546, 125454, 138000, 25090800, 27600000, '14', '2019-05-31', 0, 0, 27600000, 144000, -190, 27456000, 'Test kedua', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:29:05', 0, '1901-01-01', '00:00:00', 1, 1, '2019-05-27', '00:53:49'),
(4, '2019-05-26', '2019-05-26', 0, 5, 0, 'T123478', 1, 1, 1, 1, 6, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-06-09', 0, 0, 34500000, 144000, -238, 34356000, 'Test ketiga Edit', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:32:51', 1, '2019-05-27', '01:05:42', 0, 0, '1901-01-01', '00:00:00'),
(5, '2019-05-26', '2019-05-26', 1, 5, 1, 'T123', 1, 1, 1, 1, 2, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-06-09', 1, 34500000, 0, 144000, -238, 34356000, 'Test', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:34:48', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(6, '2019-05-26', '2019-05-26', 1, 5, 1, 'T123', 1, 1, 1, 1, 2, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-06-09', 1, 34500000, 0, 144000, -238, 34356000, 'Test', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:36:18', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_sell_out_company`
--

CREATE TABLE `t_sell_out_company` (
  `id` int(11) NOT NULL,
  `receive_date` date NOT NULL,
  `monthly_period` tinyint(2) NOT NULL,
  `tax_status` tinyint(1) NOT NULL,
  `tax_no` varchar(50) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `price_hna_per_ctn_before_tax` float NOT NULL,
  `price_hna_per_ctn_after_tax` float NOT NULL,
  `total_order_in_ctn` int(11) NOT NULL,
  `discount` int(3) NOT NULL,
  `discount_value` float NOT NULL,
  `ppn` float NOT NULL,
  `net_price_in_ctn_before_tax` float NOT NULL,
  `net_price_in_ctn_after_tax` float NOT NULL,
  `total_value_order_in_ctn_before_tax` float NOT NULL,
  `total_value_order_in_ctn_after_tax` float NOT NULL,
  `top` varchar(50) NOT NULL,
  `due_date_invoice` date NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `payment_value` float NOT NULL,
  `difference` float NOT NULL,
  `remark` varchar(150) NOT NULL,
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
-- Dumping data for table `t_sell_out_company`
--

INSERT INTO `t_sell_out_company` (`id`, `receive_date`, `monthly_period`, `tax_status`, `tax_no`, `invoice_id`, `product_id`, `customer_id`, `price_hna_per_ctn_before_tax`, `price_hna_per_ctn_after_tax`, `total_order_in_ctn`, `discount`, `discount_value`, `ppn`, `net_price_in_ctn_before_tax`, `net_price_in_ctn_after_tax`, `total_value_order_in_ctn_before_tax`, `total_value_order_in_ctn_after_tax`, `top`, `due_date_invoice`, `payment_status`, `payment_value`, `difference`, `remark`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, '2019-05-26', 5, 1, 'T12345', 1, 1, 3, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-05-25', 1, 34500000, 0, 'Test', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:13:23', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(2, '2019-05-26', 5, 1, 'T12345', 1, 1, 1, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-05-25', 1, 34500000, 0, 'Test ', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:26:15', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(3, '2019-06-01', 6, 0, 'T12346', 1, 1, 6, 125454, 138000, 200, 138000, 0, 12546, 125454, 138000, 25090800, 27600000, '14', '2019-05-31', 0, 0, 27600000, 'Test kedua', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:29:05', 0, '1901-01-01', '00:00:00', 1, 1, '2019-05-27', '00:53:49'),
(4, '2019-05-26', 5, 0, 'T123478', 1, 1, 6, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-06-09', 0, 0, 34500000, 'Test ketiga Edit', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:32:51', 1, '2019-05-27', '01:05:42', 0, 0, '1901-01-01', '00:00:00'),
(5, '2019-05-26', 5, 1, 'T123', 1, 1, 2, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-06-09', 1, 34500000, 0, 'Test', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:34:48', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(6, '2019-05-26', 5, 1, 'T123', 1, 1, 2, 125454, 138000, 250, 138000, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-06-09', 1, 34500000, 0, 'Test', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-26', '23:36:18', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(7, '2019-05-27', 5, 1, 'Q1233', 1, 1, 6, 125454, 138000, 250, 0, 0, 12546, 125454, 138000, 31363500, 34500000, '14', '2019-06-10', 1, 20700000, 0, 'Test Out', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '03:59:51', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00'),
(8, '2019-05-27', 5, 0, 'U890', 1, 1, 6, 126363, 139000, 250, 0, 0, 12637, 126363, 139000, 31590800, 34750000, '14', '2019-06-10', 1, 34750000, 0, 'Test Out 2 Edit', 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-27', '05:03:33', 1, '2019-05-27', '05:04:05', 1, 1, '2019-05-27', '05:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `t_sj`
--

CREATE TABLE `t_sj` (
  `id` int(11) NOT NULL,
  `dipo_partner_id` int(11) NOT NULL,
  `sj_no` varchar(25) NOT NULL,
  `sp_id` int(11) NOT NULL,
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
-- Dumping data for table `t_sj`
--

INSERT INTO `t_sj` (`id`, `dipo_partner_id`, `sj_no`, `sp_id`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 1, '017/KANAKA/SJ/V/2019', 1, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-25', '07:00:00', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

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

INSERT INTO `t_sp` (`id`, `principle_id`, `sp_no`, `dipo_partner_id`, `sp_date`, `total_order_amount_in_ctn`, `total_order_price_before_tax`, `total_order_price_after_tax`, `total_order_amount_after_tax`, `total_niv`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 1, '017/KANAKA/SP/V/2019', 1, '2019-05-25', 0, 0, 0, 0, 34500000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-25', '07:00:00', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `t_sp_detail`
--

CREATE TABLE `t_sp_detail` (
  `id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `pricelist_id` int(11) NOT NULL,
  `order_amount_in_ctn` int(11) NOT NULL,
  `order_price_before_tax` float NOT NULL,
  `order_price_after_tax` float NOT NULL,
  `order_amount_after_tax` float NOT NULL,
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
-- Dumping data for table `t_sp_detail`
--

INSERT INTO `t_sp_detail` (`id`, `sp_id`, `pricelist_id`, `order_amount_in_ctn`, `order_price_before_tax`, `order_price_after_tax`, `order_amount_after_tax`, `printed`, `user_printed`, `date_printed`, `time_printed`, `user_created`, `date_created`, `time_created`, `user_modified`, `date_modified`, `time_modified`, `deleted`, `user_deleted`, `date_deleted`, `time_deleted`) VALUES
(1, 1, 1, 250, 125455, 13800, 34500000, 0, 0, '1901-01-01', '00:00:00', 1, '2019-05-25', '07:00:00', 0, '1901-01-01', '00:00:00', 0, 0, '1901-01-01', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `password_mobile` text NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `logged_in` enum('0','1') NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `password_mobile`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `full_name`, `company`, `phone`, `address`, `logged_in`, `group_id`, `city`, `country`, `avatar`, `created_date`) VALUES
(1, '127.0.0.1', 'admin', '$2y$08$9LW7MTZlxDHExxeL2RowqOzwj8HfP5t1Y6yGw.KH7Wdou1ddPV49G', '5f4dcc3b5aa765d61d8327deb882cf99', '', 'admin@kanaka.com', '', NULL, NULL, NULL, 1268889823, 1558947703, 1, 'Kanaka', 'Indonesia', 'PT Kanaka', 'PT Kanaka', '+62878987654321', 'Jalan Sudirman No 1', '0', 1, 'Jakarta Selatan', NULL, 'default_avatar.jpg', '2019-04-28 00:25:43'),
(2, '127.0.0.1', 'dipo_jatinegara', '$2y$08$yESv9EQ/YDTZxfxODayOp.4VgHHD8DshNLOVri.PjnWK2WkCAi7SG', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'dipo-jatinegara@kanaka.com', NULL, NULL, NULL, NULL, 0, 1556386731, 1, 'DIPO', 'Jatinegara', 'DIPO Jatinegara', 'PT Kanaka', '085123567123', 'Jalan Jatinegara 12', '0', 2, 'Jakarta Timur', NULL, 'default_avatar.jpg', '2019-04-28 00:25:43'),
(8, '127.0.0.1', 'mitra_beras_jatinegara', '$2y$08$cWRlP6Yswl35eoc7G49M8.nrWvZ4yBInAaj72W0pcVIch.W8Iwjui', '', NULL, 'mitra_beras_jatinegara@kanaka.com', NULL, NULL, NULL, NULL, 1556385943, 1556386951, 1, 'Mitra Beras', 'Jatinegara', 'Mitra Beras Jatinegara', 'PT Kanaka', '0212378176', 'Jalan Jatinegara 50', '0', 3, NULL, NULL, 'default_avatar.jpg', '2019-04-28 00:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_menu`
--

CREATE TABLE `users_menu` (
  `id_user_menu` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `Availabled` tinyint(4) NOT NULL DEFAULT 0,
  `Created` tinyint(1) NOT NULL DEFAULT 0,
  `Viewed` tinyint(4) NOT NULL DEFAULT 0,
  `Updated` tinyint(4) NOT NULL DEFAULT 0,
  `Deleted` tinyint(4) NOT NULL DEFAULT 0,
  `Approved` tinyint(4) NOT NULL,
  `Verified` tinyint(4) NOT NULL DEFAULT 0,
  `FullAccess` tinyint(4) NOT NULL DEFAULT 0,
  `PrintLimited` tinyint(4) NOT NULL DEFAULT 0,
  `PrintUnlimited` tinyint(4) NOT NULL DEFAULT 0,
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
(24, 1, 18, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1'),
(25, 1, 19, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_sessions`
--
ALTER TABLE `app_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_config`),
  ADD KEY `key_companyconfig` (`company_config`);

--
-- Indexes for table `company_old`
--
ALTER TABLE `company_old`
  ADD PRIMARY KEY (`company_config`),
  ADD KEY `key_companyconfig` (`company_config`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`config_key`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_logs`),
  ADD KEY `users_id` (`id_user`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `m_category`
--
ALTER TABLE `m_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `m_dipo_partner`
--
ALTER TABLE `m_dipo_partner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`) USING BTREE,
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `m_principle`
--
ALTER TABLE `m_principle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_product`
--
ALTER TABLE `m_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `m_product_image`
--
ALTER TABLE `m_product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `m_zona`
--
ALTER TABLE `m_zona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`rowID`,`user_created`),
  ADD KEY `rowID` (`rowID`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `reference_logs`
--
ALTER TABLE `reference_logs`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `t_invoice`
--
ALTER TABLE `t_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `t_pricelist`
--
ALTER TABLE `t_pricelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_sell_in_company`
--
ALTER TABLE `t_sell_in_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `t_sell_out_company`
--
ALTER TABLE `t_sell_out_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `t_sj`
--
ALTER TABLE `t_sj`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `t_sp`
--
ALTER TABLE `t_sp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `t_sp_detail`
--
ALTER TABLE `t_sp_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rowID` (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

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
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id_logs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `m_category`
--
ALTER TABLE `m_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_dipo_partner`
--
ALTER TABLE `m_dipo_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `m_principle`
--
ALTER TABLE `m_principle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_product`
--
ALTER TABLE `m_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `m_product_image`
--
ALTER TABLE `m_product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_zona`
--
ALTER TABLE `m_zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reference_logs`
--
ALTER TABLE `reference_logs`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_invoice`
--
ALTER TABLE `t_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_pricelist`
--
ALTER TABLE `t_pricelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_sell_in_company`
--
ALTER TABLE `t_sell_in_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_sell_out_company`
--
ALTER TABLE `t_sell_out_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_sj`
--
ALTER TABLE `t_sj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_sp`
--
ALTER TABLE `t_sp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_sp_detail`
--
ALTER TABLE `t_sp_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_menu`
--
ALTER TABLE `users_menu`
  MODIFY `id_user_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
