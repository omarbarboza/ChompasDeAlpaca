-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2011 at 04:36 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chompasalpaca`
--
CREATE DATABASE `chompasalpaca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chompasalpaca`;

-- --------------------------------------------------------

--
-- Table structure for table `chompas`
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
-- Dumping data for table `chompas`
--

INSERT INTO `chompas` (`chompaId`, `nombre`, `insumoId`, `currentStock`, `minStock`) VALUES
(1, 'office', 7, 105, 100),
(2, 'Mid season', 5, 83, 80),
(3, 'Holmes', 7, 84, 80),
(4, 'Gigardo', 6, 123, 120),
(5, 'Anton', 7, 103, 100),
(6, 'LeBlanc', 6, 153, 150);

-- --------------------------------------------------------

--
-- Table structure for table `insumos`
--

CREATE TABLE IF NOT EXISTS `insumos` (
  `insumoId` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(11) NOT NULL,
  PRIMARY KEY (`insumoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `insumos`
--

INSERT INTO `insumos` (`insumoId`, `nombre`) VALUES
(5, 'modern'),
(6, 'elegant'),
(7, 'classic');

-- --------------------------------------------------------

--
-- Table structure for table `insumoschompas`
--

CREATE TABLE IF NOT EXISTS `insumoschompas` (
  `insumoId` int(11) NOT NULL,
  `chompaId` int(11) NOT NULL,
  `cantidadEquivalenteChompas` int(11) NOT NULL,
  PRIMARY KEY (`insumoId`,`chompaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insumoschompas`
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
-- Table structure for table `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `pedidoId` int(25) NOT NULL AUTO_INCREMENT,
  `insumoId` int(11) NOT NULL,
  `chompaId` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `pendiente` tinyint(1) NOT NULL,
  PRIMARY KEY (`pedidoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
