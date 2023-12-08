-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2023 a las 20:15:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `workflow2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujo`
--

CREATE TABLE `flujo` (
  `flujo` varchar(2) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `procesosiguiente` varchar(3) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `rol` varchar(10) DEFAULT NULL,
  `pantalla` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `flujo`
--

INSERT INTO `flujo` (`flujo`, `proceso`, `procesosiguiente`, `tipo`, `rol`, `pantalla`) VALUES
('F1', 'P1', 'P2', 'I', 'estudiante', 'anuncio'),
('F1', 'P2', 'P3', 'P', 'estudiante', 'listado'),
('F1', 'P3', NULL, 'C', 'kardex', 'verifica'),
('F1', 'P4', NULL, 'P', 'estudiante', 'correcto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujopregunta`
--

CREATE TABLE `flujopregunta` (
  `flujo` varchar(2) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL,
  `si` varchar(3) DEFAULT NULL,
  `no` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `flujopregunta`
--

INSERT INTO `flujopregunta` (`flujo`, `proceso`, `si`, `no`) VALUES
('F1', 'P3', 'P4', NULL),
('F1', 'P6', 'P7', 'P8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `secuencia` int(11) DEFAULT NULL,
  `usuario` varchar(10) DEFAULT NULL,
  `fechahorainicio` datetime DEFAULT NULL,
  `fechahorafin` datetime DEFAULT NULL,
  `flujo` varchar(2) DEFAULT NULL,
  `proceso` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`secuencia`, `usuario`, `fechahorainicio`, `fechahorafin`, `flujo`, `proceso`) VALUES
(1, '11', '2023-11-07 15:00:00', '2023-11-07 15:01:00', 'F1', 'P1'),
(1, '11', '2023-11-07 15:01:00', NULL, 'F1', 'P2'),
(2, '12', '2023-11-04 15:01:00', NULL, 'F2', 'P1'),
(3, '11', '2023-11-01 12:01:00', NULL, 'F3', 'P1'),
(14, '13', '2023-11-07 15:00:00', '2023-11-07 15:01:00', 'F1', 'P1'),
(14, '13', '2023-11-07 15:02:00', NULL, 'F1', 'P2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
