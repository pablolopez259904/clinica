-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2022 a las 05:12:32
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
-- Base de datos: `clinicaproyecto_2021`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_rama_medica` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `sintomas` varchar(150) COLLATE utf16_bin DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_citas`
--

CREATE TABLE `detalle_citas` (
  `id_detalle_cita` int(11) NOT NULL,
  `id_sucursal` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `codigo` varchar(9) COLLATE utf16_bin DEFAULT NULL,
  `nombres` varchar(60) COLLATE utf16_bin DEFAULT NULL,
  `apellidos` varchar(60) COLLATE utf16_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf16_bin DEFAULT NULL,
  `telefono` varchar(8) COLLATE utf16_bin DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_puesto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `id_sucursal` int(11) DEFAULT NULL,
  `sector` varchar(5) COLLATE utf16_bin DEFAULT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `id_sucursal`, `sector`, `numero`) VALUES
(1, 1, 'A', 1),
(2, 1, 'A', 2),
(3, 1, 'A', 3),
(4, 1, 'B', 1),
(5, 1, 'B', 2),
(6, 1, 'B', 3),
(7, 2, 'A', 1),
(8, 2, 'A', 2),
(9, 2, 'B', 1),
(10, 2, 'B', 2),
(110, 5, 'A', 1),
(111, 5, 'A', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion_reservada`
--

CREATE TABLE `habitacion_reservada` (
  `id_habitacion_ocupada` int(11) NOT NULL,
  `id_habitacion` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `estado` varchar(10) COLLATE utf16_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medico`
--

CREATE TABLE `historial_medico` (
  `id_historial_medico` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `observaciones` varchar(150) COLLATE utf16_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes_medicina`
--

CREATE TABLE `lotes_medicina` (
  `id_lote_medicina` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf16_bin DEFAULT NULL,
  `serie` varchar(30) COLLATE utf16_bin DEFAULT NULL,
  `fecha_caducidad` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `lotes_medicina`
--

INSERT INTO `lotes_medicina` (`id_lote_medicina`, `nombre`, `serie`, `fecha_caducidad`) VALUES
(1, 'Titrab', 'LM-001', '2025-12-20'),
(2, 'Tobleth', 'LM-002', '2028-01-01'),
(5, 'Ocleoh', 'LM-003', '2025-05-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `id_medicamento` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf16_bin DEFAULT NULL,
  `marca` varchar(60) COLLATE utf16_bin DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf16_bin NOT NULL,
  `id_lote_medicina` int(11) DEFAULT NULL,
  `precio_costo` double(8,2) NOT NULL,
  `precio_venta` double(8,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`id_medicamento`, `nombre`, `marca`, `descripcion`, `id_lote_medicina`, `precio_costo`, `precio_venta`, `cantidad`) VALUES
(1, 'Azitromicina', 'Sidus', 'Blister, antibiotico contra bacterias.', 1, 130.00, 175.50, 100),
(2, 'Pantoprazol', 'Stada', 'Blister para erosiones y ulceras.', 1, 125.00, 160.00, 100),
(3, 'Metamusil', 'Unilever', 'Fibra para mejorar la digestion', 2, 62.25, 93.75, 50),
(5, 'Lomotil', 'Mosfertum', 'Tabletas para regular la digestion, diarreas, etc.', 5, 96.50, 112.00, 80),
(18, 'Nuevo', 'Nuevo', 'Nuevo medicamento', 5, 10.00, 15.50, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombres` varchar(60) COLLATE utf16_bin DEFAULT NULL,
  `apellidos` varchar(60) COLLATE utf16_bin DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(8) COLLATE utf16_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf16_bin DEFAULT NULL,
  `correo_electronico` varchar(60) COLLATE utf16_bin DEFAULT NULL,
  `id_medicamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `id_puesto` int(11) NOT NULL,
  `puesto` varchar(30) COLLATE utf16_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`id_puesto`, `puesto`) VALUES
(1, 'Medico'),
(2, 'Enfermero'),
(3, 'Recepcionista'),
(4, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rama_medica`
--

CREATE TABLE `rama_medica` (
  `id_rama_medica` int(11) NOT NULL,
  `rama` varchar(30) COLLATE utf16_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `rama_medica`
--

INSERT INTO `rama_medica` (`id_rama_medica`, `rama`) VALUES
(1, 'Dermatologia'),
(2, 'Cardeologia'),
(3, 'Nutriologia'),
(4, 'Pediatria'),
(5, 'Ginecologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Empleado'),
(4, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_sucursal` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf16_bin DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf16_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id_sucursal`, `nombre`, `direccion`) VALUES
(1, 'San Andres', '8va calle No.75, Antigua Guatemala'),
(2, 'Antilia', 'Residencial Los Cedros, Ciudad de Guatemala'),
(5, 'Pilar', '10ma avenida No.35, Escuintla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `nombres`, `apellidos`, `password`, `id_rol`) VALUES
(1, 'admin@gmail.com', 'Admin', 'Admin', 'admin123', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_rama_medica` (`id_rama_medica`),
  ADD KEY `id_empleado [medico]` (`id_empleado`);

--
-- Indices de la tabla `detalle_citas`
--
ALTER TABLE `detalle_citas`
  ADD PRIMARY KEY (`id_detalle_cita`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_puesto` (`id_puesto`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `habitacion_reservada`
--
ALTER TABLE `habitacion_reservada`
  ADD PRIMARY KEY (`id_habitacion_ocupada`),
  ADD KEY `id_habitación` (`id_habitacion`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD PRIMARY KEY (`id_historial_medico`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_empleado [medico]` (`id_empleado`);

--
-- Indices de la tabla `lotes_medicina`
--
ALTER TABLE `lotes_medicina`
  ADD PRIMARY KEY (`id_lote_medicina`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`id_medicamento`),
  ADD KEY `id_lote_medicina` (`id_lote_medicina`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_medicamento` (`id_medicamento`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`id_puesto`);

--
-- Indices de la tabla `rama_medica`
--
ALTER TABLE `rama_medica`
  ADD PRIMARY KEY (`id_rama_medica`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id_sucursal`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `detalle_citas`
--
ALTER TABLE `detalle_citas`
  MODIFY `id_detalle_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `habitacion_reservada`
--
ALTER TABLE `habitacion_reservada`
  MODIFY `id_habitacion_ocupada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  MODIFY `id_historial_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `lotes_medicina`
--
ALTER TABLE `lotes_medicina`
  MODIFY `id_lote_medicina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rama_medica`
--
ALTER TABLE `rama_medica`
  MODIFY `id_rama_medica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_rama_medica`) REFERENCES `rama_medica` (`id_rama_medica`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `detalle_citas`
--
ALTER TABLE `detalle_citas`
  ADD CONSTRAINT `detalle_citas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `detalle_citas_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `detalle_citas_ibfk_3` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  ADD CONSTRAINT `detalle_citas_ibfk_4` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id_cita`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_puesto`) REFERENCES `puestos` (`id_puesto`);

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`);

--
-- Filtros para la tabla `habitacion_reservada`
--
ALTER TABLE `habitacion_reservada`
  ADD CONSTRAINT `habitacion_reservada_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`),
  ADD CONSTRAINT `habitacion_reservada_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);

--
-- Filtros para la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD CONSTRAINT `historial_medico_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `historial_medico_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD CONSTRAINT `medicamento_ibfk_1` FOREIGN KEY (`id_lote_medicina`) REFERENCES `lotes_medicina` (`id_lote_medicina`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamento` (`id_medicamento`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
