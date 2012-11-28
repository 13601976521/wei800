
SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `cd_adweixin` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `original_wxid` varchar(20) NOT NULL DEFAULT '',
  `custom_wxid` varchar(50) NOT NULL DEFAULT '',
  `wxname` varchar(50) NOT NULL DEFAULT '',
  `avatar` varchar(250) NOT NULL DEFAULT '',
  `contact` varchar(20) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `qq` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `site` varchar(250) NOT NULL DEFAULT '',
  `create_time` bigint(20) NOT NULL DEFAULT '0',
  `create_ip` varchar(15) NOT NULL DEFAULT '',
  `desc` text,
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `state_idx` (`state`),
  KEY `create_time_idx` (`create_time`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

BEGIN;
INSERT INTO `cd_adweixin` VALUES ('1', '1', 'gh_sadf90kasdf', '推广账号 1', '推广账号 1', 'adavatars/2012/11/24/20121124210936_50b0c7102a7c2.png', '', '', '', '', '', '1351956408', '127.0.0.1', '推广账号 1', '1'), ('2', '0', '', '', '', 'adavatars/2012/11/03/20121103232648_509537b88c0d7.png', '', '', '', '', '', '0', '', null, '0'), ('3', '1', 'gh_dkkdllslsd', '挖段子冷笑话', '挖段子冷笑话', 'adavatars/2012/11/04/20121104151948_509617149e628.png', '', '', '', '', '', '1352013356', '127.0.0.1', '挖段子冷笑话', '1'), ('4', '0', '', '', '', 'adavatars/2012/11/04/20121104151556_5096162c3636b.png', '', '', '', '', '', '0', '', null, '0'), ('5', '1', 'gh_sadfuilsadf', '图片宽度和高度', '图片宽度和高度', '', '', '', '', '', '', '1352013633', '127.0.0.1', '图片宽度和高度', '1'), ('6', '1', 'gh_iosdfksdf', '推荐使用公众平', '推荐使用公众平', '', '', '', '', '', '', '1352013845', '127.0.0.1', '推荐使用公众平', '0'), ('7', '1', 'gh_iosdfksdf', '推荐使用公众平', '推荐使用公众平', 'adavatars/2012/11/04/20121104153009_5096198188161.png', '', '', '', '', '', '1352014209', '127.0.0.1', '推荐使用公众平', '0'), ('8', '1', 'gh_3dfdsfsdf', '添加推广微信号', '添加推广微信号', 'adavatars/2012/11/04/20121104153035_5096199b461a5.png', '', '', '', '', '', '1352014225', '127.0.0.1', '添加推广微信号', '0'), ('9', '1', 'gh_89osdfkk', 'waduanzi', '互推账号测试', 'adavatars/2012/11/18/20121118215006_50a8e78e0f9a2.png', '', '', '', '', '', '1353246543', '127.0.0.1', '', '1');
COMMIT;


DROP TABLE IF EXISTS `cd_comment`;
CREATE TABLE `cd_comment` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `content` text,
  `user_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `create_ip` varchar(15) NOT NULL DEFAULT '',
  `up_score` int(10) unsigned NOT NULL DEFAULT '0',
  `down_score` int(10) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id_state_create_time_idx` (`post_id`,`state`,`create_time`),
  KEY `user_id_create_time_idx` (`user_id`,`create_time`),
  KEY `state_idx` (`state`),
  KEY `create_time_idx` (`create_time`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `cd_config`;
CREATE TABLE `cd_config` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `config_name` varchar(100) NOT NULL DEFAULT '',
  `config_value` text,
  `name` varchar(50) NOT NULL DEFAULT '',
  `desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `config_name_UNIQUE` (`config_name`),
  KEY `category_id_id_idx` (`category_id`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='配置信息表';

BEGIN;
INSERT INTO `cd_config` VALUES ('1', '200', 'theme_name', 'classic', '模板', null), ('2', '100', 'site_name', '挖段子冷笑话2', '站点名称', null), ('3', '100', 'shortdesc', '挖段子网1', '站点描述', null);
COMMIT;

DROP TABLE IF EXISTS `cd_post`;
CREATE TABLE `cd_post` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `weixin_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `content` text,
  `view_count` bigint(19) unsigned NOT NULL DEFAULT '0',
  `back_count` bigint(19) unsigned NOT NULL DEFAULT '0',
  `share_count` bigint(19) unsigned NOT NULL DEFAULT '0',
  `comment_count` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `create_ip` varchar(15) NOT NULL DEFAULT '',
  `ad_accounts` text,
  `ad_line_count` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `weixin_id` (`weixin_id`),
  KEY `user_id` (`user_id`),
  KEY `create_time` (`create_time`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

BEGIN;
INSERT INTO `cd_post` VALUES ('1', '2', '1', 'iPhone 5，12 月 14 日见', '<p>\r\n	<img src=\"http://f.24beta.com/images/2012/11/02/20121102192514_5093ad9b31980.jpeg\" width=\"300\" height=\"188\" title=\"iphone 5 come to china by ifanr\" alt=\"iphone 5 come to china by ifanr\" /> \r\n</p>\r\n<p>\r\n	根据<a href=\"http://tech.sina.com.cn/t/2012-11-02/00437761939.shtml\" target=\"_blank\">新浪科技消</a>息，今年 12 月电信版和联通版 iPhone 5 将会“同时上市”，这是苹果在中国市场迈出的又一个重要步伐。\r\n</p>\r\n<p>\r\n	依照苹果选择周五发售新产品的规律，电信版和联通版 iPhone 5 也必将选择在周五发售。翻看一下日历，12 月的周五一共有四天：12 月 7 日、14 日、21 日、28 日。首先可以排除的是 21 日和 28 日，因为需要事先铺货为圣诞节、元旦假期作准备。那么是 12 月 7 日还是 14 日？\r\n</p>\r\n<p>\r\n	两个日期都有传闻，但依照已知的信息，12 月 14 日的时间更有可能。\r\n</p>\r\n<p>\r\n	先来看已经公开的消息：\r\n</p>\r\n9 月 26 日，联通版和电信版 iPhone 5&nbsp;<a href=\"http://www.ifanr.com/news/162285\">通过 3C 强制认证</a>10 月 25 日，苹果 CEO Tim Cook 在财报会议上透露 iPhone 5 将在 12 月登陆中国10 月 30 日，国家无线电管理网站显示苹果 iPhone 5 已在 9 月 27 日<a href=\"http://tech.sina.com.cn/mobile/n/2012-10-30/14207753410.shtml\" target=\"_blank\">获得无线电许可</a>', '1', '0', '0', '0', '1351858788', '127.0.0.1', 'Array', '0'), ('2', '2', '1', 'Something doesn\'t work. Can you fix it?', 'Something doesn\'t work. Can you fix it?Something doesn\'t work. Can you fix it?Something doesn\'t work. Can you fix it?Something doesn\'t work. Can you fix it?Something doesn\'t work. Can you fix it?Something doesn\'t work. Can you fix it?', '1', '0', '0', '0', '1351865773', '127.0.0.1', null, '0'), ('4', '2', '1', '苹果发布 iOS 6.0.1 升级补丁', '<p>\r\n	据&nbsp;<a href=\"http://thenextweb.com/apple/2012/11/01/apple-has-released-the-ios-6-0-1-for-iphones-ipads-and-ipod-touch-devices/\" target=\"_blank\">TNW</a>&nbsp;报道，苹果刚刚发布了 iOS 6.0.1 升级补丁，针对原先 iOS 6 系统内存在的一些问题和不足进行了修复。此更新目前已经开放下载，支持在线升级或是下载更新文件升级。在线升级包的大小为 69 MB，下载更新文件的大小为 983 MB，iPhone 5 用户可以直接通过&nbsp;Software Update 升级系统。\r\n</p>\r\n<p>\r\n	曾有用户反应 iPhone 5 存在键盘失灵的情况，此故障被证明是软件问题，苹果通过 iOS 6.0.1 予以了修复。此番被修复的还有 iPhone 5、iPod Touch 5 连接到加密 WPA2 WiFi 网络时的可靠性问题。具体被改进和修复的项目如下：\r\n</p>', '0', '0', '0', '0', '1351865909', '127.0.0.1', null, '0'), ('5', '2', '1', '苹果发布 iOS 6.0.1 升级补丁', '<p>\r\n	据&nbsp;<a href=\"http://thenextweb.com/apple/2012/11/01/apple-has-released-the-ios-6-0-1-for-iphones-ipads-and-ipod-touch-devices/\" target=\"_blank\">TNW</a>&nbsp;报道，苹果刚刚发布了 iOS 6.0.1 升级补丁，针对原先 iOS 6 系统内存在的一些问题和不足进行了修复。此更新目前已经开放下载，支持在线升级或是下载更新文件升级。在线升级包的大小为 69 MB，下载更新文件的大小为 983 MB，iPhone 5 用户可以直接通过&nbsp;Software Update 升级系统。\r\n</p>\r\n<p>\r\n	曾有用户反应 iPhone 5 存在键盘失灵的情况，此故障被证明是软件问题，苹果通过 iOS 6.0.1 予以了修复。此番被修复的还有 iPhone 5、iPod Touch 5 连接到加密 WPA2 WiFi 网络时的可靠性问题。具体被改进和修复的项目如下：22222\r\n</p>', '0', '0', '0', '0', '1351865917', '127.0.0.1', null, '0'), ('6', '2', '1', '苹果发布 iOS 6.0.1 升级补丁', '<p>\r\n	据&nbsp;<a href=\"http://thenextweb.com/apple/2012/11/01/apple-has-released-the-ios-6-0-1-for-iphones-ipads-and-ipod-touch-devices/\" target=\"_blank\">TNW</a>&nbsp;报道，苹果刚刚发布了 iOS 6.0.1 升级补丁，针对原先 iOS 6 系统内存在的一些问题和不足进行了修复。此更新目前已经开放下载，支持在线升级或是下载更新文件升级。在线升级包的大小为 69 MB，下载更新文件的大小为 983 MB，iPhone 5 用户可以直接通过&nbsp;Software Update 升级系统。\r\n</p>\r\n<p>\r\n	曾有用户反应 iPhone 5 存在键盘失灵的情况，此故障被证明是软件问题，苹果通过 iOS 6.0.1 予以了修复。此番被修复的还有 iPhone 5、iPod Touch 5 连接到加密 WPA2 WiFi 网络时的可靠性问题。具体被改进和修复的项目如下：22222\r\n</p>', '1', '0', '0', '0', '1351865984', '127.0.0.1', null, '0'), ('7', '3', '1', 'When working with form fields, you often want to perform s', '<span style=\"color:#444444;\">When working with form fields, you often want to perform s<span style=\"color:#444444;\">When working with form fields, you often want to perform s<span style=\"color:#444444;\">When working with form fields, you often want to perform s</span></span></span>', '0', '0', '0', '0', '1351866877', '127.0.0.1', null, '0'), ('9', '7', '1', '背景等格式给去掉，再复制粘贴', '<blockquote>\r\n	asdfasdfasfd\r\n</blockquote>\r\n<p>\r\n	背景<span style=\"color:#E53333;\">等格式给去</span>掉，再<strong>复<s>制粘贴背景等格式</s></strong>给去掉，再复<em>制粘贴背景等格</em>式给去掉，再<u>复制粘贴背</u>景等格式给去掉，再复<span style=\"color:#003399;\">制粘贴背</span>景等格式给去掉，再<span style=\"color:#337FE5;\">复制<span>粘贴背景等</span></span>格式给<span style=\"background-color:#00D5FF;\">去掉，再复制粘贴</span> \r\n</p>\r\n<p>\r\n	背景等<span style=\"font-size:24px;\">格式给</span>去掉，再复制粘贴\r\n</p>\r\n<p style=\"text-align:center;\">\r\n	<img src=\"http://f.weixin800.cn/images/2012/11/03/20121103001604_5093f1c490064.jpeg\" alt=\"\" /> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<ol>\r\n	<li>\r\n		背景等格式给去掉，再复制粘贴\r\n	</li>\r\n	<li>\r\n		背景等格式给去掉，再复制粘贴\r\n	</li>\r\n	<li>\r\n		背景等格式给去掉，再复制粘贴\r\n	</li>\r\n</ol>\r\n<p>\r\n	<br />\r\n</p>', '17', '0', '0', '0', '1351866979', '127.0.0.1', '2,3,5', '0'), ('11', '2', '1', '测试文章', '<p>\r\n	为鳖科动物鳖Trionyx sinensis Wiegmann的背甲。全年均可捕捉，杀死后置沸水中烫至背甲上硬皮能剥落时取出，除去残肉，晒干，以砂炒后醋淬用。\r\n</p>\r\n<p>\r\n	刚刚跟一个好朋友聊天八卦，她说她老公去巴基斯坦工作了&nbsp;<br />\r\n我问她老公在外面工作放心不放心 她说放心&nbsp;<br />\r\n于是引出来一个悲催又喜感的故事&nbsp;<br />\r\n据说她老公单位的某位男筒子 在国内有老婆有孩纸&nbsp;<br />\r\n在巴基斯坦工作期间搞外遇&nbsp;<br />\r\n女方怀孕了……&nbsp;<br />\r\n于是女方家人直接找到了中国大使馆……&nbsp;<br />\r\n于是 一桩单纯的婚外情上升为 国…际…问…题……&nbsp;<br />\r\n然后 男猪脚被强制送回国&nbsp;<br />\r\n强制离婚&nbsp;<br />\r\n强制开除国际&nbsp;<br />\r\n强制加入巴基斯坦国籍&nbsp;<br />\r\n强制改宗教信仰&nbsp;<br />\r\n最后&nbsp;<br />\r\n留在了巴基斯坦&nbsp;<br />\r\n于是 好友老公他们公司所有男筒子在去巴基斯坦工作之前&nbsp;<br />\r\n单位的领导都会点上一支烟 讲一讲这位用自己的生命搞外遇哥的传说。。。\r\n</p>', '0', '0', '0', '0', '1352292161', '127.0.0.1', '', '0'), ('12', '7', '1', '还是测试内容啊', '<p>\r\n	上午第一节课没课。室友发信息让她男朋友记得叫她起来9:30起床。被铃声吵醒接了电话听到有个陌生男音说，快点起床，快点起床。声音低沉。把室友吓的猛坐起身。挂了电话一看是圆通打来的。昨晚发错信息了。把给男友的信息发给圆通了。尼玛，圆通也太给力了。\r\n</p>\r\n<p>\r\n	<span></span>\r\n</p>=+----------------------+=<p>\r\n	一天一日叫旦，一天二日叫昌，一天三日叫晶，一天一小日二大日叫晿，一天九日叫旭，一天十日那就是早了，日一整天叫昊，用嘴日两次叫唱，女人自爽叫娼，精尽人亡那叫旱，站着日叫音，边日边升歌叫暗，关门再日叫间，日弯了叫电，日不进去是白，日软了叫巴，从上往下日叫由，从下往上日叫甲，日穿了就叫申。日自己叫日本；女日男不日叫公休日；男女都不日叫双休日；说要日却不日叫假日；能不日尽量不日叫节日；换着日叫交易日；现在日叫今日；公开日叫明日；背后日叫后日；七天日一次叫星期日；不认识的也日叫生日；日的情况叫日记；日的时间叫日期；日的安排叫日程。\r\n</p>=+----------------------+=<p>\r\n	中午吃饭的小店。店老板踢踢服务员：“喂，我雇你来不是让你来看电影的！你总得活动活动腿脚吧！”服务员做得踏实：“嚷什么，我昨晚不是动了一晚上腰？”听到这里我就被鱼汤呛住了，又酸又辣一个劲儿咳嗽，吓坏了老板。他过来送纸巾，红着脸解释：“他起来和面的！”“咳咳……我、我懂……”\r\n</p>=+----------------------+=办公室有一女同事，为人豪爽可爱，和老公感情特别好。有一次我们吃饭说起小三，我问她：你老公要是有外遇了，你跟他离婚吗？她斜眼看看她老公，淡淡地说：我这辈子没有离异，只有丧偶！', '20', '4', '2', '0', '1352292298', '127.0.0.1', '1', '0');
COMMIT;

DROP TABLE IF EXISTS `cd_post_weixin`;
CREATE TABLE `cd_post_weixin` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `wx_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `follow_success` bigint(19) unsigned NOT NULL DEFAULT '0',
  `follow_fail` bigint(19) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id_idx` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

BEGIN;
INSERT INTO `cd_post_weixin` VALUES ('13', '12', '1', '1', '1');
COMMIT;

DROP TABLE IF EXISTS `cd_user`;
CREATE TABLE `cd_user` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `create_ip` varchar(15) NOT NULL DEFAULT '',
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `state_id_idx` (`state`,`id`),
  KEY `create_time_idx` (`create_time`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

BEGIN;
INSERT INTO `cd_user` VALUES ('1', 'admin@24beta.com', '东子', '4297f44b13955235245b2497399d7a93', '0', '', '1', ''), ('2', 'cdcchen@gmail.com', 'cdcchen', '4297f44b13955235245b2497399d7a93', '1353503038', '127.0.0.1', '1', ''), ('3', 'cdcchen@163.com', '小东子', '4297f44b13955235245b2497399d7a93', '1353503425', '127.0.0.1', '1', '');
COMMIT;


DROP TABLE IF EXISTS `cd_weixin`;
CREATE TABLE `cd_weixin` (
  `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(19) unsigned NOT NULL DEFAULT '0',
  `original_wxid` varchar(20) NOT NULL DEFAULT '',
  `custom_wxid` varchar(50) NOT NULL DEFAULT '',
  `wxname` varchar(50) NOT NULL DEFAULT '',
  `rect_avatar` varchar(250) NOT NULL DEFAULT '',
  `circle_avatar` varchar(250) NOT NULL DEFAULT '',
  `qrcode` varchar(250) NOT NULL DEFAULT '',
  `fans_count` bigint(20) NOT NULL DEFAULT '0',
  `contact` varchar(20) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `qq` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `site` varchar(250) NOT NULL DEFAULT '',
  `tags` varchar(250) NOT NULL DEFAULT '',
  `post_count` int(11) NOT NULL DEFAULT '0',
  `create_time` bigint(20) NOT NULL DEFAULT '0',
  `create_ip` varchar(15) NOT NULL DEFAULT '',
  `desc` text,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `state` (`state`),
  KEY `create_time` (`create_time`),
  KEY `user_id_original_wxid_unique` (`user_id`,`original_wxid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

BEGIN;
INSERT INTO `cd_weixin` VALUES ('2', '1', 'gh_9261dce78e9f', 'waduanzi', '挖段子网', 'avatars/2012/11/02/20121102003604_5092a4f4bac63.jpg', 'avatars/2012/11/02/20121102004926_5092a816d9f5d.png', 'avatars/2012/11/02/20121102003604_5092a4f4bada6.jpg', '11', '陈东', '18653137700', '80171597', 'cdcchen@163.com', 'http://www.waduanzi.com', '笑话,搞笑,趣图', '0', '1351784922', '127.0.0.1', '我的挖段子冷笑话', '1'), ('3', '1', 'gh_37fd8sdfjsdfsdf', 'lengxiaohua', '冷笑话精选', '', '', '', '11111', '东子', '18653137700', '376267', '', '', '冷笑话,精选', '0', '1351791308', '127.0.0.1', '冷笑话精选', '0'), ('5', '1', 'gh_sadf8iaskdfasdf', '测试aaaaa', '测试aaaaa', '', '', '', '0', '', '', '', '', '', '', '0', '1351864975', '127.0.0.1', '', '0'), ('6', '1', 'gh_sadf8iaskddddd', '测试aaaaa', '测试 bbbb', '', '', '', '0', '', '', '', '', '', '', '0', '1351864982', '127.0.0.1', '', '0'), ('7', '1', 'gh_90adsfoiaskdf', '测试111111', '测试111111', 'avatars/2012/11/24/20121124205208_50b0c2f84783d.jpg', 'avatars/2012/11/24/20121124204833_50b0c221e5107.png', 'avatars/2012/11/24/20121124204909_50b0c24583b3b.jpg', '0', '', '', '', '', '', '', '0', '1351866006', '127.0.0.1', '测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊测试内容啊', '1'), ('8', '1', 'gh_90adsfoiaskdf', '测试111111', '测试11111122222333', '', '', '', '0', '', '', '', '', '', '', '0', '1351866008', '127.0.0.1', '', '0'), ('9', '1', 'gh_testest', '挖段子冷笑话', '挖段子冷笑话', 'avatars/2012/11/24/20121124215424_50b0d1909e26d.jpg', 'avatars/2012/11/24/20121124215424_50b0d1909e320.png', 'avatars/2012/11/24/20121124215424_50b0d1909e3de.jpg', '0', '', '', '', '', '', '', '0', '1352013322', '127.0.0.1', '挖段子冷笑话李庄向最高人民检察院提起控告，指责重庆市公安局李庄案、龚刚模案专案组(以下简称“专案组”)所有警员涉嫌徇私枉法罪，要求追究其刑事责任。昨天，最高检两名检察官约见了李庄及其代理律师王誓华，龚刚模的亲属龚刚华和龚云飞也到场。李庄向两名检察官表示，他要求重庆检方回避这起控告案。', '0'), ('11', '1', 'gh_sdafasdf8io', 'waduanzi', '这真的是一个测试', '', '', '', '0', '', '', '', '', '', '', '0', '1353246490', '127.0.0.1', 'kwg kwg kwg', '1'), ('12', '1', 'gh_sdafasdf8io', 'waduanzi', '这真的是一个测试', 'avatars/2012/11/18/20121118215020_50a8e79cb5c78.jpg', 'avatars/2012/11/18/20121118215020_50a8e79cb5d3a.png', 'avatars/2012/11/18/20121118215020_50a8e79cb5dc2.jpg', '0', '', '', '', '', '', '', '0', '1353246518', '127.0.0.1', 'kwg kwg kwg', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
