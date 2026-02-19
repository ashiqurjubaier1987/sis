-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 01, 2025 at 03:34 PM
-- Server version: 8.0.42
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
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
(4, '2025_05_19_153638_create_personal_access_tokens_table', 1),
(5, '2025_05_19_190644_create_subjects_table', 2),
(6, '2025_05_19_195243_change_the_type_of_description_field_in_subjects_table', 3),
(8, '2025_05_20_035933_adding_softdelete_for_the_table_subjects', 4),
(9, '2025_05_22_121610_adding_a_column_phone_type_is_text_after_email_column_for_the_table_users', 5),
(10, '2025_05_24_010127_create_permission_tables', 6),
(11, '2025_05_26_102541_new_column_added_in_users_and_roles_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'subject.view', 'api', '2025-05-24 01:49:18', '2025-05-24 01:49:18'),
(2, 'subject.create', 'api', '2025-05-24 01:49:34', '2025-05-24 01:49:34'),
(3, 'subject.edit', 'api', '2025-05-24 01:51:14', '2025-05-24 01:51:14'),
(4, 'subject.delete', 'api', '2025-05-24 01:51:32', '2025-05-24 01:51:32'),
(5, 'role.view', 'api', '2025-05-24 01:53:02', '2025-05-29 06:39:42'),
(6, 'role.create', 'api', '2025-05-24 01:53:11', '2025-05-24 01:53:11'),
(7, 'role.edit', 'api', '2025-05-24 01:53:16', '2025-05-24 01:53:16'),
(8, 'role.delete', 'api', '2025-05-24 01:53:21', '2025-05-24 01:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 2, 'Ashiqur Jubaier', 'd8c46a2c9020cb20a4a23578d152859ea3b475d6e20e3c400dd08e3115ebfa5e', '[\"*\"]', NULL, NULL, '2025-05-21 19:51:10', '2025-05-21 19:51:10'),
(6, 'App\\Models\\User', 6, 'Ashiqur Jubaier', '33b8f7dbdf246ccd350cbee422e8c8ed360959a148d937c45402c0d789cced61', '[\"*\"]', NULL, NULL, '2025-05-21 20:38:41', '2025-05-21 20:38:41'),
(8, 'App\\Models\\User', 8, 'Ashiqur Jubaier', '574b6d49f45c9d51d541585ab318f476818a636dd1088fc59d107092b693b5be', '[\"*\"]', NULL, NULL, '2025-05-21 21:03:13', '2025-05-21 21:03:13'),
(25, 'App\\Models\\User', 7, 'Ashiqur Jubaier', '5ccc8f6e8fe770a5adfdb3461ddc91e9aa2e3e2f59beb4fd520e30493cc4cf9d', '[\"*\"]', NULL, NULL, '2025-05-21 21:50:10', '2025-05-21 21:50:10'),
(30, 'App\\Models\\User', 1, 'Ashiqur Jubaier', '8ca5828e3d7a054bac1e16083670e6ca788163f38196787e2161ab038f6cd98c', '[\"*\"]', '2025-05-22 00:53:29', NULL, '2025-05-22 00:42:08', '2025-05-22 00:53:29'),
(31, 'App\\Models\\User', 9, 'Ashiqur Jubaier', 'ecfb961d592191366ed0310074f26a6ceb93c5258d1cfc921bde09c3e182e1a5', '[\"*\"]', NULL, NULL, '2025-05-22 12:22:21', '2025-05-22 12:22:21'),
(32, 'App\\Models\\User', 10, 'Ashiqur Jubaier', 'a89609ac696f977a370fde4b8d85624b53a78a37a1d71c1a40abb7e89c120bd5', '[\"*\"]', NULL, NULL, '2025-05-22 12:27:37', '2025-05-22 12:27:37'),
(33, 'App\\Models\\User', 11, 'Ashiqur Jubaier', '67088d4ba7eb144dbeda5cdbc070e2ab71733ab23616197c8548f646ee8f76f7', '[\"*\"]', NULL, NULL, '2025-05-22 12:30:05', '2025-05-22 12:30:05'),
(34, 'App\\Models\\User', 12, 'Ashiqur Jubaier', '3e38dc48646806e1c2e3876e5415d74b079660c6dc8497210ced115bd5095eb0', '[\"*\"]', NULL, NULL, '2025-05-22 12:32:25', '2025-05-22 12:32:25'),
(35, 'App\\Models\\User', 13, 'Ashiqur Jubaier', '71ff749e47aaed14a04697331e30afb2691615bfba1f181b7c74542e05b0ef47', '[\"*\"]', NULL, NULL, '2025-05-22 12:33:04', '2025-05-22 12:33:04'),
(36, 'App\\Models\\User', 14, 'Ashiqur Jubaier', '352ba14c5980a79c6a60d66cfc7434a230ac8b073e648d22e5f689afd821a2f8', '[\"*\"]', NULL, NULL, '2025-05-22 12:33:58', '2025-05-22 12:33:58'),
(37, 'App\\Models\\User', 15, 'Ashiqur Jubaier', 'acc5bc3d911e9c4a5472d1a6502e43da45ac78a791ac4d5209fa5183a87fdfa1', '[\"*\"]', NULL, NULL, '2025-05-22 12:41:26', '2025-05-22 12:41:26'),
(38, 'App\\Models\\User', 16, 'Ashiqur Jubaier', '09dd6972eec61c28079261337d2f5592aaa854da5f9e3fe385974946dfdd2493', '[\"*\"]', NULL, NULL, '2025-05-22 13:09:43', '2025-05-22 13:09:43'),
(39, 'App\\Models\\User', 17, 'Ashiqur Jubaier', '015184749365a9d94654e95534f2ca32daf10f2a240c701f2a88e83acf6bd052', '[\"*\"]', NULL, NULL, '2025-05-22 13:20:27', '2025-05-22 13:20:27'),
(40, 'App\\Models\\User', 18, 'Ashiqur Jubaier', '675f840da4fa1e075f594f0f1e7dfbaceb0dd2e9ada8b873e4350d80a158f046', '[\"*\"]', NULL, NULL, '2025-05-22 13:52:07', '2025-05-22 13:52:07'),
(41, 'App\\Models\\User', 19, 'Ashiqur Jubaier', '71063eda45cc2d6114e2a92defbe48d5579db1c6b9dd7e11d9bf8116170964d5', '[\"*\"]', NULL, NULL, '2025-05-22 14:00:20', '2025-05-22 14:00:20'),
(44, 'App\\Models\\User', 21, 'Ashiqur Jubaier', '5ce85c723f7fd53ca3cdf73273b0b15ca24edc85d99c83487e312091836dc1ea', '[\"*\"]', NULL, NULL, '2025-05-22 16:57:54', '2025-05-22 16:57:54'),
(59, 'App\\Models\\User', 25, 'Ashiqur Jubaier', '3b7d7c53d7fb90cd9f477a18f332ebe9bdd041c5ea3de29f41da9a6e03914c3d', '[\"*\"]', NULL, NULL, '2025-05-23 01:02:11', '2025-05-23 01:02:11'),
(60, 'App\\Models\\User', 26, 'Ashiqur Jubaier', '9f57de4d1cd9586976aa31a5ea06a7af129f54fd7ebbf2118969be8b42860910', '[\"*\"]', NULL, NULL, '2025-05-23 01:10:15', '2025-05-23 01:10:15'),
(61, 'App\\Models\\User', 27, 'Ashiqur Jubaier', '97345c612a2e8732e67e85b5b5b7fe2d294d03ab7d409af2bcbca8ac9903508e', '[\"*\"]', NULL, NULL, '2025-05-23 01:10:18', '2025-05-23 01:10:18'),
(63, 'App\\Models\\User', 28, 'Ashiqur Jubaier', 'a6bdac4b9db8e7169e06f9a6ee5df285ef70278d21e0a1a5900ff732e1bc93c5', '[\"*\"]', NULL, NULL, '2025-05-23 01:11:31', '2025-05-23 01:11:31'),
(64, 'App\\Models\\User', 29, 'Ashiqur Jubaier', '37ca8674de2aba48aaf483e0d8b1ea5b41b54cc6984db369ab9456f579f46a4a', '[\"*\"]', NULL, NULL, '2025-05-23 01:11:34', '2025-05-23 01:11:34'),
(65, 'App\\Models\\User', 30, 'Ashiqur Jubaier', '502462f46143858e55f659fbab863f5c901081352831b8bb2ff5d029af3d1d4d', '[\"*\"]', NULL, NULL, '2025-05-23 01:17:42', '2025-05-23 01:17:42'),
(66, 'App\\Models\\User', 31, 'Ms. Fredrick Wyman', 'f6526fb7dca5a451cc6b21fe430882788ccdf747b5c0292e5288fa25b7a622a9', '[\"*\"]', NULL, NULL, '2025-05-23 01:18:27', '2025-05-23 01:18:27'),
(67, 'App\\Models\\User', 32, 'Josefina Simonis', '233f003de5302123f81198bdf26a0b69d6af18b08672009867c42e778eaf2baa', '[\"*\"]', NULL, NULL, '2025-05-23 01:18:29', '2025-05-23 01:18:29'),
(68, 'App\\Models\\User', 33, 'Shawna Jakubowski', '6f5678c57c2a0ee49ace1735a40a33f599c76ba11a574a20aa4f10c96c813d59', '[\"*\"]', NULL, NULL, '2025-05-23 01:18:32', '2025-05-23 01:18:32'),
(69, 'App\\Models\\User', 34, 'Nicole Connelly', 'e02d0389bacd6bbfa63c33d7f4c119ebc16519028fe23f3695cd1330a310d5a2', '[\"*\"]', NULL, NULL, '2025-05-23 01:18:39', '2025-05-23 01:18:39'),
(70, 'App\\Models\\User', 35, 'Guillermo Adams', '824ed6c06af82c071e7558a04e4eb71e2de12333af1be30afe336435db0e4fa5', '[\"*\"]', NULL, NULL, '2025-05-23 01:20:25', '2025-05-23 01:20:25'),
(71, 'App\\Models\\User', 36, 'Sherri Heidenreich', 'b78df8bf780a87f06e5327557c4c14c299c5c08f9bfe7d205e1d451b6adee8c0', '[\"*\"]', NULL, NULL, '2025-05-23 01:20:35', '2025-05-23 01:20:35'),
(72, 'App\\Models\\User', 37, 'Deborah Wisozk', '1f1186732639dff3f4f4e02c08cef658024be960dc9519f92283790e17bd44c1', '[\"*\"]', NULL, NULL, '2025-05-23 01:23:37', '2025-05-23 01:23:37'),
(73, 'App\\Models\\User', 38, 'Lydia Vandervort', '97e76980a844ac30cd0ce5b2bbc353de0e20d5b1ca66e308825bef5c6ead96a3', '[\"*\"]', NULL, NULL, '2025-05-23 01:24:31', '2025-05-23 01:24:31'),
(74, 'App\\Models\\User', 39, 'James Keeling', 'c89dea72ad7489a2f0e72ffb33726046a988fe66a2e8aea2df3778a4ee65aa90', '[\"*\"]', NULL, NULL, '2025-05-23 01:25:07', '2025-05-23 01:25:07'),
(75, 'App\\Models\\User', 40, 'Glenda Lindgren', '7895d6170e0bb0fad78d5b81fa6d15c90cc8b3a62d77a829c962f7f9f68183b4', '[\"*\"]', NULL, NULL, '2025-05-23 01:25:22', '2025-05-23 01:25:22'),
(76, 'App\\Models\\User', 41, 'Eileen Runolfsdottir', '88efe7ac8fe5a886ab6db7c5ef80b65a725e184f96c60a19b410960bf8710195', '[\"*\"]', NULL, NULL, '2025-05-23 01:25:38', '2025-05-23 01:25:38'),
(77, 'App\\Models\\User', 42, 'Trevor White', '52a6d8046fc1e324acdf639b522e9e0e45008048088eac997aa20743afea4903', '[\"*\"]', NULL, NULL, '2025-05-23 02:13:45', '2025-05-23 02:13:45'),
(78, 'App\\Models\\User', 43, 'Myra Mertz', '6e4fd1006d5fb3a9bbbb9af6ed0961e9c3003b78a395dbf74b835cf8957028eb', '[\"*\"]', NULL, NULL, '2025-05-23 02:14:37', '2025-05-23 02:14:37'),
(79, 'App\\Models\\User', 44, 'Ismael Roberts', 'de99638b0f3b745e040ebeb3527961e14136809974be69f2dd665740c7766679', '[\"*\"]', NULL, NULL, '2025-05-23 02:23:45', '2025-05-23 02:23:45'),
(80, 'App\\Models\\User', 45, 'Santos Schowalter', 'bf551820c04112dbcfd489f72ba9bbba4e5504f091b5d43d936a38c71a535858', '[\"*\"]', NULL, NULL, '2025-05-23 02:33:53', '2025-05-23 02:33:53'),
(81, 'App\\Models\\User', 46, 'Ryan Kihn', '529bebc0be56e0288170b58a30f5e1073eb55587c61d6569442387dff9b8b927', '[\"*\"]', NULL, NULL, '2025-05-23 02:34:21', '2025-05-23 02:34:21'),
(84, 'App\\Models\\User', 47, 'Sonja Keeling', '69f5af0015bc61ad76c23d8299b3194e09548835f12ff3217a863d58a74f518e', '[\"*\"]', NULL, NULL, '2025-05-23 02:35:40', '2025-05-23 02:35:40'),
(85, 'App\\Models\\User', 48, 'Carroll Hand', '8bc67b5fb5ca8600d78d66d211395adb0cb361b7f9d87ef56709b58b2f439dfa', '[\"*\"]', NULL, NULL, '2025-05-23 02:35:59', '2025-05-23 02:35:59'),
(92, 'App\\Models\\User', 2, 'Ashiqur Jubaier', '0865e23adb21667083371beddb999515ccfcf839303c3af4fe609ee26b2cf260', '[\"*\"]', NULL, NULL, '2025-05-23 02:48:20', '2025-05-23 02:48:20'),
(93, 'App\\Models\\User', 51, 'Keith Hammes', '369dbc604535327cfafc704f97c9eca209d1ae7b22b9bdd4a808a619a09378b4', '[\"*\"]', NULL, NULL, '2025-05-23 02:50:09', '2025-05-23 02:50:09'),
(100, 'App\\Models\\User', 20, 'Ashiqur Jubaier', '56d839e7a099fea7b103249ed2eba61b8e487e3d6cb935caf14cfa546866c1fb', '[\"*\"]', '2025-05-29 04:27:01', NULL, '2025-05-26 13:31:50', '2025-05-29 04:27:01'),
(101, 'App\\Models\\User', 20, 'Ashiqur Jubaier', 'ed290e1acd77ecc5e0ac1decbf5a4daeda88913c51deb38b169f35bad6b804b8', '[\"*\"]', NULL, NULL, '2025-05-29 04:33:04', '2025-05-29 04:33:04'),
(103, 'App\\Models\\User', 20, 'Ashiqur Jubaier', '4090ebf605e615f2b701a0893601905bef2399778451bbdaf83ea02dcaea4f95', '[\"*\"]', '2025-05-29 18:27:45', NULL, '2025-05-29 04:35:09', '2025-05-29 18:27:45'),
(104, 'App\\Models\\User', 20, 'Ashiqur Jubaier', 'cc459788216ecec1e65591133878eeb6ed90d836c1fe8159a2f729bf0871d122', '[\"*\"]', '2025-05-29 18:30:07', NULL, '2025-05-29 18:29:11', '2025-05-29 18:30:07'),
(105, 'App\\Models\\User', 20, 'Ashiqur Jubaier', '087fbd7d57e4540467f0f691d75c6a0fcf16a0d758b02d65056e5cb43f19f885', '[\"*\"]', '2025-05-29 18:32:18', NULL, '2025-05-29 18:32:02', '2025-05-29 18:32:18'),
(106, 'App\\Models\\User', 20, 'Ashiqur Jubaier', '160cb4ca55b903c55a82cba225b0e1670d00d000a691bff3d61479e86d815598', '[\"*\"]', '2025-05-29 18:34:43', NULL, '2025-05-29 18:33:29', '2025-05-29 18:34:43'),
(107, 'App\\Models\\User', 20, 'Ashiqur Jubaier', '0729680ad07e15b33e28d91b6e0c8a7087e681314c59ddeefaa8d6498adb9a62', '[\"*\"]', '2025-05-29 18:43:25', NULL, '2025-05-29 18:35:12', '2025-05-29 18:43:25'),
(108, 'App\\Models\\User', 55, 'Roberto Runolfsson', 'fb5eebda94d69a036453959db6457092eabf58fadbb66a1f0993417dcdf085df', '[\"*\"]', '2025-05-30 04:48:57', NULL, '2025-05-29 18:43:47', '2025-05-30 04:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadmin', 'api', '2025-05-28 20:43:38', '2025-05-28 20:43:38', NULL),
(2, 'admin', 'api', '2025-05-28 20:43:44', '2025-05-28 20:43:44', NULL),
(3, 'teacher', 'api', '2025-05-28 20:44:02', '2025-05-28 20:44:02', NULL),
(4, 'student', 'api', '2025-05-28 20:44:07', '2025-05-28 20:44:07', NULL),
(5, 'lol', 'api', '2025-05-28 20:52:46', '2025-05-29 18:37:03', NULL),
(7, 'teacheradmin', 'api', '2025-05-29 05:20:32', '2025-05-29 05:20:32', NULL),
(9, 'teacheradmin1', 'api', '2025-05-29 05:26:41', '2025-05-29 05:27:43', '2025-05-29 05:27:43'),
(10, 'teacheradmin2', 'api', '2025-05-29 05:29:37', '2025-05-29 05:29:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 5),
(2, 5),
(3, 5),
(1, 7),
(2, 7),
(4, 7),
(1, 9),
(2, 9),
(4, 9),
(1, 10),
(2, 10),
(4, 10);

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
('mZJxw2Wlfl2AMCjKTXC5WvwpKtOg4jWImJhPKWOd', NULL, '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblR3bHNmbUs0b2pHUm9kbzRRMlVQVWJDV3ZjWnliS3pQa1Bja3h5dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTU6Imh0dHA6Ly9zaXMudGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748254357);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Subject 1', 'SUB1', 'This subject is important.', 1, 0, '2025-05-19 20:52:23', '2025-05-20 04:11:01', '2025-05-20 04:11:01'),
(3, 'Subject 3', 'SUB3', 'This is subject 3.asdad', 1, 0, '2025-05-20 02:53:35', '2025-05-29 05:17:48', NULL),
(5, 'Subject 5', 'SUB5', 'This subject is important.', 1, 0, '2025-05-20 19:23:27', '2025-05-20 19:23:36', '2025-05-20 19:23:36'),
(6, 'Subject 6', 'SUB6', 'This subject is important.', 1, 0, '2025-05-20 19:24:01', '2025-05-20 19:24:01', NULL),
(7, 'Subject 7', 'SUB7', 'This subject is important.', 1, 0, '2025-05-22 00:42:20', '2025-05-22 00:42:20', NULL),
(8, 'Subject 8', 'SUB8', 'This subject is important.', 1, 0, '2025-05-22 00:45:16', '2025-05-22 00:45:16', NULL),
(9, 'Subject 9', 'SUB9', 'This subject is important.', 1, 0, '2025-05-23 00:39:13', '2025-05-23 00:39:13', NULL),
(10, 'Subject 10', 'SUB10', 'This subject is important.', 1, 0, '2025-05-29 04:45:00', '2025-05-29 04:45:00', NULL),
(11, 'Subject 11', 'SUB11', 'This subject is important.', 1, 0, '2025-05-29 05:17:17', '2025-05-29 05:17:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Phone number of the user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Ashiqur Jubaier', 'ashiqurjubaier1@gmail.com', NULL, NULL, '$2y$12$ECb2Tf/ACEeTvBJl4sMw8u0corl0l2d5dAJulq.dCzg3306Rz6.k2', NULL, '2025-05-21 19:51:10', '2025-05-21 19:51:10', NULL),
(3, 'Ashiqur Jubaier', 'ashiqurjubaier11@gmail.com', NULL, NULL, '$2y$12$HEiaH23kFbtuUSmMPRuixOco9hUBcZsQtTouV6LJ1nc13cUZACaY.', NULL, '2025-05-21 19:52:26', '2025-05-26 12:54:37', '2025-05-26 12:54:37'),
(6, 'Ashiqur Jubaier', 'ashiqurjubaier1212@gmail.com', NULL, NULL, '$2y$12$tqN4G9lBSIZyXyt5S3cA4OK2UuiwtqUnwcubUp3ire6y25c3IQwo2', NULL, '2025-05-21 20:38:41', '2025-05-21 20:38:41', NULL),
(7, 'Ashiqur Jubaier', 'ashiqurjubaier2@gmail.com', NULL, NULL, '$2y$12$GxjhIkFZ5OGyZ2dU0mh2fekmD0o2lRBweU3tjVrwH1oFcZdStD11O', NULL, '2025-05-21 21:01:39', '2025-05-21 21:01:39', NULL),
(8, 'Ashiqur Jubaier', 'ashiqurjubaier21@gmail.com', NULL, NULL, '$2y$12$kZiPtDhKpvyvmV7bXhskRu8nOESZ061iwDyFN/ynFzNLHBaStTNk2', NULL, '2025-05-21 21:03:13', '2025-05-21 21:03:13', NULL),
(20, 'Ashiqur Jubaier', 'ashiqurjubaier@gmail.com', '8801711109999', NULL, '$2y$12$1MiRoLYP0P4YQ4hp.woT..GC9919xLGMkHI/X2jjLwFJQJal/JdiK', NULL, '2025-05-22 16:54:49', '2025-05-26 13:28:38', NULL),
(21, 'Ashiqur Jubaier', 'ashiqurjubaier3123@gmail.com', NULL, NULL, '$2y$12$525jkpFeqetNhc0LKa9pZuS2flB8BhMFEXHMlk.QU65Gf/in7.6hm', NULL, '2025-05-22 16:57:54', '2025-05-22 16:57:54', NULL),
(23, 'Ashiqur Jubaier', 'Brennon.Kreiger42@hotmail.com', '8801750320016', NULL, '$2y$12$wfQ462CDh9tLevns0E4reenVxVuNDgwiVCnebLeZuWnuZO0m0/lIK', NULL, '2025-05-23 01:02:07', '2025-05-29 05:59:17', '2025-05-29 05:59:17'),
(24, 'Ashiqur Jubaier', 'Cleve_Medhurst@gmail.com', '8801563151516', NULL, '$2y$12$3GPf6FijEIUAcpfXV0CnWOZ1Dbiba87fOVi49y/NjpfKvUWxmLrne', NULL, '2025-05-23 01:02:09', '2025-05-29 06:43:12', '2025-05-29 06:43:12'),
(25, 'Ashiqur Jubaier', 'Alexzander62@hotmail.com', '8801663366640', NULL, '$2y$12$e.zg7nzUQEzWExOufhvK/uvgZbaBohN4hF23T5d0MR4z2cte7OZJ6', NULL, '2025-05-23 01:02:11', '2025-05-23 01:02:11', NULL),
(26, 'Ashiqur Jubaier', 'Kaleb85@hotmail.com', '8801726067236', NULL, '$2y$12$3pM67pCg/y9IOXouhjVAZux9xHxtDhs7QniJmg5bSRmY9GfvFK3by', NULL, '2025-05-23 01:10:15', '2025-05-23 01:10:15', NULL),
(27, 'lol lol lol', 'lol@gmail.com', '8801711109988', NULL, '$2y$12$x1JKl8Rb7aUq/0azPtkWeO67NBGN16gR9t2epHqqAJdQS8NtCkDua', NULL, '2025-05-23 01:10:18', '2025-05-29 18:43:14', NULL),
(28, 'Ashiqur Jubaier', 'Dimitri.Koss93@yahoo.com', '8801544325430', NULL, '$2y$12$ASR7Ri1ugmURpsu2QmOaZuUskQ8i/./2MxfArVybTHEY47Wpai7rW', NULL, '2025-05-23 01:11:31', '2025-05-23 01:11:31', NULL),
(29, 'Ashiqur Jubaier', 'Sincere70@gmail.com', '8801705517633', NULL, '$2y$12$d22yCfNcNdvqgCdOrL2OaO/j2NA9OuxUWBC3op4ZJpAG3WAufK8Rq', NULL, '2025-05-23 01:11:34', '2025-05-23 01:11:34', NULL),
(30, 'Ashiqur Jubaier', 'Koby14@gmail.com', '8801357613300', NULL, '$2y$12$fC4TzLloJAULkuVL2qfL5ubTKNCBSGv9UeiaJ/RDxIJoFqvguw1Rq', NULL, '2025-05-23 01:17:42', '2025-05-23 01:17:42', NULL),
(31, 'Ms. Fredrick Wyman', 'Jess_Bartell95@gmail.com', '8801756432702', NULL, '$2y$12$GNDxMQkwTVmCx34zKWL5TeDnsTcQGunhpxJ0KgINheXYJAQLY3rpy', NULL, '2025-05-23 01:18:27', '2025-05-23 01:18:27', NULL),
(32, 'Josefina Simonis', 'Marjolaine12@hotmail.com', '8801875151446', NULL, '$2y$12$D.ZIDfwuQaCwMhlCcq5av.AU9/5R5V.zNR3do8hI.yoHobmLV.tyC', NULL, '2025-05-23 01:18:29', '2025-05-23 01:18:29', NULL),
(33, 'Shawna Jakubowski', 'Domenick_Langworth@gmail.com', '8801354127177', NULL, '$2y$12$xjIHGSgkrXvzue5YCMwOeue6OpWUXbUh9xfN9qLldbBIcTbjDrW5m', NULL, '2025-05-23 01:18:32', '2025-05-23 01:18:32', NULL),
(34, 'Nicole Connelly', 'Petra.Huels@gmail.com', '8801512574232', NULL, '$2y$12$IjMPnOgkzIoAY00nJ/qkmeykp3lvFQkqQViKMHMI7HV7Ifon5BUmm', NULL, '2025-05-23 01:18:39', '2025-05-23 01:18:39', NULL),
(35, 'Guillermo Adams', 'Asha58@hotmail.com', '8801373324461', NULL, '$2y$12$HxxSEONap2VZlm68fnanouX7utnp6QHkIJDPwwRwo6kb0zBP3i1pu', NULL, '2025-05-23 01:20:25', '2025-05-23 01:20:25', NULL),
(36, 'Sherri Heidenreich', 'Colton_Beatty@yahoo.com', '8801456312706', NULL, '$2y$12$wAHF8g9K8g5HKOUdxpMQIupw1DggdchxkAm7Lnis0KLxNNrlJwSj.', NULL, '2025-05-23 01:20:35', '2025-05-23 01:20:35', NULL),
(37, 'Deborah Wisozk', 'Jocelyn18@gmail.com', '8801762152546', NULL, '$2y$12$wa77yECt9oFcy72d9GKmE.46xs/B7UUK1My6.yGgAWdKUhMHX6V7W', NULL, '2025-05-23 01:23:37', '2025-05-23 01:23:37', NULL),
(38, 'Lydia Vandervort', 'Jovany63@gmail.com', '8801427776667', NULL, '$2y$12$e6cSdIZFvgchV8m/FpQVLuwE6Bs.Nk9XOtlM2QfD3rPs.osStdCym', NULL, '2025-05-23 01:24:31', '2025-05-23 01:24:31', NULL),
(39, 'James Keeling', 'Hope.Bode@gmail.com', '8801825745743', NULL, '$2y$12$3D9p9gidlGbRP9/PhvsAeONh0JCfS8Tk4jAlF3WIuQFeQrQtlzaNS', NULL, '2025-05-23 01:25:07', '2025-05-23 01:25:07', NULL),
(40, 'Glenda Lindgren', 'Eve.Murphy@gmail.com', '8801412411323', NULL, '$2y$12$/SzMa4M.t.jwodKn9f7PF.KpJ0Q2UgqeBj6mXiqR3EgsMWzLE6GtG', NULL, '2025-05-23 01:25:22', '2025-05-23 01:25:22', NULL),
(41, 'Eileen Runolfsdottir', 'Demarcus.Kuhlman7@gmail.com', '8801347473051', NULL, '$2y$12$uzy1vcw2NUFmqM7tFxiRSOWMevh9QseCvCbi0ceUPHt0RZ5S8EO/K', NULL, '2025-05-23 01:25:38', '2025-05-23 01:25:38', NULL),
(42, 'Trevor White', 'Angus.Walker@yahoo.com', '8801537037566', NULL, '$2y$12$/0kf0WpKeuQmva.fFIBkxusrld1bE0.gRv3fCKXbfQ7SWQhDiUZCW', NULL, '2025-05-23 02:13:45', '2025-05-23 02:13:45', NULL),
(43, 'Myra Mertz', 'Darrell.Cronin94@gmail.com', '8801305641315', NULL, '$2y$12$whH87AMeZsyYpSOQLXyvkezr/Yp9mReDoRpEnaYPyz8rGqkbQzjJK', NULL, '2025-05-23 02:14:37', '2025-05-23 02:14:37', NULL),
(44, 'Ismael Roberts', 'Nichole.Parker35@yahoo.com', '8801537653000', NULL, '$2y$12$uHAqJ.F3GTIYIXA44JJYm.9LDUUQIhCgHvzeZlLDPDwz7r8BSc0uu', NULL, '2025-05-23 02:23:45', '2025-05-23 02:23:45', NULL),
(45, 'Santos Schowalter', 'Lura.Turcotte59@gmail.com', '8801740521151', NULL, '$2y$12$SHrxNZl3Fmm8pcwv/JqzzeZ0JfdFeK2iGFS0smG0N1BYM.stUw/DC', NULL, '2025-05-23 02:33:53', '2025-05-23 02:33:53', NULL),
(46, 'Ryan Kihn', 'Dorian_Hudson@gmail.com', '8801552706105', NULL, '$2y$12$YlvoM2.05GKcsXZJ3bvoyukBkiTgqyO47QitK6Ykg4G0norD/.SnS', NULL, '2025-05-23 02:34:21', '2025-05-23 02:34:21', NULL),
(47, 'Sonja Keeling', 'Geoffrey_Adams@yahoo.com', '8801602216432', NULL, '$2y$12$4yow42AiKUe2Wl81fNXjx.lbAM.nzGSXjppOFCsvsGfJMzvpXjpaO', NULL, '2025-05-23 02:35:40', '2025-05-23 02:35:40', NULL),
(48, 'Carroll Hand', 'Yvonne.Marvin81@gmail.com', '8801841115642', NULL, '$2y$12$cnho3k71bQch8cLXhoe2LeBnjo3tMrkVSQC9cOpCRzU8D.B5GLDnm', NULL, '2025-05-23 02:35:59', '2025-05-23 02:35:59', NULL),
(49, 'Harvey Kunze V', 'Rebekah91@hotmail.com', '8801526016256', NULL, '$2y$12$oM06OKbczIeHjx2iX9SzIenGKmkkQkJMKIYtVTSlw7AuEJh155rXK', NULL, '2025-05-23 02:36:02', '2025-05-23 02:36:02', NULL),
(50, 'Francis Steuber', 'Dolly82@hotmail.com', '8801424353601', NULL, '$2y$12$18ZxVobZzWXst1NIPEveBeRVidEf2pZrXK7B63GzHJXLcJ7kqLzJi', NULL, '2025-05-23 02:37:35', '2025-05-23 02:37:35', NULL),
(51, 'Keith Hammes', 'Freeman_Bailey@yahoo.com', '8801633431755', NULL, '$2y$12$c19HqTIrju2b4RIsMqPBUOUnjesDwaO.AH1ELlsYKTUHz.Y.FZhxG', NULL, '2025-05-23 02:50:09', '2025-05-23 02:50:09', NULL),
(52, 'Amanda Cole', 'Marcel.Walker@hotmail.com', '8801615353271', NULL, '$2y$12$PuSiMgz8fsLMPbCx8Yi8He6CMGBW1.JD32iuN2YMHXvWWUE59heY6', NULL, '2025-05-29 04:33:22', '2025-05-29 04:33:22', NULL),
(53, 'Ron Goodwin', 'Baylee.Nitzsche@gmail.com', '01620024672', NULL, '$2y$12$wZ5HphCwK.yHSpOh1io0yOtMX3gsoOGAKDIepOhlYY2w4VJx4.jVW', NULL, '2025-05-29 18:27:45', '2025-05-29 18:27:45', NULL),
(54, 'Samuel Purdy', 'Eleanore53@hotmail.com', '01622077572', NULL, '$2y$12$MtCwx9iF17BVDxUlQaDa7.hHYIP4yhY6LeoxXBUnuMt4/4UZHTtwW', NULL, '2025-05-29 18:30:07', '2025-05-29 18:30:07', NULL),
(55, 'Roberto Runolfsson', 'Everardo_Lockman56@gmail.com', '8801750516052', NULL, '$2y$12$FP5FrG0G.zngBqwbwDgIze.IM5qn7TAiUDiSy8pLa9jQU8YCp7NLK', NULL, '2025-05-29 18:43:47', '2025-05-29 18:43:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_code_unique` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
