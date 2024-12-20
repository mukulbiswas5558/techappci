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
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `state` (
  `id` int NOT NULL,
  `country_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `continent_name` varchar(255) DEFAULT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `brief_history` text,
  `formation_date` date DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `chief_minister` varchar(255) DEFAULT NULL,
  `governor` varchar(255) DEFAULT NULL,
  `chief_justice` varchar(255) DEFAULT NULL,
  `denonyme` varchar(255) DEFAULT NULL,
  `area` decimal(15,2) DEFAULT NULL,
  `area_rank` int DEFAULT NULL,
  `population` int DEFAULT NULL,
  `population_rank` int DEFAULT NULL,
  `gdp` decimal(15,2) DEFAULT NULL,
  `gdp_rank` int DEFAULT NULL,
  `per_capita_income` decimal(15,2) DEFAULT NULL,
  `per_capita_income_rank` int DEFAULT NULL,
  `literacy` decimal(5,2) DEFAULT NULL,
  `literacy_rank` int DEFAULT NULL,
  `male_literacy` decimal(5,2) DEFAULT NULL,
  `female_literacy` decimal(5,2) DEFAULT NULL,
  `sex_ratio` decimal(5,2) DEFAULT NULL,
  `sex_ratio_rank` int DEFAULT NULL,
  `child_sex_ratio` decimal(5,2) DEFAULT NULL,
  `child_sex_ratio_rank` int DEFAULT NULL,
  `embelam_image` varchar(255) DEFAULT NULL,
  `song` varchar(255) DEFAULT NULL,
  `bird` varchar(255) DEFAULT NULL,
  `fish` varchar(255) DEFAULT NULL,
  `flower` varchar(255) DEFAULT NULL,
  `fruit` varchar(255) DEFAULT NULL,
  `mammal` varchar(255) DEFAULT NULL,
  `tree` varchar(255) DEFAULT NULL,
  `assembly` varchar(255) DEFAULT NULL,
  `high_court` varchar(255) DEFAULT NULL,
  `rajya_sava_seat` int DEFAULT NULL,
  `lok_sava_seat` int DEFAULT NULL,
  `map_link_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`),
  CONSTRAINT `state_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (1,1,'Uttar Pradesh','uttar-pradesh','UP','2024-12-18 08:36:05','2024-12-18 12:21:16','Asia','India','Lucknow','Uttar Pradesh, located in the northern part of India, is the most populous state in India.','1950-01-26','Hindi','Yogi Adityanath','Anandiben Patel','Dinesh Sharma','Uttar Pradeshi',243286.00,1,199812341,1,1500000.00,2,8000.00,3,70.00,5,75.00,65.00,0.94,1,0.98,1,'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/Emblem_of_India.svg/1024px-Emblem_of_India.svg.png','Jana Gana Mana','Sarus Crane','Ganges River Dolphin','Indian Lotus','Mango','Bengal Tiger','Peepal Tree nndd','Vidhan Sabha','Allahabad High Court',31,80,'https://en.wikipedia.org/wiki/Uttar_Pradesh');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
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
