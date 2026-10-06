-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2026 a las 00:54:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `abogalia_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abogados`
--

CREATE TABLE `abogados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `especializacion` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `ciudad` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `abogados`
--

INSERT INTO `abogados` (`id`, `nombre`, `especializacion`, `descripcion`, `foto`, `ciudad`, `direccion`, `email`, `telefono`, `created_at`) VALUES
(2, 'Alethia Alvarez', 'Laboral y Civil', 'Especialista en temas civiles y laborales. Alta experiencia con derechos de los trabajadores.', '6c8e88f80c183351fb2e2fb84ab04e79.jpg', 'Aguascalientes', 'Comunidad los Negritos', 'aleallibelle@gmail.com', '4493452247', '2026-10-06 22:13:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(10) UNSIGNED NOT NULL,
  `abogado_id` int(10) UNSIGNED NOT NULL,
  `nombre_cliente` varchar(150) NOT NULL,
  `email_cliente` varchar(150) NOT NULL,
  `telefono_cliente` varchar(30) NOT NULL,
  `descripcion_caso` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `abogado_id`, `nombre_cliente`, `email_cliente`, `telefono_cliente`, `descripcion_caso`, `fecha`, `hora`, `created_at`) VALUES
(1, 2, 'Miguel Esparza', 'miguelangelem2@gmail.com', '4491854735', 'Terminación contrato', '2026-11-08', '09:30:00', '2026-10-06 22:17:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abogados`
--
ALTER TABLE `abogados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_citas_abogado` (`abogado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abogados`
--
ALTER TABLE `abogados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_citas_abogado` FOREIGN KEY (`abogado_id`) REFERENCES `abogados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
