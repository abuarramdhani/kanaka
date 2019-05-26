/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-27 05:13:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_pricelist
-- ----------------------------
DROP TABLE IF EXISTS `t_pricelist`;
CREATE TABLE `t_pricelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `normal_price` float NOT NULL,
  `company_before_tax_pcs` float NOT NULL,
  `company_before_tax_ctn` float NOT NULL,
  `company_after_tax_pcs` float NOT NULL,
  `company_after_tax_ctn` float NOT NULL,
  `stock_availibility` tinyint(4) NOT NULL,
  `dipo_discount` float NOT NULL,
  `dipo_before_tax_pcs` float NOT NULL,
  `dipo_before_tax_ctn` float NOT NULL,
  `dipo_after_tax_pcs` float NOT NULL,
  `dipo_after_tax_ctn` float NOT NULL,
  `dipo_after_tax_round_up` float NOT NULL,
  `mitra_discount` float NOT NULL,
  `mitra_before_tax_pcs` float NOT NULL,
  `mitra_before_tax_ctn` float NOT NULL,
  `mitra_after_tax_pcs` float NOT NULL,
  `mitra_after_tax_ctn` float NOT NULL,
  `mitra_after_tax_round_up` float NOT NULL,
  `customer_discount` float NOT NULL,
  `customer_before_tax_pcs` float NOT NULL,
  `customer_before_tax_ctn` float NOT NULL,
  `customer_after_tax_pcs` float NOT NULL,
  `customer_after_tax_ctn` float NOT NULL,
  `customer_after_tax_round_up` float NOT NULL,
  `het_round_up_pcs` float NOT NULL,
  `het_round_up_ctn` float NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_pricelist
-- ----------------------------
INSERT INTO `t_pricelist` VALUES ('1', '1', '138000', '10455', '125455', '11500', '138000', '1', '2', '10909', '130909', '12000', '144000', '144000', '2', '11364', '136364', '12500', '150000', '150000', '4', '11818', '141818', '13000', '156000', '156000', '13000', '156000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-23', '05:08:24', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
INSERT INTO `t_pricelist` VALUES ('2', '1', '139000', '10455', '125455', '11500', '139000', '1', '2', '10909', '130909', '12000', '144000', '145000', '2', '11364', '136364', '12500', '150000', '150000', '4', '11818', '141818', '13000', '156000', '156000', '13000', '156000', '0', '0', '1901-01-01', '00:00:00', '1', '2019-05-23', '05:08:24', '0', '1901-01-01', '00:00:00', '0', '0', '1901-01-01', '00:00:00');
