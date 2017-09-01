-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2017 at 06:18 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_coinmk`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2016-07-29 10:51:20',
  `updated_at` timestamp NOT NULL DEFAULT '2016-07-29 10:51:20',
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `type` int(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `created_at`, `updated_at`, `key`, `code`, `description`, `value`, `type`, `status`) VALUES
(504, '2016-07-29 09:57:54', '2016-08-08 15:44:12', 'BANNER', 'BANNER', 'Ảnh banner', '4e086102b245a22064ee4e8e00a0d12f.jpg', 3, 0),
(505, '2016-07-29 09:58:07', '2017-02-23 14:42:53', 'LOGO', 'LOGO', 'Ảnh logo', '9d0002915a5306cdce6b4a439fc44530.png', 3, 0),
(509, '2016-07-29 10:51:20', '2016-07-29 10:51:20', 'ISUPDATEBTCRATE', 'ISUPDATEBTCRATE', 'Configure for enable update BTC rate from blockchain', 'true', 1, 0),
(510, '2016-07-29 10:51:20', '2017-03-04 06:13:16', 'PERCENTEXCHANGE', 'PERCENTEXCHANGE', 'Cấu hình hệ số phí (C)', '0.01', 1, 1),
(511, '2016-07-29 10:51:20', '2017-03-04 06:13:41', 'BITGO', 'BITGO', 'Bitgo address', '32foxBKABXMRUeKW6rrXmPw488JhY6yYeP', 1, 0),
(512, '2016-07-29 10:51:20', '2017-03-04 06:17:08', 'BITGOAUTHENTICATION', 'BITGOAUTHENTICATION', 'Bitgo authentication code', 'v2xe39d44666f487d7e360ffd73fb1845e59b404c855ee91ac452494ae20f8db55c', 1, 0),
(517, '2016-07-29 10:51:20', '2017-03-04 06:13:56', 'BITGOLOCALWALLETPASSPHRASE', 'BITGOLOCALWALLETPASSPHRASE', 'K0nv1ctmus1c', 'Phonghong1416@', 0, 0),
(525, '2016-07-29 10:51:20', '2017-03-04 14:13:56', 'SECRETKEYOTP', 'SECRETKEYOTP', 'Secret key OTP Bitgo', 'UEYX2MWHN346BJHTS6UDWEUIUZGSRJFZN54AKPQ3N6TPP7YB35NA', 1, 0),
(528, '2016-07-29 10:51:20', '2017-03-06 20:46:02', 'BTCUSD', 'BTCUSD', 'Btc to usd', '1273', 1, 1),
(530, '2016-07-29 10:51:20', '2017-03-06 16:03:11', 'REFERER', 'REFERER', 'Hoa hồng giới thiệu', '0.01', 1, 0),
(533, '2016-07-29 10:51:20', '2017-03-03 07:44:27', 'PRESENTRATESELL', 'PRESENTRATESELL', 'Cấu hình hệ số giá bán (A)', '22800', 1, 0),
(534, '2016-07-29 10:51:20', '2017-03-03 07:44:27', 'PRESENTRATEBUY', 'PRESENTRATEBUY', 'Cấu hình hệ số giá mua (B)', '22600', 1, 0),
(535, '2016-07-29 10:51:20', '2017-04-20 14:27:02', 'MEMBERCOUNT', 'MEMBERCOUNT', 'Số lượng thành viên', '161', 1, 1),
(536, '2016-07-29 10:51:20', '2016-07-29 10:51:20', 'ROMANCOIN', 'ROMANCOIN', 'Cấu hình tỷ lệ Romancoin = BTC', '1000', 1, 0),
(537, '2016-07-29 10:51:20', '2016-07-29 10:51:20', 'DEBUG_DEV', 'DEBUG_DEV', 'hệ thống Test', '1', 1, 1),
(538, '2016-07-29 10:51:20', '2016-07-29 10:51:20', 'W_SBID', 'W_SBID', '', '1', 1, 1),
(539, '2016-07-29 10:51:20', '2016-07-29 10:51:20', 'W_SBPAS', 'W_SBPAS', '', '1', 1, 1),
(540, '2016-07-29 10:51:20', '2016-07-29 10:51:20', 'VOLUMESYS', 'VOLUMESYS', 'VOLUMESYS', '950', 1, 1),
(541, '2016-07-29 10:51:20', '2016-07-29 10:51:20', 'BET_COST_KEY', 'BET_COST_KEY', 'ty le betting volume %', '60', 1, 1),
(542, '2016-07-29 10:51:20', '2016-07-29 10:51:20', 'BET_RATE_WIN', 'BET_RATE_WIN', '', '0.5', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2016-07-29 10:51:20'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2016-07-29 10:51:20',
  `updated_at` timestamp NOT NULL DEFAULT '2016-07-29 10:51:20'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'free-btc-manager', 'free-btc-manager', 'free-btc-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(2, 'approve-btc-manager', 'approve-btc-manager', 'approve-btc-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(3, 'token-manager', 'token-manager', 'token-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(4, 'user-manager', 'user-manager', 'user-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(5, 'config-manager', 'config-manager', 'config-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(6, 'log-manager', 'log-manager', 'log-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(7, 'donate-manager', 'donate-manager', 'donate-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(8, 'faq-manager', 'faq-manager', 'faq-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(9, 'role-manager', 'role-manager', 'role-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(10, 'transaction-manager', 'transaction-manager', 'transaction-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(11, 'ads-manager', 'ads-manager', 'ads-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(12, 'deposit-manager', 'deposit-manager', 'deposit-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(13, 'order-manager', 'order-manager', 'order-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(14, 'report-manager', 'report-manager', 'report-manager', '2016-07-29 10:51:20', '2016-07-29 10:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2016-07-29 10:51:20',
  `updated_at` timestamp NOT NULL DEFAULT '2016-07-29 10:51:20'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(2, 'user', 'user', 'user', '2016-07-29 10:51:20', '2016-07-29 10:51:20'),
(3, 'leader', 'leader', 'leader', '2016-07-29 10:51:20', '2016-07-29 10:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sestockinfo`
--

CREATE TABLE `sestockinfo` (
  `id` int(11) NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `coinname` varchar(100) NOT NULL,
  `algorithm` varchar(100) DEFAULT NULL,
  `imageUrl` text NOT NULL,
  `sortOrder` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `grpdowncoin` int(11) NOT NULL DEFAULT '0',
  `grpupcoin` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0: type auto - 1: type manual',
  `api` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sestockprice`
--

CREATE TABLE `sestockprice` (
  `id` int(11) NOT NULL,
  `codeid` int(11) NOT NULL COMMENT 'id - sestockinfo',
  `symbol` varchar(100) NOT NULL,
  `vwapDataBTC` double DEFAULT '0',
  `vwapData` double DEFAULT '0',
  `cap24hrChange` double DEFAULT '0',
  `perc` double NOT NULL DEFAULT '0',
  `supply` double NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `volume` double DEFAULT '0',
  `mktcap` double NOT NULL DEFAULT '0',
  `cap24hrChangePercent` float NOT NULL DEFAULT '0',
  `capPercent` float NOT NULL DEFAULT '0',
  `txdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published` int(11) NOT NULL DEFAULT '0',
  `sortOrder` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sestockprice`
--

INSERT INTO `sestockprice` (`id`, `codeid`, `symbol`, `vwapDataBTC`, `vwapData`, `cap24hrChange`, `perc`, `supply`, `price`, `volume`, `mktcap`, `cap24hrChangePercent`, `capPercent`, `txdate`, `updated_at`, `published`, `sortOrder`, `status`) VALUES
(1, 1, 'ETH', 0, 0, -21.79, 0, 92777133.7803, 303.31, 480611.354986, 28140232446.903, -21.79, -6.70255, '2017-06-24 00:39:44', '2017-06-25 19:39:31', 1, 2, 0),
(2, 2, 'BTC', 0, 0, -74.67, 0, 16410412, 2654.96, 102054.28653108, 43568987443.52, -74.67, -2.73554, '2017-06-24 00:39:44', '2017-06-25 19:39:32', 1, 1, 0),
(3, 3, 'LTC', 0, 0, -1.4, 0, 51707132.371887, 43.84, 878920.09882481, 2266840683.1835, -1.4, -3.09461, '2017-06-24 00:39:44', '2017-06-25 19:39:33', 1, 4, 0),
(4, 4, 'XRP', 0, 0, -0.0085, 0, 0, 0.2787, 69066248.490352, 0, -0.0085, -2.95961, '2017-06-24 00:39:44', '2017-06-25 19:38:12', 0, 3, 0),
(5, 5, 'ETC', 0, 0, 1.27, 0, 92938922, 20.48, 643104.27741687, 1903389122.56, 1.27, 6.61114, '2017-06-24 00:39:45', '2017-06-25 19:39:34', 0, 5, 0),
(6, 6, 'ZEC', 0, 0, -23.29, 0, 1600481.25, 346.78, 8088.53660383, 555014887.875, -23.29, -6.2934, '2017-06-24 00:39:45', '2017-06-25 19:39:35', 1, 12, 0),
(7, 7, 'DASH', 0, 0, -4.26, 0, 7385345.1513255, 179.18, 11936.04692557, 1323306144.2145, -4.26, -2.32229, '2017-06-24 00:39:45', '2017-06-25 19:39:35', 1, 7, 0),
(8, 8, 'XMR', 0, 0, -2.31, 0, 14682945.595316, 47.41, 34381.39055064, 696118450.67395, -2.31, -4.64602, '2017-06-24 00:39:45', '2017-06-25 19:39:36', 0, 11, 0),
(9, 9, 'NVC', 0, 0, -0.2, 0, 1759411, 11.33, 139511.38754232, 19934126.63, -0.2, -1.73461, '2017-06-24 00:39:45', '2017-06-25 19:39:37', 1, 17, 0),
(10, 10, 'IOT', 0, 0, -0.014, 0, 0, 0.515, 3691171.4272474, 0, -0.014, -2.6465, '2017-06-24 00:39:45', '2017-06-25 19:39:37', 1, 20, 0),
(11, 11, 'PPC', 0, 0, -0.02, 0, 24170356.960991, 3.16, 837933.4100246, 76378327.996733, -0.02, -0.628931, '2017-06-24 00:39:45', '2017-06-25 19:39:38', 1, 48, 0),
(12, 12, 'XLM', 0, 0, -0.0024, 0, 9748543451, 0.03661, 19303018.138296, 356894175.74111, -0.0024, -6.15227, '2017-06-24 00:39:45', '2017-06-25 19:35:35', 0, 19, 0),
(13, 13, 'NXT', 0, 0, 0.0013, 0, 0, 0.1815, 3342730.881142, 0, 0.0013, 0.721421, '2017-06-24 00:39:45', '2017-06-25 19:30:10', 0, 39, 0),
(14, 14, 'NMC', 0, 0, -0.1, 0, 14736400, 3.4, 727277.35679932, 50103760, -0.1, -2.85714, '2017-06-24 00:39:45', '2017-06-25 19:39:40', 1, 66, 0),
(15, 15, 'MAID', 0, 0, -0.0246, 0, 452552412, 0.5164, 219422, 233698065.5568, -0.0246, -4.54713, '2017-06-24 00:39:45', '2017-06-25 19:39:40', 1, 30, 0),
(16, 16, 'REP', 0, 0, -1.26, 0, 11000000, 29.22, 7515.25160784, 321420000, -1.26, -4.13386, '2017-06-24 00:39:45', '2017-06-25 19:30:53', 0, 21, 0),
(17, 17, 'XEM', 0, 0, -0.0065, 0, 8999999999, 0.1822, 228362, 1639799999.8178, -0.0065, -3.44462, '2017-06-24 00:39:45', '2017-06-25 19:39:01', 0, 6, 0),
(18, 18, 'BCN', 0, 0, -0.000096, 0, 183059050419.81, 0.00177, 73359570, 324014519.24306, -0.000096, -5.14469, '2017-06-24 00:39:45', '2017-06-25 19:37:01', 0, 16, 0),
(19, 19, 'RRT', 0, 0, -0.00485, 0, 0, 0.0775, 229346.03079004, 0, -0.00485, -5.8895, '2017-06-24 00:39:45', '2017-06-25 19:32:18', 0, 23, 0),
(20, 20, 'CVC', 0, 0, 0.16, 0, 0, 1.41, 23452.41, 0, 0.16, 12.8, '2017-06-24 00:39:45', '2017-06-25 18:24:05', 0, 25, 0),
(21, 21, 'XDN', 0, 0, -0.000177, 0, 6882769110, 0.003542, 5309030, 24378768.18762, -0.000177, -4.75934, '2017-06-24 00:39:45', '2017-06-25 19:39:44', 0, 99, 0),
(22, 22, 'GNO', 0, 0, -9.7974011, 0, 10000000, 220.6652598, 288.74057764, 2206652598, -9.7974, -4.25119, '2017-06-24 00:39:46', '2017-06-25 19:39:45', 1, 29, 0),
(23, 23, 'DOGE', 0, 0, 0.000026, 0, 109952038478.54, 0.003099, 6308052.6244634, 340741367.24501, 0.000026, 0.846079, '2017-06-24 00:39:46', '2017-06-25 19:39:05', 0, 24, 0),
(24, 24, 'LSK', 0, 0, 0.04, 0, 108764785, 3.39, 3965.41070978, 368712621.15, 0.04, 1.19403, '2017-06-24 00:39:46', '2017-06-25 19:01:27', 0, 22, 0),
(25, 25, 'GRC', 0, 0, -0.00322179, 0, 390312753, 0.08292533, 1252.72782821, 32366813.845733, -0.00322179, -3.73987, '2017-06-24 00:39:46', '2017-06-25 19:39:47', 1, 83, 0),
(26, 26, 'EMC', 0, 0, -0.19501316, 0, 40302970, 1.71026858, 4524.81875466, 68928903.271683, -0.195013, -10.2354, '2017-06-24 00:39:46', '2017-06-25 19:39:47', 1, 47, 0),
(27, 27, 'OBITS', 0, 0, 0.13167452, 0, 0, 1.79810753, 99.37680136, 0, 0.131675, 7.90158, '2017-06-24 00:39:46', '2017-06-25 19:39:48', 1, 80, 0),
(28, 29, 'EDR', 0, 0, -0.00014084, 0, 886211988, 0.02480789, 52645.21604, 21985049.514985, -0.00014084, -0.564518, '2017-06-24 00:39:46', '2017-06-25 19:39:49', 1, 26, 0),
(29, 32, 'LEO', 0, 0, -0.0227871, 0, 85557322, 0.52613948, 4607.0636479, 45015084.907273, -0.0227871, -4.15121, '2017-06-24 00:39:46', '2017-06-25 19:39:49', 1, 65, 0),
(30, 34, 'XBY', 0, 0, -0.00070219, 0, 0, 0.01870541, 1326.63593667, 0, -0.00070219, -3.61812, '2017-06-24 00:39:46', '2017-06-25 19:39:50', 1, 33, 0),
(31, 37, 'XVG', 0, 0, -0.00031612, 0, 12793464160, 0.00339616, 1175.44179838, 43448651.241626, -0.00031612, -8.51552, '2017-06-24 00:39:46', '2017-06-25 19:39:51', 1, 64, 0),
(32, 38, 'YOC', 0, 0, 0.00010037, 0, 105618830, 0.00599635, 13680.41105, 633327.4712705, 0.00010037, 1.70235, '2017-06-24 00:39:46', '2017-06-25 19:39:51', 1, 15, 0),
(33, 40, 'BURST', 0, 0, -0.0017572, 0, 1795415948, 0.02027083, 13685.83175738, 36394571.461197, -0.0017572, -7.97711, '2017-06-24 00:39:46', '2017-06-25 19:39:52', 1, 69, 0),
(34, 42, 'MCAP', 0, 0, -0.65858945, 0, 16016674, 4.00906075, 19.08435099, 64211819.078945, -0.658589, -14.1097, '2017-06-24 00:39:46', '2017-06-25 19:39:53', 1, 50, 0),
(35, 54, 'ZNY', 0, 0, 0.00050773, 0, 75614500, 0.00132662, 213.33333333, 100311.70799, 0.00050773, 62.0022, '2017-06-24 00:39:46', '2017-06-25 19:39:53', 1, 13, 0),
(36, 56, 'ZCL', 0, 0, -0.23484313, 0, 0, 3.03797125, 0, 0, -0.234843, -7.17557, '2017-06-24 00:39:46', '2017-06-25 19:39:54', 1, 14, 0),
(37, 58, 'XZC', 0, 0, -0.6657008, 0, 2017641.5802476, 14.592875, 0, 29443191.375355, -0.665701, -4.3628, '2017-06-24 00:39:46', '2017-06-25 19:39:55', 1, 68, 0),
(38, 74, 'XAUR', 0, 0, 0.0111756, 0, 126289330.04891, 0.26797825, 0, 33842793.660179, 0.0111756, 4.35182, '2017-06-24 00:39:46', '2017-06-25 19:39:55', 1, 78, 0),
(39, 97, 'TKN', 0, 0, -0.16938638, 0, 39406759.92832, 1.05785077, 0, 41686471.333379, -0.169386, -13.8023, '2017-06-24 00:39:46', '2017-06-25 19:39:56', 1, 90, 0),
(40, 101, 'TAAS', 0, 0, 0.12836432, 0, 0, 2.738154, 929.50462435, 0, 0.128364, 4.91857, '2017-06-24 00:39:46', '2017-06-25 19:39:57', 1, 32, 0),
(41, 104, 'STRAT', 0, 0, -0.72408156, 0, 98438173.35557, 7.6913369, 1.58763, 757121155.09829, -0.724082, -8.60423, '2017-06-24 00:39:46', '2017-06-25 19:39:58', 1, 10, 0),
(42, 120, 'RDD', 0, 0, -0.00014081, 0, 28545288139, 0.00204289, 0, 58314883.686282, -0.00014081, -6.44823, '2017-06-24 00:39:46', '2017-06-25 19:39:58', 1, 58, 0),
(43, 135, 'PIVX', 0, 0, -0.09086007, 0, 53707000, 1.91049731, 3, 102607079.02817, -0.0908601, -4.53992, '2017-06-24 00:39:46', '2017-06-25 19:39:59', 1, 45, 0),
(44, 140, 'OMNI', 0, 0, -3.357844, 0, 0, 82.352224, 0, 0, -3.35784, -3.91768, '2017-06-24 00:39:46', '2017-06-25 19:39:59', 1, 75, 0),
(45, 152, 'NAV', 0, 0, -0.02105175, 0, 61418159.447135, 0.47437428, 0, 29135195.16666, -0.0210517, -4.24922, '2017-06-24 00:39:47', '2017-06-25 19:40:00', 1, 88, 0),
(46, 210, 'FST', 0, 0, -0.00130431, 0, 0, 0.00925932, 7177.16315, 0, -0.00130431, -12.3472, '2017-06-24 00:39:47', '2017-06-25 19:40:01', 1, 27, 0),
(47, 223, 'DROP', 0, 0, 0, 0, 0, 0.717999, 0, 0, 0, 0, '2017-06-24 00:39:47', '2017-06-24 00:41:48', 0, 18, 0),
(48, 231, 'DGD', 0, 0, -2.60168, 0, 1994946.7568, 90.2054, 0, 179954970.17585, -2.60168, -2.80332, '2017-06-24 00:39:47', '2017-06-25 19:40:02', 1, 36, 0),
(49, 232, 'DGB', 0, 0, -0.00214812, 0, 8688460433, 0.02621263, 0, 227747398.59987, -0.00214812, -7.57427, '2017-06-24 00:39:47', '2017-06-25 19:40:03', 1, 28, 0),
(50, 246, 'CLOAK', 0, 0, -0.46303524, 0, 4601059.886795, 7.1580638, 3.70015, 32934680.217299, -0.463035, -6.0757, '2017-06-24 00:39:47', '2017-06-25 19:40:04', 1, 77, 0),
(51, 256, 'BTS', 0, 0, -0.02789447, 0, 0, 0.28573887, 0, 0, -0.0278945, -8.89397, '2017-06-24 00:39:47', '2017-06-25 19:40:04', 1, 9, 0),
(52, 264, 'BLK', 0, 0, 0.02325514, 0, 76213361.396022, 0.54706922, 0, 41693984.1725, 0.0232551, 4.43958, '2017-06-24 00:39:47', '2017-06-25 19:40:05', 1, 73, 0),
(53, 269, 'BAY', 0, 0, -0.00801673, 0, 1007567722.1864, 0.04324553, 0, 43572800.156844, -0.00801673, -15.6387, '2017-06-24 00:39:47', '2017-06-25 19:40:06', 1, 71, 0),
(54, 270, 'BASH', 0, 0, -0.00843665, 0, 0, 0.03982303, 0, 0, -0.00843665, -17.4818, '2017-06-24 00:39:47', '2017-06-25 19:40:07', 1, 76, 0),
(55, 276, 'AMP', 0, 0, -0.06003659, 0, 82256324, 0.60025849, 0, 49375056.837191, -0.0600366, -9.09239, '2017-06-24 00:39:47', '2017-06-25 19:40:07', 1, 61, 0),
(56, 278, 'ADZ', 0, 0, -0.0016467, 0, 54935240, 0.03503939, 2722.09042, 1924897.2991036, -0.0016467, -4.48862, '2017-06-24 00:39:47', '2017-06-25 19:40:08', 1, 31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_info`
--

CREATE TABLE `stock_info` (
  `id` int(11) NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `coinname` varchar(100) NOT NULL,
  `algorithm` varchar(100) DEFAULT NULL,
  `imageUrl` text NOT NULL,
  `sortOrder` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_info`
--

INSERT INTO `stock_info` (`id`, `symbol`, `coinname`, `algorithm`, `imageUrl`, `sortOrder`, `status`, `type`, `updated_at`) VALUES
(1, 'ETH', 'Ethereum ', 'Ethash', '/media/coin/eth.png', 2, 1, 0, '2017-06-26 01:42:16'),
(2, 'BTC', 'Bitcoin', 'SHA256', '/media/coin/btc.png', 1, 1, 0, '2017-06-26 01:42:32'),
(3, 'LTC', 'Litecoin', 'Scrypt', '/media/coin/ltc.png', 4, 1, 0, '2017-06-26 01:42:16'),
(4, 'XRP', 'Ripple', 'N/A', '/media/coin/xrp.png', 3, 1, 0, '2017-06-26 01:42:16'),
(5, 'ETC', 'Ethereum Classic', 'Ethash', '/media/coin/etc.png', 5, 1, 0, '2017-06-26 01:42:16'),
(6, 'ZEC', 'ZCash', 'Equihash', '/media/coin/zec.png', 12, 1, 0, '2017-06-26 01:42:16'),
(7, 'DASH', 'DigitalCash', 'X11', '/media/coin/dash.png', 7, 1, 0, '2017-06-26 01:42:16'),
(8, 'XMR', 'Monero', 'CryptoNight', '/media/coin/xmr.png', 11, 1, 0, '2017-06-26 01:42:16'),
(9, 'NVC', 'NovaCoin', 'Scrypt', '/media/coin/nvc.png', 17, 1, 0, '2017-06-26 01:42:16'),
(10, 'IOT', 'IOTA', 'N/A', '/media/coin/iot.png', 20, 1, 0, '2017-06-26 01:42:16'),
(11, 'PPC', 'PeerCoin', 'N/A', '/media/coin/ppc.png', 48, 1, 0, '2017-06-26 01:42:16'),
(12, 'XLM', 'Stellar', 'N/A', '/media/coin/xlm.png', 19, 1, 0, '2017-06-26 01:42:16'),
(13, 'NXT', 'Nxt', 'PoS', '/media/coin/nxt.png', 39, 1, 0, '2017-06-26 01:42:16'),
(14, 'NMC', 'NameCoin', 'SHA256', '/media/coin/nmc.png', 66, 1, 0, '2017-06-26 01:42:16'),
(15, 'MAID', 'MaidSafe Coin', 'N/A', '/media/coin/maid.png', 30, 1, 0, '2017-06-26 01:42:16'),
(16, 'REP', 'Augur', 'N/A', '/media/coin/rep.png', 21, 1, 0, '2017-06-26 01:42:16'),
(17, 'XEM', 'NEM', 'N/A', '/media/coin/xem.png', 6, 1, 0, '2017-06-26 01:42:16'),
(18, 'BCN', 'ByteCoin', 'CryptoNight', '/media/coin/bcn.png', 16, 1, 0, '2017-06-26 01:42:16'),
(19, 'RRT', 'Recovery Right Tokens', 'N/A', '/media/coin/rrt.png', 23, 1, 0, '2017-06-26 01:42:16'),
(20, 'CVC', 'Civic', 'N/A', '/media/coin/cvc.png', 25, 1, 0, '2017-06-26 01:42:16'),
(21, 'XDN', 'DigitalNote ', 'CryptoNight', '/media/coin/xdn.png', 99, 1, 0, '2017-06-26 01:42:16'),
(22, 'GNO', 'Gnosis', 'N/A', '/media/coin/gno.png', 29, 1, 0, '2017-06-26 01:42:16'),
(23, 'DOGE', 'Dogecoin', 'Scrypt', '/media/coin/doge.png', 24, 1, 0, '2017-06-26 01:42:16'),
(24, 'LSK', 'Lisk', 'DPoS', '/media/coin/lsk.png', 22, 1, 0, '2017-06-26 01:42:16'),
(25, 'GRC', 'GridCoin', 'Scrypt', '/media/coin/grc.png', 83, 1, 0, '2017-06-26 01:42:16'),
(26, 'EMC', 'Emercoin', 'SHA256', '/media/coin/emc.png', 47, 1, 0, '2017-06-26 01:42:16'),
(27, 'OBITS', 'Obits Coin', 'N/A', '/media/coin/obits.png', 80, 1, 0, '2017-06-26 01:42:16'),
(29, 'EDR', 'E-Dinar Coin', 'X11', '/media/coin/edr.png', 26, 1, 0, '2017-06-26 01:42:16'),
(32, 'LEO', 'LEOcoin', 'Scrypt', '/media/coin/leo.png', 65, 1, 0, '2017-06-26 01:42:16'),
(34, 'XBY', 'XtraBYtes', 'N/A', '/media/coin/xby.png', 33, 1, 0, '2017-06-26 01:42:16'),
(37, 'XVG', 'Verge', 'Multiple', '/media/coin/xvg.png', 64, 1, 0, '2017-06-26 01:42:16'),
(38, 'YOC', 'YoCoin', 'Scrypt', '/media/coin/yoc.png', 15, 1, 0, '2017-06-26 01:42:16'),
(40, 'BURST', 'BurstCoin', 'Shabal256', '/media/coin/burst.png', 69, 1, 0, '2017-06-26 01:42:16'),
(42, 'MCAP', 'MCAP', 'N/A', '/media/coin/mcap.png', 50, 1, 0, '2017-06-26 01:42:16'),
(54, 'ZNY', 'BitZeny', 'Scrypt', '/media/coin/zny.png', 13, 1, 0, '2017-06-26 01:42:16'),
(56, 'ZCL', 'ZClassic', 'Equihash', '/media/coin/zcl.png', 14, 1, 0, '2017-06-26 01:42:16'),
(58, 'XZC', 'ZCoin', 'Lyra2RE', '/media/coin/xzc.png', 68, 1, 0, '2017-06-26 01:42:16'),
(74, 'XAUR', 'Xaurum', 'N/A', '/media/coin/xaur.png', 78, 1, 0, '2017-06-26 01:42:16'),
(97, 'TKN', 'TokenCard  ', 'N/A', '/media/coin/tkn.png', 90, 1, 0, '2017-06-26 01:42:16'),
(101, 'TAAS', 'Token as a Service', 'N/A', '/media/coin/taas.png', 32, 1, 0, '2017-06-26 01:42:16'),
(104, 'STRAT', 'Stratis', 'X13', '/media/coin/strat.png', 10, 1, 0, '2017-06-26 01:42:16'),
(120, 'RDD', 'ReddCoin', 'Scrypt', '/media/coin/rdd.png', 58, 1, 0, '2017-06-26 01:42:16'),
(135, 'PIVX', 'Private Instant Verified Transaction', 'Quark', '/media/coin/pivx.png', 45, 1, 0, '2017-06-26 01:42:16'),
(140, 'OMNI', 'Omni', 'Scrypt', '/media/coin/omni.png', 75, 1, 0, '2017-06-26 01:42:16'),
(152, 'NAV', 'NavCoin', 'X13', '/media/coin/nav.png', 88, 1, 0, '2017-06-26 01:42:16'),
(210, 'FST', 'FastCoin', 'Scrypt', '/media/coin/fst.png', 27, 1, 0, '2017-06-26 01:42:16'),
(223, 'DROP', 'FaucetCoin', 'X13', '/media/coin/drop.png', 18, 1, 0, '2017-06-26 01:42:16'),
(231, 'DGD', 'Digix DAO', 'N/A', '/media/coin/dgd.png', 36, 1, 0, '2017-06-26 01:42:16'),
(232, 'DGB', 'DigiByte', 'Multiple', '/media/coin/dgb.png', 28, 1, 0, '2017-06-26 01:42:16'),
(246, 'CLOAK', 'CloakCoin', 'X13', '/media/coin/cloak.png', 77, 1, 0, '2017-06-26 01:42:16'),
(256, 'BTS', 'Bitshares', 'SHA-512', '/media/coin/bts.png', 9, 1, 0, '2017-06-26 01:42:16'),
(264, 'BLK', 'BlackCoin', 'Scrypt', '/media/coin/blk.png', 73, 1, 0, '2017-06-26 01:42:16'),
(269, 'BAY', 'BitBay', 'N/A', '/media/coin/bay.png', 71, 1, 0, '2017-06-26 01:42:16'),
(270, 'BASH', 'LuckChain', 'Scrypt', '/media/coin/bash.png', 76, 1, 0, '2017-06-26 01:42:16'),
(276, 'AMP', 'Synereo', 'N/A', '/media/coin/amp.png', 61, 1, 0, '2017-06-26 01:42:16'),
(278, 'ADZ', 'Adzcoin', 'X11', '/media/coin/adz.png', 31, 1, 0, '2017-06-26 01:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `referer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `backside` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fontside` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trader_wallet` decimal(15,8) DEFAULT '0.00000000',
  `amount_wallet` decimal(15,8) DEFAULT '0.00000000',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneCountry` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'VN',
  `dialcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '+84',
  `blockchain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `peopleid` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '2016-07-29 10:51:20',
  `level_buy` int(255) DEFAULT '0' COMMENT '0',
  `level_sell` int(255) DEFAULT '0',
  `total_buy` int(11) DEFAULT '0',
  `total_sell` int(11) DEFAULT '0',
  `bitgo_receive_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `auth_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_secret` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google2fa_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enable_otp` tinyint(4) DEFAULT '0',
  `wait_disable` tinyint(4) DEFAULT '0',
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `locale` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `path_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_firsttime` int(11) DEFAULT '1',
  `romancoin_wallet` decimal(15,8) DEFAULT NULL,
  `point` int(11) NOT NULL,
  `user_point` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sponsor_id`, `name`, `username`, `phone`, `email`, `password`, `remember_token`, `referer`, `backside`, `fontside`, `trader_wallet`, `amount_wallet`, `address`, `gender`, `country`, `phoneCountry`, `dialcode`, `blockchain`, `peopleid`, `birthday`, `avatar`, `status`, `created_at`, `updated_at`, `level_buy`, `level_sell`, `total_buy`, `total_sell`, `bitgo_receive_address`, `active`, `auth_code`, `api_key`, `api_secret`, `google2fa_secret`, `enable_otp`, `wait_disable`, `bank_name`, `bank_no`, `bank_id`, `locale`, `last_login`, `path_id`, `is_firsttime`, `romancoin_wallet`, `point`, `user_point`, `level`) VALUES
(1, 0, 'admin', 'admin', '0914465982', 'ctrl.zudo@gmail.com', '$2y$10$dKdOCiCvue4YKFprcgSNxOCjO.ik7If/9leMIx0A5/Nz2aVfXjO/S', 'P97tUtL41DpC3dQ981iR3iQcjR0fBsfKRu4HPQoxRDKqri5ubMTFg9QAvhwT', 'veesQl15F3UA7tsww45u', '', NULL, NULL, '4.00000000', '123123', 0, 'vn', 'VN', '', '2N7m9TnWvAvEd6gkhJdDt4h6uxGpJhH4KZ8', '', '0000-00-00', NULL, 2, '2016-12-06 06:07:07', '2017-05-27 01:25:14', 1, 1, 5, 41, '2N2JwYBz92v3Ri86pMDe1FpGeGNHk48iATk', 1, 'AQBTU7HygqIWL0s0Yyhe0k2Ar', 'L66XHXSsH7EJuVTTidAwQlaJk8C6vYqI', '1QutVDuptyL5Kc-T8GrzGyPxPYjCuqH8c56-WAlu5WBsJLAge7vMEH5hnvBFq9He', 'SHK7BCCCCZUEFN3C', 0, 0, 'Nguyen Minh Tan', '98787889', 1, 'vn', '2017-04-08 00:18:15', NULL, 0, '1000.00000000', 1, '13644', 2),
(13644, 1, '', 'tannm', NULL, 'dinhthaovp@gmail.com', '', 'LSg4R1KwqTFtW6tQjBO1U93C6BrZAXeCTG9oexRxAwbkyiAyi9MJEWPiVSOW', '', '', NULL, NULL, '10.00000000', '', 0, NULL, 'VN', '', '1F7fc8964PFqb7WV8S67vrZJJn7qCYH1Yy', NULL, NULL, NULL, 0, '2017-03-06 16:37:34', '2017-04-06 15:50:22', 0, 0, 0, 2, '2Mvs44V3PyWkTmNaFt5eqr8jHa83PvJATdF', 1, '38Vr4pfkMfmHMoD292TivVuZV', 'adCsazaSdxXnv6yOvV6TyYiDs7VmBDpM', NULL, '', 0, 0, NULL, NULL, NULL, 'vn', '2017-03-08 15:29:37', NULL, 0, NULL, 1, '13645', 1),
(13645, 13644, '', 'tannm2', '', 'admin@gmail.com', '', 'LSg4R1KwqTFtW6tQjBO1U93C6BrZAXeCTG9oexRxAwbkyiAyi9MJEWPiVSOW', '', '', '', '5.00000000', '10.01000000', '', 0, '', 'VN', '', '', '', '0000-00-00', '', 0, '2017-03-06 16:37:34', '2017-04-27 00:48:23', 0, 0, 0, 2, '2Mvs44V3PyWkTmNaFt5eqr8jHa83PvJATdE', 0, '123456s', 'adCsazaSdxXnv6yOvV6TyYiDs7VmBDpM', '', '', 0, 0, '', '', NULL, 'vn', '2017-04-27 07:48:23', '', 0, '0.00000000', 1, '13646', 1),
(13646, NULL, '', '', '', 'admin1@gmail.com', '', 'LSg4R1KwqTFtW6tQjBO1U93C6BrZAXeCTG9oexRxAwbkyiAyi9MJEWPiVSOW', '', '', '', '0.00000000', '0.00000000', '', 0, '', 'VN', '', '', '', '0000-00-00', '', 0, '2017-03-06 16:37:34', '2017-05-03 04:32:43', 0, 0, 0, 2, '2Mvs44V3PyWkTmNaFt5eqr8jHa83PvJATdE', 0, '12356789', 'adCsazaSdxXnv6yOvV6TyYiDs7VmBDpM', '', '', 0, 0, '', '', NULL, 'en', '2017-04-27 02:09:22', '', 0, '0.00000000', 0, '', 0),
(13647, NULL, 'Anny Dinh', 'it.ok2bme', '84942714500', 'it2.ok2bme@gmail.com', '', '1EVTBYexo8AcgqmgeXJO1uDLHQHl1VZ7WspIzLC3CMGR5b3rpOKAVuNpSXHz', '', '', NULL, '7.00000000', '58.04000000', '141 thuy khue', 0, 'vn', 'VN', '', 'ssasasdadasdadasdadasd', NULL, NULL, NULL, 0, '2017-03-11 12:10:07', '2017-05-24 01:12:42', 0, 0, 14, 0, NULL, 1, '', 'AMXdINzqAuUBxk4ZqjDiASIJQ0T2z9gp', NULL, 'ETYVFWCM6BXCI55L', 0, 0, NULL, NULL, NULL, 'vn', '2017-05-24 07:14:56', NULL, 0, NULL, 0, NULL, 0),
(13653, NULL, '', 'aim982691', NULL, 'it.ok2bme@gmail.com', '', 'ZzrojAZrzisvNSkGK1k9y9zdb4HjsiumMZamv1YxyGsri0OXHWZozfBoWJkY', '', '', NULL, '7.00000000', '10.01000000', '123456', 0, NULL, 'VN', '', '1L9kpKXDyEMcXpL2ykNoxkiERuFVwhNjj9', NULL, NULL, NULL, 0, '2017-04-01 13:51:22', '2017-05-27 01:44:16', 0, 0, 0, 10, NULL, 1, '', 'DrsvjTOacghe0VlOXHYuKVClCsh0iDox', NULL, '', 0, 0, NULL, NULL, NULL, NULL, '2017-04-27 03:54:41', NULL, 0, NULL, 0, NULL, 0),
(13654, NULL, '', 'hienbtc19', '84914465982', 'hienbtc193@gmail.com', '', '', '', '', NULL, '10.00000000', '2.00000000', '', 0, NULL, 'VN', '', '13JcX3dQz2tHtZXDo8LPJio9mKQFNZ5r7f', NULL, NULL, NULL, 0, '2017-04-07 16:42:10', '2017-04-30 17:42:05', 0, 0, 0, 0, NULL, 1, '', 'MA1u0EN8borW29qZMMJU8CNKivD91NFa', NULL, '', 0, 0, NULL, NULL, NULL, NULL, '2017-04-26 10:16:07', NULL, 0, NULL, 0, NULL, 0),
(13655, NULL, '', '', NULL, 'hienbtc19@gmail.com', '', '', '', '', NULL, NULL, '0.00000000', '', 0, NULL, 'VN', '', '', NULL, NULL, NULL, 0, '2017-04-20 14:25:22', '2017-04-20 14:25:22', 0, 0, 0, 0, NULL, 0, 'TidAwQlaJk8C6vYqIyEwbdypB', NULL, NULL, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, 0),
(13656, 0, 'ss', 'hoata', '98916585425', 'hoata0180@gmail.com', '', '8mHpVRBB5irSwt2babPKSV15Qm5mN5pRfCNb8CwCKRNgJHOePDpo8aRgFOZX', '', '', NULL, '4.00000000', '6.02000000', 'ssssssss sâs', 0, 'en', 'VU', '+678', '1P8kpzUPTNJV8GKA5MYuV2XghsMXa2zCu1', NULL, NULL, NULL, 0, '2017-04-20 14:27:02', '2017-05-27 01:29:05', 0, 0, 0, 0, NULL, 1, '', 'xDPRWQ3j6jt0Kmx06QeUS50PiXRl3Ley', NULL, '', 0, 0, NULL, NULL, NULL, 'en', '2017-05-27 08:28:55', NULL, 0, NULL, 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sestockinfo`
--
ALTER TABLE `sestockinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sestockprice`
--
ALTER TABLE `sestockprice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_info`
--
ALTER TABLE `stock_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=543;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sestockinfo`
--
ALTER TABLE `sestockinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sestockprice`
--
ALTER TABLE `sestockprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `stock_info`
--
ALTER TABLE `stock_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13657;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
