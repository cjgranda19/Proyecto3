-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: facturacion
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `idcliente` int NOT NULL AUTO_INCREMENT,
  `nit` varchar(10) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` text,
  `dateadd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int NOT NULL,
  `estatus` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcliente`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (15,'1122334455','Robert Lewandowski','1998877665','Barcelona','2023-02-20 18:05:22',1,1),(16,'2211009933','Cristiano Ronaldo','0981234561','Liga de camellos, Arabia Saudita','2023-02-20 18:10:27',1,1),(17,'7181912929','Julián Álvarez','0917732738','Manchester, Inglaterra','2023-02-20 18:28:30',1,1),(18,'7812718221','Ousmane Dembélé','0961827162','Catalunya, España','2023-02-22 22:07:08',1,1),(19,'4216251126','Julio Jaramillo','0972890012','Quito, Ecuador','2023-02-22 22:13:34',1,1),(20,'2165216251','Roberto Firmino','0917261111','Liverpool, Inglaterra','2023-02-22 22:16:17',1,1),(21,'111','Juan Mariano Mercedes Carrera','1234567','dwdawdawdd','2023-02-26 23:32:24',1,0),(22,'9879283792','adawdwad','12','awdawdawd','2023-02-26 23:33:56',1,0);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id` bigint NOT NULL,
  `nit` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `direccion` text NOT NULL,
  `iva` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (0,'0123456789','DIEGO\'S WAFFLES ASSOCIATION','Wafflea con Dieguín ;)','0987654321','ejemplo@gmail.com','Quito - Pichincha - Ecuador',12);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_temp`
--

DROP TABLE IF EXISTS `detalle_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `detalle_temp` (
  `correlativo` int NOT NULL AUTO_INCREMENT,
  `token_user` varchar(50) NOT NULL,
  `codproducto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  PRIMARY KEY (`correlativo`),
  KEY `nofactura` (`token_user`),
  KEY `codproducto` (`codproducto`),
  CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_temp`
--

LOCK TABLES `detalle_temp` WRITE;
/*!40000 ALTER TABLE `detalle_temp` DISABLE KEYS */;
INSERT INTO `detalle_temp` VALUES (92,'c4ca4238a0b923820dcc509a6f75849b',1,1,0.10),(93,'c4ca4238a0b923820dcc509a6f75849b',20,1,0.90),(94,'c4ca4238a0b923820dcc509a6f75849b',25,1,1.00);
/*!40000 ALTER TABLE `detalle_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallefactura`
--

DROP TABLE IF EXISTS `detallefactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `detallefactura` (
  `correlativo` bigint NOT NULL AUTO_INCREMENT,
  `nofactura` bigint DEFAULT NULL,
  `codproducto` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`correlativo`),
  KEY `codproducto` (`codproducto`),
  KEY `nofactura` (`nofactura`),
  CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallefactura`
--

LOCK TABLES `detallefactura` WRITE;
/*!40000 ALTER TABLE `detallefactura` DISABLE KEYS */;
INSERT INTO `detallefactura` VALUES (42,14,1,3,0.10),(43,14,20,2,0.90),(44,14,21,1,1.00),(45,14,23,3,0.80),(49,15,20,4,0.90),(50,15,21,3,1.00),(51,15,22,1,0.50),(52,15,23,9,0.80),(53,15,25,1,1.00),(56,16,1,1,0.10),(57,16,20,4,0.90),(58,16,29,3,2.50),(59,17,1,1,0.10),(60,17,20,10,0.90),(61,17,23,4,0.80);
/*!40000 ALTER TABLE `detallefactura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradas`
--

DROP TABLE IF EXISTS `entradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `entradas` (
  `correlativo` int NOT NULL AUTO_INCREMENT,
  `codproducto` int NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`correlativo`),
  KEY `codproducto` (`codproducto`),
  CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas`
--

LOCK TABLES `entradas` WRITE;
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
INSERT INTO `entradas` VALUES (1,1,'2023-02-21 11:13:10',10,4.00,1),(20,20,'2023-02-28 16:21:43',50,0.90,1),(21,21,'2023-02-28 17:09:47',70,1.00,1),(22,22,'2023-02-28 17:13:18',50,0.50,1),(23,23,'2023-02-28 17:16:07',70,0.80,1),(24,24,'2023-02-28 17:18:58',60,0.55,1),(25,25,'2023-02-28 17:20:46',60,1.00,1),(26,26,'2023-02-28 17:26:45',20,4.00,1),(27,27,'2023-02-28 17:27:52',1000,0.05,1),(28,28,'2023-02-28 22:51:46',50,0.20,1),(29,29,'2023-03-01 10:42:45',50,2.50,1);
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `factura` (
  `nofactura` bigint NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` int DEFAULT NULL,
  `codcliente` int DEFAULT NULL,
  `totalfactura` decimal(10,2) DEFAULT NULL,
  `estatus` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`nofactura`),
  KEY `usuario` (`usuario`),
  KEY `codcliente` (`codcliente`),
  CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`codcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (14,'2023-02-28 18:11:52',1,15,5.50,1),(15,'2023-02-28 22:56:00',1,19,15.30,1),(16,'2023-03-01 10:48:13',1,15,11.20,1),(17,'2023-03-02 22:09:40',1,15,12.30,1);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordenes`
--

DROP TABLE IF EXISTS `ordenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `ordenes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes`
--

LOCK TABLES `ordenes` WRITE;
/*!40000 ALTER TABLE `ordenes` DISABLE KEYS */;
INSERT INTO `ordenes` VALUES (14,1,'John Doe','2023-03-08 06:58:59','2023-03-08 06:58:59'),(15,13,'Jeimmy Tinoco','2023-03-08 07:04:23','2023-03-08 07:04:23');
/*!40000 ALTER TABLE `ordenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordenes_recetas`
--

DROP TABLE IF EXISTS `ordenes_recetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `ordenes_recetas` (
  `orden_id` int NOT NULL,
  `receta_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`orden_id`,`receta_id`),
  KEY `receta_id_fk_idx` (`receta_id`) /*!80000 INVISIBLE */,
  CONSTRAINT `ordenes_recetas_orden_id_fk` FOREIGN KEY (`orden_id`) REFERENCES `ordenes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ordenes_recetas_receta_id_fk` FOREIGN KEY (`receta_id`) REFERENCES `recetas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes_recetas`
--

LOCK TABLES `ordenes_recetas` WRITE;
/*!40000 ALTER TABLE `ordenes_recetas` DISABLE KEYS */;
INSERT INTO `ordenes_recetas` VALUES (14,19,1),(15,20,2);
/*!40000 ALTER TABLE `ordenes_recetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `codproducto` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `proveedor` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `existencia` float DEFAULT NULL,
  `medida_pro` varchar(20) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int NOT NULL,
  `inventario_id` int DEFAULT NULL,
  `estatus` int NOT NULL DEFAULT '1',
  `foto` text,
  PRIMARY KEY (`codproducto`),
  KEY `proveedor` (`proveedor`),
  KEY `usuario_id` (`usuario_id`),
  KEY `inventario_id` (`inventario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Banano',12,0.10,67,'Unidades','2023-02-21 11:13:10',1,NULL,1,'img_6d7ce5001f6839b0045f5e0014f88f84.jpg'),(20,'Leche',5,0.90,38,'Litros','2023-02-28 16:21:43',1,NULL,1,'img_5a75eef73980485c181a29b00ba841e2.jpg'),(21,'Azúcar',7,1.00,45.68,'Kilogramos','2023-02-28 17:09:47',1,NULL,1,'img_845691928e108c53369bc368d609fc12.jpg'),(22,'Sal',9,0.50,48,'Kilogramos','2023-02-28 17:13:18',1,NULL,1,'img_fc7850a2010a608bde3dbb8c9af18478.jpg'),(23,'Fresa',12,0.80,42,'Libras','2023-02-28 17:16:07',1,NULL,1,'img_4c76951893e8189d07cdef4c9bec3440.jpg'),(24,'Harina',1,0.55,54.1,'Kilogramos','2023-02-28 17:18:58',1,NULL,1,'img_49706ab087e97120fc743798fc3ffff7.jpg'),(25,'Leche condensada',5,1.00,51,'Litros','2023-02-28 17:20:46',1,NULL,1,'img_aa20c86127045e52eb3061e836dd4784.jpg'),(26,'Polvo para hornear',7,4.00,19.6,'Libras','2023-02-28 17:26:45',1,NULL,1,'img_producto.png'),(27,'Huevo',9,0.05,917,'Unidades','2023-02-28 17:27:52',1,NULL,1,'img_25abcd9048856e2f68efc041130ef1f4.jpg'),(28,'Kiwi',12,0.20,46.88,'Unidades','2023-02-28 22:51:46',1,NULL,1,'img_f3b58d00a2f40183020ed7b6b9b7671e.jpg'),(29,'Mantequilla',12,2.50,47,'Kilogramos','2023-03-01 10:42:45',1,NULL,1,'img_e36248484c373c441276e249c333e604.jpg');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `codproveedor` int NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` bigint DEFAULT NULL,
  `direccion` text,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int NOT NULL,
  `estatus` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`codproveedor`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'BIC','Claudia Rosales',789877889,'Avenida las Americas','2023-02-20 23:13:48',0,1),(5,'Olimpia S.A','Elena Franco Morales',564535676,'5ta. Avenida Zona 4 Ciudad','2023-02-20 23:13:48',0,1),(7,'ACELTECSA S.A','Ruben PÃ©rez',789879889,'Colonia las Victorias','2023-02-20 23:13:48',0,1),(9,'VAIO','Felix Arnoldo Rojas',476378276,'Avenida las Americas Zona 13','2023-02-20 23:13:48',0,1),(12,'Víveres Panchita','María Francisca Mercedes',1823823712,'La Gasca','2023-02-20 23:50:22',1,1);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receta_producto`
--

DROP TABLE IF EXISTS `receta_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `receta_producto` (
  `receta_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `cantidad` double NOT NULL DEFAULT '1',
  PRIMARY KEY (`receta_id`,`producto_id`),
  KEY `producto_id_fk_idx` (`producto_id`),
  CONSTRAINT `producto_id_fk` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`codproducto`),
  CONSTRAINT `receta_id_fk` FOREIGN KEY (`receta_id`) REFERENCES `recetas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receta_producto`
--

LOCK TABLES `receta_producto` WRITE;
/*!40000 ALTER TABLE `receta_producto` DISABLE KEYS */;
INSERT INTO `receta_producto` VALUES (19,1,1),(19,20,1),(19,24,0.2),(19,27,2),(20,21,0.5),(20,23,4),(20,24,1.5),(20,26,0.2),(20,27,10);
/*!40000 ALTER TABLE `receta_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recetas`
--

DROP TABLE IF EXISTS `recetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `recetas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fk_idx` (`user_id`),
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recetas`
--

LOCK TABLES `recetas` WRITE;
/*!40000 ALTER TABLE `recetas` DISABLE KEYS */;
INSERT INTO `recetas` VALUES (19,1,'waffle',1.21,'','2023-03-08 06:58:34','2023-03-08 06:58:34'),(20,13,'Waffle Jeimmy ',5.83,'recipe_1678258990.JPG','2023-03-08 07:03:10','2023-03-08 07:03:10');
/*!40000 ALTER TABLE `recetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `idrol` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador'),(2,'Supervisor'),(3,'Vendedor');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int DEFAULT NULL,
  `estatus` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  KEY `rol` (`rol`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Danielito','daniel@gmail.com','danielito123','202cb962ac59075b964b07152d234b70',1,1),(3,'Jeimmy Tinoco','jey@gmail.com','jey456','250cf8b51c773f3f8dc8b4be867a9a02',3,0),(4,'Diego Torres','diego@gmail.com','die456','250cf8b51c773f3f8dc8b4be867a9a02',3,1),(5,'Román Riquelme','roman@gmail.com','roman123','202cb962ac59075b964b07152d234b70',1,1),(6,'Leonel Messi','leo@gmail.com','leo123','202cb962ac59075b964b07152d234b70',3,1),(7,'Maria Del Carmen','maria@gmail.com','maria123','202cb962ac59075b964b07152d234b70',2,1),(8,'Juan Schotto','juan@gmail.com','juan123','202cb962ac59075b964b07152d234b70',1,1),(9,'Martha Hidalgo','martha@gmail.com','martha123','81dc9bdb52d04dc20036dbd8313ed055',2,1),(10,'Belén Amores','belen123@gmail.com','2','202cb962ac59075b964b07152d234b70',3,1),(11,'Kevin De Bryune','kevin3@gmail.com','3','81dc9bdb52d04dc20036dbd8313ed055',1,1),(12,'Rosario Tijerass','rosario@gmail.com','ros123','202cb962ac59075b964b07152d234b70',3,1),(13,'Admin','admin@gmail.com','admin','21232f297a57a5a743894a0e4a801fc3',1,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-08  2:14:19
