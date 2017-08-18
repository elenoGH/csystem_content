-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: csystem
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_compras_cliente`
--

DROP TABLE IF EXISTS `tbl_compras_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_compras_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL,
  `id_contenido_as` int(11) DEFAULT NULL,
  `tipo_contenido_comprado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_compras_cliente`
--

LOCK TABLES `tbl_compras_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_compras_cliente` DISABLE KEYS */;
INSERT INTO `tbl_compras_cliente` VALUES (1,27,26,59,'articulo'),(2,27,26,19,'serie'),(3,27,26,55,'articulo'),(4,27,28,62,'articulo'),(5,27,26,53,'articulo'),(6,27,26,54,'articulo'),(8,27,28,63,'articulo'),(9,27,26,21,'serie'),(10,29,26,60,'articulo'),(11,29,28,61,'articulo'),(12,29,26,20,'serie');
/*!40000 ALTER TABLE `tbl_compras_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contenido_escritor`
--

DROP TABLE IF EXISTS `tbl_contenido_escritor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contenido_escritor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_topico` int(11) DEFAULT NULL,
  `id_tipo_publicacion` int(3) DEFAULT NULL COMMENT '1 -> Articulos, 2 -> Series;',
  `id_serie_escritor` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `post_to_enmbedded_text` varchar(600) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `path_source` varchar(100) DEFAULT NULL,
  `red_social` varchar(100) DEFAULT NULL,
  `tipo_source` varchar(100) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `etiquetas` varchar(100) DEFAULT NULL,
  `referencias` varchar(500) DEFAULT NULL,
  `estatus` varchar(20) DEFAULT NULL,
  `created_date` int(15) DEFAULT NULL,
  `modified_date` int(15) DEFAULT NULL,
  `precio_contenido` int(20) DEFAULT NULL,
  `tipo_moneda` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contenido_escritor`
--

LOCK TABLES `tbl_contenido_escritor` WRITE;
/*!40000 ALTER TABLE `tbl_contenido_escritor` DISABLE KEYS */;
INSERT INTO `tbl_contenido_escritor` VALUES (53,26,8,NULL,0,'Planetary Protection Offecer','Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem.','http://php.net','../../../assets/media/dir_source/img_source_martin_1502926123.png','facebook','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893950792863850496','comprado',1502926123,1502926123,20,NULL),(54,26,10,NULL,0,'El Aborto en Números','Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem.','http://php.net','../../../assets/media/dir_source/img_source_martin_1502926167.jpg','twitter','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/894627252989710337','comprado',1502926167,1502926167,25,NULL),(55,26,9,NULL,0,'Dolor de Caballo','','http://php.net','../../../assets/media/dir_source/img_source_martin_1502926197.jpg','instagram','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893283170635849730','comprado',1502926197,1502926197,5,NULL),(56,26,7,NULL,19,'Método de Seleccion','','http://php.net','../../../assets/media/dir_source/img_source_martin_1502926307.jpg','instagram','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893298145215434753','espera',1502926307,1502926307,5,NULL),(57,26,7,NULL,19,'Dedaso.','Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem.','http://php.net','../../../assets/media/dir_source/img_source_martin_1502926391.jpg','facebook','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/894627252989710337','espera',1502926391,1502926391,40,NULL),(58,26,7,NULL,19,'Ajuste de..','Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem.','http://php.net','../../../assets/media/dir_source/img_source_martin_1502926495.jpg','twitter','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/894627252989710337','espera',1502926495,1502926495,80,NULL),(59,26,7,NULL,0,'El Aborto en Números','Lorem Ipsum ','http://php.net','../../../assets/media/dir_source/img_source_martin_1502983597.jpg','facebook','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893283170635849730','comprado',1502983597,1502983597,5,NULL),(60,26,9,NULL,0,'El mas rapido del mundo','','http://php.net','../../../assets/media/dir_source/img_source_martin_1502983978.jpg','instagram','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893283170635849730','espera',1502983978,1502984051,8,NULL),(61,28,7,NULL,0,'Modo de seleccion PRI','','http://php.net','../../../assets/media/dir_source/img_source_eleno_1502993861.jpg','instagram','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893283170635849730','espera',1502993861,1502993861,20,NULL),(62,28,3,NULL,0,'La compra de Petroleo','Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem.','http://php.net','../../../assets/media/dir_source/img_source_eleno_1502993901.jpg','twitter','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/','comprado',1502993901,1502993901,5,NULL),(63,28,8,NULL,0,'stay curious','','http://php.net','../../../assets/media/dir_source/img_source_eleno_1502993949.jpg','instagram','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/894627252989710337','comprado',1502993949,1502993949,8,NULL);
/*!40000 ALTER TABLE `tbl_contenido_escritor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rol`
--

DROP TABLE IF EXISTS `tbl_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `rol` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rol`
--

LOCK TABLES `tbl_rol` WRITE;
/*!40000 ALTER TABLE `tbl_rol` DISABLE KEYS */;
INSERT INTO `tbl_rol` VALUES (1,1,'admin'),(2,2,'autor'),(3,3,'cliente');
/*!40000 ALTER TABLE `tbl_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_serie_escritor`
--

DROP TABLE IF EXISTS `tbl_serie_escritor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_serie_escritor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_topico` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `post_to_enmbedded_text` varchar(600) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `path_source` varchar(100) DEFAULT NULL,
  `red_social` varchar(100) DEFAULT NULL,
  `tipo_source` varchar(100) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `etiquetas` varchar(100) DEFAULT NULL,
  `referencias` varchar(500) DEFAULT NULL,
  `estatus` varchar(20) DEFAULT NULL,
  `created_date` int(15) DEFAULT NULL,
  `modified_date` int(15) DEFAULT NULL,
  `precio_serie` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_serie_escritor`
--

LOCK TABLES `tbl_serie_escritor` WRITE;
/*!40000 ALTER TABLE `tbl_serie_escritor` DISABLE KEYS */;
INSERT INTO `tbl_serie_escritor` VALUES (19,26,7,'México Jodido','Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem','http://php.net','../../../assets/media/dir_source/img_source_martin_1502926241.jpg','facebook','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893950792863850496','comprado',1502926241,1502926241,100),(20,26,9,'Odebrecht.','Odebrecht en México.','http://php.net','../../../assets/media/dir_source/img_source_martin_1502926602.jpg','twitter','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893950792863850496','comprado',1502926602,1502926602,30),(21,26,2,'México Jodido','','http://php.net','../../../assets/media/dir_source/img_source_martin_1502983516.jpg','instagram','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893283170635849730','comprado',1502983516,1502983516,2);
/*!40000 ALTER TABLE `tbl_serie_escritor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_topicos`
--

DROP TABLE IF EXISTS `tbl_topicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_topicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_topicos`
--

LOCK TABLES `tbl_topicos` WRITE;
/*!40000 ALTER TABLE `tbl_topicos` DISABLE KEYS */;
INSERT INTO `tbl_topicos` VALUES (1,'Desarrollo Urbano / Urbanismo',NULL),(2,'Movilidad',NULL),(3,'Ecología',NULL),(4,'Seguridad',NULL),(5,'Servicios públicos',NULL),(6,'Gobernanza y legislación',NULL),(7,'Rumbo a elección 2018',NULL),(8,'Ciencia y tecnología',NULL),(9,'Cultura',NULL),(10,'Recreación',NULL);
/*!40000 ALTER TABLE `tbl_topicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `fecha_nac_timestamp` int(30) DEFAULT NULL,
  `perfil_image_path` varchar(200) DEFAULT NULL,
  `descripcion_corta` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (26,'martin','martin',2,'martin@gmail.com','Martin Eleno',NULL,NULL,NULL,NULL),(27,'cliente','cliente',3,'cliente@gmail.com','Cliente Martin',NULL,NULL,NULL,NULL),(28,'eleno','eleno',2,'eleno@gmail.com','Eleno',NULL,NULL,NULL,NULL),(29,'martincliente','martincliente',3,'martincliente@gmail.com','Cliente Martin',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'csystem'
--

--
-- Dumping routines for database 'csystem'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-17 20:07:06
