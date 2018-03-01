/*
Navicat MySQL Data Transfer

Source Server         : dphe-pavilion
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-22 17:53:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tdo_gxgd_prods
-- ----------------------------
DROP TABLE IF EXISTS `tdo_gxgd_prods`;
CREATE TABLE `tdo_gxgd_prods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productId` int(10) unsigned NOT NULL COMMENT '产品编码',
  `goodsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '产品包名称',
  `feeType` smallint(5) unsigned NOT NULL COMMENT '计费周期',
  `price` int(10) unsigned NOT NULL COMMENT '计费价格',
  `idcId` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'IDC产品ID',
  `bossId` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'BOSS产品ID',
  `tariffId` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'BOSS产品资费ID',
  `env` tinyint(3) unsigned NOT NULL COMMENT '测试环境',
  `verify` tinyint(1) NOT NULL COMMENT '已审核',
  `pId` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '促销ID',
  `pName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '促销名称',
  `pDesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '促销描述',
  `pType` int(11) NOT NULL,
  `pUnit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pValue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tdo_gxgd_prods
-- ----------------------------
INSERT INTO `tdo_gxgd_prods` VALUES ('1', '0', 'CP包年测试产品包', '360', '10', 'IDC_CP_TEST_YEAR', '404550068568', '291492', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('2', '0', 'CP包月测试产品包', '30', '10', 'IDC_CP_TEST_MON', '404550068570', '291493', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('3', '0', 'CP单片测试产品包', '2', '10', 'IDC_CP_TEST_DP', '404550068569', '291494', '0', '0', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('4', '0', '产品消费测试包', '1', '0', '', '404550068715', '', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('5', '0', '广电测试包年产品', '360', '24000', 'IDC_year', '404550070042', '302772', '1', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('6', '0', '广电测试包月产品', '30', '1000', 'IDC_month', '404550070043', '302771', '1', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('7', '0', '单片计费0.2元', '2', '20', 'IDC_single_0.2', '404550070045', '302753', '1', '0', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('8', '0', '广电测试按次产品', '2', '100', 'IDC_single', '404550070041', '302751', '1', '0', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('9', '0', '产品消费测试包', '1', '0', '', '404550068715', '', '1', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('10', '0', 'CP包月测试产品包', '90', '10', 'IDC_CP_TEST_MON', '404550068570', '291493', '0', '1', '600048040', 'CP包月测试产品促销', '1元 12个月', '2', 'P', '1');
INSERT INTO `tdo_gxgd_prods` VALUES ('11', '0', '广电测试包月产品', '90', '1000', 'IDC_month', '404550070043', '302771', '1', '1', '600048000', '广电测试包月产品促销', '100元12个月', '2', 'P', '100');
INSERT INTO `tdo_gxgd_prods` VALUES ('12', '2', '页面包月专区', '30', '1600', 'IDC_fbyx', '404550076954', '312072', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('13', '3', '体感包月专区', '30', '2900', 'IDC_fbyxtgb', '404550076977', '312412', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('14', '11', '体感专区豪华专享半年包', '90', '2900', 'IDC_fbyxtgb', '404550076977', '312412', '0', '1', '600066333', '飞奔游戏豪华专享半年包', '飞奔游戏豪华专享半年包', '2', 'P', '170');
INSERT INTO `tdo_gxgd_prods` VALUES ('15', '17', '体感专区豪华专享季度包', '90', '2900', 'IDC_fbyxtgb', '404550076977', '312412', '0', '1', '600066332', '飞奔游戏豪华专享季度包', '飞奔游戏豪华专享季度包', '2', 'P', '99');
INSERT INTO `tdo_gxgd_prods` VALUES ('16', '31', '充值1000F币', '1', '0', '', '404550068715', '', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('17', '32', '充值2000F币', '1', '0', '', '404550068715', '', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('18', '33', '充值5000F币', '1', '0', '', '404550068715', '', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('19', '34', '充值10000F币', '1', '0', '', '404550068715', '', '0', '1', '', '', '', '0', '', '');
INSERT INTO `tdo_gxgd_prods` VALUES ('20', '35', '充值50F币', '1', '0', '', '404550068715', '', '0', '1', '', '', '', '0', '', '');
