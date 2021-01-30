CREATE DATABASE  IF NOT EXISTS `sibylcolegio` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `sibylcolegio`;
-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: sibylcolegio
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acceso`
--

DROP TABLE IF EXISTS `acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `acceso` (
  `accId` int(11) NOT NULL AUTO_INCREMENT,
  `accVista` varchar(25) DEFAULT NULL,
  `accDescripcion` varchar(50) DEFAULT NULL,
  `accCodigo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`accId`),
  UNIQUE KEY `UQ_accCodigo` (`accCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceso`
--

LOCK TABLES `acceso` WRITE;
/*!40000 ALTER TABLE `acceso` DISABLE KEYS */;
INSERT INTO `acceso` VALUES (1,'Panel de administración',NULL,'dashAdmin'),(2,'Panel docente',NULL,'dashDocente'),(3,'Panel alumno',NULL,'dashAlumno'),(4,'Tipo empleados',NULL,'verTipoEmpleado'),(5,'Empleados',NULL,'verEmpleado'),(6,'Materias',NULL,'verMateria'),(7,'Niveles',NULL,'verNivel'),(8,'Grados',NULL,'verGrado'),(9,'Grupos',NULL,'verGrupo'),(10,'Alumnos',NULL,'verAlumno'),(11,'Matricula',NULL,'matricula'),(12,'Agregar empleado',NULL,'nuevoEmpleado'),(13,'Notas','','notas'),(14,'Expediente',NULL,'expediente'),(15,'Menu personal','Parte del menú','menuPersonal'),(16,'Menu pedagogico','Parte del menú','menuPedagogico'),(17,'Menu alumnos','Parte del menú','menuAlumnos');
/*!40000 ALTER TABLE `acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `alumno` (
  `almId` int(11) NOT NULL AUTO_INCREMENT,
  `almCodigo` varchar(8) DEFAULT NULL,
  `almNie` varchar(8) DEFAULT NULL,
  `almNombre` varchar(50) NOT NULL,
  `almApellidoP` varchar(25) NOT NULL,
  `almApellidoM` varchar(25) DEFAULT NULL,
  `almFechaNac` date NOT NULL,
  `almLugarNac` varchar(100) DEFAULT NULL,
  `almSexo` char(1) NOT NULL,
  `almDireccion` varchar(400) DEFAULT NULL,
  `almMadre` varchar(100) DEFAULT NULL,
  `almPadre` varchar(100) DEFAULT NULL,
  `almTelCasa` varchar(15) DEFAULT NULL,
  `almTelCel` varchar(15) DEFAULT NULL,
  `almCorreo` varchar(50) DEFAULT NULL,
  `almResponsable` varchar(50) DEFAULT NULL,
  `almTelResponsable` varchar(15) DEFAULT NULL,
  `almFoto` varchar(100) DEFAULT NULL,
  `almMadreDui` varchar(10) DEFAULT NULL,
  `almPadreDui` varchar(10) DEFAULT NULL,
  `dptId` int(11) DEFAULT NULL,
  `munId` int(11) DEFAULT NULL,
  PRIMARY KEY (`almId`),
  UNIQUE KEY `UQ_almCodigo` (`almCodigo`),
  UNIQUE KEY `UQ_almNie` (`almNie`),
  KEY `FK_Departamento_Alumno` (`dptId`),
  KEY `FK_Municipio_Alumno` (`munId`),
  CONSTRAINT `FK_Departamento_Alumno` FOREIGN KEY (`dptId`) REFERENCES `departamento` (`dptid`),
  CONSTRAINT `FK_Municipio_Alumno` FOREIGN KEY (`munId`) REFERENCES `municipio` (`munid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES (1,'20180000',NULL,'Fabiola Cecilia','Rivera','Martínez','2011-06-07','Soyapango','F','Urb. Abalam Pje. Cuscatlan Pol E #5E','Alicia Beatríz Rivera Martínez','Luis Eduardo Rivera Martínez','2299-1780','7968-4744','beamartinez@gmail.com','Marta Alicia Martínez','7954-9740',NULL,NULL,NULL,NULL,NULL),(4,'20180001',NULL,'Killiam Aldebaran','Rivera','Martínez','2018-07-12','San Vicente','M','San Lorenzo, San Vicente','Diana Gilma Palacios Cubias','Luis Eduardo Rivera Martínez','2299-1780','79684744','luigi6884@gmail.com','Diana Gilma Palacios Cubias','7045-9089',NULL,NULL,NULL,NULL,NULL),(5,'20180002',NULL,'Luis Eduardo','Rivera','Martínez','1995-10-01','San Salvador','M','Soyapango','Marta Alicia Martínez','José Luis Rivera Rivera','2299-1780','7954-9514','luigi@gmail.com','Marta Alicia Martínez','7045-9089',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colegio`
--

DROP TABLE IF EXISTS `colegio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `colegio` (
  `clgId` int(11) NOT NULL,
  `clgNombre` varchar(75) NOT NULL,
  `clgDireccion` varchar(250) DEFAULT NULL,
  `clgTelefono` varchar(15) DEFAULT NULL,
  `clgFax` varchar(15) DEFAULT NULL,
  `clgEmail` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`clgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colegio`
--

LOCK TABLES `colegio` WRITE;
/*!40000 ALTER TABLE `colegio` DISABLE KEYS */;
INSERT INTO `colegio` VALUES (1,'Colegio Sephira Genomics','Urb. Abalam Pje. Cuscatlán Pol. E #5E','2299-1789',NULL,'luigi.chino@hotmail.com');
/*!40000 ALTER TABLE `colegio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `departamento` (
  `dptId` int(11) NOT NULL AUTO_INCREMENT,
  `dptCodigo` varchar(10) DEFAULT NULL,
  `dptNombre` varchar(50) NOT NULL,
  PRIMARY KEY (`dptId`),
  UNIQUE KEY `UQ_dptCodigo` (`dptCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'01-AH','Ahuachapán'),(2,'02-CA','Cabañas'),(3,'03-CH','Chalatenango'),(4,'04-CU','Cuscatlán'),(5,'05-LI','La Libertad'),(6,'06-PA','La Paz'),(7,'07-UN','La Unión'),(8,'08-MO','Morazán'),(9,'09-SM','San Miguel'),(10,'10-SS','San Salvador'),(11,'11-SV','San Vicente'),(12,'12-SA','Santa Ana'),(13,'13-SO','Sonsonate'),(14,'14-US','Usulután');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detgrupo`
--

DROP TABLE IF EXISTS `detgrupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detgrupo` (
  `dgrpId` int(11) NOT NULL AUTO_INCREMENT,
  `grpId` int(11) DEFAULT NULL,
  `almId` int(11) DEFAULT NULL,
  PRIMARY KEY (`dgrpId`),
  KEY `FK_Grupo_DetalleGRupo` (`grpId`),
  KEY `FK_Alumno_DetalleGrupo` (`almId`),
  CONSTRAINT `FK_Alumno_DetalleGrupo` FOREIGN KEY (`almId`) REFERENCES `alumno` (`almid`),
  CONSTRAINT `FK_Grupo_DetalleGRupo` FOREIGN KEY (`grpId`) REFERENCES `grupo` (`grpid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detgrupo`
--

LOCK TABLES `detgrupo` WRITE;
/*!40000 ALTER TABLE `detgrupo` DISABLE KEYS */;
INSERT INTO `detgrupo` VALUES (1,1,1),(2,1,4),(3,2,1),(4,2,4),(5,3,5),(6,4,5),(7,5,1),(8,5,4);
/*!40000 ALTER TABLE `detgrupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `empleado` (
  `empId` int(11) NOT NULL AUTO_INCREMENT,
  `empCodigo` varchar(8) DEFAULT NULL,
  `empNombre` varchar(50) NOT NULL,
  `empApellidoP` varchar(25) NOT NULL,
  `empApellidoM` varchar(25) DEFAULT NULL,
  `empSexo` char(1) DEFAULT NULL,
  `empDUI` varchar(10) DEFAULT NULL,
  `empNIT` varchar(20) DEFAULT NULL,
  `empISSS` varchar(20) DEFAULT NULL,
  `empNUP` varchar(20) DEFAULT NULL,
  `empDireccion` varchar(400) DEFAULT NULL,
  `empEmail` varchar(100) DEFAULT NULL,
  `tempId` int(11) DEFAULT NULL,
  `empTelCasa` varchar(15) DEFAULT NULL,
  `empCelular` varchar(15) DEFAULT NULL,
  `empFechaIngreso` datetime DEFAULT CURRENT_TIMESTAMP,
  `empFechaSalida` date DEFAULT NULL,
  `empActivo` bit(1) NOT NULL DEFAULT b'1',
  `empFechaNac` date DEFAULT NULL,
  `empProfesion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`empId`),
  UNIQUE KEY `UQ_empCodigo` (`empCodigo`),
  KEY `FK_TipoEmpleado_Empleado` (`tempId`),
  CONSTRAINT `FK_TipoEmpleado_Empleado` FOREIGN KEY (`tempId`) REFERENCES `tipoempleado` (`tempid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (2,'PC180000','Diana Gilma','Palacios','Cubias','F','05252887-4','0614-010982-123-8','123456789','123456789078','San Lorenzo, San Vicente','dipi.cub@gmail.com',2,NULL,NULL,'2019-11-22 22:46:31',NULL,_binary '',NULL,NULL),(4,'PG180001','María Fernanda','Prudencio','Gómez','F','07534881-9','0614-200500-123-7','718750220','987654321345','San Salvador','mafer@hotmail.com',2,NULL,NULL,'2019-11-22 22:46:31',NULL,_binary '',NULL,NULL),(5,'AM200001','Melissa Ivett','Azucena','Molina','F','05252883-2','0614-280604-123-8','853149642','479852158052','Montes de San Bartolo 5, Pje. 56, Casa 5','mel@gmail.com',2,'2299-3412','61585702','2020-03-31 23:45:38',NULL,_binary '','2004-06-28',NULL);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `evaluacion` (
  `evaId` int(11) NOT NULL AUTO_INCREMENT,
  `evaNombre` varchar(50) DEFAULT NULL,
  `evaPorcentaje` float DEFAULT NULL,
  `grpId` int(11) DEFAULT NULL,
  `perId` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  PRIMARY KEY (`evaId`),
  KEY `FK_Grupo_Evaluacion` (`grpId`),
  KEY `FK_Periodo_Evaluacion` (`perId`),
  CONSTRAINT `FK_Grupo_Evaluacion` FOREIGN KEY (`grpId`) REFERENCES `grupo` (`grpid`),
  CONSTRAINT `FK_Periodo_Evaluacion` FOREIGN KEY (`perId`) REFERENCES `periodo` (`perid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` VALUES (1,'Examen corto',0.25,1,NULL,NULL),(2,'Parcial',0.6,1,NULL,NULL),(3,'Actividad grupal',0.1,2,NULL,NULL),(4,'Exámen corto',0.25,5,NULL,NULL),(5,'Actividad en el aula',0.15,5,NULL,NULL),(6,'Exámen final',0.6,5,NULL,NULL);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grado`
--

DROP TABLE IF EXISTS `grado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `grado` (
  `grdId` int(11) NOT NULL AUTO_INCREMENT,
  `grdNombre` varchar(50) DEFAULT NULL,
  `turId` int(11) DEFAULT NULL,
  `empId` int(11) DEFAULT NULL,
  `nvlId` int(11) DEFAULT NULL,
  PRIMARY KEY (`grdId`),
  KEY `FK_Turno_Grado` (`turId`),
  KEY `FK_Empleado_Grado` (`empId`),
  KEY `FK_Nivel_Grado` (`nvlId`),
  CONSTRAINT `FK_Empleado_Grado` FOREIGN KEY (`empId`) REFERENCES `empleado` (`empid`),
  CONSTRAINT `FK_Nivel_Grado` FOREIGN KEY (`nvlId`) REFERENCES `nivel` (`nvlid`),
  CONSTRAINT `FK_Turno_Grado` FOREIGN KEY (`turId`) REFERENCES `turno` (`turid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grado`
--

LOCK TABLES `grado` WRITE;
/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
INSERT INTO `grado` VALUES (1,'Parvularia 4C',1,2,3),(2,'Primer Grado A',2,4,6);
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `grupo` (
  `grpId` int(11) NOT NULL AUTO_INCREMENT,
  `empId` int(11) DEFAULT NULL,
  `matId` int(11) DEFAULT NULL,
  `grdId` int(11) DEFAULT NULL,
  PRIMARY KEY (`grpId`),
  KEY `FK_Empleado_Grupo` (`empId`),
  KEY `FK_Materia_Grupo` (`matId`),
  KEY `FK_Grado_Grupo` (`grdId`),
  CONSTRAINT `FK_Empleado_Grupo` FOREIGN KEY (`empId`) REFERENCES `empleado` (`empid`),
  CONSTRAINT `FK_Grado_Grupo` FOREIGN KEY (`grdId`) REFERENCES `grado` (`grdid`),
  CONSTRAINT `FK_Materia_Grupo` FOREIGN KEY (`matId`) REFERENCES `materia` (`matid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES (1,2,4,1),(2,2,1,1),(3,4,1,2),(4,4,2,2),(5,4,5,1);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `materia` (
  `matId` int(11) NOT NULL AUTO_INCREMENT,
  `matCodigo` varchar(15) DEFAULT NULL,
  `matNombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`matId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (1,'MAT','Matemáticas'),(2,'EESS','Estudios Sociales'),(3,'CCNN','Ciencias Naturales'),(4,'LEN','Lenguaje y Literatura'),(5,'MOC','Moral y Cívica');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `municipio` (
  `munId` int(11) NOT NULL AUTO_INCREMENT,
  `munCodigo` varchar(10) DEFAULT NULL,
  `munNombre` varchar(300) NOT NULL,
  `munCodPostal` varchar(10) DEFAULT NULL,
  `dptId` int(11) DEFAULT NULL,
  PRIMARY KEY (`munId`),
  UNIQUE KEY `UQ_munCodigo` (`munCodigo`),
  KEY `FK_Departamento_Municipio` (`dptId`),
  CONSTRAINT `FK_Departamento_Municipio` FOREIGN KEY (`dptId`) REFERENCES `departamento` (`dptid`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (1,'01-01','Ahuachapán','CP 2101',1),(2,'01-02','Apaneca','CP 2102',1),(3,'01-03','Atiquizaya','CP 2103',1),(4,'01-04','Concepción de Ataco','CP 2106',1),(5,'01-05','El Refugio','CP 2107',1),(6,'01-06','Guaymango','CP 2108',1),(7,'01-07','Jujutla','CP 2109',1),(8,'01-08','San Francisco Menéndez','CP 2113',1),(9,'01-09','San Lorenzo','CP 2115',1),(10,'01-10','San Pedro Puxtla','CP 2116',1),(11,'01-11','Tacuba','CP 2117',1),(12,'01-12','Turín','CP 2118',1),(13,'02-01','Cinquera','CP 1202',2),(14,'02-02','Dolores','CP 1209',2),(15,'02-03','Guacotecti','CP 1203',2),(16,'02-04','Ilobasco','CP 1204',2),(17,'02-05','Jutiapa','CP 1206',2),(18,'02-06','San Isidro','CP 1207',2),(19,'02-07','Sensuntepeque','CP 1201',2),(20,'02-08','Tejutepeque','CP 1209',2),(21,'02-09','Victoria','CP 1210',2),(22,'03-01','Agua Caliente','',3),(23,'03-02','Arcatao','',3),(24,'03-03','Azacualpa','',3),(25,'03-04','Chalatenango','CP 1301',3),(26,'03-05','Comalapa','',3),(27,'03-06','Citalá','',3),(28,'03-07','Concepción Quezaltepeque','',3),(29,'03-08','Dulce Nombre de María','',3),(30,'03-09','El Carrizal','',3),(31,'03-10','El Paraíso','',3),(32,'03-11','La Laguna','',3),(33,'03-12','La Palma','',3),(34,'03-13','La Reina','',3),(35,'03-14','Las Vueltas','',3),(36,'03-15','Nueva Concepción','',3),(37,'03-16','Nueva Trinidad','',3),(38,'03-17','Nombre de Jesús','',3),(39,'03-18','Ojos de Agua','',3),(40,'03-19','Potonico','',3),(41,'03-20','San Antonio de la Cruz','',3),(42,'03-21','San Antonio Los Ranchos','',3),(43,'03-22','San Fernando','',3),(44,'03-23','San Francisco Lempa','',3),(45,'03-24','San Francisco Morazán','',3),(46,'03-25','San Ignacio','',3),(47,'03-26','San Isidro Labrador','CP 1330',3),(48,'03-27','San José Cancasque','',3),(49,'03-28','San José Las Flores','',3),(50,'03-29','San Luis del Carmen','',3),(51,'03-30','San Miguel de Mercedes','',3),(52,'03-31','San Rafael','',3),(53,'03-32','Santa Rita','',3),(54,'03-33','Tejutla','',3),(55,'04-01','Candelaria','',4),(56,'04-02','Cojutepeque','CP 1401',4),(57,'04-03','El Carmen','',4),(58,'04-04','El Rosario','',4),(59,'04-05','Monte San Juan','',4),(60,'04-06','Oratorio de Concepción','',4),(61,'04-07','San Bartolomé Perulapía','',4),(62,'04-08','San Cristóbal','',4),(63,'04-09','San José Guayabal','',4),(64,'04-10','San Pedro Perulapán','',4),(65,'04-11','San Rafael Cedros','',4),(66,'04-12','San Ramón','',4),(67,'04-13','Santa Cruz Analquito','',4),(68,'04-14','Santa Cruz Michapa','',4),(69,'04-15','Suchitoto','CP 1415',4),(70,'04-16','Tenancingo','',4),(71,'05-01','Antiguo Cuscatlán','CP 1502',5),(72,'05-02','Chiltiupán','',5),(73,'05-03','Ciudad Arce','',5),(74,'05-04','Colón','CP 1512',5),(75,'05-05','Comasagua','',5),(76,'05-06','Huizúcar','',5),(77,'05-07','Jayaque','',5),(78,'05-08','Jicalapa','',5),(79,'05-09','La Libertad','CP 1511',5),(80,'05-10','Santa Tecla','CP 1501',5),(81,'05-11','Nuevo Cuscatlán','CP 1513',5),(82,'05-12','San Juan Opico','',5),(83,'05-13','Quezaltepeque','',5),(84,'05-14','Sacacoyo','',5),(85,'05-15','San José Villanueva','',5),(86,'05-16','San Matías','',5),(87,'05-17','San Pablo Tacachico','',5),(88,'05-18','Talnique','',5),(89,'05-19','Tamanique','CP 1522',5),(90,'05-20','Teotepeque','',5),(91,'05-21','Tepecoyo','',5),(92,'05-22','Zaragoza','',5),(93,'06-01','Cuyultitán','',6),(94,'06-02','El Rosario','',6),(95,'06-03','Jerusalén','',6),(96,'06-04','Mercedes La Ceiba','',6),(97,'06-05','Olocuilta','',6),(98,'06-06','Paraíso de Osorio','',6),(99,'06-07','San Antonio Masahuat','',6),(100,'06-08','San Emigdio','',6),(101,'06-09','San Francisco Chinameca','',6),(102,'06-10','San Juan Nonualco','',6),(103,'06-11','San Juan Talpa','',6),(104,'06-12','San Juan Tepezontes','',6),(105,'06-13','San Luis Talpa','CP 1616',6),(106,'06-14','San Luis La Herradura','',6),(107,'06-15','San Miguel Tepezontes','',6),(108,'06-16','San Pedro Masahuat','',6),(109,'06-17','San Pedro Nonualco','',6),(110,'06-18','San Rafael Obrajuelo','',6),(111,'06-19','Santa María Ostuma','',6),(112,'06-20','Santiago Nonualco','',6),(113,'06-21','Tapalhuaca','',6),(114,'06-22','Zacatecoluca','CP 1601',6),(115,'07-01','Anamorós','',7),(116,'07-02','Bolívar','',7),(117,'07-03','Concepción de Oriente','',7),(118,'07-04','Conchagua','',7),(119,'07-05','El Carmen','',7),(120,'07-06','El Sauce','',7),(121,'07-07','Intipucá','',7),(122,'07-08','La Unión','CP 3101',7),(123,'07-09','Lislique','',7),(124,'07-10','Meanguera del Golfo','',7),(125,'07-11','Nueva Esparta','',7),(126,'07-12','Pasaquina','',7),(127,'07-13','Polorós','',7),(128,'07-14','San Alejo','',7),(129,'07-15','San José','',7),(130,'07-16','Santa Rosa de Lima','CP 3121',7),(131,'07-17','Yayantique','',7),(132,'07-18','Yucuaiquín','',7),(133,'08-01','Arambala','',8),(134,'08-02','Cacaopera','CP 3216',8),(135,'08-03','Chilanga','',8),(136,'08-04','Corinto','',8),(137,'08-05','Delicias de Concepción','',8),(138,'08-06','El Divisadero','',8),(139,'08-07','El Rosario','',8),(140,'08-08','Gualococti','',8),(141,'08-09','Guatajiagua','',8),(142,'08-10','Joateca','',8),(143,'08-11','Jocoaitique','CP 3212',8),(144,'08-12','Jocoro','',8),(145,'08-13','Lolotiquillo','',8),(146,'08-14','Meanguera','',8),(147,'08-15','Osicala','',8),(148,'08-16','Perquín','',8),(149,'08-17','San Carlos','',8),(150,'08-18','San Fernando','',8),(151,'08-19','San Francisco Gotera','CP 3201',8),(152,'08-20','San Isidro','CP 3220',8),(153,'08-21','San Simón','',8),(154,'08-22','Sensembra','',8),(155,'08-23','Sociedad','',8),(156,'08-24','Torola','',8),(157,'08-25','Yamabal','',8),(158,'08-26','Yoloaiquín','',8),(159,'09-01','Carolina','',9),(160,'09-02','Chapeltique','',9),(161,'09-03','Chinameca','',9),(162,'09-04','Chirilagua','',9),(163,'09-05','Ciudad Barrios','',9),(164,'09-06','Comacarán','',9),(165,'09-07','El Tránsito','',9),(166,'09-08','Lolotique','',9),(167,'09-09','Moncagua','',9),(168,'09-10','Nueva Guadalupe','',9),(169,'09-11','Nuevo Edén de San Juan','',9),(170,'09-12','Quelepa','',9),(171,'09-13','San Antonio del Mosco','',9),(172,'09-14','San Gerardo','',9),(173,'09-15','San Jorge','',9),(174,'09-16','San Luis de la Reina','',9),(175,'09-17','San Miguel','CP 3301',9),(176,'09-18','San Rafael Oriente','',9),(177,'09-19','Sesori','',9),(178,'09-20','Uluazapa','',9),(179,'10-01','Aguilares','CP 1122',10),(180,'10-02','Apopa','CP 1123',10),(181,'10-03','Ayutuxtepeque','CP 1121',10),(182,'10-04','Cuscatancingo','CP 1119',10),(183,'10-05','Ciudad Delgado','CP 1118',10),(184,'10-06','El Paisnal','1124',10),(185,'10-07','Guazapa','CP 1125',10),(186,'10-08','Ilopango','CP 1117',10),(187,'10-09','Mejicanos','CP 1120',10),(188,'10-10','Nejapa','CP 1126',10),(189,'10-11','Panchimalco','CP 1127',10),(190,'10-12','Rosario de Mora','CP 1128',10),(191,'10-13','San Marcos','CP 1115',10),(192,'10-14','San Martín','CP 1129',10),(193,'10-15','San Salvador','CP 1101',10),(194,'10-16','Santiago Texacuangos','CP 1130',10),(195,'10-17','Santo Tomás','CP 1131',10),(196,'10-18','Soyapango','CP 1116',10),(197,'10-19','Tonacatepeque','CP 1132',10),(198,'11-01','Apastepeque','',11),(199,'11-02','Guadalupe','',11),(200,'11-03','San Cayetano Istepeque','',11),(201,'11-04','San Esteban Catarina','',11),(202,'11-05','San Ildefonso','',11),(203,'11-06','San Lorenzo','',11),(204,'11-07','San Sebastián','',11),(205,'11-08','San Vicente','CP 1701',11),(206,'11-09','Santa Clara','CP 1709',11),(207,'11-10','Santo Domingo','',11),(208,'11-11','Tecoluca','',11),(209,'11-12','Tepetitán','',11),(210,'11-13','Verapaz','',11),(211,'12-01','Candelaria de la Frontera','',12),(212,'12-02','Chalchuapa','CP 2205',12),(213,'12-03','Coatepeque','',12),(214,'12-04','El Congo','',12),(215,'12-05','El Porvenir','',12),(216,'12-06','Masahuat','',12),(217,'12-07','Metapán','',12),(218,'12-08','San Antonio Pajonal','',12),(219,'12-09','San Sebastián Salitrillo','CP 2215',12),(220,'12-10','Santa Ana','CP 2201',12),(221,'12-11','Santa Rosa Guachipilín','',12),(222,'12-12','Santiago de la Frontera','',12),(223,'12-13','Texistepeque','',12),(224,'13-01','Acajutla','',13),(225,'13-02','Armenia','',13),(226,'13-03','Caluco','',13),(227,'13-04','Cuisnahuat','',13),(228,'13-05','Izalco','',13),(229,'13-06','Juayúa','CP 2307',13),(230,'13-07','Nahuizalco','',13),(231,'13-08','Nahulingo','',13),(232,'13-09','Salcoatitán','',13),(233,'13-10','San Antonio del Monte','',13),(234,'13-11','San Julián','',13),(235,'13-12','Santa Catarina Masahuat','',13),(236,'13-13','Santa Isabel Ishuatán','',13),(237,'13-14','Santo Domingo Guzmán','',13),(238,'13-15','Sonsonate','CP 2301',13),(239,'13-16','Sonzacate','CP 2320',13),(240,'14-01','Alegría','',14),(241,'14-02','Berlín','CP 3403',14),(242,'14-03','California','',14),(243,'14-04','Concepción Batres','',14),(244,'14-05','El Triunfo','',14),(245,'14-06','Ereguayquín','',14),(246,'14-07','Estanzuelas','CP 3408',14),(247,'14-08','Jiquilisco','',14),(248,'14-09','Jucuapa','',14),(249,'14-10','Jucuarán','',14),(250,'14-11','Mercedes Umaña','',14),(251,'14-12','Nueva Granada','',14),(252,'14-13','Ozatlán','',14),(253,'14-14','Puerto El Triunfo','',14),(254,'14-15','San Agustín','',14),(255,'14-16','San Buenaventura','',14),(256,'14-17','San Dionisio','',14),(257,'14-18','San Francisco Javier','',14),(258,'14-19','Santa Elena','CP 3422',14),(259,'14-20','Santa María','',14),(260,'14-21','Santiago de María','CP 3424',14),(261,'14-22','Tecapán','',14),(262,'14-23','Usulután','CP 3401',14);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel`
--

DROP TABLE IF EXISTS `nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `nivel` (
  `nvlId` int(11) NOT NULL AUTO_INCREMENT,
  `nvlAbrev` varchar(10) DEFAULT NULL,
  `nvlNivel` varchar(25) DEFAULT NULL,
  `nvlIdPadre` int(11) DEFAULT NULL,
  PRIMARY KEY (`nvlId`),
  KEY `FK_Nivel_Nivel` (`nvlIdPadre`),
  CONSTRAINT `FK_Nivel_Nivel` FOREIGN KEY (`nvlIdPadre`) REFERENCES `nivel` (`nvlid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel`
--

LOCK TABLES `nivel` WRITE;
/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
INSERT INTO `nivel` VALUES (3,'PRV4','Parvularia 4',NULL),(4,'PRV5','Parvularia 5',3),(5,'PRV6','Parvularia 6',4),(6,'1ero','Primer Grado',5),(7,'2do','Segundo Grado',6),(8,'3ero','Tercer Grado',7),(9,'4to','Cuarto Grado',8),(10,'5to','Quinto Grado',9),(11,'6to','Sexto Grado',10),(12,'7mo','Séptimo Grado',11),(13,'8vo','Octavo Grado',12),(14,'9no','Noveno Grado',13),(15,'','',NULL);
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nota`
--

DROP TABLE IF EXISTS `nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `nota` (
  `notId` int(11) NOT NULL AUTO_INCREMENT,
  `notNota` float DEFAULT NULL,
  `notPorcentaje` float DEFAULT NULL,
  `evaId` int(11) DEFAULT NULL,
  `almId` int(11) DEFAULT NULL,
  `grpId` int(11) DEFAULT NULL,
  `notTot` float GENERATED ALWAYS AS ((`notNota` * `notPorcentaje`)) VIRTUAL,
  `notPost` bit(1) DEFAULT b'0',
  PRIMARY KEY (`notId`),
  KEY `FK_Evaluacion_Notas` (`evaId`),
  KEY `FK_Alumno_Notas` (`almId`),
  KEY `FK_Grupo_Notas` (`grpId`),
  CONSTRAINT `FK_Alumno_Notas` FOREIGN KEY (`almId`) REFERENCES `alumno` (`almid`),
  CONSTRAINT `FK_Evaluacion_Notas` FOREIGN KEY (`evaId`) REFERENCES `evaluacion` (`evaid`),
  CONSTRAINT `FK_Grupo_Notas` FOREIGN KEY (`grpId`) REFERENCES `grupo` (`grpid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota`
--

LOCK TABLES `nota` WRITE;
/*!40000 ALTER TABLE `nota` DISABLE KEYS */;
INSERT INTO `nota` (`notId`, `notNota`, `notPorcentaje`, `evaId`, `almId`, `grpId`, `notPost`) VALUES (1,3,0.25,1,4,1,_binary '\0'),(2,8.5,0.25,4,1,5,_binary '\0'),(3,9.1,0.25,4,4,5,_binary '\0'),(4,9,0.25,1,1,1,_binary '\0'),(5,8,0.1,3,1,2,_binary '\0'),(6,8.5,0.1,3,4,2,_binary '\0');
/*!40000 ALTER TABLE `nota` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trNotaBeforeInsert` BEFORE INSERT ON `nota` FOR EACH ROW BEGIN
	SET NEW.notPorcentaje = (SELECT evaPorcentaje FROM Evaluacion WHERE evaId = NEW.evaId);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trNotaAfterUpdate` BEFORE UPDATE ON `nota` FOR EACH ROW BEGIN
	SET NEW.notPorcentaje = (SELECT evaPorcentaje FROM Evaluacion WHERE evaId = NEW.evaId);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `periodo` (
  `perId` int(11) NOT NULL AUTO_INCREMENT,
  `perNombre` int(11) DEFAULT NULL,
  `perFechaInicio` date DEFAULT NULL,
  `perFechaFin` date DEFAULT NULL,
  PRIMARY KEY (`perId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `rol` (
  `rolId` int(11) NOT NULL AUTO_INCREMENT,
  `rolNombre` varchar(50) DEFAULT NULL,
  `rolRedirect` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador','admin'),(2,'Alumno','alumno'),(3,'Docente','docente');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rolacceso`
--

DROP TABLE IF EXISTS `rolacceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `rolacceso` (
  `raccId` int(11) NOT NULL AUTO_INCREMENT,
  `rolId` int(11) DEFAULT NULL,
  `accId` int(11) DEFAULT NULL,
  PRIMARY KEY (`raccId`),
  KEY `FK_Rol_RolAcceso` (`rolId`),
  KEY `FK_Acceso_RolAcceso` (`accId`),
  CONSTRAINT `FK_Acceso_RolAcceso` FOREIGN KEY (`accId`) REFERENCES `acceso` (`accid`),
  CONSTRAINT `FK_Rol_RolAcceso` FOREIGN KEY (`rolId`) REFERENCES `rol` (`rolid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rolacceso`
--

LOCK TABLES `rolacceso` WRITE;
/*!40000 ALTER TABLE `rolacceso` DISABLE KEYS */;
INSERT INTO `rolacceso` VALUES (3,1,1),(14,1,4),(15,1,5),(16,1,6),(17,1,7),(18,1,8),(19,1,9),(20,1,10),(21,1,11),(22,2,3),(23,3,2),(24,1,12),(25,2,13),(26,2,14),(27,1,15),(28,1,17);
/*!40000 ALTER TABLE `rolacceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoempleado`
--

DROP TABLE IF EXISTS `tipoempleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tipoempleado` (
  `tempId` int(11) NOT NULL AUTO_INCREMENT,
  `tempCodigo` varchar(8) DEFAULT NULL,
  `tempNombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tempId`),
  UNIQUE KEY `UQ_tempCodigo` (`tempCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoempleado`
--

LOCK TABLES `tipoempleado` WRITE;
/*!40000 ALTER TABLE `tipoempleado` DISABLE KEYS */;
INSERT INTO `tipoempleado` VALUES (1,'Admin','Adminisrador'),(2,'Doc','Docente'),(3,'Ord','Ordenanza');
/*!40000 ALTER TABLE `tipoempleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoevaluacion`
--

DROP TABLE IF EXISTS `tipoevaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tipoevaluacion` (
  `tevaId` int(11) NOT NULL AUTO_INCREMENT,
  `tevaNombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`tevaId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoevaluacion`
--

LOCK TABLES `tipoevaluacion` WRITE;
/*!40000 ALTER TABLE `tipoevaluacion` DISABLE KEYS */;
INSERT INTO `tipoevaluacion` VALUES (1,'Exámen corto'),(2,'Actividad integradora'),(3,'Parcial');
/*!40000 ALTER TABLE `tipoevaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `turno` (
  `turId` int(11) NOT NULL AUTO_INCREMENT,
  `turNombre` varchar(25) DEFAULT NULL,
  `turActivo` bit(1) DEFAULT b'0',
  PRIMARY KEY (`turId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno`
--

LOCK TABLES `turno` WRITE;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
INSERT INTO `turno` VALUES (1,'Matutino',_binary ''),(2,'Vespertino',_binary ''),(3,'Nocturno',_binary '');
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuario` (
  `usrId` int(11) NOT NULL AUTO_INCREMENT,
  `usrUsuario` varchar(8) DEFAULT NULL,
  `usrNombre` varchar(50) DEFAULT NULL,
  `usrPassword` varchar(64) DEFAULT NULL,
  `empId` int(11) DEFAULT NULL,
  `rolId` int(11) DEFAULT NULL,
  `almId` int(11) DEFAULT NULL,
  PRIMARY KEY (`usrId`),
  UNIQUE KEY `UQ_usrUsuario` (`usrUsuario`),
  KEY `FK_Rol_Usuario` (`rolId`),
  CONSTRAINT `FK_Rol_Usuario` FOREIGN KEY (`rolId`) REFERENCES `rol` (`rolid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','Administrador','240BE518FABD2724DDB6F04EEB1DA5967448D7E831C08C8FA822809F74C720A9',0,1,NULL),(2,'PC180000','Diana Gilma Palacios Cubias','86dbfbcc9b795180d69123236066a9f9b7ad5977fa4e2a374d14e32d5ebd3a7e',2,3,NULL),(3,'20180000','Fabiola Cecilia Rivera Martínez','cf32063b23e0088cca7b76d86f5d69579367a53e08f01102b98b9453393d42fe',NULL,2,1),(4,'20180001','Killiam Aldebaran Rivera Martínez','518d9eb57bdfe19bdbad40f27d8c70d98d04e4f9ca6907de8671b2c16913eac6',NULL,2,4),(5,'PG180001','María Fernanda Prudencio Gómez','34f82501fb408fae42e188f996d387ba627b1a98a6738d66af999a52c4e17e69',4,3,NULL),(6,'20180002','Luis Eduardo Rivera Martínez','d25dbe939fa2081755816361fd060385ddb9e467363d5b383bce7cddf8e96f73',NULL,2,5),(7,'AM200001','Melissa Ivett Azucena Molina','3458ff7e36ef04e0617996aa51dad88b2478a8f5caeeb12de7648b156d71fa1d',5,3,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sibylcolegio'
--

--
-- Dumping routines for database 'sibylcolegio'
--
/*!50003 DROP PROCEDURE IF EXISTS `spAddAlumno` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAddAlumno`(IN p_almNombre VARCHAR(50),IN p_almApellidoP VARCHAR(50), IN p_almApellidoM VARCHAR(50),IN p_almFechaNac DATE,
IN p_almLugarNac VARCHAR(100),IN p_almSexo CHAR(1),IN p_almDireccion VARCHAR(400),IN p_almMadre VARCHAR(100),IN p_almPadre VARCHAR(100),
IN p_almTelCasa VARCHAR(15),IN p_almTelCel VARCHAR(15),IN p_almCorreo VARCHAR(50),IN p_almResponsable VARCHAR(50),IN p_almTelResponsable VARCHAR(15),
IN p_grdId INTEGER)
BEGIN
	DECLARE codigo VARCHAR(8);
	DECLARE i INTEGER;
    DECLARE almId INTEGER;
    DECLARE b BIT DEFAULT 0;
    DECLARE curGrupo CURSOR FOR SELECT grpId FROM Grupo WHERE grdId = p_grdId;
    
    -- Condición de salida
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET b = 1;
  
    -- Creación de código para el alumno
    SET codigo = YEAR(NOW());
	SELECT CAST(SUBSTRING(MAX(almCodigo),5,4) AS UNSIGNED) INTO i FROM Alumno WHERE SUBSTRING(almCodigo,1,4) = YEAR(NOW());
    
    IF (i >= 1) THEN 
		SET i = i + 1;
     ELSE
		SET i = 1;
	END IF;
    
    IF (i < 10) THEN
		SET codigo = CONCAT(codigo, "000", i);
	ELSEIF (i < 100) THEN
		SET codigo = CONCAT(codigo, "00", i);
	ELSEIF (i < 1000) THEN
		SET codigo = CONCAT(codigo, "0", i);
	ELSEIF (i < 10000) THEN
		SET codigo = CONCAT(codigo, i);
	END IF;
    
    -- Insertando los datos personales
    INSERT INTO Alumno(almCodigo,almNombre,almApellidoP,almApellidoM,almFechaNac,almLugarNac,almSexo,almDireccion,almMadre,almPadre,almTelCasa,almTelCel,almCorreo,almResponsable,almTelResponsable) 
		VALUES(codigo,p_almNombre,p_almApellidoP,p_almApellidoM,p_almFechaNac,p_almLugarNac,p_almSexo,p_almDireccion,p_almMadre,p_almPadre,p_almTelCasa,p_almTelCel,p_almCorreo,p_almResponsable,p_almTelResponsable);
	
    SET almId = LAST_INSERT_ID();
    
    -- Enrolandolo en todas las materias que posee el nivel
    
    OPEN curGrupo;
    getGrupos: LOOP
		FETCH curGrupo INTO i;
		IF b = 1 THEN
			LEAVE getGrupos;
		ELSE
			INSERT INTO detGrupo(grpId,almId) VALUES(i, almId);
		END IF;
		
	END LOOP getGrupos;
    CLOSE curGrupo;
    
    -- Agregandolo a la plataforma para que pueda ver sus notas
    
    INSERT INTO Usuario(usrUsuario,usrNombre,usrPassword,rolId,almId) VALUES(codigo,CONCAT(p_almNombre,' ',p_almApellidoP,' ',p_almApellidoM),SHA2(codigo,256),(SELECT rolId FROM Rol WHERE rolNombre = 'Alumno'),almId);
    
    -- Retornando el código generado
    
    SELECT codigo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spAddEmpleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAddEmpleado`(IN p_empNombre VARCHAR(50),IN p_empApellidoP VARCHAR(50), IN p_empApellidoM VARCHAR(50),
	IN p_empSexo CHAR(1),IN p_empDUI VARCHAR(10),IN p_empNIT VARCHAR(20),IN p_empISSS VARCHAR(20),IN p_empNUP VARCHAR(20),
	IN p_empDireccion VARCHAR(400),IN p_empEmail VARCHAR(100),IN p_tempId INT, IN p_empTelCasa VARCHAR(15),IN p_empCelular VARCHAR(15),
	IN p_empFechaNac DATE,IN p_empProfesion VARCHAR(250))
BEGIN
	DECLARE codigo VARCHAR(8);
	DECLARE i, empId INT;
    
    SET codigo = CONCAT(SUBSTRING(p_empApellidoP,1,1), SUBSTRING(p_empApellidoM,1,1), SUBSTRING(YEAR(NOW()),3,2));
	SELECT CAST(SUBSTRING(MAX(empCodigo),5,4) AS SIGNED) INTO i FROM Empleado WHERE SUBSTRING(empCodigo,3,2) = SUBSTRING(YEAR(NOW()),3,2);
    
    IF (i >= 1) THEN 
		SET i = i + 1;
     ELSE
		SET i = 1;
	END IF;
    
    IF (i < 10) THEN
		SET codigo = CONCAT(codigo, "000", i);
	ELSEIF (i < 100) THEN
		SET codigo = CONCAT(codigo, "00", i);
	ELSEIF (i < 1000) THEN
		SET codigo = CONCAT(codigo, "0", i);
	ELSEIF (i < 10000) THEN
		SET codigo = CONCAT(codigo, i);
	END IF;
    INSERT INTO Empleado(empCodigo,empNombre,empApellidoP,empApellidoM,empSexo,empDUI,empNIT,empISSS,empNUP,empDireccion,empEmail,tempId,empTelCasa,
			empCelular,empFechaNac,empProfesion) 
		VALUES(codigo,p_empNombre,p_empApellidoP,p_empApellidoM,p_empSexo,p_empDUI,p_empNIT,p_empISSS,p_empNUP,p_empDireccion,p_empEmail,p_tempId,p_empTelCasa,
			p_empCelular,p_empFechaNac,p_empProfesion);
	
    SET empId = LAST_INSERT_ID();
        
	-- Agregandolo a la plataforma para que pueda adminstrar a los grados asignados
    
    INSERT INTO Usuario(usrUsuario,usrNombre,usrPassword,rolId,empId) VALUES(codigo,CONCAT(p_empNombre,' ',p_empApellidoP,' ',p_empApellidoM),SHA2(codigo,256),(SELECT rolId FROM Rol WHERE rolNombre = 'Docente'),empId);
    
    -- Retornando el código generado
    
	SELECT codigo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-29 23:21:20
