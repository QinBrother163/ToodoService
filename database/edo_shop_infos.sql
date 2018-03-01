/*
Navicat MySQL Data Transfer

Source Server         : 阿里云.toodo
Source Server Version : 50173
Source Host           : 120.25.107.206:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-09-27 19:55:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for edo_shop_infos
-- ----------------------------
DROP TABLE IF EXISTS `edo_shop_infos`;
CREATE TABLE `edo_shop_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgType` int(11) NOT NULL,
  `operateType` int(11) NOT NULL,
  `trial` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `itemType` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `prodId` int(11) NOT NULL,
  `biz` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of edo_shop_infos
-- ----------------------------
INSERT INTO `edo_shop_infos` VALUES ('1', '1', '黄金套餐', '黄金套餐 赠送12个月（含体感手柄） 199元', 'shop_2_3', '2', '0', '1', '0', '0', '0', '52', '');
INSERT INTO `edo_shop_infos` VALUES ('2', '1', '钻石套餐', '钻石套餐 赠送12个月（含体感手柄+运动套装） 249元', 'shop_2_4', '2', '0', '1', '0', '0', '0', '53', '');
INSERT INTO `edo_shop_infos` VALUES ('3', '1', '体感游戏专区包月', '体感游戏包月 海量游戏畅玩30天 19元', 'shop_2_1', '2', '3', '1', '0', '0', '50', '50', '');
INSERT INTO `edo_shop_infos` VALUES ('4', '1', '体感游戏专区包年 ', '体感游戏包年 海量游戏畅玩12个月 99元 原价228元', 'shop_2_2', '2', '2', '1', '0', '0', '0', '51', '');
INSERT INTO `edo_shop_infos` VALUES ('5', '2', '钻石套餐', '钻石套餐 赠送12个月（含体感跳舞毯） 149元', 'shop_3_3', '3', '0', '1', '0', '0', '0', '62', '');
INSERT INTO `edo_shop_infos` VALUES ('6', '2', '体感热舞专区包月', '体感热舞包月 畅玩海量舞曲 19元', 'shop_3_1', '3', '3', '1', '0', '0', '60', '60', '');
INSERT INTO `edo_shop_infos` VALUES ('7', '2', '体感热舞专区包年', '体感热舞包年 畅玩海量舞曲 99元 原价228元', 'shop_3_2', '3', '2', '1', '0', '0', '0', '61', '');
INSERT INTO `edo_shop_infos` VALUES ('8', '3', '遥控游戏包月', '遥控游戏包月 海量游戏畅玩30天 19元', 'shop_1_1', '1', '1', '1', '0', '0', '40', '40', '');
INSERT INTO `edo_shop_infos` VALUES ('9', '3', '遥控游戏包年', '遥控游戏包年 海量游戏畅玩12个月 99元 原价228元', 'shop_1_2', '1', '0', '1', '0', '0', '0', '41', '');
INSERT INTO `edo_shop_infos` VALUES ('10', '1000', '主页', '体感游戏专区', '', '0', '0', '1', '0', '0', '50', '50', '');
INSERT INTO `edo_shop_infos` VALUES ('11', '1000', '主页', '体感热舞专区', '', '0', '0', '0', '0', '0', '60', '60', '');
INSERT INTO `edo_shop_infos` VALUES ('12', '1000', '主页', '遥控游戏专区', '', '0', '0', '1', '0', '0', '40', '40', '');
INSERT INTO `edo_shop_infos` VALUES ('13', '1000', '主页', '商城页面', '', '0', '0', '1', '0', '0', '0', '0', '');
