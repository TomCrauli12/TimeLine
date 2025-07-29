-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июл 29 2025 г., 07:26
-- Версия сервера: 8.0.40
-- Версия PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `TimeLine`
--

-- --------------------------------------------------------

--
-- Структура таблицы `MainNews`
--

CREATE TABLE `MainNews` (
  `id` int NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `shortDescription` text COLLATE utf8mb4_general_ci NOT NULL,
  `glavImage` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageTwo` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageThree` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `News`
--

CREATE TABLE `News` (
  `id` int NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `shortDescription` text COLLATE utf8mb4_general_ci NOT NULL,
  `glavImage` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageTwo` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageThree` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `glavNews` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `News`
--

INSERT INTO `News` (`id`, `title`, `description`, `shortDescription`, `glavImage`, `imageTwo`, `imageThree`, `author`, `date`, `glavNews`) VALUES
(1, 'Главная новость 1', 'Главная новость 1 информация ', 'Главная новость 1 краткая информация ', '688875c793a803.15934748.jpg', '', '', '12', '2025-07-29 07:20', 'да'),
(2, 'Главная новость 2', 'Главная новость 2 информация ', 'Главная новость 2 краткая информация ', '688875e25b9357.26737789.jpg', '', '', '12', '2025-07-29 07:20', 'да'),
(3, 'Главная новость 3', 'Главная новость 3 информация ', 'Главная новость 3 краткая информация ', '68887607a44fe1.45187635.jpg', '', '', '12', '2025-07-29 07:20', 'да'),
(4, 'Главная новость 4', 'Главная новость 4 информация ', 'Главная новость 4 краткая информация', '68887625dccbe0.65914027.jpg', '', '', '12', '2025-07-29 07:20', 'да'),
(5, 'Главная новость 5', 'Главная новость 5 информация ', 'Главная новость 5 краткая информация ', '68887641093882.93198951.jpg', '', '', '12', '2025-07-29 07:20', 'да'),
(6, 'Новость 1', 'Новость 1 информация ', 'Новость 1 краткая информация ', '688876656cf885.56484580.jpg', '', '', '12', '2025-07-29 07:21', 'нет'),
(7, 'Новость 2', 'Новость 2', 'Новость 2 краткая информация о ней ', '6888768bc446d3.05630528.jpg', '', '', '12', '2025-07-29 07:21', 'нет'),
(9, 'Новость 4', 'Новость 4 информация о ней ', 'Новость 4 краткая информация о ней ', '688876b75195a3.71731956.jpg', '', '', '12', '2025-07-29 07:22', 'нет'),
(10, 'Новость 6', 'Новость 6 информация о ней ', 'Новость 6 краткая информация о ней ', '688876e1c46913.10648639.jpg', '', '', '12', '2025-07-29 07:23', 'нет'),
(11, 'Новость 5', 'Новость 5 информация о ней ', 'Новость 5 краткая информация о ней ', '688876fb59b8c0.09758002.jpg', '', '', '12', '2025-07-29 07:23', 'нет'),
(12, 'Новость 7 ', 'Новость 7 информация', 'Новость 7 краткая информация о ней ', '6888771a96bea9.88300947.jpg', '', '', '12', '2025-07-29 07:24', 'нет');

-- --------------------------------------------------------

--
-- Структура таблицы `PrePosts`
--

CREATE TABLE `PrePosts` (
  `id` int NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `shortDescription` text COLLATE utf8mb4_general_ci NOT NULL,
  `glavImage` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imageTwo` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageThree` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `glavNews` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `password`, `role`) VALUES
(12, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(13, 'user', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user'),
(14, '21', '21', '3c59dc048e8850243be8079a5c74d079', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `MainNews`
--
ALTER TABLE `MainNews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `PrePosts`
--
ALTER TABLE `PrePosts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `MainNews`
--
ALTER TABLE `MainNews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `News`
--
ALTER TABLE `News`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `PrePosts`
--
ALTER TABLE `PrePosts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
