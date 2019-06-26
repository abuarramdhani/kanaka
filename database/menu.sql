/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-06-26 23:20:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_code` int(11) NOT NULL,
  `menu_name` char(50) NOT NULL,
  `menu_link` char(50) NOT NULL,
  `menu_icon` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `parent_menu_id` int(11) NOT NULL,
  `lang` char(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '2', 'Master', 'master', 'icon-grid', '0', 'master', '1', '2019-04-25 01:16:17', '2019-04-27 23:54:40');
INSERT INTO `menu` VALUES ('2', '16', 'Category', 'category', 'icon-briefcase', '1', 'category', '1', null, '2019-05-12 21:50:22');
INSERT INTO `menu` VALUES ('3', '1', 'Reports', 'reports', 'icon-notebook', '0', 'reports', '1', null, '2017-10-11 15:45:49');
INSERT INTO `menu` VALUES ('4', '14', 'Menus', 'menu', null, '1', 'menus', '1', null, null);
INSERT INTO `menu` VALUES ('5', '13', 'Users', 'users/account', null, '1', 'users', '1', null, null);
INSERT INTO `menu` VALUES ('6', '15', 'Zona', 'zona', 'icon-clock', '1', 'zona', '1', '2017-10-11 17:02:05', '2019-05-15 22:06:39');
INSERT INTO `menu` VALUES ('7', '7', 'Invoice', 'invoice', null, '3', 'invoice', '1', '2018-12-13 10:27:48', '2019-05-27 15:04:46');
INSERT INTO `menu` VALUES ('8', '9', 'Product', 'product', null, '1', 'product', '1', '2019-04-28 20:19:00', '2019-04-28 20:19:00');
INSERT INTO `menu` VALUES ('9', '10', 'DIPO', 'dipo', null, '1', 'dipo', '1', '2019-04-28 20:19:30', '2019-04-28 20:19:30');
INSERT INTO `menu` VALUES ('10', '11', 'Partner', 'partner', null, '1', 'partner', '1', '2019-04-28 20:19:55', '2019-04-28 20:19:55');
INSERT INTO `menu` VALUES ('11', '12', 'Vendor', 'vendor', null, '1', 'vendor', '1', '2019-04-28 20:20:13', '2019-05-18 14:09:02');
INSERT INTO `menu` VALUES ('12', '11', 'Customer', 'customerreport', null, '3', 'customer', '0', '2019-04-28 20:21:08', '2019-05-27 16:25:25');
INSERT INTO `menu` VALUES ('13', '8', 'Company', 'companyreport', null, '3', 'sell', '1', '2019-04-28 20:21:29', '2019-04-28 20:21:29');
INSERT INTO `menu` VALUES ('14', '9', 'DIPO Report', 'diporeport', null, '3', 'dipo_report', '0', '2019-04-28 20:22:00', '2019-05-27 16:24:56');
INSERT INTO `menu` VALUES ('15', '10', 'Partner Report', 'partnerreport', null, '3', 'partner_report', '0', '2019-04-28 20:22:20', '2019-05-27 16:25:12');
INSERT INTO `menu` VALUES ('16', '4', 'Admin', 'admin', 'icon-users', '0', 'admin', '1', '2019-04-28 20:22:36', '2019-04-28 20:22:36');
INSERT INTO `menu` VALUES ('17', '3', 'Blog', 'blog', 'icon-feed', '0', 'blog', '1', '2019-04-28 20:22:47', '2019-04-28 20:22:47');
INSERT INTO `menu` VALUES ('18', '4', 'Pricelist', 'pricelist', null, '3', 'pricelist', '1', '2019-05-19 09:36:15', '2019-05-19 09:42:18');
INSERT INTO `menu` VALUES ('19', '5', 'Surat Pesanan', 'suratpesanan', null, '3', 'surat_pesanan', '1', '2019-05-25 12:31:22', '2019-05-25 12:33:28');
INSERT INTO `menu` VALUES ('20', '6', 'Surat Jalan', 'suratjalan', null, '3', 'surat_jalan', '1', '2019-05-27 14:42:46', '2019-05-27 14:43:03');
INSERT INTO `menu` VALUES ('21', '21', 'Chart Of Accounts', 'chartofaccount', null, '1', 'chartofaccount', '1', '2019-06-12 10:25:16', '2019-06-12 10:31:38');
INSERT INTO `menu` VALUES ('22', '22', 'Jurnal', 'jurnal', null, '3', 'jurnal', '1', '2019-06-12 11:26:32', '2019-06-12 11:26:32');
INSERT INTO `menu` VALUES ('23', '23', 'Stock', 'stock', null, '3', 'stock', '1', '2019-06-24 10:25:53', '2019-06-24 10:25:53');
INSERT INTO `menu` VALUES ('24', '24', 'Profit and Loss', 'profitloss', null, '3', 'profit_loss', '1', '2019-06-25 14:02:38', '2019-06-25 14:02:38');
INSERT INTO `menu` VALUES ('25', '25', 'Account Payable', 'accountpayable', null, '3', 'accountpayable', '1', '2019-06-26 22:54:05', '2019-06-26 22:54:05');
