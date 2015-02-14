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
INSERT INTO `v_admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',0,'127.0.0.1',1423917112,'1'),(2,'joe','202cb962ac59075b964b07152d234b70',6,'127.0.0.1',1423150067,'1'),(3,'lily','202cb962ac59075b964b07152d234b70',8,'127.0.0.1',1423147535,'1');
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
INSERT INTO `v_attr` VALUES (1,'WIFI功能','单选',1,'是,否'),(2,'操作系统','单选',1,'安卓3.1,安卓3.2,安卓3.2'),(3,'显示器','单选',2,'19寸,20寸,25寸,32寸35寸,42寸'),(4,'智能手机','单选',1,'是,否'),(5,'cpu型号','单选',1,'高通,三星,海思,联发科'),(6,'cpu核数','单选',1,'单核,双核,四核,八核'),(7,'单双卡','单选',1,'单卡,双卡'),(8,'网络制式','单选',1,'联通3G,移动3G,电信3G,联通4G,移动4G,电信4G'),(9,'运行内存:','单选',1,'512M,1G,2G,4G'),(10,'显卡类型','唯一',2,'独立显卡'),(11,'操作系统','唯一',2,'window8'),(12,'电池容量','单选',4,'4800mAh,10000mAh,20000mAh'),(13,'重量','唯一',4,'约232g'),(14,'输入接口','唯一',4,'标准Micro USB接口'),(15,'材质','唯一',4,'ABS材质');
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
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COMMENT='��Ʒ��';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_goods`
--

LOCK TABLES `v_goods` WRITE;
/*!40000 ALTER TABLE `v_goods` DISABLE KEYS */;
INSERT INTO `v_goods` VALUES (54,'联想45','pic/2015-02-14/54df16248259b.jpg','pic/2015-02-14/_s_54df16248259b.jpg','pic/2015-02-14/_m_54df16248259b.jpg','pic/2015-02-14/_b_54df16248259b.jpg',0,0,0.00,0.00,'1','',0,''),(53,'联想45','pic/2015-02-14/54df15e437c96.jpg','pic/2015-02-14/_s_54df15e437c96.jpg','pic/2015-02-14/_m_54df15e437c96.jpg','pic/2015-02-14/_b_54df15e437c96.jpg',0,0,0.00,0.00,'1','',0,''),(52,'联想45','pic/2015-02-14/54df15b4ccaf9.jpg','pic/2015-02-14/_s_54df15b4ccaf9.jpg','pic/2015-02-14/_m_54df15b4ccaf9.jpg','pic/2015-02-14/_b_54df15b4ccaf9.jpg',0,0,0.00,0.00,'1','',0,''),(51,'联想45','pic/2015-02-14/54df15a33d877.jpg','pic/2015-02-14/_s_54df15a33d877.jpg','pic/2015-02-14/_m_54df15a33d877.jpg','pic/2015-02-14/_b_54df15a33d877.jpg',0,0,0.00,0.00,'1','',0,''),(50,'联想45','pic/2015-02-14/54df159da34c9.jpg','pic/2015-02-14/_s_54df159da34c9.jpg','pic/2015-02-14/_m_54df159da34c9.jpg','pic/2015-02-14/_b_54df159da34c9.jpg',0,0,0.00,0.00,'1','',0,''),(49,'联想45','pic/2015-02-14/54df1583a2ed8.jpg','pic/2015-02-14/_s_54df1583a2ed8.jpg','pic/2015-02-14/_m_54df1583a2ed8.jpg','pic/2015-02-14/_b_54df1583a2ed8.jpg',0,0,0.00,0.00,'1','',0,''),(48,'联想45','pic/2015-02-14/54df15260fcc7.jpg','pic/2015-02-14/_s_54df15260fcc7.jpg','pic/2015-02-14/_m_54df15260fcc7.jpg','pic/2015-02-14/_b_54df15260fcc7.jpg',0,0,0.00,0.00,'1','',0,''),(47,'联想45','pic/2015-02-14/54df14fd8a275.jpg','pic/2015-02-14/_s_54df14fd8a275.jpg','pic/2015-02-14/_m_54df14fd8a275.jpg','pic/2015-02-14/_b_54df14fd8a275.jpg',0,0,0.00,0.00,'1','',0,''),(46,'联想45','pic/2015-02-14/54df14cdb3480.jpg','pic/2015-02-14/_s_54df14cdb3480.jpg','pic/2015-02-14/_m_54df14cdb3480.jpg','pic/2015-02-14/_b_54df14cdb3480.jpg',0,0,0.00,0.00,'1','',0,''),(45,'联想4878','','','','',16,39,1000.00,1200.00,'0','878',0,''),(44,'联想M578','pic/2015-02-14/54df005f584ba.jpg','pic/2015-02-14/_s_54df005f584ba.jpg','pic/2015-02-14/_m_54df005f584ba.jpg','pic/2015-02-14/_b_54df005f584ba.jpg',16,39,2500.00,300.00,'1','',0,''),(43,'联想A967T','pic/2015-02-14/54df0023af412.jpg','pic/2015-02-14/_s_54df0023af412.jpg','pic/2015-02-14/_m_54df0023af412.jpg','pic/2015-02-14/_b_54df0023af412.jpg',16,39,1200.00,1500.00,'1','',0,''),(55,'联想45','pic/2015-02-14/54df163401f3b.jpg','pic/2015-02-14/_s_54df163401f3b.jpg','pic/2015-02-14/_m_54df163401f3b.jpg','pic/2015-02-14/_b_54df163401f3b.jpg',0,0,0.00,0.00,'1','',0,''),(56,'联想45','pic/2015-02-14/54df16df02c4d.jpg','pic/2015-02-14/_s_54df16df02c4d.jpg','pic/2015-02-14/_m_54df16df02c4d.jpg','pic/2015-02-14/_b_54df16df02c4d.jpg',0,0,0.00,0.00,'1','',0,''),(57,'联想45','pic/2015-02-14/54df16e2ec987.jpg','pic/2015-02-14/_s_54df16e2ec987.jpg','pic/2015-02-14/_m_54df16e2ec987.jpg','pic/2015-02-14/_b_54df16e2ec987.jpg',0,0,0.00,0.00,'1','',0,''),(58,'987','pic/2015-02-14/54df1776488b9.jpg','pic/2015-02-14/_s_54df1776488b9.jpg','pic/2015-02-14/_m_54df1776488b9.jpg','pic/2015-02-14/_b_54df1776488b9.jpg',0,0,0.00,0.00,'1','',0,''),(59,'65479','pic/2015-02-14/54df179620c30.jpg','pic/2015-02-14/_s_54df179620c30.jpg','pic/2015-02-14/_m_54df179620c30.jpg','pic/2015-02-14/_b_54df179620c30.jpg',0,0,0.00,0.00,'1','',0,''),(60,'65479','pic/2015-02-14/54df1df143285.jpg','pic/2015-02-14/_s_54df1df143285.jpg','pic/2015-02-14/_m_54df1df143285.jpg','pic/2015-02-14/_b_54df1df143285.jpg',0,0,0.00,0.00,'1','',0,''),(61,'65479','pic/2015-02-14/54df1df9c9bc2.jpg','pic/2015-02-14/_s_54df1df9c9bc2.jpg','pic/2015-02-14/_m_54df1df9c9bc2.jpg','pic/2015-02-14/_b_54df1df9c9bc2.jpg',0,0,0.00,0.00,'1','',0,''),(62,'65479','pic/2015-02-14/54df1e3b7796f.jpg','pic/2015-02-14/_s_54df1e3b7796f.jpg','pic/2015-02-14/_m_54df1e3b7796f.jpg','pic/2015-02-14/_b_54df1e3b7796f.jpg',0,0,0.00,0.00,'1','',0,''),(63,'65479','pic/2015-02-14/54df1e8a0ac7e.jpg','pic/2015-02-14/_s_54df1e8a0ac7e.jpg','pic/2015-02-14/_m_54df1e8a0ac7e.jpg','pic/2015-02-14/_b_54df1e8a0ac7e.jpg',0,0,0.00,0.00,'1','',0,''),(64,'65479','pic/2015-02-14/54df1e9175ca1.jpg','pic/2015-02-14/_s_54df1e9175ca1.jpg','pic/2015-02-14/_m_54df1e9175ca1.jpg','pic/2015-02-14/_b_54df1e9175ca1.jpg',0,0,0.00,0.00,'1','',0,''),(65,'65479','pic/2015-02-14/54df1e96432f4.jpg','pic/2015-02-14/_s_54df1e96432f4.jpg','pic/2015-02-14/_m_54df1e96432f4.jpg','pic/2015-02-14/_b_54df1e96432f4.jpg',0,0,0.00,0.00,'1','',0,''),(66,'65479','pic/2015-02-14/54df1ebe7cc50.jpg','pic/2015-02-14/_s_54df1ebe7cc50.jpg','pic/2015-02-14/_m_54df1ebe7cc50.jpg','pic/2015-02-14/_b_54df1ebe7cc50.jpg',0,0,0.00,0.00,'1','',0,''),(67,'65479','pic/2015-02-14/54df1f6063925.jpg','pic/2015-02-14/_s_54df1f6063925.jpg','pic/2015-02-14/_m_54df1f6063925.jpg','pic/2015-02-14/_b_54df1f6063925.jpg',0,0,0.00,0.00,'1','',0,''),(68,'65479','pic/2015-02-14/54df1f65da719.jpg','pic/2015-02-14/_s_54df1f65da719.jpg','pic/2015-02-14/_m_54df1f65da719.jpg','pic/2015-02-14/_b_54df1f65da719.jpg',0,0,0.00,0.00,'1','',0,''),(69,'65479','pic/2015-02-14/54df202f71552.jpg','pic/2015-02-14/_s_54df202f71552.jpg','pic/2015-02-14/_m_54df202f71552.jpg','pic/2015-02-14/_b_54df202f71552.jpg',0,0,0.00,0.00,'1','',0,''),(70,'65479','pic/2015-02-14/54df2035b8b8b.jpg','pic/2015-02-14/_s_54df2035b8b8b.jpg','pic/2015-02-14/_m_54df2035b8b8b.jpg','pic/2015-02-14/_b_54df2035b8b8b.jpg',0,0,0.00,0.00,'1','',0,''),(71,'65479','pic/2015-02-14/54df2042da24c.jpg','pic/2015-02-14/_s_54df2042da24c.jpg','pic/2015-02-14/_m_54df2042da24c.jpg','pic/2015-02-14/_b_54df2042da24c.jpg',0,0,0.00,0.00,'1','',0,''),(72,'65479','pic/2015-02-14/54df20a2af417.jpg','pic/2015-02-14/_s_54df20a2af417.jpg','pic/2015-02-14/_m_54df20a2af417.jpg','pic/2015-02-14/_b_54df20a2af417.jpg',0,0,0.00,0.00,'1','',0,''),(73,'65479','pic/2015-02-14/54df20b1e4b1b.jpg','pic/2015-02-14/_s_54df20b1e4b1b.jpg','pic/2015-02-14/_m_54df20b1e4b1b.jpg','pic/2015-02-14/_b_54df20b1e4b1b.jpg',0,0,0.00,0.00,'1','',0,''),(74,'987','pic/2015-02-14/54df20fd652a9.jpg','pic/2015-02-14/_s_54df20fd652a9.jpg','pic/2015-02-14/_m_54df20fd652a9.jpg','pic/2015-02-14/_b_54df20fd652a9.jpg',0,0,0.00,0.00,'1','',0,''),(75,'987','pic/2015-02-14/54df22e4d8b71.jpg','pic/2015-02-14/_s_54df22e4d8b71.jpg','pic/2015-02-14/_m_54df22e4d8b71.jpg','pic/2015-02-14/_b_54df22e4d8b71.jpg',0,0,0.00,0.00,'1','',0,''),(76,'6456','pic/2015-02-14/54df232cdcc21.jpg','pic/2015-02-14/_s_54df232cdcc21.jpg','pic/2015-02-14/_m_54df232cdcc21.jpg','pic/2015-02-14/_b_54df232cdcc21.jpg',0,0,0.00,0.00,'1','',0,''),(77,'6456','pic/2015-02-14/54df236feee15.jpg','pic/2015-02-14/_s_54df236feee15.jpg','pic/2015-02-14/_m_54df236feee15.jpg','pic/2015-02-14/_b_54df236feee15.jpg',0,0,0.00,0.00,'1','',0,''),(78,'6456','pic/2015-02-14/54df23ea08256.jpg','pic/2015-02-14/_s_54df23ea08256.jpg','pic/2015-02-14/_m_54df23ea08256.jpg','pic/2015-02-14/_b_54df23ea08256.jpg',0,0,0.00,0.00,'1','',0,''),(79,'6456','pic/2015-02-14/54df23f6ab585.jpg','pic/2015-02-14/_s_54df23f6ab585.jpg','pic/2015-02-14/_m_54df23f6ab585.jpg','pic/2015-02-14/_b_54df23f6ab585.jpg',0,0,0.00,0.00,'1','',0,''),(80,'6456','pic/2015-02-14/54df2412704fc.jpg','pic/2015-02-14/_s_54df2412704fc.jpg','pic/2015-02-14/_m_54df2412704fc.jpg','pic/2015-02-14/_b_54df2412704fc.jpg',0,0,0.00,0.00,'1','',0,''),(81,'6456','pic/2015-02-14/54df241cac083.jpg','pic/2015-02-14/_s_54df241cac083.jpg','pic/2015-02-14/_m_54df241cac083.jpg','pic/2015-02-14/_b_54df241cac083.jpg',0,0,0.00,0.00,'1','',0,''),(82,'645','pic/2015-02-14/54df499770623.jpg','pic/2015-02-14/_s_54df499770623.jpg','pic/2015-02-14/_m_54df499770623.jpg','pic/2015-02-14/_b_54df499770623.jpg',0,0,0.00,0.00,'1','',0,''),(83,'877878','pic/2015-02-14/54df49cbafd6c.jpg','pic/2015-02-14/_s_54df49cbafd6c.jpg','pic/2015-02-14/_m_54df49cbafd6c.jpg','pic/2015-02-14/_b_54df49cbafd6c.jpg',0,0,0.00,0.00,'1','',0,''),(84,'877878','pic/2015-02-14/54df49e66f90a.jpg','pic/2015-02-14/_s_54df49e66f90a.jpg','pic/2015-02-14/_m_54df49e66f90a.jpg','pic/2015-02-14/_b_54df49e66f90a.jpg',0,0,0.00,0.00,'1','',0,''),(85,'877878','pic/2015-02-14/54df4a1f699a3.jpg','pic/2015-02-14/_s_54df4a1f699a3.jpg','pic/2015-02-14/_m_54df4a1f699a3.jpg','pic/2015-02-14/_b_54df4a1f699a3.jpg',0,0,0.00,0.00,'1','',0,''),(86,'877878','pic/2015-02-14/54df4a6ce0730.jpg','pic/2015-02-14/_s_54df4a6ce0730.jpg','pic/2015-02-14/_m_54df4a6ce0730.jpg','pic/2015-02-14/_b_54df4a6ce0730.jpg',0,0,0.00,0.00,'1','',0,''),(87,'877878','pic/2015-02-14/54df4b2d72e62.jpg','pic/2015-02-14/_s_54df4b2d72e62.jpg','pic/2015-02-14/_m_54df4b2d72e62.jpg','pic/2015-02-14/_b_54df4b2d72e62.jpg',0,0,0.00,0.00,'1','',0,''),(88,'565','pic/2015-02-14/54df50253d713.jpg','pic/2015-02-14/_s_54df50253d713.jpg','pic/2015-02-14/_m_54df50253d713.jpg','pic/2015-02-14/_b_54df50253d713.jpg',0,0,0.00,0.00,'1','',0,''),(89,'565','pic/2015-02-14/54df503a38bc7.jpg','pic/2015-02-14/_s_54df503a38bc7.jpg','pic/2015-02-14/_m_54df503a38bc7.jpg','pic/2015-02-14/_b_54df503a38bc7.jpg',0,0,0.00,0.00,'1','',0,''),(90,'565','pic/2015-02-14/54df50493c7a5.jpg','pic/2015-02-14/_s_54df50493c7a5.jpg','pic/2015-02-14/_m_54df50493c7a5.jpg','pic/2015-02-14/_b_54df50493c7a5.jpg',0,0,0.00,0.00,'1','',0,''),(91,'565','pic/2015-02-14/54df50869039b.jpg','pic/2015-02-14/_s_54df50869039b.jpg','pic/2015-02-14/_m_54df50869039b.jpg','pic/2015-02-14/_b_54df50869039b.jpg',0,0,0.00,0.00,'1','',0,''),(92,'565','pic/2015-02-14/54df508f10d81.jpg','pic/2015-02-14/_s_54df508f10d81.jpg','pic/2015-02-14/_m_54df508f10d81.jpg','pic/2015-02-14/_b_54df508f10d81.jpg',0,0,0.00,0.00,'1','',0,''),(93,'565','pic/2015-02-14/54df509d59d6c.jpg','pic/2015-02-14/_s_54df509d59d6c.jpg','pic/2015-02-14/_m_54df509d59d6c.jpg','pic/2015-02-14/_b_54df509d59d6c.jpg',0,0,0.00,0.00,'1','',0,''),(94,'565','pic/2015-02-14/54df50a70802a.jpg','pic/2015-02-14/_s_54df50a70802a.jpg','pic/2015-02-14/_m_54df50a70802a.jpg','pic/2015-02-14/_b_54df50a70802a.jpg',0,0,0.00,0.00,'1','',0,''),(95,'8989','pic/2015-02-14/54df52ff699bd.jpg','pic/2015-02-14/_s_54df52ff699bd.jpg','pic/2015-02-14/_m_54df52ff699bd.jpg','pic/2015-02-14/_b_54df52ff699bd.jpg',0,0,0.00,0.00,'1','',0,''),(96,'8989','pic/2015-02-14/54df53110ea8a.jpg','pic/2015-02-14/_s_54df53110ea8a.jpg','pic/2015-02-14/_m_54df53110ea8a.jpg','pic/2015-02-14/_b_54df53110ea8a.jpg',0,0,0.00,0.00,'1','',0,''),(97,'8989','pic/2015-02-14/54df539961563.jpg','pic/2015-02-14/_s_54df539961563.jpg','pic/2015-02-14/_m_54df539961563.jpg','pic/2015-02-14/_b_54df539961563.jpg',0,0,0.00,0.00,'1','',0,''),(98,'8989','pic/2015-02-14/54df53d59693f.jpg','pic/2015-02-14/_s_54df53d59693f.jpg','pic/2015-02-14/_m_54df53d59693f.jpg','pic/2015-02-14/_b_54df53d59693f.jpg',0,0,0.00,0.00,'1','',0,''),(99,'8989','pic/2015-02-14/54df53e7a2a9a.jpg','pic/2015-02-14/_s_54df53e7a2a9a.jpg','pic/2015-02-14/_m_54df53e7a2a9a.jpg','pic/2015-02-14/_b_54df53e7a2a9a.jpg',0,0,0.00,0.00,'1','',0,''),(100,'8989','pic/2015-02-14/54df53f4e4043.jpg','pic/2015-02-14/_s_54df53f4e4043.jpg','pic/2015-02-14/_m_54df53f4e4043.jpg','pic/2015-02-14/_b_54df53f4e4043.jpg',0,0,0.00,0.00,'1','',0,''),(101,'8989','pic/2015-02-14/54df5443889ef.jpg','pic/2015-02-14/_s_54df5443889ef.jpg','pic/2015-02-14/_m_54df5443889ef.jpg','pic/2015-02-14/_b_54df5443889ef.jpg',0,0,0.00,0.00,'1','',0,''),(102,'8989','pic/2015-02-14/54df544ba2fc0.jpg','pic/2015-02-14/_s_54df544ba2fc0.jpg','pic/2015-02-14/_m_54df544ba2fc0.jpg','pic/2015-02-14/_b_54df544ba2fc0.jpg',0,0,0.00,0.00,'1','',0,''),(103,'8989','pic/2015-02-14/54df56628a459.jpg','pic/2015-02-14/_s_54df56628a459.jpg','pic/2015-02-14/_m_54df56628a459.jpg','pic/2015-02-14/_b_54df56628a459.jpg',0,0,0.00,0.00,'1','',0,''),(104,'8989','pic/2015-02-14/54df56cb18037.jpg','pic/2015-02-14/_s_54df56cb18037.jpg','pic/2015-02-14/_m_54df56cb18037.jpg','pic/2015-02-14/_b_54df56cb18037.jpg',0,0,0.00,0.00,'1','',0,''),(105,'8989','pic/2015-02-14/54df57fc86bed.jpg','pic/2015-02-14/_s_54df57fc86bed.jpg','pic/2015-02-14/_m_54df57fc86bed.jpg','pic/2015-02-14/_b_54df57fc86bed.jpg',0,0,0.00,0.00,'1','',0,''),(106,'4545','pic/2015-02-14/54df5adb201eb.jpg','pic/2015-02-14/_s_54df5adb201eb.jpg','pic/2015-02-14/_m_54df5adb201eb.jpg','pic/2015-02-14/_b_54df5adb201eb.jpg',0,0,0.00,0.00,'1','',0,''),(107,'4545','pic/2015-02-14/54df5b43cce5b.jpg','pic/2015-02-14/_s_54df5b43cce5b.jpg','pic/2015-02-14/_m_54df5b43cce5b.jpg','pic/2015-02-14/_b_54df5b43cce5b.jpg',0,0,0.00,0.00,'1','',0,''),(108,'4545','pic/2015-02-14/54df5b518d1b0.jpg','pic/2015-02-14/_s_54df5b518d1b0.jpg','pic/2015-02-14/_m_54df5b518d1b0.jpg','pic/2015-02-14/_b_54df5b518d1b0.jpg',0,0,0.00,0.00,'1','',0,''),(109,'4545','pic/2015-02-14/54df5c30b4400.jpg','pic/2015-02-14/_s_54df5c30b4400.jpg','pic/2015-02-14/_m_54df5c30b4400.jpg','pic/2015-02-14/_b_54df5c30b4400.jpg',0,0,0.00,0.00,'1','',0,''),(110,'4545','pic/2015-02-14/54df5c65d276c.jpg','pic/2015-02-14/_s_54df5c65d276c.jpg','pic/2015-02-14/_m_54df5c65d276c.jpg','pic/2015-02-14/_b_54df5c65d276c.jpg',0,0,0.00,0.00,'1','',0,''),(111,'4545','pic/2015-02-14/54df600a3c443.jpg','pic/2015-02-14/_s_54df600a3c443.jpg','pic/2015-02-14/_m_54df600a3c443.jpg','pic/2015-02-14/_b_54df600a3c443.jpg',0,0,0.00,0.00,'1','',0,''),(112,'7879','pic/2015-02-14/54df6058b9b1b.jpg','pic/2015-02-14/_s_54df6058b9b1b.jpg','pic/2015-02-14/_m_54df6058b9b1b.jpg','pic/2015-02-14/_b_54df6058b9b1b.jpg',0,0,0.00,0.00,'1','',0,'');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品属性表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_goods_attr`
--

LOCK TABLES `v_goods_attr` WRITE;
/*!40000 ALTER TABLE `v_goods_attr` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_goods_attr` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COMMENT='会员价格表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_member_price`
--

LOCK TABLES `v_member_price` WRITE;
/*!40000 ALTER TABLE `v_member_price` DISABLE KEYS */;
INSERT INTO `v_member_price` VALUES (1,1,76,48.00),(2,2,76,64.00),(3,3,76,849.00),(4,1,81,1000.00),(5,2,81,900.00),(6,3,81,800.00),(7,1,82,0.00),(8,2,82,0.00),(9,3,82,0.00),(10,1,83,0.00),(11,2,83,0.00),(12,3,83,0.00),(13,1,84,0.00),(14,2,84,0.00),(15,3,84,0.00),(16,1,85,0.00),(17,2,85,0.00),(18,3,85,0.00),(19,1,86,0.00),(20,2,86,0.00),(21,3,86,0.00),(22,1,87,0.00),(23,2,87,0.00),(24,3,87,0.00),(25,1,88,0.00),(26,2,88,0.00),(27,3,88,0.00),(28,1,89,0.00),(29,2,89,0.00),(30,3,89,0.00),(31,1,90,0.00),(32,2,90,0.00),(33,3,90,0.00),(34,1,91,0.00),(35,2,91,0.00),(36,3,91,0.00),(37,1,92,0.00),(38,2,92,0.00),(39,3,92,0.00),(40,1,93,0.00),(41,2,93,0.00),(42,3,93,0.00),(43,1,94,0.00),(44,2,94,0.00),(45,3,94,0.00),(46,1,95,0.00),(47,2,95,0.00),(48,3,95,0.00),(49,1,96,0.00),(50,2,96,0.00),(51,3,96,0.00),(52,1,97,0.00),(53,2,97,0.00),(54,3,97,0.00),(55,1,98,0.00),(56,2,98,0.00),(57,3,98,0.00),(58,1,99,0.00),(59,2,99,0.00),(60,3,99,0.00),(61,1,100,0.00),(62,2,100,0.00),(63,3,100,0.00),(64,1,101,0.00),(65,2,101,0.00),(66,3,101,0.00),(67,1,102,0.00),(68,2,102,0.00),(69,3,102,0.00),(70,1,103,0.00),(71,2,103,0.00),(72,3,103,0.00),(73,1,104,0.00),(74,2,104,0.00),(75,3,104,0.00),(76,1,105,0.00),(77,2,105,0.00),(78,3,105,0.00),(79,1,106,0.00),(80,2,106,0.00),(81,3,106,0.00),(82,1,107,0.00),(83,2,107,0.00),(84,3,107,0.00),(85,1,108,0.00),(86,2,108,0.00),(87,3,108,0.00),(88,1,109,0.00),(89,2,109,0.00),(90,3,109,0.00),(91,1,110,0.00),(92,2,110,0.00),(93,3,110,0.00),(94,1,111,0.00),(95,2,111,0.00),(96,3,111,0.00),(97,1,112,0.00),(98,2,112,0.00),(99,3,112,0.00);
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='商品图片表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_pics`
--

LOCK TABLES `v_pics` WRITE;
/*!40000 ALTER TABLE `v_pics` DISABLE KEYS */;
INSERT INTO `v_pics` VALUES (1,'Goods/2015-02-14/_S_54df600a64969.jpg','Goods/2015-02-14/_M_54df600a64969.jpg','Goods/2015-02-14/54df600a64969.jpg'),(2,'Goods/2015-02-14/_S_54df6058db85f.jpg','Goods/2015-02-14/_M_54df6058db85f.jpg','Goods/2015-02-14/54df6058db85f.jpg'),(3,'Goods/2015-02-14/_S_54df6058dc621.jpg','Goods/2015-02-14/_M_54df6058dc621.jpg','Goods/2015-02-14/54df6058dc621.jpg'),(4,'Goods/2015-02-14/_S_54df6058dd228.jpg','Goods/2015-02-14/_M_54df6058dd228.jpg','Goods/2015-02-14/54df6058dd228.jpg'),(5,'Goods/2015-02-14/_S_54df6058de329.jpg','Goods/2015-02-14/_M_54df6058de329.jpg','Goods/2015-02-14/54df6058de329.jpg');
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

-- Dump completed on 2015-02-14 22:55:50
