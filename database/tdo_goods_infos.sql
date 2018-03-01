/*
Navicat MySQL Data Transfer

Source Server         : dphe-pavilion
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-08-31 10:59:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tdo_goods_infos
-- ----------------------------
DROP TABLE IF EXISTS `tdo_goods_infos`;
CREATE TABLE `tdo_goods_infos` (
  `productId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '统一商品编号',
  `goodsId` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '商家自编号',
  `goodsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '商品名称',
  `goodsDesc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品描述',
  `complex` tinyint(1) NOT NULL COMMENT '是复合产品',
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '复合内容',
  `category` tinyint(3) unsigned NOT NULL COMMENT '产品类型',
  `price` int(10) unsigned NOT NULL COMMENT '定价/分',
  `storeId` int(10) unsigned NOT NULL COMMENT '商家编号',
  `storeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '商家名称',
  `verify` tinyint(1) NOT NULL COMMENT '已审核',
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tdo_goods_infos
-- ----------------------------
INSERT INTO `tdo_goods_infos` VALUES ('1', 'TD001', '体感游戏包月', '', '0', '', '0', '3000', '1000', '双动科技', '1', '');
INSERT INTO `tdo_goods_infos` VALUES ('2', 'TD002', '页面游戏包月', '', '0', '', '0', '1600', '1000', '双动科技', '1', '');
INSERT INTO `tdo_goods_infos` VALUES ('3', 'TD003', '体感热舞包月', '', '0', '', '0', '2900', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('4', 'TD004', '体感手柄', '送硬件', '0', '', '1', '19800', '1000', '双动科技', '1', '');
INSERT INTO `tdo_goods_infos` VALUES ('5', 'TD005', '品质跳舞毯', '送硬件', '0', '', '1', '9800', '1000', '双动科技', '1', '');
INSERT INTO `tdo_goods_infos` VALUES ('6', 'TD006', '运动套装', '含网球拍、高尔夫球杆、棒球棍等十合一外设。', '0', '', '1', '9800', '1000', '双动科技', '1', '');
INSERT INTO `tdo_goods_infos` VALUES ('10', 'TD010', '体感游戏包年送手柄', '', '1', '[{\"goodsId\":\"TD001\",\"quantity\":12},{\"goodsId\":\"TD004\",\"quantity\":1},{\"goodsId\":\"TD012\",\"quantity\":1}]', '1', '36000', '1000', '双动科技', '1', '');
INSERT INTO `tdo_goods_infos` VALUES ('11', 'TD011', '体感热舞半年送跳舞毯', '', '1', '[{\"goodsId\":\"TD003\",\"quantity\":6},{\"goodsId\":\"TD005\",\"quantity\":1},{\"goodsId\":\"TD012\",\"quantity\":1}]', '0', '17000', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('12', 'TD012', '快递费', '', '0', '', '1', '1800', '1000', '双动科技', '1', '');
INSERT INTO `tdo_goods_infos` VALUES ('13', 'TD013', '红外游戏包月', '', '0', '', '0', '1600', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('17', 'TD017', '体感热舞季度送跳舞毯', '', '1', '[{\"goodsId\":\"TD003\",\"quantity\":3},{\"goodsId\":\"TD005\",\"quantity\":1},{\"goodsId\":\"TD012\",\"quantity\":1}]', '0', '9900', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('20', 'TD020', '拓捷游戏包月', '', '0', '', '0', '1800', '1000', '双动科技', '1', '');
INSERT INTO `tdo_goods_infos` VALUES ('31', 'TD031', '充值1000F币', '', '0', '', '1', '1000', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('32', 'TD032', '充值2000F币', '', '0', '', '1', '2000', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('33', 'TD033', '充值5000F币', '', '0', '', '1', '5000', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('34', 'TD034', '充值10000F币', '', '0', '', '1', '10000', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('35', 'TD035', '抽奖50F币', '', '0', '', '1', '0', '1000', '双动科技', '1', '广西');
INSERT INTO `tdo_goods_infos` VALUES ('40', 'TD040', '遥控游戏专区包月', '遥控游戏包月 海量游戏畅玩30天                     19元', '0', '', '0', '1900', '1000', '双动科技', '1', '河南有线');
INSERT INTO `tdo_goods_infos` VALUES ('41', 'TD041', '遥控游戏专区包年', '遥控游戏包年 海量游戏畅玩12个月                  现价99元 原价228元', '1', '[{\"goodsId\":\"TD040\",\"quantity\":12}]', '1', '9900', '1000', '双动科技', '1', '河南有线');
INSERT INTO `tdo_goods_infos` VALUES ('50', 'TD050', '体感游戏专区包月', '体感游戏包月 海量游戏畅玩30天                     19元', '0', '', '0', '1900', '1000', '双动科技', '1', '河南有线');
INSERT INTO `tdo_goods_infos` VALUES ('51', 'TD051', '体感游戏专区包年 ', '体感游戏包年 海量游戏畅玩12个月                   现价99元 原价228元', '1', '[{\"goodsId\":\"TD050\",\"quantity\":12}]', '1', '9900', '1000', '双动科技', '1', '河南有线');
INSERT INTO `tdo_goods_infos` VALUES ('52', 'TD052', '黄金套餐', '黄金套餐      含体感手柄       赠送12个月体感游戏包月  超值199元 免邮到家', '1', '[{\"goodsId\":\"TD050\",\"quantity\":12},{\"goodsId\":\"TD004\",\"quantity\":1},{\"goodsId\":\"TD012\",\"quantity\":1}]', '1', '19900', '1000', '双动科技', '1', '河南有线');
INSERT INTO `tdo_goods_infos` VALUES ('53', 'TD053', '钻石套餐', '钻石套餐      含体感手柄+运动套装  赠送12个月体感游戏包月  钜惠249元 免邮到家', '1', '[{\"goodsId\":\"TD050\",\"quantity\":12},{\"goodsId\":\"TD004\",\"quantity\":1},{\"goodsId\":\"TD006\",\"quantity\":1},{\"goodsId\":\"TD012\",\"quantity\":1}]', '1', '24900', '1000', '双动科技', '1', '河南有线');
INSERT INTO `tdo_goods_infos` VALUES ('60', 'TD060', '体感热舞专区包月', '体感热舞包月  畅玩海量舞曲30天                      19元', '0', '', '0', '1900', '1000', '双动科技', '1', '河南有线');
INSERT INTO `tdo_goods_infos` VALUES ('61', 'TD061', '体感热舞专区包年', '体感热舞包年  畅玩海量舞曲12个月                   现价99元 原价228元', '1', '[{\"goodsId\":\"TD060\",\"quantity\":12}]', '1', '9900', '1000', '双动科技', '1', '河南有线');
INSERT INTO `tdo_goods_infos` VALUES ('62', 'TD062', '钻石套餐', '钻石套餐     含体感跳舞毯      赠送12个月体感热舞包月  钜惠149元 免邮到家', '1', '[{\"goodsId\":\"TD060\",\"quantity\":12},{\"goodsId\":\"TD005\",\"quantity\":1},{\"goodsId\":\"TD012\",\"quantity\":1}]', '1', '14900', '1000', '双动科技', '1', '河南有线');
