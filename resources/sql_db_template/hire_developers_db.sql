# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.38)
# Database: hire_developers_db
# Generation Time: 2021-12-29 14:58:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table developers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `developers`;

CREATE TABLE `developers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `price_per_hour` float DEFAULT NULL,
  `technology` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `years_of_experience` varchar(255) NOT NULL,
  `native_language` varchar(255) NOT NULL,
  `linkedin_profile_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table hire_developers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hire_developers`;

CREATE TABLE `hire_developers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `hire_developers` WRITE;
/*!40000 ALTER TABLE `hire_developers` DISABLE KEYS */;

INSERT INTO `hire_developers` (`id`, `names`, `start_date`, `end_date`)
VALUES
	(537,'Siela Cesser','2021-12-30 00:00:00','2021-12-31 00:00:00'),
	(538,'Mikle Smith','2021-12-30 00:00:00','2021-12-31 00:00:00');

/*!40000 ALTER TABLE `hire_developers` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
