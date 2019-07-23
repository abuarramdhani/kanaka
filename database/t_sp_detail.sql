/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-06-12 02:43:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_sp_detail
-- ----------------------------
DROP TABLE IF EXISTS `t_sp_detail`;
CREATE TABLE `t_sp_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_id` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_sp_detail
-- ----------------------------
INSERT INTO `t_sp_detail` VALUES ('1', '1', '2', '250', '125455', '13800', '34500000', '0', '0', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-25', '07:00:00', '1', '2019-06-12', '01:16:05', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `t_sp_detail` VALUES ('8', '12', '11', '250', '125455', '138000', '34500000', '4.67', '48.84', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '0', '2019-06-11', '23:31:43', '1', '2019-06-12', '01:16:45', '0', '0', '1901-01-01', '00:00:00');
