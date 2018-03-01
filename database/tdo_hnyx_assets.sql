/*
Navicat MySQL Data Transfer

Source Server         : dphe-pavilion
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-06 11:18:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tdo_hnyx_assets
-- ----------------------------
DROP TABLE IF EXISTS `tdo_hnyx_assets`;
CREATE TABLE `tdo_hnyx_assets` (
  `songId` int(10) unsigned NOT NULL,
  `assetId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `otherSongs` text COLLATE utf8_unicode_ci NOT NULL,
  `online` int(11) NOT NULL,
  `verify` int(11) NOT NULL,
  `videoId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`songId`),
  UNIQUE KEY `tdo_hnyx_assets_assetid_unique` (`assetId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tdo_hnyx_assets
-- ----------------------------
INSERT INTO `tdo_hnyx_assets` VALUES ('10011', 'TD2017090601001101001100', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:34');
INSERT INTO `tdo_hnyx_assets` VALUES ('10016', 'TD2017090601001101001600', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:34');
INSERT INTO `tdo_hnyx_assets` VALUES ('10017', 'TD2017090601001101001700', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:34');
INSERT INTO `tdo_hnyx_assets` VALUES ('10018', 'TD2017090601001101001800', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:34');
INSERT INTO `tdo_hnyx_assets` VALUES ('20001', 'TD2017090601001102000100', '[]', '1', '0', '', '', '2017-08-22 11:52:19', '2017-09-06 10:41:34');
INSERT INTO `tdo_hnyx_assets` VALUES ('20002', 'TD2017090601001102000200', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20003', 'TD2017090601001102000300', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20004', 'TD2017090601001102000400', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20005', 'TD2017090601001102000500', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20006', 'TD2017090601001102000600', '[]', '1', '0', '', '', '2017-08-22 11:59:32', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20007', 'TD2017090601001102000700', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20008', 'TD2017090601001102000800', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20009', 'TD2017090601001102000900', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20010', 'TD2017090601001102001000', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20011', 'TD2017090601001102001100', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20012', 'TD2017090601001102001200', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20013', 'TD2017090601001102001300', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20014', 'TD2017090601001102001400', '[90001]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20015', 'TD2017090601001102001500', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20016', 'TD2017090601001102001600', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20017', 'TD2017090601001102001700', '[90010]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:35');
INSERT INTO `tdo_hnyx_assets` VALUES ('20018', 'TD2017090601001102001800', '[90002]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('20019', 'TD2017090601001102001900', '[90009]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('20020', 'TD2017090601001102002000', '[90004]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('20021', 'TD2017090601001102002100', '[90003]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('20058', 'TD2017090601001102005800', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('20059', 'TD2017090601001102005900', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30001', 'TD2017090601001103000100', '[90006]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30002', 'TD2017090601001103000200', '[]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30003', 'TD2017090601001103000300', '[90005]', '1', '0', '', '', '2017-08-22 11:59:33', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30004', 'TD2017090601001103000400', '[90007]', '1', '0', '', '', '2017-08-22 11:59:34', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30005', 'TD2017090601001103000500', '[]', '1', '0', '', '', '2017-08-22 11:59:34', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30006', 'TD2017090601001103000600', '[]', '1', '0', '', '', '2017-08-22 11:59:34', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30007', 'TD2017090601001103000700', '[]', '1', '0', '', '', '2017-08-22 11:59:34', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30008', 'TD2017090601001103000800', '[90008]', '1', '0', '', '', '2017-08-22 11:59:34', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30009', 'TD2017090601001103000900', '[]', '1', '0', '', '', '2017-08-22 11:59:34', '2017-09-06 10:41:36');
INSERT INTO `tdo_hnyx_assets` VALUES ('30010', 'TD2017090601001103001000', '[]', '1', '0', '', '', '2017-08-22 11:59:34', '2017-09-06 10:41:36');
