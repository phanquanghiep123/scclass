-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2017 at 01:01 AM
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
(1, 'thêm', '<i class="fa fa-plus-square" aria-hidden="true"></i>', 0, 1, '0'),
(2, 'sửa', '<i class="fa fa-pencil" aria-hidden="true"></i>', 0, 1, '0'),
(3, 'xóa', '<i class="fa fa-trash" aria-hidden="true"></i>', 0, 1, '0'),
(4, 'xem thêm', '<i class="fa fa-arrow-down" aria-hidden="true"></i>', 0, 1, '0');

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

--
-- Dumping data for table `ewd_blocks`
--

INSERT INTO `ewd_blocks` (`id`, `name`, `ncolum`, `status`) VALUES
(1, 'colum 1', 1, 1),
(2, 'colum 2', 2, 1),
(3, 'colum 3', 3, 1),
(4, 'colum 4', 4, 1),
(5, 'colum 5', 5, 1),
(6, 'colum 6', 6, 1),
(7, 'colum 7', 7, 1),
(8, 'colum 8', 8, 1),
(9, 'colum 9', 9, 1),
(10, 'colum 10', 10, 1),
(11, 'colum 11', 11, 1),
(12, 'colum 12', 12, 1);

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
(1, 'aa.jpg', '/uploads/5a45fe4275f4d.jpg', '/uploads/full/5a45fe4275f4d.jpg', '/uploads/large/5a45fe4275f4d.jpg', '/uploads/medium/5a45fe4275f4d.jpg', '/uploads/small/5a45fe4275f4d.jpg', '/uploads/thumb/5a45fe4275f4d.jpg', 1, 'jpg', 3263061, 0),
(2, 'Horace__Charcoal_SP1715-0725 (1).JPG', '/uploads/5a45fe4993d3e.jpg', '/uploads/5a45fe4993d3e.jpg', '/uploads/large/5a45fe4993d3e.jpg', '/uploads/medium/5a45fe4993d3e.jpg', '/uploads/small/5a45fe4993d3e.jpg', '/uploads/thumb/5a45fe4993d3e.jpg', 1, 'JPG', 1744526, 0),
(3, 'Horace__Charcoal_SP1715-0725.JPG', '/uploads/5a45fe4d2876e.jpg', '/uploads/5a45fe4d2876e.jpg', '/uploads/large/5a45fe4d2876e.jpg', '/uploads/medium/5a45fe4d2876e.jpg', '/uploads/small/5a45fe4d2876e.jpg', '/uploads/thumb/5a45fe4d2876e.jpg', 1, 'JPG', 1744526, 0),
(4, 'Horace__Cinnabar_SP1715-0729 (1).JPG', '/uploads/5a45fe50b7a59.jpg', '/uploads/5a45fe50b7a59.jpg', '/uploads/large/5a45fe50b7a59.jpg', '/uploads/medium/5a45fe50b7a59.jpg', '/uploads/small/5a45fe50b7a59.jpg', '/uploads/thumb/5a45fe50b7a59.jpg', 1, 'JPG', 3015023, 0),
(5, 'Horace__Cinnabar_SP1715-0729.JPG', '/uploads/5a45fe54d07c5.jpg', '/uploads/5a45fe54d07c5.jpg', '/uploads/large/5a45fe54d07c5.jpg', '/uploads/medium/5a45fe54d07c5.jpg', '/uploads/small/5a45fe54d07c5.jpg', '/uploads/thumb/5a45fe54d07c5.jpg', 1, 'JPG', 3015023, 0),
(6, 'Horace_Putty_SP1715-0733.JPG', '/uploads/5a45fe591a3c5.jpg', '/uploads/full/5a45fe591a3c5.jpg', '/uploads/large/5a45fe591a3c5.jpg', '/uploads/medium/5a45fe591a3c5.jpg', '/uploads/small/5a45fe591a3c5.jpg', '/uploads/thumb/5a45fe591a3c5.jpg', 1, 'JPG', 3263061, 0),
(7, 'Jeeves_Charcoal_SP2005-0735 (1).JPG', '/uploads/5a45fe5fa3a6c.jpg', '/uploads/full/5a45fe5fa3a6c.jpg', '/uploads/large/5a45fe5fa3a6c.jpg', '/uploads/medium/5a45fe5fa3a6c.jpg', '/uploads/small/5a45fe5fa3a6c.jpg', '/uploads/thumb/5a45fe5fa3a6c.jpg', 1, 'JPG', 2515241, 0),
(8, 'Jeeves_Charcoal_SP2005-0735.JPG', '/uploads/5a45fe66b549e.jpg', '/uploads/full/5a45fe66b549e.jpg', '/uploads/large/5a45fe66b549e.jpg', '/uploads/medium/5a45fe66b549e.jpg', '/uploads/small/5a45fe66b549e.jpg', '/uploads/thumb/5a45fe66b549e.jpg', 1, 'JPG', 2515241, 0),
(9, 'Jeeves_Cinnabar_SP2005-0739 (1).JPG', '/uploads/5a45fe6de531e.jpg', '/uploads/5a45fe6de531e.jpg', '/uploads/large/5a45fe6de531e.jpg', '/uploads/medium/5a45fe6de531e.jpg', '/uploads/small/5a45fe6de531e.jpg', '/uploads/thumb/5a45fe6de531e.jpg', 1, 'JPG', 2818946, 0),
(10, 'Jeeves_Cinnabar_SP2005-0739.JPG', '/uploads/5a45fe73311a5.jpg', '/uploads/5a45fe73311a5.jpg', '/uploads/large/5a45fe73311a5.jpg', '/uploads/medium/5a45fe73311a5.jpg', '/uploads/small/5a45fe73311a5.jpg', '/uploads/thumb/5a45fe73311a5.jpg', 1, 'JPG', 2818946, 0),
(11, 'Jeeves_Pewter_SP2005-0742.JPG', '/uploads/5a45fe772e816.jpg', '/uploads/full/5a45fe772e816.jpg', '/uploads/large/5a45fe772e816.jpg', '/uploads/medium/5a45fe772e816.jpg', '/uploads/small/5a45fe772e816.jpg', '/uploads/thumb/5a45fe772e816.jpg', 1, 'JPG', 2508854, 0),
(12, 'Jeeves_Putty_SP2005-0743.JPG', '/uploads/5a45fe7ddf06a.jpg', '/uploads/full/5a45fe7ddf06a.jpg', '/uploads/large/5a45fe7ddf06a.jpg', '/uploads/medium/5a45fe7ddf06a.jpg', '/uploads/small/5a45fe7ddf06a.jpg', '/uploads/thumb/5a45fe7ddf06a.jpg', 1, 'JPG', 2790433, 0),
(13, 'Jeeves_Quartz_SP2005-0737.JPG', '/uploads/5a45fe83d9ad2.jpg', '/uploads/full/5a45fe83d9ad2.jpg', '/uploads/large/5a45fe83d9ad2.jpg', '/uploads/medium/5a45fe83d9ad2.jpg', '/uploads/small/5a45fe83d9ad2.jpg', '/uploads/thumb/5a45fe83d9ad2.jpg', 1, 'JPG', 2849626, 0),
(14, 'Nigel_Charcoal_SP1755-0716.JPG', '/uploads/5a45fe89cb0b4.jpg', '/uploads/5a45fe89cb0b4.jpg', '/uploads/large/5a45fe89cb0b4.jpg', '/uploads/medium/5a45fe89cb0b4.jpg', '/uploads/small/5a45fe89cb0b4.jpg', '/uploads/thumb/5a45fe89cb0b4.jpg', 1, 'JPG', 2067717, 0),
(15, 'Nigel_Cinnabar_SP1755-0719.JPG', '/uploads/5a45fe8d53b41.jpg', '/uploads/full/5a45fe8d53b41.jpg', '/uploads/large/5a45fe8d53b41.jpg', '/uploads/medium/5a45fe8d53b41.jpg', '/uploads/small/5a45fe8d53b41.jpg', '/uploads/thumb/5a45fe8d53b41.jpg', 1, 'jpg', 2858521, 0),
(16, 'Nigel_Putty_SP1755-0721.JPG', '/uploads/5a45fe944f7c7.jpg', '/uploads/full/5a45fe944f7c7.jpg', '/uploads/large/5a45fe944f7c7.jpg', '/uploads/medium/5a45fe944f7c7.jpg', '/uploads/small/5a45fe944f7c7.jpg', '/uploads/thumb/5a45fe944f7c7.jpg', 1, 'jpg', 2594144, 0),
(17, 'Nigel_Quartz_SP1755-0717.JPG', '/uploads/5a45fe9edd819.jpg', '/uploads/full/5a45fe9edd819.jpg', '/uploads/large/5a45fe9edd819.jpg', '/uploads/medium/5a45fe9edd819.jpg', '/uploads/small/5a45fe9edd819.jpg', '/uploads/thumb/5a45fe9edd819.jpg', 1, 'jpg', 2451440, 0),
(18, 'Promotional Page Data ABedit.xlsx', '/uploads/5a45feaa4421b.xlsx', '', '', '', '', '', 7, 'xlsx', 8490, 0),
(19, 'Riffle_Celadon_V948-14.jpg', '/uploads/5a45feaa9a33c.jpg', '/uploads/5a45feaa9a33c.jpg', '/uploads/5a45feaa9a33c.jpg', '/uploads/medium/5a45feaa9a33c.jpg', '/uploads/small/5a45feaa9a33c.jpg', '/uploads/thumb/5a45feaa9a33c.jpg', 1, 'jpg', 968374, 0),
(20, 'Riffle_Olive_V948-9865.JPG', '/uploads/5a45feac6f815.jpg', '/uploads/5a45feac6f815.jpg', '/uploads/5a45feac6f815.jpg', '/uploads/medium/5a45feac6f815.jpg', '/uploads/small/5a45feac6f815.jpg', '/uploads/thumb/5a45feac6f815.jpg', 1, 'jpg', 1032790, 0),
(21, 'Riffle_Sand_V948-9867.JPG', '/uploads/5a45feae6b33f.jpg', '/uploads/5a45feae6b33f.jpg', '/uploads/5a45feae6b33f.jpg', '/uploads/medium/5a45feae6b33f.jpg', '/uploads/small/5a45feae6b33f.jpg', '/uploads/thumb/5a45feae6b33f.jpg', 1, 'jpg', 959866, 0),
(22, 'Riffle_Wheat_V948-9862.JPG', '/uploads/5a45feb03ff93.jpg', '/uploads/5a45feb03ff93.jpg', '/uploads/5a45feb03ff93.jpg', '/uploads/medium/5a45feb03ff93.jpg', '/uploads/small/5a45feb03ff93.jpg', '/uploads/thumb/5a45feb03ff93.jpg', 1, 'jpg', 851588, 0),
(23, 'Jeeves_Charcoal_SP2005-0735.JPG', '/uploads/5a45ff117e4c9.jpg', '/uploads/full/5a45ff117e4c9.jpg', '/uploads/large/5a45ff117e4c9.jpg', '/uploads/medium/5a45ff117e4c9.jpg', '/uploads/small/5a45ff117e4c9.jpg', '/uploads/thumb/5a45ff117e4c9.jpg', 1, 'jpg', 2515241, 0),
(24, 'Nigel_Cinnabar_SP1755-0719.JPG', '/uploads/5a4600f07f809.jpg', '/uploads/full/5a4600f07f809.jpg', '/uploads/large/5a4600f07f809.jpg', '/uploads/medium/5a4600f07f809.jpg', '/uploads/small/5a4600f07f809.jpg', '/uploads/thumb/5a4600f07f809.jpg', 1, 'jpg', 2858521, 0),
(25, 'Nigel_Cinnabar_SP1755-0719.JPG', '/uploads/5a460245ef136.jpg', '/uploads/full/5a460245ef136.jpg', '/uploads/large/5a460245ef136.jpg', '/uploads/medium/5a460245ef136.jpg', '/uploads/small/5a460245ef136.jpg', '/uploads/thumb/5a460245ef136.jpg', 1, 'jpg', 2858521, 0),
(26, 'Nigel_Putty_SP1755-0721.JPG', '/uploads/5a46024c4c63c.jpg', '/uploads/full/5a46024c4c63c.jpg', '/uploads/large/5a46024c4c63c.jpg', '/uploads/medium/5a46024c4c63c.jpg', '/uploads/small/5a46024c4c63c.jpg', '/uploads/thumb/5a46024c4c63c.jpg', 1, 'jpg', 2594144, 0),
(27, 'Nigel_Quartz_SP1755-0717.JPG', '/uploads/5a46025310526.jpg', '/uploads/full/5a46025310526.jpg', '/uploads/large/5a46025310526.jpg', '/uploads/medium/5a46025310526.jpg', '/uploads/small/5a46025310526.jpg', '/uploads/thumb/5a46025310526.jpg', 1, 'jpg', 2451440, 0),
(28, 'Nigel_Cinnabar_SP1755-0719.JPG', '/uploads/5a460274239c8.jpg', '/uploads/full/5a460274239c8.jpg', '/uploads/large/5a460274239c8.jpg', '/uploads/medium/5a460274239c8.jpg', '/uploads/small/5a460274239c8.jpg', '/uploads/thumb/5a460274239c8.jpg', 1, 'jpg', 2858521, 0),
(29, 'Riffle_Sand_V948-9867.JPG', '/uploads/5a46027a6f587.jpg', '/uploads/5a46027a6f587.jpg', '/uploads/5a46027a6f587.jpg', '/uploads/medium/5a46027a6f587.jpg', '/uploads/small/5a46027a6f587.jpg', '/uploads/thumb/5a46027a6f587.jpg', 1, 'jpg', 959866, 0),
(30, 'Riffle_Wheat_V948-9862.JPG', '/uploads/5a46027ba5b61.jpg', '/uploads/5a46027ba5b61.jpg', '/uploads/5a46027ba5b61.jpg', '/uploads/medium/5a46027ba5b61.jpg', '/uploads/small/5a46027ba5b61.jpg', '/uploads/thumb/5a46027ba5b61.jpg', 1, 'jpg', 851588, 0),
(31, 'Horace_Putty_SP1715-0733.JPG', '/uploads/5a4602c23f5a9.jpg', '/uploads/full/5a4602c23f5a9.jpg', '/uploads/large/5a4602c23f5a9.jpg', '/uploads/medium/5a4602c23f5a9.jpg', '/uploads/small/5a4602c23f5a9.jpg', '/uploads/thumb/5a4602c23f5a9.jpg', 1, 'jpg', 3263061, 0),
(32, 'Jeeves_Cinnabar_SP2005-0739 (1).JPG', '/uploads/5a4602c8a52ee.jpg', '/uploads/5a4602c8a52ee.jpg', '/uploads/large/5a4602c8a52ee.jpg', '/uploads/medium/5a4602c8a52ee.jpg', '/uploads/small/5a4602c8a52ee.jpg', '/uploads/thumb/5a4602c8a52ee.jpg', 1, 'jpg', 2818946, 0),
(33, 'Jeeves_Cinnabar_SP2005-0739.JPG', '/uploads/5a4602ccbd609.jpg', '/uploads/5a4602ccbd609.jpg', '/uploads/large/5a4602ccbd609.jpg', '/uploads/medium/5a4602ccbd609.jpg', '/uploads/small/5a4602ccbd609.jpg', '/uploads/thumb/5a4602ccbd609.jpg', 1, 'jpg', 2818946, 0),
(34, 'Jeeves_Pewter_SP2005-0742.JPG', '/uploads/5a4602d0d0de9.jpg', '/uploads/full/5a4602d0d0de9.jpg', '/uploads/large/5a4602d0d0de9.jpg', '/uploads/medium/5a4602d0d0de9.jpg', '/uploads/small/5a4602d0d0de9.jpg', '/uploads/thumb/5a4602d0d0de9.jpg', 1, 'jpg', 2508854, 0),
(35, 'Jeeves_Putty_SP2005-0743.JPG', '/uploads/5a4602d73a154.jpg', '/uploads/full/5a4602d73a154.jpg', '/uploads/large/5a4602d73a154.jpg', '/uploads/medium/5a4602d73a154.jpg', '/uploads/small/5a4602d73a154.jpg', '/uploads/thumb/5a4602d73a154.jpg', 1, 'jpg', 2790433, 0),
(36, 'Nigel_Cinnabar_SP1755-0719.JPG', '/uploads/5a460304a9f90.jpg', '/uploads/full/5a460304a9f90.jpg', '/uploads/large/5a460304a9f90.jpg', '/uploads/medium/5a460304a9f90.jpg', '/uploads/small/5a460304a9f90.jpg', '/uploads/thumb/5a460304a9f90.jpg', 1, 'jpg', 2858521, 0),
(37, 'Jeeves_Charcoal_SP2005-0735 (1).JPG', '/uploads/5a46034349d4f.jpg', '/uploads/full/5a46034349d4f.jpg', '/uploads/large/5a46034349d4f.jpg', '/uploads/medium/5a46034349d4f.jpg', '/uploads/small/5a46034349d4f.jpg', '/uploads/thumb/5a46034349d4f.jpg', 1, 'jpg', 2515241, 0),
(38, 'Jeeves_Charcoal_SP2005-0735.JPG', '/uploads/5a46034a49c10.jpg', '/uploads/full/5a46034a49c10.jpg', '/uploads/large/5a46034a49c10.jpg', '/uploads/medium/5a46034a49c10.jpg', '/uploads/small/5a46034a49c10.jpg', '/uploads/thumb/5a46034a49c10.jpg', 1, 'jpg', 2515241, 0),
(39, 'Jeeves_Cinnabar_SP2005-0739 (1).JPG', '/uploads/5a46035113424.jpg', '/uploads/5a46035113424.jpg', '/uploads/large/5a46035113424.jpg', '/uploads/medium/5a46035113424.jpg', '/uploads/small/5a46035113424.jpg', '/uploads/thumb/5a46035113424.jpg', 1, 'jpg', 2818946, 0),
(40, 'font-awesome-4.7.0.zip', '/uploads/5a4603a301fe4.zip', '/uploads/5a4603a301fe4.zip', '/uploads/5a4603a301fe4.zip', '/uploads/5a4603a301fe4.zip', '/uploads/5a4603a301fe4.zip', '/uploads/5a4603a301fe4.zip', 6, 'zip', 669808, 0),
(41, 'gj-shop.zip', '/uploads/5a4603fadbf95.zip', '/uploads/5a4603fadbf95.zip', '/uploads/5a4603fadbf95.zip', '/uploads/5a4603fadbf95.zip', '/uploads/5a4603fadbf95.zip', '/uploads/5a4603fadbf95.zip', 6, 'zip', 4902, 0),
(42, 'Horace__Charcoal_SP1715-0725.JPG', '/uploads/5a4604010d363.jpg', '/uploads/5a4604010d363.jpg', '/uploads/large/5a4604010d363.jpg', '/uploads/medium/5a4604010d363.jpg', '/uploads/small/5a4604010d363.jpg', '/uploads/thumb/5a4604010d363.jpg', 1, 'jpg', 1744526, 0),
(43, 'Nigel_Cinnabar_SP1755-0719.JPG', '/uploads/5a460458d0830.jpg', '/uploads/full/5a460458d0830.jpg', '/uploads/large/5a460458d0830.jpg', '/uploads/medium/5a460458d0830.jpg', '/uploads/small/5a460458d0830.jpg', '/uploads/thumb/5a460458d0830.jpg', 1, 'jpg', 2858521, 0),
(44, 'Riffle_Sand_V948-9867.JPG', '/uploads/5a4604b67763a.jpg', '/uploads/5a4604b67763a.jpg', '/uploads/5a4604b67763a.jpg', '/uploads/medium/5a4604b67763a.jpg', '/uploads/small/5a4604b67763a.jpg', '/uploads/thumb/5a4604b67763a.jpg', 1, 'jpg', 959866, 0),
(45, 'Jeeves_Charcoal_SP2005-0735.JPG', '/uploads/5a46050d22ab7.jpg', '/uploads/full/5a46050d22ab7.jpg', '/uploads/large/5a46050d22ab7.jpg', '/uploads/medium/5a46050d22ab7.jpg', '/uploads/small/5a46050d22ab7.jpg', '/uploads/thumb/5a46050d22ab7.jpg', 1, 'jpg', 2515241, 0),
(46, 'Riffle_Celadon_V948-14.jpg', '/uploads/5a4605614e5e5.jpg', '/uploads/5a4605614e5e5.jpg', '/uploads/5a4605614e5e5.jpg', '/uploads/medium/5a4605614e5e5.jpg', '/uploads/small/5a4605614e5e5.jpg', '/uploads/thumb/5a4605614e5e5.jpg', 1, 'jpg', 968374, 0),
(47, 'Riffle_Olive_V948-9865.JPG', '/uploads/5a46056296065.jpg', '/uploads/5a46056296065.jpg', '/uploads/5a46056296065.jpg', '/uploads/medium/5a46056296065.jpg', '/uploads/small/5a46056296065.jpg', '/uploads/thumb/5a46056296065.jpg', 1, 'jpg', 1032790, 0),
(48, 'Riffle_Sand_V948-9867.JPG', '/uploads/5a460563dd3df.jpg', '/uploads/5a460563dd3df.jpg', '/uploads/5a460563dd3df.jpg', '/uploads/medium/5a460563dd3df.jpg', '/uploads/small/5a460563dd3df.jpg', '/uploads/thumb/5a460563dd3df.jpg', 1, 'jpg', 959866, 0),
(49, 'Nigel_Cinnabar_SP1755-0719.JPG', '/uploads/5a460644dd2b3.jpg', '/uploads/full/5a460644dd2b3.jpg', '/uploads/large/5a460644dd2b3.jpg', '/uploads/medium/5a460644dd2b3.jpg', '/uploads/small/5a460644dd2b3.jpg', '/uploads/thumb/5a460644dd2b3.jpg', 1, 'jpg', 2858521, 0),
(50, 'Nigel_Putty_SP1755-0721.JPG', '/uploads/5a46064c60d37.jpg', '/uploads/full/5a46064c60d37.jpg', '/uploads/large/5a46064c60d37.jpg', '/uploads/medium/5a46064c60d37.jpg', '/uploads/small/5a46064c60d37.jpg', '/uploads/thumb/5a46064c60d37.jpg', 1, 'jpg', 2594144, 0),
(51, 'Riffle_Olive_V948-9865.JPG', '/uploads/5a4606ca41396.jpg', '/uploads/5a4606ca41396.jpg', '/uploads/5a4606ca41396.jpg', '/uploads/medium/5a4606ca41396.jpg', '/uploads/small/5a4606ca41396.jpg', '/uploads/thumb/5a4606ca41396.jpg', 1, 'jpg', 1032790, 0),
(52, 'Riffle_Sand_V948-9867.JPG', '/uploads/5a4606cbad343.jpg', '/uploads/5a4606cbad343.jpg', '/uploads/5a4606cbad343.jpg', '/uploads/medium/5a4606cbad343.jpg', '/uploads/small/5a4606cbad343.jpg', '/uploads/thumb/5a4606cbad343.jpg', 1, 'jpg', 959866, 0),
(53, 'Riffle_Wheat_V948-9862.JPG', '/uploads/5a4606cd2aa8d.jpg', '/uploads/5a4606cd2aa8d.jpg', '/uploads/5a4606cd2aa8d.jpg', '/uploads/medium/5a4606cd2aa8d.jpg', '/uploads/small/5a4606cd2aa8d.jpg', '/uploads/thumb/5a4606cd2aa8d.jpg', 1, 'jpg', 851588, 0),
(54, 'Horace__Charcoal_SP1715-0725 (1).JPG', '/uploads/5a460731daa99.jpg', '/uploads/5a460731daa99.jpg', '/uploads/large/5a460731daa99.jpg', '/uploads/medium/5a460731daa99.jpg', '/uploads/small/5a460731daa99.jpg', '/uploads/thumb/5a460731daa99.jpg', 1, 'jpg', 1744526, 0),
(55, 'font-awesome-4.7.0.zip', '/uploads/5a4607437693c.zip', '/uploads/5a4607437693c.zip', '/uploads/5a4607437693c.zip', '/uploads/5a4607437693c.zip', '/uploads/5a4607437693c.zip', '/uploads/5a4607437693c.zip', 6, 'zip', 669808, 0),
(56, 'font-awesome-4.7.0.zip', '/uploads/5a46076c27581.zip', '/uploads/5a46076c27581.zip', '/uploads/5a46076c27581.zip', '/uploads/5a46076c27581.zip', '/uploads/5a46076c27581.zip', '/uploads/5a46076c27581.zip', 6, 'zip', 669808, 0),
(57, 'font-awesome-4.7.0.zip', '/uploads/5a4607bc524a9.zip', '/uploads/5a4607bc524a9.zip', '/uploads/5a4607bc524a9.zip', '/uploads/5a4607bc524a9.zip', '/uploads/5a4607bc524a9.zip', '/uploads/5a4607bc524a9.zip', 6, 'zip', 669808, 0),
(58, 'create.htm', '/uploads/5a4607c1e2dd0.htm', '/uploads/5a4607c1e2dd0.htm', '/uploads/5a4607c1e2dd0.htm', '/uploads/5a4607c1e2dd0.htm', '/uploads/5a4607c1e2dd0.htm', '/uploads/5a4607c1e2dd0.htm', 3, 'htm', 9821, 0),
(59, 'gj-shop.zip', '/uploads/5a4608409c216.zip', '/uploads/5a4608409c216.zip', '/uploads/5a4608409c216.zip', '/uploads/5a4608409c216.zip', '/uploads/5a4608409c216.zip', '/uploads/5a4608409c216.zip', 6, 'zip', 4902, 0),
(60, 'create.htm', '/uploads/5a460846b966b.htm', '/uploads/5a460846b966b.htm', '/uploads/5a460846b966b.htm', '/uploads/5a460846b966b.htm', '/uploads/5a460846b966b.htm', '/uploads/5a460846b966b.htm', 3, 'htm', 9821, 0),
(61, 'create.htm', '/uploads/5a46086dbb122.htm', '/uploads/5a46086dbb122.htm', '/uploads/5a46086dbb122.htm', '/uploads/5a46086dbb122.htm', '/uploads/5a46086dbb122.htm', '/uploads/5a46086dbb122.htm', 3, 'htm', 9821, 0),
(62, 'font-awesome-4.7.0.zip', '/uploads/5a46086e00fbe.zip', '/uploads/5a46086e00fbe.zip', '/uploads/5a46086e00fbe.zip', '/uploads/5a46086e00fbe.zip', '/uploads/5a46086e00fbe.zip', '/uploads/5a46086e00fbe.zip', 6, 'zip', 669808, 0),
(63, 'gj-shop.zip', '/uploads/5a46086e5a055.zip', '/uploads/5a46086e5a055.zip', '/uploads/5a46086e5a055.zip', '/uploads/5a46086e5a055.zip', '/uploads/5a46086e5a055.zip', '/uploads/5a46086e5a055.zip', 6, 'zip', 4902, 0),
(64, 'font-awesome-4.7.0.zip', '/uploads/5a4608b7f2b04.zip', '/uploads/5a4608b7f2b04.zip', '/uploads/5a4608b7f2b04.zip', '/uploads/5a4608b7f2b04.zip', '/uploads/5a4608b7f2b04.zip', '/uploads/5a4608b7f2b04.zip', 6, 'zip', 669808, 0),
(65, 'gj-shop.zip', '/uploads/5a4608b83114e.zip', '/uploads/5a4608b83114e.zip', '/uploads/5a4608b83114e.zip', '/uploads/5a4608b83114e.zip', '/uploads/5a4608b83114e.zip', '/uploads/5a4608b83114e.zip', 6, 'zip', 4902, 0),
(66, 'DripPress-1.0.zip', '/uploads/5a4608e52932a.zip', '/uploads/5a4608e52932a.zip', '/uploads/5a4608e52932a.zip', '/uploads/5a4608e52932a.zip', '/uploads/5a4608e52932a.zip', '/uploads/5a4608e52932a.zip', 6, 'zip', 12229, 0),
(67, 'font-awesome-4.7.0.zip', '/uploads/5a4608e55973b.zip', '/uploads/5a4608e55973b.zip', '/uploads/5a4608e55973b.zip', '/uploads/5a4608e55973b.zip', '/uploads/5a4608e55973b.zip', '/uploads/5a4608e55973b.zip', 6, 'zip', 669808, 0),
(68, 'gj-shop.zip', '/uploads/5a4608e57d2d6.zip', '/uploads/5a4608e57d2d6.zip', '/uploads/5a4608e57d2d6.zip', '/uploads/5a4608e57d2d6.zip', '/uploads/5a4608e57d2d6.zip', '/uploads/5a4608e57d2d6.zip', 6, 'zip', 4902, 0),
(69, 'aa.jpg', '/uploads/5a46090339baa.jpg', '/uploads/full/5a46090339baa.jpg', '/uploads/large/5a46090339baa.jpg', '/uploads/medium/5a46090339baa.jpg', '/uploads/small/5a46090339baa.jpg', '/uploads/thumb/5a46090339baa.jpg', 1, 'jpg', 3263061, 0),
(70, 'Horace__Charcoal_SP1715-0725 (1).JPG', '/uploads/5a460909d54f9.jpg', '/uploads/5a460909d54f9.jpg', '/uploads/large/5a460909d54f9.jpg', '/uploads/medium/5a460909d54f9.jpg', '/uploads/small/5a460909d54f9.jpg', '/uploads/thumb/5a460909d54f9.jpg', 1, 'jpg', 1744526, 0),
(71, 'Horace__Charcoal_SP1715-0725.JPG', '/uploads/5a46090d7a430.jpg', '/uploads/5a46090d7a430.jpg', '/uploads/large/5a46090d7a430.jpg', '/uploads/medium/5a46090d7a430.jpg', '/uploads/small/5a46090d7a430.jpg', '/uploads/thumb/5a46090d7a430.jpg', 1, 'jpg', 1744526, 0),
(72, 'Horace__Cinnabar_SP1715-0729 (1).JPG', '/uploads/5a460911356c9.jpg', '/uploads/5a460911356c9.jpg', '/uploads/large/5a460911356c9.jpg', '/uploads/medium/5a460911356c9.jpg', '/uploads/small/5a460911356c9.jpg', '/uploads/thumb/5a460911356c9.jpg', 1, 'jpg', 3015023, 0),
(73, 'Horace__Cinnabar_SP1715-0729.JPG', '/uploads/5a4609156aa00.jpg', '/uploads/5a4609156aa00.jpg', '/uploads/large/5a4609156aa00.jpg', '/uploads/medium/5a4609156aa00.jpg', '/uploads/small/5a4609156aa00.jpg', '/uploads/thumb/5a4609156aa00.jpg', 1, 'jpg', 3015023, 0),
(74, 'Horace_Putty_SP1715-0733.JPG', '/uploads/5a460919844f7.jpg', '/uploads/full/5a460919844f7.jpg', '/uploads/large/5a460919844f7.jpg', '/uploads/medium/5a460919844f7.jpg', '/uploads/small/5a460919844f7.jpg', '/uploads/thumb/5a460919844f7.jpg', 1, 'jpg', 3263061, 0),
(75, 'Jeeves_Charcoal_SP2005-0735 (1).JPG', '/uploads/5a46092007efb.jpg', '/uploads/full/5a46092007efb.jpg', '/uploads/large/5a46092007efb.jpg', '/uploads/medium/5a46092007efb.jpg', '/uploads/small/5a46092007efb.jpg', '/uploads/thumb/5a46092007efb.jpg', 1, 'jpg', 2515241, 0),
(76, 'Jeeves_Charcoal_SP2005-0735.JPG', '/uploads/5a4609265653b.jpg', '/uploads/full/5a4609265653b.jpg', '/uploads/large/5a4609265653b.jpg', '/uploads/medium/5a4609265653b.jpg', '/uploads/small/5a4609265653b.jpg', '/uploads/thumb/5a4609265653b.jpg', 1, 'jpg', 2515241, 0),
(77, 'Jeeves_Cinnabar_SP2005-0739 (1).JPG', '/uploads/5a46092d6822b.jpg', '/uploads/5a46092d6822b.jpg', '/uploads/large/5a46092d6822b.jpg', '/uploads/medium/5a46092d6822b.jpg', '/uploads/small/5a46092d6822b.jpg', '/uploads/thumb/5a46092d6822b.jpg', 1, 'jpg', 2818946, 0),
(78, 'Nigel_Putty_SP1755-0721.JPG', '/uploads/5a4609437126f.jpg', '/uploads/full/5a4609437126f.jpg', '/uploads/large/5a4609437126f.jpg', '/uploads/medium/5a4609437126f.jpg', '/uploads/small/5a4609437126f.jpg', '/uploads/thumb/5a4609437126f.jpg', 1, 'jpg', 2594144, 0),
(79, 'Riffle_Sand_V948-9867.JPG', '/uploads/5a460949b3f5b.jpg', '/uploads/5a460949b3f5b.jpg', '/uploads/5a460949b3f5b.jpg', '/uploads/medium/5a460949b3f5b.jpg', '/uploads/small/5a460949b3f5b.jpg', '/uploads/thumb/5a460949b3f5b.jpg', 1, 'jpg', 959866, 0),
(80, 'Riffle_Wheat_V948-9862.JPG', '/uploads/5a46094ae322e.jpg', '/uploads/5a46094ae322e.jpg', '/uploads/5a46094ae322e.jpg', '/uploads/medium/5a46094ae322e.jpg', '/uploads/small/5a46094ae322e.jpg', '/uploads/thumb/5a46094ae322e.jpg', 1, 'jpg', 851588, 0),
(81, 'Jeeves_Charcoal_SP2005-0735.JPG', '/uploads/5a4609912aebc.jpg', '/uploads/full/5a4609912aebc.jpg', '/uploads/large/5a4609912aebc.jpg', '/uploads/medium/5a4609912aebc.jpg', '/uploads/small/5a4609912aebc.jpg', '/uploads/thumb/5a4609912aebc.jpg', 1, 'jpg', 2515241, 0),
(82, 'Jeeves_Cinnabar_SP2005-0739 (1).JPG', '/uploads/5a46099764b35.jpg', '/uploads/5a46099764b35.jpg', '/uploads/large/5a46099764b35.jpg', '/uploads/medium/5a46099764b35.jpg', '/uploads/small/5a46099764b35.jpg', '/uploads/thumb/5a46099764b35.jpg', 1, 'jpg', 2818946, 0),
(83, 'Jeeves_Cinnabar_SP2005-0739.JPG', '/uploads/5a46099b63ca3.jpg', '/uploads/5a46099b63ca3.jpg', '/uploads/large/5a46099b63ca3.jpg', '/uploads/medium/5a46099b63ca3.jpg', '/uploads/small/5a46099b63ca3.jpg', '/uploads/thumb/5a46099b63ca3.jpg', 1, 'jpg', 2818946, 0),
(84, 'font-awesome-4.7.0.zip', '/uploads/5a4609bc95e4f.zip', '/uploads/5a4609bc95e4f.zip', '/uploads/5a4609bc95e4f.zip', '/uploads/5a4609bc95e4f.zip', '/uploads/5a4609bc95e4f.zip', '/uploads/5a4609bc95e4f.zip', 6, 'zip', 669808, 0);

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
(1, 'image', 'fa fa-file-image-o', '/png/jpg/jpeg/gif/'),
(2, 'folder', 'fa fa-folder-o', ''),
(3, 'file', 'fa fa-file', ''),
(4, 'audio', 'fa fa-file-audio-o', '/mp3/m4a/3gp/wav/raw/'),
(5, 'video', 'fa fa-file-movie-o', '/flv/mp4/amv/3gp'),
(6, 'zip', 'fa fa-file-zip-o', '/zip/rar/gzip/'),
(7, 'doc', 'fa fa-file-word-o', '/doc/pdf/xlsx/xlsm/xlsm/xltx/xltm/xls/xlt/docm/docx/docx'),
(8, 'text', 'fa fa-file-text-o', '/xml/html/txt/js/css/');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ewd_blocks`
--
ALTER TABLE `ewd_blocks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ewd_fonts`
--
ALTER TABLE `ewd_fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ewd_medias`
--
ALTER TABLE `ewd_medias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `ewd_media_type`
--
ALTER TABLE `ewd_media_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
