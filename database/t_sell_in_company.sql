/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-25 08:07:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_sell_in_company
-- ----------------------------
DROP TABLE IF EXISTS `t_sell_in_company`;
CREATE TABLE `t_sell_in_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_date` date NOT NULL,
  `receive_date` date NOT NULL,
  `check_status` tinyint(1) NOT NULL,
  `monthly_period` tinyint(2) NOT NULL,
  `tax_status` tinyint(1) NOT NULL,
  `tax_no` varchar(50) NOT NULL,
  `invoice_number_distributor` varchar(50) NOT NULL,
  `sp_no` varchar(50) NOT NULL,
  `sp_id` varchar(3) NOT NULL,
  `principle_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price_hna_per_ctn_before_tax` float NOT NULL,
  `price_hna_per_ctn_after_tax` float NOT NULL,
  `total_order_in_ctn` int(11) NOT NULL,
  `discount` int(3) NOT NULL,
  `discount_value` float NOT NULL,
  `ppn` float NOT NULL,
  `net_price_in_ctn_before_tax` float NOT NULL,
  `net_price_in_ctn_after_tax` float NOT NULL,
  `total_value_order_in_ctn_before_tax` float NOT NULL,
  `total_value_order_in_ctn_after_tax` float NOT NULL,
  `top` varchar(50) NOT NULL,
  `due_date_invoice` date NOT NULL,
  `aging_invoice` int(11) NOT NULL,
  `due_date_ar` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `payment_value` float NOT NULL,
  `difference` float NOT NULL,
  `selling_price` float NOT NULL,
  `margin_percented` float NOT NULL,
  `margin_value` float NOT NULL,
  `customer_id` int(11) NOT NULL,
  `margin_contibution` float NOT NULL,
  `remark` varchar(150) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_sell_in_company
-- ----------------------------
