CREATE TABLE `producto` (
	`id_producto` INT NOT NULL AUTO_INCREMENT,
	`nombre` varchar(100) NOT NULL,
	`descripcion` varchar(500) NOT NULL,
	`precio` DECIMAL(10,2) NOT NULL,
	`img_principal` varchar(50) NOT NULL,
	`img_secundaria` varchar(50) NOT NULL,
	`sku` varchar(10) NOT NULL,
	`id_categoria` INT NOT NULL,
	PRIMARY KEY (`id_producto`)
);

CREATE TABLE `usuario` (
	`id_usuario` INT NOT NULL AUTO_INCREMENT,
	`nombre` varchar(100) NOT NULL,
	`correo` varchar(100) NOT NULL,
	`telefono` varchar(20) NOT NULL,
	`password` varchar(50) NOT NULL,
	PRIMARY KEY (`id_usuario`)
);

CREATE TABLE `item_sesion` (
	`id_item_sesion` INT NOT NULL AUTO_INCREMENT,
	`id_sesion` INT NOT NULL,
	`id_producto` INT NOT NULL,
	`cantidad` INT NOT NULL,
	PRIMARY KEY (`id_item_sesion`)
);

CREATE TABLE `orden` (
	`id_orden` INT NOT NULL AUTO_INCREMENT,
	`direccion` varchar(200) NOT NULL,
	`ciudad` varchar(20) NOT NULL,
	`pais` varchar(20) NOT NULL,
	`total` DECIMAL(10,2) NOT NULL,
	`id_usuario` INT NOT NULL,
	PRIMARY KEY (`id_orden`)
);

CREATE TABLE `categoria` (
	`id_categoria` INT NOT NULL AUTO_INCREMENT,
	`nombre` varchar(20) NOT NULL,
	PRIMARY KEY (`id_categoria`)
);

CREATE TABLE `sesion` (
	`id_sesion` INT NOT NULL AUTO_INCREMENT,
	`session_id` varchar(30) NOT NULL,
	`id_usuario` INT NOT NULL,
	`fecha_creacion` DATETIME NOT NULL,
	PRIMARY KEY (`id_sesion`)
);

CREATE TABLE `item_orden` (
	`id_item_orden` INT NOT NULL AUTO_INCREMENT,
	`id_orden` INT NOT NULL,
	`id_producto` INT NOT NULL,
	`cantidad` INT NOT NULL,
	PRIMARY KEY (`id_item_orden`)
);

ALTER TABLE `producto` ADD CONSTRAINT `producto_fk0` FOREIGN KEY (`id_categoria`) REFERENCES `categoria`(`id_categoria`);

ALTER TABLE `item_sesion` ADD CONSTRAINT `item_sesion_fk0` FOREIGN KEY (`id_sesion`) REFERENCES `sesion`(`id_sesion`);

ALTER TABLE `item_sesion` ADD CONSTRAINT `item_sesion_fk1` FOREIGN KEY (`id_producto`) REFERENCES `producto`(`id_producto`);

ALTER TABLE `orden` ADD CONSTRAINT `orden_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id_usuario`);

ALTER TABLE `sesion` ADD CONSTRAINT `sesion_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id_usuario`);

ALTER TABLE `item_orden` ADD CONSTRAINT `item_orden_fk0` FOREIGN KEY (`id_orden`) REFERENCES `orden`(`id_orden`);

ALTER TABLE `item_orden` ADD CONSTRAINT `item_orden_fk1` FOREIGN KEY (`id_producto`) REFERENCES `producto`(`id_producto`);








