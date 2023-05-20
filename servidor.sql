-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2023 a las 07:12:15
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
-- Base de datos: `servidor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adopcion`
--

CREATE TABLE `adopcion` (
  `Seq_Ado` int(6) NOT NULL,
  `Seq_Usuario` decimal(5,0) NOT NULL,
  `CodAni` decimal(5,0) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `adopcion`
--

INSERT INTO `adopcion` (`Seq_Ado`, `Seq_Usuario`, `CodAni`, `Fecha`) VALUES
(1, 2, 5, '2022-10-02'),
(2, 2, 7, '2022-11-15'),
(3, 3, 8, '2022-01-20'),
(4, 2, 1, '2023-05-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal`
--

CREATE TABLE `animal` (
  `CodAni` decimal(5,0) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `CodRaz` decimal(3,0) NOT NULL,
  `CodAso` decimal(5,0) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `animal`
--

INSERT INTO `animal` (`CodAni`, `Nombre`, `CodRaz`, `CodAso`, `Estado`) VALUES
(1, 'Leo', 1, 2, 1),
(2, 'Blacky', 3, 2, 1),
(3, 'Rengar', 2, 2, 1),
(4, 'Jara', 6, 1, 1),
(5, 'Salvi', 5, 1, 1),
(6, 'Mojito', 4, 1, 1),
(7, 'Thor', 4, 1, 1),
(8, 'Cocacola', 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asociacion`
--

CREATE TABLE `asociacion` (
  `CodAso` decimal(5,0) NOT NULL,
  `Descripcion` varchar(30) NOT NULL,
  `CIF` varchar(9) DEFAULT NULL,
  `Seq_Dom` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `asociacion`
--

INSERT INTO `asociacion` (`CodAso`, `Descripcion`, `CIF`, `Seq_Dom`) VALUES
(1, 'Perretes sin fronteras', 'A1234567B', 2),
(2, 'Gatetes sin fronteras', 'C2345678B', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `Seq_Dom` decimal(5,0) NOT NULL,
  `CodTV` decimal(2,0) NOT NULL,
  `NombreVia` varchar(30) NOT NULL,
  `Numero` decimal(3,0) NOT NULL,
  `Piso` decimal(2,0) DEFAULT NULL,
  `Letra` varchar(1) DEFAULT NULL,
  `CodProv` decimal(2,0) NOT NULL,
  `CodLoc` decimal(3,0) NOT NULL,
  `mapa` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`Seq_Dom`, `CodTV`, `NombreVia`, `Numero`, `Piso`, `Letra`, `CodProv`, `CodLoc`, `mapa`) VALUES
(1, 1, 'Arroyo', 1, 3, 'B', 41, 3, ''),
(2, 1, 'Tramontana', 14, 4, NULL, 41, 927, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3171.6600497692425!2d-6.050743623570874!3d37.35055613648238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd126d22229a303d%3A0x22ec0f90ad648441!2sC.%20Tramontana%2C%2014%2C%2041927%20Mairena%20del%20Aljarafe%2C%20Sevilla!5e0!3m2!1ses!2ses!4v1683101350389!5m2!1ses!2ses\"></iframe>'),
(3, 1, 'Reyes Catolicos', 10, NULL, NULL, 41, 500, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3172.588155218549!2d-5.855650323571608!3d37.328582137736134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1264d426400569%3A0x64d0550f4d7d5c79!2sC.%20Reyes%20Cat%C3%B3licos%2C%2010%2C%2041500%20Alcal%C3%A1%20de%20Guada%C3%ADra%2C%20Sevilla!5e0!3m2!1ses!2ses!4v1683102248958!5m2!1ses!2ses\"></iframe>'),
(4, 1, 'Villegas y Marmolejo', 14, 6, 'B', 41, 3, ''),
(5, 1, 'Esperanza de Triana', 8, 2, 'C', 41, 3, ''),
(6, 1, 'Juan', 1, 1, 'A', 21, 730, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donacion`
--

CREATE TABLE `donacion` (
  `Seq_Don` int(11) NOT NULL,
  `Seq_Usuario` decimal(5,0) NOT NULL,
  `CodAso` decimal(5,0) NOT NULL,
  `Importe` decimal(6,2) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `donacion`
--

INSERT INTO `donacion` (`Seq_Don`, `Seq_Usuario`, `CodAso`, `Importe`, `Fecha`) VALUES
(1, 2, 2, 50.00, '2022-02-17'),
(2, 3, 2, 10.00, '2023-10-22'),
(3, 2, 1, 10.00, '2023-05-05'),
(4, 2, 1, 20.00, '2023-05-05'),
(5, 2, 2, 50.00, '2023-05-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `CodProv` decimal(2,0) NOT NULL,
  `CodLoc` decimal(3,0) NOT NULL,
  `Descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`CodProv`, `CodLoc`, `Descripcion`) VALUES
(21, 730, 'Almonte'),
(41, 3, 'Sevilla'),
(41, 500, 'Alcala de Guadaira'),
(41, 927, 'Mairena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `CodPer` decimal(1,0) NOT NULL,
  `Descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`CodPer`, `Descripcion`) VALUES
(1, 'Admin'),
(2, 'Asociacion'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `CodProv` decimal(2,0) NOT NULL,
  `Descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`CodProv`, `Descripcion`) VALUES
(21, 'Huelva'),
(41, 'Sevilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `CodRaz` decimal(3,0) NOT NULL,
  `Descripcion` varchar(30) NOT NULL,
  `CodTA` decimal(1,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`CodRaz`, `Descripcion`, `CodTA`) VALUES
(1, 'Siames', 1),
(2, 'Persa', 1),
(3, 'Sin raza', 1),
(4, 'Salchicha', 2),
(5, 'Bulldog', 2),
(6, 'Sin raza', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seq_dom`
--

CREATE TABLE `seq_dom` (
  `next_not_cached_value` bigint(21) NOT NULL,
  `minimum_value` bigint(21) NOT NULL,
  `maximum_value` bigint(21) NOT NULL,
  `start_value` bigint(21) NOT NULL COMMENT 'start value when sequences is created or value if RESTART is used',
  `increment` bigint(21) NOT NULL COMMENT 'increment value',
  `cache_size` bigint(21) UNSIGNED NOT NULL,
  `cycle_option` tinyint(1) UNSIGNED NOT NULL COMMENT '0 if no cycles are allowed, 1 if the sequence should begin a new cycle when maximum_value is passed',
  `cycle_count` bigint(21) NOT NULL COMMENT 'How many cycles have been done'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seq_dom`
--

INSERT INTO `seq_dom` (`next_not_cached_value`, `minimum_value`, `maximum_value`, `start_value`, `increment`, `cache_size`, `cycle_option`, `cycle_count`) VALUES
(1, 1, 9223372036854775806, 1, 1, 1000, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seq_usuario`
--

CREATE TABLE `seq_usuario` (
  `next_not_cached_value` bigint(21) NOT NULL,
  `minimum_value` bigint(21) NOT NULL,
  `maximum_value` bigint(21) NOT NULL,
  `start_value` bigint(21) NOT NULL COMMENT 'start value when sequences is created or value if RESTART is used',
  `increment` bigint(21) NOT NULL COMMENT 'increment value',
  `cache_size` bigint(21) UNSIGNED NOT NULL,
  `cycle_option` tinyint(1) UNSIGNED NOT NULL COMMENT '0 if no cycles are allowed, 1 if the sequence should begin a new cycle when maximum_value is passed',
  `cycle_count` bigint(21) NOT NULL COMMENT 'How many cycles have been done'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seq_usuario`
--

INSERT INTO `seq_usuario` (`next_not_cached_value`, `minimum_value`, `maximum_value`, `start_value`, `increment`, `cache_size`, `cycle_option`, `cycle_count`) VALUES
(1, 1, 9223372036854775806, 1, 1, 1000, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoanimal`
--

CREATE TABLE `tipoanimal` (
  `CodTA` decimal(1,0) NOT NULL,
  `Descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipoanimal`
--

INSERT INTO `tipoanimal` (`CodTA`, `Descripcion`) VALUES
(1, 'Gato'),
(2, 'Perro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipovia`
--

CREATE TABLE `tipovia` (
  `CodTV` decimal(2,0) NOT NULL,
  `Descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipovia`
--

INSERT INTO `tipovia` (`CodTV`, `Descripcion`) VALUES
(1, 'Calle'),
(2, 'Avenida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Seq_Usuario` decimal(5,0) NOT NULL,
  `DNI` decimal(8,0) DEFAULT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Ap1` varchar(30) NOT NULL,
  `Ap2` varchar(30) DEFAULT NULL,
  `Telefono` decimal(9,0) NOT NULL,
  `Correo` varchar(324) NOT NULL,
  `Password` varchar(130) NOT NULL,
  `CuentaBanco` varchar(20) DEFAULT NULL,
  `CodPer` decimal(1,0) NOT NULL,
  `Seq_Dom` decimal(5,0) NOT NULL,
  `CodAso` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Seq_Usuario`, `DNI`, `Nombre`, `Ap1`, `Ap2`, `Telefono`, `Correo`, `Password`, `CuentaBanco`, `CodPer`, `Seq_Dom`, `CodAso`) VALUES
(1, 12345678, 'Alejandro', 'Escudero', 'Gallardo', 612345678, 'aescudero@gmail.com', '123', NULL, 3, 1, NULL),
(2, 23456789, 'David', 'Maraver', 'Ceballos', 623456789, 'maraversillo@hotmail.com', '123', '23452345234523452345', 3, 5, NULL),
(3, 34567890, 'Juan', 'Reyes', NULL, 634567890, 'juanreyes@hotmail.com', '123', '12341234123412341234', 3, 4, NULL),
(4, 12345679, 'Admin', '', '', 612345679, 'admin@gmail.com', '123', NULL, 1, 1, NULL),
(5, 12341234, 'Maraver', 'Maraver', 'Maraver', 123123123, 'maraver@maraver.com', '123123123', '12341234123412341234', 3, 7, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adopcion`
--
ALTER TABLE `adopcion`
  ADD PRIMARY KEY (`Seq_Ado`),
  ADD KEY `fk_AdoAni` (`CodAni`),
  ADD KEY `fk_AdoUsu` (`Seq_Usuario`);

--
-- Indices de la tabla `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`CodAni`),
  ADD KEY `fk_AniAso` (`CodAso`),
  ADD KEY `fk_AniRaz` (`CodRaz`);

--
-- Indices de la tabla `asociacion`
--
ALTER TABLE `asociacion`
  ADD PRIMARY KEY (`CodAso`),
  ADD UNIQUE KEY `CIF` (`CIF`);

--
-- Indices de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD PRIMARY KEY (`Seq_Dom`),
  ADD KEY `fk_DomTV` (`CodTV`);

--
-- Indices de la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD PRIMARY KEY (`Seq_Don`),
  ADD KEY `fk_DonUsu` (`Seq_Usuario`),
  ADD KEY `fk_DonAso` (`CodAso`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`CodProv`,`CodLoc`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`CodPer`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`CodProv`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`CodRaz`),
  ADD KEY `fk_RazTA` (`CodTA`);

--
-- Indices de la tabla `tipoanimal`
--
ALTER TABLE `tipoanimal`
  ADD PRIMARY KEY (`CodTA`);

--
-- Indices de la tabla `tipovia`
--
ALTER TABLE `tipovia`
  ADD PRIMARY KEY (`CodTV`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Seq_Usuario`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD KEY `fk_UsuPer` (`CodPer`),
  ADD KEY `fk_UsuDom` (`Seq_Dom`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adopcion`
--
ALTER TABLE `adopcion`
  MODIFY `Seq_Ado` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `donacion`
--
ALTER TABLE `donacion`
  MODIFY `Seq_Don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adopcion`
--
ALTER TABLE `adopcion`
  ADD CONSTRAINT `fk_AdoAni` FOREIGN KEY (`CodAni`) REFERENCES `animal` (`CodAni`),
  ADD CONSTRAINT `fk_AdoUsu` FOREIGN KEY (`Seq_Usuario`) REFERENCES `usuario` (`Seq_Usuario`);

--
-- Filtros para la tabla `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `fk_AniAso` FOREIGN KEY (`CodAso`) REFERENCES `asociacion` (`CodAso`),
  ADD CONSTRAINT `fk_AniRaz` FOREIGN KEY (`CodRaz`) REFERENCES `raza` (`CodRaz`);

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `fk_DomLoc` FOREIGN KEY (`CodProv`,`CodLoc`) REFERENCES `localidad` (`CodProv`, `CodLoc`),
  ADD CONSTRAINT `fk_DomTV` FOREIGN KEY (`CodTV`) REFERENCES `tipovia` (`CodTV`);

--
-- Filtros para la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD CONSTRAINT `fk_DonAso` FOREIGN KEY (`CodAso`) REFERENCES `asociacion` (`CodAso`),
  ADD CONSTRAINT `fk_DonUsu` FOREIGN KEY (`Seq_Usuario`) REFERENCES `usuario` (`Seq_Usuario`);

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `fk_LocProv` FOREIGN KEY (`CodProv`) REFERENCES `provincia` (`CodProv`);

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `fk_RazTA` FOREIGN KEY (`CodTA`) REFERENCES `tipoanimal` (`CodTA`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_UsuDom` FOREIGN KEY (`Seq_Dom`) REFERENCES `domicilio` (`Seq_Dom`),
  ADD CONSTRAINT `fk_UsuPer` FOREIGN KEY (`CodPer`) REFERENCES `perfil` (`CodPer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
