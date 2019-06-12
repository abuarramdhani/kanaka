/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-06-12 23:00:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_chart_of_accounts
-- ----------------------------
DROP TABLE IF EXISTS `m_chart_of_accounts`;
CREATE TABLE `m_chart_of_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_chart_of_accounts
-- ----------------------------
INSERT INTO `m_chart_of_accounts` VALUES ('1', '1001', 'Modal Kerja (In)', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('2', '1002', 'Modal Kerja (Out)', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('3', '2001', 'Pembayaran (Principle)', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('4', '2002', 'Pembayaran (Customer)', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('5', '3001', 'Retur (Principle)', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('6', '3002', 'Retur (Customer)', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('7', '4001', 'Freight Cost', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('8', '5001', 'POSM', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('9', '6001', 'Gaji', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('10', '7001', 'Operational', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('11', '8001', 'Other', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('12', '9001', 'Bunga Bank (Pinjaman)', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('13', '1101', 'ATK', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('14', '1201', 'Sample', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('15', '1301', 'Pajak', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_chart_of_accounts` VALUES ('16', '1401', 'Potongan Pembelian', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '23:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
