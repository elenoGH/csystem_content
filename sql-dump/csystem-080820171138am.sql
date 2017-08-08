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
-- Table structure for table `tbl_contenido`
--

DROP TABLE IF EXISTS `tbl_contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `path_source` varchar(100) DEFAULT NULL,
  `red_social` varchar(100) DEFAULT NULL,
  `tipo_source` varchar(100) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `etiquetas` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contenido`
--

LOCK TABLES `tbl_contenido` WRITE;
/*!40000 ALTER TABLE `tbl_contenido` DISABLE KEYS */;
INSERT INTO `tbl_contenido` VALUES (5,2,'Shen Long','Mañana llega #DragonBallSuper con el doblaje soñado y promete destrucción ????\r\nAparte de Krilin, ¿q','http://php.net','../../assets/media/dir_source/img_source_escritor@gmail.com_1501887265.jpg','twitter','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}');
/*!40000 ALTER TABLE `tbl_contenido` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contenido_escritor`
--

LOCK TABLES `tbl_contenido_escritor` WRITE;
/*!40000 ALTER TABLE `tbl_contenido_escritor` DISABLE KEYS */;
INSERT INTO `tbl_contenido_escritor` VALUES (1,2,9,'Dracarys','Crecen tan rápido, en Game of Thrones temporada 7 capitulo 1, Lorem Ipsum Lorem Ipsum  Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum .','http://php.net','../../assets/media/dir_source/img_source_autor@gmail.com_1502204518.jpg','facebook','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/894627252989710337','espera',1502206357,1502206029),(2,2,8,'Planetary Protection Offecer','','http://php.net','../../assets/media/dir_source/img_source_autor@gmail.com_1502206357.png','instagram','Imagen','Social','{\"biologia\":\"bilogia\",\"hurbanismo\":\"hurbanismo\",\"tecnologi\":\"tecnologia\"}','https://twitter.com/pictoline/status/893283170635849730','espera',1502206357,1502206357);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rol`
--

LOCK TABLES `tbl_rol` WRITE;
/*!40000 ALTER TABLE `tbl_rol` DISABLE KEYS */;
INSERT INTO `tbl_rol` VALUES (1,0,'admin'),(2,1,'escritor'),(3,2,'editor'),(4,3,'comprador');
/*!40000 ALTER TABLE `tbl_rol` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (1,'admin','admin',0,'admin@gmail.com',NULL,NULL,NULL,NULL),(2,'autor','autor',1,'autor@gmail.com','Aron','Peralta Medina',NULL,NULL),(3,'editor','editor',2,'editor@gmail.com',NULL,NULL,NULL,NULL),(4,'comprador','comprador',3,'comprador@gmail.com',NULL,NULL,NULL,NULL),(5,'veronica','veronica',1,'veronica@aureacode.com','Veronica Luna','Arrañaga',NULL,NULL);
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

-- Dump completed on 2017-08-08 11:38:38
