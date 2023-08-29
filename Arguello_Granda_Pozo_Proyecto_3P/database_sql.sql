-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2023 a las 02:34:07
-- Versión del servidor: 10.6.14-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u900659423_citaviso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` mediumtext DEFAULT NULL,
  `dateadd` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `cedula`, `nombre`, `telefono`, `direccion`, `dateadd`, `usuario_id`, `estatus`) VALUES
(1, '1710202449', 'Joel Argue2', '2132', 'Caldaron', '2023-08-26 16:39:31', 1, 1),
(2, '1755231683', 'Marco Antonio Solis', '3223', '232', '2023-08-27 22:27:21', 1, 1),
(3, '1755231683', 'Josein Castro', '12', '123', '2023-08-27 22:29:21', 1, 1);

--
-- Disparadores `cliente`
--
DELIMITER $$
CREATE TRIGGER `insert_client_i` AFTER INSERT ON `cliente` FOR EACH ROW BEGIN
    INSERT INTO client_i (id_cliente, cedula, nombre, telefono, direccion, dateadd, usuario_id)
    VALUES (NEW.id_cliente, NEW.cedula, NEW.nombre, NEW.telefono, NEW.direccion, NEW.dateadd, NEW.usuario_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_i`
--

CREATE TABLE `client_i` (
  `id_cliente` int(11) NOT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `dateadd` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `client_i`
--

INSERT INTO `client_i` (`id_cliente`, `cedula`, `nombre`, `telefono`, `direccion`, `dateadd`, `usuario_id`) VALUES
(3, '1755231683', 'jOEL', '12', NULL, '2023-08-27 22:29:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_log_update`
--

CREATE TABLE `client_log_update` (
  `id_change` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `old_cedula` varchar(20) DEFAULT NULL,
  `new_cedula` varchar(20) DEFAULT NULL,
  `old_name` varchar(100) DEFAULT NULL,
  `new_name` varchar(100) DEFAULT NULL,
  `old_tel` varchar(15) DEFAULT NULL,
  `new_tel` varchar(15) DEFAULT NULL,
  `old_dir` varchar(200) DEFAULT NULL,
  `new_dir` varchar(200) DEFAULT NULL,
  `dateadd` datetime DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `client_log_update`
--

INSERT INTO `client_log_update` (`id_change`, `id_client`, `old_cedula`, `new_cedula`, `old_name`, `new_name`, `old_tel`, `new_tel`, `old_dir`, `new_dir`, `dateadd`, `usuario_id`) VALUES
(1, 1, '1710202449', '1710202449', 'Joasdl', 'Joel Arguello', '232', '2132', 'Caldaron', 'Caldaron', '2023-08-23 01:27:43', 1),
(2, 2, '1755231683', '1755231683', 'Marco Antonio', 'Marco Antonio Solis', '12', '3223', '232', '232', '2023-08-25 01:27:52', 1),
(3, 3, '1755231683', '1755231683', 'Jos123', 'Josein Castro', '12', '12', 'Miguel', '123', '2023-08-28 01:28:03', 1),
(4, 1, '1710202449', '1710202449', 'Joel Arguello', 'Joel Argue2', '2132', '2132', 'Caldaron', 'Caldaron', '2023-08-28 01:32:20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_xml_pdf`
--

CREATE TABLE `config_xml_pdf` (
  `id` bigint(20) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `direccion` text NOT NULL,
  `iva` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_log`
--

CREATE TABLE `login_log` (
  `id_log` int(11) NOT NULL,
  `usuario_id` varchar(45) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `user_ip` varchar(45) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `login_log`
--

INSERT INTO `login_log` (`id_log`, `usuario_id`, `accion`, `user_ip`, `date`) VALUES
(1, '1', 'Inicio sesión', '157.100.87.222', '2023-08-26'),
(2, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(3, '1', 'Inicio sesión', '157.100.87.222', '2023-08-26'),
(4, '1', 'Inicio sesión', '157.100.87.222', '2023-08-26'),
(5, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(6, '1', 'Inicio sesión', '157.100.87.222', '2023-08-26'),
(7, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(8, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(9, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(10, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(11, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(12, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(13, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(14, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(15, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(16, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(17, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(18, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(19, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(20, '1', 'Inicio sesión', 'Loopback', '2023-08-26'),
(21, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(22, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(23, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(24, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(25, '1', 'Inicio sesión', '2800:bf0:2a2:11fd:acf3:d1bd:33da:2107', '2023-08-27'),
(26, '1', 'Inicio sesión', '186.42.1.139', '2023-08-27'),
(27, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(28, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(29, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(30, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(31, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(32, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(33, '1', 'Inicio sesión', '186.42.1.139', '2023-08-27'),
(34, '1', 'Inicio sesión', '157.100.87.222', '2023-08-27'),
(35, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(36, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(37, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(38, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(39, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(40, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(41, '4', 'Inicio sesión', 'Loopback', '2023-08-27'),
(42, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(43, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(44, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(45, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(46, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(47, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(48, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(49, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(50, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(51, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(52, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(53, '8', 'Inicio sesión', 'Loopback', '2023-08-27'),
(54, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(55, '8', 'Inicio sesión', 'Loopback', '2023-08-27'),
(56, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(57, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(58, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(59, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(60, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(61, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(62, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(63, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(64, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(65, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(66, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(67, '1', 'Inicio sesión', '2800:bf0:2a2:11fd:b10d:a872:f23d:7b50', '2023-08-27'),
(68, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(69, '1', 'Inicio sesión', '157.100.87.222', '2023-08-27'),
(70, '1', 'Inicio sesión', '157.100.87.222', '2023-08-27'),
(71, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(72, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(73, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(74, '1', 'Inicio sesión', 'Loopback', '2023-08-27'),
(75, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(76, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(77, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(78, '16', 'Inicio sesión', 'Loopback', '2023-08-28'),
(79, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(80, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(81, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(82, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(83, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(84, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(85, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(86, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(87, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(88, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(89, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(90, '1', 'Inicio sesión', 'Loopback', '2023-08-28'),
(91, '1', 'Inicio sesión', '186.42.1.139', '2023-08-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `user_id`, `customer_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Joel Arguello', '2023-08-27 06:20:27', '2023-08-27 06:20:27'),
(2, 1, 'Joel Arguello', '2023-08-27 06:21:11', '2023-08-27 06:21:11'),
(3, 1, 'Joel Arguello', '2023-08-27 06:23:40', '2023-08-27 06:23:40'),
(4, 1, 'Joel Arguello', '2023-08-27 06:24:17', '2023-08-27 06:24:17'),
(5, 1, 'Joel Arguello', '2023-08-27 06:31:27', '2023-08-27 06:31:27'),
(6, 1, 'Joel Arguello', '2023-08-27 06:38:37', '2023-08-27 06:38:37'),
(7, 1, 'Joel Arguello', '2023-08-27 07:03:47', '2023-08-27 07:03:47'),
(8, 1, 'Joel Arguello', '2023-08-27 22:09:50', '2023-08-27 22:09:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_recetas`
--

CREATE TABLE `ordenes_recetas` (
  `orden_id` int(11) NOT NULL,
  `receta_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `existencia` float DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `descripcion`, `proveedor`, `precio`, `existencia`, `date_add`, `usuario_id`, `estatus`) VALUES
(1, 'Madera', 2, 1.00, 69, '2023-08-27 06:19:46', 1, 1),
(2, 'Tornillo', 1, 0.12, 100, '2023-08-27 08:19:02', 1, 1),
(3, 'Tabla Triplex', 1, 15.00, 50, '2023-08-27 08:19:02', 1, 1),
(4, 'Martillo', 1, 8.00, 75, '2023-08-27 08:19:02', 1, 1),
(5, 'Destornillador', 1, 2.50, 120, '2023-08-27 08:19:02', 1, 1),
(6, 'Sierra Circular', 1, 75.00, 20, '2023-08-27 08:19:02', 1, 1),
(7, 'Cinta Métrica', 1, 4.00, 90, '2023-08-27 08:19:02', 1, 1),
(8, 'Pintura Blanca', 1, 20.00, 30, '2023-08-27 08:19:02', 1, 1),
(9, 'Llave Ajustable', 1, 10.00, 60, '2023-08-27 08:19:02', 1, 1),
(10, 'Pegamento Multiuso', 1, 3.00, 80, '2023-08-27 08:19:02', 1, 1),
(11, 'Cepillo de Carpintero', 1, 12.00, 40, '2023-08-27 08:19:02', 1, 1),
(12, 'Perno', 1, 0.20, 150, '2023-08-27 08:19:02', 1, 1),
(13, 'Serrucho', 1, 20.00, 25, '2023-08-27 08:19:02', 1, 1),
(14, 'Guantes de Trabajo', 1, 1.50, 110, '2023-08-27 08:19:02', 1, 1),
(15, 'Clavos de Acero', 1, 0.05, 200, '2023-08-27 08:19:02', 1, 1),
(16, 'Nivel de Burbuja', 1, 5.00, 70, '2023-08-27 08:19:02', 1, 1),
(17, 'Lijadora Eléctrica', 1, 60.00, 15, '2023-08-27 08:19:02', 1, 1),
(18, 'Escalera Plegable', 1, 35.00, 10, '2023-08-27 08:19:02', 1, 1),
(19, 'Cinta Adhesiva', 1, 0.50, 180, '2023-08-27 08:19:02', 1, 1),
(20, 'Pincel para Pintura', 1, 1.50, 95, '2023-08-27 08:19:02', 1, 1),
(21, 'Gafas de Seguridad', 1, 2.00, 130, '2023-08-27 08:19:02', 1, 1),
(22, 'Destornillador Phillips', 1, 2.00, 100, '2023-08-27 08:19:41', 1, 1),
(23, 'Taladro Inalámbrico', 1, 120.00, 30, '2023-08-27 08:19:41', 1, 1),
(24, 'Llave Inglesa', 1, 6.00, 80, '2023-08-27 08:19:41', 1, 1),
(25, 'Pala de Jardín', 1, 15.00, 40, '2023-08-27 08:19:41', 1, 1),
(26, 'Caja de Clavos', 1, 3.00, 150, '2023-08-27 08:19:41', 1, 1),
(27, 'Sierra de Mano', 1, 10.00, 60, '2023-08-27 08:19:41', 1, 1),
(28, 'Pintura Roja', 1, 18.00, 25, '2023-08-27 08:19:41', 1, 1),
(29, 'Tijeras de Podar', 1, 8.00, 70, '2023-08-27 08:19:41', 1, 1),
(30, 'Cemento de Reparación', 1, 5.00, 90, '2023-08-27 08:19:41', 1, 1),
(31, 'Cincel', 1, 3.50, 110, '2023-08-27 08:19:41', 1, 1),
(32, 'Lápiz de Carpintero', 1, 1.00, 200, '2023-08-27 08:19:41', 1, 1),
(33, 'Llave de Tubo', 1, 8.00, 45, '2023-08-27 08:19:41', 1, 1),
(34, 'Guantes de Jardinería', 1, 2.50, 120, '2023-08-27 08:19:41', 1, 1),
(35, 'Cinta de Enmascarar', 1, 1.50, 180, '2023-08-27 08:19:41', 1, 1),
(36, 'Nivel Láser', 1, 45.00, 15, '2023-08-27 08:19:41', 1, 1),
(37, 'Escoba de Cerdas Duras', 1, 7.00, 20, '2023-08-27 08:19:41', 1, 1),
(38, 'Máscara de Protección', 1, 1.00, 250, '2023-08-27 08:19:41', 1, 1),
(39, 'Llave Allen Set', 1, 10.00, 65, '2023-08-27 08:19:41', 1, 1),
(40, 'Cemento de Secado Rápido', 1, 7.00, 85, '2023-08-27 08:19:41', 1, 1),
(41, 'Serrucho de Corte Fino', 1, 15.00, 30, '2023-08-27 08:19:41', 1, 1),
(42, 'Pegamento para Madera', 1, 4.00, 110, '2023-08-27 08:19:41', 1, 1),
(43, 'Cinta de Doble Cara', 1, 0.80, 200, '2023-08-27 08:19:41', 1, 1),
(44, 'Gafas de Protección UV', 1, 3.00, 100, '2023-08-27 08:19:41', 1, 1),
(45, 'Martillo de Carpintero', 1, 12.00, 50, '2023-08-27 08:19:41', 1, 1),
(46, 'Aceite para Madera', 1, 5.00, 70, '2023-08-27 08:19:41', 1, 1),
(47, 'Cepillo de Alambre', 1, 2.50, 120, '2023-08-27 08:19:41', 1, 1),
(48, 'Cepillo para Paredes', 1, 4.00, 90, '2023-08-27 08:19:41', 1, 1),
(49, 'Alicate de Corte', 1, 6.00, 110, '2023-08-27 08:19:41', 1, 1),
(50, 'Caja de Herramientas Grande', 1, 30.00, 10, '2023-08-27 08:19:41', 1, 1),
(51, 'Candado de Seguridad', 1, 8.00, 75, '2023-08-27 08:19:41', 1, 1),
(52, 'Pistola de Calor', 1, 25.00, 25, '2023-08-27 08:19:41', 1, 1),
(53, 'Cinta de Teflón', 1, 1.00, 150, '2023-08-27 08:21:08', 1, 1),
(54, 'Llave de Grifo', 1, 5.00, 90, '2023-08-27 08:21:08', 1, 1),
(55, 'Martillo de Goma', 1, 10.00, 40, '2023-08-27 08:21:08', 1, 1),
(56, 'Destornillador de Precisión', 1, 3.00, 120, '2023-08-27 08:21:08', 1, 1),
(57, 'Lámpara de Trabajo LED', 1, 15.00, 30, '2023-08-27 08:21:08', 1, 1),
(58, 'Tornillo Autoperforante', 1, 0.20, 200, '2023-08-27 08:21:08', 1, 1),
(59, 'Taladro de Impacto', 1, 140.00, 20, '2023-08-27 08:21:08', 1, 1),
(60, 'Máscara Respiratoria', 1, 4.00, 80, '2023-08-27 08:21:08', 1, 1),
(61, 'Adhesivo Epoxi', 1, 6.00, 60, '2023-08-27 08:21:08', 1, 1),
(62, 'Alambre de Acero', 1, 2.00, 150, '2023-08-27 08:21:08', 1, 1),
(63, 'Lija de Grano Fino', 1, 1.50, 180, '2023-08-27 08:21:08', 1, 1),
(64, 'Cepillo Metálico', 1, 3.00, 110, '2023-08-27 08:21:08', 1, 1),
(65, 'Candado de Combinación', 1, 10.00, 70, '2023-08-27 08:21:08', 1, 1),
(66, 'Tornillo de Anclaje', 1, 0.30, 130, '2023-08-27 08:21:08', 1, 1),
(67, 'Guantes Resistentes a Cortes', 1, 4.00, 100, '2023-08-27 08:21:08', 1, 1),
(68, 'Pistola de Silicona', 1, 8.00, 50, '2023-08-27 08:21:08', 1, 1),
(69, 'Serrucho Plegable', 1, 18.00, 25, '2023-08-27 08:21:08', 1, 1),
(70, 'Llave de Impacto', 1, 25.00, 15, '2023-08-27 08:21:08', 1, 1),
(71, 'Caja de Almacenamiento', 1, 5.00, 80, '2023-08-27 08:21:08', 1, 1),
(72, 'Aceite Lubricante', 1, 3.00, 120, '2023-08-27 08:21:08', 1, 1),
(73, 'Escalera de Extensión', 1, 50.00, 10, '2023-08-27 08:21:08', 1, 1),
(74, 'Tornillo de Ojo', 1, 1.00, 180, '2023-08-27 08:21:08', 1, 1),
(75, 'Broca de Madera', 1, 2.50, 150, '2023-08-27 08:21:08', 1, 1),
(76, 'Pala Plegable', 1, 12.00, 40, '2023-08-27 08:21:08', 1, 1),
(77, 'Herramienta de Desbarbado', 1, 6.00, 70, '2023-08-27 08:21:08', 1, 1),
(78, 'Papel de Lija', 1, 1.00, 200, '2023-08-27 08:21:08', 1, 1),
(79, 'Gafas de Visión Nocturna', 1, 20.00, 20, '2023-08-27 08:21:08', 1, 1),
(80, 'Sierra de Calar', 1, 30.00, 30, '2023-08-27 08:21:08', 1, 1),
(81, 'Taladro de Banco', 1, 180.00, 10, '2023-08-27 08:21:08', 1, 1),
(82, 'Cepillo de Limpieza', 1, 2.00, 100, '2023-08-27 08:21:08', 1, 1),
(83, 'Nivel de Torpedo', 1, 5.00, 65, '2023-08-27 08:21:08', 1, 1),
(84, 'Broca de Metal', 1, 3.00, 120, '2023-08-27 08:21:08', 1, 1),
(85, 'Ollas', 4, 12.00, 12, '2023-08-27 16:01:13', 1, 1),
(86, 'Ollas2', 3, 123.00, 123, '2023-08-27 16:01:42', 1, 1),
(87, 'Ollas3', 3, 21.00, 12, '2023-08-27 16:02:17', 1, 1),
(88, 'Madera', 4, 12.00, 12, '2023-08-27 16:05:02', 1, 1),
(89, '1', 3, 12.00, 12, '2023-08-27 16:06:10', 1, 1),
(90, 'asd', 3, 12.00, 12, '2023-08-27 16:07:26', 1, 1),
(91, 'Laca', 2, 20.00, 300, '2023-08-27 17:05:17', 1, 1),
(92, 'Clavos 10mm', 1, 0.50, 400, '2023-08-27 17:09:21', 1, 1);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `insert_product_i` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    INSERT INTO `product_i` (id_producto, name, supplier, price, stock, id_user)
    VALUES (NEW.codproducto, NEW.descripcion, NEW.proveedor, NEW.precio, NEW.existencia, NEW.usuario_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_i`
--

CREATE TABLE `product_i` (
  `id_producto` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `supplier` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `product_i`
--

INSERT INTO `product_i` (`id_producto`, `name`, `supplier`, `price`, `stock`, `date_add`, `id_user`) VALUES
(1, 'Madera', 2, 1.00, 12, '2023-08-27 06:19:46', 1),
(2, 'Tornillo', 1, 0.10, 100, '2023-08-24 08:19:02', 1),
(3, 'Tabla Triplex', 1, 15.00, 50, '2023-08-27 08:19:02', 1),
(4, 'Martillo', 1, 8.00, 75, '2023-08-27 08:19:02', 1),
(5, 'Destornillador', 1, 2.50, 120, '2023-08-27 08:19:02', 1),
(6, 'Sierra Circular', 1, 75.00, 20, '2023-08-27 08:19:02', 1),
(7, 'Cinta Métrica', 1, 4.00, 90, '2023-08-27 08:19:02', 1),
(8, 'Pintura Blanca', 1, 20.00, 30, '2023-08-27 08:19:02', 1),
(9, 'Llave Ajustable', 1, 10.00, 60, '2023-08-27 08:19:02', 1),
(10, 'Pegamento Multiuso', 1, 3.00, 80, '2023-08-27 08:19:02', 1),
(11, 'Cepillo de Carpintero', 1, 12.00, 40, '2023-08-27 08:19:02', 1),
(12, 'Perno', 1, 0.20, 150, '2023-08-27 08:19:02', 1),
(13, 'Serrucho', 1, 20.00, 25, '2023-08-27 08:19:02', 1),
(14, 'Guantes de Trabajo', 1, 1.50, 110, '2023-08-27 08:19:02', 1),
(15, 'Clavos de Acero', 1, 0.05, 200, '2023-08-27 08:19:02', 1),
(16, 'Nivel de Burbuja', 1, 5.00, 70, '2023-08-27 08:19:02', 1),
(17, 'Lijadora Eléctrica', 1, 60.00, 15, '2023-08-27 08:19:02', 1),
(18, 'Escalera Plegable', 1, 35.00, 10, '2023-08-27 08:19:02', 1),
(19, 'Cinta Adhesiva', 1, 0.50, 180, '2023-08-27 08:19:02', 1),
(20, 'Pincel para Pintura', 1, 1.50, 95, '2023-08-27 08:19:02', 1),
(21, 'Gafas de Seguridad', 1, 2.00, 130, '2023-08-27 08:19:02', 1),
(22, 'Destornillador Phillips', 1, 2.00, 100, '2023-08-27 08:19:41', 1),
(23, 'Taladro Inalámbrico', 1, 120.00, 30, '2023-08-27 08:19:41', 1),
(24, 'Llave Inglesa', 1, 6.00, 80, '2023-08-27 08:19:41', 1),
(25, 'Pala de Jardín', 1, 15.00, 40, '2023-08-27 08:19:41', 1),
(26, 'Caja de Clavos', 1, 3.00, 150, '2023-08-27 08:19:41', 1),
(27, 'Sierra de Mano', 1, 10.00, 60, '2023-08-27 08:19:41', 1),
(28, 'Pintura Roja', 1, 18.00, 25, '2023-08-27 08:19:41', 1),
(29, 'Tijeras de Podar', 1, 8.00, 70, '2023-08-27 08:19:41', 1),
(30, 'Cemento de Reparación', 1, 5.00, 90, '2023-08-27 08:19:41', 1),
(31, 'Cincel', 1, 3.50, 110, '2023-08-27 08:19:41', 1),
(32, 'Lápiz de Carpintero', 1, 1.00, 200, '2023-08-27 08:19:41', 1),
(33, 'Llave de Tubo', 1, 8.00, 45, '2023-08-27 08:19:41', 1),
(34, 'Guantes de Jardinería', 1, 2.50, 120, '2023-08-27 08:19:41', 1),
(35, 'Cinta de Enmascarar', 1, 1.50, 180, '2023-08-27 08:19:41', 1),
(36, 'Nivel Láser', 1, 45.00, 15, '2023-08-27 08:19:41', 1),
(37, 'Escoba de Cerdas Duras', 1, 7.00, 20, '2023-08-27 08:19:41', 1),
(38, 'Máscara de Protección', 1, 1.00, 250, '2023-08-27 08:19:41', 1),
(39, 'Llave Allen Set', 1, 10.00, 65, '2023-08-27 08:19:41', 1),
(40, 'Cemento de Secado Rápido', 1, 7.00, 85, '2023-08-27 08:19:41', 1),
(41, 'Serrucho de Corte Fino', 1, 15.00, 30, '2023-08-27 08:19:41', 1),
(42, 'Pegamento para Madera', 1, 4.00, 110, '2023-08-27 08:19:41', 1),
(43, 'Cinta de Doble Cara', 1, 0.80, 200, '2023-08-27 08:19:41', 1),
(44, 'Gafas de Protección UV', 1, 3.00, 100, '2023-08-27 08:19:41', 1),
(45, 'Martillo de Carpintero', 1, 12.00, 50, '2023-08-27 08:19:41', 1),
(46, 'Aceite para Madera', 1, 5.00, 70, '2023-08-27 08:19:41', 1),
(47, 'Cepillo de Alambre', 1, 2.50, 120, '2023-08-27 08:19:41', 1),
(48, 'Cepillo para Paredes', 1, 4.00, 90, '2023-08-27 08:19:41', 1),
(49, 'Alicate de Corte', 1, 6.00, 110, '2023-08-27 08:19:41', 1),
(50, 'Caja de Herramientas Grande', 1, 30.00, 10, '2023-08-27 08:19:41', 1),
(51, 'Candado de Seguridad', 1, 8.00, 75, '2023-08-27 08:19:41', 1),
(52, 'Pistola de Calor', 1, 25.00, 25, '2023-08-27 08:19:41', 1),
(53, 'Cinta de Teflón', 1, 1.00, 150, '2023-08-27 08:21:08', 1),
(54, 'Llave de Grifo', 1, 5.00, 90, '2023-08-27 08:21:08', 1),
(55, 'Martillo de Goma', 1, 10.00, 40, '2023-08-27 08:21:08', 1),
(56, 'Destornillador de Precisión', 1, 3.00, 120, '2023-08-27 08:21:08', 1),
(57, 'Lámpara de Trabajo LED', 1, 15.00, 30, '2023-08-27 08:21:08', 1),
(58, 'Tornillo Autoperforante', 1, 0.20, 200, '2023-08-27 08:21:08', 1),
(59, 'Taladro de Impacto', 1, 140.00, 20, '2023-08-27 08:21:08', 1),
(60, 'Máscara Respiratoria', 1, 4.00, 80, '2023-08-27 08:21:08', 1),
(61, 'Adhesivo Epoxi', 1, 6.00, 60, '2023-08-27 08:21:08', 1),
(62, 'Alambre de Acero', 1, 2.00, 150, '2023-08-27 08:21:08', 1),
(63, 'Lija de Grano Fino', 1, 1.50, 180, '2023-08-27 08:21:08', 1),
(64, 'Cepillo Metálico', 1, 3.00, 110, '2023-08-27 08:21:08', 1),
(65, 'Candado de Combinación', 1, 10.00, 70, '2023-08-27 08:21:08', 1),
(66, 'Tornillo de Anclaje', 1, 0.30, 130, '2023-08-27 08:21:08', 1),
(67, 'Guantes Resistentes a Cortes', 1, 4.00, 100, '2023-08-27 08:21:08', 1),
(68, 'Pistola de Silicona', 1, 8.00, 50, '2023-08-27 08:21:08', 1),
(69, 'Serrucho Plegable', 1, 18.00, 25, '2023-08-27 08:21:08', 1),
(70, 'Llave de Impacto', 1, 25.00, 15, '2023-08-27 08:21:08', 1),
(71, 'Caja de Almacenamiento', 1, 5.00, 80, '2023-08-27 08:21:08', 1),
(72, 'Aceite Lubricante', 1, 3.00, 120, '2023-08-27 08:21:08', 1),
(73, 'Escalera de Extensión', 1, 50.00, 10, '2023-08-27 08:21:08', 1),
(74, 'Tornillo de Ojo', 1, 1.00, 180, '2023-08-27 08:21:08', 1),
(75, 'Broca de Madera', 1, 2.50, 150, '2023-08-27 08:21:08', 1),
(76, 'Pala Plegable', 1, 12.00, 40, '2023-08-27 08:21:08', 1),
(77, 'Herramienta de Desbarbado', 1, 6.00, 70, '2023-08-27 08:21:08', 1),
(78, 'Papel de Lija', 1, 1.00, 200, '2023-08-27 08:21:08', 1),
(79, 'Gafas de Visión Nocturna', 1, 20.00, 20, '2023-08-27 08:21:08', 1),
(80, 'Sierra de Calar', 1, 30.00, 30, '2023-08-27 08:21:08', 1),
(81, 'Taladro de Banco', 1, 180.00, 10, '2023-08-27 08:21:08', 1),
(82, 'Cepillo de Limpieza', 1, 2.00, 100, '2023-08-27 08:21:08', 1),
(83, 'Nivel de Torpedo', 1, 5.00, 65, '2023-08-27 08:21:08', 1),
(84, 'Broca de Metal', 1, 3.00, 120, '2023-08-27 08:21:08', 1),
(85, 'Ollas', 4, 12.00, 12, '2023-08-27 16:01:13', 1),
(86, 'Ollas2', 3, 123.00, 123, '2023-08-27 16:01:42', 1),
(87, 'Ollas3', 3, 21.00, 12, '2023-08-27 16:02:17', 1),
(88, 'Madera', 4, 12.00, 12, '2023-08-27 16:05:02', 1),
(89, '1', 3, 12.00, 12, '2023-08-27 16:06:10', 1),
(90, 'asd', 3, 12.00, 12, '2023-08-27 16:07:26', 1),
(91, 'Laca', 2, 20.00, 300, '2023-08-27 17:05:17', 1),
(92, 'Clavos 10mm', 1, 0.50, 400, '2023-08-27 17:09:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_log_update`
--

CREATE TABLE `product_log_update` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `cambios` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cambios`)),
  `old_price` decimal(10,2) DEFAULT NULL,
  `new_price` decimal(10,2) DEFAULT NULL,
  `old_supplier` int(11) DEFAULT NULL,
  `new_supplier` int(11) DEFAULT NULL,
  `old_stock` int(11) DEFAULT NULL,
  `new_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `product_log_update`
--

INSERT INTO `product_log_update` (`id`, `producto_id`, `usuario_id`, `fecha_registro`, `cambios`, `old_price`, `new_price`, `old_supplier`, `new_supplier`, `old_stock`, `new_stock`) VALUES
(1, 1, 1, '2023-08-27 07:48:07', '{\"precio\":{\"anterior\":\"1.00\",\"nuevo\":\"1.01\"},\"proveedor\":{\"anterior\":\"2\",\"nuevo\":\"1\"},\"stock\":{\"anterior\":\"69\",\"nuevo\":70}}', 1.00, 1.01, 2, 1, 69, 70),
(2, 1, 1, '2023-08-27 07:48:27', '{\"precio\":{\"anterior\":\"1.01\",\"nuevo\":\"1\"},\"proveedor\":{\"anterior\":\"1\",\"nuevo\":\"2\"},\"stock\":{\"anterior\":\"70\",\"nuevo\":71}}', 1.01, 1.00, 1, 2, 70, 71),
(3, 2, 1, '2023-08-27 08:59:02', '{\"precio\":{\"anterior\":\"0.10\",\"nuevo\":\"0.13\"},\"proveedor\":{\"anterior\":\"1\",\"nuevo\":\"1\"},\"stock\":{\"anterior\":\"100\",\"nuevo\":\"100\"}}', 0.10, 0.13, 1, 1, 100, 100),
(4, 2, 1, '2023-08-27 08:59:13', '{\"precio\":{\"anterior\":\"0.13\",\"nuevo\":\"0.12\"},\"proveedor\":{\"anterior\":\"1\",\"nuevo\":\"1\"},\"stock\":{\"anterior\":\"100\",\"nuevo\":\"100\"}}', 0.13, 0.12, 1, 1, 100, 100),
(5, 1, 1, '2023-08-27 23:48:25', '{\"precio\":{\"anterior\":\"1.00\",\"nuevo\":\"1.00\"},\"proveedor\":{\"anterior\":\"2\",\"nuevo\":\"2\"},\"stock\":{\"anterior\":\"69\",\"nuevo\":\"69\"}}', 1.00, 1.00, 2, 2, 69, 69);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_supplier` int(11) NOT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `correo` varchar(320) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_supplier`, `cedula`, `proveedor`, `contacto`, `correo`, `telefono`, `direccion`, `date_add`, `usuario_id`, `estatus`) VALUES
(1, '1', '1', '1', '1', 1, '1', '2023-08-28 01:57:36', 1, 1),
(2, '1755231683', 'Tec', 'As As', '123asd@asdasd.com', 1, '1', '2023-08-28 02:01:52', 1, 1),
(3, '1755231683', 'Tec', 'As As', '123asd@asdasd.com', 1, '1', '2023-08-28 02:10:20', 1, 1),
(4, '1755231683', 'Tec', 'Joel Daniel', 'joel@gmail.com', 998500498, 'pjoel123', '2023-08-28 02:10:53', 1, 1),
(5, '1755231683', 'Tec', 'Joel Daniel', 'joel@gmail.com', 998500498, 'pjoel123', '2023-08-28 02:12:49', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `recipe`
--

INSERT INTO `recipe` (`id`, `user_id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(2, 1, 'Silla', 16.50, '2023-08-27 23:40:07', '2023-08-27 23:40:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rule_recipe`
--

CREATE TABLE `rule_recipe` (
  `id_recipe` int(11) NOT NULL,
  `id_product_rule` int(11) NOT NULL,
  `cantidad` double NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `rule_recipe`
--

INSERT INTO `rule_recipe` (`id_recipe`, `id_product_rule`, `cantidad`) VALUES
(2, 1, 5),
(2, 2, 10),
(2, 4, 1),
(2, 32, 1),
(2, 66, 1),
(2, 78, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(1, 'admin', 'admin_citaviso@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(3, 'jefferson analuisa', 'stevenpozo0111@gmail.com', 'steven1', '81dc9bdb52d04dc20036dbd8313ed055', 3, 0),
(13, 'Jose Luis', 'jose@asdasd.com', 'jose', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1),
(14, 'Cristina Cabezas', 'asd@asd.com', 'jasd', '7815696ecbf1c96e6894b779456d330e', 1, 1),
(15, 'carlos Granda', 'cgranda2@gmail.com', 'carlos', 'b3fb82829585e08ee183c052cc078c55', 2, 1),
(16, 'steven pozo', 'stevenpozo0999@gmail.com', 'steven', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `client_i`
--
ALTER TABLE `client_i`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `client_log_update`
--
ALTER TABLE `client_log_update`
  ADD PRIMARY KEY (`id_change`);

--
-- Indices de la tabla `config_xml_pdf`
--
ALTER TABLE `config_xml_pdf`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes_recetas`
--
ALTER TABLE `ordenes_recetas`
  ADD PRIMARY KEY (`orden_id`,`receta_id`),
  ADD KEY `receta_id_fk_idx` (`receta_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`),
  ADD KEY `proveedor` (`proveedor`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `product_i`
--
ALTER TABLE `product_i`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `product_log_update`
--
ALTER TABLE `product_log_update`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk_idx` (`user_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `rule_recipe`
--
ALTER TABLE `rule_recipe`
  ADD PRIMARY KEY (`id_recipe`,`id_product_rule`),
  ADD KEY `producto_id_fk_idx` (`id_product_rule`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `client_log_update`
--
ALTER TABLE `client_log_update`
  MODIFY `id_change` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `login_log`
--
ALTER TABLE `login_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `product_i`
--
ALTER TABLE `product_i`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `product_log_update`
--
ALTER TABLE `product_log_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_recetas`
--
ALTER TABLE `ordenes_recetas`
  ADD CONSTRAINT `ordenes_recetas_orden_id_fk` FOREIGN KEY (`orden_id`) REFERENCES `ordenes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordenes_recetas_receta_id_fk` FOREIGN KEY (`receta_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `product_log_update`
--
ALTER TABLE `product_log_update`
  ADD CONSTRAINT `product_log_update_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`codproducto`),
  ADD CONSTRAINT `product_log_update_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rule_recipe`
--
ALTER TABLE `rule_recipe`
  ADD CONSTRAINT `producto_id_fk` FOREIGN KEY (`id_product_rule`) REFERENCES `producto` (`codproducto`),
  ADD CONSTRAINT `receta_id_fk` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
