CREATE DATABASE  IF NOT EXISTS `flutter_prueba` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `flutter_prueba`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: flutter_prueba
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `comidas`
--

DROP TABLE IF EXISTS `comidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comidas` (
  `cod_tratamiento` int NOT NULL,
  `cod_comida` int NOT NULL,
  `desc_comida` varchar(150) NOT NULL,
  `tipo_comida` varchar(150) NOT NULL,
  `fecha_consumo` date DEFAULT NULL,
  `consumido` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_tratamiento`,`cod_comida`),
  KEY `cod_tratamiento_fk` (`cod_tratamiento`),
  CONSTRAINT `comidas_chk_1` CHECK ((`consumido` in (0,1)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comidas`
--

LOCK TABLES `comidas` WRITE;
/*!40000 ALTER TABLE `comidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `comidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuida`
--

DROP TABLE IF EXISTS `cuida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuida` (
  `cod_paciente` int NOT NULL,
  `cod_doctor` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_doctor`,`cod_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuida`
--

LOCK TABLES `cuida` WRITE;
/*!40000 ALTER TABLE `cuida` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `cod_usuario` int NOT NULL,
  `cod_doctor` int NOT NULL AUTO_INCREMENT,
  `cedula_doctor` char(14) DEFAULT NULL,
  `nombre_doctor` varchar(150) NOT NULL,
  `correo_doctor` varchar(100) NOT NULL,
  `clave_doctor` varchar(100) DEFAULT NULL,
  `consultorio_doctor` varchar(150) DEFAULT NULL,
  `cod_especialidad` int NOT NULL,
  `cod_hospital` int NOT NULL,
  PRIMARY KEY (`cod_doctor`),
  KEY `especialidad_fk` (`cod_especialidad`),
  KEY `cod_hospital_fk` (`cod_hospital`),
  KEY `cod_usuario_fk` (`cod_usuario`),
  CONSTRAINT `cod_usuario_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (1,1,'11997576','prueba','prueba','123','cpnsultorio prueba',1,1);
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_tratamiento`
--

DROP TABLE IF EXISTS `doctor_tratamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor_tratamiento` (
  `cod_tratamiento` int NOT NULL,
  `cod_doctor` int NOT NULL,
  PRIMARY KEY (`cod_tratamiento`,`cod_doctor`),
  KEY `cod_tratamiento_fk` (`cod_tratamiento`),
  KEY `cod_doctor_fk` (`cod_doctor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_tratamiento`
--

LOCK TABLES `doctor_tratamiento` WRITE;
/*!40000 ALTER TABLE `doctor_tratamiento` DISABLE KEYS */;
INSERT INTO `doctor_tratamiento` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `doctor_tratamiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `especialidad` (
  `cod_especialidad` int NOT NULL AUTO_INCREMENT,
  `nombre_especialidad` varchar(150) NOT NULL,
  `desc_especialidad` varchar(150) NOT NULL,
  PRIMARY KEY (`cod_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad`
--

LOCK TABLES `especialidad` WRITE;
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
INSERT INTO `especialidad` VALUES (1,'Especialidad de prueba','Direccion de prueba');
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formulario`
--

DROP TABLE IF EXISTS `formulario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formulario` (
  `cod_formulario` int NOT NULL AUTO_INCREMENT,
  `cod_doctor` int NOT NULL,
  PRIMARY KEY (`cod_formulario`),
  KEY `cod_doctor` (`cod_doctor`),
  CONSTRAINT `formulario_ibfk_1` FOREIGN KEY (`cod_doctor`) REFERENCES `doctor` (`cod_doctor`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulario`
--

LOCK TABLES `formulario` WRITE;
/*!40000 ALTER TABLE `formulario` DISABLE KEYS */;
INSERT INTO `formulario` VALUES (224,1),(226,1);
/*!40000 ALTER TABLE `formulario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hospital` (
  `cod_hospital` int NOT NULL AUTO_INCREMENT,
  `nombre_hospital` varchar(100) NOT NULL,
  `direc_hospital` varchar(150) NOT NULL,
  PRIMARY KEY (`cod_hospital`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospital`
--

LOCK TABLES `hospital` WRITE;
/*!40000 ALTER TABLE `hospital` DISABLE KEYS */;
INSERT INTO `hospital` VALUES (1,'Clinica de Prueba','Direccion de prueba');
/*!40000 ALTER TABLE `hospital` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicina_tratamiento`
--

DROP TABLE IF EXISTS `medicina_tratamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicina_tratamiento` (
  `cod_tratamiento` int NOT NULL,
  `cod_medicinas` int NOT NULL,
  PRIMARY KEY (`cod_tratamiento`,`cod_medicinas`),
  KEY `cod_tratamiento_fk` (`cod_tratamiento`),
  KEY `cod_medicinas_fk` (`cod_medicinas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicina_tratamiento`
--

LOCK TABLES `medicina_tratamiento` WRITE;
/*!40000 ALTER TABLE `medicina_tratamiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicina_tratamiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicinas`
--

DROP TABLE IF EXISTS `medicinas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicinas` (
  `cod_medicinas` int NOT NULL AUTO_INCREMENT,
  `nombre_medicina` varchar(150) NOT NULL,
  `desc_medicina` varchar(150) NOT NULL,
  `cod_tratamiento` int NOT NULL,
  PRIMARY KEY (`cod_medicinas`),
  KEY `cod_tratamiento_fk` (`cod_tratamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicinas`
--

LOCK TABLES `medicinas` WRITE;
/*!40000 ALTER TABLE `medicinas` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicinas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente` (
  `cod_usuario` int NOT NULL,
  `cod_paciente` int NOT NULL AUTO_INCREMENT,
  `cedula_paciente` char(14) DEFAULT NULL,
  `nombre_paciente` varchar(150) NOT NULL,
  `correo_paciente` varchar(100) NOT NULL,
  `tipo_diabetes` char(2) DEFAULT NULL,
  `estatus` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_paciente`),
  KEY `cod_usuario_paciente_fk` (`cod_usuario`),
  CONSTRAINT `cod_usuario_paciente_fk` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` VALUES (2,1,'27656348','Luis Somoza','luiscarlossomoza@gmail.com','1',1);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente_formulario`
--

DROP TABLE IF EXISTS `paciente_formulario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente_formulario` (
  `cod_formulario` int NOT NULL,
  `cod_paciente` int NOT NULL,
  `contestado` int NOT NULL DEFAULT '0',
  `fecha_contestado` date DEFAULT NULL,
  `ultima_muestra` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_formulario`,`cod_paciente`),
  KEY `cod_paciente` (`cod_paciente`),
  CONSTRAINT `paciente_formulario_ibfk_1` FOREIGN KEY (`cod_formulario`) REFERENCES `formulario` (`cod_formulario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paciente_formulario_ibfk_2` FOREIGN KEY (`cod_paciente`) REFERENCES `paciente` (`cod_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente_formulario`
--

LOCK TABLES `paciente_formulario` WRITE;
/*!40000 ALTER TABLE `paciente_formulario` DISABLE KEYS */;
INSERT INTO `paciente_formulario` VALUES (224,1,1,'2022-05-27',0),(226,1,1,'2022-05-27',0);
/*!40000 ALTER TABLE `paciente_formulario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente_tratamiento`
--

DROP TABLE IF EXISTS `paciente_tratamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paciente_tratamiento` (
  `cod_tratamiento` int NOT NULL,
  `cod_paciente` int NOT NULL,
  PRIMARY KEY (`cod_tratamiento`,`cod_paciente`),
  KEY `cod_tratamiento_fk` (`cod_tratamiento`),
  KEY `cod_paciente_fk` (`cod_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente_tratamiento`
--

LOCK TABLES `paciente_tratamiento` WRITE;
/*!40000 ALTER TABLE `paciente_tratamiento` DISABLE KEYS */;
INSERT INTO `paciente_tratamiento` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `paciente_tratamiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pregunta` (
  `cod_formulario` int NOT NULL,
  `num_pregunta` int NOT NULL,
  `enunciado` text NOT NULL,
  `respuesta` text,
  `tipo_respuesta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cod_formulario`,`num_pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES (224,1,'Ingresa cuanto mides',' 2','number'),(224,2,'Como estas',NULL,'text'),(224,3,'papi que tu quiere, aqui llego tu tiburon',NULL,'date'),(226,1,'Numero','5','number'),(226,2,'Texto','hola','text'),(226,3,'Fecha','2022-05-26','date');
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tratamiento`
--

DROP TABLE IF EXISTS `tratamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tratamiento` (
  `cod_tratamiento` int NOT NULL AUTO_INCREMENT,
  `desc_tratamiento` varchar(150) NOT NULL,
  `cod_paciente` int NOT NULL,
  `muestra` float DEFAULT NULL,
  `fecha_muestra` date DEFAULT NULL,
  `formulario` varchar(40) DEFAULT 'DISPONIBLE',
  `cod_doctor` int DEFAULT NULL,
  PRIMARY KEY (`cod_tratamiento`),
  KEY `cod_paciente_fk` (`cod_paciente`),
  KEY `fk_cod_doctor` (`cod_doctor`),
  CONSTRAINT `fk_cod_doctor` FOREIGN KEY (`cod_doctor`) REFERENCES `doctor` (`cod_doctor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tratamiento`
--

LOCK TABLES `tratamiento` WRITE;
/*!40000 ALTER TABLE `tratamiento` DISABLE KEYS */;
INSERT INTO `tratamiento` VALUES (1,'prueba',1,0,NULL,'DISPONIBLE',1),(2,'prueba',2,0,NULL,'DISPONIBLE',1),(3,'prueba',2,0,NULL,'DISPONIBLE',1);
/*!40000 ALTER TABLE `tratamiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `cod_usuario` int NOT NULL AUTO_INCREMENT,
  `clave_usuario` varchar(100) NOT NULL,
  `tipo_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'123','admin'),(2,'1234','member'),(3,'1234','member'),(4,'1234','member'),(5,'1234','member');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'flutter_prueba'
--

--
-- Dumping routines for database 'flutter_prueba'
--
/*!50003 DROP PROCEDURE IF EXISTS `buscar_formularios_contestados_doctor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_formularios_contestados_doctor`(_cod_doctor INT)
SELECT PF.cod_formulario,PF.cod_paciente,PF.fecha_contestado
FROM (SELECT P.cod_paciente AS cp, P.nombre_paciente AS np, P.estatus AS e, T.muestra AS m,T.formulario AS f
	  FROM paciente AS P, tratamiento AS T, doctor AS D, doctor_tratamiento AS DT, paciente_tratamiento AS PT
	  WHERE P.cod_paciente = PT.cod_paciente
	  AND  PT.cod_tratamiento = T.cod_tratamiento
	  AND T.cod_tratamiento = DT.cod_tratamiento
	  AND DT.cod_doctor = D.cod_doctor
      AND D.cod_doctor = _cod_doctor) AS pacientes_doctor,
      FORMULARIO AS F,
      PACIENTE_FORMULARIO AS PF
WHERE pacientes_doctor.cp = PF.cod_paciente
AND PF.cod_formulario = F.cod_formulario
AND F.cod_doctor = _cod_doctor
AND PF.contestado = 1 ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Buscar_pacientes_doctor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Buscar_pacientes_doctor`(_cod_doctor INT)
SELECT P.cod_paciente AS cp, P.nombre_paciente AS np, P.estatus AS e, T.muestra AS m,T.formulario AS f
FROM paciente AS P, tratamiento AS T, doctor AS D, doctor_tratamiento AS DT, paciente_tratamiento AS PT
WHERE P.cod_paciente = PT.cod_paciente
AND  PT.cod_tratamiento = T.cod_tratamiento
AND T.cod_tratamiento = DT.cod_tratamiento
AND DT.cod_doctor = D.cod_doctor
AND D.cod_doctor = _cod_doctor ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Buscar_pacientes_doctor_sin_formulario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Buscar_pacientes_doctor_sin_formulario`(_cod_doctor INT, _cod_formulario INT)
SELECT *
FROM (SELECT P.cod_paciente AS cp, P.nombre_paciente AS np, P.estatus AS e, T.muestra AS m,T.formulario AS f
	  FROM paciente AS P, tratamiento AS T, doctor AS D, doctor_tratamiento AS DT, paciente_tratamiento AS PT
	  WHERE P.cod_paciente = PT.cod_paciente
	  AND  PT.cod_tratamiento = T.cod_tratamiento
	  AND T.cod_tratamiento = DT.cod_tratamiento
	  AND DT.cod_doctor = D.cod_doctor
      AND D.cod_doctor = _cod_doctor) AS pacientes_doctor
WHERE pacientes_doctor.cp NOT IN (SELECT PF.cod_paciente
								  FROM paciente_formulario AS PF,FORMULARIO AS F
								  WHERE PF.cod_formulario = F.cod_formulario
								  AND F.cod_doctor = _cod_doctor
                                  AND F.cod_formulario = _cod_formulario) ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_respuesta_formulario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_respuesta_formulario`(_cod_formulario INT)
SELECT num_pregunta,enunciado,respuesta,tipo_respuesta
FROM PREGUNTA
WHERE cod_formulario = _cod_formulario ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Insertar_pregunta_formulario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insertar_pregunta_formulario`(_cod_formulario INT, _enunciado TEXT, _respuesta TEXT, _tipo_respuesta VARCHAR(200))
BEGIN
	DECLARE var_num_pregunta INTEGER;
	DECLARE var_cod_formulario INTEGER;
	DECLARE var_final INTEGER DEFAULT 0;
	DECLARE cursor1 CURSOR FOR SELECT cod_formulario,MAX(num_pregunta) FROM PREGUNTA WHERE cod_formulario = _cod_formulario;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET var_final = 1;
	OPEN cursor1;
		IF NOT EXISTS ( SELECT cod_formulario  FROM PREGUNTA WHERE cod_formulario = _cod_formulario ) THEN
			INSERT INTO PREGUNTA (cod_formulario,num_pregunta,enunciado,respuesta,tipo_respuesta) VALUES (_cod_formulario,1,_enunciado,_enunciado,_tipo_respuesta);
		END IF;
		FETCH cursor1 INTO var_cod_formulario,var_num_pregunta;
        INSERT INTO PREGUNTA (cod_formulario,num_pregunta,enunciado,respuesta,tipo_respuesta) VALUES (_cod_formulario,var_num_pregunta+1,_enunciado,_enunciado,_tipo_respuesta);
	CLOSE cursor1;
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

-- Dump completed on 2022-05-26 23:36:40
