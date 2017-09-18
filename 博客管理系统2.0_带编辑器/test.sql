/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2017-09-18 09:37:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8 DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('2', '123', '123');
INSERT INTO `admin` VALUES ('10', '111', '111');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `author` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `content` text CHARACTER SET utf8,
  `time` int(11) DEFAULT NULL,
  `uptime` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of page
-- ----------------------------
