/*
Navicat MySQL Data Transfer

Source Server         : dphe-pavilion
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-23 15:29:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tdc_docker_infos
-- ----------------------------
DROP TABLE IF EXISTS `tdc_docker_infos`;
CREATE TABLE `tdc_docker_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `items` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tdc_docker_infos
-- ----------------------------
INSERT INTO `tdc_docker_infos` VALUES ('1', '活动推荐', '', '5', '1001,1005');
INSERT INTO `tdc_docker_infos` VALUES ('2', '休闲游戏', '', '6', '1001,1006');
INSERT INTO `tdc_docker_infos` VALUES ('3', '小双福利社', '', '3', '1022,1024');
INSERT INTO `tdc_docker_infos` VALUES ('4', '精品游戏推荐', '', '12', '1001,1012');
INSERT INTO `tdc_docker_infos` VALUES ('5', '云游戏精选', '', '6', '1001,1006');
INSERT INTO `tdc_docker_infos` VALUES ('6', '棋牌游戏', '', '6', '1001,1006');
INSERT INTO `tdc_docker_infos` VALUES ('7', '电子竞技', '', '26', '1001,1026');
INSERT INTO `tdc_docker_infos` VALUES ('8', '热门游戏', '', '6', '2001,2006');
INSERT INTO `tdc_docker_infos` VALUES ('9', '遥控专区，最新上线！', '', '6', '2007,2012');
INSERT INTO `tdc_docker_infos` VALUES ('10', '体感游戏', '', '14', '2013,2026');
INSERT INTO `tdc_docker_infos` VALUES ('11', '商城', '', '9', '10001,10009');
