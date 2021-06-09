-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 10 2021 г., 02:36
-- Версия сервера: 5.7.29
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kurs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1614176399),
('m140209_132017_init', 1614176404),
('m140403_174025_create_account_table', 1614176405),
('m140504_113157_update_tables', 1614176409),
('m140504_130429_create_token_table', 1614176410),
('m140506_102106_rbac_init', 1614177699),
('m140830_171933_fix_ip_field', 1614176411),
('m140830_172703_change_account_table_name', 1614176411),
('m141222_110026_update_ip_field', 1614176412),
('m141222_135246_alter_username_length', 1614176412),
('m150614_103145_update_social_account_table', 1614176415),
('m150623_212711_fix_username_notnull', 1614176415),
('m151218_234654_add_timezone_to_profile', 1614176415),
('m160929_103127_add_last_login_at_to_user_table', 1614176416),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1614177699),
('m180523_151638_rbac_updates_indexes_without_prefix', 1614177699),
('m200409_110543_rbac_update_mssql_trigger', 1614177699);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(2, 'gGQuGT_7sdD_fGYYbw0H-TC3J34rFVr1', 1614182388, 0),
(3, '3unIRWp00oWVzN25idAyCJfKKPZ28foG', 1614244672, 0),
(4, '9xM5m7JzCRhATt3RdG8fncXkCgybOLpx', 1614245503, 0),
(5, '7kzY7B0_GV1BP2lB2or_BNPUuHxurSTG', 1614254135, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fio` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Скобелев ДА',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `fio`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(1, 'admin', 'Скобелев ДА', 'dimaskobelev2010@mail.ru', '$2y$10$8v9YzEj/KdWw2tEdg9F4wO306bOYouIUtTlquvWoOrYt5RIa1Cw9q', 'LpWXnCHTeXV0Myof5GIZR1PUbPDBvZcL', 1614177472, NULL, NULL, '127.0.0.1', NULL, NULL, 0, 1623251144),
(2, 'user1', 'Второй ДА', 'dimaskobelev20210@mail.ru', '$2y$10$S3YN2ApwYDrgxTFwo3mQUu7f3dAWEb2nOI4FnoRb0qhp6AwRsprWa', 'OJyTTpGMjihQJG3ZeUs0W2vlrU5LY28u', NULL, NULL, NULL, '127.0.0.1', NULL, NULL, 0, 1614182481),
(3, 'teacher1', 'Кеко ДА', 'dimaskobele1v2010@mail.ru', '$2y$10$5zSdxl2U.9dUuB54SJxO3.Y5dPKKizZR4eAs3WUVeZNKpv1hm5VUu', 'O3mKC-jHCAtPPXCuaEvGFHrJ16jGEwQF', NULL, NULL, NULL, '127.0.0.1', NULL, NULL, 1, 1614275637),
(4, 'student1', 'Юничев ДА', 'sdimaskobelev2010@mail.ru', '$2y$10$IYp90ViTP0EGF.ORrpiR8O4UhR/doiNr0reXFEyf.X3Qv4YXeNBN2', 'ieSxEZszz0Kgg-Jd5v7Wp5s_5b58tW7E', NULL, NULL, NULL, '127.0.0.1', NULL, NULL, 2, 1614245822),
(5, 'student2', 'Кекович ДА', 'dimassdkobelev2010@mail.ru', '$2y$10$Hkg5EsoKpIgyUh7OCSyqw.KdB27ayKJbyoftggi2.9c/kZ6Opofsu', 'GhJxLgXp0m8hs-SG48hsaG3NFOnfpxiz', NULL, NULL, NULL, '127.0.0.1', NULL, NULL, 2, NULL),
(6, 'teacher5', 'Скокек Ав', 'd@ds.e', 'teacher5', 'sdsd', NULL, '', NULL, '', '2021-02-25 22:26:40.000000', '2021-02-25 22:26:40.000000', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `work`
--

INSERT INTO `work` (`id`, `id_teacher`, `title`) VALUES
(1, 1, 'Практическая 1'),
(2, 1, 'Контрольная 1'),
(3, 3, 'Wok1 t1'),
(4, 3, 'wok2 t1'),
(5, 3, 'work3 t1'),
(6, 3, 'Kekkeksdds'),
(7, 1, 'Практическая 3');

-- --------------------------------------------------------

--
-- Структура таблицы `work_users`
--

CREATE TABLE `work_users` (
  `id` int(11) NOT NULL,
  `id_work` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `work_users`
--

INSERT INTO `work_users` (`id`, `id_work`, `id_user`, `status`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Пересдано', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-09 13:17:33.000000', '2021-02-24 13:18:31.000000'),
(2, 2, 2, 'Пересдано', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-09 13:17:41.000000', '2021-02-23 13:18:35.000000'),
(3, 3, 2, 'Пересдано', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-08 13:17:44.000000', '2021-02-23 13:18:39.000000'),
(4, 4, 2, 'Пересдано', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-08 10:21:37.000000', '2021-02-25 14:17:08.000000'),
(5, 5, 2, 'Проверенно', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-05-31 11:17:37.000000', '2021-02-25 11:57:00.000000'),
(6, 1, 5, 'Проверенно', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-07 11:57:16.000000', '2021-02-25 11:57:16.000000'),
(7, 1, 4, 'В процессе', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-05-03 11:57:16.000000', '2021-02-25 11:57:16.000000'),
(8, 2, 4, 'В процессе', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-02 11:57:25.000000', '2021-02-25 11:57:25.000000'),
(9, 2, 5, 'Пересдано', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-09 15:40:05.000000', '2021-02-25 15:40:05.000000'),
(10, 7, 6, 'В процессе', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-09 19:53:46.000000', '2021-06-09 19:53:46.000000'),
(11, 1, 5, 'В процессе', 'Задание1.docx', '2021-06-09 22:42:49.000000', '2021-06-09 22:42:49.000000'),
(12, 2, 5, 'В процессе', 'uploads/c8be998d3e8c39621b1dafa4e7b37355.docx', '2021-06-09 22:43:47.000000', '2021-06-09 22:43:47.000000'),
(13, 1, 6, 'В процессе', 'uploads/01083d296dbc73ab373c79b04de38951.docx', '2021-06-09 22:54:13.000000', '2021-06-09 22:54:13.000000');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Индексы таблицы `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- Индексы таблицы `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_teacher` (`id_teacher`);

--
-- Индексы таблицы `work_users`
--
ALTER TABLE `work_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_work` (`id_work`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `work`
--
ALTER TABLE `work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `work_users`
--
ALTER TABLE `work_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `work_users`
--
ALTER TABLE `work_users`
  ADD CONSTRAINT `work_users_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `work_users_ibfk_2` FOREIGN KEY (`id_work`) REFERENCES `work` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
