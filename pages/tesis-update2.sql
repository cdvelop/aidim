-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-06-2016 a las 01:29:55
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `tesis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla_revision`
--

CREATE TABLE `plantilla_revision` (
  `id_plantilla_revision` int(15) NOT NULL,
  `id_inspeccion` int(50) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `Ruido` varchar(20) DEFAULT NULL,
  `Temperatura` varchar(20) DEFAULT NULL,
  `Conexiones` varchar(20) DEFAULT NULL,
  `Acometida` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plantilla_revision`
--

INSERT INTO `plantilla_revision` (`id_plantilla_revision`, `id_inspeccion`, `id_equipo`, `comentario`, `Ruido`, `Temperatura`, `Conexiones`, `Acometida`) VALUES
(4, 2, 4, 'Comentario Adicional', NULL, '12', NULL, 'Todo ok');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `plantilla_revision`
--
ALTER TABLE `plantilla_revision`
  ADD PRIMARY KEY (`id_plantilla_revision`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `plantilla_revision`
--
ALTER TABLE `plantilla_revision`
  MODIFY `id_plantilla_revision` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;