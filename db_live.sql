/*
Navicat MySQL Data Transfer

Source Server         : �Լ�
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : db_live

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-12-27 23:57:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(15) DEFAULT NULL,
  `update_time` int(15) DEFAULT NULL,
  `delete_time` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('25', 'z130322112', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `admin_user` VALUES ('26', 'z1303221123', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `admin_user` VALUES ('27', 'z13032211243', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `admin_user` VALUES ('28', 'z1303221243', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `admin_user` VALUES ('29', 'z1303221245', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `admin_user` VALUES ('30', 'z1303221246', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `admin_user` VALUES ('31', 'z13032216', '410c8ad555afff1bea134c36e72eafc1', '1607675758', '1607675758', null);
INSERT INTO `admin_user` VALUES ('32', 'z130322178', 'e81342f7154f97b88f59cff055a14746', '1607675797', '1607675797', null);
INSERT INTO `admin_user` VALUES ('33', 'z13035341', 'e81342f7154f97b88f59cff055a14746', '1607675896', '1607675896', null);

-- ----------------------------
-- Table structure for `live`
-- ----------------------------
DROP TABLE IF EXISTS `live`;
CREATE TABLE `live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(15) DEFAULT NULL,
  `update_time` int(15) DEFAULT NULL,
  `delete_time` int(15) DEFAULT NULL,
  `state` int(2) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of live
-- ----------------------------
INSERT INTO `live` VALUES ('1', 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8', '1608026545', '1608132686', null, '0', '直播间', '<h1><strong class=\"ql-size-large\" style=\"color: rgb(230, 0, 0);\">测试</strong></h1><p><img src=\"https://www.baidu.com/img/fddong_e2dd633ee46695630e60156c91cda80a.gif\"></p>', '1');
INSERT INTO `live` VALUES ('2', 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8', '1608026556', '1608036574', null, '0', '直播间', '<p>直播测试<img src=\"https://www.showdoc.com.cn/server/api/attachment/visitfile/sign/06a1da77bd4544e380c8e77f35ef5f1e\"></p>', '1');

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `room_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', 'z13035341', '1', '123', '1608026776');
INSERT INTO `message` VALUES ('2', 'a123456', '1', '哈哈哈', '1608130735');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` int(15) DEFAULT NULL,
  `update_time` int(15) DEFAULT NULL,
  `delete_time` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('25', 'z130322112', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `user` VALUES ('26', 'z1303221123', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `user` VALUES ('27', 'z13032211243', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `user` VALUES ('28', 'z1303221243', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `user` VALUES ('29', 'z1303221245', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `user` VALUES ('30', 'z1303221246', '410c8ad555afff1bea134c36e72eafc1', null, null, null);
INSERT INTO `user` VALUES ('31', 'z13032216', '410c8ad555afff1bea134c36e72eafc1', '1607675758', '1607675758', null);
INSERT INTO `user` VALUES ('32', 'z130322178', 'e81342f7154f97b88f59cff055a14746', '1607675797', '1607675797', null);
INSERT INTO `user` VALUES ('33', 'z13035341', 'e81342f7154f97b88f59cff055a14746', '1607675896', '1607675896', null);
INSERT INTO `user` VALUES ('34', 'a123456', '874ccce2d09438a23cb53669bea15e28', '1608130477', '1608130477', null);
INSERT INTO `user` VALUES ('35', 'z130353412', 'e81342f7154f97b88f59cff055a14746', '1608986432', '1608986432', null);
