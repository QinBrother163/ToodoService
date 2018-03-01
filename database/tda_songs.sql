/*
Navicat MySQL Data Transfer

Source Server         : 阿里云.toodo
Source Server Version : 50173
Source Host           : 120.25.107.206:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-08-16 09:46:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tda_songs
-- ----------------------------
DROP TABLE IF EXISTS `tda_songs`;
CREATE TABLE `tda_songs` (
  `songId` int(10) unsigned NOT NULL,
  `category` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `singer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `long` int(11) NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `fresh` tinyint(1) NOT NULL,
  `suggest` tinyint(1) NOT NULL,
  `rhythm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `verify` tinyint(1) NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `score` int(11) NOT NULL,
  `mvUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`songId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tda_songs
-- ----------------------------
INSERT INTO `tda_songs` VALUES ('10011', '1', '一闪一闪亮晶晶', '小蓓蕾组合', '98000', '1', '1', '0', '10011.json', '0', '2', '1', '10086', '0', '10011.mp4');
INSERT INTO `tda_songs` VALUES ('10016', '1', '小螺号', '小蓓蕾组合', '99000', '1', '1', '0', '10016.json', '2', '2', '1', '10086', '0', '10016.mp4');
INSERT INTO `tda_songs` VALUES ('10017', '1', '读书郎', '小蓓蕾组合', '98000', '0', '1', '0', '10017.json', '1', '2', '1', '10086', '0', '10017.mp4');
INSERT INTO `tda_songs` VALUES ('10018', '1', '采蘑菇的小姑娘', '小蓓蕾组合', '98000', '0', '1', '0', '10018.json', '1', '2', '1', '10086', '0', '10018.mp4');
INSERT INTO `tda_songs` VALUES ('20001', '2', '不如跳舞', '陈慧琳', '115000', '1', '1', '0', '20001.json', '1', '2', '1', '10086', '0', '20001.mp4');
INSERT INTO `tda_songs` VALUES ('20002', '2', '夜曲', '周杰伦', '122000', '0', '1', '0', '20002.json', '1', '2', '1', '10086', '0', '20002.mp4');
INSERT INTO `tda_songs` VALUES ('20003', '2', 'Miracle', 'Cascada', '61000', '1', '1', '0', '20003.json', '0', '2', '1', '10086', '0', '20003.mp4');
INSERT INTO `tda_songs` VALUES ('20004', '2', '对面的女孩看过来', '任贤齐', '108000', '0', '1', '0', '20004.json', '1', '2', '1', '10086', '0', '20004.mp4');
INSERT INTO `tda_songs` VALUES ('20005', '2', '江南', '林俊杰', '134000', '1', '1', '0', '20005.json', '0', '2', '1', '10086', '0', '20005.mp4');
INSERT INTO `tda_songs` VALUES ('20006', '2', '桃花朵朵开', '阿牛', '94000', '0', '1', '0', '20006.json', '1', '2', '1', '10086', '0', '20006.mp4');
INSERT INTO `tda_songs` VALUES ('20007', '2', 'Everytime we touch', 'Cascada', '111000', '1', '1', '0', '20007.json', '1', '2', '1', '10086', '0', '20007.mp4');
INSERT INTO `tda_songs` VALUES ('20008', '2', '自由飞翔', '群星', '122000', '1', '1', '0', '20008.json', '0', '2', '1', '10086', '0', '20008.mp4');
INSERT INTO `tda_songs` VALUES ('20009', '2', '不得不爱', '潘玮柏', '162000', '0', '1', '0', '20009.json', '0', '2', '1', '10086', '0', '20009.mp4');
INSERT INTO `tda_songs` VALUES ('20010', '2', 'Butterfly', 'Smile.DK', '120000', '1', '1', '0', '20010.json', '2', '2', '1', '10086', '0', '20010.mp4');
INSERT INTO `tda_songs` VALUES ('20011', '2', '王妃', '萧敬腾', '99000', '1', '1', '0', '20011.json', '1', '2', '1', '10086', '0', '20011.mp4');
INSERT INTO `tda_songs` VALUES ('20012', '2', '舞娘', '蔡依林', '125000', '1', '1', '0', '20012.json', '1', '2', '1', '10086', '0', '20012.mp4');
INSERT INTO `tda_songs` VALUES ('20013', '2', '听妈妈的话', '周杰伦', '174000', '0', '1', '0', '20013.json', '2', '2', '1', '10086', '0', '20013.mp4');
INSERT INTO `tda_songs` VALUES ('20014', '2', '我不是黄蓉', '王蓉', '115000', '1', '1', '0', '20014.json', '2', '2', '1', '10086', '0', '20014.mp4');
INSERT INTO `tda_songs` VALUES ('20015', '2', 'How do you do', 'Befour', '158000', '0', '1', '0', '20015.json', '2', '2', '1', '10086', '0', '20015.mp4');
INSERT INTO `tda_songs` VALUES ('20016', '2', 'no body', 'Wonder Girls', '114000', '0', '1', '0', '20016.json', '0', '2', '1', '10086', '0', '20016.mp4');
INSERT INTO `tda_songs` VALUES ('20017', '2', 'the magic key', 'Various Artists', '120000', '1', '1', '0', '20017.json', '1', '2', '1', '10086', '0', '20017.mp4');
INSERT INTO `tda_songs` VALUES ('20018', '2', '姐姐妹妹站起来', '陶晶莹', '150000', '0', '1', '0', '20018.json', '2', '2', '1', '10086', '0', '20018.mp4');
INSERT INTO `tda_songs` VALUES ('20019', '2', 'sound of my dream', 'Cody Simpson', '118000', '0', '1', '0', '20019.json', '0', '2', '1', '10086', '0', '20019.mp4');
INSERT INTO `tda_songs` VALUES ('20020', '2', 'boom boom dollar', 'V.A.', '138000', '1', '1', '0', '20020.json', '1', '2', '1', '10086', '0', '20020.mp4');
INSERT INTO `tda_songs` VALUES ('20021', '2', '你若成风', '许嵩', '130000', '0', '1', '0', '20021.json', '1', '2', '1', '10086', '0', '20021.mp4');
INSERT INTO `tda_songs` VALUES ('20058', '2', 'Why So Lonely', 'Wonder Girls', '121000', '1', '1', '0', '20058.json', '2', '2', '1', '10086', '0', '20058.mp4');
INSERT INTO `tda_songs` VALUES ('20059', '2', '黏黏糊糊', 'Hello Venus', '121000', '1', '1', '0', '20059.json', '2', '2', '1', '10086', '0', '20059.mp4');
INSERT INTO `tda_songs` VALUES ('30001', '3', '最炫民族风', '凤凰传奇', '113000', '1', '1', '0', '30001.json', '0', '2', '1', '10086', '0', '30001.mp4');
INSERT INTO `tda_songs` VALUES ('30002', '3', '大声唱', '凤凰传奇', '122000', '1', '1', '0', '30002.json', '2', '2', '1', '10086', '0', '30002.mp4');
INSERT INTO `tda_songs` VALUES ('30003', '3', '小苹果', '筷子兄弟', '97000', '0', '1', '0', '30003.json', '1', '2', '1', '10086', '0', '30003.mp4');
INSERT INTO `tda_songs` VALUES ('30004', '3', '美了美了', '小沈阳、汤潮', '119000', '0', '1', '0', '30004.json', '1', '1', '1', '10086', '0', '30004.mp4');
INSERT INTO `tda_songs` VALUES ('30005', '3', '溜溜的情歌', '凤凰传奇', '124000', '1', '1', '0', '30005.json', '2', '1', '1', '10086', '0', '30005.mp4');
INSERT INTO `tda_songs` VALUES ('30006', '3', '自由飞翔', '凤凰传奇', '122000', '1', '1', '0', '30006.json', '2', '1', '1', '10086', '0', '30006.mp4');
INSERT INTO `tda_songs` VALUES ('30007', '3', '坐上火车去拉萨', '徐千雅', '106000', '1', '1', '0', '30007.json', '2', '1', '1', '10086', '0', '30007.mp4');
INSERT INTO `tda_songs` VALUES ('30008', '3', '荷塘月色', '凤凰传奇', '155000', '1', '1', '0', '30008.json', '2', '1', '1', '10086', '0', '30008.mp4');
INSERT INTO `tda_songs` VALUES ('30009', '3', '老婆最大', '崔子格、老猫', '113000', '1', '1', '0', '30009.json', '2', '1', '1', '10086', '0', '30009.mp4');
INSERT INTO `tda_songs` VALUES ('30010', '3', '春夏秋冬都是爱', '胥拉齐', '121000', '1', '1', '0', '30010.json', '2', '1', '1', '10086', '0', '30010.mp4');
INSERT INTO `tda_songs` VALUES ('90001', '0', '我不是黄蓉', '王蓉', '115000', '1', '1', '0', '20014.json', '2', '2', '1', '10086', '0', '20014.mp4');
INSERT INTO `tda_songs` VALUES ('90002', '0', '姐姐妹妹站起来', '陶晶莹', '150000', '0', '1', '0', '20018.json', '2', '2', '1', '10086', '0', '20018.mp4');
INSERT INTO `tda_songs` VALUES ('90003', '0', '你若成风', '许嵩', '130000', '0', '1', '0', '20021.json', '2', '2', '1', '10086', '0', '20021.mp4');
INSERT INTO `tda_songs` VALUES ('90004', '0', 'boom boom dollar', 'V.A.', '138000', '1', '1', '0', '20020.json', '2', '2', '1', '10086', '0', '20020.mp4');
INSERT INTO `tda_songs` VALUES ('90005', '0', '小苹果', '筷子兄弟', '97000', '0', '1', '0', '30003.json', '2', '2', '1', '10086', '0', '30003.mp4');
INSERT INTO `tda_songs` VALUES ('90006', '0', '最炫民族风', '凤凰传奇', '113000', '1', '1', '0', '30001.json', '2', '2', '1', '10086', '0', '30001.mp4');
INSERT INTO `tda_songs` VALUES ('90007', '0', '美了美了', '小沈阳、汤潮', '119000', '0', '1', '0', '30004.json', '2', '1', '1', '10086', '0', '30004.mp4');
INSERT INTO `tda_songs` VALUES ('90008', '0', '荷塘月色', '凤凰传奇', '155000', '1', '1', '0', '30008.json', '2', '1', '1', '10086', '0', '30008.mp4');
INSERT INTO `tda_songs` VALUES ('90009', '0', 'sound of my dream', 'Cody Simpson', '118000', '0', '1', '0', '20019.json', '2', '2', '1', '10086', '0', '20019.mp4');
INSERT INTO `tda_songs` VALUES ('90010', '0', 'the magic key', 'Various Artists', '120000', '1', '1', '0', '20017.json', '2', '2', '1', '10086', '0', '20017.mp4');
