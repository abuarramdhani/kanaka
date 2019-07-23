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

 Date: 06/26/2019 15:02:40 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `t_jurnal`
-- ----------------------------
DROP TABLE IF EXISTS `t_jurnal`;
CREATE TABLE `t_jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coa_id` int(11) NOT NULL,
  `jurnal_date` date NOT NULL,
  `month` varchar(20) NOT NULL,
  `reff_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `d_k` varchar(5) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `total` float NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `t_jurnal`
-- ----------------------------
BEGIN;
INSERT INTO `t_jurnal` VALUES ('1', '4', '2019-06-25', 'June', '0', 'Penjualan SO', 'D', '', '380000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '16:41:11', '1', '2019-06-25', '17:04:54', '0', '0', '1901-01-01', '00:00:00'), ('2', '4', '2019-06-25', 'June', '0', 'Penjualan SO', 'D', '', '120000', '0', '0', '1901-01-01', '00:00:00', '2', '2019-06-25', '16:43:45', '1', '2019-06-25', '17:05:00', '0', '0', '1901-01-01', '00:00:00'), ('3', '4', '2019-06-21', 'June', '0', 'Penjualan', 'D', '', '500000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '17:07:04', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('4', '2', '2019-06-26', 'June', '0', 'Sell In', 'K', '', '20700000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-26', '13:44:36', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('5', '4', '2019-06-26', 'June', '0', 'Sell Out', 'D', '', '20850000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-26', '13:49:22', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('6', '2', '2019-06-26', 'June', '13', '020/KANAKA/INVC/V/2019', 'K', '', '34750000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-26', '13:55:50', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('7', '4', '2019-06-26', 'June', '11', '020/KANAKA/INVC/V/2019', 'D', '', '27800000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-26', '13:56:54', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('8', '2', '2019-06-26', 'June', '14', '020/KANAKA/INVC/V/2019', 'K', '', '34750000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-26', '13:59:06', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('9', '4', '2019-06-26', 'June', '12', '020/KANAKA/INVC/V/2019', 'D', '', '20850000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-26', '14:00:44', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00'), ('10', '2', '2019-06-26', 'June', '15', '020/KANAKA/INVC/V/2019', 'K', '', '20850000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-26', '14:31:06', '0', '1901-01-01', '00:00:00', '1', '1', '2019-06-26', '14:58:03'), ('11', '4', '2019-06-26', 'June', '13', '020/KANAKA/INVC/V/2019', 'D', '', '27800000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-26', '14:32:19', '0', '1901-01-01', '00:00:00', '1', '1', '2019-06-26', '14:59:32');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
