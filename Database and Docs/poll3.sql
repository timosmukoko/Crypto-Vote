CREATE DATABASE  IF NOT EXISTS `poll3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `poll3`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: poll3
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.38-MariaDB

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
-- Table structure for table `tbadministrators`
--

DROP TABLE IF EXISTS `tbadministrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbadministrators` (
  `admin_id` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbadministrators`
--

LOCK TABLES `tbadministrators` WRITE;
/*!40000 ALTER TABLE `tbadministrators` DISABLE KEYS */;
INSERT INTO `tbadministrators` VALUES (1,'Admin','Admin','admin@gmail.com','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `tbadministrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcandidates`
--

DROP TABLE IF EXISTS `tbcandidates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcandidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcandidates`
--

LOCK TABLES `tbcandidates` WRITE;
/*!40000 ALTER TABLE `tbcandidates` DISABLE KEYS */;
INSERT INTO `tbcandidates` VALUES (28,10,6),(29,12,6),(30,12,2),(31,12,7);
/*!40000 ALTER TABLE `tbcandidates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbelections`
--

DROP TABLE IF EXISTS `tbelections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbelections` (
  `election_id` int(11) NOT NULL AUTO_INCREMENT,
  `election_name` varchar(255) NOT NULL,
  `reg_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('S','F','P','C') NOT NULL,
  PRIMARY KEY (`election_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbelections`
--

LOCK TABLES `tbelections` WRITE;
/*!40000 ALTER TABLE `tbelections` DISABLE KEYS */;
INSERT INTO `tbelections` VALUES (6,'Test','2019-04-10','2019-04-07','2019-04-10','F'),(7,'Test2','2019-04-09','2019-04-11','2019-04-12','S');
/*!40000 ALTER TABLE `tbelections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbmembers`
--

DROP TABLE IF EXISTS `tbmembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbmembers` (
  `member_id` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `voter_id` varchar(10) NOT NULL,
  `voter_pin` int(5) NOT NULL,
  `password` varchar(45) NOT NULL,
  `voter_status` int(11) NOT NULL DEFAULT '0',
  `candi_status` int(11) NOT NULL DEFAULT '0',
  `is_candidate` int(11) NOT NULL DEFAULT '0',
  `milestones` varchar(500) DEFAULT 'N/A',
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `voter_id` (`voter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbmembers`
--

LOCK TABLES `tbmembers` WRITE;
/*!40000 ALTER TABLE `tbmembers` DISABLE KEYS */;
INSERT INTO `tbmembers` VALUES (7,'Alice','Alice','alice@yahoo.ie','1234567A',7450,'cdece365365f774d819d55a07d18f16fb726ccb7',1,0,1,NULL),(8,'Bob','bob','bob@yahoo.fr','1234567B',1525,'4805c71b59c57ab42190741e2aaac317cbf36776',1,0,0,NULL),(9,'Colon','colon','colon@yahoo.ie','1234567C',507,'2f96c5a474ba72c35350299ef356b40d5a312abd',1,0,0,NULL),(10,'Doyle','doyle','doyle@yahoo.ie','1234567D',2321,'c5f91f454f1af32a24f3d3187ef68c0e4a7e1e73',1,1,1,'I am the best candidate'),(11,'Ely','ely','ely@yahoo.fr','1234567E',7523,'ba68501abf1d494d5a4aeef6894a46e6d0bd25e6',1,0,0,NULL),(12,'Frank','frank','frank@yahoo.ie','1234567F',3433,'4c21ce6239c6367ae2cb6ed4bd8b8a04aca9ec5d',1,1,1,'Vote for me... '),(14,'Georges','Georges','george@yahoo.ie','1234567G',3848,'3dbd30320c1fef7005ed7c1eb5caa8cff4bd8294',1,1,1,'N/A');
/*!40000 ALTER TABLE `tbmembers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbvote`
--

DROP TABLE IF EXISTS `tbvote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbvote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voter_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbvote`
--

LOCK TABLES `tbvote` WRITE;
/*!40000 ALTER TABLE `tbvote` DISABLE KEYS */;
INSERT INTO `tbvote` VALUES (6,10,6,10),(7,12,6,12),(8,11,6,10),(9,7,6,10),(10,8,6,12),(11,9,6,12),(12,14,6,12);
/*!40000 ALTER TABLE `tbvote` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-08 22:51:05
