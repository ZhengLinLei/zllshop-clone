-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2021 a las 19:01:31
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zllshop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buy_history`
--

CREATE TABLE `buy_history` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL COMMENT 'User who bought this list (wechat_id)',
  `history` text NOT NULL COMMENT 'Json of the all data',
  `price_value` double NOT NULL COMMENT 'In yuan',
  `status` text NOT NULL DEFAULT '未发货' COMMENT 'Check the status',
  `code` text NOT NULL DEFAULT '未批准' COMMENT 'The code of the ship',
  `ship_code` text NOT NULL DEFAULT '未运送' COMMENT 'The Ship Company code',
  `rate` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Rate of the ship (Yes/No) Rated',
  `share` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Share the products (Yes/No) Shared',
  `date_buy` date NOT NULL DEFAULT current_timestamp() COMMENT 'The date when was bought'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL COMMENT 'Coupon code',
  `value_yuan` double NOT NULL COMMENT 'Value of the coupon in yuan',
  `used_by_someone` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'If someone used this coupon',
  `user_used` text DEFAULT NULL COMMENT 'User who used',
  `expire_date` date NOT NULL COMMENT 'The expire date',
  `coupon_create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rate_app`
--

CREATE TABLE `rate_app` (
  `id` int(11) NOT NULL,
  `rate` int(11) NOT NULL COMMENT '1-5 rate valoration',
  `argue` text NOT NULL COMMENT 'Comentary about the rate',
  `user` text NOT NULL COMMENT 'User who rated',
  `name` text NOT NULL COMMENT 'User names',
  `date_rated` date NOT NULL DEFAULT current_timestamp() COMMENT 'Date of the rated moment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rate_buy`
--

CREATE TABLE `rate_buy` (
  `id` int(11) NOT NULL,
  `rate` int(5) NOT NULL COMMENT 'Rate 1-5',
  `argue` text NOT NULL COMMENT 'Comentary about the buy experience',
  `day` int(11) NOT NULL COMMENT 'Shipping days',
  `buy_id` int(11) NOT NULL COMMENT 'Id of buy history',
  `user` text NOT NULL COMMENT 'User rated',
  `name` text NOT NULL COMMENT 'User name',
  `date_rated` date NOT NULL DEFAULT current_timestamp() COMMENT 'Date rated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shop_item_buy`
--

CREATE TABLE `shop_item_buy` (
  `id` int(11) NOT NULL COMMENT 'Index of the table',
  `item_name` text NOT NULL COMMENT 'Item name',
  `item_description` text NOT NULL COMMENT 'Item description',
  `item_price_yuan` double NOT NULL COMMENT 'The price of the item in yuan',
  `item_price_euro` double NOT NULL COMMENT 'The price of the item in euro',
  `item_price_ship` tinyint(1) NOT NULL COMMENT 'If in the include shipping services (1 if yes 0 if no)',
  `item_class` text NOT NULL COMMENT 'The type of this item',
  `item_word` longtext NOT NULL COMMENT 'The words to search this item',
  `item_tag` longtext NOT NULL COMMENT 'Tags to describe the item',
  `item_image` longtext NOT NULL COMMENT 'All the rute to the image saved path',
  `item_seller` text NOT NULL COMMENT 'Who sell this item',
  `item_sell_times` int(11) NOT NULL DEFAULT 0 COMMENT 'The times selled of this item',
  `item_data_create` date NOT NULL DEFAULT current_timestamp() COMMENT 'The item creation day'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `wechat_id` text NOT NULL COMMENT 'The wechat ID to login and verify',
  `name` text NOT NULL COMMENT 'The name of the user',
  `password` text NOT NULL COMMENT 'Password of the user',
  `money_coin` double NOT NULL DEFAULT 0 COMMENT 'Inner shop money to buy something (In yuan)',
  `daily_points` int(11) NOT NULL DEFAULT 30 COMMENT 'Daily points receive',
  `daily_points_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'The date where received daily points',
  `user_location` longtext DEFAULT NULL COMMENT 'The user location',
  `user_buy_times` int(11) NOT NULL DEFAULT 0 COMMENT 'User buyed times',
  `user_buy_all_money` double NOT NULL DEFAULT 0,
  `user_cart` longtext DEFAULT NULL,
  `user_range` text NOT NULL DEFAULT '新用户' COMMENT 'Long time user buying',
  `user_role` text DEFAULT NULL COMMENT 'Role',
  `user_birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT 'User birthday (optional)',
  `email` text DEFAULT NULL COMMENT 'User email (optional)',
  `email_verify_code` int(11) NOT NULL DEFAULT 0 COMMENT 'New email verify code',
  `verify_code` int(11) NOT NULL COMMENT 'The Code to verify Account',
  `invited_by` text DEFAULT NULL COMMENT 'When the user was invited by someone',
  `create_user_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `buy_history`
--
ALTER TABLE `buy_history`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rate_app`
--
ALTER TABLE `rate_app`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rate_buy`
--
ALTER TABLE `rate_buy`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `shop_item_buy`
--
ALTER TABLE `shop_item_buy`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `buy_history`
--
ALTER TABLE `buy_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rate_app`
--
ALTER TABLE `rate_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rate_buy`
--
ALTER TABLE `rate_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `shop_item_buy`
--
ALTER TABLE `shop_item_buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Index of the table';

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
