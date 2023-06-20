/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `canton` (
  `id` int NOT NULL,
  `province_id` int NOT NULL,
  `canton` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`province_id`),
  KEY `fk_canton_province_idx` (`province_id`),
  CONSTRAINT `fk_canton_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `province` (
  `id` int NOT NULL,
  `province` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `realestates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `province` int NOT NULL,
  `canton` int NOT NULL,
  `images` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` longtext NOT NULL,
  `rooms` int NOT NULL,
  `wc` int NOT NULL,
  `parking` int NOT NULL,
  `date` date NOT NULL,
  `vendorId` int NOT NULL,
  PRIMARY KEY (`id`,`vendorId`),
  KEY `fk_realestates_vendors1_idx` (`vendorId`),
  CONSTRAINT `fk_realestates_vendorId` FOREIGN KEY (`vendorId`) REFERENCES `vendors` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `rentals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `province` int NOT NULL,
  `canton` int NOT NULL,
  `images` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` longtext NOT NULL,
  `rooms` int NOT NULL,
  `wc` int NOT NULL,
  `parking` int NOT NULL,
  `date` date NOT NULL,
  `vendorId` int NOT NULL,
  PRIMARY KEY (`id`,`vendorId`),
  KEY `fk_rentals_vendors_idx` (`vendorId`),
  CONSTRAINT `fk_rentals_vendorId` FOREIGN KEY (`vendorId`) REFERENCES `vendors` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `vendors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` char(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

INSERT INTO `canton` (`id`, `province_id`, `canton`) VALUES
(1, 1, 'San José');
INSERT INTO `canton` (`id`, `province_id`, `canton`) VALUES
(2, 1, 'Escazú');
INSERT INTO `canton` (`id`, `province_id`, `canton`) VALUES
(3, 1, 'Desamparados');
INSERT INTO `canton` (`id`, `province_id`, `canton`) VALUES
(4, 1, 'Puriscal'),
(5, 1, 'Tarrazú'),
(6, 1, 'Aserrí'),
(7, 1, 'Mora'),
(8, 1, 'Goicoechea'),
(9, 1, 'Santa Ana'),
(10, 1, 'Alajuelita'),
(11, 1, 'Vázquez de Coronado'),
(12, 1, 'Acosta'),
(13, 1, 'Tibás'),
(14, 1, 'Moravia'),
(15, 1, 'Montes de Oca'),
(16, 1, 'Turrubares'),
(17, 1, 'Dota'),
(18, 1, 'Curridabat'),
(19, 1, 'Pérez Zeledón'),
(20, 1, 'León Cortés Castro'),
(21, 2, 'Alajuela'),
(22, 2, 'San Ramón'),
(23, 2, 'Grecia'),
(24, 2, 'San Mateo'),
(25, 2, 'Atenas'),
(26, 2, 'Naranjo'),
(27, 2, 'Palmares'),
(28, 2, 'Poás'),
(29, 2, 'Orotina'),
(30, 2, 'San Carlos'),
(31, 2, 'Zarcero'),
(32, 2, 'Sarchí'),
(33, 2, 'Upala'),
(34, 2, 'Los Chiles'),
(35, 2, 'Guatuso'),
(36, 2, 'Río Cuarto'),
(37, 3, 'Cartago'),
(38, 3, 'Paraíso'),
(39, 3, 'La Unión'),
(40, 3, 'Jiménez'),
(41, 3, 'Turrialba'),
(42, 3, 'Alvarado'),
(43, 3, 'Oreamuno'),
(44, 3, 'El Guarco'),
(45, 4, 'Heredia'),
(46, 4, 'Barva'),
(47, 4, 'Santo Domingo'),
(48, 4, 'Santa Bárbara'),
(49, 4, 'San Rafael'),
(50, 4, 'San Isidro'),
(51, 4, 'Belén'),
(52, 4, 'Flores'),
(53, 4, 'San Pablo'),
(54, 4, 'Sarapiquí'),
(55, 5, 'Liberia'),
(56, 5, 'Nicoya'),
(57, 5, 'Santa Cruz'),
(58, 5, 'Bagaces'),
(59, 5, 'Carrillo'),
(60, 5, 'Cañas'),
(61, 5, 'Abangares'),
(62, 5, 'Tilarán'),
(63, 5, 'Nandayure'),
(64, 5, 'La Cruz'),
(65, 5, 'Hojancha'),
(66, 6, 'Puntarenas'),
(67, 6, 'Esparza'),
(68, 6, 'Buenos Aires'),
(69, 6, 'Montes de Oro'),
(70, 6, 'Osa'),
(71, 6, 'Quepos'),
(72, 6, 'Golfito'),
(73, 6, 'Coto Brus'),
(74, 6, 'Parrita'),
(75, 6, 'Corredores'),
(76, 6, 'Garabito'),
(77, 6, 'Monteverde'),
(78, 6, 'Puerto Jiménez'),
(79, 7, 'Limón'),
(80, 7, 'Pococí'),
(81, 7, 'Siquirres'),
(82, 7, 'Talamanca'),
(83, 7, 'Matina'),
(84, 7, 'Guácimo');

INSERT INTO `province` (`id`, `province`) VALUES
(1, 'San José');
INSERT INTO `province` (`id`, `province`) VALUES
(2, 'Alajuela');
INSERT INTO `province` (`id`, `province`) VALUES
(3, 'Cartago');
INSERT INTO `province` (`id`, `province`) VALUES
(4, 'Heredia'),
(5, 'Guanacaste'),
(6, 'Puntarenas'),
(7, 'Limón');





INSERT INTO `vendors` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `date`) VALUES
(1, 'Arturo', 'Hernandez Garza', '+527775158944', 'arturo_hdzg@hotmail.com', '$2y$10$dN6hhEeF0thtucnGQ5WDye3fM5Ghyn4hJ4AmznsRz9ww7jvInAhs2', '2023-04-27');
INSERT INTO `vendors` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `date`) VALUES
(2, 'Mary', 'Sossa', '+50688328276', 'mdm_711@yahoo.com', 'pass', '2023-05-03');
INSERT INTO `vendors` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `date`) VALUES
(4, 'Marty', 'McFly', '123456789', 'marty.mcfly@outatime.com', '1234', '2023-06-05');
INSERT INTO `vendors` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `date`) VALUES
(5, 'John', 'Wick', '12345678', 'john_wick@correo.com', '1234', '2023-06-07'),
(6, 'Cyberdyne Systems', 'T-800 modelo 101', ' 8885121984', 'terminator@skynet.net', '1234', '2023-06-13');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;