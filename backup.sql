
CREATE DATABASE IF NOT EXISTS `id17105048_compras` ;
USE `id17105048_compras`;


CREATE TABLE IF NOT EXISTS `listado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Producto` varchar(50) NOT NULL DEFAULT '0',
  `Cantidad` int(50) NOT NULL DEFAULT '0',
  `Medida` tinyint(4) NOT NULL DEFAULT '0',
  `Prioridad` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `listado` (`id`, `Producto`, `Cantidad`, `Medida`, `Prioridad`) VALUES
	(1, 'LECHE ENTERA', '4', 2, '2'),
	(3, 'CARNE', '2', 1, '2'),
	(4, 'GALLETITAS', '3', 2, '2');

