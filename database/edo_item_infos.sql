/*
Navicat MySQL Data Transfer

Source Server         : 阿里云.toodo
Source Server Version : 50173
Source Host           : 120.25.107.206:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-09-27 19:55:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for edo_item_infos
-- ----------------------------
DROP TABLE IF EXISTS `edo_item_infos`;
CREATE TABLE `edo_item_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page` int(11) NOT NULL COMMENT '分页编号',
  `itemName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '信息标题',
  `itemId` int(11) NOT NULL COMMENT '关联项目编号',
  `itemType` int(11) NOT NULL COMMENT '项目类型',
  `itemPicture` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目图片',
  `pictureType` int(11) NOT NULL COMMENT '图片类型',
  `itemDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目描述',
  `operateType` int(11) NOT NULL COMMENT '游戏操作模式',
  `propId` int(11) NOT NULL COMMENT '单次进入游戏的费用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of edo_item_infos
-- ----------------------------
INSERT INTO `edo_item_infos` VALUES ('1', '0', '时尚跑酷', '1008', '0', '0_1_1008', '1', '', '2', '5');
INSERT INTO `edo_item_infos` VALUES ('2', '0', '猪猪冒险之旅', '2012', '0', '0_4_2012', '4', '', '2', '7');
INSERT INTO `edo_item_infos` VALUES ('3', '0', '骑牛', '2005', '0', '0_2_2005', '2', '', '2', '10');
INSERT INTO `edo_item_infos` VALUES ('4', '0', '波斯迷城', '1001', '0', '0_4_1001', '4', '', '2', '11');
INSERT INTO `edo_item_infos` VALUES ('5', '0', '水管转转转', '2014', '0', '0_6_2014', '6', '', '2', '0');
INSERT INTO `edo_item_infos` VALUES ('6', '0', '休闲射击', '2015', '0', '0_6_2015', '6', '', '2', '0');
INSERT INTO `edo_item_infos` VALUES ('7', '0', '世界网球', '2011', '0', '0_3_2011', '3', '', '2', '16');
INSERT INTO `edo_item_infos` VALUES ('8', '0', '乒乓3', '2013', '0', '0_5_2013', '5', '', '2', '18');
INSERT INTO `edo_item_infos` VALUES ('9', '1', '波斯迷城', '1001', '0', '1001', '0', '你见过尖尖的房子吗？', '2', '3');
INSERT INTO `edo_item_infos` VALUES ('10', '1', '时尚跑酷', '1008', '0', '1008', '0', '', '2', '5');
INSERT INTO `edo_item_infos` VALUES ('11', '1', '贪吃蛇', '1010', '0', '1010', '0', '', '2', '6');
INSERT INTO `edo_item_infos` VALUES ('12', '1', '高尔夫之旅', '1011', '0', '1011', '0', '', '2', '7');
INSERT INTO `edo_item_infos` VALUES ('16', '1', '骑牛', '2005', '0', '2005', '0', '', '2', '13');
INSERT INTO `edo_item_infos` VALUES ('17', '1', '新射箭', '2010', '0', '2010', '0', '', '2', '15');
INSERT INTO `edo_item_infos` VALUES ('18', '1', '世界网球', '2011', '0', '2011', '0', '', '2', '16');
INSERT INTO `edo_item_infos` VALUES ('19', '1', '猪猪冒险之旅', '2012', '0', '2012', '0', '', '2', '17');
INSERT INTO `edo_item_infos` VALUES ('20', '1', '乒乓3', '2013', '0', '2013', '0', '', '2', '18');
INSERT INTO `edo_item_infos` VALUES ('21', '1', '水管转转转', '2014', '0', '2014', '0', '', '2', '19');
INSERT INTO `edo_item_infos` VALUES ('22', '1', '休闲射击', '2015', '0', '2015', '0', '', '2', '20');
INSERT INTO `edo_item_infos` VALUES ('23', '1', '特种兵', '2017', '0', '2017', '0', '', '2', '0');
INSERT INTO `edo_item_infos` VALUES ('27', '1', '趣味飞盘', '1004', '0', '1004', '0', '', '2', '4');
INSERT INTO `edo_item_infos` VALUES ('28', '1', '足球', '2009', '0', '2009', '0', '', '2', '14');
INSERT INTO `edo_item_infos` VALUES ('29', '2', '魔幻球', '2021', '0', '2_3_2021', '3', '', '1', '7');
INSERT INTO `edo_item_infos` VALUES ('30', '2', '宝石', '2020', '0', '2_2_2020', '2', '', '1', '0');
INSERT INTO `edo_item_infos` VALUES ('31', '2', '天空迷阵', '2003', '0', '2_1_2003', '1', '', '1', '11');
INSERT INTO `edo_item_infos` VALUES ('32', '2', '接积木', '2004', '0', '2_0_2004', '0', '', '1', '12');
INSERT INTO `edo_item_infos` VALUES ('33', '2', '飞行表演', '2002', '0', '2_4_2002', '4', '', '1', '10');
INSERT INTO `edo_item_infos` VALUES ('34', '3', '魔幻球', '2021', '0', '2021', '0', '', '1', '7');
INSERT INTO `edo_item_infos` VALUES ('35', '3', '宝石', '2020', '0', '2020', '0', '', '1', '0');
INSERT INTO `edo_item_infos` VALUES ('36', '3', '天空迷阵', '2003', '0', '2003', '0', '', '1', '11');
INSERT INTO `edo_item_infos` VALUES ('37', '3', '接积木', '2004', '0', '2004', '0', '', '1', '12');
INSERT INTO `edo_item_infos` VALUES ('38', '3', '飞行表演', '2002', '0', '2002', '0', '', '1', '10');
INSERT INTO `edo_item_infos` VALUES ('39', '3', '连连看', '2019', '0', '2019', '0', '', '1', '0');
