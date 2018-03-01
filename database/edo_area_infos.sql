/*
Navicat MySQL Data Transfer

Source Server         : 阿里云.toodo
Source Server Version : 50173
Source Host           : 120.25.107.206:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-09-27 19:54:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for edo_area_infos
-- ----------------------------
DROP TABLE IF EXISTS `edo_area_infos`;
CREATE TABLE `edo_area_infos` (
  `area` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trial` tinyint(1) NOT NULL,
  `freeBegin` datetime NOT NULL,
  `freeEnd` datetime NOT NULL,
  `cntId` int(10) unsigned NOT NULL,
  `ownId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of edo_area_infos
-- ----------------------------
INSERT INTO `edo_area_infos` VALUES ('1', '遥控游戏', '1', '1899-12-30 00:00:00', '1899-12-30 00:00:00', '0', '40');
INSERT INTO `edo_area_infos` VALUES ('2', '体感游戏', '1', '1899-12-30 00:00:00', '1899-12-30 00:00:00', '4', '50');
INSERT INTO `edo_area_infos` VALUES ('3', '体感热舞', '0', '1899-12-30 00:00:00', '1899-12-30 00:00:00', '5', '60');
