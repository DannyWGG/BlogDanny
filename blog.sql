-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2022 a las 18:24:14
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `usuario` int(11) NOT NULL,
  `reply` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `comentario`, `usuario`, `reply`, `fecha`, `post_id`) VALUES
(1, ' Buen Post xD', 3, 0, '2022-03-29 18:07:49', 2),
(2, 'Hola, Soy Manuel', 3, 0, '2022-03-29 21:21:27', 1),
(3, ' Mi nombre es Moises', 9, 0, '2022-03-29 21:37:56', 2),
(4, ' Hola, soy Maria', 11, 0, '2022-03-29 21:54:12', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poster`
--

CREATE TABLE `poster` (
  `id` int(11) NOT NULL,
  `post` varchar(500) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha_post` date NOT NULL,
  `titulo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poster`
--

INSERT INTO `poster` (`id`, `post`, `usuario`, `fecha_post`, `titulo`) VALUES
(1, 'La comunicación es el intercambio de información que se produce entre dos o más individuos con el objetivo de aportar información y recibirla. En este proceso intervienen un emisor y un receptor, además del mensaje que se pone de manifiesto.', 2, '2022-03-29', 'La Comunicación'),
(2, 'El liderazgo es el conjunto de habilidades gerenciales o de las directivas que un individuo tiene para influir en la forma de ser y actuar de las personas o en un grupo de trabajo determinado, haciendo que este equipo trabaje con entusiasmo hacia el logro de sus metas y objetivos. xD', 2, '2022-03-29', 'El Liderazgo'),
(3, 'Venezuela, oficialmente República Bolivariana de Venezuela,6​n 3​ es un país soberano situado en la parte septentrional de América del Sur, constituido por un área continental y por un gran número de islas e islotes en el mar Caribe, cuya capital y mayor aglomeración urbana es la ciudad de Caracas.', 3, '2022-03-29', 'Venezuela'),
(4, 'Programación Web. Permite la creación de sitios dinámicos en Internet. Esto se consigue generando los contenidos del sitio a través de una base de datos mediante lenguajes de programación Web. Dominando la programación Web podremos crear sitios dinámicos como periódicos digitales o tiendas virtuales.', 11, '2022-03-29', 'La Programación Web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `fecha_reg` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `superu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `avatar`, `fecha_reg`, `email`, `superu`) VALUES
(2, 'Danny', '$2y$10$2vcVYmT2AInjZjiSBZpmvu0W5cSpmQvVBo0zVLH3c9ZFVNh0jYz6O', '', '2022-03-29', 'danny@gmail.com', 1),
(3, 'Manuel', '$2y$10$kEJHc8D6H049B33OB8z9gOTs5bngpVudohluotAqy44ReHmCMrz7C', '', '2022-03-29', 'Manu@gmail.com', 0),
(5, 'Jose', '$2y$10$MowN3oRXacedrRD/mnCdTOsKidY4vE44S8UuHDA9bdhGEways46dq', '', '2022-03-29', 'jose@gmail.com', 1),
(6, 'Ana', '$2y$10$WzTJwx3CnhCUUYRk4oaCIOjp3sAoxMXORfMCez4aDJq2JyT0pH.xS', '', '2022-03-29', 'ana@gmail.com', 1),
(7, 'Armando', '$2y$10$D9HQK8f4yV.Fo7zbpqpwxOsJl9P21oEkKosDbGH84wVvvRDLj1WZW', '', '2022-03-29', 'armando@gmail.com', 1),
(8, 'Victor', '$2y$10$b3a96HAD8KvhTwNFsTNeI.MMv6cfj2H2F8qCC.NjQxkLrM1LoRaIW', '', '2022-03-29', 'victor@gmail.com', 1),
(9, 'Moises', '$2y$10$JNBGSwOe7d0FUfL/noiGaeH0MJzBfw71Y0cLkbHWGWwyq.RlqNTi6', '', '2022-03-29', 'moi@gmail.com', 0),
(10, 'Wilfred Vasquez', '$2y$10$q8Sl1qJ8DB5S6zxEJSrFJei7DM6lDkVn5SXdycSB39KBRrCMvDOSa', '', '2022-03-29', 'wilfredvas@gmail.com', 1),
(11, 'Maria', '$2y$10$f68MZiLdlqjE6Z9BJjMH5uIrW0gpQ/X/xGn27ZkrYHkMi1kf7zNcG', '', '2022-03-29', 'mari@gmail.com', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
