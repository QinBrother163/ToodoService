/*
Navicat MySQL Data Transfer

Source Server         : dphe-pavilion
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-23 15:30:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tdc_row_infos
-- ----------------------------
DROP TABLE IF EXISTS `tdc_row_infos`;
CREATE TABLE `tdc_row_infos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `docker` int(11) NOT NULL,
  `subject` tinyint(4) NOT NULL,
  `body` tinyint(4) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `padding` int(11) NOT NULL,
  `spacing` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `span` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slots` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tdc_row_infos
-- ----------------------------
INSERT INTO `tdc_row_infos` VALUES ('1', '1', '1', '0', '1130', '313', '15', '30', '2', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('2', '1', '0', '0', '1130', '267', '15', '30', '3', '536,252,252', '', '');
INSERT INTO `tdc_row_infos` VALUES ('3', '2', '1', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('4', '3', '1', '0', '1130', '420', '15', '30', '3', '5,2,2', '', '');
INSERT INTO `tdc_row_infos` VALUES ('5', '4', '1', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('6', '4', '0', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('7', '5', '1', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('9', '6', '1', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('10', '7', '1', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('11', '7', '0', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('12', '7', '0', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('13', '7', '0', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('14', '7', '0', '0', '1130', '275', '15', '30', '6', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('15', '8', '0', '0', '1130', '313', '15', '30', '2', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('16', '8', '0', '0', '1130', '215', '15', '30', '4', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('17', '9', '0', '0', '1130', '296', '15', '30', '2', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('18', '9', '0', '0', '1130', '231', '15', '30', '4', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('19', '10', '0', '0', '1130', '297', '15', '30', '3', '536,252,252', '', '');
INSERT INTO `tdc_row_infos` VALUES ('20', '10', '0', '0', '1130', '192', '15', '30', '4', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('21', '10', '0', '0', '1130', '235', '15', '30', '3', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('22', '10', '0', '0', '1130', '296', '15', '30', '4', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('23', '11', '0', '0', '1130', '327', '15', '30', '2', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('24', '11', '0', '0', '1130', '367', '15', '30', '3', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('25', '11', '0', '0', '1130', '327', '15', '30', '2', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('26', '11', '0', '0', '1130', '327', '15', '30', '2', '', '', '');
INSERT INTO `tdc_row_infos` VALUES ('27', '0', '0', '0', '0', '0', '0', '0', '0', '', '', '');
