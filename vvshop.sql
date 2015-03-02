-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: vshop
-- ------------------------------------------------------
-- Server version	5.5.16-log

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
-- Table structure for table `v_admin`
--

DROP TABLE IF EXISTS `v_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理ID',
  `username` varchar(32) NOT NULL COMMENT '管理员名称',
  `pwd` char(32) NOT NULL COMMENT '管理员密码',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `ip` varchar(32) NOT NULL DEFAULT '' COMMENT '登录ip',
  `login_time` int(11) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '管理状态 0表示禁用,1表示启用状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_admin`
--

LOCK TABLES `v_admin` WRITE;
/*!40000 ALTER TABLE `v_admin` DISABLE KEYS */;
INSERT INTO `v_admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',0,'127.0.0.1',1425042294,'1'),(2,'joe','202cb962ac59075b964b07152d234b70',6,'127.0.0.1',1423150067,'1'),(3,'lily','202cb962ac59075b964b07152d234b70',8,'127.0.0.1',1423147535,'1');
/*!40000 ALTER TABLE `v_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_attr`
--

DROP TABLE IF EXISTS `v_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_attr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `attr_name` varchar(30) NOT NULL COMMENT '属性名称',
  `attr_type` enum('单选','唯一') NOT NULL DEFAULT '唯一' COMMENT '属性类型',
  `type_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '类型ID',
  `attr_value` varchar(120) NOT NULL DEFAULT '' COMMENT '属性可选值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_attr`
--

LOCK TABLES `v_attr` WRITE;
/*!40000 ALTER TABLE `v_attr` DISABLE KEYS */;
INSERT INTO `v_attr` VALUES (1,'WIFI功能','单选',1,'是'),(2,'操作系统','单选',1,'安卓3.1,安卓3.2,安卓3.2'),(3,'显示器','单选',2,'19寸,20寸,25寸,32寸35寸,42寸'),(4,'智能手机','单选',1,'是,否'),(5,'cpu型号','单选',1,'高通,三星,海思,联发科'),(6,'cpu核数','单选',1,'单核,双核,四核,八核'),(7,'单双卡','单选',1,'单卡,双卡'),(8,'网络制式','单选',1,'联通3G,移动3G,电信3G,联通4G,移动4G,电信4G'),(9,'运行内存:','单选',1,'512M,1G,2G,4G'),(10,'显卡类型','唯一',2,'独立显卡'),(11,'操作系统','唯一',2,'window8'),(12,'电池容量','单选',4,'4800mAh,10000mAh,20000mAh'),(13,'重量','唯一',4,'约232g'),(14,'输入接口','唯一',4,'标准Micro USB接口'),(15,'材质','唯一',4,'ABS材质');
/*!40000 ALTER TABLE `v_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_auth`
--

DROP TABLE IF EXISTS `v_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_auth` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '权限名称',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级权限',
  `module` varchar(32) NOT NULL COMMENT '模块名称',
  `controller` varchar(32) NOT NULL DEFAULT '' COMMENT '控制名称',
  `action` varchar(32) NOT NULL DEFAULT '' COMMENT '方法名称',
  `level` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '等级ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_auth`
--

LOCK TABLES `v_auth` WRITE;
/*!40000 ALTER TABLE `v_auth` DISABLE KEYS */;
INSERT INTO `v_auth` VALUES (1,'管理员模块',0,'Admin','','',0),(41,'类型添加',40,'Admin','Type','add',2),(3,'商品模块',0,'Goods','','',0),(4,'商品列表',3,'Goods','Goods','lst',1),(5,'权限列表',1,'Admin','Auth','lst',1),(6,'角色列表',1,'Admin','Role','lst',1),(39,'添加管理员',38,'Admin','Admin','add',2),(40,'类型列表',3,'Admin','Type','lst',1),(9,'属性列表',3,'Goods','Attr','lst',1),(10,'属性添加',9,'Goods','Attr','add',2),(11,'属性删除',9,'Goods','Attr','lst',2),(12,'属性修改',9,'Goods','Attr','update',2),(13,'属性值列表',3,'Goods','Value','lst',1),(14,'属性值添加',13,'Goods','Value','add',2),(15,'属性值删除',13,'Goods','Value','del',2),(16,'属性值修改',13,'Goods','Value','update',2),(17,'商品分类列表',3,'Goods','Category','lst',1),(18,'分类添加',17,'Admin','Category','add',2),(19,'分类删除',17,'Admin','Category','del',2),(20,'分类修改',17,'Admin','Admin','update',2),(38,'管理员列表',1,'Admin','Admin','lst',1),(42,'类型删除',40,'Admin','Type','del',2),(43,'类型修改',40,'Admin','Type','update',2),(44,'品牌列表',3,'Admin','Brand','lst',1),(45,'会员模块',0,'Admin','','',0),(46,'会员等级列表',45,'Admin','MemberLevel','lst',1),(47,'会员等级添加',46,'Admin','MemberLevel','add',2),(48,'会员等级删除',46,'Admin','MemberLevel','del',2),(49,'会员等级修改',46,'Admin','MemberLevel','update',2);
/*!40000 ALTER TABLE `v_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_brand`
--

DROP TABLE IF EXISTS `v_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_brand` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `brand_name` varchar(30) NOT NULL COMMENT '品牌名称',
  `logo` varchar(120) NOT NULL DEFAULT '' COMMENT '品牌LOGO',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='商品品牌表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_brand`
--

LOCK TABLES `v_brand` WRITE;
/*!40000 ALTER TABLE `v_brand` DISABLE KEYS */;
INSERT INTO `v_brand` VALUES (38,'中兴','brand/2015-02-12/54dca36dc39cc.jpg'),(39,'联想','brand/2015-02-12/54dca3a3a80e0.jpg');
/*!40000 ALTER TABLE `v_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_category`
--

DROP TABLE IF EXISTS `v_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cat_name` varchar(128) NOT NULL COMMENT '����',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '��ID',
  `section_price` tinyint(4) NOT NULL DEFAULT '5' COMMENT '�۸�����',
  `keyword` varchar(300) NOT NULL DEFAULT '' COMMENT '�ؼ���',
  `desc` text NOT NULL COMMENT '��ϸ����',
  `attr_id` varchar(150) NOT NULL DEFAULT '' COMMENT '����ID',
  `cat_path` varchar(300) NOT NULL DEFAULT '' COMMENT '����·��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='��Ʒ����';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_category`
--

LOCK TABLES `v_category` WRITE;
/*!40000 ALTER TABLE `v_category` DISABLE KEYS */;
INSERT INTO `v_category` VALUES (16,'手机',0,5,'手机 3G手机','手机','1,2,5,6','0'),(18,'移动电源',0,5,'充电宝 移动电源 电源','充电宝 移动电源 电源','12,13','0');
/*!40000 ALTER TABLE `v_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_comment`
--

DROP TABLE IF EXISTS `v_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `content` varchar(300) NOT NULL COMMENT '评论内容',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `memeber_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `score` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '评分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_comment`
--

LOCK TABLES `v_comment` WRITE;
/*!40000 ALTER TABLE `v_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_goods`
--

DROP TABLE IF EXISTS `v_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `goods_name` varchar(64) NOT NULL COMMENT '��Ʒ����',
  `o_img` varchar(128) NOT NULL DEFAULT '' COMMENT '��ƷԭͼƬ',
  `s_img` varchar(128) NOT NULL DEFAULT '' COMMENT '��ƷСͼ',
  `m_img` varchar(128) NOT NULL DEFAULT '' COMMENT '��Ʒ��ͼ',
  `b_img` varchar(128) NOT NULL DEFAULT '' COMMENT '��Ʒ��ͼ',
  `cat_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '��Ʒ����ID',
  `brand_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '��ƷƷ��ID',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '�����',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '�г���',
  `is_on_sale` enum('1','0') NOT NULL DEFAULT '1' COMMENT '�Ƿ��ϼ�:1 �ϼ� 0 ��',
  `goods_desc` varchar(300) NOT NULL DEFAULT '' COMMENT '��Ʒ����',
  `type_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '��Ʒ����ID',
  `rec_id` varchar(300) NOT NULL DEFAULT '' COMMENT '�Ƽ�ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='��Ʒ��';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_goods`
--

LOCK TABLES `v_goods` WRITE;
/*!40000 ALTER TABLE `v_goods` DISABLE KEYS */;
INSERT INTO `v_goods` VALUES (29,'联想10086','Goods/2015-02-27/54f06c306cd42.jpg','Goods/2015-02-27/_s_54f06c306cd42.jpg','Goods/2015-02-27/_m_54f06c306cd42.jpg','Goods/2015-02-27/_b_54f06c306cd42.jpg',16,39,1200.00,1500.00,'1','好手机',1,''),(28,'联想10086','Goods/2015-02-27/54efef4f756f3.jpg','Goods/2015-02-27/_s_54efef4f756f3.jpg','Goods/2015-02-27/_m_54efef4f756f3.jpg','Goods/2015-02-27/_b_54efef4f756f3.jpg',16,39,1200.00,1000.00,'1','好手机',1,'');
/*!40000 ALTER TABLE `v_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_goods_attr`
--

DROP TABLE IF EXISTS `v_goods_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_goods_attr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品属性ID',
  `attr_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '属性ID',
  `attr_value` varchar(60) NOT NULL DEFAULT '' COMMENT '属性值',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性价格表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COMMENT='商品属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_goods_attr`
--

LOCK TABLES `v_goods_attr` WRITE;
/*!40000 ALTER TABLE `v_goods_attr` DISABLE KEYS */;
INSERT INTO `v_goods_attr` VALUES (66,7,'单卡',29,1200.00),(65,6,'单核',29,1300.00),(64,5,'高通',29,1200.00),(63,4,'是',29,1200.00),(62,2,'安卓3.1',29,1200.00),(61,1,'是',29,1200.00),(60,9,'512M',28,1200.00),(59,8,'联通3G',28,1200.00),(58,7,'单卡',28,1200.00),(57,6,'单核',28,1200.00),(56,5,'高通',28,1200.00),(55,4,'是',28,1200.00),(54,2,'安卓3.1',28,1200.00),(53,1,'是',28,1200.00),(67,8,'联通3G',29,1200.00),(68,9,'512M',29,1200.00),(69,7,'单卡',29,1200.00),(70,6,'四核',29,1200.00),(71,2,'安卓3.1',29,1200.00),(72,7,'双卡',29,1200.00),(73,9,'1G',29,1200.00);
/*!40000 ALTER TABLE `v_goods_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_goods_number`
--

DROP TABLE IF EXISTS `v_goods_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_goods_number` (
  `goods_number` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `goods_attr_id` varchar(120) NOT NULL DEFAULT '' COMMENT '商品属性ID',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品库存表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_goods_number`
--

LOCK TABLES `v_goods_number` WRITE;
/*!40000 ALTER TABLE `v_goods_number` DISABLE KEYS */;
INSERT INTO `v_goods_number` VALUES (0,'是,安卓3.1,是,高通,单核,单卡,联通3G,512M',29),(0,'是,安卓3.1,是,高通,单核,单卡,联通3G,512M',29),(500,'是,安卓3.2,是,海思,八核,双卡,电信4G,4G',28),(100,'是,安卓3.2,否,高通,八核,双卡,电信4G,1G',28);
/*!40000 ALTER TABLE `v_goods_number` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_hot_sale_goods`
--

DROP TABLE IF EXISTS `v_hot_sale_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_hot_sale_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '热销ID',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='热销商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_hot_sale_goods`
--

LOCK TABLES `v_hot_sale_goods` WRITE;
/*!40000 ALTER TABLE `v_hot_sale_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_hot_sale_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_member`
--

DROP TABLE IF EXISTS `v_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员ID',
  `m_name` varchar(32) NOT NULL COMMENT '会员名称',
  `pwd` char(32) NOT NULL COMMENT '会员密码',
  `m_email` varchar(32) NOT NULL COMMENT '会员邮箱',
  `token` varchar(32) NOT NULL DEFAULT '' COMMENT '账号激活码',
  `token_expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '账号激活码到期时间',
  `status` tinyint(3) unsigned DEFAULT '0' COMMENT '账号状态:0表示未激活;1表示已经激活',
  `reg_time` int(10) unsigned DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_member`
--

LOCK TABLES `v_member` WRITE;
/*!40000 ALTER TABLE `v_member` DISABLE KEYS */;
INSERT INTO `v_member` VALUES (1,'joe1280','ab87036181','4334838@qq.com','1425136016',0,0,0),(2,'joe1280','545','4334838@qq.com','08873cdd',1425136115,0,0),(3,'5989','8989','4334838@qq.com','08945814',1425136325,0,1425049925),(4,'8998','8989','4334838@qq.com','08991c6a',1425136401,0,1425050001),(5,'','','','08bfaac5',1425137018,0,1425050618),(6,'','','','08c1f702',1425137055,0,1425050655),(7,'4545','123','4334838@qq.com','08d9115f',1425137425,0,1425051025);
/*!40000 ALTER TABLE `v_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_member_level`
--

DROP TABLE IF EXISTS `v_member_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_member_level` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员等级ID',
  `level_name` varchar(20) NOT NULL COMMENT '会员等级名称',
  `top` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '积分上限',
  `bottom` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '积分下限',
  `rate` mediumint(8) unsigned NOT NULL DEFAULT '100' COMMENT '折扣率',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会员等级表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_member_level`
--

LOCK TABLES `v_member_level` WRITE;
/*!40000 ALTER TABLE `v_member_level` DISABLE KEYS */;
INSERT INTO `v_member_level` VALUES (1,'普通会员',0,2000,100),(2,'中级会员',2001,5000,90),(3,'高级会员',2001,25000,100);
/*!40000 ALTER TABLE `v_member_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_member_price`
--

DROP TABLE IF EXISTS `v_member_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_member_price` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员价格ID',
  `level_id` tinyint(3) unsigned NOT NULL COMMENT '等级ID',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '会员价格',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='会员价格表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_member_price`
--

LOCK TABLES `v_member_price` WRITE;
/*!40000 ALTER TABLE `v_member_price` DISABLE KEYS */;
INSERT INTO `v_member_price` VALUES (60,3,28,26000.00),(59,2,28,900.00),(58,1,28,1000.00),(63,3,29,1200.00),(62,2,29,1100.00),(61,1,29,1000.00);
/*!40000 ALTER TABLE `v_member_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_pics`
--

DROP TABLE IF EXISTS `v_pics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_pics` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品图片表ID',
  `s_pic` varchar(300) NOT NULL COMMENT '小图',
  `m_pic` varchar(300) NOT NULL COMMENT '中图',
  `o_pic` varchar(300) NOT NULL COMMENT '原图',
  `goods_id` mediumint(9) NOT NULL DEFAULT '0' COMMENT '商品ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='商品图片表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_pics`
--

LOCK TABLES `v_pics` WRITE;
/*!40000 ALTER TABLE `v_pics` DISABLE KEYS */;
INSERT INTO `v_pics` VALUES (45,'Pics/2015-02-27/_S_54f06c30b95d6.jpg','Pics/2015-02-27/_M_54f06c30b95d6.jpg','Pics/2015-02-27/54f06c30b95d6.jpg',29),(44,'Pics/2015-02-27/_S_54f06c30b8e22.jpg','Pics/2015-02-27/_M_54f06c30b8e22.jpg','Pics/2015-02-27/54f06c30b8e22.jpg',29),(43,'Pics/2015-02-27/_S_54f06c30b812c.jpg','Pics/2015-02-27/_M_54f06c30b812c.jpg','Pics/2015-02-27/54f06c30b812c.jpg',29),(40,'Pics/2015-02-27/_S_54efef4f96237.jpg','Pics/2015-02-27/_M_54efef4f96237.jpg','Pics/2015-02-27/54efef4f96237.jpg',28),(42,'Pics/2015-02-27/_S_54efef4f97239.jpg','Pics/2015-02-27/_M_54efef4f97239.jpg','Pics/2015-02-27/54efef4f97239.jpg',28),(41,'Pics/2015-02-27/_S_54efef4f96a60.jpg','Pics/2015-02-27/_M_54efef4f96a60.jpg','Pics/2015-02-27/54efef4f96a60.jpg',28),(46,'Pics/2015-02-27/_S_54f06c30b9cd9.jpg','Pics/2015-02-27/_M_54f06c30b9cd9.jpg','Pics/2015-02-27/54f06c30b9cd9.jpg',29);
/*!40000 ALTER TABLE `v_pics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_role`
--

DROP TABLE IF EXISTS `v_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_role` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(32) NOT NULL COMMENT '角色名字',
  `auth_list` varchar(300) NOT NULL DEFAULT '' COMMENT '权限列表',
  `status` enum('0','1') NOT NULL COMMENT '管理状态 0表示禁用,1表示启用状态',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_role`
--

LOCK TABLES `v_role` WRITE;
/*!40000 ALTER TABLE `v_role` DISABLE KEYS */;
INSERT INTO `v_role` VALUES (6,'经理','1,2,8,3,4','0',1423051643,1423150049),(8,'员工','3,4','0',1423051850,1423145328);
/*!40000 ALTER TABLE `v_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_type`
--

DROP TABLE IF EXISTS `v_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_type` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '类型ID',
  `type_name` varchar(30) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_type`
--

LOCK TABLES `v_type` WRITE;
/*!40000 ALTER TABLE `v_type` DISABLE KEYS */;
INSERT INTO `v_type` VALUES (1,'手机'),(2,'电脑'),(3,'电子产品'),(4,'移动电源');
/*!40000 ALTER TABLE `v_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_value`
--

DROP TABLE IF EXISTS `v_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `v_value` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '值ID',
  `value_name` varchar(50) NOT NULL COMMENT '属性值',
  `attr_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '属性ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='商品属性值表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_value`
--

LOCK TABLES `v_value` WRITE;
/*!40000 ALTER TABLE `v_value` DISABLE KEYS */;
INSERT INTO `v_value` VALUES (1,'安卓2.1',1),(2,'安卓2.2',1),(3,'安卓2.3',1),(4,'安卓4.0',1),(5,'安卓4.1',1),(6,'安卓4.2',1),(7,'安卓4.3',1),(8,'是',2),(9,'否',2),(10,'500万',3),(11,'800万',3),(12,'1200万',3),(13,'30万',4),(14,'80万',4),(15,'100万',4),(16,'300万',4),(17,'500万',4),(18,'800万',4),(19,'512M',6),(20,'1G',6),(21,'2G',6),(22,'3G',6),(23,'2G',5),(24,'4G',5),(25,'8G',5),(26,'16G',5),(27,'32G',5),(28,'64G',5),(29,'单卡',9),(30,'双卡',9),(31,'3.0寸',7),(32,'3.5寸',7),(33,'3.7寸',7),(34,'4.0寸',7),(35,'4.5寸',7),(36,'4.7寸',8),(37,'5.0寸',7),(38,'联通3G',8),(39,'移动3G',8),(40,'移动4G',8),(41,'联通4G',8),(42,'电信3G',8),(43,'电信4G',8),(44,'是',10),(45,'否',10),(46,'单核',12),(47,'双核',12),(48,'四核',12),(49,'八核',12),(50,'三星',11),(51,'高通',11),(52,'海思',11),(53,'联发科',11);
/*!40000 ALTER TABLE `v_value` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-02 12:56:18
