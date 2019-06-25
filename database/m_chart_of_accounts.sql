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

 Date: 06/25/2019 12:01:00 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `m_chart_of_accounts`
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_chart_of_accounts`
-- ----------------------------
BEGIN;
INSERT INTO `m_chart_of_accounts` VALUES ('1', '3001', 'Modal', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '12:00:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('2', '5001', 'Pembelian', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '12:00:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('3', '5002', 'Refund Pembelian', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '12:00:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('4', '4001', 'Penjualan', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '12:00:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('5', '4002', 'Refund Penjualan', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '12:00:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('6', '5004', 'Delivery', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '12:00:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('7', '5003', 'Beban', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '12:00:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('8', '1002', 'Piutang', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '12:00:01', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
