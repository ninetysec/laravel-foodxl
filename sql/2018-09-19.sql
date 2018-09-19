-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?09 �?19 �?09:02
-- 服务器版本: 5.5.53
-- PHP 版本: 7.1.22

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `fx_admins`
--

CREATE TABLE IF NOT EXISTS `fx_admins` (
  `adminid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fx_admins`
--

INSERT INTO `fx_admins` (`adminid`, `name`, `account_number`, `password`, `remember_token`, `create_time`, `update_time`) VALUES
(1, 'admin', '13111111111', '$2y$10$lRqatYiIItSUFdGu06zS1.sMfhxZsyeksZVg.sJ31MYrkFnjNJJIO', 'rFw3LkiOT3sY7t1tQO32RDnNXlf54KAXyhBMzmjU15BLVcTR3ARUZh8Cpqup', 1523669854, 1523669854),
(2, 'admini', '13222222222', '$2y$10$o9i5bQeqDqwq2XhQS/UFcOK1UXc3C0Q2E1f//OzdR3B5Hf2zN9LeC', '5uPi3lzgbEDaUZD9zKtXZ3nKAgLLyPR6dJ7okdRF1g2VmpP5wYHuxLnQyOUo', 1523669895, 1523669895);

-- --------------------------------------------------------

--
-- 表的结构 `fx_cart`
--

CREATE TABLE IF NOT EXISTS `fx_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(255) DEFAULT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT '0.00',
  `attr_value` varchar(255) DEFAULT NULL,
  `attr_id` int(11) NOT NULL DEFAULT '0',
  `number` int(11) NOT NULL DEFAULT '1',
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `skey` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `fx_cart`
--

INSERT INTO `fx_cart` (`id`, `goods_id`, `goods_name`, `price`, `attr_value`, `attr_id`, `number`, `contact_id`, `skey`) VALUES
(6, 1, '测试333', '0.00', '', 0, 1, 0, 'd3459da4c9496763749f0aeb9a69fd87'),
(7, 1, '测试333', '0.00', '', 0, 2, 0, 'cf6c7e3361fe7bb22617d220c981f001'),
(8, 1, '测试333', '0.00', '', 0, 2, 0, '1ccfa09c87f47ae0359dd24f837931f0'),
(9, 3, '测试333', '0.00', '', 0, 6, 0, '1ccfa09c87f47ae0359dd24f837931f0'),
(15, 1, '测试333', '0.00', '', 0, 2, 0, '5c83c3ff4dac60717c1b101257235356'),
(16, 5, '测试333', '1.00', '', 0, 1, 0, '9bc1a060d3793cc91c359cd573bf4106'),
(17, 1, '测试333', '0.00', '', 0, 3, 0, 'd56b9defdf7ebbc48fd6ac871e1bfe39'),
(18, 5, '测试333', '1.00', '', 0, 4, 0, 'd56b9defdf7ebbc48fd6ac871e1bfe39'),
(19, 1, '测试333', '0.00', '', 0, 1, 0, '81e76d0d793336abee17d49e7d0e1d48'),
(20, 5, '测试333', '1.00', '', 0, 1, 0, '81e76d0d793336abee17d49e7d0e1d48'),
(21, 1, '测试333', '0.00', '', 0, 2, 5, '2a1db702e914d7035cbac135d12c28b3'),
(22, 5, '测试333', '1.00', '', 0, 2, 5, '2a1db702e914d7035cbac135d12c28b3'),
(38, 6, '好吃的菜', '99.00', '', 0, 1, 0, 'd0da333f2a8936b9abf941cf3bfcd030'),
(39, 4, '测试333', '0.00', '', 0, 1, 0, 'd0da333f2a8936b9abf941cf3bfcd030'),
(40, 9, '测试1', '1.00', '', 0, 2, 0, 'c05f161608e0c30509139d0b46f0d4a6');

-- --------------------------------------------------------

--
-- 表的结构 `fx_category`
--

CREATE TABLE IF NOT EXISTS `fx_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `cat_img` varchar(255) DEFAULT NULL,
  `index` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `fx_category`
--

INSERT INTO `fx_category` (`cat_id`, `cat_name`, `cat_desc`, `parent_id`, `sort_order`, `cat_img`, `index`) VALUES
(1, '湘菜', '湘菜的备注', 0, 0, NULL, 1),
(2, '菜', '二级菜单', 1, 0, NULL, 0),
(3, '肉', '二级菜单', 1, 0, NULL, 0),
(4, '粤菜', '粤菜的备注', 0, 0, NULL, 0),
(5, '川菜', '川菜的备注', 0, 0, '/uploads/images/cat/cat_1537155823.jpg', 0),
(6, '肉', '二级菜单', 5, 0, NULL, 0),
(7, 'qqqq', 'qqq', 2, 0, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `fx_contact`
--

CREATE TABLE IF NOT EXISTS `fx_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `add_time` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `fx_contact`
--

INSERT INTO `fx_contact` (`id`, `name`, `phone`, `email`, `address`, `add_time`) VALUES
(2, 'kafu', 13111111111, 'root@scar1et.org', '创意产业园', 1523532164),
(3, 'test', 131211111111, NULL, 'asjgfjkhsdkahskjdh', 1523532178),
(4, 'test', 133211111111, NULL, 'asjgfjkhsdkahskjdh', 1523532206),
(5, 'admini', 15532370009, 'root@scar1et.org', 'sadasdasd', 1525675456),
(6, 'juhao', 13046230834, 'ces@163.com', '测试地址', 1526286679),
(7, 'admin', 768310988, 'qfdk@vip.qq.com', '去', 1526728585);

-- --------------------------------------------------------

--
-- 表的结构 `fx_goods`
--

CREATE TABLE IF NOT EXISTS `fx_goods` (
  `goods_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL,
  `goods_desc` varchar(255) NOT NULL,
  `shop_price` decimal(7,2) NOT NULL,
  `goods_img` varchar(255) DEFAULT NULL,
  `add_time` int(11) NOT NULL,
  `is_on_sale` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `click` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`),
  UNIQUE KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `fx_goods`
--

INSERT INTO `fx_goods` (`goods_id`, `cat_id`, `goods_name`, `goods_desc`, `shop_price`, `goods_img`, `add_time`, `is_on_sale`, `sort_order`, `click`) VALUES
(9, 1, '测试1', '测试1的备注', '1.00', '/uploads/images/goods/goods_1526820031.jpg', 1526819671, 1, 1, 1),
(10, 1, '测试2', '测试2的备注', '2.00', '', 1526820076, 1, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fx_goods_attr`
--

CREATE TABLE IF NOT EXISTS `fx_goods_attr` (
  `goods_attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL DEFAULT '0',
  `attr_value` varchar(255) NOT NULL,
  `attr_price` decimal(7,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`goods_attr_id`),
  UNIQUE KEY `goods_attr_id` (`goods_attr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `fx_goods_attr`
--

INSERT INTO `fx_goods_attr` (`goods_attr_id`, `goods_id`, `attr_id`, `attr_value`, `attr_price`) VALUES
(1, 1, 0, 'test', '0.00'),
(2, 1, 0, 'test', '0.00'),
(3, 3, 0, 'test', '0.00'),
(4, 3, 0, 'test', '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `fx_migrations`
--

CREATE TABLE IF NOT EXISTS `fx_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fx_migrations`
--

INSERT INTO `fx_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_04_14_004933_create_admins_table', 1);

-- --------------------------------------------------------

--
-- 表的结构 `fx_order_goods`
--

CREATE TABLE IF NOT EXISTS `fx_order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `goods_name` varchar(255) DEFAULT NULL,
  `goods_number` int(11) NOT NULL DEFAULT '1',
  `goods_price` decimal(7,2) NOT NULL,
  `goods_attr` varchar(255) DEFAULT NULL,
  `goods_attr_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `fx_order_goods`
--

INSERT INTO `fx_order_goods` (`id`, `order_id`, `goods_id`, `goods_name`, `goods_number`, `goods_price`, `goods_attr`, `goods_attr_id`) VALUES
(8, 9, 1, '产品1', 3, '1.00', '', 0),
(9, 10, 1, '测试333', 1, '0.00', '', 0),
(10, 10, 5, '测试333', 2, '1.00', '', 0),
(11, 11, 1, '测试333', 1, '0.00', '', 0),
(12, 11, 5, '测试333', 1, '1.00', '', 0),
(13, 12, 1, '测试333', 3, '0.00', '', 0),
(14, 12, 5, '测试333', 3, '1.00', '', 0),
(15, 13, 1, '测试333', 4, '0.00', '', 0),
(16, 13, 5, '测试333', 4, '1.00', '', 0),
(17, 14, 1, '测试333', 5, '0.00', '', 0),
(18, 14, 5, '测试333', 5, '1.00', '', 0),
(19, 15, 5, '测试333', 1, '1.00', '', 0),
(20, 16, 5, '测试333', 1, '1.00', '', 0),
(21, 17, 5, '测试333', 1, '1.00', '', 0),
(22, 18, 6, '好吃的菜', 1, '99.00', '', 0),
(23, 19, 5, '测试333', 1, '1.00', '', 0),
(24, 20, 5, '测试333', 3, '1.00', '', 0),
(25, 20, 6, '好吃的菜', 1, '99.00', '', 0),
(26, 21, 9, '测试1', 2, '1.00', '', 0),
(27, 22, 9, '测试1', 3, '1.00', '', 0),
(28, 23, 9, '测试1', 1, '1.00', '', 0),
(29, 24, 9, '测试1', 4, '1.00', '', 0),
(30, 25, 9, '测试1', 4, '1.00', '', 0),
(31, 26, 9, '测试1', 4, '1.00', '', 0),
(32, 27, 9, '测试1', 4, '1.00', '', 0),
(33, 28, 9, '测试1', 5, '1.00', '', 0),
(34, 29, 9, '测试1', 3, '1.00', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `fx_order_info`
--

CREATE TABLE IF NOT EXISTS `fx_order_info` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` bigint(20) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `pay_status` int(11) NOT NULL DEFAULT '0',
  `order_amount` decimal(7,2) NOT NULL DEFAULT '0.00',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `pay_time` int(11) NOT NULL DEFAULT '0',
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `skey` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `fx_order_info`
--

INSERT INTO `fx_order_info` (`order_id`, `order_sn`, `order_status`, `user_id`, `pay_status`, `order_amount`, `add_time`, `pay_time`, `contact_id`, `skey`) VALUES
(9, 2018041206448, 0, 0, 0, '3.00', 1523539749, 0, 4, '92dcac0b8ec5c2d6458c4c20adfa086e'),
(10, 2018051442329, 0, 0, 0, '1.00', 1526285249, 0, 5, '9fa85fb29612e3e4a5e1e1edfc91ddbe'),
(11, 2018051438148, 0, 0, 0, '1.00', 1526286682, 0, 6, '9fa85fb29612e3e4a5e1e1edfc91ddbe'),
(12, 2018051471455, 0, 0, 0, '3.00', 1526286797, 0, 2, '9fa85fb29612e3e4a5e1e1edfc91ddbe'),
(13, 2018051463527, 0, 0, 0, '1.00', 1526289607, 0, 6, '9fa85fb29612e3e4a5e1e1edfc91ddbe'),
(14, 2018051453382, 0, 0, 0, '5.00', 1526289716, 0, 6, '9fa85fb29612e3e4a5e1e1edfc91ddbe'),
(15, 2018051933346, 0, 0, 0, '1.00', 1526728493, 0, 0, '1fcec6cb03a64fcdaab9738734941c56'),
(16, 2018051948381, 0, 0, 0, '1.00', 1526728598, 0, 7, '1fcec6cb03a64fcdaab9738734941c56'),
(17, 2018051990664, 0, 0, 0, '1.00', 1526728768, 0, 7, '1fcec6cb03a64fcdaab9738734941c56'),
(18, 2018051955612, 0, 0, 0, '99.00', 1526730375, 0, 7, '1fcec6cb03a64fcdaab9738734941c56'),
(19, 2018051951773, 0, 0, 0, '1.00', 1526730527, 0, 7, '1fcec6cb03a64fcdaab9738734941c56'),
(20, 2018051972082, 0, 0, 0, '102.00', 1526740390, 0, 0, '16f9e95a035c4622251cbe166ddfc2d7'),
(21, 2018052104637, 0, 0, 0, '2.00', 1526864330, 0, 5, '7684241a05c60c7db8e846eb61005949'),
(22, 2018052182628, 0, 0, 0, '3.00', 1526866872, 0, 0, '7684241a05c60c7db8e846eb61005949'),
(23, 2018052101468, 0, 0, 0, '1.00', 1526867032, 0, 0, '7684241a05c60c7db8e846eb61005949'),
(24, 2018052177647, 0, 0, 0, '4.00', 1526867278, 0, 5, '7684241a05c60c7db8e846eb61005949'),
(25, 2018052132170, 0, 0, 0, '4.00', 1526867653, 0, 5, '7684241a05c60c7db8e846eb61005949'),
(26, 2018052123081, 0, 0, 0, '4.00', 1526867699, 0, 5, '7684241a05c60c7db8e846eb61005949'),
(27, 2018052142155, 0, 0, 0, '4.00', 1526868056, 0, 5, '7684241a05c60c7db8e846eb61005949'),
(28, 2018052123917, 0, 0, 0, '5.00', 1526869348, 0, 6, '7684241a05c60c7db8e846eb61005949'),
(29, 2018052197196, 0, 0, 0, '3.00', 1526870211, 0, 5, '7684241a05c60c7db8e846eb61005949');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
