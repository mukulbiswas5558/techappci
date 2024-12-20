-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: apidb
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `profile_image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `isblock` varchar(255) DEFAULT 'active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mukul  biswas','admin@gmail.com','1234567890','$2y$10$6lf9iny5UHMxsnxNhCyCSuySiDurPDgFUcB4G/2UyORlO2TnUEe2y','male','admin','profile_images/john_doe.jpg','active','active','2024-11-22 10:55:17','2024-11-22 10:55:56'),(2,'Jane Smith','jane.smith','9876543210','hashedpassword456','female','user','profile_images/jane_smith.jpg','active','active','2024-11-22 10:55:17','2024-11-22 10:55:17'),(3,'suman','suman@gmail.com',NULL,'',NULL,'user',NULL,'active','active','2024-12-05 11:51:48','2024-12-05 11:51:48'),(4,'mukul','mukul@gmail.com',NULL,'',NULL,'user',NULL,'active','active','2024-12-05 15:59:45','2024-12-05 15:59:45'),(5,'mukul','mukul@gmail.co',NULL,'',NULL,'user',NULL,'active','active','2024-12-09 15:58:15','2024-12-09 15:58:15'),(6,'mukul','mukul@gmail1.co',NULL,'',NULL,'user',NULL,'active','active','2024-12-09 16:03:04','2024-12-09 16:03:04'),(7,'mukul','mukul@gmail1.com',NULL,'',NULL,'user',NULL,'active','active','2024-12-09 16:09:50','2024-12-09 16:09:50'),(8,'mukul','mukul@gmail12.com',NULL,'',NULL,'user',NULL,'active','active','2024-12-09 16:10:18','2024-12-09 16:10:18'),(9,'mukul','mukul@gmail122.com',NULL,'',NULL,'user',NULL,'active','active','2024-12-09 17:09:35','2024-12-09 17:09:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-20 14:24:34
