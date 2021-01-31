-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 05:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mob_rysiai_avilys`
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
(18, '2014_10_12_000000_create_users_table', 1),
(19, '2014_10_12_100000_create_password_resets_table', 1),
(20, '2019_08_19_000000_create_failed_jobs_table', 1),
(21, '2020_11_08_200802_plan', 1),
(22, '2020_11_16_162650_create_order_table', 2),
(26, '2020_11_24_152241_create_gynimas_table', 4),
(27, '2020_11_19_151908_update_order', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_approved` tinyint(4) NOT NULL,
  `is_current_plan` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ends_at` date NOT NULL,
  `total_cost` double NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `is_approved`, `is_current_plan`, `created_at`, `updated_at`, `ends_at`, `total_cost`, `plan_id`, `user_id`) VALUES
(10, 1, 0, '2020-11-29 14:18:21', '2020-12-01 17:43:19', '2022-11-30', 239.76, 7, 2),
(11, 2, 0, '2020-12-01 17:41:53', '2020-12-03 18:19:22', '2023-12-01', 467.64, 8, 2),
(12, 1, 1, '2020-12-03 18:18:45', '2020-12-03 18:45:31', '2022-12-03', 167.76, 9, 5),
(13, 0, 0, '2020-12-03 19:41:30', '2020-12-04 09:42:41', '2022-12-04', 143.76, 7, 2),
(14, 1, 1, '2020-12-14 19:57:03', '2020-12-14 19:58:56', '2022-12-14', 143.76, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('g@gmail.com', '$2y$10$lZBlK.9cvvYxjadQohG.COQBXPuXGCUjZwZih9uUjN2yC6e3g/UbS', '2020-11-29 17:09:40'),
('gintaras.armonaitis@gmail.com', '$2y$10$ch0enhCittAOv8ri6nBDmeTizw8/6xdDXkgEjroZkW6JlCqEMt9RG', '2020-11-29 17:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `permits`
--

CREATE TABLE `permits` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permits`
--

INSERT INTO `permits` (`id`, `name`) VALUES
(1, 'Peržiūrėti planus'),
(2, 'Registruotis'),
(3, 'Peržiūrėti užsakytą planą'),
(4, 'Peržiūrėti vartotojų dabartinius mobilaus ryšio planus'),
(5, 'Peržiūrėti vartotojų istoriją'),
(6, 'Ištrinti registruotą vartotoją'),
(7, 'Kurti mobilaus ryšio planą'),
(8, 'Redaguoti mobilaus ryšio planą'),
(9, 'Patvirtinti užsakyto plano suteikimą vartotojui'),
(10, 'Užsisakyti planą');

-- --------------------------------------------------------

--
-- Table structure for table `permit_role`
--

CREATE TABLE `permit_role` (
  `permit_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permit_role`
--

INSERT INTO `permit_role` (`permit_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 3),
(5, 3),
(6, 4),
(7, 4),
(8, 4),
(9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `internet_data_mb` int(11) DEFAULT NULL,
  `cost_month` double DEFAULT NULL,
  `lower_cost_month` double DEFAULT NULL,
  `evaluation_time` int(9) DEFAULT NULL,
  `sold_quantity` int(8) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `description`, `internet_data_mb`, `cost_month`, `lower_cost_month`, `evaluation_time`, `sold_quantity`, `created_at`, `updated_at`) VALUES
(7, 'Lengviau 1', '1 GB interneto duomenų bei neriboti skambučiai', 1000, 5.99, 3.99, 24, 5, '2020-12-14 21:57:05', '2020-12-14 19:57:05'),
(8, 'Lengviau 5', '5 GB interneto duomenų ir neriboti skambučiai', 5000, 12.99, NULL, 36, 2, '2020-12-01 19:42:40', '2020-12-01 17:42:40'),
(9, 'Lengviau 2', '2 GB interneto duomenų bei neriboti skambučiai', 2000, 6.99, NULL, 24, 1, '2020-12-03 20:18:51', '2020-12-03 18:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'svecias'),
(2, 'registruotas vartotojas'),
(3, 'vadybininkas'),
(4, 'administratorius');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_nr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fk_order` int(8) DEFAULT NULL,
  `fk_role` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `email_verified_at`, `phone_nr`, `password`, `remember_token`, `created_at`, `updated_at`, `fk_order`, `fk_role`) VALUES
(2, 'Mantas', 'As', 'm@gmail.com', NULL, '864557216', '$2y$10$/TYbeRIItiEhPjkzWEeAPeK1CRkBUMEIsuSdPiSl379jEnlRxgUk6', '2CmRkIWHrbDbF4Z1CM8oiNirv8Do8MyOKyK5OVIVR2rxKXeUNhenxMd8e1ot', '2020-11-13 17:08:21', '2020-11-13 17:08:21', NULL, 1),
(3, 'Gintaras', 'Tik', 'g@gmail.com', NULL, '+37064212354', '$2y$10$eXaS5o1hMvjUgjpAyPmWGOARRTcb6wB0Wf5nMqKmkx8E31eZQKSE.', '8zJ1O3keQcWVc4zY25KQaqhcdyFeMZO0FqvtfPq0ViqM0SoEWH3qvZmVT2HO', '2020-11-13 18:15:09', '2020-11-13 18:15:09', NULL, 3),
(4, 'Darius', 'Masko', 'a@gmail.com', NULL, '865425721', 'asd12345', NULL, '2020-11-28 18:37:46', NULL, NULL, 1),
(5, 'Gintaras', 'Armo', 'gintaras.armonaitis@gmail.com', NULL, '+37064339702', '$2y$10$lNxqAeAhJZm1X5ia1yjBBOh5D1hpFG2sFtS9Yh/P0NTW/2AmxkIBS', NULL, '2020-11-29 17:30:27', '2020-11-29 17:30:27', NULL, 2),
(6, 'Lukas', 'Lukaitis', 'lukas@gmail.com', NULL, '864557320', '$2y$10$6Uq6/cTyCBf7f6cF6lYwoeS7G6dTRSNljSkmjtcu6Ab7ODYpjXJ2u', NULL, '2020-12-03 18:13:39', '2020-12-03 18:13:39', NULL, 3),
(7, 'tomas', 'tomaitis', 't@gmail.com', NULL, '864554212', '$2y$10$EeeBdN2KUVRVEtx3nSB1fuz7ikWc27Fjg/V/CVRihDCX/czhyFB3K', NULL, '2020-12-04 09:47:53', '2020-12-04 09:47:53', NULL, 1),
(8, 'petras', 'petraitis', 'p@gmail.com', NULL, '864554210', '$2y$10$qY5v4I.9JQqrFvcrzsu6huDSdaBUudDAqv2hrWUaCxPCT./wzIaU6', NULL, '2020-12-04 10:21:45', '2020-12-04 10:21:45', NULL, 1);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permits`
--
ALTER TABLE `permits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permit_role`
--
ALTER TABLE `permit_role`
  ADD PRIMARY KEY (`permit_id`,`role_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `fk_uzsakymas` (`fk_order`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permits`
--
ALTER TABLE `permits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
