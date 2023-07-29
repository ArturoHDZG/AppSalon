/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `usersId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`usersId`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `services_reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservationsId` int DEFAULT NULL,
  `servicesId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservationsId` (`reservationsId`),
  KEY `servicesId` (`servicesId`),
  CONSTRAINT `services_reservations_ibfk_1` FOREIGN KEY (`reservationsId`) REFERENCES `reservations` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `services_reservations_ibfk_2` FOREIGN KEY (`servicesId`) REFERENCES `services` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lastName` varchar(60) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirm` tinyint(1) DEFAULT NULL,
  `token` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `reservations` (`id`, `date`, `time`, `usersId`) VALUES
(2, '2023-07-25', '11:00:00', 2);


INSERT INTO `services` (`id`, `name`, `price`) VALUES
(1, 'Women\'s Haircut', 15.50);
INSERT INTO `services` (`id`, `name`, `price`) VALUES
(2, 'Men\'s Haircut', 14.50);
INSERT INTO `services` (`id`, `name`, `price`) VALUES
(3, 'Kid\'s Haircut', 13.50);
INSERT INTO `services` (`id`, `name`, `price`) VALUES
(4, 'Hairstyle Woman', 14.50),
(5, 'Hairstyle Men', 13.50),
(6, 'Hairstyle Kids', 13.50),
(7, 'Beard Cut', 13.50),
(8, 'Hair Dye Women', 30.00),
(9, 'Nails', 40.00),
(10, 'Hair Wash', 10.00),
(11, 'Capillary Treatment', 20.00);

INSERT INTO `services_reservations` (`id`, `reservationsId`, `servicesId`) VALUES
(1, NULL, 2);
INSERT INTO `services_reservations` (`id`, `reservationsId`, `servicesId`) VALUES
(2, NULL, 3);
INSERT INTO `services_reservations` (`id`, `reservationsId`, `servicesId`) VALUES
(3, NULL, 5);
INSERT INTO `services_reservations` (`id`, `reservationsId`, `servicesId`) VALUES
(4, NULL, 7),
(5, NULL, 11),
(6, 2, 2),
(7, 2, 5),
(8, 2, 7);

INSERT INTO `users` (`id`, `name`, `lastName`, `email`, `password`, `phone`, `admin`, `confirm`, `token`) VALUES
(1, 'Super', 'Admin', 'admin@appsalon.com', '$2y$10$WHW5fbKZL1xJMKku9TQyYumq0hidmEe4S1YJeN.QqJBIap53u0kxG', '7775158944', 1, 1, '');
INSERT INTO `users` (`id`, `name`, `lastName`, `email`, `password`, `phone`, `admin`, `confirm`, `token`) VALUES
(2, 'Arturo', 'Hernandez Garza', 'arturo_hdzg@hotmail.com', '$2y$10$Ei/Bf6aq9WgFPLsu32dqPufspJjiWL1Zews0hFXi4uq676Y2TZXzm', '7775158944', 0, 1, '');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
