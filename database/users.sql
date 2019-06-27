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

 Date: 06/27/2019 14:04:21 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `password_mobile` text NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text,
  `logged_in` enum('0','1') NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `dipo_partner_id` int(11) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'admin', '$2y$08$9LW7MTZlxDHExxeL2RowqOzwj8HfP5t1Y6yGw.KH7Wdou1ddPV49G', '5f4dcc3b5aa765d61d8327deb882cf99', '', 'admin@kanaka.com', '', null, null, null, '1268889823', '1561607176', '1', 'Kanaka', 'Indonesia', 'PT Kanaka', 'PT Kanaka', '+62878987654321', 'Jalan Sudirman No 1', '0', '1', '0', 'Jakarta Selatan', null, 'default_avatar.jpg', '2019-04-28 00:25:43'), ('2', '127.0.0.1', 'dipo_jatinegara', '$2y$08$yESv9EQ/YDTZxfxODayOp.4VgHHD8DshNLOVri.PjnWK2WkCAi7SG', '5f4dcc3b5aa765d61d8327deb882cf99', null, 'dipo-jatinegara@kanaka.com', null, null, null, null, '0', '1561548523', '1', 'DIPO', 'Jatinegara', 'DIPO Jatinegara', 'PT Kanaka', '085123567123', 'Jalan Jatinegara 12', '0', '2', '0', 'Jakarta Timur', null, 'default_avatar.jpg', '2019-04-28 00:25:43'), ('8', '127.0.0.1', 'mitra_beras_jatinegara', '$2y$08$cWRlP6Yswl35eoc7G49M8.nrWvZ4yBInAaj72W0pcVIch.W8Iwjui', '', null, 'mitra_beras_jatinegara@kanaka.com', null, null, null, null, '1556385943', '1560939555', '1', 'Mitra Beras', 'Jatinegara', 'Mitra Beras Jatinegara', 'PT Kanaka', '0212378176', 'Jalan Jatinegara 50', '0', '3', '0', null, null, 'default_avatar.jpg', '2019-04-28 00:25:43'), ('9', '::1', 'abcde', '$2y$08$O7MRtcS7pXXACUuPgdJmLuBittWfLJ2DjnUiiXtX9TzfKe2.JgGUC', '', null, '', null, null, null, null, '1561035768', '1561035895', '1', null, null, 'DIPO Cianjur', 'Kanaka', '08787123556', null, '0', '2', '0', null, null, 'default_avatar.jpg', '2019-06-20 20:02:48'), ('10', '::1', 'qwerty', '$2y$08$f20N/NBN5kfZ6w5JGJ1yuerrKleblhDOkfWmYlShBF2U/LlRx3jAC', '', null, 'dipojatipadang@kanakasn.com', null, null, null, null, '1561085380', null, '1', null, null, 'Jatipadang Store', 'Kanaka', '87874089410', 'Jatipadang Road', '0', '2', '0', 'Jakarta Selatan', null, 'default_avatar.jpg', '2019-06-21 09:49:40'), ('11', '::1', 'asdfg', '$2y$08$lZbo4Jald28Gjc1EnO.XNeKl/5zSiuHQPT5gUbl3Yv4MErhoINTOm', '', null, 'mitra_beras_ampera@kanakasn.com', null, null, null, null, '1561085506', null, '1', null, null, 'Ampera Store', 'Kanaka', '87874089410', 'Ampera Road', '0', '3', '11', 'Jakarta Selatan', null, 'default_avatar.jpg', '2019-06-21 09:51:46'), ('12', '::1', 'zxcvb', '$2y$08$esBYnQWqAhJx9M/kclqfTudYjtnGBviiTCm8GPXlbz/d41FcNSpX.', '', null, 'dipofatmawati@kanakasn.com', null, null, null, null, '1561085751', null, '1', null, null, 'Fatmawati', 'Kanaka', '87874089410', 'Fatmawati Road', '0', '2', '0', 'Jakarta Selatan', null, 'default_avatar.jpg', '2019-06-21 09:55:51'), ('13', '::1', 'yuiop', '$2y$08$CntUTj3hV1KiYX2CD5QUJ..1nlk1AbWw7mB5qWbsbA62dX12fCJpq', '', null, 'mitra_gula_fatmawati@kanakasn.com', null, null, null, null, '1561085842', '1561085893', '1', null, null, 'Mitra Gula Fatmawati', 'Kanaka', '87874089410', 'Fatmawati Road', '0', '3', '0', 'Jakarta Selatan', null, 'default_avatar.jpg', '2019-06-21 09:57:22'), ('14', '::1', 'ghjkl', '$2y$08$xh14vIw3nOH5fsyQ1SnCaurR1JcboYSr3rA.ZODJ0IYwNqM2fagdW', '', null, 'diporagunan@kanakasn.com', null, null, null, null, '1561089781', null, '1', null, null, 'DIPO Ragunan', 'Kanaka', '021236876', 'Ragunan Road', '0', '2', '0', 'Jakarta Selatan', null, 'default_avatar.jpg', '2019-06-21 11:03:01'), ('15', '::1', 'dipomampan', '$2y$08$f06FjRoRrI7C1fPJfUY65.CiLD7H4kpA6HQFaBMArjneuDglNQEFy', '', null, 'dipomampang@kanakasn.com', null, null, null, null, '1561102282', null, '1', null, null, 'DIPO Mampang', 'Kanaka', '087865431423', 'Mampang Road', '0', '2', '0', '159', null, 'default_avatar.jpg', '2019-06-21 14:31:22'), ('16', '::1', 'dipo_banda_aceh', '$2y$08$VsmtMJOx2J3LkwbNtCil9OjpIGnBmpHDbqYMbGpedKyD4A4Mv5iee', '', null, 'dipoaceh@kanaka.com', null, null, null, null, '1561116622', null, '1', null, null, 'DIPO Banda Aceh', 'Kanaka', '87874089410', 'Aceh Raya', '0', '2', '20', '1171', null, 'default_avatar.jpg', '2019-06-21 18:30:22'), ('17', '::1', 'dipo_makassar', '$2y$08$yHJIC7Yr70/TcxbkaLzC6OlW/.wD0ERoHAqoJIMGi.jQ9N7VmSeSe', '', null, 'dikpo_makassar@kanaka.com', null, null, null, null, '1561118165', null, '1', null, null, 'DIPO Makassar', 'Kanaka', '87874089410', 'Asia Afrika', '0', '2', '0', '7371', null, 'default_avatar.jpg', '2019-06-21 18:56:05'), ('18', '::1', 'mitra_kanaka', '$2y$08$WNfnwxaxiimtOvySFpxPlOeyUzbTcYnaC4Nji3uvhYAlBX2XApdhC', '', null, 'mitra_kanaka@kanakasn.com', null, null, null, null, '1561617958', null, '1', null, null, 'Mitra Kanaka', 'Kanaka', '081243646253', 'Cilebut raya', '0', '3', '8', 'Bogor', null, 'default_avatar.jpg', '2019-06-27 13:45:58'), ('19', '::1', 'dipo_kanaka', '$2y$08$izDii./oCY09GkjrmfJytuNIlD8nOSQwHZuQl.OqPxTr46EcSaPiq', '', null, 'dipo_kanaka@kanakasn.com', null, null, null, null, '1561618198', '1561618207', '1', null, null, 'DIPO Kanaka', 'Kanaka', '0217892073', 'Cilebut Raya', '0', '2', '0', '3271', null, 'default_avatar.jpg', '2019-06-27 13:49:58'), ('20', '::1', 'dipo_kanaka_bogor', '$2y$08$92kdQ75ZHIMlnCoZl37wf..oL6.UR3Klhv4YeQHU2DeU/a/fzd2de', '', null, 'dipo_kanaka_bogor@kanakasn.com', null, null, null, null, '1561618425', '1561618490', '1', null, null, 'DIPO Pajajaran ', 'Kanaka', '025187654321', 'Jalan Raya Pajajaran No 10', '0', '2', '23', '3271', null, 'default_avatar.jpg', '2019-06-27 13:53:45');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
