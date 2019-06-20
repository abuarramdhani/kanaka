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

 Date: 06/20/2019 14:46:47 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `m_dipo_partner`
-- ----------------------------
DROP TABLE IF EXISTS `m_dipo_partner`;
CREATE TABLE `m_dipo_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `dipo_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `billing_address` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `subdistrict` varchar(50) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `top` varchar(50) NOT NULL,
  `purchase_price_type` varchar(15) NOT NULL,
  `taxable` tinyint(1) NOT NULL,
  `npwp` varchar(15) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_invoice_address` varchar(150) NOT NULL,
  `tax_payment_method` varchar(15) NOT NULL,
  `tax_payment_time` varchar(10) NOT NULL,
  `tax_credit_ceiling` varchar(50) NOT NULL,
  `account_number` varchar(25) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_code` varchar(3) NOT NULL,
  `account_address` varchar(150) NOT NULL,
  `customer_photo` varchar(25) NOT NULL,
  `house_photo` varchar(25) NOT NULL,
  `warehouse_photo` varchar(25) NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `rowID` (`id`) USING BTREE,
  KEY `deleted` (`deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `m_dipo_partner`
-- ----------------------------
BEGIN;
INSERT INTO `m_dipo_partner` VALUES ('1', 'dipo', '0', 'BGR', 'Bogor Store', '02518790654', '', 'dipobogor@kanaka.com', 'Jalan Pajajaran No 10', '', 'Bogor', 'Bogor Tengah', '', '1', '8098898999', '-889898989', 'Ahmad', '14', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2019-04-29', '22:10:29', '1', '2019-05-14', '23:45:07', '0', '0', '1901-01-01', '00:00:00'), ('2', 'dipo', '0', 'BDG', 'Bandung Store', '02318654259', '', 'dipobandungstore@kanaka.com', 'Jalan Asia Afrika No 19', '', 'Bandung Barat', 'Ciwidey', '', '1', '87817283799', '-8738827319', 'Reza', '14', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2019-04-30', '22:14:50', '1', '2019-05-27', '11:59:04', '0', '0', '1901-01-01', '00:00:00'), ('3', 'dipo', '0', 'JKT', 'Jakarta Store', '0218765234', '', 'dipojakarta@kanaka.com', 'Jalan Kemang 20', '', 'Jakarta Selatan', 'Pasar Minggu', '', '1', '87971923719', '-8978196237', 'Andi', '14', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-01', '22:25:23', '1', '2019-05-14', '23:44:59', '0', '0', '1901-01-01', '00:00:00'), ('4', 'dipo', '0', 'SMR', 'Semarang Store', '02358618236', '', 'diposemarang@kanaka.com', 'Jalan Diponegoro No 7', '', 'Semarang', 'Semarang Utara', '', '1', '89815236576152', '-89123617623781', 'Seila', '14', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-09', '05:25:51', '1', '2019-05-09', '05:26:07', '0', '0', '1901-01-01', '00:00:00'), ('5', 'dipo', '0', 'PDG', 'Padang Store', '0256787120', '', 'dipopadang@kanaka.com', 'Jalan Ahmad Yani', '', 'Padang', 'Sumatera Barat', '', '2', '87176156461589', '-81968571765176', 'Riki', '14', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-14', '23:44:41', '1', '2019-05-16', '00:06:11', '0', '0', '1901-01-01', '00:00:00'), ('6', 'dipo', '0', 'LMP', 'Lampung Store', '02657687623', '', 'dipolampung@kanaka.com', 'Jalan Sudirman', '', 'Lampung', 'Bandar Lampung', '', '2', '8917236516', '-8186237152', 'Asep', '14', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-16', '00:04:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('7', 'dipo', '0', 'PLB', 'Palembang Store', '02458123671', '', 'dipopalembang@kanaka.com', 'Jalan Ampera No 10', '', 'Palembang', 'Sumatera Selatan', '', '2', '887182367125', '-871623152271', 'Ujang', '14', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-16', '00:13:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('8', 'partner', '3', 'M00001', 'MITRA Cimanggis', '085811275490', '', 'mitracimanggis@kanaka.com', 'Jl. Bungur No. 28, Cimanggis, Depok, Jawa Barat', '', 'Depok', 'Cimanggis', '', '1', '897918623123', '-899891723812', 'Asep', '7', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-19', '09:55:44', '1', '2019-05-19', '09:59:33', '0', '0', '1901-01-01', '00:00:00'), ('9', 'dipo', '0', 'D558175', 'Palembang Store', '087865431234', '0234516728', 'dipopalembang@kanakasn.com', 'Sudirman Road', 'Sudirman Road', 'Palembang', '', '76512', '0', '81236167243', '-8812317265', '', '', 'dipo', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '2019-06-20', '14:21:29', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('10', 'dipo', '0', 'D561625', 'Aceh Store', '085671826397', '02538767123', 'dipo@kanakasn.com', 'Jalan Raya Aceh', 'Jalan Raya Aceh No 1', 'Banda Aceh', '', '45412', '0', '8182536142', '-818253715', '', '', 'dipo', '1', '009123515123001', 'Kanaka Aceh', 'Jalan Raya Aceh Blok A No 1', 'cash', 'cod', 'Test', '54316233123', 'Kanaka Cabang Palembang', 'Mandiri', '008', 'Jalan Fatmawati', '', '', '', '0', '0', '1901-01-01', '00:00:00', '0', '2019-06-20', '14:35:36', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('11', 'partner', '0', 'M256508', 'Mitra Minyak Goreng Pasar Minggu', '0812564231654', '02168551256', '', 'Jatipadang Road', 'Jatipadang Road', 'Jakarta Selatan', '', '12345', '0', '', '', '', '', 'partner', '1', '', '', '', '', '', '', '', '', '', '', '', '2019062014433452.png', '2019062014433493.png', '2019062014433419.png', '0', '0', '1901-01-01', '00:00:00', '0', '2019-06-20', '14:43:34', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
