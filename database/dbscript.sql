-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2022 a las 18:00:34
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda-tidem-4a`
--

-- --------------------------------------------------------
CREATE DATABASE tienda;

CREATE USER 'tienda-admin'@'localhost' IDENTIFIED BY 'tienda123A';
GRANT ALL ON tienda.* TO 'tienda-admin'@'localhost';
FLUSH PRIVILEGES;

USE tienda;

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `idDevolucion` int(11) NOT NULL,
  `idOrden` int(11) NOT NULL,
  `motivo` int(11) NOT NULL,
  PRIMARY KEY (`idDevolucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `domicilio` int(11) NOT NULL,
  `codigoPostal` int(11) NOT NULL,
  `calle` varchar(60) NOT NULL,
  `numeroExterior` varchar(5) NOT NULL,
  `numeroInterior` varchar(5) DEFAULT NULL,
  PRIMARY KEY(`domicilio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `idOrden` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `domicilio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY(`idOrden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenproducto`
--

CREATE TABLE `ordenproducto` (
  `idOrdenProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idOrden` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY(`idOrdenProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `categoria`(
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `descripcion` TEXT,
  PRIMARY KEY(`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categoria`(`nombre`, `descripcion`) VALUES('General', NULL);
INSERT INTO `categoria`(`nombre`, `descripcion`) VALUES('Electronica', NULL);
INSERT INTO `categoria`(`nombre`, `descripcion`) VALUES('Muebles', NULL);
INSERT INTO `categoria`(`nombre`, `descripcion`) VALUES('Consumibles', NULL);

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `nombre` text NOT NULL,
  `costo` decimal(10,0) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY(`idProducto`),
  FOREIGN KEY(`idCategoria`) REFERENCES `categoria`(`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `fechaDeNacimiento` int(11) NOT NULL,
  `usuario` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 0,
  `saldo` decimal(10,0) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `telefono`, `correo`, `fechaDeNacimiento`, `usuario`, `password`, `tipo`, `saldo`) VALUES
(1, 'Cris', 'Cardenas', 2147483647, 'cuevashernandezcruze', 24, 'SonicChu', '2134', 1, '0'),
(2, 'fabian', 'Salazar', 2147483647, 'ihsuwhwhgs@gmail.com', 23, 'ggu', 'Añathgthytjh', 0, '0'),
(3, 'fiaban', 'martinez', 2147483647, 'Oscar@gmail.com', 10, 'JasonTodd69', 'Oscar', 0, '0'),
(4, 'Jorge', 'Corona', 2147483647, 'utsoe@gmail.com', 45, 'Cano', 'KJSAJSBAKHVSKHAVSHVu', 0, '0'),
(5, 'noadmin', 'Corona', 1234567890, 'corona.mat.oz@gmail.', 20, 'noadmin', '123', 0, '0'),
(6, 'admin', 'madero', 1234456789, 'admin@mail.com', 20, 'admin', '1234', 1, '0'),
(7, 'Saul', 'Goodman', 1118001239, 'bussines@gmail.com', 30, 'sgman', '3a409ff9bf757ce7545b', 0, '0'),
(8, 'Doroteo', 'Arango', 1234123456, 'darango@mail.mx', 40, 'panchoV', 'e807f1fcf82d132f9bb0', 0, '0');

--
-- Filtros para la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD CONSTRAINT `devolucion_ibfk_1` FOREIGN KEY (`idOrden`) REFERENCES `orden` (`idOrden`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `orden_ibfk_2` FOREIGN KEY (`domicilio`) REFERENCES `estado` (`domicilio`);

--
-- Filtros para la tabla `ordenproducto`
--
ALTER TABLE `ordenproducto`
  ADD CONSTRAINT `ordenproducto_ibfk_1` FOREIGN KEY (`idOrden`) REFERENCES `orden` (`idOrden`),
  ADD CONSTRAINT `ordenproducto_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
