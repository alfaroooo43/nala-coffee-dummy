-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2026 at 01:42 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nala_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `thumbnail`, `excerpt`, `content`, `category`, `author_id`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(3, 'Dari Lereng Ijen, Secangkir Kopi yang Punya Cerita', 'kekasihku-tercintavercelapp', 'cms/articles/jeuiOCjwchhVySTu4ZFO1NmIbS2TQUmV0mly2Gjk.webp', NULL, 'Di lereng Ijen, Bondowoso, kopi bukan sekadar hasil panen. Setiap biji membawa cerita tentang tanah, petani, dan proses panjang yang menjadikannya memiliki karakter tersendiri.\r\n\r\nNala Coffee hadir dengan membawa kopi dari petani lokal Bondowoso dan mengolahnya dengan perhatian pada kualitas. Mulai dari pemilihan buah kopi yang matang, proses pascapanen, hingga proses roasting dilakukan untuk menjaga karakter alami dari setiap biji kopi.\r\n\r\nBagi Nala, kopi yang baik tidak hanya tentang rasa di dalam cangkir. Ada perjalanan panjang di baliknya—mulai dari tangan petani, tanah tempat kopi tumbuh, hingga proses pengolahan sebelum akhirnya dinikmati.\r\n\r\nMelalui kopi Java Ijen, Nala Coffee ingin memperkenalkan karakter kopi Bondowoso sekaligus mendukung keberlangsungan petani lokal. Karena di setiap cangkir kopi, selalu ada cerita yang layak untuk dihargai.', 'Cerita Nala', 1, 'published', '2026-09-22 20:37:41', '2026-09-22 20:37:41', '2026-09-22 20:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arabica', 'arabica', 'Kopi arabica premium', 'active', '2026-09-22 18:25:24', '2026-09-22 18:25:24'),
(2, 'Robusta', 'robusta', 'Kopi robusta dengan body kuat', 'active', '2026-09-22 18:25:24', '2026-09-22 18:25:24'),
(3, 'House Blend', 'house-blend', 'Racikan harian untuk espresso dan kopi susu', 'active', '2026-09-22 18:25:24', '2026-09-22 18:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `image`, `caption`, `category`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Pemenitakan Coffe', 'cms/gallery/uLgQvsfeBEytuSCNXugxV41mcdpcTbvhkVFDf3QS.webp', 'Proses Pemetikan Kopi nala coffe', 'Kebun', 2, 'active', '2026-09-22 18:25:24', '2026-09-22 19:58:08'),
(5, 'Kopi Berkualitas', 'cms/gallery/fZMVywO7R6mUmEIqcXqxK9JwzYfqqZSJKYWt1uoH.webp', 'Kopi Berkualitas', 'Proses', 3, 'active', '2026-09-22 18:25:24', '2026-09-22 19:59:14'),
(6, 'Galeri Nala Coffee 6', 'images/gallery/gallery-6.png', NULL, 'Lifestyle', 6, 'active', '2026-09-22 18:25:24', '2026-09-22 18:25:24'),
(8, 'Alam Gunung Bondowoso', 'cms/gallery/N8hha4c8LUCSpx7RzAXjdRG6X3rxFeb53X1CbwTU.webp', 'Hutan Kopi', 'Kebun', 1, 'active', '2026-09-22 19:56:56', '2026-09-22 19:56:56'),
(9, 'Proses Pengeringan Kopi', 'cms/gallery/dZqMfuatz6vkreK6PfMEIsotHzRx4Xv6Uql5zZJ8.webp', 'Proses pengurangan kopi', 'Proses', 0, 'active', '2026-09-22 20:02:36', '2026-09-22 20:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_clicks`
--

CREATE TABLE `marketplace_clicks` (
  `id` bigint UNSIGNED NOT NULL,
  `visitor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `marketplace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'shopee',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product_page',
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clicked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','blocked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `registered_at` timestamp NULL DEFAULT NULL,
  `last_active_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_22_000001_create_categories_table', 1),
(5, '2026_09_22_000002_create_products_table', 1),
(6, '2026_09_22_000003_create_members_table', 1),
(7, '2026_09_22_000004_create_galleries_table', 1),
(8, '2026_09_22_000005_create_partnerships_table', 1),
(9, '2026_09_22_000006_create_website_visits_table', 1),
(10, '2026_09_22_000007_create_marketplace_clicks_table', 1),
(11, '2026_09_22_000008_add_admin_columns_to_users_table', 1),
(12, '2026_09_22_000009_create_articles_table', 1),
(13, '2026_09_22_000010_add_password_to_members_table', 1),
(14, '2026_09_22_000011_create_settings_table', 1),
(15, '2026_09_22_000012_add_price_to_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `partnerships`
--

CREATE TABLE `partnerships` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` enum('new','contacted','processing','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int UNSIGNED NOT NULL DEFAULT '0',
  `body_score` tinyint UNSIGNED DEFAULT NULL,
  `acidity_score` tinyint UNSIGNED DEFAULT NULL,
  `fruity_score` tinyint UNSIGNED DEFAULT NULL,
  `weight_options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopee_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `image`, `price`, `body_score`, `acidity_score`, `fruity_score`, `weight_options`, `shopee_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Arabica Ijen', 'arabica-ijen', 'Kopi dengan profil floral dan rasa buah yang bersih.', 'cms/products/K6Y4TIuDTKwsvjN0vpmRxQi6GhVlRq94VJElUviS.webp', 85000, NULL, NULL, NULL, NULL, 'https://shopee.co.id/', 'active', '2026-09-22 18:25:24', '2026-09-22 18:48:13'),
(2, 2, 'Robusta Ijen', 'robusta-ijen', 'Body tebal dengan aftertaste cokelat.', 'cms/products/eu5MI9wKwFhUuS5Lo3gnGWdx52y6OXEjZ5uEfff0.webp', 70000, NULL, NULL, NULL, NULL, 'https://shopee.co.id/', 'active', '2026-09-22 18:25:24', '2026-09-22 18:48:52'),
(3, 3, 'House Blend', 'house-blend', 'Racikan seimbang untuk seduhan harian.', 'cms/products/UlSNKRufkScq9Je2gLoZgMuFmQxUOJYzWsd84Dpn.webp', 75000, NULL, NULL, NULL, NULL, 'https://shopee.co.id/', 'active', '2026-09-22 18:25:24', '2026-09-22 18:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UnL0SeD23SbmBdKXl5CVSOaI1sB4rQramnNtsuzV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJXckhjQ0tzbE1CYzU4QVFVZ0tzM3NsbVpJQmx6SUg4WnBsRThUa1c4IiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifX0=', 1790558865);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'website_name', 'Nala Coffee', '2026-09-22 18:25:24', '2026-09-22 18:25:24'),
(2, 'email', 'hello@nalacoffee.test', '2026-09-22 18:25:24', '2026-09-22 18:25:24'),
(3, 'whatsapp', '+62 812 0000 0000', '2026-09-22 18:25:24', '2026-09-22 18:25:24'),
(4, 'instagram', 'https://instagram.com/', '2026-09-22 18:25:24', '2026-09-22 18:25:24'),
(5, 'tiktok', 'https://tiktok.com/', '2026-09-22 18:25:24', '2026-09-22 18:25:24'),
(6, 'shopee_url', 'https://shopee.co.id/', '2026-09-22 18:25:24', '2026-09-22 18:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'content_admin',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `last_login_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nala Coffee Admin', 'admin@nalacoffee.test', NULL, '$2y$12$nJ9.7E22YXarzossRYuim.U6ujSjMEMVTPtXvb8YMxBeOqwFUpD3m', 'super_admin', 'active', NULL, '6k2gTKVGNRjFODcucMGYiUCv5tUhWhvOMCEviTh3JZb1pAhBZzkpy6mfWAPG', '2026-09-22 18:25:24', '2026-09-22 18:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `website_visits`
--

CREATE TABLE `website_visits` (
  `id` bigint UNSIGNED NOT NULL,
  `visitor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visited_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_visits`
--

INSERT INTO `website_visits` (`id`, `visitor_id`, `session_id`, `page`, `referrer`, `device`, `browser`, `ip_hash`, `visited_at`, `created_at`) VALUES
(1, 'PZxqj2Ehiu8lmWqBW59aJcs0UlrxRvhwrfpEKIVi', 'PZxqj2Ehiu8lmWqBW59aJcs0UlrxRvhwrfpEKIVi', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.138.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 18:26:30', '2026-09-23 01:26:30'),
(2, 'N5VGNyim1WH6W8v7j1jWchh4Q0dWmTRf1BFjbLNQ', 'N5VGNyim1WH6W8v7j1jWchh4Q0dWmTRf1BFjbLNQ', '/', NULL, 'desktop', 'Python-urllib/3.14', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 18:26:48', '2026-09-23 01:26:49'),
(3, '5zPGb7AtcEYJs5uJuFVCqS1PzKCM7v6cHW52yTAd', '5zPGb7AtcEYJs5uJuFVCqS1PzKCM7v6cHW52yTAd', '/', NULL, 'desktop', 'Python-urllib/3.14', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 18:26:49', '2026-09-23 01:26:49'),
(4, 'jaoNMM5KyXAnbQca5nhhZMCCHX85QUDVQ8uvnGO6', 'jaoNMM5KyXAnbQca5nhhZMCCHX85QUDVQ8uvnGO6', '/', NULL, 'desktop', 'Python-urllib/3.14', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 18:27:31', '2026-09-23 01:27:31'),
(5, 'X8LSkfXw0weG3ESqKtZ82Sj0ydsWeDcORMdIBkHD', 'X8LSkfXw0weG3ESqKtZ82Sj0ydsWeDcORMdIBkHD', '/', 'http://127.0.0.1:8000/admin/login', 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 18:42:12', '2026-09-23 01:42:12'),
(6, '2KgsT0i2OZ7V1IaJ2h3fpd1LDNzB7Zo3ASPCVmkd', '2KgsT0i2OZ7V1IaJ2h3fpd1LDNzB7Zo3ASPCVmkd', '/', 'http://127.0.0.1:8000/admin/login', 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 18:49:30', '2026-09-23 01:49:30'),
(7, 'OH4eAf7BR4cTLRkE8FVH5s66KOhRMv8nteGnKmga', 'OH4eAf7BR4cTLRkE8FVH5s66KOhRMv8nteGnKmga', '/', 'http://127.0.0.1:8000/admin/login', 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 19:45:15', '2026-09-23 02:45:15'),
(8, 'VBRGD0qD6m9TfxjZqclVpzYpZAo2KNdxqYEbElOl', 'VBRGD0qD6m9TfxjZqclVpzYpZAo2KNdxqYEbElOl', '/', NULL, 'desktop', 'Python-urllib/3.14', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 19:53:31', '2026-09-23 02:53:31'),
(9, 'idK4wtNrzlgWF1tkRncmaVaIKjoIqGFRdKohiQND', 'idK4wtNrzlgWF1tkRncmaVaIKjoIqGFRdKohiQND', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 19:57:07', '2026-09-23 02:57:07'),
(10, 'idK4wtNrzlgWF1tkRncmaVaIKjoIqGFRdKohiQND', 'idK4wtNrzlgWF1tkRncmaVaIKjoIqGFRdKohiQND', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 19:59:19', '2026-09-23 02:59:19'),
(11, 'VS4WIZm26ff5hKA53qBJkBtPSltpvbYSkbmc3mon', 'VS4WIZm26ff5hKA53qBJkBtPSltpvbYSkbmc3mon', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 20:35:39', '2026-09-23 03:35:39'),
(12, 'VS4WIZm26ff5hKA53qBJkBtPSltpvbYSkbmc3mon', 'VS4WIZm26ff5hKA53qBJkBtPSltpvbYSkbmc3mon', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 20:37:47', '2026-09-23 03:37:47'),
(13, 'Fc5IDs7d9MiwecBm3WOIvmYL7rbMAmkjvAdX1oPe', 'Fc5IDs7d9MiwecBm3WOIvmYL7rbMAmkjvAdX1oPe', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.138.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 20:38:11', '2026-09-23 03:38:11'),
(14, 'Fc5IDs7d9MiwecBm3WOIvmYL7rbMAmkjvAdX1oPe', 'Fc5IDs7d9MiwecBm3WOIvmYL7rbMAmkjvAdX1oPe', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.138.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-22 20:38:19', '2026-09-23 03:38:19'),
(15, 'TDgEbCui4aQhVxJLINRyLKiY0M3feDLJXpivAouC', 'TDgEbCui4aQhVxJLINRyLKiY0M3feDLJXpivAouC', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.138.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-25 07:56:10', '2026-09-25 14:56:10'),
(16, '4v0M9xUGBzYrB2WLXEAEhi1ZpJVN5OEftoPW3Mcg', '4v0M9xUGBzYrB2WLXEAEhi1ZpJVN5OEftoPW3Mcg', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-25 07:56:19', '2026-09-25 14:56:19'),
(17, '4EGd2ZGOqJNHh6FTFfk0SMHP3DUsMqDYE3GvbEwR', '4EGd2ZGOqJNHh6FTFfk0SMHP3DUsMqDYE3GvbEwR', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-25 07:56:21', '2026-09-25 14:56:21'),
(18, 'bqO3xThoNsX32uhdXzY7GbNs3NoPsuNwF3xlct8Q', 'bqO3xThoNsX32uhdXzY7GbNs3NoPsuNwF3xlct8Q', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-27 18:11:06', '2026-09-28 01:11:06'),
(19, 'FUUOzh6hO1hxvlm4nVrur6xrMqeFloCss4wkab3A', 'FUUOzh6hO1hxvlm4nVrur6xrMqeFloCss4wkab3A', '/', NULL, 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-27 18:21:44', '2026-09-28 01:21:44'),
(20, 'UnL0SeD23SbmBdKXl5CVSOaI1sB4rQramnNtsuzV', 'UnL0SeD23SbmBdKXl5CVSOaI1sB4rQramnNtsuzV', '/', 'http://127.0.0.1:8000/admin/login', 'desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-27 18:27:45', '2026-09-28 01:27:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_status_index` (`status`),
  ADD KEY `articles_author_id_index` (`author_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_status_index` (`status`),
  ADD KEY `galleries_category_index` (`category`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketplace_clicks`
--
ALTER TABLE `marketplace_clicks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketplace_clicks_visitor_id_index` (`visitor_id`),
  ADD KEY `marketplace_clicks_product_id_index` (`product_id`),
  ADD KEY `marketplace_clicks_clicked_at_index` (`clicked_at`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partnerships`
--
ALTER TABLE `partnerships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partnerships_status_index` (`status`),
  ADD KEY `partnerships_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `products_status_index` (`status`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `website_visits`
--
ALTER TABLE `website_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `website_visits_visitor_id_index` (`visitor_id`),
  ADD KEY `website_visits_session_id_index` (`session_id`),
  ADD KEY `website_visits_visited_at_index` (`visited_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketplace_clicks`
--
ALTER TABLE `marketplace_clicks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `partnerships`
--
ALTER TABLE `partnerships`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `website_visits`
--
ALTER TABLE `website_visits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `marketplace_clicks`
--
ALTER TABLE `marketplace_clicks`
  ADD CONSTRAINT `marketplace_clicks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
