CREATE DATABASE phpapirest;
USE phpapirest;

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) NOT NULL,
  `descripcion` text NOT NULL,
  `creado` datetime NOT NULL,
  `modificado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `creado`, `modificado`) VALUES
(1, 'Moda', 'Categoría para cualquier articulo relacionado con la moda.', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(2, 'Electrónica', 'Dispositivos electronicos, drones y más.', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(3, 'Automoviles', 'Deportes motorizados y más.', '2014-06-01 00:35:07', '2014-05-30 17:34:54'),
(5, 'Peliculas', 'Productos de cine.', '0000-00-00 00:00:00', '2016-01-08 13:27:26'),
(6, 'Libros', 'Libros impresos, audiolibros y más.', '0000-00-00 00:00:00', '2016-01-08 13:27:47'),
(7, 'Deportes', 'Prendas y accesorios deportivos.', '2016-01-09 02:24:24', '2016-01-09 01:24:24');


CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `creado` datetime NOT NULL,
  `modificado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`categoria_id`) REFERENCES categorias(`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `categoria_id`, `creado`, `modificado`) VALUES
(1, 'LG P880 4X HD', 'Primer modelo con ultra HD!', '336', 3, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(2, 'Google Nexus 4', 'El telefono mas veloz hasta el 2013!', '299', 2, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(3, 'Samsung Galaxy S4', 'Mayor rendimiento y duración de bateria', '600', 2, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(6, 'Camisa de seda', 'Elegancia y buen porte!', '29', 1, '2014-06-01 01:12:26', '2014-05-31 02:12:21'),
(7, 'Lenovo Laptop', 'Mas que una computadora, un socio.', '399', 2, '2014-06-01 01:13:45', '2014-05-31 02:13:39'),
(8, 'Samsung Galaxy Tab 10.1', 'Tablet de gama alta.', '259', 2, '2014-06-01 01:14:13', '2014-05-31 02:14:08'),
(9, 'Balón de Basketball Spalding', 'Con colores y diseños variados.', '199', 7, '2014-06-01 01:18:36', '2014-05-31 02:18:31'),
(10, 'Sony Smart Watch', 'El mejor reloj inteligente!', '300', 2, '2014-06-06 17:10:01', '2014-06-05 18:09:51'),
(11, 'Huawei Y300', 'Para proposito de pruebas.', '100', 2, '2014-06-06 17:11:04', '2014-06-05 18:10:54'),
(12, 'Camiseta Abercrombie', 'Perfecto como regalo!', '60', 1, '2014-06-06 17:12:21', '2014-06-05 18:12:11'),
(13, 'Pantalon Allen Brook', 'Comodo y elegante.', '70', 1, '2014-06-06 17:12:59', '2014-06-05 18:12:49'),
(14, 'Consejos de Feng Shui', 'Consejos para la decoración del hogar y el jardín.', '30', 6, '2014-11-22 19:07:34', '2014-11-21 20:07:34'),
(15, 'Recetario', 'Simplemente completo y delicioso', '79', 6, '2014-12-04 21:12:03', '2014-12-03 22:12:03'),
(16, 'Motocicleta Yamaha', 'Alta velocidad y seguridad!', '8333', 3, '2014-12-13 00:52:54', '2014-12-12 01:52:54'),
(17, 'Zapatos Nike', 'Comodos y ligeros.', '12999', 7, '2015-12-12 06:47:08', '2015-12-12 05:47:08'),
(18, 'Pipocas Pop Corns', 'Facil de preparar.', '999', 5, '2016-01-08 06:36:37', '2016-01-08 05:36:37'),
(19, 'Balón de Futbol', 'Balón de cuero y costura reforzada.', '25000', 7, '2016-01-11 15:46:02', '2016-01-11 14:46:02');
