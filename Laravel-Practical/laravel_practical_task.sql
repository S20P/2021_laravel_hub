-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2021 at 10:31 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_practical_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2021_05_23_035650_create_permission_tables', 1),
(15, '2021_05_23_040733_create_posts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(6, 'App\\Models\\User', 2),
(6, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2021-05-22 23:51:28', '2021-05-22 23:51:28'),
(2, 'role-create', 'web', '2021-05-22 23:51:28', '2021-05-22 23:51:28'),
(3, 'role-edit', 'web', '2021-05-22 23:51:28', '2021-05-22 23:51:28'),
(4, 'role-delete', 'web', '2021-05-22 23:51:28', '2021-05-22 23:51:28'),
(5, 'post-list', 'web', '2021-05-22 23:51:28', '2021-05-22 23:51:28'),
(6, 'post-create', 'web', '2021-05-22 23:51:28', '2021-05-22 23:51:28'),
(7, 'post-edit', 'web', '2021-05-22 23:51:28', '2021-05-22 23:51:28'),
(8, 'post-delete', 'web', '2021-05-22 23:51:28', '2021-05-22 23:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `description`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'blog1', '20210523064316.png', 'testgfgdfgd', 1, '2021-05-23 01:35:06', '2021-05-23 01:13:16', '2021-05-23 01:35:06'),
(2, '“The Best Way To Get Started Is To Quit Talking And Begin Doing.” – Walt Disney', '20210523070709.png', 'This straight-to-business quote comes from the man who created the happiest place on earth – and a multibillion-dollar empire. Click here to tweet this inspirational quote.', 1, NULL, '2021-05-23 01:37:09', '2021-05-23 01:37:09'),
(3, '“The Pessimist Sees Difficulty In Every Opportunity. The Optimist Sees Opportunity In Every Difficulty.” – Winston Churchill', '20210523070745.jpg', 'When it comes to success quotes by famous people, Winston Churchill’s inspirational words of wisdom always make the list. Click here to tweet this quote.', 1, NULL, '2021-05-23 01:37:45', '2021-05-23 01:37:45'),
(4, '“Don’t Let Yesterday Take Up Too Much Of Today.” – Will Rogers', '20210523070814.png', 'Will Rogers was an American actor, cowboy, columnist and social commentator who believed in keeping forward momentum. Click here to tweet this quote.', 1, NULL, '2021-05-23 01:38:14', '2021-05-23 01:38:14'),
(5, '“You Learn More From Failure Than From Success. Don’t Let It Stop You. Failure Builds Character.” – Unknown', '20210523070844.png', 'When you replace ‘lose’ with ‘learn’ in your vocabulary, the thought of failure becomes less daunting and lets you focus on growth. Click here to tweet this.', 1, NULL, '2021-05-23 01:38:44', '2021-05-23 01:38:44'),
(6, '“It’s Not Whether You Get Knocked Down, It’s Whether You Get Up.” – Inspirational Quote By Vince Lombardi', '20210523070911.jpg', 'Vince Lombardi was an American football hero who’s uplifting words frequently make it onto Top 10 Inspirational Quotes lists. Click here to tweet this quote.', 1, NULL, '2021-05-23 01:39:11', '2021-05-23 01:39:11'),
(7, '“If You Are Working On Something That You Really Care About, You Don’t Have To Be Pushed. The Vision Pulls You.” – Steve Jobs', '20210523070932.png', 'Steve Jobs truly captured some of the wisdom of life in this statement. Do that which you are passionate about and your work will feel effortless.', 1, NULL, '2021-05-23 01:39:32', '2021-05-23 01:39:32'),
(8, '“People Who Are Crazy Enough To Think They Can Change The World, Are The Ones Who Do.” – Rob Siltanen', '20210523070954.jpg', 'I believe this is one of the best quotes to live by because it reminds me to think without limits and never doubt my wildest thoughts.', 1, NULL, '2021-05-23 01:39:54', '2021-05-23 01:39:54'),
(9, '“Failure Will Never Overtake Me If My Determination To Succeed Is Strong Enough.” – Og Mandino', '20210523071021.jpg', 'There’s a special place in my heart for these inspirational words. They remind me of my unwavering determination to become a motivational speaker.', 1, NULL, '2021-05-23 01:40:21', '2021-05-23 01:40:21'),
(10, '“Entrepreneurs Are Great At Dealing With Uncertainty And Also Very Good At Minimizing Risk. That’s The Classic Entrepreneur.” – Mohnish Pabrai', '20210523071044.png', 'This line always puts a smile on my face because it alludes to the excitement of not knowing what to expect but seeing a possible life-changing outcome.', 1, NULL, '2021-05-23 01:40:44', '2021-05-23 01:40:44'),
(11, '“We May Encounter Many Defeats But We Must Not Be Defeated.” – Maya Angelou', '20210523071103.jpg', 'Maya Angelou was one of the top civil rights activists and embraced a spirit of positive thinking and sheer determination.', 1, NULL, '2021-05-23 01:41:03', '2021-05-23 01:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-05-22 23:55:27', '2021-05-22 23:55:27'),
(2, 'user-viewer', 'web', '2021-05-23 00:08:52', '2021-05-23 00:08:52'),
(3, 'user-editor', 'web', '2021-05-23 00:09:11', '2021-05-23 00:09:11'),
(4, 'user-cretor', 'web', '2021-05-23 00:09:31', '2021-05-23 00:09:31'),
(5, 'user-deleter', 'web', '2021-05-23 00:09:42', '2021-05-23 00:09:42'),
(6, 'user-all-access', 'web', '2021-05-23 00:10:00', '2021-05-23 00:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 2),
(5, 6),
(6, 1),
(6, 4),
(6, 6),
(7, 1),
(7, 3),
(7, 6),
(8, 1),
(8, 5),
(8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Active and 1 = Deactivate and 2 = Suspended',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `profile_picture`, `gender`, `phone`, `status`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Satish', 'Parmar', 'admin@gmail.com', NULL, 'male', '7574945107', 0, NULL, 1, '$2y$10$1JWLvlJRO/gyp19Fb1f7XekGd0nb4kUypnfg6xm5WqqX8MPEBIWpq', NULL, NULL, '2021-05-22 23:55:27', '2021-05-22 23:55:27'),
(2, 'a1', 'a2', 'a1@gmail.com', '20210523064056.png', 'male', '7574845555', 0, NULL, NULL, '$2y$10$BtWSmrxes1GgboXfd.r1l.4fcULPhwTq7CxCjh.nsR3NnNzfq.a1O', NULL, NULL, '2021-05-23 01:10:56', '2021-05-23 01:10:56'),
(3, 'user1', 'dev', 'dev@gmail.com', '20210523080656.png', 'male', '34234234234', 0, NULL, NULL, '$2y$10$T8fMkZTBhsFsfp9GptKrHuMKwem4sNHv4Zc.NaFP/RHClU8kd7KSq', NULL, NULL, '2021-05-23 02:36:56', '2021-05-23 02:36:56'),
(4, 'user', 'test', 'user1@gmail.com', '20210523081055.png', 'male', '4234234234', 1, NULL, NULL, '$2y$10$L207LrSHWMlBehrZEhIN8uhDytoz/oFJ5p2xWALlGEEWzZYVbGA86', NULL, NULL, '2021-05-23 02:40:55', '2021-05-23 02:40:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
