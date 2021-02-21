/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : aomeijia

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-02-21 23:24:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(15) NOT NULL COMMENT '管理员账户名',
  `password` varchar(60) NOT NULL COMMENT '管理员密码',
  `email` varchar(50) NOT NULL COMMENT '管理员邮箱',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '框架需要的认证token',
  `dept_id` int(11) DEFAULT NULL COMMENT '部门ID',
  `access_key` varchar(25) NOT NULL DEFAULT '' COMMENT '唯一标识符',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_key` (`name`) USING BTREE,
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('59', 'kefu', 'fdsfs', '111@qq.com', null, null, '');
INSERT INTO `admin_user` VALUES ('60', 'admin', '$2y$10$/yP3Y94WrtzAIdha060fj.YIjfT/hcZ1BV5K/0dUs9aS7PDec4KPi', '3756@qq.com', 'pQvzIYfRoHtvJ8q6fYcJYM4vmSn56gtlVU7RvecV29cX3EAoSJzXIQjxFDIv', '14', '1C694C95');
INSERT INTO `admin_user` VALUES ('61', 'hsy', '$2y$10$ruMYUY.tWiB0MBHu9FpiTOWci2XkD4npD6K9YRzmFeQzYAovdzky6', 's@qq.com', null, '16', '');
INSERT INTO `admin_user` VALUES ('62', 'wulanfang', '$2y$10$VlZz/5oFkKd90o9VhsN0OOhQHbTg0I7CIZvFoRYbZqyvGPXGcqFg.', '1016104367@qq.com', 'Z2IFxWgbg5syvccFpmL30FwRlqJGqY3F1VJpsqoNDC37mPmjEoECC3cRCgm4', '16', '');

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_user_id` int(11) NOT NULL COMMENT '管理员ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`),
  KEY `admin_user_id` (`admin_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='管理员私有权限';

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
INSERT INTO `admin_user_role` VALUES ('17', '21', '3');
INSERT INTO `admin_user_role` VALUES ('18', '21', '4');
INSERT INTO `admin_user_role` VALUES ('19', '32', '1');
INSERT INTO `admin_user_role` VALUES ('20', '37', '1');
INSERT INTO `admin_user_role` VALUES ('21', '37', '2');
INSERT INTO `admin_user_role` VALUES ('22', '37', '3');
INSERT INTO `admin_user_role` VALUES ('23', '37', '4');
INSERT INTO `admin_user_role` VALUES ('24', '37', '5');
INSERT INTO `admin_user_role` VALUES ('25', '37', '6');
INSERT INTO `admin_user_role` VALUES ('29', '43', '10');
INSERT INTO `admin_user_role` VALUES ('40', '54', '10');
INSERT INTO `admin_user_role` VALUES ('42', '57', '10');
INSERT INTO `admin_user_role` VALUES ('43', '58', '11');
INSERT INTO `admin_user_role` VALUES ('44', '59', '12');
INSERT INTO `admin_user_role` VALUES ('45', '60', '13');
INSERT INTO `admin_user_role` VALUES ('49', '66', '19');
INSERT INTO `admin_user_role` VALUES ('50', '67', '15');
INSERT INTO `admin_user_role` VALUES ('51', '68', '14');

-- ----------------------------
-- Table structure for api_modular
-- ----------------------------
DROP TABLE IF EXISTS `api_modular`;
CREATE TABLE `api_modular` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL DEFAULT '' COMMENT '模块名称',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `sort` int(4) NOT NULL,
  `access_key` varchar(25) NOT NULL,
  `created_at` varchar(25) NOT NULL DEFAULT '',
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of api_modular
-- ----------------------------
INSERT INTO `api_modular` VALUES ('1', '新品上市', 'uploads/images/fhgJ7pgVvH.png', '1', '4', '1C694C95', '1', '2017-02-22 13:49:23');
INSERT INTO `api_modular` VALUES ('2', '订单查询', 'uploads/images/IFaz56H6yx.png', '1', '3', '1C694C95', '2017-01-16 16:06:08', '2017-02-22 13:49:33');
INSERT INTO `api_modular` VALUES ('3', '我的积分', 'uploads/images/9Fl9YUBpV2.png', '1', '2', '1C694C95', '2017-01-16 16:14:26', '2017-02-22 13:49:55');
INSERT INTO `api_modular` VALUES ('4', '积分商城', 'uploads/images/U93Qt5EwX3.png', '1', '1', '1C694C95', '2017-01-18 13:53:05', '2017-02-22 13:49:43');
INSERT INTO `api_modular` VALUES ('5', '新品上市', 'uploads/images/czC9LsHHoC.jpg', '1', '4', '15402CB3', '2017-03-28 14:20:17', '2017-03-28 14:20:17');
INSERT INTO `api_modular` VALUES ('6', '订单查询', 'uploads/images/7vQyBCx5hT.jpg', '1', '2', '15402CB3', '2017-03-28 14:21:20', '2017-03-28 14:21:20');
INSERT INTO `api_modular` VALUES ('7', '我的积分', 'uploads/images/jAgoxMA4MW.jpg', '1', '0', '15402CB3', '2017-03-28 14:21:46', '2017-03-28 14:21:46');
INSERT INTO `api_modular` VALUES ('8', '积分商城', 'uploads/images/mo3IeNDZ5f.jpg', '1', '0', '15402CB3', '2017-03-28 14:22:01', '2017-03-28 14:22:01');

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '文章类型',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '封面图',
  `title` varchar(25) NOT NULL DEFAULT '' COMMENT '文章标题',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '文章描述',
  `content` text COMMENT '文章详情',
  `sort` varchar(25) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `read` int(11) NOT NULL DEFAULT '0' COMMENT '阅读量',
  `real_read` int(11) DEFAULT '0' COMMENT '真实阅读量',
  `publish_date` date DEFAULT NULL COMMENT '发布时间',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '2', 'uploads/images/8XB9HBqBTk.jpg', '这是加入我们的文章', '', '<p style=\"border: 0px none; margin-top: 30px; margin-bottom: 0px; padding: 0px; vertical-align: baseline; color: rgb(99, 99, 99); line-height: 30px; font-family: &quot;Microsoft YaHei&quot;, Helvetica, &quot;STHeiti STXihei&quot;, &quot;Microsoft JhengHei&quot;, Arial; white-space: normal;\"><span style=\"border: 0px none; margin: 0px; padding: 0px; vertical-align: baseline; font-family: arial, helvetica, sans-serif;\">Aumeca Group is a professional and earliest overseas real estate agent service company in China, with many years’ development, our company becomes the leading agency in China. Our head office located in Melbourne, Australia, we also have offices in Shenzhen, Shanghai, Guangzhou, Hefei in Mainland China.</span></p><p style=\"border: 0px none; margin-top: 30px; margin-bottom: 0px; padding: 0px; vertical-align: baseline; color: rgb(99, 99, 99); line-height: 30px; font-family: &quot;Microsoft YaHei&quot;, Helvetica, &quot;STHeiti STXihei&quot;, &quot;Microsoft JhengHei&quot;, Arial; white-space: normal;\"><span style=\"border: 0px none; margin: 0px; padding: 0px; vertical-align: baseline; font-family: arial, helvetica, sans-serif;\">Aumeca Group focus on provide professional overseas real estate consultation service to our customers, and we work closely with overseas developers and become one of the leading partners for major Australian developers for project sales and marketing into China. With expert team and experience on overseas property, we won our customers&#39; trust.</span></p><p style=\"border: 0px none; margin-top: 30px; margin-bottom: 0px; padding: 0px; vertical-align: baseline; color: rgb(99, 99, 99); line-height: 30px; font-family: &quot;Microsoft YaHei&quot;, Helvetica, &quot;STHeiti STXihei&quot;, &quot;Microsoft JhengHei&quot;, Arial; white-space: normal;\"><span style=\"border: 0px none; margin: 0px; padding: 0px; vertical-align: baseline; font-family: arial, helvetica, sans-serif;\">We also cooperate with leading migration companies to provide our customers tailor solution of migration and studying abroad.</span></p><p><br/></p>', '0', '1', '0', '0', '2021-02-19', '2021-02-13 22:04:27', '2021-02-13 22:04:27');
INSERT INTO `article` VALUES ('3', '3', 'uploads/images/nUrqsewHUj.jpg', '这是联系我们', '这是联系我们的描述', '<p style=\"text-align:center\"><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210213/1613225383128160.jpg\" title=\"1613225383128160.jpg\"/></p><p style=\"text-align: center;\">回复IE很温柔给个</p><p style=\"text-align:center\"><br/></p><p style=\"text-align: center;\">鸡飞狗叫法迪欧过节费都</p><p style=\"text-align:center\"><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210213/1613225385558313.jpg\" title=\"1613225385558313.jpg\"/></p><p style=\"text-align: center;\">和VB会计法单鹄寡凫结婚古代&nbsp;</p><p><br/></p>', '2', '1', '0', '0', null, '2021-02-13 22:10:19', '2021-02-13 22:15:28');
INSERT INTO `article` VALUES ('4', '1', 'uploads/images/RGdfIsTYnc.jpg', '不吧v', '放到沙发上', '<p>555555555555555555555555555555555555555555</p>', '2', '1', '0', '0', null, '2021-02-13 22:12:08', '2021-02-13 22:12:08');
INSERT INTO `article` VALUES ('5', '1', 'uploads/images/XWTAnCE2K0.jpg', '11', '11', '<p>范德萨发发生</p>', '0', '1', '0', '0', null, '2021-02-21 12:42:50', '2021-02-21 12:42:50');
INSERT INTO `article` VALUES ('6', '4', 'uploads/images/zW8CLUvPDf.jpg', '223', '223', '<p>范德萨范德萨发放到沙发上aaa</p>', '0', '2', '2233', '0', '2021-02-23', '2021-02-21 12:45:28', '2021-02-21 12:47:18');

-- ----------------------------
-- Table structure for article_type
-- ----------------------------
DROP TABLE IF EXISTS `article_type`;
CREATE TABLE `article_type` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL DEFAULT '' COMMENT '名称',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_type
-- ----------------------------
INSERT INTO `article_type` VALUES ('1', '公司简介', '2021-01-01', '2021-01-01');
INSERT INTO `article_type` VALUES ('2', '加入我们', '2021-01-01', '2021-01-01');
INSERT INTO `article_type` VALUES ('3', '联系我们', '2021-01-01', '2021-01-01');
INSERT INTO `article_type` VALUES ('4', '项目动态', '2021-01-01', '2021-01-01');

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '所属模块',
  `title` varchar(50) NOT NULL DEFAULT '0' COMMENT '标题',
  `describe` varchar(255) DEFAULT NULL COMMENT '图片描述',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `img_url` varchar(255) NOT NULL DEFAULT '0' COMMENT '图片地址',
  `sort` int(3) NOT NULL DEFAULT '1' COMMENT '排序',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态:1显示2隐藏',
  `updated_at` varchar(50) DEFAULT NULL COMMENT '更新时间',
  `created_at` varchar(50) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Banner表';

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES ('1', '1', '1111111', null, 'www.baidu.com', 'uploads/images/WRoDtzQlsq.jpg', '1', '1', '2021-02-13 16:28:30', '2021-02-13 16:28:30');
INSERT INTO `banner` VALUES ('2', '1', '222222', null, '22222', 'uploads/images/2bbwdoNWcE.jpg', '2', '1', '2021-02-13 16:29:33', '2021-02-13 16:29:33');
INSERT INTO `banner` VALUES ('3', '3', '33333311', null, '31', 'uploads/images/WT4Lx16o4q.jpg', '31', '1', '2021-02-13 16:34:19', '2021-02-13 16:30:14');
INSERT INTO `banner` VALUES ('4', '3', '海外', null, '11', 'uploads/images/T976kKuzR5.jpg', '1', '1', '2021-02-13 16:30:44', '2021-02-13 16:30:44');
INSERT INTO `banner` VALUES ('7', '2', '首页服务图片', null, '', 'uploads/images/IJ7FMek2QQ.jpg', '3', '1', '2021-02-13 20:49:58', '2021-02-13 20:49:58');
INSERT INTO `banner` VALUES ('8', '4', '严选房源', null, 'http://www.baidu.com', 'uploads/images/mDvpGytXRV.jpg', '1', '1', '2021-02-14 12:55:44', '2021-02-14 12:55:44');
INSERT INTO `banner` VALUES ('9', '1', '贷款服务', '量身定制还款方案', '111', 'uploads/images/coQI7lzxcS.jpg', '2', '1', '2021-02-14 13:00:29', '2021-02-14 12:56:16');
INSERT INTO `banner` VALUES ('10', '4', '房屋交易', '整合专业机构保证交易安全', '', 'uploads/images/j9vzQ5N1K4.jpg', '111', '1', '2021-02-14 13:00:13', '2021-02-14 12:56:51');
INSERT INTO `banner` VALUES ('11', '4', '租赁管理', '房屋管理与管理，保证权益', '', 'uploads/images/KIc3VWqKW5.jpeg', '2', '1', '2021-02-14 12:59:01', '2021-02-14 12:59:01');

-- ----------------------------
-- Table structure for banner_type
-- ----------------------------
DROP TABLE IF EXISTS `banner_type`;
CREATE TABLE `banner_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `status` int(11) NOT NULL COMMENT '状态：2隐藏1使用',
  `updated_at` varchar(50) DEFAULT NULL COMMENT '更新时间',
  `created_at` varchar(50) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Banner类型表';

-- ----------------------------
-- Records of banner_type
-- ----------------------------
INSERT INTO `banner_type` VALUES ('1', '首页banner', '这是首页banner', '1', '2021-02-13 16:21:51', '2020-11-02');
INSERT INTO `banner_type` VALUES ('2', '首页服务图片', '这是首页服务图片', '1', '2021-02-13 20:47:21', '2020-11-05');
INSERT INTO `banner_type` VALUES ('3', '海外房产banner', '这是描述海外房产banner', '1', '2021-02-13 16:25:54', '2020-11-08');
INSERT INTO `banner_type` VALUES ('4', '首页售前售后服务', '这是首页售前售后服务内容', '1', '2021-01-01', '2021-01-01');
INSERT INTO `banner_type` VALUES ('5', '海外房产购房流程图片', '这是海外房产购房流程图片', '1', '2021-01-01', '2021-01-01');
INSERT INTO `banner_type` VALUES ('6', '首页微信文章背景图片', '这是首页微信文章背景图片', '1', '2021-01-01', '2021-01-01');
INSERT INTO `banner_type` VALUES ('7', '首页宣传图片', '这是首页热门展会下面的宣传图片', '1', '2021-01-01', '2021-01-01');

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT '父ID',
  `name` varchar(100) DEFAULT NULL COMMENT '城市名称',
  `english_name` varchar(100) DEFAULT NULL COMMENT '英文名称',
  `pic` varchar(100) DEFAULT NULL COMMENT '图标',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `hot` int(11) DEFAULT '2' COMMENT '是否热门，1是热门，2不是热门',
  `updated_at` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COMMENT='城市表';

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('103', '0', '亚洲', null, 'uploads/goodsType/R0IYCJ0QsX.png', '2', '2', '2018-10-05 15:25:10', '2017-04-18 11:29:41');
INSERT INTO `city` VALUES ('104', '0', '欧洲', null, 'uploads/goodsType/hf34UNoVUO.png', '1', '1', '2018-10-22 13:39:28', '2017-04-18 11:30:05');
INSERT INTO `city` VALUES ('105', '0', '北美洲', null, 'uploads/city/WMhS2ljf9l.jpg', '1', '2', '2021-02-13 18:06:28', '2017-04-18 11:30:30');
INSERT INTO `city` VALUES ('106', '0', '南美洲', null, 'uploads/goodsType/yQItbqKFjZ.png', '4', '1', '2018-10-05 15:24:48', '2017-04-18 11:30:46');
INSERT INTO `city` VALUES ('152', '103', '中国', null, '', '1', '2', '2021-02-13 17:57:58', '2021-02-13 17:57:58');
INSERT INTO `city` VALUES ('153', '103', '日本', null, '', '1', '2', '2021-02-13 17:58:29', '2021-02-13 17:58:29');
INSERT INTO `city` VALUES ('154', '152', '江西', null, 'uploads/city/EShuAp3cBE.jpg', '1', '2', '2021-02-13 18:00:15', '2021-02-13 18:00:15');
INSERT INTO `city` VALUES ('155', '152', '广东', null, 'uploads/city/RHinydexAf.jpg', '2', '1', '2021-02-13 18:00:48', '2021-02-13 18:00:48');
INSERT INTO `city` VALUES ('156', '153', '东京', null, 'uploads/city/C8VCp1hjYj.jpg', '1', '2', '2021-02-13 18:02:00', '2021-02-13 18:02:00');
INSERT INTO `city` VALUES ('157', '105', '美国', null, 'uploads/city/ZUk4UNfPIk.jpg', '1', '2', '2021-02-13 18:02:59', '2021-02-13 18:02:59');
INSERT INTO `city` VALUES ('159', '105', '加拿大', null, 'uploads/city/6wqjeW45iL.jpg', '0', '1', '2021-02-14 13:05:39', '2021-02-13 18:09:16');
INSERT INTO `city` VALUES ('161', '152', '福建', null, '', '3', '2', '2021-02-13 19:47:17', '2021-02-13 19:47:17');
INSERT INTO `city` VALUES ('162', '152', '北京', null, 'uploads/city/TrpuwEcbcB.jpeg', '0', '1', '2021-02-14 13:06:21', '2021-02-14 13:06:21');
INSERT INTO `city` VALUES ('163', '103', '马来西亚', 'Malaysia', 'uploads/city/5PHk0rU93D.jpg', '0', '1', '2021-02-15 17:34:47', '2021-02-15 17:30:10');
INSERT INTO `city` VALUES ('164', '103', '新加坡', 'Singapore', '', '0', '1', '2021-02-15 17:32:45', '2021-02-15 17:32:45');

-- ----------------------------
-- Table structure for company_config
-- ----------------------------
DROP TABLE IF EXISTS `company_config`;
CREATE TABLE `company_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(30) DEFAULT NULL COMMENT '公司名称',
  `custom_service_phone` varchar(20) DEFAULT NULL COMMENT '咨询电话',
  `synopsis` varchar(255) DEFAULT NULL COMMENT '公司简介',
  `header_logo` varchar(255) DEFAULT NULL COMMENT '公司顶部logo',
  `footer_logo` varchar(255) DEFAULT NULL COMMENT '公司底部logo',
  `wechat1_img` varchar(255) DEFAULT NULL COMMENT '澳美家海外微信公众号',
  `wechat2_img` varchar(255) DEFAULT NULL COMMENT '财富管理公众号',
  `video` varchar(255) DEFAULT NULL COMMENT '首页视频链接',
  `copyright` varchar(255) DEFAULT NULL COMMENT '版权所有',
  `updated_at` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='公司资料表';

-- ----------------------------
-- Records of company_config
-- ----------------------------
INSERT INTO `company_config` VALUES ('1', '澳美家有限公司111', '4007-889-229', null, 'uploads/img/GX4nYiVHEV.jpeg', 'uploads/img/iVrjIyXmfn.png', 'uploads/img/WoDbVgCn3W.jpg', 'uploads/img/fj9pFPBbEW.jpg', 'http://tbm-auth.alicdn.com/MuYAdUyjik1RFvQKAQo/Ij896pWpCfIh7XMbbcH__hdregop.mp4?auth_key=1613308075-0-0-9e98182bd5764657d53cac09e8481929', '广东澳美家投资咨询有限公司', '2021-02-14 20:23:14', '2017-02-25 14:25:30');

-- ----------------------------
-- Table structure for company_modular
-- ----------------------------
DROP TABLE IF EXISTS `company_modular`;
CREATE TABLE `company_modular` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `access_key` varchar(25) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `modular_id` int(13) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_modular
-- ----------------------------
INSERT INTO `company_modular` VALUES ('44', '22F99454-4767-6D33-BD27', '1');
INSERT INTO `company_modular` VALUES ('49', 'F4482715-25BD-DC11-873A', '1');
INSERT INTO `company_modular` VALUES ('50', 'F4482715-25BD-DC11-873A', '2');
INSERT INTO `company_modular` VALUES ('51', 'F4482715-25BD-DC11-873A', '3');
INSERT INTO `company_modular` VALUES ('52', 'F4482715-25BD-DC11-873A', '4');
INSERT INTO `company_modular` VALUES ('53', 'F4482715-25BD-DC11-873A', '5');
INSERT INTO `company_modular` VALUES ('121', 'F4482715-25BD-DC11-873A', '7');
INSERT INTO `company_modular` VALUES ('123', '1C694C95', '2');
INSERT INTO `company_modular` VALUES ('124', '1C694C95', '4');
INSERT INTO `company_modular` VALUES ('125', '1C694C95', '5');
INSERT INTO `company_modular` VALUES ('126', '1C694C95', '7');
INSERT INTO `company_modular` VALUES ('127', '1C694C95', '8');
INSERT INTO `company_modular` VALUES ('128', '1C694C95', '9');
INSERT INTO `company_modular` VALUES ('130', '1C694C95', '10');
INSERT INTO `company_modular` VALUES ('131', '1C694C95', '11');
INSERT INTO `company_modular` VALUES ('136', '15402CB3', '2');
INSERT INTO `company_modular` VALUES ('137', '15402CB3', '4');
INSERT INTO `company_modular` VALUES ('138', '15402CB3', '5');
INSERT INTO `company_modular` VALUES ('139', '15402CB3', '7');
INSERT INTO `company_modular` VALUES ('140', '15402CB3', '8');
INSERT INTO `company_modular` VALUES ('141', '15402CB3', '9');
INSERT INTO `company_modular` VALUES ('142', '15402CB3', '10');
INSERT INTO `company_modular` VALUES ('143', '15402CB3', '11');
INSERT INTO `company_modular` VALUES ('144', '1C694C95', '12');
INSERT INTO `company_modular` VALUES ('145', '1C694C95', '13');

-- ----------------------------
-- Table structure for customer_consult
-- ----------------------------
DROP TABLE IF EXISTS `customer_consult`;
CREATE TABLE `customer_consult` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '客户名字',
  `type` int(10) DEFAULT NULL COMMENT '客户咨询类型，1预约看房,2预约移民,3预约投资',
  `phone` int(11) DEFAULT NULL COMMENT '电话号码',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `wechat` varchar(100) DEFAULT NULL COMMENT '微信号',
  `content` text COMMENT '客户咨询内容',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='客户咨询表';

-- ----------------------------
-- Records of customer_consult
-- ----------------------------
INSERT INTO `customer_consult` VALUES ('1', '小吴', '1', '1234567', '111@qq.com', 'wx1234567', 'ggdgfdgdfhdfghfgh', '2021-01-01', '2021-01-01');
INSERT INTO `customer_consult` VALUES ('2', '小张', '2', '22222', '222@1qq.com', 'wx2222', 'fdsfdsfs', '2021-01-01', '2021-01-01');

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '部门名称',
  `pid` int(11) NOT NULL COMMENT '上级部门',
  `access_key` varchar(25) NOT NULL DEFAULT '' COMMENT '唯一标识',
  PRIMARY KEY (`id`),
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('14', '管理部', '0', '1C694C95');
INSERT INTO `department` VALUES ('15', '客服部', '14', '');
INSERT INTO `department` VALUES ('16', '客户专员部', '15', '');

-- ----------------------------
-- Table structure for department_role
-- ----------------------------
DROP TABLE IF EXISTS `department_role`;
CREATE TABLE `department_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL COMMENT '部门id',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`),
  KEY `key_department_id` (`department_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COMMENT='部门角色关联表';

-- ----------------------------
-- Records of department_role
-- ----------------------------
INSERT INTO `department_role` VALUES ('77', '14', '13');
INSERT INTO `department_role` VALUES ('78', '15', '14');
INSERT INTO `department_role` VALUES ('79', '16', '15');

-- ----------------------------
-- Table structure for enum
-- ----------------------------
DROP TABLE IF EXISTS `enum`;
CREATE TABLE `enum` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '枚举名称',
  `type` int(10) DEFAULT NULL COMMENT '枚举类型，1房产类型,2房产标签,3房产特色,4移民类型,5移民投资金额',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='枚举表';

-- ----------------------------
-- Records of enum
-- ----------------------------
INSERT INTO `enum` VALUES ('1', '公寓', '1', '0', '1', '2021-02-21 15:42:49', '2021-02-21 15:42:49');
INSERT INTO `enum` VALUES ('2', '别墅', '1', '0', '2', '2021-02-21 15:43:01', '2021-02-21 15:43:01');
INSERT INTO `enum` VALUES ('3', '写字楼', '1', '0', '1', '2021-02-21 15:43:14', '2021-02-21 15:43:14');
INSERT INTO `enum` VALUES ('4', '50万以下', '2', '3', '1', '2021-02-21 15:43:40', '2021-02-21 15:43:40');
INSERT INTO `enum` VALUES ('5', '50-100万1', '2', '21', '2', '2021-02-21 15:43:56', '2021-02-21 15:44:12');
INSERT INTO `enum` VALUES ('6', '学区房', '3', '0', '1', '2021-02-21 15:45:23', '2021-02-21 15:45:23');
INSERT INTO `enum` VALUES ('7', '投资房', '3', '3', '1', '2021-02-21 15:45:39', '2021-02-21 15:45:39');
INSERT INTO `enum` VALUES ('8', '不限购', '2', '0', '1', '2021-02-21 20:51:54', '2021-02-21 20:51:54');
INSERT INTO `enum` VALUES ('9', '自住', '2', '0', '1', '2021-02-21 20:52:10', '2021-02-21 20:52:10');

-- ----------------------------
-- Table structure for holds
-- ----------------------------
DROP TABLE IF EXISTS `holds`;
CREATE TABLE `holds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '用户账号',
  `sid` smallint(4) NOT NULL COMMENT '商品id',
  `hdate` date NOT NULL COMMENT '持仓日期',
  `hprice` decimal(16,2) DEFAULT NULL COMMENT '持仓成本',
  `hnum` int(10) unsigned DEFAULT NULL COMMENT '持仓数量',
  `amount` decimal(16,2) DEFAULT NULL COMMENT 'GetRich金额',
  `in_date` date DEFAULT NULL COMMENT '入账日期',
  `status` int(1) unsigned zerofill DEFAULT '0' COMMENT '0 未结算，1 已结算',
  `sdate` varchar(20) DEFAULT NULL COMMENT 'close date结算日期',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新时间',
  `created_at` varchar(20) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of holds
-- ----------------------------
INSERT INTO `holds` VALUES ('2', '60', '4', '2019-04-09', '15.00', '16', '20.00', '2019-04-02', '1', '2019-04-11 11:33:17', '2019-04-11 11:34:41', null);
INSERT INTO `holds` VALUES ('4', '60', '5', '2019-04-01', '12.11', '12', '-12.00', '2019-03-31', '1', '2019-04-11 14:28:57', '2019-04-11 14:28:57', '2019-04-11 09:56:27');
INSERT INTO `holds` VALUES ('5', '60', '8', '2019-04-05', '16.66', '16', '28.22', '2019-04-03', '1', '2019-04-11 11:43:42', '2019-04-11 11:43:42', '2019-04-11 10:01:38');
INSERT INTO `holds` VALUES ('6', '60', '4', '2019-04-03', '11.11', '11', '110.11', null, '0', null, null, null);
INSERT INTO `holds` VALUES ('7', '59', '5', '2019-04-11', '11.00', '111', '1.00', '2019-04-11', '1', '2019-04-11 11:58:28', '2019-04-11 11:58:28', '2019-04-11 11:57:12');
INSERT INTO `holds` VALUES ('8', '61', '9', '2019-04-11', '8.15', '1300', null, null, '0', null, '2019-04-11 14:13:45', '2019-04-11 14:13:45');
INSERT INTO `holds` VALUES ('9', '62', '10', '2019-04-13', '15.90', '1000', null, null, '0', null, '2019-04-13 14:52:14', '2019-04-13 14:52:14');

-- ----------------------------
-- Table structure for home_modular
-- ----------------------------
DROP TABLE IF EXISTS `home_modular`;
CREATE TABLE `home_modular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modular_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '模块类型',
  `modular_name` varchar(15) DEFAULT NULL COMMENT '模块名称',
  `modular_img` varchar(255) DEFAULT NULL COMMENT '模块图片',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `access_key` varchar(25) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='首页模块表';

-- ----------------------------
-- Records of home_modular
-- ----------------------------
INSERT INTO `home_modular` VALUES ('19', '2', '今日推荐', 'uploads/homeModular/kuHsS6efmm.jpg', '2', null, '2018-09-15 22:00:08', '2017-04-17 13:55:34');
INSERT INTO `home_modular` VALUES ('21', '4', '猜你喜欢', 'uploads/homeModular/QXgohheIf0.JPG', '1', null, '2017-05-06 22:19:15', '2017-04-17 13:58:42');
INSERT INTO `home_modular` VALUES ('23', '2', '热门市场', 'uploads/homeModular/Gsl0Us0Xvx.png', '10', null, '2018-09-29 15:54:16', '2017-05-05 14:32:38');

-- ----------------------------
-- Table structure for home_modular_content
-- ----------------------------
DROP TABLE IF EXISTS `home_modular_content`;
CREATE TABLE `home_modular_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) DEFAULT NULL COMMENT '标题',
  `desc` varchar(15) DEFAULT NULL COMMENT '描述',
  `modular_id` int(11) DEFAULT NULL COMMENT '模块ID',
  `img` varchar(255) DEFAULT NULL COMMENT '图片',
  `goods_type_id` int(11) DEFAULT NULL COMMENT '商品类型ID',
  `goods_id` varchar(50) DEFAULT NULL COMMENT '商品id 类型跟ID只能是一个',
  `access_key` varchar(25) DEFAULT NULL,
  `sort` tinyint(1) DEFAULT NULL COMMENT '排序',
  `updated_at` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modular_id` (`modular_id`),
  KEY `access_key` (`access_key`),
  KEY `modular_id_2` (`modular_id`,`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='首页模块内容表';

-- ----------------------------
-- Records of home_modular_content
-- ----------------------------
INSERT INTO `home_modular_content` VALUES ('54', null, null, '19', 'uploads/homeModularC/mymXmUmg98.jpg', null, '109,138', null, '1', '2018-10-01 22:38:49', '2017-04-17 13:55:34');
INSERT INTO `home_modular_content` VALUES ('56', null, null, '21', 'uploads/homeModularC/vfVhue8NxZ.png', null, '135,113,115,140,134,114,137,132,112,111,136,141', null, '1', '2018-10-15 21:59:20', '2017-04-17 13:58:42');
INSERT INTO `home_modular_content` VALUES ('58', null, null, '23', 'uploads/homeModularC/kbVW8KxAxu.jpg', null, '110,108,107,105,106', null, '1', '2018-09-29 15:54:16', '2017-05-05 14:32:38');

-- ----------------------------
-- Table structure for hot_search
-- ----------------------------
DROP TABLE IF EXISTS `hot_search`;
CREATE TABLE `hot_search` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `words` varchar(100) NOT NULL DEFAULT '' COMMENT '搜索词',
  `type` int(10) DEFAULT NULL COMMENT '搜索词类型，1投资主题,2海外房产,3成功案例,4百科资讯',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='热门搜索词';

-- ----------------------------
-- Records of hot_search
-- ----------------------------
INSERT INTO `hot_search` VALUES ('7', '投资1', '1', '0', '1', '2021-02-21 10:31:23', '2021-02-21 10:31:23');
INSERT INTO `hot_search` VALUES ('8', '投资2', '1', '0', '2', '2021-02-21 10:32:47', '2021-02-21 10:32:47');
INSERT INTO `hot_search` VALUES ('9', '房产1', '2', '0', '1', '2021-02-21 10:32:58', '2021-02-21 10:32:58');
INSERT INTO `hot_search` VALUES ('10', '房产2', '2', '0', '1', '2021-02-21 10:33:12', '2021-02-21 10:33:12');
INSERT INTO `hot_search` VALUES ('11', '房产3', '2', '3', '2', '2021-02-21 10:33:23', '2021-02-21 10:33:49');

-- ----------------------------
-- Table structure for integral_goods
-- ----------------------------
DROP TABLE IF EXISTS `integral_goods`;
CREATE TABLE `integral_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(15) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL COMMENT '商品名称',
  `thumbnail` varchar(150) DEFAULT '' COMMENT '缩略图',
  `banner_pic` text COMMENT '轮播图片',
  `article` text COMMENT '介绍详情',
  `field` text COMMENT '显示字段',
  `amount` decimal(16,2) DEFAULT NULL COMMENT '金额',
  `integral` decimal(16,2) DEFAULT NULL COMMENT '积分',
  `status` tinyint(1) DEFAULT '2' COMMENT '商品上下架：1上架2下架',
  `access_key` varchar(25) DEFAULT NULL COMMENT '所属key',
  `updated_at` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`),
  KEY `name_2` (`name`),
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='积分商品表';

-- ----------------------------
-- Records of integral_goods
-- ----------------------------
INSERT INTO `integral_goods` VALUES ('6', 'Q14918224238342', '国行iPad mini 4平板电脑 7', 'uploads/integralGoods/JTmkp4eOvp.jpg', 'uploads/integralGoods/zvPxMGW2H3.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491822418271771.jpg\" title=\"1491822418271771.jpg\" alt=\"国行iPad mini 4详情1.jpg\"/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:6:\"型号\";s:5:\"value\";s:31:\"国行iPad mini 4平板电脑 7\";}}', '2768.00', '25000.00', '1', '1C694C95', '2017-04-10 22:55:15', '2017-04-10 19:07:03');
INSERT INTO `integral_goods` VALUES ('7', 'D14918230177476', '小米 红米智能手机4X 金色  4G+全', 'uploads/integralGoods/BAb9HU9MW6.jpg', 'uploads/integralGoods/piIM3itbNm.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491822802139749.png\" title=\"1491822802139749.png\" alt=\"blob.png\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491823013911489.jpg\" title=\"1491823013911489.jpg\" alt=\"红米4X 手机详情1.jpg\"/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:6:\"型号\";s:5:\"value\";s:8:\"红米4x\";}}', '899.00', '7000.00', '1', '1C694C95', '2017-04-10 22:57:02', '2017-04-10 19:16:57');
INSERT INTO `integral_goods` VALUES ('8', 'B14918239900263', '小米5s  智能手机  4G+全网通  ', 'uploads/integralGoods/EPUWfdxYNx.jpg', 'uploads/integralGoods/hVlsG0tRch.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491823954453706.jpg\" title=\"1491823954453706.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491823958453328.jpg\" title=\"1491823958453328.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491823965771075.jpg\" title=\"1491823965771075.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491823973580487.jpg\" title=\"1491823973580487.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491823980304312.jpg\" title=\"1491823980304312.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491823984214395.jpg\" title=\"1491823984214395.jpg\"/></p><p><br/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:6:\"手机\";s:5:\"value\";s:8:\"小米5s\";}}', '1999.00', '17000.00', '1', '1C694C95', '2017-04-10 19:44:07', '2017-04-10 19:33:10');
INSERT INTO `integral_goods` VALUES ('9', 'W14918251422497', '德国博朗男士电动剃须刀MG5050  充', 'uploads/integralGoods/MLWYGywcUJ.jpg', 'uploads/integralGoods/QdHI6VVFqc.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825096952552.jpg\" title=\"1491825096952552.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825102342200.jpg\" title=\"1491825102342200.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825109216634.jpg\" title=\"1491825109216634.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825112159906.jpg\" title=\"1491825112159906.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825117285654.jpg\" title=\"1491825117285654.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825121373032.jpg\" title=\"1491825121373032.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825125544075.jpg\" title=\"1491825125544075.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825129954162.jpg\" title=\"1491825129954162.jpg\"/></p><p><br/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:3:\"xxx\";s:5:\"value\";s:44:\"德国博朗男士电动剃须刀MG5050  充\";}}', '399.00', '3000.00', '1', '1C694C95', '2017-04-10 22:29:02', '2017-04-10 19:52:22');
INSERT INTO `integral_goods` VALUES ('10', 'S14918257574675', '耐克NIKE CHEYENNE 3.0 ', 'uploads/integralGoods/000hu1kUIl.jpg', 'uploads/integralGoods/hl5wFasdFR.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825720301147.jpg\" title=\"1491825720301147.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825720103985.jpg\" title=\"1491825720103985.jpg\"/></p><p><br/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825720543051.jpg\" title=\"1491825720543051.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825720720571.jpg\" title=\"1491825720720571.jpg\"/></p><p><br/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491825720639405.jpg\" title=\"1491825720639405.jpg\"/></p><p><br/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:3:\"xxx\";s:5:\"value\";s:24:\"耐克NIKE CHEYENNE 3.0 \";}}', '319.00', '2600.00', '1', '1C694C95', '2017-04-10 22:28:35', '2017-04-10 20:02:37');
INSERT INTO `integral_goods` VALUES ('11', 'G14918263130429', '小米(MI) 10000毫安 移动电源/', 'uploads/integralGoods/lSg0FVUu92.jpg', 'uploads/integralGoods/MKussqjSVx.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826293811943.jpg\" title=\"1491826293811943.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826293953253.jpg\" title=\"1491826293953253.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826293153892.jpg\" title=\"1491826293153892.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826294456013.jpg\" title=\"1491826294456013.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826294655529.jpg\" title=\"1491826294655529.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826294276896.jpg\" title=\"1491826294276896.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826295928035.jpg\" title=\"1491826295928035.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826295983898.jpg\" title=\"1491826295983898.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826295451890.jpg\" title=\"1491826295451890.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491826295452720.jpg\" title=\"1491826295452720.jpg\"/></p><p><br/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:3:\"xxx\";s:5:\"value\";s:36:\"小米(MI) 10000毫安 移动电源/\";}}', '149.00', '1000.00', '1', '1C694C95', '2017-04-10 22:28:23', '2017-04-10 20:11:53');
INSERT INTO `integral_goods` VALUES ('12', 'M14918271161741', '爱仕达 30CM新一代铸铁锈不了炒锅WG', 'uploads/integralGoods/WO96pRTEsJ.jpg', 'uploads/integralGoods/TEMpPO7a92.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491827104359281.jpg\" title=\"1491827104359281.jpg\"/></p><p><br/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491827104858176.jpg\" title=\"1491827104858176.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491827104116932.jpg\" title=\"1491827104116932.jpg\"/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:6:\"型号\";s:5:\"value\";s:46:\"爱仕达 30CM新一代铸铁锈不了炒锅WG\";}}', '299.00', '2500.00', '1', '1C694C95', '2017-04-10 22:57:54', '2017-04-10 20:25:16');
INSERT INTO `integral_goods` VALUES ('13', 'B14918277047504', '松下（Panasonic）电吹风机家用E', 'uploads/integralGoods/qr0GStcYg3.jpg', 'uploads/integralGoods/NUyHmjdvEF.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491827664565819.jpg\" title=\"1491827664565819.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491827670469792.jpg\" title=\"1491827670469792.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491827676203727.jpg\" title=\"1491827676203727.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491827681960973.jpg\" title=\"1491827681960973.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491827688783207.jpg\" title=\"1491827688783207.jpg\"/></p><p><br/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:3:\"xxx\";s:5:\"value\";s:40:\"松下（Panasonic）电吹风机家用E\";}}', '189.00', '1500.00', '1', '1C694C95', '2017-04-10 22:27:57', '2017-04-10 20:35:04');
INSERT INTO `integral_goods` VALUES ('14', 'E14918282968831', '艾美特(Airmate)五叶遥控落地扇/', 'uploads/integralGoods/o44HTtTKtm.jpg', 'uploads/integralGoods/HRThUwioOH.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491828291695640.jpg\" title=\"1491828291695640.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491828291272296.jpg\" title=\"1491828291272296.jpg\"/></p><p><br/></p></div>', 'a:1:{i:0;a:2:{s:4:\"name\";s:3:\"xxx\";s:5:\"value\";s:40:\"艾美特(Airmate)五叶遥控落地扇/\";}}', '249.00', '3300.00', '1', '1C694C95', '2017-04-10 22:27:43', '2017-04-10 20:44:56');
INSERT INTO `integral_goods` VALUES ('15', 'Z14918292529356', 'diplomat/外交官24英寸万向轮静', 'uploads/integralGoods/A3UOYnjjlK.jpg', 'uploads/integralGoods/vR1ZOrbCtm.jpg', '<div style=max-width:100%; overflow: hidden;><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491829219233642.jpg\" title=\"1491829219233642.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491829219436512.jpg\" title=\"1491829219436512.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491829219920988.jpg\" title=\"1491829219920988.jpg\"/></p><p><br/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491829219466287.jpg\" title=\"1491829219466287.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491829219965986.jpg\" title=\"1491829219965986.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491829219485339.jpg\" title=\"1491829219485339.jpg\"/></p><p><img src=\"http://shopping.weilicx.com/uploads/ueditor/image/20170410/1491829219259039.jpg\" title=\"1491829219259039.jpg\"/></p><p><br/></p></div>', null, '399.00', '2000.00', '1', '1C694C95', '2017-04-11 10:16:21', '2017-04-10 21:00:52');

-- ----------------------------
-- Table structure for integral_proportion
-- ----------------------------
DROP TABLE IF EXISTS `integral_proportion`;
CREATE TABLE `integral_proportion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proportion` int(11) DEFAULT NULL COMMENT '比例',
  `access_key` varchar(25) DEFAULT NULL COMMENT '拥有者',
  `updated_at` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `access_key_2` (`access_key`),
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='积分比例';

-- ----------------------------
-- Records of integral_proportion
-- ----------------------------
INSERT INTO `integral_proportion` VALUES ('1', '10', '1C694C95', '2017-03-01 09:39:08', '2017-02-23 10:54:37');

-- ----------------------------
-- Table structure for link
-- ----------------------------
DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '链接类型',
  `title` varchar(25) NOT NULL DEFAULT '' COMMENT '链接名称',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '链接的url链接',
  `sort` varchar(25) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示，1显示，2不显示',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of link
-- ----------------------------
INSERT INTO `link` VALUES ('1', '1', '柬埔寨房产', 'https://www.baidu.com', '0', '1', '2021-02-14 23:56:10', '2021-02-14 23:56:10');
INSERT INTO `link` VALUES ('2', '2', '欧洲移民', 'https://www.baidu.com/', '0', '1', '2021-02-14 23:56:27', '2021-02-14 23:56:27');
INSERT INTO `link` VALUES ('4', '4', '百度', 'https://www.baidu.com/', '0', '1', '2021-02-15 00:07:52', '2021-02-15 00:07:52');
INSERT INTO `link` VALUES ('5', '4', '腾讯网', 'http://tengxun.com', '3', '1', '2021-02-15 11:12:54', '2021-02-15 17:55:20');

-- ----------------------------
-- Table structure for link_type
-- ----------------------------
DROP TABLE IF EXISTS `link_type`;
CREATE TABLE `link_type` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL DEFAULT '' COMMENT '名称',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of link_type
-- ----------------------------
INSERT INTO `link_type` VALUES ('1', '全球房产', '2021-01-01', '2021-01-01');
INSERT INTO `link_type` VALUES ('2', '全球移民', '2021-01-01', '2021-01-01');
INSERT INTO `link_type` VALUES ('3', '关于公司', '2021-01-01', '2021-01-01');
INSERT INTO `link_type` VALUES ('4', '友情链接', '2021-01-01', '2021-01-01');
INSERT INTO `link_type` VALUES ('5', '微信文章链接', '2021-01-01', '2021-01-01');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modular_id` int(11) NOT NULL COMMENT '模块ID',
  `menu_key` varchar(30) NOT NULL COMMENT '菜单key',
  `menu_title` varchar(15) NOT NULL COMMENT '菜单名称',
  `menu_url` varchar(100) NOT NULL COMMENT '菜单url',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COMMENT='权限菜单表';

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '11', 'stocksManage', '添加商品', '/stocks/addStocks', '0');
INSERT INTO `menu` VALUES ('2', '11', 'stocksManage', '商品管理', '/stocks/stocksList', '1');
INSERT INTO `menu` VALUES ('5', '12', 'wechatConfigManage', '微信配置', '/wechatConfig/wechatConfigList', '1');
INSERT INTO `menu` VALUES ('6', '4', 'adminManage', '人员管理', '/user/userList', '1');
INSERT INTO `menu` VALUES ('7', '4', 'deptManage', '部门管理', '/department/departmentList', '2');
INSERT INTO `menu` VALUES ('8', '4', 'roleManage', '角色权限管理', '/role/roleList', '3');
INSERT INTO `menu` VALUES ('11', '5', 'linkTypeManage', '链接类型管理', '/link/linkTypeList', '1');
INSERT INTO `menu` VALUES ('12', '5', 'linManage', '链接管理', '/link/linkList', '3');
INSERT INTO `menu` VALUES ('17', '8', 'articleTypeManage', '文章类型管理', '/article/articleTypeList', '2');
INSERT INTO `menu` VALUES ('18', '8', 'articleManage', '文章管理', '/article/articleList', '1');
INSERT INTO `menu` VALUES ('21', '9', 'integralDetailManage', '宝分明细', '/finance/integralList', '3');
INSERT INTO `menu` VALUES ('22', '9', 'bankCardManage', '银行卡管理', '/finance/bankCardList', '4');
INSERT INTO `menu` VALUES ('25', '10', 'orderManage', '线上订单管理', '/order/orderList', '1');
INSERT INTO `menu` VALUES ('28', '11', 'stocksManage', '修改商品', '/stocks/updateStocks', '0');
INSERT INTO `menu` VALUES ('32', '9', 'integralWithdrawalManage', '宝分兑现管理', '/finance/integralWithdrawalsList', '4');
INSERT INTO `menu` VALUES ('33', '4', 'companyConfigManage', '公司资料设置', '/home/companyConfigSet', '4');
INSERT INTO `menu` VALUES ('34', '10', 'returnManage', '退货管理', '/order/returnList', '2');
INSERT INTO `menu` VALUES ('35', '5', 'partnerTypeManage', '合作伙伴类型管理', '/partner/partnerTypeList', '5');
INSERT INTO `menu` VALUES ('39', '12', 'storeManage', '商家管理', '/storeList', '1');
INSERT INTO `menu` VALUES ('40', '12', 'storeTypeManage', '商家类型管理', '/storeType/storeTypeList', '2');
INSERT INTO `menu` VALUES ('41', '7', 'memberManage', '用户管理', '/member/userList', '2');
INSERT INTO `menu` VALUES ('42', '7', 'distributorManage', '渠道商申请管理', '/member/distributorList', '3');
INSERT INTO `menu` VALUES ('43', '13', 'channelManage', '分销管理', '/RelationsList', '1');
INSERT INTO `menu` VALUES ('44', '10', 'downOrderManage', '线下订单管理', '/order/downOrderList', '1');
INSERT INTO `menu` VALUES ('45', '14', 'stocksManage', '商品管理', '/stocks/stocksList', '0');
INSERT INTO `menu` VALUES ('46', '11', 'stocksManage', '删除商品', '/stocks/deleteStocks', '0');
INSERT INTO `menu` VALUES ('47', '15', 'holdsManage', '持仓管理', '/holds/holdsList', '0');
INSERT INTO `menu` VALUES ('48', '1', 'bannerTypeManage', '图片类型管理', '/banner/bannerTypeList', '0');
INSERT INTO `menu` VALUES ('49', '1', 'bannerManage', '图片管理', '/banner/bannerList', '0');
INSERT INTO `menu` VALUES ('50', '2', 'cityManage', '城市管理', '/city/cityList', '0');
INSERT INTO `menu` VALUES ('51', '3', 'articleTypeManage', '文章类型管理', '/article/articleTypeList', '2');
INSERT INTO `menu` VALUES ('52', '3', 'articleManage', '文章管理', '/article/articleList', '1');
INSERT INTO `menu` VALUES ('53', '5', 'partnerManage', '合作伙伴管理', '/partner/partnerList', '6');
INSERT INTO `menu` VALUES ('54', '5', 'teamMemberManage', '团队成员管理', '/teamMember/teamMemberList', '0');
INSERT INTO `menu` VALUES ('55', '5', 'hotSearchManage', '热门搜索词管理', '/hotsearch/hotsearchList', '0');
INSERT INTO `menu` VALUES ('56', '5', 'customerConsultManage', '客户咨询管理', '/customerConsult/customerConsultList', '0');
INSERT INTO `menu` VALUES ('57', '5', 'tagManage', '标签管理', '/tag/tagList', '0');
INSERT INTO `menu` VALUES ('58', '5', 'enumManage', '枚举管理', '/enum/enumList', '0');
INSERT INTO `menu` VALUES ('59', '6', 'houseManage', '海外房产管理', '/house/houseList', '0');

-- ----------------------------
-- Table structure for menu_role
-- ----------------------------
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `menu_key` varchar(50) NOT NULL COMMENT '菜单key',
  `access_key` varchar(25) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=428 DEFAULT CHARSET=utf8 COMMENT='菜单角色关联表';

-- ----------------------------
-- Records of menu_role
-- ----------------------------
INSERT INTO `menu_role` VALUES ('8', '2', 'adminManage', '', '1');
INSERT INTO `menu_role` VALUES ('9', '2', 'deptManage', '', '2');
INSERT INTO `menu_role` VALUES ('10', '2', 'roleManage', '', '3');
INSERT INTO `menu_role` VALUES ('17', '2', 'bannerTypeManage', '', '2');
INSERT INTO `menu_role` VALUES ('18', '2', 'bannerManage', '', '1');
INSERT INTO `menu_role` VALUES ('19', '2', 'goodsTypeManage', '', '2');
INSERT INTO `menu_role` VALUES ('20', '2', 'goodsManage', '', '1');
INSERT INTO `menu_role` VALUES ('37', '1', 'cadminManage', '', '1');
INSERT INTO `menu_role` VALUES ('38', '1', 'companyManage', '', '2');
INSERT INTO `menu_role` VALUES ('49', '2', 'financeManage', '', '1');
INSERT INTO `menu_role` VALUES ('50', '2', 'withdrawalsMange', '', '3');
INSERT INTO `menu_role` VALUES ('56', '10', 'bannerTypeManage', '22F99454-4767-6D33-BD27', '2');
INSERT INTO `menu_role` VALUES ('57', '10', 'bannerManage', '22F99454-4767-6D33-BD27', '1');
INSERT INTO `menu_role` VALUES ('68', '11', 'bannerTypeManage', 'F4482715-25BD-DC11-873A', '2');
INSERT INTO `menu_role` VALUES ('69', '11', 'bannerManage', 'F4482715-25BD-DC11-873A', '1');
INSERT INTO `menu_role` VALUES ('70', '11', 'goodsTypeManage', 'F4482715-25BD-DC11-873A', '2');
INSERT INTO `menu_role` VALUES ('71', '11', 'goodsManage', 'F4482715-25BD-DC11-873A', '1');
INSERT INTO `menu_role` VALUES ('72', '11', 'wechatConfigManage', 'F4482715-25BD-DC11-873A', '1');
INSERT INTO `menu_role` VALUES ('73', '11', 'adminManage', 'F4482715-25BD-DC11-873A', '1');
INSERT INTO `menu_role` VALUES ('74', '11', 'deptManage', 'F4482715-25BD-DC11-873A', '2');
INSERT INTO `menu_role` VALUES ('75', '11', 'roleManage', 'F4482715-25BD-DC11-873A', '3');
INSERT INTO `menu_role` VALUES ('86', '12', 'bannerTypeManage', 'F4482715-25BD-DC11-873A', '1');
INSERT INTO `menu_role` VALUES ('87', '12', 'bannerManage', 'F4482715-25BD-DC11-873A', '2');
INSERT INTO `menu_role` VALUES ('88', '12', 'goodsTypeManage', 'F4482715-25BD-DC11-873A', '3');
INSERT INTO `menu_role` VALUES ('89', '12', 'goodsManage', 'F4482715-25BD-DC11-873A', '1');
INSERT INTO `menu_role` VALUES ('90', '12', 'wechatConfigManage', 'F4482715-25BD-DC11-873A', '1');
INSERT INTO `menu_role` VALUES ('100', '11', 'masterManage', '', '2');
INSERT INTO `menu_role` VALUES ('106', '13', 'adminManage', '1C694C95', '1');
INSERT INTO `menu_role` VALUES ('107', '13', 'deptManage', '1C694C95', '2');
INSERT INTO `menu_role` VALUES ('108', '13', 'roleManage', '1C694C95', '3');
INSERT INTO `menu_role` VALUES ('114', '11', 'workTypeManage', '1C694C95', '5');
INSERT INTO `menu_role` VALUES ('135', '13', 'companyConfigManage', '1C694C95', '4');
INSERT INTO `menu_role` VALUES ('336', '14', 'orderManage', '1C694C95', '1');
INSERT INTO `menu_role` VALUES ('337', '14', 'returnManage', '1C694C95', '2');
INSERT INTO `menu_role` VALUES ('338', '14', 'goodsManage', '1C694C95', '1');
INSERT INTO `menu_role` VALUES ('339', '14', 'goodsTypeManage', '1C694C95', '2');
INSERT INTO `menu_role` VALUES ('340', '14', 'goodsNormsManage', '1C694C95', '3');
INSERT INTO `menu_role` VALUES ('352', '14', 'articleManage', '1C694C95', '1');
INSERT INTO `menu_role` VALUES ('353', '14', 'articleTypeManage', '1C694C95', '2');
INSERT INTO `menu_role` VALUES ('355', '14', 'masterManage', '1C694C95', '2');
INSERT INTO `menu_role` VALUES ('357', '14', 'distributorLevelManage', '1C694C95', '4');
INSERT INTO `menu_role` VALUES ('358', '14', 'workTypeManage', '1C694C95', '5');
INSERT INTO `menu_role` VALUES ('359', '14', 'bannerManage', '1C694C95', '1');
INSERT INTO `menu_role` VALUES ('360', '14', 'bannerTypeManage', '1C694C95', '2');
INSERT INTO `menu_role` VALUES ('361', '14', 'shoppingHomeManage', '1C694C95', '3');
INSERT INTO `menu_role` VALUES ('362', '14', 'apiManage', '1C694C95', '4');
INSERT INTO `menu_role` VALUES ('363', '14', 'adminManage', '1C694C95', '1');
INSERT INTO `menu_role` VALUES ('364', '14', 'deptManage', '1C694C95', '2');
INSERT INTO `menu_role` VALUES ('365', '14', 'roleManage', '1C694C95', '3');
INSERT INTO `menu_role` VALUES ('366', '14', 'companyConfigManage', '1C694C95', '4');
INSERT INTO `menu_role` VALUES ('367', '14', 'stockholderManage', '1C694C95', '5');
INSERT INTO `menu_role` VALUES ('368', '19', 'goodsTypeManage', '15402CB3', '2');
INSERT INTO `menu_role` VALUES ('369', '19', 'goodsManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('370', '19', 'goodsNormsManage', '15402CB3', '3');
INSERT INTO `menu_role` VALUES ('371', '19', 'adminManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('372', '19', 'deptManage', '15402CB3', '2');
INSERT INTO `menu_role` VALUES ('373', '19', 'roleManage', '15402CB3', '3');
INSERT INTO `menu_role` VALUES ('374', '19', 'companyConfigManage', '15402CB3', '4');
INSERT INTO `menu_role` VALUES ('375', '19', 'stockholderManage', '15402CB3', '5');
INSERT INTO `menu_role` VALUES ('376', '19', 'financeManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('377', '19', 'withdrawalsMange', '15402CB3', '3');
INSERT INTO `menu_role` VALUES ('378', '19', 'bankCardManage', '15402CB3', '4');
INSERT INTO `menu_role` VALUES ('379', '19', 'rechargeManage', '15402CB3', '2');
INSERT INTO `menu_role` VALUES ('380', '19', 'withdrawalsSet', '15402CB3', '5');
INSERT INTO `menu_role` VALUES ('382', '19', 'masterManage', '15402CB3', '2');
INSERT INTO `menu_role` VALUES ('384', '19', 'workTypeManage', '15402CB3', '5');
INSERT INTO `menu_role` VALUES ('385', '19', 'distributorLevelManage', '15402CB3', '4');
INSERT INTO `menu_role` VALUES ('386', '19', 'articleTypeManage', '15402CB3', '2');
INSERT INTO `menu_role` VALUES ('387', '19', 'articleManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('388', '19', 'integralGoodsManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('389', '19', 'integralDetailManage', '15402CB3', '3');
INSERT INTO `menu_role` VALUES ('390', '19', 'goodsQrCodeManage', '15402CB3', '2');
INSERT INTO `menu_role` VALUES ('391', '19', 'integralProportionManage', '15402CB3', '6');
INSERT INTO `menu_role` VALUES ('392', '19', 'integralWithdrawalManage', '15402CB3', '4');
INSERT INTO `menu_role` VALUES ('393', '19', 'stockBus', '15402CB3', '5');
INSERT INTO `menu_role` VALUES ('394', '19', 'orderManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('395', '19', 'returnManage', '15402CB3', '2');
INSERT INTO `menu_role` VALUES ('396', '19', 'bannerTypeManage', '15402CB3', '2');
INSERT INTO `menu_role` VALUES ('397', '19', 'bannerManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('398', '19', 'apiManage', '15402CB3', '4');
INSERT INTO `menu_role` VALUES ('399', '19', 'shoppingHomeManage', '15402CB3', '3');
INSERT INTO `menu_role` VALUES ('407', '13', 'stocksManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('408', '13', 'holdsManage', '15402CB3', '1');
INSERT INTO `menu_role` VALUES ('409', '15', 'holdsManage', '', '0');
INSERT INTO `menu_role` VALUES ('410', '13', 'bannerTypeManage', '', '0');
INSERT INTO `menu_role` VALUES ('411', '13', 'bannerManage', '', '0');
INSERT INTO `menu_role` VALUES ('412', '13', 'cityManage', '', '0');
INSERT INTO `menu_role` VALUES ('413', '13', 'articleManage', '', '1');
INSERT INTO `menu_role` VALUES ('414', '13', 'articleTypeManage', '', '2');
INSERT INTO `menu_role` VALUES ('416', '13', 'linkTypeManage', '', '1');
INSERT INTO `menu_role` VALUES ('419', '13', 'teamMemberManage', '', '0');
INSERT INTO `menu_role` VALUES ('420', '13', 'linManage', '', '3');
INSERT INTO `menu_role` VALUES ('421', '13', 'partnerTypeManage', '', '5');
INSERT INTO `menu_role` VALUES ('422', '13', 'partnerManage', '', '6');
INSERT INTO `menu_role` VALUES ('423', '13', 'hotSearchManage', '', '0');
INSERT INTO `menu_role` VALUES ('424', '13', 'customerConsultManage', '', '0');
INSERT INTO `menu_role` VALUES ('425', '13', 'tagManage', '', '0');
INSERT INTO `menu_role` VALUES ('426', '13', 'enumManage', '', '0');
INSERT INTO `menu_role` VALUES ('427', '13', 'houseManage', '', '0');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL DEFAULT '0' COMMENT '用户id',
  `access_key` varchar(50) NOT NULL DEFAULT '' COMMENT '唯一标识',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '消息内容',
  `status` tinyint(1) NOT NULL DEFAULT '-1' COMMENT '-1未读,1已读,-2已删除',
  `add_time` int(13) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='消息';

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('20', '134', '', '我是测试内容', '-1', '1493963891');
INSERT INTO `message` VALUES ('21', '134', '', '我是测试内容2', '-1', '1493963891');
INSERT INTO `message` VALUES ('22', '134', '', '我是测试内3', '-1', '1493963891');
INSERT INTO `message` VALUES ('23', '134', '', '我是测试内容4', '-1', '1493963891');
INSERT INTO `message` VALUES ('24', '139', '', '我是测试内容', '1', '1493963891');
INSERT INTO `message` VALUES ('25', '139', '', '我是测试内容2', '1', '1493963891');
INSERT INTO `message` VALUES ('26', '139', '', '我是测试内容3', '1', '1493963891');
INSERT INTO `message` VALUES ('27', '139', '', '我是测试内容4', '1', '1493963891');
INSERT INTO `message` VALUES ('29', '150', '', '订单号[2017050817739]退货申请，审核成功,退款0.10元', '1', '1494238025');
INSERT INTO `message` VALUES ('30', '150', '', '订单号[2017050878056]退货申请，审核失败！如有疑问请联系工作人员。', '1', '1494238037');
INSERT INTO `message` VALUES ('31', '150', '', '订单号[2017050908573]退货申请，审核成功,退款0.01元', '1', '1494298000');
INSERT INTO `message` VALUES ('32', '151', '', '订单号[2017050940699]退货申请，审核失败！如有疑问请联系工作人员。', '1', '1494299890');
INSERT INTO `message` VALUES ('33', '151', '', '订单号[2017050940699]退货申请，审核成功,退款0.01元', '-1', '1494409737');
INSERT INTO `message` VALUES ('34', '154', '', '订单号[2017050839370]退货申请，审核成功,退款0.02元', '-1', '1494482730');

-- ----------------------------
-- Table structure for modular
-- ----------------------------
DROP TABLE IF EXISTS `modular`;
CREATE TABLE `modular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modular_key` varchar(30) NOT NULL COMMENT '模块Key',
  `modular_ico` varchar(30) NOT NULL COMMENT '模块图标',
  `modular_title` varchar(15) NOT NULL COMMENT '模块名称',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='权限某块表';

-- ----------------------------
-- Records of modular
-- ----------------------------
INSERT INTO `modular` VALUES ('1', 'bannerManage', 'glyphicon glyphicon-user', '图片管理', '1');
INSERT INTO `modular` VALUES ('2', 'cityManage', 'glyphicon glyphicon-gift', '城市管理', '2');
INSERT INTO `modular` VALUES ('3', 'articleManage', 'glyphicon glyphicon-book', '文章管理', '6');
INSERT INTO `modular` VALUES ('4', 'systemManage', 'glyphicon glyphicon-cog', '系统管理', '10');
INSERT INTO `modular` VALUES ('5', 'contentManage', 'glyphicon glyphicon-gift', '其他模块管理', '1');
INSERT INTO `modular` VALUES ('6', 'houseManage', 'glyphicon glyphicon-book', '海外房产管理', null);
INSERT INTO `modular` VALUES ('11', 'shoppingMallManage', 'glyphicon glyphicon-th', '商品管理', '8');
INSERT INTO `modular` VALUES ('15', 'holdsManage', 'glyphicon glyphicon-user', '持仓管理', '8');

-- ----------------------------
-- Table structure for oversea_house
-- ----------------------------
DROP TABLE IF EXISTS `oversea_house`;
CREATE TABLE `oversea_house` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '城市id',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '类型id,枚举表中的id',
  `feature_id` int(11) NOT NULL DEFAULT '0' COMMENT '特色id,枚举表中的id',
  `tag_id` varchar(50) NOT NULL COMMENT '标签',
  `images` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `project_atlas` text NOT NULL COMMENT '项目图集',
  `unit_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最低单价,以万为单位',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `home_show` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示在首页,1显示，2不显示',
  `complete_date` varchar(255) NOT NULL DEFAULT '' COMMENT '交房时间',
  `area` varchar(255) NOT NULL DEFAULT '' COMMENT '面积',
  `house_type` varchar(255) NOT NULL DEFAULT '' COMMENT '户型',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价,以万为单位',
  `property_year` varchar(255) NOT NULL DEFAULT '' COMMENT '产权年限',
  `first_payment` varchar(255) NOT NULL DEFAULT '' COMMENT '首付比例',
  `year_return` varchar(255) NOT NULL DEFAULT '' COMMENT '年回报率',
  `house_standard` varchar(255) NOT NULL DEFAULT '' COMMENT '交房标准',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '项目位置',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示,1显示2不显示',
  `watch_number` int(11) NOT NULL DEFAULT '0' COMMENT '在看人数',
  `publish_date` date DEFAULT NULL COMMENT '发布时间',
  `basic_info` text COMMENT '基本信息',
  `main_door` text COMMENT '主力户型',
  `surround_facility` text COMMENT '周边配套',
  `program_feature` text COMMENT '项目特色',
  `invest_analysis` text COMMENT '投资分析',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='海外房产表';

-- ----------------------------
-- Records of oversea_house
-- ----------------------------
INSERT INTO `oversea_house` VALUES ('1', '155', '1', '7', '0', 'uploads/images/Scp0HtJoTI.jpg;uploads/images/uG5NNKOypj.jpg;uploads/images/DRU0A70BhU.jpg', '<p><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210221/1613917124877463.jpeg\" title=\"1613917124877463.jpeg\"/></p><p><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210221/1613917124865568.jpg\" title=\"1613917124865568.jpg\"/></p><p><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210221/1613917124646651.jpg\" title=\"1613917124646651.jpg\"/></p><p><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210221/1613917124993797.jpg\" title=\"1613917124993797.jpg\"/></p><p><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210221/1613917125633921.jpg\" title=\"1613917125633921.jpg\"/></p><p><br/></p>', '1.00', '天安云谷', '这是天安云谷', '1', '预计2021.9', '120平米', '三房两厅', '120.00', '永久产权', '30%', '7.5%', '交房标准', '深圳', '0', '1', '12', '2021-02-10', '<p>那个积分兑换个健康地方和高科技的</p>', '<p>购房的几个地方建瓯IG将豆腐干豆腐机</p>', '<p>光复节大概几点覅偶感觉到否</p>', '<p>赶紧发达国家的反馈给记得放开了个京东方</p>', '<p>明白不参加补课的分级管控力度附近股票的佛公开课更多反馈&nbsp;</p>', '2021-02-21 22:20:07', '2021-02-21 22:20:07');
INSERT INTO `oversea_house` VALUES ('2', '154', '1', '7', '8;9', 'uploads/images/Y8u2oFcnem.jpg;uploads/images/usXQ4BBskh.jpg;uploads/images/DU0KJeLauT.jpg', '<p>购房定个地方11111</p>', '3.31', '北京四合院1', '这是北京四合院1', '1', '预计2022.21', '180平米1', '8房1', '3000.31', '701', '31%', '8.18%', '精装修交房1', '北京1', '31', '2', '331', '2021-02-01', '<p>凤凰国际开了个1</p>', '<p>个梵蒂冈电饭锅1</p>', '<p>购房定个地方100000</p>', '<p>购房定个地方1222</p>', '<p>购房定个地方施工123</p>', '2021-02-21 22:23:20', '2021-02-21 22:57:09');
INSERT INTO `oversea_house` VALUES ('3', '152', '3', '6', '4;8', 'uploads/images/x4DCR5xPch.jpg;uploads/images/T0SOLI6DuQ.jpeg;uploads/images/v97wnv6FEG.jpg', '<p>项目图集</p><p><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210221/1613919560185354.jpeg\" title=\"1613919560185354.jpeg\"/></p><p><img src=\"http://admin.aomeijia.com/uploads/ueditor/image/20210221/1613919560333375.jpg\" title=\"1613919560333375.jpg\"/></p><p><br/></p>', '16.00', '26', '36', '1', '46', '56', '66', '76.00', '86', '96', '17', '27', '37', '47', '1', '57', '2021-02-27', '<p>基本信息</p>', '<p>主力户型</p>', '<p>周边配套</p>', '<p>项目特色</p>', '<p>投资分析</p>', '2021-02-21 22:59:33', '2021-02-21 22:59:33');

-- ----------------------------
-- Table structure for partner
-- ----------------------------
DROP TABLE IF EXISTS `partner`;
CREATE TABLE `partner` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '合作伙伴类型',
  `title` varchar(25) NOT NULL DEFAULT '' COMMENT '合作伙伴标题',
  `logo` varchar(100) NOT NULL DEFAULT '' COMMENT '合作伙伴logo',
  `sort` varchar(25) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of partner
-- ----------------------------
INSERT INTO `partner` VALUES ('1', '1', '佳兆业', '', '0', '1', '2021-02-15 17:59:04', '2021-02-15 17:59:04');
INSERT INTO `partner` VALUES ('2', '3', '留学类目伙伴', 'uploads/images/hpuyo3NdFo.jpeg', '3', '1', '2021-02-15 20:56:39', '2021-02-15 21:07:17');
INSERT INTO `partner` VALUES ('3', '1', '房产2', 'uploads/images/95pmvur0Jq.jpg', '0', '2', '2021-02-15 21:02:21', '2021-02-15 21:02:21');
INSERT INTO `partner` VALUES ('4', '2', '移民伙伴', 'uploads/images/HYYGL2J1ET.jpg', '0', '1', '2021-02-15 21:04:39', '2021-02-15 21:04:39');

-- ----------------------------
-- Table structure for partner_type
-- ----------------------------
DROP TABLE IF EXISTS `partner_type`;
CREATE TABLE `partner_type` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL DEFAULT '' COMMENT '名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` int(2) DEFAULT '1' COMMENT '状态，1启用，2禁用',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of partner_type
-- ----------------------------
INSERT INTO `partner_type` VALUES ('1', '房产', null, '1', '2021-02-15 17:50:54', '2021-02-15 17:50:54');
INSERT INTO `partner_type` VALUES ('2', '移民1', '2', '1', '2021-02-15 17:51:11', '2021-02-15 17:55:29');
INSERT INTO `partner_type` VALUES ('3', '留学', null, '1', '2021-02-15 17:53:45', '2021-02-15 17:53:45');
INSERT INTO `partner_type` VALUES ('4', '金融1', '6', '2', '2021-02-15 17:56:41', '2021-02-15 17:57:12');

-- ----------------------------
-- Table structure for resources
-- ----------------------------
DROP TABLE IF EXISTS `resources`;
CREATE TABLE `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modular_id` int(11) NOT NULL COMMENT '模块ID',
  `resources_key` varchar(50) NOT NULL COMMENT '资源key',
  `resources_title` varchar(30) NOT NULL COMMENT '资源名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8 COMMENT='权限资源表';

-- ----------------------------
-- Records of resources
-- ----------------------------
INSERT INTO `resources` VALUES ('1', '11', '/stocks/stocksList', '商品管理');
INSERT INTO `resources` VALUES ('2', '11', '/stocks/addStocks', '添加商品');
INSERT INTO `resources` VALUES ('3', '11', '/stocks/updateStocks', '修改商品');
INSERT INTO `resources` VALUES ('4', '11', '/stocks/deleteStocks', '删除商品');
INSERT INTO `resources` VALUES ('21', '12', '/wechatConfig/wechatConfigList', '配置列表');
INSERT INTO `resources` VALUES ('22', '12', '/wechatConfig/updateWechatConfig', '编辑配置');
INSERT INTO `resources` VALUES ('23', '12', '/wechatConfig/seeWechatConfig', '查看配置');
INSERT INTO `resources` VALUES ('24', '12', '/wechatConfig/seeToken', '获取接口key（必选）');
INSERT INTO `resources` VALUES ('25', '12', '/wechatMenu/wechatMenuList', '菜单列表');
INSERT INTO `resources` VALUES ('26', '12', '/wechatMenu/addWechatMenu', '添加菜单');
INSERT INTO `resources` VALUES ('27', '12', '/wechatMenu/updateWechatMenu', '更新菜单');
INSERT INTO `resources` VALUES ('28', '12', 'wechatMenu/seeWechatMenu', '查看菜单');
INSERT INTO `resources` VALUES ('29', '12', '/wechatMenu/deleteWechatMenu', '删除菜单');
INSERT INTO `resources` VALUES ('30', '12', '/wechatMenu/publish', '发布菜单');
INSERT INTO `resources` VALUES ('31', '4', '/user/userList', '管理员列表');
INSERT INTO `resources` VALUES ('32', '4', '/user/addUser', '增加管理员');
INSERT INTO `resources` VALUES ('33', '4', '/user/updateUser', '修改管理员');
INSERT INTO `resources` VALUES ('34', '4', '/user/seeUser', '查看管理员');
INSERT INTO `resources` VALUES ('35', '4', '/user/deleteUser', '删除管理员');
INSERT INTO `resources` VALUES ('36', '4', '/user/resetPass', '重置密码');
INSERT INTO `resources` VALUES ('37', '4', '/department/departmentList', '部门列表');
INSERT INTO `resources` VALUES ('38', '4', '/department/addDepartment', '增加部门');
INSERT INTO `resources` VALUES ('39', '4', '/department/updateDepartment', '修改部门');
INSERT INTO `resources` VALUES ('40', '4', '/department/seeDepartment', '查看部门');
INSERT INTO `resources` VALUES ('41', '4', '/department/deleteDepartment', '删除部门');
INSERT INTO `resources` VALUES ('42', '4', '/department/ajaxDepartmentList', '获取部门列表（管理员管理跟部门管理有添加修改权限必选）');
INSERT INTO `resources` VALUES ('43', '4', '/role/roleList', '角色列表');
INSERT INTO `resources` VALUES ('44', '4', '/role/addRole', '增加角色');
INSERT INTO `resources` VALUES ('45', '4', '/role/updateRole', '修改角色');
INSERT INTO `resources` VALUES ('46', '4', '/role/seeRole', '查看角色');
INSERT INTO `resources` VALUES ('47', '4', '/role/deleteRole', '删除角色');
INSERT INTO `resources` VALUES ('53', '5', '/link/linkTypeList', '链接类型列表');
INSERT INTO `resources` VALUES ('54', '5', '/link/addLink', '添加链接');
INSERT INTO `resources` VALUES ('55', '5', '/link/linkList', '链接列表');
INSERT INTO `resources` VALUES ('58', '12', '/wechatConfig/addWechatConfig', '添加配置');
INSERT INTO `resources` VALUES ('60', '7', '/member/distributorList', '经销商列表');
INSERT INTO `resources` VALUES ('61', '7', '/member/distributorAdd', '添加经销商');
INSERT INTO `resources` VALUES ('62', '7', '/member/distributorUpdate', '修改经销商');
INSERT INTO `resources` VALUES ('63', '7', '/member/distributorDetail', '查看经销商');
INSERT INTO `resources` VALUES ('64', '7', '/member/distributorDelete', '删除经销商');
INSERT INTO `resources` VALUES ('65', '7', '/member/userList', '普通用户列表');
INSERT INTO `resources` VALUES ('66', '7', '/member/userAdd', '添加普通用户');
INSERT INTO `resources` VALUES ('67', '7', '/member/userUpdate', '修改普通用户');
INSERT INTO `resources` VALUES ('68', '7', '/member/userDetail', '查看普通用户');
INSERT INTO `resources` VALUES ('69', '7', '/member/userDelete', '删除普通用户');
INSERT INTO `resources` VALUES ('70', '7', '/member/masterList', '师傅列表');
INSERT INTO `resources` VALUES ('71', '7', '/member/masterAdd', '添加师傅');
INSERT INTO `resources` VALUES ('72', '7', '/member/masterUpdate', '修改师傅');
INSERT INTO `resources` VALUES ('73', '7', '/member/masterDetail', '查看师傅');
INSERT INTO `resources` VALUES ('74', '7', '/member/masterDelete', '删除师傅');
INSERT INTO `resources` VALUES ('75', '7', '/member/ajaxDistributorList', 'ajax获取所有经销商（必选）');
INSERT INTO `resources` VALUES ('76', '7', '/member/memberReceiptList', '获取收货地址列表');
INSERT INTO `resources` VALUES ('77', '7', '/member/upMemberReceipt', '修改收货地址');
INSERT INTO `resources` VALUES ('78', '7', '/member/memberReceiptAdd', '增加收货地址');
INSERT INTO `resources` VALUES ('79', '7', '/member/memberReceiptDelete', '删除收货地址');
INSERT INTO `resources` VALUES ('80', '7', '/member/workTypeList', '工种列表');
INSERT INTO `resources` VALUES ('81', '7', '/member/workTypeAdd', '添加工种');
INSERT INTO `resources` VALUES ('82', '7', '/member/workTypeUpdate', '更新工种');
INSERT INTO `resources` VALUES ('83', '7', '/member/workTypeDelete', '删除工种');
INSERT INTO `resources` VALUES ('84', '3', '/article/articleTypeList', '文章类型列表');
INSERT INTO `resources` VALUES ('85', '3', '/article/articleList', '文章列表');
INSERT INTO `resources` VALUES ('86', '3', '/article/addArticle', '添加文章');
INSERT INTO `resources` VALUES ('87', '3', '/article/updateArticle', '编辑文章');
INSERT INTO `resources` VALUES ('88', '3', '/article/deleteArticle', '删除文章');
INSERT INTO `resources` VALUES ('89', '3', '/article/seeArticle', '查看文章');
INSERT INTO `resources` VALUES ('93', '8', '/apiList', 'api模块列表');
INSERT INTO `resources` VALUES ('94', '8', '/addApi', '添加api模块');
INSERT INTO `resources` VALUES ('95', '8', '/updateApi', '修改api模块');
INSERT INTO `resources` VALUES ('96', '8', '/deleteApi', '删除api模块');
INSERT INTO `resources` VALUES ('97', '7', '/member/changeUserMaster', '修改为师傅');
INSERT INTO `resources` VALUES ('98', '7', '/member/changeUserDistributor', '修改为经销商');
INSERT INTO `resources` VALUES ('99', '9', '/integral/goodsList', '积分商品列表');
INSERT INTO `resources` VALUES ('100', '9', '/integral/goodsAdd', '添加积分商品');
INSERT INTO `resources` VALUES ('101', '9', '/integral/goodsUpdate', '修改积分商品');
INSERT INTO `resources` VALUES ('102', '9', '/integral/goodsDelete', '删除积分商品');
INSERT INTO `resources` VALUES ('103', '9', '/goods/ajaxGoodsList', '获取普通商品（必选）');
INSERT INTO `resources` VALUES ('104', '9', '/integral/goodsDetail', '查看积分商品');
INSERT INTO `resources` VALUES ('105', '5', '/link/updateLink', '更新链接');
INSERT INTO `resources` VALUES ('106', '9', '/finance/bankCardList', '银行卡列表');
INSERT INTO `resources` VALUES ('107', '9', '/finance/bankCardUpdate', '修改银行卡');
INSERT INTO `resources` VALUES ('108', '5', '/link/deleteLink', '删除链接');
INSERT INTO `resources` VALUES ('109', '9', '/qrCode/goodsQrCodeList', '商品二维码列表');
INSERT INTO `resources` VALUES ('110', '9', '/qrCode/goodsQrCodeAdd', '增加商品二维码');
INSERT INTO `resources` VALUES ('111', '9', '/qrCode/goodsQrCodeDelete', '删除商品二维码');
INSERT INTO `resources` VALUES ('112', '9', '/qrCode/exportGoodsQrCode', '导出商品二维码');
INSERT INTO `resources` VALUES ('113', '10', '/order/orderList', '订单列表');
INSERT INTO `resources` VALUES ('114', '10', '/order/updateOrder', '修改订单');
INSERT INTO `resources` VALUES ('115', '10', '/order/goodList', '商品详情（必选）');
INSERT INTO `resources` VALUES ('135', '7', '/distributorLevel/distributorLevelList', '经销商等级列表');
INSERT INTO `resources` VALUES ('136', '7', '/distributorLevel/distributorLevelAdd', '经销商等级增加');
INSERT INTO `resources` VALUES ('137', '7', '/distributorLevel/distributorLevelUpdate', '经销商等级修改');
INSERT INTO `resources` VALUES ('138', '7', '/distributorLevel/distributorLevelDelete', '经销商等级删除');
INSERT INTO `resources` VALUES ('139', '9', '/integral/integralProportionSet', '积分比例设置');
INSERT INTO `resources` VALUES ('140', '5', '/link/seeLink', '查看链接');
INSERT INTO `resources` VALUES ('141', '5', '/partner/partnerTypeList', '合作伙伴类型列表');
INSERT INTO `resources` VALUES ('142', '10', '/order/deliverGoodsSet', '设置为已发货');
INSERT INTO `resources` VALUES ('143', '4', '/home/companyConfigSet', '公司资料设置');
INSERT INTO `resources` VALUES ('144', '10', '/order/returnList', '退货列表');
INSERT INTO `resources` VALUES ('146', '5', '/partner/addPartner', '添加合作伙伴');
INSERT INTO `resources` VALUES ('153', '5', '/partner/partnerList', '合作伙伴列表');
INSERT INTO `resources` VALUES ('154', '5', '/partner/updatePartner', '更新合作伙伴');
INSERT INTO `resources` VALUES ('155', '12', '/storeList', '商家列表');
INSERT INTO `resources` VALUES ('156', '12', '/updateStore', '商家修改审核');
INSERT INTO `resources` VALUES ('157', '12', '/seeStore', '查看商家');
INSERT INTO `resources` VALUES ('158', '12', '/storeType/storeTypeList', '商家类型列表');
INSERT INTO `resources` VALUES ('159', '12', '/storeType/storeTypeAdd', '商家类型添加');
INSERT INTO `resources` VALUES ('160', '12', '/storeType/storeTypeUpdate', '商家类型修改');
INSERT INTO `resources` VALUES ('161', '12', '/storeType/storeTypeDelete', '商家类型删除');
INSERT INTO `resources` VALUES ('162', '7', '/member/channelUpdate', '添加为渠道商');
INSERT INTO `resources` VALUES ('163', '7', '/member/agentUpdate', '添加为代理商');
INSERT INTO `resources` VALUES ('167', '13', '/RelationsList', '分销列表');
INSERT INTO `resources` VALUES ('168', '12', '/storeOrder', '销量明细');
INSERT INTO `resources` VALUES ('169', '10', '/order/downOrderList', '线下订单列表');
INSERT INTO `resources` VALUES ('170', '10', '/order/seedownOrder', '线下订单查询');
INSERT INTO `resources` VALUES ('171', '12', '/addStore', '添加商家');
INSERT INTO `resources` VALUES ('172', '15', '/holds/holdsList', '持仓管理');
INSERT INTO `resources` VALUES ('173', '15', '/holds/addHolds', '添加持仓');
INSERT INTO `resources` VALUES ('174', '15', '/holds/updateHolds', '修改持仓');
INSERT INTO `resources` VALUES ('175', '15', '/holds/deleteHolds', '删除持仓');
INSERT INTO `resources` VALUES ('176', '15', '/holds/settlementHolds', '结算持仓');
INSERT INTO `resources` VALUES ('177', '1', '/banner/bannerTypeList', '图片类型列表');
INSERT INTO `resources` VALUES ('178', '1', '/banner/seeType', '查看图片类型');
INSERT INTO `resources` VALUES ('179', '1', '/banner/updateType', '更新图片类型');
INSERT INTO `resources` VALUES ('180', '1', '/banner/bannerList', '图片列表');
INSERT INTO `resources` VALUES ('181', '1', '/banner/addBanner', '添加图片');
INSERT INTO `resources` VALUES ('182', '1', '/banner/updateBanner', '更新图片');
INSERT INTO `resources` VALUES ('183', '1', '/banner/seeBanner', '查看图片');
INSERT INTO `resources` VALUES ('184', '1', '/banner/deleteBanner', '删除图片');
INSERT INTO `resources` VALUES ('185', '2', '/city/cityList', '城市列表');
INSERT INTO `resources` VALUES ('186', '2', '/city/cityAdd', '添加城市');
INSERT INTO `resources` VALUES ('187', '2', '/city/cityUpdate', '更新城市');
INSERT INTO `resources` VALUES ('188', '2', '/city/cityDelete', '删除城市');
INSERT INTO `resources` VALUES ('189', '2', '/city/ajaxcityList', '获取城市列表（必选权限）');
INSERT INTO `resources` VALUES ('190', '5', '/partner/deletePartner', '删除合作伙伴');
INSERT INTO `resources` VALUES ('191', '5', '/partner/seePartner', '查看合作伙伴');
INSERT INTO `resources` VALUES ('192', '5', '/partner/addPartnerType', '添加合作伙伴类型');
INSERT INTO `resources` VALUES ('193', '5', '/partner/updatePartnerType', '更新合作伙伴类型');
INSERT INTO `resources` VALUES ('194', '5', '/teamMember/teamMemberList', '团队成员列表');
INSERT INTO `resources` VALUES ('195', '5', '/teamMember/addTeamMember', '添加团队成员');
INSERT INTO `resources` VALUES ('196', '5', '/teamMember/updateTeamMember', '更新团队成员');
INSERT INTO `resources` VALUES ('197', '5', '/teamMember/deleteTeamMember', '删除团队成员');
INSERT INTO `resources` VALUES ('198', '5', '/teamMember/seeTeamMember', '查看团队成员');
INSERT INTO `resources` VALUES ('199', '5', '/hotsearch/hotsearchList', '热门搜索词列表');
INSERT INTO `resources` VALUES ('200', '5', '/hotsearch/addHotsearch', '添加热门搜索词');
INSERT INTO `resources` VALUES ('201', '5', '/hotsearch/updateHotsearch', '更新热门搜索词');
INSERT INTO `resources` VALUES ('202', '5', '/hotsearch/deleteHotsearch', '删除热门搜索词');
INSERT INTO `resources` VALUES ('203', '5', '/hotsearch/seeHotsearch', '查看热门搜索词');
INSERT INTO `resources` VALUES ('204', '5', '/customerConsult/customerConsultList', '客户咨询列表');
INSERT INTO `resources` VALUES ('205', '5', '/customerConsult/seeCustomerConsult', '查看客户咨询');
INSERT INTO `resources` VALUES ('206', '5', '/tag/tagList', '标签列表');
INSERT INTO `resources` VALUES ('207', '5', '/tag/addTag', '添加标签');
INSERT INTO `resources` VALUES ('208', '5', '/tag/updateTag', '更新标签');
INSERT INTO `resources` VALUES ('209', '5', '/tag/deleteTag', '删除标签');
INSERT INTO `resources` VALUES ('210', '5', '/tag/seeTag', '查看标签');
INSERT INTO `resources` VALUES ('211', '5', '/enum/enumList', '枚举列表');
INSERT INTO `resources` VALUES ('212', '5', '/enum/addEnum', '添加枚举');
INSERT INTO `resources` VALUES ('213', '5', '/enum/updateEnum', '更新枚举');
INSERT INTO `resources` VALUES ('214', '5', '/enum/seeEnum', '查看枚举');
INSERT INTO `resources` VALUES ('215', '6', '/house/houseList', '海外房产列表');
INSERT INTO `resources` VALUES ('216', '6', '/house/addHouse', '添加海外房产');
INSERT INTO `resources` VALUES ('217', '6', '/house/updateHouse', '更新海外房产');
INSERT INTO `resources` VALUES ('218', '6', '/house/deleteHouse', '删除海外房产');
INSERT INTO `resources` VALUES ('219', '6', '/house/seeHouse', '查看海外房产');

-- ----------------------------
-- Table structure for resources_role
-- ----------------------------
DROP TABLE IF EXISTS `resources_role`;
CREATE TABLE `resources_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `resources_key` varchar(255) NOT NULL COMMENT '资源key',
  `access_key` varchar(25) NOT NULL DEFAULT '' COMMENT '唯一标识',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1770 DEFAULT CHARSET=utf8 COMMENT='角色资源表';

-- ----------------------------
-- Records of resources_role
-- ----------------------------
INSERT INTO `resources_role` VALUES ('38', '2', '/user/userList', '');
INSERT INTO `resources_role` VALUES ('39', '2', '/user/addUser', '');
INSERT INTO `resources_role` VALUES ('40', '2', '/user/updateUser', '');
INSERT INTO `resources_role` VALUES ('41', '2', '/user/deleteUser', '');
INSERT INTO `resources_role` VALUES ('43', '2', '/department/departmentList', '');
INSERT INTO `resources_role` VALUES ('44', '2', '/department/addDepartment', '');
INSERT INTO `resources_role` VALUES ('45', '2', '/department/deleteDepartment', '');
INSERT INTO `resources_role` VALUES ('46', '2', '/department/seeDepartment', '');
INSERT INTO `resources_role` VALUES ('47', '2', '/department/updateDepartment', '');
INSERT INTO `resources_role` VALUES ('49', '2', '/role/roleList', '');
INSERT INTO `resources_role` VALUES ('50', '2', '/role/addRole', '');
INSERT INTO `resources_role` VALUES ('51', '2', '/role/updateRole', '');
INSERT INTO `resources_role` VALUES ('63', '2', '/department/ajaxDepartmentList', '');
INSERT INTO `resources_role` VALUES ('66', '2', '/user/seeUser', '');
INSERT INTO `resources_role` VALUES ('67', '2', '/user/resetPass', '');
INSERT INTO `resources_role` VALUES ('68', '2', '/role/seeRole', '');
INSERT INTO `resources_role` VALUES ('69', '2', '/role/deleteRole', '');
INSERT INTO `resources_role` VALUES ('75', '2', '/wechatConfig/wechatConfigList', '');
INSERT INTO `resources_role` VALUES ('77', '2', '/wechatConfig/updateWechatConfig', '');
INSERT INTO `resources_role` VALUES ('78', '2', '/wechatConfig/seeWechatConfig', '');
INSERT INTO `resources_role` VALUES ('79', '2', '/wechatConfig/seeToken', '');
INSERT INTO `resources_role` VALUES ('81', '2', '/wechatMenu/addWechatMenu', '');
INSERT INTO `resources_role` VALUES ('82', '2', '/wechatMenu/updateWechatMenu', '');
INSERT INTO `resources_role` VALUES ('83', '2', 'wechatMenu/seeWechatMenu', '');
INSERT INTO `resources_role` VALUES ('84', '2', '/wechatMenu/deleteWechatMenu', '');
INSERT INTO `resources_role` VALUES ('85', '2', '/wechatMenu/publish', '');
INSERT INTO `resources_role` VALUES ('86', '2', '/wechatMenu/wechatMenuList', '');
INSERT INTO `resources_role` VALUES ('87', '2', '/banner/bannerTypeList', '');
INSERT INTO `resources_role` VALUES ('88', '2', '/banner/addType', '');
INSERT INTO `resources_role` VALUES ('89', '2', '/banner/updateType', '');
INSERT INTO `resources_role` VALUES ('90', '2', '/banner/seeType', '');
INSERT INTO `resources_role` VALUES ('91', '2', '/banner/deleteType', '');
INSERT INTO `resources_role` VALUES ('92', '2', '/banner/bannerList', '');
INSERT INTO `resources_role` VALUES ('93', '2', '/banner/addBanner', '');
INSERT INTO `resources_role` VALUES ('94', '2', '/banner/updateBanner', '');
INSERT INTO `resources_role` VALUES ('95', '2', '/banner/seeBanner', '');
INSERT INTO `resources_role` VALUES ('96', '2', '/banner/deleteBanner', '');
INSERT INTO `resources_role` VALUES ('97', '2', '/goodsType/goodsTypeList', '');
INSERT INTO `resources_role` VALUES ('98', '2', '/goodsType/goodsTypeAdd', '');
INSERT INTO `resources_role` VALUES ('99', '2', '/goodsType/goodsTypeUpdate', '');
INSERT INTO `resources_role` VALUES ('100', '2', '/goodsType/goodsTypeDetail', '');
INSERT INTO `resources_role` VALUES ('101', '2', '/goodsType/goodsTypeDelete', '');
INSERT INTO `resources_role` VALUES ('102', '2', '/goods/goodsList', '');
INSERT INTO `resources_role` VALUES ('103', '2', '/goods/goodsAdd', '');
INSERT INTO `resources_role` VALUES ('104', '2', '/goods/goodsUpdate', '');
INSERT INTO `resources_role` VALUES ('105', '2', '/goods/goodsDetail', '');
INSERT INTO `resources_role` VALUES ('106', '2', '/goods/goodsDelete', '');
INSERT INTO `resources_role` VALUES ('107', '2', '/goodsType/ajaxGoodsTypeList', '');
INSERT INTO `resources_role` VALUES ('108', '2', '/goodsType/ajaxGoodsTypeAttribute', '');
INSERT INTO `resources_role` VALUES ('205', '1', '/user/cuserList', '');
INSERT INTO `resources_role` VALUES ('206', '1', '/user/addCuser', '');
INSERT INTO `resources_role` VALUES ('207', '1', '/user/updateCuser', '');
INSERT INTO `resources_role` VALUES ('208', '1', '/department/companyList', '');
INSERT INTO `resources_role` VALUES ('209', '1', '/department/addCompany', '');
INSERT INTO `resources_role` VALUES ('210', '1', '/department/updateCompany', '');
INSERT INTO `resources_role` VALUES ('211', '1', '/department/ajaxFirstList', '');
INSERT INTO `resources_role` VALUES ('263', '2', '/finance/financeList', '');
INSERT INTO `resources_role` VALUES ('264', '2', '/finance/withdrawalsList', '');
INSERT INTO `resources_role` VALUES ('265', '2', '/finance/withdrawalsAudit', '');
INSERT INTO `resources_role` VALUES ('266', '10', '/banner/bannerTypeList', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('267', '10', '/banner/addType', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('268', '10', '/banner/updateType', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('269', '10', '/banner/seeType', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('270', '10', '/banner/deleteType', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('271', '10', '/banner/bannerList', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('272', '10', '/banner/addBanner', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('273', '10', '/banner/updateBanner', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('274', '10', '/banner/seeBanner', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('275', '10', '/banner/deleteBanner', '22F99454-4767-6D33-BD27');
INSERT INTO `resources_role` VALUES ('353', '11', '/banner/bannerTypeList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('354', '11', '/banner/addType', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('355', '11', '/banner/updateType', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('356', '11', '/banner/seeType', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('357', '11', '/banner/deleteType', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('358', '11', '/banner/bannerList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('359', '11', '/banner/addBanner', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('360', '11', '/banner/updateBanner', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('361', '11', '/banner/seeBanner', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('362', '11', '/banner/deleteBanner', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('363', '11', '/goodsType/goodsTypeList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('364', '11', '/goodsType/goodsTypeAdd', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('365', '11', '/goodsType/goodsTypeUpdate', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('366', '11', '/goodsType/goodsTypeDelete', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('367', '11', '/goodsType/ajaxGoodsTypeList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('368', '11', '/goods/goodsList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('369', '11', '/goods/goodsAdd', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('370', '11', '/goods/goodsUpdate', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('371', '11', '/goods/goodsDetail', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('372', '11', '/goods/goodsDelete', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('373', '11', '/goodsType/ajaxGoodsTypeAttribute', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('374', '11', '/wechatConfig/wechatConfigList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('375', '11', '/wechatConfig/updateWechatConfig', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('376', '11', '/wechatConfig/seeWechatConfig', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('377', '11', '/wechatConfig/seeToken', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('378', '11', '/wechatMenu/wechatMenuList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('379', '11', '/wechatMenu/addWechatMenu', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('380', '11', '/wechatMenu/updateWechatMenu', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('381', '11', 'wechatMenu/seeWechatMenu', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('382', '11', '/wechatMenu/deleteWechatMenu', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('383', '11', '/wechatMenu/publish', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('384', '11', '/user/userList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('385', '11', '/user/addUser', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('386', '11', '/user/updateUser', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('387', '11', '/user/seeUser', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('388', '11', '/user/deleteUser', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('389', '11', '/user/resetPass', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('390', '11', '/department/departmentList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('391', '11', '/department/addDepartment', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('392', '11', '/department/updateDepartment', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('393', '11', '/department/seeDepartment', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('394', '11', '/department/deleteDepartment', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('395', '11', '/department/ajaxDepartmentList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('396', '11', '/role/roleList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('397', '11', '/role/addRole', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('398', '11', '/role/updateRole', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('399', '11', '/role/seeRole', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('400', '11', '/role/deleteRole', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('411', '12', '/banner/bannerTypeList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('412', '12', '/banner/addType', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('413', '12', '/banner/updateType', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('414', '12', '/banner/seeType', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('415', '12', '/banner/deleteType', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('416', '12', '/banner/bannerList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('417', '12', '/banner/addBanner', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('418', '12', '/banner/updateBanner', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('419', '12', '/banner/seeBanner', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('420', '12', '/banner/deleteBanner', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('421', '12', '/goodsType/goodsTypeList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('422', '12', '/goodsType/goodsTypeAdd', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('423', '12', '/goodsType/goodsTypeUpdate', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('424', '12', '/goodsType/goodsTypeDelete', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('425', '12', '/goodsType/ajaxGoodsTypeList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('426', '12', '/goods/goodsList', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('427', '12', '/goods/goodsAdd', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('428', '12', '/goods/goodsUpdate', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('429', '12', '/goods/goodsDetail', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('430', '12', '/goods/goodsDelete', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('431', '12', '/goodsType/ajaxGoodsTypeAttribute', 'F4482715-25BD-DC11-873A');
INSERT INTO `resources_role` VALUES ('476', '11', '/wechatConfig/addWechatConfig', '');
INSERT INTO `resources_role` VALUES ('478', '11', '/member/distributorList', '');
INSERT INTO `resources_role` VALUES ('479', '11', '/member/distributorAdd', '');
INSERT INTO `resources_role` VALUES ('480', '11', '/member/distributorUpdate', '');
INSERT INTO `resources_role` VALUES ('481', '11', '/member/distributorDetail', '');
INSERT INTO `resources_role` VALUES ('482', '11', '/member/distributorDelete', '');
INSERT INTO `resources_role` VALUES ('483', '11', '/member/userList', '');
INSERT INTO `resources_role` VALUES ('484', '11', '/member/userAdd', '');
INSERT INTO `resources_role` VALUES ('485', '11', '/member/userUpdate', '');
INSERT INTO `resources_role` VALUES ('486', '11', '/member/userDetail', '');
INSERT INTO `resources_role` VALUES ('508', '13', '/user/userList', '1C694C95');
INSERT INTO `resources_role` VALUES ('509', '13', '/user/addUser', '1C694C95');
INSERT INTO `resources_role` VALUES ('510', '13', '/user/updateUser', '1C694C95');
INSERT INTO `resources_role` VALUES ('511', '13', '/user/seeUser', '1C694C95');
INSERT INTO `resources_role` VALUES ('512', '13', '/user/deleteUser', '1C694C95');
INSERT INTO `resources_role` VALUES ('513', '13', '/user/resetPass', '1C694C95');
INSERT INTO `resources_role` VALUES ('514', '13', '/department/departmentList', '1C694C95');
INSERT INTO `resources_role` VALUES ('515', '13', '/department/addDepartment', '1C694C95');
INSERT INTO `resources_role` VALUES ('516', '13', '/department/updateDepartment', '1C694C95');
INSERT INTO `resources_role` VALUES ('517', '13', '/department/seeDepartment', '1C694C95');
INSERT INTO `resources_role` VALUES ('518', '13', '/department/deleteDepartment', '1C694C95');
INSERT INTO `resources_role` VALUES ('519', '13', '/department/ajaxDepartmentList', '1C694C95');
INSERT INTO `resources_role` VALUES ('520', '13', '/role/roleList', '1C694C95');
INSERT INTO `resources_role` VALUES ('521', '13', '/role/addRole', '1C694C95');
INSERT INTO `resources_role` VALUES ('522', '13', '/role/updateRole', '1C694C95');
INSERT INTO `resources_role` VALUES ('523', '13', '/role/seeRole', '1C694C95');
INSERT INTO `resources_role` VALUES ('524', '13', '/role/deleteRole', '1C694C95');
INSERT INTO `resources_role` VALUES ('537', '11', '/member/userDelete', '');
INSERT INTO `resources_role` VALUES ('538', '11', '/member/masterList', '');
INSERT INTO `resources_role` VALUES ('539', '11', '/member/masterAdd', '');
INSERT INTO `resources_role` VALUES ('540', '11', '/member/masterUpdate', '');
INSERT INTO `resources_role` VALUES ('541', '11', '/member/masterDetail', '');
INSERT INTO `resources_role` VALUES ('542', '11', '/member/masterDelete', '');
INSERT INTO `resources_role` VALUES ('543', '11', '/member/ajaxDistributorList', '');
INSERT INTO `resources_role` VALUES ('544', '11', '/member/memberReceiptList', '');
INSERT INTO `resources_role` VALUES ('545', '11', '/member/upMemberReceipt', '');
INSERT INTO `resources_role` VALUES ('557', '11', '/member/memberReceiptAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('558', '11', '/member/memberReceiptDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('559', '11', '/member/workTypeList', '1C694C95');
INSERT INTO `resources_role` VALUES ('560', '11', '/member/workTypeAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('561', '11', '/member/workTypeUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('562', '11', '/member/workTypeDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1398', '14', '/order/orderList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1399', '14', '/order/updateOrder', '1C694C95');
INSERT INTO `resources_role` VALUES ('1400', '14', '/order/goodList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1401', '14', '/order/deliverGoodsSet', '1C694C95');
INSERT INTO `resources_role` VALUES ('1402', '14', '/order/returnList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1403', '14', '/goodsType/goodsTypeList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1404', '14', '/goodsType/goodsTypeAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1405', '14', '/goodsType/goodsTypeUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1406', '14', '/goodsType/goodsTypeDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1407', '14', '/goodsType/ajaxGoodsTypeList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1408', '14', '/goods/goodsList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1409', '14', '/goods/goodsAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1410', '14', '/goods/goodsUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1411', '14', '/goods/goodsDetail', '1C694C95');
INSERT INTO `resources_role` VALUES ('1412', '14', '/goods/goodsDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1413', '14', '/goodsType/ajaxGoodsTypeAttribute', '1C694C95');
INSERT INTO `resources_role` VALUES ('1414', '14', '/goodsNorms/goodsNormsList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1415', '14', '/goodsNorms/goodsNormsAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1416', '14', '/goodsNorms/goodsNormsUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1417', '14', '/goodsNorms/goodsNormsDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1418', '14', '/goodsNorms/normsAttrList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1419', '14', '/goodsNorms/normsAttrAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1420', '14', '/goodsNorms/normsUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1421', '14', '/goodsNorms/normsAttrDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1422', '14', '/goodsNorms/ajaxGoodsNormsList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1423', '14', '/goodsNorms/ajaxNormsAttrList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1424', '14', '/goodsNorms/ajaxGoodsAttrList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1447', '14', '/article/articleTypeList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1448', '14', '/article/articleList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1449', '14', '/article/addArticle', '1C694C95');
INSERT INTO `resources_role` VALUES ('1450', '14', '/article/updateArticle', '1C694C95');
INSERT INTO `resources_role` VALUES ('1451', '14', '/article/deleteArticle', '1C694C95');
INSERT INTO `resources_role` VALUES ('1452', '14', '/article/seeArticle', '1C694C95');
INSERT INTO `resources_role` VALUES ('1453', '14', '/article/addArticleType', '1C694C95');
INSERT INTO `resources_role` VALUES ('1454', '14', '/article/updateArticleType', '1C694C95');
INSERT INTO `resources_role` VALUES ('1455', '14', '/article/deleteArticleType', '1C694C95');
INSERT INTO `resources_role` VALUES ('1456', '14', '/apiList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1457', '14', '/addApi', '1C694C95');
INSERT INTO `resources_role` VALUES ('1458', '14', '/updateApi', '1C694C95');
INSERT INTO `resources_role` VALUES ('1459', '14', '/deleteApi', '1C694C95');
INSERT INTO `resources_role` VALUES ('1460', '14', '/member/distributorList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1461', '14', '/member/distributorAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1462', '14', '/member/distributorUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1463', '14', '/member/distributorDetail', '1C694C95');
INSERT INTO `resources_role` VALUES ('1464', '14', '/member/distributorDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1465', '14', '/member/userList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1466', '14', '/member/userAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1467', '14', '/member/userUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1468', '14', '/member/userDetail', '1C694C95');
INSERT INTO `resources_role` VALUES ('1469', '14', '/member/userDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1470', '14', '/member/masterList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1471', '14', '/member/masterAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1472', '14', '/member/masterUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1473', '14', '/member/masterDetail', '1C694C95');
INSERT INTO `resources_role` VALUES ('1474', '14', '/member/masterDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1475', '14', '/member/ajaxDistributorList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1476', '14', '/member/memberReceiptList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1477', '14', '/member/upMemberReceipt', '1C694C95');
INSERT INTO `resources_role` VALUES ('1478', '14', '/member/memberReceiptAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1479', '14', '/member/memberReceiptDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1480', '14', '/member/workTypeList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1481', '14', '/member/workTypeAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1482', '14', '/member/workTypeUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1483', '14', '/member/workTypeDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1484', '14', '/member/changeUserMaster', '1C694C95');
INSERT INTO `resources_role` VALUES ('1485', '14', '/member/changeUserDistributor', '1C694C95');
INSERT INTO `resources_role` VALUES ('1486', '14', '/distributorLevel/distributorLevelList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1487', '14', '/distributorLevel/distributorLevelAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1488', '14', '/distributorLevel/distributorLevelUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1489', '14', '/distributorLevel/distributorLevelDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1490', '14', '/banner/bannerTypeList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1491', '14', '/banner/addType', '1C694C95');
INSERT INTO `resources_role` VALUES ('1492', '14', '/banner/updateType', '1C694C95');
INSERT INTO `resources_role` VALUES ('1493', '14', '/banner/seeType', '1C694C95');
INSERT INTO `resources_role` VALUES ('1494', '14', '/banner/deleteType', '1C694C95');
INSERT INTO `resources_role` VALUES ('1495', '14', '/banner/bannerList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1496', '14', '/banner/addBanner', '1C694C95');
INSERT INTO `resources_role` VALUES ('1497', '14', '/banner/updateBanner', '1C694C95');
INSERT INTO `resources_role` VALUES ('1498', '14', '/banner/seeBanner', '1C694C95');
INSERT INTO `resources_role` VALUES ('1499', '14', '/banner/deleteBanner', '1C694C95');
INSERT INTO `resources_role` VALUES ('1500', '14', '/shoppingHome/modularList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1501', '14', '/shoppingHome/modularAdd', '1C694C95');
INSERT INTO `resources_role` VALUES ('1502', '14', '/shoppingHome/modularUpdate', '1C694C95');
INSERT INTO `resources_role` VALUES ('1503', '14', '/shoppingHome/modularDelete', '1C694C95');
INSERT INTO `resources_role` VALUES ('1504', '14', '/order/updateReturn', '1C694C95');
INSERT INTO `resources_role` VALUES ('1505', '14', '/user/userList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1506', '14', '/user/addUser', '1C694C95');
INSERT INTO `resources_role` VALUES ('1507', '14', '/user/updateUser', '1C694C95');
INSERT INTO `resources_role` VALUES ('1508', '14', '/user/seeUser', '1C694C95');
INSERT INTO `resources_role` VALUES ('1509', '14', '/user/deleteUser', '1C694C95');
INSERT INTO `resources_role` VALUES ('1510', '14', '/user/resetPass', '1C694C95');
INSERT INTO `resources_role` VALUES ('1511', '14', '/department/departmentList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1512', '14', '/department/addDepartment', '1C694C95');
INSERT INTO `resources_role` VALUES ('1513', '14', '/department/updateDepartment', '1C694C95');
INSERT INTO `resources_role` VALUES ('1514', '14', '/department/seeDepartment', '1C694C95');
INSERT INTO `resources_role` VALUES ('1515', '14', '/department/deleteDepartment', '1C694C95');
INSERT INTO `resources_role` VALUES ('1516', '14', '/department/ajaxDepartmentList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1517', '14', '/role/roleList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1518', '14', '/role/addRole', '1C694C95');
INSERT INTO `resources_role` VALUES ('1519', '14', '/role/updateRole', '1C694C95');
INSERT INTO `resources_role` VALUES ('1520', '14', '/role/seeRole', '1C694C95');
INSERT INTO `resources_role` VALUES ('1521', '14', '/role/deleteRole', '1C694C95');
INSERT INTO `resources_role` VALUES ('1522', '14', '/shoppingHome/companyConfigSet', '1C694C95');
INSERT INTO `resources_role` VALUES ('1523', '14', '/user/stockholderList', '1C694C95');
INSERT INTO `resources_role` VALUES ('1524', '14', '/user/addStockholder', '1C694C95');
INSERT INTO `resources_role` VALUES ('1525', '14', '/user/updateStockholder', '1C694C95');
INSERT INTO `resources_role` VALUES ('1526', '14', '/user/deleteStockholder', '1C694C95');
INSERT INTO `resources_role` VALUES ('1527', '14', '/user/seeStockholder', '1C694C95');
INSERT INTO `resources_role` VALUES ('1528', '19', '/goodsType/goodsTypeList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1529', '19', '/goodsType/goodsTypeAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1530', '19', '/goodsType/goodsTypeUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1531', '19', '/goodsType/goodsTypeDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1532', '19', '/goodsType/ajaxGoodsTypeList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1533', '19', '/goods/goodsList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1534', '19', '/goods/goodsAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1535', '19', '/goods/goodsUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1536', '19', '/goods/goodsDetail', '15402CB3');
INSERT INTO `resources_role` VALUES ('1537', '19', '/goods/goodsDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1538', '19', '/goodsType/ajaxGoodsTypeAttribute', '15402CB3');
INSERT INTO `resources_role` VALUES ('1539', '19', '/goodsNorms/goodsNormsList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1540', '19', '/goodsNorms/goodsNormsAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1541', '19', '/goodsNorms/goodsNormsUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1542', '19', '/goodsNorms/goodsNormsDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1543', '19', '/goodsNorms/normsAttrList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1544', '19', '/goodsNorms/normsAttrAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1545', '19', '/goodsNorms/normsUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1546', '19', '/goodsNorms/normsAttrDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1547', '19', '/goodsNorms/ajaxGoodsNormsList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1548', '19', '/goodsNorms/ajaxNormsAttrList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1549', '19', '/goodsNorms/ajaxGoodsAttrList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1550', '19', '/user/userList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1551', '19', '/user/addUser', '15402CB3');
INSERT INTO `resources_role` VALUES ('1552', '19', '/user/updateUser', '15402CB3');
INSERT INTO `resources_role` VALUES ('1553', '19', '/user/seeUser', '15402CB3');
INSERT INTO `resources_role` VALUES ('1554', '19', '/user/deleteUser', '15402CB3');
INSERT INTO `resources_role` VALUES ('1555', '19', '/user/resetPass', '15402CB3');
INSERT INTO `resources_role` VALUES ('1556', '19', '/department/departmentList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1557', '19', '/department/addDepartment', '15402CB3');
INSERT INTO `resources_role` VALUES ('1558', '19', '/department/updateDepartment', '15402CB3');
INSERT INTO `resources_role` VALUES ('1559', '19', '/department/seeDepartment', '15402CB3');
INSERT INTO `resources_role` VALUES ('1560', '19', '/department/deleteDepartment', '15402CB3');
INSERT INTO `resources_role` VALUES ('1561', '19', '/department/ajaxDepartmentList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1562', '19', '/role/roleList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1563', '19', '/role/addRole', '15402CB3');
INSERT INTO `resources_role` VALUES ('1564', '19', '/role/updateRole', '15402CB3');
INSERT INTO `resources_role` VALUES ('1565', '19', '/role/seeRole', '15402CB3');
INSERT INTO `resources_role` VALUES ('1566', '19', '/role/deleteRole', '15402CB3');
INSERT INTO `resources_role` VALUES ('1567', '19', '/shoppingHome/companyConfigSet', '15402CB3');
INSERT INTO `resources_role` VALUES ('1568', '19', '/user/stockholderList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1569', '19', '/user/addStockholder', '15402CB3');
INSERT INTO `resources_role` VALUES ('1570', '19', '/user/updateStockholder', '15402CB3');
INSERT INTO `resources_role` VALUES ('1571', '19', '/user/deleteStockholder', '15402CB3');
INSERT INTO `resources_role` VALUES ('1572', '19', '/user/seeStockholder', '15402CB3');
INSERT INTO `resources_role` VALUES ('1573', '19', '/finance/financeList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1574', '19', '/finance/withdrawalsList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1575', '19', '/finance/withdrawalsAudit', '15402CB3');
INSERT INTO `resources_role` VALUES ('1576', '19', '/finance/integralList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1577', '19', '/finance/bankCardList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1578', '19', '/finance/bankCardUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1579', '19', '/finance/recharge', '15402CB3');
INSERT INTO `resources_role` VALUES ('1580', '19', '/finance/integralWithdrawalsList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1581', '19', '/finance/integralWithdrawalsAudit', '15402CB3');
INSERT INTO `resources_role` VALUES ('1582', '19', '/finance/withdrawalsSet', '15402CB3');
INSERT INTO `resources_role` VALUES ('1583', '19', '/finance/stockBus', '15402CB3');
INSERT INTO `resources_role` VALUES ('1584', '19', '/member/distributorList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1585', '19', '/member/distributorAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1586', '19', '/member/distributorUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1587', '19', '/member/distributorDetail', '15402CB3');
INSERT INTO `resources_role` VALUES ('1588', '19', '/member/distributorDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1589', '19', '/member/userList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1590', '19', '/member/userAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1591', '19', '/member/userUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1592', '19', '/member/userDetail', '15402CB3');
INSERT INTO `resources_role` VALUES ('1593', '19', '/member/userDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1594', '19', '/member/masterList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1595', '19', '/member/masterAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1596', '19', '/member/masterUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1597', '19', '/member/masterDetail', '15402CB3');
INSERT INTO `resources_role` VALUES ('1598', '19', '/member/masterDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1599', '19', '/member/ajaxDistributorList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1600', '19', '/member/memberReceiptList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1601', '19', '/member/upMemberReceipt', '15402CB3');
INSERT INTO `resources_role` VALUES ('1602', '19', '/member/memberReceiptAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1603', '19', '/member/memberReceiptDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1604', '19', '/member/workTypeList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1605', '19', '/member/workTypeAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1606', '19', '/member/workTypeUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1607', '19', '/member/workTypeDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1608', '19', '/member/changeUserMaster', '15402CB3');
INSERT INTO `resources_role` VALUES ('1609', '19', '/member/changeUserDistributor', '15402CB3');
INSERT INTO `resources_role` VALUES ('1610', '19', '/distributorLevel/distributorLevelList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1611', '19', '/distributorLevel/distributorLevelAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1612', '19', '/distributorLevel/distributorLevelUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1613', '19', '/distributorLevel/distributorLevelDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1614', '19', '/article/articleTypeList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1615', '19', '/article/articleList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1616', '19', '/article/addArticle', '15402CB3');
INSERT INTO `resources_role` VALUES ('1617', '19', '/article/updateArticle', '15402CB3');
INSERT INTO `resources_role` VALUES ('1618', '19', '/article/deleteArticle', '15402CB3');
INSERT INTO `resources_role` VALUES ('1619', '19', '/article/seeArticle', '15402CB3');
INSERT INTO `resources_role` VALUES ('1620', '19', '/article/addArticleType', '15402CB3');
INSERT INTO `resources_role` VALUES ('1621', '19', '/article/updateArticleType', '15402CB3');
INSERT INTO `resources_role` VALUES ('1622', '19', '/article/deleteArticleType', '15402CB3');
INSERT INTO `resources_role` VALUES ('1623', '19', '/apiList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1624', '19', '/addApi', '15402CB3');
INSERT INTO `resources_role` VALUES ('1625', '19', '/updateApi', '15402CB3');
INSERT INTO `resources_role` VALUES ('1626', '19', '/deleteApi', '15402CB3');
INSERT INTO `resources_role` VALUES ('1627', '19', '/integral/goodsList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1628', '19', '/integral/goodsAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1629', '19', '/integral/goodsUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1630', '19', '/integral/goodsDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1631', '19', '/goods/ajaxGoodsList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1632', '19', '/integral/goodsDetail', '15402CB3');
INSERT INTO `resources_role` VALUES ('1633', '19', '/qrCode/goodsQrCodeList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1634', '19', '/qrCode/goodsQrCodeAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1635', '19', '/qrCode/goodsQrCodeDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1636', '19', '/qrCode/exportGoodsQrCode', '15402CB3');
INSERT INTO `resources_role` VALUES ('1637', '19', '/integral/integralProportionSet', '15402CB3');
INSERT INTO `resources_role` VALUES ('1638', '19', '/order/orderList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1639', '19', '/order/updateOrder', '15402CB3');
INSERT INTO `resources_role` VALUES ('1640', '19', '/order/goodList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1641', '19', '/order/deliverGoodsSet', '15402CB3');
INSERT INTO `resources_role` VALUES ('1642', '19', '/order/returnList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1643', '19', '/banner/bannerTypeList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1644', '19', '/banner/addType', '15402CB3');
INSERT INTO `resources_role` VALUES ('1645', '19', '/banner/updateType', '15402CB3');
INSERT INTO `resources_role` VALUES ('1646', '19', '/banner/seeType', '15402CB3');
INSERT INTO `resources_role` VALUES ('1647', '19', '/banner/deleteType', '15402CB3');
INSERT INTO `resources_role` VALUES ('1648', '19', '/banner/bannerList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1649', '19', '/banner/addBanner', '15402CB3');
INSERT INTO `resources_role` VALUES ('1650', '19', '/banner/updateBanner', '15402CB3');
INSERT INTO `resources_role` VALUES ('1651', '19', '/banner/seeBanner', '15402CB3');
INSERT INTO `resources_role` VALUES ('1652', '19', '/banner/deleteBanner', '15402CB3');
INSERT INTO `resources_role` VALUES ('1653', '19', '/shoppingHome/modularList', '15402CB3');
INSERT INTO `resources_role` VALUES ('1654', '19', '/shoppingHome/modularAdd', '15402CB3');
INSERT INTO `resources_role` VALUES ('1655', '19', '/shoppingHome/modularUpdate', '15402CB3');
INSERT INTO `resources_role` VALUES ('1656', '19', '/shoppingHome/modularDelete', '15402CB3');
INSERT INTO `resources_role` VALUES ('1657', '19', '/order/updateReturn', '15402CB3');
INSERT INTO `resources_role` VALUES ('1695', '13', '/stocks/stocksList', '');
INSERT INTO `resources_role` VALUES ('1696', '13', '/stocks/addStocks', '');
INSERT INTO `resources_role` VALUES ('1697', '13', '/stocks/updateStocks', '');
INSERT INTO `resources_role` VALUES ('1698', '13', '/stocks/deleteStocks', '');
INSERT INTO `resources_role` VALUES ('1699', '13', '/holds/holdsList', '');
INSERT INTO `resources_role` VALUES ('1703', '13', '/holds/addHolds', '');
INSERT INTO `resources_role` VALUES ('1704', '13', '/holds/updateHolds', '');
INSERT INTO `resources_role` VALUES ('1705', '13', '/holds/deleteHolds', '');
INSERT INTO `resources_role` VALUES ('1706', '13', '/holds/settlementHolds', '');
INSERT INTO `resources_role` VALUES ('1707', '15', '/holds/holdsList', '');
INSERT INTO `resources_role` VALUES ('1709', '13', '/banner/bannerTypeList', '');
INSERT INTO `resources_role` VALUES ('1711', '13', '/banner/updateType', '');
INSERT INTO `resources_role` VALUES ('1712', '13', '/banner/bannerList', '');
INSERT INTO `resources_role` VALUES ('1713', '13', '/banner/addBanner', '');
INSERT INTO `resources_role` VALUES ('1714', '13', '/banner/updateBanner', '');
INSERT INTO `resources_role` VALUES ('1715', '13', '/banner/seeType', '');
INSERT INTO `resources_role` VALUES ('1716', '13', '/banner/seeBanner', '');
INSERT INTO `resources_role` VALUES ('1717', '13', '/banner/deleteBanner', '');
INSERT INTO `resources_role` VALUES ('1718', '13', '/city/cityList', '');
INSERT INTO `resources_role` VALUES ('1719', '13', '/city/cityAdd', '');
INSERT INTO `resources_role` VALUES ('1720', '13', '/city/cityUpdate', '');
INSERT INTO `resources_role` VALUES ('1721', '13', '/city/cityDelete', '');
INSERT INTO `resources_role` VALUES ('1722', '13', '/city/ajaxcityList', '');
INSERT INTO `resources_role` VALUES ('1723', '13', '/article/articleTypeList', '');
INSERT INTO `resources_role` VALUES ('1724', '13', '/article/articleList', '');
INSERT INTO `resources_role` VALUES ('1725', '13', '/article/addArticle', '');
INSERT INTO `resources_role` VALUES ('1726', '13', '/article/updateArticle', '');
INSERT INTO `resources_role` VALUES ('1727', '13', '/article/deleteArticle', '');
INSERT INTO `resources_role` VALUES ('1728', '13', '/article/seeArticle', '');
INSERT INTO `resources_role` VALUES ('1729', '13', '/home/companyConfigSet', '');
INSERT INTO `resources_role` VALUES ('1730', '13', '/link/linkTypeList', '');
INSERT INTO `resources_role` VALUES ('1731', '13', '/link/addLink', '');
INSERT INTO `resources_role` VALUES ('1732', '13', '/link/linkList', '');
INSERT INTO `resources_role` VALUES ('1733', '13', '/link/updateLink', '');
INSERT INTO `resources_role` VALUES ('1734', '13', '/link/deleteLink', '');
INSERT INTO `resources_role` VALUES ('1735', '13', '/link/seeLink', '');
INSERT INTO `resources_role` VALUES ('1736', '13', '/partner/partnerTypeList', '');
INSERT INTO `resources_role` VALUES ('1737', '13', '/partner/addPartner', '');
INSERT INTO `resources_role` VALUES ('1738', '13', '/partner/partnerList', '');
INSERT INTO `resources_role` VALUES ('1739', '13', '/partner/updatePartner', '');
INSERT INTO `resources_role` VALUES ('1740', '13', '/partner/deletePartner', '');
INSERT INTO `resources_role` VALUES ('1741', '13', '/partner/seePartner', '');
INSERT INTO `resources_role` VALUES ('1742', '13', '/partner/addPartnerType', '');
INSERT INTO `resources_role` VALUES ('1743', '13', '/partner/updatePartnerType', '');
INSERT INTO `resources_role` VALUES ('1744', '13', '/teamMember/teamMemberList', '');
INSERT INTO `resources_role` VALUES ('1745', '13', '/teamMember/addTeamMember', '');
INSERT INTO `resources_role` VALUES ('1746', '13', '/teamMember/updateTeamMember', '');
INSERT INTO `resources_role` VALUES ('1747', '13', '/teamMember/deleteTeamMember', '');
INSERT INTO `resources_role` VALUES ('1748', '13', '/teamMember/seeTeamMember', '');
INSERT INTO `resources_role` VALUES ('1749', '13', '/hotsearch/hotsearchList', '');
INSERT INTO `resources_role` VALUES ('1750', '13', '/hotsearch/addHotsearch', '');
INSERT INTO `resources_role` VALUES ('1751', '13', '/hotsearch/updateHotsearch', '');
INSERT INTO `resources_role` VALUES ('1752', '13', '/hotsearch/deleteHotsearch', '');
INSERT INTO `resources_role` VALUES ('1753', '13', '/hotsearch/seeHotsearch', '');
INSERT INTO `resources_role` VALUES ('1754', '13', '/customerConsult/customerConsultList', '');
INSERT INTO `resources_role` VALUES ('1755', '13', '/customerConsult/seeCustomerConsult', '');
INSERT INTO `resources_role` VALUES ('1756', '13', '/tag/tagList', '');
INSERT INTO `resources_role` VALUES ('1757', '13', '/tag/addTag', '');
INSERT INTO `resources_role` VALUES ('1758', '13', '/tag/updateTag', '');
INSERT INTO `resources_role` VALUES ('1759', '13', '/tag/deleteTag', '');
INSERT INTO `resources_role` VALUES ('1760', '13', '/tag/seeTag', '');
INSERT INTO `resources_role` VALUES ('1761', '13', '/enum/enumList', '');
INSERT INTO `resources_role` VALUES ('1762', '13', '/enum/addEnum', '');
INSERT INTO `resources_role` VALUES ('1763', '13', '/enum/updateEnum', '');
INSERT INTO `resources_role` VALUES ('1764', '13', '/enum/seeEnum', '');
INSERT INTO `resources_role` VALUES ('1765', '13', '/house/houseList', '');
INSERT INTO `resources_role` VALUES ('1766', '13', '/house/addHouse', '');
INSERT INTO `resources_role` VALUES ('1767', '13', '/house/updateHouse', '');
INSERT INTO `resources_role` VALUES ('1768', '13', '/house/deleteHouse', '');
INSERT INTO `resources_role` VALUES ('1769', '13', '/house/seeHouse', '');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `access_key` varchar(25) NOT NULL DEFAULT '' COMMENT '唯一关联标识',
  PRIMARY KEY (`id`),
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('13', '超级管理员', '1C694C95');
INSERT INTO `role` VALUES ('14', '客服人员', '1C694C95');
INSERT INTO `role` VALUES ('15', '客户专员', '1C694C95');

-- ----------------------------
-- Table structure for stocks
-- ----------------------------
DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `scode` char(20) CHARACTER SET utf8mb4 NOT NULL COMMENT '商品代码',
  `sname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '商品名称',
  `price` decimal(16,2) NOT NULL COMMENT '标牌价',
  `tprice` decimal(16,2) NOT NULL COMMENT '最新目标价',
  `updated_at` varchar(20) DEFAULT NULL COMMENT '更新时间',
  `created_at` varchar(20) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `scode` (`scode`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='商品数据表';

-- ----------------------------
-- Records of stocks
-- ----------------------------
INSERT INTO `stocks` VALUES ('4', 'code2', '商品2', '12.22', '15.00', '2019-04-10 14:51:25', '2019-04-10 14:51:25');
INSERT INTO `stocks` VALUES ('5', 'code3', '商品3', '8.88', '10.22', '2019-04-10 14:58:19', '2019-04-10 14:58:19');
INSERT INTO `stocks` VALUES ('8', 'code8', '商品8', '12.12', '22.22', '2019-04-10 14:59:33', '2019-04-10 14:59:33');
INSERT INTO `stocks` VALUES ('9', '601700', '大将风范', '8.76', '0.00', '2019-04-13 11:41:02', '2019-04-11 14:12:14');
INSERT INTO `stocks` VALUES ('10', '300170', '汉得xx', '16.90', '0.00', '2019-04-15 11:50:50', '2019-04-13 14:51:41');

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '标签名',
  `type` int(10) DEFAULT NULL COMMENT '标签类型，1房产标签,2投资标签',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('1', '不限购', '1', '0', '1', '2021-02-21 13:35:22', '2021-02-21 13:35:22');
INSERT INTO `tag` VALUES ('2', '自住', '1', '2', '2', '2021-02-21 13:35:39', '2021-02-21 13:35:39');
INSERT INTO `tag` VALUES ('3', '投资标签2', '2', '32', '2', '2021-02-21 13:35:52', '2021-02-21 13:36:34');
INSERT INTO `tag` VALUES ('4', '投资标签1', '2', '0', '1', '2021-02-21 13:36:07', '2021-02-21 13:36:07');

-- ----------------------------
-- Table structure for team_member
-- ----------------------------
DROP TABLE IF EXISTS `team_member`;
CREATE TABLE `team_member` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '名字',
  `job` varchar(100) NOT NULL DEFAULT '' COMMENT '职位',
  `phone` int(13) DEFAULT NULL COMMENT '电话',
  `photo` varchar(100) DEFAULT '' COMMENT '照片',
  `describe` varchar(255) DEFAULT '' COMMENT '描述',
  `wechat_id` varchar(100) DEFAULT '' COMMENT '微信号',
  `wechat_code` varchar(100) DEFAULT '' COMMENT '微信二维码',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='团队成员';

-- ----------------------------
-- Records of team_member
-- ----------------------------
INSERT INTO `team_member` VALUES ('2', '五阿哥', '阿哥', '11111111', 'uploads/images/jT48qo0Ddw.jpg', '这是阿哥', '111', 'uploads/images/3LrZmV2rFm.jpg', '0', '1', '2021-02-15 23:47:14', '2021-02-15 23:47:14');
INSERT INTO `team_member` VALUES ('3', '小吴', '开发工程师', '111111', 'uploads/images/sa0UFRFDL1.jpg', '这是开发工程师', '12', 'uploads/images/0ETrQibkBs.jpg', '0', '1', '2021-02-15 23:48:50', '2021-02-15 23:48:50');
INSERT INTO `team_member` VALUES ('4', '111', '111111', '111111', 'uploads/images/kVEkLxXfux.jpg', '111', '1', 'uploads/images/TQ2B9ikPTn.jpg', '0', '1', '2021-02-15 23:49:21', '2021-02-15 23:49:21');
INSERT INTO `team_member` VALUES ('5', '2223', '22223', '2223', 'uploads/images/1yWX4gJWQE.jpeg', '22223', '22223', 'uploads/images/GNJWXq9JGd.jpeg', '23', '2', '2021-02-15 23:49:50', '2021-02-16 00:00:00');
INSERT INTO `team_member` VALUES ('6', '小燕子', '格格', '1234567', 'uploads/images/UtJ9rILGTo.jpg', '这是小燕子的描述', 'wechat123', 'uploads/images/fFhbxVlbt0.jpg', '0', '1', '2021-02-21 08:50:55', '2021-02-21 08:50:55');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '所属上级',
  `access_token` varchar(150) NOT NULL DEFAULT '' COMMENT 'token',
  `nickname` varchar(20) DEFAULT NULL,
  `real_name` varchar(20) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `phone` varchar(11) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `head_portrait` varchar(150) NOT NULL DEFAULT '' COMMENT '头像',
  `channel_status` tinyint(1) DEFAULT '0' COMMENT '//是否渠道商 1是 0不是',
  `channel_num` varchar(20) DEFAULT NULL COMMENT '//渠道商编号',
  `by_agent_num` varchar(20) NOT NULL DEFAULT '' COMMENT '经该代理商推荐编号',
  `agent_status` tinyint(1) DEFAULT '0' COMMENT '//是否代理商 1是0不是',
  `agent_num` varchar(20) DEFAULT NULL COMMENT '//代理商编号',
  `business_status` tinyint(1) DEFAULT '0' COMMENT '//是否商家 1是0不是 默认0',
  `idcard` varchar(25) NOT NULL DEFAULT '' COMMENT '身份证号',
  `idcard_pho` varchar(125) NOT NULL DEFAULT '' COMMENT '身份证正反面',
  `birthday` varchar(15) DEFAULT '2017-01-17' COMMENT '生日',
  `sex` tinyint(1) DEFAULT '1' COMMENT '性别1是男2是女',
  `cash_password` varchar(150) NOT NULL DEFAULT '' COMMENT '兑现支付密码',
  `access_key` varchar(25) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recommend_id` (`idcard`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('196', '0', '2be7a09f9a0d754938fca490c3ff9861', '张智远', '', '18030318430', '$2y$10$UlF4hQ81I3CmWiycEm8seOqGYvlHeNRhYKb/Hn4NVZsWbHfJ2Fl2G', '', '1', 'QDS20190101854348', '', '1', 'DLS20190101301457', '0', '', '', '2017-01-17', '1', '', null, '2018-09-30 22:47:23', '2019-01-01 19:15:44');

-- ----------------------------
-- Table structure for user_amount_log
-- ----------------------------
DROP TABLE IF EXISTS `user_amount_log`;
CREATE TABLE `user_amount_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1用户id2商家id',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID/本项目为商家id',
  `user_nickname` varchar(20) NOT NULL COMMENT '用户昵称',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `operation_amount` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '本次操作金额',
  `original_balance` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '原本金额',
  `current_blaance` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '操作后余额',
  `type` tinyint(1) NOT NULL COMMENT '1余额增加2提现3平台修改4在线支付5用户消费6平账专用7提成8返佣',
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_nickname` (`user_nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=622 DEFAULT CHARSET=utf8 COMMENT='用户资金日志';

-- ----------------------------
-- Records of user_amount_log
-- ----------------------------
INSERT INTO `user_amount_log` VALUES ('451', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]200元', '200.00', '0.00', '0.00', '5', '2017-04-26 14:26:32', '2017-04-26 14:26:32');
INSERT INTO `user_amount_log` VALUES ('461', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]200元', '200.00', '0.00', '0.00', '5', '2017-04-26 14:41:50', '2017-04-26 14:41:50');
INSERT INTO `user_amount_log` VALUES ('463', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]200元', '200.00', '0.00', '0.00', '5', '2017-04-26 15:26:40', '2017-04-26 15:26:40');
INSERT INTO `user_amount_log` VALUES ('468', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]200元', '200.00', '0.00', '0.00', '5', '2017-04-26 15:34:46', '2017-04-26 15:34:46');
INSERT INTO `user_amount_log` VALUES ('473', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]200元', '200.00', '0.00', '0.00', '5', '2017-04-26 15:53:29', '2017-04-26 15:53:29');
INSERT INTO `user_amount_log` VALUES ('474', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]200元', '200.00', '0.00', '0.00', '5', '2017-04-26 15:57:09', '2017-04-26 15:57:09');
INSERT INTO `user_amount_log` VALUES ('475', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]200元', '200.00', '0.00', '0.00', '5', '2017-04-26 15:58:20', '2017-04-26 15:58:20');
INSERT INTO `user_amount_log` VALUES ('478', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]200元', '200.00', '0.00', '0.00', '5', '2017-04-26 16:23:43', '2017-04-26 16:23:43');
INSERT INTO `user_amount_log` VALUES ('479', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]100元', '100.00', '0.00', '0.00', '5', '2017-04-26 16:24:41', '2017-04-26 16:24:41');
INSERT INTO `user_amount_log` VALUES ('480', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]100元', '100.00', '0.00', '0.00', '5', '2017-04-26 16:25:13', '2017-04-26 16:25:13');
INSERT INTO `user_amount_log` VALUES ('481', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]100元', '100.00', '0.00', '0.00', '5', '2017-04-26 16:25:52', '2017-04-26 16:25:52');
INSERT INTO `user_amount_log` VALUES ('482', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]100元', '100.00', '0.00', '0.00', '5', '2017-04-26 16:26:11', '2017-04-26 16:26:11');
INSERT INTO `user_amount_log` VALUES ('483', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 16:35:07', '2017-04-26 16:35:07');
INSERT INTO `user_amount_log` VALUES ('484', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 16:36:53', '2017-04-26 16:36:53');
INSERT INTO `user_amount_log` VALUES ('485', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 16:39:21', '2017-04-26 16:39:21');
INSERT INTO `user_amount_log` VALUES ('491', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 16:42:55', '2017-04-26 16:42:55');
INSERT INTO `user_amount_log` VALUES ('492', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 16:54:29', '2017-04-26 16:54:29');
INSERT INTO `user_amount_log` VALUES ('493', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 16:59:49', '2017-04-26 16:59:49');
INSERT INTO `user_amount_log` VALUES ('494', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 17:01:14', '2017-04-26 17:01:14');
INSERT INTO `user_amount_log` VALUES ('495', '1', '28', '缓存测试添加', '用户线下消费50', '50.00', '0.00', '50.00', '1', '2017-04-26 17:50:27', '2017-04-26 17:50:27');
INSERT INTO `user_amount_log` VALUES ('496', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 17:50:29', '2017-04-26 17:50:29');
INSERT INTO `user_amount_log` VALUES ('497', '1', '28', '缓存测试添加', '用户线下消费50', '50.00', '50.00', '100.00', '1', '2017-04-26 17:53:25', '2017-04-26 17:53:25');
INSERT INTO `user_amount_log` VALUES ('498', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 17:53:26', '2017-04-26 17:53:26');
INSERT INTO `user_amount_log` VALUES ('499', '1', '28', '缓存测试添加', '用户线下消费50', '50.00', '100.00', '150.00', '1', '2017-04-26 17:54:49', '2017-04-26 17:54:49');
INSERT INTO `user_amount_log` VALUES ('500', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 17:54:50', '2017-04-26 17:54:50');
INSERT INTO `user_amount_log` VALUES ('502', '1', '28', '缓存测试添加', '用户线下消费50', '50.00', '150.00', '200.00', '1', '2017-04-26 18:12:16', '2017-04-26 18:12:16');
INSERT INTO `user_amount_log` VALUES ('503', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 18:12:16', '2017-04-26 18:12:16');
INSERT INTO `user_amount_log` VALUES ('504', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]100元', '100.00', '0.00', '0.00', '5', '2017-04-26 20:02:34', '2017-04-26 20:02:34');
INSERT INTO `user_amount_log` VALUES ('505', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 20:09:16', '2017-04-26 20:09:16');
INSERT INTO `user_amount_log` VALUES ('506', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]100元', '100.00', '0.00', '0.00', '5', '2017-04-26 20:12:09', '2017-04-26 20:12:09');
INSERT INTO `user_amount_log` VALUES ('507', '1', '28', '缓存测试添加', '用户线下消费0.00', '0.00', '200.00', '200.00', '1', '2017-04-26 20:13:07', '2017-04-26 20:13:07');
INSERT INTO `user_amount_log` VALUES ('508', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]0.00元', '0.00', '0.00', '0.00', '5', '2017-04-26 20:13:07', '2017-04-26 20:13:07');
INSERT INTO `user_amount_log` VALUES ('509', '1', '28', '缓存测试添加', '用户线下消费100', '100.00', '200.00', '300.00', '1', '2017-04-26 20:19:03', '2017-04-26 20:19:03');
INSERT INTO `user_amount_log` VALUES ('510', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]100元', '100.00', '0.00', '0.00', '5', '2017-04-26 20:19:05', '2017-04-26 20:19:05');
INSERT INTO `user_amount_log` VALUES ('511', '1', '28', '缓存测试添加', '用户线下消费50', '50.00', '300.00', '350.00', '1', '2017-04-26 20:21:27', '2017-04-26 20:21:27');
INSERT INTO `user_amount_log` VALUES ('512', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 20:21:28', '2017-04-26 20:21:28');
INSERT INTO `user_amount_log` VALUES ('513', '1', '28', '缓存测试添加', '用户线下消费50', '50.00', '350.00', '400.00', '1', '2017-04-26 20:23:38', '2017-04-26 20:23:38');
INSERT INTO `user_amount_log` VALUES ('514', '1', '147', '18850221115', '订单[2017040607434][支付宝消费]50元', '50.00', '0.00', '0.00', '5', '2017-04-26 20:23:38', '2017-04-26 20:23:38');
INSERT INTO `user_amount_log` VALUES ('515', '2', '132', '测试', '用户线下消费50', '50.00', '0.00', '11.00', '1', '2017-04-26 20:23:38', null);
INSERT INTO `user_amount_log` VALUES ('517', '2', '31', '店铺2', '[提现]', '100.00', '800.00', '700.00', '2', '2017-05-03 15:11:28', '2017-05-03 15:11:28');
INSERT INTO `user_amount_log` VALUES ('518', '2', '31', '店铺2', '[提现]', '100.00', '700.00', '600.00', '2', '2017-05-03 15:22:02', '2017-05-03 15:22:02');
INSERT INTO `user_amount_log` VALUES ('519', '2', '31', '店铺2', '[提现]', '100.00', '600.00', '500.00', '2', '2017-05-03 15:35:12', '2017-05-03 15:35:12');
INSERT INTO `user_amount_log` VALUES ('520', '2', '19', '后台添加商家测试', '[提现]', '999.00', '1000.00', '1.00', '2', '2017-05-04 15:15:16', '2017-05-04 15:15:16');
INSERT INTO `user_amount_log` VALUES ('521', '2', '19', '后台添加商家测试', '[提现]', '100.00', '10000.00', '9900.00', '2', '2017-05-05 09:37:33', '2017-05-05 09:37:33');
INSERT INTO `user_amount_log` VALUES ('522', '2', '19', '后台添加商家测试', '[提现]', '100.00', '9900.00', '9800.00', '2', '2017-05-05 09:48:41', '2017-05-05 09:48:41');
INSERT INTO `user_amount_log` VALUES ('523', '2', '19', '后台添加商家测试', '[提现]', '100.00', '9800.00', '9700.00', '2', '2017-05-05 10:24:30', '2017-05-05 10:24:30');
INSERT INTO `user_amount_log` VALUES ('524', '1', '139', 'Have', '订单[2017050559873][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-05 15:22:52', '2017-05-05 15:22:52');
INSERT INTO `user_amount_log` VALUES ('525', '1', '149', '15359225953', '订单[2017050511014][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-05 15:23:11', '2017-05-05 15:23:11');
INSERT INTO `user_amount_log` VALUES ('526', '1', '149', '15359225953', '订单[2017050553948][支付宝消费]0.2元', '0.20', '0.00', '0.00', '5', '2017-05-05 15:24:11', '2017-05-05 15:24:11');
INSERT INTO `user_amount_log` VALUES ('527', '1', '139', 'Have', '订单[2017050593431][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-05 15:24:20', '2017-05-05 15:24:20');
INSERT INTO `user_amount_log` VALUES ('528', '1', '149', '15359225953', '订单[2017050526219][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-05 15:26:46', '2017-05-05 15:26:46');
INSERT INTO `user_amount_log` VALUES ('529', '1', '149', '15359225953', '订单[2017050522889][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-05 15:32:20', '2017-05-05 15:32:20');
INSERT INTO `user_amount_log` VALUES ('530', '2', '19', '后台添加商家测', '用户线下消费0.1', '0.10', '9700.00', '9700.10', '1', '2017-05-05 22:17:39', '2017-05-05 22:17:39');
INSERT INTO `user_amount_log` VALUES ('531', '1', '134', '测试修改刷新', '订单[2017050400765][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-05 22:17:39', '2017-05-05 22:17:39');
INSERT INTO `user_amount_log` VALUES ('532', '1', '154', '15980609689', '订单[2017050704176][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-07 14:35:57', '2017-05-07 14:35:57');
INSERT INTO `user_amount_log` VALUES ('533', '2', '48', '7天酒店', '用户线下消费0.01', '0.01', '0.00', '0.01', '1', '2017-05-07 20:05:05', '2017-05-07 20:05:05');
INSERT INTO `user_amount_log` VALUES ('534', '1', '154', '15980609689', '订单[2017050741497][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-07 20:05:05', '2017-05-07 20:05:05');
INSERT INTO `user_amount_log` VALUES ('535', '2', '32', '我的', '[提现]', '100.00', '10000.00', '9900.00', '2', '2017-05-08 10:31:02', '2017-05-08 10:31:02');
INSERT INTO `user_amount_log` VALUES ('536', '2', '32', '我的', '[提现]', '100.00', '9900.00', '9800.00', '2', '2017-05-08 10:33:10', '2017-05-08 10:33:10');
INSERT INTO `user_amount_log` VALUES ('537', '2', '32', '我的', '[提现审核]审核失败，增加提现金额：100.00元', '100.00', '9800.00', '9900.00', '1', '2017-05-08 11:35:03', '2017-05-08 11:35:03');
INSERT INTO `user_amount_log` VALUES ('538', '1', '150', 'lily', '订单[2017050817739][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-08 16:26:57', '2017-05-08 16:26:57');
INSERT INTO `user_amount_log` VALUES ('539', '1', '153', '东山', '订单[2017050878056][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-08 16:45:50', '2017-05-08 16:45:50');
INSERT INTO `user_amount_log` VALUES ('540', '1', '154', '15980609689', '订单[2017050839370][支付宝消费]0.02元', '0.02', '0.00', '0.00', '5', '2017-05-08 17:09:07', '2017-05-08 17:09:07');
INSERT INTO `user_amount_log` VALUES ('541', '1', '150', 'lily', '订单[2017050816823][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-08 18:11:13', '2017-05-08 18:11:13');
INSERT INTO `user_amount_log` VALUES ('542', '1', '151', '15870065127', '订单[2017050900727][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-09 10:01:17', '2017-05-09 10:01:17');
INSERT INTO `user_amount_log` VALUES ('543', '1', '150', 'lily', '订单[2017050908573][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-09 10:10:29', '2017-05-09 10:10:29');
INSERT INTO `user_amount_log` VALUES ('544', '1', '151', '15870065127', '订单[2017050940699][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-09 11:16:20', '2017-05-09 11:16:20');
INSERT INTO `user_amount_log` VALUES ('552', '1', '149', '我是测试', '订单[2017051185165][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-11 10:48:35', '2017-05-11 10:48:35');
INSERT INTO `user_amount_log` VALUES ('553', '1', '149', '我是测试', '订单[2017051182101][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-11 10:51:32', '2017-05-11 10:51:32');
INSERT INTO `user_amount_log` VALUES ('554', '1', '149', '我是测试', '订单[2017051128273][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-11 10:54:45', '2017-05-11 10:54:45');
INSERT INTO `user_amount_log` VALUES ('555', '1', '149', '我是测试结果', '订单[2017051182101][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-11 11:13:48', '2017-05-11 11:13:48');
INSERT INTO `user_amount_log` VALUES ('556', '1', '151', '15870065127', '订单[2017051147471][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-11 14:35:33', '2017-05-11 14:35:33');
INSERT INTO `user_amount_log` VALUES ('557', '2', '84', '我要开店', '用户线下消费0.01', '0.01', '0.00', '0.01', '1', '2017-05-11 14:43:35', '2017-05-11 14:43:35');
INSERT INTO `user_amount_log` VALUES ('558', '1', '156', '17759413572', '订单[2017051142672][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-11 14:43:35', '2017-05-11 14:43:35');
INSERT INTO `user_amount_log` VALUES ('559', '2', '84', '我要开店', '用户线下消费0.2', '0.20', '0.01', '0.21', '1', '2017-05-11 14:51:50', '2017-05-11 14:51:50');
INSERT INTO `user_amount_log` VALUES ('560', '1', '156', '17759413572', '订单[2017051108475][支付宝消费]0.2元', '0.20', '0.00', '0.00', '5', '2017-05-11 14:51:50', '2017-05-11 14:51:50');
INSERT INTO `user_amount_log` VALUES ('561', '2', '84', '我要开店', '用户线下消费0.2', '0.20', '0.21', '0.41', '1', '2017-05-12 10:42:33', '2017-05-12 10:42:33');
INSERT INTO `user_amount_log` VALUES ('562', '1', '148', '阿萨德飒沓', '订单[2017051298337][支付宝消费]0.2元', '0.20', '0.00', '0.00', '5', '2017-05-12 10:42:33', '2017-05-12 10:42:33');
INSERT INTO `user_amount_log` VALUES ('563', '1', '177', '18250815530', '订单[2017051244232][支付宝消费]1元', '1.00', '0.00', '0.00', '5', '2017-05-12 15:54:14', '2017-05-12 15:54:14');
INSERT INTO `user_amount_log` VALUES ('564', '1', '176', '我是昵称', '订单[2017051250263][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-12 15:56:08', '2017-05-12 15:56:08');
INSERT INTO `user_amount_log` VALUES ('565', '1', '177', '18250815530', '订单[2017051239775][支付宝消费]1元', '1.00', '0.00', '0.00', '5', '2017-05-12 16:23:16', '2017-05-12 16:23:16');
INSERT INTO `user_amount_log` VALUES ('566', '2', '87', '钱钱钱钱钱', '用户线下消费1', '1.00', '0.00', '1.00', '1', '2017-05-12 16:56:18', '2017-05-12 16:56:18');
INSERT INTO `user_amount_log` VALUES ('567', '1', '177', '18250815530', '订单[2017051280646][支付宝消费]1元', '1.00', '0.00', '0.00', '5', '2017-05-12 16:56:18', '2017-05-12 16:56:18');
INSERT INTO `user_amount_log` VALUES ('568', '2', '87', '钱钱钱钱钱', '用户线下消费0.01', '0.01', '1.00', '1.01', '1', '2017-05-12 16:57:33', '2017-05-12 16:57:33');
INSERT INTO `user_amount_log` VALUES ('569', '1', '176', '我是昵称', '订单[2017051238595][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-12 16:57:33', '2017-05-12 16:57:33');
INSERT INTO `user_amount_log` VALUES ('570', '2', '87', '钱钱钱钱钱', '用户线下消费0.01', '0.01', '1.01', '1.02', '1', '2017-05-12 17:02:45', '2017-05-12 17:02:45');
INSERT INTO `user_amount_log` VALUES ('571', '1', '176', '我是昵称', '订单[2017051268228][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-12 17:02:45', '2017-05-12 17:02:45');
INSERT INTO `user_amount_log` VALUES ('572', '2', '87', '钱钱钱钱钱', '用户线下消费0.01', '0.01', '1.02', '1.03', '1', '2017-05-12 17:05:35', '2017-05-12 17:05:35');
INSERT INTO `user_amount_log` VALUES ('573', '1', '176', '我是昵称', '订单[2017051262915][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-12 17:05:35', '2017-05-12 17:05:35');
INSERT INTO `user_amount_log` VALUES ('574', '1', '171', '15870065122', '订单[2017051279031][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-12 17:13:54', '2017-05-12 17:13:54');
INSERT INTO `user_amount_log` VALUES ('601', '1', '166', '叶莉', '订单[2017051547504][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-15 09:52:51', '2017-05-15 09:52:51');
INSERT INTO `user_amount_log` VALUES ('602', '1', '171', '15870065122', '订单[2017051558562][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-15 09:52:53', '2017-05-15 09:52:53');
INSERT INTO `user_amount_log` VALUES ('603', '1', '171', '15870065122', '订单[2017051590306][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-15 09:53:22', '2017-05-15 09:53:22');
INSERT INTO `user_amount_log` VALUES ('604', '2', '84', '我要开店', '用户线下消费0.08元', '0.08', '0.41', '0.49', '1', '2017-05-15 09:53:53', '2017-05-15 09:53:53');
INSERT INTO `user_amount_log` VALUES ('605', '1', '148', '阿萨德飒沓', '订单[2017051515046][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-05-15 09:53:53', '2017-05-15 09:53:53');
INSERT INTO `user_amount_log` VALUES ('606', '1', '177', '18250815530', '订单[2017051566243][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-05-15 09:57:15', '2017-05-15 09:57:15');
INSERT INTO `user_amount_log` VALUES ('607', '1', '159', '18960688757', '订单[2017051596015][支付宝消费]238元', '238.00', '0.00', '0.00', '5', '2017-05-15 10:16:34', '2017-05-15 10:16:34');
INSERT INTO `user_amount_log` VALUES ('608', '2', '87', '钱钱钱钱钱', '用户线下消费8元', '8.00', '1.03', '9.03', '1', '2017-05-15 16:27:12', '2017-05-15 16:27:12');
INSERT INTO `user_amount_log` VALUES ('609', '1', '177', '夜里', '订单[2017051557282][支付宝消费]10.00元', '10.00', '0.00', '0.00', '5', '2017-05-15 16:27:12', '2017-05-15 16:27:12');
INSERT INTO `user_amount_log` VALUES ('610', '2', '87', '钱钱钱钱钱', '用户线下消费4元', '4.00', '9.03', '13.03', '1', '2017-05-15 17:44:30', '2017-05-15 17:44:30');
INSERT INTO `user_amount_log` VALUES ('611', '1', '177', '夜里', '订单[2017051528974][支付宝消费]5.00元', '5.00', '0.00', '0.00', '5', '2017-05-15 17:44:30', '2017-05-15 17:44:30');
INSERT INTO `user_amount_log` VALUES ('612', '1', '180', '15970172573', '订单[2017051504213][支付宝消费]0.10元', '0.10', '0.00', '0.00', '5', '2017-05-15 17:54:05', '2017-05-15 17:54:05');
INSERT INTO `user_amount_log` VALUES ('613', '1', '148', '阿萨德飒沓', '订单[2017051563589]代付[支付宝消费]0.020元', '0.02', '0.00', '0.00', '5', '2017-05-15 18:07:57', '2017-05-15 18:07:57');
INSERT INTO `user_amount_log` VALUES ('614', '1', '148', '阿萨德飒沓', '订单[2017051528062]代付[支付宝消费]0.020元', '0.02', '0.00', '0.00', '5', '2017-05-15 18:08:33', '2017-05-15 18:08:33');
INSERT INTO `user_amount_log` VALUES ('615', '1', '148', '阿萨德飒沓', '订单[2017051577628]代付[支付宝消费]0.020元', '0.02', '0.00', '0.00', '5', '2017-05-15 18:10:05', '2017-05-15 18:10:05');
INSERT INTO `user_amount_log` VALUES ('616', '2', '91', '耶', '用户线下消费0.8元', '0.80', '0.00', '0.80', '1', '2017-05-16 10:55:18', '2017-05-16 10:55:18');
INSERT INTO `user_amount_log` VALUES ('617', '1', '177', '夜里', '订单[2017051677034][支付宝消费]1元', '1.00', '0.00', '0.00', '5', '2017-05-16 10:55:18', '2017-05-16 10:55:18');
INSERT INTO `user_amount_log` VALUES ('618', '1', '176', '我是昵称', '订单[2017051685278]代付[支付宝消费]1.000元', '1.00', '0.00', '0.00', '5', '2017-05-16 10:59:55', '2017-05-16 10:59:55');
INSERT INTO `user_amount_log` VALUES ('619', '1', '187', '15985775888', '订单[2017070389734][支付宝消费]0.01元', '0.01', '0.00', '0.00', '5', '2017-07-03 19:56:45', '2017-07-03 19:56:45');
INSERT INTO `user_amount_log` VALUES ('620', '2', '87', '周大福(竹屿路泰禾分店)', '用户线下消费0.08元', '0.08', '13.03', '13.11', '1', '2017-08-13 18:47:54', '2017-08-13 18:47:54');
INSERT INTO `user_amount_log` VALUES ('621', '1', '176', '我是昵称', '订单[2017051223018][支付宝消费]0.1元', '0.10', '0.00', '0.00', '5', '2017-08-13 18:47:55', '2017-08-13 18:47:55');

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `legal_person` varchar(10) DEFAULT NULL COMMENT '法人',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `discount` float DEFAULT '0' COMMENT '折扣',
  `province` varchar(12) DEFAULT NULL COMMENT '省份',
  `city` varchar(12) DEFAULT NULL COMMENT '城市',
  `balance` decimal(16,2) DEFAULT '0.00' COMMENT '余额',
  `consumption_amount` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '累计消费',
  `integral` decimal(16,3) DEFAULT '0.000' COMMENT '积分/宝分',
  `treasure_num` int(5) NOT NULL DEFAULT '0' COMMENT '当前包袋个数',
  `has_treasure_num` int(5) NOT NULL DEFAULT '0' COMMENT '已赠送宝袋数量',
  `bonus_integral` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '总奖励宝分（只适用消费）',
  `bestir_integral` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '已激励宝分',
  `un_bestir_integral` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '未激励宝分',
  `cash_integral` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '可兑现宝分',
  `un_cash_integral` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '不可兑现',
  `company_name` varchar(25) NOT NULL COMMENT '企业名称',
  `access_key` varchar(25) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES ('1', '1', null, null, '0', null, null, '0.00', '0.00', '0.000', '0', '0', '0.000', '0.000', '0.000', '0.000', '0.000', '', null, null, null);
INSERT INTO `user_info` VALUES ('3', '3', null, null, null, null, null, '0.00', '0.00', '0.000', '0', '0', '0.000', '0.000', '0.000', '0.000', '0.000', '', 'F4482715-25BD-DC11-873A', '2017-01-12 13:35:18', '2017-01-12 13:35:18');
INSERT INTO `user_info` VALUES ('112', '130', null, null, '0', '福建', '厦门', '0.00', '0.00', '0.000', '0', '0', '0.000', '0.000', '0.000', '0.000', '0.000', '', '1c694c95', '2017-04-10 20:31:02', '2017-04-10 20:31:02');
INSERT INTO `user_info` VALUES ('119', '0', null, null, '0', null, null, '10.00', '0.00', '0.000', '3', '0', '0.000', '0.000', '0.000', '0.000', '0.000', '', null, '2017-04-19 14:16:59', '2017-04-19 14:16:59');
INSERT INTO `user_info` VALUES ('130', '150', null, null, '0', null, null, '0.00', '0.12', '0.000', '0', '0', '0.120', '0.000', '0.120', '0.000', '0.000', '', null, '2017-05-05 11:29:57', '2017-05-09 10:10:29');
INSERT INTO `user_info` VALUES ('143', '163', null, null, '0', null, null, '0.00', '0.00', '0.000', '0', '0', '0.000', '0.000', '0.000', '0.000', '0.000', '', null, '2017-05-10 16:20:17', '2017-05-10 16:20:17');
INSERT INTO `user_info` VALUES ('144', '164', null, null, '0', null, null, '0.00', '0.00', '0.000', '0', '0', '0.000', '0.000', '0.000', '0.000', '0.000', '', null, '2017-05-10 17:58:08', '2017-05-10 17:58:08');
INSERT INTO `user_info` VALUES ('176', '196', null, null, '0', null, null, '0.00', '0.00', '0.000', '0', '0', '0.000', '0.000', '0.000', '0.000', '0.000', '', null, '2018-09-30 22:47:23', '2018-09-30 22:47:23');

-- ----------------------------
-- Table structure for user_integexchange_log
-- ----------------------------
DROP TABLE IF EXISTS `user_integexchange_log`;
CREATE TABLE `user_integexchange_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1用户2商家',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `user_nickname` varchar(20) DEFAULT '' COMMENT '用户昵称',
  `remarks` varchar(150) DEFAULT '' COMMENT '用户备注',
  `verify_remarks` varchar(150) DEFAULT '' COMMENT '审核备注',
  `amount` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '兑换积分',
  `price` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '当前比例的金额',
  `paid_in_amount` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '实际到账金额',
  `status` tinyint(1) DEFAULT '3' COMMENT '状态1审核通过，2审核不通过，3待审核',
  `access_key` varchar(25) DEFAULT NULL COMMENT '所属key',
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `access_key` (`access_key`),
  KEY `user_nickname` (`user_nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COMMENT='积分兑现记录表';

-- ----------------------------
-- Records of user_integexchange_log
-- ----------------------------
INSERT INTO `user_integexchange_log` VALUES ('45', '2', '1', '陈年', '宝分兑现', '', '30.00', '30.00', '25.00', '2', '1C694C95', '2017-04-06 15:40:32', '2017-04-18 16:54:03');
INSERT INTO `user_integexchange_log` VALUES ('46', '1', '138', '15359225953', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-04-25 18:18:22', '2017-04-25 18:18:22');
INSERT INTO `user_integexchange_log` VALUES ('47', '1', '138', '15359225953', '[兑换1000宝分]', '', '1000.00', '1000.00', '995.00', '3', null, '2017-04-25 18:24:25', '2017-04-25 18:24:25');
INSERT INTO `user_integexchange_log` VALUES ('48', '1', '138', '15359225953', '[兑换200宝分]', '', '200.00', '200.00', '195.00', '3', null, '2017-04-25 18:28:40', '2017-04-25 18:28:40');
INSERT INTO `user_integexchange_log` VALUES ('49', '1', '138', '15359225953', '[兑换200宝分]', '', '200.00', '200.00', '195.00', '3', null, '2017-04-25 18:29:55', '2017-04-25 18:29:55');
INSERT INTO `user_integexchange_log` VALUES ('50', '1', '138', '15359225953', '[兑换200宝分]', '', '200.00', '200.00', '195.00', '3', null, '2017-04-25 18:31:49', '2017-04-25 18:31:49');
INSERT INTO `user_integexchange_log` VALUES ('51', '1', '138', '15359225953', '[兑换200宝分]', '', '200.00', '200.00', '195.00', '3', null, '2017-04-25 18:34:37', '2017-04-25 18:34:37');
INSERT INTO `user_integexchange_log` VALUES ('52', '1', '138', '15359225953', '[兑换100宝分]', '1111', '100.00', '100.00', '95.00', '2', null, '2017-04-25 18:40:54', '2017-04-25 20:24:02');
INSERT INTO `user_integexchange_log` VALUES ('53', '2', '28', '缓存测试添加', '[兑换100宝分]', 'butyongguo', '100.00', '100.00', '95.00', '2', null, '2017-04-25 20:15:25', '2017-04-25 20:23:22');
INSERT INTO `user_integexchange_log` VALUES ('54', '1', '139', 'Have', '[兑换666宝分]', '', '666.00', '666.00', '661.00', '3', null, '2017-04-28 18:15:26', '2017-04-28 18:15:26');
INSERT INTO `user_integexchange_log` VALUES ('55', '1', '139', 'Have', '[兑换333宝分]', '', '333.00', '333.00', '328.00', '3', null, '2017-04-28 18:18:52', '2017-04-28 18:18:52');
INSERT INTO `user_integexchange_log` VALUES ('56', '1', '139', 'Have', '[兑换555宝分]', '', '555.00', '555.00', '550.00', '3', null, '2017-04-28 18:20:03', '2017-04-28 18:20:03');
INSERT INTO `user_integexchange_log` VALUES ('57', '1', '139', 'Have', '[兑换222宝分]', '', '222.00', '222.00', '217.00', '3', null, '2017-04-28 18:23:01', '2017-04-28 18:23:01');
INSERT INTO `user_integexchange_log` VALUES ('58', '1', '139', 'Have', '[兑换111宝分]', '', '111.00', '111.00', '106.00', '3', null, '2017-04-30 14:04:29', '2017-04-30 14:04:29');
INSERT INTO `user_integexchange_log` VALUES ('59', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-04-30 14:44:55', '2017-04-30 14:44:55');
INSERT INTO `user_integexchange_log` VALUES ('60', '1', '139', 'Have', '[兑换1111宝分]', '', '1111.00', '1111.00', '1106.00', '3', null, '2017-04-30 14:49:16', '2017-04-30 14:49:16');
INSERT INTO `user_integexchange_log` VALUES ('61', '1', '139', 'Have', '[兑换102宝分]', '', '102.00', '102.00', '97.00', '3', null, '2017-04-30 15:20:55', '2017-04-30 15:20:55');
INSERT INTO `user_integexchange_log` VALUES ('62', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-04-30 15:24:44', '2017-04-30 15:24:44');
INSERT INTO `user_integexchange_log` VALUES ('63', '1', '139', 'Have', '[兑换103宝分]', '', '103.00', '103.00', '98.00', '3', null, '2017-04-30 15:28:00', '2017-04-30 15:28:00');
INSERT INTO `user_integexchange_log` VALUES ('64', '1', '139', 'Have', '[兑换107宝分]', '', '107.00', '107.00', '102.00', '3', null, '2017-04-30 15:28:42', '2017-04-30 15:28:42');
INSERT INTO `user_integexchange_log` VALUES ('65', '1', '139', 'Have', '[兑换123宝分]', '', '123.00', '123.00', '118.00', '3', null, '2017-04-30 15:33:46', '2017-04-30 15:33:46');
INSERT INTO `user_integexchange_log` VALUES ('66', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-04-30 15:56:42', '2017-04-30 15:56:42');
INSERT INTO `user_integexchange_log` VALUES ('67', '1', '139', 'Have', '[兑换111宝分]', '', '111.00', '111.00', '106.00', '3', null, '2017-04-30 16:08:38', '2017-04-30 16:08:38');
INSERT INTO `user_integexchange_log` VALUES ('68', '1', '139', 'Have', '[兑换105宝分]', '', '105.00', '105.00', '100.00', '3', null, '2017-04-30 16:10:25', '2017-04-30 16:10:25');
INSERT INTO `user_integexchange_log` VALUES ('69', '1', '139', 'Have', '[兑换110宝分]', '', '110.00', '110.00', '105.00', '3', null, '2017-04-30 16:54:31', '2017-04-30 16:54:31');
INSERT INTO `user_integexchange_log` VALUES ('70', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-04-30 17:08:32', '2017-04-30 17:08:32');
INSERT INTO `user_integexchange_log` VALUES ('71', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-04-30 17:12:18', '2017-04-30 17:12:18');
INSERT INTO `user_integexchange_log` VALUES ('72', '1', '139', 'Have', '[兑换113宝分]', '', '113.00', '113.00', '108.00', '3', null, '2017-05-02 10:38:03', '2017-05-02 10:38:03');
INSERT INTO `user_integexchange_log` VALUES ('73', '1', '139', 'Have', '[兑换118.8宝分]', '', '118.80', '118.80', '113.80', '3', null, '2017-05-02 10:41:53', '2017-05-02 10:41:53');
INSERT INTO `user_integexchange_log` VALUES ('74', '1', '139', 'Have', '[兑换111宝分]', '', '111.00', '111.00', '106.00', '3', null, '2017-05-02 10:47:55', '2017-05-02 10:47:55');
INSERT INTO `user_integexchange_log` VALUES ('75', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 12:00:29', '2017-05-03 12:00:29');
INSERT INTO `user_integexchange_log` VALUES ('76', '1', '139', 'Have', '[兑换121宝分]', '', '121.00', '121.00', '116.00', '3', null, '2017-05-03 12:01:50', '2017-05-03 12:01:50');
INSERT INTO `user_integexchange_log` VALUES ('77', '1', '139', 'Have', '[兑换123宝分]', '', '123.00', '123.00', '118.00', '3', null, '2017-05-03 13:56:29', '2017-05-03 13:56:29');
INSERT INTO `user_integexchange_log` VALUES ('78', '2', '31', '店铺2', '[兑换2220宝分]', '', '2220.00', '2220.00', '2215.00', '3', null, '2017-05-03 14:18:27', '2017-05-03 14:18:27');
INSERT INTO `user_integexchange_log` VALUES ('79', '2', '31', '店铺2', '[兑换111宝分]', '', '111.00', '111.00', '106.00', '3', null, '2017-05-03 14:25:59', '2017-05-03 14:25:59');
INSERT INTO `user_integexchange_log` VALUES ('80', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 14:29:00', '2017-05-03 14:29:00');
INSERT INTO `user_integexchange_log` VALUES ('81', '2', '31', '店铺2', '[兑换122宝分]', '', '122.00', '122.00', '117.00', '3', null, '2017-05-03 14:29:32', '2017-05-03 14:29:32');
INSERT INTO `user_integexchange_log` VALUES ('82', '2', '31', '店铺2', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 14:34:21', '2017-05-03 14:34:21');
INSERT INTO `user_integexchange_log` VALUES ('83', '1', '139', 'Have', '[兑换123宝分]', '', '123.00', '123.00', '118.00', '3', null, '2017-05-03 15:12:47', '2017-05-03 15:12:47');
INSERT INTO `user_integexchange_log` VALUES ('84', '1', '139', 'Have', '[兑换111宝分]', '', '111.00', '111.00', '106.00', '3', null, '2017-05-03 15:13:02', '2017-05-03 15:13:02');
INSERT INTO `user_integexchange_log` VALUES ('85', '1', '139', 'Have', '[兑换101宝分]', '', '101.00', '101.00', '96.00', '3', null, '2017-05-03 15:16:49', '2017-05-03 15:16:49');
INSERT INTO `user_integexchange_log` VALUES ('86', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 15:21:09', '2017-05-03 15:21:09');
INSERT INTO `user_integexchange_log` VALUES ('87', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 15:21:29', '2017-05-03 15:21:29');
INSERT INTO `user_integexchange_log` VALUES ('88', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 15:26:06', '2017-05-03 15:26:06');
INSERT INTO `user_integexchange_log` VALUES ('89', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 15:41:23', '2017-05-03 15:41:23');
INSERT INTO `user_integexchange_log` VALUES ('90', '1', '139', 'Have', '[兑换100.2000宝分]', '', '100.20', '100.20', '95.20', '3', null, '2017-05-03 15:54:26', '2017-05-03 15:54:26');
INSERT INTO `user_integexchange_log` VALUES ('91', '1', '139', 'Have', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 15:59:05', '2017-05-03 15:59:05');
INSERT INTO `user_integexchange_log` VALUES ('92', '2', '31', '店铺2', '[兑换123宝分]', '', '123.00', '123.00', '118.00', '3', null, '2017-05-03 16:58:47', '2017-05-03 16:58:47');
INSERT INTO `user_integexchange_log` VALUES ('93', '2', '31', '店铺2', '[兑换190宝分]', '', '190.00', '190.00', '185.00', '3', null, '2017-05-03 17:04:16', '2017-05-03 17:04:16');
INSERT INTO `user_integexchange_log` VALUES ('94', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 17:44:50', '2017-05-03 17:44:50');
INSERT INTO `user_integexchange_log` VALUES ('95', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:02:57', '2017-05-03 18:02:57');
INSERT INTO `user_integexchange_log` VALUES ('96', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:04:36', '2017-05-03 18:04:36');
INSERT INTO `user_integexchange_log` VALUES ('97', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:07:12', '2017-05-03 18:07:12');
INSERT INTO `user_integexchange_log` VALUES ('98', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:07:47', '2017-05-03 18:07:47');
INSERT INTO `user_integexchange_log` VALUES ('99', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:08:24', '2017-05-03 18:08:24');
INSERT INTO `user_integexchange_log` VALUES ('100', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:09:01', '2017-05-03 18:09:01');
INSERT INTO `user_integexchange_log` VALUES ('101', '2', '31', '店铺2', '[兑换111宝分]', '', '111.00', '111.00', '106.00', '3', null, '2017-05-03 18:17:58', '2017-05-03 18:17:58');
INSERT INTO `user_integexchange_log` VALUES ('102', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:18:59', '2017-05-03 18:18:59');
INSERT INTO `user_integexchange_log` VALUES ('103', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:21:06', '2017-05-03 18:21:06');
INSERT INTO `user_integexchange_log` VALUES ('104', '2', '19', '后台添加商家测试', '[兑换200宝分]', '', '200.00', '200.00', '195.00', '3', null, '2017-05-03 18:21:44', '2017-05-03 18:21:44');
INSERT INTO `user_integexchange_log` VALUES ('105', '1', '134', '测试修改', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:50:57', '2017-05-03 18:50:57');
INSERT INTO `user_integexchange_log` VALUES ('106', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-03 18:51:12', '2017-05-03 18:51:12');
INSERT INTO `user_integexchange_log` VALUES ('107', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-04 12:05:30', '2017-05-04 12:05:30');
INSERT INTO `user_integexchange_log` VALUES ('108', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-04 12:06:09', '2017-05-04 12:06:09');
INSERT INTO `user_integexchange_log` VALUES ('109', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-04 12:06:28', '2017-05-04 12:06:28');
INSERT INTO `user_integexchange_log` VALUES ('110', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '2', null, '2017-05-04 12:06:46', '2017-05-04 14:30:02');
INSERT INTO `user_integexchange_log` VALUES ('111', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-04 17:48:43', '2017-05-04 17:48:43');
INSERT INTO `user_integexchange_log` VALUES ('112', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-05 09:27:07', '2017-05-05 09:27:07');
INSERT INTO `user_integexchange_log` VALUES ('113', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-05 09:35:45', '2017-05-05 09:35:45');
INSERT INTO `user_integexchange_log` VALUES ('114', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-05 09:37:52', '2017-05-05 09:37:52');
INSERT INTO `user_integexchange_log` VALUES ('115', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-05 09:47:05', '2017-05-05 09:47:05');
INSERT INTO `user_integexchange_log` VALUES ('116', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-05 09:48:29', '2017-05-05 09:48:29');
INSERT INTO `user_integexchange_log` VALUES ('117', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-05 10:15:08', '2017-05-05 10:15:08');
INSERT INTO `user_integexchange_log` VALUES ('118', '2', '19', '后台添加商家测试', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-05 10:16:42', '2017-05-05 10:16:42');
INSERT INTO `user_integexchange_log` VALUES ('119', '2', '31', '店铺2', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '3', null, '2017-05-05 11:06:19', '2017-05-05 11:06:19');
INSERT INTO `user_integexchange_log` VALUES ('120', '2', '87', '钱钱钱钱钱', '[兑换100宝分]', '', '100.00', '100.00', '95.00', '1', null, '2017-05-12 18:25:22', '2017-05-15 10:21:10');
INSERT INTO `user_integexchange_log` VALUES ('121', '1', '186', '13106254510', '[兑换-200宝分]', '', '-200.00', '-200.00', '-205.00', '3', null, '2017-06-22 15:08:52', '2017-06-22 15:08:52');
INSERT INTO `user_integexchange_log` VALUES ('122', '1', '186', '13106254510', '[兑换200宝分]', '', '200.00', '200.00', '195.00', '3', null, '2017-06-22 15:09:29', '2017-06-22 15:09:29');

-- ----------------------------
-- Table structure for user_integral_log
-- ----------------------------
DROP TABLE IF EXISTS `user_integral_log`;
CREATE TABLE `user_integral_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1用户2商家',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `user_nickname` varchar(20) NOT NULL COMMENT '用户昵称',
  `from_store_id` int(13) NOT NULL DEFAULT '0' COMMENT '抽成来源商家',
  `remarks` varchar(255) DEFAULT NULL COMMENT '备注',
  `operation_amount` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '本次操作积分',
  `original_balance` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '原本积分',
  `current_blaance` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '操作后积分',
  `current_yjl` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '操作后已激励宝分',
  `current_djl` decimal(16,3) NOT NULL DEFAULT '0.000' COMMENT '操作后待激励宝分',
  `current_kdh` decimal(16,3) NOT NULL,
  `current_bkdh` decimal(16,3) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '操作类型：1消费增加2兑换消费3平台修改6推荐提成',
  `mengyou` int(13) NOT NULL DEFAULT '0' COMMENT '盟友id',
  `access_key` varchar(25) DEFAULT NULL COMMENT '所属key',
  `created_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_nickname` (`user_nickname`),
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=1215 DEFAULT CHARSET=utf8 COMMENT='用户积分日志';

-- ----------------------------
-- Records of user_integral_log
-- ----------------------------
INSERT INTO `user_integral_log` VALUES ('359', '1', '132', '17759413574', '0', '[宝分提现审核]审核失败，返还宝分：30.00', '30.000', '11.000', '41.000', '0.000', '0.000', '0.000', '0.000', '4', '0', null, '2017-04-18 15:27:04', '2017-04-18 15:27:04');
INSERT INTO `user_integral_log` VALUES ('368', '1', '132', '17759413574', '0', '[宝分消费]，待激励宝分：1000', '1000.000', '130.000', '130.000', '0.000', '2000.000', '100.000', '30.000', '1', '0', null, '2017-04-18 17:04:12', '2017-04-18 17:04:12');
INSERT INTO `user_integral_log` VALUES ('369', '1', '132', '17759413574', '0', '[宝分消费]，待激励宝分：1000', '100.000', '130.000', '30.000', '0.000', '2000.000', '0.000', '30.000', '2', '0', null, '2017-04-18 17:06:36', '2017-04-18 17:06:36');
INSERT INTO `user_integral_log` VALUES ('370', '1', '132', '17759413574', '0', '[宝分签到]', '0.250', '30.000', '30.250', '0.250', '1999.750', '0.180', '30.080', '7', '0', null, '2017-04-18 17:15:19', '2017-04-18 17:15:19');
INSERT INTO `user_integral_log` VALUES ('371', '1', '132', '17759413574', '0', '[宝分签到]', '0.250', '30.250', '30.500', '0.500', '1999.500', '0.360', '30.160', '7', '0', null, '2017-04-18 17:15:50', '2017-04-18 17:15:50');
INSERT INTO `user_integral_log` VALUES ('372', '1', '132', '17759413574', '0', '[宝分签到]', '0.250', '30.250', '30.500', '0.500', '1999.500', '0.360', '30.160', '7', '0', null, '2017-04-18 17:16:04', '2017-04-18 17:16:04');
INSERT INTO `user_integral_log` VALUES ('373', '1', '132', '17759413574', '0', '[宝分签到]', '0.250', '30.500', '30.750', '0.750', '1999.250', '0.540', '30.240', '7', '0', null, '2017-04-18 17:16:12', '2017-04-18 17:16:12');
INSERT INTO `user_integral_log` VALUES ('374', '1', '132', '17759413574', '0', '[宝分签到]', '0.250', '30.750', '31.000', '1.000', '1999.000', '0.180', '0.080', '7', '0', null, '2017-04-18 17:17:58', '2017-04-18 17:17:58');
INSERT INTO `user_integral_log` VALUES ('375', '1', '132', '17759413574', '0', '[宝分签到]', '0.250', '31.000', '31.000', '1.000', '1998.750', '0.180', '0.080', '8', '0', null, '2017-04-18 17:34:27', '2017-04-18 17:34:27');
INSERT INTO `user_integral_log` VALUES ('376', '1', '132', '17759413574', '0', '[宝分签到]', '0.250', '31.000', '31.000', '1.000', '0.000', '0.180', '0.080', '8', '0', null, '2017-04-18 17:40:23', '2017-04-18 17:40:23');
INSERT INTO `user_integral_log` VALUES ('377', '1', '132', '17759413574', '0', '[宝分签到]', '0.200', '31.000', '31.200', '1.200', '0.000', '0.320', '0.140', '6', '0', null, '2017-04-18 17:44:51', '2017-04-18 17:44:51');
INSERT INTO `user_integral_log` VALUES ('378', '2', '1', '测试商家', '0', '[宝分签到]', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '6', '0', null, null, null);
INSERT INTO `user_integral_log` VALUES ('379', '1', '132', '被推荐者', '0', null, '100.000', '130.000', '30.000', '0.000', '2000.000', '0.000', '30.000', '6', '3', null, null, null);
INSERT INTO `user_integral_log` VALUES ('380', '1', '135', '直接盟友1', '0', null, '0.250', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '6', '0', null, null, null);
INSERT INTO `user_integral_log` VALUES ('381', '1', '135', '直接盟友1', '0', null, '1.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1', '0', null, null, null);
INSERT INTO `user_integral_log` VALUES ('382', '1', '136', '间接盟友', '0', null, '0.250', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '1', '0', null, null, null);
INSERT INTO `user_integral_log` VALUES ('383', '2', '140', 'sadsad', '0', null, '50.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '6', '0', null, null, null);
INSERT INTO `user_integral_log` VALUES ('384', '2', '140', 'adssa ', '0', null, '50.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '6', '0', null, null, null);
INSERT INTO `user_integral_log` VALUES ('386', '2', '132', '直接盟友', '0', '商家签到获得宝分', '55.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '6', '0', null, '2017-04-18 17:44:51', null);
INSERT INTO `user_integral_log` VALUES ('400', '1', '139', '15259205640', '0', '签到获得宝分', '1.500', '8.000', '9.500', '404.000', '596.000', '6.650', '2.850', '7', '0', null, '2017-04-25 16:16:40', '2017-04-25 16:16:40');
INSERT INTO `user_integral_log` VALUES ('401', '2', '28', '缓存测试添加', '0', '商家签到获得宝分', '2.500', '209.000', '211.500', '201.500', '2.500', '0.000', '0.000', '10', '0', null, '2017-04-25 16:16:41', '2017-04-25 16:16:41');
INSERT INTO `user_integral_log` VALUES ('402', '1', '136', '被推荐用户测试', '0', '漏签减少宝分', '1.500', '0.000', '0.000', '100.000', '398.500', '0.000', '0.000', '8', '0', null, '2017-04-25 16:42:22', '2017-04-25 16:42:22');
INSERT INTO `user_integral_log` VALUES ('403', '1', '138', '15359225953', '0', '漏签减少宝分', '1.500', '0.000', '0.000', '100.000', '398.500', '0.000', '0.000', '8', '0', null, '2017-04-25 16:42:23', '2017-04-25 16:42:23');
INSERT INTO `user_integral_log` VALUES ('404', '1', '138', '15359225953', '0', '[宝分兑换]', '100.000', '1500.000', '1400.000', '100.000', '398.500', '900.000', '500.000', '2', '0', null, '2017-04-25 18:18:21', '2017-04-25 18:18:21');
INSERT INTO `user_integral_log` VALUES ('405', '1', '138', '15359225953', '0', '[宝分兑换]', '1000.000', '1400.000', '400.000', '100.000', '398.500', '0.000', '500.000', '2', '0', null, '2017-04-25 18:24:25', '2017-04-25 18:24:25');
INSERT INTO `user_integral_log` VALUES ('406', '1', '138', '15359225953', '0', '[宝分兑换]', '200.000', '500.000', '300.000', '100.000', '398.500', '0.000', '400.000', '2', '0', null, '2017-04-25 18:28:39', '2017-04-25 18:28:39');
INSERT INTO `user_integral_log` VALUES ('407', '1', '138', '15359225953', '0', '[宝分兑换]', '200.000', '300.000', '100.000', '100.000', '398.500', '0.000', '100.000', '2', '0', null, '2017-04-25 18:29:55', '2017-04-25 18:29:55');
INSERT INTO `user_integral_log` VALUES ('408', '1', '138', '15359225953', '0', '[宝分兑换]', '200.000', '300.000', '100.000', '100.000', '398.500', '0.000', '100.000', '2', '0', null, '2017-04-25 18:31:49', '2017-04-25 18:31:49');
INSERT INTO `user_integral_log` VALUES ('409', '1', '138', '15359225953', '0', '[宝分兑换]', '200.000', '300.000', '100.000', '100.000', '398.500', '0.000', '100.000', '2', '0', null, '2017-04-25 18:34:36', '2017-04-25 18:34:36');
INSERT INTO `user_integral_log` VALUES ('410', '1', '138', '15359225953', '0', '[宝分兑换]', '100.000', '100.000', '0.000', '100.000', '398.500', '0.000', '0.000', '2', '0', null, '2017-04-25 18:40:54', '2017-04-25 18:40:54');
INSERT INTO `user_integral_log` VALUES ('413', '2', '1', '测试店铺1', '0', '商家漏签减少宝分', '2.000', '0.000', '0.000', '200.000', '798.000', '0.000', '0.000', '11', '0', null, '2017-04-25 19:44:13', '2017-04-25 19:44:13');
INSERT INTO `user_integral_log` VALUES ('414', '2', '18', '我要开店3', '0', '商家漏签减少宝分', '2.000', '0.000', '0.000', '200.000', '798.000', '0.000', '0.000', '11', '0', null, '2017-04-25 19:44:13', '2017-04-25 19:44:13');
INSERT INTO `user_integral_log` VALUES ('415', '2', '19', '后台添加商家测试', '0', '商家漏签减少宝分', '2.000', '0.000', '0.000', '200.000', '798.000', '0.000', '0.000', '11', '0', null, '2017-04-25 19:44:13', '2017-04-25 19:44:13');
INSERT INTO `user_integral_log` VALUES ('417', '1', '136', '被推荐用户测试', '0', '漏签减少宝分', '1.000', '0.000', '0.000', '100.000', '397.500', '0.000', '0.000', '8', '0', null, '2017-04-25 19:46:27', '2017-04-25 19:46:27');
INSERT INTO `user_integral_log` VALUES ('418', '1', '138', '15359225953', '0', '漏签减少宝分', '1.000', '0.000', '0.000', '100.000', '397.500', '0.000', '0.000', '8', '0', null, '2017-04-25 19:46:27', '2017-04-25 19:46:27');
INSERT INTO `user_integral_log` VALUES ('419', '2', '28', '缓存测试添加', '0', '[宝分兑换]', '100.000', '211.500', '111.500', '201.500', '2.500', '0.000', '0.000', '12', '0', null, '2017-04-25 20:15:25', '2017-04-25 20:15:25');
INSERT INTO `user_integral_log` VALUES ('420', '2', '28', '缓存测试添加', '0', '[宝分提现审核]审核失败，返还宝分：100.00', '100.000', '111.500', '211.500', '201.500', '2.500', '0.000', '0.000', '14', '0', null, '2017-04-25 20:23:22', '2017-04-25 20:23:22');
INSERT INTO `user_integral_log` VALUES ('421', '1', '138', '15359225953', '0', '[宝分提现审核]审核失败，返还宝分：100.00', '100.000', '0.000', '100.000', '100.000', '397.500', '100.000', '0.000', '4', '0', null, '2017-04-25 20:24:02', '2017-04-25 20:24:02');
INSERT INTO `user_integral_log` VALUES ('505', '1', '28', '缓存测试添加', '0', '广告费激励宝分', '5.000', '0.000', '0.000', '0.000', '205.000', '0.000', '0.000', '9', '0', null, '2017-04-26 17:50:27', '2017-04-26 17:50:27');
INSERT INTO `user_integral_log` VALUES ('506', '1', '147', '18850221115', '0', '消费50激励宝分', '50.000', '25.000', '25.000', '0.000', '750.000', '25.000', '0.000', '1', '0', null, '2017-04-26 17:50:30', '2017-04-26 17:50:30');
INSERT INTO `user_integral_log` VALUES ('507', '1', '146', '18850221114', '0', '[推荐盟友],激励5宝分', '5.000', '35.000', '40.000', '0.000', '0.000', '28.000', '12.000', '6', '147', null, '2017-04-26 17:50:31', '2017-04-26 17:50:31');
INSERT INTO `user_integral_log` VALUES ('508', '1', '142', '18850221111', '0', '[推荐盟友],激励4宝分', '4.000', '28.000', '32.000', '0.000', '0.000', '22.400', '9.600', '6', '147', null, '2017-04-26 17:50:32', '2017-04-26 17:50:32');
INSERT INTO `user_integral_log` VALUES ('509', '1', '28', '缓存测试添加', '0', '广告费激励宝分', '5.000', '0.000', '0.000', '0.000', '5.000', '0.000', '0.000', '9', '0', null, '2017-04-26 17:53:25', '2017-04-26 17:53:25');
INSERT INTO `user_integral_log` VALUES ('510', '1', '147', '18850221115', '0', '消费50激励宝分', '50.000', '25.000', '25.000', '0.000', '800.000', '25.000', '0.000', '1', '0', null, '2017-04-26 17:53:27', '2017-04-26 17:53:27');
INSERT INTO `user_integral_log` VALUES ('511', '1', '146', '18850221114', '0', '[推荐盟友],激励5宝分', '5.000', '40.000', '45.000', '0.000', '0.000', '31.500', '13.500', '6', '147', null, '2017-04-26 17:53:29', '2017-04-26 17:53:29');
INSERT INTO `user_integral_log` VALUES ('512', '1', '142', '18850221111', '0', '[推荐盟友],激励4宝分', '4.000', '32.000', '36.000', '0.000', '0.000', '25.200', '10.800', '6', '147', null, '2017-04-26 17:53:29', '2017-04-26 17:53:29');
INSERT INTO `user_integral_log` VALUES ('513', '1', '28', '缓存测试添加', '0', '广告费激励宝分', '5.000', '0.000', '0.000', '0.000', '5.000', '0.000', '0.000', '9', '0', null, '2017-04-26 17:54:49', '2017-04-26 17:54:49');
INSERT INTO `user_integral_log` VALUES ('514', '1', '147', '18850221115', '0', '消费50激励宝分', '50.000', '25.000', '25.000', '0.000', '850.000', '25.000', '0.000', '1', '0', null, '2017-04-26 17:54:52', '2017-04-26 17:54:52');
INSERT INTO `user_integral_log` VALUES ('515', '1', '146', '18850221114', '0', '[推荐盟友],激励5宝分', '5.000', '45.000', '50.000', '0.000', '0.000', '35.000', '15.000', '6', '147', null, '2017-04-26 17:54:52', '2017-04-26 17:54:52');
INSERT INTO `user_integral_log` VALUES ('516', '1', '142', '18850221111', '0', '[推荐盟友],激励4宝分', '4.000', '36.000', '40.000', '0.000', '0.000', '28.000', '12.000', '6', '147', null, '2017-04-26 17:54:54', '2017-04-26 17:54:54');
INSERT INTO `user_integral_log` VALUES ('518', '1', '28', '缓存测试添加', '0', '广告费激励宝分', '5.000', '0.000', '0.000', '0.000', '10.000', '0.000', '0.000', '9', '0', null, '2017-04-26 18:12:15', '2017-04-26 18:12:15');
INSERT INTO `user_integral_log` VALUES ('519', '1', '132', 'sadsada', '0', '抽成', '10.000', '31.200', '41.200', '1.200', '0.000', '10.315', '0.135', '13', '0', null, '2017-04-26 18:12:16', '2017-04-26 18:12:16');
INSERT INTO `user_integral_log` VALUES ('520', '1', '147', '18850221115', '0', '消费50激励宝分', '50.000', '25.000', '25.000', '0.000', '900.000', '25.000', '0.000', '1', '0', null, '2017-04-26 18:12:16', '2017-04-26 18:12:16');
INSERT INTO `user_integral_log` VALUES ('521', '1', '146', '18850221114', '0', '[推荐盟友],激励5宝分', '5.000', '50.000', '55.000', '0.000', '0.000', '38.500', '16.500', '6', '147', null, '2017-04-26 18:12:17', '2017-04-26 18:12:17');
INSERT INTO `user_integral_log` VALUES ('522', '1', '142', '18850221111', '0', '[推荐盟友],激励4宝分', '4.000', '40.000', '44.000', '0.000', '0.000', '30.800', '13.200', '6', '147', null, '2017-04-26 18:12:17', '2017-04-26 18:12:17');
INSERT INTO `user_integral_log` VALUES ('523', '1', '147', '18850221115', '0', '消费100激励宝分', '100.000', '0.000', '0.000', '0.000', '100.000', '0.000', '0.000', '1', '0', null, '2017-04-26 20:02:34', '2017-04-26 20:02:34');
INSERT INTO `user_integral_log` VALUES ('524', '1', '146', '18850221114', '0', '[推荐盟友],激励10宝分', '10.000', '0.000', '10.000', '0.000', '0.000', '7.000', '3.000', '6', '147', null, '2017-04-26 20:02:34', '2017-04-26 20:02:34');
INSERT INTO `user_integral_log` VALUES ('525', '1', '142', '18850221111', '0', '[推荐盟友],激励8宝分', '8.000', '0.000', '8.000', '0.000', '0.000', '5.600', '2.400', '6', '147', null, '2017-04-26 20:02:35', '2017-04-26 20:02:35');
INSERT INTO `user_integral_log` VALUES ('526', '1', '147', '18850221115', '0', '消费50宝分', '50.000', '75.000', '25.000', '0.000', '100.000', '25.000', '0.000', '5', '0', null, '2017-04-26 20:09:16', '2017-04-26 20:09:16');
INSERT INTO `user_integral_log` VALUES ('527', '1', '147', '18850221115', '0', '消费50激励宝分', '50.000', '25.000', '25.000', '0.000', '150.000', '25.000', '0.000', '1', '0', null, '2017-04-26 20:09:16', '2017-04-26 20:09:16');
INSERT INTO `user_integral_log` VALUES ('528', '1', '146', '18850221114', '0', '[推荐盟友],激励5宝分', '5.000', '10.000', '15.000', '0.000', '0.000', '10.500', '4.500', '6', '147', null, '2017-04-26 20:09:17', '2017-04-26 20:09:17');
INSERT INTO `user_integral_log` VALUES ('529', '1', '142', '18850221111', '0', '[推荐盟友],激励4宝分', '4.000', '8.000', '12.000', '0.000', '0.000', '8.400', '3.600', '6', '147', null, '2017-04-26 20:09:17', '2017-04-26 20:09:17');
INSERT INTO `user_integral_log` VALUES ('530', '1', '147', '18850221115', '0', '消费100激励宝分', '100.000', '25.000', '25.000', '0.000', '250.000', '25.000', '0.000', '1', '0', null, '2017-04-26 20:12:09', '2017-04-26 20:12:09');
INSERT INTO `user_integral_log` VALUES ('531', '1', '146', '18850221114', '0', '[推荐盟友],激励10宝分', '10.000', '15.000', '25.000', '0.000', '0.000', '17.500', '7.500', '6', '147', null, '2017-04-26 20:12:09', '2017-04-26 20:12:09');
INSERT INTO `user_integral_log` VALUES ('532', '1', '142', '18850221111', '0', '[推荐盟友],激励8宝分', '8.000', '12.000', '20.000', '0.000', '0.000', '14.000', '6.000', '6', '147', null, '2017-04-26 20:12:09', '2017-04-26 20:12:09');
INSERT INTO `user_integral_log` VALUES ('533', '1', '28', '缓存测试添加', '0', '广告费激励宝分', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '9', '0', null, '2017-04-26 20:13:06', '2017-04-26 20:13:06');
INSERT INTO `user_integral_log` VALUES ('534', '1', '147', '18850221115', '0', '消费0.00激励宝分', '0.000', '25.000', '25.000', '0.000', '250.000', '25.000', '0.000', '1', '0', null, '2017-04-26 20:13:07', '2017-04-26 20:13:07');
INSERT INTO `user_integral_log` VALUES ('535', '1', '146', '18850221114', '0', '[推荐盟友],激励0宝分', '0.000', '25.000', '25.000', '0.000', '0.000', '17.500', '7.500', '6', '147', null, '2017-04-26 20:13:07', '2017-04-26 20:13:07');
INSERT INTO `user_integral_log` VALUES ('536', '1', '142', '18850221111', '0', '[推荐盟友],激励0宝分', '0.000', '20.000', '20.000', '0.000', '0.000', '14.000', '6.000', '6', '147', null, '2017-04-26 20:13:07', '2017-04-26 20:13:07');
INSERT INTO `user_integral_log` VALUES ('537', '1', '28', '缓存测试添加', '0', '广告费激励宝分', '10.000', '0.000', '0.000', '0.000', '10.000', '0.000', '0.000', '9', '0', null, '2017-04-26 20:19:03', '2017-04-26 20:19:03');
INSERT INTO `user_integral_log` VALUES ('538', '1', '132', 'sadsada', '0', '抽成', '5.000', '41.200', '46.200', '1.200', '0.000', '15.315', '0.135', '13', '0', null, '2017-04-26 20:19:04', '2017-04-26 20:19:04');
INSERT INTO `user_integral_log` VALUES ('539', '1', '147', '18850221115', '0', '消费100激励宝分', '100.000', '25.000', '25.000', '0.000', '350.000', '25.000', '0.000', '1', '0', null, '2017-04-26 20:19:05', '2017-04-26 20:19:05');
INSERT INTO `user_integral_log` VALUES ('540', '1', '146', '18850221114', '0', '[推荐盟友],激励10宝分', '10.000', '25.000', '35.000', '0.000', '0.000', '24.500', '10.500', '6', '147', null, '2017-04-26 20:19:05', '2017-04-26 20:19:05');
INSERT INTO `user_integral_log` VALUES ('541', '1', '142', '18850221111', '0', '[推荐盟友],激励8宝分', '8.000', '20.000', '28.000', '0.000', '0.000', '19.600', '8.400', '6', '147', null, '2017-04-26 20:19:05', '2017-04-26 20:19:05');
INSERT INTO `user_integral_log` VALUES ('542', '1', '28', '缓存测试添加', '0', '广告费激励宝分', '5.000', '0.000', '0.000', '0.000', '15.000', '0.000', '0.000', '9', '0', null, '2017-04-26 20:21:27', '2017-04-26 20:21:27');
INSERT INTO `user_integral_log` VALUES ('543', '1', '132', 'sadsada', '0', '抽成', '7.500', '46.200', '53.700', '1.200', '0.000', '22.815', '0.135', '13', '0', null, '2017-04-26 20:21:27', '2017-04-26 20:21:27');
INSERT INTO `user_integral_log` VALUES ('544', '1', '147', '18850221115', '0', '消费50激励宝分', '50.000', '25.000', '25.000', '0.000', '400.000', '25.000', '0.000', '1', '0', null, '2017-04-26 20:21:28', '2017-04-26 20:21:28');
INSERT INTO `user_integral_log` VALUES ('545', '1', '146', '18850221114', '0', '[推荐盟友],激励5宝分', '5.000', '35.000', '40.000', '0.000', '0.000', '28.000', '12.000', '6', '147', null, '2017-04-26 20:21:29', '2017-04-26 20:21:29');
INSERT INTO `user_integral_log` VALUES ('546', '1', '142', '18850221111', '0', '[推荐盟友],激励4宝分', '4.000', '28.000', '32.000', '0.000', '0.000', '22.400', '9.600', '6', '147', null, '2017-04-26 20:21:29', '2017-04-26 20:21:29');
INSERT INTO `user_integral_log` VALUES ('547', '1', '28', '缓存测试添加', '0', '广告费激励宝分', '5.000', '0.000', '0.000', '0.000', '20.000', '0.000', '0.000', '9', '0', null, '2017-04-26 20:23:38', '2017-04-26 20:23:38');
INSERT INTO `user_integral_log` VALUES ('548', '1', '132', 'sadsada', '0', '抽成', '10.000', '53.700', '63.700', '1.200', '0.000', '32.815', '0.135', '13', '0', null, '2017-04-26 20:23:38', '2017-04-26 20:23:38');
INSERT INTO `user_integral_log` VALUES ('549', '1', '147', '18850221115', '0', '消费50激励宝分', '50.000', '25.000', '25.000', '0.000', '450.000', '25.000', '0.000', '1', '0', null, '2017-04-26 20:23:39', '2017-04-26 20:23:39');
INSERT INTO `user_integral_log` VALUES ('550', '1', '146', '18850221114', '0', '[推荐盟友],激励5宝分', '5.000', '40.000', '45.000', '0.000', '0.000', '31.500', '13.500', '6', '147', null, '2017-04-26 20:23:39', '2017-04-26 20:23:39');
INSERT INTO `user_integral_log` VALUES ('551', '1', '142', '18850221111', '0', '[推荐盟友],激励4宝分', '4.000', '32.000', '36.000', '0.000', '0.000', '25.200', '10.800', '6', '147', null, '2017-04-26 20:23:39', '2017-04-26 20:23:39');
INSERT INTO `user_integral_log` VALUES ('552', '2', '132', '', '0', '[推荐盟友],激励4宝分', '10.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '6', '0', null, '2017-04-18 17:44:51', null);
INSERT INTO `user_integral_log` VALUES ('553', '2', '132', '', '0', '还钱了', '55.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '11', '0', null, '2017-04-18 17:44:51', null);
INSERT INTO `user_integral_log` VALUES ('554', '1', '139', 'Have', '0', '[宝分兑换]', '666.000', '1000.000', '334.000', '3000.000', '4000.000', '4334.000', '6000.000', '2', '0', null, '2017-04-28 18:15:26', '2017-04-28 18:15:26');
INSERT INTO `user_integral_log` VALUES ('555', '1', '139', 'Have', '0', '[宝分兑换]', '333.000', '334.000', '1.000', '3000.000', '4000.000', '4001.000', '6000.000', '2', '0', null, '2017-04-28 18:18:52', '2017-04-28 18:18:52');
INSERT INTO `user_integral_log` VALUES ('556', '1', '139', 'Have', '0', '[宝分兑换]', '555.000', '1.000', '-554.000', '3000.000', '4000.000', '3446.000', '6000.000', '2', '0', null, '2017-04-28 18:20:03', '2017-04-28 18:20:03');
INSERT INTO `user_integral_log` VALUES ('557', '1', '139', 'Have', '0', '[宝分兑换]', '222.000', '-554.000', '-776.000', '3000.000', '4000.000', '3224.000', '6000.000', '2', '0', null, '2017-04-28 18:23:01', '2017-04-28 18:23:01');
INSERT INTO `user_integral_log` VALUES ('558', '1', '139', 'Have', '0', '[宝分兑换]', '111.000', '5000.000', '4889.000', '3000.000', '4000.000', '1889.000', '3000.000', '2', '0', null, '2017-04-30 14:04:29', '2017-04-30 14:04:29');
INSERT INTO `user_integral_log` VALUES ('559', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '4889.000', '4789.000', '3000.000', '4000.000', '1789.000', '3000.000', '2', '0', null, '2017-04-30 14:44:55', '2017-04-30 14:44:55');
INSERT INTO `user_integral_log` VALUES ('560', '1', '139', 'Have', '0', '[宝分兑换]', '1111.000', '4789.000', '3678.000', '3000.000', '4000.000', '678.000', '3000.000', '2', '0', null, '2017-04-30 14:49:16', '2017-04-30 14:49:16');
INSERT INTO `user_integral_log` VALUES ('561', '1', '139', 'Have', '0', '[宝分兑换]', '102.000', '3678.000', '3576.000', '3000.000', '4000.000', '576.000', '3000.000', '2', '0', null, '2017-04-30 15:20:55', '2017-04-30 15:20:55');
INSERT INTO `user_integral_log` VALUES ('562', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '3576.000', '3476.000', '3000.000', '4000.000', '476.000', '3000.000', '2', '0', null, '2017-04-30 15:24:44', '2017-04-30 15:24:44');
INSERT INTO `user_integral_log` VALUES ('563', '1', '139', 'Have', '0', '[宝分兑换]', '103.000', '3476.000', '3373.000', '3000.000', '4000.000', '373.000', '3000.000', '2', '0', null, '2017-04-30 15:28:00', '2017-04-30 15:28:00');
INSERT INTO `user_integral_log` VALUES ('564', '1', '139', 'Have', '0', '[宝分兑换]', '107.000', '3373.000', '3266.000', '3000.000', '4000.000', '266.000', '3000.000', '2', '0', null, '2017-04-30 15:28:42', '2017-04-30 15:28:42');
INSERT INTO `user_integral_log` VALUES ('565', '1', '139', 'Have', '0', '[宝分兑换]', '123.000', '3266.000', '3143.000', '3000.000', '4000.000', '143.000', '3000.000', '2', '0', null, '2017-04-30 15:33:46', '2017-04-30 15:33:46');
INSERT INTO `user_integral_log` VALUES ('566', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '3143.000', '3043.000', '3000.000', '4000.000', '43.000', '3000.000', '2', '0', null, '2017-04-30 15:56:41', '2017-04-30 15:56:41');
INSERT INTO `user_integral_log` VALUES ('568', '1', '139', 'Have', '0', '[宝分兑换]', '111.000', '3043.000', '2932.000', '3000.000', '4000.000', '2889.000', '43.000', '2', '0', null, '2017-04-30 16:08:38', '2017-04-30 16:08:38');
INSERT INTO `user_integral_log` VALUES ('569', '1', '139', 'Have', '0', '[宝分兑换]', '105.000', '2932.000', '2827.000', '3000.000', '4000.000', '2784.000', '43.000', '2', '0', null, '2017-04-30 16:10:25', '2017-04-30 16:10:25');
INSERT INTO `user_integral_log` VALUES ('570', '1', '139', 'Have', '0', '[宝分兑换]', '110.000', '2827.000', '2717.000', '3000.000', '4000.000', '2674.000', '43.000', '2', '0', null, '2017-04-30 16:54:31', '2017-04-30 16:54:31');
INSERT INTO `user_integral_log` VALUES ('571', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '2717.000', '2617.000', '3000.000', '4000.000', '2574.000', '43.000', '2', '0', null, '2017-04-30 17:08:32', '2017-04-30 17:08:32');
INSERT INTO `user_integral_log` VALUES ('572', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '2617.000', '2517.000', '3000.000', '4000.000', '2474.000', '43.000', '2', '0', null, '2017-04-30 17:12:18', '2017-04-30 17:12:18');
INSERT INTO `user_integral_log` VALUES ('573', '1', '139', 'Have', '0', '[宝分兑换]', '113.000', '2517.000', '2404.000', '3000.000', '4000.000', '2361.000', '43.000', '2', '0', null, '2017-05-02 10:38:03', '2017-05-02 10:38:03');
INSERT INTO `user_integral_log` VALUES ('574', '1', '139', 'Have', '0', '[宝分兑换]', '118.800', '2404.000', '2285.200', '3000.000', '4000.000', '2242.200', '43.000', '2', '0', null, '2017-05-02 10:41:53', '2017-05-02 10:41:53');
INSERT INTO `user_integral_log` VALUES ('575', '1', '139', 'Have', '0', '[宝分兑换]', '111.000', '2285.200', '2174.200', '3000.000', '4000.000', '2131.200', '43.000', '2', '0', null, '2017-05-02 10:47:55', '2017-05-02 10:47:55');
INSERT INTO `user_integral_log` VALUES ('576', '2', '139', 'Have', '0', '[宝分兑换]', '111.000', '222.000', '333.000', '444.000', '555.000', '666.000', '777.000', '6', '0', null, '2017-05-02 10:47:55', null);
INSERT INTO `user_integral_log` VALUES ('577', '2', '139', 'Have', '0', '[宝分兑换]', '222.000', '333.000', '444.000', '555.000', '666.000', '777.000', '888.000', '10', '0', null, '2017-05-02 10:47:55', null);
INSERT INTO `user_integral_log` VALUES ('578', '2', '139', 'Have', '0', '[宝分兑换]', '333.000', '444.000', '555.000', '666.000', '777.000', '888.000', '999.000', '13', '0', null, '2017-05-02 10:47:55', null);
INSERT INTO `user_integral_log` VALUES ('579', '2', '139', 'Have', '0', '[宝分兑换]', '444.000', '555.000', '666.000', '777.000', '888.000', '999.000', '1000.000', '5', '0', null, '2017-05-02 10:47:55', null);
INSERT INTO `user_integral_log` VALUES ('580', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '2174.200', '2074.200', '3000.000', '4000.000', '2031.200', '43.000', '2', '0', null, '2017-05-03 12:00:28', '2017-05-03 12:00:28');
INSERT INTO `user_integral_log` VALUES ('581', '1', '139', 'Have', '0', '[宝分兑换]', '121.000', '2074.200', '1953.200', '3000.000', '4000.000', '1910.200', '43.000', '2', '0', null, '2017-05-03 12:01:50', '2017-05-03 12:01:50');
INSERT INTO `user_integral_log` VALUES ('582', '1', '139', 'Have', '0', '[宝分兑换]', '123.000', '1953.200', '1830.200', '3000.000', '4000.000', '1787.200', '43.000', '2', '0', null, '2017-05-03 13:56:29', '2017-05-03 13:56:29');
INSERT INTO `user_integral_log` VALUES ('583', '2', '31', '店铺2', '0', '[宝分兑换]', '2220.000', '6666.000', '4446.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 14:18:27', '2017-05-03 14:18:27');
INSERT INTO `user_integral_log` VALUES ('584', '2', '31', '店铺2', '0', '[宝分兑换]', '111.000', '4446.000', '4335.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 14:25:59', '2017-05-03 14:25:59');
INSERT INTO `user_integral_log` VALUES ('585', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '1830.200', '1730.200', '3000.000', '4000.000', '1687.200', '43.000', '2', '0', null, '2017-05-03 14:29:00', '2017-05-03 14:29:00');
INSERT INTO `user_integral_log` VALUES ('586', '2', '31', '店铺2', '0', '[宝分兑换]', '122.000', '4335.000', '4213.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 14:29:32', '2017-05-03 14:29:32');
INSERT INTO `user_integral_log` VALUES ('587', '2', '31', '店铺2', '0', '[宝分兑换]', '100.000', '4213.000', '4113.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 14:34:21', '2017-05-03 14:34:21');
INSERT INTO `user_integral_log` VALUES ('588', '1', '139', 'Have', '0', '[宝分兑换]', '123.000', '1730.200', '1607.200', '3000.000', '4000.000', '1564.200', '43.000', '2', '0', null, '2017-05-03 15:12:47', '2017-05-03 15:12:47');
INSERT INTO `user_integral_log` VALUES ('589', '1', '139', 'Have', '0', '[宝分兑换]', '111.000', '1607.200', '1496.200', '3000.000', '4000.000', '1453.200', '43.000', '2', '0', null, '2017-05-03 15:13:02', '2017-05-03 15:13:02');
INSERT INTO `user_integral_log` VALUES ('590', '1', '139', 'Have', '0', '[宝分兑换]', '101.000', '1496.200', '1395.200', '3000.000', '4000.000', '1352.200', '43.000', '2', '0', null, '2017-05-03 15:16:49', '2017-05-03 15:16:49');
INSERT INTO `user_integral_log` VALUES ('591', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '1395.200', '1295.200', '3000.000', '4000.000', '1252.200', '43.000', '2', '0', null, '2017-05-03 15:21:09', '2017-05-03 15:21:09');
INSERT INTO `user_integral_log` VALUES ('592', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '1295.200', '1195.200', '3000.000', '4000.000', '1152.200', '43.000', '2', '0', null, '2017-05-03 15:21:29', '2017-05-03 15:21:29');
INSERT INTO `user_integral_log` VALUES ('593', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '1195.200', '1095.200', '3000.000', '4000.000', '1052.200', '43.000', '2', '0', null, '2017-05-03 15:26:06', '2017-05-03 15:26:06');
INSERT INTO `user_integral_log` VALUES ('594', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '1095.200', '995.200', '3000.000', '4000.000', '952.200', '43.000', '2', '0', null, '2017-05-03 15:41:23', '2017-05-03 15:41:23');
INSERT INTO `user_integral_log` VALUES ('595', '1', '139', 'Have', '0', '[宝分兑换]', '100.200', '995.200', '895.000', '3000.000', '4000.000', '852.000', '43.000', '2', '0', null, '2017-05-03 15:54:26', '2017-05-03 15:54:26');
INSERT INTO `user_integral_log` VALUES ('596', '1', '139', 'Have', '0', '[宝分兑换]', '100.000', '895.000', '795.000', '3000.000', '4000.000', '752.000', '43.000', '2', '0', null, '2017-05-03 15:59:05', '2017-05-03 15:59:05');
INSERT INTO `user_integral_log` VALUES ('597', '2', '31', '店铺2', '0', '[宝分兑换]', '123.000', '4113.000', '3990.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 16:58:47', '2017-05-03 16:58:47');
INSERT INTO `user_integral_log` VALUES ('598', '2', '31', '店铺2', '0', '[宝分兑换]', '190.000', '3990.000', '3800.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 17:04:16', '2017-05-03 17:04:16');
INSERT INTO `user_integral_log` VALUES ('599', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '1000.000', '900.000', '3000.000', '2000.000', '900.000', '0.000', '2', '0', null, '2017-05-03 17:44:50', '2017-05-03 17:44:50');
INSERT INTO `user_integral_log` VALUES ('600', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '900.000', '800.000', '3000.000', '2000.000', '800.000', '0.000', '2', '0', null, '2017-05-03 18:02:57', '2017-05-03 18:02:57');
INSERT INTO `user_integral_log` VALUES ('601', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '800.000', '700.000', '3000.000', '2000.000', '700.000', '0.000', '2', '0', null, '2017-05-03 18:04:36', '2017-05-03 18:04:36');
INSERT INTO `user_integral_log` VALUES ('602', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '700.000', '600.000', '3000.000', '2000.000', '600.000', '0.000', '2', '0', null, '2017-05-03 18:07:12', '2017-05-03 18:07:12');
INSERT INTO `user_integral_log` VALUES ('603', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '600.000', '500.000', '3000.000', '2000.000', '500.000', '0.000', '2', '0', null, '2017-05-03 18:07:47', '2017-05-03 18:07:47');
INSERT INTO `user_integral_log` VALUES ('604', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '500.000', '400.000', '3000.000', '2000.000', '400.000', '0.000', '2', '0', null, '2017-05-03 18:08:24', '2017-05-03 18:08:24');
INSERT INTO `user_integral_log` VALUES ('605', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '400.000', '300.000', '3000.000', '2000.000', '300.000', '0.000', '2', '0', null, '2017-05-03 18:09:01', '2017-05-03 18:09:01');
INSERT INTO `user_integral_log` VALUES ('606', '2', '31', '店铺2', '0', '[宝分兑换]', '111.000', '3800.000', '3689.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 18:17:58', '2017-05-03 18:17:58');
INSERT INTO `user_integral_log` VALUES ('607', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '300.000', '200.000', '3000.000', '2000.000', '200.000', '0.000', '2', '0', null, '2017-05-03 18:18:59', '2017-05-03 18:18:59');
INSERT INTO `user_integral_log` VALUES ('608', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '100000.000', '99900.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 18:21:06', '2017-05-03 18:21:06');
INSERT INTO `user_integral_log` VALUES ('609', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '200.000', '99900.000', '99700.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 18:21:44', '2017-05-03 18:21:44');
INSERT INTO `user_integral_log` VALUES ('610', '1', '134', '测试修改', '0', '[宝分兑换]', '100.000', '200.000', '100.000', '3000.000', '2000.000', '100.000', '0.000', '2', '0', null, '2017-05-03 18:50:57', '2017-05-03 18:50:57');
INSERT INTO `user_integral_log` VALUES ('611', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99700.000', '99600.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-03 18:51:12', '2017-05-03 18:51:12');
INSERT INTO `user_integral_log` VALUES ('612', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99600.000', '99500.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-04 12:05:30', '2017-05-04 12:05:30');
INSERT INTO `user_integral_log` VALUES ('613', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99500.000', '99400.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-04 12:06:09', '2017-05-04 12:06:09');
INSERT INTO `user_integral_log` VALUES ('614', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99400.000', '99300.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-04 12:06:28', '2017-05-04 12:06:28');
INSERT INTO `user_integral_log` VALUES ('615', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99300.000', '99200.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-04 12:06:46', '2017-05-04 12:06:46');
INSERT INTO `user_integral_log` VALUES ('616', '2', '19', '后台添加商家测试', '0', '[宝分提现审核]审核失败，返还宝分：100.00', '100.000', '99200.000', '99300.000', '1000.000', '7777.000', '0.000', '0.000', '14', '0', null, '2017-05-04 14:30:02', '2017-05-04 14:30:02');
INSERT INTO `user_integral_log` VALUES ('617', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99300.000', '99200.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-04 17:48:43', '2017-05-04 17:48:43');
INSERT INTO `user_integral_log` VALUES ('618', '1', '139', 'Have', '0', '消费宝分', '68.000', '795.000', '727.000', '3000.000', '4000.000', '727.000', '0.000', '5', '0', null, '2017-05-04 19:52:29', '2017-05-04 19:52:29');
INSERT INTO `user_integral_log` VALUES ('619', '1', '139', 'Have', '0', '消费宝分', '68.000', '727.000', '659.000', '3000.000', '4000.000', '659.000', '0.000', '5', '0', null, '2017-05-04 19:52:32', '2017-05-04 19:52:32');
INSERT INTO `user_integral_log` VALUES ('620', '1', '139', 'Have', '0', '消费宝分', '68.000', '659.000', '591.000', '3000.000', '4000.000', '591.000', '0.000', '5', '0', null, '2017-05-04 19:52:44', '2017-05-04 19:52:44');
INSERT INTO `user_integral_log` VALUES ('626', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99200.000', '99100.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-05 09:27:07', '2017-05-05 09:27:07');
INSERT INTO `user_integral_log` VALUES ('627', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99100.000', '99000.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-05 09:35:45', '2017-05-05 09:35:45');
INSERT INTO `user_integral_log` VALUES ('628', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '99000.000', '98900.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-05 09:37:52', '2017-05-05 09:37:52');
INSERT INTO `user_integral_log` VALUES ('629', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '98900.000', '98800.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-05 09:47:05', '2017-05-05 09:47:05');
INSERT INTO `user_integral_log` VALUES ('630', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '98800.000', '98700.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-05 09:48:29', '2017-05-05 09:48:29');
INSERT INTO `user_integral_log` VALUES ('631', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '98700.000', '98600.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-05 10:15:08', '2017-05-05 10:15:08');
INSERT INTO `user_integral_log` VALUES ('632', '2', '19', '后台添加商家测试', '0', '[宝分兑换]', '100.000', '98600.000', '98500.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-05 10:16:42', '2017-05-05 10:16:42');
INSERT INTO `user_integral_log` VALUES ('633', '2', '31', '店铺2', '0', '[宝分兑换]', '100.000', '3689.000', '3589.000', '1000.000', '7777.000', '0.000', '0.000', '12', '0', null, '2017-05-05 11:06:19', '2017-05-05 11:06:19');
INSERT INTO `user_integral_log` VALUES ('685', '1', '139', 'Have', '0', '消费0.00宝分', '0.000', '591.000', '591.000', '3000.000', '4000.000', '591.000', '0.000', '5', '0', null, '2017-05-05 15:22:52', '2017-05-05 15:22:52');
INSERT INTO `user_integral_log` VALUES ('686', '1', '139', 'Have', '0', '消费0.1激励宝分', '0.100', '591.000', '591.000', '3000.000', '4000.100', '591.000', '0.000', '1', '0', null, '2017-05-05 15:22:52', '2017-05-05 15:22:52');
INSERT INTO `user_integral_log` VALUES ('687', '1', '149', '15359225953', '0', '消费0.00宝分', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '5', '0', null, '2017-05-05 15:23:11', '2017-05-05 15:23:11');
INSERT INTO `user_integral_log` VALUES ('688', '1', '149', '15359225953', '0', '消费0.1激励宝分', '0.100', '0.000', '0.000', '0.000', '0.100', '0.000', '0.000', '1', '0', null, '2017-05-05 15:23:11', '2017-05-05 15:23:11');
INSERT INTO `user_integral_log` VALUES ('689', '1', '149', '15359225953', '0', '消费0.00宝分', '0.000', '0.000', '0.000', '0.000', '0.100', '0.000', '0.000', '5', '0', null, '2017-05-05 15:24:11', '2017-05-05 15:24:11');
INSERT INTO `user_integral_log` VALUES ('690', '1', '149', '15359225953', '0', '消费0.2激励宝分', '0.200', '0.000', '0.000', '0.000', '0.300', '0.000', '0.000', '1', '0', null, '2017-05-05 15:24:11', '2017-05-05 15:24:11');
INSERT INTO `user_integral_log` VALUES ('691', '1', '139', 'Have', '0', '消费0.00宝分', '0.000', '591.000', '591.000', '3000.000', '4000.100', '591.000', '0.000', '5', '0', null, '2017-05-05 15:24:20', '2017-05-05 15:24:20');
INSERT INTO `user_integral_log` VALUES ('692', '1', '139', 'Have', '0', '消费0.1激励宝分', '0.100', '591.000', '591.000', '3000.000', '4000.200', '591.000', '0.000', '1', '0', null, '2017-05-05 15:24:20', '2017-05-05 15:24:20');
INSERT INTO `user_integral_log` VALUES ('693', '1', '149', '15359225953', '0', '消费0.00宝分', '0.000', '0.000', '0.000', '0.000', '0.300', '0.000', '0.000', '5', '0', null, '2017-05-05 15:26:46', '2017-05-05 15:26:46');
INSERT INTO `user_integral_log` VALUES ('694', '1', '149', '15359225953', '0', '消费0.1激励宝分', '0.100', '0.000', '0.000', '0.000', '0.400', '0.000', '0.000', '1', '0', null, '2017-05-05 15:26:46', '2017-05-05 15:26:46');
INSERT INTO `user_integral_log` VALUES ('695', '1', '149', '15359225953', '0', '消费0.1激励宝分', '0.100', '0.000', '0.000', '0.000', '0.500', '0.000', '0.000', '1', '0', null, '2017-05-05 15:32:20', '2017-05-05 15:32:20');
INSERT INTO `user_integral_log` VALUES ('696', '1', '134', '测试修改刷新', '0', '消费宝分', '68.000', '5000.000', '4932.000', '3000.000', '2000.000', '100.000', '0.000', '5', '0', null, '2017-05-05 16:25:21', '2017-05-05 16:25:21');
INSERT INTO `user_integral_log` VALUES ('699', '1', '139', 'Have', '0', '签到获得宝分', '1.500', '591.000', '592.500', '3001.500', '3998.700', '592.050', '0.450', '7', '0', null, '2017-05-05 16:58:14', '2017-05-05 16:58:14');
INSERT INTO `user_integral_log` VALUES ('700', '1', '134', '测试修改刷新', '0', '消费宝分', '68.000', '4932.000', '4864.000', '3000.000', '2000.000', '32.000', '0.000', '5', '0', null, '2017-05-05 17:50:43', '2017-05-05 17:50:43');
INSERT INTO `user_integral_log` VALUES ('710', '1', '19', '后台添加商家测', '0', '广告费激励宝分', '0.010', '98500.000', '98500.000', '1000.000', '7777.010', '0.000', '0.000', '9', '0', null, '2017-05-05 22:17:39', '2017-05-05 22:17:39');
INSERT INTO `user_integral_log` VALUES ('711', '1', '132', 'sadsada', '0', '抽成', '0.005', '63.700', '63.705', '1.200', '0.000', '32.820', '0.135', '13', '0', null, '2017-05-05 22:17:39', '2017-05-05 22:17:39');
INSERT INTO `user_integral_log` VALUES ('712', '1', '134', '测试修改刷新', '0', '消费0.1激励宝分', '0.100', '4864.000', '4864.000', '3000.000', '2000.100', '32.000', '0.000', '1', '0', null, '2017-05-05 22:17:39', '2017-05-05 22:17:39');
INSERT INTO `user_integral_log` VALUES ('717', '1', '139', 'Have', '0', '签到获得宝分', '1.500', '592.500', '594.000', '3003.000', '3997.200', '593.100', '0.900', '7', '0', null, '2017-05-06 02:29:37', '2017-05-06 02:29:37');
INSERT INTO `user_integral_log` VALUES ('722', '1', '154', '15980609689', '0', '消费0.1激励宝分', '0.100', '0.000', '0.000', '0.000', '0.100', '0.000', '0.000', '1', '0', null, '2017-05-07 14:35:57', '2017-05-07 14:35:57');
INSERT INTO `user_integral_log` VALUES ('723', '1', '48', '7天酒店', '0', '广告费激励宝分', '0.001', '0.000', '0.000', '0.000', '0.001', '0.000', '0.000', '9', '0', null, '2017-05-07 20:05:05', '2017-05-07 20:05:05');
INSERT INTO `user_integral_log` VALUES ('724', '1', '132', 'sadsada', '0', '抽成', '0.001', '63.705', '63.705', '1.200', '0.000', '32.820', '0.135', '13', '0', null, '2017-05-07 20:05:05', '2017-05-07 20:05:05');
INSERT INTO `user_integral_log` VALUES ('725', '1', '154', '15980609689', '0', '消费0.01激励宝分', '0.010', '0.000', '0.000', '0.000', '0.110', '0.000', '0.000', '1', '0', null, '2017-05-07 20:05:05', '2017-05-07 20:05:05');
INSERT INTO `user_integral_log` VALUES ('730', '1', '139', 'Have', '0', '签到获得宝分', '1.500', '594.000', '595.500', '3004.500', '3995.700', '594.150', '1.350', '7', '0', null, '2017-05-08 09:41:36', '2017-05-08 09:41:36');
INSERT INTO `user_integral_log` VALUES ('731', '1', '150', 'lily', '0', '消费0.1激励宝分', '0.100', '0.000', '0.000', '0.000', '0.100', '0.000', '0.000', '1', '0', null, '2017-05-08 16:26:57', '2017-05-08 16:26:57');
INSERT INTO `user_integral_log` VALUES ('732', '1', '153', '东山', '0', '消费0.01激励宝分', '0.010', '0.000', '0.000', '0.000', '0.010', '0.000', '0.000', '1', '0', null, '2017-05-08 16:45:50', '2017-05-08 16:45:50');
INSERT INTO `user_integral_log` VALUES ('733', '1', '154', '15980609689', '0', '消费0.02激励宝分', '0.020', '0.000', '0.000', '0.000', '0.130', '0.000', '0.000', '1', '0', null, '2017-05-08 17:09:07', '2017-05-08 17:09:07');
INSERT INTO `user_integral_log` VALUES ('734', '1', '150', 'lily', '0', '签到获得宝分', '0.000', '0.000', '0.000', '0.000', '0.100', '0.000', '0.000', '7', '0', null, '2017-05-08 17:15:56', '2017-05-08 17:15:56');
INSERT INTO `user_integral_log` VALUES ('735', '1', '150', 'lily', '0', '消费0.01激励宝分', '0.010', '0.000', '0.000', '0.000', '0.110', '0.000', '0.000', '1', '0', null, '2017-05-08 18:11:13', '2017-05-08 18:11:13');
INSERT INTO `user_integral_log` VALUES ('740', '1', '134', '测试修改刷新', '0', '消费宝分', '78.000', '4864.000', '4786.000', '3000.000', '2000.100', '-46.000', '0.000', '5', '0', null, '2017-05-08 18:32:16', '2017-05-08 18:32:16');
INSERT INTO `user_integral_log` VALUES ('742', '1', '134', '测试修改刷新', '0', '消费宝分', '78.000', '4786.000', '4708.000', '3000.000', '2000.100', '-124.000', '0.000', '5', '0', null, '2017-05-08 18:34:02', '2017-05-08 18:34:02');
INSERT INTO `user_integral_log` VALUES ('743', '1', '134', '测试修改刷新', '0', '消费宝分', '78.000', '4708.000', '4630.000', '3000.000', '2000.100', '-202.000', '0.000', '5', '0', null, '2017-05-08 18:34:16', '2017-05-08 18:34:16');
INSERT INTO `user_integral_log` VALUES ('744', '1', '139', 'Have', '0', '消费宝分', '78.000', '595.500', '517.500', '3004.500', '3995.700', '517.500', '0.000', '5', '0', null, '2017-05-08 18:35:51', '2017-05-08 18:35:51');
INSERT INTO `user_integral_log` VALUES ('745', '1', '139', 'Have', '0', '消费宝分', '295.000', '517.500', '222.500', '3004.500', '3995.700', '222.500', '0.000', '5', '0', null, '2017-05-08 18:36:08', '2017-05-08 18:36:08');
INSERT INTO `user_integral_log` VALUES ('746', '1', '134', '测试修改刷新', '0', '消费宝分', '78.000', '4630.000', '4552.000', '3000.000', '2000.100', '-280.000', '0.000', '5', '0', null, '2017-05-08 21:40:41', '2017-05-08 21:40:41');
INSERT INTO `user_integral_log` VALUES ('747', '1', '134', '测试修改刷新', '0', '消费宝分', '78.000', '4552.000', '4474.000', '3000.000', '2000.100', '-358.000', '0.000', '5', '0', null, '2017-05-08 21:41:29', '2017-05-08 21:41:29');
INSERT INTO `user_integral_log` VALUES ('748', '1', '134', '测试修改刷新', '0', '漏签减少宝分', '0.000', '4474.000', '4474.000', '3000.000', '2000.100', '-358.000', '0.000', '8', '0', null, '2017-05-09 00:05:02', '2017-05-09 00:05:02');
INSERT INTO `user_integral_log` VALUES ('749', '1', '136', '被推荐用户测试', '0', '漏签减少宝分', '1.000', '0.000', '0.000', '100.000', '396.500', '0.000', '0.000', '8', '0', null, '2017-05-09 00:05:02', '2017-05-09 00:05:02');
INSERT INTO `user_integral_log` VALUES ('750', '1', '147', '18850221115', '0', '漏签减少宝分', '1.000', '100.000', '100.000', '0.000', '449.000', '25.000', '75.000', '8', '0', null, '2017-05-09 00:05:02', '2017-05-09 00:05:02');
INSERT INTO `user_integral_log` VALUES ('751', '1', '149', '15359225953', '0', '漏签减少宝分', '0.000', '0.000', '0.000', '0.000', '0.500', '0.000', '0.000', '8', '0', null, '2017-05-09 00:05:02', '2017-05-09 00:05:02');
INSERT INTO `user_integral_log` VALUES ('752', '1', '153', '东山', '0', '漏签减少宝分', '0.000', '0.000', '0.000', '0.000', '0.010', '0.000', '0.000', '8', '0', null, '2017-05-09 00:05:02', '2017-05-09 00:05:02');
INSERT INTO `user_integral_log` VALUES ('753', '1', '154', '15980609689', '0', '漏签减少宝分', '0.000', '0.000', '0.000', '0.000', '0.130', '0.000', '0.000', '8', '0', null, '2017-05-09 00:05:02', '2017-05-09 00:05:02');
INSERT INTO `user_integral_log` VALUES ('754', '2', '48', '7天酒店', '0', '商家漏签减少宝分', '0.000', '0.000', '0.000', '0.000', '0.001', '0.000', '0.000', '11', '0', null, '2017-05-09 00:08:01', '2017-05-09 00:08:01');
INSERT INTO `user_integral_log` VALUES ('755', '1', '139', 'Have', '0', '签到获得宝分', '1.500', '222.500', '224.000', '3006.000', '3994.200', '223.550', '0.450', '7', '0', null, '2017-05-09 09:25:53', '2017-05-09 09:25:53');
INSERT INTO `user_integral_log` VALUES ('763', '1', '149', '15359225953', '0', '签到获得宝分', '0.500', '0.000', '0.500', '0.500', '0.000', '0.350', '0.150', '7', '0', null, '2017-05-09 17:16:31', '2017-05-09 17:16:31');
INSERT INTO `user_integral_log` VALUES ('766', '1', '150', 'lily', '0', '签到获得宝分', '0.000', '0.000', '0.000', '0.000', '0.120', '0.000', '0.000', '7', '0', null, '2017-05-09 19:48:40', '2017-05-09 19:48:40');
INSERT INTO `user_integral_log` VALUES ('767', '1', '134', '测试修改刷新', '0', '签到获得宝分', '9.900', '4405.900', '4415.800', '3019.800', '1980.300', '-422.140', '5.940', '7', '0', null, '2017-05-10 10:14:39', '2017-05-10 10:14:39');
INSERT INTO `user_integral_log` VALUES ('768', '1', '150', '我', '0', '签到获得宝分', '0.000', '0.000', '0.000', '0.000', '0.120', '0.000', '0.000', '7', '0', null, '2017-05-10 10:43:38', '2017-05-10 10:43:38');
INSERT INTO `user_integral_log` VALUES ('769', '1', '139', 'Have11', '0', '签到获得宝分', '1.500', '224.000', '225.500', '3007.500', '3992.700', '224.600', '0.900', '7', '0', null, '2017-05-10 10:47:06', '2017-05-10 10:47:06');
INSERT INTO `user_integral_log` VALUES ('770', '1', '151', '15870065127', '0', '签到获得宝分', '0.000', '0.000', '0.000', '8000.000', '888.000', '0.000', '0.000', '7', '0', null, '2017-05-10 10:52:26', '2017-05-10 10:52:26');
INSERT INTO `user_integral_log` VALUES ('778', '1', '149', '我是测试', '0', '消费0.01激励宝分', '0.010', '0.500', '0.500', '0.500', '0.010', '0.350', '0.150', '1', '0', null, '2017-05-11 10:48:36', '2017-05-11 10:48:36');
INSERT INTO `user_integral_log` VALUES ('779', '1', '149', '我是测试', '0', '消费0.01激励宝分', '0.010', '0.500', '0.500', '0.500', '0.020', '0.350', '0.150', '1', '0', null, '2017-05-11 10:51:32', '2017-05-11 10:51:32');
INSERT INTO `user_integral_log` VALUES ('780', '1', '136', '被推荐用户测试', '0', '漏签减少宝分', '1.000', '0.000', '0.000', '100.000', '395.500', '0.000', '0.000', '8', '0', null, '2017-05-11 10:53:47', '2017-05-11 10:53:47');
INSERT INTO `user_integral_log` VALUES ('781', '1', '147', '18850221115', '0', '漏签减少宝分', '1.500', '100.000', '100.000', '0.000', '447.500', '25.000', '75.000', '8', '0', null, '2017-05-11 10:53:47', '2017-05-11 10:53:47');
INSERT INTO `user_integral_log` VALUES ('782', '1', '149', '我是测试', '0', '漏签减少宝分', '1.000', '0.500', '0.500', '0.500', '0.000', '0.350', '0.150', '8', '0', null, '2017-05-11 10:53:47', '2017-05-11 10:53:47');
INSERT INTO `user_integral_log` VALUES ('783', '1', '153', '东山', '0', '漏签减少宝分', '0.500', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '8', '0', null, '2017-05-11 10:53:47', '2017-05-11 10:53:47');
INSERT INTO `user_integral_log` VALUES ('784', '1', '154', '123', '0', '漏签减少宝分', '0.500', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '8', '0', null, '2017-05-11 10:53:47', '2017-05-11 10:53:47');
INSERT INTO `user_integral_log` VALUES ('785', '2', '48', '7天酒店', '0', '商家漏签减少宝分', '0.500', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '11', '0', null, '2017-05-11 10:53:54', '2017-05-11 10:53:54');
INSERT INTO `user_integral_log` VALUES ('786', '1', '149', '我是测试', '0', '消费0.01激励宝分', '0.010', '0.500', '0.500', '0.500', '0.010', '0.350', '0.150', '1', '0', null, '2017-05-11 10:54:45', '2017-05-11 10:54:45');
INSERT INTO `user_integral_log` VALUES ('787', '1', '139', 'Have4', '0', '签到获得宝分', '1.500', '225.500', '227.000', '3009.000', '3991.200', '225.650', '1.350', '7', '0', null, '2017-05-11 10:56:27', '2017-05-11 10:56:27');
INSERT INTO `user_integral_log` VALUES ('788', '1', '139', 'Have4', '0', '消费宝分', '98.000', '227.000', '129.000', '3009.000', '3991.200', '129.000', '0.000', '5', '0', null, '2017-05-11 10:57:08', '2017-05-11 10:57:08');
INSERT INTO `user_integral_log` VALUES ('789', '1', '139', 'Have4', '0', '消费宝分', '98.000', '129.000', '31.000', '3009.000', '3991.200', '31.000', '0.000', '5', '0', null, '2017-05-11 10:58:55', '2017-05-11 10:58:55');
INSERT INTO `user_integral_log` VALUES ('790', '1', '149', '我是测试结果', '0', '消费0.01激励宝分', '0.010', '0.500', '0.500', '0.500', '0.020', '0.350', '0.150', '1', '0', null, '2017-05-11 11:13:49', '2017-05-11 11:13:49');
INSERT INTO `user_integral_log` VALUES ('791', '1', '139', '我的', '0', '消费宝分', '98.000', '100000.000', '99902.000', '3009.000', '3991.200', '90000.000', '0.000', '5', '0', null, '2017-05-11 11:34:30', '2017-05-11 11:34:30');
INSERT INTO `user_integral_log` VALUES ('792', '1', '149', '我', '0', '签到获得宝分', '0.020', '0.500', '0.520', '0.520', '0.000', '0.364', '0.156', '7', '0', null, '2017-05-11 14:08:03', '2017-05-11 14:08:03');
INSERT INTO `user_integral_log` VALUES ('793', '1', '151', '15870065127', '0', '消费0.01激励宝分', '0.010', '0.000', '0.000', '8000.000', '888.010', '0.000', '0.000', '1', '0', null, '2017-05-11 14:35:33', '2017-05-11 14:35:33');
INSERT INTO `user_integral_log` VALUES ('794', '1', '84', '我要开店', '0', '广告费激励宝分', '0.001', '0.000', '0.000', '0.000', '0.001', '0.000', '0.000', '9', '0', null, '2017-05-11 14:43:35', '2017-05-11 14:43:35');
INSERT INTO `user_integral_log` VALUES ('795', '1', '160', '18850221107', '84', '抽成', '0.001', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '13', '0', null, '2017-05-11 14:43:35', '2017-05-11 14:43:35');
INSERT INTO `user_integral_log` VALUES ('796', '1', '168', '欧欧欧欧', '0', '代理商抽成', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', '14', '0', null, '2017-05-11 14:43:35', '2017-05-11 14:43:35');
INSERT INTO `user_integral_log` VALUES ('797', '1', '156', '17759413572', '0', '消费0.01激励宝分', '0.010', '0.000', '0.000', '0.000', '0.010', '0.000', '0.000', '1', '0', null, '2017-05-11 14:43:35', '2017-05-11 14:43:35');
INSERT INTO `user_integral_log` VALUES ('798', '2', '84', '我要开店', '0', '广告费激励宝分', '0.020', '0.000', '0.000', '0.000', '0.021', '0.000', '0.000', '9', '0', null, '2017-05-11 14:51:50', '2017-05-11 14:51:50');
INSERT INTO `user_integral_log` VALUES ('799', '1', '160', '18850221107', '84', '抽成', '0.010', '0.000', '0.010', '0.000', '0.000', '0.010', '0.000', '13', '0', null, '2017-05-11 14:51:50', '2017-05-11 14:51:50');
INSERT INTO `user_integral_log` VALUES ('800', '1', '168', '欧欧欧欧', '84', '代理商抽成', '0.006', '0.000', '0.006', '0.000', '0.000', '0.006', '0.000', '14', '0', null, '2017-05-11 14:51:50', '2017-05-11 14:51:50');
INSERT INTO `user_integral_log` VALUES ('801', '1', '156', '17759413572', '0', '消费0.2激励宝分', '0.200', '0.000', '0.000', '0.000', '0.210', '0.000', '0.000', '1', '0', null, '2017-05-11 14:51:50', '2017-05-11 14:51:50');
INSERT INTO `user_integral_log` VALUES ('802', '1', '156', '17759413572', '0', '签到获得宝分', '0.210', '0.000', '0.210', '0.210', '0.000', '0.147', '0.063', '7', '0', null, '2017-05-11 15:31:33', '2017-05-11 15:31:33');
INSERT INTO `user_integral_log` VALUES ('805', '2', '84', '我要开店', '0', '商家漏签减少宝分', '0.000', '0.000', '0.000', '0.000', '0.021', '0.000', '0.000', '11', '0', null, '2017-05-12 04:08:01', '2017-05-12 04:08:01');
INSERT INTO `user_integral_log` VALUES ('806', '2', '84', '我要开店', '0', '广告费激励宝分', '0.020', '0.000', '0.000', '0.000', '0.041', '0.000', '0.000', '9', '0', null, '2017-05-12 10:42:33', '2017-05-12 10:42:33');
INSERT INTO `user_integral_log` VALUES ('807', '1', '160', '18850221107', '84', '抽成', '0.010', '0.010', '0.020', '0.000', '0.000', '0.020', '0.000', '13', '0', null, '2017-05-12 10:42:33', '2017-05-12 10:42:33');
INSERT INTO `user_integral_log` VALUES ('808', '1', '168', '欧欧欧欧', '84', '代理商抽成', '0.006', '0.006', '0.012', '0.000', '0.000', '0.012', '0.000', '14', '0', null, '2017-05-12 10:42:33', '2017-05-12 10:42:33');
INSERT INTO `user_integral_log` VALUES ('809', '1', '148', '阿萨德飒沓', '0', '消费0.2获得激励宝分', '0.200', '0.000', '0.000', '0.000', '0.200', '0.000', '0.000', '1', '0', null, '2017-05-12 10:42:33', '2017-05-12 10:42:33');
INSERT INTO `user_integral_log` VALUES ('810', '1', '146', '18850221114', '0', '[推荐盟友],激励0.02宝分', '0.020', '45.000', '45.020', '0.000', '0.000', '31.514', '13.506', '6', '148', null, '2017-05-12 10:42:33', '2017-05-12 10:42:33');
INSERT INTO `user_integral_log` VALUES ('811', '1', '142', '18850221111', '0', '[推荐盟友],激励0.016宝分', '0.016', '36.000', '36.016', '0.000', '0.000', '25.211', '10.804', '6', '148', null, '2017-05-12 10:42:34', '2017-05-12 10:42:34');
INSERT INTO `user_integral_log` VALUES ('812', '1', '139', '我的刚刚', '0', '签到获得宝分', '1.500', '99902.000', '99903.500', '3010.500', '3989.700', '90001.050', '0.450', '7', '0', null, '2017-05-12 12:43:44', '2017-05-12 12:43:44');
INSERT INTO `user_integral_log` VALUES ('813', '1', '177', '18250815530', '0', '消费1获得激励宝分', '1.000', '0.000', '0.000', '0.000', '1.000', '0.000', '0.000', '1', '0', null, '2017-05-12 15:54:14', '2017-05-12 15:54:14');
INSERT INTO `user_integral_log` VALUES ('814', '1', '166', '叶莉', '0', '[推荐盟友],激励0.1宝分', '0.100', '0.000', '0.100', '0.000', '0.000', '0.070', '0.030', '6', '177', null, '2017-05-12 15:54:14', '2017-05-12 15:54:14');
INSERT INTO `user_integral_log` VALUES ('815', '1', '176', '我是昵称', '0', '消费0.01获得激励宝分', '0.010', '0.000', '0.000', '0.000', '0.010', '0.000', '0.000', '1', '0', null, '2017-05-12 15:56:08', '2017-05-12 15:56:08');
INSERT INTO `user_integral_log` VALUES ('816', '1', '149', '我们', '0', '[推荐盟友],激励0.001宝分', '0.001', '0.520', '0.521', '0.520', '0.000', '0.364', '0.156', '6', '176', null, '2017-05-12 15:56:08', '2017-05-12 15:56:08');
INSERT INTO `user_integral_log` VALUES ('817', '1', '177', '18250815530', '0', '签到获得宝分', '0.500', '0.000', '0.500', '0.500', '0.500', '0.350', '0.150', '7', '0', null, '2017-05-12 16:07:44', '2017-05-12 16:07:44');
INSERT INTO `user_integral_log` VALUES ('818', '1', '177', '18250815530', '0', '消费1获得激励宝分', '1.000', '0.500', '0.500', '0.500', '1.500', '0.350', '0.150', '1', '0', null, '2017-05-12 16:23:16', '2017-05-12 16:23:16');
INSERT INTO `user_integral_log` VALUES ('819', '1', '166', '叶莉', '0', '[推荐盟友],激励0.1宝分', '0.100', '0.100', '0.200', '0.000', '0.000', '0.140', '0.060', '6', '177', null, '2017-05-12 16:23:16', '2017-05-12 16:23:16');
INSERT INTO `user_integral_log` VALUES ('820', '2', '87', '钱钱钱钱钱', '0', '广告费激励宝分', '0.100', '0.000', '0.000', '0.000', '0.100', '0.000', '0.000', '9', '0', null, '2017-05-12 16:56:18', '2017-05-12 16:56:18');
INSERT INTO `user_integral_log` VALUES ('821', '1', '160', '18850221107', '87', '抽成', '0.050', '0.020', '0.070', '0.000', '0.000', '0.070', '0.000', '13', '0', null, '2017-05-12 16:56:18', '2017-05-12 16:56:18');
INSERT INTO `user_integral_log` VALUES ('822', '1', '168', '欧欧欧欧', '87', '代理商抽成', '0.030', '0.012', '0.042', '0.000', '0.000', '0.042', '0.000', '14', '0', null, '2017-05-12 16:56:18', '2017-05-12 16:56:18');
INSERT INTO `user_integral_log` VALUES ('823', '1', '177', '18250815530', '0', '消费1获得激励宝分', '1.000', '0.500', '0.500', '0.500', '2.500', '0.350', '0.150', '1', '0', null, '2017-05-12 16:56:18', '2017-05-12 16:56:18');
INSERT INTO `user_integral_log` VALUES ('824', '1', '166', '叶莉', '0', '[推荐盟友],激励0.1宝分', '0.100', '0.200', '0.300', '0.000', '0.000', '0.210', '0.090', '6', '177', null, '2017-05-12 16:56:18', '2017-05-12 16:56:18');
INSERT INTO `user_integral_log` VALUES ('825', '2', '87', '钱钱钱钱钱', '0', '广告费激励宝分', '0.001', '0.000', '0.000', '0.000', '0.101', '0.000', '0.000', '9', '0', null, '2017-05-12 16:57:33', '2017-05-12 16:57:33');
INSERT INTO `user_integral_log` VALUES ('826', '1', '160', '18850221107', '87', '抽成', '0.001', '0.070', '0.070', '0.000', '0.000', '0.070', '0.000', '13', '0', null, '2017-05-12 16:57:33', '2017-05-12 16:57:33');
INSERT INTO `user_integral_log` VALUES ('827', '1', '168', '欧欧欧欧', '87', '代理商抽成', '0.000', '0.042', '0.042', '0.000', '0.000', '0.042', '0.000', '14', '0', null, '2017-05-12 16:57:33', '2017-05-12 16:57:33');
INSERT INTO `user_integral_log` VALUES ('828', '1', '176', '我是昵称', '0', '消费0.01获得激励宝分', '0.010', '0.000', '0.000', '0.000', '0.020', '0.000', '0.000', '1', '0', null, '2017-05-12 16:57:33', '2017-05-12 16:57:33');
INSERT INTO `user_integral_log` VALUES ('829', '1', '149', '我们', '0', '[推荐盟友],激励0.001宝分', '0.001', '0.521', '0.522', '0.520', '0.000', '0.364', '0.156', '6', '176', null, '2017-05-12 16:57:33', '2017-05-12 16:57:33');
INSERT INTO `user_integral_log` VALUES ('830', '2', '87', '钱钱钱钱钱', '0', '广告费激励宝分', '0.001', '0.000', '0.000', '0.000', '0.102', '0.000', '0.000', '9', '0', null, '2017-05-12 17:02:45', '2017-05-12 17:02:45');
INSERT INTO `user_integral_log` VALUES ('831', '1', '160', '18850221107', '87', '抽成', '0.001', '0.070', '0.070', '0.000', '0.000', '0.070', '0.000', '13', '0', null, '2017-05-12 17:02:45', '2017-05-12 17:02:45');
INSERT INTO `user_integral_log` VALUES ('832', '1', '168', '欧欧欧欧', '87', '代理商抽成', '0.000', '0.042', '0.042', '0.000', '0.000', '0.042', '0.000', '14', '0', null, '2017-05-12 17:02:45', '2017-05-12 17:02:45');
INSERT INTO `user_integral_log` VALUES ('833', '1', '176', '我是昵称', '0', '消费0.01获得激励宝分', '0.010', '0.000', '0.000', '0.000', '0.030', '0.000', '0.000', '1', '0', null, '2017-05-12 17:02:45', '2017-05-12 17:02:45');
INSERT INTO `user_integral_log` VALUES ('834', '1', '149', '我们', '0', '[推荐盟友],激励0.001宝分', '0.001', '0.522', '0.523', '0.520', '0.000', '0.364', '0.156', '6', '176', null, '2017-05-12 17:02:45', '2017-05-12 17:02:45');
INSERT INTO `user_integral_log` VALUES ('835', '2', '87', '钱钱钱钱钱', '0', '广告费激励宝分', '0.001', '0.000', '0.000', '0.000', '0.103', '0.000', '0.000', '9', '0', null, '2017-05-12 17:05:35', '2017-05-12 17:05:35');
INSERT INTO `user_integral_log` VALUES ('836', '1', '160', '18850221107', '87', '抽成', '0.001', '0.070', '0.070', '0.000', '0.000', '0.070', '0.000', '13', '0', null, '2017-05-12 17:05:35', '2017-05-12 17:05:35');
INSERT INTO `user_integral_log` VALUES ('837', '1', '168', '欧欧欧欧', '87', '代理商抽成', '0.000', '0.042', '0.042', '0.000', '0.000', '0.042', '0.000', '14', '0', null, '2017-05-12 17:05:35', '2017-05-12 17:05:35');
INSERT INTO `user_integral_log` VALUES ('838', '1', '176', '我是昵称', '0', '消费0.01获得激励宝分', '0.010', '0.000', '0.000', '0.000', '0.040', '0.000', '0.000', '1', '0', null, '2017-05-12 17:05:35', '2017-05-12 17:05:35');
INSERT INTO `user_integral_log` VALUES ('839', '1', '149', '我们', '0', '[推荐盟友],激励0.001宝分', '0.001', '0.523', '0.524', '0.520', '0.000', '0.364', '0.156', '6', '176', null, '2017-05-12 17:05:35', '2017-05-12 17:05:35');
INSERT INTO `user_integral_log` VALUES ('840', '1', '171', '15870065122', '0', '消费0.01获得激励宝分', '0.010', '0.000', '0.000', '0.000', '0.010', '0.000', '0.000', '1', '0', null, '2017-05-12 17:13:54', '2017-05-12 17:13:54');
INSERT INTO `user_integral_log` VALUES ('841', '1', '170', '18030312046', '0', '[推荐盟友],激励0.001宝分', '0.001', '0.000', '0.001', '0.000', '0.000', '0.000', '0.000', '6', '171', null, '2017-05-12 17:13:54', '2017-05-12 17:13:54');
INSERT INTO `user_integral_log` VALUES ('842', '1', '171', '15870065122', '0', '签到获得宝分', '0.010', '0.000', '0.010', '0.010', '0.000', '0.007', '0.003', '7', '0', null, '2017-05-12 17:14:27', '2017-05-12 17:14:27');
INSERT INTO `user_integral_log` VALUES ('844', '1', '151', '15870065127', '0', '签到获得宝分', '0.500', '0.500', '1.000', '8001.000', '887.010', '0.700', '0.300', '7', '0', null, '2017-05-12 18:02:58', '2017-05-12 18:02:58');
INSERT INTO `user_integral_log` VALUES ('845', '1', '166', '叶莉', '0', '签到获得宝分', '0.500', '100.000', '100.500', '0.500', '99.500', '20.350', '80.150', '7', '0', null, '2017-05-12 18:21:12', '2017-05-12 18:21:12');
INSERT INTO `user_integral_log` VALUES ('846', '2', '87', '钱钱钱钱钱', '0', '商家签到获得宝分', '8.000', '100.000', '108.000', '8.000', '92.000', '0.000', '0.000', '10', '0', null, '2017-05-12 18:21:12', '2017-05-12 18:21:12');
INSERT INTO `user_integral_log` VALUES ('847', '2', '87', '钱钱钱钱钱', '0', '[宝分兑换]', '100.000', '108.000', '8.000', '8.000', '92.000', '0.000', '0.000', '12', '0', null, '2017-05-12 18:25:22', '2017-05-12 18:25:22');
INSERT INTO `user_integral_log` VALUES ('908', '1', '166', '叶莉', '0', '消费0.01获得激励宝分', '0.010', '100.500', '100.500', '0.500', '99.510', '20.350', '80.150', '1', '0', null, '2017-05-15 09:52:51', '2017-05-15 09:52:51');
INSERT INTO `user_integral_log` VALUES ('909', '1', '171', '15870065122', '0', '消费0.01获得激励宝分', '0.010', '0.010', '0.010', '0.010', '0.010', '0.007', '0.003', '1', '0', null, '2017-05-15 09:52:53', '2017-05-15 09:52:53');
INSERT INTO `user_integral_log` VALUES ('910', '1', '170', '18030312046', '0', '[推荐宝友],激励0.001宝分', '0.001', '0.001', '0.002', '0.000', '0.000', '0.000', '0.000', '6', '171', null, '2017-05-15 09:52:53', '2017-05-15 09:52:53');
INSERT INTO `user_integral_log` VALUES ('911', '1', '171', '15870065122', '0', '消费0.01获得激励宝分', '0.010', '0.010', '0.010', '0.010', '0.020', '0.007', '0.003', '1', '0', null, '2017-05-15 09:53:22', '2017-05-15 09:53:22');
INSERT INTO `user_integral_log` VALUES ('912', '1', '170', '18030312046', '0', '[推荐宝友],激励0.001宝分', '0.001', '0.002', '0.003', '0.000', '0.000', '0.000', '0.000', '6', '171', null, '2017-05-15 09:53:22', '2017-05-15 09:53:22');
INSERT INTO `user_integral_log` VALUES ('913', '2', '84', '我要开店', '0', '广告费激励宝分', '0.010', '0.000', '0.000', '0.000', '0.051', '0.000', '0.000', '9', '0', null, '2017-05-15 09:53:53', '2017-05-15 09:53:53');
INSERT INTO `user_integral_log` VALUES ('914', '1', '160', '18850221107', '84', '抽成', '0.005', '0.070', '0.075', '0.000', '0.000', '0.075', '0.000', '13', '0', null, '2017-05-15 09:53:53', '2017-05-15 09:53:53');
INSERT INTO `user_integral_log` VALUES ('915', '1', '168', '欧欧欧欧', '84', '代理商抽成', '0.003', '0.042', '0.045', '0.000', '0.000', '0.045', '0.000', '14', '0', null, '2017-05-15 09:53:53', '2017-05-15 09:53:53');
INSERT INTO `user_integral_log` VALUES ('916', '1', '148', '阿萨德飒沓', '0', '消费0.1获得激励宝分', '0.100', '0.000', '0.000', '0.000', '0.300', '0.000', '0.000', '1', '0', null, '2017-05-15 09:53:53', '2017-05-15 09:53:53');
INSERT INTO `user_integral_log` VALUES ('917', '1', '146', '18850221114', '0', '[推荐宝友],激励0.01宝分', '0.010', '45.020', '45.030', '0.000', '0.000', '31.521', '13.509', '6', '148', null, '2017-05-15 09:53:53', '2017-05-15 09:53:53');
INSERT INTO `user_integral_log` VALUES ('918', '1', '142', '18850221111', '0', '[推荐宝友],激励0.008宝分', '0.008', '36.016', '36.024', '0.000', '0.000', '25.216', '10.806', '6', '148', null, '2017-05-15 09:53:53', '2017-05-15 09:53:53');
INSERT INTO `user_integral_log` VALUES ('919', '1', '177', '18250815530', '0', '消费0.01获得激励宝分', '0.010', '0.500', '0.500', '0.500', '2.510', '0.350', '0.150', '1', '0', null, '2017-05-15 09:57:15', '2017-05-15 09:57:15');
INSERT INTO `user_integral_log` VALUES ('920', '1', '166', '叶莉', '0', '[推荐宝友],激励0.001宝分', '0.001', '100.500', '100.501', '0.500', '99.510', '20.350', '80.150', '6', '177', null, '2017-05-15 09:57:15', '2017-05-15 09:57:15');
INSERT INTO `user_integral_log` VALUES ('921', '1', '159', '18960688757', '0', '消费238获得激励宝分', '238.000', '0.000', '0.000', '0.000', '238.000', '0.000', '0.000', '1', '0', null, '2017-05-15 10:16:34', '2017-05-15 10:16:34');
INSERT INTO `user_integral_log` VALUES ('922', '1', '166', '叶莉', '0', '签到获得宝分', '0.500', '300.501', '301.001', '1.000', '299.010', '20.700', '80.300', '7', '0', null, '2017-05-15 11:47:43', '2017-05-15 11:47:43');
INSERT INTO `user_integral_log` VALUES ('923', '2', '87', '钱钱钱钱钱', '0', '商家签到获得宝分', '8.000', '8.000', '16.000', '16.000', '84.000', '0.000', '0.000', '10', '0', null, '2017-05-15 11:47:43', '2017-05-15 11:47:43');
INSERT INTO `user_integral_log` VALUES ('924', '1', '177', '18250815530', '0', '签到获得宝分', '0.500', '0.500', '1.000', '1.000', '202.010', '0.700', '0.300', '7', '0', null, '2017-05-15 13:57:09', '2017-05-15 13:57:09');
INSERT INTO `user_integral_log` VALUES ('925', '2', '87', '钱钱钱钱钱', '0', '广告费激励宝分', '1.000', '16.000', '16.000', '16.000', '85.000', '0.000', '0.000', '9', '0', null, '2017-05-15 16:27:12', '2017-05-15 16:27:12');
INSERT INTO `user_integral_log` VALUES ('926', '1', '160', '18850221107', '87', '抽成', '0.500', '0.075', '0.575', '0.000', '0.000', '0.575', '0.000', '13', '0', null, '2017-05-15 16:27:12', '2017-05-15 16:27:12');
INSERT INTO `user_integral_log` VALUES ('927', '1', '168', '欧欧欧欧', '87', '代理商抽成', '0.300', '0.045', '0.345', '0.000', '0.000', '0.345', '0.000', '14', '0', null, '2017-05-15 16:27:12', '2017-05-15 16:27:12');
INSERT INTO `user_integral_log` VALUES ('928', '1', '177', '夜里', '0', '消费10.00获得激励宝分', '10.000', '1.000', '1.000', '1.000', '212.010', '0.700', '0.300', '1', '0', null, '2017-05-15 16:27:12', '2017-05-15 16:27:12');
INSERT INTO `user_integral_log` VALUES ('929', '1', '166', '叶莉', '0', '[推荐宝友],激励1宝分', '1.000', '301.001', '302.001', '1.000', '299.010', '21.400', '80.600', '6', '177', null, '2017-05-15 16:27:12', '2017-05-15 16:27:12');
INSERT INTO `user_integral_log` VALUES ('930', '2', '87', '钱钱钱钱钱', '0', '广告费激励宝分', '0.500', '16.000', '16.000', '16.000', '85.500', '0.000', '0.000', '9', '0', null, '2017-05-15 17:44:30', '2017-05-15 17:44:30');
INSERT INTO `user_integral_log` VALUES ('931', '1', '160', '18850221107', '87', '抽成', '0.250', '0.575', '0.825', '0.000', '0.000', '0.825', '0.000', '13', '0', null, '2017-05-15 17:44:30', '2017-05-15 17:44:30');
INSERT INTO `user_integral_log` VALUES ('932', '1', '168', '欧欧欧欧', '87', '代理商抽成', '0.150', '0.345', '0.495', '0.000', '0.000', '0.495', '0.000', '14', '0', null, '2017-05-15 17:44:30', '2017-05-15 17:44:30');
INSERT INTO `user_integral_log` VALUES ('933', '1', '177', '夜里', '0', '消费5.00获得激励宝分', '5.000', '1.000', '1.000', '1.000', '217.010', '0.700', '0.300', '1', '0', null, '2017-05-15 17:44:30', '2017-05-15 17:44:30');
INSERT INTO `user_integral_log` VALUES ('934', '1', '166', '叶莉', '0', '[推荐宝友],激励0.5宝分', '0.500', '302.001', '302.501', '1.000', '299.010', '21.750', '80.750', '6', '177', null, '2017-05-15 17:44:30', '2017-05-15 17:44:30');
INSERT INTO `user_integral_log` VALUES ('935', '2', '57', '测试店铺', '0', '广告费激励宝分', '0.010', '0.000', '0.000', '0.000', '0.010', '0.000', '0.000', '9', '0', null, '2017-05-15 17:54:04', '2017-05-15 17:54:04');
INSERT INTO `user_integral_log` VALUES ('936', '1', '180', '15970172573', '0', '消费0.10获得激励宝分', '0.100', '0.000', '0.000', '0.000', '0.100', '0.000', '0.000', '1', '0', null, '2017-05-15 17:54:05', '2017-05-15 17:54:05');
INSERT INTO `user_integral_log` VALUES ('937', '1', '149', '我们', '0', '[推荐宝友],激励0.01宝分', '0.010', '0.524', '0.534', '0.520', '0.000', '0.371', '0.159', '6', '180', null, '2017-05-15 17:54:05', '2017-05-15 17:54:05');
INSERT INTO `user_integral_log` VALUES ('939', '2', '57', '测试店铺', '0', '广告费激励宝分', '0.010', '0.000', '0.000', '0.000', '0.020', '0.000', '0.000', '9', '0', null, '2017-05-15 18:07:57', '2017-05-15 18:07:57');
INSERT INTO `user_integral_log` VALUES ('940', '1', '180', '15970172573', '0', '消费0.10获得激励宝分', '0.100', '0.000', '0.000', '0.000', '0.200', '0.000', '0.000', '1', '0', null, '2017-05-15 18:07:57', '2017-05-15 18:07:57');
INSERT INTO `user_integral_log` VALUES ('941', '1', '149', '我们', '0', '[推荐宝友],激励0.01宝分', '0.010', '0.534', '0.544', '0.520', '0.000', '0.378', '0.162', '6', '180', null, '2017-05-15 18:07:57', '2017-05-15 18:07:57');
INSERT INTO `user_integral_log` VALUES ('942', '2', '57', '测试店铺', '0', '广告费激励宝分', '0.010', '0.000', '0.000', '0.000', '0.030', '0.000', '0.000', '9', '0', null, '2017-05-15 18:08:33', '2017-05-15 18:08:33');
INSERT INTO `user_integral_log` VALUES ('943', '1', '180', '15970172573', '0', '消费0.10获得激励宝分', '0.100', '0.000', '0.000', '0.000', '0.300', '0.000', '0.000', '1', '0', null, '2017-05-15 18:08:33', '2017-05-15 18:08:33');
INSERT INTO `user_integral_log` VALUES ('944', '1', '149', '我们', '0', '[推荐宝友],激励0.01宝分', '0.010', '0.544', '0.554', '0.520', '0.000', '0.385', '0.165', '6', '180', null, '2017-05-15 18:08:33', '2017-05-15 18:08:33');
INSERT INTO `user_integral_log` VALUES ('945', '2', '57', '测试店铺', '0', '广告费激励宝分', '0.010', '0.000', '0.000', '0.000', '0.040', '0.000', '0.000', '9', '0', null, '2017-05-15 18:10:05', '2017-05-15 18:10:05');
INSERT INTO `user_integral_log` VALUES ('946', '1', '180', '15970172573', '0', '消费0.10获得激励宝分', '0.100', '0.000', '0.000', '0.000', '0.400', '0.000', '0.000', '1', '0', null, '2017-05-15 18:10:05', '2017-05-15 18:10:05');
INSERT INTO `user_integral_log` VALUES ('947', '1', '149', '我们', '0', '[推荐宝友],激励0.01宝分', '0.010', '0.554', '0.564', '0.520', '0.000', '0.392', '0.168', '6', '180', null, '2017-05-15 18:10:05', '2017-05-15 18:10:05');
INSERT INTO `user_integral_log` VALUES ('950', '1', '166', '叶莉', '0', '签到获得宝分', '0.500', '302.501', '303.001', '1.500', '298.510', '22.100', '80.900', '7', '0', null, '2017-05-16 10:08:39', '2017-05-16 10:08:39');
INSERT INTO `user_integral_log` VALUES ('951', '2', '87', '钱钱钱钱钱', '0', '商家签到获得宝分', '8.000', '16.000', '24.000', '24.000', '77.500', '0.000', '0.000', '10', '0', null, '2017-05-16 10:08:39', '2017-05-16 10:08:39');
INSERT INTO `user_integral_log` VALUES ('952', '1', '177', '夜里', '0', '签到获得宝分', '0.000', '1.000', '1.000', '1.000', '217.010', '0.700', '0.300', '7', '0', null, '2017-05-16 10:12:15', '2017-05-16 10:12:15');
INSERT INTO `user_integral_log` VALUES ('953', '1', '170', '18030312046', '0', '签到获得宝分', '0.500', '0.003', '0.503', '0.500', '199.500', '0.350', '0.150', '7', '0', null, '2017-05-16 10:19:08', '2017-05-16 10:19:08');
INSERT INTO `user_integral_log` VALUES ('954', '1', '139', '我的刚刚', '0', '签到获得宝分', '1.500', '99903.500', '99905.000', '3012.000', '3988.200', '90002.100', '0.900', '7', '0', null, '2017-05-16 10:26:28', '2017-05-16 10:26:28');
INSERT INTO `user_integral_log` VALUES ('955', '2', '91', '耶', '0', '广告费激励宝分', '0.100', '0.000', '0.000', '0.000', '0.100', '0.000', '0.000', '9', '0', null, '2017-05-16 10:55:18', '2017-05-16 10:55:18');
INSERT INTO `user_integral_log` VALUES ('956', '1', '166', '叶莉', '91', '抽成', '0.050', '303.001', '303.051', '1.500', '298.510', '22.150', '80.900', '13', '0', null, '2017-05-16 10:55:18', '2017-05-16 10:55:18');
INSERT INTO `user_integral_log` VALUES ('957', '1', '154', '123', '91', '代理商抽成', '0.030', '0.000', '0.030', '0.000', '0.000', '0.030', '0.000', '14', '0', null, '2017-05-16 10:55:18', '2017-05-16 10:55:18');
INSERT INTO `user_integral_log` VALUES ('958', '1', '177', '夜里', '0', '消费1获得激励宝分', '1.000', '1.000', '1.000', '1.000', '218.010', '0.700', '0.300', '1', '0', null, '2017-05-16 10:55:18', '2017-05-16 10:55:18');
INSERT INTO `user_integral_log` VALUES ('959', '1', '166', '叶莉', '0', '[推荐宝友],激励0.1宝分', '0.100', '303.051', '303.151', '1.500', '298.510', '22.220', '80.930', '6', '177', null, '2017-05-16 10:55:18', '2017-05-16 10:55:18');
INSERT INTO `user_integral_log` VALUES ('960', '2', '91', '耶', '0', '广告费激励宝分', '0.500', '0.000', '0.000', '0.000', '0.600', '0.000', '0.000', '9', '0', null, '2017-05-16 10:59:55', '2017-05-16 10:59:55');
INSERT INTO `user_integral_log` VALUES ('961', '1', '166', '叶莉', '91', '抽成', '0.250', '303.151', '303.401', '1.500', '298.510', '22.470', '80.930', '13', '0', null, '2017-05-16 10:59:55', '2017-05-16 10:59:55');
INSERT INTO `user_integral_log` VALUES ('962', '1', '154', '123', '91', '代理商抽成', '0.150', '0.030', '0.180', '0.000', '0.000', '0.180', '0.000', '14', '0', null, '2017-05-16 10:59:55', '2017-05-16 10:59:55');
INSERT INTO `user_integral_log` VALUES ('963', '1', '177', '夜里', '0', '消费5.00获得激励宝分', '5.000', '1.000', '1.000', '1.000', '223.010', '0.700', '0.300', '1', '0', null, '2017-05-16 10:59:55', '2017-05-16 10:59:55');
INSERT INTO `user_integral_log` VALUES ('964', '1', '166', '叶莉', '0', '[推荐宝友],激励0.5宝分', '0.500', '303.401', '303.901', '1.500', '298.510', '22.820', '81.080', '6', '177', null, '2017-05-16 10:59:55', '2017-05-16 10:59:55');
INSERT INTO `user_integral_log` VALUES ('1017', '1', '176', '我是昵称', '0', '签到获得宝分', '0.500', '0.000', '0.500', '0.500', '201.540', '0.350', '0.150', '7', '0', null, '2017-05-16 17:10:50', '2017-05-16 17:10:50');
INSERT INTO `user_integral_log` VALUES ('1022', '1', '139', '我的刚刚', '0', '签到获得宝分', '1.500', '99905.000', '99906.500', '3013.500', '3986.700', '90003.150', '1.350', '7', '0', null, '2017-05-17 14:04:25', '2017-05-17 14:04:25');
INSERT INTO `user_integral_log` VALUES ('1023', '1', '176', '我是昵称', '0', '签到获得宝分', '0.500', '0.500', '1.000', '1.000', '201.040', '0.700', '0.300', '7', '0', null, '2017-05-17 14:24:46', '2017-05-17 14:24:46');
INSERT INTO `user_integral_log` VALUES ('1026', '1', '139', '我的刚刚', '0', '签到获得宝分', '1.500', '99906.500', '99908.000', '3015.000', '3985.200', '90004.200', '1.800', '7', '0', null, '2017-05-18 10:56:20', '2017-05-18 10:56:20');
INSERT INTO `user_integral_log` VALUES ('1027', '1', '166', '叶莉', '0', '签到获得宝分', '0.500', '303.901', '304.401', '2.000', '298.010', '23.170', '81.230', '7', '0', null, '2017-05-18 16:34:31', '2017-05-18 16:34:31');
INSERT INTO `user_integral_log` VALUES ('1028', '1', '176', '我是昵称', '0', '签到获得宝分', '0.500', '1.000', '1.500', '1.500', '200.540', '1.050', '0.450', '7', '0', null, '2017-05-18 16:37:36', '2017-05-18 16:37:36');
INSERT INTO `user_integral_log` VALUES ('1029', '2', '87', '钱钱钱钱钱', '0', '商家签到获得宝分', '7.200', '24.000', '31.200', '31.200', '70.300', '0.000', '0.000', '10', '0', null, '2017-05-18 16:39:02', '2017-05-18 16:39:02');
INSERT INTO `user_integral_log` VALUES ('1038', '1', '166', '叶莉', '0', '签到获得宝分', '0.500', '304.401', '304.901', '2.500', '297.510', '23.520', '81.380', '7', '0', null, '2017-05-22 11:49:06', '2017-05-22 11:49:06');
INSERT INTO `user_integral_log` VALUES ('1039', '2', '87', '钱钱钱钱钱', '0', '商家签到获得宝分', '7.200', '31.200', '38.400', '38.400', '63.100', '0.000', '0.000', '10', '0', null, '2017-05-22 11:49:09', '2017-05-22 11:49:09');
INSERT INTO `user_integral_log` VALUES ('1040', '1', '139', '我的刚刚', '0', '签到获得宝分', '1.500', '99908.000', '99909.500', '3016.500', '3983.700', '90005.250', '2.250', '7', '0', null, '2017-05-22 14:18:40', '2017-05-22 14:18:40');
INSERT INTO `user_integral_log` VALUES ('1061', '1', '151', '15870065127', '0', '签到获得宝分', '0.500', '1.000', '1.500', '8001.500', '886.510', '1.050', '0.450', '7', '0', null, '2017-06-01 14:22:27', '2017-06-01 14:22:27');
INSERT INTO `user_integral_log` VALUES ('1064', '1', '139', '我的刚刚', '0', '签到获得宝分', '1.500', '99909.500', '99911.000', '3018.000', '3982.200', '90006.300', '2.700', '7', '0', null, '2017-06-02 10:33:05', '2017-06-02 10:33:05');
INSERT INTO `user_integral_log` VALUES ('1065', '1', '176', '我是昵称', '0', '签到获得宝分', '0.500', '1.500', '2.000', '2.000', '200.040', '1.400', '0.600', '7', '0', null, '2017-06-02 11:51:53', '2017-06-02 11:51:53');
INSERT INTO `user_integral_log` VALUES ('1086', '1', '139', '我的刚刚', '0', '签到获得宝分', '1.500', '99911.000', '99912.500', '3019.500', '3980.700', '90007.350', '3.150', '7', '0', null, '2017-06-12 09:52:15', '2017-06-12 09:52:15');
INSERT INTO `user_integral_log` VALUES ('1099', '1', '177', '夜里', '0', '消费宝分', '0.010', '1.000', '0.990', '1.000', '223.010', '0.700', '0.000', '5', '0', null, '2017-06-21 16:46:37', '2017-06-21 16:46:37');
INSERT INTO `user_integral_log` VALUES ('1102', '1', '186', '13106254510', '0', '[宝分兑换]', '-200.000', '0.000', '200.000', '0.000', '0.000', '200.000', '0.000', '2', '0', null, '2017-06-22 15:08:52', '2017-06-22 15:08:52');
INSERT INTO `user_integral_log` VALUES ('1103', '1', '186', '13106254510', '0', '[宝分兑换]', '200.000', '200.000', '0.000', '0.000', '0.000', '0.000', '0.000', '2', '0', null, '2017-06-22 15:09:29', '2017-06-22 15:09:29');
INSERT INTO `user_integral_log` VALUES ('1126', '1', '187', '15985775888', '0', '消费0.01获得激励宝分', '0.010', '0.000', '0.000', '0.000', '0.010', '0.000', '0.000', '1', '0', null, '2017-07-03 19:56:45', '2017-07-03 19:56:45');
INSERT INTO `user_integral_log` VALUES ('1143', '1', '139', '我的刚刚', '0', '签到获得宝分', '1.500', '99912.500', '99914.000', '3021.000', '3979.200', '90008.400', '3.600', '7', '0', null, '2017-07-11 14:31:20', '2017-07-11 14:31:20');
INSERT INTO `user_integral_log` VALUES ('1210', '2', '87', '周大福(竹屿路泰禾分店)', '0', '广告费激励宝分', '0.010', '38.400', '38.400', '38.400', '63.110', '0.000', '0.000', '9', '0', null, '2017-08-13 18:47:54', '2017-08-13 18:47:54');
INSERT INTO `user_integral_log` VALUES ('1211', '1', '160', '18850221107', '87', '抽成', '0.005', '0.825', '0.830', '0.000', '0.000', '0.830', '0.000', '13', '0', null, '2017-08-13 18:47:55', '2017-08-13 18:47:55');
INSERT INTO `user_integral_log` VALUES ('1212', '1', '168', '欧欧欧欧', '87', '代理商抽成', '0.003', '0.495', '0.498', '0.000', '0.000', '0.498', '0.000', '14', '0', null, '2017-08-13 18:47:55', '2017-08-13 18:47:55');
INSERT INTO `user_integral_log` VALUES ('1213', '1', '176', '我是昵称', '0', '消费0.1获得激励宝分', '0.100', '2.000', '2.000', '2.000', '200.140', '1.400', '0.600', '1', '0', null, '2017-08-13 18:47:55', '2017-08-13 18:47:55');
INSERT INTO `user_integral_log` VALUES ('1214', '1', '149', '我们', '0', '[推荐宝友],激励0.01宝分', '0.010', '0.564', '0.574', '0.520', '0.000', '0.399', '0.171', '6', '176', null, '2017-08-13 18:47:55', '2017-08-13 18:47:55');

-- ----------------------------
-- Table structure for user_receipt
-- ----------------------------
DROP TABLE IF EXISTS `user_receipt`;
CREATE TABLE `user_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `access_token` varchar(255) NOT NULL DEFAULT '' COMMENT '用户token',
  `name` varchar(20) NOT NULL COMMENT '收货姓名',
  `province` varchar(20) NOT NULL COMMENT '收货省份',
  `city` varchar(20) NOT NULL COMMENT '收货城市',
  `area` varchar(20) NOT NULL DEFAULT '' COMMENT '区域',
  `phone` varchar(12) NOT NULL COMMENT '收货手机号码或者电话号码 带-',
  `address` varchar(100) NOT NULL COMMENT '详细地址',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否默认：1默认0不默认',
  `access_key` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`access_token`) USING BTREE,
  KEY `access_key` (`access_key`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_receipt
-- ----------------------------
INSERT INTO `user_receipt` VALUES ('13', '27', '2', '大帅哥', '福建', '厦门', '湖里区', '17759413687', '是的发送到', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('17', '20', '6452def18ddd515081420dcad', 'xrf', '福建省', '泉州市', '', '18855668596', '南安11', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('20', '34', '9bfb0e800502146fead7eb3796990981', '年年有鱼', '福建省', '厦门市', '湖里区', '18850223235', '安岭路987号', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('22', '34', '9bfb0e800502146fead7eb3796990981', '余生', '福建', '厦门', '湖里区', '13859679874', '中宅民族艺术幼儿园旁', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('108', '34', '9bfb0e800502146fead7eb3796990981', '你', '天津', '南开区', '', '15359225953', '发布', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('109', '34', '9bfb0e800502146fead7eb3796990981', '啦啦', '河北', '邯郸', '邯郸县', '15359225953', '啦啦啦', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('111', '32', '97162b5fccc17a3cdc2d0ea4a3e6c72e', '李', '上海', '徐汇区城区', '', '15260220530', '1202', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('113', '44', 'c78a236bf7298f7cdef6a6cae5641065', '哈哈哈', '内蒙古', '呼和浩特', '回民区', '05921234561', '青藏高原', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('114', '41', '33b44ffd73fda3f841775f4cc21e22d6', '刘季萌', '福建', '厦门', '湖里区', '15711511024', '裕隆国际1号楼703', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('115', '47', '51ae10730e316f1f90bb971578429cdb', 'wl', '内蒙古', '包头市土默特右旗美岱召镇', '', '123456789', '703', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('116', '46', 'b08a384b204308f02eed1899dc807653', '123', '福建', '厦门市湖里区', '', '18030312046', '裕隆国际大厦', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('117', '46', 'b08a384b204308f02eed1899dc807653', '321', '福建', '福州市鼓楼区城区', '', '18030312046', '鼓东路65号', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('118', '47', '51ae10730e316f1f90bb971578429cdb', 'wl', '北京', '朝阳区三环以内', '', '123', '703', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('119', '48', '47674891f798c2decf8fdbc1d49ba223', '琳琳', '福建', '厦门', '湖里区', '13365902133', '裕隆国际大厦', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('120', '35', '9fc76cc68a95c03458c864514c59d261', '11', '内蒙古', '包头', '石拐区', '15359225953', 'Dad wee', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('121', '43', '9c6ea7b0b516491b841abccfbbc8c68f', '陈述', '福建', '厦门', '思明区', '18030206067', '安岭路', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('143', '41', '33b44ffd73fda3f841775f4cc21e22d6', '刘季萌', '福建', '厦门', '思明区', '15711511024', '啊啊啊', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('144', '54', 'c262704ce095336a21a30a7655f37dd6', '武丽云', '福建', '厦门', '湖里区', '13696994439', '湖里大道80号', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('145', '49', 'ba41fc6113968d17caffe938e61f7c43', '厦门1', '上海', '黄浦区城区', '', '1', '把', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('146', '34', '9bfb0e800502146fead7eb3796990981', 'Hejiangwei', '北京', '崇文区', '', '15359225953', 'Shang Ian and', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('148', '57', '2625992c9b5d0b51716b098c96de7d2e', '王亮', '天津', '西青区杨柳青', '', '13102057257', '哈哈哈', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('150', '40', '65e1c7c9a099ffdab2fbd5b8f0630cab', '余小生', '福建', '厦门', '湖里区', '18850223235', '钟宅民族小学旁987号', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('152', '39', 'c5572123b1ef4afce58c190c62c4e446', 'ghh', '重庆', '潼南县宝龙镇', '', '15259205640', 'vgghj', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('153', '65', '0efa4e7597e8c910e331c621339639ad', 'yuyu', '北京', '朝阳区三环以内', '', '15005151855', 'bbvbbbvccccf', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('154', '32', '97162b5fccc17a3cdc2d0ea4a3e6c72e', '吴兰芳', '河北', '石家庄', '长安区', '15870065127', 'fdsfs32', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('156', '32', '97162b5fccc17a3cdc2d0ea4a3e6c72e', 'aa', '北京', '', '东城区', '123456', 'aa123', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('157', '32', '97162b5fccc17a3cdc2d0ea4a3e6c72e', 'bb', '北京', '', '密云县', '123456', 'bb123', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('159', '32', '97162b5fccc17a3cdc2d0ea4a3e6c72e', 'dd', '北京', '', '东城区', '123456', 'dew342432', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('160', '81', '83edb796a0360af1e0c568c364896264', '吴兰芳', '北京', '', '东城区', '15870065127', '123号', '1', '1c694c95');
INSERT INTO `user_receipt` VALUES ('161', '120', 'b4a04598f74abbe23e85969ee8be20cc', '吴兰芳', '北京', '', '东城区', '15870065127', '100号', '1', '1c694c95');
INSERT INTO `user_receipt` VALUES ('162', '121', 'aaed2ee7ab081aa4088c418410af3792', '吴兰芳', '山西', '太原', '小店区', '4354532', '100号', '1', '1c694c95');
INSERT INTO `user_receipt` VALUES ('163', '121', 'aaed2ee7ab081aa4088c418410af3792', '吴兰芳123', '山西', '长治', '屯留县', '15870065127', '120号', '1', '1c694c95');
INSERT INTO `user_receipt` VALUES ('170', '53', '85e328d21103ec1d225d57d6b176c040', '李新春', '福建', '福州市鼓楼区洪山镇', '', '13306935999', '176', '1', '1C694C95');
INSERT INTO `user_receipt` VALUES ('235', '134', '21193d182b000baa3942b1fb309f65db', '153592', '北京', '东城区', '', '15359225693', '12fd545', '1', null);
INSERT INTO `user_receipt` VALUES ('239', '150', '4239f221be9f50d948633c6f86bd1d77', '我', '福建', '厦门', '湖里区', '18250815530', '你', '1', null);
INSERT INTO `user_receipt` VALUES ('243', '164', '10006a2cbfb7467e9148b3d4c5bcac79', '叶', '福建', '厦门', '湖里区', '18250815530', '我', '0', null);
INSERT INTO `user_receipt` VALUES ('244', '164', '10006a2cbfb7467e9148b3d4c5bcac79', '叶', '福建', '厦门市湖里区', '0', '18250815530', '微', '0', null);
INSERT INTO `user_receipt` VALUES ('245', '164', '10006a2cbfb7467e9148b3d4c5bcac79', '叶', '福建', '厦门', '湖里区', '18066585245', '是', '1', null);
INSERT INTO `user_receipt` VALUES ('249', '196', '2be7a09f9a0d754938fca490c3ff9861', '张智远', '福建', '厦门市湖里区', '0', '18030318430', '金海湾财富中心3号305室', '1', null);

-- ----------------------------
-- Table structure for user_relations
-- ----------------------------
DROP TABLE IF EXISTS `user_relations`;
CREATE TABLE `user_relations` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分销等级',
  `pid` int(13) NOT NULL DEFAULT '0' COMMENT '上级id',
  `child_id` int(132) NOT NULL DEFAULT '0' COMMENT '下属id',
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='分销关系';

-- ----------------------------
-- Records of user_relations
-- ----------------------------
INSERT INTO `user_relations` VALUES ('12', '2', '142', '146', '2017-04-26 10:00:18', '2017-04-26 10:00:18');
INSERT INTO `user_relations` VALUES ('13', '2', '146', '147', '2017-04-26 10:01:07', '2017-04-26 10:01:07');
INSERT INTO `user_relations` VALUES ('14', '3', '142', '147', '2017-04-26 10:01:07', '2017-04-26 10:01:07');
INSERT INTO `user_relations` VALUES ('15', '2', '146', '148', '2017-04-27 11:38:37', '2017-04-27 11:38:37');
INSERT INTO `user_relations` VALUES ('16', '3', '142', '148', '2017-04-27 11:38:38', '2017-04-27 11:38:38');
INSERT INTO `user_relations` VALUES ('17', '2', '153', '160', '2017-05-10 10:22:10', '2017-05-10 10:22:10');
INSERT INTO `user_relations` VALUES ('18', '2', '160', '161', '2017-05-10 10:23:50', '2017-05-10 10:23:50');
INSERT INTO `user_relations` VALUES ('19', '3', '153', '161', '2017-05-10 10:23:50', '2017-05-10 10:23:50');
INSERT INTO `user_relations` VALUES ('20', '2', '170', '171', '2017-05-12 13:56:15', '2017-05-12 13:56:15');
INSERT INTO `user_relations` VALUES ('21', '2', '170', '172', '2017-05-12 13:58:51', '2017-05-12 13:58:51');
INSERT INTO `user_relations` VALUES ('22', '2', '149', '176', '2017-05-12 14:32:38', '2017-05-12 14:32:38');
INSERT INTO `user_relations` VALUES ('23', '2', '166', '177', '2017-05-12 14:38:34', '2017-05-12 14:38:34');
INSERT INTO `user_relations` VALUES ('24', '2', '176', '178', '2017-05-12 14:39:58', '2017-05-12 14:39:58');
INSERT INTO `user_relations` VALUES ('25', '3', '149', '178', '2017-05-12 14:39:58', '2017-05-12 14:39:58');
INSERT INTO `user_relations` VALUES ('27', '2', '149', '180', '2017-05-12 15:28:48', '2017-05-12 15:28:48');
INSERT INTO `user_relations` VALUES ('28', '2', '170', '181', '2017-05-12 17:54:59', '2017-05-12 17:54:59');
INSERT INTO `user_relations` VALUES ('29', '2', '183', '184', '2017-06-08 22:46:32', '2017-06-08 22:46:32');
INSERT INTO `user_relations` VALUES ('30', '2', '198', '199', '2018-10-10 17:57:51', '2018-10-10 17:57:51');
INSERT INTO `user_relations` VALUES ('31', '2', '197', '208', '2018-10-11 14:21:19', '2018-10-11 14:21:19');
INSERT INTO `user_relations` VALUES ('32', '2', '196', '209', '2018-10-11 23:27:01', '2018-10-11 23:27:01');
