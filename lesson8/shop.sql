-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Ноя 09 2020 г., 19:20
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id_cartRecord` int(11) NOT NULL,
  `session_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id_cartRecord`, `session_id`, `product_id`, `quantity`) VALUES
(11, '', '5', 1),
(39, '8p0blb74jb8u943it9t71cpbts03ute6', '8', 6),
(42, 'frl5tfqlfoqlgpude96q6toe958b5m6o', '6', 1),
(44, 'frl5tfqlfoqlgpude96q6toe958b5m6o', '7', 1),
(45, '8p0blb74jb8u943it9t71cpbts03ute6', '6', 1),
(46, 'frl5tfqlfoqlgpude96q6toe958b5m6o', '8', 1),
(47, 'g171snlj8ed4fct083hoh50eugjugr87', '8', 2),
(48, 'g171snlj8ed4fct083hoh50eugjugr87', '2', 1),
(49, 'g171snlj8ed4fct083hoh50eugjugr87', '6', 1),
(50, 'fefl822cj7nvifmas65evvsr0k60sun6', '6', 1),
(51, 'fefl822cj7nvifmas65evvsr0k60sun6', '1', 1),
(52, 'fqt446v1h9dv66gpkscbjulqfbhlrkt8', '5', 1),
(53, 'fqt446v1h9dv66gpkscbjulqfbhlrkt8', '1', 1),
(54, 'fqt446v1h9dv66gpkscbjulqfbhlrkt8', '3', 1),
(55, 'ig7ulgc7t0l41i37p672qrqubkavqnrq', '6', 1),
(56, 'ig7ulgc7t0l41i37p672qrqubkavqnrq', '1', 1),
(57, 'bque7rstmp5gpskh3jb8khsnvnqau9s3', '5', 1),
(58, '3p79arekuein587hgc7tt6qqdaltlipq', '5', 1),
(59, 'qh3m1791kduecavs68d2cg9qphum9dau', '6', 1),
(60, 'qh3m1791kduecavs68d2cg9qphum9dau', '2', 1),
(61, 'lmca6vs644ehsrl1kaloojehmdcd9gai', '6', 1),
(62, 'lmca6vs644ehsrl1kaloojehmdcd9gai', '2', 1),
(63, 'v3am9dorcqbps88uv3edfb1efib6pndt', '8', 1),
(64, '9mv4tuh9avioaln9iujl5jfs25ifn21t', '8', 1),
(65, '9mv4tuh9avioaln9iujl5jfs25ifn21t', '6', 1),
(66, 'gmmk7rpr7b6ap1qvucrhcs30feev0p8m', '8', 1),
(67, '8rn71p8p1t59nqdu07hague2f8fnb2eu', '8', 1),
(68, 'ee14idseb1qgns3c38j490udrafqn788', '8', 1),
(69, '4nmqq305cg4om4rt5ganonqd56kpv0a4', '8', 1),
(70, 'm8pid34vvg5c6gg4et9f8l6uu7115h9d', '8', 1),
(71, 'tjsk2ti4e0t3pjfs3fpnqplnhc3o05re', '8', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_time` datetime NOT NULL,
  `id_images` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `name`, `feedback_text`, `data_time`, `id_images`) VALUES
(1, 'admin', 'Всё в порядке', '2020-11-03 13:37:37', 1),
(2, 'user1', 'Хороший товар!', '2020-11-04 18:47:43', 2),
(36, 'efe', 'ewww', '2020-11-04 18:52:47', 2),
(40, '123', '1234', '2020-11-04 19:11:56', 2),
(41, 'Валентин2', 'Тачка-пуля-шпуля!', '2020-11-04 19:13:46', 8),
(43, 'Олигарх Виталий', 'Вожу на ней доски для огорода', '2020-11-04 20:35:09', 3),
(45, 'Игорь', 'Досталась от деда', '2020-11-04 20:35:58', 6),
(46, 'гоги', 'норм', '2020-11-06 16:40:49', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`) VALUES
(3, '«Прибываю в легкий дивизион». Макгрегор обратился к болельщикам', 'Бывший двойной чемпион UFC Конор Макгрегор заявил, что возвращается к выступлениям в легком дивизионе. \r\n\r\n— Только что вернулся из лаборатории Макгрегора. Полное сканирование тела завершено, и результат уже получен — прибываю в легкий дивизион, — написал Макгрегор в Twitter. '),
(4, '«Было бы интересно встретиться, потому что он легендарный боец». Волков готов к поединку с Джонсом', 'Российский тяжеловес UFC Александр Волков заявил, что готов провести встречу с бывшим чемпионом организации в полутяжелом дивизионе Джоном Джонсом.\r\n\r\n— Надо посмотреть хотя бы его первый бой в новом весе, потому что мы видели выступление Густафссона. Так себе вышло, хотя может он себя и проявит. Вердум его прикольно поймал. Джонс — талантливый спортсмен, одаренный физически. Посмотрим, как он будет справляться с прессингом тяжеловесов, которые достаточно большие и могут придавить тебя в партере или сильно ударить. Гипотетический бой для него — Нганну, но он его довольно ярко избегает. Мне было бы с ним интересно встретиться, потому что боец легендарный и достаточно опытный. Попытаться встать с ним на один уровень и взять весь опыт, который он накопил в полутяжелом весе, было бы круто. Однако вряд ли мне сейчас его дадут, но когда доберусь, то будет круто, — рассказал Волков в беседе с YouTube-каналом «Вестник ММА». \r\nНапомним, что в 2020 году Джонс объявил, что намерен перейти в тяжелый дивизион. Он оставил пояс полутяжелого веса и начал подготовку к выступлениям в новой категории.\r\n\r\nНа счету 33-летнего Боунса 26 побед, 1 поражение, и еще 1 бой признан несостоявшимся. \r\n\r\n32-летний Волков располагается на 6-й строчке среди лучших тяжеловесов UFC. Его профессиональный рекорд составляет 32 победы и 8 поражений. '),
(5, '234', '333');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `nameOfCustomer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumberOfCustomer` int(11) NOT NULL,
  `session_id` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `nameOfCustomer`, `phoneNumberOfCustomer`, `session_id`) VALUES
(2, '234', 333, 'g171snlj8ed4fct083hoh50eugjugr87'),
(7, 'KingOfNught', 321, 'fefl822cj7nvifmas65evvsr0k60sun6'),
(11, 'ука', 1231231231, 'm8pid34vvg5c6gg4et9f8l6uu7115h9d');

-- --------------------------------------------------------

--
-- Структура таблицы `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `size` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `nameOfProduct` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptionOfProduct` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `costOfProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pictures`
--

INSERT INTO `pictures` (`id`, `name`, `size`, `views`, `nameOfProduct`, `descriptionOfProduct`, `costOfProduct`) VALUES
(1, '1.jpeg', 169831, 33, 'Rolls-royce_black', 'Максимальная скорость – 250 км/ч\r\nРазгон: от 0 до 100 км/ч за 5,3 с\r\n', 27500),
(2, '2.jpg', 210881, 44, 'Rolls-royce_green', 'Максимальная скорость	250 км/ч (ограничена)\r\nРазгон 0-100 км/ч	4,9 с', 28000),
(3, '3.jpg', 457052, 29, 'Rolls-royce_white', 'Максимальная скорость	250 км/ч (ограничена)\r\nРазгон 0-100 км/ч	4,9 с', 28600),
(4, '4.jpg', 176825, 24, 'Rolls-royce_blue', 'развивает 624 л. с.;\r\nрассчитан на 6,6 литра;\r\nпозволяет разгоняться до 100 км/ч за 4,6 секунды.', 29000),
(5, 'joey-d-VfZXHH_Tkwg-unsplash.jpg', 1866353, 35, 'Ford_Mustang_black', 'Максимальная скорость, км/ч250Разгон до 100 км/ч, с5.8Расход топлива, л смешанный9.8', 4000),
(6, 'jorgen-hendriksen-HsB4t2NvtLo-unsplash.jpg', 2978986, 55, 'Ford_Mustang_white', 'Тип двигателябензинРасположение двигателяпереднее, продольноеОбъем двигателя, см³2782Тип наддуванет', 5000),
(7, 'jonathan-gallegos-Up4VB9_T9BA-unsplash.jpg', 2969845, 40, 'Ford_Mustang_blue', 'Максимальная скорость, км/ч250Разгон до 100 км/ч, с4.8Расход топлива, л смешанный13.5', 3800),
(8, '19qM.gif', 1030028, 228, 'Ferrari_red', '490 л.с.\r\n4.3 л.', 13000);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `pass`, `hash`) VALUES
(1, 'admin', '$2y$10$xQErKtsnXfGQdzJ7gY1W5eI1HJWr.8pb32pxFQ1sTZPocNhdHN4uy', '15960516205fa67467aa0b90.46867073'),
(2, 'user1', '$2y$10$xQErKtsnXfGQdzJ7gY1W5eI1HJWr.8pb32pxFQ1sTZPocNhdHN4uy', '13173899385fa8d34d918ec2.20520291');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cartRecord`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Индексы таблицы `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cartRecord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
