-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2021 a las 06:17:21
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `supermarket`
--
CREATE DATABASE IF NOT EXISTS `supermarket` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `supermarket`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `measure` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `name`, `price`, `stock`, `description`, `measure`, `state`) VALUES
(1, 'Mango', '250', 100, 'Mango Verde', 'KG', 1),
(2, 'Papaya', '550', 100, 'Papaya madura', 'UNIDAD', 1),
(3, 'Pera', '650', 0, 'Pera', 'UNIDAD', 0),
(4, 'Naranja', '1500', 80, 'Bolsa de Naranja', 'UNIDAD', 1),
(5, 'Sandia', '2300', 100, 'Sandia por Kg', 'KG', 1),
(6, 'Culantro', '200', 100, 'Rollo de culantro', 'UNIDAD', 1),
(7, 'Cebolla', '1275', 100, 'Kilos de cebolla', 'KG', 1),
(8, 'Tomate', '2500', 60, 'Kilos de tomate', 'KG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(1, 'jrwc1989@gmail.com', 'Vsmora1989', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
