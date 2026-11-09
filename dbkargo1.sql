/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - dbkargo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbkargo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `dbkargo`;

/*Table structure for table `auth_activation_attempts` */

DROP TABLE IF EXISTS `auth_activation_attempts`;

CREATE TABLE `auth_activation_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_activation_attempts` */

insert  into `auth_activation_attempts`(`id`,`ip_address`,`user_agent`,`token`,`created_at`) values 
(1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',NULL,'2024-04-02 14:03:40'),
(2,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',NULL,'2024-04-02 14:03:52'),
(3,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36','b4fa102d6749ece8791af9e039108dd2','2024-04-17 23:43:43');

/*Table structure for table `auth_groups` */

DROP TABLE IF EXISTS `auth_groups`;

CREATE TABLE `auth_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_groups` */

insert  into `auth_groups`(`id`,`name`,`description`) values 
(1,'Petugas','Mengelola Master Dan Transaksi'),
(2,'Kepala Kantor','Mengelola Laporan');

/*Table structure for table `auth_groups_permissions` */

DROP TABLE IF EXISTS `auth_groups_permissions`;

CREATE TABLE `auth_groups_permissions` (
  `group_id` int unsigned NOT NULL DEFAULT '0',
  `permission_id` int unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`),
  CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_groups_permissions` */

insert  into `auth_groups_permissions`(`group_id`,`permission_id`) values 
(1,1),
(1,2),
(1,3),
(1,4),
(2,4);

/*Table structure for table `auth_groups_users` */

DROP TABLE IF EXISTS `auth_groups_users`;

CREATE TABLE `auth_groups_users` (
  `group_id` int unsigned NOT NULL DEFAULT '0',
  `user_id` int unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`),
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_groups_users` */

insert  into `auth_groups_users`(`group_id`,`user_id`) values 
(1,20),
(2,21);

/*Table structure for table `auth_logins` */

DROP TABLE IF EXISTS `auth_logins`;

CREATE TABLE `auth_logins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_logins` */

insert  into `auth_logins`(`id`,`ip_address`,`email`,`user_id`,`date`,`success`) values 
(2,'::1','crafi2606@gmail.com',1,'2024-04-01 04:54:49',1),
(3,'::1','crafi2606@gmail.com',1,'2024-04-01 05:02:05',1),
(4,'::1','crafi2606@gmail.com',1,'2024-04-02 14:42:25',1),
(5,'::1','crafi2606@gmail.com',1,'2024-04-02 14:43:20',1),
(6,'::1','crafi2606@gmail.com',1,'2024-04-02 14:43:41',1),
(7,'::1','crafi2606@gmail.com',1,'2024-04-03 00:51:10',1),
(8,'::1','uyeegaming@gmail.com',3,'2024-04-03 01:39:26',1),
(9,'::1','crafi2606@gmail.com',1,'2024-04-03 01:39:54',1),
(10,'::1','crafi2606@gmail.com',NULL,'2024-04-03 02:02:01',0),
(11,'::1','crafi2606@gmail.com',1,'2024-04-03 02:02:09',1),
(12,'::1','crafi2606@gmail.com',1,'2024-04-03 03:02:43',1),
(13,'::1','crafi2606@gmail.com',1,'2024-04-03 03:03:05',1),
(14,'::1','crafi2606@gmail.com',1,'2024-04-03 03:03:20',1),
(15,'::1','lemontea666@gmail.com',NULL,'2024-04-03 23:21:40',0),
(16,'::1','crafi2606@gmail.com',1,'2024-04-03 23:21:58',1),
(17,'::1','pimpinan',NULL,'2024-04-03 23:23:11',0),
(18,'::1','crafi2606@gmail.com',1,'2024-04-03 23:23:18',1),
(19,'::1','uyeegaming@gmail.com',3,'2024-04-03 23:24:11',1),
(20,'::1','crafi2606@gmail.com',1,'2024-04-04 23:17:30',1),
(21,'::1','crafi2606@gmail.com',1,'2024-04-05 04:29:31',1),
(22,'::1','crafi2606@gmail.com',1,'2024-04-05 05:39:30',0),
(23,'::1','crafi2606@gmail.com',1,'2024-04-05 05:39:33',1),
(24,'::1','crafi2606@gmail.com',1,'2024-04-06 04:56:03',1),
(25,'::1','crafi2606@gmail.com',1,'2024-04-16 22:58:44',1),
(26,'::1','crafi2606@gmail.com',1,'2024-04-16 23:57:34',1),
(27,'::1','crafi2606@gmail.com',1,'2024-04-17 16:40:34',1),
(28,'::1','pramuditometra@gmail.com',NULL,'2024-04-17 21:27:55',0),
(29,'::1','pramuditometra@gmail.com',NULL,'2024-04-17 21:29:11',0),
(30,'::1','uyeegaming@gmail.com',3,'2024-04-17 22:01:14',1),
(31,'::1','uyegaming4@gmail.com',NULL,'2024-04-17 23:40:56',0),
(32,'::1','pramuditometra@gmail.com',7,'2024-04-17 23:43:55',1),
(33,'::1','pramuditometra@gmail.com',7,'2024-04-17 23:47:37',1),
(34,'::1','pramuditometra@gmail.com',7,'2024-04-17 23:47:59',1),
(35,'::1','pramuditometra@gmail.com',7,'2024-04-17 23:50:49',1),
(36,'::1','pramuditometra@gmail.com',7,'2024-04-18 00:14:26',1),
(37,'::1','pramuditometra@gmail.com',NULL,'2024-04-18 12:52:28',0),
(38,'::1','pramuditometra@gmail.com',NULL,'2024-04-18 12:52:34',0),
(39,'::1','pramuditometra@gmail.com',7,'2024-04-18 12:52:55',1),
(40,'::1','pramuditometra@gmail.com',7,'2024-04-18 15:35:28',1),
(41,'::1','pramuditometra@gmail.com',7,'2024-04-18 23:19:43',1),
(42,'::1','pramuditometra@gmail.com',7,'2024-04-19 15:41:59',1),
(43,'::1','pramuditometra@gmail.com',NULL,'2024-04-19 17:58:35',0),
(44,'::1','pramuditometra@gmail.com',7,'2024-04-19 17:58:43',1),
(45,'::1','pramudito',NULL,'2024-04-19 22:35:21',0),
(46,'::1','pramuditometra@gmail.com',7,'2024-04-19 22:35:28',1),
(47,'::1','pramuditometra@gmail.com',7,'2024-04-20 03:30:21',1),
(48,'::1','pramuditometra@gmail.com',7,'2024-04-20 04:46:49',1),
(49,'::1','pramuditometra@gmail.com',7,'2024-04-21 16:28:56',1),
(50,'::1','pramudito',NULL,'2024-04-22 03:52:19',0),
(51,'::1','pramudito',NULL,'2024-04-22 03:52:27',0),
(52,'::1','pramuditometra@gmail.com',7,'2024-04-22 03:52:43',1),
(53,'::1','pramuditometra@gmail.com',NULL,'2024-04-23 00:12:15',0),
(54,'::1','pramuditometra@gmail.com',7,'2024-04-23 00:12:28',1),
(55,'::1','pramuditometra@gmail.com',NULL,'2024-04-23 01:19:59',0),
(56,'::1','pramuditometra@gmail.com',7,'2024-04-23 01:20:11',1),
(57,'::1','pramuditometra@gmail.com',7,'2024-04-23 01:20:16',1),
(58,'::1','pramuditometra@gmail.com',7,'2024-04-23 04:21:05',1),
(59,'::1','pramuditometra@gmail.com',7,'2024-04-24 21:19:14',1),
(60,'::1','pramuditometra@gmail.com',7,'2024-04-24 23:46:32',1),
(61,'::1','pramuditometra@gmail.com',7,'2024-04-25 02:21:42',1),
(62,'::1','pramuditometra@gmail.com',7,'2024-05-09 19:53:41',1),
(63,'::1','pramuditometra@gmail.com',7,'2024-05-09 23:05:33',1),
(64,'::1','pramuditometra@gmail.com',7,'2024-05-10 01:10:32',1),
(65,'::1','pramuditometra@gmail.com',7,'2024-05-10 01:10:56',1),
(66,'::1','pramuditometra@gmail.com',7,'2024-05-10 01:11:53',1),
(67,'::1','pramuditometra@gmail.com',7,'2024-05-10 15:13:21',1),
(68,'::1','pramuditometra@gmail.com',7,'2024-05-17 23:55:21',1),
(69,'::1','pramuditometra@gmail.com',7,'2024-05-17 23:58:21',1),
(70,'::1','pramuditometra@gmail.com',7,'2024-05-18 00:00:07',1),
(71,'::1','crafi2606@gmail.com',NULL,'2024-05-23 18:30:47',0),
(72,'::1','crafi2606@gmail.com',NULL,'2024-05-23 18:30:49',0),
(73,'::1','pramuditometra@gmail.com',7,'2024-05-23 18:31:55',1),
(74,'::1','crafi2606@gmail.com',8,'2024-05-23 18:48:10',1),
(75,'::1','crafi2606@gmail.com',8,'2024-05-23 21:24:57',1),
(76,'::1','crafi2606@gmail.com',8,'2024-05-23 21:25:15',1),
(77,'::1','crafi2606@gmail.com',8,'2024-05-23 21:27:35',1),
(78,'::1','pramuditometra@gmail.com',7,'2024-05-23 21:29:00',1),
(79,'::1','crafi2606@gmail.com',8,'2024-05-26 17:52:02',1),
(80,'::1','crafi2606@gmail.com',8,'2024-05-26 17:54:16',1),
(81,'::1','crafi2606@gmail.com',8,'2024-05-26 17:57:38',1),
(82,'::1','crafi2606@gmail.com',8,'2024-05-26 17:57:46',1),
(83,'::1','pramuditometra@gmail.com',7,'2024-05-26 18:03:00',1),
(84,'::1','crafi2606@gmail.com',8,'2024-05-26 18:08:18',1),
(85,'::1','crafi2606@gmail.com',8,'2024-05-26 19:51:15',1),
(86,'::1','crafi2606@gmail.com',8,'2024-05-26 19:51:25',1),
(87,'::1','pramuditometra@gmail.com',7,'2024-05-26 19:51:39',1),
(88,'::1','pramuditometra@gmail.com',7,'2024-05-26 20:07:41',1),
(89,'::1','crafi2606@gmail.com',8,'2024-05-27 16:06:44',1),
(90,'::1','crafi2606@gmail.com',8,'2024-05-27 16:08:01',1),
(91,'::1','crafi2606@gmail.com',8,'2024-05-27 16:13:10',1),
(92,'::1','crafi2606@gmail.com',8,'2024-05-27 16:13:49',1),
(93,'::1','crafi2606@gmail.com',8,'2024-05-27 22:55:14',1),
(94,'::1','crafi2606@gmail.com',8,'2024-06-03 01:54:16',1),
(95,'::1','crafi2606@gmail.com',8,'2024-06-25 11:35:35',1),
(96,'::1','crafi2606@gmail.com',8,'2024-06-25 15:10:36',1),
(97,'::1','crafi2606@gmail.com',8,'2024-06-25 16:04:50',1),
(98,'::1','crafi2606@gmail.com',8,'2024-06-29 01:27:34',1),
(99,'::1','crafi2606@gmail.com',8,'2024-06-30 14:40:07',1),
(100,'::1','tiwiwahyuni4@gmail.com',13,'2024-06-30 15:25:59',1),
(101,'::1','crafi2606@gmail.com',8,'2024-06-30 16:08:34',1),
(102,'::1','tiwiwahyuni4@gmail.com',16,'2024-06-30 16:15:50',1),
(103,'::1','yessy@gmail.com',17,'2024-06-30 16:24:00',1),
(104,'::1','tiwiwahyuni4@gmail.com',16,'2024-06-30 16:24:24',1),
(105,'::1','tiwiwahyuni4@gmail.com',16,'2024-06-30 17:58:28',1),
(106,'::1','tiwiwahyuni4@gmail.com',16,'2024-06-30 23:23:21',1),
(107,'::1','tiwiwahyuni4@gmail.com',16,'2024-07-01 02:26:54',1),
(108,'::1','tiwiwahyuni4@gmail.com',16,'2024-07-01 14:17:22',1),
(109,'::1','crafi2606@gmail.com',NULL,'2024-07-01 16:46:27',0),
(110,'::1','tiwiwahyuni4@gmail.com',16,'2024-07-01 16:46:42',1),
(111,'::1','tiwiwahyuni4@gmail.com',16,'2024-07-02 09:46:52',1),
(112,'::1','tiwiwahyuni4@gmail.com',16,'2024-07-02 11:44:06',1),
(113,'::1','tiwiwahyuni4@gmail.com',16,'2024-07-02 21:07:14',1),
(114,'::1','devi@gmail.com',20,'2024-07-02 21:12:25',1),
(115,'::1','devi',NULL,'2024-07-03 04:25:25',0),
(116,'::1','devi',NULL,'2024-07-03 04:25:33',0),
(117,'::1','devi',NULL,'2024-07-03 04:25:58',0),
(118,'::1','devi',NULL,'2024-07-03 04:26:03',0),
(119,'::1','devi',NULL,'2024-07-03 04:26:08',0),
(120,'::1','devi',NULL,'2024-07-03 04:26:23',0),
(121,'::1','devi',NULL,'2024-07-03 04:26:30',0),
(122,'::1','devi@gmail.com',20,'2024-07-03 04:27:53',1),
(123,'::1','devi',NULL,'2024-07-03 04:28:17',0),
(124,'::1','devi@gmail.com',20,'2024-07-03 04:28:25',1),
(125,'::1','devi@gmail.com',20,'2024-07-03 15:39:08',1),
(126,'::1','devi@gmail.com',20,'2024-07-03 23:41:43',1),
(127,'::1','devi@gmail.com',20,'2024-07-04 01:48:50',1),
(128,'::1','kepalakantor@gmail.com',21,'2024-07-04 03:29:06',1),
(129,'::1','devi@gmail.com',20,'2024-07-04 04:32:14',1),
(130,'::1','devi@gmail.com',20,'2024-07-04 05:13:35',1),
(131,'::1','kepalakantor@gmail.com',21,'2024-07-04 09:52:56',1),
(132,'::1','devi@gmail.com',20,'2024-07-04 10:52:29',1),
(133,'::1','devi@gmail.com',20,'2024-07-07 17:31:31',1),
(134,'::1','devi',NULL,'2024-07-07 18:05:35',0),
(135,'::1','devi@gmail.com',20,'2024-07-07 18:06:52',1),
(136,'::1','puput',NULL,'2024-07-07 20:37:09',0),
(137,'::1','puput@gmail.com',20,'2024-07-07 20:37:23',1),
(138,'::1','puput@gmail.com',20,'2024-07-08 03:12:02',1),
(139,'::1','puput@gmail.com',20,'2024-07-08 08:48:56',1),
(140,'::1','putjul',NULL,'2024-07-09 02:30:57',0),
(141,'::1','putjul',NULL,'2024-07-09 02:31:07',0),
(142,'::1','putjul',NULL,'2024-07-09 02:31:34',0),
(143,'::1','puput',NULL,'2024-07-09 02:31:47',0),
(144,'::1','puput@gmail.com',NULL,'2024-07-09 02:32:18',0),
(145,'::1','puput',NULL,'2024-07-09 02:32:29',0),
(146,'::1','puput',NULL,'2024-07-09 02:32:54',0),
(147,'::1','puput',NULL,'2024-07-09 02:33:02',0),
(148,'::1','puput@gmail.com',20,'2024-07-09 02:33:43',1),
(149,'::1','puput@gmail.com',20,'2024-07-09 14:46:19',1),
(150,'::1','puput',NULL,'2024-07-09 20:50:26',0),
(151,'::1','puput@gmail.com',20,'2024-07-09 20:50:37',1),
(152,'::1','puput@gmail.com',20,'2024-07-10 04:30:45',1),
(153,'::1','puput@gmail.com',20,'2024-07-10 22:59:17',1),
(154,'::1','puput@gmail.com',20,'2024-07-10 22:59:18',1),
(155,'::1','puput@gmail.com',20,'2024-07-11 11:42:15',1),
(156,'::1','sherly@gmail.com',20,'2024-07-17 01:48:20',1),
(157,'::1','sherly@gmail.com',20,'2024-07-17 11:32:22',1),
(158,'::1','sherly@gmail.com',20,'2024-07-17 14:15:37',1),
(159,'::1','sherly@gmail.com',20,'2024-07-17 15:57:03',1),
(160,'::1','sherly@gmail.com',20,'2024-07-17 16:06:17',1),
(161,'::1','sherly',NULL,'2024-07-17 23:03:36',0),
(162,'::1','sherly@gmail.com',20,'2024-07-17 23:04:04',1),
(163,'::1','sherly',NULL,'2024-07-18 10:05:50',0),
(164,'::1','sherly@gmail.com',20,'2024-07-18 10:06:02',1),
(165,'::1','sherly@gmail.com',20,'2024-07-18 11:35:17',1),
(166,'::1','sherly@gmail.com',20,'2024-07-18 11:47:42',1),
(167,'::1','sherly@gmail.com',20,'2024-07-18 13:57:13',1),
(168,'::1','sherly@gmail.com',20,'2024-07-18 14:40:48',1),
(169,'::1','sherly@gmail.com',20,'2024-07-18 15:02:42',1),
(170,'::1','sherly',NULL,'2024-07-20 00:12:46',0),
(171,'::1','sherly',NULL,'2024-07-20 00:12:55',0),
(172,'::1','sherly@gmail.com',20,'2024-07-20 00:13:03',1),
(173,'::1','sherly@gmail.com',20,'2024-07-20 00:16:03',1),
(174,'::1','sherly@gmail.com',20,'2024-07-20 12:44:50',1),
(175,'::1','sherly@gmail.com',20,'2024-07-20 15:29:48',1),
(176,'::1','sherly@gmail.com',20,'2024-07-20 16:13:16',1),
(177,'::1','pimpinan@gmail.com',21,'2024-07-20 16:17:48',1),
(178,'::1','pimpinan@gmail.com',21,'2024-07-20 16:40:22',1),
(179,'::1','sherly@gmail.com',20,'2024-07-20 16:42:28',1),
(180,'::1','sherly@gmail.com',20,'2024-07-20 16:46:48',1),
(181,'::1','sherly@gmail.com',20,'2024-09-01 18:55:12',1),
(182,'::1','sherly@gmail.com',20,'2024-10-01 11:22:51',1),
(183,'::1','sherly@gmail.com',20,'2024-10-08 16:12:14',1),
(184,'::1','sherli',NULL,'2024-10-12 16:56:52',0),
(185,'::1','sherly@gmail.com',20,'2024-10-12 16:57:21',1),
(186,'::1','sherly@gmail.com',20,'2024-10-17 19:17:09',1),
(187,'::1','sherly@gmail.com',20,'2024-11-06 17:12:12',1),
(188,'::1','dhimas@gmail.com',20,'2025-01-14 15:34:32',1),
(189,'::1','dhimas@gmail.com',20,'2025-01-14 23:25:36',1),
(190,'::1','dhimas@gmail.com',20,'2025-01-15 04:58:13',1),
(191,'::1','dhimas',NULL,'2025-01-15 05:28:33',0),
(192,'::1','dhimas',NULL,'2025-01-15 05:28:55',0),
(193,'::1','dhimas',NULL,'2025-01-15 05:29:12',0),
(194,'::1','dhimas@gmail.com',NULL,'2025-01-15 05:31:12',0),
(195,'::1','dhimas',NULL,'2025-01-15 05:37:39',0),
(196,'::1','dhimas@gmail.com',NULL,'2025-01-15 05:38:09',0),
(197,'::1','dhimas',NULL,'2025-01-15 05:38:56',0),
(198,'::1','dhimas@gmail.com',20,'2025-01-15 05:39:05',1),
(199,'::1','dhimas@gmail.com',20,'2025-01-15 13:49:18',1),
(200,'::1','dhimas@gmail.com',20,'2025-01-15 15:44:39',1),
(201,'::1','dhimas@gmail.com',20,'2025-01-15 20:46:10',1),
(202,'::1','dhimas@gmail.com',20,'2025-01-16 02:45:24',1),
(203,'::1','dhimas@gmail.com',20,'2025-01-16 03:05:31',1),
(204,'::1','dhimas@gmail.com',20,'2025-01-16 03:08:32',1),
(205,'::1','dhimas@gmail.com',20,'2025-01-17 22:07:39',1),
(206,'::1','bagus@gmail.com',22,'2025-01-17 22:09:25',1),
(207,'::1','dhimas@gmail.com',20,'2025-01-17 22:09:48',1),
(208,'::1','pimpinan@gmail.com',21,'2025-01-17 22:33:48',1),
(209,'::1','dhimas@gmail.com',20,'2025-01-17 22:34:50',1);

/*Table structure for table `auth_permissions` */

DROP TABLE IF EXISTS `auth_permissions`;

CREATE TABLE `auth_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_permissions` */

insert  into `auth_permissions`(`id`,`name`,`description`) values 
(1,'Mengelola Master','Semua Master'),
(2,'Mengelola Transaksi','Semua Transaksi'),
(3,'Mengelola Pelanggan','Semua Pelanggan'),
(4,'Mengelola Laporan','Semua Laporan'),
(5,'Melakukan Pemesanan','Khusus Pelanggan');

/*Table structure for table `auth_reset_attempts` */

DROP TABLE IF EXISTS `auth_reset_attempts`;

CREATE TABLE `auth_reset_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_reset_attempts` */

insert  into `auth_reset_attempts`(`id`,`email`,`ip_address`,`user_agent`,`token`,`created_at`) values 
(1,'','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36','','2024-04-02 14:10:20'),
(2,'','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36','','2024-04-02 14:37:51');

/*Table structure for table `auth_tokens` */

DROP TABLE IF EXISTS `auth_tokens`;

CREATE TABLE `auth_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int unsigned NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`),
  CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_tokens` */

/*Table structure for table `auth_users_permissions` */

DROP TABLE IF EXISTS `auth_users_permissions`;

CREATE TABLE `auth_users_permissions` (
  `user_id` int unsigned NOT NULL DEFAULT '0',
  `permission_id` int unsigned NOT NULL DEFAULT '0',
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`),
  CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `auth_users_permissions` */

/*Table structure for table `konsumen` */

DROP TABLE IF EXISTS `konsumen`;

CREATE TABLE `konsumen` (
  `idkonsumen` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenkel` enum('L','P') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nohp` char(15) DEFAULT NULL,
  PRIMARY KEY (`idkonsumen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `konsumen` */

insert  into `konsumen`(`idkonsumen`,`nama`,`jenkel`,`alamat`,`nohp`) values 
('P-0001','IHZA','L','JL,LUBAY NO 01','08542136987');

/*Table structure for table `kota` */

DROP TABLE IF EXISTS `kota`;

CREATE TABLE `kota` (
  `idkota` int NOT NULL AUTO_INCREMENT,
  `namakota` varchar(255) DEFAULT NULL,
  `alamat` text,
  `notelp` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idkota`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `kota` */

insert  into `kota`(`idkota`,`namakota`,`alamat`,`notelp`) values 
(6,'PADANG','JL.OLO LADANG NO 69, PADANG','081234564665'),
(7,'PEKANBARU','JL.PEKANBARU NO 01, PEKANBARU','08124578963'),
(8,'MEDAN','JL.MEDAN NO 01, MEDAN','08124578963'),
(9,'PALEMBANG','JL.PALEMBANG NO 01, PALEMBANG','08124578963'),
(10,'ACEH','JL.ACEH NO 01, ACEH','08124578963'),
(11,'JAKARTA','JL.JAKARTA NO 01, JAKARTA','08124578963');

/*Table structure for table `pengiriman` */

DROP TABLE IF EXISTS `pengiriman`;

CREATE TABLE `pengiriman` (
  `noresi` char(30) NOT NULL,
  `idtarif` int DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `idkonsumen` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `namapenerima` varchar(255) DEFAULT NULL,
  `alamatpenerima` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `nohppenerima` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `berat` int DEFAULT NULL,
  `totalbiaya` double DEFAULT NULL,
  `status` enum('1','2','3') DEFAULT NULL,
  PRIMARY KEY (`noresi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pengiriman` */

insert  into `pengiriman`(`noresi`,`idtarif`,`tgl`,`idkonsumen`,`namapenerima`,`alamatpenerima`,`nohppenerima`,`berat`,`totalbiaya`,`status`) values 
('KRG-20250117-603',8,'2025-01-17','P-0001','DEA','JL,PENGAMBIRAN, JAKARTA','085421356897',10,200000,'3');

/*Table structure for table `tarif` */

DROP TABLE IF EXISTS `tarif`;

CREATE TABLE `tarif` (
  `idtarif` int NOT NULL AUTO_INCREMENT,
  `namatarif` varchar(255) DEFAULT NULL,
  `idkotaasal` int DEFAULT NULL,
  `idkotatujuan` int DEFAULT NULL,
  `tarif` double DEFAULT NULL,
  `layanan` enum('express','reguler') DEFAULT NULL,
  `estimasi` int DEFAULT NULL,
  PRIMARY KEY (`idtarif`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tarif` */

insert  into `tarif`(`idtarif`,`namatarif`,`idkotaasal`,`idkotatujuan`,`tarif`,`layanan`,`estimasi`) values 
(7,'ELEKTRONIK',6,11,15000,'reguler',4),
(8,'PERABOTAN',6,11,20000,'reguler',4),
(9,'MAKANAN',6,11,10000,'express',3);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'default.jpg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`username`,`fullname`,`foto`,`password_hash`,`reset_hash`,`reset_at`,`reset_expires`,`activate_hash`,`status`,`status_message`,`active`,`force_pass_reset`,`created_at`,`updated_at`,`deleted_at`) values 
(20,'dhimas@gmail.com','dhimas','dhimas','foto-20250115-dhimas.png','$2y$10$qU6k41xcVZWOnG/q8fTRs.quatJzNm8yT/sh5Kd0T4MyCkPBWZsy2',NULL,NULL,NULL,'91d3c636d2164921e41f450e2b4e9255',NULL,NULL,1,0,'2024-07-02 21:12:00','2025-01-16 03:00:03',NULL),
(21,'pimpinan@gmail.com','pimpinan','pimpinan','foto-20250116-pimpinan.jpg','$2y$10$EDXHGnc8J0Z9FFPK75hQHu4UxHkhTnsHeEDVKO17AfkCYM30yRvU2',NULL,NULL,NULL,'c2a914298a96131e16e7f46f11874dff',NULL,NULL,1,0,'2024-07-04 03:27:52','2025-01-16 03:23:12',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
