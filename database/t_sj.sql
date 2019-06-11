/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-06-12 02:43:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_sj
-- ----------------------------
DROP TABLE IF EXISTS `t_sj`;
CREATE TABLE `t_sj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sj_no` varchar(25) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `total_order_amount_in_ctn` int(11) NOT NULL,
  `total_order_volume` float NOT NULL,
  `total_order_weight` float NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_sj
-- ----------------------------
INSERT INTO `t_sj` VALUES ('1', '017/KANAKA/SJ/V/2019', '1', '0', '0', '0', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-25', '07:00:00', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `t_sj` VALUES ('2', '018/KANAKA/SJ/V/2019', '12', '250', '4.67', '48.84', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '00:15:29', '1', '2019-06-12', '01:10:34', '1', '1', '2019-06-12', '01:15:23');
INSERT INTO `t_sj` VALUES ('3', '019/KANAKA/SJ/V/2019', '12', '250', '4.67', '48.84', '0', '0', '1901-01-01', '00:00:00', '1', '2019-06-12', '01:09:15', '1', '2019-06-12', '01:16:45', '0', '0', '1901-01-01', '00:00:00');
