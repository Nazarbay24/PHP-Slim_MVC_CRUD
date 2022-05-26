-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 26 2022 г., 17:21
-- Версия сервера: 5.7.33
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crud`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(20000) NOT NULL,
  `author` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `img`, `date`) VALUES
(14, 'Quo doloribus blanditiis vitae consequatur quam', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo doloribus blanditiis vitae consequatur quam maxime placeat nobis odio quis, facilis rerum! Expedita rerum repudiandae impedit, veritatis optio earum accusamus commodi! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut corrupti nesciunt veritatis, quia magnam, magni obcaecati aliquid dolorum repudiandae sed quasi iusto provident nihil ut perspiciatis enim consectetur illo id.Lorem ipsum dolor sit amet consectetur adipisicing elit. Et culpa nulla ullam vel harum saepe doloremque, nam aliquid, illum, enim quia officia debitis sed maiores magni ab natus quis ducimus.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, reiciendis? Blanditiis odit vel fugit commodi facere autem sapiente inventore veritatis molestias, quas praesentium odio id ipsa! Minus autem maiores soluta!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quo doloribus blanditiis vitae consequatur quam maxime placeat nobis odio quis, facilis rerum! Expedita rerum repudiandae impedit, veritatis optio earum accusamus commodi! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut corrupti nesciunt veritatis, quia magnam, magni obcaecati aliquid dolorum repudiandae sed quasi iusto provident nihil ut perspiciatis enim consectetur illo id.Lorem ipsum dolor sit amet consectetur adipisicing elit. Et culpa nulla ullam vel harum saepe doloremque, nam aliquid, illum, enim quia officia debitis sed maiores magni ab natus quis ducimus.Lorem ipsum dolor, sit amet consectetur adipisicing elit. Suscipit, reiciendis? Blanditiis odit vel fugit commodi facere autem sapiente inventore veritatis molestias, quas praesentium odio id ipsa! Minus autem maiores soluta!', 'asd', 'app/uploaded_post_images/6423flying-house-up-wallpaper-movie.jpg', '2022-01-28 13:58:50');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(17, 'Nurbek-24', 'asddssd@asd.com', '$2y$10$FSArjU7gVx6WLzKnjkUMeuXzeVDXyB2e5jAo3YY3I8lrlAWu786lO');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
