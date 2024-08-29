-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 07:10 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkhabor_epaper`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_advclient`
--

CREATE TABLE `e_advclient` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `join_date` datetime NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_advertise`
--

CREATE TABLE `e_advertise` (
  `ID` bigint(20) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `exp_date` int(11) NOT NULL DEFAULT '0',
  `locations` varchar(255) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `client_id` int(11) NOT NULL,
  `is_slide` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_comments`
--

CREATE TABLE `e_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_news_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_news`
--

CREATE TABLE `e_news` (
  `ID` bigint(20) NOT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `pos_top` int(11) NOT NULL,
  `pos_left` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `page_id` bigint(20) NOT NULL,
  `ref_link` varchar(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_options`
--

CREATE TABLE `e_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_page`
--

CREATE TABLE `e_page` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdate` varchar(25) NOT NULL,
  `img_small` varchar(255) NOT NULL,
  `img_medium` varchar(255) NOT NULL,
  `img_full` varchar(255) NOT NULL,
  `ptype` varchar(255) NOT NULL,
  `pnumber` int(11) NOT NULL,
  `is_list` enum('0','1') NOT NULL,
  `list_order` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_users`
--

CREATE TABLE `e_users` (
  `ID` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_type` enum('admin','editor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sitesetup`
--

CREATE TABLE `sitesetup` (
  `ID` tinyint(1) NOT NULL,
  `SiteName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `HomePageTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MetaTag` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `MetaDescription` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `SiteBanner` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `GoogleAnalytics` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Logo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FavIcon` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SiteContact` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SiteEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SiteFaceBook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SiteTwitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SiteGooglePlus` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SiteYouTube` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Currency` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `GoogleMap` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `e_advclient`
--
ALTER TABLE `e_advclient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `e_advertise`
--
ALTER TABLE `e_advertise`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `e_comments`
--
ALTER TABLE `e_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_news_ID` (`comment_news_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`);

--
-- Indexes for table `e_news`
--
ALTER TABLE `e_news`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `e_options`
--
ALTER TABLE `e_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `e_page`
--
ALTER TABLE `e_page`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `type_status_date` (`ID`);

--
-- Indexes for table `e_users`
--
ALTER TABLE `e_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sitesetup`
--
ALTER TABLE `sitesetup`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `e_advclient`
--
ALTER TABLE `e_advclient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_advertise`
--
ALTER TABLE `e_advertise`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_comments`
--
ALTER TABLE `e_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_news`
--
ALTER TABLE `e_news`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_options`
--
ALTER TABLE `e_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_page`
--
ALTER TABLE `e_page`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `e_users`
--
ALTER TABLE `e_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sitesetup`
--
ALTER TABLE `sitesetup`
  MODIFY `ID` tinyint(1) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
