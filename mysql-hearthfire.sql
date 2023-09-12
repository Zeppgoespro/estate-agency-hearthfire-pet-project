-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: mysql-hearthfire
-- Время создания: Сен 12 2023 г., 18:32
-- Версия сервера: 8.0.34
-- Версия PHP: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hearthfire`
--
CREATE DATABASE IF NOT EXISTS `hearthfire` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hearthfire`;

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
('03Df2XXK4hBbDfQ83biY', 'vader', '9e07f1c61057a28d70299b6c695d5432adf80e38'),
('KYH6bvchXFtVKmGL2kJo', 'voder', '9e07f1c61057a28d70299b6c695d5432adf80e38');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `number`, `message`) VALUES
('3VZ1W2y26JE07cYEIr3N', 'Thomas', 'thomas@hf.com', '79000001111', 'I need to buy a new home.\r\nMy current home is infected with crazy brown mouse.'),
('5fxvCdBWXoAxyM1AI5WA', 'fred', 'fred@bookex.com', '5', 'Hello! Error here!'),
('kCZefGxZZDZmV0DVLw9l', 'hahaha', 'hahaha@hahaha.com', '5', 'Hello!'),
('238jX2HLNo50Ra4iWW2H', 'frank', 'frank@bookex.com', '8', 'Number!'),
('hZYx7Brdmu8T76JHnKGc', 'Dima', 'dima@bookex.com', '1234567890', 'Hello!');

-- --------------------------------------------------------

--
-- Структура таблицы `properties`
--

CREATE TABLE `properties` (
  `id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `property_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `offer` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `furnished` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `bhk` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `deposite` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `bedroom` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `bathroom` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `balcony` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `carpet` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `age` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `total_floors` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `room_floor` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `loan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lift` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `security_guard` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `play_ground` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `garden` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `water_supply` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `power_backup` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `parking_area` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `gym` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `shopping_mall` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `hospital` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `school` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `market_area` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `image_1` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image_2` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image_3` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image_4` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `image_5` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `property_name`, `address`, `price`, `type`, `offer`, `status`, `furnished`, `bhk`, `deposite`, `bedroom`, `bathroom`, `balcony`, `carpet`, `age`, `total_floors`, `room_floor`, `loan`, `lift`, `security_guard`, `play_ground`, `garden`, `water_supply`, `power_backup`, `parking_area`, `gym`, `shopping_mall`, `hospital`, `school`, `market_area`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `description`, `date`) VALUES
('e6yRuwur8N2qcnMVGlf2', 'dPOipGHYqdnMfMnrIwZQ', 'Tommy Vercetti Palace', 'Vice City', '120000000', 'house', 'sale', 'ready', 'furnished', '3', '60000000', '3', '3', '3', '43000', '40', '3', '9', 'available', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'no', 'no', 'no', 'nmfxpyDSLyp7r8uWldF1.jpg', '6hVoYEZrMXZyJ3yGL47z.jpg', 'hSZ9rc6dElcgtfzLB62t.jpg', 'vmyqhPchxde1Q9TK97LR.jpg', '', 'Gangsta palace.', '2023-02-04 17:53:22'),
('bS4nBZAHpZVWo3Mwdhi0', 'fN4dhyqeLy5Rfh1pv8lr', 'Bag End', 'Shire', '3600000', 'house', 'sale', 'ready', 'furnished', '3', '1000000', '3', '3', '0', '600', '99', '1', '18', 'available', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'no', 'no', 'yes', 'yes', 'yes', 'QNXvQs07qpOJ3YaUHgQQ.jpg', 'ymqCTmPI9RYn8x0L7AAj.jpg', 'Es3VNBpRSRxIbEhADEud.jpg', 'jsuQCRSWQvTUB8VaIW2G.jpg', 'lPn0Bzn24cwGrzK10RWj.jpg', 'House for good warrior hobbits!', '2023-08-07 19:10:54'),
('oXcLTFY01BsmahA5vjnP', 'eo1PGw3A5Vvl3zp0hgX7', 'Millenium Falcon', 'Galaxy', '16000000', 'flat', 'sale', 'ready', 'semi-furnished', '1', '16000000', '1', '1', '1', '320', '44', '1', '5', 'not available', 'yes', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'yes', 'no', 'no', 'HuqejQNAJEP5xyJv3Vck.jpg', 'O98QAtiDTOcVf86L5Hbq.jpg', 'HBctc5r27d7mThwWPUN5.jpg', 'SSgdjcwoWrsulXumHvtz.jpg', 'x7JJvVVDyrS2IH1De1YK.jpg', 'Need to sell it out and disappear.', '2023-08-14 18:22:10');

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `property_id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `sender` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `receiver` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `property_id`, `sender`, `receiver`, `date`) VALUES
('0Ph4u19MVNUQG4jfFdIM', 'e6yRuwur8N2qcnMVGlf2', 'fN4dhyqeLy5Rfh1pv8lr', 'dPOipGHYqdnMfMnrIwZQ', '2023-08-09 17:13:59'),
('bSdUtc9jdpXSPgwfGJhO', 'bS4nBZAHpZVWo3Mwdhi0', 'dPOipGHYqdnMfMnrIwZQ', 'fN4dhyqeLy5Rfh1pv8lr', '2023-08-09 17:31:28'),
('UPJ6AOvVUq8tTWtiy1vv', 'e6yRuwur8N2qcnMVGlf2', 'eo1PGw3A5Vvl3zp0hgX7', 'dPOipGHYqdnMfMnrIwZQ', '2023-08-14 18:22:35'),
('F1ctjfo2Rez6k5sfTB7t', 'bS4nBZAHpZVWo3Mwdhi0', 'eo1PGw3A5Vvl3zp0hgX7', 'fN4dhyqeLy5Rfh1pv8lr', '2023-08-14 18:22:44'),
('OkflFcgmffeRlFxWQQZp', 'oXcLTFY01BsmahA5vjnP', 'dPOipGHYqdnMfMnrIwZQ', 'eo1PGw3A5Vvl3zp0hgX7', '2023-08-14 18:24:21');

-- --------------------------------------------------------

--
-- Структура таблицы `saved`
--

CREATE TABLE `saved` (
  `id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `property_id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `saved`
--

INSERT INTO `saved` (`id`, `property_id`, `user_id`) VALUES
('m6zqyRPjxOqyfwlwIhAC', 'bS4nBZAHpZVWo3Mwdhi0', 'dPOipGHYqdnMfMnrIwZQ'),
('gQJbatkjH84BGfLvXA8E', 'bS4nBZAHpZVWo3Mwdhi0', 'fN4dhyqeLy5Rfh1pv8lr');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `password`) VALUES
('dPOipGHYqdnMfMnrIwZQ', 'Zinger', '79139139999', 'zingerrr@hf.com', '9e07f1c61057a28d70299b6c695d5432adf80e38'),
('fN4dhyqeLy5Rfh1pv8lr', 'boba', '9124444444', 'boba@hf.com', '9e07f1c61057a28d70299b6c695d5432adf80e38'),
('eo1PGw3A5Vvl3zp0hgX7', 'Mando', '79129159999', 'mando@hf.com', '9e07f1c61057a28d70299b6c695d5432adf80e38'),
('lIzGI5yWrmCzQfj8kFuV', 'Yoda', '79129169999', 'yoda@hf.com', '9e07f1c61057a28d70299b6c695d5432adf80e38'),
('WMGzv54SXq0eYRglFYtc', 'Frodo', '79129189999', 'frodo@hf.com', '9e07f1c61057a28d70299b6c695d5432adf80e38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
