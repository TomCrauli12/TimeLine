-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июл 28 2025 г., 09:27
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
  `glavImage` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageTwo` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageThree` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `MainNews`
--

INSERT INTO `MainNews` (`id`, `title`, `description`, `glavImage`, `imageTwo`, `imageThree`, `author`, `date`) VALUES
(3, 'Индивидуамльное имя ', 'Индивидуамльное имя для каждого файла', 'glav_686d69a2095883.10374400.jpg', '', '', '1', '2025-07-08'),
(4, 'Главная новость', 'главная новость на удаление и перенос в новости', '6884030ced98d1.78264037.jpg', '', '', '2', '2025-07-25');

-- --------------------------------------------------------

--
-- Структура таблицы `News`
--

CREATE TABLE `News` (
  `id` int NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `glavImage` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageTwo` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageThree` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `News`
--

INSERT INTO `News` (`id`, `title`, `description`, `glavImage`, `imageTwo`, `imageThree`, `author`, `date`) VALUES
(1, 'проверка ', 'проверка 123', 'a1ykbhj.jpg', 'IMG_9026.HEIC', '', '1', '2025-07-08 11:55'),
(2, 'Новость вторая', 'Инофрмация о новости 2', 'a1ykbhj.jpg', '', '', '1', '2025-07-08 12:20'),
(3, 'Новость 3', 'Информация о новости 3 а так же проверка на отправку как клавной новости с последующим изменением на другую ', 'a1ykbhj.jpg', '', '', '1', '2025-07-08'),
(4, 'новость для главной старницы', 'проверка редактирования  ', 'a1ykbhj.jpg', '', '', '1', '2025-07-08'),
(6, 'новость с изображением ', 'новость хммм ну она есть ', '6884dffd69acd3.54892545.jpg', '', '', '2', '2025-07-26 14:02');

-- --------------------------------------------------------

--
-- Структура таблицы `PrePosts`
--

CREATE TABLE `PrePosts` (
  `id` int NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `glavImage` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imageTwo` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `imageThree` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `News`
--
ALTER TABLE `News`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `PrePosts`
--
ALTER TABLE `PrePosts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
