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

 Date: 06/25/2019 12:00:50 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `t_sp_detail`
-- ----------------------------
DROP TABLE IF EXISTS `t_sp_detail`;
CREATE TABLE `t_sp_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pricelist_id` int(11) NOT NULL,
  `order_amount_in_ctn` int(11) NOT NULL,
  `order_price_before_tax` float NOT NULL,
  `order_price_after_tax` float NOT NULL,
  `order_amount_after_tax` float NOT NULL,
  `order_volume` float NOT NULL,
  `order_weight` float NOT NULL,
  `order_price_dipo_before_tax` float NOT NULL,
  `order_price_dipo_after_tax` float NOT NULL,
  `order_amount_dipo_after_tax` float NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `t_sp_detail`
-- ----------------------------
BEGIN;
INSERT INTO `t_sp_detail` VALUES ('1', '13', '1', '2', '150', '125455', '139000', '0', '0', '0', '130909', '144000', '21600000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-25', '11:28:01', '1', '2019-06-25', '11:53:35', '0', '0', '1901-01-01', '00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
