/*
 Navicat Premium Data Transfer

 Source Server         : PHPMyAdmin
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : db_kanaka

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 06/21/2019 11:11:06 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `m_principle`
-- ----------------------------
DROP TABLE IF EXISTS `m_principle`;
CREATE TABLE `m_principle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_office` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email_office` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `pic_operational` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `phone_personal` varchar(20) NOT NULL,
  `pic_finance` varchar(50) NOT NULL,
  `pic_finance_name` varchar(50) NOT NULL,
  `pic_finance_phone` varchar(20) NOT NULL,
  `taxable` tinyint(1) NOT NULL,
  `npwp` varchar(15) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tdp` varchar(20) NOT NULL,
  `siup` varchar(20) NOT NULL,
  `sppkp` varchar(20) NOT NULL,
  `tax_company_name` varchar(50) NOT NULL,
  `tax_company_address` varchar(50) NOT NULL,
  `tax_payment_method` varchar(15) NOT NULL,
  `top` varchar(5) NOT NULL,
  `tax_credit_ceiling` varchar(50) NOT NULL,
  `account_number` varchar(25) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_code` varchar(5) NOT NULL,
  `account_address` varchar(150) NOT NULL,
  `product` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `email_personal` varchar(50) NOT NULL,
  `web` varchar(50) NOT NULL,
  `reg_disc` float NOT NULL,
  `add_disc_1` float NOT NULL,
  `add_disc_2` float NOT NULL,
  `btw_disc` float NOT NULL,
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
  `time_deleted` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_principle`
-- ----------------------------
BEGIN;
INSERT INTO `m_principle` VALUES ('1', 'P00001', 'PT. MITRAKARYA SUKSES NABATI', '02166603959', '0216678695', 'darwanto@mahakaryakapital.co.id', 'Jl. Pluit Selatan Raya No. 106-107, Jakarta 14450, Indonesia', '', '', '', '', 'Darwanto', '081288982238', '', '', '', '0', '', '', '', '', '', '', '', '', '30', '', '', '', '', '', '', 'Minyak Goreng', 'Promoo', 'darwanto@gmail.com', '', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-18', '13:40:47', '1', '2019-05-27', '10:59:05', '0', '0', '1901-01-01', '00:00:00'), ('2', 'P00002', 'PT. DSG SURYAMAS INDONESIA', '0215256316', '0215256357', 'veronika@dsgap.com', 'Jl. Pacatama Raya Kav. 18, Desa Leuwilimus, Cikande, 42186, Serang', '', '', '', '', 'Veronika ', '082227049365', '', '', '', '0', '', '', '', '', '', '', '', '', '30', '', '', '', '', '', '', 'Diapers', 'Fitti', '', 'www.dsgil.com', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-18', '13:54:42', '1', '2019-05-27', '10:58:49', '0', '0', '1901-01-01', '00:00:00'), ('3', 'P00003', 'PT. NADYNE GLOBAL NIAGA', '02178835337', '02178835350', 'info@nadyne.com', 'Jl. Benda Raya No. 92, Kemang, Jakarta Selatan, DKI Jakarta', '', '', '', '', 'Chika ', '085710019305', '', '', '', '0', '', '', '', '', '', '', '', '', 'CBD', '', '', '', '', '', '', 'Diapers', 'Fitti', 'chika@nadyne.com', 'http://nadyne.com/', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-27', '10:52:57', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('4', 'P00004', 'PT. ASIA PARAMITA INDAH', '', '', '', 'Jl. Perniagaan Barat No. 12,Jakarta Barat 11230, Indonesia', '', '', '', '', ' Elvin Suryawijaya', '08978695780', '', '', '', '0', '', '', '', '', '', '', '', '', '30', '', '', '', '', '', '', 'Pasta Gigi', 'Darlie', 'elvin_suryawijaya@darlie.com', '', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-27', '10:56:58', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('5', 'P00005', 'PT. SINARMAS DISTIRBUSI NUSANTARA', '0214602050', '', 'suprihatmo@sinarmas-distribusi.com', 'Jl. Rawa Girang No.3, Kawasan Industri Pulogadung, Jakarta Timur, 13930', '', '', '', '', ' Suprihatmo ', '08884103054', '', '', '', '0', '', '', '', '', '', '', '', '', 'CBD', '', '', '', '', '', '', 'Gula', 'Gulaku', 'prie.hatmo@gmail.com', ' www.smart-plus.com', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-27', '10:58:12', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('6', 'P130660', 'PT Pangestu Group', '087874089410', '0213545236', 'admin@pangestugroup.com', 'Cilebut', '16165', '8767414523149', '-877152345142', 'Admin', 'Ahmad', '0878676154', 'Finance', 'Aulia', '08123457652', '1', '004909971263912', 'PT Pangestu Group Indonesia', '0012376175253162', '0023567415623674', '0037564123674127', 'PT Pangestu Group Indonesia, LTD', 'Ampera Road', 'cash', '30', 'Ceiling A', '5546712345', 'Pangestu Group Indonesia', 'Mandiri', '008', 'Ampera', '', '', '', '', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2019-06-21', '10:59:57', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
