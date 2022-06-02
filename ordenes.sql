-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2017 a las 23:44:37
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ordenes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(10) NOT NULL,
  `nombre_clientes` varchar(50) NOT NULL,
  `contacto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `movil` varchar(50) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_clientes`, `contacto`, `ciudad`, `direccion`, `telefono`, `movil`, `email`) VALUES
(1, 'Carvajal', 'Alejandra Escobar', 'Bogota', 'calle 26 # 45-35', '5443322', '3113355935', 'andres@carvajal.com'),
(2, 'Isa', 'andres', 'Bogota', 'Calle 200 # 8-08', '5443322', '3134485060', 'cauonsitemed@isa.com.co'),
(4, 'Socya', 'Beatriz Carvajal', 'Bogota', 'Calle 30 # 55-198', '3146236060', '3146236060', 'bcarvajal@socya.org.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `serial_equipo` varchar(50) NOT NULL,
  `nombre_equipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `product_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `serial_equipo`, `nombre_equipo`, `descripcion`, `product_number`) VALUES
(1, '5CG5463J2Z', 'Hp probook 640 g1', 'portatil', 'T6F37LP#ABM'),
(2, '5CG5463DFJ', 'hp probook 840 g3', 'portatil', 'T6F37LP#ASD'),
(3, '8CG434018W', 'HP EliteBook Revolve 810 G2', 'portatil', 'F7U92LA'),
(4, '5FGRTYUH', 'HP EliteBook Revolve', 'portatil', 'DL146'),
(5, 'MXL30223HC', 'HP COMPAQ ELITE 8300', 'portatil', 'C9G96LT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `nom_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_estado`, `nom_estado`) VALUES
(1, 'Requiere Repuesto'),
(2, 'Pendiente Proveedor'),
(3, 'Repuestos OK'),
(4, 'Fix Time'),
(5, 'Caso Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_servicio`
--

CREATE TABLE `ordenes_servicio` (
  `id_caso` int(50) NOT NULL,
  `num_caso` bigint(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `fecha_recibido` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `fecha_onsite` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `fecha_repair` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `fecha_cierre` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `nombre_clientes` varchar(50) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `movil` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_serial_equipos` int(50) NOT NULL,
  `descripcion_servicio` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_servicio` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_tecnico_servicio` int(11) NOT NULL,
  `id_tecnico_solucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ordenes_servicio`
--

INSERT INTO `ordenes_servicio` (`id_caso`, `num_caso`, `estado`, `fecha_creacion`, `fecha_recibido`, `fecha_onsite`, `fecha_repair`, `fecha_cierre`, `nombre_clientes`, `contacto`, `ciudad`, `direccion`, `telefono`, `movil`, `email`, `id_serial_equipos`, `descripcion_servicio`, `tipo_servicio`, `id_tecnico_servicio`, `id_tecnico_solucion`) VALUES
(16, 4748350112, 'Requiere repuesto', '2017-12-26 17:12:00', '2017-12-26 17:12:00', '1970-01-01 06:00:00', '1970-01-01 06:00:00', '1970-01-01 06:00:00', 'Socya', 'Beatriz Carvajal', 'BogotÃ¡, D.C.', 'Calle 30 # 55-198', '3146236060', '3146236060', 'bcarvajal@socya.org.co', 3, 'Diagnostico', 'onsite', 1, 2),
(17, 4757162395, 'Requiere repuesto', '2017-12-26 19:00:00', '2017-12-26 21:00:00', '1970-01-01 06:00:00', '1970-01-01 06:00:00', '1970-01-01 06:00:00', 'ENLACE TECNOLOGICO DE NEGOCIOS', 'JUAN CARLOS JIMENEZ', 'BogotÃ¡, D.C.', 'CALLE 60 # 10-40', '3187736746', '3187736746', 'JUAN.JIMENES@ETN.COM.CO', 5, 'Diagnostico', 'onsite', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes`
--

CREATE TABLE `partes` (
  `id_partes` bigint(255) NOT NULL,
  `no_parte` varchar(255) NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partes`
--

INSERT INTO `partes` (`id_partes`, `no_parte`, `descripcion`) VALUES
(1, '730958-001', 'SPS-PLASTIC KIT 14'),
(4, '717380-001', 'Intel Dual Band Wireless-N 7260NB 802.11 a/b/g/n (2x2) WiFi module'),
(7, '671613-001', '4GB PC3 -1200 DUAL MEMORY MODULE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `id_repuestos` int(11) NOT NULL,
  `part_order` varchar(255) NOT NULL,
  `no_parte` varchar(50) NOT NULL,
  `serial_parte` varchar(255) NOT NULL,
  `uso_parte` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`id_repuestos`, `part_order`, `no_parte`, `serial_parte`, `uso_parte`) VALUES
(8, 'PO-102794206', '1', 'N/A', 'Usado'),
(9, 'PO-102794206', '4', 'N/A', 'Usado'),
(10, 'PO-123456788', '4', 'DFGHJ', 'Usado'),
(11, 'PO-123456788', '1', 'ERTYU', 'Usado'),
(12, 'po-99999999', '4', 'sdrergege', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `id_tecnico` int(11) NOT NULL,
  `ntecnico` varchar(50) NOT NULL,
  `ncedula` int(100) NOT NULL,
  `telefono` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`id_tecnico`, `ntecnico`, `ncedula`, `telefono`) VALUES
(1, 'Diego', 1026582100, '3184870193'),
(2, 'Jose', 1023457134, '3184876985');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `numdoc` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `numdoc`, `password`) VALUES
(1, '1026582100', 'Diego.2311'),
(2, '25284793', 'angie');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_visitas` int(11) NOT NULL,
  `part_order` varchar(50) NOT NULL,
  `work_order` varchar(100) NOT NULL,
  `caso` int(50) NOT NULL,
  `fecha` timestamp(4) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visitas`, `part_order`, `work_order`, `caso`, `fecha`) VALUES
(11, 'PO-102794206', 'WO-1234567890', 10, '2017-12-26 17:12:00.0000'),
(12, 'PO-123456788', 'WO-99866554', 16, '2017-12-26 22:00:00.0000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `ordenes_servicio`
--
ALTER TABLE `ordenes_servicio`
  ADD PRIMARY KEY (`id_caso`);

--
-- Indices de la tabla `partes`
--
ALTER TABLE `partes`
  ADD PRIMARY KEY (`id_partes`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id_repuestos`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`id_tecnico`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ordenes_servicio`
--
ALTER TABLE `ordenes_servicio`
  MODIFY `id_caso` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `partes`
--
ALTER TABLE `partes`
  MODIFY `id_partes` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id_repuestos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id_tecnico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visitas` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
