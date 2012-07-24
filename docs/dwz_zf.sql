/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50515
Source Host           : 127.0.0.1:3306
Source Database       : dwz_zf

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2012-07-24 13:38:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dwz_acl_resources`
-- ----------------------------
DROP TABLE IF EXISTS `dwz_acl_resources`;
CREATE TABLE `dwz_acl_resources` (
  `r_id` int(10) NOT NULL AUTO_INCREMENT,
  `r_model` varchar(100) NOT NULL,
  `r_controller` varchar(100) NOT NULL,
  `r_action` varchar(100) NOT NULL,
  `r_name` varchar(200) DEFAULT '',
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源表-存储所有的Resources';

-- ----------------------------
-- Records of dwz_acl_resources
-- ----------------------------

-- ----------------------------
-- Table structure for `dwz_acl_role`
-- ----------------------------
DROP TABLE IF EXISTS `dwz_acl_role`;
CREATE TABLE `dwz_acl_role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(200) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色表-存储所有的角色';

-- ----------------------------
-- Records of dwz_acl_role
-- ----------------------------

-- ----------------------------
-- Table structure for `dwz_acl_role_privilege`
-- ----------------------------
DROP TABLE IF EXISTS `dwz_acl_role_privilege`;
CREATE TABLE `dwz_acl_role_privilege` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `acl_role_id` int(10) NOT NULL,
  `cl_resource_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色拥有资源表-将对应的角色拥有对应的Resources存入';

-- ----------------------------
-- Records of dwz_acl_role_privilege
-- ----------------------------

-- ----------------------------
-- Table structure for `dwz_keywords`
-- ----------------------------
DROP TABLE IF EXISTS `dwz_keywords`;
CREATE TABLE `dwz_keywords` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) DEFAULT NULL COMMENT '编号',
  `name` varchar(45) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '标签类型\n1:标签分类\n2:取值标签\n3:匹配标签\n',
  `status` int(11) DEFAULT '1' COMMENT '状态:\n1-活动\n2-暂停使用',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级关联标签',
  `description` varchar(2000) DEFAULT NULL COMMENT '描述',
  `is_delete` int(11) DEFAULT '0' COMMENT '0:未删除\n1:已删除',
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(15) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
-- Records of dwz_keywords
-- ----------------------------
INSERT INTO `dwz_keywords` VALUES ('2', '1', '张慧华1', null, '1', null, 'asdf', '0', null, null, null, null);
INSERT INTO `dwz_keywords` VALUES ('3', '2', 'test', null, '1', null, '2', '0', null, null, null, null);
INSERT INTO `dwz_keywords` VALUES ('4', '3', '张慧华3', null, '1', null, '3', '0', null, null, null, null);
INSERT INTO `dwz_keywords` VALUES ('5', '4', '4', null, '1', null, '4', '0', null, null, null, null);
INSERT INTO `dwz_keywords` VALUES ('6', '5', '5', null, '1', null, '5', '0', null, null, null, null);
INSERT INTO `dwz_keywords` VALUES ('7', '6', '6', null, '1', null, '6', '0', null, null, null, null);
INSERT INTO `dwz_keywords` VALUES ('8', '7', '7', null, '1', null, '7', '0', null, null, null, null);

-- ----------------------------
-- Table structure for `dwz_log`
-- ----------------------------
DROP TABLE IF EXISTS `dwz_log`;
CREATE TABLE `dwz_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL COMMENT '操作描述',
  `detail` text COMMENT '操作记录',
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志表';

-- ----------------------------
-- Records of dwz_log
-- ----------------------------

-- ----------------------------
-- Table structure for `dwz_user`
-- ----------------------------
DROP TABLE IF EXISTS `dwz_user`;
CREATE TABLE `dwz_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) DEFAULT NULL COMMENT '用户名',
  `name` varchar(45) DEFAULT NULL COMMENT '姓名',
  `password` varchar(45) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL COMMENT '1-男\n2-女',
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '状态:\n1-活动\n2-暂停使用',
  `address` varchar(2000) DEFAULT NULL COMMENT '地址',
  `is_delete` int(11) DEFAULT '0' COMMENT '0:未删除\n1:已删除',
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(15) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_user` varchar(15) DEFAULT NULL,
  `role_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of dwz_user
-- ----------------------------
