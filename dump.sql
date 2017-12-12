-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.41-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных editor
CREATE DATABASE IF NOT EXISTS `editor` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `editor`;


-- Дамп структуры для таблица editor.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `additional_content` text,
  `date_create` datetime NOT NULL,
  `date_edit` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы editor.pages: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `title`, `header`, `content`, `additional_content`, `date_create`, `date_edit`) VALUES
	(2, 'Страница 2', 'Заголовок 2', 'Содержание', 'Еще содержание', '2017-12-12 10:13:19', '2017-12-12 11:53:50'),
	(3, 'Страница 3', 'Заголовок 3', 'Содержание', 'Еще содержание', '2017-12-12 10:15:19', '2017-12-12 11:54:03'),
	(4, 'New', 'title new', 'blah', 'hah', '2017-12-12 12:05:56', NULL),
	(5, 'Контроллер управления DMX operator 192 channels', 'Заголовок 33', '123', '432', '2017-12-12 12:07:54', NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;


-- Дамп структуры для таблица editor.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `sid` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы editor.users: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `pass`, `sid`) VALUES
	(1, 'admin@mail.ru', '202cb962ac59075b964b07152d234b70', 'g4jig6asmqpjqnsvmd0lmfu496');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
