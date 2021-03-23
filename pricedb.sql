-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2016 at 09:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pricedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) CHARACTER SET ascii NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `order` tinyint(4) DEFAULT '0',
  `parent` bigint(20) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `order`, `parent`, `description`, `created`) VALUES
(5, 'Consumer Basket', '603153c3760d581e73e2329a2888cada.jpg', 0, NULL, 'bread,milk', '1470568475'),
(6, 'Forex', 'e19027ec7d9fb8d6d993f381685d53d9.jpg', 0, NULL, 'Forex exchange', '1470582934'),
(7, 'Loans', NULL, 0, NULL, 'Loan data', '1471449957');

-- --------------------------------------------------------

--
-- Table structure for table `categories_info`
--

CREATE TABLE IF NOT EXISTS `categories_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` bigint(20) unsigned NOT NULL,
  `name` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  `units` varchar(256) DEFAULT NULL,
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `categories_info`
--

INSERT INTO `categories_info` (`id`, `category`, `name`, `type`, `units`, `created`) VALUES
(1, 3, 'Buying Price', 'numeric', NULL, '1470566542'),
(3, 4, 'Price', 'numeric', NULL, '1470566811'),
(4, 5, 'Price', 'numeric', 'Ksh', '1470568498'),
(5, 3, 'Selling Price', 'numeric', NULL, '1470577507'),
(6, 6, 'Selling', 'numeric', 'Ksh', '1470583041'),
(7, 6, 'Buying', 'numeric', 'Ksh', '1470583041'),
(8, 7, 'Interest Rate', 'percentage', NULL, '1471449996'),
(10, 8, 'cpu speed', 'numeric', NULL, '1471450331'),
(12, 8, 'ram size', 'numeric', NULL, '1471450410');

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE IF NOT EXISTS `industries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) CHARACTER SET ascii NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`id`, `name`, `description`, `image`, `created`) VALUES
(2, 'Banking', '', NULL, '1471534253'),
(3, 'Consumer Goods', '', NULL, '1471534446');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `type`, `name`, `description`, `added_by`, `image`, `created`) VALUES
(6, 'good', 'Milk', 'Wholesome pastuerized cow milk', 1, '1ae6a67b51b9ac440c2e67ae635205a1.jpg', 1470577303),
(7, 'good', 'Sugar', 'Sweet brown sugar', 1, '75b08d5000ec9e91402edbe9f14bf7c4.jpg', 1470580418),
(8, 'service', '$US Exchange', 'Exchange of foreign currencies', 1, '188c916accadc3a0b78a689d68fa3527.jpg', 1470583232),
(9, 'service', 'Yen Exchange', 'Yen currency sales', 1, '2bd149ce4fd72313d0f9459f7e68f36a.jpg', 1470896789),
(10, 'good', 'Rice', 'Long grain rice', 1, NULL, 1471449785);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product` bigint(20) unsigned NOT NULL,
  `category` bigint(11) unsigned NOT NULL,
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product`, `category`, `created`) VALUES
(8, 7, 5, '1470580515'),
(9, 5, 5, '1470583101'),
(10, 8, 6, '1470583255'),
(11, 6, 5, '1470583681'),
(12, 9, 6, '1470896829'),
(14, 10, 5, '1471449806'),
(15, 11, 7, '1471450010'),
(17, 12, 8, '1471450377'),
(18, 13, 8, '1471450468');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE IF NOT EXISTS `product_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product` bigint(20) unsigned NOT NULL,
  `provider` int(10) unsigned NOT NULL,
  `region` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `datapoint` bigint(11) unsigned NOT NULL,
  `value` varchar(5000) DEFAULT NULL,
  `date` varchar(256) DEFAULT NULL,
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `product`, `provider`, `region`, `owner`, `datapoint`, `value`, `date`, `created`) VALUES
(1, 10, 3, 4, 4, 3, '100', '1470952800', '1471537563'),
(2, 10, 3, 3, 4, 3, '100', '1470261600', '1471537582'),
(3, 10, 3, 4, 1, 4, '120', '1471644000', '1471682664'),
(4, 10, 3, 4, 1, 4, '98', '1472680800', '1471682753'),
(5, 10, 3, 4, 1, 4, '100', '1478127600', '1471682991'),
(6, 10, 4, 4, 1, 4, '100', '1460584800', '1471683058'),
(7, 10, 4, 4, 1, 4, '100', '1472162400', '1471683084'),
(8, 10, 4, 4, 1, 4, '50', '1480028400', '1471683103'),
(9, 10, 4, 4, 1, 4, '100', '1474063200', '1471683218'),
(10, 10, 4, 4, 4, 4, '60', '1470952800', '1471847280'),
(11, 10, 4, 4, 4, 4, '55', '1467842400', '1471850113'),
(12, 10, 3, 4, 4, 4, '78', '1469570400', '1471850149'),
(13, 10, 3, 4, 4, 4, '122', '1478646000', '1471850190'),
(14, 10, 4, 4, 1, 4, '220', '1456354800', '1471865470'),
(15, 10, 4, 5, 1, 4, '130', '1452034800', '1471865508'),
(16, 10, 4, 5, 1, 4, '89', '1456441200', '1471865534');

-- --------------------------------------------------------

--
-- Table structure for table `product_providers`
--

CREATE TABLE IF NOT EXISTS `product_providers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `country` varchar(256) DEFAULT NULL,
  `industry` varchar(256) DEFAULT NULL,
  `description` varchar(5000) NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_providers`
--

INSERT INTO `product_providers` (`id`, `name`, `country`, `industry`, `description`, `image`, `created`) VALUES
(2, 'Barclays', 'Kenya', '2', '', NULL, '1471534509'),
(3, 'Nakumatt', 'Kenya', '3', '', NULL, '1471535643'),
(4, 'Naivas', 'Kenya', '3', 'Retail outlet', NULL, '1471683024');

-- --------------------------------------------------------

--
-- Table structure for table `product_regions`
--

CREATE TABLE IF NOT EXISTS `product_regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) CHARACTER SET ascii NOT NULL,
  `country` varchar(256) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_regions`
--

INSERT INTO `product_regions` (`id`, `name`, `country`, `description`, `image`, `created`) VALUES
(3, 'Western', 'kenya', 'Western kenya', NULL, '1470553503'),
(4, 'Nairobi', 'Kenya', 'Nairobi Region', NULL, '1471534556'),
(5, 'Central', 'Kenya', '', NULL, '1471534871');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fbid` bigint(20) unsigned DEFAULT NULL,
  `twid` bigint(20) unsigned DEFAULT NULL,
  `gpid` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(256) NOT NULL,
  `status` varchar(256) CHARACTER SET ascii NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `pic` varchar(256) DEFAULT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `phone` varchar(256) DEFAULT NULL,
  `activation_code` varchar(256) CHARACTER SET ascii DEFAULT NULL,
  `activation_expiry` timestamp NULL DEFAULT NULL,
  `preset_code` varchar(256) CHARACTER SET ascii DEFAULT NULL,
  `preset_expiry` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `password` (`password`),
  KEY `firstname` (`firstname`),
  KEY `lastname` (`lastname`),
  KEY `phone` (`phone`),
  KEY `status` (`status`),
  KEY `activation_code` (`activation_code`,`preset_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fbid`, `twid`, `gpid`, `type`, `status`, `email`, `password`, `pic`, `firstname`, `lastname`, `phone`, `activation_code`, `activation_expiry`, `preset_code`, `preset_expiry`, `last_login`, `created`) VALUES
(1, NULL, NULL, NULL, 'admin', 'active', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 'Admin', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-05 13:38:33'),
(2, NULL, NULL, NULL, 'user', 'active', 'ryan@email.com', '7d9ff7b0d33e227f435308ed73c053a4', NULL, 'Collins', 'Ryan', NULL, '3383085cd0ad8c474eb73a294aa7a4ca', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00'),
(4, NULL, NULL, NULL, 'user', 'active', 'oyareishma@gmail.com', '6602344071152d1ea3d2c8c565773c82', NULL, 'Ishmael ', 'Oyare', NULL, '60314cdb7781273b053b3c8b372f6f73', '0000-00-00 00:00:00', NULL, NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE IF NOT EXISTS `users_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users` int(11) unsigned NOT NULL,
  `name` varchar(256) CHARACTER SET ascii NOT NULL,
  `value` varchar(256) NOT NULL,
  `editable` varchar(256) NOT NULL DEFAULT 'no',
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users` (`users`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `users`, `name`, `value`, `editable`, `created`) VALUES
(1, 2, 'accepts_terms', 'yes', 'yes', '1470478169'),
(2, 2, 'points', '50', 'yes', '1471448595'),
(3, 3, 'accepts_terms', 'yes', 'yes', '1471449671'),
(4, 4, 'accepts_terms', 'yes', 'yes', '1471537463'),
(5, 4, 'points', '60', 'yes', '1471850190'),
(6, 2, 'categories_preferences', 'a:2:{s:5:"cat-5";s:1:"5";s:5:"cat-6";s:1:"6";}', 'yes', '1471859160'),
(7, 2, 'product_preferences', 'false', 'yes', '1471856832'),
(8, 2, 'setup_done', 'yes', 'yes', '1471859160'),
(9, 2, 'products_preferences', 'a:4:{s:7:"prod-10";s:2:"10";s:6:"prod-6";s:1:"6";s:6:"prod-9";s:1:"9";s:6:"prod-8";s:1:"8";}', 'yes', '1471859160');

-- --------------------------------------------------------

--
-- Table structure for table `user_preferences`
--

CREATE TABLE IF NOT EXISTS `user_preferences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product` bigint(20) unsigned NOT NULL,
  `provider` int(10) unsigned NOT NULL,
  `region` int(10) unsigned NOT NULL,
  `datapoint` bigint(11) unsigned NOT NULL,
  `created` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
