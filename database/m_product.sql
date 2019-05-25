/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-25 08:08:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_product
-- ----------------------------
DROP TABLE IF EXISTS `m_product`;
CREATE TABLE `m_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `category_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `view_total` int(11) NOT NULL,
  `description` text NOT NULL,
  `feature` text NOT NULL,
  `barcode_product` varchar(50) DEFAULT NULL,
  `barcode_carton` varchar(50) DEFAULT NULL,
  `packing_size` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `length` float NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `volume` float NOT NULL,
  `weight` float NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_product
-- ----------------------------
INSERT INTO `m_product` VALUES ('1', 'BiorF Ultra 825ml\r\n', '1', 'SB00001\r\n', '0', '', '', '', '', '1 x 12\r\n', '12', '29', '23', '28', '0.02', '10.46', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-18', '05:13:49', '1', '2019-05-18', '05:49:28', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `m_product` VALUES ('2', 'Minyak Goreng Promoo Pillow 200ml', '1', 'MP00001', '0', '', '', '', '', '200ml x 48', '48', '4', '5', '6', '1.2', '0', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-18', '05:13:49', '1', '2019-05-18', '05:49:28', '0', '0', '1901-01-01', '00:00:00');
