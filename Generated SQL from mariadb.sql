-- MySQL dump 10.14  Distrib 5.5.47-MariaDB, for Linux (x86_64)
--
-- Host: dbdev.cs.uiowa.edu    Database: db_ngramer
-- ------------------------------------------------------
-- Server version	5.5.47-MariaDB

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
-- Table structure for table `Employers`
--

DROP TABLE IF EXISTS `Employers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Employers` (
  `Name` varchar(55) NOT NULL,
  `Location` varchar(55) NOT NULL,
  `EmployerID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`EmployerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Employers`
--

LOCK TABLES `Employers` WRITE;
/*!40000 ALTER TABLE `Employers` DISABLE KEYS */;
INSERT INTO `Employers` VALUES ('h','j street',1),('Google','123 ',2),('swag','1',3),('Google','123 Google',4),('Apple','123',5);
/*!40000 ALTER TABLE `Employers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PaycheckData`
--

DROP TABLE IF EXISTS `PaycheckData`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PaycheckData` (
  `PaycheckID` int(11) NOT NULL AUTO_INCREMENT,
  `PayPeriodStart` varchar(10) DEFAULT NULL,
  `PayPeriodEnd` varchar(10) DEFAULT NULL,
  `HoursPaid` int(10) unsigned NOT NULL,
  `AmountPaid` int(10) unsigned NOT NULL,
  `UserID` int(11) NOT NULL,
  `EmployerID` int(11) NOT NULL,
  PRIMARY KEY (`PaycheckID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PaycheckData`
--

LOCK TABLES `PaycheckData` WRITE;
/*!40000 ALTER TABLE `PaycheckData` DISABLE KEYS */;
INSERT INTO `PaycheckData` VALUES (1,'04/12/2016','04/15/2016',6,6,1,2),(2,'04/18/2016','04/29/2016',40,3457,1,2),(3,'04/11/2016','04/15/2016',40,5,3,4),(4,'04/11/2016','04/15/2016',40,40,1,2);
/*!40000 ALTER TABLE `PaycheckData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SMSTokens`
--

DROP TABLE IF EXISTS `SMSTokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SMSTokens` (
  `Cell` bigint(20) NOT NULL,
  `Token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SMSTokens`
--

LOCK TABLES `SMSTokens` WRITE;
/*!40000 ALTER TABLE `SMSTokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `SMSTokens` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(55) NOT NULL,
  `LastName` varchar(55) NOT NULL,
  `Username` varchar(55) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `Email` varchar(55) NOT NULL,
  `Age` int(11) NOT NULL,
  `AccountType` int(11) NOT NULL DEFAULT '2',
  `Phone` bigint(20) NOT NULL,
  `LastLoggedIn` timestamp NULL DEFAULT NULL,
  `DateJoined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Verified` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'User','User','User','$1$oxvBpPJm$6qUvF.4OgqvziGk6vMmp11','a@a.com',22,2,6308730098,NULL,'2016-04-13 19:48:24',0),(2,'b','b','b','$1$Bbz0WP4P$Ze9SlUGLfgXYW717u0rFG1','b@b',22,2,3456789012,NULL,'2016-04-13 22:08:47',0),(3,'j','j','j','$1$wJDMmOUv$ngsI1azGyo570pzxCqXF.1','j@j',22,2,6308730098,NULL,'2016-04-14 14:54:25',0),(4,'Admin','Admin','admin','$1$CC0s2plv$KuRSJfYVJa9JNtkTnkNJ./','Admin@admin',56,0,6308730098,NULL,'2016-04-20 20:25:57',0),(5,'Non Profit','Non Profit','nonprofit','$1$SbOIYyTA$Lt7gJPI/p0WNEF0UWKuis0','Non@profit',54,1,6308730098,NULL,'2016-04-20 20:26:45',0);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsersEmployment`
--

DROP TABLE IF EXISTS `UsersEmployment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsersEmployment` (
  `EmployerID` int(11) NOT NULL,
  `HourlyWage` int(10) unsigned NOT NULL,
  `StandardHours` int(10) unsigned NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`EmployerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsersEmployment`
--

LOCK TABLES `UsersEmployment` WRITE;
/*!40000 ALTER TABLE `UsersEmployment` DISABLE KEYS */;
INSERT INTO `UsersEmployment` VALUES (1,125,40,1),(2,6,100,1),(3,5,700,1),(4,25,40,3),(5,26,40,3);
/*!40000 ALTER TABLE `UsersEmployment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WageDataEntries`
--

DROP TABLE IF EXISTS `WageDataEntries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WageDataEntries` (
  `EntryID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `EmployerID` int(11) NOT NULL,
  `EntryDate` varchar(10) NOT NULL,
  `HoursWorked` int(10) unsigned NOT NULL,
  `EntryDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`EntryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WageDataEntries`
--

LOCK TABLES `WageDataEntries` WRITE;
/*!40000 ALTER TABLE `WageDataEntries` DISABLE KEYS */;
/*!40000 ALTER TABLE `WageDataEntries` ENABLE KEYS */;
UNLOCK TABLES;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-19 12:22:02
