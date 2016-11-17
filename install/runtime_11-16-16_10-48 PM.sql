# ************************************************************
# Sequel Pro SQL dump
# Version 4500
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 10.0.27-MariaDB)
# Database: crex_runtime
# Generation Time: 2016-11-17 04:48:47 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ___recent_deployments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `___recent_deployments`;

CREATE TABLE `___recent_deployments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `deployment_key` varchar(50) NOT NULL,
  `deployed_by` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_current` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `before_recent_deployments_insert` BEFORE INSERT ON `___recent_deployments` FOR EACH ROW SET new.created_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table __components_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `__components_template`;

CREATE TABLE `__components_template` (
  `name` varchar(100) NOT NULL DEFAULT '',
  `html` text,
  `scss` text,
  `js_head` text,
  `js_body` text,
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table __layouts_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `__layouts_template`;

CREATE TABLE `__layouts_template` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `layout_name` varchar(200) NOT NULL DEFAULT '',
  `content` text,
  `meta` text,
  `js` text,
  `nonblocking_js` text,
  `style` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table __page_data_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `__page_data_template`;

CREATE TABLE `__page_data_template` (
  `page_id` bigint(20) NOT NULL,
  `page` varchar(500) NOT NULL,
  `reference_name` varchar(500) NOT NULL DEFAULT '',
  `content` text,
  KEY `page` (`page`),
  KEY `reference_name` (`reference_name`),
  KEY `page_2` (`page`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table __pages_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `__pages_template`;

CREATE TABLE `__pages_template` (
  `page_id` bigint(20) NOT NULL,
  `version_id` bigint(20) NOT NULL,
  `permalink` varchar(500) NOT NULL DEFAULT '',
  `page` varchar(500) NOT NULL,
  `layout` varchar(500) NOT NULL,
  `percentage` tinyint(4) NOT NULL DEFAULT '100',
  `title` varchar(500) NOT NULL,
  `contents` longtext,
  `for_render` longtext,
  KEY `permalink` (`permalink`),
  KEY `page` (`page`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table __scripts_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `__scripts_template`;

CREATE TABLE `__scripts_template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `content` longtext NOT NULL,
  `priority` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table __site_data_template
# ------------------------------------------------------------

DROP TABLE IF EXISTS `__site_data_template`;

CREATE TABLE `__site_data_template` (
  `reference_name` varchar(500) NOT NULL DEFAULT '',
  `content` text,
  KEY `reference_name` (`reference_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
