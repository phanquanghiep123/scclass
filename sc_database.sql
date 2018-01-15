-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2018 at 11:33 AM
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
  `id` int(11) NOT NULL,
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

INSERT INTO `ewd_block_part_meta` (`id`, `block_part_id`, `meta_key`, `theme_id`, `section_id`, `value`, `created_at`, `updated_at`, `media_id`) VALUES
(3, 38, 'value_media', 0, 0, '', '2018-01-15 07:23:16', '2018-01-15 14:23:16', 479),
(4, 37, 'value_text', 0, 0, 'abc', '2018-01-15 07:23:22', '2018-01-15 14:23:22', 0),
(5, 39, 'value_text', 0, 0, 'qử rqwrqwerq', '2018-01-15 07:23:42', '2018-01-15 14:23:42', 0),
(7, 52, 'value_text', 0, 0, '<p>&eacute; dfssf dsfsdf dsf</p>', '2018-01-15 08:22:36', '2018-01-15 15:22:36', 0),
(8, 53, 'value_text', 0, 0, '<p>asd sfsdfsd fsdf</p>', '2018-01-15 09:35:54', '2018-01-15 16:35:54', 0),
(9, 55, 'value_text', 0, 0, '<p>wer rgfsđ</p>', '2018-01-15 09:40:55', '2018-01-15 16:40:55', 0),
(10, 56, 'value_text', 0, 0, '<p>f fsdfsd&nbsp;</p>', '2018-01-15 09:41:25', '2018-01-15 16:41:25', 0),
(12, 57, 'value_text', 0, 0, '<p>fdg gdfgf</p>', '2018-01-15 09:42:10', '2018-01-15 16:42:10', 0),
(14, 58, 'value_text', 0, 0, '<p>dtrg gđfgfdgdf gfdgdfg</p>\r\n<p>trgh tẻgfregr</p>', '2018-01-15 09:43:13', '2018-01-15 16:43:13', 0),
(15, 61, 'value_text', 0, 0, '<p>ae rtret</p>', '2018-01-15 09:53:52', '2018-01-15 16:53:52', 0),
(16, 85, 'value_text', 0, 0, '15/01/2018', '2018-01-15 10:29:05', '2018-01-15 17:29:05', 0),
(17, 86, 'value_text', 0, 0, '01/2018', '2018-01-15 10:29:13', '2018-01-15 17:29:13', 0),
(18, 87, 'value_text', 0, 0, '17:00', '2018-01-15 10:29:22', '2018-01-15 17:29:22', 0),
(19, 88, 'value_text', 0, 0, '2018', '2018-01-15 10:29:35', '2018-01-15 17:29:35', 0),
(20, 92, 'value_text', 0, 0, '11/02/2018 22:00', '2018-01-15 10:32:18', '2018-01-15 17:32:18', 0),
(21, 93, 'value_text', 0, 0, '21:00', '2018-01-15 10:32:24', '2018-01-15 17:32:24', 0);

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
(469, 'content.html', '/uploads/5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', '/uploads//5a581d490e7d2.html', 8, 'html', 267, '467', '/467/469/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(470, 'images.html', '/uploads/5a581d493c800.html', '/uploads//5a581d493c800.html', '/uploads//5a581d493c800.html', '/uploads//5a581d493c800.html', '/uploads//5a581d493c800.html', '/uploads//5a581d493c800.html', 8, 'html', 2832, '467', '/467/470/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(471, 'image.html', '/uploads/5a581d495a03c.html', '/uploads//5a581d495a03c.html', '/uploads//5a581d495a03c.html', '/uploads//5a581d495a03c.html', '/uploads//5a581d495a03c.html', '/uploads//5a581d495a03c.html', 8, 'html', 2813, '467', '/467/471/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(472, 'text.html', '/uploads/5a581d497366c.html', '/uploads//5a581d497366c.html', '/uploads//5a581d497366c.html', '/uploads//5a581d497366c.html', '/uploads//5a581d497366c.html', '/uploads//5a581d497366c.html', 8, 'html', 238, '467', '/467/472/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(473, 'video.html', '/uploads/5a581d498e75a.html', '/uploads//5a581d498e75a.html', '/uploads//5a581d498e75a.html', '/uploads//5a581d498e75a.html', '/uploads//5a581d498e75a.html', '/uploads//5a581d498e75a.html', 8, 'html', 2843, '467', '/467/473/', 0, 0, '', '2018-01-12 02:28:25', '2018-01-12 09:28:25'),
(474, 'Screenshot_5.png', '/uploads/5a581dc09d3f6.png', '/uploads/5a581dc09d3f6.png', '/uploads/large/5a581dc09d3f6.png', '/uploads/medium/5a581dc09d3f6.png', '/uploads/small/5a581dc09d3f6.png', '/uploads/thumb/5a581dc09d3f6.png', 1, 'png', 367956, '0', '/474/', 0, 0, '', '2018-01-12 02:30:26', '2018-01-12 09:30:26'),
(475, 'Screenshot_4.png', '/uploads/5a581e4eb0c1d.png', '/uploads/5a581e4eb0c1d.png', '/uploads/5a581e4eb0c1d.png', '/uploads/5a581e4eb0c1d.png', '/uploads/small/5a581e4eb0c1d.png', '/uploads/thumb/5a581e4eb0c1d.png', 1, 'png', 686367, '0', '/475/', 0, 0, '', '2018-01-12 02:32:33', '2018-01-12 09:32:33'),
(476, 'audios.html', '/uploads/5a58203e22749.html', '/uploads//5a58203e22749.html', '/uploads//5a58203e22749.html', '/uploads//5a58203e22749.html', '/uploads//5a58203e22749.html', '/uploads//5a58203e22749.html', 8, 'html', 2833, '467', '/467/476/', 0, 0, '', '2018-01-12 02:41:02', '2018-01-12 09:41:02'),
(477, 'videos.html', '/uploads/5a58203e80106.html', '/uploads//5a58203e80106.html', '/uploads//5a58203e80106.html', '/uploads//5a58203e80106.html', '/uploads//5a58203e80106.html', '/uploads//5a58203e80106.html', 8, 'html', 2853, '467', '/467/477/', 0, 0, '', '2018-01-12 02:41:02', '2018-01-12 09:41:02'),
(478, 'Screenshot_2.png', '/uploads/5a58238b02946.png', '/uploads/5a58238b02946.png', '/uploads/5a58238b02946.png', '/uploads/5a58238b02946.png', '/uploads/small/5a58238b02946.png', '/uploads/thumb/5a58238b02946.png', 1, 'png', 491282, '0', '/478/', 0, 0, '', '2018-01-12 02:55:07', '2018-01-12 09:55:07'),
(479, 'Screenshot_4.png', '/uploads/5a58239da0653.png', '/uploads/5a58239da0653.png', '/uploads/5a58239da0653.png', '/uploads/5a58239da0653.png', '/uploads/small/5a58239da0653.png', '/uploads/thumb/5a58239da0653.png', 1, 'png', 2079880, '0', '/479/', 0, 0, '', '2018-01-12 02:55:26', '2018-01-12 09:55:26'),
(480, 'datetime.html', '/uploads/5a5c5b81a5e8a.html', '/uploads/5a5c5b81a5e8a.html', '/uploads/5a5c5b81a5e8a.html', '/uploads/5a5c5b81a5e8a.html', '/uploads/5a5c5b81a5e8a.html', '/uploads/5a5c5b81a5e8a.html', 8, 'html', 251, '467', '/467/480/', 0, 0, '', '2018-01-15 07:42:57', '2018-01-15 14:42:57'),
(481, 'day.html', '/uploads/5a5c5d40812fa.html', '/uploads/5a5c5d40812fa.html', '/uploads/5a5c5d40812fa.html', '/uploads/5a5c5d40812fa.html', '/uploads/5a5c5d40812fa.html', '/uploads/5a5c5d40812fa.html', 8, 'html', 252, '467', '/467/481/', 0, 0, '', '2018-01-15 07:50:24', '2018-01-15 14:50:24'),
(482, 'month.html', '/uploads/5a5c5e0f3f568.html', '/uploads/5a5c5e0f3f568.html', '/uploads/5a5c5e0f3f568.html', '/uploads/5a5c5e0f3f568.html', '/uploads/5a5c5e0f3f568.html', '/uploads/5a5c5e0f3f568.html', 8, 'html', 256, '467', '/467/482/', 0, 0, '', '2018-01-15 07:53:51', '2018-01-15 14:53:51'),
(483, 'year.html', '/uploads/5a5c5e6d3c819.html', '/uploads/5a5c5e6d3c819.html', '/uploads/5a5c5e6d3c819.html', '/uploads/5a5c5e6d3c819.html', '/uploads/5a5c5e6d3c819.html', '/uploads/5a5c5e6d3c819.html', 8, 'html', 241, '467', '/467/483/', 0, 0, '', '2018-01-15 07:55:25', '2018-01-15 14:55:25'),
(484, 'hours.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', 8, 'html', 254, '467', '/467/484/', 0, 0, '', '2018-01-15 09:57:03', '2018-01-15 16:57:03');

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
(9, 'list audios', '476', '<div class=\"item-list\"> 	<audio class=\"value_show src_video\" src=\"{{value}}\" controls></audio> </div>', '2018-01-12 02:41:51', '2018-01-12 09:41:51', 1),
(11, 'datetime', '480', '{{value}}', '2018-01-15 07:45:22', '2018-01-15 14:45:22', 1),
(12, 'day', '481', '{{value}}', '2018-01-15 07:50:36', '2018-01-15 14:50:36', 1),
(13, 'month', '482', '{{value}}', '2018-01-15 07:54:08', '2018-01-15 14:54:08', 1),
(14, 'hours', '484', '{{value}}', '2018-01-15 09:57:23', '2018-01-15 16:57:23', 1),
(15, 'year', '483', '{{value}}', '2018-01-15 10:24:45', '2018-01-15 17:24:45', 1);

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
(24, 0, 0, 2, 1),
(31, 0, 0, 2, 1),
(31, 0, 0, 3, 1),
(33, 0, 0, 2, 1),
(34, 0, 0, 3, 1),
(37, 0, 0, 2, 1),
(38, 0, 0, 2, 1),
(39, 0, 0, 2, 1),
(45, 0, 0, 2, 1),
(45, 0, 0, 3, 1),
(53, 0, 0, 3, 1),
(55, 0, 0, 2, 1),
(57, 0, 0, 2, 1),
(57, 0, 0, 3, 1),
(58, 0, 0, 2, 1),
(92, 0, 0, 2, 1),
(92, 0, 0, 3, 1),
(93, 0, 0, 2, 1);

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
(26, 3, 0, 0, 0, 0, 12, 1, '5a5c399df26e4', '', '', '', '2018-01-15 05:18:51', '2018-01-15 12:18:51'),
(27, 2, 0, 0, 0, 0, 6, 1, '5a5c545e6c231', '', '', '', '2018-01-15 07:12:31', '2018-01-15 14:12:31'),
(28, 3, 0, 0, 0, 0, 6, 1, '5a5c545e6c231', '', '', '', '2018-01-15 07:12:36', '2018-01-15 14:12:36'),
(29, 3, 0, 0, 0, 0, 6, 1, '5a5c54c765469', '', '', '', '2018-01-15 07:14:17', '2018-01-15 14:14:17'),
(30, 2, 0, 0, 0, 0, 6, 1, '5a5c54c765469', '', '', '', '2018-01-15 07:14:27', '2018-01-15 14:14:27'),
(31, 3, 0, 0, 0, 0, 6, 1, '5a5c54e53d976', '', '', '', '2018-01-15 07:14:46', '2018-01-15 14:14:46'),
(32, 3, 0, 0, 0, 0, 6, 1, '5a5c5588c7981', '', '', '', '2018-01-15 07:17:30', '2018-01-15 14:17:30'),
(33, 3, 0, 0, 0, 0, 10, 1, '5a5c55e2b2a97', '', '', '', '2018-01-15 07:18:59', '2018-01-15 14:18:59'),
(34, 2, 0, 0, 0, 0, 12, 1, '5a5c55e2b2a97', '', '', '', '2018-01-15 07:19:55', '2018-01-15 14:19:55'),
(35, 4, 0, 0, 0, 0, 12, 1, '5a5c55e2b2a97', '', '', '', '2018-01-15 07:20:20', '2018-01-15 14:20:20'),
(36, 4, 0, 0, 0, 0, 6, 1, '5a5c566159dbd', '', '', '', '2018-01-15 07:21:06', '2018-01-15 14:21:06'),
(37, 2, 0, 0, 0, 0, 6, 1, '5a5c56d02a714', '', '', '', '2018-01-15 07:22:57', '2018-01-15 14:22:57'),
(38, 3, 0, 0, 0, 0, 6, 1, '5a5c56d02a714', '', '', '', '2018-01-15 07:23:06', '2018-01-15 14:23:06'),
(39, 5, 0, 0, 0, 0, 12, 1, '5a5c56d02a714', '', '', '', '2018-01-15 07:23:26', '2018-01-15 14:23:26'),
(40, 5, 0, 0, 0, 0, 6, 1, '5a5c5808a21ae', '', '', '', '2018-01-15 07:28:09', '2018-01-15 14:28:09'),
(41, 2, 0, 0, 0, 0, 6, 1, '5a5c59832ea2c', '', '', '', '2018-01-15 07:34:28', '2018-01-15 14:34:28'),
(42, 5, 0, 0, 0, 0, 12, 1, '5a5c59832ea2c', '', '', '', '2018-01-15 07:34:36', '2018-01-15 14:34:36'),
(43, 13, 0, 0, 0, 0, 6, 1, '5a5c5e97bf044', '', '', '', '2018-01-15 07:56:30', '2018-01-15 14:56:30'),
(44, 3, 0, 0, 0, 0, 6, 1, '5a5c5e97bf044', '', '', '', '2018-01-15 07:56:42', '2018-01-15 14:56:42'),
(45, 5, 0, 0, 0, 0, 6, 1, '5a5c5e97bf044', '', '', '', '2018-01-15 07:56:44', '2018-01-15 14:56:44'),
(46, 5, 0, 0, 0, 0, 6, 1, '5a5c60cd6e543', '', '', '', '2018-01-15 08:05:36', '2018-01-15 15:05:36'),
(47, 5, 0, 0, 0, 0, 6, 1, '5a5c6192ebba7', '', '', '', '2018-01-15 08:08:52', '2018-01-15 15:08:52'),
(48, 5, 0, 0, 0, 0, 6, 1, '5a5c61b448924', '', '', '', '2018-01-15 08:09:26', '2018-01-15 15:09:26'),
(49, 5, 0, 0, 0, 0, 6, 1, '5a5c622a9611e', '', '', '', '2018-01-15 08:11:23', '2018-01-15 15:11:23'),
(50, 5, 0, 0, 0, 0, 6, 1, '5a5c62563f8e8', '', '', '', '2018-01-15 08:12:07', '2018-01-15 15:12:07'),
(51, 5, 0, 0, 0, 0, 6, 1, '5a5c6469cfbdc', '', '', '', '2018-01-15 08:20:58', '2018-01-15 15:20:58'),
(52, 5, 0, 0, 0, 0, 6, 1, '5a5c64c6ce169', '', '', '', '2018-01-15 08:22:32', '2018-01-15 15:22:32'),
(53, 5, 0, 0, 0, 0, 12, 1, '5a5c75e1b15a0', '', '', '', '2018-01-15 09:35:31', '2018-01-15 16:35:31'),
(54, 5, 0, 0, 0, 0, 6, 1, '5a5c75e1b15a0', '', '', '', '2018-01-15 09:36:01', '2018-01-15 16:36:01'),
(55, 5, 0, 0, 0, 0, 6, 1, '5a5c772237260', '', '', '', '2018-01-15 09:40:52', '2018-01-15 16:40:52'),
(56, 5, 0, 0, 0, 0, 6, 1, '5a5c773be348d', '', '', '', '2018-01-15 09:41:16', '2018-01-15 16:41:16'),
(57, 5, 0, 0, 0, 0, 6, 1, '5a5c775755739', '', '', '', '2018-01-15 09:42:05', '2018-01-15 16:42:05'),
(58, 5, 0, 0, 0, 0, 7, 1, '5a5c77a1c04ae', '', '', '', '2018-01-15 09:42:58', '2018-01-15 16:42:58'),
(59, 5, 0, 0, 0, 0, 6, 1, '5a5c77cc0302d', '', '', '', '2018-01-15 09:43:41', '2018-01-15 16:43:41'),
(60, 12, 0, 0, 0, 0, 6, 1, '5a5c77cc0302d', '', '', '', '2018-01-15 09:43:46', '2018-01-15 16:43:46'),
(61, 5, 0, 0, 0, 0, 6, 1, '5a5c7a2b53218', '', '', '', '2018-01-15 09:53:49', '2018-01-15 16:53:49'),
(62, 11, 0, 0, 0, 0, 6, 1, '5a5c7a2b53218', '', '', '', '2018-01-15 09:53:55', '2018-01-15 16:53:55'),
(63, 12, 0, 0, 0, 0, 6, 1, '5a5c7b5561d5e', '', '', '', '2018-01-15 09:58:48', '2018-01-15 16:58:48'),
(64, 11, 0, 0, 0, 0, 6, 1, '5a5c7bd10292a', '', '', '', '2018-01-15 10:00:52', '2018-01-15 17:00:52'),
(65, 6, 0, 0, 0, 0, 6, 1, '5a5c7bd8aed9e', '', '', '', '2018-01-15 10:01:03', '2018-01-15 17:01:03'),
(66, 12, 0, 0, 0, 0, 6, 1, '5a5c7bd8aed9e', '', '', '', '2018-01-15 10:01:07', '2018-01-15 17:01:07'),
(67, 12, 0, 0, 0, 0, 6, 1, '5a5c7cf78f8ff', '', '', '', '2018-01-15 10:05:46', '2018-01-15 17:05:46'),
(68, 11, 0, 0, 0, 0, 6, 1, '5a5c7cf78f8ff', '', '', '', '2018-01-15 10:06:03', '2018-01-15 17:06:03'),
(69, 13, 0, 0, 0, 0, 6, 1, '5a5c7cf78f8ff', '', '', '', '2018-01-15 10:06:15', '2018-01-15 17:06:15'),
(70, 14, 0, 0, 0, 0, 6, 1, '5a5c7cf78f8ff', '', '', '', '2018-01-15 10:06:39', '2018-01-15 17:06:39'),
(71, 12, 0, 0, 0, 0, 6, 1, '5a5c7de8e51ce', '', '', '', '2018-01-15 10:09:49', '2018-01-15 17:09:49'),
(72, 12, 0, 0, 0, 0, 6, 1, '5a5c7eaa3f64f', '', '', '', '2018-01-15 10:13:00', '2018-01-15 17:13:00'),
(73, 13, 0, 0, 0, 0, 6, 1, '5a5c7eaa3f64f', '', '', '', '2018-01-15 10:13:05', '2018-01-15 17:13:05'),
(74, 11, 0, 0, 0, 0, 6, 1, '5a5c7eaa3f64f', '', '', '', '2018-01-15 10:13:08', '2018-01-15 17:13:08'),
(75, 12, 0, 0, 0, 0, 6, 1, '5a5c7ed8398e4', '', '', '', '2018-01-15 10:13:46', '2018-01-15 17:13:46'),
(76, 12, 0, 0, 0, 0, 6, 1, '5a5c7ed8398e4', '', '', '', '2018-01-15 10:14:17', '2018-01-15 17:14:17'),
(77, 11, 0, 0, 0, 0, 6, 1, '5a5c7f1f0dac2', '', '', '', '2018-01-15 10:14:56', '2018-01-15 17:14:56'),
(78, 12, 0, 0, 0, 0, 6, 1, '5a5c7f1f0dac2', '', '', '', '2018-01-15 10:15:01', '2018-01-15 17:15:01'),
(79, 12, 0, 0, 0, 0, 6, 1, '5a5c7f49df69f', '', '', '', '2018-01-15 10:15:39', '2018-01-15 17:15:39'),
(80, 14, 0, 0, 0, 0, 6, 1, '5a5c7f8a7f7bb', '', '', '', '2018-01-15 10:16:46', '2018-01-15 17:16:46'),
(81, 13, 0, 0, 0, 0, 6, 1, '5a5c810ec13a7', '', '', '', '2018-01-15 10:23:18', '2018-01-15 17:23:18'),
(82, 15, 0, 0, 0, 0, 6, 1, '5a5c8172ec357', '', '', '', '2018-01-15 10:24:52', '2018-01-15 17:24:52'),
(83, 13, 0, 0, 0, 0, 6, 1, '5a5c8172ec357', '', '', '', '2018-01-15 10:25:10', '2018-01-15 17:25:10'),
(84, 13, 0, 0, 0, 0, 6, 1, '5a5c819a440e5', '', '', '', '2018-01-15 10:25:32', '2018-01-15 17:25:32'),
(85, 12, 0, 0, 0, 0, 6, 1, '5a5c81f469526', '', '', '', '2018-01-15 10:27:02', '2018-01-15 17:27:02'),
(86, 13, 0, 0, 0, 0, 6, 1, '5a5c81f469526', '', '', '', '2018-01-15 10:27:07', '2018-01-15 17:27:07'),
(87, 14, 0, 0, 0, 0, 6, 1, '5a5c81f469526', '', '', '', '2018-01-15 10:27:14', '2018-01-15 17:27:14'),
(88, 15, 0, 0, 0, 0, 6, 1, '5a5c81f469526', '', '', '', '2018-01-15 10:29:32', '2018-01-15 17:29:32'),
(89, 11, 0, 0, 0, 0, 6, 1, '5a5c82c3936f7', '', '', '', '2018-01-15 10:30:29', '2018-01-15 17:30:29'),
(90, 13, 0, 0, 0, 0, 6, 1, '5a5c82c3936f7', '', '', '', '2018-01-15 10:30:37', '2018-01-15 17:30:37'),
(91, 12, 0, 0, 0, 0, 6, 1, '5a5c82c3936f7', '', '', '', '2018-01-15 10:30:42', '2018-01-15 17:30:42'),
(92, 11, 0, 0, 0, 0, 9, 1, '5a5c83233d0e6', '', '', '', '2018-01-15 10:32:05', '2018-01-15 17:32:05'),
(93, 14, 0, 0, 0, 0, 6, 1, '5a5c83233d0e6', '', '', '', '2018-01-15 10:32:20', '2018-01-15 17:32:20');

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `ewd_block_part_meta`
--
ALTER TABLE `ewd_block_part_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT for table `ewd_media_type`
--
ALTER TABLE `ewd_media_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ewd_parts`
--
ALTER TABLE `ewd_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `ewd_types`
--
ALTER TABLE `ewd_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
