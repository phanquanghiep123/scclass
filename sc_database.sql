-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2018 at 03:22 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'thêm', '<i class="fa fa-plus-square" aria-hidden="true"></i>', 0, 1, '/block/theme/section/'),
(2, 'sửa', '<i class="fa fa-pencil" aria-hidden="true"></i>', 0, 1, '/part/block/theme/section/'),
(3, 'xóa', '<i class="fa fa-trash" aria-hidden="true"></i>', 0, 1, '/part/block/theme/section/'),
(4, 'xem thêm', '<i class="fa fa-arrow-down" aria-hidden="true"></i>', 0, 1, '/section/');

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
(1, 1, 'value_text', 0, 0, '<p>fdgfgdfgdg</p>\n<p>fgdfgdgfdgdfgfd</p>\n<p>dfgdfgdfgfd</p>', '2018-01-15 13:48:27', '2018-01-15 20:48:27', 0),
(2, 3, 'value_media', 0, 0, '', '2018-01-15 13:52:22', '2018-01-15 20:52:22', 485),
(4, 6, 'value_text', 0, 0, 'fg fgfgd', '2018-01-15 13:59:14', '2018-01-15 20:59:14', 0),
(5, 7, 'value_text', 0, 0, '15/01/2018', '2018-01-15 14:01:14', '2018-01-15 21:01:14', 0),
(6, 8, 'value_text', 0, 0, '15/01/2018', '2018-01-15 14:01:21', '2018-01-15 21:01:21', 0),
(7, 9, 'value_text', 0, 0, '01/2018', '2018-01-15 14:01:30', '2018-01-15 21:01:30', 0),
(8, 10, 'value_text', 0, 0, '22:00', '2018-01-15 14:01:35', '2018-01-15 21:01:35', 0),
(9, 11, 'value_text', 0, 0, '2018', '2018-01-15 14:01:40', '2018-01-15 21:01:40', 0),
(10, 5, 'value_text', 0, 0, '20/01/2018 21:00', '2018-01-15 14:02:34', '2018-01-15 21:02:34', 0),
(11, 14, 'value_media', 0, 0, '', '2018-01-15 14:08:06', '2018-01-15 21:08:06', 479),
(12, 15, 'value_media', 0, 0, '', '2018-01-15 14:12:02', '2018-01-15 21:12:02', 474),
(13, 15, 'value_media', 0, 0, '', '2018-01-15 14:12:02', '2018-01-15 21:12:02', 475),
(14, 15, 'value_media', 0, 0, '', '2018-01-15 14:12:02', '2018-01-15 21:12:02', 478),
(15, 15, 'value_media', 0, 0, '', '2018-01-15 14:12:03', '2018-01-15 21:12:03', 479),
(16, 19, 'value_media', 0, 0, '', '2018-01-15 14:20:42', '2018-01-15 21:20:42', 474),
(17, 19, 'value_media', 0, 0, '', '2018-01-15 14:20:42', '2018-01-15 21:20:42', 475),
(18, 19, 'value_media', 0, 0, '', '2018-01-15 14:20:42', '2018-01-15 21:20:42', 478),
(19, 19, 'value_media', 0, 0, '', '2018-01-15 14:20:42', '2018-01-15 21:20:42', 479),
(20, 20, 'value_media', 0, 0, '', '2018-01-15 14:21:09', '2018-01-15 21:21:09', 475),
(21, 21, 'value_media', 0, 0, '', '2018-01-15 14:21:26', '2018-01-15 21:21:26', 474),
(22, 21, 'value_media', 0, 0, '', '2018-01-15 14:21:26', '2018-01-15 21:21:26', 475),
(23, 21, 'value_media', 0, 0, '', '2018-01-15 14:21:26', '2018-01-15 21:21:26', 478),
(24, 21, 'value_media', 0, 0, '', '2018-01-15 14:21:26', '2018-01-15 21:21:26', 479);

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
(484, 'hours.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', '/uploads/5a5c7aefb11c7.html', 8, 'html', 254, '467', '/467/484/', 0, 0, '', '2018-01-15 09:57:03', '2018-01-15 16:57:03'),
(485, 'videoplayback.mp4', '/uploads/5a5ca929358ed.mp4', '/uploads/5a5ca929358ed.mp4', '/uploads/5a5ca929358ed.mp4', '/uploads/5a5ca929358ed.mp4', '/uploads/5a5ca929358ed.mp4', '/uploads/5a5ca929358ed.mp4', 5, 'mp4', 32588036, '0', '/485/', 0, 0, '', '2018-01-15 13:14:18', '2018-01-15 20:14:18'),
(486, 'QuaKhuNgotNgaoEricTjRemixVinahouse-DinhKienPhong-5051557.mp3', '/uploads/5a5cafa9aecde.mp3', '/uploads/5a5cafa9aecde.mp3', '/uploads/5a5cafa9aecde.mp3', '/uploads/5a5cafa9aecde.mp3', '/uploads/5a5cafa9aecde.mp3', '/uploads/5a5cafa9aecde.mp3', 4, 'mp3', 4063319, '0', '/486/', 0, 0, '', '2018-01-15 13:42:01', '2018-01-15 20:42:01');

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
(3, 'image', '471', '<div class="item-list">	\n    <a class="delete-item" href="javascript:;">X</a>\n	<img src = "{{value}}" class="value_show src_image">  \n</div>\n', '2018-01-12 02:33:39', '2018-01-12 09:33:39', 1),
(4, 'list images ', '470', '<div class="item-list">	\n    <a class="delete-item" href="javascript:;">X</a>\n	<img src = "{{value}}" class="value_show src_image">  \n</div>\n', '2018-01-12 02:35:19', '2018-01-12 09:35:19', 1),
(5, 'content', '469', '{{value}}', '2018-01-12 02:35:39', '2018-01-12 09:35:39', 1),
(6, 'video', '473', '<div class="item-list">	\n    <a class="delete-item" href="javascript:;">X</a>\n	<video class="value_show src_video" src="{{value}}" controls></video>\n</div>', '2018-01-12 02:36:04', '2018-01-12 09:36:04', 1),
(7, 'audio', '468', '<div class="item-list">	\n    <a class="delete-item" href="javascript:;">X</a>\n	<audio class="value_show src_audio" src="{{value}}" controls></audio>\n</div>', '2018-01-12 02:36:28', '2018-01-12 09:36:28', 1),
(8, 'list videos', '477', '<div class="item-list">	\n    <a class="delete-item" href="javascript:;">X</a>\n	<video class="value_show src_video" src="{{value}}" controls></video>\n</div>', '2018-01-12 02:41:29', '2018-01-12 09:41:29', 1),
(9, 'list audios', '476', '<div class="item-list">	\n    <a class="delete-item" href="javascript:;">X</a>\n	<audio class="value_show src_audio" src="{{value}}" controls></audio>\n</div>', '2018-01-12 02:41:51', '2018-01-12 09:41:51', 1),
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
(93, 0, 0, 2, 1),
(108, 0, 0, 2, 1),
(108, 0, 0, 3, 1);

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
(1, 5, 0, 0, 0, 0, 6, 1, '5a5cb11da859c', '', '', '', '2018-01-15 13:48:17', '2018-01-15 20:48:17'),
(2, 2, 0, 0, 0, 0, 6, 1, '5a5cb209391b7', '', '', '', '2018-01-15 13:52:11', '2018-01-15 20:52:11'),
(3, 6, 0, 0, 0, 0, 6, 1, '5a5cb209391b7', '', '', '', '2018-01-15 13:52:15', '2018-01-15 20:52:15'),
(4, 12, 0, 0, 0, 0, 6, 1, '5a5cb209391b7', '', '', '', '2018-01-15 13:52:50', '2018-01-15 20:52:50'),
(5, 11, 0, 0, 0, 0, 12, 1, '5a5cb23fc8b96', '', '', '', '2018-01-15 13:53:09', '2018-01-15 20:53:09'),
(6, 2, 0, 0, 0, 0, 6, 1, '5a5cb23fc8b96', '', '', '', '2018-01-15 13:59:11', '2018-01-15 20:59:11'),
(7, 12, 0, 0, 0, 0, 6, 1, '5a5cb23fc8b96', '', '', '', '2018-01-15 14:01:10', '2018-01-15 21:01:10'),
(8, 12, 0, 0, 0, 0, 6, 1, '5a5cb23fc8b96', '', '', '', '2018-01-15 14:01:16', '2018-01-15 21:01:16'),
(9, 13, 0, 0, 0, 0, 6, 1, '5a5cb23fc8b96', '', '', '', '2018-01-15 14:01:22', '2018-01-15 21:01:22'),
(10, 14, 0, 0, 0, 0, 6, 1, '5a5cb23fc8b96', '', '', '', '2018-01-15 14:01:33', '2018-01-15 21:01:33'),
(11, 15, 0, 0, 0, 0, 6, 1, '5a5cb23fc8b96', '', '', '', '2018-01-15 14:01:37', '2018-01-15 21:01:37'),
(12, 4, 0, 0, 0, 0, 6, 1, '5a5cb23fc8b96', '', '', '', '2018-01-15 14:02:41', '2018-01-15 21:02:41'),
(13, 4, 0, 0, 0, 0, 6, 1, '5a5cb4bde4c92', '', '', '', '2018-01-15 14:03:43', '2018-01-15 21:03:43'),
(14, 3, 0, 0, 0, 0, 6, 1, '5a5cb5b5a4979', '', '', '', '2018-01-15 14:07:51', '2018-01-15 21:07:51'),
(15, 4, 0, 0, 0, 0, 6, 1, '5a5cb5b5a4979', '', '', '', '2018-01-15 14:08:07', '2018-01-15 21:08:07'),
(16, 4, 0, 0, 0, 0, 6, 1, '5a5cb5b5a4979', '', '', '', '2018-01-15 14:12:10', '2018-01-15 21:12:10'),
(17, 4, 0, 0, 0, 0, 6, 1, '5a5cb81eb1581', '', '', '', '2018-01-15 14:18:07', '2018-01-15 21:18:07'),
(18, 4, 0, 0, 0, 0, 6, 1, '5a5cb82ceb3e2', '', '', '', '2018-01-15 14:18:22', '2018-01-15 21:18:22'),
(19, 4, 0, 0, 0, 0, 12, 1, '5a5cb8951ebb6', '', '', '', '2018-01-15 14:20:12', '2018-01-15 21:20:12'),
(20, 3, 0, 0, 0, 0, 4, 1, '5a5cb8951ebb6', '', '', '', '2018-01-15 14:20:47', '2018-01-15 21:20:47'),
(21, 4, 0, 0, 0, 0, 8, 1, '5a5cb8951ebb6', '', '', '', '2018-01-15 14:20:53', '2018-01-15 21:20:53');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=487;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ewd_types`
--
ALTER TABLE `ewd_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
