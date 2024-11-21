-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 21 2024 г., 18:27
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
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `PRODUCT_NAME` varchar(255) NOT NULL,
  `PRODUCT_PRICE` decimal(10,2) DEFAULT NULL,
  `PRODUCT_ARTICLE` varchar(255) DEFAULT NULL,
  `PRODUCT_QUANTITY` int(11) DEFAULT NULL,
  `DATE_CREATE` datetime DEFAULT current_timestamp(),
  `IS_HIDDEN` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`ID`, `PRODUCT_ID`, `PRODUCT_NAME`, `PRODUCT_PRICE`, `PRODUCT_ARTICLE`, `PRODUCT_QUANTITY`, `DATE_CREATE`, `IS_HIDDEN`) VALUES
(1, 101, 'Product A', 150.00, 'ART001', 11, '2024-11-21 05:35:59', 0),
(2, 102, 'Product B', 200.50, 'ART002', 12, '2024-11-21 05:35:59', 0),
(3, 103, 'Product C', 300.00, 'ART003', 25, '2024-11-21 05:35:59', 1),
(4, 105, 'Product A', 100.00, '12345', 51, '2024-11-21 05:59:10', 0),
(5, 106, 'Product B', 150.00, '12346', 31, '2024-11-21 05:59:10', 0),
(6, 107, 'Product C', 200.00, '12347', 21, '2024-11-21 05:59:10', 0),
(7, 108, 'Product D', 250.00, '12348', 11, '2024-11-21 05:59:10', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
