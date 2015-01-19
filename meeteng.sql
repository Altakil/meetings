-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 19 2015 г., 12:20
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `meeteng`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adminprofile`
--

CREATE TABLE IF NOT EXISTS `adminprofile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `adminprofile`
--

INSERT INTO `adminprofile` (`id`, `admin`, `password`) VALUES
(1, 'Admin', '12345');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Ukraine'),
(2, 'USA'),
(3, 'Russia'),
(4, 'Canada'),
(5, 'Germany');

-- --------------------------------------------------------

--
-- Структура таблицы `town`
--

CREATE TABLE IF NOT EXISTS `town` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4CE6C7A4F92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `town`
--

INSERT INTO `town` (`id`, `country_id`, `name`) VALUES
(1, 1, 'Kiev'),
(2, 1, 'Charkov'),
(3, 2, 'NewYork'),
(4, 2, 'California'),
(5, 1, 'Poltava'),
(6, 1, 'Sumy'),
(7, 5, 'Berlin'),
(8, 3, 'Moscov'),
(9, 4, 'Ottava');

-- --------------------------------------------------------

--
-- Структура таблицы `userman`
--

CREATE TABLE IF NOT EXISTS `userman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BirthDate` date NOT NULL,
  `MaritalStatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BodyType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `userman`
--

INSERT INTO `userman` (`id`, `gender`, `email`, `password`, `FirstName`, `LastName`, `country`, `city`, `BirthDate`, `MaritalStatus`, `BodyType`, `image`) VALUES
(1, 'man', 'email@yandex.ru', '11', 'Man', 'Linux', 'Ukraine', 'Kiev', '2010-01-01', 'married', '22', '70_Best_Wallpapers_by_Korogan (16).jpg'),
(2, 'man', 'emi@yandex.ru', '11', 'man', 'man', 'USA', 'California', '2010-01-01', 'married', '22', '70_Best_Wallpapers_by_Korogan (5).jpg'),
(3, 'man', 'rikki@email.ru', '11', 'rikki', 'man', 'Ukraine', 'Kiev', '2010-01-01', 'married', '22', '70_Best_Wallpapers_by_Korogan (20).jpg'),
(4, 'man', 'big@rambler.ru', '11', 'man', 'man', 'Germany', 'Berlin', '2010-01-01', 'married', '22', '70_Best_Wallpapers_by_Korogan (10).jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `userwomen`
--

CREATE TABLE IF NOT EXISTS `userwomen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BirthDate` date NOT NULL,
  `MaritalStatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `breast` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `waist` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `Hips` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `userwomen`
--

INSERT INTO `userwomen` (`id`, `gender`, `email`, `password`, `FirstName`, `LastName`, `country`, `city`, `BirthDate`, `MaritalStatus`, `breast`, `waist`, `Hips`, `image`) VALUES
(1, 'woman', 'woomen@yandex.ru', '11', '11', '11', 'Ukraine', 'Kiev', '2010-01-01', 'married', '22', '22', '22', '15.jpg'),
(2, 'woman', 'woomen-email@yandex.ru', '11', 'Marusia', 'Marusia', 'Ukraine', 'Kiev', '2010-01-01', 'married', '22', '22', '22', '70_Best_Wallpapers_by_Korogan (6).jpg'),
(3, 'woman', 'woom@yandex.ru', '11', 'lola', 'lola', 'Ukraine', 'Poltava', '2010-01-01', 'married', '22', '22', '22', '70_Best_Wallpapers_by_Korogan (33).jpg'),
(4, 'woman', 'mail@yandex.ru', '11', 'name', 'name', 'Ukraine', 'Kiev', '2010-01-01', 'married', '22', '22', '22', '70_Best_Wallpapers_by_Korogan (26).jpg');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `FK_4CE6C7A4F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
