CREATE DATABASE IF NOT EXISTS tecnica;
USE tecnica;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2026 a las 04:24:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1770674356),
('editor', '10', 1770688330),
('editor', '6', 1770674655),
('editor', '8', 1770682782),
('product.create', '10', 1770688330),
('product.update', '10', 1770688330),
('product.view', '10', 1770688330),
('viewer', '7', 1770676185);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1770674356, 1770674356),
('editor', 1, NULL, NULL, NULL, 1770674356, 1770674356),
('product.create', 2, 'Crear productos', NULL, NULL, 1770674356, 1770674356),
('product.delete', 2, 'Eliminar productos', NULL, NULL, 1770674356, 1770674356),
('product.update', 2, 'Actualizar productos', NULL, NULL, 1770674356, 1770674356),
('product.view', 2, 'Ver productos', NULL, NULL, 1770674356, 1770674356),
('userCreate', 2, 'Crear usuarios', NULL, NULL, 1770674356, 1770674356),
('userDelete', 2, 'Eliminar usuarios', NULL, NULL, 1770674356, 1770674356),
('userUpdate', 2, 'Actualizar usuarios', NULL, NULL, 1770674356, 1770674356),
('userView', 2, 'Ver usuarios', NULL, NULL, 1770674356, 1770674356),
('viewer', 1, NULL, NULL, NULL, 1770674356, 1770674356);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'product.create'),
('admin', 'product.delete'),
('admin', 'product.update'),
('admin', 'product.view'),
('admin', 'userCreate'),
('admin', 'userDelete'),
('admin', 'userUpdate'),
('admin', 'userView'),
('editor', 'product.create'),
('editor', 'product.update'),
('editor', 'product.view'),
('editor', 'userUpdate'),
('editor', 'userView'),
('viewer', 'product.view'),
('viewer', 'userView');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1770656510),
('m130524_201442_init', 1770656513),
('m140506_102106_rbac_init', 1770658906),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1770658906),
('m180523_151638_rbac_updates_indexes_without_prefix', 1770658906),
('m190124_110200_add_verification_token_column_to_user_table', 1770656513),
('m200409_110543_rbac_update_mssql_trigger', 1770658906),
('m260209_171123_create_admin_user', 1770657596),
('m260209_174155_rbac_init', 1770659340),
('m260209_174914_assign_admin_role', 1770659530),
('m260209_175543_rbac_permissions', 1770659876),
('m260209_183638_create_product_table', 1770662281);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `sku` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `sku`, `price`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(2, 'lonchera', 'ninguna por el momento ', '123AF', 50.00, 50, 1, 1770663457, 1770663457),
(3, 'gggg', 'gggg', '123234r', 45.00, 34, 1, 1770675247, 1770675247),
(4, 'bbbbb', 'aaaa', '12242sgdfg', 20.00, 10, 1, 1770685013, 1770685022),
(5, 'lonchera kids', 'lonchera infantil', 'LK001', 35.00, 40, 1, 1770700001, 1770700001),
(6, 'termo acero', 'termo térmico 500ml', 'TA002', 18.50, 25, 1, 1770700002, 1770700002),
(7, 'mochila escolar', 'mochila mediana', 'ME003', 45.00, 30, 1, 1770700003, 1770700003),
(8, 'cartuchera', 'cartuchera básica', 'CB004', 8.00, 60, 1, 1770700004, 1770700004),
(9, 'botella agua', 'botella plástica', 'BA005', 6.50, 80, 1, 1770700005, 1770700005),
(10, 'lonchera térmica', 'mantiene alimentos calientes', 'LT006', 55.00, 20, 1, 1770700006, 1770700006),
(11, 'mochila grande', 'mochila para colegio', 'MG007', 60.00, 15, 1, 1770700007, 1770700007),
(12, 'set cubiertos', 'cubiertos reutilizables', 'SC008', 5.00, 100, 1, 1770700008, 1770700008),
(13, 'vaso térmico', 'vaso con tapa', 'VT009', 12.00, 35, 1, 1770700009, 1770700009),
(14, 'bolsa almuerzo', 'bolsa ecológica', 'BA010', 9.50, 50, 1, 1770700010, 1770700010),
(15, 'lonchera juvenil', 'diseño juvenil', 'LJ011', 48.00, 22, 1, 1770700011, 1770700011),
(16, 'mochila deportiva', 'uso diario', 'MD012', 52.00, 18, 1, 1770700012, 1770700012),
(17, 'envase hermético', 'plástico resistente', 'EH013', 4.75, 120, 1, 1770700013, 1770700013),
(18, 'set lunch', 'lonchera + termo', 'SL014', 65.00, 12, 1, 1770700014, 1770700014),
(19, 'termo kids', 'termo infantil', 'TK015', 15.00, 28, 1, 1770700015, 1770700015),
(20, 'bolso térmico', 'bolso porta alimentos', 'BT016', 38.00, 16, 1, 1770700016, 1770700016),
(21, 'mochila pequeña', 'ideal para niños', 'MP017', 32.00, 26, 1, 1770700017, 1770700017),
(22, 'lonchera premium', 'material reforzado', 'LP018', 70.00, 10, 1, 1770700018, 1770700018),
(23, 'botella acero', 'botella inoxidable', 'BA019', 14.00, 45, 1, 1770700019, 1770700019),
(24, 'kit escolar', 'mochila + lonchera', 'KE020', 95.00, 8, 1, 1770700020, 1770700020);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', '', '$2y$13$KE0.UA6fMFK9tX/U2Aa.zeAjTE67mmq9c8ZcigZQEDOwT2LtkyyJu', NULL, 'admin@admin.com', 10, 1770657596, 1770659592, NULL),
(6, 'editor', '', '$2y$13$/4FKKQH9MK8FNuFPxts1M.fpJrx9J1H0LubSzKNfl3WcadRrWWxOC', NULL, 'editor@demo.com', 10, 1770664412, 1770664412, NULL),
(7, 'viewer', '', '$2y$13$/4FKKQH9MK8FNuFPxts1M.fpJrx9J1H0LubSzKNfl3WcadRrWWxOC', NULL, 'viewer@demo.com', 10, 1770664412, 1770664412, NULL),
(8, 'karla', 'zxigTLfd_GZab_uT56rN8LDGKuSFEvNs', '$2y$13$F/uZop3dtbhpShPjI64XKuIeoncqM0s2WJljx1egzBpyFZDL4VfJO', NULL, 'karla0979@gmail.com', 10, 1770681290, 1770681290, NULL),
(9, 'prueba', 'Y2tRVMrVAk_8UXLksa7hOISnWxz3g0BI', '$2y$13$YRwE9kk5in0PHaLQrUACJ.aqQzNJVllOqQpdA7gSRDzvGJypxyhOK', NULL, 'prueba@gmail.com', 10, 1770682064, 1770686381, NULL),
(10, 'luna', 'v4gsxNIePE3qGRR8TNrCIk_BJ0puqAy8', '$2y$13$vAlDiSEIefgocNed1R4lGeRJ3hIzdp8T0qeEB20BV.Lic9aNskoaS', NULL, 'luna@gmail.com', 10, 1770682841, 1770684988, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `idx-product-sku` (`sku`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
