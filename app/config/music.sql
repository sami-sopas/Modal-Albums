-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2023 a las 19:53:33
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
-- Base de datos: `music`
--
CREATE DATABASE IF NOT EXISTS `music` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `music`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Pop'),
(2, 'Rock'),
(3, 'Reggaeton'),
(4, 'Cumbia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `id_genre` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `music`
--

INSERT INTO `music` (`id`, `name`, `description`, `id_genre`, `date`) VALUES
(19, 'D>E>A>T>H>M>E>T>A>L', 'Panchiko es una banda de rock indie británica formada en Nottingham, Reino Unido a finales de los años 90, que mezcla elementos del rock con otros géneros, como el trip-hop y el lo-fi.', 2, '2023-07-15 11:31:34'),
(20, 'Norman Fucking Rockwell!', 'Elizabeth Woolridge Grant, ​conocida artísticamente como Lana Del Rey, es una cantante, compositora, modelo, actriz, escritora y productora estadounidense.', 1, '2023-07-15 11:37:28'),
(21, 'Romance', 'Luis Miguel Gallego Basteri, ​​ conocido como Luis Miguel, es un cantante y productor mexicano.​​​ Es uno de los cantantes más exitosos de la música en español.', 1, '2023-07-15 11:39:49'),
(22, 'El Madrileño', 'C. Tangana, es un rapero, cantante, compositor y actor español de diversos géneros como Rap trap, latin pop, nuevo flamenco y reguetón.', 3, '2023-07-15 11:50:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_song_genre` (`id_genre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `fk_song_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
