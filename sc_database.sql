-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2018 at 06:26 AM
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

--
-- Dumping data for table `ewd_actions`
--

INSERT INTO `ewd_actions` (`id`, `name`, `icon`, `type`, `status`, `support_key`) VALUES
(1, 'thêm', '<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i>', 0, 1, '/block/theme/section/'),
(2, 'sửa', '<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>', 0, 1, '/part/block/theme/section/'),
(3, 'xóa', '<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>', 0, 1, '/part/block/theme/section/'),
(4, 'xem thêm', '<i class=\"fa fa-arrow-down\" aria-hidden=\"true\"></i>', 0, 1, '/section/');

-- --------------------------------------------------------

--
-- Table structure for table `ewd_blocks`
--

CREATE TABLE `ewd_blocks` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
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
-- Table structure for table `ewd_block_part_meta`
--

CREATE TABLE `ewd_block_part_meta` (
  `block_part_id` bigint(20) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `theme_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `media_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ewd_block_part_meta`
--

INSERT INTO `ewd_block_part_meta` (`block_part_id`, `meta_key`, `theme_id`, `section_id`, `value`, `created_at`, `updated_at`, `media_id`) VALUES
(1, 'value_text', 0, 0, 'abc', '2018-01-15 04:22:33', '2018-01-15 11:22:33', 0),
(2, 'value_text', 0, 0, 'sdfg sdf', '2018-01-15 04:20:47', '2018-01-15 11:20:47', 0),
(14, 'value_text', 0, 0, 'trytrytryt', '2018-01-15 05:01:40', '2018-01-15 12:01:40', 0),
(15, 'value_text', 0, 0, 'ghgfhgf', '2018-01-15 05:09:41', '2018-01-15 12:09:41', 0),
(16, 'value_text', 0, 0, 'xzcxcxc', '2018-01-15 05:11:05', '2018-01-15 12:11:05', 0),
(20, 'value_text', 0, 0, 'gfhgf', '2018-01-15 05:14:53', '2018-01-15 12:14:53', 0),
(21, 'value_text', 0, 0, 'cvgbfgdg', '2018-01-15 05:16:18', '2018-01-15 12:16:18', 0),
(23, 'value_text', 0, 0, 'sdgffsdf', '2018-01-15 05:17:32', '2018-01-15 12:17:32', 0),
(24, 'value_text', 0, 0, 'dsfsdfsddsfdsf', '2018-01-15 05:18:39', '2018-01-15 12:18:39', 0);

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
-- Table structure for table `ewd_config`
--

CREATE TABLE `ewd_config` (
  `id` bigint(20) NOT NULL,
  `key_id` varchar(255) NOT NULL,
  `value` varchar(500) NOT NULL,
  `support` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ewd_config`
--

INSERT INTO `ewd_config` (`id`, `key_id`, `value`, `support`) VALUES
(2, 'full', '1920', 'media_width_upload'),
(3, 'large', '1366', 'media_width_upload'),
(4, 'medium', '1366', 'media_width_upload'),
(5, 'small', '640', 'media_width_upload'),
(6, 'thumb', '420', 'media_width_upload'),
(7, 'kB', '1024', 'file_size'),
(8, 'MB', '1048476', 'file_size'),
(9, 'GB', '1073741824', 'file_size'),
(10, 'TB', '1099511627776', 'file_size'),
(11, 'media_allow', '/mp3/m4a/3gp/wav/raw/doc/pdf/xlsx/xlsm/xlsm/xltx/xltm/xls/xlt/docm/docx/docx/png/jpg/jpeg/gif/xml/html/txt/js/css/flv/mp4/amv/3gp/zip/rar/gzip/', 'file_allow_upload');

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
  `extension` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `folder_id` varchar(255) NOT NULL DEFAULT '/0/',
  `path_folder` varchar(255) NOT NULL DEFAULT '/0/',
  `member_id` bigint(20) NOT NULL,
  `is_root` tinyint(1) NOT NULL DEFAULT '0',
  `dir_folder` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ewd_medias`
--

INSERT INTO `ewd_medias` (`id`, `name`, `path`, `full`, `large`, `medium`, `small`, `thumb`, `type_id`, `extension`, `size`, `folder_id`, `path_folder`, `member_id`, `is_root`, `dir_folder`, `created_at`, `updated_at`) VALUES
(467, 'parts', '', '', '', '', '', '', 2, 'folder', 0, '0', '/467/', 0, 0, '', '2018-01-12 02:25:50', '2018-01-12 09:25:50'),
(468, 'audio.html', '/uploads/5a581d48ce47f.html', '/uploads//5a581d48ce47f.html', '/uploads//5a581d48ce47f.html', '/uploads//5a581d48ce47f.html', '/uploads//5a581d48ce47f.html', '/uploads//5a581d48ce47f.html', 8, 'html', 2851, '467', '/467/468/', 0, 0, '', '2018-01-12 02:28:24', '2018-01-12 09:28:24'),
(469, 'content.html', '/uploads/5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', 8, 'html', 133, '467', '/467/469/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(470, 'images.html', '/uploads/5a581d493c800.html', '/uploads//5a581d493c800.html', '/uploads//5a581d493c800.html', '/uploads//5a581d493c800.html', '/uploads//5a581d493c800.html', '/uploads//5a581d493c800.html', 8, 'html', 2832, '467', '/467/470/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(471, 'image.html', '/uploads/5a581d495a03c.html', '/uploads//5a581d495a03c.html', '/uploads//5a581d495a03c.html', '/uploads//5a581d495a03c.html', '/uploads//5a581d495a03c.html', '/uploads//5a581d495a03c.html', 8, 'html', 2813, '467', '/467/471/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(472, 'text.html', '/uploads/5a581d497366c.html', '/uploads//5a581d497366c.html', '/uploads//5a581d497366c.html', '/uploads//5a581d497366c.html', '/uploads//5a581d497366c.html', '/uploads//5a581d497366c.html', 8, 'html', 130, '467', '/467/472/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(473, 'video.html', '/uploads/5a581d498e75a.html', '/uploads//5a581d498e75a.html', '/uploads//5a581d498e75a.html', '/uploads//5a581d498e75a.html', '/uploads//5a581d498e75a.html', '/uploads//5a581d498e75a.html', 8, 'html', 2843, '467', '/467/473/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(474, 'Screenshot_5.png', '/uploads/5a581dc09d3f6.png', '/uploads/5a581dc09d3f6.png', '/uploads/large/5a581dc09d3f6.png', '/uploads/medium/5a581dc09d3f6.png', '/uploads/small/5a581dc09d3f6.png', '/uploads/thumb/5a581dc09d3f6.png', 1, 'png', 367956, '0', '/474/', 0, 0, '', '2018-01-12 02:30:26', '2018-01-12 09:30:26'),
(475, 'Screenshot_4.png', '/uploads/5a581e4eb0c1d.png', '/uploads/5a581e4eb0c1d.png', '/uploads/5a581e4eb0c1d.png', '/uploads/5a581e4eb0c1d.png', '/uploads/small/5a581e4eb0c1d.png', '/uploads/thumb/5a581e4eb0c1d.png', 1, 'png', 686367, '0', '/475/', 0, 0, '', '2018-01-12 02:32:33', '2018-01-12 09:32:33'),
(476, 'audios.html', '/uploads/5a58203e22749.html', '/uploads//5a58203e22749.html', '/uploads//5a58203e22749.html', '/uploads//5a58203e22749.html', '/uploads//5a58203e22749.html', '/uploads//5a58203e22749.html', 8, 'html', 2833, '467', '/467/476/', 0, 0, '', '2018-01-12 02:41:02', '2018-01-12 09:41:02'),
(477, 'videos.html', '/uploads/5a58203e80106.html', '/uploads//5a58203e80106.html', '/uploads//5a58203e80106.html', '/uploads//5a58203e80106.html', '/uploads//5a58203e80106.html', '/uploads//5a58203e80106.html', 8, 'html', 2853, '467', '/467/477/', 0, 0, '', '2018-01-12 02:41:02', '2018-01-12 09:41:02'),
(478, 'Screenshot_2.png', '/uploads/5a58238b02946.png', '/uploads/5a58238b02946.png', '/uploads/5a58238b02946.png', '/uploads/5a58238b02946.png', '/uploads/small/5a58238b02946.png', '/uploads/thumb/5a58238b02946.png', 1, 'png', 491282, '0', '/478/', 0, 0, '', '2018-01-12 02:55:07', '2018-01-12 09:55:07'),
(479, 'Screenshot_4.png', '/uploads/5a58239da0653.png', '/uploads/5a58239da0653.png', '/uploads/5a58239da0653.png', '/uploads/5a58239da0653.png', '/uploads/small/5a58239da0653.png', '/uploads/thumb/5a58239da0653.png', 1, 'png', 2079880, '0', '/479/', 0, 0, '', '2018-01-12 02:55:26', '2018-01-12 09:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `ewd_media_type`
--

CREATE TABLE `ewd_media_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `extension` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ewd_media_type`
--

INSERT INTO `ewd_media_type` (`id`, `name`, `icon`, `extension`) VALUES
(1, 'image', '', '/png/jpg/jpeg/gif/'),
(2, 'folder', 'fa fa-folder', ''),
(3, 'file', 'fa fa-file', ''),
(4, 'audio', 'fa fa-file-audio-o', '/mp3/m4a/3gp/wav/raw/'),
(5, 'video', 'fa fa-file-movie-o', '/flv/mp4/amv/3gp/'),
(6, 'zip', 'fa fa-file-zip-o', '/zip/rar/gzip/'),
(7, 'doc', 'fa fa-file-word-o', '/doc/pdf/xlsx/xlsm/xlsm/xltx/xltm/xls/xlt/docm/docx/docx/'),
(8, 'text', 'fa fa-file-text-o', '/xml/html/txt/js/css/');

-- --------------------------------------------------------

--
-- Table structure for table `ewd_parts`
--

CREATE TABLE `ewd_parts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path_html` varchar(255) NOT NULL,
  `list_show` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ewd_parts`
--

INSERT INTO `ewd_parts` (`id`, `name`, `path_html`, `list_show`, `created_at`, `updated_at`, `status`) VALUES
(2, 'text', '472', '{{value}}', '2018-01-12 02:33:17', '2018-01-12 09:33:17', 1),
(3, 'image', '471', '<div class=\"item-list\"> 	\n	<img src = \"{{value}}\" class=\"value_show src_image\">  \n</div>', '2018-01-12 02:33:39', '2018-01-12 09:33:39', 1),
(4, 'list images ', '470', '<div class=\"item-list\"> 	<img src = \"{{value}}\" class=\"value_show src_image\">  </div>', '2018-01-12 02:35:19', '2018-01-12 09:35:19', 1),
(5, 'content', '469', '{{value}}', '2018-01-12 02:35:39', '2018-01-12 09:35:39', 1),
(6, 'video', '473', '<div class=\"item-list\"> 	<video class=\"value_show src_video\" src=\"{{value}}\" controls></video> </div>', '2018-01-12 02:36:04', '2018-01-12 09:36:04', 1),
(7, 'audio', '468', '<div class=\"item-list\"> 	<audio class=\"value_show src_video\" src=\"{{value}}\" controls></audio> </div>', '2018-01-12 02:36:28', '2018-01-12 09:36:28', 1),
(8, 'list videos', '477', '<div class=\"item-list\"> 	<video class=\"value_show src_video\" src=\"{{value}}\" controls></video> </div>', '2018-01-12 02:41:29', '2018-01-12 09:41:29', 1),
(9, 'list audios', '476', '<div class=\"item-list\"> 	<audio class=\"value_show src_video\" src=\"{{value}}\" controls></audio> </div>', '2018-01-12 02:41:51', '2018-01-12 09:41:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ewd_part_action`
--

CREATE TABLE `ewd_part_action` (
  `block_part_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `theme_id` bigint(20) NOT NULL,
  `action_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ewd_part_action`
--

INSERT INTO `ewd_part_action` (`block_part_id`, `section_id`, `theme_id`, `action_id`, `active`) VALUES
(1, 0, 0, 2, 1),
(1, 0, 0, 3, 1),
(14, 0, 0, 2, 0),
(14, 0, 0, 3, 0),
(21, 0, 0, 3, 1),
(24, 0, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ewd_sections`
--

CREATE TABLE `ewd_sections` (
  `id` bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `member_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `thumb` bigint(20) NOT NULL,
  `is_system` tinyint(1) NOT NULL,
  `member_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_theme_section`
--

CREATE TABLE `ewd_theme_section` (
  `theme_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_full` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_theme_sections_block`
--

CREATE TABLE `ewd_theme_sections_block` (
  `theme_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `block_id` bigint(20) NOT NULL,
  `ncolum` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ewd_theme_sections_block_part`
--

CREATE TABLE `ewd_theme_sections_block_part` (
  `id` bigint(20) NOT NULL,
  `part_id` bigint(20) NOT NULL,
  `block_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `theme_id` bigint(20) NOT NULL,
  `sort` int(11) NOT NULL,
  `ncolum` int(11) NOT NULL,
  `is_system` tinyint(1) NOT NULL,
  `ramkey` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `id_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ewd_theme_sections_block_part`
--

INSERT INTO `ewd_theme_sections_block_part` (`id`, `part_id`, `block_id`, `section_id`, `theme_id`, `sort`, `ncolum`, `is_system`, `ramkey`, `name`, `class_name`, `id_name`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 0, 0, 0, 6, 1, '5a5c2c7dedf7a', '', '', '', '2018-01-15 04:22:23', '2018-01-15 11:22:23'),
(2, 2, 0, 0, 0, 0, 6, 1, '5a5c2e0ae4f58', '', '', '', '2018-01-15 04:28:59', '2018-01-15 11:28:59'),
(3, 2, 0, 0, 0, 0, 6, 1, '5a5c2e1638cea', '', '', '', '2018-01-15 04:29:12', '2018-01-15 11:29:12'),
(4, 2, 0, 0, 0, 0, 6, 1, '5a5c2e1638cea', '', '', '', '2018-01-15 04:29:16', '2018-01-15 11:29:16'),
(5, 2, 0, 0, 0, 0, 6, 1, '5a5c2e43cf96e', '', '', '', '2018-01-15 04:29:57', '2018-01-15 11:29:57'),
(6, 2, 0, 0, 0, 0, 6, 1, '5a5c2e1638cea', '', '', '', '2018-01-15 04:30:00', '2018-01-15 11:30:00'),
(7, 2, 0, 0, 0, 0, 6, 1, '5a5c2f2220ad5', '', '', '', '2018-01-15 04:33:39', '2018-01-15 11:33:39'),
(8, 2, 0, 0, 0, 0, 6, 1, '5a5c2e1638cea', '', '', '', '2018-01-15 04:33:45', '2018-01-15 11:33:45'),
(9, 2, 0, 0, 0, 0, 6, 1, '5a5c2e1638cea', '', '', '', '2018-01-15 04:34:06', '2018-01-15 11:34:06'),
(10, 2, 0, 0, 0, 0, 6, 1, '5a5c2e1638cea', '', '', '', '2018-01-15 04:44:48', '2018-01-15 11:44:48'),
(11, 2, 0, 0, 0, 0, 6, 1, '5a5c35030e15c', '', '', '', '2018-01-15 04:58:44', '2018-01-15 11:58:44'),
(12, 2, 0, 0, 0, 0, 6, 1, '5a5c352eabd1b', '', '', '', '2018-01-15 04:59:27', '2018-01-15 11:59:27'),
(13, 2, 0, 0, 0, 0, 6, 1, '5a5c35404a951', '', '', '', '2018-01-15 04:59:46', '2018-01-15 11:59:46'),
(14, 2, 0, 0, 0, 0, 10, 1, '5a5c355107b30', '', '', '', '2018-01-15 05:00:01', '2018-01-15 12:00:01'),
(15, 2, 0, 0, 0, 0, 11, 1, '5a5c378f4565f', '', '', '', '2018-01-15 05:09:36', '2018-01-15 12:09:36'),
(16, 2, 0, 0, 0, 0, 8, 1, '5a5c37e44f7a5', '', '', '', '2018-01-15 05:11:02', '2018-01-15 12:11:02'),
(17, 2, 0, 0, 0, 0, 6, 1, '5a5c37f16de46', '', '', '', '2018-01-15 05:11:14', '2018-01-15 12:11:14'),
(18, 2, 0, 0, 0, 0, 6, 1, '5a5c37fd11d81', '', '', '', '2018-01-15 05:11:26', '2018-01-15 12:11:26'),
(19, 2, 0, 0, 0, 0, 9, 1, '5a5c387b457cb', '', '', '', '2018-01-15 05:13:33', '2018-01-15 12:13:33'),
(20, 2, 0, 0, 0, 0, 10, 1, '5a5c38c6ae2a5', '', '', '', '2018-01-15 05:14:48', '2018-01-15 12:14:48'),
(21, 2, 0, 0, 0, 0, 9, 1, '5a5c391ddfce2', '', '', '', '2018-01-15 05:16:15', '2018-01-15 12:16:15'),
(22, 2, 0, 0, 0, 0, 9, 1, '5a5c3935750b8', '', '', '', '2018-01-15 05:16:39', '2018-01-15 12:16:39'),
(23, 2, 0, 0, 0, 0, 9, 1, '5a5c39638427a', '', '', '', '2018-01-15 05:17:26', '2018-01-15 12:17:26'),
(24, 2, 0, 0, 0, 0, 5, 1, '5a5c399df26e4', '', '', '', '2018-01-15 05:18:23', '2018-01-15 12:18:23'),
(25, 2, 0, 0, 0, 0, 7, 1, '5a5c399df26e4', '', '', '', '2018-01-15 05:18:42', '2018-01-15 12:18:42'),
(26, 3, 0, 0, 0, 0, 12, 1, '5a5c399df26e4', '', '', '', '2018-01-15 05:18:51', '2018-01-15 12:18:51');

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
-- Indexes for table `ewd_block_part_meta`
--
ALTER TABLE `ewd_block_part_meta`
  ADD PRIMARY KEY (`block_part_id`,`theme_id`,`section_id`);

--
-- Indexes for table `ewd_common_style`
--
ALTER TABLE `ewd_common_style`
  ADD PRIMARY KEY (`reference_id`,`type_id`,`key_id`);

--
-- Indexes for table `ewd_config`
--
ALTER TABLE `ewd_config`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`block_part_id`,`section_id`,`theme_id`,`action_id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ewd_blocks`
--
ALTER TABLE `ewd_blocks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_config`
--
ALTER TABLE `ewd_config`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ewd_fonts`
--
ALTER TABLE `ewd_fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ewd_medias`
--
ALTER TABLE `ewd_medias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=480;

--
-- AUTO_INCREMENT for table `ewd_media_type`
--
ALTER TABLE `ewd_media_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ewd_parts`
--
ALTER TABLE `ewd_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `ewd_theme_sections_block_part`
--
ALTER TABLE `ewd_theme_sections_block_part`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ewd_types`
--
ALTER TABLE `ewd_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
