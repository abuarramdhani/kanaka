/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-19 08:39:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_dipo_partner
-- ----------------------------
DROP TABLE IF EXISTS `m_dipo_partner`;
CREATE TABLE `m_dipo_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of m_dipo_partner
-- ----------------------------
INSERT INTO `m_dipo_partner` VALUES ('1', 'dipo', '0', 'BGR', 'Bogor Store', 'Jalan Pajajaran No 10', '02518790654', 'dipobogor@kanaka.com', 'Bogor', 'Bogor Tengah', '1', '8098898999', '-889898989', 'Ahmad', '14', '0', '0', '1901-01-01', '00:00:00', '1', '2019-04-29', '22:10:29', '1', '2019-05-14', '23:45:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo_partner` VALUES ('2', 'dipo', '0', 'BDG', 'Bandung Store', 'Jalan Asia Afrika No 19', '02318654259', 'dipobandungstore@kanaka.com', 'Bandung Barat', 'Ciwidey', '1', '87817283799', '-8738827319', 'Reza', '14', '0', '0', '1901-01-01', '00:00:00', '1', '2019-04-30', '22:14:50', '1', '2019-05-19', '08:38:56', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo_partner` VALUES ('3', 'dipo', '0', 'JKT', 'Jakarta Store', 'Jalan Kemang 20', '0218765234', 'dipojakarta@kanaka.com', 'Jakarta Selatan', 'Pasar Minggu', '1', '87971923719', '-8978196237', 'Andi', '14', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-01', '22:25:23', '1', '2019-05-14', '23:44:59', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo_partner` VALUES ('4', 'dipo', '0', 'SMR', 'Semarang Store', 'Jalan Diponegoro No 7', '02358618236', 'diposemarang@kanaka.com', 'Semarang', 'Semarang Utara', '1', '89815236576152', '-89123617623781', 'Seila', '14', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-09', '05:25:51', '1', '2019-05-09', '05:26:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo_partner` VALUES ('5', 'dipo', '0', 'PDG', 'Padang Store', 'Jalan Ahmad Yani', '0256787120', 'dipopadang@kanaka.com', 'Padang', 'Sumatera Barat', '2', '87176156461589', '-81968571765176', 'Riki', '7', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-14', '23:44:41', '1', '2019-05-16', '00:06:11', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo_partner` VALUES ('6', 'dipo', '0', 'LMP', 'Lampung Store', 'Jalan Sudirman', '02657687623', 'dipolampung@kanaka.com', 'Lampung', 'Bandar Lampung', '2', '8917236516', '-8186237152', 'Asep', '14', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-16', '00:04:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo_partner` VALUES ('7', 'dipo', '0', 'PLB', 'Palembang Store', 'Jalan Ampera No 10', '02458123671', 'dipopalembang@kanaka.com', 'Palembang', 'Sumatera Selatan', '2', '887182367125', '-871623152271', 'Ujang', '14', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-16', '00:13:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
