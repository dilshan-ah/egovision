-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 11:08 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egovision`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@site.com', 'admin', NULL, '6346ab2e6449f1665575726.png', '$2y$10$DPcZdU5ncDNJqfcQyNRYuuvyj4QKYq1QLVcxJ/TNqELQN/JkyxAvO', NULL, NULL, '2022-10-12 09:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `click_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `user_id`, `title`, `is_read`, `click_url`, `created_at`, `updated_at`) VALUES
(1, 0, 'SMS Error: unexpected response from API', 0, '#', '2023-01-18 03:59:33', '2023-01-18 03:59:33'),
(2, 8, 'Deposit successful via Mollie - USD', 0, '/admin/deposit/successful', '2023-02-13 07:57:29', '2023-02-13 07:57:29'),
(3, 0, 'SMS Error: unexpected response from API', 0, '#', '2023-02-13 07:57:31', '2023-02-13 07:57:31'),
(4, 0, 'SMS Error: Bad Credentials', 0, '#', '2024-09-22 06:27:58', '2024-09-22 06:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_path`, `product_id`, `created_at`, `updated_at`, `title`, `btn_text`) VALUES
(3, 'ego-assets/images/banners/1727070230_img1.jpeg', 5, '2024-09-23 05:23:18', '2024-09-23 06:55:32', 'The Model is wearing', 'Shop color'),
(4, 'ego-assets/images/banners/1727069077_img2.jpeg', 8, '2024-09-23 05:24:37', '2024-09-23 05:57:43', 'Stylish colors', 'Shop color'),
(5, 'ego-assets/images/banners/1727069094_img3.jpeg', 13, '2024-09-23 05:24:54', '2024-09-23 05:58:00', 'Quality and Comfort', 'Shop color');

-- --------------------------------------------------------

--
-- Table structure for table `base_curves`
--

CREATE TABLE `base_curves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `base_curves`
--

INSERT INTO `base_curves` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '8.7 mm', '2024-09-25 07:01:17', '2024-09-25 07:01:17'),
(2, '8.6 mm', '2024-09-25 07:01:30', '2024-09-25 07:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `power_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `power` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pair` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `session_id`, `power_status`, `created_at`, `updated_at`, `user_id`, `power`, `pair`) VALUES
(271, '6', 'H90bOoudETVwJTleJt5SznJ5wIMw6wYTe6RuI9M8', 'no_power', '2024-10-02 09:00:10', '2024-10-02 09:12:27', '42', NULL, '1'),
(272, '18', 'H90bOoudETVwJTleJt5SznJ5wIMw6wYTe6RuI9M8', 'no_power', '2024-10-02 09:00:10', '2024-10-02 09:12:27', '42', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `collection_sets`
--

CREATE TABLE `collection_sets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tone_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collection_sets`
--

INSERT INTO `collection_sets` (`id`, `category_id`, `tone_id`, `duration_id`, `featured`, `created_at`, `updated_at`, `image_path`, `description`) VALUES
(21, '3', '4', '6', 'no', '2024-09-25 06:39:57', '2024-09-26 16:17:29', 'ego-assets/images/product_collections/1727331685_TC_box.jpg', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 14px;\">Experience timeless elegance with Desio\'s Timeless Collection, ideal for achieving a subtle, natural eye color. Tailored for dark brown eyes, our collection satisfies your desire for darker lenses that seamlessly blend with your natural eye color. What sets this collection apart is the 14.2 lens diameter, a feature sought after by many of our customers</span></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Diameter: 14.2mm - Base curve 8.6mm</span><br style=\"box-sizing: inherit;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Availability: From -8.00 to +4.00</span></p>'),
(22, '4', '4', '8', 'no', '2024-09-25 06:40:32', '2024-09-26 16:17:37', 'ego-assets/images/product_collections/1727331710_A3T_box.jpg', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 12px;\"><span style=\"box-sizing: inherit; font-size: 14px;\">The Attitude 3-Tones Quarterly color contacts are designed with a honey sunburst around the pupil hole, bordered by a base color and a limbal ring. Whether you prefer Irresistible Blue, Precious Grey, Tender Hazel, or Charming Green lenses, our 3-tone designs are guaranteed to captivate attention and enhance your natural eye color. This collection offers both prescription contact lenses and toric contact lenses.</span><br style=\"box-sizing: inherit;\"></span></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Diameter: 14.4mm - Base curve 8.7mm</span><br style=\"box-sizing: inherit;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Availability: From -13.00 to +6.00 &amp; Torics</span></p>'),
(23, '4', '3', '8', 'yes', '2024-09-25 06:40:45', '2024-09-26 06:22:24', 'ego-assets/images/product_collections/1727331744_1727000341_A3T_box.jpg', '<h4 style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 0.5rem; font-weight: 400; line-height: 1.2; color: rgb(0, 0, 0); font-size: 1.25rem; font-family: Prata; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; letter-spacing: 0.5px; text-align: left; background-color: rgb(245, 245, 245);\">2 Tones - Quarterly</h4><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(0, 0, 0); letter-spacing: 0.5px; text-align: left; background-color: rgb(245, 245, 245);\"><span style=\"box-sizing: inherit; font-size: 14px;\">The Attitude 2 tones Quarterly color contact lenses are designed with a base color and a limbal ring. Wild Green, Delicious Honey, Romantic Blue or Rebel Grey are the ultimate choice for a classic look. This collection offers both prescription contact lenses and toric contact lenses.</span></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; color: rgb(0, 0, 0); letter-spacing: 0.5px; text-align: left; background-color: rgb(245, 245, 245);\"><span style=\"box-sizing: inherit; font-size: 10px;\">Diameter: 14.5mm - Base curve 8.7mm</span><br style=\"box-sizing: inherit;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Availability: From -13.00 to +6.00 &amp; Torics</span></p>'),
(24, '4', '2', '6', 'no', '2024-09-25 06:41:45', '2024-09-26 16:17:47', 'ego-assets/images/product_collections/1727331775_A2TT_box.jpg', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 14px;\">The Attitude 2 tones Quarterly color contact lenses are designed with a base color and a limbal ring. Wild Green, Delicious Honey, Romantic Blue or Rebel Grey are the ultimate choice for a classic look. This collection offers both prescription contact lenses and toric contact lenses.</span></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Diameter: 14.5mm - Base curve 8.7mm</span><br style=\"box-sizing: inherit;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Availability: From -13.00 to +6.00 &amp; Torics</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `color_intro` text DEFAULT NULL,
  `color_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `created_at`, `updated_at`, `image_path`, `color_intro`, `color_code`) VALUES
(3, 'Purple Lenses', '2024-09-22 12:20:10', '2024-09-30 06:46:54', 'ego-assets/images/color_image/126299.jpg', '<p style=\"margin-right: 0in; margin-left: 0in; font-size: 16px; font-family: &quot;Times New Roman&quot;, &quot;serif&quot;;\">Discover Ego Vision’s stunning purple contact lenses! Expertly designed to\r\n    enhance your natural eye color, these lenses offer a subtle yet captivating\r\n    purple hue. Whether you have brown, green, or blue eyes, our purple lenses will\r\n    add depth and dimension to your look, helping you make a bold statement\r\n    wherever you go.</p>', '#b3059c'),
(4, 'Blue lenses', '2024-09-22 12:21:36', '2024-09-26 09:44:20', 'ego-assets/images/color_image/626052.jpg', '<p><span style=\"font-size: 15px; line-height: 107%; font-family: Calibri, &quot;sans-serif&quot;;\">Seeking\r\n    a fresh, captivating look? Ego Vision’s blue contact lenses are the ideal\r\n    choice! Skillfully crafted to enhance your eyes with a stunning blue hue, these\r\n    lenses will leave you feeling confident and irresistibly charming</span></p>', '#0055ff'),
(5, 'Green Lenses', '2024-09-22 12:22:06', '2024-09-26 09:44:42', 'ego-assets/images/color_image/625367.jpg', '<p class=\"MsoNormal\" style=\"margin: 0in 0in 11px; font-size: 15px; font-family: Calibri, &quot;sans-serif&quot;; line-height: normal;\"><span style=\"font-size: 16px; font-family: Arial, &quot;sans-serif&quot;; color: black; letter-spacing: 1px;\">Try Ego vision’s green\r\n        colored contact lenses! They are specially designed to enhance your natural eye\r\n        color with a beautiful green shade that will make you stand out from the crowd.\r\n        Whether you have light or dark eyes, our lenses will give you a natural and\r\n        striking green hue that will enhance your eyes.</span></p>', '#00ff4c'),
(11, 'Brown & Hazel Lenses', '2024-09-26 09:41:43', '2024-09-26 09:41:43', 'ego-assets/images/color_image/433391.jpg', '<p style=\"margin-right: 0in; margin-left: 0in; font-size: 16px; font-family: &quot;Times New Roman&quot;, &quot;serif&quot;;\">Ego Vision’s brown and hazel contact lenses offer the perfect solution for a\r\n    subtle, natural look! Whether you have light or dark eyes, these lenses provide\r\n    an authentic hazel hue that blends seamlessly with your natural eye color,\r\n    creating a beautifully natural effect.</p>', '#846262'),
(12, 'Grey Lenses', '2024-09-26 09:43:52', '2024-09-26 09:43:52', 'ego-assets/images/color_image/936618.jpeg', '<p style=\"margin-right: 0in; margin-left: 0in; font-size: 16px; font-family: &quot;Times New Roman&quot;, &quot;serif&quot;;\">For a sophisticated and elegant look, try Ego Vision’s grey contact lenses!\r\n    Meticulously designed to enhance your natural eye color, these lenses offer a\r\n    subtle yet striking grey hue that will leave you feeling confident and chic.\r\n    Perfect for those seeking a refined and timeless appearance.</p>', '#888686');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `method_code` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `method_currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `final_amo` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_try` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT 0,
  `admin_feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `method_code`, `amount`, `method_currency`, `charge`, `rate`, `final_amo`, `detail`, `btc_amo`, `btc_wallet`, `trx`, `payment_try`, `status`, `from_api`, `admin_feedback`, `created_at`, `updated_at`) VALUES
(1, 8, 115, '100.00000000', 'USD', '2.00000000', '1.00000000', '102.00000000', '{\"cardToken\":\"tkn_WjGvAGtest\",\"cardNumber\":\"3704\",\"cardHolder\":\"T. TEST\",\"cardAudience\":\"consumer\",\"cardLabel\":\"Mastercard\",\"cardCountryCode\":\"NL\",\"cardSecurity\":\"3dsecure\",\"feeRegion\":\"other\"}', '0', '', '7A27BS2YJXEW', 0, 1, 0, NULL, '2023-02-13 07:57:04', '2023-02-13 07:57:29'),
(2, 8, 122, '10.00000000', 'BTC', '1.10000000', '1.00000000', '11.10000000', NULL, '0', '', 'MEBJG9UJYRJD', 0, 0, 0, NULL, '2023-02-14 04:36:35', '2023-02-14 04:36:35'),
(3, 8, 122, '10.00000000', 'BTC', '1.10000000', '1.00000000', '11.10000000', NULL, '0', '', 'M8NH34N9T4NE', 0, 0, 0, NULL, '2023-02-14 04:41:49', '2023-02-14 04:41:49'),
(4, 8, 122, '10.00000000', 'BTC', '1.10000000', '1.00000000', '11.10000000', '\"{\\\"id\\\":\\\"2h66kPMBByCk8DxEjsSSyZ\\\",\\\"storeId\\\":\\\"HsqFVTXSeUFJu7caoYZc3CTnP8g5LErVdHhEXPVTheHf\\\",\\\"amount\\\":\\\"10.00\\\",\\\"checkoutLink\\\":\\\"https:\\\\\\/\\\\\\/testnet.demo.btcpayserver.org\\\\\\/i\\\\\\/2h66kPMBByCk8DxEjsSSyZ\\\",\\\"status\\\":\\\"New\\\",\\\"additionalStatus\\\":\\\"None\\\",\\\"monitoringExpiration\\\":1676446037,\\\"expirationTime\\\":1676359637,\\\"createdTime\\\":1676358737,\\\"availableStatusesForManualMarking\\\":[\\\"Settled\\\",\\\"Invalid\\\"],\\\"archived\\\":false,\\\"type\\\":\\\"Standard\\\",\\\"currency\\\":\\\"USD\\\",\\\"metadata\\\":{\\\"orderId\\\":\\\"8PFENVVEK8AE\\\"},\\\"checkout\\\":{\\\"speedPolicy\\\":\\\"MediumSpeed\\\",\\\"paymentMethods\\\":[\\\"BTC\\\"],\\\"defaultPaymentMethod\\\":null,\\\"expirationMinutes\\\":15,\\\"monitoringMinutes\\\":1440,\\\"paymentTolerance\\\":0,\\\"redirectURL\\\":null,\\\"redirectAutomatically\\\":false,\\\"requiresRefundEmail\\\":null,\\\"defaultLanguage\\\":null,\\\"checkoutType\\\":null},\\\"receipt\\\":{\\\"enabled\\\":null,\\\"showQR\\\":null,\\\"showPayments\\\":null}}\"', '0', '2h66kPMBByCk8DxEjsSSyZ', '8PFENVVEK8AE', 0, 0, 0, NULL, '2023-02-14 04:42:16', '2023-02-14 04:42:18'),
(5, 8, 508, '10.00000000', 'BTC', '1.10000000', '1.00000000', '11.10000000', NULL, '0.00050982', '3GnXmdC8PUuWUFzPHfFAbV3F7n1LAbuxfr', '9NEFC4SQYYFO', 0, 0, 0, NULL, '2023-02-14 04:58:24', '2023-02-14 04:59:50'),
(6, 8, 509, '10.00000000', 'BTC', '1.10000000', '1.00000000', '11.10000000', NULL, '0', '', '236HYPQY4PGR', 0, 0, 0, NULL, '2023-02-14 05:05:57', '2023-02-14 05:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `diameters`
--

CREATE TABLE `diameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diameters`
--

INSERT INTO `diameters` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, '14.2 mm', '2024-08-21 10:57:29', '2024-08-21 10:57:29'),
(3, '14.3 mm', '2024-08-21 10:57:38', '2024-08-21 10:57:38'),
(4, '14.4 mm', '2024-08-21 10:57:47', '2024-08-21 10:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `durations`
--

CREATE TABLE `durations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `months` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `durations`
--

INSERT INTO `durations` (`id`, `name`, `created_at`, `updated_at`, `months`, `image_path`, `description`) VALUES
(6, 'Monthly Lenses', '2024-09-24 06:38:28', '2024-09-24 06:53:04', '1', 'ego-assets/images/product_durations/1727160784_Desio_monthly_colored_contact_lenses (1).jpg', '<h4 style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 0.5rem; font-family: Prata; font-weight: 400; font-size: 1.25rem; color: rgb(0, 0, 0); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Hydration and comfort with Hioxifilcon D</h4><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Our monthly contact lenses, made from Hioxifilcon D with its 54% water content, provide exceptional hydration and comfort. This high level of moisture keeps your eyes moist throughout the day, significantly reducing irritation and ensuring clear vision. These qualities make these contact lenses one of the best contacts for dry eyes. Additionally, ideal for daily wear, these lenses cater to those seeking the most comfortable contact lenses for their eye health, which is especially beneficial for users with dry eyes.</p>'),
(8, 'Quarterly Lenses', '2024-09-24 06:43:12', '2024-09-24 06:43:12', '3', 'ego-assets/images/product_durations/1727160192_desio_quarterly_colored_contact_lenses.jpg', '<h4 style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 0.5rem; font-family: Prata; font-weight: 400; font-size: 1.25rem; color: rgb(0, 0, 0); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Durability and Practicality with Polymacon</h4><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">For those on the go, our three months lenses made from Polymacon offer a practical solution. With a 38% water content, these lenses combine durability and comfort, perfect for extended wear and fewer replacements. The robust nature of Polymacon makes it an excellent choice for busy individuals seeking both convenience and quality.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'object',
  `support` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, '2019-10-18 23:16:05', '2022-03-22 05:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, '2019-10-18 23:16:05', '2024-09-24 06:15:42'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 23:16:05', '2022-10-13 05:02:43'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, '2021-05-04 10:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, '2022-03-22 05:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `act`, `form_data`, `created_at`, `updated_at`) VALUES
(2, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number_22\":{\"name\":\"NID Number 22\",\"label\":\"nid_number_22\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"textarea\"},\"sadfg\":{\"name\":\"sadfg\",\"label\":\"sadfg\",\"is_required\":\"optional\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"asdf\":{\"name\":\"asdf\",\"label\":\"asdf\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"Test2\",\"Test3\"],\"type\":\"select\"},\"nid_number_226985\":{\"name\":\"NID Number 226985\",\"label\":\"nid_number_226985\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"Test 2\",\"Test 3\"],\"type\":\"checkbox\"},\"nid_number_3333\":{\"name\":\"NID Number 3333\",\"label\":\"nid_number_3333\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Test\",\"asdf\"],\"type\":\"radio\"},\"nid_number_3333587\":{\"name\":\"NID Number 3333587\",\"label\":\"nid_number_3333587\",\"is_required\":\"optional\",\"extensions\":\"jpg,bmp,png,pdf\",\"options\":[],\"type\":\"file\"}}', '2022-03-16 01:09:49', '2022-03-17 00:02:54'),
(3, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"nid_number_226985\":{\"name\":\"NID Number 226985\",\"label\":\"nid_number_226985\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-16 04:32:29', '2022-03-16 04:35:32'),
(5, 'withdraw_method', '{\"nid_number_33\":{\"name\":\"NID Number 33\",\"label\":\"nid_number_33\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-17 00:45:35', '2022-03-17 00:53:17'),
(6, 'withdraw_method', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-17 00:47:04', '2022-03-17 00:47:04'),
(7, 'kyc', '{\"full.name\":{\"name\":\"Full.Name\",\"label\":\"full.name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"gender\":{\"name\":\"Gender\",\"label\":\"gender\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Male\",\"Female\",\"Others\"],\"type\":\"select\"},\"you_hobby\":{\"name\":\"You Hobby\",\"label\":\"you_hobby\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"Programming\",\"Gardening\",\"Traveling\",\"Others\"],\"type\":\"checkbox\"},\"nid_photo\":{\"name\":\"NID Photo\",\"label\":\"nid_photo\",\"is_required\":\"required\",\"extensions\":\"jpg,png\",\"options\":[],\"type\":\"file\"}}', '2022-03-17 02:56:14', '2022-12-17 11:14:11'),
(8, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-21 07:53:25', '2022-03-21 07:53:25'),
(9, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-21 07:54:15', '2022-03-21 07:54:15'),
(10, 'manual_deposit', '{\"nid_number\":{\"name\":\"NID Number\",\"label\":\"nid_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"}}', '2022-03-21 07:55:15', '2022-03-21 07:55:22'),
(11, 'withdraw_method', '{\"nid_number_2658\":{\"name\":\"NID Number 2658\",\"label\":\"nid_number_2658\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[\"asdf\"],\"type\":\"checkbox\"}}', '2022-03-22 00:14:09', '2022-03-22 00:14:18'),
(12, 'withdraw_method', '[]', '2022-03-30 09:03:12', '2022-03-30 09:03:12'),
(13, 'withdraw_method', '{\"bank_name\":{\"name\":\"Bank Name\",\"label\":\"bank_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"account_name\":{\"name\":\"Account Name\",\"label\":\"account_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"account_number\":{\"name\":\"Account Number\",\"label\":\"account_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-30 09:09:11', '2022-04-03 06:38:57'),
(14, 'withdraw_method', '{\"mobile_number\":{\"name\":\"Mobile Number\",\"label\":\"mobile_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2022-03-30 09:10:12', '2022-03-30 09:10:12'),
(15, 'manual_deposit', '{\"send_from_number\":{\"name\":\"Send From Number\",\"label\":\"send_from_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"transaction_number\":{\"name\":\"Transaction Number\",\"label\":\"transaction_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"screenshot\":{\"name\":\"Screenshot\",\"label\":\"screenshot\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg,png\",\"options\":[],\"type\":\"file\"}}', '2022-03-30 09:15:27', '2022-03-30 09:15:27'),
(16, 'manual_deposit', '{\"transaction_number\":{\"name\":\"Transaction Number\",\"label\":\"transaction_number\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"screenshot\":{\"name\":\"Screenshot\",\"label\":\"screenshot\",\"is_required\":\"required\",\"extensions\":\"jpg,pdf,docx\",\"options\":[],\"type\":\"file\"}}', '2022-03-30 09:16:43', '2022-04-11 03:19:54'),
(17, 'manual_deposit', '[]', '2022-03-30 09:21:19', '2022-03-30 09:21:19'),
(18, 'manual_deposit', '[]', '2022-07-26 05:53:36', '2022-07-26 05:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_keys` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"admin\",\"blog\",\"aaaa\",\"ddd\",\"aaa\"],\"description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit\",\"social_title\":\"Viserlab Limited\",\"social_description\":\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit ff\",\"image\":\"5fa397a629bee1604556710.jpg\"}', '2020-07-04 23:42:52', '2021-01-03 07:43:02'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\",\"description\":\"fdg sdfgsdf g ggg\",\"about_icon\":\"<i class=\\\"las la-address-card\\\"><\\/i>\",\"background_image\":\"60951a84abd141620384388.png\",\"about_image\":\"5f9914e907ace1603867881.jpg\"}', '2020-10-28 00:51:20', '2021-05-07 10:16:28'),
(25, 'blog.content', '{\"heading\":\"Latest News\",\"subheading\":\"------\"}', '2020-10-28 00:51:34', '2022-03-19 04:41:13'),
(26, 'blog.element', '{\"has_image\":[\"1\",\"1\"],\"title\":\"this is a test blog 2\",\"description\":\"aewf asdf\",\"description_nic\":\"asdf asdf\",\"blog_icon\":\"<i class=\\\"lab la-hornbill\\\"><\\/i>\",\"blog_image_1\":\"5f99164f1baec1603868239.jpg\",\"blog_image_2\":\"5ff2e146346d21609752902.jpg\"}', '2020-10-28 00:57:19', '2021-01-04 03:35:02'),
(27, 'contact_us.content', '{\"title\":\"Auctor gravida vestibulu\",\"short_details\":\"55f55\",\"email_address\":\"5555f\",\"contact_details\":\"5555h\",\"contact_number\":\"5555a\",\"latitude\":\"5555h\",\"longitude\":\"5555s\",\"website_footer\":\"5555qqq\"}', '2020-10-28 00:59:19', '2020-11-01 04:51:54'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\"}', '2020-10-28 01:04:02', '2020-10-28 01:04:02'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"las la-expand\\\"><\\/i>\",\"url\":\"https:\\/\\/www.google.com\\/\"}', '2020-11-12 04:07:30', '2021-05-12 05:56:59'),
(33, 'feature.content', '{\"heading\":\"asdf\",\"sub_heading\":\"asdf\"}', '2021-01-03 23:40:54', '2021-01-03 23:40:55'),
(34, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"asdf\"}', '2021-01-03 23:41:02', '2021-01-03 23:41:02'),
(35, 'service.element', '{\"trx_type\":\"withdraw\",\"service_icon\":\"<i class=\\\"las la-highlighter\\\"><\\/i>\",\"title\":\"asdfasdf\",\"description\":\"asdfasdfasdfasdf\"}', '2021-03-06 01:12:10', '2021-03-06 01:12:10'),
(36, 'service.content', '{\"trx_type\":\"deposit\",\"heading\":\"asdf fffff\",\"subheading\":\"555\"}', '2021-03-06 01:27:34', '2022-03-30 08:07:06'),
(39, 'banner.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse voluptatum eaque earum quos quia? Id aspernatur ratione, voluptas nulla rerum laudantium neque ipsam eaque\"}', '2021-05-02 06:09:30', '2021-05-02 06:09:30'),
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\",\"status\":1}', '2020-07-04 23:42:52', '2022-09-22 07:29:55'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"line-height:1.3;\\\"><font color=\\\"#363636\\\" face=\\\"Exo, sans-serif\\\" size=\\\"3\\\">Welcome to the official website of Ego Vision (https:\\/\\/egovision.shop). We respect your privacy and are committed to protecting your personal information. Please read our Privacy Policy carefully for more details.<\\/font><\\/h3><h3 class=\\\"mb-3\\\" style=\\\"line-height:1.3;\\\"><font color=\\\"#363636\\\" face=\\\"Exo, sans-serif\\\"><span style=\\\"font-size:24px;\\\"><b>1\\/ Data We Collect<\\/b><\\/span><\\/font><\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><span style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;font-size:18px;\\\">When you place an order on our site, we may collect and process the following personal information:<\\/span><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Your name, gender, date of birth, email address, postal address, delivery address (if different), phone number, and payment details.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>This information is used to process your orders, manage your account, and provide necessary services and information.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">We may also collect data related to user demographics, improve the design and content of our site, and use it for market research and statistical analysis.<\\/span><\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"color:rgb(54,54,54);font-family:Exo, sans-serif;font-weight:600;line-height:1.3;font-size:24px;\\\">2\\/ Use of Personal Information<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><span style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;font-size:18px;\\\">We use your personal information for the following purposes:<\\/span><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Order Processing: To manage and fulfill your purchases.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Account Management: To verify and handle your transactions and to provide updates on your orders.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Marketing: We may send you information about our products, services, promotions, and other offers via email. You can opt out of receiving these communications by clicking \\\"unsubscribe\\\" in any email or by updating your preferences in your account.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">We may share your information with third parties for order fulfillment, such as couriers or payment processors, as required to deliver products or services to you.<\\/span><\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"color:rgb(54,54,54);font-family:Exo, sans-serif;font-weight:600;line-height:1.3;font-size:24px;\\\">3\\/ Security<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">You have the right to:<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Access the personal data we hold about you.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Correct any inaccuracies in your personal data.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Request deletion of your data where legally permitted.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Opt-out of marketing communications at any time.<\\/span><\\/font><\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">4\\/ Your Rights<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">5\\/ Cookies<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We use cookies to enhance your experience on our website. Cookies help us recognize your device, store your preferences, and ensure that our site functions smoothly. By using egovision.shop, you agree to the use of cookies. However, you can manage your cookie preferences via your browser settings.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">6\\/ Third-Party Involvement<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We may share your data with third parties for business purposes, such as order fulfillment, payment processing, or marketing. We ensure that any third-party service providers are obligated to handle your data with the same level of security as we do. We will not sell or disclose your personal information to any third parties without your explicit consent unless required by law.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"color:rgb(54,54,54);font-family:Exo, sans-serif;font-weight:600;line-height:1.3;font-size:24px;\\\">7\\/ Contests and Promotions<\\/h3><p class=\\\"font-18\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-right:0px;margin-left:0px;font-size:18px;\\\">If you participate in any contests or promotions hosted by Ego Vision, your data may be used to inform you of results and advertise our offers. The policy governing specific promotions will be shared when applicable.<\\/p><p class=\\\"font-18\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-right:0px;margin-left:0px;font-size:18px;\\\"><br \\/><\\/p><h3 class=\\\"mb-3\\\" style=\\\"color:rgb(54,54,54);font-family:Exo, sans-serif;font-weight:600;line-height:1.3;font-size:24px;\\\">8\\/ Changes to the Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">We reserve the right to modify this Privacy Policy as necessary. Any changes will be posted on this page, and where significant, we will notify you via email.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">If you have any questions or concerns regarding our Privacy Policy, please contact us at 98\\/6-A, Boro moghbazar, Ramna, Dhaka.<\\/span><\\/font><\\/p><\\/div>\"}', '2021-06-09 08:50:42', '2024-09-26 07:25:34'),
(43, 'policy_pages.element', '{\"title\":\"Terms and Conditions\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"margin-bottom:3rem;\\\"><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><span style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;\\\"><b><font size=\\\"6\\\">Welcome to Ego Vision!<\\/font><\\/b><\\/span><br \\/><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\"><br \\/><\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">These terms and conditions outline the rules and regulations for the use of Ego Vision\'s website, located at https:\\/\\/egovision.shop.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\"><br \\/><\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">By accessing this website, we assume you accept these terms and conditions. Do not continue to use egovision.shop if you do not agree to all of the terms and conditions stated on this page.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\"><br \\/><\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\" size=\\\"6\\\"><b>Terminology<\\/b><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">The following terminology applies to these Terms and Conditions, Privacy Statement, and Disclaimer Notice, and all Agreements:<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\"><br \\/><\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u201cClient,\\u201d \\u201cYou,\\u201d and \\u201cYour\\u201d refers to you, the person accessing this website and accepting the Company\\u2019s terms and conditions.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u201cThe Company,\\u201d \\u201cOurselves,\\u201d \\u201cWe,\\u201d \\u201cOur,\\u201d and \\u201cUs\\u201d refers to Ego Vision.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">\\u201cParty,\\u201d \\u201cParties,\\u201d or \\u201cUs\\u201d refers to both the Client and ourselves.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">All terms refer to the offer, acceptance, and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client\\u2019s needs concerning the provision of the Company\\u2019s stated services, in accordance with and subject to, the prevailing laws of Bangladesh. Any use of the above terminology or other words in the singular, plural, capitalization, and\\/or he\\/she or they, are taken as interchangeable and therefore as referring to the same.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\"><br \\/><\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\" size=\\\"6\\\"><b>Cookies<\\/b><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">We employ the use of cookies. By accessing egovision.shop, you agree to the use of cookies in agreement with Ego Vision\'s Privacy Policy.<\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\"><br \\/><\\/span><\\/font><\\/p><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;\\\"><font color=\\\"#6f6f6f\\\" face=\\\"Nunito, sans-serif\\\"><span style=\\\"font-size:18px;\\\">Most interactive websites use cookies to retrieve the user\\u2019s details for each visit. Cookies are used by our website to enable the functionality of certain areas, making it easier for people visiting our website.<\\/span><\\/font><\\/p><\\/div>\"}', '2021-06-09 08:51:18', '2024-09-26 08:03:54'),
(44, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align: center; font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"text-align: center; margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div>\"}', '2020-07-04 23:42:52', '2022-05-11 03:57:17'),
(45, 'policy_pages.element', '{\"title\":\"Returns, Exchanges, or Refund Policy\",\"details\":\"<div>At Ego Vision, we strive to ensure your satisfaction with every purchase. However, if you\'re not completely happy with your order, we offer a straightforward return process.<\\/div><div><br \\/><\\/div><div><br \\/><\\/div><div><b><font size=\\\"6\\\">How to Return an Item:<\\/font><\\/b><\\/div><div>1.<span style=\\\"white-space:pre;\\\">\\t<\\/span>Sign into your account: Access your account on egovision.shop.<\\/div><div>2.<span style=\\\"white-space:pre;\\\">\\t<\\/span>Find your order: Navigate to \\\"My Orders\\\" and click the \\u201cReturn Item\\u201d button.<\\/div><div>3.<span style=\\\"white-space:pre;\\\">\\t<\\/span>Select the item(s): Choose the item(s) you wish to return, indicate the reason for return, and submit your request.<\\/div><div>4.<span style=\\\"white-space:pre;\\\">\\t<\\/span>Choose a mailing method:<\\/div><div>o<span style=\\\"white-space:pre;\\\">\\t<\\/span>Self-send the package<\\/div><div>o<span style=\\\"white-space:pre;\\\">\\t<\\/span>Drop off at one of our retail locations<\\/div><div>o<span style=\\\"white-space:pre;\\\">\\t<\\/span>Arrange a pickup service<\\/div><div>5.<span style=\\\"white-space:pre;\\\">\\t<\\/span>Customer support: Our customer service team will contact you to confirm your return request and provide further instructions.<\\/div><div><br \\/><\\/div><div><br \\/><\\/div><div><b><font size=\\\"6\\\">Processing &amp; Refunds:<\\/font><\\/b><\\/div><div>Once we receive your returned item, we will:<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Confirm the parcel and update your return status.<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Process the return and refund within 7 working days.<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Refunds will be credited to your account for future use.<\\/div><div><br \\/><\\/div><div><br \\/><\\/div><div><b><font size=\\\"6\\\">Return Conditions:<\\/font><\\/b><\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Items must be returned in their unused condition, with all original packaging.<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>We do not accept items that have been worn, damaged, washed, or altered in any way.<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>All returns must be coordinated with Ego Vision before sending the item back. Unapproved returns will not be accepted.<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Return shipping is at the customer\\u2019s expense unless dropping off at one of our retail locations.<\\/div><div><br \\/><\\/div><div><br \\/><\\/div><div><b><font size=\\\"6\\\">Refunds:<\\/font><\\/b><\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Returns will be processed within 7 days after we receive the package.<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>The refund will be credited to your account for future purchases.<\\/div>\"}', '2024-09-26 07:32:30', '2024-09-26 07:32:30'),
(46, 'policy_pages.element', '{\"title\":\"Shipping &amp; Delivery\",\"details\":\"<div>At Ego Vision, we prioritize fast and reliable delivery to ensure your items reach you as quickly as possible. Below are the details of our shipping and delivery process:<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Delivery Time: You can expect your order to arrive within 1-3 business days from the date it is placed.<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Order Confirmation: After your order is authorized and verified, you will receive a confirmation email. We begin preparing your order immediately after verification. Due to this quick processing time, we may not be able to modify or cancel your order, but we will do our best to accommodate any requests.<\\/div><div>\\u2022<span style=\\\"white-space:pre;\\\">\\t<\\/span>Processing Time: It usually takes 1 business day to process your order. Please note that this timeframe excludes weekends and public holidays.<\\/div>\"}', '2024-09-26 07:33:45', '2024-09-26 07:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `code` int(10) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crypto` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:04:38'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:35:33'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:48:36'),
(4, 0, 104, 'Skrill', 'Skrill', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:30:16'),
(5, 0, 105, 'PayTM', 'Paytm', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 03:00:44'),
(6, 0, 106, 'Payeer', 'Payeer', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 13:14:22', '2022-08-28 10:11:14'),
(7, 0, 107, 'PayStack', 'Paystack', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 13:14:22', '2021-05-21 01:49:51'),
(8, 0, 108, 'VoguePay', 'Voguepay', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:22:38'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-06-05 11:37:45'),
(10, 0, 110, 'RazorPay', 'Razorpay', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:51:32'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:53:10'),
(12, 0, 112, 'Instamojo', 'Instamojo', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:56:20'),
(13, 0, 501, 'Blockchain', 'Blockchain', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2022-03-21 07:41:56'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:14'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:44'),
(17, 0, 505, 'Coingate', 'Coingate', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-03-30 09:24:57'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 13:14:22', '2021-05-21 02:02:47'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-20 23:01:08'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 13:14:22', '2021-05-21 00:58:38'),
(27, 0, 115, 'Mollie', 'Mollie', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:44:45'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2021-06-22 08:05:04'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-09-14 07:41:14'),
(37, 0, 120, 'Authorize.net', 'Authorize', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"59e4P9DBcZv\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"47x47TJyLw2E7DbR\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-08-28 09:33:06'),
(46, 0, 121, 'NMI', 'NMI', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2022-08-28 10:32:31'),
(50, 0, 507, 'BTCPay', 'BTCPay', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"HsqFVTXSeUFJu7caoYZc3CTnP8g5LErVdHhEXPVTheHf\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"4436bd706f99efae69305e7c4eff4780de1335ce\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"https:\\/\\/testnet.demo.btcpayserver.org\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"SUCdqPn9CDkY7RmJHfpQVHP2Lf2\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, '2023-02-14 04:42:09'),
(51, 0, 508, 'Now payments hosted', 'NowPaymentsHosted', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2023-02-14 05:08:23'),
(52, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2023-02-14 05:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int(10) DEFAULT NULL,
  `gateway_alias` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `max_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway_currencies`
--

INSERT INTO `gateway_currencies` (`id`, `name`, `currency`, `symbol`, `method_code`, `gateway_alias`, `min_amount`, `max_amount`, `percent_charge`, `fixed_charge`, `rate`, `image`, `gateway_parameter`, `created_at`, `updated_at`) VALUES
(39, 'RazorPay - INR', 'INR', '$', 110, 'Razorpay', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"key_id\":\"rzp_test_kiOtejPbRZU90E\",\"key_secret\":\"osRDebzEqbsE1kbyQJ4y0re7\"}', '2020-09-26 04:51:34', '2020-09-26 04:51:34'),
(42, 'VoguePay - USD', 'USD', '$', 108, 'Voguepay', '1.00000000', '1000.00000000', '0.00', '1.00000000', '1.00000000', NULL, '{\"merchant_id\":\"demo\"}', '2020-09-26 04:52:09', '2020-09-26 04:52:09'),
(75, 'Skrill - AED', 'AED', '$', 104, 'Skrill', '1.00000000', '10000.00000000', '1.00', '1.00000000', '10.00000000', NULL, '{\"pay_to_email\":\"merchant@skrill.com\",\"secret_key\":\"---\"}', '2021-05-19 12:04:56', '2021-05-19 12:04:56'),
(76, 'Skrill - USD', 'USD', '$', 104, 'Skrill', '1.00000000', '10000.00000000', '1.00', '1.00000000', '2.00000000', NULL, '{\"pay_to_email\":\"merchant@skrill.com\",\"secret_key\":\"---\"}', '2021-05-19 12:04:56', '2021-05-19 12:04:56'),
(82, 'Paypal Express - USD', 'USD', '$', 113, 'PaypalSdk', '1.00000000', '1000000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"clientId\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\",\"clientSecret\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}', '2021-05-21 00:00:14', '2021-05-21 00:00:14'),
(83, 'Paypal - USD', 'USD', '$', 101, 'Paypal', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"paypal_email\":\"sb-owud61543012@business.example.com\"}', '2021-05-21 00:04:38', '2021-05-21 00:04:38'),
(84, 'Stripe Hosted - USD', 'USD', '$', 103, 'Stripe', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"secret_key\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\",\"publishable_key\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}', '2021-05-21 00:48:36', '2021-05-21 00:48:36'),
(86, 'Stripe Storefront - USD', 'USD', '$', 111, 'StripeJs', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"secret_key\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\",\"publishable_key\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}', '2021-05-21 00:53:13', '2021-05-21 00:53:13'),
(91, 'Stripe Checkout - USD', 'USD', 'USD', 114, 'StripeV3', '10.00000000', '1000.00000000', '0.00', '1.00000000', '1.00000000', NULL, '{\"secret_key\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\",\"publishable_key\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\",\"end_point\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}', '2021-05-21 01:21:58', '2021-05-21 01:21:58'),
(94, 'Perfect Money - USD', 'USD', '$', 102, 'PerfectMoney', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"passphrase\":\"hR26aw02Q1eEeUPSIfuwNypXX\",\"wallet_id\":\"U30603391\"}', '2021-05-21 01:36:32', '2021-05-21 01:36:32'),
(96, 'PayStack - NGN', 'NGN', '₦', 107, 'Paystack', '1.00000000', '10000.00000000', '1.00', '1.00000000', '420.00000000', NULL, '{\"public_key\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\",\"secret_key\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}', '2021-05-21 01:52:11', '2021-05-21 01:52:11'),
(97, 'CoinPayments - BTC', 'BTC', '$', 503, 'Coinpayments', '1.00000000', '10000.00000000', '10.00', '1.00000000', '10.00000000', NULL, '{\"public_key\":\"---------------\",\"private_key\":\"------------\",\"merchant_id\":\"93a1e014c4ad60a7980b4a7239673cb4\"}', '2021-05-21 02:07:14', '2021-05-21 02:07:14'),
(109, 'Mollie - USD', 'USD', '$', 115, 'Mollie', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"mollie_email\":\"vi@gmail.com\",\"api_key\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}', '2021-05-21 02:44:45', '2021-05-21 02:44:45'),
(113, 'Instamojo - INR', 'INR', '₹', 112, 'Instamojo', '1.00000000', '10000.00000000', '1.00', '1.00000000', '75.00000000', NULL, '{\"api_key\":\"test_2241633c3bc44a3de84a3b33969\",\"auth_token\":\"test_279f083f7bebefd35217feef22d\",\"salt\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}', '2021-05-21 02:57:00', '2021-05-21 02:57:00'),
(115, 'Flutterwave - USD', 'USD', 'USD', 109, 'Flutterwave', '1.00000000', '2000.00000000', '0.00', '1.00000000', '1.00000000', NULL, '{\"public_key\":\"----------------\",\"secret_key\":\"-----------------------\",\"encryption_key\":\"------------------\"}', '2021-06-05 11:37:45', '2021-06-05 11:37:45'),
(116, 'PayTM - AUD', 'AUD', '$', 105, 'Paytm', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"MID\":\"DIY12386817555501617\",\"merchant_key\":\"bKMfNxPPf_QdZppa\",\"WEBSITE\":\"DIYtestingweb\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\",\"transaction_url\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\",\"transaction_status_url\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}', '2021-06-14 12:16:39', '2021-06-14 12:16:39'),
(117, 'PayTM - USD', 'USD', '$', 105, 'Paytm', '1.00000000', '10000.00000000', '1.00', '1.00000000', '2.00000000', NULL, '{\"MID\":\"DIY12386817555501617\",\"merchant_key\":\"bKMfNxPPf_QdZppa\",\"WEBSITE\":\"DIYtestingweb\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\",\"transaction_url\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\",\"transaction_status_url\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}', '2021-06-14 12:16:39', '2021-06-14 12:16:39'),
(121, 'Cashmaal - PKR', 'PKR', 'pkr', 116, 'Cashmaal', '1.00000000', '10000.00000000', '10.00', '1.00000000', '100.00000000', NULL, '{\"web_id\":\"3748\",\"ipn_key\":\"546254628759524554647987\"}', '2021-06-22 08:05:04', '2021-06-22 08:05:04'),
(136, 'CoinPayments Fiat - USD', 'USD', '$', 504, 'CoinpaymentsFiat', '1.00000000', '10000.00000000', '10.00', '1.00000000', '10.00000000', NULL, '{\"merchant_id\":\"6515561\"}', '2022-03-10 03:55:32', '2022-03-10 03:55:32'),
(137, 'CoinPayments Fiat - AUD', 'AUD', '$', 504, 'CoinpaymentsFiat', '1.00000000', '10000.00000000', '0.00', '1.00000000', '1.00000000', NULL, '{\"merchant_id\":\"6515561\"}', '2022-03-10 03:55:32', '2022-03-10 03:55:32'),
(140, 'Payeer - USD', 'USD', '$', 106, 'Payeer', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"merchant_id\":\"866989763\",\"secret_key\":\"7575\"}', '2022-03-21 02:54:29', '2022-03-21 02:54:29'),
(142, 'Blockchain - BTC', 'BTC', '$', 501, 'Blockchain', '1.00000000', '1.11000000', '1.00', '11.00000000', '1.00000000', NULL, '{\"api_key\":\"55529946-05ca-48ff-8710-f279d86b1cc5\",\"xpub_code\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}', '2022-03-21 03:53:18', '2022-03-21 03:53:18'),
(144, 'Coinbase Commerce - USD', 'USD', '$', 506, 'CoinbaseCommerce', '1.00000000', '10000.00000000', '10.00', '1.00000000', '10.00000000', NULL, '{\"api_key\":\"c47cd7df-d8e8-424b-a20a\",\"secret\":\"55871878-2c32-4f64-ab66\"}', '2022-03-30 07:48:19', '2022-03-30 07:48:19'),
(145, 'CoinPayments - ETH', 'JPY', '111', 506, 'CoinbaseCommerce', '1.00000000', '11.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"c47cd7df-d8e8-424b-a20a\",\"secret\":\"55871878-2c32-4f64-ab66\"}', '2022-03-30 07:48:19', '2022-03-30 07:48:19'),
(147, 'Bank Wire', 'USD', '', 1001, 'bank_wire', '10.00000000', '100000.00000000', '1.00', '5.00000000', '1.00000000', '', NULL, '2022-03-30 09:16:43', '2022-07-26 05:57:22'),
(154, 'Authorize.net - USD', 'USD', '$', 120, 'Authorize', '1.00000000', '10.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"login_id\":\"59e4P9DBcZv\",\"transaction_key\":\"47x47TJyLw2E7DbR\"}', '2022-08-28 09:33:06', '2022-08-28 09:33:06'),
(156, 'NMI - USD', 'USD', '$', 121, 'NMI', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}', '2022-08-28 10:32:31', '2022-08-28 10:32:31'),
(163, 'Mercado Pago - USD', 'USD', '$', 119, 'MercadoPago', '1.00000000', '10.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"access_token\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}', '2022-09-14 07:41:14', '2022-09-14 07:41:14'),
(170, 'Now payments checkout - BTC', 'BTC', '$', 509, 'NowPaymentsCheckout', '1.00000000', '1000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"---------------\",\"secret_key\":\"-----------\"}', '2023-02-14 05:08:05', '2023-02-14 05:08:05'),
(171, 'Now payments hosted - BTC', 'BTC', '$', 508, 'NowPaymentsHosted', '1.00000000', '100.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"--------\",\"secret_key\":\"------------\"}', '2023-02-14 05:08:23', '2023-02-14 05:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'email configuration',
  `sms_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `global_shortcodes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT 0,
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0,
  `secure_password` tinyint(1) NOT NULL DEFAULT 0,
  `agree` tinyint(1) NOT NULL DEFAULT 0,
  `multi_language` tinyint(1) NOT NULL DEFAULT 1,
  `registration` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_body`, `sms_from`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `force_ssl`, `maintenance_mode`, `secure_password`, `agree`, `multi_language`, `registration`, `active_template`, `system_info`, `created_at`, `updated_at`) VALUES
(1, 'Ego Vision', 'USD', '$', 'info@egovision.shop', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2024 <a href=\"#\">{{site_name}}</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'EgoAdmin', NULL, NULL, '{\"name\":\"smtp\",\"host\":\"smtp.hostinger.com\",\"port\":\"465\",\"enc\":\"ssl\",\"username\":\"info@egovision.shop\",\"password\":\"info@Egovision123\"}', '{\"name\":\"nexmo\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 0, 1, 1, 0, 1, 0, 0, 0, 1, 1, 1, 'basic', '[]', NULL, '2024-10-01 21:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '2020-07-06 03:47:55', '2022-04-09 03:47:04'),
(5, 'Hindi', 'hn', 0, '2020-12-29 02:20:07', '2022-04-09 03:47:04'),
(9, 'Bangla', 'bn', 0, '2021-03-14 04:37:41', '2022-03-30 12:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `lense_designs`
--

CREATE TABLE `lense_designs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lens_designs`
--

CREATE TABLE `lens_designs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lens_designs`
--

INSERT INTO `lens_designs` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Attitude', '2024-09-25 07:33:36', '2024-09-25 07:33:36'),
(2, 'Sensual', '2024-09-25 07:33:49', '2024-09-25 07:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `lens_powers`
--

CREATE TABLE `lens_powers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lens_powers`
--

INSERT INTO `lens_powers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '+0.25', '2024-09-27 06:26:52', '2024-09-27 06:26:52'),
(2, '+0.50', '2024-09-27 06:28:22', '2024-09-27 06:28:22'),
(3, '+0.75', '2024-09-27 06:28:48', '2024-09-27 06:28:48'),
(4, '+1.00', '2024-09-27 06:28:58', '2024-09-27 06:28:58'),
(5, '+1.25', '2024-09-27 06:29:13', '2024-09-27 06:29:13'),
(6, '+1.50', '2024-09-27 06:29:24', '2024-09-27 06:29:24'),
(7, '+1.75', '2024-09-27 06:29:30', '2024-09-27 06:29:30'),
(8, '+2.00', '2024-09-27 06:29:37', '2024-09-27 06:29:37'),
(9, '+2.25', '2024-09-27 06:29:50', '2024-09-27 06:29:50'),
(10, '+2.50', '2024-09-27 06:29:59', '2024-09-27 06:29:59'),
(11, '+2.75', '2024-09-27 06:30:10', '2024-09-27 06:30:10'),
(12, '3.00', '2024-09-27 06:30:30', '2024-09-27 06:30:30'),
(13, '+3.00', '2024-09-27 06:31:16', '2024-09-27 06:31:16'),
(14, '+3.25', '2024-09-27 06:31:21', '2024-09-27 06:31:21'),
(15, '+3.50', '2024-09-27 06:31:26', '2024-09-27 06:31:26'),
(16, '+3.75', '2024-09-27 06:31:34', '2024-09-27 06:31:34'),
(17, '+4.00', '2024-09-27 06:31:39', '2024-09-27 06:31:39'),
(18, '+4.25', '2024-09-27 06:31:56', '2024-09-27 06:31:56'),
(19, '+4.50', '2024-09-27 06:32:01', '2024-09-27 06:32:01'),
(20, '+4.75', '2024-09-27 06:32:24', '2024-09-27 06:32:24'),
(21, '+5.00', '2024-09-27 06:32:35', '2024-09-27 06:32:35'),
(22, '+5.25', '2024-09-27 06:33:40', '2024-09-27 06:33:40'),
(23, '+5.50', '2024-09-27 06:33:46', '2024-09-27 06:33:46'),
(24, '+5.75', '2024-09-27 06:34:14', '2024-09-27 06:34:14'),
(25, '+6.00', '2024-09-27 06:34:20', '2024-09-27 06:34:20'),
(26, '+6.25', '2024-09-27 06:36:01', '2024-09-27 06:36:01'),
(27, '+6.50', '2024-09-27 06:36:10', '2024-09-27 06:36:10'),
(28, '+6.75', '2024-09-27 06:36:17', '2024-09-27 06:36:17'),
(29, '+7.00', '2024-09-27 06:36:25', '2024-09-27 06:36:25'),
(30, '+7.25', '2024-09-27 06:37:11', '2024-09-27 06:37:11'),
(31, '+7.50', '2024-09-27 06:37:19', '2024-09-27 06:37:19'),
(32, '+7.75', '2024-09-27 06:37:26', '2024-09-27 06:37:26'),
(33, '+8.00', '2024-09-27 06:37:31', '2024-09-27 06:37:31'),
(34, '+8.25', '2024-09-27 06:37:37', '2024-09-27 06:37:37'),
(35, '+8.50', '2024-09-27 06:37:44', '2024-09-27 06:37:44'),
(36, '+8.75', '2024-09-27 06:37:51', '2024-09-27 06:37:51'),
(37, '+9.00', '2024-09-27 06:37:57', '2024-09-27 06:37:57'),
(38, '+9.25', '2024-09-27 06:38:52', '2024-09-27 06:38:52'),
(39, '+9.50', '2024-09-27 06:38:56', '2024-09-27 06:38:56'),
(40, '+9.75', '2024-09-27 06:39:01', '2024-09-27 06:39:01'),
(41, '+10.00', '2024-09-27 06:39:07', '2024-09-27 06:39:07'),
(42, '+10.25', '2024-09-27 06:39:14', '2024-09-27 06:39:14'),
(43, '+10.50', '2024-09-27 06:39:22', '2024-09-27 06:39:22'),
(44, '+10.75', '2024-09-27 06:39:31', '2024-09-27 06:39:31'),
(45, '+11.00', '2024-09-27 06:39:35', '2024-09-27 06:39:35'),
(46, '+11.25', '2024-09-27 06:39:57', '2024-09-27 06:39:57'),
(47, '+11.50', '2024-09-27 06:40:02', '2024-09-27 06:40:02'),
(48, '+11.75', '2024-09-27 06:40:06', '2024-09-27 06:40:06'),
(49, '+12.00', '2024-09-27 06:40:11', '2024-09-27 06:40:11'),
(50, '+12.25', '2024-09-27 06:41:21', '2024-09-27 06:41:21'),
(51, '+12.50', '2024-09-27 06:41:25', '2024-09-27 06:41:25'),
(52, '+12.75', '2024-09-27 06:41:30', '2024-09-27 06:41:30'),
(53, '+13.00', '2024-09-27 06:41:41', '2024-09-27 06:41:41'),
(54, '+13.25', '2024-09-27 06:41:46', '2024-09-27 06:41:46'),
(55, '+13.50', '2024-09-27 06:41:51', '2024-09-27 06:41:51'),
(56, '+13.75', '2024-09-27 06:41:57', '2024-09-27 06:41:57'),
(57, '+14.00', '2024-09-27 06:42:20', '2024-09-27 06:42:20'),
(58, '+14.25', '2024-09-27 06:42:31', '2024-09-27 06:42:31'),
(59, '+14.50', '2024-09-27 06:42:36', '2024-09-27 06:42:36'),
(60, '+14.75', '2024-09-27 06:42:41', '2024-09-27 06:42:41'),
(61, '+15.00', '2024-09-27 06:42:46', '2024-09-27 06:42:46'),
(62, '+15.25', '2024-09-27 06:42:52', '2024-09-27 06:42:52'),
(63, '+15.50', '2024-09-27 06:42:57', '2024-09-27 06:42:57'),
(64, '+15.75', '2024-09-27 06:43:02', '2024-09-27 06:43:02'),
(65, '+16.00', '2024-09-27 06:43:09', '2024-09-27 06:43:09'),
(66, '+16.25', '2024-09-27 10:14:44', '2024-09-27 10:14:44'),
(67, '+16.50', '2024-09-27 10:15:18', '2024-09-27 10:15:18'),
(68, '+16.75', '2024-09-27 10:15:23', '2024-09-27 10:15:23'),
(69, '+17.00', '2024-09-27 10:15:31', '2024-09-27 10:15:31'),
(70, '+17.25', '2024-09-27 10:15:36', '2024-09-27 10:15:36'),
(71, '+17.50', '2024-09-27 10:15:40', '2024-09-27 10:15:40'),
(72, '+17.75', '2024-09-27 10:15:46', '2024-09-27 10:15:46'),
(73, '+18.00', '2024-09-27 10:15:52', '2024-09-27 10:15:52'),
(74, '+18.25', '2024-09-27 10:15:58', '2024-09-27 10:15:58'),
(75, '+18.50', '2024-09-27 10:16:04', '2024-09-27 10:16:04'),
(76, '+18.75', '2024-09-27 10:16:16', '2024-09-27 10:16:16'),
(77, '+19.00', '2024-09-27 10:16:21', '2024-09-27 10:16:21'),
(78, '+19.25', '2024-09-27 10:17:52', '2024-09-27 10:17:52'),
(79, '+19.50', '2024-09-27 10:17:58', '2024-09-27 10:17:58'),
(80, '+19.75', '2024-09-27 10:18:04', '2024-09-27 10:18:04'),
(81, '+20.00', '2024-09-27 10:18:11', '2024-09-27 10:18:11'),
(82, '-0.25', '2024-09-27 06:26:52', '2024-09-27 06:26:52'),
(83, '-0.50', '2024-09-27 06:28:22', '2024-09-27 06:28:22'),
(84, '-0.75', '2024-09-27 06:28:48', '2024-09-27 06:28:48'),
(85, '-1.00', '2024-09-27 06:28:58', '2024-09-27 06:28:58'),
(86, '-1.25', '2024-09-27 06:29:13', '2024-09-27 06:29:13'),
(87, '-1.50', '2024-09-27 06:29:24', '2024-09-27 06:29:24'),
(88, '-1.75', '2024-09-27 06:29:30', '2024-09-27 06:29:30'),
(89, '-2.00', '2024-09-27 06:29:37', '2024-09-27 06:29:37'),
(90, '-2.25', '2024-09-27 06:29:50', '2024-09-27 06:29:50'),
(91, '-2.50', '2024-09-27 06:29:59', '2024-09-27 06:29:59'),
(92, '-2.75', '2024-09-27 06:30:10', '2024-09-27 06:30:10'),
(93, '3.00', '2024-09-27 06:30:30', '2024-09-27 06:30:30'),
(94, '-3.00', '2024-09-27 06:31:16', '2024-09-27 06:31:16'),
(95, '-3.25', '2024-09-27 06:31:21', '2024-09-27 06:31:21'),
(96, '-3.50', '2024-09-27 06:31:26', '2024-09-27 06:31:26'),
(97, '-3.75', '2024-09-27 06:31:34', '2024-09-27 06:31:34'),
(98, '-4.00', '2024-09-27 06:31:39', '2024-09-27 06:31:39'),
(99, '-4.25', '2024-09-27 06:31:56', '2024-09-27 06:31:56'),
(100, '-4.50', '2024-09-27 06:32:01', '2024-09-27 06:32:01'),
(101, '-4.75', '2024-09-27 06:32:24', '2024-09-27 06:32:24'),
(102, '-5.00', '2024-09-27 06:32:35', '2024-09-27 06:32:35'),
(103, '-5.25', '2024-09-27 06:33:40', '2024-09-27 06:33:40'),
(104, '-5.50', '2024-09-27 06:33:46', '2024-09-27 06:33:46'),
(105, '-5.75', '2024-09-27 06:34:14', '2024-09-27 06:34:14'),
(106, '-6.00', '2024-09-27 06:34:20', '2024-09-27 06:34:20'),
(107, '-6.25', '2024-09-27 06:36:01', '2024-09-27 06:36:01'),
(108, '-6.50', '2024-09-27 06:36:10', '2024-09-27 06:36:10'),
(109, '-6.75', '2024-09-27 06:36:17', '2024-09-27 06:36:17'),
(110, '-7.00', '2024-09-27 06:36:25', '2024-09-27 06:36:25'),
(111, '-7.25', '2024-09-27 06:37:11', '2024-09-27 06:37:11'),
(112, '-7.50', '2024-09-27 06:37:19', '2024-09-27 06:37:19'),
(113, '-7.75', '2024-09-27 06:37:26', '2024-09-27 06:37:26'),
(114, '-8.00', '2024-09-27 06:37:31', '2024-09-27 06:37:31'),
(115, '-8.25', '2024-09-27 06:37:37', '2024-09-27 06:37:37'),
(116, '-8.50', '2024-09-27 06:37:44', '2024-09-27 06:37:44'),
(117, '-8.75', '2024-09-27 06:37:51', '2024-09-27 06:37:51'),
(118, '-9.00', '2024-09-27 06:37:57', '2024-09-27 06:37:57'),
(119, '-9.25', '2024-09-27 06:38:52', '2024-09-27 06:38:52'),
(120, '-9.50', '2024-09-27 06:38:56', '2024-09-27 06:38:56'),
(121, '-9.75', '2024-09-27 06:39:01', '2024-09-27 06:39:01'),
(122, '-10.00', '2024-09-27 06:39:07', '2024-09-27 06:39:07'),
(123, '-10.25', '2024-09-27 06:39:14', '2024-09-27 06:39:14'),
(124, '-10.50', '2024-09-27 06:39:22', '2024-09-27 06:39:22'),
(125, '-10.75', '2024-09-27 06:39:31', '2024-09-27 06:39:31'),
(126, '-11.00', '2024-09-27 06:39:35', '2024-09-27 06:39:35'),
(127, '-11.25', '2024-09-27 06:39:57', '2024-09-27 06:39:57'),
(128, '-11.50', '2024-09-27 06:40:02', '2024-09-27 06:40:02'),
(129, '-11.75', '2024-09-27 06:40:06', '2024-09-27 06:40:06'),
(130, '-12.00', '2024-09-27 06:40:11', '2024-09-27 06:40:11'),
(131, '-12.25', '2024-09-27 06:41:21', '2024-09-27 06:41:21'),
(132, '-12.50', '2024-09-27 06:41:25', '2024-09-27 06:41:25'),
(133, '-12.75', '2024-09-27 06:41:30', '2024-09-27 06:41:30'),
(134, '-13.00', '2024-09-27 06:41:41', '2024-09-27 06:41:41'),
(135, '-13.25', '2024-09-27 06:41:46', '2024-09-27 06:41:46'),
(136, '-13.50', '2024-09-27 06:41:51', '2024-09-27 06:41:51'),
(137, '-13.75', '2024-09-27 06:41:57', '2024-09-27 06:41:57'),
(138, '-14.00', '2024-09-27 06:42:20', '2024-09-27 06:42:20'),
(139, '-14.25', '2024-09-27 06:42:31', '2024-09-27 06:42:31'),
(140, '-14.50', '2024-09-27 06:42:36', '2024-09-27 06:42:36'),
(141, '-14.75', '2024-09-27 06:42:41', '2024-09-27 06:42:41'),
(142, '-15.00', '2024-09-27 06:42:46', '2024-09-27 06:42:46'),
(143, '-15.25', '2024-09-27 06:42:52', '2024-09-27 06:42:52'),
(144, '-15.50', '2024-09-27 06:42:57', '2024-09-27 06:42:57'),
(145, '-15.75', '2024-09-27 06:43:02', '2024-09-27 06:43:02'),
(146, '-16.00', '2024-09-27 06:43:09', '2024-09-27 06:43:09'),
(147, '-16.25', '2024-09-27 10:14:44', '2024-09-27 10:14:44'),
(148, '-16.50', '2024-09-27 10:15:18', '2024-09-27 10:15:18'),
(149, '-16.75', '2024-09-27 10:15:23', '2024-09-27 10:15:23'),
(150, '-17.00', '2024-09-27 10:15:31', '2024-09-27 10:15:31'),
(151, '-17.25', '2024-09-27 10:15:36', '2024-09-27 10:15:36'),
(152, '-17.50', '2024-09-27 10:15:40', '2024-09-27 10:15:40'),
(153, '-17.75', '2024-09-27 10:15:46', '2024-09-27 10:15:46'),
(154, '-18.00', '2024-09-27 10:15:52', '2024-09-27 10:15:52'),
(155, '-18.25', '2024-09-27 10:15:58', '2024-09-27 10:15:58'),
(156, '-18.50', '2024-09-27 10:16:04', '2024-09-27 10:16:04'),
(157, '-18.75', '2024-09-27 10:16:16', '2024-09-27 10:16:16'),
(158, '-19.00', '2024-09-27 10:16:21', '2024-09-27 10:16:21'),
(159, '-19.25', '2024-09-27 10:17:52', '2024-09-27 10:17:52'),
(160, '-19.50', '2024-09-27 10:17:58', '2024-09-27 10:17:58'),
(161, '-19.75', '2024-09-27 10:18:04', '2024-09-27 10:18:04'),
(162, '-20.00', '2024-09-27 10:18:11', '2024-09-27 10:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Polymacon', '2024-08-21 11:43:08', '2024-08-21 11:43:22'),
(3, 'Hioxifilcon D', '2024-08-21 11:43:44', '2024-08-21 11:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_14_061757_create_support_tickets_table', 3),
(5, '2020_06_14_061837_create_support_messages_table', 3),
(6, '2020_06_14_061904_create_support_attachments_table', 3),
(7, '2020_06_14_062359_create_admins_table', 3),
(8, '2020_06_14_064604_create_transactions_table', 4),
(9, '2020_06_14_065247_create_general_settings_table', 5),
(12, '2014_10_12_100000_create_password_resets_table', 6),
(13, '2020_06_14_060541_create_user_logins_table', 6),
(14, '2020_06_14_071708_create_admin_password_resets_table', 7),
(15, '2020_09_14_053026_create_countries_table', 8),
(16, '2021_03_15_084721_create_admin_notifications_table', 9),
(17, '2016_06_01_000001_create_oauth_auth_codes_table', 10),
(18, '2016_06_01_000002_create_oauth_access_tokens_table', 10),
(19, '2016_06_01_000003_create_oauth_refresh_tokens_table', 10),
(20, '2016_06_01_000004_create_oauth_clients_table', 10),
(21, '2016_06_01_000005_create_oauth_personal_access_clients_table', 10),
(22, '2021_05_08_103925_create_sms_gateways_table', 11),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 12),
(24, '2021_05_23_111859_create_email_logs_table', 13),
(25, '2022_02_26_061836_create_forms_table', 14),
(26, '2024_08_21_163708_create_base_curves_table', 15),
(27, '2024_08_21_175909_create_lense_designs_table', 15),
(28, '2024_08_29_171150_create_prescriptions_table', 15),
(29, '2024_09_22_130708_add_thumbnail_to_product_categories', 15),
(30, '2024_09_22_160005_add_description_to_category', 16),
(31, '2024_09_22_180624_add_columns_to_colors', 17),
(32, '2024_09_22_181556_drop_column_from_colors', 18),
(33, '2024_09_22_181817_add_column_to_colors', 19),
(34, '2024_09_23_104128_create_banners_table', 20),
(35, '2024_09_23_114725_add_column_to_banner', 21),
(36, '2024_09_24_122222_create_durations_table', 22),
(37, '2024_09_24_124346_add_month_to_durations', 23),
(38, '2024_09_24_122902_add_fields_to_durations', 24),
(39, '2024_09_24_135927_add_duration_id_to_product', 25),
(40, '2024_09_24_140124_drop_duration_id_from_durations', 26),
(41, '2024_09_24_140317_add_duration_id_to_products', 27),
(42, '2024_09_24_154633_create_collection_sets_table', 28),
(43, '2024_09_26_103101_add_color_code_to_colors', 29),
(44, '2024_09_26_112620_add_product_type_to_products', 30),
(45, '2024_09_26_120153_add_fields_to_collection_set', 31),
(46, '2024_09_27_120810_create_lens_powers_table', 32),
(47, '2024_09_27_171521_create_product_variations_table', 33),
(48, '2024_09_28_023852_create_carts_table', 34),
(49, '2024_09_28_153144_drop_columns_from_carts_table', 35),
(50, '2024_09_28_153501_add_column_to_carts', 36),
(51, '2024_09_29_170717_add_timestamps_to_orders_table', 37),
(52, '2024_09_30_110531_create_wishlists_table', 38);

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sender` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_logs`
--

INSERT INTO `notification_logs` (`id`, `user_id`, `sender`, `sent_from`, `sent_to`, `subject`, `message`, `notification_type`, `created_at`, `updated_at`) VALUES
(1, 51, 'smtp', 'info@egovision.shop', 'najmussakib173@gmail.com', 'Please verify your email address', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello Najmus Sakib ()</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\"><br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;595645</span></font></div></div></td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2024 <a href=\"#\">Ego Vision</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'email', '2024-10-02 09:42:30', '2024-10-02 09:42:30'),
(2, 55, 'php', 'info@egovision.shop', 'dilshanahmed2025@gmail.com', 'Please verify your email address', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello Esahara Dilshan ()</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\"><br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;894396</span></font></div></div></td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">Ego Vision</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'email', '2024-10-02 09:47:20', '2024-10-02 09:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT 1,
  `sms_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', '<div><div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been added to your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}&nbsp;</span></font><br></div><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin note:&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 12px; font-weight: 600; white-space: nowrap; text-align: var(--bs-body-text-align);\">{{remark}}</span></div>', '{{amount}} {{site_currency}} credited in your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin note is \"{{remark}}\"', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:18:28'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been subtracted from your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}</span></font><br><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin Note: {{remark}}</div>', '{{amount}} {{site_currency}} debited from your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin Note is {{remark}}', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:24:11'),
(3, 'DEPOSIT_COMPLETE', 'Deposit - Automated - Successful', 'Deposit Completed Successfully', '<div>Your deposit of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit successfully by {{method_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:25:43'),
(4, 'DEPOSIT_APPROVE', 'Deposit - Manual - Approved', 'Your Deposit is Approved', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:26:07'),
(5, 'DEPOSIT_REJECT', 'Deposit - Manual - Rejected', 'Your Deposit Request is Rejected', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:45:27'),
(6, 'DEPOSIT_REQUEST', 'Deposit - Manual - Requested', 'Deposit Request Submitted Successfully', '<div>Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:29:19'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', '{\"code\":\"Email verification code\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '---', 'Your phone verification code is: {{code}}', '{\"code\":\"SMS Verification Code\"}', 0, 1, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(12, 'WITHDRAW_APPROVE', 'Withdraw - Approved', 'Withdraw Request has been Processed and your money is sent', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Processed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Processed Payment :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div>', 'Admin Approve Your {{amount}} {{site_currency}} withdraw request by {{method_name}}. Transaction {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"admin_details\":\"Details provided by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:50:16'),
(13, 'WITHDRAW_REJECT', 'Withdraw - Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Rejected.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You should get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">----</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><br></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\">{{amount}} {{currency}} has been&nbsp;<span style=\"font-weight: bolder;\">refunded&nbsp;</span>to your account and your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}}</span><span style=\"font-weight: bolder;\">&nbsp;{{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Rejection :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br><br><br></div><div></div><div></div>', 'Admin Rejected Your {{amount}} {{site_currency}} withdraw request. Your Main Balance {{post_balance}}  {{method_name}} , Transaction {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this action\",\"admin_details\":\"Rejection message by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:57:46'),
(14, 'WITHDRAW_REQUEST', 'Withdraw - Requested', 'Withdraw Request Submitted Successfully', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been submitted Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br></div>', '{{amount}} {{site_currency}} withdraw requested by {{method_name}}. You will get {{method_amount}} {{method_currency}} Trx: {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-21 04:39:03'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(16, 'KYC_APPROVE', 'KYC Approved', 'KYC has been approved', NULL, NULL, '[]', 1, 1, NULL, NULL),
(17, 'KYC_REJECT', 'KYC Rejected Successfully', 'KYC has been rejected', NULL, NULL, '[]', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `address_one` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_two` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_charge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `amount`, `address_one`, `status`, `transaction_id`, `currency`, `user_id`, `address_two`, `company`, `city`, `state`, `country`, `zip_code`, `delivery_charge`, `subtotal`, `payment_method`, `created_at`, `updated_at`) VALUES
(85, 'Dilshan Ahmed', 'dilshaneffendi1123@gmail.com', '+88001984603367', 1030, 'Indira road', 'Pending', '66fbbac872ced', 'BDT', 42, NULL, NULL, 'Dhaka', 'Dhaka District', 'Bangladesh', '1215', '60', '970', 'ssl', '2024-10-01 09:03:04', '2024-10-01 09:03:04'),
(87, 'Dilshan Ahmed', 'dilshaneffendi1123@gmail.com', '+9301984603367', 5880, 'Indira road', 'Pending', '66fbc4829177b', 'BDT', 42, NULL, NULL, 'Dhaka', 'Dhaka District', 'Bangladesh', '1215', '60', '5820', 'cod', '2024-10-01 09:44:34', '2024-10-01 09:44:34'),
(88, 'Dilshan Ahmed', 'dilshaneffendi1123@gmail.com', '+9301984603367', 2970, 'Indira road', 'Pending', '66fbc4df01300', 'BDT', 42, NULL, NULL, 'Dhaka', 'Dhaka District', 'Bangladesh', '1215', '60', '2910', 'cod', '2024-10-01 09:46:07', '2024-10-01 09:46:07'),
(89, 'Hamish Hubbard', 'kedihybu@mailinator.com', '+1284+1 (973) 136-9431', 914, '39 Hague Lane', 'Pending', '66fbc68d7f5fe', 'BDT', 42, 'Quo nostrum sed eum', 'Martin Wolf Plc', 'Quia incidunt omnis', 'Ondo State', 'Nigeria', '54271', '60', '854', 'cod', '2024-10-01 09:53:17', '2024-10-01 09:53:17'),
(90, 'Shah Razi Siddiqui', 'devilsmack.anik@gmail.com', '+8801710070606', 871, 'Flat B9, House 52, Ranavola Main Road, Sector 10, Uttara, Dhaka-1230, Bangladesh.', 'Pending', '66fbe06ba970a', 'BDT', 42, NULL, 'CODETREE', 'Dhaka', 'Dhaka District', 'Bangladesh', '1230', '60', '811', 'ssl', '2024-10-01 11:43:39', '2024-10-01 11:43:39'),
(91, 'Najmus Sakib', 'najmussakib173@gmail.com', '+8801726920703', 1659130, 'Dhaka', 'Pending', '66fbf1d7eaaae', 'BDT', 51, 'Ramoura', 'codetree', 'Dhaka', 'Sylhet District', 'Bangladesh', '1230', '60', '1659070', 'ssl', '2024-10-01 12:57:59', '2024-10-01 12:57:59'),
(92, 'Tasha Hahn', 'temuv@mailinator.com', '+966+1 (965) 498-6839', 7560, '76 Green Hague Court', 'Pending', '66fbfecb2688b', 'BDT', 53, 'Asperiores eum fugia', 'Obrien and Britt Co', 'Sunt omnis corrupti', 'Žilina Region', 'Slovakia', '45615', '60', '7500', 'cod', '2024-10-01 13:53:15', '2024-10-01 13:53:15'),
(93, 'John Doe', 'john@example.com', '123456789', 1050, '123 Main St', 'Pending', '66fc2e181ebb2', 'BDT', 42, 'Apt 4B', 'Example Co.', 'Dhaka', 'Dhaka', 'Bangladesh', '1212', '50', '1000', 'cod', '2024-10-01 23:15:04', '2024-10-01 23:15:04'),
(94, 'Dilshan Ahmed', 'dilshaneffendi1123@gmail.com', '+9301984603367', 12260, 'Indira road', 'Pending', '66fcfcdd8adef', 'BDT', 42, NULL, NULL, 'Dhaka', 'Dhaka District', 'Bangladesh', '1215', '60', '12200', 'ssl', '2024-10-02 07:57:17', '2024-10-02 07:57:17'),
(95, 'Dilshan Ahmed', 'dilshaneffendi1123@gmail.com', '+88001984603367', 260, 'Indira road', 'Pending', '66fcfcf2c4a8b', 'BDT', 42, NULL, NULL, 'Dhaka', 'Dhaka District', 'Bangladesh', '1215', '60', '200', 'ssl', '2024-10-02 07:57:38', '2024-10-02 07:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `power` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pair` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `order_id` bigint(20) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `power`, `pair`, `price`, `created_at`, `updated_at`, `order_id`) VALUES
(21, '10', NULL, '1', '970', '2024-10-01 09:03:04', '2024-10-01 09:03:04', 85),
(22, '10', '+0.50', '3', '2910', '2024-10-01 09:44:34', '2024-10-01 09:44:34', 87),
(24, '10', '+0.75', '3', '2910', '2024-10-01 09:46:07', '2024-10-01 09:46:07', 88),
(25, '14', NULL, '1', '854', '2024-10-01 09:53:17', '2024-10-01 09:53:17', 89),
(26, '13', NULL, '1', '811', '2024-10-01 17:43:39', '2024-10-01 17:43:39', 90),
(27, '15', NULL, '2', '1659070', '2024-10-01 18:57:59', '2024-10-01 18:57:59', 91),
(28, '7', NULL, '1', '7500', '2024-10-01 19:53:15', '2024-10-01 19:53:15', 92),
(29, '1', 'Power 1', '2', '500', '2024-10-01 23:15:04', '2024-10-01 23:15:04', 93),
(31, '6', NULL, '2', '12000', '2024-10-02 07:57:17', '2024-10-02 07:57:17', 94),
(33, '18', NULL, '2', '200', '2024-10-02 07:57:38', '2024-10-02 07:57:38', 95);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"about\",\"blog\",\"counter\",\"faq\",\"feature\",\"service\",\"subscribe\"]', 1, '2020-07-11 06:23:58', '2022-03-15 06:56:00'),
(4, 'Blog', 'blog', 'templates.basic.', NULL, 1, '2020-10-22 01:14:43', '2020-10-22 01:14:43'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, 1, '2020-10-22 01:14:53', '2020-10-22 01:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ronnie@gmail.com', '100375', '2020-07-07 05:44:47'),
('user@site.comfff', '988862', '2021-05-07 07:31:28'),
('mosta@gmail.com', '865544', '2021-06-10 09:21:05'),
('user@site.com', '727340', '2022-09-20 05:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(29, 'App\\Models\\User', 22, 'MyApp', '5da1bfd64a5d95722d5c085185f0787323270c5cf12d09c5a69e4f950f4d8420', '[\"*\"]', NULL, NULL, '2021-05-19 05:47:02', '2021-05-19 05:47:02'),
(46, 'App\\Models\\User', 25, 'auth_token', 'bc7288b4e2082a0475639d6e2f29483a35abd11f55110df12244d9142f7ca54a', '[\"*\"]', NULL, NULL, '2021-06-10 05:35:17', '2021-06-10 05:35:17'),
(47, 'App\\Models\\User', 25, 'auth_token', '2bcdbee9ab110af212b02516a602ba52cf27a6aa844901acbb2fbfc09c95bb34', '[\"*\"]', NULL, NULL, '2021-06-10 06:31:50', '2021-06-10 06:31:50'),
(51, 'App\\Models\\User', 26, 'auth_token', 'c792344d1730dde4e418f6380309b24767062dc5e9c6757fce88675f7bbff9f3', '[\"*\"]', NULL, NULL, '2021-06-10 08:38:29', '2021-06-10 08:38:29'),
(53, 'App\\Models\\User', 24, 'auth_token', '36c0eb2f6065deb315bd996e158aed1d6c06f4a04879317bcf1961ea786a675c', '[\"*\"]', '2021-06-10 13:04:13', NULL, '2021-06-10 09:36:52', '2021-06-10 13:04:13'),
(54, 'App\\Models\\User', 24, 'auth_token', 'ddcfe3a5d501093c86a0a376a125099517199ea17ee9d4d78be12e476e413b40', '[\"*\"]', '2021-06-10 10:05:35', NULL, '2021-06-10 10:05:22', '2021-06-10 10:05:35'),
(55, 'App\\Models\\User', 24, 'auth_token', 'ecf248b74ee8bff942c22b299ccb3afe840a589b7dbd62b9897cbe46ea6c8941', '[\"*\"]', NULL, NULL, '2021-06-10 11:56:06', '2021-06-10 11:56:06'),
(60, 'App\\Models\\User', 31, 'auth_token', '29647be4a8b5510c717c50b8279d168717ebcc25b3d0155fcc840cd315527112', '[\"*\"]', NULL, NULL, '2022-03-22 11:22:57', '2022-03-22 11:22:57'),
(64, 'App\\Models\\User', 8, 'auth_token', '710ea03f99855951e40875d7bfc2ffbabf4a8316d2b527de20ceac02029af6b9', '[\"*\"]', '2022-09-25 04:50:11', NULL, '2022-08-03 06:04:12', '2022-09-25 04:50:11'),
(65, 'App\\Models\\User', 33, 'auth_token', '2ff064418c422255032f6530e80f18a8b552aabd8a95018a163452af086d0014', '[\"*\"]', NULL, NULL, '2022-09-29 06:59:30', '2022-09-29 06:59:30'),
(66, 'App\\Models\\User', 8, 'auth_token', 'b11af6742cfc224a5fe6d1faeac5ac10b3fe22eb960c2a7dd21ac20866952c47', '[\"*\"]', '2022-10-24 06:29:07', NULL, '2022-10-24 06:27:52', '2022-10-24 06:29:07'),
(67, 'App\\Models\\User', 37, 'MyApp', 'c922274c82793165e763de40074e140d17ceb78a80af56e69f05705319022aaf', '[\"*\"]', NULL, NULL, '2024-08-18 05:36:30', '2024-08-18 05:36:30'),
(68, 'App\\Models\\User', 38, 'MyApp', '3ede004680e6b1c5a4eff44ea01e415c3e5a1ecdce35b6ec5784ce4a2ca54626', '[\"*\"]', NULL, NULL, '2024-08-18 05:43:05', '2024-08-18 05:43:05'),
(69, 'App\\Models\\User', 39, 'MyApp', '2ed6d4a99380813a8a22ee5766d5e45bf4c87ba17cd6bb6c31932c8caa16dbff', '[\"*\"]', NULL, NULL, '2024-08-18 05:49:25', '2024-08-18 05:49:25'),
(70, 'App\\Models\\User', 39, 'MyApp', 'add1759fe7c95a8362169fd23afd735818045ead2cbf0f7a75e6755e5fc98da6', '[\"*\"]', NULL, NULL, '2024-08-18 05:52:18', '2024-08-18 05:52:18'),
(71, 'App\\Models\\User', 39, 'MyApp', 'f93a592542bf5eeb3b368f4428e5c45cb8447e0164ceeebee4eeeb7cab3ee9b8', '[\"*\"]', NULL, NULL, '2024-08-18 05:54:27', '2024-08-18 05:54:27'),
(72, 'App\\Models\\User', 39, 'MyApp', '054a08b60154cfd578b6a736441aad0c04a964a7f3cef3ff3235443432b79fa4', '[\"*\"]', NULL, NULL, '2024-08-18 05:54:47', '2024-08-18 05:54:47'),
(73, 'App\\Models\\User', 39, 'MyApp', '7f0fd4279c461967ef7469c8aadc2593730202d184622a260eb79a08a15ed652', '[\"*\"]', NULL, NULL, '2024-08-18 06:00:07', '2024-08-18 06:00:07'),
(74, 'App\\Models\\User', 39, 'MyApp', 'bd9cc2bb3b92bcb0f50847ec16bf076b7a2c3a52bdac1b319a953a067c24089b', '[\"*\"]', NULL, NULL, '2024-08-18 06:14:34', '2024-08-18 06:14:34'),
(75, 'App\\Models\\User', 40, 'MyApp', '15b8d8e970055d81edb37907030cfb35952c353f55dce1e164c475595a93e08f', '[\"*\"]', NULL, NULL, '2024-08-18 06:26:32', '2024-08-18 06:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT 0,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `created_at`, `updated_at`, `user_id`, `file`) VALUES
(1, '2024-10-02 10:50:03', '2024-10-02 10:50:03', 55, 'prescriptions/1727866203_Dilshan\'sCV.pdf'),
(2, '2024-10-02 10:53:16', '2024-10-02 10:53:16', 55, 'prescriptions/1727866396_1726999840_SP_box.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_intro` text NOT NULL,
  `description` text NOT NULL,
  `pack_content` varchar(255) DEFAULT NULL,
  `diameter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `base_curve_id` bigint(20) UNSIGNED DEFAULT NULL,
  `material_id` bigint(20) UNSIGNED DEFAULT NULL,
  `water_content` varchar(255) DEFAULT NULL,
  `tone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lens_design_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `color_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `duration_id` varchar(255) DEFAULT NULL,
  `product_type` enum('normal','accessories') NOT NULL DEFAULT 'normal',
  `is_default_bag` tinyint(1) DEFAULT NULL,
  `is_free` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `product_intro`, `description`, `pack_content`, `diameter_id`, `base_curve_id`, `material_id`, `water_content`, `tone_id`, `lens_design_id`, `price`, `stock_quantity`, `color_id`, `category_id`, `image_path`, `duration_id`, `product_type`, `is_default_bag`, `is_free`, `created_at`, `updated_at`) VALUES
(5, 'IRRESISTIBLE BLUE', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Step into the hypnotic allure of Irresistible Blue, a 3-toned blue colored contact lens designed to enchant those around you. Comfort and versatility with our Polymacon lenses, featuring 38% water content for three months. Perfect for a range of vision needs, they correct myopia, hyperopia, and astigmatism with options from -13.00 to +6.00 diopters or no power for perfect vision. Each 14.4 mm diameter lens fits comfortably with an 8.7 mm base curve. Free lens case with every pair.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><em style=\"box-sizing: inherit;\">Lens appearance may vary based on iris color.</em></p><br><br><br><br><br><br>', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">IRRESISTIBLE BLUE- QUARTERLY COLOR CONTACTS - THREE TONES</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">3 toned hypnotic blue quarterly colored contact lens to allure those around you.<br style=\"box-sizing: inherit;\">The corrective version is available in myopia, hyperopia and astigmatism.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">The effect given by the colored contact lenses may vary depending on the original color of your iris. Scroll through the above pictures, to see how they could appear on you!</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Plano lenses</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">If you do not require correction, please select no power.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Box Content</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">Each Desio box contains 2 contact lenses with the same color and power, stored in separate blisters submerged in sterile saline solution. The Box content is specified above the quantity selector.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Different correction for each eye</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">If you require a different correction for each eye, you will need to order two boxes: one with your left eye correction and the second with your right eye correction. Unfortunately, we cannot open the original packagings and mix your prescriptions.<br style=\"box-sizing: inherit;\">Please select the box \"I need 2 different powers” to be able to select both corrections.<br style=\"box-sizing: inherit;\">If you require the same correction for both eyes, please leave the checkbox unselected.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Toric lenses for astigmatism</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\">Irresistible Blue toric lenses</strong><span>&nbsp;</span>production time:<strong style=\"box-sizing: inherit; font-weight: bolder;\"><span>&nbsp;</span>Approximately 5 weeks.</strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">They are specially made for you on preorder. Toric orders are final and CANNOT be modified once they are placed in production. Prescription is required for all Toric lenses orders.</p><br><br><br><br><br><br>', '2 lenses (1 pair)', 2, 1, 2, '38%', 2, 1, '7000.00', 50, 5, 3, 'ego-assets/images/products/160083.jpg', '6', 'normal', NULL, NULL, '2024-08-20 08:10:59', '2024-08-20 08:10:59'),
(6, 'PRECIOUS GREY', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Discover the depth of Precious Grey, deep precious grey colored contact lenses with 3 tones. Comfort and versatility with our Polymacon lenses, featuring 38% water content for three months. Perfect for a range of vision needs, they correct myopia, hyperopia, and astigmatism with options from -13.00 to +6.00 diopters or no power for perfect vision. Each 14.4 mm diameter lens fits comfortably with an 8.7 mm base curve. Free lens case with every pair.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><em style=\"box-sizing: inherit;\">Lens appearance may vary based on iris color.</em></p>', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">PRECIOUS GREY- QUARTERLY COLOR CONTACTS - THREE TONES</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Deep precious grey quarterly colored contact lens with 3 exquisite tones.<br style=\"box-sizing: inherit;\">The corrective version is available in myopia, hyperopia and astigmatism.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">The effect given by the colored contact lenses may vary depending on the original color of your iris. Scroll through the above pictures, to see how they could appear on you!</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Plano lenses</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">If you do not require correction, please select no power.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Box Content</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">Each Desio box contains 2 contact lenses with the same color and power, stored in separate blisters submerged in sterile saline solution. The Box content is specified above the quantity selector.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Different correction for each eye</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">If you require a different correction for each eye, you will need to order two boxes: one with your left eye correction and the second with your right eye correction. Unfortunately, we cannot open the original packagings and mix your prescriptions.<br style=\"box-sizing: inherit;\">Please select the box \"I need 2 different powers” to be able to select both corrections.<br style=\"box-sizing: inherit;\">If you require the same correction for both eyes, please leave the checkbox unselected.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Toric lenses for astigmatism</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\">Precious Grey toric lenses</strong><span>&nbsp;</span>production time:<span>&nbsp;</span><strong style=\"box-sizing: inherit; font-weight: bolder;\">Approximately 5 weeks</strong>.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">They are specially made for you on preorder. Toric orders are final and CANNOT be modified once they are placed in production. Prescription is required for all Toric lenses orders.</p>', '2 lenses (1 pair)', 4, 2, 3, '37%', 4, 2, '6000.00', 860, 5, 10, 'ego-assets/images/products/699118.jpg', '8', 'normal', NULL, NULL, '2024-08-20 11:26:24', '2024-08-20 11:26:24'),
(7, 'TENDER HAZEL', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Tender Hazel offers a smooth brown hazel colored 3-toned colored contact lens that beautifully complements any eye color. Comfort and versatility with our Polymacon lenses, featuring 38% water content for three months. Perfect for a range of vision needs, they correct myopia, hyperopia, and astigmatism with options from -13.00 to +6.00 diopters or no power for perfect vision. Each 14.4 mm diameter lens fits comfortably with an 8.7 mm base curve. Free lens case with every pair.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><em style=\"box-sizing: inherit;\">Lens appearance may vary based on iris color.</em></p>', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">TENDER HAZEL- QUARTERLY COLOR CONTACTS - THREE TONES</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">A smooth brown hazel colored 3 toned quarterly contact lens to devote your closest.<br style=\"box-sizing: inherit;\">The corrective version is available in myopia, hyperopia and astigmatism.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">The effect given by the colored contact lenses may vary depending on the original color of your iris. Scroll through the above pictures, to see how they could appear on you!</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Plano lenses</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">If you do not require correction, please select no power.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Box Content</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">Each Desio box contains 2 contact lenses with the same color and power, stored in separate blisters submerged in sterile saline solution. The Box content is specified above the quantity selector.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Different correction for each eye</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">If you require a different correction for each eye, you will need to order two boxes: one with your left eye correction and the second with your right eye correction. Unfortunately, we cannot open the original packagings and mix your prescriptions.<br style=\"box-sizing: inherit;\">Please select the box \"I need 2 different powers” to be able to select both corrections.<br style=\"box-sizing: inherit;\">If you require the same correction for both eyes, please leave the checkbox unselected.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Toric lenses for astigmatism</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\">Tender Hazel toric lenses</strong><span>&nbsp;</span>production time:<span>&nbsp;</span><strong style=\"box-sizing: inherit; font-weight: bolder;\">Approximately 5 weeks</strong>.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">They are specially made for you on preorder. Toric orders are final and CANNOT be modified once they are placed in production. Prescription is required for all Toric lenses orders.</p>', '2 lenses (1 pair)', 3, 1, 3, '38%', 3, 2, '7500.00', 300, 5, 3, 'ego-assets/images/products/427480.jpg', '6', 'normal', NULL, NULL, '2024-08-20 11:43:13', '2024-08-20 11:43:13'),
(8, 'WILD GREEN', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">Step into the natural world with Wild Green colored contact lenses, perfect for adding a vibrant touch to your look. Comfort and versatility with our Polymacon lenses, featuring 38% water content for three months. Perfect for a range of vision needs, they correct myopia, hyperopia, and astigmatism with options from -13.00 to +6.00 diopters or no power for perfect vision. Each 14.5 mm diameter lens fits comfortably with an 8.7 mm base curve. Free lens case with every pair.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><em style=\"box-sizing: inherit;\">Lens appearance may vary based on iris color.</em></p>', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Brilliant and determinate. Exuding confidence and still able to see the humor in life.<br style=\"box-sizing: inherit;\">These vibrant green lenses act as weapons of seduction, irresistible to others.<br style=\"box-sizing: inherit;\">Wild Green is a quarterly colored contact lens available without power (0.00), in myopia, hyperopia and astigmatism.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">The effect given by the colored contact lenses may vary depending on the original color of your iris. Scroll through the above pictures, to see how they could appear on you!</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Plano lenses</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">If you do not require correction, please select no power.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Box Content</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">Each Desio box contains 2 contact lenses with the same color and power, stored in separate blisters submerged in sterile saline solution. The Box content is specified above the quantity selector.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Different correction for each eye</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">If you require a different correction for each eye, you will need to order two boxes: one with your left eye correction and the second with your right eye correction. Unfortunately, we cannot open the original packagings and mix your prescriptions.<br style=\"box-sizing: inherit;\">Please select the box \"I need 2 different powers” to be able to select both corrections.<br style=\"box-sizing: inherit;\">If you require the same correction for both eyes, please leave the checkbox unselected.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\"><span style=\"box-sizing: inherit; text-decoration: underline;\">Toric lenses for astigmatism</span></strong></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\"><strong style=\"box-sizing: inherit; font-weight: bolder;\">Wild Green toric lenses</strong><span>&nbsp;</span>production time:<span>&nbsp;</span><strong style=\"box-sizing: inherit; font-weight: bolder;\">Approximately 5 weeks</strong>.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\">They are specially made for you on preorder. Toric orders are final and CANNOT be modified once they are placed in production. Prescription is required for all Toric lenses orders.</p>', '2 lenses (1 pair)', 2, 2, 2, '38%', 2, 1, '3500.00', 250, 4, 4, 'ego-assets/images/products/684912.jpg', '8', 'normal', NULL, NULL, '2024-08-20 11:51:03', '2024-08-20 11:51:03'),
(9, 'Hamish Talley', '<p>Molestiae quo quam q.</p>', '<p>Officiis reprehender.</p>', 'Cade Nixon', 4, 1, 3, '36%', 3, 1, '104.00', 69, 4, 4, 'ego-assets/images/products/848995.jpg', '6', 'normal', NULL, NULL, '2024-08-21 05:24:38', '2024-08-21 05:24:38'),
(10, 'Jennifer Strickland', '<p>Id, quas et dolores .</p>', '<p>Nostrum vitae est cu.</p>', 'Vaughan Yang', 3, 2, 3, '36%', 3, 2, '970.00', 521, 4, 4, 'ego-assets/images/products/227620.jpg', '8', 'normal', NULL, NULL, '2024-08-21 05:27:13', '2024-08-21 05:27:13'),
(13, 'Wynter Rowland', '<p>Quia id, tenetur lab.</p>', '<p>Impedit, corrupti, n.</p>', 'Hannah Hodge', 3, 1, 3, '36%', 4, 1, '811.00', 353, 5, 10, 'ego-assets/images/products/160083.jpg', '6', 'normal', NULL, NULL, '2024-08-21 07:14:04', '2024-08-21 07:14:04'),
(14, 'Quamar Stokes', '<p>Aute culpa, dolor at.</p>', '<p>Omnis qui omnis volu.</p>', 'Hope Beck', 4, 2, 3, '30%', 3, 2, '800.00', 989, 5, 4, 'ego-assets/images/products/258746.jpg', '8', 'normal', NULL, NULL, '2024-09-26 16:29:06', '2024-09-26 16:29:06'),
(15, 'cFdTCKLvcG', '<p>vgjjghjghj</p>', '<p>ghvjbhvmjb</p>', '7nFEeZq9iw', 2, 1, 3, 'water content', 2, 2, '829535.00', 408095, 3, 3, 'ego-assets/images/products/529363.jpg', '6', 'normal', NULL, NULL, '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(16, 'Odette Sharpe', '<p>Magna officia enim h.</p>', '<p>Aliquam dolore a qui.</p>', 'Brody Boyer', 3, 1, NULL, NULL, NULL, NULL, '649.00', 124, NULL, NULL, 'ego-assets/images/products/260283.jpg', '6', 'accessories', NULL, NULL, '2024-09-30 09:34:34', '2024-09-30 09:34:34'),
(17, 'Desio Black Pochette', '<div class=\"product attribute overview\" style=\"box-sizing: inherit; order: 3; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"value\" itemprop=\"description\" style=\"box-sizing: inherit;\"><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem;\">Desio black patent pochette closed with a one-handled silver zipper.</p></div></div><div class=\"product-info-tabs\" style=\"box-sizing: inherit; display: flex; flex-wrap: wrap; border-top: 1px solid rgb(230, 230, 230); order: 5; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"product-info-tab\" style=\"box-sizing: inherit; flex: 0 0 50%; max-width: 50%; border-bottom: 1px solid rgb(230, 230, 230); padding: 0.9375rem; border-right: 1px solid rgb(230, 230, 230);\"><br class=\"Apple-interchange-newline\"></div></div>', '<p><span style=\"color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">Desio black patent pochette closed with a one-handled silver zipper. The style of this product is the perfect combination of Italian design and a specialized manufacturing process. The ideal solution for keeping all the essential accessories in one safe place. Make sure you find the most important things in your bag right when you need them with this small purse. Dimensions: 215 x 165 x 42 mm</span></p>', '2 lenses (1 pair)', 3, 2, NULL, NULL, NULL, NULL, '1700.00', 20, NULL, NULL, 'ego-assets/images/products/677163.jpg', '6', 'accessories', 0, 1, '2024-10-02 04:35:55', '2024-10-02 04:42:28');
INSERT INTO `products` (`id`, `name`, `product_intro`, `description`, `pack_content`, `diameter_id`, `base_curve_id`, `material_id`, `water_content`, `tone_id`, `lens_design_id`, `price`, `stock_quantity`, `color_id`, `category_id`, `image_path`, `duration_id`, `product_type`, `is_default_bag`, `is_free`, `created_at`, `updated_at`) VALUES
(18, 'Desio Brush Set', '<div class=\"product attribute overview\" style=\"box-sizing: inherit; order: 3; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"value\" itemprop=\"description\" style=\"box-sizing: inherit;\">Desio Luxury Brush Set (5 pcs)</div></div><div class=\"product-info-tabs\" style=\"box-sizing: inherit; display: flex; flex-wrap: wrap; border-top: 1px solid rgb(230, 230, 230); order: 5; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><div class=\"product-info-tab\" style=\"box-sizing: inherit; flex: 0 0 50%; max-width: 50%; border-bottom: 1px solid rgb(230, 230, 230); padding: 0.9375rem; border-right: 1px solid rgb(230, 230, 230);\"><br class=\"Apple-interchange-newline\"></div></div>', '<p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Desio Makeup Brushes, stored in a Desio pochette.</p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">The set contains:</p><ul style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"box-sizing: inherit;\">1 foundation brush</li><li style=\"box-sizing: inherit;\">1 blush brush</li><li style=\"box-sizing: inherit;\">1 Blending brush</li><li style=\"box-sizing: inherit;\">1 shader brush</li><li style=\"box-sizing: inherit;\">1 concealer brush</li></ul>', NULL, 3, 1, NULL, NULL, NULL, NULL, '100.00', 11, NULL, NULL, 'ego-assets/images/products/790562.jpg', NULL, 'accessories', 1, 1, '2024-10-02 04:42:28', '2024-10-02 04:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_at`, `updated_at`, `thumbnail`, `description`) VALUES
(3, 'Timeless Collection', '2024-08-18 12:50:35', '2024-09-22 10:21:47', 'ego-assets/images/product_categories/1727000157_TC_box.jpg', '<h4 style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 0.5rem; font-family: Prata; font-weight: 400; font-size: 1.25rem; color: rgb(0, 0, 0); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">3 Tones - Monthly</h4><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 14px;\">Experience timeless elegance with Desio\'s Timeless Collection, ideal for achieving a subtle, natural eye color. Tailored for dark brown eyes, our collection satisfies your desire for darker lenses that seamlessly blend with your natural eye color. What sets this collection apart is the 14.2 lens diameter, a feature sought after by many of our customers</span></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Diameter: 14.2mm - Base curve 8.6mm</span><br style=\"box-sizing: inherit;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Availability: From -8.00 to +4.00</span></p>'),
(4, 'Attitude Collection', '2024-08-18 12:50:47', '2024-09-22 10:19:01', 'ego-assets/images/product_categories/1727000341_A3T_box.jpg', '<h4 style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 0.5rem; font-family: Prata; font-weight: 400; font-size: 1.25rem; color: rgb(0, 0, 0); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">2 Tones - Quarterly</h4><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 14px;\">The Attitude 2 tones Quarterly color contact lenses are designed with a base color and a limbal ring. Wild Green, Delicious Honey, Romantic Blue or Rebel Grey are the ultimate choice for a classic look. This collection offers both prescription contact lenses and toric contact lenses.</span></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Diameter: 14.5mm - Base curve 8.7mm</span><br style=\"box-sizing: inherit;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Availability: From -13.00 to +6.00 &amp; Torics</span></p>'),
(10, 'Attitude Timeless Collection', '2024-09-22 07:59:33', '2024-09-22 10:20:25', 'ego-assets/images/product_categories/1727000425_A2TT_box.jpg', '<h4 style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 0.5rem; font-family: Prata; font-weight: 400; font-size: 1.25rem; color: rgb(0, 0, 0); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">1 Tone - Monthly</h4><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 14px;\">The design of the Attitude Collection 1 Tone colored contact lenses is a base color without limbal ring. So if you seek a natural, vibrant eye color that\'s also comfortable color contacts, look no further. This collection offers four colors all with no limbal ring: Shameless Hazel, Sublime Grey, Lush Green, and Angelic Blue.</span></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Diameter: 14.3mm - Base curve 8.6mm</span><br style=\"box-sizing: inherit;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Availability: From -8.00 to +4.00</span></p>'),
(11, '10th Anniversary Collection', '2024-09-22 10:10:40', '2024-09-22 10:10:40', 'ego-assets/images/product_categories/1726999840_SP_box.jpg', '<h4 style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 0.5rem; font-family: Prata; font-weight: 400; font-size: 1.25rem; color: rgb(0, 0, 0); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">1&amp;2 Tones - Monthly</h4><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 12px;\"><span style=\"box-sizing: inherit; font-size: 14px;\">The Sale &amp; Peppe collection commemorates Desio\'s 10th anniversary. This collection offers two color contact lenses: Salty White and Pepper Grey, available for individual purchase or as a set. Salty White is a single tone lens, while Pepper Grey features two tones. These versatile grey contact lenses are designed for monthly use, aiming to enhance your aesthetic appeal and add charm and allure to any style.</span><br style=\"box-sizing: inherit;\"></span></p><p style=\"box-sizing: inherit; margin-top: 0px; margin-bottom: 1rem; color: rgb(0, 0, 0); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: 0.5px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(245, 245, 245); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Diameter: 14.3mm - Base curve: 8.6mm</span><br style=\"box-sizing: inherit;\"><span style=\"box-sizing: inherit; font-size: 10px;\">Availability: From -8.00 to +4.00</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 9, 'ego-assets/images/product_images/661261.png', '2024-08-21 05:24:38', '2024-08-21 05:24:38'),
(2, 9, 'ego-assets/images/product_images/661261.png', '2024-08-21 05:24:38', '2024-08-21 05:24:38'),
(3, 9, 'ego-assets/images/product_images/661261.png', '2024-08-21 05:24:39', '2024-08-21 05:24:39'),
(4, 10, 'ego-assets/images/product_images/360340.jpg', '2024-08-21 05:27:13', '2024-08-21 05:27:13'),
(5, 10, 'ego-assets/images/product_images/360340.jpg', '2024-08-21 05:27:14', '2024-08-21 05:27:14'),
(12, 13, 'ego-assets/images/product_images/386708.jpg', '2024-08-21 07:14:04', '2024-08-21 07:14:04'),
(13, 13, 'ego-assets/images/product_images/946643.jpg', '2024-08-21 07:14:04', '2024-08-21 07:14:04'),
(14, 13, 'ego-assets/images/product_images/624312.jpg', '2024-08-21 07:14:04', '2024-08-21 07:14:04'),
(15, 14, 'ego-assets/images/product_images/924588.jpg', '2024-09-26 16:29:06', '2024-09-26 16:29:06'),
(16, 15, 'ego-assets/images/product_images/352089.jpg', '2024-09-27 11:53:20', '2024-09-27 11:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `power` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `power`, `stock`, `created_at`, `updated_at`) VALUES
(1, 10, '+0.25', '0', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(2, 10, '+0.50', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(3, 10, '+0.75', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(10, 13, '+0.25', '0', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(11, 13, '+0.50', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(12, 13, '+0.75', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(13, 5, '+0.25', '0', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(14, 5, '+0.50', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(15, 5, '+0.75', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(16, 6, '+0.25', '0', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(17, 6, '+0.50', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(18, 6, '+0.75', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(19, 7, '+0.25', '0', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(20, 7, '+0.50', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(21, 7, '+0.75', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(22, 8, '+0.25', '0', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(23, 8, '+0.50', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20'),
(24, 8, '+0.75', '44', '2024-09-27 11:53:20', '2024-09-27 11:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `replacements`
--

CREATE TABLE `replacements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `replacements`
--

INSERT INTO `replacements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, '1 months', '2024-08-21 11:16:16', '2024-08-21 11:16:28'),
(3, '2 months', '2024-08-21 11:16:38', '2024-08-21 11:16:38'),
(4, '3 months', '2024-08-21 11:16:49', '2024-08-21 11:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(10) UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) DEFAULT 0,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tones`
--

CREATE TABLE `tones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tones`
--

INSERT INTO `tones` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'One Tones', '2024-08-21 12:05:00', '2024-08-21 12:05:00'),
(3, 'Two Tones', '2024-08-21 12:05:13', '2024-08-21 12:05:13'),
(4, 'Three Tones', '2024-08-21 12:05:22', '2024-08-21 12:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `post_balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `charge`, `post_balance`, `trx_type`, `trx`, `details`, `remark`, `created_at`, `updated_at`) VALUES
(1, 8, '100.00000000', '2.00000000', '15277.55755565', '+', '7A27BS2YJXEW', 'Deposit Via Mollie - USD', 'deposit', '2023-02-13 07:57:29', '2023-02-13 07:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_by` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'contains full address',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `kyc_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: KYC Unverified, 2: KYC pending, 1: KYC verified',
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: mobile unverified, 1: mobile verified',
  `profile_complete` tinyint(1) NOT NULL DEFAULT 0,
  `ver_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `country_code`, `mobile`, `location`, `dob`, `ref_by`, `balance`, `password`, `address`, `status`, `kyc_data`, `kv`, `ev`, `sv`, `profile_complete`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `ban_reason`, `remember_token`, `created_at`, `updated_at`, `google_id`) VALUES
(41, 'Najmus', 'Sakib', NULL, 'najmus57@gmail.com', NULL, '01726920703', NULL, '2024-08-08', 0, '0.00000000', '$2y$10$k6jELjrI4qaIfkk/Cesqi.tFYiSV4.83Qu.cI2y.6vlKORaCgdcDO', NULL, 1, NULL, 1, 1, 1, 1, '160672', '2024-09-04 12:23:57', 0, 1, NULL, NULL, '3FYU7BYWapW3u9Ka2SBR11hwJNoahDeRnJizsSs91pvevjPeDv0cHVn7EXfu', '2024-08-28 06:16:01', '2024-09-04 06:23:57', NULL),
(42, 'Dilshan', 'Ahmed', NULL, 'dilshaneffendi1123@gmail.com', NULL, '01984603367', NULL, '2024-09-18', 0, '0.00000000', '$2y$10$egKvd6//Vqtgc7thfYjRpun4jDHKDkLV.KrXKzawTs7v0Kn9Yr/gW', '{\"country\":null,\"address\":\"Indira road\",\"state\":\"Dhaka\",\"zip\":\"1215\",\"city\":\"Dhaka\"}', 1, NULL, 0, 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, 'oWflejMGbuAcOsE5C3wzQu6x2DQEq1q78bOfvz5fyF5DR77qg6itJMlJfQlQ', '2024-09-22 06:23:13', '2024-09-22 06:28:56', NULL),
(51, 'Najmus', 'Sakib', NULL, 'najmussakib173@gmail.com', NULL, '01726920703', NULL, '2024-10-17', 0, '0.00000000', '$2y$10$uiHOnGsFjzZCClt/B1ycHewMyloIliSc6IS/34gAzw5.Zk2PXzIW2', NULL, 1, NULL, 0, 0, 0, 0, '595645', '2024-10-02 09:42:28', 0, 1, NULL, NULL, 'qHGLgvKJvzMSQbVt9LvC7GdTdzgjEx9es3WZAHybbvKWrBlKrwkLWP79TQhg', '2024-10-01 18:51:55', '2024-10-02 09:42:28', NULL),
(52, 'Shakil', 'Ahmed', NULL, 'sa27289@gmail.com', NULL, NULL, NULL, NULL, 0, '0.00000000', NULL, NULL, 1, NULL, 0, 1, 0, 0, NULL, NULL, 0, 1, NULL, NULL, NULL, '2024-10-01 18:58:16', '2024-10-01 18:58:16', '115623450220741677333'),
(53, 'CODETREE', 'Bangladesh', NULL, 'codetree.developers@gmail.com', NULL, NULL, NULL, NULL, 0, '0.00000000', NULL, NULL, 1, NULL, 1, 1, 1, 0, '110074', '2024-10-01 20:59:04', 0, 1, NULL, NULL, NULL, '2024-10-01 19:51:05', '2024-10-01 20:59:04', '110153188054168687234'),
(55, 'Dilshan', 'Ahmed', NULL, 'dilshanahmed2025@gmail.com', NULL, '01984603367', 'Comilla District', '2024-10-25', 0, '0.00000000', '$2y$10$/GFTmjoHpYJV9kYBJY/euudGZ7VoSoik9/yB170cLKIXs8TWZx7pm', '{\"country\":null,\"address\":\"Indira road\",\"state\":\"Dhaka\",\"zip\":\"1215\",\"city\":\"Dhaka\"}', 1, NULL, 1, 1, 1, 1, '894396', '2024-10-02 15:47:18', 0, 1, NULL, NULL, 'GbspBcmqIwXlh2Us2aBSaTBhBROJmT5eGxsL1YsnfKe0QpMrvZ8BvzpWb4Rk', '2024-10-02 09:47:00', '2024-10-02 09:50:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_ip` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `city`, `country`, `country_code`, `longitude`, `latitude`, `browser`, `os`, `created_at`, `updated_at`) VALUES
(14, 8, '::1', 'Dhaka', 'Bangladesh', 'BD', '17.057', '56.56', 'Chrome', 'Windows 10', '2020-11-22 00:52:36', '2020-11-22 00:52:36'),
(15, 8, '::1', NULL, NULL, '', '', '', NULL, NULL, '2020-11-22 00:52:50', '2020-11-22 00:52:50'),
(16, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2020-11-22 00:58:16', '2020-11-22 00:58:16'),
(17, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2020-11-22 00:58:41', '2020-11-22 00:58:41'),
(18, 8, '::1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2020-11-22 00:59:30', '2020-11-22 00:59:30'),
(19, 11, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2020-11-23 06:45:43', '2020-11-23 06:45:43'),
(20, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2020-12-24 05:10:34', '2020-12-24 05:10:34'),
(21, 8, '127.0.0.1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2020-12-24 05:12:16', '2020-12-24 05:12:16'),
(22, 8, '127.0.0.1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2020-12-24 05:13:40', '2020-12-24 05:13:40'),
(23, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2020-12-28 02:46:17', '2020-12-28 02:46:17'),
(24, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2020-12-29 02:31:30', '2020-12-29 02:31:30'),
(25, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-01-02 23:32:38', '2021-01-02 23:32:38'),
(26, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-01-03 04:39:14', '2021-01-03 04:39:14'),
(27, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-01-03 23:32:07', '2021-01-03 23:32:07'),
(28, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-01-17 03:02:58', '2021-01-17 03:02:58'),
(29, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-01-31 06:56:02', '2021-01-31 06:56:02'),
(30, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-02-13 06:23:32', '2021-02-13 06:23:32'),
(31, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-04 01:46:06', '2021-03-04 01:46:06'),
(32, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-04 02:40:51', '2021-03-04 02:40:51'),
(33, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-04 02:52:25', '2021-03-04 02:52:25'),
(34, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-06 00:38:14', '2021-03-06 00:38:14'),
(36, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-06 23:51:07', '2021-03-06 23:51:07'),
(37, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-07 00:11:05', '2021-03-07 00:11:05'),
(38, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-07 00:13:36', '2021-03-07 00:13:36'),
(39, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-07 00:13:59', '2021-03-07 00:13:59'),
(40, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-07 00:14:12', '2021-03-07 00:14:12'),
(41, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-07 00:14:24', '2021-03-07 00:14:24'),
(42, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-07 00:17:31', '2021-03-07 00:17:31'),
(43, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-07 00:17:56', '2021-03-07 00:17:56'),
(44, 8, '127.0.0.1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2021-03-08 01:04:19', '2021-03-08 01:04:19'),
(45, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-08 01:05:03', '2021-03-08 01:05:03'),
(46, 8, '127.0.0.1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2021-03-08 01:05:45', '2021-03-08 01:05:45'),
(47, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-09 06:31:16', '2021-03-09 06:31:16'),
(48, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-14 05:29:21', '2021-03-14 05:29:21'),
(49, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-14 07:47:37', '2021-03-14 07:47:37'),
(50, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-15 01:04:33', '2021-03-15 01:04:33'),
(51, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-15 03:29:51', '2021-03-15 03:29:51'),
(52, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-15 03:32:22', '2021-03-15 03:32:22'),
(53, 13, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-15 03:35:45', '2021-03-15 03:35:45'),
(54, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-15 23:37:22', '2021-03-15 23:37:22'),
(55, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-16 04:35:36', '2021-03-16 04:35:36'),
(59, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-18 00:13:32', '2021-03-18 00:13:32'),
(60, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-18 06:03:56', '2021-03-18 06:03:56'),
(61, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-22 09:28:04', '2021-03-22 09:28:04'),
(62, 8, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-03-30 00:16:44', '2021-03-30 00:16:44'),
(63, 17, '::1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-04-17 01:17:26', '2021-04-17 01:17:26'),
(64, 8, '::1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-04-19 02:41:01', '2021-04-19 02:41:01'),
(65, 18, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-04-28 00:41:42', '2021-04-28 00:41:42'),
(66, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-04-28 23:03:35', '2021-04-28 23:03:35'),
(67, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-01 22:24:42', '2021-05-01 22:24:42'),
(68, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-02 08:07:35', '2021-05-02 08:07:35'),
(69, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-02 09:02:14', '2021-05-02 09:02:14'),
(70, 8, '::1', 'Dhaka', 'Bangladesh', 'BD', '17.057', '56.56', 'Unknown Browser', 'Unknown OS Platform', '2021-05-03 08:56:35', '2021-05-03 08:56:35'),
(71, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-03 10:01:43', '2021-05-03 10:01:43'),
(72, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-03 10:38:50', '2021-05-03 10:38:50'),
(73, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-04 04:04:50', '2021-05-04 04:04:50'),
(74, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-04 06:51:42', '2021-05-04 06:51:42'),
(75, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-04 10:15:58', '2021-05-04 10:15:58'),
(76, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-04 10:26:29', '2021-05-04 10:26:29'),
(77, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-04 14:42:41', '2021-05-04 14:42:41'),
(78, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-05 00:21:23', '2021-05-05 00:21:23'),
(79, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-05 07:36:31', '2021-05-05 07:36:31'),
(80, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-05 09:50:53', '2021-05-05 09:50:53'),
(81, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-05 10:11:18', '2021-05-05 10:11:18'),
(82, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-07 03:49:58', '2021-05-07 03:49:58'),
(83, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-07 05:55:44', '2021-05-07 05:55:44'),
(84, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-07 07:31:48', '2021-05-07 07:31:48'),
(85, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-07 08:06:54', '2021-05-07 08:06:54'),
(86, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-08 04:09:24', '2021-05-08 04:09:24'),
(87, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-08 04:25:42', '2021-05-08 04:25:42'),
(88, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-08 04:27:02', '2021-05-08 04:27:02'),
(89, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-08 09:45:25', '2021-05-08 09:45:25'),
(90, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-10 04:54:10', '2021-05-10 04:54:10'),
(91, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-10 06:02:08', '2021-05-10 06:02:08'),
(92, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-10 06:11:16', '2021-05-10 06:11:16'),
(93, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-10 06:11:30', '2021-05-10 06:11:30'),
(94, 19, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-10 06:24:07', '2021-05-10 06:24:07'),
(95, 20, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-10 06:27:04', '2021-05-10 06:27:04'),
(96, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-10 06:58:32', '2021-05-10 06:58:32'),
(97, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-11 07:34:32', '2021-05-11 07:34:32'),
(98, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-18 06:30:15', '2021-05-18 06:30:15'),
(99, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 07:10:00', '2021-05-18 07:10:00'),
(100, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 07:11:42', '2021-05-18 07:11:42'),
(101, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 08:24:25', '2021-05-18 08:24:25'),
(102, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 09:00:03', '2021-05-18 09:00:03'),
(103, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 09:10:28', '2021-05-18 09:10:28'),
(104, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 09:11:20', '2021-05-18 09:11:20'),
(105, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 09:22:20', '2021-05-18 09:22:20'),
(106, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 09:48:40', '2021-05-18 09:48:40'),
(107, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 09:56:02', '2021-05-18 09:56:02'),
(108, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 10:02:24', '2021-05-18 10:02:24'),
(109, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 11:02:35', '2021-05-18 11:02:35'),
(110, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 11:16:00', '2021-05-18 11:16:00'),
(111, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 11:26:43', '2021-05-18 11:26:43'),
(112, 8, '192.168.30.113', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 11:46:21', '2021-05-18 11:46:21'),
(113, 8, '192.168.30.108', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 11:48:56', '2021-05-18 11:48:56'),
(114, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 11:50:45', '2021-05-18 11:50:45'),
(115, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 11:58:17', '2021-05-18 11:58:17'),
(116, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 12:01:46', '2021-05-18 12:01:46'),
(117, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 13:04:11', '2021-05-18 13:04:11'),
(118, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 13:04:42', '2021-05-18 13:04:42'),
(119, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-18 13:26:53', '2021-05-18 13:26:53'),
(120, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 04:43:07', '2021-05-19 04:43:07'),
(121, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 05:00:42', '2021-05-19 05:00:42'),
(122, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 05:18:47', '2021-05-19 05:18:47'),
(123, 22, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 05:47:02', '2021-05-19 05:47:02'),
(124, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 05:48:12', '2021-05-19 05:48:12'),
(125, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 06:02:29', '2021-05-19 06:02:29'),
(126, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 06:02:37', '2021-05-19 06:02:37'),
(127, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 06:46:41', '2021-05-19 06:46:41'),
(128, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 08:06:17', '2021-05-19 08:06:17'),
(129, 8, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 09:04:52', '2021-05-19 09:04:52'),
(130, 8, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-19 09:07:03', '2021-05-19 09:07:03'),
(131, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-19 09:37:12', '2021-05-19 09:37:12'),
(132, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-20 05:15:36', '2021-05-20 05:15:36'),
(133, 8, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-20 05:42:29', '2021-05-20 05:42:29'),
(134, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-20 06:21:56', '2021-05-20 06:21:56'),
(135, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-20 06:38:33', '2021-05-20 06:38:33'),
(136, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-20 06:51:08', '2021-05-20 06:51:08'),
(137, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-20 08:25:26', '2021-05-20 08:25:26'),
(138, 8, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-20 08:40:34', '2021-05-20 08:40:34'),
(139, 8, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-05-22 08:27:18', '2021-05-22 08:27:18'),
(140, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-05-24 05:48:16', '2021-05-24 05:48:16'),
(141, 8, '127.0.0.1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2021-05-30 11:37:41', '2021-05-30 11:37:41'),
(142, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-05 10:24:30', '2021-06-05 10:24:30'),
(143, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-05 13:16:57', '2021-06-05 13:16:57'),
(144, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-07 06:48:16', '2021-06-07 06:48:16'),
(145, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-08 09:50:07', '2021-06-08 09:50:07'),
(146, 23, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-09 06:15:34', '2021-06-09 06:15:34'),
(147, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-09 06:20:13', '2021-06-09 06:20:13'),
(148, 24, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 05:31:54', '2021-06-10 05:31:54'),
(149, 25, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 05:35:17', '2021-06-10 05:35:17'),
(150, 25, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 06:31:50', '2021-06-10 06:31:50'),
(151, 24, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 06:32:47', '2021-06-10 06:32:47'),
(152, 24, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 06:36:30', '2021-06-10 06:36:30'),
(153, 24, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 06:36:42', '2021-06-10 06:36:42'),
(154, 26, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 08:38:29', '2021-06-10 08:38:29'),
(155, 24, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 09:33:53', '2021-06-10 09:33:53'),
(156, 24, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 09:36:53', '2021-06-10 09:36:53'),
(157, 24, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 10:05:22', '2021-06-10 10:05:22'),
(158, 24, '192.168.30.101', '', '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2021-06-10 11:56:06', '2021-06-10 11:56:06'),
(159, 27, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-12 05:27:14', '2021-06-12 05:27:14'),
(160, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-12 05:49:27', '2021-06-12 05:49:27'),
(161, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-17 12:20:17', '2021-06-17 12:20:17'),
(162, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-20 10:09:14', '2021-06-20 10:09:14'),
(163, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-06-22 06:39:43', '2021-06-22 06:39:43'),
(164, 8, '127.0.0.1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2021-07-04 11:19:27', '2021-07-04 11:19:27'),
(165, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2021-07-17 09:35:26', '2021-07-17 09:35:26'),
(166, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-23 00:59:39', '2022-02-23 00:59:39'),
(167, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-23 01:00:48', '2022-02-23 01:00:48'),
(168, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-23 01:01:34', '2022-02-23 01:01:34'),
(169, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-23 01:16:57', '2022-02-23 01:16:57'),
(170, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-23 01:58:50', '2022-02-23 01:58:50'),
(171, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-23 05:10:49', '2022-02-23 05:10:49'),
(172, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-24 01:54:21', '2022-02-24 01:54:21'),
(173, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-24 02:45:18', '2022-02-24 02:45:18'),
(174, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-02-24 06:02:52', '2022-02-24 06:02:52'),
(175, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-07 04:00:28', '2022-03-07 04:00:28'),
(176, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-08 04:32:14', '2022-03-08 04:32:14'),
(177, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-10 03:27:26', '2022-03-10 03:27:26'),
(178, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-12 07:02:34', '2022-03-12 07:02:34'),
(179, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-16 05:23:33', '2022-03-16 05:23:33'),
(180, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-16 23:29:15', '2022-03-16 23:29:15'),
(181, 28, '127.0.0.1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2022-03-17 03:09:58', '2022-03-17 03:09:58'),
(182, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-19 05:54:50', '2022-03-19 05:54:50'),
(183, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-21 00:10:58', '2022-03-21 00:10:58'),
(184, 29, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-21 02:41:54', '2022-03-21 02:41:54'),
(185, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-21 02:47:16', '2022-03-21 02:47:16'),
(186, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-21 03:15:55', '2022-03-21 03:15:55'),
(187, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-21 05:42:49', '2022-03-21 05:42:49'),
(188, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-22 05:36:59', '2022-03-22 05:36:59'),
(189, 30, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-22 07:53:20', '2022-03-22 07:53:20'),
(190, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-03-22 09:59:16', '2022-03-22 09:59:16'),
(191, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-03-22 10:24:43', '2022-03-22 10:24:43'),
(192, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-03-22 10:47:56', '2022-03-22 10:47:56'),
(193, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-03-22 10:48:33', '2022-03-22 10:48:33'),
(194, 31, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-03-22 11:22:57', '2022-03-22 11:22:57'),
(195, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-23 04:52:19', '2022-03-23 04:52:19'),
(196, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-03-29 08:05:49', '2022-03-29 08:05:49'),
(197, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-30 07:23:47', '2022-03-30 07:23:47'),
(198, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-30 11:49:52', '2022-03-30 11:49:52'),
(199, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-03-30 13:03:17', '2022-03-30 13:03:17'),
(200, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-04-02 04:35:15', '2022-04-02 04:35:15'),
(201, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-04-03 06:33:59', '2022-04-03 06:33:59'),
(202, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-04-03 07:49:36', '2022-04-03 07:49:36'),
(203, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-04-04 03:53:39', '2022-04-04 03:53:39'),
(204, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-04-04 05:37:22', '2022-04-04 05:37:22'),
(205, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-04-04 08:33:11', '2022-04-04 08:33:11'),
(206, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-04-11 03:16:38', '2022-04-11 03:16:38'),
(207, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-05-08 10:25:23', '2022-05-08 10:25:23'),
(208, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-05-25 10:38:37', '2022-05-25 10:38:37'),
(209, 32, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-05-25 13:03:03', '2022-05-25 13:03:03'),
(210, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-05-29 09:28:37', '2022-05-29 09:28:37'),
(211, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-05-30 11:57:53', '2022-05-30 11:57:53'),
(212, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-07-04 05:44:23', '2022-07-04 05:44:23'),
(213, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-07-18 12:22:51', '2022-07-18 12:22:51'),
(214, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-07-20 13:06:51', '2022-07-20 13:06:51'),
(215, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-07-25 11:13:59', '2022-07-25 11:13:59'),
(216, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-07-25 11:14:52', '2022-07-25 11:14:52'),
(217, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-07-26 07:34:37', '2022-07-26 07:34:37'),
(218, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-08-03 05:04:05', '2022-08-03 05:04:05'),
(219, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-08-03 06:04:12', '2022-08-03 06:04:12'),
(220, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-08-07 04:17:49', '2022-08-07 04:17:49'),
(221, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-08-18 11:50:56', '2022-08-18 11:50:56'),
(222, 8, '127.0.0.1', NULL, '', '', '', '', 'Firefox', 'Windows 10', '2022-08-24 07:58:42', '2022-08-24 07:58:42'),
(223, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-08-28 08:24:12', '2022-08-28 08:24:12'),
(224, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-08-31 04:25:57', '2022-08-31 04:25:57'),
(225, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-09-14 07:35:05', '2022-09-14 07:35:05'),
(226, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-09-20 05:15:53', '2022-09-20 05:15:53'),
(227, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-09-20 05:23:20', '2022-09-20 05:23:20'),
(228, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-09-22 07:37:42', '2022-09-22 07:37:42'),
(229, 33, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-09-29 06:59:30', '2022-09-29 06:59:30'),
(230, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-10-19 03:03:43', '2022-10-19 03:03:43'),
(231, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-10-20 08:36:02', '2022-10-20 08:36:02'),
(232, 8, '127.0.0.1', NULL, '', '', '', '', 'Unknown Browser', 'Unknown OS Platform', '2022-10-24 06:27:52', '2022-10-24 06:27:52'),
(233, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-11-05 05:08:32', '2022-11-05 05:08:32'),
(234, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-11-13 06:35:49', '2022-11-13 06:35:49'),
(235, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2022-12-27 08:28:19', '2022-12-27 08:28:19'),
(236, 8, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2023-02-13 07:56:55', '2023-02-13 07:56:55'),
(237, 39, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-08-18 06:24:13', '2024-08-18 06:24:13'),
(238, 40, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-08-18 06:27:20', '2024-08-18 06:27:20'),
(239, 40, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-08-20 07:11:36', '2024-08-20 07:11:36'),
(240, 40, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-08-21 07:08:50', '2024-08-21 07:08:50'),
(241, 41, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-08-28 06:16:21', '2024-08-28 06:16:21'),
(242, 41, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-08-28 07:29:01', '2024-08-28 07:29:01'),
(243, 41, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-08-28 08:03:18', '2024-08-28 08:03:18'),
(244, 41, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-08-28 12:17:48', '2024-08-28 12:17:48'),
(245, 41, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-02 10:44:41', '2024-09-02 10:44:41'),
(246, 41, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-03 06:26:04', '2024-09-03 06:26:04'),
(247, 41, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-03 10:34:48', '2024-09-03 10:34:48'),
(248, 41, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-04 06:18:03', '2024-09-04 06:18:03'),
(249, 41, '127.0.0.1', NULL, '', '', '', '', 'Handheld Browser', 'Android', '2024-09-15 10:29:52', '2024-09-15 10:29:52'),
(250, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-22 06:25:48', '2024-09-22 06:25:48'),
(251, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-25 06:23:22', '2024-09-25 06:23:22'),
(252, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-27 10:39:14', '2024-09-27 10:39:14'),
(253, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-27 18:10:10', '2024-09-27 18:10:10'),
(254, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-27 20:23:37', '2024-09-27 20:23:37'),
(255, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-28 07:07:15', '2024-09-28 07:07:15'),
(256, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-29 05:28:52', '2024-09-29 05:28:52'),
(257, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-09-29 06:58:28', '2024-09-29 06:58:28'),
(258, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-10-01 08:25:13', '2024-10-01 08:25:13'),
(259, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-10-01 09:21:03', '2024-10-01 09:21:03'),
(260, 42, '103.181.69.134', 'Dhaka', 'Bangladesh', 'BD', '90.349', '23.7167', 'Chrome', 'Windows 10', '2024-10-01 17:41:01', '2024-10-01 17:41:01'),
(261, 42, '103.181.69.134', 'Dhaka', 'Bangladesh', 'BD', '90.349', '23.7167', 'Handheld Browser', 'iPhone', '2024-10-01 17:42:10', '2024-10-01 17:42:10'),
(262, 51, '103.87.138.5', '', 'Bangladesh', 'BD', '90.3742', '23.7018', 'Handheld Browser', 'iPhone', '2024-10-01 18:52:28', '2024-10-01 18:52:28'),
(263, 51, '103.87.139.58', 'Dhaka', 'Bangladesh', 'BD', '90.4017', '23.7086', 'Handheld Browser', 'iPhone', '2024-10-01 19:40:26', '2024-10-01 19:40:26'),
(264, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-10-02 04:05:54', '2024-10-02 04:05:54'),
(265, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-10-02 04:06:17', '2024-10-02 04:06:17'),
(266, 42, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-10-02 04:14:53', '2024-10-02 04:14:53'),
(267, 55, '127.0.0.1', NULL, '', '', '', '', 'Chrome', 'Windows 10', '2024-10-02 10:06:01', '2024-10-02 10:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(21, 55, '15', '2024-10-02 10:24:19', '2024-10-02 10:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `after_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `withdraw_information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `method_id`, `user_id`, `amount`, `currency`, `rate`, `charge`, `trx`, `final_amount`, `after_charge`, `withdraw_information`, `status`, `admin_feedback`, `created_at`, `updated_at`) VALUES
(1, 1, 8, '10.00000000', 'USD', '1.00000000', '1.20000000', 'CFKTEECKPXTG', '8.80000000', '8.80000000', NULL, 0, NULL, '2023-02-13 07:58:14', '2023-02-13 07:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT 0.00000000,
  `max_limit` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `fixed_charge` decimal(28,8) DEFAULT 0.00000000,
  `rate` decimal(28,8) DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `form_id`, `name`, `min_limit`, `max_limit`, `fixed_charge`, `rate`, `percent_charge`, `currency`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 'Bank Transfer', '1.00000000', '1000.00000000', '1.00000000', '1.00000000', '2.00', 'USD', '<span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Please Provide The information Below:</span><br>', 1, '2022-03-30 09:09:11', '2022-10-13 05:12:28'),
(2, 14, 'Mobile Money', '1.00000000', '1000.00000000', '0.00000000', '1.00000000', '0.01', 'USD', '<span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Please Provide The Information Below:</span><br>', 1, '2022-03-30 09:10:12', '2022-10-12 11:36:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_curves`
--
ALTER TABLE `base_curves`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_unique` (`name`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_sets`
--
ALTER TABLE `collection_sets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `color_name_unique` (`name`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diameters`
--
ALTER TABLE `diameters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `durations`
--
ALTER TABLE `durations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lense_designs`
--
ALTER TABLE `lense_designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lens_designs`
--
ALTER TABLE `lens_designs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_unique` (`name`);

--
-- Indexes for table `lens_powers`
--
ALTER TABLE `lens_powers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variations_product_id_foreign` (`product_id`);

--
-- Indexes for table `replacements`
--
ALTER TABLE `replacements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_unique` (`name`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tones`
--
ALTER TABLE `tones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_unique` (`name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `base_curves`
--
ALTER TABLE `base_curves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `collection_sets`
--
ALTER TABLE `collection_sets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diameters`
--
ALTER TABLE `diameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `durations`
--
ALTER TABLE `durations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lense_designs`
--
ALTER TABLE `lense_designs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lens_designs`
--
ALTER TABLE `lens_designs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lens_powers`
--
ALTER TABLE `lens_powers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `replacements`
--
ALTER TABLE `replacements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tones`
--
ALTER TABLE `tones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
