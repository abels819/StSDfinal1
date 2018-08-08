/*
Navicat MySQL Data Transfer

Source Server         : chgfv.com
Source Server Version : 80000
Source Host           : localhost:3306
Source Database       : stsd

Target Server Type    : MYSQL
Target Server Version : 80000
File Encoding         : 65001

Date: 2018-08-08 10:23:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `arrivals`
-- ----------------------------
DROP TABLE IF EXISTS `arrivals`;
CREATE TABLE `arrivals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `studentid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of arrivals
-- ----------------------------
INSERT INTO `arrivals` VALUES ('3', '2018-07-23', '3208');
INSERT INTO `arrivals` VALUES ('4', '2018-08-01', '3208');

-- ----------------------------
-- Table structure for `manager`
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `studentid` int(225) NOT NULL,
  `paystatus` varchar(255) NOT NULL,
  `paied` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '2018-07-24', '2018-07-24', '1_E', '2', '1', 'cash', '1');
INSERT INTO `orders` VALUES ('2', '2018-12-02', '2019-01-02', 'M_G', '0', '1', 'alipay', '1');
INSERT INTO `orders` VALUES ('4', '2018-07-23', '2018-08-23', 'M_G', '1', '1', 'alipay', '1');
INSERT INTO `orders` VALUES ('5', '2018-07-23', '2018-07-23', '1_G', '2', '1', 'alipay', '1');
INSERT INTO `orders` VALUES ('6', '2017-04-01', '2017-05-01', 'M_G', '2', '1', 'alipay', '1');

-- ----------------------------
-- Table structure for `order_type`
-- ----------------------------
DROP TABLE IF EXISTS `order_type`;
CREATE TABLE `order_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period` varchar(255) NOT NULL,
  `name_en` varchar(225) NOT NULL,
  `name_ch` varchar(255) NOT NULL,
  `price` float DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_type
-- ----------------------------
INSERT INTO `order_type` VALUES ('1', 'D', 'experiencing', '单节体验课', '20', '1_E');
INSERT INTO `order_type` VALUES ('2', 'D', 'single grouped course', '单节集体课', '45', '1_G');
INSERT INTO `order_type` VALUES ('3', 'M', 'every courses for one month', '月度无限卡', '490', 'M_G');
INSERT INTO `order_type` VALUES ('4', 'T', 'every courses for one term', '本学期无限卡', '1500', 'T_G');
INSERT INTO `order_type` VALUES ('5', 'D', 'private lesson for one hour', '一小时私教', '200', '1_P');

-- ----------------------------
-- Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `lisence` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `status` int(8) NOT NULL DEFAULT '1',
  `lessons_count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', '3208', 'su', '1', '6');
INSERT INTO `student` VALUES ('2', '32088', 'su', '1', '0');
