-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 18, 2023 at 03:42 PM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mangsel`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_activation_attempts`
--

INSERT INTO `auth_activation_attempts` (`id`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', '5ec0215bc28c83d3da7fe83570b2ed91', '2023-01-20 18:06:38'),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '084ecdcc645c1710154991cccbe2988a', '2023-02-20 06:12:51'),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', '9c4e48fef40207cbd265b6700939e571', '2023-02-20 06:16:51'),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'bdf3005fc890ef9d9b6be5399383d7a5', '2023-04-18 18:43:23'),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'a002c180134964e2bc607721e03884aa', '2023-05-02 14:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'petugas', 'Site-Administrator'),
(2, 'anggota', 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'riri23', 1, '2023-01-20 17:37:55', 0),
(2, '::1', 'riri23', 1, '2023-01-20 17:40:12', 0),
(3, '::1', 'riri23', 1, '2023-01-20 17:42:54', 0),
(4, '::1', 'riri23', 1, '2023-01-20 17:44:03', 0),
(5, '::1', 'riri23', 1, '2023-01-20 17:54:14', 0),
(6, '::1', 'riri23', 1, '2023-01-20 17:56:23', 0),
(7, '::1', 'riri23', 1, '2023-01-20 18:00:37', 0),
(8, '::1', 'riri23', 1, '2023-01-20 18:02:01', 0),
(9, '::1', 'riri23', 1, '2023-01-20 18:03:50', 0),
(10, '::1', 'riri23', 1, '2023-01-20 18:05:25', 0),
(11, '::1', 'lexynotfound@gmail.com', 1, '2023-01-20 18:06:48', 1),
(12, '::1', 'lexynotfound@gmail.com', 1, '2023-01-22 11:31:00', 1),
(13, '::1', 'lexynotfound@gmail.com', 1, '2023-02-08 08:07:39', 1),
(14, '::1', 'riri23', NULL, '2023-02-20 06:06:45', 0),
(15, '::1', 'riri23', NULL, '2023-02-20 06:07:04', 0),
(16, '::1', 'riri23', NULL, '2023-02-20 06:08:53', 0),
(17, '::1', 'riri23', NULL, '2023-02-20 06:09:12', 0),
(18, '::1', 'lexynotfound@gmail.com', NULL, '2023-02-20 06:09:35', 0),
(19, '::1', 'lexynotfound@gmail.com', NULL, '2023-02-20 06:10:03', 0),
(20, '::1', 'lexynotfound@gmail.com', NULL, '2023-02-20 06:10:18', 0),
(21, '::1', 'riri23', NULL, '2023-02-20 06:11:00', 0),
(22, '::1', 'raihanardila22', NULL, '2023-02-20 06:13:02', 0),
(23, '::1', 'raihanardila22', NULL, '2023-02-20 06:13:19', 0),
(24, '::1', 'raihanardila22@gmail.com', NULL, '2023-02-20 06:13:29', 0),
(25, '::1', 'raihanardila22', NULL, '2023-02-20 06:13:42', 0),
(26, '::1', 'raihanardila22', NULL, '2023-02-20 06:13:59', 0),
(27, '::1', 'raihanardila', NULL, '2023-02-20 06:14:06', 0),
(28, '::1', 'raihanardila22', NULL, '2023-02-20 06:14:15', 0),
(29, '::1', 'raihanardila22', NULL, '2023-02-20 06:14:45', 0),
(30, '::1', 'raihanardila22', NULL, '2023-02-20 06:14:56', 0),
(31, '::1', 'raihanardila22', NULL, '2023-02-20 06:15:05', 0),
(32, '::1', 'lexynotfound@gmail.com', 3, '2023-02-20 06:16:59', 1),
(33, '::1', 'lexynotfound@gmail.com', 1, '2023-02-20 06:56:59', 1),
(34, '::1', 'lexynotfound@gmail.com', 1, '2023-02-20 07:53:05', 1),
(35, '::1', 'riri23', NULL, '2023-02-21 06:08:26', 0),
(36, '::1', 'riri23', NULL, '2023-02-21 06:08:35', 0),
(37, '::1', 'riri23', NULL, '2023-02-21 06:08:52', 0),
(38, '::1', 'riri23', NULL, '2023-02-21 06:09:04', 0),
(39, '::1', 'lexynotfound@gmail.com', NULL, '2023-02-21 06:09:20', 0),
(40, '::1', 'lexynotfound@gmail.com', NULL, '2023-02-21 06:09:37', 0),
(41, '::1', 'riri23', NULL, '2023-02-21 06:09:49', 0),
(42, '::1', 'lexynotfound@gmail.com', 1, '2023-02-21 06:10:14', 1),
(43, '::1', 'riri23', NULL, '2023-02-21 06:10:24', 0),
(44, '::1', 'riri23', NULL, '2023-02-21 06:10:35', 0),
(45, '::1', 'lexynotfound@gmail.com', 1, '2023-02-21 06:10:45', 1),
(46, '::1', 'lexynotfound@gmail.com', 1, '2023-02-21 09:33:35', 1),
(47, '::1', 'lexynotfound@gmail.com', 1, '2023-02-21 11:06:17', 1),
(48, '::1', 'lexynotfound@gmail.com', 1, '2023-02-21 11:07:01', 1),
(49, '::1', 'lexynotfound@gmail.com', 1, '2023-02-21 11:19:38', 1),
(50, '::1', 'lexynotfound@gmail.com', 1, '2023-03-01 09:29:40', 1),
(51, '::1', 'lexynotfound@gmail.com', 1, '2023-03-01 13:33:25', 1),
(52, '::1', 'lexynotfound@gmail.com', 1, '2023-03-01 13:34:00', 1),
(53, '::1', 'lexynotfound@gmail.com', 1, '2023-03-03 09:37:58', 1),
(54, '::1', 'lexynotfound@gmail.com', 1, '2023-03-03 09:49:13', 1),
(55, '::1', 'lexynotfound@gmail.com', 1, '2023-03-03 17:02:59', 1),
(56, '::1', 'riri23', NULL, '2023-03-03 17:16:44', 0),
(57, '::1', 'lexynotfound@gmail.com', 1, '2023-03-03 17:16:53', 1),
(58, '::1', 'lexynotfound@gmail.com', 1, '2023-03-04 00:01:52', 1),
(59, '::1', 'lexynotfound@gmail.com', 1, '2023-03-04 02:21:04', 1),
(60, '::1', 'lexynotfound@gmail.com', 1, '2023-03-04 08:52:38', 1),
(61, '::1', 'lexynotfound@gmail.com', 1, '2023-03-04 09:06:47', 1),
(62, '::1', 'lexynotfound@gmail.com', 1, '2023-03-06 07:22:06', 1),
(63, '::1', 'lexynotfound@gmail.com', 1, '2023-03-06 11:09:54', 1),
(64, '::1', 'lexynotfound@gmail.com', 1, '2023-03-07 04:06:14', 1),
(65, '::1', 'lexynotfound@gmail.com', 1, '2023-03-07 06:33:53', 1),
(66, '::1', 'lexynotfound@gmail.com', 1, '2023-03-08 12:41:17', 1),
(67, '::1', 'lexynotfound@gmail.com', 1, '2023-03-15 11:48:36', 1),
(68, '::1', 'lexynotfound@gmail.com', 1, '2023-03-17 15:51:34', 1),
(69, '::1', 'riri23', NULL, '2023-04-04 10:38:22', 0),
(70, '::1', 'riri23', NULL, '2023-04-04 10:38:30', 0),
(71, '::1', 'riri23', NULL, '2023-04-04 10:38:40', 0),
(72, '::1', 'riri23', NULL, '2023-04-04 10:38:50', 0),
(73, '::1', 'riri23', NULL, '2023-04-04 10:39:13', 0),
(74, '::1', 'riri23', NULL, '2023-04-04 10:39:23', 0),
(75, '::1', 'riri23', NULL, '2023-04-04 10:41:16', 0),
(76, '::1', 'riri23', NULL, '2023-04-04 10:41:36', 0),
(77, '::1', 'riri23', NULL, '2023-04-04 11:41:02', 0),
(78, '::1', 'riri23', NULL, '2023-04-04 11:41:34', 0),
(79, '::1', 'lexynotfound@gmail.com', NULL, '2023-04-04 11:41:59', 0),
(80, '::1', 'riri23', NULL, '2023-04-04 11:42:42', 0),
(81, '::1', 'riri23', NULL, '2023-04-04 11:44:01', 0),
(82, '::1', 'lexynotfound@gmail.com', NULL, '2023-04-18 18:38:04', 0),
(83, '::1', 'riri23', 2, '2023-04-18 18:42:26', 0),
(84, '::1', 'riri23', 2, '2023-04-18 18:42:48', 0),
(85, '::1', 'lexynotfound@gmail.com', 2, '2023-04-18 18:43:34', 1),
(86, '::1', 'lexynotfound@gmail.com', 2, '2023-04-18 21:50:16', 1),
(87, '::1', 'riri23', NULL, '2023-04-18 21:57:12', 0),
(88, '::1', 'lexynotfound@gmail.com', 2, '2023-04-18 22:01:28', 1),
(89, '::1', 'riri23', NULL, '2023-04-18 22:01:52', 0),
(90, '::1', 'lexynotfound@gmail.com', 2, '2023-04-18 22:16:35', 1),
(91, '::1', 'lexynotfound@gmail.com', 2, '2023-04-18 22:17:21', 1),
(92, '::1', 'lexynotfound@gmail.com', 2, '2023-04-18 22:18:22', 1),
(93, '::1', 'lexynotfound@gmail.com', 2, '2023-04-18 22:19:26', 1),
(94, '::1', 'riri23', NULL, '2023-05-01 10:05:26', 0),
(95, '::1', 'lexynotfound@gmail.com', 2, '2023-05-01 10:07:25', 1),
(96, '::1', 'riri23', NULL, '2023-05-01 17:25:15', 0),
(97, '::1', 'riri23', NULL, '2023-05-01 17:25:40', 0),
(98, '::1', 'lexynotfound@gmail.com', 2, '2023-05-01 17:25:51', 1),
(99, '::1', 'riri23', NULL, '2023-05-01 17:42:58', 0),
(100, '::1', 'riri23', NULL, '2023-05-01 17:43:08', 0),
(101, '::1', 'lexynotfound@gmail.com', 2, '2023-05-01 17:43:18', 1),
(102, '::1', 'riri23', NULL, '2023-05-02 02:00:32', 0),
(103, '::1', 'lexynotfound@gmail.com', 2, '2023-05-02 02:00:40', 1),
(104, '::1', 'riri23', NULL, '2023-05-02 02:01:06', 0),
(105, '::1', 'riri23', NULL, '2023-05-02 02:01:14', 0),
(106, '::1', 'lexynotfound@gmail.com', 2, '2023-05-02 02:01:22', 1),
(107, '::1', 'lexynotfound@gmail.com', 2, '2023-05-02 02:42:13', 1),
(108, '::1', 'riri23', NULL, '2023-05-02 11:06:26', 0),
(109, '::1', 'lexynotfound@gmail.com', 2, '2023-05-02 11:06:34', 1),
(110, '::1', 'lexynotfound@gmail.com', 2, '2023-05-02 11:12:28', 1),
(111, '::1', 'raihanardila', NULL, '2023-05-02 14:02:18', 0),
(112, '::1', 'raihanardila', NULL, '2023-05-02 14:02:31', 0),
(113, '::1', 'raihanardila', NULL, '2023-05-02 14:02:41', 0),
(114, '::1', 'raihanardila', NULL, '2023-05-02 14:03:03', 0),
(115, '::1', 'raihanardila', NULL, '2023-05-02 14:03:22', 0),
(116, '::1', 'lexynotfound@gmail.com', 2, '2023-05-02 14:03:37', 1),
(117, '::1', 'lexynotfound@gmail.com', 2, '2023-05-03 00:11:48', 1),
(118, '::1', 'lexynotfound@gmail.com', 1, '2023-05-03 01:24:06', 1),
(119, '::1', 'lexynotfound@gmail.com', 1, '2023-05-03 02:46:19', 1),
(120, '::1', 'lexynotfound@gmail.com', 1, '2023-05-03 03:07:33', 1),
(121, '::1', 'lexynotfound@gmail.com', 1, '2023-05-03 03:24:18', 1),
(122, '::1', 'raihanardila22', NULL, '2023-05-03 03:33:07', 0),
(123, '::1', 'raihanardila', NULL, '2023-05-03 03:33:18', 0),
(124, '::1', 'kurnia@ids.ac.id', 2, '2023-05-03 03:33:28', 1),
(125, '::1', 'lexynotfound@gmail.com', 1, '2023-05-03 03:38:00', 1),
(126, '::1', 'riri23', NULL, '2023-05-03 03:42:55', 0),
(127, '::1', 'lexynotfound@gmail.com', 1, '2023-05-03 03:43:02', 1),
(128, '::1', 'lexynotfound@gmail.com', 1, '2023-05-03 08:45:21', 1),
(129, '::1', 'raihanardila', NULL, '2023-05-03 10:30:16', 0),
(130, '::1', 'raihanardila', NULL, '2023-05-03 10:30:27', 0),
(131, '::1', 'kurnia@ids.ac.id', 2, '2023-05-03 10:30:40', 1),
(132, '::1', 'lexynotfound@gmail.com', 1, '2023-05-03 11:25:25', 1),
(133, '::1', 'lexynotfound@gmail.com', 1, '2023-05-04 05:07:17', 1),
(134, '::1', 'raihanardila', NULL, '2023-05-04 05:20:50', 0),
(135, '::1', 'raihanardila', NULL, '2023-05-04 05:20:59', 0),
(136, '::1', 'raihanardila', NULL, '2023-05-04 05:21:08', 0),
(137, '::1', 'raihanardila', NULL, '2023-05-04 05:21:20', 0),
(138, '::1', 'kurnia@ids.ac.id', 2, '2023-05-04 05:21:29', 1),
(139, '::1', 'lexynotfound@gmail.com', 1, '2023-05-04 05:26:07', 1),
(140, '::1', 'lexynotfound@gmail.com', 1, '2023-05-04 09:08:54', 1),
(141, '::1', 'lexynotfound@gmail.com', 1, '2023-05-04 09:15:50', 1),
(142, '::1', 'lexynotfound@gmail.com', 1, '2023-05-04 13:44:35', 1),
(143, '::1', 'raihanardila', NULL, '2023-05-04 13:44:58', 0),
(144, '::1', 'raihanardila', NULL, '2023-05-04 13:45:06', 0),
(145, '::1', 'raihanardila', NULL, '2023-05-04 13:45:20', 0),
(146, '::1', 'raihanardila', NULL, '2023-05-04 13:45:39', 0),
(147, '::1', 'raihanardila', NULL, '2023-05-04 13:45:56', 0),
(148, '::1', 'kurnia@ids.ac.id', 2, '2023-05-04 13:46:08', 1),
(149, '::1', 'raihanardila', NULL, '2023-05-04 13:48:25', 0),
(150, '::1', 'kurnia@ids.ac.id', 2, '2023-05-04 13:50:11', 1),
(151, '::1', 'riri23', NULL, '2023-05-04 13:52:53', 0),
(152, '::1', 'lexynotfound@gmail.com', 1, '2023-05-04 13:53:04', 1),
(153, '::1', 'kurnia@ids.ac.id', 2, '2023-05-05 12:22:41', 1),
(154, '::1', 'lexynotfound@gmail.com', 1, '2023-05-05 13:02:07', 1),
(155, '::1', 'riri23', NULL, '2023-05-05 16:30:09', 0),
(156, '::1', 'lexynotfound@gmail.com', 1, '2023-05-05 16:30:18', 1),
(157, '::1', 'lexynotfound@gmail.com', 1, '2023-05-06 02:29:21', 1),
(158, '::1', 'lexynotfound@gmail.com', 1, '2023-05-07 06:48:48', 1),
(159, '::1', 'lexynotfound@gmail.com', 1, '2023-05-09 03:35:04', 1),
(160, '::1', 'lexynotfound@gmail.com', 1, '2023-05-09 03:49:48', 1),
(161, '::1', 'lexynotfound@gmail.com', 1, '2023-05-09 03:52:33', 1),
(162, '::1', 'lexynotfound@gmail.com', 1, '2023-05-12 10:44:12', 1),
(163, '::1', 'lexynotfound@gmail.com', 1, '2023-05-13 01:33:26', 1),
(164, '::1', 'lexynotfound@gmail.com', 1, '2023-05-13 09:45:56', 1),
(165, '::1', 'riri23', NULL, '2023-05-13 14:10:16', 0),
(166, '::1', 'riri23', NULL, '2023-05-13 14:10:23', 0),
(167, '::1', 'lexynotfound@gmail.com', 1, '2023-05-13 14:10:32', 1),
(168, '::1', 'riri23', NULL, '2023-05-14 00:30:43', 0),
(169, '::1', 'lexynotfound@gmail.com', 1, '2023-05-14 00:30:53', 1),
(170, '::1', 'riri23', NULL, '2023-05-14 03:15:15', 0),
(171, '::1', 'lexynotfound@gmail.com', 1, '2023-05-14 03:15:23', 1),
(172, '::1', 'lexynotfound@gmail.com', 1, '2023-05-14 08:56:44', 1),
(173, '::1', 'lexynotfound@gmail.com', 1, '2023-05-14 09:58:18', 1),
(174, '::1', 'lexynotfound@gmail.com', 1, '2023-05-14 15:18:51', 1),
(175, '::1', 'lexynotfound@gmail.com', 1, '2023-05-15 11:21:29', 1),
(176, '::1', 'lexynotfound@gmail.com', 1, '2023-05-17 08:21:25', 1),
(177, '::1', 'lexynotfound@gmail.com', 1, '2023-05-18 07:12:55', 1),
(178, '::1', 'riri23', NULL, '2023-05-19 09:32:26', 0),
(179, '::1', 'lexynotfound@gmail.com', 1, '2023-05-19 09:42:43', 1),
(180, '::1', 'lexynotfound@gmail.com', 1, '2023-05-19 20:15:08', 1),
(181, '::1', 'lexynotfound@gmail.com', 1, '2023-05-20 01:52:10', 1),
(182, '::1', 'lexynotfound@gmail.com', 1, '2023-05-20 13:11:49', 1),
(183, '::1', 'lexynotfound@gmail.com', 1, '2023-05-21 21:37:51', 1),
(184, '::1', 'lexynotfound@gmail.com', 1, '2023-05-22 00:04:47', 1),
(185, '::1', 'lexynotfound@gmail.com', 1, '2023-05-22 09:23:07', 1),
(186, '::1', 'riri23', NULL, '2023-05-22 09:59:36', 0),
(187, '::1', 'lexynotfound@gmail.com', 1, '2023-05-22 09:59:46', 1),
(188, '::1', 'riri23', NULL, '2023-05-22 19:16:04', 0),
(189, '::1', 'lexynotfound@gmail.com', 1, '2023-05-22 19:16:13', 1),
(190, '::1', 'lexynotfound@gmail.com', 1, '2023-05-24 12:35:17', 1),
(191, '::1', 'riri23', NULL, '2023-05-24 15:58:26', 0),
(192, '::1', 'lexynotfound@gmail.com', 1, '2023-05-24 15:58:36', 1),
(193, '::1', 'lexynotfound@gmail.com', 1, '2023-05-25 04:26:59', 1),
(194, '::1', 'riri23', NULL, '2023-05-25 06:22:34', 0),
(195, '::1', 'lexynotfound@gmail.com', 1, '2023-05-25 06:22:45', 1),
(196, '::1', 'lexynotfound@gmail.com', 1, '2023-05-25 06:37:05', 1),
(197, '::1', 'lexynotfound@gmail.com', 1, '2023-05-25 06:38:55', 1),
(198, '::1', 'lexynotfound@gmail.com', 1, '2023-05-26 03:36:49', 1),
(199, '::1', 'lexynotfound@gmail.com', 1, '2023-05-26 10:53:01', 1),
(200, '::1', 'riri23', NULL, '2023-05-26 13:28:39', 0),
(201, '::1', 'lexynotfound@gmail.com', 1, '2023-05-26 13:28:49', 1),
(202, '::1', 'lexynotfound@gmail.com', 1, '2023-05-27 00:57:10', 1),
(203, '::1', 'lexynotfound@gmail.com', 1, '2023-05-28 07:41:28', 1),
(204, '::1', 'riri23', NULL, '2023-05-29 01:04:16', 0),
(205, '::1', 'riri23', NULL, '2023-05-29 01:04:23', 0),
(206, '::1', 'lexynotfound@gmail.com', 1, '2023-05-29 01:04:32', 1),
(207, '::1', 'riri23', NULL, '2023-05-29 17:26:54', 0),
(208, '::1', 'riri23', NULL, '2023-05-29 17:27:01', 0),
(209, '::1', 'lexynotfound@gmail.com', 1, '2023-05-29 17:27:10', 1),
(210, '::1', 'lexynotfound@gmail.com', 1, '2023-05-30 00:38:18', 1),
(211, '::1', 'lexynotfound@gmail.com', 1, '2023-05-30 07:26:15', 1),
(212, '::1', 'riri23', NULL, '2023-05-30 07:51:20', 0),
(213, '::1', 'lexynotfound@gmail.com', 1, '2023-05-30 07:51:28', 1),
(214, '::1', 'lexynotfound@gmail.com', 1, '2023-05-31 07:31:44', 1),
(215, '::1', 'lexynotfound@gmail.com', 1, '2023-06-01 00:39:28', 1),
(216, '::1', 'lexynotfound@gmail.com', 1, '2023-06-01 11:11:06', 1),
(217, '::1', 'lexynotfound@gmail.com', 1, '2023-06-01 16:52:30', 1),
(218, '::1', 'lexynotfound@gmail.com', 1, '2023-06-02 03:09:46', 1),
(219, '::1', 'lexynotfound@gmail.com', 1, '2023-06-02 08:03:50', 1),
(220, '::1', 'lexynotfound@gmail.com', 1, '2023-06-02 11:18:17', 1),
(221, '::1', 'lexynotfound@gmail.com', 1, '2023-06-02 15:14:21', 1),
(222, '::1', 'lexynotfound@gmail.com', 1, '2023-06-04 02:46:59', 1),
(223, '::1', 'lexynotfound@gmail.com', 1, '2023-06-05 11:03:39', 1),
(224, '::1', 'lexynotfound@gmail.com', 1, '2023-06-05 16:02:09', 1),
(225, '::1', 'lexynotfound@gmail.com', 1, '2023-06-06 01:57:43', 1),
(226, '::1', 'lexynotfound@gmail.com', 1, '2023-06-06 09:49:21', 1),
(227, '::1', 'lexynotfound@gmail.com', 1, '2023-06-07 02:38:52', 1),
(228, '::1', 'lexynotfound@gmail.com', 1, '2023-06-07 11:38:05', 1),
(229, '::1', 'lexynotfound@gmail.com', 1, '2023-06-07 18:49:23', 1),
(230, '::1', 'lexynotfound@gmail.com', 1, '2023-06-08 00:41:27', 1),
(231, '::1', 'riri23', NULL, '2023-06-08 09:13:32', 0),
(232, '::1', 'lexynotfound@gmail.com', 1, '2023-06-08 09:13:41', 1),
(233, '::1', 'lexynotfound@gmail.com', 1, '2023-06-09 08:32:38', 1),
(234, '::1', 'lexynotfound@gmail.com', 1, '2023-06-09 12:03:34', 1),
(235, '::1', 'lexynotfound@gmail.com', 1, '2023-06-09 19:45:59', 1),
(236, '::1', 'lexynotfound@gmail.com', 1, '2023-06-10 02:25:59', 1),
(237, '::1', 'lexynotfound@gmail.com', 1, '2023-06-10 07:54:44', 1),
(238, '::1', 'lexynotfound@gmail.com', 1, '2023-06-11 01:25:51', 1),
(239, '::1', 'lexynotfound@gmail.com', 1, '2023-06-11 04:30:32', 1),
(240, '::1', 'lexynotfound@gmail.com', 1, '2023-06-11 11:53:19', 1),
(241, '::1', 'lexynotfound@gmail.com', 1, '2023-06-11 23:34:39', 1),
(242, '::1', 'lexynotfound@gmail.com', 1, '2023-06-12 06:24:54', 1),
(243, '::1', 'riri23', NULL, '2023-06-12 07:07:18', 0),
(244, '::1', 'lexynotfound@gmail.com', 1, '2023-06-12 07:07:53', 1),
(245, '::1', 'lexynotfound@gmail.com', 1, '2023-06-12 19:46:51', 1),
(246, '::1', 'lexynotfound@gmail.com', 1, '2023-06-14 09:41:18', 1),
(247, '::1', 'lexynotfound@gmail.com', 1, '2023-06-15 02:39:25', 1),
(248, '::1', 'lexynotfound@gmail.com', 1, '2023-06-15 06:15:39', 1),
(249, '::1', 'lexynotfound@gmail.com', 1, '2023-06-17 00:21:57', 1),
(250, '::1', 'lexynotfound@gmail.com', 1, '2023-06-18 10:49:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'Manage All Users'),
(2, 'manage-profile', 'Manage users profile');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_reset_attempts`
--

INSERT INTO `auth_reset_attempts` (`id`, `email`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, 'lexynotfound@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.48', '93515a5e136e21cc1732e52b5415fd28', '2023-04-18 21:49:53'),
(2, 'lexynotfound@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '67c329ed379f1f5e7e28ebf09f62be06', '2023-04-18 22:05:18'),
(3, 'lexynotfound@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.64', '5c8ec9b00040c2b3687c18750a999c30', '2023-05-01 10:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1674230464, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya_denda`
--

CREATE TABLE `tbl_biaya_denda` (
  `id` int(11) UNSIGNED NOT NULL,
  `harga_denda` varchar(255) NOT NULL DEFAULT '4000',
  `tgl_tetap` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Aktif',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_biaya_denda`
--

INSERT INTO `tbl_biaya_denda` (`id`, `harga_denda`, `tgl_tetap`, `status`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4000', '2019-11-23 00:00:00', 'Aktif', 0, '2023-03-06 19:40:17', '2023-03-06 19:40:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_buku` varchar(255) NOT NULL,
  `kategori_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `rak_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `sampul` varchar(255) NOT NULL DEFAULT 'defaults.svg',
  `isbn` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `thn_buku` varchar(255) NOT NULL,
  `jml` int(11) NOT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id`, `id_buku`, `kategori_id`, `rak_id`, `sampul`, `isbn`, `title`, `penerbit`, `pengarang`, `thn_buku`, `jml`, `tgl_masuk`, `updated_at`, `deleted_at`) VALUES
(1, 'CS-2123', 1, 1, 'defaults.svg', '132-123-234-231', 'CARA MUDAH BELAJAR PEMROGRAMAN C++', 'INFORMATIKA BANDUNG', 'BUDI RAHARJO ', '2012', 200, '2023-03-06 19:37:23', '2023-06-07 03:57:22', '2023-03-06 19:37:23'),
(2, 'DRT-1290', 1, 1, '1685097717_9268ecdd1b8e31e323f1.png', '123-198-092-320', 'Belajar Pemprograman Dart Dasar Sampai Mahir', 'PT. Visi Media Tama', 'Kurnia Raihan Ardian', '2023', 197, '2023-05-26 10:41:57', '2023-06-18 14:22:33', NULL),
(3, 'CPP-290', 1, 1, '1685419612_efeb8c47bb0e5d30f69e.png', '390-129-092-390', 'Pemprograman C++', 'PT. Multimedia Nusantara', 'Abdul Hamid', '2023', 200, '2023-05-30 04:06:52', '2023-06-18 15:09:45', NULL),
(4, 'SSTRA-390', 2, 2, '1686400271_933a07b89d771db9d202.jpg', '290-390-390-322', 'The Complete Plays In One Sitting', 'PT. Sentosa Media', 'William Shakespeare', '2023', 152, '2023-06-02 19:42:22', '2023-06-18 14:41:23', NULL),
(5, 'SSTRA-012', 2, 2, '1685419900_06f33cb251fc5a2cd772.jpg', '902-089-123-090', 'Pramoedya Ananta Toer : Politik & Sastra', 'PT. Multimedia Perkasa', 'Anandito Reza Bangsawan', '2018', 100, '2023-05-30 04:11:40', '2023-06-07 03:38:09', NULL),
(6, 'SSTRA-190', 2, 2, '1685420112_572e3cacf81bb86358dc.jpg', '180-230-902-390', 'The House of Dreams', 'PT. Visi Media Tama', 'Aghata Christie', '1998', 203, '2023-05-30 04:15:12', '2023-06-09 21:26:03', NULL),
(7, 'HRPT-012', 2, 2, '1686384031_1e4fff5ab21231f397d9.jpg', '389-902-378-265-128', 'Harry Potter and the Chamber of Secrets', 'PT. Visi Media Tama', 'J.K Rowling', '1998', 288, '2023-06-10 08:00:31', '2023-06-18 15:22:11', NULL),
(8, 'HRPT-018', 2, 2, '1686384627_3203c93c25d819defec9.jpg', '390-012-087-903-109', 'Harry Potter and the Deathly Hallows', 'PT. Visi Media Tama', 'J.K. Rowling', '2006', 290, '2023-06-10 08:10:27', '2023-06-18 15:17:55', NULL),
(10, 'DEAR23', 1, 1, 'defaults.svg', '3290-12309-3120392', 'DWADKAM', 'DADA', 'DADAW', '202', 2, '2023-06-10 08:43:42', '2023-06-10 08:46:22', '2023-06-10 08:46:22'),
(11, 'RI11', 2, 9, '1686407601_72e2fcda02eeb55bdc4a.jpg', '123', '10 dosa soeharto', 'BJ', 'BJ', '1965', 8, '2023-06-10 14:30:21', '2023-06-12 23:59:46', NULL),
(12, 'adasd-1232', 1, 3, '1686561741_dbf11ac4422d95b9cb01.png', '12312-012-312-012', 'adawd', 'dawdaw', 'dawdaw', '323', 33, '2023-06-12 09:22:21', '2023-06-12 09:28:38', '2023-06-12 09:28:38'),
(13, 'dawdaw-312321', 3, 3, '1686562028_52e352a3ae8b083f355e.png', '123-0312-0312-312', 'dawdaw', 'dawdaw', 'dadawd', '3232', 3, '2023-06-12 09:27:08', '2023-06-12 09:28:32', '2023-06-12 09:28:32'),
(14, 'dadaw-3123', 1, 1, '1686562333_bec0fa9a3e8094dbe6ec.png', '123-123-123-123', 'DAWDAWD', 'dawdaw', 'adwwdawd', '2323', 3, '2023-06-12 09:32:13', '2023-06-12 09:55:35', '2023-06-12 09:55:35'),
(15, 'dadaw-31233124324', 1, 1, '1686563698_c6d7dc88f8c30c1d6fcd.png', '123-123-123-123', 'DAWDAWDdqdq', 'dawdaw', 'adwwdawd', '2323', 3, '2023-06-12 09:54:58', '2023-06-12 09:55:30', '2023-06-12 09:55:30'),
(16, 'dawdaw-31232', 3, 3, '1686563766_d912b9dcd3f0a7f84e9f.png', '12312-312-312-32', 'dawdawdaw', 'dawdaw', 'dawdaw', '2323', 3, '2023-06-12 09:56:06', '2023-06-12 09:58:09', '2023-06-12 09:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_denda`
--

CREATE TABLE `tbl_denda` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_denda` varchar(255) NOT NULL,
  `pinjam_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `denda` varchar(255) NOT NULL,
  `biaya_id` int(11) UNSIGNED DEFAULT '0',
  `status` varchar(255) DEFAULT NULL,
  `status_denda` varchar(255) DEFAULT NULL,
  `lama_waktu` int(11) NOT NULL,
  `tgl_denda` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_denda`
--

INSERT INTO `tbl_denda` (`id`, `id_denda`, `pinjam_id`, `denda`, `biaya_id`, `status`, `status_denda`, `lama_waktu`, `tgl_denda`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(1, 'DND-8E076FCAF2', 1, 'Anda Telah Di Denda Sebesar 9000', 1, 'Dikembalikan', 'Dikembalikan', 6, '2023-06-06 07:17:45', NULL, NULL, NULL, 2),
(2, 'DND-9F876FCAF2', 2, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Dikembalikan', 3, '2023-06-08 10:58:22', '2023-06-07 10:58:22', '2023-06-07 10:58:22', NULL, 11),
(3, 'DND-95676FCAF2', 3, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Dikembalikan', 3, '2023-06-08 10:58:22', '2023-06-07 10:58:22', '2023-06-07 10:58:22', NULL, 3),
(4, 'DND-8E096FCAF2', 4, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Dikembalikan', 3, '2023-06-08 11:01:58', '2023-06-07 11:01:58', '2023-06-07 11:01:58', NULL, 3),
(5, 'DND-1E076FCAF2', 12, 'Anda Dikenakan Denda Sebesar 0', 1, 'Dikembalikan', 'Dikembalikan', 3, '2023-06-08 08:45:14', '2023-06-06 02:17:32', '2023-06-06 02:17:32', NULL, 8),
(6, 'DND-2E076FCAF2', 13, 'Anda Dikenakan Denda Sebesar 0', 1, 'Dikembalikan', 'Dikembalikan', 3, '2023-06-08 08:45:03', '2023-06-07 03:37:37', '2023-06-07 03:37:37', NULL, 9),
(7, 'DND-4E076FCAF2', 14, 'Anda Dikenakan Denda Sebesar 0', 1, 'Dikembalikan', NULL, 3, '2023-06-08 08:45:20', '2023-06-07 03:41:32', '2023-06-07 03:41:32', NULL, 9),
(8, 'DND-6E076FCAF2', 15, 'Anda Dikenakan Denda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 03:45:11', '2023-06-07 03:45:11', NULL, 9),
(9, 'DND-4E076FCAF2', 16, 'Anda Dikenakan Denda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 03:48:08', '2023-06-07 03:48:08', NULL, 9),
(10, 'DND-2F076FCAF2', 5, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Denda Sudah bayar', 3, '2023-06-08 11:03:33', '2023-06-07 11:03:33', NULL, NULL, 4),
(11, 'DND-6D076FCAF2', 6, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Denda Sudah bayar', 3, '2023-06-08 11:03:33', '2023-06-07 11:03:33', '2023-06-07 11:03:33', NULL, 5),
(12, 'DND-2K076FCAF2', 7, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Denda Sudah bayar', 3, '2023-06-07 11:06:42', '2023-06-07 11:06:42', '2023-06-07 11:06:42', NULL, 6),
(13, 'DND-8L076FCAF2', 8, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Denda Sudah bayar', 3, '2023-06-07 11:06:42', '2023-06-07 11:06:42', '2023-06-07 11:06:42', NULL, 7),
(14, 'DND-8Y076FCAF2', 9, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Denda Sudah bayar', 3, '2023-06-07 11:06:42', '2023-06-07 11:06:42', '2023-06-07 11:06:42', NULL, 5),
(15, 'DND-8I076FCAF2', 10, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Denda Sudah bayar', 3, '2023-06-07 11:06:42', '2023-06-07 11:06:42', '2023-06-07 11:06:42', NULL, 6),
(16, 'DND-9L076FCAF2', 11, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Denda Sudah bayar', 3, '2023-06-08 11:06:42', '2023-06-07 11:06:42', '2023-06-07 11:06:42', NULL, 7),
(17, 'DND-8B076FCAF2', 17, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 04:11:00', '2023-06-07 04:11:00', NULL, 1),
(18, 'DND-7M076FCAF2', 18, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 13:44:48', '2023-06-07 13:44:48', NULL, 7),
(19, 'DND-2J076FCAF2', 19, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', 'Tidak Ada Denda', 3, '2023-06-10 01:57:37', '2023-06-07 13:48:12', '2023-06-07 13:48:12', NULL, 4),
(20, 'DND-3X076FCAF2', 20, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 18:59:38', '2023-06-07 18:59:38', NULL, 7),
(21, 'DND-6A476FCAF2', 21, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 19:05:53', '2023-06-07 19:05:53', NULL, 3),
(22, 'DND-2A476FCAF2', 22, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 19:15:31', '2023-06-07 19:15:31', NULL, 8),
(23, 'DND-7S876FCAF2', 23, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 19:36:21', '2023-06-07 19:36:21', NULL, 5),
(24, 'DND-2D276FCAF2', 24, 'Denda Anda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 20:06:26', '2023-06-07 20:06:26', NULL, 5),
(25, 'DND-2R076FCAF2', 25, 'Anda Dikenakan Denda Sebesar 0', 1, 'Dikembalikan', NULL, 3, NULL, '2023-06-07 20:35:20', '2023-06-07 20:35:20', NULL, 6),
(26, 'DND-6C076FCAF2', 26, 'Anda Dikenakan Denda Sebesar 0', 1, '', NULL, 3, NULL, '2023-06-07 20:56:45', '2023-06-07 20:56:45', NULL, 3),
(27, 'DND-2X076FCAF2', 27, 'Anda Dikenakan Denda Sebesar 0', 1, NULL, 'Tidak Ada Denda', 3, NULL, '2023-06-07 21:28:38', '2023-06-07 21:28:38', NULL, 7),
(28, 'DND-2K076FCAF2', 28, 'Anda Dikenakan Denda Sebesar 0', 1, NULL, 'Tidak Ada Denda', 3, NULL, '2023-06-07 21:34:20', '2023-06-07 21:34:20', NULL, 8),
(29, 'DND-2L776FCAF2', 29, 'Anda Dikenakan Denda Sebesar 0', 1, NULL, 'Tidak Ada Denda', 3, NULL, '2023-06-07 21:37:25', '2023-06-07 21:37:25', NULL, 7),
(30, 'DND-2Z976FCAF2', 30, 'Anda Dikenakan Denda Sebesar 0', 1, NULL, 'Denda Belum Dibayar', 3, NULL, '2023-06-07 21:39:00', '2023-06-07 21:39:00', NULL, 7),
(31, 'DND-2V076FCAF2', 31, 'Anda Dikenakan Denda Sebesar 0', 1, 'Dikembalikan', 'Denda Belum Dibayar', 3, NULL, '2023-06-07 21:42:04', '2023-06-07 21:42:19', NULL, 7),
(32, 'DND-2V776FCAF2', 32, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 3, NULL, '2023-06-07 21:51:25', '2023-06-07 21:51:25', NULL, 9),
(33, 'DND-2J676FCAF2', 33, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 3, NULL, '2023-06-07 21:52:48', '2023-06-07 21:52:48', NULL, 9),
(34, 'DND-2G476FCAF2', 34, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 3, NULL, '2023-06-08 00:49:37', '2023-06-08 00:49:37', NULL, 9),
(35, 'DND-2L476FCAF2', 35, 'Anda Dikenakan Denda Sebesar 0', 1, 'Dikembalikan', 'Tidak Ada Denda', 3, NULL, '2023-06-08 00:55:12', '2023-06-08 00:58:30', NULL, 9),
(36, 'DND-2R053FCAF2', 36, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-08 01:23:26', '2023-06-08 01:23:26', NULL, 8),
(37, 'DND-2R897FCAF2', 37, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-08 01:30:42', '2023-06-08 01:30:50', NULL, 6),
(38, 'DND-2R777FCAF2', 38, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-08 09:22:31', '2023-06-08 09:22:41', NULL, 8),
(39, 'DND-2R289FCAF2', 39, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-08 09:28:13', '2023-06-08 09:28:22', NULL, 9),
(40, 'DND-2R336FCAF2', 40, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 13:09:38', '2023-06-09 13:14:26', NULL, 9),
(41, 'DND-2R876FCAF2', 41, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 19:46:28', '2023-06-09 19:50:00', NULL, 7),
(42, 'DND-2R326FCAF2', 42, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 19:50:19', '2023-06-09 19:57:06', NULL, 9),
(43, 'DND-2R476FCAF2', 43, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 19:57:24', '2023-06-09 19:58:21', NULL, 9),
(44, 'DND-2R443FCAF2', 44, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 19:58:47', '2023-06-09 20:04:21', NULL, 8),
(45, 'DND-2R431FCAF2', 45, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 20:09:00', '2023-06-09 20:09:00', NULL, 6),
(46, 'DND-2R226FCAF2', 46, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 20:19:50', '2023-06-09 20:19:50', NULL, 3),
(47, 'DND-2R256FCAF2', 47, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 20:23:07', '2023-06-09 20:23:07', NULL, 3),
(48, 'DND-2R846FCAF2', 48, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 20:45:35', '2023-06-09 20:45:35', NULL, 9),
(49, 'DND-2R980FCAF2', 49, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 20:55:54', '2023-06-09 20:55:54', NULL, 9),
(50, 'DND-2R356FCAF2', 50, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 21:01:12', '2023-06-09 21:01:12', NULL, 8),
(51, 'DND-2R987FCAF2', 51, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 21:12:11', '2023-06-09 21:12:11', NULL, 9),
(52, 'DND-2R236FCAF2', 52, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-09 21:25:13', '2023-06-09 21:26:03', NULL, 9),
(53, 'DND-2R745FCAF2', 53, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-12 22:55:37', '2023-06-12 22:56:40', NULL, 8),
(54, 'DND-3R576FCAF2', 54, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sedang Di Pinjam', 'Tidak Ada Denda', 0, NULL, '2023-06-12 23:08:35', '2023-06-12 23:08:35', NULL, 7),
(55, 'DND-2B076FCAF2', 55, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-12 23:45:26', '2023-06-12 23:53:00', NULL, 8),
(56, 'DND-2P076FCAF2', 56, 'Anda Dikenakan Denda Sebesar 0', 1, 'Belum Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-12 23:59:46', '2023-06-12 23:59:46', NULL, 7),
(57, 'DND-2H676FCAF2', 57, 'Anda Dikenakan Denda Sebesar 0', 1, 'Belum Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-13 00:03:06', '2023-06-13 00:03:06', NULL, 8),
(58, 'DND-2Z076FCAF2', 58, 'Anda Dikenakan Denda Sebesar 0', 1, 'Belum Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-13 00:04:16', '2023-06-13 00:04:16', NULL, 4),
(59, 'DND-2S076FCAF2', 59, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-13 00:05:05', '2023-06-13 00:05:12', NULL, 6),
(60, 'DND-2X076FCAF2', 60, 'Anda Dikenakan Denda Sebesar 0', 1, 'Belum Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-13 00:05:28', '2023-06-13 00:05:28', NULL, 6),
(61, 'DND-2H076FCAF2', 61, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-13 00:13:49', '2023-06-18 14:22:22', NULL, 3),
(62, 'DND-79A57FB7F4', 62, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 14:17:32', '2023-06-18 14:22:27', NULL, 8),
(63, 'DND-80911798B4', 63, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 14:20:59', '2023-06-18 14:22:33', NULL, 6),
(64, 'DND-554B9CB1CB', 64, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 14:23:12', '2023-06-18 14:41:18', NULL, 9),
(65, 'DND-7EC0478B04', 65, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 14:36:02', '2023-06-18 14:41:23', NULL, 9),
(66, 'DND-006AD86178', 66, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 14:48:06', '2023-06-18 15:10:05', NULL, 9),
(67, 'DND-2AB2B47520', 67, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 15:06:55', '2023-06-18 15:09:45', NULL, 9),
(68, 'DND-CC3ED14B20', 68, 'Anda Dikenakan Denda Sebesar 0', 1, 'Belum Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 15:10:18', '2023-06-18 15:10:18', NULL, 9),
(69, 'DND-9A735E88F6', 69, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 15:17:11', '2023-06-18 15:17:55', NULL, 6),
(70, 'DND-D4F59EB8F2', 70, 'Anda Dikenakan Denda Sebesar 0', 1, 'Sudah Dikembalikan', 'Tidak Ada Denda', 0, NULL, '2023-06-18 15:18:14', '2023-06-18 15:22:11', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pemrograman', '2023-03-06 19:41:20', NULL, NULL),
(2, 'Sastra', '2023-05-30 04:08:14', '2023-06-11 23:43:34', NULL),
(3, 'Sejarah', '2023-06-11 14:28:52', '2023-06-12 22:42:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_laporan_peminjaman` varchar(255) DEFAULT NULL,
  `judul_laporan` varchar(255) DEFAULT NULL,
  `jenis_laporan` varchar(255) DEFAULT NULL,
  `pinjam_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `buku_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tgl_laporan` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id`, `id_laporan_peminjaman`, `judul_laporan`, `jenis_laporan`, `pinjam_id`, `buku_id`, `tgl_laporan`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'LPPJ-312IODM', 'Peminjaman', 'dioawmndksndioasn (AG0006) Telah Meminjam Buku', 45, 6, '2023-06-09', '2023-06-09 20:09:00', '2023-06-09 20:09:00', NULL),
(2, 'LPPJ-DAK3141', 'Peminjaman', 'Ahmad Sanusi Fajri (AG0003) Telah Meminjam Buku', 46, 6, '2023-06-09', '2023-06-09 20:19:50', '2023-06-09 20:19:50', NULL),
(3, 'LPPJ-NKWKL123', 'Peminjaman', 'Ahmad Sanusi Fajri (AG0003) Telah Meminjam Buku', 47, 6, '2023-06-09', '2023-06-09 20:23:07', '2023-06-09 20:23:07', NULL),
(4, 'LPPJ-32KKDW', 'Peminjaman', 'idj12odnaod (AG0009) Telah Meminjam Buku', 49, 6, '2023-06-09', '2023-06-09 20:55:54', '2023-06-09 20:55:54', NULL),
(5, 'LPPJ-NJKAW23', 'Peminjaman', 'iodn1qdionawodn2on312 (AG0008) Telah Meminjam Buku', 50, 6, '2023-06-09', '2023-06-09 21:01:12', '2023-06-09 21:01:12', NULL),
(6, 'LPJJ-KNKDAWD23', 'Peminjaman', 'idj12odnaod (AG0009) Telah Meminjam Buku', 51, 6, '2023-06-09', '2023-06-09 21:12:11', '2023-06-09 21:12:11', NULL),
(7, 'LPPJ-OKOKDW03', 'Peminjaman', 'idj12odnaod (AG0009) Telah Meminjam Buku', 52, 6, '2023-06-09', '2023-06-09 21:25:13', '2023-06-09 21:25:13', NULL),
(8, 'LPPJ-88977D4D40B2', 'Laporan Peminjaman', 'iodn1qdionawodn2on312 (AG0008) Telah Meminjam Buku', 53, 11, '2023-06-12', '2023-06-12 22:55:37', '2023-06-12 22:55:37', NULL),
(9, 'LPPJ-0BC3914A4BF1', 'Laporan Peminjaman', 'iodnawkldn12iound1 (AG0007) Telah Meminjam Buku', 54, 7, '2023-06-12', '2023-06-12 23:08:35', '2023-06-12 23:08:35', NULL),
(10, 'LPPJ-FAF1C36AFC29', 'Laporan Peminjaman', 'iodn1qdionawodn2on312 (AG0008) Telah Meminjam Buku', 55, 8, '2023-06-12', '2023-06-12 23:45:26', '2023-06-12 23:45:26', NULL),
(11, 'LPPJ-0AA083A40BA2', 'Laporan Peminjaman', 'iodnawkldn12iound1 (AG0007) Telah Meminjam Buku', 56, 11, '2023-06-12', '2023-06-12 23:59:46', '2023-06-12 23:59:46', NULL),
(12, 'LPPJ-9D8183F1460A', 'Laporan Peminjaman', 'iodn1qdionawodn2on312 (AG0008) Telah Meminjam Buku', 57, 7, '2023-06-13', '2023-06-13 00:03:06', '2023-06-13 00:03:06', NULL),
(13, 'LPPJ-87A8BBF247E9', 'Laporan Peminjaman', 'i1hj2do12ndion (AG0004) Telah Meminjam Buku', 58, 7, '2023-06-13', '2023-06-13 00:04:16', '2023-06-13 00:04:16', NULL),
(14, 'LPPJ-138D5558459F', 'Laporan Peminjaman', 'dioawmndksndioasn (AG0006) Telah Meminjam Buku', 59, 4, '2023-06-13', '2023-06-13 00:05:05', '2023-06-13 00:05:05', NULL),
(15, 'LPPJ-6191B299B1B5', 'Laporan Peminjaman', 'dioawmndksndioasn (AG0006) Telah Meminjam Buku', 60, 7, '2023-06-13', '2023-06-13 00:05:28', '2023-06-13 00:05:28', NULL),
(16, 'LPPJ-3278D6C078F5', 'Laporan Peminjaman', 'Ahmad Sanusi Fajri (AG0003) Telah Meminjam Buku', 61, 2, '2023-06-13', '2023-06-13 00:13:49', '2023-06-13 00:13:49', NULL),
(17, 'LPPJ-B332A360DD2F', 'Laporan Peminjaman', 'iodn1qdionawodn2on312 (AG0008) Telah Meminjam Buku', 62, 4, '2023-06-18', '2023-06-18 14:17:32', '2023-06-18 14:17:32', NULL),
(18, 'LPPJ-DB222AF51E6E', 'Laporan Peminjaman', 'dioawmndksndioasn (AG0006) Telah Meminjam Buku', 63, 2, '2023-06-18', '2023-06-18 14:20:59', '2023-06-18 14:20:59', NULL),
(19, 'LPPJ-2E2EFAE29719', 'Laporan Peminjaman', 'idj12odnaod (AG0009) Telah Meminjam Buku', 64, 3, '2023-06-18', '2023-06-18 14:23:12', '2023-06-18 14:23:12', NULL),
(20, 'LPPJ-DB8E7C4279ED', 'Laporan Peminjaman', 'idj12odnaod (AG0009) Telah Meminjam Buku', 65, 4, '2023-06-18', '2023-06-18 14:36:02', '2023-06-18 14:36:02', NULL),
(21, 'LPPJ-93D9D0F8F940', 'Laporan Peminjaman', 'idj12odnaod (AG0009) Telah Meminjam Buku', 67, 3, '2023-06-18', '2023-06-18 15:06:55', '2023-06-18 15:06:55', NULL),
(22, 'LPPJ-F71EDFAD3EB0', 'Laporan Peminjaman', 'idj12odnaod (AG0009) Telah Meminjam Buku', 68, 7, '2023-06-18', '2023-06-18 15:10:18', '2023-06-18 15:10:18', NULL),
(23, 'LPPJ-29D826D52569', 'Laporan Peminjaman', 'dioawmndksndioasn (AG0006) Telah Meminjam Buku', 69, 8, '2023-06-18', '2023-06-18 15:17:11', '2023-06-18 15:17:11', NULL),
(24, 'LPPJ-85BE91636512', 'Laporan Peminjaman', 'oindawokdnaklsndio (AG0005) Telah Meminjam Buku', 70, 7, '2023-06-18', '2023-06-18 15:18:14', '2023-06-18 15:18:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan_buku`
--

CREATE TABLE `tbl_laporan_buku` (
  `id` int(11) NOT NULL,
  `id_laporan_buku` varchar(255) DEFAULT NULL,
  `buku_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `judul_laporan` varchar(255) DEFAULT NULL,
  `jenis_laporan` varchar(255) DEFAULT NULL,
  `tgl_laporan` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_laporan_buku`
--

INSERT INTO `tbl_laporan_buku` (`id`, `id_laporan_buku`, `buku_id`, `judul_laporan`, `jenis_laporan`, `tgl_laporan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LPB-HRT23JK', 7, 'Penambahan Buku', 'penambahan', '2023-06-10', '2023-06-10 08:00:31', '2023-06-10 08:00:31', '0000-00-00 00:00:00'),
(2, 'LPB-A9C948D5CE', 8, 'Penambahan Buku', 'Penambahan BukuHarry Potter and the Deathly Hallows', '2023-06-10', '2023-06-10 08:10:27', '2023-06-10 08:10:27', '0000-00-00 00:00:00'),
(5, 'LPB-587B03CD85', 10, 'Penambahan Buku', 'Penambahan BukuDWADKAM', '2023-06-10', '2023-06-10 08:43:42', '2023-06-10 08:43:42', '0000-00-00 00:00:00'),
(8, 'LPBD-485A79DBF5', 10, 'Penghapusan Buku', 'Penghapusan Buku: DWADKAM', '2023-06-10', '2023-06-10 08:46:22', '2023-06-10 08:46:22', '0000-00-00 00:00:00'),
(9, 'LPBU-BD6CF2174B', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:28:48', '2023-06-10 11:28:48', '0000-00-00 00:00:00'),
(10, 'LPBU-CF4D14D8C4', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:32:38', '2023-06-10 11:32:38', '0000-00-00 00:00:00'),
(11, 'LPBU-9440C166F4', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:35:29', '2023-06-10 11:35:29', '0000-00-00 00:00:00'),
(12, 'LPBU-26FDDFDE55', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:35:32', '2023-06-10 11:35:32', '0000-00-00 00:00:00'),
(13, 'LPBU-1FF056837E', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:35:34', '2023-06-10 11:35:34', '0000-00-00 00:00:00'),
(14, 'LPBU-2B2664F44A', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:37:07', '2023-06-10 11:37:07', '0000-00-00 00:00:00'),
(15, 'LPBU-57B6F18D5F', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:38:00', '2023-06-10 11:38:00', '0000-00-00 00:00:00'),
(16, 'LPBU-288367FD60', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:45:40', '2023-06-10 11:45:40', '0000-00-00 00:00:00'),
(17, 'LPBU-80D936DF6C', 4, 'Pembaruan Buku', 'Pembaruan Buku Sastra', '2023-06-10', '2023-06-10 11:45:58', '2023-06-10 11:45:58', '0000-00-00 00:00:00'),
(18, 'LPBU-22FF2E1A62', 4, 'Pembaruan Data Buku', 'Data buku dengan judul \"Sastra\" telah diperbarui.', '2023-06-10', '2023-06-10 11:52:26', '2023-06-10 11:52:26', '0000-00-00 00:00:00'),
(19, 'LPBU-F52CFDAD24', 4, 'Pembaruan Data Buku', 'Data buku dengan judul \"Sastra\" telah diperbarui.', '2023-06-10', '2023-06-10 11:53:41', '2023-06-10 11:53:41', '0000-00-00 00:00:00'),
(20, 'LPBU-1D40AFDB0F', 4, 'Pembaruan Data Buku', 'Data buku dengan judul \"Sastra\" telah diperbarui.', '2023-06-10', '2023-06-10 12:18:33', '2023-06-10 12:18:33', '0000-00-00 00:00:00'),
(21, 'LPBU-A0B3FF1A5C', 4, 'Pembaruan Data Buku', 'Data buku dengan judul \"Sastra\" telah diperbarui.', '2023-06-10', '2023-06-10 12:31:11', '2023-06-10 12:31:11', '0000-00-00 00:00:00'),
(22, 'LPBU-23FCAA5B87', 4, 'Pembaruan Data Buku', 'Data buku dengan judul \"The Complete Plays In One Sitting\" telah diperbarui.', '2023-06-10', '2023-06-10 12:34:57', '2023-06-10 12:34:57', '0000-00-00 00:00:00'),
(23, 'LPB-B5F510E06C', 11, 'Penambahan Buku', 'Penambahan Buku 10 dosa soeharto', '2023-06-10', '2023-06-10 14:30:21', '2023-06-10 14:30:21', '0000-00-00 00:00:00'),
(24, 'LPBU-AB311D9AD3', 11, 'Pembaruan Data Buku', 'Data buku dengan judul \"10 dosa soeharto\" telah diperbarui.', '2023-06-10', '2023-06-10 14:33:21', '2023-06-10 14:33:21', '0000-00-00 00:00:00'),
(25, 'LPB-A0363EC575', 12, 'Penambahan Buku', 'Penambahan Buku adawd', '2023-06-12', '2023-06-12 09:22:21', '2023-06-12 09:22:21', '0000-00-00 00:00:00'),
(26, 'LPB-607C9F61BD', 13, 'Penambahan Buku', 'Penambahan Buku dawdaw', '2023-06-12', '2023-06-12 09:27:08', '2023-06-12 09:27:08', '0000-00-00 00:00:00'),
(27, 'LPBD-4F0F734F99', 13, 'Penghapusan Buku', 'Penghapusan Buku: dawdaw', '2023-06-12', '2023-06-12 09:28:32', '2023-06-12 09:28:32', '0000-00-00 00:00:00'),
(28, 'LPBD-16062EA579', 12, 'Penghapusan Buku', 'Penghapusan Buku: adawd', '2023-06-12', '2023-06-12 09:28:38', '2023-06-12 09:28:38', '0000-00-00 00:00:00'),
(29, 'LPB-5363D2A613', 14, 'Penambahan Buku', 'Penambahan Buku DAWDAWD', '2023-06-12', '2023-06-12 09:32:13', '2023-06-12 09:32:13', '0000-00-00 00:00:00'),
(30, 'LPBD-AE8E88DE2F', 15, 'Penghapusan Buku', 'Penghapusan Buku: DAWDAWDdqdq', '2023-06-12', '2023-06-12 09:55:30', '2023-06-12 09:55:30', '0000-00-00 00:00:00'),
(31, 'LPBD-990D311208', 14, 'Penghapusan Buku', 'Penghapusan Buku: DAWDAWD', '2023-06-12', '2023-06-12 09:55:35', '2023-06-12 09:55:35', '0000-00-00 00:00:00'),
(32, 'LPB-6BE8F86BB3', 16, 'Penambahan Buku', 'Penambahan Buku dawdawdaw', '2023-06-12', '2023-06-12 09:56:06', '2023-06-12 09:56:06', '0000-00-00 00:00:00'),
(33, 'LPBD-3717C35118', 16, 'Penghapusan Buku', 'Penghapusan Buku: dawdawdaw', '2023-06-12', '2023-06-12 09:58:09', '2023-06-12 09:58:09', '0000-00-00 00:00:00'),
(34, 'LPBU-0CC918BFDC', 11, 'Pembaruan Data Buku', 'Data buku dengan judul \"10 dosa soeharto\" telah diperbarui.', '2023-06-12', '2023-06-12 22:51:01', '2023-06-12 22:51:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan_denda`
--

CREATE TABLE `tbl_laporan_denda` (
  `id` int(11) NOT NULL,
  `denda_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `id_laporan_denda` varchar(255) DEFAULT NULL,
  `judul_laporan` varchar(255) NOT NULL,
  `jenis_laporan` varchar(255) NOT NULL,
  `tgl_laporan` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_laporan_denda`
--

INSERT INTO `tbl_laporan_denda` (`id`, `denda_id`, `id_laporan_denda`, `judul_laporan`, `jenis_laporan`, `tgl_laporan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 68, 'LPDN-14632DCBB771', 'Laporan Denda Peminjaman', 'idj12odnaod (AG0009) Telah Dikenakan Denda Sebesar 0 Data Denda Sudah Tercatat', '2023-06-18', '2023-06-18 15:10:18', '2023-06-18 15:10:18', NULL),
(3, 70, 'LPDN-6C62F2725396', 'Laporan Denda Peminjaman', 'oindawokdnaklsndio (AG0005) Telah Dikenakan Denda Sebesar Anda Dikenakan Denda Sebesar 0 Data Denda Sudah Tercatat', '2023-06-18', '2023-06-18 15:18:14', '2023-06-18 15:18:14', NULL),
(4, 70, 'LPDNU-6C683CF19070', 'Laporan Denda Peminjaman', 'oindawokdnaklsndio (AG0005) Terdapat Denda Pada Peminjaman 70', '2023-06-18', '2023-06-18 15:22:11', '2023-06-18 15:22:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan_pengembalian`
--

CREATE TABLE `tbl_laporan_pengembalian` (
  `id` int(11) NOT NULL,
  `id_laporan_pengembalian` varchar(255) DEFAULT NULL,
  `judul_laporan` varchar(255) DEFAULT NULL,
  `jenis_laporan` varchar(255) DEFAULT NULL,
  `pengembalian_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tgl_laporan` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_laporan_pengembalian`
--

INSERT INTO `tbl_laporan_pengembalian` (`id`, `id_laporan_pengembalian`, `judul_laporan`, `jenis_laporan`, `pengembalian_id`, `tgl_laporan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LPP-23209XED', 'Laporan Pengembalian', 'idj12odnaod (AG0009) Melakukan Pengembalian 3 Buku The House Of Dragon', 31, '2023-06-10', '2023-06-10 04:16:44', '2023-06-10 04:16:44', '2023-06-10 04:16:44'),
(2, 'LPP-F86EA830C9E5', 'Laporan Pengembalian', 'idj12odnaod (AG0009) Telah Mengembalikan 3 Buku The House of Dreams', 32, '2023-06-09', '2023-06-09 21:26:03', '2023-06-09 21:26:03', NULL),
(3, 'LPP-F80779780DD7', 'Laporan Pengembalian', 'iodn1qdionawodn2on312 (AG0008) Telah Mengembalikan 1 Buku 10 dosa soeharto', 33, '2023-06-12', '2023-06-12 22:56:40', '2023-06-12 22:56:40', NULL),
(4, 'LPP-7FFADDDA75D6', 'Laporan Pengembalian', 'iodn1qdionawodn2on312 (AG0008) Telah Mengembalikan 1 Buku Harry Potter and the Deathly Hallows', 34, '2023-06-12', '2023-06-12 23:53:00', '2023-06-12 23:53:00', NULL),
(5, 'LPP-E70CCBF82FF1', 'Laporan Pengembalian', 'dioawmndksndioasn (AG0006) Telah Mengembalikan 3 Buku The Complete Plays In One Sitting', 35, '2023-06-13', '2023-06-13 00:05:12', '2023-06-13 00:05:12', NULL),
(6, 'LPP-D143B4017D64', 'Laporan Pengembalian', 'Ahmad Sanusi Fajri (AG0003) Telah Mengembalikan 1 Buku Belajar Pemprograman Dart Dasar Sampai Mahir', 36, '2023-06-18', '2023-06-18 14:22:22', '2023-06-18 14:22:22', NULL),
(7, 'LPP-2CD4D1D5A8FC', 'Laporan Pengembalian', 'iodn1qdionawodn2on312 (AG0008) Telah Mengembalikan 1 Buku The Complete Plays In One Sitting', 37, '2023-06-18', '2023-06-18 14:22:27', '2023-06-18 14:22:27', NULL),
(8, 'LPP-5C0F37D5CA46', 'Laporan Pengembalian', 'dioawmndksndioasn (AG0006) Telah Mengembalikan 1 Buku Belajar Pemprograman Dart Dasar Sampai Mahir', 38, '2023-06-18', '2023-06-18 14:22:33', '2023-06-18 14:22:33', NULL),
(9, 'LPP-1BF41A94E5AB', 'Laporan Pengembalian', 'idj12odnaod (AG0009) Telah Mengembalikan 1 Buku Pemprograman C++', 39, '2023-06-18', '2023-06-18 14:41:18', '2023-06-18 14:41:18', NULL),
(10, 'LPP-9990498AC0A0', 'Laporan Pengembalian', 'idj12odnaod (AG0009) Telah Mengembalikan 1 Buku The Complete Plays In One Sitting', 40, '2023-06-18', '2023-06-18 14:41:23', '2023-06-18 14:41:23', NULL),
(11, 'LPP-7CE37A97E321', 'Laporan Pengembalian', 'idj12odnaod (AG0009) Telah Mengembalikan 1 Buku Pemprograman C++', 41, '2023-06-18', '2023-06-18 15:09:45', '2023-06-18 15:09:45', NULL),
(12, 'LPP-E0E197895697', 'Laporan Pengembalian', 'idj12odnaod (AG0009) Telah Mengembalikan 1 Buku Harry Potter and the Chamber of Secrets', 42, '2023-06-18', '2023-06-18 15:10:05', '2023-06-18 15:10:05', NULL),
(13, 'LPP-B76CCA46E0D2', 'Laporan Pengembalian', 'dioawmndksndioasn (AG0006) Telah Mengembalikan 1 Buku Harry Potter and the Deathly Hallows', 43, '2023-06-18', '2023-06-18 15:17:55', '2023-06-18 15:17:55', NULL),
(14, 'LPP-18501E771848', 'Laporan Pengembalian', 'oindawokdnaklsndio (AG0005) Telah Mengembalikan 1 Buku Harry Potter and the Chamber of Secrets', 44, '2023-06-18', '2023-06-18 15:22:11', '2023-06-18 15:22:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pengembalian` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `buku_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `pinjam_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `denda_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(255) DEFAULT NULL,
  `tgl_balik` date DEFAULT NULL,
  `lama_pinjam` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_pengembalian`
--

INSERT INTO `tbl_pengembalian` (`id`, `id_pengembalian`, `user_id`, `buku_id`, `pinjam_id`, `denda_id`, `status`, `tgl_balik`, `lama_pinjam`, `tgl_pinjam`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PGL-12398321789', 9, 4, 16, 9, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 13:32:43', '2023-06-07 13:32:43', '2023-06-07 13:32:43'),
(2, 'PGL-33218321789', 4, 6, 19, 19, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 13:48:22', '2023-06-07 13:48:22', NULL),
(3, 'PGL-54398321789', 7, 4, 20, 20, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 18:59:54', '2023-06-07 18:59:54', NULL),
(4, 'PGL-13982352230', 3, 2, 21, 21, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 19:06:17', '2023-06-07 19:06:17', NULL),
(5, 'PGL-24482352230', 8, 2, 22, 22, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 19:16:55', '2023-06-07 19:16:55', NULL),
(6, 'PGL-25782381239', 5, 2, 24, 24, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 20:06:45', '2023-06-07 20:06:45', NULL),
(7, 'PGL-55782381239', 6, 2, 25, 25, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 20:38:49', '2023-06-07 20:38:49', NULL),
(8, 'PGL-12782381239', 3, 4, 26, 26, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 20:56:53', '2023-06-07 20:56:53', NULL),
(9, 'PGL-33382381239', 8, 2, 28, 28, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 21:34:29', '2023-06-07 21:34:29', NULL),
(10, 'PGL-89282381239', 7, 2, 29, 29, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 21:37:32', '2023-06-07 21:37:32', NULL),
(11, 'PGL-13482381239', 7, 2, 30, 30, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 21:39:10', '2023-06-07 21:39:10', NULL),
(12, 'PGL-77782381239', 7, 2, 31, 31, 'Dikembalikan', '2023-06-07', 3, '2023-06-07', '2023-06-07 21:42:19', '2023-06-07 21:42:19', NULL),
(13, 'PGL-98282381239', 9, 2, 34, 34, 'Dikembalikan', '2023-06-08', 3, '2023-06-08', '2023-06-08 07:52:03', '2023-06-08 07:52:03', NULL),
(14, 'PGL-96482381239', 9, 6, 35, 35, 'Dikembalikan', '2023-06-08', 3, '2023-06-08', '2023-06-08 00:58:30', '2023-06-08 00:58:30', NULL),
(15, 'PGL-2387893223', 8, 2, 36, 36, 'Dikembalikan', '2023-06-08', 3, '2023-06-08', '2023-06-08 08:28:13', '2023-06-08 08:28:13', NULL),
(16, 'PGL-74819de11336b', 6, 4, 37, 37, 'Dikembalikan', '2023-06-08', 3, '2023-06-08', '2023-06-08 01:30:50', '2023-06-08 01:30:50', NULL),
(17, 'PGL-64819de11340b', 8, 6, 38, 38, 'Dikembalikan', '2023-06-08', 3, '2023-06-08', '2023-06-08 09:22:41', '2023-06-08 09:22:41', NULL),
(18, 'PGL-FAC957216CD3', 9, 6, 39, 39, 'Dikembalikan', '2023-06-08', 3, '2023-06-08', '2023-06-08 09:28:22', '2023-06-08 09:28:22', NULL),
(19, 'PGL-63DE910CD001', 9, 2, 40, 40, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 13:14:26', '2023-06-09 13:14:26', NULL),
(20, 'PGL-C8A76089361D', 7, 6, 41, 41, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 19:50:00', '2023-06-09 19:50:00', NULL),
(21, 'PGL-5F882F1F61A2', 9, 6, 42, 42, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 19:57:06', '2023-06-09 19:57:06', NULL),
(22, 'PGL-E3A2995A1B74', 9, 6, 43, 43, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 19:58:21', '2023-06-09 19:58:21', NULL),
(23, 'PGL-F57F2C85E178', 8, 6, 44, 44, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 20:04:21', '2023-06-09 20:04:21', NULL),
(24, 'PGL-18E8BAD0C050', 6, 6, 45, 45, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 20:18:32', '2023-06-09 20:18:32', NULL),
(25, 'PGL-CB0DFEB88B83', 3, 6, 46, 46, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 20:20:00', '2023-06-09 20:20:00', NULL),
(26, 'PGL-CD4ABD177FC3', 3, 6, 47, 47, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 20:23:26', '2023-06-09 20:23:26', NULL),
(27, 'PGL-A4D2CB45B4AA', 9, 6, 48, 48, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 20:46:47', '2023-06-09 20:46:47', NULL),
(28, 'PGL-2103157B96DF', 9, 6, 49, 49, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 20:56:05', '2023-06-09 20:56:05', NULL),
(29, 'PGL-EE937942DF6F', 8, 6, 50, 50, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 21:01:33', '2023-06-09 21:01:33', NULL),
(31, 'PGL-1076EA9464F9', 9, 6, 51, 51, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 21:14:52', '2023-06-09 21:14:52', NULL),
(32, 'PGL-2744CB13A47F', 9, 6, 52, 52, 'Dikembalikan', '2023-06-09', 3, '2023-06-09', '2023-06-09 21:26:03', '2023-06-09 21:26:03', NULL),
(33, 'PGL-1180F7602A40', 8, 11, 53, 53, 'Dikembalikan', '2023-06-12', 3, '2023-06-12', '2023-06-12 22:56:40', '2023-06-12 22:56:40', NULL),
(34, 'PGL-18FAA523158F', 8, 8, 55, 55, 'Dikembalikan', '2023-06-12', 3, '2023-06-12', '2023-06-12 23:53:00', '2023-06-12 23:53:00', NULL),
(35, 'PGL-0A65759353AB', 6, 4, 59, 59, 'Dikembalikan', '2023-06-13', 1, '2023-06-13', '2023-06-13 00:05:12', '2023-06-13 00:05:12', NULL),
(36, 'PGL-73DB20A8132F', 3, 2, 61, 61, 'Dikembalikan', '2023-06-18', 3, '2023-06-13', '2023-06-18 14:22:22', '2023-06-18 14:22:22', NULL),
(37, 'PGL-10D1BAED4C4E', 8, 4, 62, 62, 'Dikembalikan', '2023-06-18', 3, '2023-06-18', '2023-06-18 14:22:27', '2023-06-18 14:22:27', NULL),
(38, 'PGL-0ECF98A6745C', 6, 2, 63, 63, 'Dikembalikan', '2023-06-18', 3, '2023-06-18', '2023-06-18 14:22:33', '2023-06-18 14:22:33', NULL),
(39, 'PGL-4BE696417FFA', 9, 3, 64, 64, 'Dikembalikan', '2023-06-18', 1, '2023-06-18', '2023-06-18 14:41:18', '2023-06-18 14:41:18', NULL),
(40, 'PGL-EDCF0500CBA8', 9, 4, 65, 65, 'Dikembalikan', '2023-06-18', 3, '2023-06-18', '2023-06-18 14:41:23', '2023-06-18 14:41:23', NULL),
(41, 'PGL-332F741F79AA', 9, 3, 67, 67, 'Dikembalikan', '2023-06-18', 3, '2023-06-18', '2023-06-18 15:09:45', '2023-06-18 15:09:45', NULL),
(42, 'PGL-ED0DF720977D', 9, 7, 66, 66, 'Dikembalikan', '2023-06-18', 1, '2023-06-18', '2023-06-18 15:10:05', '2023-06-18 15:10:05', NULL),
(43, 'PGL-D0265BA5E0FC', 6, 8, 69, 69, 'Dikembalikan', '2023-06-18', 1, '2023-06-18', '2023-06-18 15:17:55', '2023-06-18 15:17:55', NULL),
(44, 'PGL-FA9F13EC0F1F', 5, 7, 70, 70, 'Dikembalikan', '2023-06-18', 1, '2023-06-18', '2023-06-18 15:22:11', '2023-06-18 15:22:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pinjam` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `buku_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `harga_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `lama_pinjam` int(11) NOT NULL,
  `tgl_balik` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id`, `id_pinjam`, `user_id`, `buku_id`, `harga_id`, `status`, `denda`, `jml_pinjam`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'MGSL-09320932', 2, 1, 1, 'Dikembalikan', NULL, 2, '06-01-2023', 3, '06-03-2023', NULL, '2023-06-07 03:28:39', NULL),
(2, 'MGSL-1230219890', 11, 2, 1, 'Dikembalikan', NULL, 2, '06-01-2023', 3, '06-04-2023', NULL, '2023-06-07 03:52:21', NULL),
(3, 'MGSL-8E076FCAF2', 3, 3, 1, 'Dikembalikan', NULL, 3, '2023-06-02', 3, '2023-06-05', '2023-06-02 03:18:17', '2023-06-07 03:55:09', NULL),
(4, 'MGSL-AA92EAA93E', 3, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-02', 3, '2023-06-05', '2023-06-02 13:00:18', '2023-06-07 03:57:02', NULL),
(5, 'MGSL-6AFE4D2A9E', 4, 4, 0, 'Dikembalikan', NULL, 4, '2023-06-02', 4, '2023-06-06', '2023-06-02 13:04:24', '2023-06-07 03:57:09', NULL),
(6, 'MGSL-09F13E793F', 5, 1, 0, 'Dikembalikan', NULL, 3, '2023-06-02', 3, '2023-06-05', '2023-06-02 13:18:12', '2023-06-07 03:57:12', NULL),
(7, 'MGSL-DFE8167E21', 6, 2, 0, 'Dikembalikan', NULL, 2, '2023-06-02', 3, '2023-06-05', '2023-06-02 13:26:08', '2023-06-07 03:57:15', NULL),
(8, 'MGSL-3FC65E9C1C', 7, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-02', 3, '2023-06-05', '2023-06-02 15:14:46', '2023-06-07 03:57:17', NULL),
(9, 'MGSL-C2866AA419', 5, 4, 0, 'Dikembalikan', NULL, 3, '2023-06-04', 3, '2023-06-07', '2023-06-04 02:47:28', '2023-06-07 03:57:19', NULL),
(10, 'MGSL-228DA07554', 6, 1, 0, 'Dikembalikan', NULL, 1, '2023-06-04', 3, '2023-06-07', '2023-06-04 02:48:44', '2023-06-07 03:57:22', NULL),
(11, 'MGSL-07F61BBC1B', 7, 3, 0, 'Dikembalikan', NULL, 2, '2023-06-05', 3, '2023-06-08', '2023-06-05 11:04:07', '2023-06-07 03:57:24', NULL),
(12, 'MGSL-F97B48632C', 8, 4, 0, 'Dikembalikan', NULL, 2, '2023-06-06', 3, '2023-06-09', '2023-06-06 02:17:32', '2023-06-07 03:29:07', NULL),
(13, 'MGSL-67CB521CE2', 9, 5, 0, 'Dikembalikan', NULL, 1, '2023-06-07', 3, '2023-06-10', '2023-06-07 03:37:37', '2023-06-07 03:38:09', NULL),
(14, 'MGSL-E7B5F5EA4F', 9, 6, 0, 'Dikembalikan', NULL, 1, '2023-06-07', 3, '2023-06-10', '2023-06-07 03:41:32', '2023-06-07 03:41:45', NULL),
(15, 'MGSL-42165FA5B1', 9, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 03:45:11', '2023-06-07 03:45:18', NULL),
(16, 'MGSL-4F8033D8C3', 9, 4, 0, 'Dikembalikan', NULL, 1, '2023-06-07', 3, '2023-06-10', '2023-06-07 03:48:08', '2023-06-07 03:48:15', NULL),
(17, 'MGSL-80A52251A1', 1, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 04:11:00', '2023-06-07 04:11:26', NULL),
(18, 'MGSL-20B6D16389', 7, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 13:44:48', '2023-06-07 13:45:37', NULL),
(19, 'MGSL-CE337B11BE', 4, 6, 0, 'Dikembalikan', NULL, 1, '2023-06-07', 3, '2023-06-10', '2023-06-07 13:48:12', '2023-06-07 13:48:22', NULL),
(20, 'MGSL-F5C183F111', 7, 4, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 18:59:38', '2023-06-07 18:59:54', NULL),
(21, 'MGSL-97A0C7D0AE', 3, 2, 0, 'Dikembalikan', NULL, 1, '2023-06-07', 3, '2023-06-10', '2023-06-07 19:05:53', '2023-06-07 19:06:17', NULL),
(22, 'MGSL-0BFCE8F387', 8, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 19:15:31', '2023-06-07 19:16:55', NULL),
(23, 'MGSL-BE98543BEC', 5, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 19:36:21', '2023-06-07 19:36:44', NULL),
(24, 'MGSL-016C92565A', 5, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 20:06:26', '2023-06-07 20:06:45', NULL),
(25, 'MGSL-741CA971FD', 6, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 20:35:20', '2023-06-07 20:38:49', NULL),
(26, 'MGSL-A1FA13F45F', 3, 4, 0, 'Dikembalikan', NULL, 1, '2023-06-07', 3, '2023-06-10', '2023-06-07 20:56:45', '2023-06-07 20:56:53', NULL),
(27, 'MGSL-B824995809', 7, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 21:28:38', '2023-06-07 21:29:44', NULL),
(28, 'MGSL-2678617A20', 8, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 21:34:20', '2023-06-07 21:34:29', NULL),
(29, 'MGSL-FB986D4682', 7, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 21:37:25', '2023-06-07 21:37:32', NULL),
(30, 'MGSL-3A85914576', 7, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 21:39:00', '2023-06-07 21:39:10', NULL),
(31, 'MGSL-6BDB110A97', 7, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 21:42:04', '2023-06-07 21:42:19', NULL),
(32, 'MGSL-5AA0FDAADE', 9, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 21:51:25', '2023-06-07 21:51:34', NULL),
(33, 'MGSL-7FF66C8893', 9, 4, 0, 'Dikembalikan', NULL, 3, '2023-06-07', 3, '2023-06-10', '2023-06-07 21:52:48', '2023-06-07 21:52:58', NULL),
(34, 'MGSL-0491CD359E', 9, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-08', 3, '2023-06-11', '2023-06-08 00:49:37', '2023-06-08 00:49:47', NULL),
(35, 'MGSL-58A911BEA2', 9, 6, 0, 'Dikembalikan', NULL, 2, '2023-06-08', 3, '2023-06-11', '2023-06-08 00:55:12', '2023-06-08 00:58:30', NULL),
(36, 'MGSL-6B64070BB5', 8, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-08', 3, '2023-06-11', '2023-06-08 01:23:26', '2023-06-08 01:24:02', NULL),
(37, 'MGSL-2D4866BB5F', 6, 4, 0, 'Dikembalikan', NULL, 3, '2023-06-08', 3, '2023-06-11', '2023-06-08 01:30:42', '2023-06-08 01:30:50', NULL),
(38, 'MGSL-FB8F8D7145', 8, 6, 0, 'Dikembalikan', NULL, 1, '2023-06-08', 3, '2023-06-11', '2023-06-08 09:22:31', '2023-06-08 09:22:41', NULL),
(39, 'MGSL-F94885142E', 9, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-08', 3, '2023-06-11', '2023-06-08 09:28:13', '2023-06-08 09:28:22', NULL),
(40, 'MGSL-A91D87D61F', 9, 2, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 13:09:38', '2023-06-09 13:14:26', NULL),
(41, 'MGSL-181964672A', 7, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 19:46:28', '2023-06-09 19:50:00', NULL),
(42, 'MGSL-86A695131D', 9, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 19:50:19', '2023-06-09 19:57:06', NULL),
(43, 'MGSL-6F0DDF8011', 9, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 19:57:24', '2023-06-09 19:58:21', NULL),
(44, 'MGSL-1CFDF9D7C7', 8, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 19:58:47', '2023-06-09 20:04:21', NULL),
(45, 'MGSL-440C74BE55', 6, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 20:09:00', '2023-06-09 20:18:32', NULL),
(46, 'MGSL-FB81EBC9B3', 3, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 20:19:50', '2023-06-09 20:20:00', NULL),
(47, 'MGSL-75FE8F7A86', 3, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 20:23:07', '2023-06-09 20:23:26', NULL),
(48, 'MGSL-525DD117B8', 9, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 20:45:35', '2023-06-09 20:46:47', NULL),
(49, 'MGSL-5982B42C39', 9, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 20:55:54', '2023-06-09 20:56:05', NULL),
(50, 'MGSL-D398130F9E', 8, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 21:01:12', '2023-06-09 21:01:33', NULL),
(51, 'MGSL-981FBD5E93', 9, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 21:12:11', '2023-06-09 21:14:52', NULL),
(52, 'MGSL-6CB2565AD1', 9, 6, 0, 'Dikembalikan', NULL, 3, '2023-06-09', 3, '2023-06-12', '2023-06-09 21:25:13', '2023-06-09 21:26:03', NULL),
(53, 'MGSL-744DBD780C', 8, 11, 0, 'Dikembalikan', NULL, 1, '2023-06-12', 3, '2023-06-15', '2023-06-12 22:55:37', '2023-06-12 22:56:40', NULL),
(54, 'MGSL-9DF68572E4', 7, 7, 0, 'Sedang Di Pinjam', NULL, 1, '2023-06-12', 3, '2023-06-15', '2023-06-12 23:08:35', '2023-06-12 23:08:35', NULL),
(55, 'MGSL-A6A43542CF', 8, 8, 0, 'Dikembalikan', NULL, 1, '2023-06-12', 3, '2023-06-15', '2023-06-12 23:45:26', '2023-06-12 23:53:00', NULL),
(56, 'MGSL-7AF665980C', 7, 11, 0, 'Sedang Di Pinjam', NULL, 4, '2023-06-12', 1, '2023-06-13', '2023-06-12 23:59:46', '2023-06-12 23:59:46', NULL),
(57, 'MGSL-5D0187DFF8', 8, 7, 0, 'Sedang Di Pinjam', NULL, 3, '2023-06-13', 3, '2023-06-16', '2023-06-13 00:03:06', '2023-06-13 00:03:06', NULL),
(58, 'MGSL-FB65629ABC', 4, 7, 0, 'Sedang Di Pinjam', NULL, 3, '2023-06-13', 1, '2023-06-14', '2023-06-13 00:04:16', '2023-06-13 00:04:16', NULL),
(59, 'MGSL-89AA733C31', 6, 4, 0, 'Dikembalikan', NULL, 3, '2023-06-13', 1, '2023-06-14', '2023-06-13 00:05:05', '2023-06-13 00:05:12', NULL),
(60, 'MGSL-8554CBB014', 6, 7, 0, 'Sedang Di Pinjam', NULL, 3, '2023-06-13', 1, '2023-06-14', '2023-06-13 00:05:28', '2023-06-13 00:05:28', NULL),
(61, 'MGSL-CBBB13BDE7', 3, 2, 0, 'Dikembalikan', NULL, 1, '2023-06-13', 3, '2023-06-16', '2023-06-13 00:13:49', '2023-06-18 14:22:22', NULL),
(62, 'MGSL-01DE3E94B6', 8, 4, 0, 'Dikembalikan', NULL, 1, '2023-06-18', 3, '2023-06-21', '2023-06-18 14:17:32', '2023-06-18 14:22:27', NULL),
(63, 'MGSL-5F025AFC05', 6, 2, 0, 'Dikembalikan', NULL, 1, '2023-06-18', 3, '2023-06-21', '2023-06-18 14:20:59', '2023-06-18 14:22:33', NULL),
(64, 'MGSL-4F39355A12', 9, 3, 0, 'Dikembalikan', NULL, 1, '2023-06-18', 1, '2023-06-19', '2023-06-18 14:23:12', '2023-06-18 14:41:18', NULL),
(65, 'MGSL-30281F538A', 9, 4, 0, 'Dikembalikan', NULL, 1, '2023-06-18', 3, '2023-06-21', '2023-06-18 14:36:02', '2023-06-18 14:41:23', NULL),
(66, 'MGSL-97A0D60260', 9, 7, 0, 'Dikembalikan', NULL, 1, '2023-06-18', 1, '2023-06-19', '2023-06-18 14:48:06', '2023-06-18 15:10:05', NULL),
(67, 'MGSL-719AC2F84F', 9, 3, 0, 'Dikembalikan', NULL, 1, '2023-06-18', 3, '2023-06-21', '2023-06-18 15:06:55', '2023-06-18 15:09:45', NULL),
(68, 'MGSL-364675AFAB', 9, 7, 0, 'Sedang Di Pinjam', NULL, 1, '2023-06-18', 1, '2023-06-19', '2023-06-18 15:10:18', '2023-06-18 15:10:18', NULL),
(69, 'MGSL-AD657FE1A9', 6, 8, 0, 'Dikembalikan', NULL, 1, '2023-06-18', 1, '2023-06-19', '2023-06-18 15:17:11', '2023-06-18 15:17:55', NULL),
(70, 'MGSL-256124E73A', 5, 7, 0, 'Dikembalikan', NULL, 1, '2023-06-18', 1, '2023-06-19', '2023-06-18 15:18:14', '2023-06-18 15:22:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_rak` varchar(255) NOT NULL,
  `buku_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_rak`
--

INSERT INTO `tbl_rak` (`id`, `nama_rak`, `buku_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Rak Buku 1', 1, '2023-03-06 19:42:31', NULL, NULL),
(2, 'Rak Buku 2', 5, '2023-05-28 10:08:49', '2023-05-28 10:08:49', NULL),
(3, 'Rak 3', 6, '2023-05-31 14:27:20', '2023-06-12 00:27:50', NULL),
(9, 'Rak 4', 0, '2023-06-12 22:50:44', '2023-06-12 22:50:44', NULL),
(10, 'Rak 5', 0, '2023-06-13 00:25:06', '2023-06-13 00:25:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `anggota` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `tgl_bergabung` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.svg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Online',
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `anggota`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenkel`, `alamat`, `telepon`, `tgl_bergabung`, `foto`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'lexynotfound@gmail.com', 'riri23', 'AG0001', 'Riri Riskya', 'Jakarta', '2001-11-27', 'Perempuan', 'Jl. Raya Joglo', '081342685644', '27 Oktober 2022', 'default.svg', '$2y$10$vnhRbGsJ6Tcjy4E/7TvM9.7LKai9PB4MIhs8CVjco4KzMd6rg/pq2', NULL, '2023-05-01 10:07:11', NULL, NULL, 'Aktif', NULL, 1, 0, '2023-04-18 18:41:46', '2023-06-13 00:40:29', NULL),
(2, 'iodjnawiodnawoi@gmail.com', 'galangkun', 'AG0002', 'Eka Galang Pratama', '', '1998-02-02', 'Laki-laki', 'Jl. Taman Anggrek', '081295304697', '', '1684747457_0472cae83108eb26d95d.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-22 09:24:17', '2023-06-13 00:34:40', NULL),
(3, 'oidnawodih2@gmail.com', 'ahmadsanusi', 'AG0003', 'Ahmad Sanusi Fajri', '', '1997-04-05', 'Laki-laki', 'Jl. Jakarta Barat, Rawa Buaya', '081295304698', '', '1684747616_1211165c2f207ec17f28.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-22 09:26:56', '2023-05-25 04:39:46', NULL),
(4, 'odianwdoiawn@gmail.com', 'oidnawoidn2o', 'AG0004', 'i1hj2do12ndion', '', '1998-02-02', 'Laki-Laki', 'iodawhdoawndo2n', '081295304698', '', '1684747982_59315dff52a473d92361.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-22 09:33:02', '2023-05-22 09:33:02', NULL),
(5, 'oidnawlsdnlas@gmail.com', 'oidnaodansl', 'AG0005', 'oindawokdnaklsndio', '', '1998-02-02', 'Laki-Laki', 'oidnawdoawno', '081295304698', '', '1684751027_23bc375af2c7f9b640b8.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-22 10:23:47', '2023-05-22 10:23:47', NULL),
(6, 'nmdoakndioasndaso2@gmail.com', 'iodanwdokansodkn', 'AG0006', 'dioawmndksndioasn', '', '1998-02-02', 'Laki-Laki', 'odnaodnasodnasion', '081295304698', '', '1684751603_9c4ad1fa6b4df86aedd9.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-22 10:33:23', '2023-05-22 10:33:23', NULL),
(7, 'oidnawoidn2oiqdn@gmail.com', 'oidnawodno1i2no34', 'AG0007', 'iodnawkldn12iound1', '', '1998-02-02', 'Laki-Laki', 'iohdnawodn3aoh', '081295304698', '', '1684783601_2a71e1d8c8730986b695.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-22 19:26:41', '2023-05-22 19:26:41', NULL),
(8, 'iopdjqo1pn2ei1n2@gmail.com', 'oidnawodn2oen12o', 'AG0008', 'iodn1qdionawodn2on312', '', '1998-02-02', 'Laki-Laki', 'oidnawoidnawon', '081295304698', '', '1684783904_c4304f1b139833bb0b10.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-22 19:31:44', '2023-05-22 19:31:44', NULL),
(9, 'ndoiawnd2iono@gmail.com', 'oi12n3o12nd', 'AG0009', 'idj12odnaod', '', '1997-02-02', 'Laki-Laki', 'odnawodnawon', '081295304698', '', '1684784332_609b17398df5fcc2f878.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-22 19:38:52', '2023-05-22 19:38:52', NULL),
(10, 'kldnawkldaw@gmail.com', 'dawdawd', 'AG0010', 'dawdwa', '', '1998-02-02', 'Laki-Laki', 'kjdnawkjdnwakjb', '081295304698', '', '1684947909_c918de5e5fffc2aec6a8.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-24 17:05:09', '2023-05-24 17:05:09', NULL),
(11, 'kjdnawwkjdnaw@gmail.com', 'dawnkjdawn', 'AG0011', 'kdnawjdknawk', '', '1998-02-02', 'Laki-Laki', 'kdnawkdnawkjdn', '081295304698', '', '1684989987_0e3b50af160e1891120b.png', '', NULL, NULL, NULL, NULL, 'Online', NULL, 0, 0, '2023-05-25 04:46:27', '2023-05-25 04:46:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `group_id_user_id` (`group_id`,`user_id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_biaya_denda`
--
ALTER TABLE `tbl_biaya_denda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`kategori_id`),
  ADD KEY `id_rak` (`rak_id`);

--
-- Indexes for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjam_id` (`pinjam_id`),
  ADD KEY `biaya_id` (`biaya_id`),
  ADD KEY `tbl_denda_user_id_foreign` (`user_id`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laporan_pinjam_id` (`pinjam_id`),
  ADD KEY `fk_laporan_buku_id` (`buku_id`);

--
-- Indexes for table `tbl_laporan_buku`
--
ALTER TABLE `tbl_laporan_buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_laporan_buku_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `tbl_laporan_denda`
--
ALTER TABLE `tbl_laporan_denda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_laporan_denda_denda_id_foreign_key_tbl_denda` (`denda_id`);

--
-- Indexes for table `tbl_laporan_pengembalian`
--
ALTER TABLE `tbl_laporan_pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laporan_pengembalian_pengembalian_id` (`pengembalian_id`);

--
-- Indexes for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_pengembalian_pinjam_id_foreign` (`pinjam_id`),
  ADD KEY `tbl_pengembalian_denda_id_foreign` (`denda_id`),
  ADD KEY `tbl_pengembalian_buku_id_foreign` (`buku_id`),
  ADD KEY `tbl_pengembalian_user_id_foreign` (`user_id`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_id` (`user_id`),
  ADD KEY `tbl_pinjam_harga_id_foreign` (`harga_id`),
  ADD KEY `tbl_pinjam_buku_id_fk` (`buku_id`);

--
-- Indexes for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `anggota` (`anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_biaya_denda`
--
ALTER TABLE `tbl_biaya_denda`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_laporan_buku`
--
ALTER TABLE `tbl_laporan_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_laporan_denda`
--
ALTER TABLE `tbl_laporan_denda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_laporan_pengembalian`
--
ALTER TABLE `tbl_laporan_pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD CONSTRAINT `tbl_buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `tbl_kategori` (`id`),
  ADD CONSTRAINT `tbl_buku_rak_id_foreign` FOREIGN KEY (`rak_id`) REFERENCES `tbl_rak` (`id`);

--
-- Constraints for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  ADD CONSTRAINT `tbl_denda_biaya_id_foreign` FOREIGN KEY (`biaya_id`) REFERENCES `tbl_biaya_denda` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_denda_pinjam_id_foreign` FOREIGN KEY (`pinjam_id`) REFERENCES `tbl_pinjam` (`id`),
  ADD CONSTRAINT `tbl_denda_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD CONSTRAINT `fk_laporan_buku_id` FOREIGN KEY (`buku_id`) REFERENCES `tbl_buku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_laporan_pinjam_id` FOREIGN KEY (`pinjam_id`) REFERENCES `tbl_pinjam` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_laporan_buku`
--
ALTER TABLE `tbl_laporan_buku`
  ADD CONSTRAINT `tbl_laporan_buku_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `tbl_buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_laporan_denda`
--
ALTER TABLE `tbl_laporan_denda`
  ADD CONSTRAINT `tbl_laporan_denda_denda_id_foreign_key_tbl_denda` FOREIGN KEY (`denda_id`) REFERENCES `tbl_denda` (`id`);

--
-- Constraints for table `tbl_laporan_pengembalian`
--
ALTER TABLE `tbl_laporan_pengembalian`
  ADD CONSTRAINT `fk_laporan_pengembalian_pengembalian_id` FOREIGN KEY (`pengembalian_id`) REFERENCES `tbl_pengembalian` (`id`);

--
-- Constraints for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD CONSTRAINT `tbl_pengembalian_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `tbl_buku` (`id`),
  ADD CONSTRAINT `tbl_pengembalian_denda_id_foreign` FOREIGN KEY (`denda_id`) REFERENCES `tbl_denda` (`id`),
  ADD CONSTRAINT `tbl_pengembalian_pinjam_id_foreign` FOREIGN KEY (`pinjam_id`) REFERENCES `tbl_pinjam` (`id`),
  ADD CONSTRAINT `tbl_pengembalian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD CONSTRAINT `tbl_pinjam_buku_id_fk` FOREIGN KEY (`buku_id`) REFERENCES `tbl_buku` (`id`),
  ADD CONSTRAINT `tbl_pinjam_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
