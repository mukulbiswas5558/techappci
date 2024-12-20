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
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_country` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `initial` varchar(255) DEFAULT NULL,
  `flag` text,
  `continent_name` varchar(255) DEFAULT NULL,
  `major_cities` text,
  `capital` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `border_shared` text,
  `area` varchar(255) DEFAULT NULL,
  `climate` varchar(255) DEFAULT NULL,
  `topography` text,
  `population` varchar(255) DEFAULT NULL,
  `ethnic_groups` text,
  `language` text,
  `religions` text,
  `government_type` varchar(255) DEFAULT NULL,
  `prime_minister` varchar(255) DEFAULT NULL,
  `president` varchar(255) DEFAULT NULL,
  `vice_president` varchar(255) DEFAULT NULL,
  `administrative_division` text,
  `currency` varchar(255) DEFAULT NULL,
  `gdp` varchar(255) DEFAULT NULL,
  `gdp_per_capita` varchar(255) DEFAULT NULL,
  `major_industry` text,
  `exports` text,
  `imports` text,
  `brief_history` text,
  `key_historical_events` text,
  `tourist_stat` varchar(255) DEFAULT NULL,
  `education_system` text,
  `literacy_rate` varchar(255) DEFAULT NULL,
  `healthcare_system` text,
  `life_expectancy` varchar(255) DEFAULT NULL,
  `holidays` text,
  `cuisine` text,
  `sports` text,
  `major_attractions` text,
  `independance_date` date DEFAULT NULL,
  `denonym` varchar(255) DEFAULT NULL,
  `area_rank` varchar(255) DEFAULT NULL,
  `population_rank` varchar(255) DEFAULT NULL,
  `gdp_rank` varchar(255) DEFAULT NULL,
  `literacy_rate_rank` varchar(255) DEFAULT NULL,
  `male_literacy` varchar(255) DEFAULT NULL,
  `female_literacy` varchar(255) DEFAULT NULL,
  `sex_ratio` varchar(255) DEFAULT NULL,
  `sex_rank` varchar(255) DEFAULT NULL,
  `child_sex_ratio` varchar(255) DEFAULT NULL,
  `child_sex_rank` varchar(255) DEFAULT NULL,
  `embelam_image_url` text,
  `song` text,
  `bird` varchar(255) DEFAULT NULL,
  `fish` varchar(255) DEFAULT NULL,
  `flower` varchar(255) DEFAULT NULL,
  `fruit` varchar(255) DEFAULT NULL,
  `mammal` varchar(255) DEFAULT NULL,
  `tree` varchar(255) DEFAULT NULL,
  `map_link_url` text,
  `chief_justice` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (1,'IN','India','INnn','https://upload.wikimedia.org/wikipedia/commons/b/bc/Flag_of_India.png','Asia','Mumbai, Delhi, Bangalore','New Delhi','South Asia','Pakistan, China, Nepal','','Tropical','Plains, Mountains','','Multiple','Hindi, English','Hinduism, Islam','Democracy','Narendra Modi','Droupadi Murmu','Jagdeep Dhankhar','28 states','INR','','','IT, Agriculture','Textiles, Software','Oil, Machinery','Ancient civilization','Independence in 1947','10 million','CBSE, ICSE','77%','Universal healthcare','70 years','Diwali, Holi','Spicy foods','Cricket, Hockey','Taj Mahal, Jaipur','1947-08-15','Indian','7','2','5','10','80%','74%','940','100','920','90','https://emblem_url','Jana Gana Mana','Peacock','Rohu','Lotus','Mango','Tiger','Banyan','https://map_url','D. Y. Chandrachud','20.5937','78.9629111','2024-12-18 05:39:25','2024-12-18 07:38:53');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
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
