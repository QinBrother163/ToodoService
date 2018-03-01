/*
Navicat MySQL Data Transfer

Source Server         : 阿里云.toodo
Source Server Version : 50173
Source Host           : 120.25.107.206:3306
Source Database       : toodo_service

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-09-27 19:55:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for edo_game_infos
-- ----------------------------
DROP TABLE IF EXISTS `edo_game_infos`;
CREATE TABLE `edo_game_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gameId` int(11) NOT NULL COMMENT '游戏编号',
  `gameName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '游戏名称',
  `gameNameCn` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '中文名',
  `gameDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '游戏简介',
  `gameType` int(11) NOT NULL COMMENT '"游戏类型',
  `packageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'java包名',
  `versionCode` int(11) NOT NULL COMMENT '版本号',
  `gameUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '主程序文件',
  `gameVersion` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'bin版本',
  `gameSize` int(11) NOT NULL COMMENT 'bin大小/kb',
  `resUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '资源地址',
  `resVersion` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'res版本',
  `resSize` int(11) NOT NULL COMMENT 'res大小/kb',
  `updateTime` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of edo_game_infos
-- ----------------------------
INSERT INTO `edo_game_infos` VALUES ('1', '1001', 'balce', '波斯迷城', '悬空的场景、各式各样的机关、逼真的物理系统、细腻的操作手感，共同构成了这款既考验玩家操作细腻度又考验玩家智力的趣味游戏。', '0', '', '1', 'balce_bin.zip', '1.1.2', '5000', 'balce_res.zip', '1.1.2', '61046', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('2', '1004', 'disc', '趣味飞盘', '扔飞盘是一款基于体感操作的3D游戏。玩家利用手柄做出挥甩动作，将飞盘掷出后，小狗追及飞盘，如到达目标区域，小狗可以接到，如无法到达目标区域，则小狗无法接到。', '0', '', '1', 'disc_bin.zip', '1.1.2', '5000', 'disc_res.zip', '1.1.2', '74340', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('3', '1008', 'newrunner_h', '时尚跑酷', '时尚跑酷是一款横版动作闯关游戏。玩家作为一个跑酷运动者在游戏世界中进行冒险，可以使用跳跃、滚动、飞行等技能，跨过面前的一切障碍，吃掉在各个场景中的金币，一路狂奔到关底。', '0', '', '1', 'newrunner_h_bin.zip', '1.1.2', '5000', 'newrunner_h_res.zip', '1.1.2', '106858', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('4', '1010', 'snake', '贪吃蛇', '再现经典游戏贪吃蛇的3D版本，精美的太空背景、添加了道具的新玩法。', '0', '', '1', 'snake_bin.zip', '1.1.2', '5000', 'snake_res.zip', '1.1.2', '15522', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('5', '1011', 'golf', '高尔夫之旅', '你见过第十八洞吗？和小伙伴们十八洞之后，开个座谈会吧。', '1', 'com.toodo.golf2', '1', 'golf.apk', '1.1.2', '100000', '', '', '0', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('6', '1013', 'newbadmin', '羽毛球', '一款体育运动类游戏，3D视觉，精美的画面，流畅的动作，让你足不出户也能体验一把真实的羽毛球赛事。', '0', '', '1', 'newbadmin_bin.zip', '1.1.2', '5000', 'newbadmin_res.zip', '1.1.2', '76781', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('7', '2001', 'coolbird', '酷呆鸟', '酷呆鸟，游戏中玩家控制一只小鸟，跨越由各种不同组合的木箱所组成的障碍，而这只鸟其实是根本不会飞的……所以玩家每按一下“确定”键小鸟就会飞高一点，不按就会下降，玩家必须控制节奏，拿捏按“确定”键的时间点，让小鸟能在落下的瞬间跳起来，恰好能够通过狭窄的障碍墙缺口，只要稍一分神，马上就会失败阵亡。', '0', '', '1', 'coolbird_bin.zip', '1.1.2', '5000', 'coolbird_res.zip', '1.1.2', '26210', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('8', '2002', 'airshow', '飞行表演', '技术高超的飞行员，驾驶着喷气式飞机穿梭于各种障碍之间，为玩家上演一场激情四射的视觉盛宴。', '0', '', '1', 'airshow_bin.zip', '1.1.2', '5000', 'airshow_res.zip', '1.1.2', '29752', '2017-03-09 13:45:00');
INSERT INTO `edo_game_infos` VALUES ('9', '2003', 'bloxorz', '天空迷阵', '一款休闲益智游戏，精美的高清画面，游戏非常锻炼玩家逻辑思维能力。', '0', '', '1', 'bloxorz_bin.zip', '1.1.2', '5000', 'bloxorz_res.zip', '1.1.2', '68889', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('10', '2004', 'bricks', '接积木', '用有趣的体感的方式接取掉落的积木，玩法和操作非常容易上手，游戏需要动脑和动手互相结合，适合全年龄玩家。', '0', '', '1', 'bricks_bin.zip', '1.1.2', '5000', 'bricks_res.zip', '1.1.2', '98412', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('11', '2005', 'cattle', '骑牛', '竞速类游戏，玩家控制滑稽的牛仔限定时间内冲刺终点，在撞到得分稻草人获得高分的同时，也要躲避栏杆阻碍。', '0', '', '1', 'cattle_bin.zip', '1.1.2', '5000', 'cattle_res.zip', '1.1.2', '200385', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('12', '2009', 'footballnet', '足球', '以世界杯为主题，玩家可操控世界上最强的10只球队中的知名代表球员，足不出户就能体验世界杯的欢乐与激情。Q版卡通风格，逼真的效果，诙谐风趣的恶搞元素，一定让你爱不释手。\n', '0', '', '1', 'footballnet_bin.zip', '1.1.2', '5000', 'footballnet_res.zip', '1.1.2', '129618', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('13', '2010', 'newarchery', '新射箭', '《射箭比赛》是一款体育类游戏。玩家充分考虑风力和距离影响，进行射箭运动。游戏场景清新优美，操作手感紧凑快捷，更有强力道具来相助。游戏采用健康的体感操作，简简单单就能给您带来百步穿杨的感觉！', '0', '', '1', 'newarchery_bin.zip', '1.1.2', '5000', 'newarchery_res.zip', '1.1.2', '75569', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('14', '2011', 'newtennis', '世界网球', '《世界网球》是一款体感操作的体育游戏。游戏有着流畅的手感，精彩刺激的对战和联赛模式。游戏还提供了角色培养模式和多种强力的道具，玩家可以根据自己的喜好自由选择.\n', '0', '', '1', 'newtennis_bin.zip', '1.1.2', '5000', 'newtennis_res.zip', '1.1.2', '130813', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('15', '2012', 'piggy', '猪猪冒险之旅', 'Q版可爱的角色形象，简单易懂的体感操作，诙谐搞笑的小游戏。', '0', '', '1', 'piggy_bin.zip', '1.1.2', '5000', 'piggy_res.zip', '1.1.2', '100305', '2017-03-09 13:45:00');
INSERT INTO `edo_game_infos` VALUES ('16', '2013', 'ppong3', '乒乓3', '模拟真实的乒乓球体感运动游戏，简单易懂的操作，精美的画面与刺激比赛气氛，足不出户即可体验激动人心的乒乓球比赛，还可以自己培养角色，与其他玩家一争高下，最后夺得冠军。', '0', '', '1', 'ppong3_bin.zip', '1.1.2', '5000', 'ppong3_res.zip', '1.1.2', '151048', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('17', '2014', 'rotatepipe', '水管转转转', '搞怪的角色形像，简单的操作，轻松愉快的一款小游戏。\n', '0', '', '1', 'rotatepipe_bin.zip', '1.1.2', '5000', 'rotatepipe_res.zip', '1.1.2', '42096', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('18', '2015', 'shooting', '休闲射击', '休闲射击是一款高清级别画面的射击游戏，游戏画面精致，卡通形象细腻可爱，准星光标移动自然流畅，射击手感紧凑快捷。', '0', '', '1', 'shooting_bin.zip', '1.1.2', '5000', 'shooting_res.zip', '1.1.2', '73667', '2016-11-22 14:10:00');
INSERT INTO `edo_game_infos` VALUES ('19', '2017', 'newmission', '特种兵', '经典怀旧的动作射击类游戏，采用传统的横版过关模式，在限定的时间内消灭敌人通过关卡，最后击败boss。游戏中有各种各样的敌人登场，配合各种地形场景，会使游戏变得非常有挑战性。8个方向的自由射击，火力全面而且强大的各种武器，更有大威力的抛物线手雷，还有攻速极快的近身匕首。游戏中还可以购买各种更强大的武器。', '0', '', '1', 'newmission_bin.zip', '1.1.2', '5000', 'newmission_res.zip', '1.1.2', '101920', '2017-03-09 13:45:00');
INSERT INTO `edo_game_infos` VALUES ('20', '2018', 'Nima', '找尼玛', '找尼玛是一款结合了传统的找茬系列元素和经典的角色扮演系列元素的游戏。拥有风趣幽默的故事情节，诙谐搞笑的画面，包含丰富的游戏模式以及道具系统，操作简单，易于上手。', '0', '', '1', 'Nima_bin.zip', '1.1.2', '5000', 'Nima_res.zip', '1.1.2', '72303', '2017-03-09 13:45:00');
INSERT INTO `edo_game_infos` VALUES ('21', '2019', 'clearup', '连连看', '一款消除类型游戏，游戏采用时尚的水晶质感为主题，配以圆角的卡通风格。', '0', '', '1', 'clearup_bin.zip', '1.1.2', '5000', 'clearup_res.zip', '1.1.2', '17107', '2017-03-04 10:32:00');
INSERT INTO `edo_game_infos` VALUES ('22', '2020', 'diamond', '宝石', '一款解谜益智类游戏。玩家需要不断消除头顶的宝石，达到一定分数后即可通关。', '0', '', '1', 'diamond_bin.zip', '1.1.2', '5000', 'diamond_res.zip', '1.1.2', '14975', '2017-03-04 10:32:00');
INSERT INTO `edo_game_infos` VALUES ('23', '2021', 'magicjad', '魔幻球', '一款休闲益智类游戏。玩家需要不断发射珠子到相同颜色的队列中，然后消除它他，达到一定分数后即可通关。', '0', '', '1', 'magicjad_bin.zip', '1.1.2', '5000', 'magicjad_res.zip', '1.1.2', '29506', '2017-03-04 10:32:00');
