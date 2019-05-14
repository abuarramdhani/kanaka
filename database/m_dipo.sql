/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-14 23:51:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_dipo
-- ----------------------------
DROP TABLE IF EXISTS `m_dipo`;
CREATE TABLE `m_dipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `subdistrict` varchar(50) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
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
  KEY `rowID` (`id`),
  KEY `deleted` (`deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of m_dipo
-- ----------------------------
INSERT INTO `m_dipo` VALUES ('1', 'BGR', 'Bogor Store', 'Jalan Pajajaran No 10', '02518790654', 'dipobogor@kanaka.com', 'Bogor', 'Bogor Tengah', '8098898999', '-889898989', '0', '0', '1901-01-01', '00:00:00', '1', '2019-04-29', '22:10:29', '1', '2019-05-14', '23:45:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo` VALUES ('2', 'BDG', 'Bandung Store', 'Jalan Asia Afrika No 19', '02318654259', 'dipobandungstore@kanaka.com', 'Bandung Barat', 'Ciwidey', '87817283799', '-8738827319', '0', '0', '1901-01-01', '00:00:00', '1', '2019-04-30', '22:14:50', '1', '2019-05-01', '23:04:32', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo` VALUES ('3', 'JKT', 'Jakarta Store', 'Jalan Kemang 20', '0218765234', 'dipojakarta@kanaka.com', 'Jakarta Selatan', 'Pasar Minggu', '87971923719', '-8978196237', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-01', '22:25:23', '1', '2019-05-14', '23:44:59', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo` VALUES ('4', 'SMR', 'Semarang Store', 'Jalan Diponegoro No 7', '02358618236', 'diposemarang@kanaka.com', 'Semarang', 'Semarang Utara', '89815236576152', '-89123617623781', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-09', '05:25:51', '1', '2019-05-09', '05:26:07', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_dipo` VALUES ('5', 'SRB', 'Surabaya Store', 'Jalan Bung Tomo', '0236787129', 'diposurabaya@kanaka.com', 'Surabaya', 'Surabaya Barat', '871761564615', '-819685717651', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-14', '23:44:41', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
