/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-07-01 07:40:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_sell_out_company_detail
-- ----------------------------
DROP TABLE IF EXISTS `t_sell_out_company_detail`;
CREATE TABLE `t_sell_out_company_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sell_out_id` int(11) NOT NULL,
  `amount` double NOT NULL,
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
