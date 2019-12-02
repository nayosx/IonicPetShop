-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: lab04
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.6-MariaDB

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
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `carnet` varchar(25) NOT NULL,
  `email` varchar(64) NOT NULL,
  `image` varchar(64) NOT NULL DEFAULT 'logo.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES (1,'José Hernández','HG101513','jose004@ufg.edu.sv','avatar.jpg');
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduct` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `datecrea` datetime NOT NULL DEFAULT current_timestamp(),
  `isshipped` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `car_fk` (`idproduct`),
  KEY `car_fk_1` (`iduser`),
  CONSTRAINT `car_fk` FOREIGN KEY (`idproduct`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `car_fk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car`
--

LOCK TABLES `car` WRITE;
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
INSERT INTO `car` VALUES (1,1,1,'2019-11-30 18:33:14',0),(4,1,3,'2019-12-01 01:38:19',0),(5,3,3,'2019-12-01 01:38:19',0),(6,2,3,'2019-12-01 01:38:19',0),(7,4,1,'2019-12-01 13:53:49',0),(8,3,1,'2019-12-01 13:53:57',0),(9,4,1,'2019-12-01 15:00:26',0),(10,2,4,'2019-12-01 16:33:06',0),(11,2,5,'2019-12-01 16:49:58',0),(12,4,5,'2019-12-01 16:50:04',0),(13,1,1,'2019-12-01 17:16:07',0);
/*!40000 ALTER TABLE `car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduct` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `datecrea` datetime NOT NULL DEFAULT current_timestamp(),
  `price` double NOT NULL DEFAULT 0,
  `discond` double NOT NULL DEFAULT 0,
  `tax` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `orders_fk` (`idproduct`),
  KEY `orders_fk_1` (`iduser`),
  CONSTRAINT `orders_fk` FOREIGN KEY (`idproduct`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_fk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,1,'2019-11-30 18:37:44',0,0,0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT 'No name',
  `description` varchar(256) NOT NULL DEFAULT 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s',
  `price` double NOT NULL DEFAULT 0,
  `img` varchar(128) NOT NULL DEFAULT 'default.jpg',
  `datecrea` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Gato','Esto es un lorem',200,'kitten.jpg','2019-11-30 15:32:01'),(2,'Tortuga','Otra data',25,'turtle.jpg','2019-12-01 00:38:33'),(3,'Perro','Es un perro',400,'puppy.jpg','2019-12-01 00:38:33'),(4,'Conejo','Lorem',10,'rabbit.jpg','2019-12-01 13:30:25');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `datecrea` datetime NOT NULL DEFAULT current_timestamp(),
  `carnet` varchar(32) NOT NULL,
  `bio` varchar(256) DEFAULT NULL,
  `isdelete` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ado','nes','ness','12345','2019-11-30 18:24:12','1201212','algo de mi vida',0),(2,'Ado 2','Gonz','ness01','12345','2019-11-30 19:44:15','121212121221212','lorem',0),(3,'Ado 333333','Gonz','ness02','12345','2019-11-30 19:44:22','121212121221212','lorem',0),(4,'Ado 44444','Gonz','ness04','12345','2019-11-30 22:12:59','121212121221212','lorem',0),(5,'Ado 5','Gonz','ness05','12345','2019-11-30 23:11:51','121212121221212','lorem',0),(6,'Ado 66666','Gonz','ness06','12345','2019-12-01 00:15:47','121212121221212','lorem',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'lab04'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-01 21:41:40
