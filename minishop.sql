-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33-0ubuntu0.16.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for minishop_test
CREATE DATABASE IF NOT EXISTS `minishop_test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `minishop_test`;

-- Dumping structure for table minishop_test.attributes
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table minishop_test.attributes: ~6 rows (approximately)
DELETE FROM `attributes`;
/*!40000 ALTER TABLE `attributes` DISABLE KEYS */;
INSERT INTO `attributes` (`id`, `name`, `value`, `product_id`, `created`, `updated`) VALUES
	(1, 'color', 'black', 1, '2022-02-17 10:32:09', '2022-02-17 10:32:14'),
	(2, 'brand', 'nike', 1, '2022-02-17 10:32:24', '2022-02-17 10:32:30'),
	(3, 'size', 'big', 2, '2022-02-17 10:32:38', '2022-02-17 10:32:51'),
	(4, 'width', '10', 3, '2022-02-17 10:33:09', '2022-02-17 10:33:09'),
	(5, 'brand', 'Android', 2, '2022-02-17 10:33:43', '2022-02-17 10:33:46'),
	(6, 'height', '44', 3, '2022-02-17 10:33:59', '2022-02-17 10:34:03');
/*!40000 ALTER TABLE `attributes` ENABLE KEYS */;

-- Dumping structure for table minishop_test.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `price` float DEFAULT '0',
  `description` varchar(250) DEFAULT NULL,
  `image_url` varchar(250) DEFAULT NULL,
  `sale` tinyint(2) DEFAULT '0',
  `sale_price` float DEFAULT '0',
  `banner_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table minishop_test.products: ~7 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `title`, `price`, `description`, `image_url`, `sale`, `sale_price`, `banner_url`) VALUES
	(1, 'iPad', 100, 'Very good product 111', 'https://dummyimage.com/300x150/000/fff.jpg&text=test+1', 0, 150, NULL),
	(2, 'iPhone', 200, 'Some phone just test', 'https://dummyimage.com/300x200&text=test_product_2', 1, 250, NULL),
	(3, 'AppleTV', 300, 'Tv from Apple test 34343', 'https://dummyimage.com/300x200/999/ddd&text=test_product_3', 0, 350, NULL),
	(4, 'Apple Watch', 400, 'This an apple watch some text for test111', NULL, 1, 450, NULL),
	(5, 'Airpods', 500, 'These are air pods from Apple they are good for some people but I dont like them', NULL, 0, 550, NULL),
	(6, 'iMac', 600, 'Imac test test test', NULL, 1, 650, NULL),
	(7, 'Macbook', 700, 'Imac comp just another test description', NULL, 0, 750, NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
