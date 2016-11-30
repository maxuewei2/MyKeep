/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50716
Source Host           : localhost:3306
Source Database       : keep

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2016-11-30 18:07:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `setting_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `setting_content` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`setting_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `task_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `task_content` varchar(1024) COLLATE utf8_bin NOT NULL DEFAULT '',
  `task_add_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `task_done` char(1) CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
SET FOREIGN_KEY_CHECKS=1;
