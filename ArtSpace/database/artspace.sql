-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 24 2026 г., 23:34
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `artspace`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categorytitle` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `categorytitle`, `created_at`) VALUES
(38, '32131', '2026-06-06 16:12:33'),
(39, 'Лепка', '2026-06-21 20:18:50'),
(40, 'Программирование', '2026-06-24 00:53:22');

-- --------------------------------------------------------

--
-- Структура таблицы `dates`
--

CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `masterclass_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `dates`
--

INSERT INTO `dates` (`id`, `masterclass_id`, `date`) VALUES
(14, 15, '2026-06-06 04:24:00'),
(15, 15, '2026-07-02 06:24:00'),
(16, 16, '2026-06-24 22:20:00'),
(17, 16, '2026-06-25 19:20:00'),
(18, 16, '2026-06-26 01:40:00'),
(19, 17, '2026-07-01 15:00:00'),
(20, 17, '2026-07-02 12:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `masterclasses`
--

CREATE TABLE `masterclasses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `masterclasses`
--

INSERT INTO `masterclasses` (`id`, `title`, `description`, `category_id`, `created_at`) VALUES
(15, 'MClass13123', 'balblablabla', 38, '2026-06-22 23:24:26'),
(16, 'Мастер-класс 1', 'Описаниеописаниеописаниеописаниеописение2', 39, '2026-06-23 16:17:24'),
(17, 'Мастер-класс по программированию', 'Блаблаблабла', 40, '2026-06-24 00:54:08');

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `masterclass_id` int(11) NOT NULL,
  `visit_date` datetime NOT NULL,
  `payment` enum('cash','transfer') NOT NULL DEFAULT 'cash',
  `status` enum('sent','confirmed','completed') NOT NULL DEFAULT 'sent',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `masterclass_id`, `visit_date`, `payment`, `status`, `created_at`) VALUES
(1, 1, 16, '0000-00-00 00:00:00', 'cash', 'sent', '2026-06-24 02:11:16'),
(2, 1, 16, '0000-00-00 00:00:00', 'cash', 'sent', '2026-06-24 02:12:54'),
(3, 1, 15, '2026-07-02 06:24:00', 'transfer', 'confirmed', '2026-06-24 02:13:13'),
(4, 1, 15, '2026-07-02 06:24:00', 'transfer', 'sent', '2026-06-24 03:50:35'),
(5, 1, 17, '2026-07-02 12:00:00', 'cash', 'sent', '2026-06-24 03:54:26'),
(6, 1, 17, '2026-07-01 15:00:00', 'transfer', 'sent', '2026-06-24 04:01:20'),
(7, 1, 16, '2026-06-24 22:20:00', 'cash', 'sent', '2026-06-24 04:01:54'),
(8, 1, 16, '2026-06-24 22:20:00', 'transfer', 'sent', '2026-06-24 04:03:52'),
(9, 1, 16, '2026-06-24 22:20:00', 'transfer', 'confirmed', '2026-06-24 04:04:39'),
(10, 1, 16, '2026-06-24 22:20:00', 'transfer', 'completed', '2026-06-24 04:10:14'),
(11, 1, 15, '2026-07-02 06:24:00', 'transfer', 'completed', '2026-06-24 16:33:26'),
(12, 4, 16, '2026-06-24 22:20:00', 'transfer', 'sent', '2026-06-24 17:30:41'),
(13, 4, 15, '2026-06-06 04:24:00', 'transfer', 'sent', '2026-06-24 17:40:26'),
(14, 4, 15, '2026-06-06 04:24:00', 'cash', 'sent', '2026-06-24 17:41:30'),
(15, 4, 15, '2026-06-06 04:24:00', 'cash', 'sent', '2026-06-24 17:44:06'),
(16, 4, 15, '2026-07-02 06:24:00', 'cash', 'sent', '2026-06-24 18:53:37'),
(17, 1, 15, '2026-07-02 06:24:00', 'transfer', 'sent', '2026-06-24 23:36:09'),
(18, 1, 15, '2026-06-06 04:24:00', 'transfer', 'sent', '2026-06-24 23:37:40'),
(19, 1, 15, '2026-06-06 04:24:00', 'cash', 'confirmed', '2026-06-25 00:14:48'),
(20, 1, 15, '2026-06-06 04:24:00', 'cash', 'sent', '2026-06-25 00:28:41');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `fio`, `email`, `tel`, `role`) VALUES
(1, '111', '$2y$10$Ax6Fglot8j.BJ/O3tfqCr.iETRMYQ5O4EszLt7FxQLq.onu6zrmCq', '111', '111@gmail.com', '111', 'admin'),
(2, '1q2w3e4r', '$2y$10$1odCpkZxLf.KazyaEHV4u.ipBjP0getbR0zOd0RhJsWngw0xxNl2i', '1q2w3e4r', '1q2w3e4r@gmail.com', '1q2w3e4r', 'user'),
(3, '1q2w3e4r5t', '$2y$10$1.Bcez5OB4ZHQTq.KvCf0u2VRDhsdTth5StiOhVNi3L/ZUYf5JjhS', '3213123', '123123r3@gmail.com', '1231231313', 'user'),
(4, 'Ivanov', '$2y$10$is..RGitnD5Wlz6Vxuc23Opt6GyblZJZG8H0IecIZ6DA2JfJOcaiS', 'Иванов Иван Иванович', 'ivanov12@gmail.com', '+7(930)996-09-53', 'user'),
(5, 'ArtAdmin', '$2y$10$n7iTTbt6ktweQ3DKp5GpneT.PQLyMObCEaG8j/mG8cuwhD73LS6K2', '123123123', '123123123@gmail.com', '123123123123123', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masterclass_id` (`masterclass_id`);

--
-- Индексы таблицы `masterclasses`
--
ALTER TABLE `masterclasses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `masterclass_id` (`masterclass_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `masterclasses`
--
ALTER TABLE `masterclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dates`
--
ALTER TABLE `dates`
  ADD CONSTRAINT `dates_ibfk_1` FOREIGN KEY (`masterclass_id`) REFERENCES `masterclasses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `masterclasses`
--
ALTER TABLE `masterclasses`
  ADD CONSTRAINT `masterclasses_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`masterclass_id`) REFERENCES `masterclasses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
