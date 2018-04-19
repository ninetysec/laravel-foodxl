-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-04-14 18:13:41
-- 服务器版本： 5.5.57-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `fx_admins`
--

CREATE TABLE IF NOT EXISTS `fx_admins` (
  `adminid` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `fx_admins`
--

INSERT INTO `fx_admins` (`adminid`, `name`, `account_number`, `password`, `remember_token`, `create_time`, `update_time`) VALUES
(1, 'admin', '13111111111', '$2y$10$lRqatYiIItSUFdGu06zS1.sMfhxZsyeksZVg.sJ31MYrkFnjNJJIO', 'yI2JCtyW03jnJpmiBEMcC31I6TbzxX2pdJ6aUp6fIBS4j72eVp0Dw8ezE5j9', 1523669854, 1523669854),
(2, 'admini', '13222222222', '$2y$10$o9i5bQeqDqwq2XhQS/UFcOK1UXc3C0Q2E1f//OzdR3B5Hf2zN9LeC', '5uPi3lzgbEDaUZD9zKtXZ3nKAgLLyPR6dJ7okdRF1g2VmpP5wYHuxLnQyOUo', 1523669895, 1523669895);

-- --------------------------------------------------------

--
-- 表的结构 `fx_cart`
--

CREATE TABLE IF NOT EXISTS `fx_cart` (
  `id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(255) DEFAULT NULL,
  `price` decimal(7,2) NOT NULL DEFAULT '0.00',
  `attr_value` varchar(255) DEFAULT NULL,
  `attr_id` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '1',
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `skey` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `fx_category`
--

CREATE TABLE IF NOT EXISTS `fx_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `fx_category`
--

INSERT INTO `fx_category` (`cat_id`, `cat_name`, `cat_desc`, `parent_id`, `sort_order`) VALUES
(1, '测试333', ' ', 2, 0),
(2, '分类2', '分类1的子类', 1, 0),
(3, '测试11', '', 0, 0),
(4, '测试11', '', 0, 0),
(5, '测试11', '', 0, 0),
(6, '测试112', '', 0, 0),
(7, '测试333', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fx_contact`
--

CREATE TABLE IF NOT EXISTS `fx_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `add_time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `fx_contact`
--

INSERT INTO `fx_contact` (`id`, `name`, `phone`, `address`, `add_time`) VALUES
(2, 'test', 13111111111, 'asjgfjkhsdkahskjdh', 1523532164),
(3, 'test', 131211111111, 'asjgfjkhsdkahskjdh', 1523532178),
(4, 'test', 133211111111, 'asjgfjkhsdkahskjdh', 1523532206);

-- --------------------------------------------------------

--
-- 表的结构 `fx_goods`
--

CREATE TABLE IF NOT EXISTS `fx_goods` (
  `goods_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `goods_name` varchar(255) NOT NULL,
  `goods_desc` varchar(255) NOT NULL,
  `shop_price` decimal(7,2) NOT NULL,
  `goods_img` varchar(255) DEFAULT NULL,
  `add_time` int(11) NOT NULL,
  `is_on_sale` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `fx_goods`
--

INSERT INTO `fx_goods` (`goods_id`, `cat_id`, `goods_name`, `goods_desc`, `shop_price`, `goods_img`, `add_time`, `is_on_sale`, `sort_order`) VALUES
(1, 1, '测试333', ' ', '0.00', '/uploads/images/2018-04/1523521513.jpg', 1523521513, 1, 0),
(2, 0, '测试333', '', '0.00', NULL, 1523694358, 1, 0),
(3, 0, '测试333', '', '0.00', NULL, 1523694757, 1, 0),
(4, 0, '测试333', '', '0.00', NULL, 1523699057, 1, 0),
(5, 0, '测试333', '', '0.00', NULL, 1523699131, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fx_goods_attr`
--

CREATE TABLE IF NOT EXISTS `fx_goods_attr` (
  `goods_attr_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL DEFAULT '0',
  `attr_value` varchar(255) NOT NULL,
  `attr_price` decimal(7,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `goods_name` varchar(255) DEFAULT NULL,
  `goods_number` int(11) NOT NULL DEFAULT '1',
  `goods_price` decimal(7,2) NOT NULL,
  `goods_attr` varchar(255) DEFAULT NULL,
  `goods_attr_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `fx_order_goods`
--

INSERT INTO `fx_order_goods` (`id`, `order_id`, `goods_id`, `goods_name`, `goods_number`, `goods_price`, `goods_attr`, `goods_attr_id`) VALUES
(8, 9, 1, '产品1', 3, '1.00', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `fx_order_info`
--

CREATE TABLE IF NOT EXISTS `fx_order_info` (
  `order_id` int(11) NOT NULL,
  `order_sn` bigint(20) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `pay_status` int(11) NOT NULL DEFAULT '0',
  `order_amount` decimal(7,2) NOT NULL DEFAULT '0.00',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `pay_time` int(11) NOT NULL DEFAULT '0',
  `contact_id` int(11) NOT NULL DEFAULT '0',
  `skey` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `fx_order_info`
--

INSERT INTO `fx_order_info` (`order_id`, `order_sn`, `order_status`, `user_id`, `pay_status`, `order_amount`, `add_time`, `pay_time`, `contact_id`, `skey`) VALUES
(9, 2018041206448, 0, 0, 0, '1.00', 1523539749, 0, 4, '92dcac0b8ec5c2d6458c4c20adfa086e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fx_admins`
--
ALTER TABLE `fx_admins`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `fx_cart`
--
ALTER TABLE `fx_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `fx_category`
--
ALTER TABLE `fx_category`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_id` (`cat_id`);

--
-- Indexes for table `fx_contact`
--
ALTER TABLE `fx_contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `fx_goods`
--
ALTER TABLE `fx_goods`
  ADD PRIMARY KEY (`goods_id`),
  ADD UNIQUE KEY `goods_id` (`goods_id`);

--
-- Indexes for table `fx_goods_attr`
--
ALTER TABLE `fx_goods_attr`
  ADD PRIMARY KEY (`goods_attr_id`),
  ADD UNIQUE KEY `goods_attr_id` (`goods_attr_id`);

--
-- Indexes for table `fx_migrations`
--
ALTER TABLE `fx_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fx_order_goods`
--
ALTER TABLE `fx_order_goods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `fx_order_info`
--
ALTER TABLE `fx_order_info`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fx_admins`
--
ALTER TABLE `fx_admins`
  MODIFY `adminid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fx_cart`
--
ALTER TABLE `fx_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fx_category`
--
ALTER TABLE `fx_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `fx_contact`
--
ALTER TABLE `fx_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fx_goods`
--
ALTER TABLE `fx_goods`
  MODIFY `goods_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fx_goods_attr`
--
ALTER TABLE `fx_goods_attr`
  MODIFY `goods_attr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fx_migrations`
--
ALTER TABLE `fx_migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fx_order_goods`
--
ALTER TABLE `fx_order_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fx_order_info`
--
ALTER TABLE `fx_order_info`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
