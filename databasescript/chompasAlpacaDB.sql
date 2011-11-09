-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-11-2011 a las 07:21:47
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `chompasalpaca`
--
CREATE DATABASE `chompasalpaca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chompasalpaca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chompas`
--

CREATE TABLE IF NOT EXISTS `chompas` (
  `chompaId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `insumoId` int(11) NOT NULL,
  `currentStock` int(11) NOT NULL,
  `minStock` int(11) NOT NULL,
  PRIMARY KEY (`chompaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `chompas`
--

INSERT INTO `chompas` (`chompaId`, `nombre`, `insumoId`, `currentStock`, `minStock`) VALUES
(1, 'office', 7, 239, 100),
(2, 'Mid season', 5, 74, 80),
(3, 'Holmes', 7, -8, 80),
(4, 'Gigardo', 6, 200, 120),
(5, 'Anton', 7, 238, 100),
(6, 'LeBlanc', 6, 348, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE IF NOT EXISTS `insumos` (
  `insumoId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(11) NOT NULL,
  PRIMARY KEY (`insumoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`insumoId`, `nombre`) VALUES
(5, 'modern'),
(6, 'elegant'),
(7, 'classic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumoschompas`
--

CREATE TABLE IF NOT EXISTS `insumoschompas` (
  `insumoId` int(11) NOT NULL,
  `chompaId` int(11) NOT NULL,
  `cantidadEquivalenteChompas` int(11) NOT NULL,
  PRIMARY KEY (`insumoId`,`chompaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `insumoschompas`
--

INSERT INTO `insumoschompas` (`insumoId`, `chompaId`, `cantidadEquivalenteChompas`) VALUES
(5, 2, 100),
(6, 4, 180),
(6, 6, 200),
(7, 1, 200),
(7, 3, 100),
(7, 5, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `pedidoId` int(25) NOT NULL AUTO_INCREMENT,
  `insumoId` int(11) NOT NULL,
  `chompaId` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `pendiente` tinyint(1) NOT NULL,
  PRIMARY KEY (`pedidoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pedidoId`, `insumoId`, `chompaId`, `fecha`, `pendiente`) VALUES
(18, 6, 4, '2011-11-08', 0),
(19, 7, 1, '2011-11-08', 1),
(20, 6, 6, '2011-11-08', 0),
(21, 7, 5, '2011-11-08', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
