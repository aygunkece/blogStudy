/*
 Navicat Premium Data Transfer

 Source Server         : blogcasestudy
 Source Server Type    : MySQL
 Source Server Version : 80033 (8.0.33)
 Source Host           : localhost:3306
 Source Schema         : blogcasestudy

 Target Server Type    : MySQL
 Target Server Version : 80033 (8.0.33)
 File Encoding         : 65001

 Date: 14/11/2023 04:11:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_date` timestamp NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_user_id_foreign` (`user_id`),
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of articles
-- ----------------------------
BEGIN;
INSERT INTO `articles` (`id`, `title`, `content`, `image`, `publish_date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES (13, 'XAut expedita velit i', 'DDD Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics', 'storage/articles/background.jpg', '2023-11-11 14:00:00', 0, 6, '2023-11-11 13:09:25', '2023-11-13 22:32:01');
INSERT INTO `articles` (`id`, `title`, `content`, `image`, `publish_date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES (14, 'Title 2 Güncelle', 'Content 2 Güncel', 'storage/articles/2150649844.jpg', '2023-11-12 11:00:00', 1, 6, '2023-11-11 15:17:03', '2023-11-13 22:19:59');
INSERT INTO `articles` (`id`, `title`, `content`, `image`, `publish_date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES (15, 'Veritatis sit eveni', 'Nunc sed dictum arcu. Aenean ultricies tincidunt sapien, sed elementum est. Nullam id magna efficitur, rutrum justo sit amet, molestie tortor. Integer sit amet efficitur eros, at dictum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dui nibh, scelerisque sed nisl a, suscipit facilisis mi. Proin et enim velit.\r\n\r\nNullam malesuada gravida ultricies. Sed eu magna libero. In neque tortor, accumsan a erat sed, efficitur vulputate nibh. Vestibulum venenatis ipsum velit, vel dictum massa ultrices ut. In efficitur urna sed posuere tincidunt. Sed euismod eleifend velit nec luctus. Nulla sagittis, tellus et efficitur congue, ligula leo suscipit erat, eget placerat lorem felis nec ante. Sed lobortis elementum felis, non ultricies eros consectetur eget.', 'storage/articles/2150649844.jpg', '2023-11-12 11:00:00', 1, 6, '2023-11-11 15:42:34', '2023-11-12 10:14:32');
INSERT INTO `articles` (`id`, `title`, `content`, `image`, `publish_date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES (17, 'Qui lorem neque sint', 'Nunc sed dictum arcu. Aenean ultricies tincidunt sapien, sed elementum est. Nullam id magna efficitur, rutrum justo sit amet, molestie tortor. Integer sit amet efficitur eros, at dictum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dui nibh, scelerisque sed nisl a, suscipit facilisis mi. Proin et enim velit.\r\n\r\nNullam malesuada gravida ultricies. Sed eu magna libero. In neque tortor, accumsan a erat sed, efficitur vulputate nibh. Vestibulum venenatis ipsum velit, vel dictum massa ultrices ut. In efficitur urna sed posuere tincidunt. Sed euismod eleifend velit nec luctus. Nulla sagittis, tellus et efficitur congue, ligula leo suscipit erat, eget placerat lorem felis nec ante. Sed lobortis elementum felis, non ultricies eros consectetur eget.', 'storage/articles/dene1.jpeg', '2023-11-12 09:59:00', 1, 6, '2023-11-11 22:51:19', '2023-11-12 10:14:58');
INSERT INTO `articles` (`id`, `title`, `content`, `image`, `publish_date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES (19, 'Deneme Title', 'İçerik Deneme', 'storage/articles/2150649844.jpg', '2023-11-12 11:50:00', 1, 5, '2023-11-13 22:09:53', '2023-11-13 22:09:53');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2023_11_08_161304_create_permission_tables', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2014_10_12_100000_create_password_resets_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2023_11_09_221852_create_articles_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2023_11_11_212833_create_ratings_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2016_06_01_000001_create_oauth_auth_codes_table', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2016_06_01_000002_create_oauth_access_tokens_table', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2016_06_01_000003_create_oauth_refresh_tokens_table', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2016_06_01_000004_create_oauth_clients_table', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2016_06_01_000005_create_oauth_personal_access_clients_table', 6);
COMMIT;

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
BEGIN;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES (1, 'App\\Models\\User', 5);
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES (3, 'App\\Models\\User', 6);
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES (2, 'App\\Models\\User', 7);
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
BEGIN;
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES (2, 'App\\Models\\User', 5, 'mobillium', '52fbb70c2d1411e6b8b8c01086bb07c7b69e2b5cdc271f3dec11198af9be2e08', '[\"*\"]', NULL, NULL, '2023-11-13 19:37:44', '2023-11-13 19:37:44');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES (3, 'App\\Models\\User', 5, 'mobillium', '26da65669c923215cb60440196d7410e62f65e435faa16cb8c16f089713984a0', '[\"*\"]', '2023-11-13 22:32:16', NULL, '2023-11-13 21:55:08', '2023-11-13 22:32:16');
COMMIT;

-- ----------------------------
-- Table structure for ratings
-- ----------------------------
DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `article_id` bigint unsigned NOT NULL,
  `value` tinyint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ratings_user_id_article_id_unique` (`user_id`,`article_id`),
  KEY `ratings_article_id_foreign` (`article_id`),
  CONSTRAINT `ratings_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of ratings
-- ----------------------------
BEGIN;
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (4, 6, 13, 3, '2023-11-11 22:53:20', '2023-11-11 22:53:23');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (5, 6, 14, 5, '2023-11-12 11:17:11', '2023-11-12 11:17:11');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (6, 6, 15, 5, '2023-11-13 23:44:57', '2023-11-13 23:44:57');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (7, 6, 17, 4, '2023-11-13 23:45:03', '2023-11-13 23:45:24');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (8, 6, 19, 3, '2023-11-13 23:45:13', '2023-11-13 23:45:13');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (9, 5, 14, 2, '2023-11-13 23:46:40', '2023-11-13 23:46:40');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (10, 5, 15, 4, '2023-11-13 23:46:48', '2023-11-13 23:46:48');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (11, 5, 17, 2, '2023-11-13 23:46:54', '2023-11-13 23:46:54');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (12, 5, 19, 1, '2023-11-13 23:46:59', '2023-11-13 23:46:59');
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (13, 7, 13, 4, NULL, NULL);
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (14, 7, 14, 3, NULL, NULL);
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (15, 7, 15, 5, NULL, NULL);
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (16, 7, 17, 1, NULL, NULL);
INSERT INTO `ratings` (`id`, `user_id`, `article_id`, `value`, `created_at`, `updated_at`) VALUES (17, 7, 19, 4, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES (1, 'admin', 'web', NULL, NULL);
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES (2, 'moderator', 'web', NULL, NULL);
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES (3, 'writer', 'web', NULL, NULL);
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES (4, 'reader', 'web', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (5, 'admin', 'admin@mobillium.com', NULL, '$2y$12$BQr55eLjCIhLgqQ0X2BxpOX3747i8hPXONFbqBU.6hapRMbh2cBVq', NULL, '2023-11-08 16:32:02', '2023-11-08 16:32:02');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (6, 'writer1', 'writer1@mobillium.com', NULL, '$2y$12$4cj/ne8sy8SAP1DhB5hlt.3KjrTpPQZDU3NySoMit19/UH26RhQIW', NULL, '2023-11-08 16:32:03', '2023-11-08 16:32:03');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (7, 'moderator1', 'moderator1@mobillium.com', NULL, '$2y$12$CwKPdNTGyqJHe1nIuEV4NuVaUqHqy1EfgFBdooTss.5XM2Y33obWi', NULL, '2023-11-08 16:32:03', '2023-11-08 16:32:03');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
