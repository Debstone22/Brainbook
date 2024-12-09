-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2024 a las 00:03:21
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
-- Base de datos: `brainbook3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `version` int(11) DEFAULT 1,
  `imagen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre_curso`, `descripcion`, `status`, `version`, `imagen`) VALUES
(7, 'Introducción a la Programación', 'Curso básico para aprender los fundamentos de la programación.', 1, 1, 'uploads/programacion.jpg'),
(8, 'Estructuras de Datos', 'Curso avanzado para aprender a manejar estructuras de datos.', 1, 1, 'uploads/grafos.jpeg'),
(9, 'Bases de Datos I', 'Curso intermedio para aprender sobre bases de datos relacionales.', 0, 1, 'uploads/database.jpg'),
(10, 'Redes de Computadoras', 'Curso avanzado sobre redes y protocolos de comunicación.', 0, 1, 'uploads/network.jpg'),
(11, 'Desarrollo Web', 'Curso básico para aprender a crear sitios web.', 0, 1, 'uploads/webDeveloper.jpg'),
(21, 'Inteligencia Artificial', 'Curso avanzado sobre técnicas y aplicaciones de la inteligencia artificial.', 0, 1, 'uploads/tapioca.jpg'),
(23, 'Álgebra Lineal', 'Estudio de sistemas de ecuaciones lineales, matrices, determinantes, espacios vectoriales y transformaciones lineales.', 1, 2, 'uploads/algebra-e1577465340342.jpg'),
(24, 'Física General', 'Exploración de los conceptos fundamentales de la física, incluyendo mecánica, termodinámica, electromagnetismo y óptica.', 1, 3, 'fisica_general.jpg'),
(25, 'Química Orgánica', 'Estudio de la estructura, propiedades y reacciones de los compuestos orgánicos.', 0, 1, 'quimica_organica.jpg'),
(26, 'Cálculo Diferencial e Integral', 'Introducción a los conceptos de límites, derivadas, integrales y sus aplicaciones en diversas áreas de las ciencias e ingeniería.', 1, 4, 'calculo_diferencial.jpg'),
(27, 'Historia del Arte', 'Análisis de la evolución del arte a lo largo de la historia, desde la antigüedad hasta el arte contemporáneo.', 1, 2, 'historia_arte.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_estudiante`
--

CREATE TABLE `curso_estudiante` (
  `id_cursoestudiante` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso_estudiante`
--

INSERT INTO `curso_estudiante` (`id_cursoestudiante`, `id_curso`, `id_usuario`) VALUES
(1, 7, 8),
(2, 9, 8),
(3, 8, 8),
(4, 21, 8),
(5, 23, 8),
(6, 26, 8),
(7, 25, 19),
(8, 10, 19),
(9, 7, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_profesor`
--

CREATE TABLE `curso_profesor` (
  `id_curso` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso_profesor`
--

INSERT INTO `curso_profesor` (`id_curso`, `id_profesor`) VALUES
(7, 1),
(8, 2),
(9, 1),
(10, 3),
(21, 2),
(23, 3),
(25, 5),
(26, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_semana`
--

CREATE TABLE `curso_semana` (
  `id_cursosemana` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_semana` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `pdf_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso_semana`
--

INSERT INTO `curso_semana` (`id_cursosemana`, `id_curso`, `id_semana`, `titulo`, `descripcion`, `pdf_url`) VALUES
(1, 7, 1, 'Introducción al curso', 'Descripción de la semana 1: Introducción al curso y conceptos básicos de programación.', 'semana1.pdf'),
(2, 7, 2, 'Variables y Tipos de Datos', 'Descripción de la semana 2: Variables, tipos de datos y operaciones básicas.', 'semana2.pdf'),
(3, 7, 3, 'Estructuras de Control', 'Descripción de la semana 3: Estructuras de control como condicionales y bucles.', 'semana3.pdf'),
(4, 7, 4, 'Funciones y Procedimientos', 'Descripción de la semana 4: Definición y uso de funciones y procedimientos.', 'https://example.com/curso7/semana4.pdf'),
(5, 7, 5, 'Listas y Arreglos', 'Descripción de la semana 5: Introducción a listas y arreglos en programación.', 'https://example.com/curso7/semana5.pdf'),
(6, 7, 6, 'Manejo de Cadenas de Texto', 'Descripción de la semana 6: Manipulación y uso de cadenas de texto.', 'https://example.com/curso7/semana6.pdf'),
(7, 7, 7, 'Entrada y Salida de Datos', 'Descripción de la semana 7: Técnicas para la entrada y salida de datos en programas.', 'https://example.com/curso7/semana7.pdf'),
(8, 7, 8, 'Archivos y Persistencia de Datos', 'Descripción de la semana 8: Manejo de archivos y persistencia de datos.', 'https://example.com/curso7/semana8.pdf'),
(9, 7, 9, 'Programación Orientada a Objetos', 'Descripción de la semana 9: Conceptos básicos de programación orientada a objetos (POO).', 'https://example.com/curso7/semana9.pdf'),
(10, 7, 10, 'Clases y Objetos', 'Descripción de la semana 10: Creación y uso de clases y objetos.', 'https://example.com/curso7/semana10.pdf'),
(11, 7, 11, 'Herencia y Polimorfismo', 'Descripción de la semana 11: Principios de herencia y polimorfismo en POO.', 'https://example.com/curso7/semana11.pdf'),
(12, 7, 12, 'Excepciones y Manejo de Errores', 'Descripción de la semana 12: Manejo de excepciones y errores en programas.', 'https://example.com/curso7/semana12.pdf'),
(13, 7, 13, 'Estructuras de Datos Avanzadas', 'Descripción de la semana 13: Introducción a estructuras de datos avanzadas.', 'https://example.com/curso7/semana13.pdf'),
(14, 7, 14, 'Algoritmos y Complejidad', 'Descripción de la semana 14: Algoritmos y análisis de complejidad.', 'https://example.com/curso7/semana14.pdf'),
(15, 7, 15, 'Proyectos Prácticos', 'Descripción de la semana 15: Desarrollo de proyectos prácticos de programación.', 'https://example.com/curso7/semana15.pdf'),
(16, 7, 16, 'Revisión y Mejora de Código', 'Descripción de la semana 16: Técnicas de revisión y mejora de código.', 'https://example.com/curso7/semana16.pdf'),
(17, 7, 17, 'Preparación para el Examen Final', 'Descripción de la semana 17: Preparación y repaso para el examen final.', 'https://example.com/curso7/semana17.pdf'),
(18, 7, 18, 'Conclusiones y Evaluación', 'Descripción de la semana 18: Conclusiones del curso y evaluación final.', 'https://example.com/curso7/semana18.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id_log` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `accion` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `texto_comentario` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `leido` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id_profesor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id_profesor`, `nombre`, `apellido`, `email`, `password`, `edad`, `celular`) VALUES
(1, 'Ana', 'Pérez', 'ana.perez@example.com', 'password123', 35, '987654321'),
(2, 'Juan', 'García', 'juan.garcia@example.com', 'password123', 42, '987654322'),
(3, 'María', 'López', 'maria.lopez@example.com', 'password123', 30, '987654323'),
(4, 'Carlos', 'Hernández', 'carlos.hernandez@example.com', 'password123', 45, '987654324'),
(5, 'Laura', 'Martínez', 'laura.martinez@example.com', 'password123', 28, '987654325');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE `progreso` (
  `id_progreso` int(11) NOT NULL,
  `id_cursoestudiante` int(11) NOT NULL,
  `id_cursosemana` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen`
--

CREATE TABLE `resumen` (
  `id_resumen` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_semana` int(11) NOT NULL,
  `contenido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'usuario', 'usuario base, sin privilegios'),
(2, 'profesor', 'acceso parcial a los privilegios'),
(3, 'administrador', 'control total sobre la aplicacion web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semana`
--

CREATE TABLE `semana` (
  `id_semana` int(11) NOT NULL,
  `numero_semana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `semana`
--

INSERT INTO `semana` (`id_semana`, `numero_semana`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `edad` tinyint(4) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_rol`, `nombre`, `apellido`, `email`, `password`, `edad`, `celular`) VALUES
(1, 3, 'Luis', 'Garcia', 'U21221971', '$2y$10$ESUMTjN0Fjgd1cU/D/ofK.sOs/i9C/6mAGBpJ4alaOsBp2HM69gr6', 25, '+51987654321'),
(2, 1, 'Maria', 'Lopez', 'U22221972', 'ola', 21, '+51912345678'),
(3, 1, 'Roberto', 'Fernandez', 'U21221975', 'carlos789', 30, '+51911223344'),
(4, 1, 'Lucia', 'Perez', 'U21261930', 'luciaPass321', 22, '+51999887766'),
(8, 3, 'Elder', 'Cardoza', 'U21221969', '$2y$10$uG.IWsBdXf80rQGMrMN3S.2wVzBKdDHfRVTHz7ka.K86ZRUDPzHDi', 20, '999333777'),
(12, 2, 'Pedro', 'Ramirez', 'U21123456', 'hola', 35, '+51987654321'),
(13, 1, 'Laura', 'Martinez', 'U21765432', 'mundo', 28, '+51923456789'),
(14, 2, 'Juan', 'Hernandez', 'U21345678', 'pass1234', 30, '+51901234567'),
(15, 1, 'Sofia', 'Torres', 'U21987654', 'password1234', 26, '+51987654322'),
(16, 2, 'Carlos', 'Gomez', 'U21123457', 'qwerty', 40, '+51912345679'),
(17, 1, 'Ana', 'Mendoza', 'U21765433', 'asd1234', 33, '+51923456790'),
(19, 3, 'Jairo', 'Saavedra', 'U21303267', '$2y$10$kDeMynElYSxwugPT7iV1o.k4epC1TyeW.TAcTCs99XA/0I8Eglbd.', 65, '+51929884768');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `curso_estudiante`
--
ALTER TABLE `curso_estudiante`
  ADD PRIMARY KEY (`id_cursoestudiante`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `curso_profesor`
--
ALTER TABLE `curso_profesor`
  ADD PRIMARY KEY (`id_curso`,`id_profesor`),
  ADD KEY `id_profesor` (`id_profesor`);

--
-- Indices de la tabla `curso_semana`
--
ALTER TABLE `curso_semana`
  ADD PRIMARY KEY (`id_cursosemana`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_semana` (`id_semana`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id_profesor`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD KEY `id_cursoestudiante` (`id_cursoestudiante`),
  ADD KEY `id_cursosemana` (`id_cursosemana`);

--
-- Indices de la tabla `resumen`
--
ALTER TABLE `resumen`
  ADD PRIMARY KEY (`id_resumen`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_semana` (`id_semana`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `semana`
--
ALTER TABLE `semana`
  ADD PRIMARY KEY (`id_semana`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `curso_estudiante`
--
ALTER TABLE `curso_estudiante`
  MODIFY `id_cursoestudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `curso_semana`
--
ALTER TABLE `curso_semana`
  MODIFY `id_cursosemana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `resumen`
--
ALTER TABLE `resumen`
  MODIFY `id_resumen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semana`
--
ALTER TABLE `semana`
  MODIFY `id_semana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso_estudiante`
--
ALTER TABLE `curso_estudiante`
  ADD CONSTRAINT `curso_estudiante_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_estudiante_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `curso_profesor`
--
ALTER TABLE `curso_profesor`
  ADD CONSTRAINT `curso_profesor_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `curso_profesor_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id_profesor`);

--
-- Filtros para la tabla `curso_semana`
--
ALTER TABLE `curso_semana`
  ADD CONSTRAINT `curso_semana_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `curso_semana_ibfk_2` FOREIGN KEY (`id_semana`) REFERENCES `semana` (`id_semana`);

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD CONSTRAINT `progreso_ibfk_1` FOREIGN KEY (`id_cursoestudiante`) REFERENCES `curso_estudiante` (`id_cursoestudiante`),
  ADD CONSTRAINT `progreso_ibfk_2` FOREIGN KEY (`id_cursosemana`) REFERENCES `curso_semana` (`id_cursosemana`);

--
-- Filtros para la tabla `resumen`
--
ALTER TABLE `resumen`
  ADD CONSTRAINT `resumen_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `resumen_ibfk_2` FOREIGN KEY (`id_semana`) REFERENCES `semana` (`id_semana`),
  ADD CONSTRAINT `resumen_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
