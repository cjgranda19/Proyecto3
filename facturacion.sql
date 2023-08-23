

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";







CREATE DATABASE IF NOT EXISTS `u900659423_citaviso` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `u900659423_citaviso`;



CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `dateadd` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



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



CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



CREATE TABLE `ordenes_recetas` (
  `orden_id` int(11) NOT NULL,
  `receta_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `existencia` float DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `date_edit` date DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DELIMITER $$
CREATE TRIGGER `insert_producto_i` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    INSERT INTO `producto-i` (id_producto, name, supplier, price, stock, id_user)
    VALUES (NEW.codproducto, NEW.descripcion, NEW.proveedor, NEW.precio, NEW.existencia, NEW.usuario_id);
END
$$
DELIMITER ;



CREATE TABLE `producto-i` (
  `id_producto` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `supplier` int(10) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `date_add` date NOT NULL DEFAULT current_timestamp(),
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



CREATE TABLE `product_log` (
  `id_producto_i` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `supplier` int(10) NOT NULL,
  `new_price` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



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



CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Vendedor');



CREATE TABLE `rule_recipe` (
  `id_recipe` int(11) NOT NULL,
  `id_product_rule` int(11) NOT NULL,
  `cantidad` double NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;


INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(1, 'admin', NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1);


ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `usuario_id` (`usuario_id`);

ALTER TABLE `config_xml_pdf`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ordenes_recetas`
  ADD PRIMARY KEY (`orden_id`,`receta_id`),
  ADD KEY `receta_id_fk_idx` (`receta_id`);

ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`),
  ADD KEY `proveedor` (`proveedor`),
  ADD KEY `usuario_id` (`usuario_id`);

ALTER TABLE `producto-i`
  ADD PRIMARY KEY (`id_producto`);

ALTER TABLE `product_log`
  ADD PRIMARY KEY (`id_producto_i`);

ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `usuario_id` (`usuario_id`);

ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk_idx` (`user_id`);

ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

ALTER TABLE `rule_recipe`
  ADD PRIMARY KEY (`id_recipe`,`id_product_rule`),
  ADD KEY `producto_id_fk_idx` (`id_product_rule`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);


ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `producto-i`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `product_log`
  MODIFY `id_producto_i` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `proveedor`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ordenes_recetas`
  ADD CONSTRAINT `ordenes_recetas_orden_id_fk` FOREIGN KEY (`orden_id`) REFERENCES `ordenes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordenes_recetas_receta_id_fk` FOREIGN KEY (`receta_id`) REFERENCES `recipe` (`id`) ON DELETE CASCADE;

ALTER TABLE `recipe`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE;

ALTER TABLE `rule_recipe`
  ADD CONSTRAINT `producto_id_fk` FOREIGN KEY (`id_product_rule`) REFERENCES `producto` (`codproducto`),
  ADD CONSTRAINT `receta_id_fk` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id`);
COMMIT;




