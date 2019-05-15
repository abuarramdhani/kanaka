/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-15 23:01:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_zona
-- ----------------------------
DROP TABLE IF EXISTS `m_zona`;
CREATE TABLE `m_zona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
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
-- Records of m_zona
-- ----------------------------
INSERT INTO `m_zona` VALUES ('1', 'Zona 1', 'Jakarta, Bogor, Bandung', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-15', '22:45:30', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_zona` VALUES ('2', 'Zona 2', 'Padang, Lampung', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-15', '22:45:49', '1', '2019-05-15', '22:45:58', '0', '0', '1901-01-01', '00:00:00');
