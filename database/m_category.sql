/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-14 06:13:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_category
-- ----------------------------
DROP TABLE IF EXISTS `m_category`;
CREATE TABLE `m_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(150) NOT NULL,
  `image` varchar(50) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_category
-- ----------------------------
INSERT INTO `m_category` VALUES ('1', 'Beras', 'Makanan', 'Real_Estate.png', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-12', '23:31:11', '1', '2019-05-14', '05:39:15', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_category` VALUES ('2', 'Gula', 'Makanan', 'logo-template.png', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-12', '23:32:51', '0', '1901-01-01', '00:00:00', '1', '1', '2019-05-12', '23:37:08');
INSERT INTO `m_category` VALUES ('3', 'Gula', 'Makanan', 'logo-template.png', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-12', '23:38:43', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
