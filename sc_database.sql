-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2017 at 05:44 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sc_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `ewd_actions`
--

CREATE TABLE `ewd_actions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `support_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_blocks`
--

CREATE TABLE `ewd_blocks` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ncolum` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_block_action`
--

CREATE TABLE `ewd_block_action` (
  `block_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_common_style`
--

CREATE TABLE `ewd_common_style` (
  `reference_id` bigint(20) NOT NULL,
  `type_id` int(11) NOT NULL,
  `key_id` varchar(255) NOT NULL,
  `value` varchar(1000) NOT NULL,
  `common_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_fonts`
--

CREATE TABLE `ewd_fonts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_family` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_medias`
--

CREATE TABLE `ewd_medias` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `full` varchar(255) NOT NULL,
  `large` varchar(255) NOT NULL,
  `medium` varchar(255) NOT NULL,
  `small` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `extention` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `folder_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ewd_medias`
--

INSERT INTO `ewd_medias` (`id`, `name`, `path`, `full`, `large`, `medium`, `small`, `thumb`, `type_id`, `extention`, `size`, `folder_id`) VALUES
(1, 'perfil-koket_59cb5f60e0b9f.png', 'D:/xampp/htdocs/sc_class/uploads/5a45c7c771240.png', 'D:/xampp/htdocs/sc_class/uploads/5a45c7c771240.png', 'D:/xampp/htdocs/sc_class/uploads/5a45c7c771240.png', 'D:/xampp/htdocs/sc_class/uploads/5a45c7c771240.png', 'D:/xampp/htdocs/sc_class/uploads/5a45c7c771240.png', 'D:/xampp/htdocs/sc_class/uploads/5a45c7c771240.png', 1, 'png', 118098, 0),
(2, '1506510510.jpg', 'D:/xampp/htdocs/sc_class/uploads/5a45c7f2b3bd0.jpg', 'D:\\xampp\\htdocs\\sc_class\\/uploads/full/5a45c7f2b3bd0.jpg', 'D:\\xampp\\htdocs\\sc_class\\/uploads/large/5a45c7f2b3bd0.jpg', 'D:\\xampp\\htdocs\\sc_class\\/uploads/medium/5a45c7f2b3bd0.jpg', 'D:\\xampp\\htdocs\\sc_class\\/uploads/small/5a45c7f2b3bd0.jpg', 'D:\\xampp\\htdocs\\sc_class\\/uploads/thumb/5a45c7f2b3bd0.jpg', 1, 'jpg', 8892638, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ewd_media_type`
--

CREATE TABLE `ewd_media_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_parts`
--

CREATE TABLE `ewd_parts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path_html` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_part_action`
--

CREATE TABLE `ewd_part_action` (
  `part_id` bigint(20) NOT NULL,
  `block_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `theme_id` bigint(20) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_part_meta`
--

CREATE TABLE `ewd_part_meta` (
  `part_id` bigint(20) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `theme_id` bigint(20) NOT NULL,
  `block_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `media_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_sections`
--

CREATE TABLE `ewd_sections` (
  `id` bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_section_action`
--

CREATE TABLE `ewd_section_action` (
  `section_id` bigint(20) NOT NULL,
  `theme_id` bigint(20) NOT NULL,
  `action_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_themes`
--

CREATE TABLE `ewd_themes` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `thumb` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_theme_section`
--

CREATE TABLE `ewd_theme_section` (
  `theme_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_full` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_theme_sections_block`
--

CREATE TABLE `ewd_theme_sections_block` (
  `theme_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `block_id` bigint(20) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_theme_sections_block_part`
--

CREATE TABLE `ewd_theme_sections_block_part` (
  `part_id` bigint(20) NOT NULL,
  `block_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `theme_id` bigint(20) NOT NULL,
  `sort` int(11) NOT NULL,
  `ncolum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_types`
--

CREATE TABLE `ewd_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `support_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ewd_actions`
--
ALTER TABLE `ewd_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ewd_blocks`
--
ALTER TABLE `ewd_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ewd_block_action`
--
ALTER TABLE `ewd_block_action`
  ADD PRIMARY KEY (`block_id`,`section_id`,`theme_id`,`action_id`);

--
-- Indexes for table `ewd_common_style`
--
ALTER TABLE `ewd_common_style`
  ADD PRIMARY KEY (`reference_id`,`type_id`,`key_id`);

--
-- Indexes for table `ewd_fonts`
--
ALTER TABLE `ewd_fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ewd_medias`
--
ALTER TABLE `ewd_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ewd_media_type`
--
ALTER TABLE `ewd_media_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ewd_parts`
--
ALTER TABLE `ewd_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ewd_part_action`
--
ALTER TABLE `ewd_part_action`
  ADD PRIMARY KEY (`part_id`,`block_id`,`section_id`,`theme_id`,`action_id`);

--
-- Indexes for table `ewd_part_meta`
--
ALTER TABLE `ewd_part_meta`
  ADD PRIMARY KEY (`part_id`,`meta_key`,`theme_id`,`block_id`,`section_id`);

--
-- Indexes for table `ewd_sections`
--
ALTER TABLE `ewd_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ewd_section_action`
--
ALTER TABLE `ewd_section_action`
  ADD PRIMARY KEY (`section_id`,`theme_id`,`action_id`);

--
-- Indexes for table `ewd_themes`
--
ALTER TABLE `ewd_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ewd_theme_section`
--
ALTER TABLE `ewd_theme_section`
  ADD PRIMARY KEY (`theme_id`,`section_id`);

--
-- Indexes for table `ewd_theme_sections_block`
--
ALTER TABLE `ewd_theme_sections_block`
  ADD PRIMARY KEY (`theme_id`,`section_id`,`block_id`);

--
-- Indexes for table `ewd_theme_sections_block_part`
--
ALTER TABLE `ewd_theme_sections_block_part`
  ADD PRIMARY KEY (`part_id`,`block_id`,`section_id`,`theme_id`);

--
-- Indexes for table `ewd_types`
--
ALTER TABLE `ewd_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ewd_actions`
--
ALTER TABLE `ewd_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_blocks`
--
ALTER TABLE `ewd_blocks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_fonts`
--
ALTER TABLE `ewd_fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_medias`
--
ALTER TABLE `ewd_medias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ewd_media_type`
--
ALTER TABLE `ewd_media_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_parts`
--
ALTER TABLE `ewd_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_sections`
--
ALTER TABLE `ewd_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_themes`
--
ALTER TABLE `ewd_themes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_types`
--
ALTER TABLE `ewd_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
