-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.4.5 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para olt
CREATE DATABASE IF NOT EXISTS `olt` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `olt`;

-- Volcando estructura para tabla olt.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `tipo_usuario` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedAt` datetime DEFAULT NULL,
  `userDeleted` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_cliente
CREATE TABLE IF NOT EXISTS `w_cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `celular` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_equipo
CREATE TABLE IF NOT EXISTS `w_equipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUra` int DEFAULT NULL,
  `idServicio` int DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  `user` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `passw` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `idUser` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUra` (`idUra`),
  KEY `idServicio` (`idServicio`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `w_equipo_ibfk_1` FOREIGN KEY (`idUra`) REFERENCES `w_ura` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `w_equipo_ibfk_2` FOREIGN KEY (`idServicio`) REFERENCES `w_servicio` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `w_equipo_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_linea
CREATE TABLE IF NOT EXISTS `w_linea` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idReserva` int DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `clave` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idReserva` (`idReserva`),
  CONSTRAINT `w_linea_ibfk_1` FOREIGN KEY (`idReserva`) REFERENCES `w_reserva` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_observacion
CREATE TABLE IF NOT EXISTS `w_observacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idReserva` int DEFAULT NULL,
  `texto` text COLLATE utf8mb4_bin,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idReserva` (`idReserva`),
  CONSTRAINT `w_observacion_ibfk_1` FOREIGN KEY (`idReserva`) REFERENCES `w_reserva` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_plan_r
CREATE TABLE IF NOT EXISTS `w_plan_r` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_plan_t
CREATE TABLE IF NOT EXISTS `w_plan_t` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_plan_w
CREATE TABLE IF NOT EXISTS `w_plan_w` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `velocidad_up` int DEFAULT NULL,
  `velocidad_down` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_puerto
CREATE TABLE IF NOT EXISTS `w_puerto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idEquipo` int DEFAULT NULL,
  `idReserva` int DEFAULT NULL,
  `pon` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `puerto` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEquipo` (`idEquipo`),
  KEY `fk_puerto_reserva` (`idReserva`),
  CONSTRAINT `fk_puerto_reserva` FOREIGN KEY (`idReserva`) REFERENCES `w_reserva` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `w_puerto_ibfk_1` FOREIGN KEY (`idEquipo`) REFERENCES `w_equipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_reserva
CREATE TABLE IF NOT EXISTS `w_reserva` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCliente` int DEFAULT NULL,
  `idPuerto` int DEFAULT NULL,
  `idPlanr` int DEFAULT NULL,
  `idPlant` int DEFAULT NULL,
  `idPlanw` int DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `serie` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `fibra` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `tv` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `fecha_anulacion` datetime DEFAULT NULL,
  `idUser` int DEFAULT NULL,
  `mora` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idCliente` (`idCliente`),
  KEY `idPuerto` (`idPuerto`),
  KEY `idPlanr` (`idPlanr`),
  KEY `idPlant` (`idPlant`),
  KEY `idPlanw` (`idPlanw`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `w_reserva_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `w_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `w_reserva_ibfk_2` FOREIGN KEY (`idPuerto`) REFERENCES `w_puerto` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `w_reserva_ibfk_3` FOREIGN KEY (`idPlanr`) REFERENCES `w_plan_r` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `w_reserva_ibfk_4` FOREIGN KEY (`idPlant`) REFERENCES `w_plan_t` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `w_reserva_ibfk_5` FOREIGN KEY (`idPlanw`) REFERENCES `w_plan_w` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `w_reserva_ibfk_6` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_servicio
CREATE TABLE IF NOT EXISTS `w_servicio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla olt.w_ura
CREATE TABLE IF NOT EXISTS `w_ura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `fecha_reg` datetime DEFAULT NULL,
  `fecha_up` datetime DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `w_ura_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
