-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: mandalay_db
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `features` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `floor_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:Inactive,1:Active',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order_no` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `features`
--

LOCK TABLES `features` WRITE;
/*!40000 ALTER TABLE `features` DISABLE KEYS */;
INSERT INTO `features` VALUES (50,1,'KITCHEN',NULL,NULL,1,0,1,NULL,'2019-12-13 17:47:16'),(51,1,'Gourmet Kitchen (19077)','1572931560.png','$ 120',1,50,2,NULL,'2019-12-13 17:47:16'),(52,1,'GREAT ROOM AND DINING',NULL,NULL,1,0,3,NULL,'2019-12-13 17:47:16'),(53,1,'Fireplace at Great Room (40030)','1574764794.png','$ 600',1,52,4,NULL,'2019-12-13 17:47:16'),(54,1,'Windows at Great Room (22573)','1574771879.png','$ 500',1,52,8,NULL,'2019-12-13 17:47:16'),(55,1,'4\' Expansion at Great Room (17521)','1575268750.png','$ 400',1,52,5,NULL,'2019-12-13 17:47:16'),(56,1,'10\' Ceiling at Great Room (10006)','1574764852.png','$ 600',1,52,9,NULL,'2019-12-13 17:47:16'),(58,1,'11\' Ceiling at Great Room (10007)','1574764996.png','$ 600',1,52,10,NULL,'2019-12-13 17:47:16'),(63,1,'12\' Sliding Glass Door (22516)','1572932683.png','$ 120',1,52,16,NULL,'2019-12-13 17:47:16'),(64,1,'Corner Sliders (22529)','1573653643.png','$ 500',1,52,15,NULL,'2019-12-13 17:47:16'),(65,1,'Window at Dining Room (22571)','1573643236.png','$ 500',1,52,13,NULL,'2019-12-13 17:47:16'),(66,1,'Extended Dining Room (17511)','1573653684.png','$ 600',1,52,14,NULL,'2019-12-13 17:47:16'),(67,1,'BEDROOMS AND BATHROOMS',NULL,NULL,1,0,17,NULL,'2019-12-13 17:47:16'),(68,1,'Windows at Owner\'s Suite (22574)','1574269417.png','$ 120',1,67,18,NULL,'2019-12-13 17:47:16'),(70,1,'Sitting Room at Owner\'s Suite (17506)','1574765326.png','$ 600',1,67,19,NULL,'2019-12-13 17:47:16'),(73,1,'2\' Owner\'s Suite Expansion (17563)','1575267804.png','$ 600',1,67,20,NULL,'2019-12-13 17:47:16'),(74,1,'Curbless Walk-In Shower at Owner\'s Bath (19104)','1573135510.png','$ 100',1,67,31,NULL,'2019-12-13 17:47:16'),(75,1,'Walk-In Shower at Owner\'s Bath (19087)','1574765419.png','$ 500',1,67,28,NULL,'2019-12-13 17:47:16'),(77,1,'4\' Owner\'s Suite Expansion (17564)','1575267780.png','$ 600',1,67,21,NULL,'2019-12-13 17:47:16'),(78,1,'2\' Owner\'s Bath/Closet Expansion (17517)','1575267842.png','$ 500',1,67,22,NULL,'2019-12-13 17:47:16'),(81,1,'LAUNDRY',NULL,NULL,1,0,41,NULL,'2019-12-13 17:47:16'),(82,1,'Stacked Washer/Dryer set up at Laundry Room (45005)','1574766592.PNG','$ 500',1,81,42,NULL,'2019-12-13 17:47:16'),(83,1,'Sink Rough-In at Laundry (45046)','1574272282.png','$ 500',1,81,43,NULL,'2019-12-13 17:47:16'),(84,1,'GARAGE',NULL,NULL,1,0,44,NULL,'2019-12-13 17:47:16'),(85,1,'2\' Garage Expansion (15505)','1574767399.png','$ 120',1,84,45,NULL,'2019-12-13 17:47:16'),(86,1,'Garage Service Door (15536)','1574270142.png','$ 100',1,84,51,NULL,'2019-12-13 17:47:16'),(88,1,'Bedroom 3 in lieu of Den (19005)','1574765519.png','$ 500',1,67,39,NULL,'2019-12-13 17:47:16'),(89,1,'5\' Garage Expansion (15507)','1574767469.png','$ 500',1,84,47,NULL,'2019-12-13 17:47:16'),(91,1,'1-Car Garage (15558)','1574767549.png','$ 100',1,84,49,NULL,'2019-12-13 17:47:16'),(92,1,'Service Door at 1-Car Garage (15536)','1574270212.png','$ 120',1,84,50,NULL,'2019-12-13 17:47:16'),(93,1,'Soft Water Loop Rough-In (45027)','1574270237.png','$ 120',1,84,52,NULL,'2019-12-13 17:47:16'),(96,1,'Deck Mounted Tub at Owners Suite Bath','1573118692.png','$ 500',1,67,34,NULL,'2019-12-13 17:47:16'),(97,1,'4\' Owner\'s Bath/Closet Expansion (17565)','1575267869.png','$ 600',1,67,23,NULL,'2019-12-13 17:47:16'),(100,1,'OUTDOOR LIVING',NULL,NULL,1,0,53,NULL,'2019-12-13 17:47:16'),(102,1,'Step-In Shower at Bath 2 (45009 or 45010)','1573120422.png','$ 120',1,67,40,NULL,'2019-12-13 17:47:16'),(103,1,'Side Patio at Den/Office or Bedroom 3 (17033 or 17034)','1574271739.png','$ 600',1,100,56,NULL,'2019-12-13 17:47:16'),(104,1,'Service Door at 5\' Garage Expansion (15536)','1574270267.png','$ 100',1,84,48,NULL,'2019-12-13 17:47:16'),(105,1,'Windows at Expanded Great Room (22573)','1574765047.png','$ 120',1,52,6,NULL,'2019-12-13 17:47:16'),(106,1,'Fireplace at Expanded Great Room (40030)','1574765083.png','$ 100',1,52,7,NULL,'2019-12-13 17:47:16'),(113,1,'Outdoor Great Room (17004)','1574769934.png','$ 500',1,100,54,NULL,'2019-12-13 17:47:16'),(115,1,'Service Door at 2\' Garage Expansion (15536)','1574270303.png','$750',1,84,46,NULL,'2019-12-13 17:47:16'),(116,1,'Windows at Owner\'s Suite (22574)','1573813073.png','$ 100',1,67,24,NULL,'2019-12-13 17:47:16'),(118,1,'Sitting Room with 2\' Owner\'s Suite Expansion (17506)','1575267517.png','50.00',1,67,26,NULL,'2019-12-13 17:47:16'),(119,1,'Sitting Room with 4\' Owner\'s Suite Expansion (17506)','1574766564.png','50.00',1,67,27,NULL,'2019-12-13 17:47:16'),(120,1,'Windows at Owner\'s Suite (22574)','1573813140.png','$ 120',1,67,25,NULL,'2019-12-13 17:47:16'),(127,1,'Enclosed Den with Doors (19105 or 19106)','1574766057.png','$ 500',1,67,37,NULL,'2019-12-13 17:47:16'),(128,1,'Fireplace at Outdoor Great Room (40042)','1574771139.png','$ 150',1,100,55,NULL,'2019-12-13 17:47:16'),(130,1,'Closet at Enclosed Den (19107)','1574766097.png','200',1,67,38,NULL,'2019-12-13 17:47:16'),(131,1,'Beams at Raised Ceiling (10034)','1574764930.png','$200',1,52,11,NULL,'2019-12-13 17:47:16'),(132,1,'Beams at Expanded Great Room (10034)','1574764969.png','$ 500',1,52,12,NULL,'2019-12-13 17:47:16'),(133,1,'Curbless Walk-In Shower at Owner\'s Bath (with 2\' Expansion) (19104)','1574855185.png','$200',1,67,32,NULL,'2019-12-13 17:47:16'),(134,1,'Curbless Walk-In Shower at Owner\'s Bath (with 4\' Expansion) (19104)','1574855227.png','200',1,67,33,NULL,'2019-12-13 17:47:23'),(135,1,'Walk-In Shower at Owner\'s Bath (with 2\' Expansion) (19087)','1574855343.png','$200',1,67,29,NULL,'2019-12-13 17:47:16'),(136,1,'Walk-In Shower at Owner\'s Bath (with 4\' Expansion) (19087)','1574855367.png','$200',1,67,30,NULL,'2019-12-13 17:47:16'),(139,1,'Deck Mounted Tub (2\' Expansion)','1575267669.png','$ 200',1,67,35,NULL,'2019-12-13 17:47:16'),(140,1,'Deck Mounted tub (4\' Expansion)','1575267687.png','$ 200',1,67,36,NULL,'2019-12-13 17:47:16');
/*!40000 ALTER TABLE `features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floor_acl_settings`
--

DROP TABLE IF EXISTS `floor_acl_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `floor_acl_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `floor_id` bigint(20) unsigned NOT NULL,
  `feature_id` bigint(20) unsigned NOT NULL,
  `conflicts` json DEFAULT NULL,
  `dependency` json DEFAULT NULL,
  `togetherness` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `floor_acl_settings_feature_id_foreign` (`feature_id`),
  KEY `floor_acl_settings_floor_id_foreign` (`floor_id`),
  KEY `floor_acl_settings_user_id_foreign` (`user_id`),
  CONSTRAINT `floor_acl_settings_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  CONSTRAINT `floor_acl_settings_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `floor_acl_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2667 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floor_acl_settings`
--

LOCK TABLES `floor_acl_settings` WRITE;
/*!40000 ALTER TABLE `floor_acl_settings` DISABLE KEYS */;
INSERT INTO `floor_acl_settings` VALUES (2644,1,1,55,'[\"53\", \"54\", \"131\"]','[\"105\", \"106\", \"132\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2645,1,1,56,'[\"58\"]','[\"131\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2646,1,1,58,'[\"56\"]','[\"131\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2647,1,1,63,'[\"64\"]','[]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2648,1,1,65,'[\"64\"]','[]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2649,1,1,73,'[\"68\", \"70\", \"74\", \"75\", \"77\", \"96\", \"97\", \"119\", \"120\", \"134\", \"136\", \"140\"]','[\"116\", \"118\", \"135\", \"139\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2650,1,1,75,'[\"96\", \"133\", \"134\"]','[\"74\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2651,1,1,77,'[\"68\", \"70\", \"73\", \"74\", \"75\", \"78\", \"96\", \"97\", \"116\", \"118\", \"133\", \"135\", \"139\"]','[\"119\", \"120\", \"136\", \"140\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2652,1,1,78,'[\"74\", \"75\", \"77\", \"96\", \"97\", \"116\", \"118\", \"119\", \"120\", \"134\", \"136\", \"140\"]','[\"135\", \"139\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2653,1,1,85,'[\"86\", \"89\", \"91\", \"92\", \"104\"]','[\"115\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2654,1,1,86,'[\"85\", \"89\", \"91\", \"92\", \"104\", \"115\"]','[]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2655,1,1,88,'[\"127\"]','[]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2656,1,1,89,'[\"85\", \"86\", \"91\", \"92\", \"115\"]','[\"104\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2657,1,1,91,'[\"85\", \"86\", \"89\", \"104\", \"115\"]','[\"92\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2658,1,1,96,'[\"74\", \"75\", \"133\", \"134\", \"135\", \"136\"]','[]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2659,1,1,97,'[\"73\", \"74\", \"75\", \"78\", \"116\", \"118\", \"119\", \"120\", \"133\", \"135\"]','[\"136\", \"140\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2660,1,1,113,'[]','[\"128\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2661,1,1,127,'[\"88\"]','[\"130\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2662,1,1,131,'[\"55\", \"132\"]','[]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2663,1,1,135,'[\"74\", \"75\", \"77\", \"96\", \"97\", \"134\", \"136\", \"140\"]','[\"133\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2664,1,1,136,'[\"73\", \"74\", \"75\", \"78\", \"96\", \"133\", \"135\", \"139\"]','[\"134\"]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2665,1,1,139,'[\"74\", \"75\", \"77\", \"96\", \"133\", \"134\", \"135\", \"136\", \"140\"]','[]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43'),(2666,1,1,140,'[\"73\", \"74\", \"75\", \"78\", \"96\", \"133\", \"134\", \"135\", \"136\", \"139\"]','[]','[]','2019-12-13 17:51:43','2019-12-13 17:51:43');
/*!40000 ALTER TABLE `floor_acl_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floors`
--

DROP TABLE IF EXISTS `floors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `floors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `home_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floors`
--

LOCK TABLES `floors` WRITE;
/*!40000 ALTER TABLE `floors` DISABLE KEYS */;
INSERT INTO `floors` VALUES (1,1,'First Floor','1574772927.png',1,NULL,'2019-11-26 12:55:27');
/*!40000 ALTER TABLE `floors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homes`
--

DROP TABLE IF EXISTS `homes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bedrooms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bathrooms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homes`
--

LOCK TABLES `homes` WRITE;
/*!40000 ALTER TABLE `homes` DISABLE KEYS */;
INSERT INTO `homes` VALUES (1,'PLAN 603 | FARMHOUSE',NULL,'1,664 Sq.Ft.','2 Bedrooms + Den','2 Bathrooms','$ 300000','2 Cars','1571995324.jpg',1,'2019-10-23 15:25:32','2019-12-10 21:19:15'),(2,'PLAN 603 | PRAIRIE','Jasper','1664 Sqft','2 Bedroom + DEN','2 Bathrooms','1,000,000','2 Garage','1574213425.jpg',1,'2019-10-29 15:27:29','2019-11-20 01:30:25');
/*!40000 ALTER TABLE `homes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(8,'2019_10_15_114406_create_settings_table',3),(11,'2019_10_13_120822_create_homes_table',4),(12,'2019_10_13_170113_create_floors_table',4),(13,'2019_10_14_181820_create_features_table',4),(14,'2019_10_21_180035_create_floor_acl_settings_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,NULL,'1-877-JASPER2','jasper@mandalayhomes.com','2019-12-10 06:07:54','2019-12-10 06:07:54');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@gmail.com',NULL,'$2y$10$ykmm5ImrkueCZvY2.0Qcb.Rj6YFGAE2etvmaqd0S8IXPyzhqWwUyy',NULL,NULL,NULL);
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

-- Dump completed on 2019-12-14  7:22:01
