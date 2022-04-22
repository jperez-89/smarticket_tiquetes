-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2022 a las 20:14:10
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tickets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombreCliente` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefonoCliente` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `emailCliente` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombreCliente`, `telefonoCliente`, `emailCliente`, `Status`) VALUES
(1, 'Argenis Martinez Alvarez', '60234578', 'amartinez@gmail.com', 1),
(2, 'Rodrigo Espinoza Suarez', '83251435', 'espinozasu@hotmail.com', 1),
(3, 'Jairo Pérez Rodríguez', '83182537', 'jrwc1989@gmail.com', 1),
(4, 'Carlos Ramírez Solano', '85661298', 'csolano@empresa.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `idEntrada` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idTipoEntrada` int(11) NOT NULL,
  `CantidadEntradas` int(11) NOT NULL,
  `PrecioUnitario` int(11) NOT NULL,
  `EntradasDisponibles` int(11) NOT NULL,
  `LimiteCompra` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`idEntrada`, `idEvento`, `idTipoEntrada`, `CantidadEntradas`, `PrecioUnitario`, `EntradasDisponibles`, `LimiteCompra`, `Status`) VALUES
(1, 2, 1, 20, 5000, 17, 2, 1),
(2, 1, 2, 10, 50000, 3, 2, 1),
(3, 1, 1, 120, 15000, 111, 3, 1),
(4, 3, 1, 50000, 20000, 49985, 5, 1),
(5, 3, 2, 50, 45000, 35, 2, 1),
(6, 2, 4, 13, 16000, 10, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `idEvento` int(11) NOT NULL,
  `nombreEvento` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`idEvento`, `nombreEvento`, `Status`) VALUES
(1, 'Concierto Gondwana', 1),
(2, 'Baile Maelo Ruiz', 1),
(3, 'Concierto Los Cafres', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaentradas`
--

CREATE TABLE `reservaentradas` (
  `idReservaEntrada` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idTipoEntrada` int(11) NOT NULL,
  `PrecioEntrada` int(11) NOT NULL,
  `cantEntradas` int(11) NOT NULL,
  `TotalPagar` int(11) NOT NULL,
  `tipoReserva` char(1) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `reservaentradas`
--

INSERT INTO `reservaentradas` (`idReservaEntrada`, `idCliente`, `idEvento`, `idTipoEntrada`, `PrecioEntrada`, `cantEntradas`, `TotalPagar`, `tipoReserva`) VALUES
(1, 3, 1, 1, 15000, 2, 30000, 'R'),
(2, 3, 3, 1, 20000, 5, 100000, 'R'),
(3, 4, 3, 1, 20000, 2, 40000, 'R'),
(4, 1, 2, 1, 5000, 1, 5000, 'R'),
(5, 4, 1, 2, 50000, 2, 100000, 'R'),
(6, 1, 1, 1, 15000, 3, 45000, 'R'),
(7, 2, 2, 4, 16000, 2, 32000, 'R'),
(8, 2, 1, 2, 50000, 2, 100000, 'R'),
(9, 2, 3, 1, 20000, 5, 100000, 'R'),
(10, 1, 3, 1, 20000, 3, 60000, 'R');

--
-- Disparadores `reservaentradas`
--
DELIMITER $$
CREATE TRIGGER `restar_stock_entradas` AFTER INSERT ON `reservaentradas` FOR EACH ROW BEGIN
    UPDATE entradas
    SET EntradasDisponibles = EntradasDisponibles - new.cantEntradas
    WHERE idEvento = new.idEvento AND idTipoEntrada = idTipoEntrada;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoentradas`
--

CREATE TABLE `tipoentradas` (
  `idTipoEntrada` int(11) NOT NULL,
  `nombreTipoEntrada` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipoentradas`
--

INSERT INTO `tipoentradas` (`idTipoEntrada`, `nombreTipoEntrada`, `Status`) VALUES
(1, 'General', 1),
(2, 'VIP', 1),
(3, '2', 2),
(4, 'Combo Salsero VIP', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`,`emailCliente`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`idEntrada`),
  ADD KEY `fkEntradas_Eventos` (`idEvento`),
  ADD KEY `fkEntradas_TipoEntradas` (`idTipoEntrada`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEvento`);

--
-- Indices de la tabla `reservaentradas`
--
ALTER TABLE `reservaentradas`
  ADD PRIMARY KEY (`idReservaEntrada`),
  ADD KEY `fkEvento_Reserva` (`idEvento`),
  ADD KEY `fkCliente_Reserva` (`idCliente`),
  ADD KEY `fkTipoEntrada_Reserva` (`idTipoEntrada`);

--
-- Indices de la tabla `tipoentradas`
--
ALTER TABLE `tipoentradas`
  ADD PRIMARY KEY (`idTipoEntrada`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `idEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservaentradas`
--
ALTER TABLE `reservaentradas`
  MODIFY `idReservaEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipoentradas`
--
ALTER TABLE `tipoentradas`
  MODIFY `idTipoEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fkEntradas_Eventos` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`idEvento`),
  ADD CONSTRAINT `fkEntradas_TipoEntradas` FOREIGN KEY (`idTipoEntrada`) REFERENCES `tipoentradas` (`idTipoEntrada`);

--
-- Filtros para la tabla `reservaentradas`
--
ALTER TABLE `reservaentradas`
  ADD CONSTRAINT `fkCliente_Reserva` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `fkEvento_Reserva` FOREIGN KEY (`idEvento`) REFERENCES `entradas` (`idEvento`),
  ADD CONSTRAINT `fkTipoEntrada_Reserva` FOREIGN KEY (`idTipoEntrada`) REFERENCES `entradas` (`idTipoEntrada`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
