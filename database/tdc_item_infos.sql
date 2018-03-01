/*
Navicat MySQL Data Transfer

Source Server         : 阿里云.toodo
Source Server Version : 50173
Source Host           : 120.25.107.206:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-09-28 12:03:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tdc_item_infos
-- ----------------------------
DROP TABLE IF EXISTS `tdc_item_infos`;
CREATE TABLE `tdc_item_infos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `typeId` int(11) DEFAULT NULL,
  `imgs` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10010 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tdc_item_infos
-- ----------------------------
INSERT INTO `tdc_item_infos` VALUES ('1001', '1', null, '{\"img0\":\"h_200x112 (1).jpg\",\n \"img1\":\"h_400x225 (1).jpg\",\n \"img2\":\"h_448x252 (1).jpg\",\n \"img4\":\"v_200x300 (1).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1002', '1', null, '{\"img0\":\"h_200x112 (2).jpg\",\n \"img1\":\"h_400x225 (2).jpg\",\n \"img2\":\"h_448x252 (2).jpg\",\n \"img3\":\"h_800x450_ (2).jpg\",\n \"img4\":\"v_200x300 (2).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1003', '1', null, '{\"img0\":\"h_200x112 (3).jpg\",\n \"img1\":\"h_400x225 (3).jpg\",\n \"img2\":\"h_448x252 (3).jpg\",\n \"img3\":\"h_800x450_ (3).jpg\",\n \"img4\":\"v_200x300 (3).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1004', '1', null, '{\"img0\":\"h_200x112 (4).jpg\",\n \"img1\":\"h_400x225 (4).jpg\",\n \"img2\":\"h_448x252 (4).jpg\",\n \"img4\":\"v_200x300 (4).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1005', '1', null, '{\"img0\":\"h_200x112 (5).jpg\",\n \"img1\":\"h_400x225 (5).jpg\",\n \"img2\":\"h_448x252 (5).jpg\",\n \"img3\":\"h_800x450_ (5).jpg\",\n \"img4\":\"v_200x300 (5).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1006', '1', null, '{\"img0\":\"h_200x112 (6).jpg\",\n \"img1\":\"h_400x225 (6).jpg\",\n \"img2\":\"h_448x252 (6).jpg\",\n \"img4\":\"v_200x300 (6).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1007', '1', null, '{\"img0\":\"h_200x112 (7).jpg\",\n \"img1\":\"h_400x225 (7).jpg\",\n \"img2\":\"h_448x252 (7).jpg\",\n \"img3\":\"h_800x450_ (4).jpg\",\n \"img4\":\"v_200x300 (7).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1008', '1', null, '{\"img0\":\"h_200x112 (8).jpg\",\n \"img1\":\"h_400x225 (8).jpg\",\n \"img2\":\"h_448x252 (8).jpg\",\n \"img4\":\"v_200x300 (8).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1009', '1', null, '{\"img0\":\"h_200x112 (9).jpg\",\n \"img1\":\"h_400x225 (9).jpg\",\n \"img2\":\"h_448x252 (9).jpg\",\n \"img3\":\"h_800x450_ (1).jpg\",\n \"img4\":\"v_200x300 (9).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1010', '1', null, '{\"img0\":\"h_200x112 (10).jpg\",\n \"img1\":\"h_400x225 (10).jpg\",\n \"img2\":\"h_448x252 (10).jpg\",\n \"img4\":\"v_200x300 (10).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1011', '1', null, '{\"img0\":\"h_200x112 (11).jpg\",\n \"img1\":\"h_400x225 (11).jpg\",\n \"img2\":\"h_448x252 (11).jpg\",\n \"img4\":\"v_200x300 (11).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1012', '1', null, '{\"img0\":\"h_200x112 (12).jpg\",\n \"img1\":\"h_400x225 (12).jpg\",\n \"img2\":\"h_448x252 (12).jpg\",\n \"img4\":\"v_200x300 (12).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1013', '1', null, '{\"img0\":\"h_200x112 (13).jpg\",\n \"img1\":\"h_400x225 (13).jpg\",\n \"img2\":\"h_448x252 (13).jpg\",\n \"img4\":\"v_200x300 (13).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1014', '1', null, '{\"img0\":\"h_200x112 (14).jpg\",\n \"img1\":\"h_400x225 (14).jpg\",\n \"img2\":\"h_448x252 (14).jpg\",\n \"img4\":\"v_200x300 (14).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1015', '1', null, '{\"img0\":\"h_200x112 (15).jpg\",\n \"img1\":\"h_400x225 (15).jpg\",\n \"img2\":\"h_448x252 (15).jpg\",\n \"img4\":\"v_200x300 (15).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1016', '1', null, '{\"img0\":\"h_200x112 (16).jpg\",\n \"img1\":\"h_400x225 (16).jpg\",\n \"img2\":\"h_448x252 (16).jpg\",\n \"img4\":\"v_200x300 (16).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1017', '1', null, '{\"img0\":\"h_200x112 (17).jpg\",\n \"img1\":\"h_400x225 (17).jpg\",\n \"img2\":\"h_448x252 (17).jpg\",\n \"img4\":\"v_200x300 (17).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1018', '1', null, '{\"img0\":\"h_200x112 (18).jpg\",\n \"img1\":\"h_400x225 (18).jpg\",\n \"img2\":\"h_448x252 (18).jpg\",\n \"img4\":\"v_200x300 (18).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1019', '1', null, '{\"img0\":\"h_200x112 (19).jpg\",\n \"img1\":\"h_400x225 (19).jpg\",\n \"img2\":\"h_448x252 (19).jpg\",\n \"img4\":\"v_200x300 (19).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1020', '1', null, '{\"img0\":\"h_200x112 (20).jpg\",\n \"img1\":\"h_400x225 (20).jpg\",\n \"img2\":\"h_448x252 (20).jpg\",\n \"img4\":\"v_200x300 (20).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1021', '1', null, '{\"img0\":\"h_200x112 (21).jpg\",\n \"img1\":\"h_400x225 (21).jpg\",\n \"img2\":\"h_448x252 (21).jpg\",\n \"img4\":\"v_200x300 (21).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1022', '1', null, '{\"img0\":\"h_200x112 (22).jpg\",\n \"img1\":\"h_400x225 (22).jpg\",\n \"img2\":\"h_448x252 (22).jpg\",\n \"img4\":\"v_200x300 (22).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1023', '1', null, '{\"img0\":\"h_200x112 (23).jpg\",\n \"img1\":\"h_400x225 (23).jpg\",\n \"img2\":\"h_448x252 (23).jpg\",\n \"img4\":\"v_200x300 (23).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1024', '1', null, '{\"img0\":\"h_200x112 (24).jpg\",\n \"img1\":\"h_400x225 (24).jpg\",\n \"img2\":\"h_448x252 (24).jpg\",\n \"img4\":\"v_200x300 (24).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1025', '1', null, '{\"img0\":\"h_200x112 (25).jpg\",\n \"img1\":\"h_400x225 (25).jpg\",\n \"img4\":\"v_200x300 (25).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1026', '1', null, '{\"img0\":\"h_200x112 (26).jpg\",\n \"img1\":\"h_400x225 (26).jpg\",\n \"img4\":\"v_200x300 (26).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1027', '1', null, '{\"img0\":\"h_200x112 (27).jpg\",\n \"img1\":\"h_400x225 (27).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1028', '1', null, '{\"img0\":\"h_200x112 (28).jpg\",\n \"img1\":\"h_400x225 (28).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1029', '1', null, '{\"img0\":\"h_200x112 (29).jpg\",\n \"img1\":\"h_400x225 (29).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1030', '1', null, '{\"img0\":\"h_200x112 (30).jpg\",\n \"img1\":\"h_400x225 (30).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1031', '1', null, '{\"img0\":\"h_200x112 (31).jpg\",\n \"img1\":\"h_400x225 (31).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1032', '1', null, '{\"img0\":\"h_200x112 (32).jpg\",\n \"img1\":\"h_400x225 (32).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1033', '1', null, '{\"img0\":\"h_200x112 (33).jpg\",\n \"img1\":\"h_400x225 (33).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1034', '1', null, '{\"img0\":\"h_200x112 (34).jpg\",\n \"img1\":\"h_400x225 (34).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1035', '1', null, '{\"img0\":\"h_200x112 (35).jpg\",\n \"img1\":\"h_400x225 (35).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1036', '1', null, '{\"img0\":\"h_200x112 (36).jpg\",\n \"img1\":\"h_400x225 (36).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1037', '1', null, '{\"img0\":\"h_200x112 (37).jpg\",\n \"img1\":\"h_400x225 (37).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1038', '1', null, '{\"img0\":\"h_200x112 (38).jpg\",\n \"img1\":\"h_400x225 (38).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1039', '1', null, '{\"img0\":\"h_200x112 (39).jpg\",\n \"img1\":\"h_400x225 (39).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1040', '1', null, '{\"img0\":\"h_200x112 (40).jpg\",\n \"img1\":\"h_400x225 (40).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1041', '1', null, '{\"img0\":\"h_200x112 (41).jpg\",\n \"img1\":\"h_400x225 (41).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1042', '1', null, '{\"img0\":\"h_200x112 (42).jpg\",\n \"img1\":\"h_400x225 (42).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1043', '1', null, '{\"img0\":\"h_200x112 (43).jpg\",\n \"img1\":\"h_400x225 (43).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1044', '1', null, '{\"img0\":\"h_200x112 (44).jpg\",\n \"img1\":\"h_400x225 (44).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1045', '1', null, '{\"img0\":\"h_200x112 (45).jpg\",\n \"img1\":\"h_400x225 (45).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1046', '1', null, '{\"img0\":\"h_200x112 (46).jpg\",\n \"img1\":\"h_400x225 (46).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1047', '1', null, '{\"img0\":\"h_200x112 (47).jpg\",\n \"img1\":\"h_400x225 (47).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1048', '1', null, '{\"img0\":\"h_200x112 (48).jpg\",\n \"img1\":\"h_400x225 (48).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1049', '1', null, '{\"img0\":\"h_200x112 (49).jpg\",\n \"img1\":\"h_400x225 (49).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1050', '1', null, '{\"img0\":\"h_200x112 (50).jpg\",\n \"img1\":\"h_400x225 (50).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1051', '1', null, '{\"img0\":\"h_200x112 (51).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1052', '1', null, '{\"img0\":\"h_200x112 (52).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1053', '1', null, '{\"img0\":\"h_200x112 (53).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1054', '1', null, '{\"img0\":\"h_200x112 (54).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1055', '1', null, '{\"img0\":\"h_200x112 (55).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1056', '1', null, '{\"img0\":\"h_200x112 (56).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1057', '1', null, '{\"img0\":\"h_200x112 (57).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1058', '1', null, '{\"img0\":\"h_200x112 (58).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1059', '1', null, '{\"img0\":\"h_200x112 (59).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1060', '1', null, '{\"img0\":\"h_200x112 (60).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1061', '1', null, '{\"img0\":\"h_200x112 (61).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1062', '1', null, '{\"img0\":\"h_200x112 (62).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1063', '1', null, '{\"img0\":\"h_200x112 (63).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1064', '1', null, '{\"img0\":\"h_200x112 (64).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1065', '1', null, '{\"img0\":\"h_200x112 (65).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1066', '1', null, '{\"img0\":\"h_200x112 (66).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1067', '1', null, '{\"img0\":\"h_200x112 (67).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1068', '1', null, '{\"img0\":\"h_200x112 (68).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1069', '1', null, '{\"img0\":\"h_200x112 (69).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1070', '1', null, '{\"img0\":\"h_200x112 (70).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1071', '1', null, '{\"img0\":\"h_200x112 (71).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1072', '1', null, '{\"img0\":\"h_200x112 (72).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1073', '1', null, '{\"img0\":\"h_200x112 (73).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1074', '1', null, '{\"img0\":\"h_200x112 (74).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1075', '1', null, '{\"img0\":\"h_200x112 (75).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1076', '1', null, '{\"img0\":\"h_200x112 (76).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1077', '1', null, '{\"img0\":\"h_200x112 (77).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1078', '1', null, '{\"img0\":\"h_200x112 (78).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1079', '1', null, '{\"img0\":\"h_200x112 (79).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1080', '1', null, '{\"img0\":\"h_200x112 (80).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1081', '1', null, '{\"img0\":\"h_200x112 (81).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1082', '1', null, '{\"img0\":\"h_200x112 (82).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1083', '1', null, '{\"img0\":\"h_200x112 (83).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1084', '1', null, '{\"img0\":\"h_200x112 (84).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1085', '1', null, '{\"img0\":\"h_200x112 (85).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1086', '1', null, '{\"img0\":\"h_200x112 (86).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1087', '1', null, '{\"img0\":\"h_200x112 (87).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1088', '1', null, '{\"img0\":\"h_200x112 (88).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1089', '1', null, '{\"img0\":\"h_200x112 (89).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1090', '1', null, '{\"img0\":\"h_200x112 (90).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1091', '1', null, '{\"img0\":\"h_200x112 (91).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1092', '1', null, '{\"img0\":\"h_200x112 (92).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1093', '1', null, '{\"img0\":\"h_200x112 (93).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1094', '1', null, '{\"img0\":\"h_200x112 (94).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1095', '1', null, '{\"img0\":\"h_200x112 (95).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1096', '1', null, '{\"img0\":\"h_200x112 (96).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1097', '1', null, '{\"img0\":\"h_200x112 (97).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1098', '1', null, '{\"img0\":\"h_200x112 (98).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1099', '1', null, '{\"img0\":\"h_200x112 (99).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1100', '1', null, '{\"img0\":\"h_200x112 (100).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1101', '1', null, '{\"img0\":\"h_200x112 (101).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1102', '1', null, '{\"img0\":\"h_200x112 (102).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1103', '1', null, '{\"img0\":\"h_200x112 (103).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1104', '1', null, '{\"img0\":\"h_200x112 (104).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1105', '1', null, '{\"img0\":\"h_200x112 (105).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1106', '1', null, '{\"img0\":\"h_200x112 (106).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1107', '1', null, '{\"img0\":\"h_200x112 (107).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1108', '1', null, '{\"img0\":\"h_200x112 (108).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1109', '1', null, '{\"img0\":\"h_200x112 (109).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1110', '1', null, '{\"img0\":\"h_200x112 (110).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1111', '1', null, '{\"img0\":\"h_200x112 (111).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1112', '1', null, '{\"img0\":\"h_200x112 (112).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1113', '1', null, '{\"img0\":\"h_200x112 (113).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1114', '1', null, '{\"img0\":\"h_200x112 (114).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1115', '1', null, '{\"img0\":\"h_200x112 (115).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1116', '1', null, '{\"img0\":\"h_200x112 (116).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1117', '1', null, '{\"img0\":\"h_200x112 (117).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1118', '1', null, '{\"img0\":\"h_200x112 (118).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1119', '1', null, '{\"img0\":\"h_200x112 (119).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1120', '1', null, '{\"img0\":\"h_200x112 (120).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1121', '1', null, '{\"img0\":\"h_200x112 (121).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1122', '1', null, '{\"img0\":\"h_200x112 (122).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1123', '1', null, '{\"img0\":\"h_200x112 (123).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('1124', '1', null, '{\"img0\":\"h_200x112 (124).jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2001', '1', '2005', '{\"img0\":\"1hot/1.jpg,1hot/1.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2002', '1', '1001', '{\"img0\":\"1hot/2.jpg,1hot/2.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2003', '1', '2014', '{\"img0\":\"1hot/3.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2004', '1', '2015', '{\"img0\":\"1hot/4.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2005', '1', '2011', '{\"img0\":\"1hot/5.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2006', '1', '2013', '{\"img0\":\"1hot/6.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2007', '1', '2021', '{\"img0\":\"2kong/1.jpg,2kong/1.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2008', '1', '2020', '{\"img0\":\"2kong/2.jpg,2kong/2.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2009', '1', '2003', '{\"img0\":\"2kong/3.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2010', '1', '2004', '{\"img0\":\"2kong/4.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2011', '1', '2002', '{\"img0\":\"2kong/5.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2012', '1', '2009', '{\"img0\":\"2kong/6.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2013', '1', '1001', '{\"img0\":\"3gan/1.jpg,3gan/1.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2014', '1', '1008', '{\"img0\":\"3gan/2.jpg,3gan/2.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2015', '1', '1010', '{\"img0\":\"3gan/3.jpg,3gan/3.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2016', '1', '1011', '{\"img0\":\"3gan/4.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2017', '1', '2005', '{\"img0\":\"3gan/5.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2018', '1', '2010', '{\"img0\":\"3gan/6.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2019', '1', '2011', '{\"img0\":\"3gan/7.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2020', '1', '2012', '{\"img0\":\"3gan/8.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2021', '1', '2013', '{\"img0\":\"3gan/9.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2022', '1', '2014', '{\"img0\":\"3gan/10.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2023', '1', '2015', '{\"img0\":\"3gan/11.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2024', '1', '2017', '{\"img0\":\"3gan/11.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2025', '1', '1004', '{\"img0\":\"3gan/11.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('2026', '1', '2009', '{\"img0\":\"3gan/11.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10001', '2', '1', '{\"img0\":\"4shop/1.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10002', '2', '2', '{\"img0\":\"4shop/2.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10003', '2', '7', '{\"img0\":\"4shop/3.jpg,4shop/3.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10004', '2', '8', '{\"img0\":\"4shop/4.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10005', '2', '9', '{\"img0\":\"4shop/5.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10006', '2', '6', '{\"img0\":\"4shop/6.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10007', '2', '5', '{\"img0\":\"4shop/7.jpg\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10008', '2', '4', '{\"img0\":\"4shop/8.jpg,4shop/8.png\"}', null, null);
INSERT INTO `tdc_item_infos` VALUES ('10009', '2', '3', '{\"img0\":\"4shop/9.jpg,4shop/9.png\"}', null, null);
