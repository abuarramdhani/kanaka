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

 Date: 06/26/2019 11:39:36 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `reference_logs`
-- ----------------------------
DROP TABLE IF EXISTS `reference_logs`;
CREATE TABLE `reference_logs` (
  `rowID` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL,
  PRIMARY KEY (`rowID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `reference_logs`
-- ----------------------------
BEGIN;
INSERT INTO `reference_logs` VALUES ('1', '1', 'Menu'), ('2', '2', 'User'), ('3', '3', 'User Menus'), ('4', '4', 'Product'), ('5', '5', 'Category'), ('6', '6', 'DIPO'), ('7', '7', 'Partner'), ('8', '8', 'Zona'), ('9', '9', 'Sell In Company'), ('10', '10', 'Principle'), ('11', '11', 'Price List'), ('12', '12', 'Sell Out Company'), ('13', '13', 'Surat Pesanan'), ('14', '14', 'Surat Jalan'), ('15', '15', 'Invoice'), ('16', '16', 'Chart Of Accounts'), ('17', '17', 'Jurnal');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
