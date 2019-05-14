/*
Navicat MySQL Data Transfer

Source Server         : PHPMyAdmin
Source Server Version : 50611
Source Host           : 127.0.0.1:3306
Source Database       : db_kanaka

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2019-05-14 23:51:03
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '2', 'Master', 'master', 'icon-grid', '0', 'master', '1', '2019-04-25 01:16:17', '2019-04-27 23:54:40');
INSERT INTO `menu` VALUES ('2', '8', 'Category', 'category', 'icon-briefcase', '1', 'category', '1', null, '2019-05-12 21:50:22');
INSERT INTO `menu` VALUES ('3', '1', 'Reports', 'reports', 'icon-notebook', '0', 'reports', '1', null, '2017-10-11 15:45:49');
INSERT INTO `menu` VALUES ('4', '14', 'Menus', 'menu', null, '1', 'menus', '1', null, null);
INSERT INTO `menu` VALUES ('5', '13', 'Users', 'users/account', null, '1', 'users', '1', null, null);
INSERT INTO `menu` VALUES ('6', '6', 'Brand', 'brand', 'icon-clock', '1', 'brand', '0', '2017-10-11 17:02:05', '2017-10-31 09:50:36');
INSERT INTO `menu` VALUES ('7', '7', 'Area', 'area', null, '1', 'area', '0', '2018-12-13 10:27:48', '2019-04-27 07:52:18');
INSERT INTO `menu` VALUES ('8', '9', 'Product', 'product', null, '1', 'product', '1', '2019-04-28 20:19:00', '2019-04-28 20:19:00');
INSERT INTO `menu` VALUES ('9', '10', 'DIPO', 'dipo', null, '1', 'dipo', '1', '2019-04-28 20:19:30', '2019-04-28 20:19:30');
INSERT INTO `menu` VALUES ('10', '11', 'Partner', 'partner', null, '1', 'partner', '1', '2019-04-28 20:19:55', '2019-04-28 20:19:55');
INSERT INTO `menu` VALUES ('11', '12', 'Vendor', 'vendor', null, '1', 'vendor', '1', '2019-04-28 20:20:13', '2019-05-14 23:22:48');
INSERT INTO `menu` VALUES ('12', '5', 'Customer', 'customer', null, '3', 'customer', '1', '2019-04-28 20:21:08', '2019-04-28 20:21:08');
INSERT INTO `menu` VALUES ('13', '6', 'Company', 'company', null, '3', 'company', '1', '2019-04-28 20:21:29', '2019-04-28 20:21:29');
INSERT INTO `menu` VALUES ('14', '7', 'DIPO Report', 'dipo_report', null, '3', 'dipo_report', '1', '2019-04-28 20:22:00', '2019-04-28 20:23:40');
INSERT INTO `menu` VALUES ('15', '8', 'Partner Report', 'partner_report', null, '3', 'partner_report', '1', '2019-04-28 20:22:20', '2019-04-28 20:23:51');
INSERT INTO `menu` VALUES ('16', '4', 'Admin', 'admin', 'icon-users', '0', 'admin', '1', '2019-04-28 20:22:36', '2019-04-28 20:22:36');
INSERT INTO `menu` VALUES ('17', '3', 'Blog', 'blog', 'icon-feed', '0', 'blog', '1', '2019-04-28 20:22:47', '2019-04-28 20:22:47');
