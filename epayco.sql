-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-07-2020 a las 21:51:46
-- Versión del servidor: 5.7.30-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `epayco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `document` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cellphone` varchar(100) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `document`, `name`, `email`, `cellphone`, `created_at`, `updated_at`) VALUES
(20, '15505050', 'Erka Rebolledo', 'erkarebolledo@gmail.com', '04166424326', '2020-07-18', '2020-07-18'),
(43, '12961060', 'Erka Rebolledo', 'samurebolledox@gmail.com', '04166424326', '2020-07-19', '2020-07-19'),
(44, '2000021', 'Samuel Rebolledo', 'smauel@gmail.com', '04165447887', '2020-07-19', '2020-07-19'),
(45, '564556455', 'Karen Suarez', 'karen.suarez@gmail.com', '04166424261', '2020-07-19', '2020-07-19'),
(46, '555454544', 'Samantha Rebolledo', 'sami@gmail.com', '041125544', '2020-07-19', '2020-07-19'),
(47, '545456454', 'Isabel Rebolledo', 'isarebo@gmail.com', '5118209', '2020-07-19', '2020-07-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `session_id` varchar(100) DEFAULT NULL,
  `token` varchar(6) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `wallets`
--

INSERT INTO `wallets` (`id`, `customer_id`, `balance`, `session_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 0, '0.00', NULL, NULL, '2020-07-18', '2020-07-18'),
(2, 0, '0.00', NULL, NULL, '2020-07-18', '2020-07-18'),
(3, 0, '0.00', NULL, NULL, '2020-07-18', '2020-07-18'),
(4, 1, '0.00', NULL, NULL, '2020-07-18', '2020-07-18'),
(5, 39, '10.00', NULL, NULL, '2020-07-18', '2020-07-18'),
(6, 40, '0.00', NULL, NULL, '2020-07-18', '2020-07-18'),
(7, 20, '200.00', 'nl4zcLHbGuOLHnjExIxp3LnZU7AnsnVX3C9tM1gY', '7a2c4e', '2020-07-18', '2020-07-19'),
(8, 43, '50.00', NULL, NULL, '2020-07-19', '2020-07-19'),
(9, 44, '125.00', NULL, NULL, '2020-07-19', '2020-07-19'),
(10, 45, '97.00', 'wiRqwdIrTDqiRAATxw9jgm5U2aMDOydlWujsquAg', 'dff760', '2020-07-19', '2020-07-19'),
(11, 46, '0.00', NULL, NULL, '2020-07-19', '2020-07-19'),
(12, 47, '0.00', NULL, NULL, '2020-07-19', '2020-07-19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT de la tabla `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
