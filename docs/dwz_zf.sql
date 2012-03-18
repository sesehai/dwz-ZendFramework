-- MySQL dump 10.11
--
-- Host: localhost    Database: dwz_zf
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dp_keywords`
--

DROP TABLE IF EXISTS `dp_keywords`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dp_keywords` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `code` varchar(15) default NULL COMMENT '编号',
  `name` varchar(45) default NULL,
  `type` int(11) default NULL COMMENT '标签类型\n1:标签分类\n2:取值标签\n3:匹配标签\n',
  `status` int(11) default '1' COMMENT '状态:\n1-活动\n2-暂停使用',
  `parent_id` int(11) default NULL COMMENT '上级关联标签',
  `description` varchar(2000) default NULL COMMENT '描述',
  `is_delete` int(11) default '0' COMMENT '0:未删除\n1:已删除',
  `created_date` datetime default NULL,
  `created_user` varchar(15) default NULL,
  `modified_date` datetime default NULL,
  `modified_user` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='标签表';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dp_keywords`
--

LOCK TABLES `dp_keywords` WRITE;
/*!40000 ALTER TABLE `dp_keywords` DISABLE KEYS */;
INSERT INTO `dp_keywords` VALUES (2,'1','张慧华1',NULL,1,NULL,'asdf',0,NULL,NULL,NULL,NULL),(3,'2','test',NULL,1,NULL,'2',0,NULL,NULL,NULL,NULL),(4,'3','张慧华3',NULL,1,NULL,'3',0,NULL,NULL,NULL,NULL),(5,'4','4',NULL,1,NULL,'4',0,NULL,NULL,NULL,NULL),(6,'5','5',NULL,1,NULL,'5',0,NULL,NULL,NULL,NULL),(7,'6','6',NULL,1,NULL,'6',0,NULL,NULL,NULL,NULL),(8,'7','7',NULL,1,NULL,'7',0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `dp_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dp_log`
--

DROP TABLE IF EXISTS `dp_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dp_log` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(200) default NULL COMMENT '操作描述',
  `detail` text COMMENT '操作记录',
  `created_date` datetime default NULL,
  `created_user` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志表';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dp_log`
--

LOCK TABLES `dp_log` WRITE;
/*!40000 ALTER TABLE `dp_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `dp_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dp_media`
--

DROP TABLE IF EXISTS `dp_media`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dp_media` (
  `industry_code` varchar(15) default NULL,
  `id` int(11) unsigned NOT NULL auto_increment,
  `code` varchar(15) default NULL COMMENT '编号',
  `name` varchar(45) default NULL,
  `type` int(11) default NULL COMMENT '标签类型',
  `status` int(11) default '1' COMMENT '状态:\n1-活动\n2-暂停使用',
  `url` varchar(45) default NULL,
  `priority` decimal(10,2) default NULL COMMENT '权重',
  `description` varchar(2000) default NULL COMMENT '描述',
  `is_delete` int(11) default '0' COMMENT '0:未删除\n1:已删除',
  `created_date` datetime default NULL,
  `created_user` varchar(15) default NULL,
  `modified_date` datetime default NULL,
  `modified_user` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='媒体表';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dp_media`
--

LOCK TABLES `dp_media` WRITE;
/*!40000 ALTER TABLE `dp_media` DISABLE KEYS */;
INSERT INTO `dp_media` VALUES (NULL,1,'1','张慧华',NULL,1,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `dp_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dp_org_imp_article`
--

DROP TABLE IF EXISTS `dp_org_imp_article`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dp_org_imp_article` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `author_id` varchar(25) default NULL COMMENT '博主id',
  `weibo_homepage` varchar(50) default NULL COMMENT '微博主页',
  `author_name` varchar(100) default NULL COMMENT '昵称',
  `article_title` varchar(300) default NULL COMMENT '标题',
  `article` text COMMENT '文章',
  `sex` int(11) default NULL COMMENT '性别\n0:未知\n1:男\n2:女',
  `keywords` varchar(1000) default NULL COMMENT '标签',
  `location` varchar(100) default NULL,
  `fans_number` int(11) default NULL COMMENT '粉丝数',
  `attention_number` int(11) default NULL COMMENT '关注数',
  `article_number` int(11) default NULL COMMENT '文章数',
  `transmit_number` int(11) default NULL COMMENT '转发数',
  `comment_number` int(11) default NULL COMMENT '评论数/回复数',
  `source_id` int(11) default NULL COMMENT '来源',
  `article_url` varchar(1000) default NULL COMMENT '文章链接',
  `read_number` int(11) default NULL COMMENT '浏览数',
  `media_type` int(11) default NULL,
  `priority` decimal(10,2) default NULL COMMENT '重要度',
  `level` varchar(10) default NULL COMMENT '危机',
  `get_date` datetime default NULL COMMENT '抓取时间',
  `publish_date` datetime default NULL COMMENT '发布时间',
  `words_number` int(11) default NULL COMMENT '字数',
  `image_status` int(11) default NULL COMMENT '是否有图\n1:有\n0:无',
  `remark` varchar(2000) default NULL COMMENT '备注',
  `imp_template_type` int(11) default NULL COMMENT '导入模板类型',
  `modified_date` datetime default NULL,
  `modified_user` varchar(15) default NULL,
  `created_date` datetime default NULL,
  `created_user` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='导入原始数据表';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dp_org_imp_article`
--

LOCK TABLES `dp_org_imp_article` WRITE;
/*!40000 ALTER TABLE `dp_org_imp_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `dp_org_imp_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dp_task`
--

DROP TABLE IF EXISTS `dp_task`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dp_task` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `code` varchar(50) default NULL COMMENT '任务id',
  `type` varchar(15) default NULL COMMENT '任务类型',
  `priority` int(11) default '0' COMMENT '优先级',
  `excute_date` datetime default NULL,
  `status` int(11) default NULL,
  `modified_date` datetime default NULL,
  `modified_user` varchar(15) default NULL,
  `created_date` datetime default NULL,
  `created_user` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务表';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dp_task`
--

LOCK TABLES `dp_task` WRITE;
/*!40000 ALTER TABLE `dp_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `dp_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dp_user`
--

DROP TABLE IF EXISTS `dp_user`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dp_user` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `code` varchar(15) default NULL COMMENT '用户名',
  `name` varchar(45) default NULL COMMENT '姓名',
  `password` varchar(45) default NULL,
  `sex` int(11) default NULL COMMENT '1-男\n2-女',
  `email` varchar(45) default NULL,
  `phone` varchar(45) default NULL,
  `status` int(11) default '1' COMMENT '状态:\n1-活动\n2-暂停使用',
  `address` varchar(2000) default NULL COMMENT '地址',
  `is_delete` int(11) default '0' COMMENT '0:未删除\n1:已删除',
  `created_date` datetime default NULL,
  `created_user` varchar(15) default NULL,
  `modified_date` datetime default NULL,
  `modified_user` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dp_user`
--

LOCK TABLES `dp_user` WRITE;
/*!40000 ALTER TABLE `dp_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `dp_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-10-10  7:10:10
