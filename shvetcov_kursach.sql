-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 16 2024 г., 10:53
-- Версия сервера: 10.11.10-MariaDB-ubu2204
-- Версия PHP: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shvetcov_kursach`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `name`) VALUES
(1, 'IT'),
(2, 'Кулинария'),
(3, 'Культура');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id_course` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id_course`, `name`, `photo`, `category`, `description`, `price`) VALUES
(3, 'Курс по Python', '/course_photo/1.png', 1, 'Мега мощный курс по Питону до сеньора за три дня с зп 500 тыс.', 100000),
(6, 'Ораторское искусство', '3c482346f375027677fa8a0d6830a32714d4f13f9e94c2d9e215e0ac205ad4e5.png', 1, 'Ори на здоровье', 100),
(7, 'Архитектура', '41f3e15ff8a4e4117da46465954304497ef29bdf35afaa9e36d527864d24c266.jpg', 3, 'Лучший курс по обучению архитектуре', 12345),
(8, 'Архитектура 1', '3c482346f375027677fa8a0d6830a32714d4f13f9e94c2d9e215e0ac205ad4e5.jpg', 3, 'Лучший курс по обучению архитектуре', 12345);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User',
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `full_name`, `username`, `avatar`, `email`, `phone`, `password`, `role`, `token`) VALUES
(3, 'Швецов Илья', 'Ilya', '', 'test@test.ru', '000', '$2y$13$uo9kcn3h.WuEGeF.ZgzAM.Tl45yunZi86Z.CLnMDCzHCR5jbpOUZO', 'Admin', 'dJ-I74pxXtjFFyjQ8DTB-xo7CuPKqXmh'),
(4, 'Швецов Илья', 'Artos', '', 'test@test.ru', '000', '$2y$13$6uuo4O.2D7CPFwvGWnFGE.ue.BGZWcf5SuC0WllxswIYRmqWeuAGK', 'User', 'RFpPkmilcYzwXvy4PFPtiAnOik0rIp-h'),
(5, 'Людмила Костерина', 'Lu', '', 'test@test.ru', '000', '$2y$13$hwVxitKk7It6bOmwM73DiOSbNOm6BugOSsGk4R3hwS8JCOyiRNrCa', 'User', 'Dibsce8IFngbU0N_zcSoa1axTRw5_f2N'),
(6, 'Катька Михайлович', 'Kit', 'ava.png', 'kate@mail.com', '111', '$2y$13$ZmkU2hbZWMwmtJRR2c28zuL6AICBml/gjY7LrFM4Nd/bdRDrO5zBO', 'User', '5otXAPe8i-sP0J2icvyX9ChO_4HeI0Hq');

-- --------------------------------------------------------

--
-- Структура таблицы `visitedCourses`
--

CREATE TABLE `visitedCourses` (
  `id_link` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `visitedCourses`
--

INSERT INTO `visitedCourses` (`id_link`, `user_id`, `course_id`) VALUES
(2, 3, 8);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Индексы таблицы `visitedCourses`
--
ALTER TABLE `visitedCourses`
  ADD PRIMARY KEY (`id_link`),
  ADD UNIQUE KEY `user_id` (`user_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `visitedCourses`
--
ALTER TABLE `visitedCourses`
  MODIFY `id_link` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id_category`);

--
-- Ограничения внешнего ключа таблицы `visitedCourses`
--
ALTER TABLE `visitedCourses`
  ADD CONSTRAINT `visitedCourses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `visitedCourses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id_course`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
