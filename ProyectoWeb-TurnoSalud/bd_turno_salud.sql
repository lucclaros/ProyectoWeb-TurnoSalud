-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 13:00:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_turno_salud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendas`
--

CREATE TABLE `agendas` (
  `id_agenda` int(8) NOT NULL,
  `id_doctor` int(8) NOT NULL,
  `id_dia` int(8) NOT NULL,
  `id_mes` int(8) NOT NULL,
  `inicio_jornada` time NOT NULL,
  `fin_jornada` time NOT NULL,
  `duracion_turno` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agendas`
--

INSERT INTO `agendas` (`id_agenda`, `id_doctor`, `id_dia`, `id_mes`, `inicio_jornada`, `fin_jornada`, `duracion_turno`) VALUES
(153, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(154, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(155, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(156, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(157, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(158, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(159, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(160, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(161, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(162, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(163, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(164, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(165, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(166, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(167, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(168, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(169, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(170, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(171, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(172, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(173, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(174, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(175, 1, 2, 1, '10:00:00', '18:00:00', '00:45:00'),
(176, 1, 3, 1, '10:00:00', '18:00:00', '00:45:00'),
(177, 1, 2, 2, '10:00:00', '18:00:00', '00:45:00'),
(178, 1, 3, 2, '10:00:00', '18:00:00', '00:45:00'),
(179, 1, 2, 3, '10:00:00', '18:00:00', '00:45:00'),
(180, 1, 3, 3, '10:00:00', '18:00:00', '00:45:00'),
(181, 1, 2, 4, '10:00:00', '18:00:00', '00:45:00'),
(182, 1, 3, 4, '10:00:00', '18:00:00', '00:45:00'),
(183, 1, 2, 5, '10:00:00', '18:00:00', '00:45:00'),
(184, 1, 3, 5, '10:00:00', '18:00:00', '00:45:00'),
(185, 1, 2, 6, '10:00:00', '18:00:00', '00:45:00'),
(186, 1, 3, 6, '10:00:00', '18:00:00', '00:45:00'),
(187, 1, 2, 7, '10:00:00', '18:00:00', '00:45:00'),
(188, 1, 3, 7, '10:00:00', '18:00:00', '00:45:00'),
(189, 1, 2, 8, '10:00:00', '18:00:00', '00:45:00'),
(190, 1, 3, 8, '10:00:00', '18:00:00', '00:45:00'),
(191, 1, 2, 9, '10:00:00', '18:00:00', '00:45:00'),
(192, 1, 3, 9, '10:00:00', '18:00:00', '00:45:00'),
(193, 1, 2, 10, '10:00:00', '18:00:00', '00:45:00'),
(194, 1, 3, 10, '10:00:00', '18:00:00', '00:45:00'),
(195, 1, 2, 11, '10:00:00', '18:00:00', '00:45:00'),
(196, 1, 3, 11, '10:00:00', '18:00:00', '00:45:00'),
(197, 1, 2, 12, '10:00:00', '18:00:00', '00:45:00'),
(198, 1, 3, 12, '10:00:00', '18:00:00', '00:45:00'),
(199, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(200, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(201, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(202, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(203, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(204, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(205, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(206, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(207, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(208, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(209, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(210, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(211, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(212, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(213, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(214, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(215, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(216, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(217, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(218, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(219, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(220, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(221, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(222, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(223, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(224, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(225, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(226, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(227, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(228, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(229, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(230, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(231, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(232, 11, 2, 1, '07:00:00', '18:00:00', '01:00:00'),
(233, 11, 3, 1, '07:00:00', '18:00:00', '01:00:00'),
(234, 11, 4, 1, '07:00:00', '18:00:00', '01:00:00'),
(235, 11, 2, 2, '07:00:00', '18:00:00', '01:00:00'),
(236, 11, 3, 2, '07:00:00', '18:00:00', '01:00:00'),
(237, 11, 4, 2, '07:00:00', '18:00:00', '01:00:00'),
(238, 11, 2, 3, '07:00:00', '18:00:00', '01:00:00'),
(239, 11, 3, 3, '07:00:00', '18:00:00', '01:00:00'),
(240, 11, 4, 3, '07:00:00', '18:00:00', '01:00:00'),
(241, 11, 2, 4, '07:00:00', '18:00:00', '01:00:00'),
(242, 11, 3, 4, '07:00:00', '18:00:00', '01:00:00'),
(243, 11, 4, 4, '07:00:00', '18:00:00', '01:00:00'),
(244, 11, 2, 5, '07:00:00', '18:00:00', '01:00:00'),
(245, 11, 3, 5, '07:00:00', '18:00:00', '01:00:00'),
(246, 11, 4, 5, '07:00:00', '18:00:00', '01:00:00'),
(247, 11, 2, 6, '07:00:00', '18:00:00', '01:00:00'),
(248, 11, 3, 6, '07:00:00', '18:00:00', '01:00:00'),
(249, 11, 4, 6, '07:00:00', '18:00:00', '01:00:00'),
(250, 11, 2, 7, '07:00:00', '18:00:00', '01:00:00'),
(251, 11, 3, 7, '07:00:00', '18:00:00', '01:00:00'),
(252, 11, 4, 7, '07:00:00', '18:00:00', '01:00:00'),
(253, 11, 2, 8, '07:00:00', '18:00:00', '01:00:00'),
(254, 11, 3, 8, '07:00:00', '18:00:00', '01:00:00'),
(255, 11, 4, 8, '07:00:00', '18:00:00', '01:00:00'),
(256, 11, 2, 9, '07:00:00', '18:00:00', '01:00:00'),
(257, 11, 3, 9, '07:00:00', '18:00:00', '01:00:00'),
(258, 11, 4, 9, '07:00:00', '18:00:00', '01:00:00'),
(259, 11, 2, 10, '07:00:00', '18:00:00', '01:00:00'),
(260, 11, 3, 10, '07:00:00', '18:00:00', '01:00:00'),
(261, 11, 4, 10, '07:00:00', '18:00:00', '01:00:00'),
(262, 11, 2, 11, '07:00:00', '18:00:00', '01:00:00'),
(263, 11, 3, 11, '07:00:00', '18:00:00', '01:00:00'),
(264, 11, 4, 11, '07:00:00', '18:00:00', '01:00:00'),
(265, 11, 2, 12, '07:00:00', '18:00:00', '01:00:00'),
(266, 11, 3, 12, '07:00:00', '18:00:00', '01:00:00'),
(267, 11, 4, 12, '07:00:00', '18:00:00', '01:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `comentario` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id_dia` int(11) NOT NULL,
  `nombre_dia` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id_dia`, `nombre_dia`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id_doctor` int(8) NOT NULL,
  `id_usuario` int(8) NOT NULL,
  `id_especialidad` int(8) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id_doctor`, `id_usuario`, `id_especialidad`, `direccion`, `precio`) VALUES
(1, 3, 1, 'fraga 500', 16000),
(3, 7, 1, 'Rivadavia 5560', 25000),
(4, 8, 2, 'Pueyrredon 100 ', 8000),
(5, 9, 2, 'Libertados San Martin 791', 10000),
(6, 10, 2, 'Juncal 840', 17000),
(7, 11, 3, 'Bilbao 446', 11000),
(8, 12, 3, 'Suipacha 740', 9000),
(9, 13, 4, 'Santa Fe 200', 12000),
(10, 14, 4, '9 de julio 1674', 20000),
(11, 15, 2, 'santa fe 90', 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores_obras_sociales`
--

CREATE TABLE `doctores_obras_sociales` (
  `id_doctor` int(8) NOT NULL,
  `id_obra_social` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doctores_obras_sociales`
--

INSERT INTO `doctores_obras_sociales` (`id_doctor`, `id_obra_social`) VALUES
(2, 2),
(3, 2),
(4, 4),
(5, 3),
(6, 3),
(7, 1),
(1, 4),
(11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id_especialidad` int(8) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id_especialidad`, `nombre`) VALUES
(1, 'Medico clinico'),
(2, 'Odontologia'),
(3, 'Pediatria'),
(4, 'Traumatologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiales_medicos`
--

CREATE TABLE `historiales_medicos` (
  `id_historial_medico` int(8) NOT NULL,
  `id_doctor` int(8) NOT NULL,
  `id_paciente` int(8) NOT NULL,
  `enlace_documento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id_codigo_postal` int(8) NOT NULL,
  `nombre_de_localidad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id_codigo_postal`, `nombre_de_localidad`) VALUES
(1, 'Moron'),
(2, 'Ituzaingo'),
(3, 'Padua'),
(4, 'Moreno'),
(5, 'San Martin'),
(6, 'CABA'),
(7, 'Lanus'),
(8, 'Quilmes'),
(9, 'Florencio Varela'),
(10, 'Avellaneda'),
(11, 'Lomas de Zamora'),
(12, 'Berazategui'),
(13, 'Esteban Echeverria'),
(14, 'San Isidro'),
(15, 'San Fernando'),
(16, 'Tigre'),
(17, 'Vicente Lopez'),
(18, 'Pilar'),
(19, 'Tres de Febrero'),
(20, 'La Plata');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id_matricula` int(8) NOT NULL,
  `id_doctor` int(8) DEFAULT NULL,
  `numero_matricula` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id_matricula`, `id_doctor`, `numero_matricula`) VALUES
(1, NULL, '12345'),
(2, NULL, '23457'),
(3, 11, '34578'),
(4, NULL, '45789'),
(5, NULL, '57890'),
(6, NULL, '67901'),
(7, NULL, '78012'),
(8, NULL, '89023'),
(9, NULL, '90134'),
(10, NULL, '01245');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meses`
--

CREATE TABLE `meses` (
  `id_meses` int(8) NOT NULL,
  `nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `meses`
--

INSERT INTO `meses` (`id_meses`, `nombre`) VALUES
(1, 'Enero'),
(2, 'Febrero'),
(3, 'Marzo'),
(4, 'Abril'),
(5, 'Mayo'),
(6, 'Junio'),
(7, 'julio'),
(8, 'Agosto'),
(9, 'Septiembre'),
(10, 'Octubre'),
(11, 'Noviembre'),
(12, 'Diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras_sociales`
--

CREATE TABLE `obras_sociales` (
  `id_obra_social` int(8) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descuento` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `obras_sociales`
--

INSERT INTO `obras_sociales` (`id_obra_social`, `nombre`, `descuento`) VALUES
(1, 'Pami', 0.1),
(2, 'Sanidad', 0.2),
(3, 'Ospe', 0.2),
(4, 'Osde', 0.4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(8) NOT NULL,
  `id_usuario` int(8) NOT NULL,
  `id_obra_social` int(8) NOT NULL,
  `numero_afiliado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `id_usuario`, `id_obra_social`, `numero_afiliado`) VALUES
(1, 1, 4, '6164'),
(2, 2, 3, '11'),
(3, 5, 2, '1764'),
(4, 6, 1, '4531'),
(5, 16, 1, '2141');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id_provincia` int(8) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `nombre`) VALUES
(1, 'Buenos Aires'),
(2, 'La Pampa'),
(3, 'Jujuy'),
(4, 'La Rioja'),
(5, 'Córdoba'),
(6, 'Catamarca'),
(7, 'Chaco'),
(8, 'Chubut'),
(10, 'Corrientes'),
(11, 'Entre Ríos'),
(12, 'Formosa'),
(13, 'Mendoza'),
(14, 'Misiones'),
(15, 'Neuquén'),
(16, 'Río Negro'),
(17, 'Salta'),
(18, 'San Juan'),
(19, 'San Luis'),
(20, 'Santa Cruz'),
(21, 'Santa Fe'),
(22, 'Santiago del Estero'),
(23, 'Tierra del Fuego'),
(24, 'Tucumán');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscriptores`
--

CREATE TABLE `suscriptores` (
  `id_suscripcion` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documentos`
--

CREATE TABLE `tipos_documentos` (
  `id_tipo_documento` int(8) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_documentos`
--

INSERT INTO `tipos_documentos` (`id_tipo_documento`, `nombre`) VALUES
(1, 'dni'),
(2, 'Visa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id_turno` int(8) NOT NULL,
  `id_paciente` int(8) NOT NULL,
  `id_agenda` int(8) NOT NULL,
  `fecha_del_turno` date NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `hora_turno` time NOT NULL,
  `estado_turno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id_turno`, `id_paciente`, `id_agenda`, `fecha_del_turno`, `lugar`, `hora_turno`, `estado_turno`) VALUES
(1, 2, 1, '0000-00-00', 'Consultorio', '00:00:00', 'Cancelado'),
(2, 1, 1, '2024-06-25', 'Consultorio', '15:15:00', 'Programado'),
(3, 1, 1, '2024-06-25', 'Consultorio', '10:00:00', 'Programado'),
(4, 1, 1, '2024-06-25', 'Consultorio', '13:45:00', 'Programado'),
(5, 5, 11, '2024-06-26', 'Consultorio', '11:00:00', 'Programado'),
(6, 5, 11, '2024-06-25', 'Consultorio', '16:00:00', 'Programado'),
(7, 5, 1, '2024-06-25', 'Consultorio', '13:00:00', 'Programado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(8) NOT NULL,
  `id_tipo_documento` int(8) NOT NULL,
  `id_provincia` int(8) NOT NULL,
  `id_localidad` int(8) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_usuario` varchar(50) NOT NULL,
  `documento_usuario` varchar(10) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `administrador` int(8) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_tipo_documento`, `id_provincia`, `id_localidad`, `nombre_usuario`, `apellido_usuario`, `documento_usuario`, `usuario`, `password`, `email`, `administrador`, `imagen`) VALUES
(1, 1, 1, 4, 'jose', 'villegas', '27345678', 'josevillegas', 'f717c413cebc560ff181002dbc323431', 'jose@gmail.com', NULL, 'foto1'),
(2, 1, 5, 10, 'karina', 'gomez', '32456789', 'karinagomez', '25b75828d59d5d126e0faa7aab654017', 'karina@gmail.com', 1, 'foto2'),
(3, 1, 1, 2, 'federico', 'perez', '41567890', 'fedeperez', '925b4c68435d1c1feaf05f526578ab16', 'fede@gmail.com', NULL, 'foto3'),
(4, 1, 1, 9, 'sonia', 'gomez', '19876543', 'soniagomez', '6649fd67f6451bd5cd3b8d9c629a5dbe', 'sonia@gmail.com', NULL, 'foto4'),
(5, 1, 1, 5, 'martin', 'perez', '3445616', 'martinlopez', '34f74c049edea51851c6924f4a386762', 'martin@gmail.com', NULL, 'foto5'),
(6, 1, 1, 4, 'jose', 'lopez', '56789012', 'joselopez', 'a3c9e8f7d1', 'jose@gmail.com', NULL, 'foto6'),
(7, 1, 1, 1, 'maria', 'martinez', '23456789', 'mariamartinez', '1b2d3e4c5a', 'maria@gmail.com', NULL, 'foto7'),
(8, 1, 1, 3, 'luis', 'fernandez', '34567890', 'luisfernandez', 'c7d8e9f0a1', 'luis@gmail.com', NULL, 'foto8'),
(9, 1, 1, 8, 'ana', 'rodriguez', '45678901', 'anarodriguez', '3e4f5a6b7c', 'ana@gmail.com', NULL, 'foto9'),
(10, 1, 1, 12, 'juan', 'gonzalez', '67890123', 'juangonzalez', '9a0b1c2d3e', 'juan@gmail.com', NULL, 'foto10'),
(11, 1, 1, 7, 'laura', 'sanchez', '78901234', 'laurasanchez', 'b2c3d4e5f6', 'laura@gmail.com', NULL, 'foto11'),
(12, 1, 1, 9, 'pablo', 'torres', '89012345', 'pablotolres', '7d8e9f0a1b', 'pablo@gmail.com', NULL, 'foto12'),
(13, 1, 1, 6, 'andrea', 'ramirez', '90123456', 'andrearamirez', '5a6b7c8d9e', 'andrea@gmail.com', NULL, 'foto13'),
(14, 1, 1, 5, 'carlos', 'diaz', '01234567', 'carlosdiaz', '2d3e4f5a6b', 'carlos@gmail.com', NULL, 'foto14'),
(15, 1, 1, 8, 'marcelo', 'gomez', '27938002', 'marcelo', '3087fef099356ee4eb120feee83a80e2', 'marcelo@gmail.com', NULL, NULL),
(16, 1, 1, 12, 'miguel', 'gonzales', '12464375', 'miguel', 'd622db89866532f89625db5a6b33a95b', 'miguel@gmail.com', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `agenda_ibfk_1` (`id_doctor`),
  ADD KEY `agenda_ibfk_2` (`id_mes`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id_dia`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id_doctor`),
  ADD KEY `doctor_ibfk_5` (`id_usuario`),
  ADD KEY `doctor_ibfk_6` (`id_especialidad`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `historiales_medicos`
--
ALTER TABLE `historiales_medicos`
  ADD PRIMARY KEY (`id_historial_medico`),
  ADD KEY `historial_medico_ibfk_1` (`id_doctor`),
  ADD KEY `historial_medico_ibfk_2` (`id_paciente`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id_codigo_postal`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `matricula_ibfk_1` (`id_doctor`);

--
-- Indices de la tabla `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`id_meses`);

--
-- Indices de la tabla `obras_sociales`
--
ALTER TABLE `obras_sociales`
  ADD PRIMARY KEY (`id_obra_social`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `paciente_ibfk_4` (`id_obra_social`),
  ADD KEY `paciente_ibfk_5` (`id_usuario`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  ADD PRIMARY KEY (`id_suscripcion`);

--
-- Indices de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `usuario_ibfk_1` (`id_tipo_documento`),
  ADD KEY `usuario_ibfk_2` (`id_provincia`),
  ADD KEY `usuario_ibfk_3` (`id_localidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id_agenda` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id_dia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id_doctor` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id_especialidad` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historiales_medicos`
--
ALTER TABLE `historiales_medicos`
  MODIFY `id_historial_medico` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id_codigo_postal` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `meses`
--
ALTER TABLE `meses`
  MODIFY `id_meses` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `obras_sociales`
--
ALTER TABLE `obras_sociales`
  MODIFY `id_obra_social` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id_provincia` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  MODIFY `id_suscripcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  MODIFY `id_tipo_documento` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_turno` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctores` (`id_doctor`),
  ADD CONSTRAINT `agendas_ibfk_2` FOREIGN KEY (`id_mes`) REFERENCES `meses` (`id_meses`);

--
-- Filtros para la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD CONSTRAINT `doctores_ibfk_5` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `doctores_ibfk_6` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`);

--
-- Filtros para la tabla `historiales_medicos`
--
ALTER TABLE `historiales_medicos`
  ADD CONSTRAINT `historiales_medicos_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctores` (`id_doctor`),
  ADD CONSTRAINT `historiales_medicos_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctores` (`id_doctor`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_4` FOREIGN KEY (`id_obra_social`) REFERENCES `obras_sociales` (`id_obra_social`),
  ADD CONSTRAINT `pacientes_ibfk_5` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipos_documentos` (`id_tipo_documento`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id_provincia`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_codigo_postal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
