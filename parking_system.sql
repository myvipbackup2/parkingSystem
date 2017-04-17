/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : parking_system

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2017-04-17 19:58:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `real_name` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码（需要md5加密）',
  `tel` varchar(255) DEFAULT NULL COMMENT '联系电话',
  `level` int(1) DEFAULT NULL COMMENT '权限',
  `img_src` varchar(255) DEFAULT NULL,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `open_id` varchar(255) DEFAULT NULL COMMENT '微信open_id',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='管理员信息表';

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('21', 'admin', '管理员test', 'admin', '13895752345', '1', 'images/photos/user1.png', '2017-02-15 22:53:20', null);
INSERT INTO `t_admin` VALUES ('38', 'zhangsan', '张三', '1234', '13012362374', '3', 'images/photos/user2.png', '2017-02-15 23:34:02', null);
INSERT INTO `t_admin` VALUES ('47', 'lisi', '李四', '1234', '13904514567', '3', 'images/photos/user3.png', '2017-02-27 16:27:46', null);

-- ----------------------------
-- Table structure for t_cancel
-- ----------------------------
DROP TABLE IF EXISTS `t_cancel`;
CREATE TABLE `t_cancel` (
  `cancel_id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` text COMMENT '取消原因',
  `order_id` int(11) DEFAULT NULL COMMENT '订单编号',
  `cancel_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `cancel_status` varchar(10) DEFAULT '未处理' COMMENT '取消状态（同意|拒绝|未处理）',
  PRIMARY KEY (`cancel_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_cancel_fk` FOREIGN KEY (`order_id`) REFERENCES `t_order` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单取消记录表';

-- ----------------------------
-- Records of t_cancel
-- ----------------------------

-- ----------------------------
-- Table structure for t_checkin
-- ----------------------------
DROP TABLE IF EXISTS `t_checkin`;
CREATE TABLE `t_checkin` (
  `checkin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '入住人姓名',
  `id_card` varchar(255) DEFAULT NULL COMMENT '入住人身份证',
  `tel` varchar(255) DEFAULT NULL COMMENT '入住人电话',
  `checkin_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '入住时间',
  `order_id` int(11) DEFAULT NULL COMMENT '关联订单id',
  PRIMARY KEY (`checkin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='入住信息记录表';

-- ----------------------------
-- Records of t_checkin
-- ----------------------------
INSERT INTO `t_checkin` VALUES ('1', 'asd ', 'qweqwe', 'qweqwe', '2017-02-22 20:08:50', '4');
INSERT INTO `t_checkin` VALUES ('2', 'qqq', 'qqq', 'qqq', '2017-02-22 20:09:44', '1');
INSERT INTO `t_checkin` VALUES ('3', 'dfafefefe', '1333333333333333333', '13232323232', '2017-03-07 11:36:46', '4');
INSERT INTO `t_checkin` VALUES ('4', 'fdafdafdsafd', '3333333333333333', '11111111111111', '2017-03-07 11:38:27', '4');
INSERT INTO `t_checkin` VALUES ('5', '', '', '', '2017-03-10 18:56:11', '8');
INSERT INTO `t_checkin` VALUES ('6', 'zs', '1234', '123', '2017-03-12 10:13:08', '8');
INSERT INTO `t_checkin` VALUES ('7', 'lisi', '2345', '234', '2017-03-12 10:13:08', '8');
INSERT INTO `t_checkin` VALUES ('8', 'wwww', '123', '123', '2017-03-12 11:43:10', '8');
INSERT INTO `t_checkin` VALUES ('9', 'aaa', '234', '234', '2017-03-12 11:43:10', '8');
INSERT INTO `t_checkin` VALUES ('10', '123', '123', '123', '2017-03-12 11:45:13', '8');
INSERT INTO `t_checkin` VALUES ('11', '456', '456', '456', '2017-03-12 11:45:13', '8');

-- ----------------------------
-- Table structure for t_collect
-- ----------------------------
DROP TABLE IF EXISTS `t_collect`;
CREATE TABLE `t_collect` (
  `collect_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `park_id` int(11) DEFAULT NULL COMMENT '房源id',
  `collect_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`collect_id`),
  KEY `user_id` (`user_id`),
  KEY `house_id` (`park_id`),
  CONSTRAINT `house_collect_fk` FOREIGN KEY (`park_id`) REFERENCES `t_park` (`park_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_collect_fk` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='收藏房源记录表';

-- ----------------------------
-- Records of t_collect
-- ----------------------------
INSERT INTO `t_collect` VALUES ('2', '2', '2', '2017-02-05 16:05:39');
INSERT INTO `t_collect` VALUES ('3', '3', '3', '2017-02-05 16:05:45');
INSERT INTO `t_collect` VALUES ('4', '1', '2', '2017-02-05 16:06:02');
INSERT INTO `t_collect` VALUES ('7', '1', '3', '2017-02-05 23:33:03');
INSERT INTO `t_collect` VALUES ('8', '37', '2', '2017-03-17 15:46:15');
INSERT INTO `t_collect` VALUES ('10', '37', '24', '2017-03-19 23:49:19');
INSERT INTO `t_collect` VALUES ('17', '37', '10', '2017-04-12 21:34:00');
INSERT INTO `t_collect` VALUES ('18', '37', '1', '2017-04-12 23:13:29');
INSERT INTO `t_collect` VALUES ('19', '37', '12', '2017-04-12 23:15:20');
INSERT INTO `t_collect` VALUES ('21', '37', '25', '2017-04-14 21:38:40');

-- ----------------------------
-- Table structure for t_combo
-- ----------------------------
DROP TABLE IF EXISTS `t_combo`;
CREATE TABLE `t_combo` (
  `combo_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '套餐名称',
  `park_id` int(11) DEFAULT NULL COMMENT '房源id',
  `start_time` date DEFAULT NULL COMMENT '套餐开始时间',
  `end_time` date DEFAULT NULL COMMENT '套餐结束时间',
  `price` float(6,0) DEFAULT NULL COMMENT '价格',
  `days` int(11) DEFAULT NULL COMMENT '起订天数',
  `combo_type_id` int(11) DEFAULT NULL COMMENT '套餐类型id',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  PRIMARY KEY (`combo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='房源套餐信息表';

-- ----------------------------
-- Records of t_combo
-- ----------------------------
INSERT INTO `t_combo` VALUES ('1', '冰雪大世界门票', '1', '2017-03-01', '2017-03-16', '100', '3', '1', null);
INSERT INTO `t_combo` VALUES ('5', '', '0', '0000-00-00', '0000-00-00', '0', '0', '0', null);
INSERT INTO `t_combo` VALUES ('6', 'bbbbbbbb', '1', '2017-02-28', '2017-04-06', '300', '2', '2', null);
INSERT INTO `t_combo` VALUES ('7', '太阳岛', '10', '2017-03-06', '2017-03-23', '400', '3', '1', 'http://www.taiyangdao.com.cn/index.html');
INSERT INTO `t_combo` VALUES ('8', 'hhhh', '23', '2017-03-13', '2017-03-24', '300', '20', '2', '');
INSERT INTO `t_combo` VALUES ('9', '群办家园一周+冰雪大世界门票', '26', '2017-03-01', '2017-03-08', '1500', '7', '1', '');

-- ----------------------------
-- Table structure for t_combo_type
-- ----------------------------
DROP TABLE IF EXISTS `t_combo_type`;
CREATE TABLE `t_combo_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL COMMENT '套餐类型名称',
  `description` varchar(255) DEFAULT NULL COMMENT '套餐说明',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='房源套餐类型表';

-- ----------------------------
-- Records of t_combo_type
-- ----------------------------
INSERT INTO `t_combo_type` VALUES ('1', '门票', '各种门票');
INSERT INTO `t_combo_type` VALUES ('2', '礼品', '各种礼品');
INSERT INTO `t_combo_type` VALUES ('3', '天数', '多订优惠');

-- ----------------------------
-- Table structure for t_comment
-- ----------------------------
DROP TABLE IF EXISTS `t_comment`;
CREATE TABLE `t_comment` (
  `comm_id` int(11) NOT NULL AUTO_INCREMENT,
  `comm_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  `content` text COMMENT '评论内容',
  `score` varchar(255) DEFAULT NULL COMMENT '综合评分满分5分(整洁卫生5 分|交通位置5分|管理服务5 分|设施装修5分)',
  `clean_score` varchar(255) DEFAULT NULL,
  `traffic_score` varchar(255) DEFAULT NULL,
  `manage_score` varchar(255) DEFAULT NULL,
  `facility_score` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `park_id` int(11) DEFAULT NULL COMMENT '房源id',
  `order_id` int(11) DEFAULT NULL COMMENT '订单',
  PRIMARY KEY (`comm_id`),
  KEY `user_id` (`user_id`),
  KEY `house_id` (`park_id`),
  CONSTRAINT `house_comment_fk` FOREIGN KEY (`park_id`) REFERENCES `t_park` (`park_id`),
  CONSTRAINT `user_comment_fk` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='房源评论信息表';

-- ----------------------------
-- Records of t_comment
-- ----------------------------
INSERT INTO `t_comment` VALUES ('1', '2017-03-19 20:38:28', '这是我的新评论', '3.5', '5', '4', '3', '2', '40', '1', '1');
INSERT INTO `t_comment` VALUES ('2', '2017-03-19 21:04:28', '这是新评论', '3.5', '2', '3', '4', '5', '40', '1', '1');
INSERT INTO `t_comment` VALUES ('3', '2017-03-19 21:04:59', '啊啊啊啊', '5', '5', '5', '5', '5', '40', '1', '1');
INSERT INTO `t_comment` VALUES ('4', '2017-03-20 09:29:59', '环境真好', '4.25', '4', '4', '5', '4', '37', '1', '11');
INSERT INTO `t_comment` VALUES ('5', '2017-03-20 13:03:54', '真不错', '4.75', '5', '4', '5', '5', '39', '2', '14');

-- ----------------------------
-- Table structure for t_comment_img
-- ----------------------------
DROP TABLE IF EXISTS `t_comment_img`;
CREATE TABLE `t_comment_img` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_thumb_src` varchar(255) DEFAULT NULL COMMENT '图片缩略图',
  `img_src` varchar(255) DEFAULT NULL COMMENT '评论原图',
  `comm_id` int(11) DEFAULT NULL COMMENT '评论id',
  PRIMARY KEY (`img_id`),
  KEY `comm_id` (`comm_id`),
  CONSTRAINT `comm_img_fk` FOREIGN KEY (`comm_id`) REFERENCES `t_comment` (`comm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='评论图片信息表';

-- ----------------------------
-- Records of t_comment_img
-- ----------------------------
INSERT INTO `t_comment_img` VALUES ('1', 'uploads\\houseImg\\houseSmall\\housePic6.jpg', null, '1');
INSERT INTO `t_comment_img` VALUES ('2', 'uploads\\houseImg\\houseSmall\\housePic6.jpg', null, '1');
INSERT INTO `t_comment_img` VALUES ('3', 'uploads\\houseImg\\houseSmall\\housePic6.jpg', null, '1');
INSERT INTO `t_comment_img` VALUES ('4', 'uploads\\houseImg\\houseSmall\\housePic6.jpg', null, '4');
INSERT INTO `t_comment_img` VALUES ('5', 'uploads\\houseImg\\houseSmall\\housePic6.jpg', null, '4');
INSERT INTO `t_comment_img` VALUES ('6', 'uploads\\houseImg\\houseSmall\\housePic6.jpg', null, '3');
INSERT INTO `t_comment_img` VALUES ('7', 'uploads/comment/148863576176691.png', null, '6');
INSERT INTO `t_comment_img` VALUES ('8', 'uploads/comment/148863595361849.png', null, '7');
INSERT INTO `t_comment_img` VALUES ('9', 'uploads/comment/148863615940870.png', null, '9');
INSERT INTO `t_comment_img` VALUES ('10', 'uploads/comment/148863622613242.png', null, '10');
INSERT INTO `t_comment_img` VALUES ('11', 'uploads/comment/148863675661762.png', null, '12');

-- ----------------------------
-- Table structure for t_conmment
-- ----------------------------
DROP TABLE IF EXISTS `t_conmment`;
CREATE TABLE `t_conmment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `conmment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(255) DEFAULT NULL,
  `img_first` varchar(255) DEFAULT NULL,
  `img_second` varchar(255) DEFAULT NULL,
  `img_third` varchar(255) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `house_id` int(11) DEFAULT NULL,
  `img_first_thumb` varchar(255) DEFAULT NULL,
  `img_second_thumb` varchar(255) DEFAULT NULL,
  `img_third_thumb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `house_id` (`house_id`),
  CONSTRAINT `fk_house_comment` FOREIGN KEY (`house_id`) REFERENCES `t_park` (`park_id`),
  CONSTRAINT `fk_user_comment` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_conmment
-- ----------------------------
INSERT INTO `t_conmment` VALUES ('1', '2017-01-26 11:15:20', '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈', 'assets/img/1.jpg', 'assets/img/1.jpg', null, '80', '1', '1', 'assets/img/1.jpg', 'assets/img/1.jpg', null);
INSERT INTO `t_conmment` VALUES ('2', '2017-01-26 11:18:04', '这是一个完美的事情留,真的很好neighboorhoud。索尼娅是一种足以向\r我们展示了这里的一切是由汽车及如何公共交通工作。如果你想成为出\r繁忙的波士顿大留...谢谢你索尼娅!', null, null, null, '20', '1', '1', 'assets/img/2.jpg', 'assets/img/2.jpg', 'assets/img/2.jpg');
INSERT INTO `t_conmment` VALUES ('3', '2017-01-31 23:09:33', '但是很突然', '', '', '', '30', '1', '1', '', '', '');

-- ----------------------------
-- Table structure for t_developer
-- ----------------------------
DROP TABLE IF EXISTS `t_developer`;
CREATE TABLE `t_developer` (
  `developer_id` int(11) NOT NULL AUTO_INCREMENT,
  `developer_name` varchar(40) DEFAULT NULL COMMENT '开发商名称',
  `description` text COMMENT '开发商描述',
  `telephone` varchar(20) DEFAULT NULL COMMENT '开发商电话',
  `address` varchar(255) DEFAULT NULL COMMENT '开发商地址',
  `logo` varchar(255) DEFAULT NULL COMMENT '开发商logo',
  `is_delete` int(2) DEFAULT '0' COMMENT '0表示未删除 1表示已删除',
  `founding_time` date DEFAULT NULL COMMENT '公司成立时间',
  PRIMARY KEY (`developer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_developer
-- ----------------------------
INSERT INTO `t_developer` VALUES ('1', '恒大集团', '恒大集团是集地产、金融、健康、旅游及体育为一体的世界500强企业集团，总资产达万亿，年销售规模超4000亿，员工8万多人，解决就业170多万人，在全国200多个城市拥有地产项目600多个，已成为全球第一房企。到2020年，恒大将实现总资产超3万亿、房地产年销售规模超6000亿。', '4008893333', '广州市天河区', null, '1', null);
INSERT INTO `t_developer` VALUES ('2', 'test', '', '0451-12345678', '士大夫士大夫撒旦飞洒地方', 'uploads/developer/20170227141527_73513.png', '1', '2017-02-09');
INSERT INTO `t_developer` VALUES ('3', '11', '&lt;p&gt;二分法撒旦飞洒地方撒发生阿斯顿发生的发生暗示法大是大非&lt;/p&gt;', '1111', '1111', 'uploads/developer/20170227142913_96575.png', '1', '2017-02-17');
INSERT INTO `t_developer` VALUES ('4', '小宝房建公司', '<p>公司太牛逼</p>', '13456533556', '群力花园3栋301', 'images/head-default.png', '1', '2017-03-07');
INSERT INTO `t_developer` VALUES ('5', '小小建筑有限公司', '<p>飞飞飞</p>', '13245678543', '群力花园3栋301', 'uploads/developer/盒模型css.png', '1', '2017-03-01');
INSERT INTO `t_developer` VALUES ('6', '啊啊啊啊啊啊啊啊啊', '<p>嘎嘎而过</p>', '21212121', '群力花园3栋301', 'uploads/developer/盒模型.png', '1', '2017-03-06');
INSERT INTO `t_developer` VALUES ('7', '哈尔滨万家好地产', '<p>哈尔滨万家好地产</p>', '', '', 'images/head-default.png', '0', '0000-00-00');
INSERT INTO `t_developer` VALUES ('8', '哈尔滨天渤万嘉地产', '<p>哈尔滨天渤万嘉地产</p>', '', '', 'images/head-default.png', '0', '0000-00-00');
INSERT INTO `t_developer` VALUES ('9', '哈尔滨综合开发建设有限公司', '<p>哈尔滨综合开发建设有限公司</p>', '', '', 'images/head-default.png', '0', '0000-00-00');
INSERT INTO `t_developer` VALUES ('10', '哈尔滨好民居建设投资发展有限公司', '<p>哈尔滨好民居建设投资发展有限公司</p>', '', '', 'images/head-default.png', '0', '0000-00-00');
INSERT INTO `t_developer` VALUES ('11', '哈尔滨市河松房地产开发有限责任公司', '<p>哈尔滨市河松房地产开发有限责任公司</p>', '', '', 'images/head-default.png', '0', '0000-00-00');
INSERT INTO `t_developer` VALUES ('12', '哈尔滨市新阳开发建设指挥部', '<p>哈尔滨市新阳开发建设指挥部</p>', '', '', 'images/head-default.png', '0', '0000-00-00');
INSERT INTO `t_developer` VALUES ('13', '哈尔滨市天昊房地产开发建设有限公司', '<p>哈尔滨市天昊房地产开发建设有限公司</p>', '', '', 'images/head-default.png', '0', '0000-00-00');

-- ----------------------------
-- Table structure for t_enter
-- ----------------------------
DROP TABLE IF EXISTS `t_enter`;
CREATE TABLE `t_enter` (
  `enter_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `enter_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`enter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_enter
-- ----------------------------

-- ----------------------------
-- Table structure for t_facility
-- ----------------------------
DROP TABLE IF EXISTS `t_facility`;
CREATE TABLE `t_facility` (
  `facility_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL COMMENT '设备类型id',
  `park_id` int(11) DEFAULT NULL COMMENT '房源id',
  PRIMARY KEY (`facility_id`),
  KEY `house_id` (`park_id`),
  KEY `facility_type_id` (`type_id`),
  CONSTRAINT `facility_type_fk` FOREIGN KEY (`type_id`) REFERENCES `t_facility_type` (`type_id`),
  CONSTRAINT `fk_house_facility` FOREIGN KEY (`park_id`) REFERENCES `t_park` (`park_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='房源设备信息表';

-- ----------------------------
-- Records of t_facility
-- ----------------------------
INSERT INTO `t_facility` VALUES ('1', '1', '1');
INSERT INTO `t_facility` VALUES ('2', '2', '1');
INSERT INTO `t_facility` VALUES ('3', '3', '1');
INSERT INTO `t_facility` VALUES ('4', '4', '1');
INSERT INTO `t_facility` VALUES ('5', '5', '1');
INSERT INTO `t_facility` VALUES ('6', '6', '1');
INSERT INTO `t_facility` VALUES ('7', '7', '1');
INSERT INTO `t_facility` VALUES ('8', '8', '1');
INSERT INTO `t_facility` VALUES ('9', '9', '1');
INSERT INTO `t_facility` VALUES ('14', '1', '12');
INSERT INTO `t_facility` VALUES ('15', '2', '12');
INSERT INTO `t_facility` VALUES ('16', '8', '12');
INSERT INTO `t_facility` VALUES ('23', '1', '16');
INSERT INTO `t_facility` VALUES ('24', '2', '12');
INSERT INTO `t_facility` VALUES ('25', '3', '16');
INSERT INTO `t_facility` VALUES ('26', '3', '17');
INSERT INTO `t_facility` VALUES ('27', '4', '17');
INSERT INTO `t_facility` VALUES ('28', '1', '18');
INSERT INTO `t_facility` VALUES ('29', '8', '18');
INSERT INTO `t_facility` VALUES ('30', '1', '20');
INSERT INTO `t_facility` VALUES ('31', '2', '20');
INSERT INTO `t_facility` VALUES ('38', '1', '21');
INSERT INTO `t_facility` VALUES ('39', '8', '21');
INSERT INTO `t_facility` VALUES ('40', '1', '22');
INSERT INTO `t_facility` VALUES ('41', '2', '22');
INSERT INTO `t_facility` VALUES ('42', '3', '23');
INSERT INTO `t_facility` VALUES ('43', '4', '23');
INSERT INTO `t_facility` VALUES ('44', '1', '24');
INSERT INTO `t_facility` VALUES ('45', '2', '24');
INSERT INTO `t_facility` VALUES ('46', '1', '25');
INSERT INTO `t_facility` VALUES ('47', '2', '25');
INSERT INTO `t_facility` VALUES ('48', '1', '26');
INSERT INTO `t_facility` VALUES ('49', '2', '26');
INSERT INTO `t_facility` VALUES ('50', '3', '26');
INSERT INTO `t_facility` VALUES ('51', '4', '26');
INSERT INTO `t_facility` VALUES ('52', '5', '26');
INSERT INTO `t_facility` VALUES ('53', '6', '26');
INSERT INTO `t_facility` VALUES ('54', '7', '26');
INSERT INTO `t_facility` VALUES ('55', '8', '26');
INSERT INTO `t_facility` VALUES ('56', '9', '26');

-- ----------------------------
-- Table structure for t_facility_type
-- ----------------------------
DROP TABLE IF EXISTS `t_facility_type`;
CREATE TABLE `t_facility_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '设备名称',
  `icon` varchar(255) DEFAULT NULL COMMENT '设备图标',
  `is_free` int(255) DEFAULT '0' COMMENT '是否付费（0免费|1收费）',
  `price` float(6,1) DEFAULT NULL COMMENT '收费价格',
  `remark` varchar(255) DEFAULT NULL COMMENT '设备备注',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='设备类型信息表';

-- ----------------------------
-- Records of t_facility_type
-- ----------------------------
INSERT INTO `t_facility_type` VALUES ('1', '冰箱', 'uploads/facilities/phone.png', '0', null, null);
INSERT INTO `t_facility_type` VALUES ('2', '洗衣机', 'uploads/facilities/TV.png', '0', null, null);
INSERT INTO `t_facility_type` VALUES ('3', '电视', 'uploads/facilities/pliers.png', '0', null, null);
INSERT INTO `t_facility_type` VALUES ('4', '电脑', 'uploads/facilities/shop.png', '0', null, null);
INSERT INTO `t_facility_type` VALUES ('5', '空调', 'uploads/facilities/hook.png', '0', null, null);
INSERT INTO `t_facility_type` VALUES ('6', '彩电', 'uploads/facilities/phone.png', '0', null, null);
INSERT INTO `t_facility_type` VALUES ('7', '床', 'uploads/facilities/phone.png', '1', '100.0', null);
INSERT INTO `t_facility_type` VALUES ('8', '沙发', 'uploads/facilities/phone.png', '1', '200.0', null);
INSERT INTO `t_facility_type` VALUES ('9', 'wifi', 'uploads/facilities/phone.png', '1', '300.0', null);

-- ----------------------------
-- Table structure for t_log
-- ----------------------------
DROP TABLE IF EXISTS `t_log`;
CREATE TABLE `t_log` (
  `log_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL COMMENT '操作人员id',
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '操作时间',
  `log_content` varchar(255) DEFAULT NULL COMMENT '操作的功能',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=utf8 COMMENT='管理员操作日志表';

-- ----------------------------
-- Records of t_log
-- ----------------------------
INSERT INTO `t_log` VALUES ('1', '21', '2017-02-27 15:00:02', '进行了管理员管理的列表查询操作');
INSERT INTO `t_log` VALUES ('2', '21', '2017-02-27 15:00:16', '进行了管理员管理的列表查询操作');
INSERT INTO `t_log` VALUES ('3', '21', '2017-02-27 15:12:37', '进行了管理员管理的列表查询操作');
INSERT INTO `t_log` VALUES ('4', '21', '2017-02-27 15:36:25', '进行了管理员管理的列表查询操作');
INSERT INTO `t_log` VALUES ('5', '38', '2017-02-27 15:40:34', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('6', '38', '2017-02-27 15:50:00', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('7', '38', '2017-02-27 16:05:28', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('8', '38', '2017-02-27 16:09:59', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('9', '38', '2017-02-27 16:11:34', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('10', '38', '2017-02-27 16:11:55', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('11', '38', '2017-02-27 16:12:56', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('12', '38', '2017-02-27 16:12:58', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('13', '38', '2017-02-27 16:13:26', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('14', '38', '2017-02-27 16:23:23', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('15', '38', '2017-02-27 16:25:02', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('16', '38', '2017-02-27 16:25:46', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('17', '38', '2017-02-27 16:25:55', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('18', '38', '2017-02-27 16:25:58', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('19', '38', '2017-02-27 16:26:16', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('20', '38', '2017-02-27 16:26:18', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('21', '38', '2017-02-27 16:27:55', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('22', '38', '2017-02-27 16:29:27', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('23', '38', '2017-02-27 16:31:44', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('24', '38', '2017-02-27 16:33:14', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('25', '38', '2017-02-27 16:33:20', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('26', '38', '2017-02-27 16:34:03', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('27', '38', '2017-02-27 16:40:32', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('28', '38', '2017-02-27 16:41:18', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('29', '38', '2017-02-27 16:41:38', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('30', '38', '2017-02-27 16:41:43', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('31', '38', '2017-02-27 16:42:08', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('32', '38', '2017-02-27 16:42:18', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('33', '38', '2017-02-27 16:43:07', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('34', '38', '2017-02-27 16:49:10', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('35', '38', '2017-02-27 17:27:18', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('36', '38', '2017-02-27 17:27:40', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('37', '21', '2017-02-28 09:20:14', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('38', '21', '2017-02-28 09:20:17', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('39', '21', '2017-02-28 09:20:19', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('40', '21', '2017-02-28 09:20:20', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('41', '21', '2017-02-28 09:20:21', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('42', '21', '2017-02-28 09:20:21', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('43', '21', '2017-02-28 09:20:44', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('44', '21', '2017-02-28 09:20:44', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('45', '21', '2017-02-28 09:21:06', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('46', '21', '2017-02-28 09:21:06', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('47', '21', '2017-02-28 09:21:09', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('48', '21', '2017-02-28 09:21:10', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('49', '21', '2017-02-28 09:21:31', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('50', '21', '2017-02-28 09:21:31', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('51', '21', '2017-02-28 09:22:00', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('52', '21', '2017-02-28 09:22:00', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('53', '21', '2017-02-28 09:22:19', '进行了 查询套餐类型 操作');
INSERT INTO `t_log` VALUES ('54', '21', '2017-02-28 09:24:03', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('55', '21', '2017-02-28 09:24:24', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('56', '21', '2017-02-28 09:24:59', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('57', '21', '2017-02-28 09:56:08', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('58', '21', '2017-02-28 09:56:08', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('59', '21', '2017-02-28 09:56:10', '进行了 用户详情查询 操作');
INSERT INTO `t_log` VALUES ('60', '21', '2017-02-28 10:29:00', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('61', '21', '2017-02-28 10:29:00', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('62', '21', '2017-02-28 10:29:06', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('63', '21', '2017-02-28 10:29:16', '进行了 查询套餐类型 操作');
INSERT INTO `t_log` VALUES ('64', '21', '2017-02-28 10:30:01', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('65', '21', '2017-02-28 10:30:07', '进行了 删除套餐 操作');
INSERT INTO `t_log` VALUES ('66', '21', '2017-02-28 10:30:07', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('67', '21', '2017-02-28 10:31:29', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('68', '21', '2017-02-28 10:31:33', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('69', '21', '2017-02-28 10:32:25', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('70', '21', '2017-02-28 10:38:22', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('71', '21', '2017-02-28 10:38:33', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('72', '21', '2017-02-28 10:39:07', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('73', '21', '2017-02-28 10:39:10', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('74', '21', '2017-02-28 10:40:20', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('75', '21', '2017-02-28 10:41:19', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('76', '21', '2017-02-28 10:42:27', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('77', '21', '2017-02-28 10:45:30', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('78', '21', '2017-02-28 10:59:28', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('79', '21', '2017-02-28 10:59:40', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('80', '21', '2017-02-28 10:59:41', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('81', '21', '2017-02-28 10:59:42', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('82', '21', '2017-02-28 10:59:43', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('83', '21', '2017-02-28 10:59:43', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('84', '21', '2017-02-28 10:59:44', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('85', '21', '2017-02-28 10:59:44', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('86', '21', '2017-02-28 10:59:44', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('87', '21', '2017-02-28 10:59:45', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('88', '21', '2017-02-28 10:59:53', '进行了 删除套餐 操作');
INSERT INTO `t_log` VALUES ('89', '21', '2017-02-28 10:59:53', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('90', '21', '2017-02-28 10:59:58', '进行了 删除套餐 操作');
INSERT INTO `t_log` VALUES ('91', '21', '2017-02-28 10:59:58', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('92', '21', '2017-02-28 11:14:32', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('93', '21', '2017-02-28 11:16:02', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('94', '21', '2017-02-28 11:16:23', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('95', '21', '2017-02-28 11:17:06', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('96', '21', '2017-02-28 11:17:33', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('97', '21', '2017-02-28 11:18:14', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('98', '21', '2017-02-28 11:18:47', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('99', '21', '2017-02-28 11:18:51', '进行了 修改套餐 操作');
INSERT INTO `t_log` VALUES ('100', '21', '2017-02-28 11:18:56', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('101', '21', '2017-02-28 11:19:07', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('102', '21', '2017-02-28 11:19:21', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('103', '21', '2017-02-28 11:19:25', '进行了 修改套餐 操作');
INSERT INTO `t_log` VALUES ('104', '21', '2017-02-28 11:19:26', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('105', '21', '2017-02-28 11:19:55', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('106', '21', '2017-02-28 11:20:11', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('107', '21', '2017-02-28 11:20:15', '进行了 修改套餐 操作');
INSERT INTO `t_log` VALUES ('108', '21', '2017-02-28 11:20:16', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('109', '21', '2017-02-28 11:21:44', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('110', '21', '2017-02-28 11:22:02', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('111', '21', '2017-02-28 11:22:54', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('112', '21', '2017-02-28 11:23:07', '进行了 修改套餐 操作');
INSERT INTO `t_log` VALUES ('113', '21', '2017-02-28 11:23:07', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('114', '21', '2017-02-28 11:24:06', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('115', '21', '2017-02-28 11:24:21', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('116', '21', '2017-02-28 11:24:27', '进行了 修改套餐 操作');
INSERT INTO `t_log` VALUES ('117', '21', '2017-02-28 11:24:28', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('118', '21', '2017-02-28 11:24:42', '进行了 修改套餐 操作');
INSERT INTO `t_log` VALUES ('119', '21', '2017-02-28 11:24:42', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('120', '21', '2017-02-28 11:26:22', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('121', '21', '2017-02-28 14:01:38', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('122', '21', '2017-02-28 14:01:38', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('123', '21', '2017-02-28 14:01:47', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('124', '21', '2017-02-28 14:01:48', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('125', '21', '2017-02-28 14:19:10', '进行了 添加套餐 操作');
INSERT INTO `t_log` VALUES ('126', '21', '2017-02-28 14:19:10', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('127', '21', '2017-02-28 14:20:02', '进行了 添加套餐 操作');
INSERT INTO `t_log` VALUES ('128', '21', '2017-02-28 14:20:13', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('129', '21', '2017-02-28 20:34:03', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('130', '21', '2017-02-28 20:34:04', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('131', '21', '2017-02-28 21:34:17', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('132', '21', '2017-02-28 21:34:17', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('133', '21', '2017-02-28 21:34:21', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('134', '21', '2017-03-01 10:10:45', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('135', '21', '2017-03-01 11:17:19', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('136', '21', '2017-03-01 11:17:19', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('137', '21', '2017-03-01 11:17:21', '进行了 用户详情查询 操作');
INSERT INTO `t_log` VALUES ('138', '21', '2017-03-01 11:17:25', '进行了 用户详情查询 操作');
INSERT INTO `t_log` VALUES ('139', '21', '2017-03-01 11:17:39', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('140', '21', '2017-03-01 11:19:03', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('141', '21', '2017-03-01 11:19:03', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('142', '21', '2017-03-01 11:19:04', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('143', '21', '2017-03-01 11:19:04', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('144', '21', '2017-03-01 11:23:32', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('145', '21', '2017-03-01 11:23:33', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('146', '21', '2017-03-01 11:23:38', '进行了 开发商详情查询 操作');
INSERT INTO `t_log` VALUES ('147', '21', '2017-03-01 11:23:39', '进行了 开发商详情查询 操作');
INSERT INTO `t_log` VALUES ('148', '21', '2017-03-01 11:23:39', '进行了 开发商详情查询 操作');
INSERT INTO `t_log` VALUES ('149', '21', '2017-03-01 11:23:43', '进行了 开发商修改查询 操作');
INSERT INTO `t_log` VALUES ('150', '21', '2017-03-01 11:25:04', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('151', '21', '2017-03-01 11:25:04', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('152', '21', '2017-03-01 11:34:22', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('153', '21', '2017-03-01 11:34:23', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('154', '21', '2017-03-01 11:34:29', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('155', '21', '2017-03-01 11:34:29', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('156', '21', '2017-03-01 11:41:21', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('157', '21', '2017-03-01 11:41:21', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('158', '21', '2017-03-01 13:36:01', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('159', '21', '2017-03-01 13:36:01', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('160', '21', '2017-03-01 13:41:02', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('161', '21', '2017-03-01 13:41:02', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('162', '21', '2017-03-01 16:41:47', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('163', '21', '2017-03-01 16:42:20', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('164', '21', '2017-03-01 16:44:43', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('165', '21', '2017-03-01 16:45:29', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('166', '21', '2017-03-01 16:45:38', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('167', '21', '2017-03-01 22:13:19', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('168', '21', '2017-03-01 22:15:13', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('169', '21', '2017-03-01 22:15:34', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('170', '21', '2017-03-01 22:16:14', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('171', '21', '2017-03-01 22:19:23', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('172', '21', '2017-03-04 23:14:36', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('173', '21', '2017-03-04 23:14:36', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('174', '21', '2017-03-04 23:17:47', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('175', '21', '2017-03-04 23:17:47', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('176', '21', '2017-03-05 11:29:04', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('177', '21', '2017-03-05 13:12:39', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('178', '21', '2017-03-05 13:14:10', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('179', '21', '2017-03-05 13:15:18', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('180', '21', '2017-03-05 13:52:21', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('181', '21', '2017-03-05 21:14:06', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('182', '21', '2017-03-05 21:14:07', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('183', '21', '2017-03-05 21:23:26', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('184', '21', '2017-03-05 21:23:39', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('185', '21', '2017-03-05 21:23:51', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('186', '21', '2017-03-05 21:53:09', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('187', '21', '2017-03-05 21:53:21', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('188', '21', '2017-03-05 21:53:21', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('189', '21', '2017-03-05 21:53:25', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('190', '21', '2017-03-05 21:53:34', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('191', '21', '2017-03-05 21:53:43', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('192', '21', '2017-03-05 21:54:28', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('193', '21', '2017-03-05 21:54:35', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('194', '21', '2017-03-05 21:57:00', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('195', '21', '2017-03-05 21:57:01', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('196', '21', '2017-03-05 21:57:02', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('197', '21', '2017-03-05 21:57:07', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('198', '21', '2017-03-05 21:57:17', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('199', '21', '2017-03-05 21:57:18', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('200', '21', '2017-03-05 21:57:23', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('201', '21', '2017-03-05 21:57:31', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('202', '21', '2017-03-05 21:58:07', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('203', '21', '2017-03-05 21:58:09', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('204', '21', '2017-03-05 22:00:21', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('205', '21', '2017-03-05 22:00:34', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('206', '21', '2017-03-05 22:00:40', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('207', '21', '2017-03-05 22:00:42', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('208', '21', '2017-03-05 22:00:46', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('209', '21', '2017-03-05 22:01:00', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('210', '21', '2017-03-05 22:01:34', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('211', '21', '2017-03-05 22:01:36', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('212', '21', '2017-03-05 22:01:40', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('213', '21', '2017-03-05 22:01:45', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('214', '21', '2017-03-05 22:02:10', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('215', '21', '2017-03-05 22:02:11', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('216', '21', '2017-03-05 22:02:32', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('217', '21', '2017-03-05 22:02:46', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('218', '21', '2017-03-05 22:02:52', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('219', '21', '2017-03-05 22:03:29', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('220', '21', '2017-03-05 22:03:33', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('221', '21', '2017-03-05 22:03:41', '进行了 设备管理添加设备 操作');
INSERT INTO `t_log` VALUES ('222', '21', '2017-03-05 22:03:41', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('223', '21', '2017-03-06 10:06:30', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('224', '21', '2017-03-06 10:06:30', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('225', '21', '2017-03-06 14:07:21', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('226', '21', '2017-03-06 14:12:46', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('227', '21', '2017-03-06 14:13:03', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('228', '21', '2017-03-06 14:20:49', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('229', '21', '2017-03-06 14:22:45', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('230', '21', '2017-03-06 14:23:25', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('231', '21', '2017-03-06 14:23:28', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('232', '21', '2017-03-06 14:23:32', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('233', '21', '2017-03-06 14:23:52', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('234', '21', '2017-03-06 14:24:29', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('235', '21', '2017-03-06 14:28:04', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('236', '21', '2017-03-06 14:28:08', '进行了 管理员删除房源 操作');
INSERT INTO `t_log` VALUES ('237', '21', '2017-03-06 15:41:34', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('238', '21', '2017-03-06 15:44:17', '进行了 添加套餐 操作');
INSERT INTO `t_log` VALUES ('239', '21', '2017-03-06 15:44:58', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('240', '21', '2017-03-06 15:46:43', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('241', '21', '2017-03-06 22:42:31', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('242', '21', '2017-03-06 22:52:18', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('243', '21', '2017-03-07 09:36:58', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('244', '21', '2017-03-07 10:37:20', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('245', '21', '2017-03-07 10:49:17', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('246', '21', '2017-03-07 10:51:38', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('247', '21', '2017-03-08 11:19:14', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('248', '21', '2017-03-08 11:19:14', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('249', '21', '2017-03-08 11:19:41', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('250', '21', '2017-03-08 11:19:41', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('251', '21', '2017-03-08 11:20:29', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('252', '21', '2017-03-08 11:20:30', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('253', '21', '2017-03-08 11:20:30', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('254', '21', '2017-03-08 11:22:11', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('255', '21', '2017-03-08 11:22:11', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('256', '21', '2017-03-08 11:22:12', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('257', '21', '2017-03-08 11:56:21', '进行了 开发商详情查询 操作');
INSERT INTO `t_log` VALUES ('258', '21', '2017-03-08 11:56:26', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('259', '21', '2017-03-08 11:56:26', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('260', '21', '2017-03-08 11:57:39', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('261', '21', '2017-03-08 11:57:39', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('262', '21', '2017-03-08 11:57:40', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('263', '21', '2017-03-08 12:53:39', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('264', '21', '2017-03-08 12:53:40', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('265', '21', '2017-03-08 12:53:41', '进行了 用户详情查询 操作');
INSERT INTO `t_log` VALUES ('266', '21', '2017-03-08 12:53:47', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('267', '21', '2017-03-08 12:54:25', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('268', '21', '2017-03-08 12:54:25', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('269', '21', '2017-03-08 12:54:31', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('270', '21', '2017-03-08 12:54:31', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('271', '21', '2017-03-08 12:54:39', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('272', '21', '2017-03-08 12:54:39', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('273', '21', '2017-03-08 16:05:54', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('274', '21', '2017-03-16 23:25:48', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('275', '21', '2017-03-16 23:25:48', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('276', '21', '2017-03-16 23:26:36', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('277', '21', '2017-03-16 23:26:39', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('278', '21', '2017-03-16 23:26:42', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('279', '21', '2017-03-16 23:26:42', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('280', '21', '2017-03-17 16:23:39', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('281', '21', '2017-03-17 16:23:39', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('282', '21', '2017-03-17 16:23:41', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('283', '21', '2017-03-17 16:23:41', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('284', '21', '2017-03-17 16:23:41', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('285', '21', '2017-03-17 16:23:42', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('286', '21', '2017-03-17 16:24:43', '进行了 用户添加 操作');
INSERT INTO `t_log` VALUES ('287', '21', '2017-03-17 16:24:43', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('288', '21', '2017-03-17 16:24:43', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('289', '21', '2017-03-18 19:55:15', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('290', '21', '2017-03-18 19:55:15', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('291', '21', '2017-03-18 20:00:22', '进行了 添加套餐 操作');
INSERT INTO `t_log` VALUES ('292', '21', '2017-03-18 20:28:22', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('293', '21', '2017-03-18 20:28:22', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('294', '21', '2017-03-18 20:52:20', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('295', '21', '2017-03-18 20:52:20', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('296', '21', '2017-03-18 21:00:01', '进行了 查询评论列表 操作');
INSERT INTO `t_log` VALUES ('297', '21', '2017-03-18 21:00:10', '进行了 查询套餐类型 操作');
INSERT INTO `t_log` VALUES ('298', '21', '2017-03-18 21:23:07', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('299', '21', '2017-03-18 21:23:08', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('300', '21', '2017-03-18 21:23:17', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('301', '21', '2017-03-19 22:05:14', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('302', '21', '2017-03-19 22:05:23', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('303', '21', '2017-03-19 22:07:11', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('304', '21', '2017-03-19 22:07:13', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('305', '21', '2017-03-19 22:23:00', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('306', '21', '2017-03-19 22:23:03', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('307', '21', '2017-03-19 22:23:10', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('308', '21', '2017-03-19 22:23:26', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('309', '21', '2017-03-19 22:23:29', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('310', '21', '2017-03-19 22:23:35', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('311', '21', '2017-03-19 22:31:09', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('312', '21', '2017-03-19 22:31:54', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('313', '21', '2017-03-19 23:06:46', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('314', '21', '2017-03-19 23:07:39', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('315', '21', '2017-03-19 23:08:42', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('316', '21', '2017-03-19 23:09:56', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('317', '21', '2017-03-19 23:10:26', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('318', '21', '2017-03-19 23:10:37', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('319', '21', '2017-03-19 23:12:01', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('320', '21', '2017-03-19 23:12:01', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('321', '21', '2017-03-19 23:23:08', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('322', '21', '2017-03-19 23:27:30', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('323', '21', '2017-03-19 23:29:27', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('324', '21', '2017-03-19 23:29:34', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('325', '21', '2017-03-19 23:42:25', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('326', '21', '2017-03-20 00:08:55', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('327', '21', '2017-03-20 00:08:56', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('328', '21', '2017-03-20 00:17:00', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('329', '21', '2017-03-20 00:17:01', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('330', '21', '2017-03-20 00:17:03', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('331', '21', '2017-03-20 00:17:05', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('332', '21', '2017-03-20 00:17:06', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('333', '21', '2017-03-20 00:17:07', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('334', '21', '2017-03-20 00:17:07', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('335', '21', '2017-03-20 00:17:08', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('336', '21', '2017-03-20 00:17:10', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('337', '21', '2017-03-20 00:17:11', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('338', '21', '2017-03-20 00:17:14', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('339', '21', '2017-03-20 00:19:09', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('340', '21', '2017-03-20 00:19:14', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('341', '21', '2017-03-20 00:19:14', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('342', '21', '2017-03-20 00:19:58', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('343', '21', '2017-03-20 00:19:59', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('344', '21', '2017-03-20 00:20:01', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('345', '21', '2017-03-20 00:21:50', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('346', '21', '2017-03-20 00:21:50', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('347', '21', '2017-03-20 00:21:53', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('348', '21', '2017-03-20 00:23:05', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('349', '21', '2017-03-20 00:23:06', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('350', '21', '2017-03-20 00:23:11', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('351', '21', '2017-03-20 00:23:40', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('352', '21', '2017-03-20 00:23:41', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('353', '21', '2017-03-20 00:26:55', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('354', '21', '2017-03-20 00:27:03', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('355', '21', '2017-03-20 00:27:03', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('356', '21', '2017-03-20 00:27:15', '进行了 用户发送消息 操作');
INSERT INTO `t_log` VALUES ('357', '21', '2017-03-20 00:27:20', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('358', '21', '2017-03-20 00:27:22', '进行了 用户发送消息 操作');
INSERT INTO `t_log` VALUES ('359', '21', '2017-03-20 00:38:58', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('360', '21', '2017-03-20 00:38:59', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('361', '21', '2017-03-20 00:39:05', '进行了 开发商删除 操作');
INSERT INTO `t_log` VALUES ('362', '21', '2017-03-20 00:39:05', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('363', '21', '2017-03-20 00:40:05', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('364', '21', '2017-03-20 00:40:05', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('365', '21', '2017-03-20 00:40:06', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('366', '21', '2017-03-20 00:40:32', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('367', '21', '2017-03-20 00:40:32', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('368', '21', '2017-03-20 00:40:32', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('369', '21', '2017-03-20 00:40:47', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('370', '21', '2017-03-20 00:40:47', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('371', '21', '2017-03-20 00:40:47', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('372', '21', '2017-03-20 00:41:04', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('373', '21', '2017-03-20 00:41:04', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('374', '21', '2017-03-20 00:41:05', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('375', '21', '2017-03-20 00:41:21', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('376', '21', '2017-03-20 00:41:21', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('377', '21', '2017-03-20 00:41:22', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('378', '21', '2017-03-20 00:41:31', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('379', '21', '2017-03-20 00:41:31', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('380', '21', '2017-03-20 00:41:31', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('381', '21', '2017-03-20 00:41:42', '进行了 开发商添加 操作');
INSERT INTO `t_log` VALUES ('382', '21', '2017-03-20 00:41:42', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('383', '21', '2017-03-20 00:41:42', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('384', '21', '2017-03-20 11:59:42', '进行了 添加套餐 操作');
INSERT INTO `t_log` VALUES ('385', '21', '2017-03-20 12:01:46', '进行了 查询套餐类型 操作');
INSERT INTO `t_log` VALUES ('386', '21', '2017-03-20 12:01:51', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('387', '21', '2017-03-20 12:01:52', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('388', '21', '2017-03-20 14:27:33', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('389', '21', '2017-03-20 14:27:33', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('390', '21', '2017-03-20 14:36:25', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('391', '21', '2017-03-26 11:26:52', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('392', '21', '2017-03-27 11:30:41', '进行了 用户添加--订单管理 操作');
INSERT INTO `t_log` VALUES ('393', '21', '2017-03-27 11:47:52', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('394', '21', '2017-03-27 12:03:46', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('395', '21', '2017-03-27 12:03:47', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('396', '21', '2017-04-13 23:20:16', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('397', '21', '2017-04-13 23:20:17', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('398', '21', '2017-04-13 23:20:39', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('399', '21', '2017-04-13 23:20:44', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('400', '21', '2017-04-13 23:20:56', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('401', '21', '2017-04-13 23:21:01', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('402', '21', '2017-04-13 23:21:01', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('403', '21', '2017-04-13 23:21:06', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('404', '21', '2017-04-13 23:21:07', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('405', '21', '2017-04-13 23:22:15', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('406', '21', '2017-04-13 23:22:15', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('407', '21', '2017-04-14 01:27:01', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('408', '21', '2017-04-14 01:27:02', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('409', '21', '2017-04-14 01:27:07', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('410', '21', '2017-04-14 01:27:07', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('411', '21', '2017-04-14 01:28:13', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('412', '21', '2017-04-14 01:28:20', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('413', '21', '2017-04-14 01:28:28', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('414', '21', '2017-04-14 01:28:33', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('415', '21', '2017-04-14 01:28:43', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('416', '21', '2017-04-14 01:28:48', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('417', '21', '2017-04-14 01:28:58', '进行了 开发商管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('418', '21', '2017-04-14 01:28:58', '进行了 开发商管理 操作');
INSERT INTO `t_log` VALUES ('419', '21', '2017-04-15 22:13:05', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('420', '21', '2017-04-15 22:13:06', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('421', '21', '2017-04-15 22:39:07', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('422', '21', '2017-04-15 22:39:08', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('423', '21', '2017-04-15 22:40:08', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('424', '21', '2017-04-15 22:41:43', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('425', '21', '2017-04-15 22:41:43', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('426', '21', '2017-04-15 22:42:35', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('427', '21', '2017-04-15 22:42:36', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('428', '21', '2017-04-15 22:48:59', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('429', '21', '2017-04-15 22:49:24', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('430', '21', '2017-04-17 15:41:46', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('431', '21', '2017-04-17 15:41:47', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('432', '21', '2017-04-17 15:41:52', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('433', '21', '2017-04-17 15:41:52', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('434', '21', '2017-04-17 15:42:45', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('435', '21', '2017-04-17 15:42:46', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('436', '21', '2017-04-17 15:44:11', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('437', '21', '2017-04-17 15:44:11', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('438', '21', '2017-04-17 15:54:42', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('439', '21', '2017-04-17 15:54:43', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('440', '21', '2017-04-17 16:10:31', '进行了 用户发送消息 操作');
INSERT INTO `t_log` VALUES ('441', '21', '2017-04-17 16:11:43', '进行了 查询套餐列表 操作');
INSERT INTO `t_log` VALUES ('442', '21', '2017-04-17 16:11:49', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('443', '21', '2017-04-17 16:11:58', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('444', '21', '2017-04-17 16:12:04', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('445', '21', '2017-04-17 16:46:50', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('446', '21', '2017-04-17 16:46:53', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('447', '21', '2017-04-17 16:46:53', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('448', '21', '2017-04-17 16:47:02', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('449', '21', '2017-04-17 16:47:02', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('450', '21', '2017-04-17 19:34:39', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('451', '21', '2017-04-17 19:34:40', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('452', '21', '2017-04-17 19:34:45', '进行了 设备管理列表查询 操作');
INSERT INTO `t_log` VALUES ('453', '21', '2017-04-17 19:37:17', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('454', '21', '2017-04-17 19:37:17', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('455', '21', '2017-04-17 19:37:24', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('456', '21', '2017-04-17 19:37:24', '进行了 用户管理 操作');
INSERT INTO `t_log` VALUES ('457', '21', '2017-04-17 19:38:16', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('458', '21', '2017-04-17 19:38:23', '进行了 管理员管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('459', '21', '2017-04-17 19:39:01', '进行了 用户管理的列表查询 操作');
INSERT INTO `t_log` VALUES ('460', '21', '2017-04-17 19:39:01', '进行了 用户管理 操作');

-- ----------------------------
-- Table structure for t_message
-- ----------------------------
DROP TABLE IF EXISTS `t_message`;
CREATE TABLE `t_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_id` int(11) DEFAULT NULL COMMENT '回复的留言的id',
  `sender` int(11) DEFAULT NULL COMMENT '发送人id',
  `receiver` int(11) DEFAULT NULL COMMENT '接收人id',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '留言时间',
  `content` text COMMENT '留言内容',
  `is_delete` int(11) DEFAULT '0' COMMENT '是否删除（0未删除|1删除）',
  `is_read` int(255) DEFAULT '0' COMMENT '是否已读（0未读|1已读）',
  PRIMARY KEY (`message_id`),
  KEY `sender` (`sender`),
  KEY `receiver` (`receiver`),
  CONSTRAINT `fk_user_receiver` FOREIGN KEY (`receiver`) REFERENCES `t_user` (`user_id`),
  CONSTRAINT `fk_user_sender` FOREIGN KEY (`sender`) REFERENCES `t_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='留言信息表';

-- ----------------------------
-- Records of t_message
-- ----------------------------
INSERT INTO `t_message` VALUES ('27', '35', '-1', '2', '2017-02-16 17:51:45', '得得', '0', '0');
INSERT INTO `t_message` VALUES ('29', null, '3', '-1', '2017-02-16 17:55:58', '不但花费话费的reeir', '0', '1');
INSERT INTO `t_message` VALUES ('30', null, '2', '-1', '2017-02-16 17:55:54', '给发', '0', '1');
INSERT INTO `t_message` VALUES ('32', null, '2', '-1', '2017-02-16 17:55:23', '户给发', '0', '1');
INSERT INTO `t_message` VALUES ('33', null, '3', '-1', '2017-02-16 17:54:30', '愤愤愤愤', '0', '1');
INSERT INTO `t_message` VALUES ('35', null, '2', '-1', '2017-02-16 17:54:36', '你的就是那就', '0', '1');
INSERT INTO `t_message` VALUES ('36', null, '3', '-1', '2017-02-16 17:54:32', '额分分', '0', '1');
INSERT INTO `t_message` VALUES ('39', '29', '-1', '1', '2017-02-16 17:54:10', '哈哈哈', '0', '0');
INSERT INTO `t_message` VALUES ('40', '30', '-1', '1', '2017-02-16 17:54:11', '123123', '0', '0');
INSERT INTO `t_message` VALUES ('41', '29', '-1', '37', '2017-02-16 17:54:11', '哈哈哈', '0', '0');
INSERT INTO `t_message` VALUES ('42', '29', '-1', '37', '2017-02-16 17:54:14', '123', '0', '0');
INSERT INTO `t_message` VALUES ('43', null, '1', '-1', '2017-02-23 22:07:02', '123123\n', '0', null);
INSERT INTO `t_message` VALUES ('44', null, '37', '-1', '2017-02-23 22:09:19', '123123\n', '0', null);
INSERT INTO `t_message` VALUES ('45', null, '1', '-1', '2017-02-24 14:33:01', '请问请问', '0', '1');
INSERT INTO `t_message` VALUES ('46', null, '-1', '39', '2017-03-20 00:27:29', '你好，有什么 问题吗', '0', '0');
INSERT INTO `t_message` VALUES ('47', null, '-1', '1', '2017-04-17 16:10:34', '', '0', '0');

-- ----------------------------
-- Table structure for t_order
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(100) DEFAULT NULL COMMENT '订单号（规则：20170214122815+5位随机数）',
  `start_time` date DEFAULT NULL COMMENT '入住时间',
  `end_time` date DEFAULT NULL COMMENT '离开时间',
  `price` decimal(10,0) DEFAULT NULL COMMENT '订单价格',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '订单创建时间',
  `status` varchar(20) DEFAULT NULL COMMENT '订单状态',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `park_id` int(11) DEFAULT NULL COMMENT '房源id',
  `is_invoice` int(11) DEFAULT NULL COMMENT '是否需要发票（0不需要|1需要）',
  `invoice_no` int(11) DEFAULT NULL COMMENT '发票号',
  `invoice_title` varchar(255) DEFAULT NULL COMMENT '发票抬头',
  `invoice_posted` int(11) DEFAULT NULL COMMENT '发票是否邮寄（0未邮寄|1邮寄）',
  `invoice_created` int(11) DEFAULT '0' COMMENT '是否已开发票',
  `invoice_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '发票邮寄时间',
  `invoice_address` text,
  `invoice_person_name` varchar(50) DEFAULT NULL COMMENT '发票联系人姓名',
  `invoice_person_tel` varchar(255) DEFAULT NULL COMMENT '发票联系人手机',
  `order_type` varchar(255) DEFAULT NULL COMMENT '订单类型？？？',
  `order_memo` varchar(255) DEFAULT NULL COMMENT '订单备注',
  `checkin_memo` varchar(255) DEFAULT NULL COMMENT '入驻备注',
  `checkout_mark` varchar(255) DEFAULT NULL COMMENT '退房备注',
  `checkout_has_problem` varchar(10) DEFAULT '无问题' COMMENT '退房时是否有问题（有问题|无问题）',
  `urgency_concat` varchar(20) DEFAULT NULL COMMENT '紧急联系人',
  `urgency_contact_tel` varchar(20) DEFAULT NULL COMMENT '紧急联系人电话',
  `cash_pledge` int(11) DEFAULT NULL COMMENT '押金',
  `cash_pledge_pay_way` varchar(10) DEFAULT NULL COMMENT '支付方式（支付宝|微信|银行卡|现金）',
  `return_cash_pledge` int(11) DEFAULT NULL COMMENT '退还押金',
  `checkin_charge` int(11) DEFAULT NULL,
  `return_way` varchar(10) DEFAULT NULL COMMENT '退还方式（支付宝|微信|银行卡|现金）',
  `checkout_charge` int(11) DEFAULT NULL COMMENT '结账负责人',
  `is_delete` int(11) DEFAULT '0',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `house_id` (`park_id`),
  CONSTRAINT `fk_house_order` FOREIGN KEY (`park_id`) REFERENCES `t_park` (`park_id`),
  CONSTRAINT `fk_user_order` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='订单信息表';

-- ----------------------------
-- Records of t_order
-- ----------------------------
INSERT INTO `t_order` VALUES ('1', null, '2017-03-08', '2017-03-11', '1000', '2017-01-07 11:27:22', '已支付', '1', '1', '1', '1234568', '水电费v个', '0', '0', '2017-03-10 16:08:11', '', null, '', '去哪网预付', '', null, '', null, null, null, null, null, null, null, '', '0', '0');
INSERT INTO `t_order` VALUES ('2', null, '2017-01-07', '2017-01-08', '10', '2017-01-07 11:29:00', '已完成', '37', '1', '0', '123456', '是的v发现的', '0', '0', '2017-03-04 21:39:13', '', null, '', '携程预付', '', null, '', null, null, null, null, null, null, null, '', '0', '0');
INSERT INTO `t_order` VALUES ('3', null, '2017-01-21', '2017-01-29', '200', '2017-01-07 11:29:29', '入住中', '1', '2', '1', '123', ' 是的v和黑大', '1', '1', '2017-03-10 16:07:57', '', null, '', '携程预付', '', null, '', null, null, null, null, null, null, null, '', '0', '0');
INSERT INTO `t_order` VALUES ('4', null, '2017-03-22', '2017-04-04', '2000', '2017-01-07 11:30:02', '未支付', '3', '1', '1', '123456', '死后的生活', '1', '1', '2017-03-10 16:08:06', '', null, '', '网站自营', '', null, '', null, null, null, null, null, null, null, '', '0', '0');
INSERT INTO `t_order` VALUES ('7', null, '2017-03-10', '2017-03-14', '2000', '2017-03-09 12:46:20', '已完成', '-1', '10', '1', null, '', null, '0', '2017-03-10 21:06:45', '', null, '', null, null, null, 'faef', '无问题', null, null, '200', '微信', '111', null, '微信', '21', '0');
INSERT INTO `t_order` VALUES ('8', null, '2017-03-10', '2017-03-11', '2888', '2017-03-10 16:31:14', '已完成', '-1', '10', '1', null, '', null, '0', '2017-03-19 23:39:59', '', null, '', null, null, '入住备注', '霜霜', '无问题', null, null, '400', '支付宝', '400', null, '支付宝', '0', '0');
INSERT INTO `t_order` VALUES ('9', null, '2017-03-10', '2017-03-11', '2345', '2017-03-10 16:34:56', '已完成', '-1', '1', '1', null, '啊啊啊', null, '0', '2017-03-17 16:16:08', '飞飞飞', null, '12324324', null, null, null, '用户取消订单', '无问题', null, null, null, '现金', '234', null, '现金', '21', '0');
INSERT INTO `t_order` VALUES ('10', null, '2017-03-21', '2017-03-23', '1000', '2017-03-19 23:40:56', '入住中', '-1', '1', null, null, null, null, '0', '2017-03-27 14:06:26', '飞飞飞', null, null, null, null, null, null, '无问题', null, null, null, '现金', '500', null, null, null, '0');
INSERT INTO `t_order` VALUES ('11', null, '2017-03-19', '2017-03-24', '1200', '2017-03-19 23:53:12', '已完成', '37', '24', '1', null, '', '1', '1', '2017-03-20 00:02:04', '', null, '', null, null, 'ddd', 'yyy', '无问题', null, null, '500', '现金', '500', null, '现金', '0', '0');
INSERT INTO `t_order` VALUES ('12', null, '2017-03-20', '2017-03-21', '440', '2017-03-20 12:05:53', '已支付', '39', '26', null, null, null, null, '0', null, null, null, null, null, null, null, null, '无问题', null, null, null, '现金', null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('13', null, '2017-03-21', '2017-03-22', '3000', '2017-03-20 12:26:46', '已支付', '39', '1', null, null, null, null, '0', '2017-03-20 12:37:51', null, null, null, null, null, null, null, '无问题', null, null, null, '现金', null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('14', null, '2017-03-13', '2017-03-24', '500', '2017-03-20 13:02:17', '已完成', '39', '2', '1', null, 'aa', null, '0', '2017-03-20 13:03:27', 'bb', null, 'ccc', null, null, '无', 'ddd', '无问题', null, null, '0', '现金', '400', null, '现金', '0', '0');
INSERT INTO `t_order` VALUES ('15', '2147483647', '2017-03-21', '2017-03-17', '32323', '2017-03-27 11:30:58', '未支付', '38', '1', null, null, null, null, '0', null, null, null, null, null, null, null, null, '无问题', null, null, null, '现金', null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('18', '2017040413222652948', '2017-04-13', '0000-00-00', '9999999999', '2017-04-04 19:22:26', '未处理', '37', '1', null, null, '2017-04-05', null, '0', '2017-04-04 13:22:26', null, '12000', '', null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('19', '2017040413234395497', null, null, null, '2017-04-04 19:23:43', '未处理', '37', '1', null, null, null, null, '0', '2017-04-05 19:52:30', null, null, null, null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('20', '2017040413251650048', '2017-04-05', '2017-04-13', '12000', '2017-04-04 19:25:16', '未处理', '37', '1', null, null, null, null, '0', null, null, '', '', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('21', '2017040413264467527', '2017-04-18', '2017-04-20', '3000', '2017-04-04 19:26:44', '进行中', '37', '1', null, null, null, null, '0', '2017-04-04 21:20:30', null, '小小', '13232323232', '支付宝支付', null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('22', '2017040415363703497', '2017-04-18', '2017-04-20', '3000', '2017-04-04 21:36:37', '进行中', '37', '1', null, null, null, null, '0', '2017-04-04 21:36:41', null, '', '', '支付宝支付', null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('23', '2017040504243136843', '2017-04-13', '2017-04-14', '1500', '2017-04-05 10:24:31', '未处理', '37', '1', null, null, null, null, '0', null, null, '大大', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('24', '2017040504254731790', '2017-04-13', '2017-04-14', '1500', '2017-04-05 10:25:47', '未处理', '37', '1', null, null, null, null, '0', null, null, '小小', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('25', '2017040504261601491', null, null, null, '2017-04-05 10:26:16', '未处理', '37', '1', null, null, null, null, '0', '2017-04-05 19:52:24', null, null, null, null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('26', '2017040504263469438', null, null, null, '2017-04-05 10:26:34', '未处理', '37', '1', null, null, null, null, '0', '2017-04-05 19:52:27', null, null, null, null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('27', '2017040504264336452', null, null, null, '2017-04-05 10:26:43', '未处理', '37', '1', null, null, null, null, '0', '2017-04-05 19:52:25', null, null, null, null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('28', '2017040504270264398', '2017-04-13', '2017-04-14', '1500', '2017-04-05 10:27:02', '未处理', '37', '1', null, null, null, null, '0', null, null, 'xiaoxiao', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('29', '2017040515064373242', '2017-04-06', '2017-04-07', '1500', '2017-04-05 21:06:43', '未处理', '37', '1', null, null, null, null, '0', null, null, '小小', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('30', '2017040705313882500', '2017-04-08', '2017-04-09', '1500', '2017-04-07 11:31:38', '未处理', '37', '1', null, null, null, null, '0', null, null, '啊啊啊', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('31', '2017040709590422471', '2017-04-08', '2017-04-09', '1500', '2017-04-07 15:59:04', '未处理', '37', '1', null, null, null, null, '0', null, null, '小小', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('32', '2017040710080578879', null, null, null, '2017-04-07 16:08:05', '未处理', '37', '1', null, null, null, null, '0', '2017-04-08 14:02:03', null, null, null, null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('33', '2017040710082198217', '2017-04-08', '2017-04-09', '1500', '2017-04-07 16:08:21', '未处理', '37', '1', null, null, null, null, '0', null, null, '啊啊啊', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('34', '2017040808250450713', '2017-04-08', '2017-04-09', '1500', '2017-04-08 14:25:04', '未处理', '37', '1', null, null, null, null, '0', null, null, '啊啊', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('35', '2017040808260035589', '2017-04-08', '2017-04-09', '1500', '2017-04-08 14:26:00', '未支付', '37', '1', null, null, null, null, '0', '2017-04-08 14:26:07', null, '啊啊', '13232323232', '支付宝支付', null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('36', '2017040808535271644', '2017-04-08', '2017-04-09', '1500', '2017-04-08 14:53:52', '未处理', '37', '1', null, null, null, null, '0', null, null, 'aaa', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('37', '2017040809011788804', '2017-04-08', '2017-04-09', '1500', '2017-04-08 15:01:17', '未处理', '37', '1', null, null, null, null, '0', null, null, '啊啊', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('38', '2017040809213106013', '2017-04-08', '2017-04-09', '1500', '2017-04-08 15:21:31', '未处理', '37', '1', null, null, null, null, '0', null, null, 'aa ', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('39', '2017041007362489534', '2017-04-12', '2017-04-14', '200', '2017-04-10 13:36:24', '未处理', null, '1', null, null, null, null, '0', null, null, '', '', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('40', '2017041008572580858', '2017-04-11', '2017-04-13', '3000', '2017-04-10 14:57:25', '未处理', '37', '1', null, null, null, null, '0', null, null, '小小', '13232323232', null, null, null, null, '无问题', null, '', null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('41', '2017041216163837647', '2017-04-12', '2017-04-13', '1500', '2017-04-12 16:16:38', '未支付', '37', '1', null, null, null, null, '0', null, null, 'ss', '13812312321', null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('42', '2017041216175865605', '2017-04-12', '2017-04-13', '1500', '2017-04-12 16:17:58', '未支付', '37', '1', null, null, null, null, '0', null, null, 's', '13723123123', null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('43', '2017041216182033131', null, null, '0', '2017-04-12 16:18:20', '未支付', '37', null, null, null, null, null, '0', null, null, null, null, null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('44', '2017041219021519377', '2017-04-12', '2017-04-13', '1500', '2017-04-12 19:02:15', '未支付', null, '1', null, null, null, null, '0', null, null, '李子翔', '13817723123', null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('45', '2017041219104072857', '2017-04-12', '2017-04-13', '1500', '2017-04-12 19:10:40', '已完成', '37', '1', null, null, null, null, '0', '2017-04-12 19:11:45', null, '罗崇杰', '18846980875', null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('46', '2017041219223261963', '2017-04-12', '2017-01-13', '-133500', '2017-04-12 19:22:32', '未支付', '37', '1', null, null, null, null, '1', '2017-04-14 01:28:07', null, '李子翔', '13817766379', null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('47', '2017041221330736148', '2017-04-12', '2017-04-15', '945', '2017-04-12 21:33:07', '未支付', null, '12', null, null, null, null, '0', null, null, 'luocho', '13912328573', null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('48', '2017041314475442093', '2017-04-13', '2017-04-14', '1500', '2017-04-13 14:47:54', '未支付', '37', '1', null, null, null, null, '1', '2017-04-14 01:28:07', null, '我问问', '18846013862', null, null, null, null, '无问题', null, null, null, '微信', null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('49', '2017041315252972108', '2017-04-13', '2017-04-14', '1500', '2017-04-13 15:25:29', '未支付', '37', '1', null, null, null, null, '1', '2017-04-14 01:28:06', null, 'sdsa', '13134213123', null, null, null, null, '无问题', null, null, null, '微信', null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('50', '2017041315295355786', '2017-04-13', '2017-04-14', '1500', '2017-04-13 15:29:53', '未支付', '37', '1', null, null, null, null, '1', '2017-04-14 01:28:01', null, '我问问', '14452523524', null, null, null, null, '无问题', null, null, null, '微信', null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('51', '2017041318373321840', '2017-04-13', '2017-04-14', '1500', '2017-04-13 18:37:33', '未支付', '37', '1', null, null, null, null, '1', '2017-04-14 01:27:59', null, 'hyhh', '13817787787', null, null, null, null, '无问题', null, null, null, '微信', null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('52', '2017041417214450164', '2017-05-14', '2017-05-15', '1500', '2017-04-14 17:21:44', '未支付', '37', '1', null, null, null, null, '0', null, null, 'wwa', '13812312312', null, null, null, null, '无问题', null, null, null, '微信', null, null, null, null, '0');
INSERT INTO `t_order` VALUES ('53', null, '0000-00-00', '0000-00-00', '1000', '2017-04-17 19:37:41', '入住中', '-1', '1', null, null, null, null, '0', null, '飞飞飞', null, null, null, null, null, null, '无问题', null, null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for t_park
-- ----------------------------
DROP TABLE IF EXISTS `t_park`;
CREATE TABLE `t_park` (
  `park_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '房源名称',
  `province` varchar(255) DEFAULT NULL COMMENT '省',
  `city` varchar(255) DEFAULT NULL COMMENT '市',
  `region` varchar(255) DEFAULT NULL COMMENT '区',
  `street` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `price` decimal(10,0) DEFAULT NULL COMMENT '基础价格',
  `area` float(6,2) DEFAULT NULL COMMENT '房源面积',
  `bedroom` int(11) DEFAULT NULL COMMENT '室',
  `livingroom` int(11) DEFAULT NULL COMMENT '厅',
  `lavatory` int(11) DEFAULT NULL COMMENT '卫',
  `notice` varchar(255) DEFAULT NULL COMMENT '入住须知',
  `traffic` varchar(255) DEFAULT NULL COMMENT '交通情况',
  `description` text,
  `plot_id` int(11) DEFAULT NULL COMMENT '小区编号',
  `is_sale` int(11) DEFAULT '0' COMMENT '是否出售',
  `sale_price` decimal(10,0) DEFAULT NULL COMMENT '出售价格',
  `floor` int(11) DEFAULT NULL COMMENT '楼层',
  `total_floors` int(11) DEFAULT NULL COMMENT '总楼层',
  `developer_id` int(11) DEFAULT NULL COMMENT '开发商',
  `video` varchar(255) DEFAULT NULL COMMENT '视频',
  `manager_id` int(11) DEFAULT NULL COMMENT '房屋管理员',
  `is_delete` int(11) DEFAULT '0',
  PRIMARY KEY (`park_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='房源信息表';

-- ----------------------------
-- Records of t_park
-- ----------------------------
INSERT INTO `t_park` VALUES ('1', '哈尔滨梧桐树公寓观景大床房', '黑龙江', '哈尔滨市', '道里区', '文化路', '1500', '25.00', '2', '1', '1', '啊飞洒发发的顺丰的飞洒发大水发是飞洒发的说法大厦法定是范德萨发生飞洒发的说法的说法方式方法是否', '这寒冷的冬天来套煎饼果子，这香香的味道让你神魂颠倒，火腿肠要不要，鸡蛋要不要，我说鸡蛋你说要，鸡蛋，要，鸡蛋，要，鸡蛋鸡蛋鸡蛋，要要要。。。。。78块5', '百度贴吧是以兴趣主题聚合志同道合者的互动平台，同好网友聚集在这里交流话题、展示自我、结交朋友。贴吧主题涵盖了娱乐、游戏、小说、地区、生活等各方面', '1', '1', '500000', '4', '7', '1', null, null, '0');
INSERT INTO `t_park` VALUES ('2', '群力哈尔滨故事公寓一室一厅阳光套房', '黑龙江', '哈尔滨市', '南岸区', '劳务费', '1000', '45.00', '2', '2', '1', null, null, '百度贴吧是以兴趣主题聚合志同道合者的互动平台，同好网友聚集在这里交流话题、展示自我、结交朋友。贴吧主题涵盖了娱乐、游戏、小说、地区、生活等各方面', '1', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('3', '哈西万达禧龙公寓地中海大床房', '黑龙江', '哈尔滨市', '道里区', '二和', '2000', '55.00', '2', '2', '1', null, null, '百度贴吧是以兴趣主题聚合志同道合者的互动平台，同好网友聚集在这里交流话题、展示自我、结交朋友。贴吧主题涵盖了娱乐、游戏、小说、地区、生活等各方面', '1', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('4', '中央大街荣耀宝宇时尚索菲亚双大床四人', '黑龙江', '哈尔滨市', '道里区', '电话v个', '1800', '30.00', '2', '2', '1', null, null, '百度贴吧是以兴趣主题聚合志同道合者的互动平台，同好网友聚集在这里交流话题、展示自我、结交朋友。贴吧主题涵盖了娱乐、游戏、小说、地区、生活等各方面', '2', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('5', '中央大街旁 索菲亚附近地中海风情大床房', '黑龙江', '哈尔滨市', '道里区', '都不', '1700', '10.00', '2', '2', '1', null, null, '百度贴吧是以兴趣主题聚合志同道合者的互动平台，同好网友聚集在这里交流话题、展示自我、结交朋友。贴吧主题涵盖了娱乐、游戏、小说、地区、生活等各方面', '3', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('6', '哈西万达大盛公寓欧式大床房', '黑龙江', '哈尔滨市', '道里区', '度过', '1650', '20.00', '2', '2', '1', null, null, '百度贴吧是以兴趣主题聚合志同道合者的互动平台，同好网友聚集在这里交流话题、展示自我、结交朋友。贴吧主题涵盖了娱乐、游戏、小说、地区、生活等各方面', '2', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('7', '中央大街82平复式《北北游子居》可做饭', '黑龙江', '哈尔滨市', '道里区', '安委会', '800', '33.00', '2', '2', '1', null, null, '百度贴吧是以兴趣主题聚合志同道合者的互动平台，同好网友聚集在这里交流话题、展示自我、结交朋友。贴吧主题涵盖了娱乐、游戏、小说、地区、生活等各方面', '2', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('8', '乐松商圈凯旋广场温馨舒适的两居室', '黑龙江', '哈尔滨市', '道里区', ' sebv', '55', '33.00', '2', '2', '1', null, null, null, '1', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('9', '学府四道街 复式豪宅', '黑龙江', '哈尔滨市', '道里区', '号v电话', '8888', '33.00', '2', '2', '1', null, null, null, '2', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('10', '好的GV更待何时v喝点水', '黑龙江', '哈尔滨市', '道里区', '文化路', '12541', '33.00', '2', '2', '1', null, null, null, '2', '0', null, null, null, null, null, '38', '0');
INSERT INTO `t_park` VALUES ('11', '哈尔滨哈西万达豪华家庭房 ', '黑龙江', '哈尔滨市', '道里区', 'sss', '333', '33.00', '2', '2', '1', null, null, null, '3', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('12', '哈尔滨斯维登凯旋广场高级市景大床房', '黑龙江', '哈尔滨市', '南岗区', '凯旋广场', '315', '33.00', '2', '1', '1', null, null, '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">◆公寓位于香坊区乐松商圈，马路对面即是乐松购物广场，松雷商场和家乐福超市都伴其左右，在这里，无论是想购物、娱乐，或是美食，都可以一次性满足你，还有万达影城，酒足饭饱后还可以看场电影，感受好莱坞大片的震撼，在这里万达陪你度过一个美好的周末；</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">◆房间温馨舒适，家具家电一应俱全、配备全自动滚筒洗衣机、热水器、空调、42LED液晶电视（中央频道齐全）、高速WIFI，所有房间均为明窗，房间采用高星级酒店配备标准，干净、舒适、便捷的居住体验是您商务出差、旅游度假的首选。</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">◆公寓近小吃街，步行可达，一路边逛边吃，小吃香气扑鼻，走进去，你变迈不动腿，在这里你可以满足自己吃货的心。交通便利，公交线路齐全，机场巴士二号线乐松广场站，距离哈西火车站、客运站二十分钟车程；周边餐饮、咖啡厅，娱乐场所齐全。</span></p>', '1', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('13', '哈尔滨斯维登凯旋广场高级市景大床房aaaaaaaaaaa', '黑龙江', '哈尔滨市', '道里区', 'bbbbbbbbbb', '4000', '33.00', '3', '2', '2', null, null, '', '3', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('14', '哈尔滨斯维登凯旋广场高级市景大床房', '黑龙江', '哈尔滨市', '道里区', '凯旋广场', null, '33.00', '2', '2', '2', null, null, null, '1', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('15', '哈尔滨斯维登凯旋广场高级市景大床房vvvvvv', '黑龙江', '哈尔滨市', '市辖区', 'vvvvvvv', '11111', '33.00', '1', '1', '1', null, null, '', '1', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('16', '观江国际豪华房', '黑龙江', '哈尔滨市', '道外区', '23445667号', '4500', '33.00', '2', '1', '1', null, null, '<p>房子好的不得了啊</p>', '2', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('17', '群力花园豪华型', '黑龙江', '哈尔滨市', '市辖区', '群力花园3栋301', '5000', '33.00', '3', '2', '2', '', '', '<p>放大放大</p>', '1', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('18', '方法反反复复反复', '黑龙江', '哈尔滨市', '市辖区', 'vvvvvvvvvvv', '5000', '33.00', '3', '2', '2', '<p>噶哥哥哥哥</p>', '<p>嘎嘎个个</p>', '<p>刚发给人</p>', '2', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_park` VALUES ('19', '哈尔滨斯维登凯旋广场高级市景大床房', '黑龙江', '哈尔滨市', '道里区', 'faefeafef', '3000', '33.00', '2', '1', '1', '', '', '', '1', '1', '500000', '4', '7', '2', '', null, '0');
INSERT INTO `t_park` VALUES ('20', '去去去去去去去去去去', '黑龙江', '哈尔滨市', '市辖区', '发发的撒案发', '2222', null, '2', '1', '1', '&lt;p&gt;啊啊啊啊啊啊啊啊&lt;/p&gt;', '&lt;p&gt;啊啊啊啊啊啊啊啊&lt;/p&gt;', '&lt;p&gt;啊啊啊啊啊啊啊&lt;/p&gt;', '1', '0', '0', '0', '0', '1', '', null, '0');
INSERT INTO `t_park` VALUES ('21', 'aaaaaaa', '黑龙江', '哈尔滨市', '市辖区', 'aaaaaaaa', '1111', null, '2', '1', '1', '&lt;p&gt;gagdsagd&lt;/p&gt;', '&lt;p&gt;gasgds&lt;/p&gt;', '&lt;p&gt;gagdagad&lt;/p&gt;', '1', '0', '0', '0', '0', '1', '', null, '0');
INSERT INTO `t_park` VALUES ('22', 'testee', '黑龙江', '哈尔滨市', '市辖区', 'feeeeeeeeee', '3333', null, '2', '2', '2', '', '', '<p>fafe</p>', '1', '0', '0', '0', '0', '1', '', null, '1');
INSERT INTO `t_park` VALUES ('23', '中央大街荣耀宝宇时尚索菲亚双大床四人间', '黑龙江', '哈尔滨市', '市辖区', '哈尔滨道里区宝宇荣耀上城温莎国际公寓 ', '1800', null, '3', '2', '1', 'qweqew', 'qweqweqwe', '<p>qweqweqwe</p>', '1', '1', '900000', '5', '12', '5', '', '21', '0');
INSERT INTO `t_park` VALUES ('24', '哈西浪漫公寓温馨大床房', '黑龙江', '哈尔滨市', '南岗区', '哈尔滨南岗区哈西万达公寓', '1200', null, '2', '1', '1', '押金¥100.00银联标识信用卡外卡信用卡13:00之后入住12:00之前退房允许吸烟提供发票接待外宾允许带宠物\r\n24:00~24:00接待', '周边五百米服务：超市、菜市场、提款机、药店、餐厅、儿童乐园', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">哈尔滨素有东方小巴黎的美誉，中西合璧的城市风貌，粗犷豪放的民族风情令人沉醉。公寓坐落在美丽的哈尔滨西站旁，紧邻万达广场，步行15分钟便可到达哈尔滨西站。公寓主楼32层，开阔的视野让您一览北国冰城美景。</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">公寓装修温馨整洁，房间宽敞明亮，舒适感极强。屋内摆放着有精美大雕花的欧式家具，以及梦幻的水晶吊灯，尽显奢华及典雅。整洁的卧床、柔软的床品，能带给您良好的休息与睡眠体验，让疲惫的身心得到及时的舒展和放松。公寓内24小时热水、液晶电视、十兆光纤、WiFi无线上网、冰箱、洗衣机等一应俱全，电磁炉、齐备的厨具餐具更是让身在异乡的您也能亲自下厨为家人朋友做上一顿可口的饭菜，卫生间内各种洗浴用品也很齐全。</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">下楼过个马路就是繁华的万达商场，吃货们有许多美食可以选择，购物狂们也可以尽情享受买买买的快乐，广场上还会不定期举办夏日音乐会等各类活动。公寓周边有电影院，结束一天的行程再去悠闲地看场电影也是极好的，附近的超市也可为您的日常采买提供无限便利。</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">距离哈西万达、西客站商圈3.9公里，约8分钟车程；</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">距离哈尔滨太平国际机场33.2公里，约5分钟车程。</span></p>', '1', '1', '500000', '2', '3', '4', '', '21', '0');
INSERT INTO `t_park` VALUES ('25', '近冰雪大世界百纳度假别墅', '黑龙江', '哈尔滨市', '松北区', '哈尔滨江北报达雅苑', '1200', null, '2', '1', '1', '押金¥1000.0014:00之后入住11:00之前退房提供发票银联标识信用卡外卡信用卡接待外宾允许吸烟允许带宠物\r\n00:00~24:00接待', '交通特方便', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">致力于打造哈尔滨高B格聚会场地，我们不山寨，只做自己的独特风格。凯芙团队经营多家聚会别墅，多家情侣日租，聚会房，多种房源，多种选择，经营多年，经验丰富！别墅位于报达雅苑别墅区，安保严格，全程您无须担忧小伙伴的安全问题！24小时管家服务，随时随地为您解忧。</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">1.KTV区域：海量曲库尽情下载，专业音响，喊破您的喉咙！</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">2.台球区域：标准品牌台球桌，没事儿来一杆，管家小哥球技不错，可以一起约起来！</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">3.就餐区：餐桌长度3.6米，容纳多人用餐。并可加桌！</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">4.游戏区：配备Xbox&nbsp;360、街机（拳皇对打，五百合一，玩到手抖）多台游戏电脑，一起开LOL！别墅WiFI覆盖。</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">5.厨艺区：我们将免费为您提供厨具餐具，天然气，电磁炉，带好您的食材，一展厨艺！</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">6.全自动麻将机，嗨一晚赢到手软。</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">7.独家大型桌上足球，另有桌上冰球，多人PK!</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">8.睡眠空间：纯实木上下铺，超长榻榻米，两张欧式大床，配备空调！</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">9.另有专业厨师可为您定制私家菜品，并免费提供烧烤炉具！&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br/><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, &quot;Hiragino Sans GB&quot;, &quot;Segoe UI&quot;, &quot;Microsoft Yahei&quot;, 微软雅黑, Tahoma, Arial, STHeiti, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">一切Ready，等您来！</span></p>', '4', '1', '80000', '3', '6', '7', '', '21', '0');
INSERT INTO `t_park` VALUES ('26', '群力家园新装修，拎包即住', '黑龙江', '哈尔滨市', '道里区', '机场路融江路', '220', null, '2', '1', '1', '提供发票，押金¥400，银联标识，信用卡，外卡，信用卡，12:00之后入住，14:00之前退房，允许吸烟，允许带宠物，接待外宾', '17路：滇池路站，龙章路公交首末站 71路：新三中站 32路：新三中站 95路：新三中站 218路：新三中站 59路：穆斯林小区站 113路：新三中站 125路：龙章路公交首末站 65路：群力家园A区站 66路：群力家园A区站', '<p>群力家园项目位于道里区规划伊春路，龙章路，东湖路周边地段，占地面积61.22万平方米，规划总面积约为210.37万平方米，规划住宅共95栋，住宅总建筑面积约166.47万平方米，商服总建筑面积约为9.34万平方米，其中可售商服面积为8.01万平方米，配建公共用房1.33万平方米。地下车库总建筑面积34.55万平方米。投资额约105.32亿元。项目划分为A区、B区、C区、D区、E区、F区、G区、K区、Q区和S区等10个独立封闭区域。分一期、二期建设。</p><p>小区容积率2.76，绿化面积19万平方米，绿化率30%，小区配建有1.2万平方米大型超市，有医疗中心，老少活动中心，体育健身中心，幼儿园和托儿所，中小学。为方便居民交通建设了公交枢纽站，目前经停小区的有65路、66路、33路、117路、124路和125路等6条公交线路。</p><p>指标：</p><p>用地面积：61.22万平方米</p><p>幢数：95栋</p><p>&nbsp;</p><p>楼层数：8、11、18、22、26层</p><p>&nbsp;</p><p>总建筑面积：210.37万平方米</p><p>&nbsp;</p><p>商铺面积：8.01万平方米</p><p>&nbsp;</p><p>住宅建筑面积：166.47万平方米</p><p>&nbsp;</p><p>地下车场建筑面积：34.55万平方米</p><p>&nbsp;</p><p>总户数：14124户</p><p>&nbsp;</p><p>小区车位：9219个</p><p><br/></p>', '9', '0', '0', '0', '0', '7', '', '21', '0');

-- ----------------------------
-- Table structure for t_park_img
-- ----------------------------
DROP TABLE IF EXISTS `t_park_img`;
CREATE TABLE `t_park_img` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `is_main` int(1) DEFAULT NULL COMMENT '是否主图',
  `img_thumb_src` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `img_src` varchar(255) DEFAULT NULL COMMENT '源图',
  `description` varchar(255) DEFAULT NULL COMMENT '图片说明',
  `park_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`img_id`),
  KEY `house_id` (`park_id`),
  CONSTRAINT `house_img_fk` FOREIGN KEY (`park_id`) REFERENCES `t_park` (`park_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='房源图片信息表';

-- ----------------------------
-- Records of t_park_img
-- ----------------------------
INSERT INTO `t_park_img` VALUES ('1', '0', 'uploads\\houseImg\\houseSmall\\housePic6.jpg', 'uploads\\houseImg\\houseBig\\housePic6.jpg', null, '1');
INSERT INTO `t_park_img` VALUES ('2', '0', 'uploads\\houseImg\\houseSmall\\housePic1.jpg', 'uploads\\houseImg\\houseBig\\housePic1.jpg', null, '1');
INSERT INTO `t_park_img` VALUES ('3', '1', 'uploads\\houseImg\\houseSmall\\housePic2.jpg', 'uploads\\houseImg\\houseBig\\housePic2.jpg', null, '1');
INSERT INTO `t_park_img` VALUES ('4', '0', 'uploads\\houseImg\\houseSmall\\housePic3.jpg', 'uploads\\houseImg\\houseBig\\housePic3.jpg', null, '1');
INSERT INTO `t_park_img` VALUES ('5', '0', 'uploads\\houseImg\\houseSmall\\housePic4.jpg', 'uploads\\houseImg\\houseBig\\housePic4.jpg', null, '1');
INSERT INTO `t_park_img` VALUES ('6', '1', 'uploads\\houseImg\\houseSmall\\housePic3.jpg', 'uploads\\houseImg\\houseBig\\housePic4.jpg', null, '9');
INSERT INTO `t_park_img` VALUES ('7', '1', 'uploads\\houseImg\\houseSmall\\housePic3.jpg', 'uploads\\houseImg\\houseBig\\housePic4.jpg', null, '10');
INSERT INTO `t_park_img` VALUES ('8', '1', 'uploads\\houseImg\\houseSmall\\housePic3.jpg', 'uploads\\houseImg\\houseBig\\housePic4.jpg', null, '4');
INSERT INTO `t_park_img` VALUES ('9', '1', 'uploads\\houseImg\\houseSmall\\housePic4.jpg', 'uploads\\houseImg\\houseBig\\housePic4.jpg', null, '2');
INSERT INTO `t_park_img` VALUES ('10', '1', 'uploads\\houseImg\\houseSmall\\housePic3.jpg', 'uploads\\houseImg\\houseBig\\housePic4.jpg', null, '3');
INSERT INTO `t_park_img` VALUES ('11', '1', 'uploads\\houseImg\\houseSmall\\housePic3.jpg', 'uploads\\houseImg\\houseBig\\housePic3.jpg', null, '16');
INSERT INTO `t_park_img` VALUES ('12', '0', 'uploads\\houseImg\\houseSmall\\housePic3.jpg', 'uploads\\houseImg\\houseBig\\housePic3.jpg', null, '16');
INSERT INTO `t_park_img` VALUES ('13', '1', 'uploads\\houseImg\\houseSmall\\housePic3.jpg', 'uploads\\houseImg\\houseBig\\housePic3.jpg', null, '12');
INSERT INTO `t_park_img` VALUES ('14', '0', 'uploads/houseImg/houseSmall/housePic4.jpg', 'uploads\\houseImg\\houseBig\\housePic4.jpg', null, '12');
INSERT INTO `t_park_img` VALUES ('17', '1', 'uploads/houseImg/houseSmall/148855513929687.png', 'uploads/houseImg/houseBig/148855513929687.png', null, '21');
INSERT INTO `t_park_img` VALUES ('18', '1', 'uploads/houseImg/houseSmall/148876674937239.png', 'uploads/houseImg/houseBig/148876674937239.png', null, '22');
INSERT INTO `t_park_img` VALUES ('19', '0', 'uploads/houseImg/houseSmall/148876675389333.png', 'uploads/houseImg/houseBig/148876675389333.png', null, '22');
INSERT INTO `t_park_img` VALUES ('20', '1', 'uploads/houseImg/houseSmall/148983832965751.jpg', 'uploads/houseImg/houseBig/148983832965751.jpg', null, '23');
INSERT INTO `t_park_img` VALUES ('21', '1', 'uploads/houseImg/houseSmall/148993832988953.jpg', 'uploads/houseImg/houseBig/148993832988953.jpg', null, '24');
INSERT INTO `t_park_img` VALUES ('22', '0', 'uploads/houseImg/houseSmall/148993833692026.jpg', 'uploads/houseImg/houseBig/148993833692026.jpg', null, '24');
INSERT INTO `t_park_img` VALUES ('23', '1', 'uploads/houseImg/houseSmall/148994236536344.jpg', 'uploads/houseImg/houseBig/148994236536344.jpg', null, '25');
INSERT INTO `t_park_img` VALUES ('24', '0', 'uploads/houseImg/houseSmall/148994237119614.jpg', 'uploads/houseImg/houseBig/148994237119614.jpg', null, '25');
INSERT INTO `t_park_img` VALUES ('25', '1', 'uploads/houseImg/houseSmall/148998164017572.jpg', 'uploads/houseImg/houseBig/148998164017572.jpg', null, '26');
INSERT INTO `t_park_img` VALUES ('26', '0', 'uploads/houseImg/houseSmall/148998166452610.jpg', 'uploads/houseImg/houseBig/148998166452610.jpg', null, '26');
INSERT INTO `t_park_img` VALUES ('27', '0', 'uploads/houseImg/houseSmall/148998170229360.jpg', 'uploads/houseImg/houseBig/148998170229360.jpg', null, '26');
INSERT INTO `t_park_img` VALUES ('28', '0', 'uploads/houseImg/houseSmall/148998170690022.jpg', 'uploads/houseImg/houseBig/148998170690022.jpg', null, '26');
INSERT INTO `t_park_img` VALUES ('29', '0', 'uploads/houseImg/houseSmall/148998172050130.jpg', 'uploads/houseImg/houseBig/148998172050130.jpg', null, '26');
INSERT INTO `t_park_img` VALUES ('30', '0', 'uploads/houseImg/houseSmall/148998172631871.jpg', 'uploads/houseImg/houseBig/148998172631871.jpg', null, '26');

-- ----------------------------
-- Table structure for t_park_rent_type
-- ----------------------------
DROP TABLE IF EXISTS `t_park_rent_type`;
CREATE TABLE `t_park_rent_type` (
  `rent_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rent_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_park_rent_type
-- ----------------------------

-- ----------------------------
-- Table structure for t_park_type
-- ----------------------------
DROP TABLE IF EXISTS `t_park_type`;
CREATE TABLE `t_park_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_park_type
-- ----------------------------
INSERT INTO `t_park_type` VALUES ('1', '一字型');
INSERT INTO `t_park_type` VALUES ('2', '非字型');
INSERT INTO `t_park_type` VALUES ('3', '斜位停车');
INSERT INTO `t_park_type` VALUES ('4', '豪华型');

-- ----------------------------
-- Table structure for t_plot
-- ----------------------------
DROP TABLE IF EXISTS `t_plot`;
CREATE TABLE `t_plot` (
  `plot_id` int(11) NOT NULL AUTO_INCREMENT,
  `plot_name` varchar(100) DEFAULT NULL COMMENT '小区名称',
  `plot_delete` int(11) DEFAULT '0',
  `developer_id` int(11) DEFAULT NULL COMMENT '开发商',
  `description` text COMMENT '小区描述',
  `video` varchar(255) DEFAULT NULL COMMENT '视频链接',
  `plot_pos` varchar(30) DEFAULT '126.639003,45.76703' COMMENT '小区坐标',
  PRIMARY KEY (`plot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='房源小区信息表';

-- ----------------------------
-- Records of t_plot
-- ----------------------------
INSERT INTO `t_plot` VALUES ('1', '康泰嘉园', '0', '12', '', '', '126.639003,45.76703');
INSERT INTO `t_plot` VALUES ('2', '熙俊印象', '0', '8', '&lt;p&gt;熙俊印象&lt;/p&gt;', '', '126.639003,45.76703');
INSERT INTO `t_plot` VALUES ('3', '欣欣怡园', '0', '9', '&lt;p&gt;欣欣怡园&lt;/p&gt;', '', '126.639003,45.76703');
INSERT INTO `t_plot` VALUES ('4', '玫瑰湾', '0', '10', '&lt;p&gt;玫瑰湾&lt;/p&gt;', '', '126.639003,45.76703');
INSERT INTO `t_plot` VALUES ('5', '雨阳名居', '0', '11', '&lt;p&gt;雨阳名居&lt;/p&gt;', '', '126.639003,45.76703');
INSERT INTO `t_plot` VALUES ('6', '群力家园', '0', '7', '&lt;p&gt;群力家园&lt;/p&gt;', '', '126.639003,45.76703');

-- ----------------------------
-- Table structure for t_recommend
-- ----------------------------
DROP TABLE IF EXISTS `t_recommend`;
CREATE TABLE `t_recommend` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `park_id` int(11) DEFAULT NULL COMMENT '房源id',
  `rec_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '推荐时间',
  `rec_reason` varchar(255) DEFAULT NULL COMMENT '推荐理由',
  `rec_status` varchar(10) DEFAULT '未结束' COMMENT '推荐状态(已结束|未结束)',
  PRIMARY KEY (`rec_id`),
  KEY `house_id` (`park_id`),
  CONSTRAINT `house_recommend` FOREIGN KEY (`park_id`) REFERENCES `t_park` (`park_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='房源推荐记录表';

-- ----------------------------
-- Records of t_recommend
-- ----------------------------
INSERT INTO `t_recommend` VALUES ('1', '1', '2017-02-07 15:46:06', null, '未结束');
INSERT INTO `t_recommend` VALUES ('2', '12', '2017-03-14 11:49:04', 'qwfghjk', '未结束');
INSERT INTO `t_recommend` VALUES ('3', '10', '2017-03-14 11:49:06', 'aaaaa', '未结束');
INSERT INTO `t_recommend` VALUES ('6', '7', '2017-03-14 11:50:01', 'adfdfd', '未结束');
INSERT INTO `t_recommend` VALUES ('10', '6', '2017-03-14 11:50:17', 'fdfdfdf', '未结束');
INSERT INTO `t_recommend` VALUES ('23', '9', '2017-03-14 11:51:24', 'sssssssssss', '未结束');
INSERT INTO `t_recommend` VALUES ('24', '5', '2017-03-14 11:51:22', 'sssssssssss', '未结束');
INSERT INTO `t_recommend` VALUES ('30', '4', '2017-03-14 11:51:25', 'aaaaaaaaa', '未结束');
INSERT INTO `t_recommend` VALUES ('33', '3', '2017-03-14 11:51:26', 'vvvvvvvvvv', '未结束');
INSERT INTO `t_recommend` VALUES ('34', '2', '2017-03-14 11:51:28', 'aaaaaaaaa', '未结束');
INSERT INTO `t_recommend` VALUES ('35', '25', '2017-03-19 05:53:04', '环境超好', '未结束');

-- ----------------------------
-- Table structure for t_service
-- ----------------------------
DROP TABLE IF EXISTS `t_service`;
CREATE TABLE `t_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `plot_name` varchar(255) DEFAULT NULL,
  `house_name` varchar(255) DEFAULT NULL,
  `facility_name` varchar(255) DEFAULT NULL,
  `question_dec` varchar(255) DEFAULT NULL,
  `service_time` date DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_service
-- ----------------------------
INSERT INTO `t_service` VALUES ('5', '2', '啊啊啊', '事实上', '对对对啊啊啊', '0000-00-00');
INSERT INTO `t_service` VALUES ('6', '2', '啊啊啊', '事实上', '对对对啊啊啊', '0000-00-00');
INSERT INTO `t_service` VALUES ('7', '2', '啊啊啊', '事实上', '对对对啊啊啊', '0000-00-00');

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '登录用户名',
  `rel_name` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `password` varchar(32) NOT NULL COMMENT '密码（需md5加密）',
  `tel` varchar(20) NOT NULL COMMENT '电话',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `id_card` varchar(18) DEFAULT NULL COMMENT '身份证号',
  `sex` varchar(2) DEFAULT NULL COMMENT '性别（男|女）',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `hometown` varchar(10) DEFAULT NULL COMMENT '家乡',
  `city` varchar(10) DEFAULT NULL,
  `portrait` varchar(255) DEFAULT 'uploads/portraits/head-default.png' COMMENT '头像',
  `reg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `is_delete` varchar(1) DEFAULT '0' COMMENT '是否删除',
  `qq_id` varchar(50) DEFAULT NULL,
  `wechat_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='注册用户信息表';

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('-1', '123123123', null, '123123', '123456', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-02-22 21:09:57', '0', null, null);
INSERT INTO `t_user` VALUES ('1', '123', null, '123', '123123', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-02-23 22:52:01', '0', null, null);
INSERT INTO `t_user` VALUES ('2', '234', null, '234', '666666', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-02-23 23:26:29', '0', null, null);
INSERT INTO `t_user` VALUES ('3', '345', null, '345', '88888888', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-02-23 23:26:34', '0', null, null);
INSERT INTO `t_user` VALUES ('37', '123qwe', '罗崇', '46f94c8de14fb36680850768ff1b7f2a', '18846013862', '222@qq.com', '230921187638475822', '男', null, null, null, 'undefined', '2017-03-02 23:29:08', '0', null, null);
INSERT INTO `t_user` VALUES ('38', 'lisi', '李四', 'admin', '1234567', 'lisi@163.com', null, '1', '2017-03-17', null, null, 'uploads/portraits/head-default.png', '2017-03-17 16:24:43', '0', null, null);
INSERT INTO `t_user` VALUES ('39', 'qq123', null, '21232f297a57a5a743894a0e4a801fc3', 'admin', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-03-20 00:16:54', '0', null, null);
INSERT INTO `t_user` VALUES ('40', 'aa', null, 'admin', '123456789', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-03-27 11:30:41', '0', null, null);
INSERT INTO `t_user` VALUES ('44', '哈尔滨悦居', null, '', '', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-04-07 22:31:28', '0', 'C5E4B840D82B0B7333597BACEE687A46', null);
INSERT INTO `t_user` VALUES ('46', '吴迎', null, '', '', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-04-07 22:53:35', '0', null, 'oZDBCxDLhKjQqMRHb8mBB9MSI6K0');
INSERT INTO `t_user` VALUES ('47', '15004653965', null, '', '15004653965', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-04-09 09:45:17', '0', null, null);
INSERT INTO `t_user` VALUES ('48', 'wwwwww', null, 'd785c99d298a4e9e6e13fe99e602ef42', '15004653965', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-04-09 11:06:34', '0', null, null);
INSERT INTO `t_user` VALUES ('49', '15004653962', null, '', '15004653962', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-04-09 21:32:07', '0', null, null);
INSERT INTO `t_user` VALUES ('50', '18846013862', null, '', '18846013862', null, null, null, null, null, null, 'uploads/portraits/head-default.png', '2017-04-12 12:53:20', '0', null, null);
