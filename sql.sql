-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-08-24 05:55:10
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `roads`
--

-- --------------------------------------------------------

--
-- 表的结构 `bs_auth_group`
--

CREATE TABLE IF NOT EXISTS `bs_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `describe` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `bs_auth_group`
--

INSERT INTO `bs_auth_group` (`id`, `module`, `title`, `status`, `rules`, `describe`) VALUES
(1, '', '网站创建者', 1, '', '网站拥有者，具有最高权限'),
(2, '', '管理员', 1, '1,1,2,2,4,4,5,5,6,6,7,7,9,9', '站内管理，审核人员'),
(3, '', '参与者', 1, '', '来宾，网站注册用户');

-- --------------------------------------------------------

--
-- 表的结构 `bs_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `bs_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bs_auth_group_access`
--

INSERT INTO `bs_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(10, 2),
(222, 3),
(225, 3),
(229, 3);

-- --------------------------------------------------------

--
-- 表的结构 `bs_auth_rule`
--

CREATE TABLE IF NOT EXISTS `bs_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL DEFAULT '' COMMENT '规则所属module',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` smallint(5) NOT NULL,
  `sort` smallint(3) DEFAULT NULL COMMENT '排序',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `model` (`module`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `bs_auth_rule`
--

INSERT INTO `bs_auth_rule` (`id`, `module`, `name`, `title`, `type`, `status`, `condition`, `pid`, `sort`, `create_time`) VALUES
(1, '', 'Admin/Index/index', '权限列表', 1, 1, '', 0, 0, NULL),
(2, '', 'Admin/Index', '登录后台', 1, 1, '', 0, 0, NULL),
(4, '', 'Pulp', '权限列表', 1, 1, '', 0, 0, NULL),
(5, '', 'Admin/Pulp', '权限列表', 1, 1, '', 0, 0, NULL),
(6, '', 'Pulp/clear_cache', '清楚缓存', 1, 1, 'ggg', 0, 50, NULL),
(7, '', 'Menu/index', '菜单管理', 1, 1, '', 0, 0, 1453214009),
(8, '', 'ceshi/index', 'ceshi', 1, 1, '', 1, 1, 1453216496),
(9, '', 'Music/index', '歌曲', 1, 1, '', 0, 0, 1453712383),
(10, '', 'Music/add', '添加歌曲', 1, 1, '', 0, 0, 1471950485);

-- --------------------------------------------------------

--
-- 表的结构 `bs_config`
--

CREATE TABLE IF NOT EXISTS `bs_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `bs_config`
--

INSERT INTO `bs_config` (`id`, `name`, `type`, `title`, `group`, `extra`, `remark`, `create_time`, `update_time`, `status`, `value`, `sort`) VALUES
(1, 'WEB_SITE_TITLE', 0, '网站标题', 0, '', '网站标题前台显示标题', 1378898976, 1456491029, 1, 'Seventy-two', 0),
(2, 'WEB_SITE_DESCRIPTION', 2, '网站描述', 1, '', '网站搜索引擎描述', 1378898976, 1379235841, 1, 'OneThink内容管理框架', 1),
(3, 'WEB_SITE_KEYWORD', 2, '网站关键字', 1, '', '网站搜索引擎关键字', 1378898976, 1381390100, 1, 'ThinkPHP,OneThink', 8),
(4, 'WEB_SITE_CLOSE', 4, '关闭站点', 1, '0:关闭,1:开启', '站点关闭后其他用户不能访问，管理员可以正常访问', 1378898976, 1379235296, 1, '1', 1),
(6, 'CONFIG_TYPE_LIST', 3, '配置类型列表', 4, '', '主要用于数据解析和页面表单的生成', 1378898976, 1379235348, 1, '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举', 2),
(5, 'WEB_SITE_ICP', 0, '网站备案号', 0, '', '设置在网站底部显示的备案号，如“沪ICP备12007941号-2', 1378900335, 1456489583, 1, '', 9),
(7, 'COLOR_STYLE', 4, '后台色系', 1, 'default_color:默认\r\nblue_color:紫罗兰', '后台颜色风格', 1379122533, 1379235904, 1, 'default_color', 10);

-- --------------------------------------------------------

--
-- 表的结构 `bs_menu`
--

CREATE TABLE IF NOT EXISTS `bs_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '二级分组名',
  `identifier` char(50) NOT NULL DEFAULT 'Null' COMMENT '所属菜单标识',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

--
-- 转存表中的数据 `bs_menu`
--

INSERT INTO `bs_menu` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `tip`, `group`, `identifier`, `status`) VALUES
(1, '首页', 0, 1, 'Pulp/Index', 0, '', '', 'Null', 1),
(2, '内容', 0, 1, 'Article/index', 0, '', '', 'Null', 1),
(3, '成员列表', 1, 0, 'Admin/admin_list', 0, '', '管理成员', 'Index', 1),
(4, '角色管理', 1, 0, 'Admin/auth_group', 0, '', '管理成员', '', 1),
(5, '权限管理', 1, 0, 'Admin/auth_rule', 0, '', '管理成员', '', 1),
(6, '网站配置', 1, 0, 'Config/index', 0, '', '系统管理', 'Config', 1),
(7, '导航管理', 1, 0, 'article/update', 0, '', '系统管理', '', 1),
(8, '菜单管理', 1, 0, 'Menu/index', 0, '', '系统管理', 'Menu', 1),
(9, '模型管理', 1, 0, 'Model/index', 0, '', '系统管理', '', 1),
(10, '复制', 2, 0, 'article/copy', 0, '', '会员列表', 'article', 1),
(11, '粘贴', 1, 0, 'article/paste', 0, '', '', '', 1),
(12, '导入', 3, 0, 'article/batchOperate', 0, '', '', '', 1),
(13, '回收站', 2, 0, 'Article/recycle', 0, '', '内容', 'Article', 1),
(125, '贴吧内容', 2, 0, 'article/tieba', 0, '', '内容', '', 1),
(124, 'ceshi ', 3, 0, 'article/copyff', 1, '', '会员列表', '', 1),
(126, '歌曲', 0, 3, 'Music/Index', 0, '', '', 'Null', 1),
(128, '花儿', 126, 0, 'Music/huaer', 0, '', '歌曲', 'Null', 1),
(129, '添加歌曲', 126, 0, 'Music/add', 0, '', '歌曲', 'Null', 0);

-- --------------------------------------------------------

--
-- 表的结构 `bs_user`
--

CREATE TABLE IF NOT EXISTS `bs_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `username` varchar(20) NOT NULL COMMENT '账户',
  `nickname` varchar(10) DEFAULT NULL COMMENT '昵称',
  `password` char(32) NOT NULL COMMENT '密码',
  `entrdata` int(11) DEFAULT NULL COMMENT '登录时间',
  `regidata` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `userphone` char(15) DEFAULT NULL COMMENT '用户手机',
  `usersign` varchar(120) DEFAULT NULL COMMENT '个人签名',
  `userphoto` varchar(60) DEFAULT NULL COMMENT '个人头像',
  `useremail` varchar(32) DEFAULT NULL COMMENT '电子邮箱',
  `entryip` varchar(15) DEFAULT NULL COMMENT '登录 IP',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账户状态，禁用为0  ',
  `login_count` mediumint(8) DEFAULT NULL COMMENT '登录次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=230 ;

--
-- 转存表中的数据 `bs_user`
--

INSERT INTO `bs_user` (`id`, `username`, `nickname`, `password`, `entrdata`, `regidata`, `userphone`, `usersign`, `userphoto`, `useremail`, `entryip`, `status`, `login_count`) VALUES
(1, 'root', NULL, '21232f297a57a5a743894a0e4a801fc3', 1457101873, '2015-08-11 05:47:38', NULL, NULL, NULL, NULL, '127.0.0.1', 1, 1),
(10, 'admin', '士官长约翰-117', '21232f297a57a5a743894a0e4a801fc3', 1471959926, '2015-12-10 05:19:27', '15597302912', '面带微笑，不是因为快乐太长，是太长的时间忘了悲伤...', '/Uploads/2015-12-17/56726ada855c7.png', 'pyz315@hotmail.com', '127.0.0.1', 1, 402),
(222, 'fdsafdsaf', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, '2016-01-19 08:51:21', NULL, NULL, NULL, NULL, NULL, 1, NULL),
(225, '123456', NULL, '21232f297a57a5a743894a0e4a801fc3', 1471956654, '2016-02-25 06:42:34', NULL, NULL, NULL, NULL, '127.0.0.1', 1, 9),
(229, 'ffff', NULL, 'eed8cdc400dfd4ec85dff70a170066b7', 1457109047, '2016-02-26 08:29:42', NULL, NULL, NULL, NULL, '127.0.0.1', 1, 47);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
