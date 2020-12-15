-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 01:53 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hours`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `remember_token`, `parent_id`, `type`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$zIudUmhL41T2MUBXjyymxuzIAlGXs610HWt0KgxQcPt43lJMKuXOi', NULL, 0, NULL, 0, '2020-11-26 02:44:22', '2020-11-26 02:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_img` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `author` int(11) DEFAULT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`id`, `title`, `slug`, `post_type`, `featured_img`, `org`, `org_name`, `description`, `author`, `start_datetime`, `end_datetime`, `status`, `is_softdel`, `created_at`, `updated_at`) VALUES
(1, 'Auction2', 'auction2', 'horse', '16074316295fcf75cd01ae6.jpeg', '16063768485fbf5d90b9f5f.png', 'BE MINE by Brantzau / Taloubet Z', '<p>Mount St John Stud (MSJ) offers it&rsquo;s first online auction of 13 Dressage Broodmares and embryos pregnant in recipient mares. MSJ is renowned for it&rsquo;s&nbsp; world class damlines focusing on sport with a high proportion of embryo transfer. This auction includes a selection of some of the most exciting dressage damline..</p>', 1, '2020-12-01 07:47:13', '2020-12-31 07:47:16', 'on', 'no', '2020-11-26 02:47:28', '2020-12-08 07:47:09'),
(2, 'Auction1', 'auction1', 'horse', '16074316085fcf75b813546.jpeg', '16064721725fc0d1ec05840.png', 'BE MINE by Brantzau / Taloubet Z', '<p>Mount St John Stud (MSJ) offers it&rsquo;s first online auction of 13 Dressage Broodmares and embryos pregnant in recipient mares. MSJ is renowned for it&rsquo;s&nbsp; world class damlines focusing...</p>', 1, '2020-12-01 10:15:31', '2020-12-31 09:00:34', 'on', 'no', '2020-11-27 05:16:12', '2020-12-08 07:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `auctionsbidding`
--

CREATE TABLE `auctionsbidding` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ac_parent_id` int(11) NOT NULL,
  `ac_parent_child_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `bdatetime` datetime NOT NULL,
  `win` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `sold` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auctionsbidding`
--

INSERT INTO `auctionsbidding` (`id`, `ac_parent_id`, `ac_parent_child_id`, `user_id`, `amount`, `bdatetime`, `win`, `status`, `sold`, `is_softdel`, `created_at`, `updated_at`) VALUES
(23, 1, 3, 2, 2300, '2020-12-10 10:24:16', 'off', 'on', 'off', 'no', '2020-12-10 20:24:17', '2020-12-10 20:24:17'),
(24, 1, 3, 2, 2600, '2020-12-10 10:25:15', 'off', 'on', 'off', 'no', '2020-12-10 20:25:17', '2020-12-10 20:25:17'),
(25, 2, 2, 2, 2300, '2020-12-10 10:25:39', 'off', 'on', 'off', 'no', '2020-12-10 20:25:41', '2020-12-10 20:25:41'),
(26, 2, 1, 2, 3499, '2020-12-10 10:26:04', 'off', 'on', 'off', 'no', '2020-12-10 20:26:06', '2020-12-10 20:26:06'),
(27, 1, 4, 2, 7887, '2020-12-10 10:26:29', 'off', 'on', 'off', 'no', '2020-12-10 20:26:31', '2020-12-10 20:26:31'),
(28, 1, 3, 2, 2900, '2020-12-10 11:33:19', 'off', 'on', 'off', 'no', '2020-12-10 21:33:21', '2020-12-10 21:33:21'),
(29, 1, 3, 2, 3200, '2020-12-10 11:44:45', 'off', 'on', 'off', 'no', '2020-12-10 21:44:47', '2020-12-10 21:44:47'),
(30, 1, 4, 2, 8187, '2020-12-10 15:55:53', 'off', 'on', 'off', 'no', '2020-12-11 01:55:55', '2020-12-11 01:55:55'),
(31, 2, 2, 2, 2600, '2020-12-11 12:53:42', 'off', 'on', 'off', 'no', '2020-12-11 22:53:44', '2020-12-11 22:53:44'),
(32, 2, 1, 2, 3799, '2020-12-11 14:07:39', 'off', 'on', 'off', 'no', '2020-12-12 00:07:41', '2020-12-12 00:07:41'),
(33, 2, 2, 2, 2900, '2020-12-11 14:08:04', 'off', 'on', 'off', 'no', '2020-12-12 00:08:06', '2020-12-12 00:08:06'),
(34, 1, 3, 2, 3500, '2020-12-11 14:08:57', 'off', 'on', 'off', 'no', '2020-12-12 00:08:59', '2020-12-12 00:08:59'),
(35, 1, 4, 2, 8487, '2020-12-11 14:09:24', 'off', 'on', 'off', 'no', '2020-12-12 00:09:26', '2020-12-12 00:09:26'),
(36, 1, 4, 2, 8787, '2020-12-11 14:10:50', 'off', 'on', 'off', 'no', '2020-12-12 00:10:52', '2020-12-12 00:10:52'),
(37, 1, 3, 6, 3800, '2020-12-11 14:15:37', 'off', 'on', 'off', 'no', '2020-12-12 00:15:38', '2020-12-12 00:15:38'),
(38, 2, 1, 7, 4099, '2020-12-11 14:18:53', 'off', 'on', 'off', 'no', '2020-12-12 02:18:57', '2020-12-12 02:18:57'),
(39, 1, 4, 2, 9087, '2020-12-12 15:37:23', 'off', 'on', 'off', 'no', '2020-12-13 01:37:24', '2020-12-13 01:37:24'),
(40, 2, 2, 2, 3200, '2020-12-12 15:38:23', 'off', 'on', 'off', 'no', '2020-12-13 01:38:24', '2020-12-13 01:38:24'),
(41, 2, 1, 7, 4399, '2020-12-12 16:22:52', 'off', 'on', 'off', 'no', '2020-12-12 21:22:53', '2020-12-12 21:22:53'),
(42, 2, 2, 4, 3500, '2020-12-13 22:58:17', 'off', 'on', 'off', 'no', '2020-12-14 10:58:19', '2020-12-14 10:58:19'),
(43, 1, 3, 2, 4100, '2020-12-14 05:43:20', 'off', 'on', 'off', 'no', '2020-12-14 15:43:30', '2020-12-14 15:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `auctionschildposts`
--

CREATE TABLE `auctionschildposts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ac_parent_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_price` double NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` longtext COLLATE utf8mb4_unicode_ci,
  `upload_video` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auctionschildposts`
--

INSERT INTO `auctionschildposts` (`id`, `ac_parent_id`, `user_id`, `title`, `start_price`, `slug`, `post_type`, `gallery`, `upload_video`, `video_link`, `description`, `start_datetime`, `end_datetime`, `status`, `is_softdel`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Horse 1', 2000, 'horse_1', 'horse', '16074314275fcf7503b41fe.jpeg', '16074321095fcf77add632f.mp4', NULL, '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', '2020-12-02 12:42:42', '2020-12-30 12:42:45', 'on', 'no', '2020-11-26 02:49:06', '2020-12-08 07:57:21'),
(2, 2, 1, 'Horse 2', 2000, 'horse_2', 'horse', '16075810445fd1bd744cb10.jpeg', '16074320795fcf778f2a39e.mp4', NULL, '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', '2020-12-02 12:45:05', '2020-12-29 12:45:08', 'on', 'no', '2020-11-26 02:49:06', '2020-12-10 11:17:24'),
(3, 1, 1, 'Horse 1', 2000, 'horse_1', 'horse', '16075811405fd1bdd40e1a0.jpeg', '16075810965fd1bda86c21d.mp4', NULL, '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', '2020-12-02 12:45:05', '2020-12-29 12:45:08', 'on', 'no', '2020-11-26 02:49:06', '2020-12-10 11:19:00'),
(4, 1, 1, 'Horse 2', 2000, 'horse_2', 'horse', '16074318985fcf76daa40e1.jpeg', '16074320075fcf7747c82db.mp4', NULL, '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', '2020-12-02 12:45:05', '2020-12-29 12:45:08', 'on', 'no', '2020-11-26 02:49:06', '2020-12-08 07:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `auctionscomments`
--

CREATE TABLE `auctionscomments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ac_parent_id` int(11) NOT NULL,
  `ac_parent_child_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biddingconditions`
--

CREATE TABLE `biddingconditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ac_parent_id` int(11) DEFAULT NULL,
  `ac_parent_child_id` int(11) NOT NULL,
  `inc_amount` double NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biddingconditions`
--

INSERT INTO `biddingconditions` (`id`, `ac_parent_id`, `ac_parent_child_id`, `inc_amount`, `status`, `is_softdel`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 300, 'on', 'no', '2020-11-26 03:22:15', '2020-12-08 07:57:22'),
(2, 1, 4, 300, 'on', 'no', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(3, 2, 2, 300, 'on', 'no', '2020-12-08 07:52:26', '2020-12-10 11:17:24'),
(4, 1, 3, 300, 'on', 'no', '2020-12-08 07:52:51', '2020-12-10 11:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `create_datetime` datetime NOT NULL,
  `is_agree` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `phone`, `description`, `create_datetime`, `is_agree`, `status`, `is_softdel`, `created_at`, `updated_at`) VALUES
(1, 'faisal abbas', 'faisalsehar786@gmail.com', 'test', '+10478600056', 'pla', '2020-12-10 10:28:59', 'yes', 'off', 'no', '2020-12-10 15:29:00', '2020-12-10 15:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_class` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeholder` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `name`, `slug`, `css_class`, `placeholder`, `required`, `css_id`, `post_type`, `field_type`, `status`, `is_softdel`, `created_at`, `updated_at`) VALUES
(1, 'Age', 'age', 'age', 'e.g 1.5', 'required', 'age', 'horse', 'number', 'on', 'no', '2020-11-26 02:55:53', '2020-11-26 02:55:53'),
(2, 'Is Ridden', 'is_ridden', NULL, NULL, 'required', NULL, 'horse', 'isridden', 'on', 'no', '2020-11-26 02:56:13', '2020-11-26 02:56:13'),
(3, 'GENDER', 'gender', 'gender', 'e.g Stallion', 'required', 'gender', 'horse', 'gender', 'on', 'no', '2020-11-26 03:00:12', '2020-12-08 04:46:08'),
(4, 'BORN', 'born', 'born', NULL, 'required', 'born', 'horse', 'text', 'on', 'no', '2020-11-26 03:01:19', '2020-11-26 03:01:19'),
(5, 'SIZE', 'size', 'size', 'e.g 16.1 ¾ h.h', 'required', 'size', 'horse', 'text', 'on', 'no', '2020-11-26 03:02:25', '2020-11-26 03:02:25'),
(6, 'COLOR', 'color', 'color', 'e.g Red', 'required', 'color', 'horse', 'text', 'on', 'no', '2020-11-26 03:03:06', '2020-11-26 03:03:06'),
(7, 'BREED', 'breed', 'breed', 'e.g  Hannoveraner', 'required', 'breed', 'horse', 'text', 'on', 'no', '2020-11-26 03:03:58', '2020-11-26 03:03:58'),
(8, 'OWNER', 'owner', 'owner', 'e.g Marvin Klausing 49356 Diepholz', 'required', 'owner', 'horse', 'text', 'on', 'no', '2020-11-26 03:05:13', '2020-11-26 03:05:13'),
(9, 'BREEDER', 'breeder', 'breeder', 'e.g Helmut Wähling Hamburg', 'required', 'breeder', 'horse', 'text', 'on', 'no', '2020-11-26 03:06:09', '2020-11-26 03:06:09'),
(10, 'VALUE ADDED TAX RATE', 'value_added_tax_rate', 'value_added_tax_rate', 'e.g 0%', 'required', 'value_added_tax_rate', 'horse', 'number', 'on', 'no', '2020-11-26 03:06:52', '2020-11-26 03:06:52'),
(11, 'VETERINARY DOCUMENTS', 'veterinary_documents', 'veterinary_documents', 'doc Or pdf', 'no', 'veterinary_documents', 'horse', 'file', 'on', 'no', '2020-11-26 03:07:50', '2020-11-26 03:07:50'),
(12, 'AUCTION TERMS', 'auction_terms', 'auction_terms', 'doc Or pdf', 'no', 'auction_terms', 'horse', 'file', 'on', 'no', '2020-11-26 03:08:26', '2020-11-26 03:08:26'),
(13, 'Dam By', 'dam_by', 'dam_by', 'e.g Hohenstein/T.', 'required', 'dam_by', 'horse', 'text', 'on', 'no', '2020-11-26 03:10:02', '2020-11-26 03:10:02'),
(14, 'Sire', 'sire', 'sire', 'e.g Cornet Obolensky', 'required', 'sire', 'horse', 'text', 'on', 'no', '2020-11-26 07:16:24', '2020-11-26 07:16:24'),
(15, 'Life ID', 'life_id', 'life_id', 'DE 431310686318', 'required', 'life_id', 'horse', 'text', 'on', 'no', '2020-12-04 15:37:34', '2020-12-04 15:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `address2` longtext COLLATE utf8mb4_unicode_ci,
  `phone` longtext COLLATE utf8mb4_unicode_ci,
  `howtoBid` longtext COLLATE utf8mb4_unicode_ci,
  `howtoBidimg` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`id`, `address`, `address2`, `phone`, `howtoBid`, `howtoBidimg`, `created_at`, `updated_at`) VALUES
(1, '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.&nbsp;</p>', '<p>8897573875</p>', NULL, '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', NULL, NULL, '2020-12-08 19:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_16_194401_create_admin_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_10_15_062627_roles', 1),
(6, '2019_10_15_062707_roles_authorities', 1),
(7, '2019_10_15_062734_roles_subauthorities', 1),
(8, '2020_10_28_071057_custom__fields', 1),
(9, '2020_10_28_071130_auctions', 1),
(10, '2020_10_28_071347_auctions_child_posts', 1),
(11, '2020_10_28_071529_posts_meta', 1),
(12, '2020_10_28_071700_auctions_bidding', 1),
(13, '2020_10_28_071734_auctions_comments', 1),
(14, '2020_10_28_072035_payment_meta', 1),
(15, '2020_11_04_071505_posts', 1),
(16, '2020_11_11_084625_bidding_conditions', 1),
(17, '2020_11_12_060851_news', 1),
(18, '2020_11_12_114222_subscriber', 1),
(19, '2020_11_13_065708_contacts', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_img` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `author` int(11) DEFAULT NULL,
  `create_datetime` datetime NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `post_type`, `featured_img`, `org_name`, `description`, `author`, `create_datetime`, `status`, `is_softdel`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'lorem_ipsum_is_placeholder_text_commonly_used_in_the_graphic_print_and_publishing_industries_for_previewing_layouts_and_visual_mockups', 'news', '1606473047.jpg', 'BE MINE by Brantzau / Taloubet Z', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', 1, '2020-11-27 10:30:39', 'on', 'no', '2020-11-27 05:30:47', '2020-11-27 05:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmeta`
--

CREATE TABLE `paymentmeta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ac_parent_id` int(11) NOT NULL,
  `ac_parent_child_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `payment_method` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tid` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_type`, `is_softdel`, `created_at`, `updated_at`) VALUES
(1, 'horse', 'no', '2020-11-26 02:46:13', '2020-11-26 02:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `postsmeta`
--

CREATE TABLE `postsmeta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `meta_key` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  `post_type` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_type` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postsmeta`
--

INSERT INTO `postsmeta` (`id`, `post_id`, `meta_key`, `meta_value`, `post_type`, `field_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'age', '3', 'horse', 'number', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:21'),
(2, 1, 'is_ridden', 'yes', 'horse', 'isridden', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:21'),
(3, 1, 'gender', 'male', 'horse', 'gender', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:21'),
(4, 1, 'born', '2020-11-10', 'horse', 'text', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:21'),
(5, 1, 'size', '16.1', 'horse', 'text', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:21'),
(6, 1, 'color', 'black', 'horse', 'text', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:21'),
(7, 1, 'breed', 'Arabian', 'horse', 'text', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:22'),
(8, 1, 'owner', 'jhon', 'horse', 'text', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:22'),
(9, 1, 'breeder', 'test', 'horse', 'text', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:22'),
(10, 1, 'value_added_tax_rate', '0', 'horse', 'number', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:22'),
(11, 1, 'veterinary_documents', '16074314275fcf7503e85b3.docx', 'horse', 'file', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:22'),
(12, 1, 'auction_terms', NULL, 'horse', 'file', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:22'),
(13, 1, 'dam_by', 'test', 'horse', 'text', 'on', '2020-11-26 03:22:15', '2020-12-08 07:57:22'),
(14, 1, 'sire', 'Cornet Obolensky', 'horse', 'text', 'on', '2020-11-26 07:16:48', '2020-12-08 07:57:22'),
(15, 1, 'life_id', 'DE 431310686318', 'horse', 'text', 'on', '2020-12-04 06:19:34', '2020-12-08 07:57:22'),
(16, 2, 'age', '4', 'horse', 'number', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(17, 2, 'is_ridden', 'yes', 'horse', 'isridden', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(18, 2, 'gender', 'male', 'horse', 'gender', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(19, 2, 'born', '2020-12-16', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(20, 2, 'size', '16.1', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(21, 2, 'color', 'black', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(22, 2, 'breed', 'Arabian', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(23, 2, 'owner', 'jhon', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(24, 2, 'breeder', 'test', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(25, 2, 'value_added_tax_rate', '9', 'horse', 'number', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(26, 2, 'veterinary_documents', '16074315315fcf756bafc6d.docx', 'horse', 'file', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(27, 2, 'auction_terms', NULL, 'horse', 'file', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(28, 2, 'dam_by', 'Roh', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(29, 2, 'sire', 'Bon Crue', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(30, 2, 'life_id', 'DE 431310686318', 'horse', 'text', 'on', '2020-12-08 01:27:12', '2020-12-10 11:17:24'),
(31, 3, 'age', '3', 'horse', 'number', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(32, 3, 'is_ridden', 'yes', 'horse', 'isridden', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(33, 3, 'gender', 'male', 'horse', 'gender', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(34, 3, 'born', '2020-12-12', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(35, 3, 'size', '16.1', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(36, 3, 'color', 'black', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(37, 3, 'breed', 'Arabian', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(38, 3, 'owner', 'jhon', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(39, 3, 'breeder', 'test', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(40, 3, 'value_added_tax_rate', '0', 'horse', 'number', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(41, 3, 'veterinary_documents', '16074317785fcf7662b1193.pdf', 'horse', 'file', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(42, 3, 'auction_terms', NULL, 'horse', 'file', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(43, 3, 'dam_by', 'Roh', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(44, 3, 'sire', 'Bon Crue', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(45, 3, 'life_id', 'DE 431310686318', 'horse', 'text', 'on', '2020-12-08 07:49:38', '2020-12-10 11:19:00'),
(46, 4, 'age', '4', 'horse', 'number', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(47, 4, 'is_ridden', 'yes', 'horse', 'isridden', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(48, 4, 'gender', 'male', 'horse', 'gender', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(49, 4, 'born', '2020-12-05', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(50, 4, 'size', '16.1', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(51, 4, 'color', 'black', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(52, 4, 'breed', 'Arabian', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(53, 4, 'owner', 'jhon', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(54, 4, 'breeder', 'test', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(55, 4, 'value_added_tax_rate', '0', 'horse', 'number', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(56, 4, 'veterinary_documents', '16074318985fcf76dad199d.pdf', 'horse', 'file', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(57, 4, 'auction_terms', NULL, 'horse', 'file', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(58, 4, 'dam_by', 'Roh', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(59, 4, 'sire', 'Bon Crue', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20'),
(60, 4, 'life_id', 'DE 431310686318', 'horse', 'text', 'on', '2020-12-08 07:51:38', '2020-12-08 07:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Seller', 1, 0, '2020-11-26 02:44:22', '2020-12-08 01:22:50'),
(2, 'Buyer', 1, 1, '2020-11-26 02:44:22', '2020-11-26 02:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `rolesauthorities`
--

CREATE TABLE `rolesauthorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `authority` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected_ids` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rolesubauthorities`
--

CREATE TABLE `rolesubauthorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_authority_id` int(11) NOT NULL,
  `authority` tinyint(1) NOT NULL DEFAULT '0',
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `create_datetime` datetime NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `is_softdel` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `description`, `create_datetime`, `status`, `is_softdel`, `created_at`, `updated_at`) VALUES
(1, 'faisalsehar786@gmail.com', NULL, '2020-12-10 10:28:15', 'off', 'no', '2020-12-10 15:28:16', '2020-12-10 15:28:16'),
(2, 'veronika.duarte@gmail.com', NULL, '2020-12-12 19:09:29', 'off', 'no', '2020-12-13 00:09:28', '2020-12-13 00:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `business_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_number` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `fname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `parent_id`, `business_name`, `vat_number`, `image`, `country`, `address`, `type`, `phone`, `terms`, `role_id`, `fname`, `cname`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'faisal abbas', 'faisalsehar786@gmail.com', '2020-11-26 03:57:36', '$2y$10$jZmr63AR6uoQxWxOzq74sONhfSkTDI7BQkLJF9EHzxcbz9OcH2GkK', 0, 'property', 'b495892384', '16063859695fbf8131c0259.jpg', 'Pakistan', 'islamabd', NULL, '+10478600056', 'off', 2, 'khan', 'sbs', NULL, '2020-11-26 03:57:05', '2020-12-14 07:52:33'),
(3, 'faheem kiani', 'faheemkian14@gmail.com', NULL, '$2y$10$T3R/RI1.RJDczX5BT.W9TOiJB3FYtv/e.fcJ0sgKaA5HZq3iPbD5i', 0, NULL, NULL, NULL, 'Pakistan', 'islamabd', NULL, NULL, 'off', 2, NULL, NULL, NULL, '2020-12-08 03:32:16', '2020-12-08 03:32:16'),
(4, 'Paulo', 'alfouvar@gmail.com', '2020-12-09 21:24:29', '$2y$10$Zl01CmODZ.fQZsgwGO6ZWO8EzNO31XPmFZD4kWJEoftlnOYxYF.Ry', 0, NULL, '12345678', NULL, 'Indonesia', 'Bogor', NULL, NULL, 'off', 2, NULL, NULL, NULL, '2020-12-09 18:59:35', '2020-12-09 21:24:29'),
(5, 'TANZEEL UL REHMAN', 'tanzeelbutt66@gmail.com', '2020-12-09 21:46:07', '$2y$10$whQgg/7Gs8FwyExif5F4D.Nk4zJIwfbfeAhnyhGIpBiPiZlKV4o8e', 0, NULL, 'kv233869', NULL, 'Pakistan', 'Materials Research Lab., Department of Physics, Faculty of Basic and Applied Sciences, International Islamic University Islamabad, Pakistan', NULL, NULL, 'off', 2, NULL, NULL, NULL, '2020-12-09 21:45:38', '2020-12-09 21:46:07'),
(6, 'amir', 'amirshahzad86@gmail.com', '2020-12-11 19:14:38', '$2y$10$dOSukDmzDPzy53aMC2iAz.ZbNKMmTIvPMZv4P5zcIKElGdagEc11e', 0, NULL, NULL, NULL, 'Pakistan', '3587', NULL, NULL, 'off', 2, NULL, NULL, NULL, '2020-12-11 19:14:27', '2020-12-11 19:14:38'),
(7, 'JP22', 'paulo.duarte888@gmail.com', '2020-12-11 19:17:07', '$2y$10$Sa3cZnVH5f8LBdNU0yFGPu2zTm.wJqVNk1wRf3rY91vcrFjNZO5e.', 0, 'JP32', '504505506', NULL, 'Portugal', 'Almarze', NULL, '+351937239707', 'off', 2, NULL, NULL, NULL, '2020-12-11 19:16:34', '2020-12-11 19:17:59'),
(8, 'vero', 'veronika.duarte@gmail.com', '2020-12-13 03:48:48', '$2y$10$mhmhdpbiRH5pbIavn4.7XuIdHzS8EzOmmakAjITIZ.4UwJVtqOAL2', 0, NULL, 'veronika.duarte@gmail.com', NULL, 'Slovakia', 'jakarta', NULL, NULL, 'off', 2, NULL, NULL, NULL, '2020-12-13 03:07:49', '2020-12-13 03:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `item_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 1, 4, '2020-12-14 04:08:51', '2020-12-14 04:08:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auctionsbidding`
--
ALTER TABLE `auctionsbidding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auctionschildposts`
--
ALTER TABLE `auctionschildposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auctionscomments`
--
ALTER TABLE `auctionscomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biddingconditions`
--
ALTER TABLE `biddingconditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paymentmeta`
--
ALTER TABLE `paymentmeta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postsmeta`
--
ALTER TABLE `postsmeta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolesauthorities`
--
ALTER TABLE `rolesauthorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolesubauthorities`
--
ALTER TABLE `rolesubauthorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auctionsbidding`
--
ALTER TABLE `auctionsbidding`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `auctionschildposts`
--
ALTER TABLE `auctionschildposts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auctionscomments`
--
ALTER TABLE `auctionscomments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biddingconditions`
--
ALTER TABLE `biddingconditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paymentmeta`
--
ALTER TABLE `paymentmeta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `postsmeta`
--
ALTER TABLE `postsmeta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rolesauthorities`
--
ALTER TABLE `rolesauthorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rolesubauthorities`
--
ALTER TABLE `rolesubauthorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
