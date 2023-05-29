-- MySQL dump 10.13  Distrib 8.0.33, for macos13.3 (arm64)
--
-- Host: localhost    Database: MUCal
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Categories` (
  `RegionID` char(2) NOT NULL,
  `RegionName` varchar(50) NOT NULL,
  `ColorCode` varchar(7) NOT NULL,
  PRIMARY KEY (`RegionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categories`
--

LOCK TABLES `Categories` WRITE;
/*!40000 ALTER TABLE `Categories` DISABLE KEYS */;
INSERT INTO `Categories` VALUES ('AU','Australia','#65688f'),('DB','Dubai','#b56107'),('SG','Singapore','#3CB371');
/*!40000 ALTER TABLE `Categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Events`
--

DROP TABLE IF EXISTS `Events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Events` (
  `EventID` int NOT NULL AUTO_INCREMENT,
  `EventName` varchar(255) NOT NULL,
  `DateStart` date NOT NULL,
  `DateEnd` date DEFAULT NULL,
  `TimeStart` time DEFAULT NULL,
  `TimeEnd` time DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `RegionID` char(2) NOT NULL,
  `AmendedBy_ref` int DEFAULT NULL,
  PRIMARY KEY (`EventID`),
  KEY `RegionID` (`RegionID`),
  KEY `AmendedBy_ref` (`AmendedBy_ref`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`RegionID`) REFERENCES `Categories` (`RegionID`),
  CONSTRAINT `events_ibfk_2` FOREIGN KEY (`AmendedBy_ref`) REFERENCES `User` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Events`
--

LOCK TABLES `Events` WRITE;
/*!40000 ALTER TABLE `Events` DISABLE KEYS */;
INSERT INTO `Events` VALUES (1,'Graduation','2023-06-01','2023-06-01',NULL,NULL,'Australia Graduation today!','AU',2),(2,'Event 1','2023-06-02','2023-06-02','10:00:00',NULL,'Event description','AU',2),(3,'Event 2','2023-06-03','2023-06-03','14:00:00','16:00:00','Event description','AU',2),(4,'Graduation','2023-06-04','2023-06-04',NULL,NULL,'Singapore Graduation today!','SG',2),(5,'Event 1','2023-06-05','2023-06-05','10:00:00',NULL,'Event description','SG',2),(6,'Event 2','2023-06-06','2023-06-06','14:00:00','16:00:00','Event description','SG',2),(7,'Graduation','2023-06-07','2023-06-07',NULL,NULL,'Dubai Graduation today!','DB',2),(8,'Event 1','2023-06-08','2023-06-08','10:00:00',NULL,'Event description','DB',2),(9,'Event 2','2023-06-09','2023-06-09','14:00:00','16:00:00','Event description','DB',2);
/*!40000 ALTER TABLE `Events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `AccessRightsID` int NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `AccessRightsID` (`AccessRightsID`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`AccessRightsID`) REFERENCES `UserRights` (`AccessRightsID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Tharuka','tharuka@outlook.com',1),(2,'Willie','willie@outlook.com',1),(3,'Jas','jas@outlook.com',2),(4,'ZhengLong','zhenglong@outlook.com',3);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserRights`
--

DROP TABLE IF EXISTS `UserRights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `UserRights` (
  `AccessRightsID` int NOT NULL AUTO_INCREMENT,
  `AccessName` varchar(50) NOT NULL,
  PRIMARY KEY (`AccessRightsID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserRights`
--

LOCK TABLES `UserRights` WRITE;
/*!40000 ALTER TABLE `UserRights` DISABLE KEYS */;
INSERT INTO `UserRights` VALUES (1,'Administrator'),(2,'FacultyMember'),(3,'Student');
/*!40000 ALTER TABLE `UserRights` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-29  1:45:33
