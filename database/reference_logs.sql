/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-12 23:42:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for reference_logs
-- ----------------------------
DROP TABLE IF EXISTS `reference_logs`;
CREATE TABLE `reference_logs` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of reference_logs
-- ----------------------------
INSERT INTO `reference_logs` VALUES ('1', '1', 'Menu');
INSERT INTO `reference_logs` VALUES ('2', '2', 'User');
INSERT INTO `reference_logs` VALUES ('3', '3', 'User Menus');
INSERT INTO `reference_logs` VALUES ('4', '4', 'Product');
INSERT INTO `reference_logs` VALUES ('5', '5', 'Category');
INSERT INTO `reference_logs` VALUES ('6', '6', 'DIPO');
INSERT INTO `reference_logs` VALUES ('7', '7', 'Partner');
INSERT INTO `reference_logs` VALUES ('8', '8', '-');
INSERT INTO `reference_logs` VALUES ('9', '9', '-');
